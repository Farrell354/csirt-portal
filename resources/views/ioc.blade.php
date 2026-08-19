@php
    $feed = request('feed', 'dokumen');
    
    $tabs = [
        'dokumen' => ['label' => '< DOKUMEN >', 'desc' => 'Dokumen publikasi resmi CSIRT.', 'total' => '13'],
        'cve' => ['label' => '< CVE >', 'desc' => 'Kerentanan (CVE) terbaru beserta skor CVSS.', 'total' => '13,207'],
        'malware' => ['label' => '< MALWARE >', 'desc' => 'Sampel malware / keluarga malware yang terdeteksi.', 'total' => '72'],
        'phishing-link' => ['label' => '< PHISHING LINK >', 'desc' => 'Tautan phishing aktif yang perlu diwaspadai.', 'total' => '409'],
        'phishing-domain' => ['label' => '< PHISHING DOMAIN >', 'desc' => 'Domain phishing / typosquat yang digunakan untuk penipuan.', 'total' => '3,743'],
        'ip' => ['label' => '< IP FEEDS >', 'desc' => 'Alamat IP berbahaya / Anomali (C2, Botnet, Scanner).', 'total' => '405']
    ];
    
    if(!array_key_exists($feed, $tabs)) $feed = 'dokumen';
    $activeTab = $tabs[$feed];

    // Dummy Chart Data
    $chart = ['mei' => 0, 'juni' => 0, 'juli' => 0, 'agustus' => 0];
    if($feed == 'dokumen') { $chart['agustus'] = 13; $chartPct = [0,0,0,100]; }
    elseif($feed == 'cve') { $chart['juli'] = "6,790"; $chart['agustus'] = "6,417"; $chartPct = [0,0,100,95]; }
    elseif($feed == 'malware') { $chart['agustus'] = 72; $chartPct = [0,0,0,100]; }
    elseif($feed == 'phishing-link') { $chart['agustus'] = 409; $chartPct = [0,0,0,100]; }
    elseif($feed == 'phishing-domain') { $chart['mei']=33; $chart['juni']=35; $chart['juli']=933; $chart['agustus']="2,842"; $chartPct = [2,2,30,100]; }
    elseif($feed == 'ip') { $chart['agustus'] = 405; $chartPct = [0,0,0,100]; }
