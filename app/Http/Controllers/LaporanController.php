<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePocRequest;
use App\Models\Laporan;
use App\Services\FileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LaporanController extends Controller
{
    public function __construct(private readonly FileUploadService $uploader)
    {
    }

    /**
     * Store a new vulnerability report with its PoC file.
     */
    public function store(StorePocRequest $request): RedirectResponse
    {
        $storedFilename = $this->uploader->store($request->file('bukti_poc'));

        $laporan = $request->user()->laporans()->create([
            'target_url'       => $request->validated('target_url'),
            'jenis_kerentanan' => $request->validated('jenis_kerentanan'),
            'severity'         => $request->validated('severity'),
            'deskripsi'        => $request->validated('deskripsi'),
            'bukti_poc'        => $storedFilename,
            'status'           => 'Menunggu',
            'poin_diberikan'   => 0,
        ]);

        Log::info('AUDIT TRAIL — Laporan Kerentanan Baru Dikirim', [
            'laporan_id'  => $laporan->id,
            'user_id'     => $request->user()->id,
            'target_url'  => $request->validated('target_url'),
            'jenis'       => $request->validated('jenis_kerentanan'),
            'severity'    => $request->validated('severity'),
            'ip_address'  => $request->ip(),
            'user_agent'  => $request->userAgent(),
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
     * @param  Request  $request
     * @param  Laporan  $laporan  Resolved by route-model binding via UUID
     */
    public function download(Request $request, Laporan $laporan): StreamedResponse
    {
        Gate::authorize('downloadPoc', $laporan);

        Log::info('AUDIT TRAIL — PoC File Downloaded', [
            'laporan_id' => $laporan->id,
            'user_id'    => $request->user()?->id,
            'ip_address' => $request->ip(),
        ]);

        $downloadName = 'poc_' . $laporan->id . '_' . now()->format('Ymd');

        return $this->uploader->download($laporan->bukti_poc, $downloadName);
    }
}
