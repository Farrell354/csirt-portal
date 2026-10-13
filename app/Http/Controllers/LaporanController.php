<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePocRequest;
use App\Models\Laporan;
use App\Models\LaporanActivityLog;
use App\Services\PocScannerService;
use App\Services\Security\PocUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LaporanController extends Controller
{
    public function __construct(
        private readonly PocScannerService $scanner,
        private readonly PocUploadService  $pocUploader,
    ) {}

    /**
     * Store a new vulnerability report with its PoC file.
     *
     * Pipeline:
     *   1. StorePocRequest validates all input (inc. anon fields).
     *   2. FileUploadService::store() — 3-pass file validation + UUID rename.
     *   3. Laporan record created with all fields including is_anonymous/pseudonym.
     *   4. PocScannerService::scan() — heuristic 3-pass scan (sets scan_status).
     *   5. LaporanActivityLog::record() — audit trail entry.
     */
    public function store(StorePocRequest $request): RedirectResponse
    {
        // ── Enhanced pipeline: EXIF strip + SHA-256 hash wraps the locked FileUploadService ──
        $upload = $this->pocUploader->store($request->file('bukti_poc'));

        /** @var \App\Models\User $user */
        $user = $request->user();

        $laporan = $user->laporans()->create([
            'target_url'       => $request->validated('target_url'),
            'jenis_kerentanan' => $request->validated('jenis_kerentanan'),
            'severity'         => $request->validated('severity'),
            'deskripsi'        => $request->validated('deskripsi'),
            'bukti_poc'        => $upload->storedFilename,
            'poc_hash'         => $upload->pocHash,
            'is_exif_stripped' => $upload->isExifStripped,
            'scan_status'      => 'pending',
            'status'           => 'Menunggu',
            'poin_diberikan'   => 0,
            'is_anonymous'     => (bool) $request->validated('is_anonymous'),
            'pseudonym'        => $request->validated('pseudonym'),
        ]);

        // Enhancement 4 — Run PoC heuristic scan immediately after upload
        $this->scanner->scan($upload->storedFilename, $laporan, $user, $request);

        // Enhancement 2 — Audit trail: report submitted (inc. SHA-256 fingerprint)
        LaporanActivityLog::record(
            laporan: $laporan,
            causer:  $user,
            action:  'REPORT_SUBMITTED',
            details: [
                'target_url'       => $request->validated('target_url'),
                'jenis_kerentanan' => $request->validated('jenis_kerentanan'),
                'severity'         => $request->validated('severity'),
                'is_anonymous'     => (bool) $request->validated('is_anonymous'),
                'poc_sha256'       => $upload->pocHash,
                'exif_stripped'    => $upload->isExifStripped,
            ],
            request: $request,
        );

        Log::info('AUDIT TRAIL — Laporan Kerentanan Baru Dikirim', [
            'laporan_id'    => $laporan->id,
            'user_id'       => $user->id,
            'target_url'    => $request->validated('target_url'),
            'jenis'         => $request->validated('jenis_kerentanan'),
            'severity'      => $request->validated('severity'),
            'scan_status'   => $laporan->fresh()?->scan_status,
            'poc_sha256'    => $upload->pocHash,
            'exif_stripped' => $upload->isExifStripped,
            'ip_address'    => $request->ip(),
            'user_agent'    => $request->userAgent(),
        ]);

        return redirect('/dashboard')
            ->with('pesan', 'Laporan berhasil dikirim! Menunggu validasi tim CSIRT.');
    }

    /**
     * Stream a PoC file to an authorised user.
     *
     * Route-model binding resolves {laporan} by UUID.
     * Gate::authorize('downloadPoc', $laporan) → LaporanPolicy.
     *
     * Strict quarantine check: if scan_status is 'quarantined', direct download
     * is blocked with 403 Forbidden.
     * Security headers: Content-Disposition attachment, nosniff, no-store cache.
     *
     * @param  Request  $request
     * @param  Laporan  $laporan  Resolved by route-model binding via UUID
     */
    public function download(Request $request, Laporan $laporan): StreamedResponse
    {
        Gate::authorize('downloadPoc', $laporan);

        // Strict quarantine gate (Defense in Depth)
        if ($laporan->scan_status === 'quarantined') {
            abort(403, 'Berkas dalam status karantina. Gunakan fitur inspeksi aman / override terlebih dahulu');
        }

        if ($laporan->scan_status === 'pending') {
            abort(403, 'File sedang menunggu pemindaian keamanan. Silakan coba beberapa saat lagi.');
        }

        if (! Storage::disk('poc_files')->exists($laporan->bukti_poc)) {
            abort(404, 'File bukti PoC tidak ditemukan di penyimpanan privat.');
        }

        $extension = pathinfo($laporan->bukti_poc, PATHINFO_EXTENSION);
        $safeFilename = 'poc_' . preg_replace('/[^a-zA-Z0-9_-]/', '', (string) $laporan->id) . ($extension ? '.' . $extension : '');

        // Audit trail: PoC downloaded
        LaporanActivityLog::record(
            laporan: $laporan,
            causer:  $request->user(),
            action:  'POC_DOWNLOADED',
            details: [
                'file'     => $laporan->bukti_poc,
                'filename' => $safeFilename,
            ],
            request: $request,
        );

        Log::info('AUDIT TRAIL — PoC File Downloaded', [
            'laporan_id' => $laporan->id,
            'user_id'    => $request->user()?->id,
            'filename'   => $safeFilename,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return Storage::disk('poc_files')->download($laporan->bukti_poc, $safeFilename, [
            'Content-Type'             => 'application/octet-stream',
            'Content-Disposition'      => 'attachment; filename="' . $safeFilename . '"',
            'X-Content-Type-Options'   => 'nosniff',
            'Cache-Control'            => 'no-store, no-cache, must-revalidate, private',
        ]);
    }
}
