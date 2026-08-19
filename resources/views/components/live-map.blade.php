{{--
    LIVE MAP COMPONENT — Mobile-First Responsive
    Single globe container, layout switches via CSS:
    - Mobile (<lg): Stacked — Header → Stats cards → Globe → Vuln list → Feed
    - Desktop (≥lg): Globe full-background + floating side widgets
--}}
<section class="relative w-full overflow-hidden bg-[#050b14] border-y border-slate-800/50 text-white font-sans" id="live-map-section">

    <style>
        /* ── Scrollbar ── */
        .map-scrollbar::-webkit-scrollbar { width: 4px; }
        .map-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .map-scrollbar::-webkit-scrollbar-thumb { background: #0ea5e9; border-radius: 10px; }

        /* ── List separator ── */
        .clean-list-item { border-bottom: 1px solid rgba(30,58,138,0.25); padding-bottom: 0.5rem; margin-bottom: 0.5rem; }
        .clean-list-item:last-child { border-bottom: none; padding-bottom: 0; margin-bottom: 0; }

        /* ── Marquee ── */
        @keyframes marquee-map { 0% { transform: translate3d(0,0,0); } 100% { transform: translate3d(-50%,0,0); } }
        .animate-marquee-map { animation: marquee-map 35s linear infinite; }

        /* ─────────────────────────────────────────
           MOBILE  (<1024px): stacked layout
        ───────────────────────────────────────── */
        #globe-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 60vw;
            min-height: 260px;
            max-height: 400px;
            overflow: hidden;
            pointer-events: auto;
        }
        #globe-container { width: 100%; height: 100%; }

        #desktop-widgets { display: none; }
        #mobile-stats    { display: grid; }

        /* ─────────────────────────────────────────
           DESKTOP (≥1024px): globe as full backdrop
        ───────────────────────────────────────── */
        @media (min-width: 1024px) {
            #live-map-section { height: 100vh; min-height: 700px; max-height: 1080px; }

            #globe-wrapper {
                position: absolute;
                inset: 0;
                height: auto;
                max-height: none;
                pointer-events: auto;
                cursor: grab;
                #globe-wrapper:active { cursor: grabbing; }
            }

            #desktop-widgets { display: flex; }
            #mobile-stats    { display: none; }
        }

        /* Fade overlay at bottom of globe on mobile */
        #globe-fade {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 80px;
            background: linear-gradient(to top, #050b14, transparent);
            pointer-events: none;
            z-index: 2;
        }
        @media (min-width: 1024px) { #globe-fade { display: none; } }
    </style>

    <!-- ═══════════════════════════════════════════════════════
         GLOBE — single container, visible on all screen sizes
    ═══════════════════════════════════════════════════════ -->
    <div id="globe-wrapper">
        <div id="globe-container"></div>
        <div id="globe-fade"></div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         HEADER TEXT
    ═══════════════════════════════════════════════════════ -->
    <div class="relative lg:absolute lg:inset-x-0 lg:top-0 z-10 text-center pt-5 sm:pt-8 pb-3 sm:pb-5 lg:pt-10 flex flex-col items-center px-4">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-900/30 border border-blue-500/30 rounded-full backdrop-blur-md mb-3 shadow-lg">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse shadow-[0_0_8px_#22d3ee] shrink-0"></span>
            <span class="text-cyan-400 font-mono text-[9px] sm:text-[10px] font-bold tracking-[0.2em] uppercase">Live Threat Intelligence</span>
        </div>
        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black tracking-tight text-white mb-1 sm:mb-2">
            Peta Ancaman <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">Siber Jatim</span>
        </h2>
        <p class="text-gray-400 font-medium text-xs sm:text-sm max-w-xl px-2 hidden sm:block">
            Monitoring serangan siber terhadap infrastruktur digital Pemerintah Provinsi Jawa Timur secara waktu nyata.
        </p>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         MOBILE: Stats Cards (shown below globe on mobile)
    ═══════════════════════════════════════════════════════ -->
    <div id="mobile-stats" class="relative z-10 px-4 sm:px-6 py-4 grid-cols-2 sm:grid-cols-4 gap-3">
        <div class="bg-[#0a1122]/95 border border-slate-700/80 rounded-2xl p-4 flex flex-col gap-1.5">
            <div class="flex items-center gap-1.5 font-mono text-[9px] text-gray-400 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse shrink-0"></span>
                Live Attacks
            </div>
            <div class="font-display text-2xl sm:text-3xl font-black text-white tracking-tighter leading-none" id="live-attack-count-mobile">104.001</div>
        </div>
        <div class="bg-[#0a1122]/95 border border-slate-700/80 rounded-2xl p-4 flex flex-col gap-1.5">
            <div class="flex items-center gap-1.5 font-mono text-[9px] text-orange-400 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full shrink-0"></span>
                Top Attack
            </div>
            <div class="font-mono text-xs font-bold text-white truncate" id="mobile-top-attack">SQL Injection</div>
        </div>
        <div class="bg-[#0a1122]/95 border border-slate-700/80 rounded-2xl p-4 flex flex-col gap-1.5">
            <div class="flex items-center gap-1.5 font-mono text-[9px] text-cyan-400 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-cyan-500 rounded-full shrink-0"></span>
                Sumber
            </div>
            <div class="font-mono text-xs font-bold text-white truncate" id="mobile-top-country">🇨🇳 China</div>
        </div>
        <div class="bg-[#0a1122]/95 border border-emerald-700/50 rounded-2xl p-4 flex flex-col gap-1.5">
            <div class="flex items-center gap-1.5 font-mono text-[9px] text-emerald-400 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse shrink-0"></span>
                Sistem
            </div>
            <div class="font-mono text-xs font-bold text-emerald-400">ONLINE</div>
        </div>
    </div>

    <!-- Mobile: Vulnerability List -->
    <div class="lg:hidden relative z-10 px-4 sm:px-6 pb-4">
        <div class="bg-[#0a1122]/95 border border-slate-700/80 rounded-2xl p-4">
            <h4 class="font-mono text-[10px] font-bold text-white uppercase tracking-widest mb-3 flex items-center gap-2 border-b border-slate-700/60 pb-2.5">
                <div class="p-1 bg-cyan-900/40 rounded text-cyan-400">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                </div>
                Aduan Kerentanan Sistem
            </h4>
            <ul class="space-y-2 font-mono text-xs text-gray-300">
                @if(isset($topKerentanan) && $topKerentanan->count() > 0)
                    @foreach($topKerentanan->take(4) as $i => $rentan)
                    <li class="clean-list-item flex justify-between items-center">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="font-bold text-gray-500 w-3 shrink-0 text-[9px]">{{ $i+1 }}.</span>
                            <span class="truncate">{{ $rentan->nama_kerentanan }}</span>
                        </div>
                        <span class="font-bold text-cyan-400 shrink-0 ml-2">{{ number_format($rentan->jumlah, 0, ',', '.') }}</span>
                    </li>
                    @endforeach
                @else
                    <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[9px] font-bold text-gray-500 w-3">1.</span><span>Information Disclosure</span></div><span class="font-bold text-cyan-400 ml-2">142</span></li>
                    <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[9px] font-bold text-gray-500 w-3">2.</span><span>Cross-Site Scripting</span></div><span class="font-bold text-cyan-400 ml-2">98</span></li>
                    <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[9px] font-bold text-gray-500 w-3">3.</span><span>IDOR</span></div><span class="font-bold text-cyan-400 ml-2">75</span></li>
                    <li class="flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[9px] font-bold text-gray-500 w-3">4.</span><span>SQL Injection</span></div><span class="font-bold text-cyan-400 ml-2">42</span></li>
                @endif
            </ul>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         DESKTOP: Floating Side Widgets
    ═══════════════════════════════════════════════════════ -->
    <div id="desktop-widgets" class="absolute inset-0 z-10 flex-row justify-between items-start px-8 xl:px-12 pointer-events-none pt-36 pb-24">

        <!-- LEFT -->
        <div class="w-[300px] xl:w-[340px] flex flex-col gap-5 pointer-events-auto">
            <div class="bg-[#0a1122]/80 border border-slate-700/80 p-5 xl:p-6 rounded-2xl backdrop-blur-xl shadow-2xl relative overflow-hidden hover:border-blue-500/50 transition-colors">
                <div class="absolute -top-10 -right-10 w-28 h-28 bg-red-500/10 rounded-full blur-3xl"></div>
                <div class="flex items-center justify-between mb-3 relative z-10">
                    <div class="flex items-center gap-2">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                        </span>
                        <span class="font-mono text-[10px] text-gray-400 font-bold tracking-widest uppercase">Live Attack Count</span>
                    </div>
                    <span class="font-mono text-[9px] bg-blue-900/50 text-blue-400 px-2 py-1 rounded border border-blue-800/50 uppercase font-bold tracking-wider">24 Jam</span>
                </div>
                <h3 class="text-5xl xl:text-6xl font-black text-white tracking-tighter relative z-10" id="live-attack-count">104.001</h3>
            </div>

            <div class="bg-[#0a1122]/80 border border-slate-700/80 p-5 xl:p-6 rounded-2xl backdrop-blur-xl shadow-2xl hover:border-blue-500/50 transition-colors flex-grow">
                <h4 class="font-mono text-[10px] text-white font-bold tracking-wider mb-4 flex items-center gap-2 uppercase border-b border-slate-700/80 pb-3">
                    <div class="p-1.5 bg-cyan-900/40 rounded text-cyan-400"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg></div>
                    Aduan Kerentanan
                </h4>
                <ul class="space-y-3 font-mono text-xs text-gray-300">
                    @if(isset($topKerentanan) && $topKerentanan->count() > 0)
                        @foreach($topKerentanan as $i => $rentan)
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default">
                            <div class="flex items-center gap-2 min-w-0"><span class="font-bold text-gray-500 w-4 shrink-0 text-[10px]">{{ $i+1 }}.</span><span class="truncate max-w-[150px] xl:max-w-[180px]" title="{{ $rentan->nama_kerentanan }}">{{ $rentan->nama_kerentanan }}</span></div>
                            <span class="font-bold text-cyan-400 shrink-0 ml-2">{{ number_format($rentan->jumlah, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    @else
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default"><div class="flex items-center gap-2"><span class="text-[10px] font-bold text-gray-500 w-4">1.</span><span>Information Disclosure</span></div><span class="font-bold text-cyan-400 ml-2">142</span></li>
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default"><div class="flex items-center gap-2"><span class="text-[10px] font-bold text-gray-500 w-4">2.</span><span>Cross-Site Scripting</span></div><span class="font-bold text-cyan-400 ml-2">98</span></li>
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default"><div class="flex items-center gap-2"><span class="text-[10px] font-bold text-gray-500 w-4">3.</span><span>Insecure Direct Object</span></div><span class="font-bold text-cyan-400 ml-2">75</span></li>
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default"><div class="flex items-center gap-2"><span class="text-[10px] font-bold text-gray-500 w-4">4.</span><span>SQL Injection</span></div><span class="font-bold text-cyan-400 ml-2">42</span></li>
                        <li class="flex justify-between items-center hover:text-white transition-colors cursor-default"><div class="flex items-center gap-2"><span class="text-[10px] font-bold text-gray-500 w-4">5.</span><span>Business Logic Error</span></div><span class="font-bold text-cyan-400 ml-2">21</span></li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="w-[280px] xl:w-[310px] flex flex-col gap-4 pointer-events-auto">
            <div class="bg-[#0a1122]/80 border border-slate-700/80 p-4 xl:p-5 rounded-2xl backdrop-blur-md shadow-xl hover:border-orange-500/50 transition-colors">
                <h4 class="font-mono text-[10px] text-white font-bold tracking-wider mb-3 flex items-center gap-2 uppercase border-b border-slate-700/80 pb-2.5">
                    <div class="p-1.5 bg-orange-900/40 rounded text-orange-500"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg></div>
                    Top Jenis Serangan
                </h4>
                <ul id="top-attacks-list" class="space-y-2 font-mono text-[11px] text-gray-300">
                    <li class="clean-list-item flex justify-between"><span>Loading...</span><span class="text-red-400">-</span></li>
                </ul>
            </div>

            <div class="bg-[#0a1122]/80 border border-slate-700/80 p-4 xl:p-5 rounded-2xl backdrop-blur-md shadow-xl hover:border-cyan-500/50 transition-colors">
                <h4 class="font-mono text-[10px] text-white font-bold tracking-wider mb-3 flex items-center gap-2 uppercase border-b border-slate-700/80 pb-2.5">
                    <div class="p-1.5 bg-blue-900/40 rounded text-blue-400"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                    Negara Sumber
                </h4>
                <ul id="top-countries-list" class="space-y-2 font-mono text-[11px] text-gray-300">
                    <li class="clean-list-item flex justify-between"><span>Loading...</span><span class="text-cyan-400">-</span></li>
                </ul>
            </div>

            <div class="bg-[#0a1122]/80 border border-slate-700/80 p-4 xl:p-5 rounded-2xl backdrop-blur-md shadow-xl hover:border-red-500/50 transition-colors">
                <h4 class="font-mono text-[10px] text-white font-bold tracking-wider mb-3 flex items-center gap-2 uppercase border-b border-slate-700/80 pb-2.5">
                    <div class="p-1.5 bg-red-900/40 rounded text-red-400"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg></div>
                    Top IP Penyerang
                </h4>
                <ul id="top-ips-list" class="space-y-2 font-mono text-[11px] text-gray-300">
                    <li class="clean-list-item flex justify-between"><span>Loading...</span><span class="text-red-400">-</span></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         ALERT PILL
    ═══════════════════════════════════════════════════════ -->
    <div class="relative lg:absolute lg:bottom-14 lg:left-1/2 lg:-translate-x-1/2 z-20 flex justify-center pb-3 lg:pb-0 px-4">
        <div id="latest-alert-pill" class="bg-[#0a1122]/95 border border-slate-700/80 backdrop-blur-md px-4 sm:px-5 py-2 rounded-full flex items-center gap-2 sm:gap-3 shadow-[0_0_15px_rgba(0,0,0,0.5)] max-w-[95vw] overflow-hidden">
            <span class="relative flex h-2 w-2 sm:h-2.5 sm:w-2.5 shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-full w-full bg-orange-500"></span>
            </span>
            <span class="font-mono text-[9px] sm:text-[10px] text-gray-300 truncate">
                <span class="text-orange-400 font-bold">Memulai Sistem...</span>
                &nbsp;|&nbsp; 🌐 Menghubungkan &rarr; <span class="text-cyan-400 font-bold">JatimProv</span>
            </span>
            <span class="bg-blue-500/20 text-blue-400 border border-blue-500/30 font-mono text-[8px] sm:text-[9px] px-1.5 sm:px-2 py-0.5 rounded font-bold uppercase tracking-widest shrink-0">INFO</span>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         BOTTOM FEED MARQUEE
    ═══════════════════════════════════════════════════════ -->
    <div class="relative lg:absolute lg:bottom-0 lg:left-0 lg:right-0 z-20 w-full bg-[#050b14]/95 border-t border-slate-800/80 py-2 overflow-hidden flex whitespace-nowrap font-mono text-[10px] sm:text-[11px] text-gray-400">
        <div class="animate-marquee-map inline-block whitespace-nowrap">
            <span class="mx-4 sm:mx-6"><span class="text-red-500 mr-1.5 font-bold animate-pulse">●</span> SQL Injection dari 82.197.69.49 → JatimProv <span class="bg-red-500/20 text-red-400 border border-red-500/30 px-1 py-0.5 rounded ml-1 text-[8px] font-bold">CRITICAL</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-orange-500 mr-1.5 font-bold animate-pulse">●</span> Reconnaissance dari 165.22.221.124 → Diskominfo <span class="bg-orange-500/20 text-orange-400 border border-orange-500/30 px-1 py-0.5 rounded ml-1 text-[8px] font-bold">HIGH</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-red-500 mr-1.5 font-bold animate-pulse">●</span> DDoS Attempt dari 145.110.242.20 → Server Utama <span class="bg-red-500/20 text-red-400 border border-red-500/30 px-1 py-0.5 rounded ml-1 text-[8px] font-bold">CRITICAL</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-yellow-500 mr-1.5 font-bold animate-pulse">●</span> Brute Force SSH dari 103.111.42.11 → DB Server <span class="bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 px-1 py-0.5 rounded ml-1 text-[8px] font-bold">MEDIUM</span></span>
            {{-- duplicate for seamless loop --}}
            <span class="mx-4 sm:mx-6"><span class="text-red-500 mr-1.5 font-bold animate-pulse">●</span> SQL Injection dari 82.197.69.49 → JatimProv <span class="bg-red-500/20 text-red-400 border border-red-500/30 px-1 py-0.5 rounded ml-1 text-[8px] font-bold">CRITICAL</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-orange-500 mr-1.5 font-bold animate-pulse">●</span> Reconnaissance dari 165.22.221.124 → Diskominfo <span class="bg-orange-500/20 text-orange-400 border border-orange-500/30 px-1 py-0.5 rounded ml-1 text-[8px] font-bold">HIGH</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-red-500 mr-1.5 font-bold animate-pulse">●</span> DDoS Attempt dari 145.110.242.20 → Server Utama <span class="bg-red-500/20 text-red-400 border border-red-500/30 px-1 py-0.5 rounded ml-1 text-[8px] font-bold">CRITICAL</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-yellow-500 mr-1.5 font-bold animate-pulse">●</span> Brute Force SSH dari 103.111.42.11 → DB Server <span class="bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 px-1 py-0.5 rounded ml-1 text-[8px] font-bold">MEDIUM</span></span>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         SCRIPTS
    ═══════════════════════════════════════════════════════ -->
    <script src="https://unpkg.com/three"></script>
    <script src="https://unpkg.com/globe.gl"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        /* ── Single container, adapts to CSS-set size ── */
        const container = document.getElementById('globe-container');
        if (!container || typeof Globe === 'undefined') return;

        const isDesktop   = window.innerWidth >= 1024;
        const targetJatim = { lat: -7.2504, lng: 112.7688 };

        /* Camera altitude: zoom out more on mobile */
        const altitudeFinal   = isDesktop ? 1.8 : 2.6;
        const altitudeInitial = isDesktop ? 2.2 : 3.2;
        const rotateSpeed     = isDesktop ? 0.5 : 0.3;

        /* ── Globe init ── */
        const myGlobe = Globe({ animateIn: true })(container)
            .globeImageUrl('https://unpkg.com/three-globe/example/img/earth-dark.jpg')
            .bumpImageUrl('https://unpkg.com/three-globe/example/img/earth-topology.png')
            .backgroundImageUrl('https://unpkg.com/three-globe/example/img/night-sky.png')
            .backgroundColor('rgba(5,11,20,1)')
            .showAtmosphere(true)
            .atmosphereColor('#0ea5e9')
            .atmosphereAltitude(0.12)
            .width(container.clientWidth)
            .height(container.clientHeight);

        /* ── Jatim marker ── */
        const markerEl = document.createElement('div');
        markerEl.style.pointerEvents = 'none';
        markerEl.innerHTML = `
            <div style="position:relative;display:flex;align-items:center;gap:5px;transform:translate(-4px,-4px)">
                <span style="position:relative;display:inline-flex;width:8px;height:8px">
                    <span style="position:absolute;inset:0;border-radius:9999px;background:#22d3ee;animation:ping 1s cubic-bezier(0,0,0.2,1) infinite;opacity:0.75"></span>
                    <span style="position:relative;display:inline-flex;width:8px;height:8px;border-radius:9999px;background:#22d3ee;box-shadow:0 0 8px #22d3ee"></span>
                </span>
                <span style="font-size:${isDesktop ? 12 : 10}px;font-family:sans-serif;font-weight:700;color:#cffafe;text-shadow:0 0 8px rgba(0,0,0,1)">Jatim</span>
            </div>`;

        myGlobe
            .htmlElementsData([{ lat: targetJatim.lat, lng: targetJatim.lng }])
            .htmlElement(() => markerEl)
            .htmlAltitude(0.02);

        myGlobe.pointOfView({ lat: -5, lng: 113, altitude: altitudeInitial }, 0);
        setTimeout(() => myGlobe.pointOfView({ lat: -5, lng: 113, altitude: altitudeFinal }, 3000), 200);

        myGlobe
            .arcDashLength(0.4).arcDashGap(0.15)
            .arcDashAnimateTime(1500).arcStroke(1.2)
            .ringColor(d => d.color).ringMaxRadius(4)
            .ringPropagationSpeed(2).ringRepeatPeriod(0);

        myGlobe.controls().autoRotate      = true;
        myGlobe.controls().autoRotateSpeed  = rotateSpeed;
        myGlobe.controls().enableZoom       = true;
        myGlobe.controls().minDistance = 120;
        myGlobe.controls().maxDistance = 500;

        /* ── Attack simulation ── */
        const COUNTRIES  = [
            { name:'India',     flag:'🇮🇳', lat:20.59,  lng:78.96  },
            { name:'China',     flag:'🇨🇳', lat:35.86,  lng:104.19 },
            { name:'USA',       flag:'🇺🇸', lat:37.09,  lng:-95.71 },
            { name:'Rusia',     flag:'🇷🇺', lat:61.52,  lng:105.32 },
            { name:'Singapore', flag:'🇸🇬', lat:1.35,   lng:103.82 },
        ];
        const ATTACKS = [
            { name:'SQL Injection',        severity:'CRITICAL' },
            { name:'Reconnaissance',       severity:'HIGH'     },
            { name:'Cross-Site Scripting', severity:'HIGH'     },
            { name:'DDoS Attempt',         severity:'CRITICAL' },
        ];
        let activeAttacks = [], activeRings = [];

        const rand = arr => arr[Math.floor(Math.random() * arr.length)];

        function fireAttack() {
            const c = rand(COUNTRIES), a = rand(ATTACKS);
            const color = a.severity === 'CRITICAL' ? '#ef4444' : '#f97316';
            const arc = {
                startLat: c.lat + (Math.random()-0.5)*5,
                startLng: c.lng + (Math.random()-0.5)*5,
                endLat:   targetJatim.lat + (Math.random()-0.5)*1.5,
                endLng:   targetJatim.lng + (Math.random()-0.5)*1.5,
                color,
            };
            activeAttacks.push(arc);
            if (activeAttacks.length > 12) activeAttacks.shift();

            myGlobe.arcsData(activeAttacks)
                .arcStartLat(d=>d.startLat).arcStartLng(d=>d.startLng)
                .arcEndLat(d=>d.endLat).arcEndLng(d=>d.endLng)
                .arcColor(d=>['rgba(255,255,255,0)', d.color]);

            setTimeout(() => {
                activeRings.push({ lat: arc.endLat, lng: arc.endLng, color });
                if (activeRings.length > 5) activeRings.shift();
                myGlobe.ringsData(activeRings);
            }, 1500);

            /* Update both counters */
            ['live-attack-count','live-attack-count-mobile'].forEach(id => {
                const el = document.getElementById(id);
                if (!el) return;
                const cur = parseInt(el.innerText.replace(/[\.,]/g,'')) || 104001;
                el.innerText = (cur + Math.floor(Math.random()*10)+1).toLocaleString('id-ID');
            });

            /* Mobile quick stats */
            const ma = document.getElementById('mobile-top-attack');
            const mc = document.getElementById('mobile-top-country');
            if (ma) ma.innerText = a.name;
            if (mc) mc.innerText = c.flag + ' ' + c.name;

            /* Alert pill */
            const pill = document.getElementById('latest-alert-pill');
            if (!pill) return;
            const sc = (a.severity === 'CRITICAL' || a.severity === 'HIGH')
                ? { t:'text-red-400', bg:'bg-red-500/20', b:'border-red-500/30' }
                : { t:'text-yellow-400', bg:'bg-yellow-500/20', b:'border-yellow-500/30' };
            pill.innerHTML = `
                <span class="relative flex h-2 w-2 sm:h-2.5 sm:w-2.5 shrink-0">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-full w-full bg-orange-500"></span>
                </span>
                <span class="font-mono text-[9px] sm:text-[10px] text-gray-300 truncate">
                    <span class="text-orange-400 font-bold">${a.name}</span>
                    &nbsp;|&nbsp; ${c.flag} ${c.name} &nbsp;&rarr;&nbsp;
                    <span class="text-cyan-400 font-bold">JatimProv</span>
                </span>
                <span class="${sc.bg} ${sc.t} ${sc.b} border font-mono text-[8px] sm:text-[9px] px-1.5 sm:px-2 py-0.5 rounded font-bold uppercase tracking-widest shrink-0">${a.severity}</span>`;
        }

        /* ── API poll + fallback ── */
        const updList = (id, data, gen) => {
            const el = document.getElementById(id);
            if (!el || !data?.length) return;
            el.innerHTML = data.map((item,i) => gen(item,i)).join('');
        };

        setInterval(() => {
            fetch('/api/threat-data')
                .then(r => { if (r.ok) return r.json(); throw new Error(); })
                .then(d => {
                    if (d.total_attacks) {
                        ['live-attack-count','live-attack-count-mobile'].forEach(id => {
                            const el = document.getElementById(id);
                            if (el) el.innerText = d.total_attacks.toLocaleString('id-ID');
                        });
                    }
                    updList('top-attacks-list', d.top_attacks, (item,i) => `
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default">
                            <div class="flex items-center gap-2 min-w-0"><span class="text-[9px] font-bold text-gray-500 w-4 shrink-0">${i+1}.</span><span class="truncate">${item.name}</span></div>
                            <span class="font-bold shrink-0 ml-2 ${i===0?'text-red-400':i===1?'text-orange-400':'text-yellow-400'}">${item.count.toLocaleString('id-ID')}</span>
                        </li>`);
                    updList('top-countries-list', d.top_countries, (item,i) => `
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default">
                            <div class="flex items-center gap-2 min-w-0"><span class="text-[9px] font-bold text-gray-500 w-4 shrink-0">${i+1}.</span><span class="truncate">${item.flag} ${item.name}</span></div>
                            <span class="font-bold text-cyan-400 shrink-0 ml-2">${item.count.toLocaleString('id-ID')}</span>
                        </li>`);
                    updList('top-ips-list', d.top_ips, (item,i) => `
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default">
                            <div class="flex items-center gap-2 min-w-0"><span class="text-[9px] font-bold text-gray-500 w-4 shrink-0">${i+1}.</span><span class="truncate">${item.address}</span></div>
                            <span class="font-bold shrink-0 ml-2 ${i===0?'text-red-400':'text-orange-400'}">${item.count.toLocaleString('id-ID')}</span>
                        </li>`);
                    if (d.recent_attacks?.length) {
                        d.recent_attacks.forEach(a => {
                            const arc = { startLat:a.source_lat, startLng:a.source_lng,
                                endLat:targetJatim.lat+(Math.random()-.5)*1.5,
                                endLng:targetJatim.lng+(Math.random()-.5)*1.5,
                                color:a.severity==='high'?'#ef4444':a.severity==='medium'?'#f97316':'#0ea5e9' };
                            activeAttacks.push(arc); if(activeAttacks.length>12) activeAttacks.shift();
                            myGlobe.arcsData(activeAttacks).arcStartLat(d=>d.startLat).arcStartLng(d=>d.startLng)
                                .arcEndLat(d=>d.endLat).arcEndLng(d=>d.endLng).arcColor(d=>['rgba(255,255,255,0)',d.color]);
                            setTimeout(()=>{ activeRings.push({lat:arc.endLat,lng:arc.endLng,color:arc.color}); if(activeRings.length>5) activeRings.shift(); myGlobe.ringsData(activeRings); },1500);
                        });
                    } else { fireAttack(); }
                })
                .catch(fireAttack);
        }, 3000);

        setTimeout(fireAttack, 500);

        /* ── Resize ── */
        let rTimer;
        window.addEventListener('resize', () => {
            clearTimeout(rTimer);
            rTimer = setTimeout(() => {
                myGlobe.width(container.clientWidth).height(container.clientHeight);
            }, 150);
        }, { passive: true });
    });
    </script>
</section>