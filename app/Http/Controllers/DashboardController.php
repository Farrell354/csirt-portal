<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $artikels = Artikel::orderBy('tanggal_publikasi', 'desc')->get();

            return view('dashboard', compact('artikels'));
        }

        $laporans = auth()->user()->laporans()->orderBy('created_at', 'desc')->get();

        return view('hunter-dashboard', compact('laporans'));
    }
}
