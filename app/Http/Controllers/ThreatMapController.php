<?php

namespace App\Http\Controllers;

class ThreatMapController extends Controller
{
    public function getThreatData()
    {
        // ========================================================================
        // LOGIKA SUPER DEWA: Membuat Backend Seolah-olah Menerima Serangan Real-time
        // ========================================================================

        // --- 1. GLOBE MAPS & TOTAL ATTACKS LOGIC (SAMA SEPERTI SEBELUMNYA) ---
        // Definisikan List Negara Sumber Serangan yang Populer (Coordinat Asli)
        $popularSources = [
            ['name' => 'China', 'lat' => 35.8616, 'lng' => 104.1953],
            ['name' => 'Russia', 'lat' => 61.5240, 'lng' => 105.3188],
            ['name' => 'USA', 'lat' => 37.0902, 'lng' => -95.7128],
            ['name' => 'India', 'lat' => 20.5936, 'lng' => 78.9628],
            ['name' => 'Singapore', 'lat' => 1.3520, 'lng' => 103.8198],
            ['name' => 'Germany', 'lat' => 51.1657, 'lng' => 10.4515],
            ['name' => 'Australia', 'lat' => -25.2744, 'lng' => 133.7751],
        ];

        // Acak Jumlah Serangan yang Mendarat (Ganti interval, misal 1-4 serangan sekaligus)
        $numRecentAttacks = rand(1, 4);
        $recent_attacks = [];

        for ($i = 0; $i < $numRecentAttacks; $i++) {
            // Pilih satu negara secara acak dari list populer
            $source = $popularSources[array_rand($popularSources)];

            // Pilih severity secara acak (high, medium, low)
            $severities = ['high', 'medium', 'low'];
            $severity = $severities[array_rand($severities)];

            // Tambahkan koordinat asal ke array serangan terbaru
            $recent_attacks[] = [
                'source_lat' => $source['lat'],
                'source_lng' => $source['lng'],
                'severity' => $severity,
            ];
        }

        // Update Angka Total Serangan Secara Dinamis (Simulasi naik terus)
        $baseCount = cache()->remember('live_threat_total_attacks', 60 * 24, function () {
            // Angka awal awal banget
            return 104001;
        });

        // Setiap dipanggil, angka total naik secara acak antara 1 sampai 25 serangan
        $newCount = $baseCount + rand(1, 25);
        cache()->put('live_threat_total_attacks', $newCount, 60 * 24);

        // --- 2. NEW LOGIC: GENERATE DYNAMIC RANKED LISTS DATA ---

        // 2a. Generate Ranked Attack Types Data
        $attackTypes = ['Reconnaissance', 'SQL Injection', 'Cross-Site Scripting (XSS)', 'Business Logic Error', 'Insecure Direct Object Ref.', 'Brute Force SSH', 'Malware Payload'];
        $top_attacks = [];
        foreach ($attackTypes as $attack) {
            // Score is a fraction of total attacks + slight random variance
            $score = floor($newCount * (rand(10, 50) / 1000));
            $top_attacks[] = ['name' => $attack, 'count' => $score];
        }
        // Sort by count descending
        usort($top_attacks, fn ($a, $b) => $b['count'] <=> $a['count']);
        // Take top 3
        $top_attacks = array_slice($top_attacks, 0, 3);

        // 2b. Generate Ranked Countries Data
        $countries = [
            ['name' => 'Indonesia', 'flag' => '🇮🇩'],
            ['name' => 'Singapore', 'flag' => '🇸🇬'],
            ['name' => 'USA', 'flag' => '🇺🇸'],
            ['name' => 'China', 'flag' => '🇨🇳'],
            ['name' => 'India', 'flag' => '🇮🇳'],
            ['name' => 'Germany', 'flag' => '🇩🇪'],
            ['name' => 'Russia', 'flag' => '🇷🇺'],
        ];
        $top_countries = [];
        foreach ($countries as $country) {
            $score = floor($newCount * (rand(100, 300) / 1000)); // countries usually have higher counts than attack types
            $top_countries[] = ['name' => $country['name'], 'flag' => $country['flag'], 'count' => $score];
        }
        usort($top_countries, fn ($a, $b) => $b['count'] <=> $a['count']);
        $top_countries = array_slice($top_countries, 0, 3);

        // 2c. Generate Ranked Top Attacker IPs Data
        $ips = ['180.243.2.151', '103.8.77.26', '172.232.238.140', '82.197.69.49', '165.22.221.124', '145.110.242.20'];
        $top_ips = [];
        foreach ($ips as $ip) {
            $score = floor($newCount * (rand(5, 20) / 1000));
            $top_ips[] = ['address' => $ip, 'count' => $score];
        }
        usort($top_ips, fn ($a, $b) => $b['count'] <=> $a['count']);
        $top_ips = array_slice($top_ips, 0, 3);

        // --- 3. FORMAT FINAL DATA STRUCTURE ---
        $data = [
            'total_attacks' => $newCount,
            'recent_attacks' => $recent_attacks,
            'top_attacks' => $top_attacks, // New data
            'top_countries' => $top_countries, // New data
            'top_ips' => $top_ips, // New data
        ];

        return response()->json($data);
    }
}
