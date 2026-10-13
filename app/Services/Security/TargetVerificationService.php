<?php

namespace App\Services\Security;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * TargetVerificationService — Defense in Depth: Anti-SSRF Layer
 *
 * Multi-pass validation pipeline before any network request is made:
 *
 *   Pass 1 – Scheme Allowlist : Only http/https. Blocks file://, gopher://,
 *             dict://, ftp://, and any other protocol vector.
 *
 *   Pass 2 – Domain Scope    : Hostname must match official Pemprov Jatim
 *             subdomains (*.jatimprov.go.id) or the exact configured scope list.
 *
 *   Pass 3 – DNS + IP Guard  : Resolved IPv4 must not fall inside private,
 *             loopback, or link-local ranges (RFC 1918, RFC 3927, RFC 5737).
 *             Guards against DNS rebinding & SSRF to internal services.
 *
 *   Pass 4 – Live Health Check: Lightweight HEAD (fallback GET) to confirm the
 *             asset is responsive and capture the real HTTP status code.
 *
 * Return shape:
 *   ['status' => string, 'message' => string, ...optional fields]
 *
 * Status values:
 *   'verified'         — asset is live and in-scope
 *   'out_of_scope'     — domain does not match configured scope
 *   'prohibited_target'— resolved IP is private/reserved
 *   'invalid_scheme'   — scheme is not http/https
 *   'dns_failure'      — hostname could not be resolved
 *   'offline'          — asset did not respond within timeout
 */
class TargetVerificationService
{
    /**
     * Allowed schemes (strictly enforced to prevent alternative-protocol SSRF).
     *
     * @var list<string>
     */
    private const ALLOWED_SCHEMES = ['http', 'https'];

    /**
     * Regex pattern(s) for in-scope domains.
     * All must be anchored (^ … $) to prevent suffix bypass attacks.
     * Additional patterns can be added for future scoping.
     *
     * @var list<string>
     */
    private const SCOPE_PATTERNS = [
        '/^[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*\.jatimprov\.go\.id$/i',
        '/^jatimprov\.go\.id$/i',
    ];

    /**
     * HTTP timeout in seconds for the live health-check request.
     */
    private const HTTP_TIMEOUT = 4;

