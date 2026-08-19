<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreatMapController;
use App\KnowledgeBase;
use App\Models\Artikel;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// ==========================================
// RUTE PUBLIK (PENGUNJUNG WEB)
// ==========================================

Route::get('/profil', function () {
    return view('profil');
});
Route::get('/layanan/{slug}', function ($slug) {
    return view('layanan-detail', compact('slug'));
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
        $artikels = Artikel::orderBy('tanggal_publikasi', 'desc')->get();

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
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('artikel-create');
    });

    // Rute untuk memproses dan menyimpan data artikel baru
    Route::post('/dashboard/artikel', function (Request $request) {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
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
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        Artikel::destroy($id);

        return redirect('/dashboard');
    });

    // Rute untuk menampilkan formulir edit (mengambil data lama)
    Route::get('/dashboard/artikel/{id}/edit', function ($id) {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $artikel = Artikel::findOrFail($id);

        return view('artikel-edit', compact('artikel'));
    });

    // Rute untuk menyimpan perubahan data ke database
    Route::put('/dashboard/artikel/{id}', function (Request $request, $id) {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
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
    if (auth()->user()->role !== 'hunter') {
        abort(403, 'Hanya Hunter yang diizinkan melapor.');
    }

    return view('hunter-lapor');
})->middleware(['auth', 'verified']);

// Jalur untuk memproses dan menyimpan data Laporan ke Database
Route::post('/dashboard/lapor', function (Request $request) {
    if (auth()->user()->role !== 'hunter') {
        abort(403);
    }

    // 1. Validasi inputan agar tidak ada data yang kosong/salah format
    $request->validate([
        'target_url' => 'required|url',
        'jenis_kerentanan' => 'required|string',
        'severity' => 'required|string',
        'deskripsi' => 'required|string|min:10',
        'bukti_poc' => 'required|file|mimes:jpg,png,pdf,mp4|max:5120',
    ]);

    // Simpan file ke storage/app/private/laporan_poc
    $path = $request->file('bukti_poc')->store('laporan_poc', 'local');

    // 2. Simpan ke tabel laporans menggunakan relasi user yang sedang login
    auth()->user()->laporans()->create([
        'target_url' => $request->target_url,
        'jenis_kerentanan' => $request->jenis_kerentanan,
        'severity' => $request->severity,
        'deskripsi' => $request->deskripsi,
        'bukti_poc' => $path,
        'status' => 'Menunggu',
        'poin_diberikan' => 0,
    ]);

    // 3. Kembalikan ke halaman dashboard dengan pesan sukses
    // 4. Audit Trail (Log aktivitas sensitif)
    Log::info('AUDIT TRAIL - Laporan Kerentanan Baru Dikirim', [
        'user_id' => auth()->id(),
        'target_url' => $request->target_url,
        'severity' => $request->severity,
        'ip_address' => $request->ip(),
        'user_agent' => $request->userAgent(),
    ]);

    return redirect('/dashboard')->with('pesan', 'Laporan berhasil dikirim! Menunggu validasi tim CSIRT.');
})->middleware(['auth', 'verified', 'throttle:3,60']);

// Jalur untuk mengunduh/melihat bukti PoC yang aman (Anti-IDOR)
Route::get('/laporan/file/{filename}', function ($filename) {
    $path = 'laporan_poc/'.$filename;

    if (! Storage::disk('local')->exists($path)) {
        abort(404, 'File tidak ditemukan.');
    }

    $laporan = Laporan::where('bukti_poc', $path)->firstOrFail();

    // Cek IDOR: Hanya admin atau hunter pemilik laporan yang bisa akses
    $user = auth()->user();
    if ($user->role !== 'admin' && $laporan->user_id !== $user->id) {
        abort(403, 'Akses ditolak.');
    }

    return Storage::disk('local')->response($path);
})->middleware(['auth']);

// ==========================================
// RUTE KHUSUS ADMIN (MANAJEMEN LAPORAN HUNTER)
// ==========================================

// 1. Halaman Daftar Laporan
Route::get('/admin/laporan', function () {
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    // Tarik semua laporan dari database beserta data pengirimnya (Hunter)
    $laporans = Laporan::with('user')->orderBy('created_at', 'desc')->get();

    return view('admin-laporan', compact('laporans'));
})->middleware(['auth', 'verified']);

