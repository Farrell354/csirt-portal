@php
    $type = request('type', 'dokumen');
    
    // Mapping format for headers and data generator
    $config = [
        'dokumen' => ['title' => 'Dokumen CTI', 'col1' => 'JUDUL DOKUMEN', 'col2' => 'UKURAN', 'col3' => 'TANGGAL'],
        'cve' => ['title' => 'Kerentanan (CVE)', 'col1' => 'CVE ID', 'col2' => 'CVSS SCORE', 'col3' => 'PUBLISHED'],
        'malware' => ['title' => 'Malware Terdeteksi', 'col1' => 'NAMA MALWARE', 'col2' => 'TYPE', 'col3' => 'TERDETEKSI'],
        'phishing-link' => ['title' => 'Phishing URL', 'col1' => 'URL BERBAHAYA', 'col2' => 'STATUS', 'col3' => 'DITEMUKAN'],
        'phishing-domain' => ['title' => 'Domain Phishing', 'col1' => 'DOMAIN', 'col2' => 'TLD', 'col3' => 'DITEMUKAN'],
        'ip' => ['title' => 'IP Feeds', 'col1' => 'ALAMAT IP', 'col2' => 'REPUTATION', 'col3' => 'TERAKHIR AKTIF']
    ];
    
    if(!array_key_exists($type, $config)) $type = 'dokumen';
    $c = $config[$type];
