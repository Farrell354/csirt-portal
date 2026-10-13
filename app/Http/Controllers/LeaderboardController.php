<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\View\View;

class LeaderboardController extends Controller
{
    public function index(): View
    {
        // Only hunters who have non-anonymous validated reports contribute to the leaderboard.
        // Anonymous reports are excluded to prevent score-delta deanonymization attacks:
        // a visible reputation jump would correlate directly with an anonymous submission.
        $hunters = User::where('role', 'hunter')
            ->where('poin', '>', 0)
            ->withCount(['laporans as valid_laporans_count' => fn ($q) => $q
                ->where('status', 'Valid')
                ->where('is_anonymous', false)])
            ->orderBy('poin', 'desc')
            ->get();

        $top3              = $hunters->take(3);
        $lainnya           = $hunters->skip(3);
        $totalHunter       = User::where('role', 'hunter')->count();
        // Exclude anonymous reports from the public "total valid reports" counter.
        $totalLaporanValid = Laporan::where('status', 'Valid')
            ->where('is_anonymous', false)
            ->count();

        return view('leaderboard', compact('top3', 'lainnya', 'totalHunter', 'totalLaporanValid'));
    }
}