// 2. Proses Validasi & Transfer Poin
Route::post('/admin/laporan/{id}/validasi', function (Request $request, $id) {
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $laporan = Laporan::findOrFail($id);

    $oldStatus = $laporan->status;
    $oldPoin = $laporan->poin_diberikan;

    // Update status laporan dan poin yang diberikan
    $laporan->update([
        'status' => $request->status,
        'poin_diberikan' => $request->poin,
    ]);

    $hunter = $laporan->user;

    if ($oldStatus === 'Valid') {
        $hunter->poin -= $oldPoin;
    }

    if ($request->status === 'Valid') {
        $hunter->poin += $request->poin;
    }

    $hunter->save();

    return back()->with('pesan', 'Laporan berhasil divalidasi dan poin telah diupdate!');
})->middleware(['auth', 'verified']);

// ==========================================
// RUTE HALL OF FAME / LEADERBOARD (PUBLIK)
// ==========================================
Route::get('/leaderboard', function () {
    // 1. Ambil semua hunter yang punya poin (poin > 0), urutkan dari yang terbesar
    $hunters = User::where('role', 'hunter')
        ->where('poin', '>', 0)
        ->orderBy('poin', 'desc')
        ->get();

    // 2. Pisahkan Top 3 (Podium) dan sisanya (List biasa)
    $top3 = $hunters->take(3);
    $lainnya = $hunters->skip(3);

    // 3. Hitung statistik untuk dipamerkan di header
    $totalHunter = User::where('role', 'hunter')->count();
    $totalLaporanValid = Laporan::where('status', 'Valid')->count();

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
            'Authorization' => 'Bearer '.env('GROQ_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'openai/gpt-oss-20b',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "Anda adalah Asisten AI resmi JatimProv-CSIRT. Jawablah pertanyaan user HANYA berdasarkan DATA BERIKUT:\n\n".$panduanCSIRT."\n\nATURAN PENTING:\n1. Basa-basi/Sapaan: Jika pengguna hanya menyapa (contoh: hi, halo, p, assalamualaikum, pagi), JANGAN ditolak. Balaslah sapaannya dengan ramah dan tawarkan bantuan terkait layanan CSIRT.\n2. Typo: Pengguna mungkin salah ketik. Tebak maksudnya sebelum menjawab.\n3. Luar Topik: HANYA tolak dan arahkan ke menu Kontak jika pertanyaan benar-benar melenceng jauh dari keamanan siber dan BUKAN sebuah sapaan.",
                ],
                [
                    'role' => 'user',
                    'content' => $pesanUser,
                ],
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

    } catch (Exception $e) {
        return response()->json(['reply' => 'Waduh, koneksi ke AI terputus.']);
    }
});
// Rute untuk Cetak Rekap Laporan CSIRT (Admin)
Route::get('/admin/laporan/cetak', function () {
    if (! auth()->check() || auth()->user()->role !== 'admin') {
        abort(403);
    }
    // Ambil semua laporan beserta data usernya
    $laporans = Laporan::with('user')->orderBy('created_at', 'desc')->get();

    return view('admin-laporan-cetak', compact('laporans'));
})->middleware(['auth', 'verified']);
// Rute Pengaturan Profil
Route::get('/settings', function () {
    return view('settings');
})->middleware(['auth']);

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
})->middleware(['auth']);

Route::get('/panduan/lihat', function () {
    return view('panduan-viewer');
});
// Halaman Daftar IoC
Route::get('/ioc/detail', function () {
    return view('ioc-detail');
});
Route::get('/pembelajaran-insiden', function () {
    return view('pembelajaran-insiden');
});
Route::get('/ioc/semua', function () {
    return view('ioc-all');
});
Route::get('/ioc', function () {
    return view('ioc');
});

// Halaman Viewer IoC (Bisa numpang pakai file panduan-viewer yang sudah ada)
Route::get('/ioc/lihat', function () {
    return view('panduan-viewer');
});
Route::get('/', [BerandaController::class, 'index']);
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/api/threat-data', [ThreatMapController::class, 'getThreatData']);
require __DIR__.'/auth.php';

// Rute untuk melihat Profil Publik Hunter dari Leaderboard
Route::get('/hunter/{id}', function ($id) {
    // Cari data user berdasarkan ID yang diklik
    $hunter = User::where('role', 'hunter')->findOrFail($id);

    // Hitung statistik khusus hunter ini
    $laporanValid = $hunter->laporans()->where('status', 'Valid')->count();
    $totalLaporan = $hunter->laporans()->count();
    $validitas = $totalLaporan > 0 ? round(($laporanValid / $totalLaporan) * 100, 1) : 0;

    return view('hunter-public-profil', compact('hunter', 'laporanValid', 'validitas'));
});
