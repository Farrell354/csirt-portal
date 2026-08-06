<!DOCTYPE html>
    <html lang="id">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Ancaman Siber Jawa Timur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-[#050b14]">

    <section class="bg-[#050b14] text-white relative overflow-hidden font-sans min-h-screen flex flex-col border-y border-gray-800/50">
        
        <!-- CONTAINER PETA: Background Penuh Layar (Sangat Gelap) -->
        <div class="absolute inset-0 z-0 flex items-center justify-center overflow-hidden opacity-40">
            <!-- Bayangan Peta Globe -->
            <div id="globe-container" class="w-[120%] h-[120%] rounded-full shadow-[inset_0_0_100px_rgba(0,0,0,1)] bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-900/20 via-[#050b14] to-[#050b14] flex items-center justify-center relative mt-40">
                <!-- Titik Pusat "JatimProv" -->
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center gap-2">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                    </span>
                    <span class="text-blue-500 font-bold tracking-widest text-lg drop-shadow-md">JatimProv</span>
                </div>
            </div>
        </div>

        <!-- HEADER TEXT (Tengah Atas) -->
        <div class="text-center relative z-10 pointer-events-none pt-12 flex flex-col items-center">
            <!-- Garis Keamanan Siber -->
            <div class="flex items-center gap-4 mb-3">
                <div class="h-[1px] w-12 bg-blue-800/60"></div>
                <span class="text-blue-500/80 text-xs font-bold tracking-[0.2em] uppercase">Keamanan Siber</span>
                <div class="h-[1px] w-12 bg-blue-800/60"></div>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold tracking-wide drop-shadow-lg text-gray-100">Peta Ancaman Siber <span class="text-[#00a8ff]">Jawa Timur</span></h2>
            <p class="text-gray-500 text-xs md:text-sm mt-3 drop-shadow-md">Monitoring serangan siber terhadap infrastruktur digital Pemerintah Provinsi Jawa Timur</p>
        </div>

        <!-- AREA WIDGET (Melayang Kiri & Kanan) -->
        <div class="absolute inset-0 z-10 flex flex-col md:flex-row justify-between items-center px-4 md:px-12 pointer-events-none pt-32 pb-16">
            
            <!-- WIDGET KIRI: Total Serangan & Kategori Kerentanan -->
            <div class="w-full md:w-[320px] flex flex-col gap-4 pointer-events-auto mb-6 md:mb-0">
                
                <!-- Kotak 1: Live Threat Map -->
                <div class="bg-[#0a1122]/60 border border-gray-800/60 p-6 rounded-2xl backdrop-blur-md shadow-lg">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-600"></span>
                        </span>
                        <span class="text-[10px] text-blue-500 font-bold tracking-widest uppercase">Live Threat Map</span>
                    </div>
                    <h3 class="text-5xl font-bold text-white tracking-tight" id="live-attack-count">104.001</h3>
                    <p class="text-[10px] text-gray-500 mt-2 font-mono">serangan terdeteksi 24 jam terakhir</p>
                </div>

                <!-- Kotak 2: Aduan Kerentanan (Dinamis dari Laporan Hunter) -->
                <div class="bg-[#0a1122]/60 border border-gray-800/60 p-4 rounded-xl backdrop-blur-md shadow-lg">
                    <h4 class="text-[10px] text-gray-400 font-bold tracking-widest mb-3 flex items-center gap-2 uppercase">
                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                        Aduan Kerentanan Terbanyak
                    </h4>
                    <ul class="space-y-2.5 text-[11px] font-mono">
                        
                        <!-- Cek apakah data dari Controller dikirim dan tidak kosong -->
                        @if(isset($topKerentanan) && $topKerentanan->count() > 0)
                            @foreach($topKerentanan as $index => $rentan)
                            <li class="flex justify-between items-center group">
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-black bg-blue-600/20 text-blue-500 border border-blue-600/30 w-4 h-4 flex items-center justify-center rounded-[3px]">{{ $index + 1 }}</span>
                                    <span class="text-sm text-gray-300 group-hover:text-white transition-colors truncate max-w-[180px]" title="{{ $rentan->nama_kerentanan }}">{{ $rentan->nama_kerentanan }}</span>
                                </div>
                                <span class="text-xs font-bold text-blue-400">{{ number_format($rentan->jumlah, 0, ',', '.') }}</span>
                            </li>
                            @endforeach
                        @else
                            <!-- Data Dummy Realistis (Muncul jika database belum ada isinya) -->
                            <li class="flex justify-between items-center group">
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-black bg-blue-600/20 text-blue-500 border border-blue-600/30 w-4 h-4 flex items-center justify-center rounded-[3px]">1</span>
                                    <span class="text-sm text-gray-300 group-hover:text-white transition-colors">Information Disclosure</span>
                                </div>
                                <span class="text-xs font-bold text-blue-400">142</span>
                            </li>
                            <li class="flex justify-between items-center group">
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-black bg-blue-600/20 text-blue-500 border border-blue-600/30 w-4 h-4 flex items-center justify-center rounded-[3px]">2</span>
                                    <span class="text-sm text-gray-300 group-hover:text-white transition-colors">Cross-Site Scripting (XSS)</span>
                                </div>
                                <span class="text-xs font-bold text-blue-400">98</span>
                            </li>
                            <li class="flex justify-between items-center group">
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-black bg-blue-600/20 text-blue-500 border border-blue-600/30 w-4 h-4 flex items-center justify-center rounded-[3px]">3</span>
                                    <span class="text-sm text-gray-300 group-hover:text-white transition-colors">Insecure Direct Object Ref.</span>
                                </div>
                                <span class="text-xs font-bold text-blue-400">75</span>
                            </li>
                            <li class="flex justify-between items-center group">
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-black bg-blue-600/20 text-blue-500 border border-blue-600/30 w-4 h-4 flex items-center justify-center rounded-[3px]">4</span>
                                    <span class="text-sm text-gray-300 group-hover:text-white transition-colors">SQL Injection (SQLi)</span>
                                </div>
                                <span class="text-xs font-bold text-blue-400">42</span>
                            </li>
                            <li class="flex justify-between items-center group">
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-black bg-blue-600/20 text-blue-500 border border-blue-600/30 w-4 h-4 flex items-center justify-center rounded-[3px]">5</span>
                                    <span class="text-sm text-gray-300 group-hover:text-white transition-colors">Business Logic Error</span>
                                </div>
                                <span class="text-xs font-bold text-blue-400">21</span>
                            </li>
                        @endif

                    </ul>
                </div>

            </div>

            <!-- ===================================================================== -->
            <!-- WIDGET KANAN: 3 Panel Tumpuk (TERDAPAT PERUBAHAN ID HTML PELAN-PELAN) -->
            <!-- ===================================================================== -->
            <div class="w-full md:w-[320px] flex flex-col gap-4 pointer-events-auto">
                
                <!-- Panel 1: Serangan Terbanyak -->
                <div class="bg-[#0a1122]/60 border border-gray-800/60 p-4 rounded-xl backdrop-blur-md shadow-lg overflow-hidden group">
                    <h4 class="text-[10px] text-gray-400 font-bold tracking-widest mb-3 flex items-center gap-2 uppercase">
                        <svg class="w-3.5 h-3.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                        Top Serangan
                    </h4>
                    <!-- GANTI ID: Tambahkan id="top-attacks-list" pelan-pelan -->
                    <ul id="top-attacks-list" class="space-y-2.5 text-[11px] font-mono">
                        <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px] shadow-[0_0_10px_rgba(250,204,21,0.3)]">1</span> <span class="text-gray-300 truncate max-w-[170px]">Reconnaissance</span></div> <span class="text-red-500 font-bold">37,939</span></li>
                        <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">2</span> <span class="text-gray-300 truncate max-w-[170px]">SQL Injection</span></div> <span class="text-orange-500 font-bold">28,357</span></li>
                        <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">3</span> <span class="text-gray-300 truncate max-w-[170px]">Cross-Site Scripting</span></div> <span class="text-blue-400 font-bold">12,723</span></li>
                    </ul>
                </div>

                <!-- Panel 2: Negara Sumber -->
                <div class="bg-[#0a1122]/60 border border-gray-800/60 p-4 rounded-xl backdrop-blur-md shadow-lg overflow-hidden group">
                    <h4 class="text-[10px] text-gray-400 font-bold tracking-widest mb-3 flex items-center gap-2 uppercase">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Negara Sumber
                    </h4>
                    <!-- GANTI ID: Tambahkan id="top-countries-list" pelan-pelan -->
                    <ul id="top-countries-list" class="space-y-2.5 text-[11px] font-mono">
                        <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">1</span> <span class="text-gray-300">🇮🇩 Indonesia</span></div> <span class="text-orange-500 font-bold">45,493</span></li>
                        <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">2</span> <span class="text-gray-300">🇸🇬 Singapore</span></div> <span class="text-blue-400 font-bold">31,987</span></li>
                        <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">3</span> <span class="text-gray-300">🇺🇸 United States</span></div> <span class="text-blue-400 font-bold">11,117</span></li>
                    </ul>
                </div>

                <!-- Panel 3: Top IP Penyerang -->
                <div class="bg-[#0a1122]/60 border border-gray-800/60 p-4 rounded-xl backdrop-blur-md shadow-lg overflow-hidden group">
                    <h4 class="text-[10px] text-gray-400 font-bold tracking-widest mb-3 flex items-center gap-2 uppercase">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                        Top IP Penyerang
                    </h4>
                    <!-- GANTI ID: Tambahkan id="top-ips-list" pelan-pelan -->
                    <ul id="top-ips-list" class="space-y-2.5 text-[11px] font-mono">
                        <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-red-500/20 text-red-400 border border-red-500/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px] shadow-[0_0_10px_rgba(239,68,68,0.3)]">1</span> <span class="text-gray-300">180.243.2.151</span></div> <span class="text-red-500 font-bold">9,050</span></li>
                        <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-red-500/20 text-red-400 border border-red-500/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">2</span> <span class="text-gray-300">103.8.77.26</span></div> <span class="text-[#00a8ff] font-bold">8,647</span></li>
                        <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-red-500/20 text-red-400 border border-red-500/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">3</span> <span class="text-gray-300">172.232.238.140</span></div> <span class="text-[#00a8ff] font-bold">6,004</span></li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- WIDGET NOTIFIKASI BAWAH (Pill Ticker) -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 pointer-events-auto">
            <div class="bg-[#0a1122]/90 border border-gray-700/50 backdrop-blur-md px-5 py-2.5 rounded-full flex items-center gap-3 shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span></span>
                <span class="text-[11px] font-mono text-gray-300"><span class="text-orange-400 font-bold">SQL Injection</span> &nbsp;🇮🇳 India &nbsp;&rarr;&nbsp; <span class="text-blue-400 font-bold">JatimProv</span></span>
                <span class="bg-red-500/20 text-red-500 border border-red-500/30 text-[9px] px-2 py-0.5 rounded font-bold ml-2">HIGH</span>
            </div>
        </div>

        <!-- TOMBOL SCROLL TO TOP (Opsional) -->
        <button class="absolute bottom-8 right-8 z-20 bg-[#00a8ff] hover:bg-blue-600 text-white w-10 h-10 rounded-full flex justify-center items-center shadow-lg transition-transform hover:scale-105 pointer-events-auto">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path></svg>
        </button>

        <!-- Ticker Running Text di Bawah -->
        <div class="absolute bottom-0 left-0 w-full bg-[#050b14]/95 border-t border-gray-800/60 p-2.5 overflow-hidden flex whitespace-nowrap text-[11px] text-gray-400 font-mono z-30 backdrop-blur-md shadow-[0_-5px_20px_rgba(0,0,0,0.5)]">
            <div class="animate-marquee inline-block whitespace-nowrap">
                <!-- SET DATA 1 -->
                <span class="mx-6"><span class="text-red-500 mr-2 animate-pulse">●</span> SQL Injection dari 82.197.69.49 &rarr; JatimProv <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
                <span class="mx-6"><span class="text-orange-500 mr-2 animate-pulse">●</span> Reconnaissance dari 165.22.221.124 &rarr; Diskominfo <span class="bg-orange-500/20 text-orange-500 border border-orange-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">HIGH</span></span>
                <span class="mx-6"><span class="text-red-500 mr-2 animate-pulse">●</span> DDoS Attempt dari 145.110.242.20 &rarr; Server Utama <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
                <span class="mx-6"><span class="text-yellow-500 mr-2 animate-pulse">●</span> Brute Force SSH dari 103.111.42.11 &rarr; Database Server <span class="bg-yellow-500/20 text-yellow-500 border border-yellow-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">MEDIUM</span></span>
                <span class="mx-6"><span class="text-blue-500 mr-2 animate-pulse">●</span> Malware Payload dari 45.33.32.156 &rarr; JatimProv <span class="bg-blue-500/20 text-blue-500 border border-blue-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">LOW</span></span>

                <!-- SET DATA 2 -->
                <span class="mx-6"><span class="text-red-500 mr-2 animate-pulse">●</span> SQL Injection dari 82.197.69.49 &rarr; JatimProv <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
                <span class="mx-6"><span class="text-orange-500 mr-2 animate-pulse">●</span> Reconnaissance dari 165.22.221.124 &rarr; Diskominfo <span class="bg-orange-500/20 text-orange-500 border border-orange-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">HIGH</span></span>
                <span class="mx-6"><span class="text-red-500 mr-2 animate-pulse">●</span> DDoS Attempt dari 145.110.242.20 &rarr; Server Utama <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
                <span class="mx-6"><span class="text-yellow-500 mr-2 animate-pulse">●</span> Brute Force SSH dari 103.111.42.11 &rarr; Database Server <span class="bg-yellow-500/20 text-yellow-500 border border-yellow-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">MEDIUM</span></span>
                <span class="mx-6"><span class="text-blue-500 mr-2 animate-pulse">●</span> Malware Payload dari 45.33.32.156 &rarr; JatimProv <span class="bg-blue-500/20 text-blue-500 border border-blue-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">LOW</span></span>
            </div>
        </div>
        
        <style>
            @keyframes marquee { 
                0% { transform: translateX(0%); } 
                100% { transform: translateX(-50%); } 
            }
            .animate-marquee { animation: marquee 35s linear infinite; }
            
            /* Animasi khusus untuk Marker Target di Globe (gaya Komdigi: dot + label, bukan radar besar) */
            @keyframes marker-pulse { 0% { transform: scale(0.6); opacity: 0.6; } 50% { transform: scale(1.4); opacity: 0; } 100% { transform: scale(0.6); opacity: 0; } }
        </style>

        <!-- LOAD THREE.JS & GLOBE.GL -->
        <script src="https://unpkg.com/three"></script>
        <script src="https://unpkg.com/globe.gl"></script>
        
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const container = document.getElementById('globe-container');
                container.innerHTML = ''; 

                const targetJatim = { lat: -7.2504, lng: 112.7688 };

                // 1. INIT GLOBE: BUMI GELAP + ATMOSFER GLOWING (gaya Komdigi: bersih & minim noise)
                const myGlobe = Globe({ animateIn: true })
                    (container)
                    .globeImageUrl('https://unpkg.com/three-globe/example/img/earth-dark.jpg') 
                    .bumpImageUrl('https://unpkg.com/three-globe/example/img/earth-topology.png')
                    .backgroundImageUrl('https://unpkg.com/three-globe/example/img/night-sky.png')
                    .backgroundColor('rgba(0,0,0,0)')
                    .showAtmosphere(true)
                    .atmosphereColor('#0ea5e9')
                    .atmosphereAltitude(0.22)
                    .width(container.clientWidth)
                    .height(container.clientHeight);

                // 2. HEX WIREFRAME GRID: garis halus cyan di daratan (bukan blok solid berkedip)
                fetch('https://raw.githubusercontent.com/vasturiano/globe.gl/master/example/datasets/ne_110m_admin_0_countries.geojson')
                    .then(res => res.json())
                    .then(countries => {
                        myGlobe.hexPolygonsData(countries.features)
                            .hexPolygonResolution(4)          // grid lebih halus & rapat
                            .hexPolygonMargin(0.35)            // margin besar -> terlihat seperti garis wireframe, bukan blok
                            .hexPolygonUseDots(false)
                            .hexPolygonColor(() => 'rgba(56, 189, 248, 0.28)') // cyan tipis merata, konsisten
                            .hexPolygonAltitude(0.006)         // sangat tipis, hampir menempel di permukaan
                            .hexPolygonTransitionDuration(1500);

                        // "Breathing" halus: sesekali beberapa hex berkedip lebih terang, bukan blok gelap acak
                        setInterval(() => {
                            myGlobe.hexPolygonColor(() =>
                                Math.random() > 0.985
                                    ? 'rgba(125, 211, 252, 0.9)'   // kilau terang sesekali
                                    : 'rgba(56, 189, 248, 0.28)'   // garis dasar tipis
                            );
                        }, 3000);
                    });

                // 3. MARKER TARGET: dot + label "Komdigi" dengan ping halus (bukan radar besar berputar)
                const markerEl = document.createElement('div');
                markerEl.style.pointerEvents = 'none';
                markerEl.innerHTML = `
                    <div style="position:relative; display:flex; align-items:center; gap:6px; transform: translate(-4px, -4px);">
                        <span style="position:relative; display:inline-flex; width:8px; height:8px;">
                            <span style="position:absolute; inline-size:100%; block-size:100%; border-radius:9999px; background:#38bdf8; animation: marker-pulse 1.8s ease-out infinite;"></span>
                            <span style="position:relative; display:inline-flex; width:8px; height:8px; border-radius:9999px; background:#38bdf8; box-shadow:0 0 8px #38bdf8;"></span>
                        </span>
                        <span style="font-size:11px; font-family: monospace; font-weight:700; color:#e0f2fe; text-shadow: 0 0 6px rgba(0,0,0,0.8);">Jatim</span>
                    </div>
                `;
                
                myGlobe.htmlElementsData([{ lat: targetJatim.lat, lng: targetJatim.lng }])
                    .htmlElement(() => markerEl)
                    .htmlAltitude(0.02);

                // Set Kamera awal ke arah Jatim (lebih dekat, seperti referensi)
                myGlobe.pointOfView({ lat: -5, lng: 113, altitude: 1.8 });

                // 4. EFEK LASER (ARCS) & LEDAKAN — lebih jarang & lebih halus, sesuai gaya referensi
                myGlobe
                    .arcDashLength(0.4)
                    .arcDashGap(0.15)
                    .arcDashAnimateTime(1200)
                    .arcStroke(0.8)
                    .ringColor(d => d.color)
                    .ringMaxRadius(4)
                    .ringPropagationSpeed(3)
                    .ringRepeatPeriod(0);

                myGlobe.controls().autoRotate = true;
                myGlobe.controls().autoRotateSpeed = 0.4;
                myGlobe.controls().enableZoom = false;

                // 5. DATA NEGARA SUMBER & SATELLITE SWARM (dibuat lebih halus/kecil agar tidak ramai seperti referensi)
                const satellites = [...Array(60).keys()].map(() => ({
                    lat: (Math.random() - 0.5) * 180,
                    lng: (Math.random() - 0.5) * 360,
                    altitude: Math.random() * 0.4 + 0.1,
                    size: Math.random() * 0.15 + 0.05,   // lebih kecil, tidak dominan
                    color: ['#0ea5e9', '#38bdf8', '#7dd3fc', '#f59e0b'][Math.floor(Math.random() * 4)]
                }));

                myGlobe.pointsData(satellites)
                    .pointAltitude('altitude')
                    .pointColor('color')
                    .pointRadius('size')
                    .pointsMerge(true);

                setInterval(() => {
                    satellites.forEach(s => s.lng += 0.3);
                    myGlobe.pointsData(satellites);
                }, 50);

                // =====================================================================
                // 6. MESIN LOGIKA SUPER DEWA: INTEGRASI GLOBE & WIDGET DINAMIS
                // =====================================================================
                let activeAttacks = [];
                let activeRings = [];

                setInterval(() => {
                    // Panggil API Terminal Data yang barusan Bos buat
                    fetch('/api/threat-data')
                        .then(response => response.json())
                        .then(data => {
                            console.log("Data Asli Berhasil Ditarik:", data);

                            // --- A. UPDATE WIDGET KIRI ( TOTAL SERANGAN ) ---
                            const countElement = document.getElementById('live-attack-count');
                            if (countElement && data.total_attacks) {
                                // Gunakan format angka Indonesia pelan-pelan
                                countElement.innerText = data.total_attacks.toLocaleString('id-ID');
                            }

                            // --- B. NEW LOGIC: UPDATE DYNAMIC WIDGET PANELS ( KANAN ) pelan-pelan ---

                            // Fungsi pembantu untuk mengupdate list DOM
                            const updateDynamicList = (containerId, listData, itemHtmlGenerator) => {
                                const container = document.getElementById(containerId);
                                if (!container || !listData) return;
                                container.innerHTML = ''; // Kosongkan list lama dulu Bos
                                listData.forEach((item, index) => {
                                    // Tempelkan item HTML baru pelan-pelan Bos
                                    container.innerHTML += itemHtmlGenerator(item, index);
                                });
                            };

                            // Generator HTML untuk "Top Serangan"
                            const generateAttackItemHtml = (item, index) => {
                                // Tentukan warna berdasarkan peringkat
                                const scoreClass = index === 0 ? 'text-red-500' : (index === 1 ? 'text-orange-500' : 'text-blue-400');
                                return `
                                    <li class="flex justify-between items-center group">
                                        <div class="flex items-center gap-3">
                                            <span class="text-[10px] font-black ${index === 0 ? 'bg-red-600/20 text-red-500 border-red-600/30' : 'bg-yellow-600/20 text-yellow-500 border-yellow-600/30'} w-4 h-4 flex items-center justify-center rounded-[3px] shadow-[0_0_10px_rgba(250,204,21,0.2)]">${index + 1}</span>
                                            <span class="text-sm text-gray-300 group-hover:text-white transition-colors truncate max-w-[180px]">${item.name}</span>
                                        </div>
                                        <span class="text-xs font-bold ${scoreClass}">${item.count.toLocaleString('id-ID')}</span>
                                    </li>
                                `;
                            };

                            // Generator HTML untuk "Negara Sumber"
                            const generateCountryItemHtml = (item, index) => {
                                 const scoreClass = index === 0 ? 'text-orange-500' : 'text-blue-400';
                                 return `
                                    <li class="flex justify-between items-center group">
                                        <div class="flex items-center gap-3">
                                            <span class="text-[10px] font-black bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px]">${index + 1}</span>
                                            <span class="text-sm text-gray-300 group-hover:text-white transition-colors">${item.flag} ${item.name}</span>
                                        </div>
                                        <span class="text-xs font-bold ${scoreClass}">${item.count.toLocaleString('id-ID')}</span>
                                    </li>
                                `;
                            };

                            // Generator HTML untuk "Top IP Penyerang"
                            const generateIpItemHtml = (item, index) => {
                                const scoreClass = index === 0 ? 'text-red-500' : 'text-[#00a8ff]';
                                return `
                                    <li class="flex justify-between items-center group">
                                        <div class="flex items-center gap-3">
                                            <span class="text-[10px] font-black bg-red-600/20 text-red-400 border border-red-500/30 w-4 h-4 flex items-center justify-center rounded-[3px] shadow-[0_0_10px_rgba(239,68,68,0.2)]">${index + 1}</span>
                                            <span class="text-sm text-gray-300 group-hover:text-white transition-colors">${item.address}</span>
                                        </div>
                                        <span class="text-xs font-bold ${scoreClass}">${item.count.toLocaleString('id-ID')}</span>
                                    </li>
                                `;
                            };

                            // Panggil fungsi update untuk ketiga panel kanan pelan-pelan Bos
                            updateDynamicList('top-attacks-list', data.top_attacks, generateAttackItemHtml);
                            updateDynamicList('top-countries-list', data.top_countries, generateCountryItemHtml);
                            updateDynamicList('top-ips-list', data.top_ips, generateIpItemHtml);


                            // --- C. UPDATE GLOBE MAPS ( LASER & LEDAKAN — SAMA SEPERTI SEBELUMNYA ) ---
                            if (data.recent_attacks) {
                                data.recent_attacks.forEach(attack => {
                                    // Bikin titik mendarat acak sedikit di sekitar Jawa Timur
                                    const endLatOffset = targetJatim.lat + (Math.random() - 0.5) * 1.5;
                                    const endLngOffset = targetJatim.lng + (Math.random() - 0.5) * 1.5;

                                    const newAttack = {
                                        startLat: attack.source_lat, // Koordinat asal dari API
                                        startLng: attack.source_lng, // Koordinat asal dari API
                                        endLat: endLatOffset,
                                        endLng: endLngOffset,
                                        // Set warna berdasarkan severity dari API
                                        color: attack.severity === 'high' ? '#ef4444' : (attack.severity === 'medium' ? '#f97316' : '#0ea5e9')
                                    };

                                    activeAttacks.push(newAttack);
                                    // Batasi komet aktif biar ngga ngelag pelan-pelan Bos
                                    if (activeAttacks.length > 12) activeAttacks.shift();

                                    // Render laser baru
                                    myGlobe.arcsData(activeAttacks)
                                        .arcStartLat(d => d.startLat)
                                        .arcStartLng(d => d.startLng)
                                        .arcEndLat(d => d.endLat)
                                        .arcEndLng(d => d.endLng)
                                        .arcColor(d => ['rgba(255,255,255,0)', d.color]);

                                    // Render ledakan radar 1,2 detik kemudian (pas laser mendarat)
                                    setTimeout(() => {
                                        activeRings.push({ lat: endLatOffset, lng: endLngOffset, color: newAttack.color });
                                        if (activeRings.length > 5) activeRings.shift();
                                        myGlobe.ringsData(activeRings);
                                    }, 1200);
                                });
                            }
                        })
                        .catch(error => console.error('Error saat menarik data pelan-pelan:', error));
                        
                }, 3000); // Penarikan data baru dilakukan setiap 3 detik Bos biar aman

                window.addEventListener('resize', () => {
                    myGlobe.width(container.clientWidth).height(container.clientHeight);
                });
            });
        </script>
    </section>

    </body>
    </html>