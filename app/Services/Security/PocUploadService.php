<?php

namespace App\Services\Security;

use App\Services\FileUploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * PocUploadService — Enhanced PoC Upload Pipeline
 *
 * Orchestrates the complete PoC attachment ingestion sequence on top of the
 * locked FileUploadService, adding two new post-storage passes:
 *
 *   Pass A — EXIF / Metadata Stripping (UU PDP No. 27/2022, ISO/IEC 27701)
 *             Delegates to ExifStripperService.  For JPEG/PNG/WebP, this
 *             removes GPS coordinates, device identifiers, and timestamps from
 *             the stored binary before anything else reads it.
 *
 *   Pass B — SHA-256 Integrity Hash (NIST SP 800-61 chain-of-custody)
 *             Reads the FINAL stored bytes (post-strip) and computes the
 *             canonical hash.  This fingerprints the exact evidence artifact
 *             that will be handed to the triage analyst.
 *
 * Returns a structured UploadResult that the controller persists to the DB.
 *
 * CODE BASE FREEZE compliance:
 *   FileUploadService is NEVER modified.  PocUploadService wraps it as a
 *   pure downstream consumer — all 3 existing passes (extension blocklist,
 *   magic-byte MIME sniff, UUID rename) run unchanged inside FileUploadService.
 */
class PocUploadService
{
    public function __construct(
        private readonly FileUploadService    $uploader,
        private readonly ExifStripperService  $stripper,
    ) {}

    /**
     * Run the full upload pipeline and return enriched metadata.
     *
     * @param  UploadedFile  $file
     * @return UploadResult
     *
     * @throws \Illuminate\Validation\ValidationException  If FileUploadService rejects the file.
     * @throws \RuntimeException                           If storage fails.
     */
    public function store(UploadedFile $file): UploadResult
    {
        // ── Pass 1-3: Existing locked pipeline (extension block, magic-byte, UUID rename) ──
        $storedFilename = $this->uploader->store($file);

        // Resolve the absolute filesystem path so we can operate on it directly.
        $disk     = Storage::disk('poc_files');
        $fullPath = $disk->path($storedFilename);

        // ── Pass A: Detect real MIME from stored file (used by stripper) ─────────────
        $realMime = $this->detectMime($fullPath);

        // ── Pass A: EXIF / metadata stripping ────────────────────────────────────────
        $isExifStripped = $this->stripper->strip($fullPath, $realMime);

        // ── Pass B: SHA-256 fingerprint of the FINAL stored binary ───────────────────
        $pocHash = hash_file('sha256', $fullPath) ?: null;

        return new UploadResult(
            storedFilename: $storedFilename,
            pocHash:        $pocHash,
            isExifStripped: $isExifStripped,
        );
    }

    // ─────────────────────────────────────────────────────────────────────────

    private function detectMime(string $absolutePath): string
    {
        if (! extension_loaded('fileinfo') || ! file_exists($absolutePath)) {
            return 'application/octet-stream';
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime  = $finfo->file($absolutePath);

        return ($mime !== false && $mime !== '') ? $mime : 'application/octet-stream';
    }
}
