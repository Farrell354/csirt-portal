<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class HunterDashboardController extends Controller
{
    /**
     * Display a hunter's own vulnerability report details and sanitized timeline.
     * Enforces data privacy separation: only external ticket updates are visible.
     * Internal CSIRT audit logs (e.g. DISPOSITION_SENT, internal notes) are strictly omitted.
     *
     * Gate: LaporanPolicy::view() — owning hunter (or admin).
     *
     * @param  Laporan  $laporan  Resolved by route-model binding via UUID
     */
    public function show(Laporan $laporan): View
    {
        Gate::authorize('view', $laporan);

        // Load only external-facing activity logs for hunter visibility
        $laporan->load([
            'user',
            'certificate',
            'externalActivityLogs' => function ($query) {
                $query->with('causer')->latest('created_at');
            },
        ]);

        return view('hunter-laporan-detail', compact('laporan'));
    }
}