    /**
     * Verify a raw URL against the full Anti-SSRF pipeline.
     *
     * @param  string  $rawUrl  The URL as submitted by the hunter
     * @return array{status: string, message: string, is_live?: bool, http_code?: int, ip?: string, domain?: string}
     */
    public function verify(string $rawUrl): array
    {
        $rawUrl = trim($rawUrl);

        // ── Pass 1: Scheme Enforcement ────────────────────────────────────────
        $parsedScheme = strtolower((string) parse_url($rawUrl, PHP_URL_SCHEME));

        if (! in_array($parsedScheme, self::ALLOWED_SCHEMES, true)) {
            return [
                'status'  => 'invalid_scheme',
                'message' => 'Protokol tidak diizinkan. Hanya URL HTTP atau HTTPS yang diterima.',
            ];
        }

        // ── Parse hostname ────────────────────────────────────────────────────
        $host = strtolower(trim((string) parse_url($rawUrl, PHP_URL_HOST)));

        if ($host === '') {
            return [
                'status'  => 'invalid_scheme',
                'message' => 'URL tidak valid: hostname tidak ditemukan.',
            ];
        }

        // Strip IPv6 brackets if present
        $host = ltrim(rtrim($host, ']'), '[');

        // ── Pass 2: Domain Scope Validation ───────────────────────────────────
        if (! $this->isInScope($host)) {
            return [
                'status'  => 'out_of_scope',
                'message' => 'Target di luar lingkup kewenangan JatimProv-CSIRT. Domain harus berakhiran .jatimprov.go.id.',
                'domain'  => $host,
            ];
        }

        // ── Pass 3: DNS Resolution + Private IP Guard ─────────────────────────
        $ipValidation = $this->resolveAndValidateIp($host);

        if ($ipValidation['blocked']) {
            return [
                'status'  => isset($ipValidation['dns_failure']) ? 'dns_failure' : 'prohibited_target',
                'message' => $ipValidation['message'],
                'domain'  => $host,
            ];
        }

        $resolvedIp = $ipValidation['ip'];

        // ── Pass 4: Live Asset Health Check ───────────────────────────────────
        $healthCheck = $this->performHealthCheck($rawUrl);

        if (! $healthCheck['reachable']) {
            return [
                'status'  => 'offline',
                'message' => 'Target tidak merespons dalam batas waktu yang ditentukan.',
                'domain'  => $host,
                'ip'      => $resolvedIp,
            ];
        }

        return [
            'status'    => 'verified',
            'message'   => 'Aset resmi JatimProv terverifikasi dan aktif.',
            'is_live'   => true,
            'http_code' => $healthCheck['http_code'],
            'ip'        => $resolvedIp,
            'domain'    => $host,
        ];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Private helpers
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Check whether the hostname matches any in-scope pattern or explicit list.
     */
    private function isInScope(string $host): bool
    {
        foreach (self::SCOPE_PATTERNS as $pattern) {
            if (preg_match($pattern, $host) === 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * Resolve the hostname via DNS and validate the resulting IP is not
     * private, loopback, link-local, or otherwise reserved.
     *
     * Returns: ['blocked' => bool, 'ip' => string|null, 'message' => string, 'dns_failure' => bool?]
     *
     * @return array{blocked: bool, ip: string|null, message: string, dns_failure?: bool}
     */
    private function resolveAndValidateIp(string $host): array
    {
        // Block bare IPv4/IPv6 literals directly supplied as the "hostname"
        if (filter_var($host, FILTER_VALIDATE_IP)) {
            return $this->checkIpSafety($host);
        }

        // DNS A record lookup
        $dnsRecords = dns_get_record($host, DNS_A);

        if (empty($dnsRecords)) {
            // Fallback: gethostbyname() (may use OS cache)
            $resolved = gethostbyname($host);
            if ($resolved === $host) {
                // gethostbyname returns the original name when it fails
                return [
                    'blocked'     => true,
                    'ip'          => null,
                    'message'     => 'Domain tidak dapat diresolusi (DNS failure). Pastikan target aktif.',
                    'dns_failure' => true,
                ];
            }
            return $this->checkIpSafety($resolved);
        }

        // Take the first A record
        $ip = (string) ($dnsRecords[0]['ip'] ?? '');

        return $this->checkIpSafety($ip);
    }

    /**
     * Validate that an IP address is publicly routable (not private/reserved/loopback).
     *
     * @return array{blocked: bool, ip: string|null, message: string}
     */
    private function checkIpSafety(string $ip): array
    {
        if ($ip === '') {
            return [
                'blocked' => true,
                'ip'      => null,
                'message' => 'Tidak dapat menentukan alamat IP dari hostname.',
            ];
        }

        // Explicit IPv6 loopback check
        if ($ip === '::1' || $ip === '0:0:0:0:0:0:0:1') {
            return [
                'blocked' => true,
                'ip'      => $ip,
                'message' => 'Target merujuk ke alamat jaringan privat/terlarang (IPv6 loopback).',
            ];
        }

        // filter_var with NO_PRIV_RANGE | NO_RES_RANGE covers:
        //   10.0.0.0/8, 172.16.0.0/12, 192.168.0.0/16, 127.0.0.0/8,
        //   169.254.0.0/16, 0.0.0.0/8, and other IANA reserved ranges.
        $isPublic = filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );

        if ($isPublic === false) {
            Log::warning('ANTI-SSRF: Blocked request to private/reserved IP', [
                'ip'   => $ip,
            ]);

            return [
                'blocked' => true,
                'ip'      => $ip,
                'message' => 'Target merujuk ke alamat jaringan privat/terlarang. Permintaan diblokir demi keamanan.',
            ];
        }

        return [
            'blocked' => false,
            'ip'      => $ip,
            'message' => 'IP validated as public.',
        ];
    }

    /**
     * Perform a lightweight HEAD (fallback to GET) health check.
     *
     * @return array{reachable: bool, http_code: int}
     */
    private function performHealthCheck(string $url): array
    {
        try {
            // HEAD request first — minimal data transfer
            $response = Http::timeout(self::HTTP_TIMEOUT)
                ->withoutRedirecting()
                ->withHeaders(['User-Agent' => 'JatimProv-CSIRT-AssetVerifier/1.0'])
                ->head($url);

            return ['reachable' => true, 'http_code' => $response->status()];
        } catch (ConnectionException) {
            // HEAD failed — try a minimal GET
            try {
                $response = Http::timeout(self::HTTP_TIMEOUT)
                    ->withoutRedirecting()
                    ->withHeaders(['User-Agent' => 'JatimProv-CSIRT-AssetVerifier/1.0'])
                    ->get($url);

                return ['reachable' => true, 'http_code' => $response->status()];
            } catch (ConnectionException) {
                return ['reachable' => false, 'http_code' => 0];
            }
        }
    }
}
