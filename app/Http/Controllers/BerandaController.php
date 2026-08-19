<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        // 1. Ambil 3 data artikel terbaru dari tabel 'artikels'
        $artikelTerkini = DB::table('artikels')
            ->latest('tanggal_publikasi')
            ->take(3)
            ->get();

        // 2. Ambil data Top 5 Kerentanan dari tabel 'laporans'
        $topKerentanan = DB::table('laporans')
            ->select('jenis_kerentanan as nama_kerentanan', DB::raw('count(*) as jumlah'))
            ->where('status', 'Valid') // Hanya hitung yang statusnya 'Valid' sesuai database
            ->groupBy('jenis_kerentanan')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        // 3. Lempar data ke view (Ganti 'welcome' jika nama file blade beranda Bos berbeda)
        return view('welcome', compact('artikelTerkini', 'topKerentanan'));
    }
}
