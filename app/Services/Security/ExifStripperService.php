<?php

namespace App\Services\Security;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * ExifStripperService — UU PDP Privacy Metadata Sanitizer
 *
 * Removes all EXIF / IPTC / XMP metadata from hunter-submitted image files
 * before they are committed to the private `poc_files` disk.
 *
 * Why this matters (UU PDP No. 27/2022, ISO/IEC 27701):
 *   Camera EXIF blocks routinely embed GPS coordinates, device serial numbers,
 *   OS versions, and timestamps — all of which constitute personal data under
 *   Indonesian data-minimisation rules. Stripping them at ingestion time is the
 *   most reliable protection because it prevents inadvertent disclosure even if
 *   the file is later mis-handled downstream.
 *
 * Supported formats (EXIF-bearing):
 *   • JPEG / JPG  — via imagecreatefromjpeg() / imagejpeg()      (GD)
 *   • PNG         — via imagecreatefrompng() / imagepng()         (GD)
 *   • WebP        — via imagecreatefromwebp() / imagewebp()       (GD ≥ 8.1)
 *   • Any image   — via Imagick::stripImage()                     (Imagick)
 *
 * Fallback:
 *   If neither GD nor Imagick is available at runtime, the original file is
 *   kept unchanged and `is_exif_stripped` is set to false.  This is logged so
 *   operators can act (install php-gd / php-imagick) without breaking uploads.
 *
 * The GD technique works because GD decodes the pixel data and re-encodes the
 * image from scratch — all application-level metadata segments (APP1 EXIF,
 * APP13 IPTC, XMP) are simply never written back.  The pixel matrix is lossless
 * for PNG/WebP; JPEG uses the same quality setting that PHP defaults to (75),
 * which is acceptable for a PoC screenshot or screen-recording frame.
 */
class ExifStripperService
{
    /**
     * MIME types that contain strippable EXIF metadata.
     * Key → real MIME; Value → stripping method tag.
     *
     * @var array<string, string>
     */
    private const EXIF_BEARING_MIMES = [
        'image/jpeg' => 'jpeg',
        'image/jpg'  => 'jpeg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
    ];

    /**
     * Attempt to strip EXIF/IPTC/XMP metadata from an image file in-place.
     *
     * @param  string  $absolutePath  Full filesystem path to the stored image.
     * @param  string  $mimeType      Real MIME detected by magic-byte inspection.
     * @return bool                   True if stripping was performed; false otherwise.
     */
    public function strip(string $absolutePath, string $mimeType): bool
    {
        $type = self::EXIF_BEARING_MIMES[$mimeType] ?? null;

        // Skip non-image files (PDF, MP4, etc.) without complaint.
        if ($type === null) {
            return false;
        }

        // Prefer Imagick when available (handles all subtypes uniformly).
        if (extension_loaded('imagick') && class_exists(\Imagick::class)) {
            return $this->stripWithImagick($absolutePath);
        }

        // Fall back to GD.
        if (extension_loaded('gd')) {
            return $this->stripWithGd($absolutePath, $type);
        }

        // Neither extension available — log and skip gracefully.
        Log::warning('ExifStripperService: Neither GD nor Imagick is loaded. ' .
            'EXIF metadata NOT stripped from PoC file. Install php-gd or php-imagick.', [
                'path' => basename($absolutePath),
            ]);

        return false;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Private helpers
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Strip metadata using Imagick::stripImage().
     * Rewrites the file in the same format with all metadata segments removed.
     */
    private function stripWithImagick(string $absolutePath): bool
    {
        try {
            /** @var \Imagick $imagick */
            $imagick = new \Imagick($absolutePath);
            $imagick->stripImage();
            $imagick->writeImage($absolutePath);
            $imagick->destroy();

            return true;
        } catch (\ImagickException $e) {
            Log::error('ExifStripperService (Imagick): Failed to strip EXIF', [
                'path'  => basename($absolutePath),
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Strip metadata by round-tripping the image through GD.
     * GD's re-encode writes only pixel data — no metadata segments survive.
     *
     * @param  string  $absolutePath
     * @param  string  $type  One of 'jpeg', 'png', 'webp'
     */
    private function stripWithGd(string $absolutePath, string $type): bool
    {
        try {
            $image = match ($type) {
                'jpeg' => @imagecreatefromjpeg($absolutePath),
                'png'  => @imagecreatefrompng($absolutePath),
                'webp' => function_exists('imagecreatefromwebp')
                    ? @imagecreatefromwebp($absolutePath)
                    : false,
                default => false,
            };

            if ($image === false) {
                Log::warning('ExifStripperService (GD): imagecreatefrom*() returned false.', [
                    'path' => basename($absolutePath),
                    'type' => $type,
                ]);
                return false;
            }

            $success = match ($type) {
                'jpeg' => imagejpeg($image, $absolutePath, 85),
                'png'  => imagepng($image, $absolutePath),
                'webp' => function_exists('imagewebp')
                    ? imagewebp($image, $absolutePath)
                    : false,
                default => false,
            };

            imagedestroy($image);

            return $success !== false;
        } catch (\Throwable $e) {
            Log::error('ExifStripperService (GD): Unexpected error', [
                'path'  => basename($absolutePath),
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
