<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class HunterController extends Controller
{
    public function show(int|string $id): View
    {
        $hunter = User::where('role', 'hunter')->findOrFail($id);

        $validLaporans = $hunter->laporans()->where('status', 'Valid')->orderBy('created_at', 'desc')->get();
        $laporanValid = $validLaporans->count();
        $totalLaporan = $hunter->laporans()->count();
        $validitas = $totalLaporan > 0 ? round(($laporanValid / $totalLaporan) * 100, 1) : 0;

        return view('hunter-public-profil', compact('hunter', 'validLaporans', 'laporanValid', 'validitas'));
    }
}
