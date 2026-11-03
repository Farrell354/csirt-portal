<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ThreatMapController extends Controller
{
    public function getThreatData(): JsonResponse
    {
        // ========================================================================
        // DATA SIMULASI TELEMETRI ANCAMAN SIBER (DEMO KOMDIGI-STYLE LIVE MAP)
        // ========================================================================

        /** @var array<int, array{name: string, flag: string, lat: float, lng: float, weight: int}> $sources */
        $sources = [
            ['name' => 'China',       'flag' => '🇨🇳', 'lat' => 35.8617,  'lng' => 104.1954, 'weight' => 26],
            ['name' => 'USA',         'flag' => '🇺🇸', 'lat' => 37.0902,  'lng' => -95.7129, 'weight' => 21],
            ['name' => 'Russia',      'flag' => '🇷🇺', 'lat' => 61.5240,  'lng' => 105.3188, 'weight' => 18],
            ['name' => 'Indonesia',   'flag' => '🇮🇩', 'lat' => -6.2088,  'lng' => 106.8456, 'weight' => 14],
            ['name' => 'Singapore',   'flag' => '🇸🇬', 'lat' => 1.3521,   'lng' => 103.8198, 'weight' => 9],
            ['name' => 'India',       'flag' => '🇮🇳', 'lat' => 20.5937,  'lng' => 78.9629,  'weight' => 7],
            ['name' => 'Germany',     'flag' => '🇩🇪', 'lat' => 51.1657,  'lng' => 10.4515,  'weight' => 5],
            ['name' => 'Netherlands', 'flag' => '🇳🇱', 'lat' => 52.1326,  'lng' => 5.2913,   'weight' => 4],
            ['name' => 'Brazil',      'flag' => '🇧🇷', 'lat' => -14.2350, 'lng' => -51.9253, 'weight' => 3],
        ];

        /** @var array<int, array{name: string, severity: string, protocol: string, share: float}> $attackCatalog */
        $attackCatalog = [
            ['name' => 'SQL Injection (SQLi)',       'severity' => 'CRITICAL', 'protocol' => 'HTTPS/443', 'share' => 0.31],
            ['name' => 'Authentication Attack',      'severity' => 'HIGH',     'protocol' => 'HTTPS/443', 'share' => 0.24],
            ['name' => 'Cross-Site Scripting (XSS)', 'severity' => 'HIGH',     'protocol' => 'HTTPS/443', 'share' => 0.19],
            ['name' => 'Reconnaissance / Port Scan', 'severity' => 'MEDIUM',   'protocol' => 'TCP/Multi', 'share' => 0.15],
            ['name' => 'Brute Force SSH',            'severity' => 'HIGH',     'protocol' => 'SSH/22',    'share' => 0.11],
        ];

        /** @var array<int, string> $targetHosts */
        $targetHosts = [
            'sso.jatimprov.go.id',
            'api.jatimprov.go.id',
            'portal.jatimprov.go.id',
            'diskominfo.jatimprov.go.id',
            'ppid.jatimprov.go.id',
            'simpeg.jatimprov.go.id',
        ];

        /** @var array<int, array{address: string, flag: string, country: string}> $attackerIps */
        $attackerIps = [
            ['address' => '180.243.2.151',   'flag' => '🇨🇳', 'country' => 'China'],
            ['address' => '82.197.69.49',    'flag' => '🇷🇺', 'country' => 'Russia'],
            ['address' => '172.232.238.140', 'flag' => '🇺🇸', 'country' => 'USA'],
            ['address' => '103.8.77.26',     'flag' => '🇮🇩', 'country' => 'Indonesia'],
            ['address' => '165.22.221.124',  'flag' => '🇸🇬', 'country' => 'Singapore'],
            ['address' => '145.110.242.20',  'flag' => '🇩🇪', 'country' => 'Germany'],
        ];

        $baseCount = (int) Cache::remember('live_threat_total_attacks', 60 * 24, static function (): int {
            return 148290;
        });

        $newCount = $baseCount + random_int(4, 28);
        Cache::put('live_threat_total_attacks', $newCount, 60 * 24);

        // --- 1. GENERATE RECENT LIVE ATTACK EVENTS ---
        $numRecentAttacks = random_int(4, 6);
        /** @var array<int, array<string, mixed>> $recentAttacks */
        $recentAttacks = [];

        for ($i = 0; $i < $numRecentAttacks; $i++) {
            $source = $sources[array_rand($sources)];
            $attack = $attackCatalog[array_rand($attackCatalog)];
            $ipEntry = $attackerIps[array_rand($attackerIps)];
            $target = $targetHosts[array_rand($targetHosts)];

            $recentAttacks[] = [
                'timestamp'      => now()->subSeconds(($numRecentAttacks - $i) * 2)->format('H:i:s'),
                'source_country' => $source['name'],
                'source_flag'    => $source['flag'],
                'source_lat'     => $source['lat'] + (random_int(-25, 25) / 10.0),
                'source_lng'     => $source['lng'] + (random_int(-25, 25) / 10.0),
                'target_lat'     => -7.2504 + (random_int(-4, 4) / 10.0),
                'target_lng'     => 112.7688 + (random_int(-4, 4) / 10.0),
                'target_host'    => $target,
                'source_ip'      => $ipEntry['address'],
                'attack_type'    => $attack['name'],
                'protocol'       => $attack['protocol'],
                'severity'       => $attack['severity'],
                'action'         => 'MITIGATED',
            ];
        }

        // --- 2. RANKED ATTACK TYPES (Komdigi-CSIRT Style with Percentages) ---
        /** @var array<int, array{name: string, count: int, percentage: int, severity: string}> $topAttacks */
        $topAttacks = [];
        foreach ($attackCatalog as $item) {
            $jitter = random_int(-15, 15) / 1000.0;
            $share = max(0.05, $item['share'] + $jitter);
            $count = (int) floor($newCount * $share * 0.42);
            $topAttacks[] = [
                'name'       => $item['name'],
                'count'      => $count,
                'percentage' => (int) round($share * 100),
                'severity'   => $item['severity'],
            ];
        }
        usort($topAttacks, static fn (array $a, array $b): int => $b['count'] <=> $a['count']);

        // --- 3. RANKED SOURCE COUNTRIES ---
        /** @var array<int, array{name: string, flag: string, count: int, percentage: int}> $topCountries */
        $topCountries = [];
        foreach ($sources as $country) {
            $ratio = ($country['weight'] + random_int(-2, 2)) / 100.0;
            $count = (int) floor($newCount * max(0.02, $ratio) * 0.65);
            $topCountries[] = [
                'name'       => $country['name'],
                'flag'       => $country['flag'],
                'count'      => $count,
                'percentage' => max(3, min(95, $country['weight'] + random_int(-2, 2))),
            ];
        }
        usort($topCountries, static fn (array $a, array $b): int => $b['count'] <=> $a['count']);
        $topCountries = array_slice($topCountries, 0, 5);

        // --- 4. RANKED TOP ATTACKER IPs ---
        /** @var array<int, array{address: string, flag: string, country: string, count: int, percentage: int}> $topIps */
        $topIps = [];
        foreach ($attackerIps as $idx => $ip) {
            $baseShare = max(8, 28 - ($idx * 4) + random_int(-2, 2));
            $count = (int) floor($newCount * ($baseShare / 1000.0));
            $topIps[] = [
                'address'    => $ip['address'],
                'flag'       => $ip['flag'],
                'country'    => $ip['country'],
                'count'      => $count,
                'percentage' => min(100, $baseShare * 3),
            ];
        }
        usort($topIps, static fn (array $a, array $b): int => $b['count'] <=> $a['count']);
        $topIps = array_slice($topIps, 0, 5);

        return response()->json([
            'simulated'          => true,
            'total_attacks'      => $newCount,
            'attacks_per_minute' => random_int(38, 94),
            'mitigated_rate'     => 99.8,
            'recent_attacks'     => $recentAttacks,
            'top_attacks'        => $topAttacks,
            'top_countries'      => $topCountries,
            'top_ips'            => $topIps,
        ]);
    }
}