@endphp
<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Data {{ $c['title'] }} - JatimProv-CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen overflow-x-hidden selection:bg-cyan-500 selection:text-white">

    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-40 dark:opacity-100 z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-cyan-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50"><x-navbar /></div>

    <div class="flex-grow relative z-10 flex flex-col items-center w-full pt-16 pb-24">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <a href="/ioc?feed={{ $type }}" class="inline-flex items-center text-[10px] font-bold font-mono text-gray-500 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 mb-8 transition-transform hover:-translate-x-2 duration-300 uppercase tracking-widest bg-white/50 dark:bg-slate-900/50 px-4 py-2 rounded-xl border border-gray-200 dark:border-slate-800 backdrop-blur-md shadow-sm">
                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Dashboard
            </a>

            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="font-display text-3xl font-black text-slate-900 dark:text-white uppercase mb-2">Data Keseluruhan: {{ $c['title'] }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Menampilkan 50 data terbaru (Dummy Data Mode).</p>
                </div>
                <div class="hidden sm:block">
                    <div class="px-4 py-2 bg-slate-100 dark:bg-slate-800 rounded-lg text-[10px] font-mono text-slate-500 uppercase tracking-widest border border-gray-200 dark:border-slate-700">
                        TOTAL RECORD: <span class="text-cyan-500 font-bold ml-2">999+</span>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-xl">
                <!-- Search bar -->
                <div class="p-6 border-b border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-[#020817]/50 flex gap-4">
                    <div class="relative w-full max-w-md group">
                        <input type="text" placeholder="Cari {{ strtolower($c['title']) }}..." class="w-full bg-white dark:bg-slate-950 border border-gray-200 dark:border-slate-700/80 text-sm px-5 py-2.5 rounded-xl outline-none focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-500 transition-all text-gray-700 dark:text-gray-200 shadow-sm placeholder-gray-400">
                    </div>
                    <button class="px-5 py-2.5 bg-cyan-500 text-white text-xs font-bold rounded-xl shadow-md hover:bg-cyan-600 transition-colors">FILTER</button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
                        <thead class="text-[10px] text-gray-500 dark:text-slate-400 uppercase bg-gray-50/80 dark:bg-slate-800/40 border-b border-gray-100 dark:border-slate-800 font-mono tracking-widest">
                            <tr>
                                <th scope="col" class="px-6 py-5 font-bold w-16 text-center">NO</th>
                                <th scope="col" class="px-6 py-5 font-bold">{{ $c['col1'] }}</th>
                                <th scope="col" class="px-6 py-5 font-bold">{{ $c['col2'] }}</th>
                                <th scope="col" class="px-6 py-5 font-bold text-right">{{ $c['col3'] }}</th>
                                <th scope="col" class="px-6 py-5 font-bold text-center w-24">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-800/80">
                            @for($i = 1; $i <= 50; $i++)
                                @php
                                    // Generate dummy content dynamically per row
                                    $c1 = ''; $c2 = ''; $c3 = '15 Aug 2026'; $link = '#';
                                    
                                    if($type == 'dokumen') {
                                        $c1 = 'Laporan Analisis CTI Vol ' . rand(100, 999) . ' - Ancaman Sektoral';
                                        $c2 = rand(800, 3500) . ' KB';
                                        $link = '/ioc/detail?type=dokumen&id=' . urlencode($c1);
                                    } elseif($type == 'cve') {
                                        $year = rand(2021, 2026);
                                        $c1 = 'CVE-' . $year . '-' . rand(10000, 99999);
                                        $c2 = (rand(40, 100) / 10);
                                        $link = '/ioc/detail?type=cve&id=' . urlencode($c1);
                                    } elseif($type == 'malware') {
                                        $names = ['FakeSpy', 'FlyTrap', 'ViceLeaker', 'Red Alert', 'Emotet', 'Ryuk', 'CobaltStrike', 'Qakbot'];
                                        $c1 = $names[array_rand($names)] . ' v' . rand(1,5) . '.' . rand(0,9);
                                        $types = ['Ransomware', 'Trojan', 'Spyware', 'Worm'];
                                        $c2 = $types[array_rand($types)];
                                        $link = '/ioc/detail?type=malware&id=' . urlencode($c1);
                                    } elseif($type == 'phishing-link') {
                                        $c1 = 'https://' . substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, rand(8,15)) . '.com/login';
                                        $c2 = 'ACTIVE';
                                        $link = '/ioc/detail?type=phishing-link&id=' . urlencode($c1);
                                    } elseif($type == 'phishing-domain') {
                                        $tlds = ['.com', '.net', '.app', '.dev', '.xyz'];
                                        $c1 = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, rand(6,12)) . $tlds[array_rand($tlds)];
                                        $c2 = strtoupper(explode('.', $c1)[1]);
                                        $link = '/ioc/detail?type=phishing-domain&id=' . urlencode($c1);
                                    } elseif($type == 'ip') {
                                        $c1 = rand(1,255) . '.' . rand(1,255) . '.' . rand(1,255) . '.' . rand(1,255);
                                        $c2 = 'MALICIOUS';
                                        $link = '/ioc/detail?type=ip&id=' . urlencode($c1);
                                    }
                                @endphp
                            <tr class="hover:bg-cyan-50/50 dark:hover:bg-slate-800/50 transition-colors duration-300 group">
                                <td class="px-6 py-4 font-mono text-xs text-slate-400 dark:text-slate-500 text-center">{{ $i }}</td>
                                <td class="px-6 py-4 font-mono text-sm {{ in_array($type, ['phishing-link', 'phishing-domain', 'ip', 'cve']) ? 'text-red-500' : 'text-slate-800 dark:text-gray-200' }}">
                                    {{ $c1 }}
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-slate-500">
                                    @if($type == 'cve')
                                        <span class="px-2 py-1 rounded {{ $c2 >= 7 ? 'bg-red-500/10 text-red-500 border border-red-500/50' : 'bg-amber-500/10 text-amber-500 border border-amber-500/50' }}">{{ $c2 }}</span>
                                    @elseif(in_array($type, ['phishing-link', 'ip']))
                                        <span class="px-2 py-1 rounded bg-red-500/10 text-red-500 border border-red-500/50">{{ $c2 }}</span>
                                    @else
                                        {{ $c2 }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-slate-400 text-right">{{ $c3 }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ $link }}" class="text-[10px] font-bold uppercase tracking-widest text-cyan-500 hover:text-white bg-cyan-500/10 hover:bg-cyan-500 px-3 py-1.5 rounded transition-colors">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Dummy -->
                <div class="p-6 border-t border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-[#020817]/50 flex justify-between items-center">
                    <div class="text-[10px] font-mono text-slate-500">Showing 1 to 50 of 9,842 entries</div>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 rounded bg-slate-200 dark:bg-slate-800 text-slate-400 cursor-not-allowed text-xs font-mono">PREV</button>
                        <button class="px-3 py-1.5 rounded bg-cyan-500 text-white text-xs font-mono">1</button>
                        <button class="px-3 py-1.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-mono transition-colors">2</button>
                        <button class="px-3 py-1.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-mono transition-colors">3</button>
                        <button class="px-3 py-1.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-mono transition-colors">NEXT</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-footer />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />
</body>
</html>
