<?php

namespace App\Http\Controllers;

use App\Models\User;

class HunterController extends Controller
{
    public function show($id)
    {
        $hunter = User::where('role', 'hunter')->findOrFail($id);

        $laporanValid = $hunter->laporans()->where('status', 'Valid')->count();
        $totalLaporan = $hunter->laporans()->count();
        $validitas = $totalLaporan > 0 ? round(($laporanValid / $totalLaporan) * 100, 1) : 0;

        return view('hunter-public-profil', compact('hunter', 'laporanValid', 'validitas'));
    }
}
