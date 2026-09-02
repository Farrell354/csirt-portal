<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * FileUploadService — Defense in Depth: Application Layer
 *
 * Implements a hardened three-pass file validation pipeline before
 * storing any Proof-of-Concept (PoC) upload:
 *
 *   Pass 1 – Extension blocklist  : rejects outright any file whose
 *             extension matches a known dangerous type, regardless of
 *             what the client claims the MIME type is.
 *
 *   Pass 2 – Magic-byte MIME sniff: reads the actual file header bytes
 *             via PHP's finfo extension. This catches MIME-spoofed files
 *             (e.g. a PHP script renamed to .jpg by an attacker). The
 *             detected real MIME must be in the strict allowlist.
 *
 *   Pass 3 – UUID rename          : the original filename is discarded.
 *             Files are stored as "{uuid}.{safe_extension}" to prevent
 *             path traversal, logical ID guessing, and directory listing.
 *
 * Storage target: the dedicated `poc_files` private disk (serve: false),
 * which is rooted outside of the public/ directory.
 */
class FileUploadService
{
    /**
     * Hard blocklist of extensions that MUST NEVER be stored,
     * even if the MIME type appears benign.
     *
     * This list covers direct execution vectors on common web stacks.
     */
    private const BLOCKED_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'php8',
        'phtml', 'phar', 'phps',
        'sh', 'bash', 'zsh', 'fish',
        'py', 'rb', 'pl', 'lua',
        'exe', 'bat', 'cmd', 'com', 'msi', 'msp',
        'vbs', 'vbe', 'js', 'jse', 'wsf', 'wsh',
        'ps1', 'psm1', 'psd1',
        'html', 'htm', 'shtml', 'xhtml',
        'svg', 'xml', 'xsl', 'xslt',
        'htaccess', 'htpasswd',
        'jar', 'war', 'class',
    ];

    /**
     * Allowlist of MIME types that are acceptable for PoC uploads.
     * Detected by actual magic-byte inspection, NOT the client header.
     *
     * Key   → real MIME type from finfo
     * Value → safe canonical extension to use when storing the file
     */
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg'      => 'jpg',
        'image/png'       => 'png',
        'image/gif'       => 'gif',
        'image/webp'      => 'webp',
        'application/pdf' => 'pdf',
        'video/mp4'       => 'mp4',
        'video/webm'      => 'webm',
        'video/x-msvideo' => 'avi',
    ];

    /**
     * Maximum file size in bytes (default: 10 MB).
     */
    private const MAX_SIZE_BYTES = 10 * 1024 * 1024;

    /**
     * Validate and store a PoC upload file.
     *
     * @param  UploadedFile  $file  The uploaded file from the request.
     * @param  string        $field The form field name (used in validation messages).
     * @return string              The storage path relative to the `poc_files` disk root.
     *
     * @throws ValidationException  If any validation pass fails.
     * @throws \RuntimeException    If the storage operation itself fails.
     */
    public function store(UploadedFile $file, string $field = 'bukti_poc'): string
    {
        $this->validateSize($file, $field);
        $this->validateExtension($file, $field);
        $realMime = $this->detectRealMime($file, $field);
        $safeExtension = $this->validateMimeAndGetExtension($realMime, $field);

        return $this->persist($file, $safeExtension);
    }

    /**
     * Serve a stored PoC file as a streamed download response.
     * Always streams as an attachment (forces browser download, never inline render).
     *
     * @param  string  $storagePath  Path returned by store(), relative to poc_files disk.
     * @param  string  $downloadName Suggested filename for the browser download prompt.
     */
    public function download(string $storagePath, string $downloadName = 'bukti_poc'): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        if (! Storage::disk('poc_files')->exists($storagePath)) {
            abort(404, 'File bukti tidak ditemukan.');
        }

        // Content-Disposition: attachment prevents browsers from rendering
        // potentially dangerous content (e.g. PDFs with embedded JS) inline.
        return Storage::disk('poc_files')->download($storagePath, $downloadName, [
            'Content-Type'        => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="'.$downloadName.'"',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    /**
     * Delete a previously stored PoC file.
     */
    public function delete(string $storagePath): void
    {
        Storage::disk('poc_files')->delete($storagePath);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Private validation passes
    // ─────────────────────────────────────────────────────────────────────────

    private function validateSize(UploadedFile $file, string $field): void
    {
        if ($file->getSize() > self::MAX_SIZE_BYTES) {
            $maxMb = self::MAX_SIZE_BYTES / (1024 * 1024);
            throw ValidationException::withMessages([
                $field => "File terlalu besar. Maksimum {$maxMb} MB.",
            ]);
        }
    }

    /**
     * Pass 1 — Extension blocklist.
     *
     * Extracts the extension from the client-supplied filename (which we do
     * NOT trust for storage — this is purely for early rejection of obvious
     * attack vectors before spending resources on finfo MIME detection).
     */
    private function validateExtension(UploadedFile $file, string $field): void
    {
        // Use getClientOriginalExtension() for the blocklist check only.
        // This value comes from the client and is untrusted — we use it
        // offensively (to catch obvious attacks) not defensively.
        $clientExt = strtolower(trim($file->getClientOriginalExtension()));

        if (in_array($clientExt, self::BLOCKED_EXTENSIONS, true)) {
            throw ValidationException::withMessages([
                $field => 'Tipe file tidak diizinkan. Hanya gambar dan PDF yang diterima.',
            ]);
        }

        // Double-check: scan the full original filename for embedded
        // dangerous extensions (e.g. "shell.php.jpg" attack).
        $originalName = $file->getClientOriginalName();
        $parts        = explode('.', $originalName);

        // Walk all parts of the filename (skip the first which is the basename).
        array_shift($parts);
        foreach ($parts as $part) {
            if (in_array(strtolower(trim($part)), self::BLOCKED_EXTENSIONS, true)) {
                throw ValidationException::withMessages([
                    $field => 'Nama file mengandung ekstensi berbahaya.',
                ]);
            }
        }
    }

    /**
     * Pass 2 — Magic-byte MIME sniffing.
     *
     * Opens the actual file bytes using PHP's finfo extension, which reads
     * the file header (magic bytes) to determine the real MIME type.
     * This is unaffected by the client-supplied Content-Type header or
     * the filename extension.
     */
    private function detectRealMime(UploadedFile $file, string $field): string
    {
        if (! extension_loaded('fileinfo')) {
            // finfo is required. If it's somehow missing, fail closed.
            throw new \RuntimeException(
                'PHP fileinfo extension is not loaded. Cannot perform MIME validation.'
            );
        }

        $finfo    = new \finfo(FILEINFO_MIME_TYPE);
        $realMime = $finfo->file($file->getRealPath());

        if ($realMime === false || empty($realMime)) {
            throw ValidationException::withMessages([
                $field => 'Tidak dapat memverifikasi tipe file. Upload ditolak.',
            ]);
        }

        return $realMime;
    }

    /**
     * Pass 3a — MIME allowlist check.
     *
     * Compares the real MIME (from magic bytes) against the strict allowlist.
     * Returns the canonical safe extension to use for storage.
     */
    private function validateMimeAndGetExtension(string $realMime, string $field): string
    {
        $safeExtension = self::ALLOWED_MIME_TYPES[$realMime] ?? null;

        if ($safeExtension === null) {
            throw ValidationException::withMessages([
                $field => 'Tipe file tidak diizinkan: '.$realMime.'. Hanya gambar (JPG, PNG, GIF, WebP) dan PDF yang diterima.',
            ]);
        }

        return $safeExtension;
    }

    /**
     * Pass 3b — UUID-renamed storage.
     *
     * The original filename is NEVER used as the storage name.
     * Files are stored as a random UUID v4 + safe canonical extension.
     * This prevents:
     *   - Path traversal  (../../../etc/passwd)
     *   - Logical ID guessing  (poc_1.pdf, poc_2.pdf …)
     *   - Directory listing exploitation
     */
    private function persist(UploadedFile $file, string $safeExtension): string
    {
        $uuid     = Str::uuid()->toString();
        $filename = $uuid . '.' . $safeExtension;

        // storeAs() on `poc_files` disk → storage/app/private/poc_files/{uuid}.{ext}
        $path = Storage::disk('poc_files')->putFileAs('', $file, $filename);

        if ($path === false) {
            throw new \RuntimeException('Gagal menyimpan file PoC ke penyimpanan aman.');
        }

        return $filename; // Return just the filename (relative to disk root)
    }
}
