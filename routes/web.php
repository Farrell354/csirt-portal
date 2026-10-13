<?php

use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\PublicCertificateVerificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HunterController;
use App\Http\Controllers\HunterDashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TargetVerificationController;
use App\Http\Controllers\ThreatMapController;
use App\Models\Laporan;
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
Route::view('/kontak', 'kontak');
Route::view('/panduan', 'panduan');
Route::view('/rfc2350', 'rfc2350');
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

// Verifikasi Publik Sertifikat Penghargaan (UU PDP Compliant)
Route::get('/verify-certificate/{uuid}', [PublicCertificateVerificationController::class, 'show'])->name('certificate.verify');

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

    // Unduh bukti PoC (pemilik laporan atau admin — otorisasi via LaporanPolicy)
    Route::get('/laporan/{laporan}/poc', [LaporanController::class, 'download'])->name('laporan.download');
    Route::get('/laporan/file/{laporan}', [LaporanController::class, 'download']);

    // Unduh Sertifikat Penghargaan (pemilik laporan atau admin — otorisasi via CertificatePolicy)
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');

    // ==========================================
    // BUG BOUNTY & LAPORAN (Khusus Hunter)
    // ==========================================
    Route::middleware('role:hunter')->group(function () {
        Route::view('/dashboard/lapor', 'hunter-lapor');
        Route::post('/dashboard/lapor', [LaporanController::class, 'store'])->middleware('throttle:3,60');
        Route::get('/dashboard/laporan/{laporan}', [HunterDashboardController::class, 'show'])->name('hunter.laporan.show');

        // Anti-SSRF: Live asset & scope verifier (throttled to prevent port scanning)
        Route::post('/api/verify-target', [TargetVerificationController::class, 'verify'])
            ->middleware('throttle:15,1')
            ->name('api.verify-target');
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
        Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
        // /cetak must be declared BEFORE the {laporan} wildcard so it is not captured
        Route::get('/admin/laporan/cetak', [AdminLaporanController::class, 'cetak'])->name('admin.laporan.cetak');
        // Single-report review page — UUID in URL via HasUuids PK (Anti-IDOR compliance)
        Route::get('/admin/laporan/{laporan}', [AdminLaporanController::class, 'show'])->name('admin.laporan.show');
        Route::get('/admin/laporan/{laporan}/cetak', [AdminLaporanController::class, 'cetakAdvisory'])->name('admin.laporan.advisory.cetak');
        Route::get('/admin/laporan/{laporan}/validasi', fn (Laporan $laporan) => redirect()->route('admin.laporan.show', $laporan));
        Route::post('/admin/laporan/{laporan}/validasi', [AdminLaporanController::class, 'validasi'])->name('admin.laporan.validasi');
        Route::post('/admin/laporan/{laporan}/cvss', [AdminLaporanController::class, 'saveCvss'])->name('admin.laporan.cvss');
        Route::post('/admin/laporan/{laporan}/override-quarantine', [AdminLaporanController::class, 'overrideQuarantine'])->name('admin.laporan.override-quarantine');
        // OPD Disposition (Enhancement 5)
        Route::post('/admin/laporan/{laporan}/disposition', [AdminLaporanController::class, 'disposition'])->name('admin.laporan.disposition');
        // Penerbitan Sertifikat Penghargaan (VDP Certificate)
        Route::post('/admin/laporan/{laporan}/certificate', [CertificateController::class, 'issue'])->name('admin.laporan.certificate.issue');

        // REAL-TIME SYSTEM METRICS API
        Route::get('/api/system-metrics', [DashboardController::class, 'systemMetrics'])->name('admin.system.metrics');
    });

});
