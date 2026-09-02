<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $artikels = Artikel::orderBy('tanggal_publikasi', 'desc')->get();

            return view('dashboard', compact('artikels'));
        }

        $laporans        = $user->laporans()->orderBy('created_at', 'desc')->get();
        $totalLaporan    = $laporans->count();
        $laporanDiproses = $laporans->whereIn('status', ['Pending', 'Diproses', 'Menunggu'])->count();
        $laporanValid    = $laporans->where('status', 'Valid')->count();
        $totalPoin       = $user->poin ?? 0;

        return view('hunter-dashboard', compact('laporans', 'totalLaporan', 'laporanDiproses', 'laporanValid', 'totalPoin'));
    }
}
