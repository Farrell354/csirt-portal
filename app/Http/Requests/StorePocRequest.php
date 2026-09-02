<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * StorePocRequest — Defense in Depth: Application Layer
 *
 * Typed FormRequest that enforces strict, server-side input validation
 * for vulnerability report submissions. This is the single source of
 * truth for what constitutes a valid laporan payload.
 *
 * Security notes:
 *   - `jenis_kerentanan` is validated against a strict allowlist enum
 *     to prevent injection of arbitrary strings into the database.
 *   - `severity` is validated against the CVSS severity levels only.
 *   - `target_url` blocks private/loopback IP ranges and localhost to
 *     prevent SSRF-adjacent report abuse.
 *   - `bukti_poc` is validated here only by size/extension (first pass).
 *     The definitive magic-byte MIME check happens inside FileUploadService.
 */
class StorePocRequest extends FormRequest
{
    /**
     * Allowed vulnerability categories.
     * This strict enum prevents arbitrary string injection and
     * makes reporting analytics reliable.
     */
    private const ALLOWED_VULNERABILITY_TYPES = [
        'SQL Injection',
        'Cross-Site Scripting (XSS)',
        'Cross-Site Request Forgery (CSRF)',
        'Broken Authentication',
        'Broken Access Control',
        'Sensitive Data Exposure',
        'Security Misconfiguration',
        'Insecure Deserialization',
        'Using Components with Known Vulnerabilities',
        'Insufficient Logging & Monitoring',
        'Server-Side Request Forgery (SSRF)',
        'XML External Entity (XXE)',
        'Insecure Direct Object Reference (IDOR)',
        'Remote Code Execution (RCE)',
        'Local File Inclusion (LFI)',
        'Remote File Inclusion (RFI)',
        'Open Redirect',
        'Business Logic Vulnerability',
        'Lainnya',
    ];

    /**
     * Ensure only authenticated hunters may submit reports.
     */
    public function authorize(): bool
    {
        return $this->user() !== null
            && $this->user()->role === 'hunter';
    }

    /**
     * Validation rules.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // URL must be a valid, publicly reachable URL.
            // active_url checks DNS — prevents most localhost/internal SSRF abuse.
            'target_url' => [
                'required',
                'string',
                'max:2048',
                'url:http,https',
                'active_url',
                function (string $attribute, mixed $value, \Closure $fail) {
                    $this->blockPrivateUrls($value, $fail);
                },
            ],

            // Strict enum — no arbitrary strings accepted.
            'jenis_kerentanan' => [
                'required',
                'string',
                Rule::in(self::ALLOWED_VULNERABILITY_TYPES),
            ],

            // CVSS-aligned severity levels only.
            'severity' => [
                'required',
                'string',
                Rule::in(['Informational', 'Low', 'Medium', 'High', 'Critical']),
            ],

            // Description must be meaningful (min 20 chars, max 10k).
            'deskripsi' => [
                'required',
                'string',
                'min:20',
                'max:10000',
            ],

            // First-pass file validation (size + broad extension check).
            // Second-pass magic-byte MIME sniffing happens in FileUploadService.
            'bukti_poc' => [
                'required',
                'file',
                'max:10240', // 10 MB in KB
                // mimes: here is an intentional first filter only.
                // Do NOT remove FileUploadService MIME sniff — this alone is insufficient.
                'mimes:jpg,jpeg,png,gif,webp,pdf,mp4,webm,avi',
            ],
        ];
    }

    /**
     * Custom human-readable attribute names for error messages.
     */
    public function attributes(): array
    {
        return [
            'target_url'        => 'URL Target',
            'jenis_kerentanan'  => 'Jenis Kerentanan',
            'severity'          => 'Tingkat Keparahan',
            'deskripsi'         => 'Deskripsi',
            'bukti_poc'         => 'Bukti PoC',
        ];
    }

    /**
     * Custom validation error messages.
     */
    public function messages(): array
    {
        return [
            'target_url.active_url'        => 'URL target tidak dapat dijangkau atau tidak valid.',
            'jenis_kerentanan.in'          => 'Jenis kerentanan tidak valid. Pilih dari daftar yang tersedia.',
            'severity.in'                  => 'Tingkat keparahan tidak valid.',
            'bukti_poc.mimes'              => 'Hanya file JPG, PNG, GIF, WebP, PDF, MP4, WebM, atau AVI yang diizinkan.',
            'bukti_poc.max'                => 'Ukuran file PoC maksimum adalah 10 MB.',
        ];
    }

    /**
     * Block common private/loopback ranges to prevent SSRF-adjacent abuse.
     * Hunters should only be targeting external, public-facing systems.
     */
    private function blockPrivateUrls(string $url, \Closure $fail): void
    {
        $host = parse_url($url, PHP_URL_HOST);
        if ($host === false || $host === null) {
            $fail('URL target tidak valid.');
            return;
        }

        $blockedPatterns = [
            '/^localhost$/i',
            '/^127\.\d+\.\d+\.\d+$/',
            '/^10\.\d+\.\d+\.\d+$/',
            '/^172\.(1[6-9]|2\d|3[01])\.\d+\.\d+$/',
            '/^192\.168\.\d+\.\d+$/',
            '/^::1$/',
            '/^0\.0\.0\.0$/',
            '/^169\.254\.\d+\.\d+$/', // Link-local
        ];

        foreach ($blockedPatterns as $pattern) {
            if (preg_match($pattern, $host)) {
                $fail('URL target tidak boleh mengarah ke jaringan internal atau lokal.');
                return;
            }
        }
    }
}
