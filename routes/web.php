<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Artikel;

// ==========================================
// RUTE PUBLIK (PENGUNJUNG WEB)
// ==========================================
Route::get('/', function () {
    $artikelTerkini = Artikel::orderBy('tanggal_publikasi', 'desc')->take(3)->get();
    return view('welcome', compact('artikelTerkini'));
});

Route::get('/profil', function () { return view('profil'); });
Route::get('/layanan', function () { return view('layanan'); });
Route::get('/panduan', function () { return view('panduan'); });
Route::get('/kontak', function () { return view('kontak'); });
Route::get('/rfc2350', function () { return view('rfc2350'); });

Route::get('/artikel', function () {
    $query = Artikel::orderBy('tanggal_publikasi', 'desc');

    if (request()->has('search') && request('search') != '') {
        $kata_kunci = request('search');
        $query->where('judul', 'LIKE', "%{$kata_kunci}%")
              ->orWhere('kategori', 'LIKE', "%{$kata_kunci}%");
    }

    $artikels = $query->paginate(6)->withQueryString();
    return view('artikel', compact('artikels'));
});

Route::get('/artikel/{id}', function ($id) {
    $artikel = Artikel::findOrFail($id);
    return view('artikel-detail', compact('artikel'));
});


// ==========================================
// RUTE ADMIN (LARAVEL BREEZE)
// ==========================================
Route::get('/dashboard', function () {
    $artikels = Artikel::orderBy('tanggal_publikasi', 'desc')->get();
    return view('dashboard', compact('artikels'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    // Rute untuk menampilkan halaman formulir tambah artikel
    Route::get('/dashboard/artikel/create', function () {
        return view('artikel-create');
    });

    // Rute untuk memproses dan menyimpan data artikel baru
    Route::post('/dashboard/artikel', function (Request $request) {
        Artikel::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'gambar' => $request->gambar,
            'penulis' => $request->penulis,
            'tanggal_publikasi' => now(),
            'konten' => $request->konten,
        ]);
        return redirect('/dashboard');
    });

    // Rute untuk menghapus artikel
    Route::delete('/dashboard/artikel/{id}', function ($id) {
        Artikel::destroy($id);
        return redirect('/dashboard');
    });

    // Rute untuk menampilkan formulir edit (mengambil data lama)
    Route::get('/dashboard/artikel/{id}/edit', function ($id) {
        $artikel = Artikel::findOrFail($id);
        return view('artikel-edit', compact('artikel'));
    });

    // Rute untuk menyimpan perubahan data ke database
    Route::put('/dashboard/artikel/{id}', function (Request $request, $id) {
        $artikel = Artikel::findOrFail($id);
        $artikel->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'gambar' => $request->gambar,
            'penulis' => $request->penulis,
            'konten' => $request->konten,
        ]);
        return redirect('/dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';