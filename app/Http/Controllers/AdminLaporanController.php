<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin-laporan', compact('laporans'));
    }

    public function validasi(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['Menunggu', 'Pending', 'Diproses', 'Valid', 'Ditolak'])],
            'poin' => ['required', 'integer', 'min:0', 'max:1000'],
        ]);

        DB::transaction(function () use ($id, $validated) {
            $laporan = Laporan::lockForUpdate()->findOrFail($id);
            $oldStatus = $laporan->status;
            $oldPoin = $laporan->poin_diberikan;

            $laporan->update([
                'status' => $validated['status'],
                'poin_diberikan' => $validated['poin'],
            ]);

            $hunter = User::whereKey($laporan->user_id)->lockForUpdate()->firstOrFail();

            if ($oldStatus === 'Valid') {
                $hunter->poin -= $oldPoin;
            }

            if ($validated['status'] === 'Valid') {
                $hunter->poin += $validated['poin'];
            }

            $hunter->save();
        });

        return back()->with('pesan', 'Laporan berhasil divalidasi dan poin telah diupdate!');
    }

    public function cetak()
    {
        $laporans = Laporan::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin-laporan-cetak', compact('laporans'));
    }
}
