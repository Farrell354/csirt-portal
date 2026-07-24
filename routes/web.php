<?php

use Illuminate\Support\Facades\Route;
use App\Models\Artikel;

Route::get('/', function () {
    // Mengambil 3 artikel terbaru saja untuk halaman depan
    $artikelTerkini = App\Models\Artikel::orderBy('tanggal_publikasi', 'desc')->take(6)->get();
    
    return view('welcome', compact('artikelTerkini'));
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/layanan', function () {
    return view('layanan');
});

Route::get('/panduan', function () {
    return view('panduan');
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/rfc2350', function () {
    return view('rfc2350');
});

// ROUTE ARTIKEL (Cukup satu saja, sudah lengkap dengan fitur pencarian)
Route::get('/artikel', function () {
    $query = Artikel::orderBy('tanggal_publikasi', 'desc');

    // Menggunakan helper request() bawaan Laravel agar kebal error
    if (request()->has('search') && request('search') != '') {
        $kata_kunci = request('search');
        $query->where('judul', 'LIKE', "%{$kata_kunci}%")
              ->orWhere('kategori', 'LIKE', "%{$kata_kunci}%");
    }

    // withQueryString() berguna agar halaman 2, 3, dst tetap mengingat kata kunci pencarian
    $artikels = $query->paginate(6)->withQueryString();
    
    return view('artikel', compact('artikels'));
});

// ROUTE DETAIL ARTIKEL
Route::get('/artikel/{id}', function ($id) {
    // Mencari artikel berdasarkan ID, jika tidak ada akan otomatis muncul halaman 404
    $artikel = App\Models\Artikel::findOrFail($id);
    
    return view('artikel-detail', compact('artikel'));
});