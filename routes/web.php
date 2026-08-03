<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Http;
use App\KnowledgeBase;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BerandaController;

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
    // Jika yang login adalah ADMIN
    if (auth()->user()->role === 'admin') {
        $artikels = App\Models\Artikel::orderBy('tanggal_publikasi', 'desc')->get();
        return view('dashboard', compact('artikels'));
    } 
    
    // Jika yang login adalah HUNTER (Masyarakat)
    else {
        // Ambil data laporan khusus milik hunter ini saja
        $laporans = auth()->user()->laporans()->orderBy('created_at', 'desc')->get();
        return view('hunter-dashboard', compact('laporans'));
    }
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

// Jalur untuk menampilkan Halaman Form Pelaporan
Route::get('/dashboard/lapor', function () {
    // Pastikan hanya hunter yang bisa mengakses halaman ini
    if (auth()->user()->role !== 'hunter') abort(403, 'Hanya Hunter yang diizinkan melapor.');
    return view('hunter-lapor');
})->middleware(['auth', 'verified']);

// Jalur untuk memproses dan menyimpan data Laporan ke Database
Route::post('/dashboard/lapor', function (Request $request) {
    if (auth()->user()->role !== 'hunter') abort(403);

    // 1. Validasi inputan agar tidak ada data yang kosong/salah format
    $request->validate([
        'target_url' => 'required|url',
        'jenis_kerentanan' => 'required|string',
        'deskripsi' => 'required|string|min:10',
        'bukti_poc' => 'required|string',
    ]);

    // 2. Simpan ke tabel laporans menggunakan relasi user yang sedang login
    auth()->user()->laporans()->create([
        'target_url' => $request->target_url,
        'jenis_kerentanan' => $request->jenis_kerentanan,
        'deskripsi' => $request->deskripsi,
        'bukti_poc' => $request->bukti_poc,
        'status' => 'Menunggu',
        'poin_diberikan' => 0
    ]);

    // 3. Kembalikan ke halaman dashboard dengan pesan sukses
    return redirect('/dashboard')->with('pesan', 'Laporan berhasil dikirim! Menunggu validasi tim CSIRT.');
})->middleware(['auth', 'verified']);

// ==========================================
// RUTE KHUSUS ADMIN (MANAJEMEN LAPORAN HUNTER)
// ==========================================

// 1. Halaman Daftar Laporan
Route::get('/admin/laporan', function () {
    if (auth()->user()->role !== 'admin') abort(403);
    
    // Tarik semua laporan dari database beserta data pengirimnya (Hunter)
    $laporans = App\Models\Laporan::with('user')->orderBy('created_at', 'desc')->get();
    return view('admin-laporan', compact('laporans'));
})->middleware(['auth', 'verified']);

// 2. Proses Validasi & Transfer Poin
Route::post('/admin/laporan/{id}/validasi', function (Request $request, $id) {
    if (auth()->user()->role !== 'admin') abort(403);

    $laporan = App\Models\Laporan::findOrFail($id);
    
    // Update status laporan dan poin yang diberikan
    $laporan->update([
        'status' => $request->status,
        'poin_diberikan' => $request->poin
    ]);

    // Jika admin menekan tombol "Valid", transfer poin ke akun Hunter
    if ($request->status === 'Valid') {
        $hunter = $laporan->user;
        $hunter->poin += $request->poin;
        $hunter->save();
    }

    return back()->with('pesan', 'Laporan berhasil divalidasi dan poin telah diupdate!');
})->middleware(['auth', 'verified']);

// ==========================================
// RUTE HALL OF FAME / LEADERBOARD (PUBLIK)
// ==========================================
Route::get('/leaderboard', function () {
    // 1. Ambil semua hunter yang punya poin (poin > 0), urutkan dari yang terbesar
    $hunters = App\Models\User::where('role', 'hunter')
                    ->where('poin', '>', 0)
                    ->orderBy('poin', 'desc')
                    ->get();
    
    // 2. Pisahkan Top 3 (Podium) dan sisanya (List biasa)
    $top3 = $hunters->take(3);
    $lainnya = $hunters->skip(3);
    
    // 3. Hitung statistik untuk dipamerkan di header
    $totalHunter = App\Models\User::where('role', 'hunter')->count();
    $totalLaporanValid = App\Models\Laporan::where('status', 'Valid')->count();

    // 4. Lempar datanya ke tampilan front-end
    return view('leaderboard', compact('top3', 'lainnya', 'totalHunter', 'totalLaporanValid'));
});

