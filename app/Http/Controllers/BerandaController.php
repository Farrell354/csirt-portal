<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        // 1. Ambil 3 data artikel terbaru dari tabel 'artikels'
        $artikelTerkini = Artikel::query()
            ->latest('tanggal_publikasi')
            ->take(3)
            ->get();

        // 2. Ambil data Top 5 Kerentanan dari laporan yang berstatus Valid
        $topKerentanan = Laporan::query()
            ->select('jenis_kerentanan as nama_kerentanan', DB::raw('count(*) as jumlah'))
            ->where('status', 'Valid')
            ->groupBy('jenis_kerentanan')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        // 3. Lempar data ke view
        return view('welcome', compact('artikelTerkini', 'topKerentanan'));
    }
}
