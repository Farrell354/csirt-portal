<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'target_url' => 'required|url',
            'jenis_kerentanan' => 'required|string',
            'severity' => 'required|string',
            'deskripsi' => 'required|string|min:10',
            'bukti_poc' => 'required|file|mimes:jpg,png,pdf,mp4|max:5120',
        ]);

        $path = $request->file('bukti_poc')->store('laporan_poc', 'local');

        auth()->user()->laporans()->create([
            'target_url' => $request->target_url,
            'jenis_kerentanan' => $request->jenis_kerentanan,
            'severity' => $request->severity,
            'deskripsi' => $request->deskripsi,
            'bukti_poc' => $path,
            'status' => 'Menunggu',
            'poin_diberikan' => 0,
        ]);

        Log::info('AUDIT TRAIL - Laporan Kerentanan Baru Dikirim', [
            'user_id' => auth()->id(),
            'target_url' => $request->target_url,
            'severity' => $request->severity,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect('/dashboard')->with('pesan', 'Laporan berhasil dikirim! Menunggu validasi tim CSIRT.');
    }

    public function download($filename)
    {
        if ($filename !== basename($filename)) {
            abort(400, 'Nama file tidak valid.');
        }

        $path = 'laporan_poc/'.$filename;

        if (! Storage::disk('local')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $laporan = Laporan::where('bukti_poc', $path)->firstOrFail();
        $user = auth()->user();

        if ($user->role !== 'admin' && $laporan->user_id !== $user->id) {
            abort(403, 'Akses ditolak.');
        }

        return Storage::disk('local')->response($path);
    }
}
