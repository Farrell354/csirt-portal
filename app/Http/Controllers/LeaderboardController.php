<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        $hunters = User::where('role', 'hunter')
            ->where('poin', '>', 0)
            ->orderBy('poin', 'desc')
            ->get();

        $top3 = $hunters->take(3);
        $lainnya = $hunters->skip(3);
        $totalHunter = User::where('role', 'hunter')->count();
        $totalLaporanValid = Laporan::where('status', 'Valid')->count();

        return view('leaderboard', compact('top3', 'lainnya', 'totalHunter', 'totalLaporanValid'));
    }
}
