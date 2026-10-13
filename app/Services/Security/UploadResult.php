<?php

namespace App\Services\Security;

/**
 * UploadResult — value object returned by PocUploadService::store().
 *
 * Carries all post-processing metadata needed by the controller to
 * populate the `laporans` table in one atomic database write.
 */
final readonly class UploadResult
{
    public function __construct(
        /** Path relative to the `poc_files` disk root (e.g. "abc123.jpg"). */
        public readonly string  $storedFilename,

        /**
         * SHA-256 hex digest of the FINAL stored binary (post-EXIF-strip).
         * Null only if hash_file() failed (disk I/O error — should not occur).
         */
        public readonly ?string $pocHash,

        /**
         * True when EXIF/IPTC/XMP metadata was successfully removed from
         * this specific file.  False for non-image types or if GD/Imagick
         * is unavailable.
         */
        public readonly bool    $isExifStripped,
    ) {}
}
