<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminLaporanController extends Controller
{
    /**
     * Display all reports for admin review.
     * Gate: LaporanPolicy::viewAny() — admin only via before() hook.
     */
    public function index(): View
    {
        Gate::authorize('viewAny', Laporan::class);

        $laporans = Laporan::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin-laporan', compact('laporans'));
    }

    /**
     * Validate and score a vulnerability report.
     *
     * Gate: LaporanPolicy::update() — admin only via before() hook.
     *
     * @param  Request  $request
     * @param  Laporan  $laporan  Resolved by route-model binding via UUID
     */
    public function validasi(Request $request, Laporan $laporan): RedirectResponse
    {
        Gate::authorize('update', $laporan);

        $validated = $request->validate([
            'status' => ['required', Rule::in(['Menunggu', 'Valid', 'Ditolak'])],
            'poin'   => ['required', 'integer', 'min:0', 'max:1000'],
        ]);

        DB::transaction(function () use ($laporan, $validated, $request) {
            $laporan = Laporan::lockForUpdate()->findOrFail($laporan->id);

            $oldStatus = $laporan->status;
            $oldPoin   = (int) $laporan->poin_diberikan;

            $laporan->update([
                'status'         => $validated['status'],
                'poin_diberikan' => $validated['poin'],
            ]);

            $hunter = User::whereKey($laporan->user_id)->lockForUpdate()->firstOrFail();

            if ($oldStatus === 'Valid') {
                $hunter->poin -= $oldPoin;
            }

            if ($validated['status'] === 'Valid') {
                $hunter->poin += (int) $validated['poin'];
            }

            $hunter->save();

            Log::info('AUDIT TRAIL — Laporan Divalidasi', [
                'admin_id'   => $request->user()?->id,
                'laporan_id' => $laporan->id,
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
                'poin'       => $validated['poin'],
                'ip_address' => $request->ip(),
            ]);
        });

        return back()->with('pesan', 'Laporan berhasil divalidasi dan poin telah diupdate!');
    }

    /**
     * Print-friendly view of all reports.
     * Gate: LaporanPolicy::viewAny() — admin only via before() hook.
     */
    public function cetak(): View
    {
        Gate::authorize('viewAny', Laporan::class);

        $laporans = Laporan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin-laporan-cetak', compact('laporans'));
    }
}
