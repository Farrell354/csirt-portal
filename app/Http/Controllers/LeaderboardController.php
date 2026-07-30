<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Sesuaikan jika nama model Bos adalah 'Hunter'
use App\Models\Laporan; // Sesuaikan dengan nama model laporan bug-nya

class LeaderboardController extends Controller
{
    public function index()
    {
        // 1. Tarik Data Real dari Database
        $hunters = User::where('role', 'hunter') // Opsional: Pastikan cuma role 'hunter' yang masuk
            
            // Hitung jumlah laporan yang statusnya sudah di-'valid'-asi admin
            ->withCount(['laporans as valid_bugs' => function ($query) {
                $query->where('status', 'valid'); 
            }])
            
            // Jumlahkan total poin dari laporan yang valid
            ->withSum(['laporans as total_score' => function ($query) {
                $query->where('status', 'valid');
            }], 'poin') // 'poin' adalah nama kolom di tabel laporans (misal: 50, 30, 10)
            
            // Urutkan dari poin tertinggi
            ->orderByDesc('total_score')
            
            // Kalau ada poin yang sama, urutkan dari jumlah bug terbanyak
            ->orderByDesc('valid_bugs') 
            
            // Ambil Top 10 atau Top 20 saja biar halaman nggak berat
            ->take(20) 
            ->get();

        // 2. Injeksi Data Tambahan (Ranking & Avatar)
        $hunters->map(function ($hunter, $index) {
            // Berikan nomor urut Rank (1, 2, 3, dst)
            $hunter->rank = $index + 1;
            
            // Bikin avatar otomatis berbasis inisial nama jika user belum upload foto
            $hunter->avatar = $hunter->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($hunter->username) . '&background=random&color=fff&bold=true';
            
            // Tentukan Julukan / Pangkat (Gamification ala desain Bos)
            if ($hunter->rank == 1) $hunter->pangkat = 'GRAND MASTER';
            elseif ($hunter->rank == 2) $hunter->pangkat = 'SILVER GUARDIAN';
            elseif ($hunter->rank == 3) $hunter->pangkat = 'BRONZE STRIKER';
            elseif ($hunter->total_score >= 100) $hunter->pangkat = 'LVL 3 EXPERT';
            else $hunter->pangkat = 'LVL 1 ROOKIE';

            return $hunter;
        });
        

        // 3. Lempar ke tampilan
        return view('pages.leaderboard', compact('hunters'));
    }
}