<?php

namespace App\Services;

use App\Models\Laporan;
use App\Models\LaporanActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * PocScannerService — Defense-in-Depth Layer: PoC Heuristic Scanner
 *
 * Implements a multi-pass heuristic pipeline that runs immediately after
 * FileUploadService::store() to classify the uploaded PoC file as:
 *
 *   'clean'       — passed all checks; safe to store and serve.
 *   'quarantined' — failed one or more checks; blocked from download.
 *
 * This service is the FOURTH defensive layer (after extension blocklist,
 * magic-byte MIME sniff, and UUID rename in FileUploadService):
 *
 *   Pass A — MIME re-verification  : independent second magic-byte check.
 *   Pass B — Polyglot/script scan  : scans first 8 KB for embedded scripts.
 *   Pass C — Entropy analysis      : high entropy may indicate encrypted payload.
 *
 * Design notes:
 *   - All checks operate on the stored file (post-UUID-rename) on the
 *     `poc_files` private disk — never on the original client file.
 *   - The scanner fails CLOSED: any I/O error → 'quarantined'.
 *   - Results are recorded to LaporanActivityLog for audit trail.
 */
class PocScannerService
{
    /**
     * Allowlist of real MIME types (same source of truth as FileUploadService).
     * Defining separately here ensures the scanner is independent.
     *
     * @var array<string>
     */
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
        'application/pdf',
        'video/mp4',
        'video/webm',
        'video/x-msvideo',
    ];

    /**
     * Patterns indicating embedded script/shell content.
     * Matched case-insensitively against raw file bytes.
     *
     * @var array<string>
     */
    private const SCRIPT_SIGNATURES = [
        '<?php',
        '<?=',
        '<script',
        'eval(',
        'exec(',
        'system(',
        'passthru(',
        'shell_exec(',
        'base64_decode(',
        "#!/",         // Unix shebang
        'MZi',         // PE executable magic (Windows)
        'PK',          // ZIP/OOXML (can contain macros)
    ];

    /**
     * Shannon entropy threshold above which a file is flagged.
     * A perfectly random/encrypted file has entropy ≈ 8.0.
     * Threshold 7.2 catches most encrypted payloads while avoiding false
     * positives on compressed images.
     */
    private const ENTROPY_THRESHOLD = 7.2;

    /**
     * Bytes to read for heuristic checks (8 KB is sufficient for headers).
     */
    private const SCAN_BYTES = 8192;

    // ── Public API ────────────────────────────────────────────────────────────

    /**
     * Run the full heuristic scan pipeline on a stored PoC file.
     *
     * Updates $laporan->scan_status in-place and records an audit log entry.
     *
     * @param  string       $storagePath  Filename relative to `poc_files` disk root
     * @param  Laporan      $laporan      The report being scanned
     * @param  User|null    $causer       The submitting hunter (for audit log)
     * @param  Request|null $request      HTTP context for audit log
     * @return string  Final scan_status: 'clean' or 'quarantined'
     */
    public function scan(
        string $storagePath,
        Laporan $laporan,
        ?User $causer = null,
        ?Request $request = null,
    ): string {
        $findings = [];
        $status   = 'clean';

        try {
            $fullPath = Storage::disk('poc_files')->path($storagePath);

            if (! file_exists($fullPath)) {
                $status     = 'quarantined';
                $findings[] = 'FILE_NOT_FOUND: stored file missing from disk';
            } else {
                $rawBytes = $this->readSampleBytes($fullPath);

                // Pass A — Independent MIME re-verification
                $mimeResult = $this->checkMime($fullPath);
                if ($mimeResult !== null) {
                    $findings[] = $mimeResult;
                    $status     = 'quarantined';
                }

                // Pass B — Embedded script / polyglot pattern scan
                $scriptResult = $this->checkScriptSignatures($rawBytes);
                if ($scriptResult !== null) {
                    $findings[] = $scriptResult;
                    $status     = 'quarantined';
                }

                // Pass C — Shannon entropy analysis
                $entropyResult = $this->checkEntropy($rawBytes);
                if ($entropyResult !== null) {
                    $findings[] = $entropyResult;
                    $status     = 'quarantined';
                }
            }
        } catch (\Throwable $e) {
            // Fail closed — scanner errors count as quarantine
            $status     = 'quarantined';
            $findings[] = 'SCAN_ERROR: ' . $e->getMessage();
            Log::error('PocScannerService exception', [
                'laporan_id' => $laporan->id,
                'error'      => $e->getMessage(),
            ]);
        }

        // Persist the scan result
        $laporan->update(['scan_status' => $status]);

        // Audit log
        LaporanActivityLog::record(
            laporan:  $laporan,
            causer:   $causer,
            action:   'POC_SCANNED',
            details:  [
                'result'   => $status,
                'file'     => $storagePath,
                'findings' => $findings,
            ],
            request:  $request,
        );

        if ($status === 'quarantined') {
            Log::warning('SECURITY — PoC file quarantined after heuristic scan', [
                'laporan_id' => $laporan->id,
                'file'       => $storagePath,
                'findings'   => $findings,
            ]);
        }

        return $status;
    }

    // ── Private scan passes ───────────────────────────────────────────────────

    /**
     * Pass A — Independent MIME type re-verification via finfo magic bytes.
     * Returns a finding string on failure, null on pass.
     */
    private function checkMime(string $fullPath): ?string
    {
        if (! extension_loaded('fileinfo')) {
            return 'MIME_CHECK_SKIPPED: fileinfo extension not available';
        }

        $finfo    = new \finfo(FILEINFO_MIME_TYPE);
        $realMime = $finfo->file($fullPath);

        if ($realMime === false || ! in_array($realMime, self::ALLOWED_MIME_TYPES, true)) {
            return "MIME_MISMATCH: detected '{$realMime}' is not in allowlist";
        }

        return null;
    }

    /**
     * Pass B — Scan raw bytes for embedded script/shell signatures.
     * Returns a finding string on failure, null on pass.
     */
    private function checkScriptSignatures(string $rawBytes): ?string
    {
        $lower = strtolower($rawBytes);

        foreach (self::SCRIPT_SIGNATURES as $sig) {
            if (str_contains($lower, strtolower($sig))) {
                return "SCRIPT_SIGNATURE: pattern '{$sig}' detected in file header";
            }
        }

        return null;
    }

    /**
     * Pass C — Shannon entropy analysis.
     * High entropy may indicate encrypted or compressed shellcode payloads.
     * Returns a finding string on failure, null on pass.
     */
    private function checkEntropy(string $rawBytes): ?string
    {
        $entropy = $this->shannonEntropy($rawBytes);

        if ($entropy > self::ENTROPY_THRESHOLD) {
            return sprintf(
                'HIGH_ENTROPY: %.4f bits/byte (threshold: %.1f) — possible encrypted payload',
                $entropy,
                self::ENTROPY_THRESHOLD,
            );
        }

        return null;
    }

    /**
     * Read the first SCAN_BYTES bytes of a file for heuristic analysis.
     */
    private function readSampleBytes(string $fullPath): string
    {
        $handle = fopen($fullPath, 'rb');
        if ($handle === false) {
            throw new \RuntimeException("Cannot open file for scanning: {$fullPath}");
        }

        $bytes = fread($handle, self::SCAN_BYTES);
        fclose($handle);

        return $bytes === false ? '' : $bytes;
    }

    /**
     * Calculate the Shannon entropy (bits per byte) of a byte string.
     * Formula: H = -Σ p(x) * log₂(p(x))
     */
    private function shannonEntropy(string $data): float
    {
        $length = strlen($data);
        if ($length === 0) {
            return 0.0;
        }

        $freq = array_count_values(str_split($data));
        $entropy = 0.0;

        foreach ($freq as $count) {
            $p        = $count / $length;
            $entropy -= $p * log($p, 2);
        }

        return $entropy;
    }

    // ── Forensic Analysis & Inspection API ────────────────────────────────────

    /**
     * Extract forensic details and safe sanitized raw preview of a PoC file.
     *
     * @param  Laporan  $laporan
     * @return array{
     *     exists: bool,
     *     filename: string,
     *     sha256: string,
     *     sha256_short: string,
     *     size_formatted: string,
     *     size_bytes: int,
     *     detected_mime: string,
     *     detection_reason: string,
     *     raw_payload: string,
     *     is_binary: bool
     * }
     */
    public function getForensics(Laporan $laporan): array
    {
        $storagePath = (string) $laporan->bukti_poc;
        $disk = Storage::disk('poc_files');

        if (! $disk->exists($storagePath)) {
            return [
                'exists'           => false,
                'filename'         => basename($storagePath),
                'sha256'           => 'N/A',
                'sha256_short'     => 'N/A',
                'size_formatted'   => '0 B',
                'size_bytes'       => 0,
                'detected_mime'    => 'unknown',
                'detection_reason' => 'File tidak ditemukan di storage aman.',
                'raw_payload'      => '[FILE_NOT_FOUND]',
                'is_binary'        => false,
            ];
        }

        $fullPath = $disk->path($storagePath);
        $sha256   = hash_file('sha256', $fullPath) ?: 'N/A';
        $shaShort = strlen($sha256) > 20 ? substr($sha256, 0, 10) . '...' . substr($sha256, -8) : $sha256;
        $sizeBytes = file_exists($fullPath) ? (filesize($fullPath) ?: 0) : 0;
        $sizeFormatted = $this->formatBytes($sizeBytes);

        $finfo = extension_loaded('fileinfo') ? new \finfo(FILEINFO_MIME_TYPE) : null;
        $detectedMime = $finfo ? ($finfo->file($fullPath) ?: 'application/octet-stream') : 'application/octet-stream';

        $detectionReason = $this->resolveDetectionReason($laporan, $fullPath);

        // Read sample for safe raw payload preview (up to 8KB)
        $handle = @fopen($fullPath, 'rb');
        $rawBytes = $handle ? (fread($handle, 8192) ?: '') : '';
        if ($handle) {
            fclose($handle);
        }

        $isBinary = str_contains($rawBytes, "\0");
        $rawPayload = $this->formatRawPayload($rawBytes);

        return [
            'exists'           => true,
            'filename'         => basename($storagePath),
            'sha256'           => $sha256,
            'sha256_short'     => $shaShort,
            'size_formatted'   => $sizeFormatted,
            'size_bytes'       => $sizeBytes,
            'detected_mime'    => $detectedMime,
            'detection_reason' => $detectionReason,
            'raw_payload'      => $rawPayload,
            'is_binary'        => $isBinary,
        ];
    }

    private function resolveDetectionReason(Laporan $laporan, string $fullPath): string
    {
        // 1. Check activity logs first
        $latestScanLog = $laporan->activityLogs()
            ->where('action', 'POC_SCANNED')
            ->latest('id')
            ->first();

        if ($latestScanLog && ! empty($latestScanLog->details['findings'])) {
            return implode('; ', (array) $latestScanLog->details['findings']);
        }

        // 2. If no log or empty findings, run a fast heuristic check
        if (file_exists($fullPath)) {
            $rawBytes = $this->readSampleBytes($fullPath);
            $findings = [];

            $mimeResult = $this->checkMime($fullPath);
            if ($mimeResult !== null) {
                $findings[] = $mimeResult;
            }

            $scriptResult = $this->checkScriptSignatures($rawBytes);
            if ($scriptResult !== null) {
                $findings[] = $scriptResult;
            }

            $entropyResult = $this->checkEntropy($rawBytes);
            if ($entropyResult !== null) {
                $findings[] = $entropyResult;
            }

            if (! empty($findings)) {
                return implode('; ', $findings);
            }
        }

        return $laporan->scan_status === 'quarantined'
            ? 'Magic-byte anomaly: embedded payload detected'
            : 'File terverifikasi aman oleh heuristic scanner';
    }

    private function formatRawPayload(string $bytes): string
    {
        if (empty($bytes)) {
            return '[EMPTY_FILE]';
        }

        $lines = [];
        $length = strlen($bytes);
        for ($i = 0; $i < $length; $i += 16) {
            $chunk = substr($bytes, $i, 16);
            $hexParts = [];
            $asciiParts = '';

            for ($j = 0; $j < strlen($chunk); $j++) {
                $hexParts[] = sprintf('%02x', ord($chunk[$j]));
                $asciiParts .= (ord($chunk[$j]) >= 32 && ord($chunk[$j]) <= 126) ? $chunk[$j] : '.';
            }

            $hexString = implode(' ', array_slice($hexParts, 0, 8));
            if (count($hexParts) > 8) {
                $hexString .= '  ' . implode(' ', array_slice($hexParts, 8));
            }

            $lines[] = sprintf('%08x  %-49s  |%s|', $i, $hexString, $asciiParts);
        }

        return implode("\n", $lines);
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' B';
    }
}
