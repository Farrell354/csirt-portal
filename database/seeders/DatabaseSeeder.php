<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin (Untuk cek dan validasi laporan masuk)
        User::forceCreate([
            'name' => 'Administrator CSIRT',
            'username' => 'admin_csirt',
            'email' => 'admin@example.com',
            'password' => bcrypt('11223344'),
            'role' => 'admin',
        ]);

        // 2. Akun Hunter (Untuk ngetes kirim laporan bug nyata)
        User::forceCreate([
            'name' => 'Farel',
            'username' => 'farel_hunter',
            'email' => 'farel@hunter.com',
            'password' => bcrypt('11223344'),
            'role' => 'hunter',
        ]);
    }
}