@endphp
<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ancaman Siber & IoC - JatimProv-CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen overflow-x-hidden selection:bg-cyan-500 selection:text-white">

    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-40 dark:opacity-100 z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <div class="flex-grow relative z-10 flex flex-col items-center w-full pt-12 pb-24">
        <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- HEADER -->
            <div class="text-center mb-10 opacity-0 animate-fade-in-up">
                <h1 class="font-display text-3xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight mb-4 uppercase">
                    Dokumen IOC & Ancaman Siber
                </h1>
                <p class="text-xs md:text-sm text-gray-500 dark:text-slate-400 font-medium max-w-3xl mx-auto leading-relaxed">
                    Dokumen indikator kompromi (IoC) serta kerentanan dan ancaman siber terkini yang sudah divalidasi oleh Jatimprov-CSIRT dan terintegrasi dengan CTIS BSSN. Diperbarui otomatis setiap hari.
                </p>
            </div>

            <!-- STAT CARDS -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 rounded-xl p-3 text-center shadow-sm">
                    <div class="text-2xl font-display font-bold text-blue-600 dark:text-blue-500">13</div>
                    <div class="text-[9px] font-mono font-bold uppercase tracking-widest text-slate-500 mt-1">DOKUMEN IOC</div>
                </div>
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 rounded-xl p-3 text-center shadow-sm">
                    <div class="text-2xl font-display font-bold text-cyan-600 dark:text-cyan-400">13,207</div>
                    <div class="text-[9px] font-mono font-bold uppercase tracking-widest text-slate-500 mt-1">CVE</div>
                </div>
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 rounded-xl p-3 text-center shadow-sm">
                    <div class="text-2xl font-display font-bold text-red-600 dark:text-red-500">7,270</div>
                    <div class="text-[9px] font-mono font-bold uppercase tracking-widest text-slate-500 mt-1">CRITICAL/HIGH</div>
                </div>
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 rounded-xl p-3 text-center shadow-sm">
                    <div class="text-2xl font-display font-bold text-amber-500 dark:text-amber-400">822</div>
                    <div class="text-[9px] font-mono font-bold uppercase tracking-widest text-slate-500 mt-1">MALWARE</div>
                </div>
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 rounded-xl p-3 text-center shadow-sm">
                    <div class="text-2xl font-display font-bold text-teal-500 dark:text-teal-400">29,594</div>
                    <div class="text-[9px] font-mono font-bold uppercase tracking-widest text-slate-500 mt-1">PHISHING</div>
                </div>
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 rounded-xl p-3 text-center shadow-sm">
                    <div class="text-2xl font-display font-bold text-blue-600 dark:text-blue-500">405</div>
                    <div class="text-[9px] font-mono font-bold uppercase tracking-widest text-slate-500 mt-1">IP FEEDS</div>
                </div>
            </div>

            <!-- TABS -->
            <div class="flex flex-wrap justify-center gap-2 mb-10 opacity-0 animate-fade-in-up" style="animation-delay: 0.15s;">
                @foreach($tabs as $key => $tab)
                    <a href="?feed={{ $key }}" class="px-4 py-2 font-mono text-[9px] sm:text-[10px] font-bold uppercase tracking-widest rounded-lg transition-colors {{ $feed == $key ? 'bg-transparent border border-cyan-500 text-cyan-600 dark:text-cyan-400' : 'bg-transparent border border-gray-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-400 hover:bg-gray-100 dark:hover:bg-slate-800' }}">
                        {{ $tab['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="w-full opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                
                <!-- SYNC STATUS & TITLE -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-2 gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 shadow-[0_0_5px_#22c55e]"></span>
                        <span class="text-[10px] font-mono font-bold text-slate-400">Terakhir disinkronkan 4 days ago</span>
                    </div>
                    <a href="/ioc/semua?type={{ $feed }}" class="px-4 py-1.5 bg-cyan-500 hover:bg-cyan-400 text-white font-bold text-[10px] uppercase rounded transition-colors shadow-[0_0_10px_rgba(6,182,212,0.3)] inline-block">
                        = Lihat Semua
                    </a>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-6">{{ $activeTab['desc'] }}</p>

                <!-- CHART CARD -->
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 rounded-2xl p-6 shadow-xl mb-6">
                    <div class="flex justify-between items-start mb-6 border-b border-gray-100 dark:border-slate-800 pb-4">
                        <h2 class="text-xl font-display font-bold text-slate-900 dark:text-white">Tahun 2026</h2>
                        <div class="text-right">
                            <div class="text-2xl font-display font-bold text-cyan-500">{{ $activeTab['total'] }}</div>
                            <div class="text-[8px] font-mono uppercase tracking-widest text-slate-500">TOTAL {{ strtoupper(str_replace('-', ' ', $feed)) }}</div>
                        </div>
                    </div>
                    
                    <div class="text-[9px] font-mono font-bold uppercase tracking-widest text-slate-400 mb-5 flex items-center gap-2">
                        <span class="w-2 h-2 border border-slate-400"></span> RINCIAN 4 BULAN TERAKHIR (ROLLING)
                    </div>

                    <div class="space-y-4">
                        @foreach(['MEI' => 0, 'JUNI' => 1, 'JULI' => 2, 'AGUSTUS' => 3] as $month => $i)
                        <div class="flex items-center gap-4">
                            <div class="w-16 text-[10px] font-mono font-bold {{ $chartPct[$i] == 100 ? 'text-cyan-500' : 'text-slate-500 dark:text-slate-400' }}">{{ $month }}</div>
                            <div class="flex-grow bg-gray-100 dark:bg-slate-800 rounded-full h-1.5 relative">
                                <div class="absolute left-0 top-0 h-full bg-cyan-500 rounded-full {{ $chartPct[$i] > 0 ? 'shadow-[0_0_8px_rgba(6,182,212,0.5)]' : '' }}" style="width: {{ $chartPct[$i] }}%;"></div>
                            </div>
                            <div class="w-12 text-right text-[10px] font-mono font-bold {{ $chartPct[$i] == 100 ? 'text-cyan-500' : 'text-slate-500' }}">{{ $chart[strtolower($month)] }}</div>
                        </div>
                        @endforeach
                    </div>
                    
                    <p class="text-[9px] text-slate-400 dark:text-slate-500 mt-6 pt-4 border-t border-gray-100 dark:border-slate-800">
                        <span class="inline-block w-2.5 h-2.5 rounded-full border border-slate-400 text-center leading-[8px] mr-1 text-[7px]">i</span> 
                        Total {{ ucwords(str_replace('-', ' ', $feed)) }} = akumulasi Januari-bulan ini. Grafik = 4 bulan terakhir rolling.
                    </p>
                </div>

                <!-- EXTRA DISTRIBUTION CHARTS -->
                @if($feed == 'cve')
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-cyan-500/30 rounded-2xl p-6 shadow-lg mb-6 shadow-cyan-500/5">
                    <div class="text-[10px] font-mono font-bold uppercase tracking-widest text-cyan-500 mb-5">DISTRIBUSI TINGKAT KEPARAHAN CVE</div>
                    <div class="space-y-3">
                        @foreach([['HIGH','6,618',100], ['MEDIUM','4,354',75], ['CRITICAL','1,752',40], ['LOW','432',15], ['NONE','4',5]] as $d)
                        <div class="flex items-center gap-4">
                            <div class="w-16 text-[9px] font-mono font-bold text-white">{{ $d[0] }}</div>
                            <div class="flex-grow bg-slate-800 h-1.5 relative">
                                <div class="absolute left-0 top-0 h-full bg-blue-500" style="width: {{ $d[2] }}%;"></div>
                            </div>
                            <div class="w-10 text-right text-[9px] font-mono font-bold text-slate-400">{{ $d[1] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @elseif($feed == 'phishing-link')
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-cyan-500/30 rounded-2xl p-6 shadow-lg mb-6 shadow-cyan-500/5">
                    <div class="text-[10px] font-mono font-bold uppercase tracking-widest text-cyan-500 mb-5">DISTRIBUSI SKEMA URL</div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-4">
                            <div class="w-12 text-[9px] font-mono font-bold text-white">HTTPS</div>
                            <div class="flex-grow bg-slate-800 h-1.5 relative"><div class="absolute left-0 top-0 h-full bg-blue-500" style="width: 100%;"></div></div>
                            <div class="w-10 text-right text-[9px] font-mono font-bold text-slate-400">8,568</div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 text-[9px] font-mono font-bold text-white">HTTP</div>
                            <div class="flex-grow bg-slate-800 h-1.5 relative"><div class="absolute left-0 top-0 h-full bg-blue-500" style="width: 50%;"></div></div>
                            <div class="w-10 text-right text-[9px] font-mono font-bold text-slate-400">4,175</div>
                        </div>
                    </div>
                </div>
                @elseif($feed == 'phishing-domain')
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-cyan-500/30 rounded-2xl p-6 shadow-lg mb-6 shadow-cyan-500/5">
                    <div class="text-[10px] font-mono font-bold uppercase tracking-widest text-cyan-500 mb-5">DISTRIBUSI TLD</div>
                    <div class="space-y-3">
                        @foreach([['.COM','4,502',100], ['.DEV','1,829',40], ['.APP','1,533',35], ['.CC','1,410',30], ['.IO','807',20], ['.AU','750',18], ['.VIP','725',17], ['.YZ','346',10], ['.NET','207',8], ['.ORG','263',9]] as $d)
                        <div class="flex items-center gap-4">
                            <div class="w-10 text-[9px] font-mono font-bold text-white">{{ $d[0] }}</div>
                            <div class="flex-grow bg-slate-800 h-1.5 relative">
                                <div class="absolute left-0 top-0 h-full bg-blue-500" style="width: {{ $d[2] }}%;"></div>
                            </div>
                            <div class="w-10 text-right text-[9px] font-mono font-bold text-slate-400">{{ $d[1] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- LIST TABLE (5 TERBARU) -->
                @if($feed != 'cve')
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-xl">
                    <div class="p-5 border-b border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-[#020817]/50">
                        <h2 class="text-[10px] font-mono font-bold uppercase tracking-widest text-cyan-500">5 {{ strtoupper(str_replace('-', ' ', $feed)) }} TERBARU</h2>
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-slate-800/80">
                        @php
                            $items = [];
                            if($feed == 'dokumen') {
                                $items = ['Ungkap Aktivitas APT Turla, Lebih dari 107 Ribu Indikasi Kompromi Terdeteksi di Indonesia', 'Ransomware Berbasis AI Otonom Pertama Terungkap, Mampu Menyerang Tanpa Campur Tangan Manusia', 'Ekstensi Microsoft Edge Berbahaya Jadi Senjata Baru Sebar Ransomware'];
                            } elseif($feed == 'malware') {
                                $items = ['FakeSpy', 'FlyTrap', 'ViceLeaker', 'Red Alert 2.0', 'Manakle'];
                            } elseif($feed == 'phishing-link') {
                                $items = ['https://chill-farmukehums.com/', 'https://mertilostart.com/sqd3?Aq.js', 'http://kupzovo.shop:7587/collections', 'http://faanzect.click:4929/exports'];
                            } elseif($feed == 'phishing-domain') {
                                $items = ['1jfem.ch'];
                            } elseif($feed == 'ip') {
                                $items = ['110.12.255.48', '31.55.200.234', '85.215.228.204', '45.11.101.89', '38.240.222.165'];
                            }
                        @endphp
                        
                        @foreach($items as $item)
                        <a href="/ioc/detail?type={{ $feed }}&id={{ urlencode($item) }}" class="p-5 hover:bg-slate-800/30 transition-colors flex justify-between items-center group block">
                            <div class="font-mono text-xs {{ in_array($feed, ['phishing-link', 'phishing-domain', 'ip']) ? 'text-red-500' : 'text-slate-300' }} group-hover:text-cyan-400 transition-colors truncate pr-4">
                                {{ $item }}
                            </div>
                            @if($feed != 'dokumen')
                            <div class="text-[9px] font-mono text-slate-500 shrink-0">15 Aug 2026 07:35</div>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

    <x-footer />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.opacity-0.animate-fade-in-up').forEach(el => {
                setTimeout(() => el.style.opacity = '1', parseInt(el.style.animationDelay)*1000 || 300);
            });
        });
    </script>
</body>
</html>
