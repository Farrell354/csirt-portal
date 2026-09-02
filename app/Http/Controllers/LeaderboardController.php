<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\View\View;

class LeaderboardController extends Controller
{
    public function index(): View
    {
        $hunters = User::where('role', 'hunter')
            ->where('poin', '>', 0)
            ->withCount(['laporans as valid_laporans_count' => fn ($q) => $q->where('status', 'Valid')])
            ->orderBy('poin', 'desc')
            ->get();

        $top3              = $hunters->take(3);
        $lainnya           = $hunters->skip(3);
        $totalHunter       = User::where('role', 'hunter')->count();
        $totalLaporanValid = Laporan::where('status', 'Valid')->count();

        return view('leaderboard', compact('top3', 'lainnya', 'totalHunter', 'totalLaporanValid'));
    }
}