// ==========================================
// RUTE API CHATBOT (OTAK AI - GROQ DENGAN BASIS PENGETAHUAN)
// ==========================================
Route::post('/chatbot-reply', function (Request $request) {
    $pesanUser = $request->input('message');

    // Cukup panggil fungsi getInfo() di sini!
    $panduanCSIRT = KnowledgeBase::getInfo();

    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama-3.1-8b-instant', 
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "Anda adalah Asisten AI resmi JatimProv-CSIRT. Jawablah pertanyaan user HANYA berdasarkan DATA BERIKUT:\n\n" . $panduanCSIRT . "\n\nATURAN PENTING:\n1. Basa-basi/Sapaan: Jika pengguna hanya menyapa (contoh: hi, halo, p, assalamualaikum, pagi), JANGAN ditolak. Balaslah sapaannya dengan ramah dan tawarkan bantuan terkait layanan CSIRT.\n2. Typo: Pengguna mungkin salah ketik. Tebak maksudnya sebelum menjawab.\n3. Luar Topik: HANYA tolak dan arahkan ke menu Kontak jika pertanyaan benar-benar melenceng jauh dari keamanan siber dan BUKAN sebuah sapaan."
                ],
                [
                    'role' => 'user',
                    'content' => $pesanUser
                ]
            ],
            // Naikkan sedikit suhunya (misal ke 0.4) agar AI lebih fleksibel mencerna typo, 
            // tapi tidak terlalu tinggi agar tidak mengarang jawaban.
            'temperature' => 0.4, 
        ]);

        if ($response->successful()) {
            $balasanAI = $response->json()['choices'][0]['message']['content'];
            return response()->json(['reply' => $balasanAI]);
        }

        return response()->json(['reply' => 'Maaf, server AI sedang sibuk. Silakan coba beberapa saat lagi.']);

    } catch (\Exception $e) {
        return response()->json(['reply' => 'Waduh, koneksi ke AI terputus.']);
    }
});
// Rute untuk Cetak Rekap Laporan CSIRT (Admin)
Route::get('/admin/laporan/cetak', function () {
    // Ambil semua laporan beserta data usernya
    $laporans = App\Models\Laporan::with('user')->orderBy('created_at', 'desc')->get();
    return view('admin-laporan-cetak', compact('laporans'));
});
// Rute Pengaturan Profil
Route::get('/settings', function () {
    return view('settings');
});

Route::put('/settings', function (Request $request) {
    $user = auth()->user();

    // Validasi inputan
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,'.$user->id,
        'password' => 'nullable|min:8|confirmed', // Harus ada konfirmasi password jika diisi
    ]);

    // Update Nama dan Email
    $user->name = $request->name;
    $user->email = $request->email;

    // Update Password HANYA jika form password diisi
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('sukses', 'Profil berhasil diperbarui!');
});

Route::get('/panduan/lihat', function () {
    return view('panduan-viewer');
});
// Halaman Daftar IoC
Route::get('/ioc', function () {
    return view('ioc');
});

// Halaman Viewer IoC (Bisa numpang pakai file panduan-viewer yang sudah ada)
Route::get('/ioc/lihat', function () {
    return view('panduan-viewer');
});
Route::get('/', [BerandaController::class, 'index']);
require __DIR__.'/auth.php';

// Rute untuk melihat Profil Publik Hunter dari Leaderboard
Route::get('/hunter/{id}', function ($id) {
    // Cari data user berdasarkan ID yang diklik
    $hunter = App\Models\User::where('role', 'hunter')->findOrFail($id);
    
    // Hitung statistik khusus hunter ini
    $laporanValid = $hunter->laporans()->where('status', 'Valid')->count();
    $totalLaporan = $hunter->laporans()->count();
    $validitas = $totalLaporan > 0 ? round(($laporanValid / $totalLaporan) * 100, 1) : 0;

    return view('hunter-public-profil', compact('hunter', 'laporanValid', 'validitas'));
});
