<?php

use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HunterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ThreatMapController;
use Illuminate\Support\Facades\Route;

// ==========================================
// RUTE PUBLIK UTAMA
// ==========================================
Route::get('/', [BerandaController::class, 'index']);
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{id}', [ArtikelController::class, 'show']);
Route::get('/api/threat-data', [ThreatMapController::class, 'getThreatData']);

// Rute Tampilan Statis (Route::view lebih efisien dibanding closure)
Route::view('/profil', 'profil');
Route::view('/layanan', 'layanan');
Route::get('/layanan/{slug}', fn ($slug) => view('layanan-detail', compact('slug')));
Route::view('/panduan/lihat', 'panduan-viewer');
Route::view('/ioc/detail', 'ioc-detail');
Route::view('/pembelajaran-insiden', 'pembelajaran-insiden');
Route::view('/ioc/semua', 'ioc-all');
Route::view('/ioc', 'ioc');
Route::view('/ioc/lihat', 'panduan-viewer');

// ==========================================
// LEADERBOARD & CHATBOT
// ==========================================
Route::get('/leaderboard', [LeaderboardController::class, 'index']);
Route::get('/hunter/{id}', [HunterController::class, 'show']);
Route::post('/chatbot-reply', [ChatbotController::class, 'reply'])->middleware('throttle:10,1');

// ==========================================
// RUTE OTENTIKASI (Breeze)
// ==========================================
require __DIR__.'/auth.php';

// ==========================================
// RUTE KHUSUS PENGGUNA LOGIN (Dashboard)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Utama (Admin & Hunter)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil Pengguna & Pengaturan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/settings', [SettingsController::class, 'edit']);
    Route::put('/settings', [SettingsController::class, 'update']);

    // Unduh bukti PoC (pemilik laporan atau admin — cek di controller)
    Route::get('/laporan/file/{filename}', [LaporanController::class, 'download']);

    // ==========================================
    // BUG BOUNTY & LAPORAN (Khusus Hunter)
    // ==========================================
    Route::middleware('role:hunter')->group(function () {
        Route::view('/dashboard/lapor', 'hunter-lapor');
        Route::post('/dashboard/lapor', [LaporanController::class, 'store'])->middleware('throttle:3,60');
    });

    // ==========================================
    // MANAJEMEN ARTIKEL (Khusus Admin CMS)
    // ==========================================
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard/artikel/create', [ArtikelController::class, 'create']);
        Route::post('/dashboard/artikel', [ArtikelController::class, 'store']);
        Route::get('/dashboard/artikel/{id}/edit', [ArtikelController::class, 'edit']);
        Route::put('/dashboard/artikel/{id}', [ArtikelController::class, 'update']);
        Route::delete('/dashboard/artikel/{id}', [ArtikelController::class, 'destroy']);

        // ADMIN KHUSUS LAPORAN
        Route::get('/admin/laporan', [AdminLaporanController::class, 'index']);
        Route::post('/admin/laporan/{id}/validasi', [AdminLaporanController::class, 'validasi']);
        Route::get('/admin/laporan/cetak', [AdminLaporanController::class, 'cetak']);
    });

});
