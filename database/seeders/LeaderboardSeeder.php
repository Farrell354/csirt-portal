<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Laporan;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class LeaderboardSeeder extends Seeder
{
    public function run(): void
    {
        // Gunakan Faker versi Indonesia
        $faker = Faker::create('id_ID');

        // Kita buat 10 Hunter Dummy
        for ($i = 1; $i <= 10; $i++) {
            // 1. Buat Akun Hunter dengan poin acak antara 50 sampai 5000
            $hunter = User::create([
                'name' => $faker->userName . '_' . $faker->numberBetween(1, 99),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'), // Password default
                'role' => 'hunter',
                'poin' => $faker->numberBetween(50, 5000),
            ]);

            // 2. Buat riwayat laporan valid secara acak untuk setiap Hunter (1 sampai 15 laporan)
            $jumlahLaporan = $faker->numberBetween(1, 15);
            
            for ($j = 0; $j < $jumlahLaporan; $j++) {
                Laporan::create([
                    'user_id' => $hunter->id,
                    'target_url' => 'https://' . $faker->word . '.jatimprov.go.id',
                    'jenis_kerentanan' => $faker->randomElement(['SQL Injection', 'Cross-Site Scripting (XSS)', 'RCE', 'IDOR']),
                    'deskripsi' => 'Ditemukan celah ' . $faker->word . ' pada parameter id di halaman utama.',
                    'bukti_poc' => 'https://imgur.com/dummy' . $faker->numberBetween(100, 999) . '.png',
                    'status' => 'Valid',
                    'poin_diberikan' => $faker->numberBetween(10, 200),
                ]);
            }
        }
    }
}