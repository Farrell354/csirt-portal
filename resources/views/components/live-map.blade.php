{{--
    LIVE MAP COMPONENT — Komdigi-CSIRT Style Cyber Threat Intelligence Map (60 FPS Ultra-Smooth Edition)
    - Mobile (<lg): Stacked — Header → Quick Stats → Realistic 3D Night Globe + Controls → Analytics Cards
    - Desktop (≥lg): Full-screen 3D WebGL Realistic Night Earth (GPU-Optimized Textures + Per-Province Indonesia + Inertial Camera Damping)
--}}
<section class="relative w-full overflow-hidden bg-[#030814] border-y border-cyan-500/25 text-white font-sans select-none" id="live-map-section">

    <style>
        /* ── Scrollbar ── */
        .map-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
        .map-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .map-scrollbar::-webkit-scrollbar-thumb { background: rgba(14, 165, 233, 0.4); border-radius: 10px; }

        /* ── List separator ── */
        .clean-list-item { border-bottom: 1px solid rgba(30, 58, 138, 0.28); padding-bottom: 0.5rem; margin-bottom: 0.5rem; }
        .clean-list-item:last-child { border-bottom: none; padding-bottom: 0; margin-bottom: 0; }

        /* ── Hardware-Accelerated Marquee ── */
        @keyframes marquee-map { 0% { transform: translate3d(0,0,0); } 100% { transform: translate3d(-50%,0,0); } }
        .animate-marquee-map {
            animation: marquee-map 38s linear infinite;
            will-change: transform;
        }
        .animate-marquee-map:hover { animation-play-state: paused; }

        /* ── HUD Grid & Radial Vignette Overlay ── */
        .hud-grid-bg {
            background-image:
                radial-gradient(circle at 50% 52%, rgba(14, 165, 233, 0.15) 0%, rgba(3, 8, 20, 0.88) 65%),
                linear-gradient(to right, rgba(6, 182, 212, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(6, 182, 212, 0.04) 1px, transparent 1px);
            background-size: 100% 100%, 38px 38px, 38px 38px;
        }

        /* ── Smooth Row Slide & Flash on New Telemetry ── */
        @keyframes rowFlash {
            0%   { background-color: rgba(6, 182, 212, 0.24); opacity: 0.4; transform: translateY(-4px); }
            100% { background-color: transparent; opacity: 1; transform: translateY(0); }
        }
        .telemetry-row-new {
            animation: rowFlash 0.45s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* ── Ultra-Smooth GPU-Accelerated Province HUD Card & 3D Marker Entrance ── */
        #selected-province-hud {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translate3d(-50%, 22px, 0) scale(0.95);
            transition:
                opacity 0.48s cubic-bezier(0.16, 1, 0.3, 1),
                transform 0.48s cubic-bezier(0.16, 1, 0.3, 1),
                visibility 0.48s;
            will-change: transform, opacity;
        }
        #selected-province-hud.prov-hud-active {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translate3d(-50%, 0, 0) scale(1);
        }
        @keyframes markerPopIn {
            0%   { opacity: 0; transform: translate(-6px, -2px) scale(0.75); }
            100% { opacity: 1; transform: translate(-6px, -12px) scale(1); }
        }

        /* ─────────────────────────────────────────
           MOBILE (<1024px): stacked layout
        ───────────────────────────────────────── */
        #globe-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 70vw;
            min-height: 310px;
            max-height: 450px;
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
            #live-map-section { height: 100vh; min-height: 790px; max-height: 1080px; }

            #globe-wrapper {
                position: absolute;
                inset: 0;
                height: auto;
                max-height: none;
                pointer-events: auto;
                cursor: grab;
            }
            #globe-wrapper:active { cursor: grabbing; }

            #desktop-widgets { display: flex; }
            #mobile-stats    { display: none; }
        }

        /* Fade overlay at bottom of globe on mobile */
        #globe-fade {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 80px;
            background: linear-gradient(to top, #030814, transparent);
            pointer-events: none;
            z-index: 2;
        }
        @media (min-width: 1024px) { #globe-fade { display: none; } }
    </style>

    <!-- Subtle Cyber HUD Grid & Radial Glow Overlay -->
    <div class="absolute inset-0 hud-grid-bg pointer-events-none z-0" aria-hidden="true"></div>

    <!-- ═══════════════════════════════════════════════════════
         GLOBE — single container, visible on all screen sizes
    ═══════════════════════════════════════════════════════ -->
    <div id="globe-wrapper">
        <div id="globe-container"></div>
        <div id="globe-fade"></div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         HEADER TEXT, DEMO BADGE & GLOBE CONTROLS DOCK
    ═══════════════════════════════════════════════════════ -->
    <div class="relative lg:absolute lg:inset-x-0 lg:top-0 z-20 text-center pt-5 sm:pt-7 pb-3 sm:pb-4 lg:pt-6 flex flex-col items-center px-4 pointer-events-none">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-950/60 border border-cyan-500/30 rounded-full backdrop-blur-md mb-2 shadow-[0_0_20px_rgba(6,182,212,0.15)] pointer-events-auto">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse shadow-[0_0_8px_#22d3ee] shrink-0"></span>
            <span class="text-cyan-400 font-mono text-[9px] sm:text-[10px] font-bold tracking-[0.2em] uppercase">Live Threat Intelligence</span>
            <span class="text-amber-300 font-mono text-[9px] sm:text-[10px] font-bold tracking-[0.2em] uppercase border border-amber-400/40 bg-amber-400/10 rounded-full px-2 py-0.5">Demo</span>
        </div>
        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-4xl xl:text-5xl font-black tracking-tight text-white mb-1.5">
            Peta Ancaman <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-sky-400 to-blue-500">Siber Real-Time</span>
        </h2>
        <p class="text-gray-300/90 font-medium text-xs sm:text-sm max-w-2xl px-2 hidden sm:block leading-relaxed">
            Visualisasi pemantauan lalu lintas ancaman siber (24 Jam Terakhir) yang mengarah ke infrastruktur digital Pemerintah Provinsi Jawa Timur.
        </p>

        <!-- Interactive Globe Navigation & Night Earth Texture Controls (Stacked cleanly below subtitle) -->
        <div class="mt-3 flex flex-wrap items-center justify-center gap-1.5 bg-[#071022]/90 border border-cyan-500/30 backdrop-blur-md px-3 py-1.5 rounded-full shadow-[0_0_25px_rgba(6,182,212,0.18)] pointer-events-auto">
            <button type="button" id="btn-focus-jatim" class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 hover:bg-emerald-500/30 transition-colors flex items-center gap-1.5" title="Perbesar ke Peta Provinsi Indonesia & Jawa Timur">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                Fokus Jatim &amp; RI
            </button>
            <button type="button" id="btn-view-global" class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider text-gray-300 hover:text-white hover:bg-slate-800/80 transition-colors" title="Tampilan Global">
                Global
            </button>
            <span class="h-3.5 w-px bg-slate-700/80 mx-0.5"></span>
            <button type="button" id="btn-mode-texture" class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-blue-500/20 text-sky-300 border border-sky-500/30 hover:bg-blue-500/30 transition-colors flex items-center gap-1" title="Ganti Tekstur Bumi (Bumi Malam / Bumi Siang / Vektor Siber)">
                <span>🌙</span>
                <span id="texture-mode-label">Mode: Bumi Malam</span>
            </button>
            <button type="button" id="btn-toggle-clouds" class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider text-sky-300 hover:bg-slate-800/80 transition-colors hidden sm:flex items-center gap-1" title="Tampilkan / Sembunyikan Lapisan Awan 3D">
                <span>☁️</span>
                <span id="clouds-label">Awan: ON</span>
            </button>
            <span class="h-3.5 w-px bg-slate-700/80 mx-0.5 hidden sm:inline"></span>
            <button type="button" id="btn-toggle-rotate" class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider text-emerald-400 hover:bg-slate-800/80 transition-colors flex items-center gap-1" title="Jeda / Putar Rotasi Globe">
                <span id="rotate-icon">⏸</span>
                <span id="rotate-label" class="hidden sm:inline">Rotasi</span>
            </button>
            <button type="button" id="btn-zoom-in" class="w-6 h-6 rounded-full text-xs font-mono font-bold text-gray-300 hover:text-white hover:bg-slate-800/80 transition-colors flex items-center justify-center" title="Perbesar (+)">+</button>
            <button type="button" id="btn-zoom-out" class="w-6 h-6 rounded-full text-xs font-mono font-bold text-gray-300 hover:text-white hover:bg-slate-800/80 transition-colors flex items-center justify-center" title="Perkecil (−)">−</button>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         MOBILE: Stats Cards & Panels (<1024px)
    ═══════════════════════════════════════════════════════ -->
    <div id="mobile-stats" class="relative z-10 px-4 sm:px-6 py-4 grid-cols-2 sm:grid-cols-4 gap-3">
        <div class="bg-[#081021]/95 border border-slate-700/80 rounded-2xl p-3.5 flex flex-col gap-1">
            <div class="flex items-center gap-1.5 font-mono text-[9px] text-gray-400 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse shrink-0"></span>
                Serangan (24J)
            </div>
            <div class="font-display text-2xl font-black text-white tracking-tighter leading-none" id="live-attack-count-mobile">148.290</div>
        </div>
        <div class="bg-[#081021]/95 border border-slate-700/80 rounded-2xl p-3.5 flex flex-col gap-1">
            <div class="flex items-center gap-1.5 font-mono text-[9px] text-orange-400 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full shrink-0"></span>
                Top Serangan
            </div>
            <div class="font-mono text-xs font-bold text-white truncate" id="mobile-top-attack">SQL Injection (SQLi)</div>
        </div>
        <div class="bg-[#081021]/95 border border-slate-700/80 rounded-2xl p-3.5 flex flex-col gap-1">
            <div class="flex items-center gap-1.5 font-mono text-[9px] text-cyan-400 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-cyan-500 rounded-full shrink-0"></span>
                Negara Sumber
            </div>
            <div class="font-mono text-xs font-bold text-white truncate" id="mobile-top-country">🇨🇳 China</div>
        </div>
        <div class="bg-[#081021]/95 border border-emerald-700/50 rounded-2xl p-3.5 flex flex-col gap-1">
            <div class="flex items-center gap-1.5 font-mono text-[9px] text-emerald-400 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse shrink-0"></span>
                Mitigasi WAF
            </div>
            <div class="font-mono text-xs font-bold text-emerald-400">99,8% BLOCKED</div>
        </div>
    </div>

    <!-- Mobile: Top Jenis Serangan & Aduan Kerentanan -->
    <div class="lg:hidden relative z-10 px-4 sm:px-6 pb-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div class="bg-[#081021]/95 border border-slate-700/80 rounded-2xl p-4">
            <h4 class="font-mono text-[10px] font-bold text-white uppercase tracking-widest mb-3 flex items-center justify-between border-b border-slate-700/60 pb-2">
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                    Top Jenis Serangan (24J)
                </span>
                <span class="text-[9px] text-orange-400">LIVE</span>
            </h4>
            <ul id="mobile-top-attacks-list" class="space-y-2.5 font-mono text-xs text-gray-300"></ul>
        </div>

        <div class="bg-[#081021]/95 border border-slate-700/80 rounded-2xl p-4">
            <h4 class="font-mono text-[10px] font-bold text-white uppercase tracking-widest mb-3 flex items-center justify-between border-b border-slate-700/60 pb-2">
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                    Aduan Kerentanan VDP
                </span>
                <span class="text-[9px] text-cyan-400">VALID</span>
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
                    <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[9px] font-bold text-gray-500 w-3">1.</span><span>SQL Injection (SQLi)</span></div><span class="font-bold text-cyan-400 ml-2">142</span></li>
                    <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[9px] font-bold text-gray-500 w-3">2.</span><span>Cross-Site Scripting (XSS)</span></div><span class="font-bold text-cyan-400 ml-2">98</span></li>
                    <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[9px] font-bold text-gray-500 w-3">3.</span><span>Authentication Attack</span></div><span class="font-bold text-cyan-400 ml-2">75</span></li>
                    <li class="flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[9px] font-bold text-gray-500 w-3">4.</span><span>Insecure Direct Object (IDOR)</span></div><span class="font-bold text-cyan-400 ml-2">42</span></li>
                @endif
            </ul>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         DESKTOP: Floating Side Widgets (≥1024px)
    ═══════════════════════════════════════════════════════ -->
    <div id="desktop-widgets" class="absolute inset-0 z-10 flex-row justify-between items-start px-6 xl:px-10 pointer-events-none pt-32 pb-28">

        <!-- ── LEFT HUD COLUMN ── -->
        <div class="w-[310px] xl:w-[350px] flex flex-col gap-3.5 pointer-events-auto">

            <!-- 1. Live Attack Counter & Mitigation Status -->
            <div class="bg-[#081021]/85 border border-slate-700/80 p-4 xl:p-5 rounded-2xl backdrop-blur-xl shadow-2xl relative overflow-hidden hover:border-cyan-500/50 transition-colors">
                <div class="absolute -top-10 -right-10 w-28 h-28 bg-red-500/15 rounded-full blur-3xl"></div>
                <div class="flex items-center justify-between mb-2 relative z-10">
                    <div class="flex items-center gap-2">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                        </span>
                        <span class="font-mono text-[10px] text-gray-300 font-bold tracking-widest uppercase">Total Serangan Siber</span>
                    </div>
                    <span class="font-mono text-[9px] bg-red-950/70 text-red-400 px-2 py-0.5 rounded border border-red-700/50 uppercase font-bold tracking-wider">24 Jam Terakhir</span>
                </div>
                <div class="flex items-baseline justify-between gap-2 relative z-10">
                    <h3 class="text-4xl xl:text-5xl font-black text-white tracking-tighter tabular-nums" id="live-attack-count">148.290</h3>
                    <div class="text-right font-mono">
                        <span class="text-[10px] text-emerald-400 font-bold block">● 99,8% DIMITIGASI</span>
                        <span class="text-[9px] text-gray-400" id="attacks-per-min-label">~64 serangan/mnt</span>
                    </div>
                </div>
            </div>

            <!-- 2. Top Jenis Serangan (Komdigi-CSIRT Style Progress Bars) -->
            <div class="bg-[#081021]/85 border border-slate-700/80 p-4 xl:p-5 rounded-2xl backdrop-blur-xl shadow-2xl hover:border-orange-500/50 transition-colors">
                <h4 class="font-mono text-[10px] text-white font-bold tracking-wider mb-3 flex items-center justify-between uppercase border-b border-slate-700/80 pb-2.5">
                    <span class="flex items-center gap-2">
                        <span class="p-1.5 bg-orange-950/70 border border-orange-500/30 rounded text-orange-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </span>
                        Statistik Jenis Serangan Teratas
                    </span>
                    <span class="text-[9px] text-orange-400 font-mono">24J</span>
                </h4>
                <ul id="top-attacks-list" class="space-y-2.5 font-mono text-[11px] text-gray-300"></ul>
            </div>

            <!-- 3. Aduan Kerentanan Sistem (VDP Validated Reports) -->
            <div class="bg-[#081021]/85 border border-slate-700/80 p-4 xl:p-5 rounded-2xl backdrop-blur-xl shadow-2xl hover:border-cyan-500/50 transition-colors">
                <h4 class="font-mono text-[10px] text-white font-bold tracking-wider mb-3 flex items-center justify-between uppercase border-b border-slate-700/80 pb-2.5">
                    <span class="flex items-center gap-2">
                        <span class="p-1.5 bg-cyan-950/70 border border-cyan-500/30 rounded text-cyan-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </span>
                        Temuan Kerentanan VDP Tervalidasi
                    </span>
                    <span class="text-[9px] text-cyan-400 font-mono">DB RIIL</span>
                </h4>
                <ul class="space-y-2 font-mono text-[11px] text-gray-300">
                    @if(isset($topKerentanan) && $topKerentanan->count() > 0)
                        @foreach($topKerentanan->take(4) as $i => $rentan)
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default">
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="font-bold text-gray-500 w-4 shrink-0 text-[10px]">{{ $i+1 }}.</span>
                                <span class="truncate max-w-[175px] xl:max-w-[205px]" title="{{ $rentan->nama_kerentanan }}">{{ $rentan->nama_kerentanan }}</span>
                            </div>
                            <span class="font-bold text-cyan-400 shrink-0 ml-2">{{ number_format($rentan->jumlah, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    @else
                        <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[10px] font-bold text-gray-500 w-4">1.</span><span>Information Disclosure</span></div><span class="font-bold text-cyan-400 ml-2">142</span></li>
                        <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[10px] font-bold text-gray-500 w-4">2.</span><span>Cross-Site Scripting (XSS)</span></div><span class="font-bold text-cyan-400 ml-2">98</span></li>
                        <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[10px] font-bold text-gray-500 w-4">3.</span><span>Insecure Direct Object (IDOR)</span></div><span class="font-bold text-cyan-400 ml-2">75</span></li>
                        <li class="flex justify-between items-center"><div class="flex items-center gap-2"><span class="text-[10px] font-bold text-gray-500 w-4">4.</span><span>SQL Injection (SQLi)</span></div><span class="font-bold text-cyan-400 ml-2">42</span></li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- ── RIGHT HUD COLUMN ── -->
        <div class="w-[310px] xl:w-[350px] flex flex-col gap-3.5 pointer-events-auto">

            <!-- 1. Negara Sumber Serangan -->
            <div class="bg-[#081021]/85 border border-slate-700/80 p-4 xl:p-5 rounded-2xl backdrop-blur-xl shadow-2xl hover:border-cyan-500/50 transition-colors">
                <h4 class="font-mono text-[10px] text-white font-bold tracking-wider mb-3 flex items-center justify-between uppercase border-b border-slate-700/80 pb-2.5">
                    <span class="flex items-center gap-2">
                        <span class="p-1.5 bg-blue-950/70 border border-blue-500/30 rounded text-blue-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        Negara Sumber Serangan
                    </span>
                    <span class="text-[9px] text-cyan-400 font-mono">ORIGIN</span>
                </h4>
                <ul id="top-countries-list" class="space-y-2.5 font-mono text-[11px] text-gray-300"></ul>
            </div>

            <!-- 2. Top IP Penyerang -->
            <div class="bg-[#081021]/85 border border-slate-700/80 p-4 xl:p-5 rounded-2xl backdrop-blur-xl shadow-2xl hover:border-red-500/50 transition-colors">
                <h4 class="font-mono text-[10px] text-white font-bold tracking-wider mb-3 flex items-center justify-between uppercase border-b border-slate-700/80 pb-2.5">
                    <span class="flex items-center gap-2">
                        <span class="p-1.5 bg-red-950/70 border border-red-500/30 rounded text-red-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                        </span>
                        Top IP Penyerang Terdeteksi
                    </span>
                    <span class="text-[9px] text-red-400 font-mono">HOSTILE</span>
                </h4>
                <ul id="top-ips-list" class="space-y-2 font-mono text-[11px] text-gray-300"></ul>
            </div>

            <!-- 3. Live Attack Feed Table (Real-Time Stream ala Komdigi) -->
            <div class="bg-[#081021]/85 border border-slate-700/80 p-4 rounded-2xl backdrop-blur-xl shadow-2xl hover:border-emerald-500/50 transition-colors">
                <h4 class="font-mono text-[10px] text-white font-bold tracking-wider mb-2.5 flex items-center justify-between uppercase border-b border-slate-700/80 pb-2">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        Log Telemetri Serangan Langsung
                    </span>
                    <span class="text-[9px] text-emerald-400 font-mono">REAL-TIME</span>
                </h4>
                <div class="overflow-hidden">
                    <table class="w-full font-mono text-[10px] text-left">
                        <thead>
                            <tr class="text-gray-500 border-b border-slate-800 uppercase text-[9px]">
                                <th class="pb-1.5 font-semibold">Waktu</th>
                                <th class="pb-1.5 font-semibold">Sumber</th>
                                <th class="pb-1.5 font-semibold">Vektor</th>
                                <th class="pb-1.5 font-semibold text-right">Level</th>
                            </tr>
                        </thead>
                        <tbody id="live-telemetry-tbody" class="divide-y divide-slate-800/60 text-gray-300"></tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         SELECTED PROVINCE ANIMATED HUD CARD (KOMDIGI STYLE)
    ═══════════════════════════════════════════════════════ -->
    <div id="selected-province-hud" class="fixed lg:absolute bottom-24 left-1/2 z-30 w-[92vw] max-w-[460px] bg-[#061226]/95 border border-cyan-400/50 rounded-2xl p-4 backdrop-blur-xl shadow-[0_0_35px_rgba(6,182,212,0.28)]">
        <div class="flex items-start justify-between gap-3 border-b border-slate-700/80 pb-2.5 mb-3">
            <div class="flex items-center gap-2.5 min-w-0">
                <span class="relative flex h-3 w-3 shrink-0">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <div class="min-w-0">
                    <div class="font-mono text-[9px] text-cyan-400 uppercase tracking-widest font-bold" id="hud-prov-subtitle">SEKTOR RADAR PROVINSI TERKUNCI</div>
                    <h4 class="font-sans text-sm sm:text-base font-black text-white truncate" id="hud-prov-title">Provinsi Jawa Timur</h4>
                </div>
            </div>
            <button type="button" id="btn-close-prov-hud" class="px-2 py-1 rounded-lg bg-slate-800/90 hover:bg-red-500/20 text-gray-400 hover:text-red-300 border border-slate-700 hover:border-red-500/40 font-mono text-[10px] font-bold transition-colors shrink-0" title="Tutup & Reset Pandangan">
                ✕ TUTUP
            </button>
        </div>
        <div class="grid grid-cols-3 gap-2 font-mono text-[10px] mb-3">
            <div class="bg-[#0a1930]/90 border border-slate-800 rounded-xl p-2.5">
                <span class="text-gray-400 text-[9px] block uppercase">Insiden (24J)</span>
                <span class="text-cyan-300 font-bold text-sm tabular-nums" id="hud-prov-count">4.820</span>
            </div>
            <div class="bg-[#0a1930]/90 border border-slate-800 rounded-xl p-2.5">
                <span class="text-gray-400 text-[9px] block uppercase">Vektor Dominan</span>
                <span class="text-orange-400 font-bold text-[10px] truncate block" id="hud-prov-vector">SQL Injection</span>
            </div>
            <div class="bg-[#0a1930]/90 border border-slate-800 rounded-xl p-2.5">
                <span class="text-gray-400 text-[9px] block uppercase">Koordinat</span>
                <span class="text-emerald-400 font-bold text-[10px] truncate block" id="hud-prov-coords">-7.53, 112.23</span>
            </div>
        </div>
        <div class="flex items-center justify-between gap-2">
            <div class="flex-grow bg-slate-800/90 h-1.5 rounded-full overflow-hidden">
                <div id="hud-prov-bar" class="bg-gradient-to-r from-emerald-400 via-cyan-400 to-blue-500 h-full rounded-full transition-all duration-500" style="width: 82%"></div>
            </div>
            <button type="button" id="btn-sim-prov-attack" class="px-3 py-1 rounded-full bg-cyan-500/20 hover:bg-cyan-500/30 text-cyan-300 border border-cyan-400/40 font-mono text-[9px] font-bold uppercase tracking-wider transition-colors shrink-0">
                ⚡ Uji Radar Sektor
            </button>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         BOTTOM LIVE ALERT PILL
    ═══════════════════════════════════════════════════════ -->
    <div class="relative lg:absolute lg:bottom-11 lg:left-1/2 lg:-translate-x-1/2 z-20 flex justify-center pb-3 lg:pb-0 px-4 pointer-events-none">
        <div id="latest-alert-pill" class="bg-[#081021]/95 border border-slate-700/80 backdrop-blur-md px-4 sm:px-5 py-2 rounded-full flex items-center gap-2 sm:gap-3 shadow-[0_0_25px_rgba(0,0,0,0.75)] max-w-[95vw] overflow-hidden pointer-events-auto">
            <span class="relative flex h-2 w-2 sm:h-2.5 sm:w-2.5 shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-full w-full bg-red-500"></span>
            </span>
            <span class="font-mono text-[9px] sm:text-[10px] text-gray-300 truncate">
                <span class="text-orange-400 font-bold">SQL Injection (SQLi)</span>
                &nbsp;|&nbsp; 🇨🇳 China (180.243.2.151) &nbsp;&rarr;&nbsp;
                <span class="text-cyan-400 font-bold">sso.jatimprov.go.id</span>
            </span>
            <span class="bg-red-500/20 text-red-400 border border-red-500/30 font-mono text-[8px] sm:text-[9px] px-1.5 sm:px-2 py-0.5 rounded font-bold uppercase tracking-widest shrink-0">CRITICAL</span>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         BOTTOM FEED MARQUEE
    ═══════════════════════════════════════════════════════ -->
    <div class="relative lg:absolute lg:bottom-0 lg:left-0 lg:right-0 z-20 w-full bg-[#030814]/95 border-t border-slate-800/80 py-2 overflow-hidden flex whitespace-nowrap font-mono text-[10px] sm:text-[11px] text-gray-400">
        <div id="marquee-feed-track" class="animate-marquee-map inline-block whitespace-nowrap">
            <span class="mx-4 sm:mx-6"><span class="text-red-500 mr-1.5 font-bold animate-pulse">●</span> [WAF-MITIGATED] SQL Injection (SQLi) dari 180.243.2.151 (🇨🇳 China) &rarr; sso.jatimprov.go.id (HTTPS/443) <span class="bg-red-500/20 text-red-400 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 text-[8px] font-bold">CRITICAL</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-orange-500 mr-1.5 font-bold animate-pulse">●</span> [WAF-MITIGATED] Authentication Attack dari 82.197.69.49 (🇷🇺 Russia) &rarr; simpeg.jatimprov.go.id (HTTPS/443) <span class="bg-orange-500/20 text-orange-400 border border-orange-500/30 px-1.5 py-0.5 rounded ml-1 text-[8px] font-bold">HIGH</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-orange-500 mr-1.5 font-bold animate-pulse">●</span> [WAF-MITIGATED] Cross-Site Scripting (XSS) dari 172.232.238.140 (🇺🇸 USA) &rarr; portal.jatimprov.go.id (HTTPS/443) <span class="bg-orange-500/20 text-orange-400 border border-orange-500/30 px-1.5 py-0.5 rounded ml-1 text-[8px] font-bold">HIGH</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-yellow-500 mr-1.5 font-bold animate-pulse">●</span> [IDS-LOGGED] Reconnaissance / Port Scan dari 165.22.221.124 (🇸🇬 Singapore) &rarr; api.jatimprov.go.id (TCP/Multi) <span class="bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 px-1.5 py-0.5 rounded ml-1 text-[8px] font-bold">MEDIUM</span></span>
            {{-- Duplicate for seamless infinite loop --}}
            <span class="mx-4 sm:mx-6"><span class="text-red-500 mr-1.5 font-bold animate-pulse">●</span> [WAF-MITIGATED] SQL Injection (SQLi) dari 180.243.2.151 (🇨🇳 China) &rarr; sso.jatimprov.go.id (HTTPS/443) <span class="bg-red-500/20 text-red-400 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 text-[8px] font-bold">CRITICAL</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-orange-500 mr-1.5 font-bold animate-pulse">●</span> [WAF-MITIGATED] Authentication Attack dari 82.197.69.49 (🇷🇺 Russia) &rarr; simpeg.jatimprov.go.id (HTTPS/443) <span class="bg-orange-500/20 text-orange-400 border border-orange-500/30 px-1.5 py-0.5 rounded ml-1 text-[8px] font-bold">HIGH</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-orange-500 mr-1.5 font-bold animate-pulse">●</span> [WAF-MITIGATED] Cross-Site Scripting (XSS) dari 172.232.238.140 (🇺🇸 USA) &rarr; portal.jatimprov.go.id (HTTPS/443) <span class="bg-orange-500/20 text-orange-400 border border-orange-500/30 px-1.5 py-0.5 rounded ml-1 text-[8px] font-bold">HIGH</span></span>
            <span class="mx-4 sm:mx-6"><span class="text-yellow-500 mr-1.5 font-bold animate-pulse">●</span> [IDS-LOGGED] Reconnaissance / Port Scan dari 165.22.221.124 (🇸🇬 Singapore) &rarr; api.jatimprov.go.id (TCP/Multi) <span class="bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 px-1.5 py-0.5 rounded ml-1 text-[8px] font-bold">MEDIUM</span></span>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         SCRIPTS (60 FPS GPU-OPTIMIZED)
    ═══════════════════════════════════════════════════════ -->
    <script src="https://unpkg.com/three"></script>
    <script src="https://unpkg.com/globe.gl"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('globe-container');
        const sectionEl = document.getElementById('live-map-section');
        if (!container || typeof Globe === 'undefined') return;

        const isDesktop   = window.innerWidth >= 1024;
        const targetJatim = { lat: -7.5361, lng: 112.2384, name: 'JatimProv Command Center (Jawa Timur)' };

        const altitudeFinal   = isDesktop ? 1.55 : 2.35;
        const altitudeInitial = isDesktop ? 2.15 : 2.95;
        const rotateSpeed     = isDesktop ? 0.35 : 0.25;

        let hoveredPolygon     = null;
        let selectedPolygon    = null;
        let idnProvinces       = [];
        let worldFeatures      = null;
        let currentTextureMode = 'night'; // 'night' | 'realistic' | 'vector'
        let cloudsMesh         = null;
        let cloudsEnabled      = true;
        let isSectionVisible   = true;
        let userPausedRotate   = false;
        let displayedCount     = 148290;

        /* ── 1. Initialize 3D WebGL Globe with Capped PixelRatio & Smooth Damping ── */
        const myGlobe = Globe({ animateIn: false })(container)
            .globeImageUrl('/img/globe/earth-night-opt.jpg')
            .bumpImageUrl('/img/globe/earth-topology.png')
            .backgroundColor('rgba(3,8,20,0)')
            .showGlobe(true)
            .showGraticules(false)
            .showAtmosphere(true)
            .atmosphereColor('#0ea5e9')
            .atmosphereAltitude(0.16)
            .polygonsTransitionDuration(0)
            .width(container.clientWidth)
            .height(container.clientHeight);

        // Cap WebGL PixelRatio to max 1.5x for locked 60 FPS on Retina/HiDPI displays
        try {
            const renderer = myGlobe.renderer();
            if (renderer) {
                renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 1.5));
                renderer.powerPreference = 'high-performance';
            }
        } catch (e) {}

        // Configure Smooth Inertial OrbitControls Damping
        const controls = myGlobe.controls();
        controls.autoRotate      = true;
        controls.autoRotateSpeed = rotateSpeed;
        controls.enableZoom      = true;
        controls.enableDamping   = true;
        controls.dampingFactor   = 0.06;
        controls.rotateSpeed     = 0.65;
        controls.zoomSpeed       = 0.75;
        controls.minDistance     = 115;
        controls.maxDistance     = 480;

        /* ── 2. Pre-bind Arc & Ring Accessors ONCE (Zero Shader Re-compilation!) ── */
        myGlobe
            .arcStartLat(d => d.startLat)
            .arcStartLng(d => d.startLng)
            .arcEndLat(d => d.endLat)
            .arcEndLng(d => d.endLng)
            .arcColor(d => d.colors)
            .arcLabel(d => `<div style="font-family:JetBrains Mono,monospace;font-size:11px;background:rgba(8,16,33,0.92);border:1px solid ${d.strokeColor};padding:4px 8px;border-radius:6px;color:#fff"><b>${d.attackType}</b><br/>${d.flag} ${d.country} (${d.ip}) &rarr; ${d.targetHost}</div>`)
            .arcDashLength(0.45)
            .arcDashGap(0.2)
            .arcDashAnimateTime(1500)
            .arcStroke(1.3)
            .arcAltitudeAutoScale(0.38)
            .ringColor(d => t => `rgba(${d.rgb}, ${Math.max(0, 1 - t)})`)
            .ringMaxRadius(d => d.maxR)
            .ringPropagationSpeed(2.2)
            .ringRepeatPeriod(0);

        /* ── 3. Realistic Ocean Specular Map & Lightweight 32-Segment Cloud Layer ── */
        let waterSpecularTex = null;
        const applyRealisticMaterial = () => {
            if (typeof THREE === 'undefined') return;
            const globeMaterial = myGlobe.globeMaterial();
            globeMaterial.color = new THREE.Color(0xffffff);
            globeMaterial.emissive = new THREE.Color(0x040b18);
            globeMaterial.emissiveIntensity = 0.2;
            globeMaterial.bumpScale = 8;

            if (waterSpecularTex) {
                globeMaterial.specularMap = waterSpecularTex;
                globeMaterial.specular = new THREE.Color('#0ea5e9');
                globeMaterial.shininess = 15;
                globeMaterial.needsUpdate = true;
            } else {
                new THREE.TextureLoader().load('/img/globe/earth-water.png', texture => {
                    waterSpecularTex = texture;
                    globeMaterial.specularMap = texture;
                    globeMaterial.specular = new THREE.Color('#0ea5e9');
                    globeMaterial.shininess = 15;
                    globeMaterial.needsUpdate = true;
                });
            }
        };
        applyRealisticMaterial();

        try {
            const scene = myGlobe.scene();
            if (scene && typeof THREE !== 'undefined') {
                const sunLight = new THREE.DirectionalLight(0xe0f2fe, 0.85);
                sunLight.position.set(-200, 180, 220);
                scene.add(sunLight);

                // Ultra-lightweight 32x32 Cloud Sphere with 344KB optimized texture
                new THREE.TextureLoader().load('/img/globe/clouds-opt.png', cloudsTexture => {
                    cloudsMesh = new THREE.Mesh(
                        new THREE.SphereGeometry(myGlobe.getGlobeRadius() * 1.006, 32, 32),
                        new THREE.MeshLambertMaterial({
                            map: cloudsTexture,
                            transparent: true,
                            opacity: 0.22,
                            depthWrite: false,
                        })
                    );
                    scene.add(cloudsMesh);

                    (function rotateClouds() {
                        if (cloudsMesh && cloudsMesh.visible && isSectionVisible) {
                            cloudsMesh.rotation.y -= 0.00035;
                        }
                        requestAnimationFrame(rotateClouds);
                    })();
                });
            }
        } catch (e) {}

        /* ── 4. Fast Per-Province Indonesia Overlay (Only 32 Provinces Rendered in Night/Day Modes!) ── */
        const isJatimProvince = feat => Boolean(feat?.properties?.IS_JATIM || feat?.properties?.PROVINCE === 'Jawa Timur');
        const isIndonesiaProvince = feat => Boolean(feat?.properties?.IS_IDN_PROVINCE || feat?.properties?.ISO_A3 === 'IDN');

        const buildTooltipHtml = ({ properties: p }) => {
            if (p.IS_JATIM) {
                return `
                    <div style="font-family:JetBrains Mono,monospace;font-size:11px;background:rgba(6,24,44,0.95);border:1px solid #34d399;padding:6px 10px;border-radius:6px;color:#f8fafc;box-shadow:0 0 18px rgba(16,185,129,0.35)">
                        <b style="color:#34d399">🛡️ Provinsi ${p.PROVINCE} (Indonesia)</b><br/>
                        <span style="font-size:9px;color:#a7f3d0">Pusat Komando Utama JatimProv-CSIRT (Surabaya)</span>
                    </div>`;
            }
            if (p.IS_IDN_PROVINCE) {
                return `
                    <div style="font-family:JetBrains Mono,monospace;font-size:11px;background:rgba(7,16,34,0.95);border:1px solid #38bdf8;padding:5px 9px;border-radius:6px;color:#f8fafc">
                        <b style="color:#38bdf8">🇮🇩 Provinsi ${p.PROVINCE}</b><br/>
                        <span style="font-size:9px;color:#cbd5e1">Wilayah Daerah Republik Indonesia (Klik untuk Fokus)</span>
                    </div>`;
            }
            return `
                <div style="font-family:JetBrains Mono,monospace;font-size:11px;background:rgba(7,16,34,0.94);border:1px solid rgba(148,163,184,0.4);padding:5px 9px;border-radius:6px;color:#f8fafc">
                    <b style="color:#e2e8f0">${p.ADMIN || p.NAME} (${p.ISO_A3 || p.ADM0_A3})</b>
                </div>`;
        };

        // Static altitude prevents expensive 3D earcut geometry re-triangulation on click/hover (Locked 60 FPS!)
        const getPolygonAltitude = d => {
            if (isJatimProvince(d)) return 0.012;
            return currentTextureMode === 'vector' ? 0.007 : 0.006;
        };

        const getCapColor = d => {
            if (d === selectedPolygon) return 'rgba(16, 185, 129, 0.74)';
            if (d === hoveredPolygon) return 'rgba(52, 211, 153, 0.52)';
            if (isJatimProvince(d)) return 'rgba(16, 185, 129, 0.42)';
            if (isIndonesiaProvince(d)) return currentTextureMode === 'vector' ? 'rgba(6, 182, 212, 0.32)' : 'rgba(14, 165, 233, 0.16)';
            return 'rgba(15, 36, 74, 0.85)';
        };

        const getSideColor = d => {
            if (isJatimProvince(d)) return 'rgba(52, 211, 153, 0.3)';
            return currentTextureMode === 'vector' ? 'rgba(14, 165, 233, 0.1)' : 'rgba(34, 211, 238, 0.14)';
        };

        const getStrokeColor = d => {
            if (d === selectedPolygon) return '#a7f3d0';
            if (isJatimProvince(d)) return '#34d399';
            if (isIndonesiaProvince(d)) return '#22d3ee';
            return 'rgba(56, 189, 248, 0.45)';
        };

        const applyTextureMode = (mode) => {
            currentTextureMode = mode;
            const labelEl = document.getElementById('texture-mode-label');

            if (mode === 'night') {
                if (labelEl) labelEl.textContent = 'Mode: Bumi Malam';
                if (cloudsMesh) cloudsMesh.visible = cloudsEnabled;
                myGlobe
                    .globeImageUrl('/img/globe/earth-night-opt.jpg')
                    .bumpImageUrl('/img/globe/earth-topology.png')
                    .showGraticules(false)
                    .polygonsData(idnProvinces)
                    .polygonAltitude(getPolygonAltitude)
                    .polygonCapColor(getCapColor)
                    .polygonSideColor(getSideColor)
                    .polygonStrokeColor(getStrokeColor)
                    .polygonLabel(buildTooltipHtml);
                applyRealisticMaterial();
            } else if (mode === 'realistic') {
                if (labelEl) labelEl.textContent = 'Mode: Bumi Siang';
                if (cloudsMesh) cloudsMesh.visible = cloudsEnabled;
                myGlobe
                    .globeImageUrl('/img/globe/earth-blue-marble-opt.jpg')
                    .bumpImageUrl('/img/globe/earth-topology.png')
                    .showGraticules(false)
                    .polygonsData(idnProvinces)
                    .polygonAltitude(getPolygonAltitude)
                    .polygonCapColor(getCapColor)
                    .polygonSideColor(getSideColor)
                    .polygonStrokeColor(getStrokeColor)
                    .polygonLabel(buildTooltipHtml);
                applyRealisticMaterial();
            } else {
                if (labelEl) labelEl.textContent = 'Mode: Vektor Siber';
                if (cloudsMesh) cloudsMesh.visible = false;
                const renderVector = (feats) => {
                    myGlobe
                        .globeImageUrl('/img/globe/earth-night-opt.jpg')
                        .bumpImageUrl('/img/globe/earth-topology.png')
                        .showGraticules(true)
                        .polygonsData(feats)
                        .polygonAltitude(getPolygonAltitude)
                        .polygonCapColor(getCapColor)
                        .polygonSideColor(getSideColor)
                        .polygonStrokeColor(getStrokeColor)
                        .polygonLabel(buildTooltipHtml);
                    applyRealisticMaterial();
                };
                if (worldFeatures) {
                    renderVector(worldFeatures);
                } else {
                    fetch('/data/world-countries.geojson')
                        .then(r => r.json())
                        .then(g => {
                            worldFeatures = (g.features || []).filter(d => d.properties?.ISO_A2 !== 'AQ');
                            renderVector(worldFeatures);
                        });
                }
            }
        };

        // Lightweight Hover: Only updates material color when hovered polygon changes (NO geometry rebuild!)
        myGlobe.onPolygonHover(hoverD => {
            if (hoverD === hoveredPolygon) return;
            hoveredPolygon = hoverD;
            container.style.cursor = hoverD && isIndonesiaProvince(hoverD) ? 'pointer' : 'grab';
            myGlobe.polygonCapColor(getCapColor);
        });

        /* ── 5. Jatim Command Center Marker & Dynamic Selected Province 3D Lock Marker ── */
        const createMarkerElement = d => {
            const el = document.createElement('div');
            el.style.pointerEvents = 'none';
            if (d.type === 'selected') {
                el.innerHTML = `
                    <div style="position:relative;display:flex;align-items:center;gap:6px;transform:translate(-6px,-12px);animation:markerPopIn 0.42s cubic-bezier(0.16,1,0.3,1) forwards">
                        <span style="position:relative;display:inline-flex;width:14px;height:14px">
                            <span style="position:absolute;inset:0;border-radius:9999px;background:#38bdf8;animation:ping 1.2s cubic-bezier(0,0,0.2,1) infinite;opacity:0.95"></span>
                            <span style="position:relative;display:inline-flex;width:14px;height:14px;border-radius:9999px;background:#0ea5e9;border:2px solid #e0f2fe;box-shadow:0 0 16px #38bdf8"></span>
                        </span>
                        <span style="font-size:${isDesktop ? 10 : 9}px;font-family:JetBrains Mono,monospace;font-weight:800;color:#f0f9ff;background:rgba(7,24,52,0.95);border:1px solid #38bdf8;padding:2px 7px;border-radius:4px;box-shadow:0 0 15px rgba(14,165,233,0.45);white-space:nowrap">🎯 ${d.label}</span>
                    </div>`;
            } else {
                el.innerHTML = `
                    <div style="position:relative;display:flex;align-items:center;gap:6px;transform:translate(-6px,-6px)">
                        <span style="position:relative;display:inline-flex;width:12px;height:12px">
                            <span style="position:absolute;inset:0;border-radius:9999px;background:#34d399;animation:ping 1.2s cubic-bezier(0,0,0.2,1) infinite;opacity:0.9"></span>
                            <span style="position:relative;display:inline-flex;width:12px;height:12px;border-radius:9999px;background:#10b981;box-shadow:0 0 14px #34d399,0 0 28px #059669"></span>
                        </span>
                        <span style="font-size:${isDesktop ? 11 : 9}px;font-family:JetBrains Mono,monospace;font-weight:800;color:#ecfdf5;background:rgba(6,24,44,0.92);border:1px solid rgba(52,211,153,0.7);padding:1.5px 6px;border-radius:4px;text-shadow:0 0 8px rgba(0,0,0,1)">JATIM-CSIRT</span>
                    </div>`;
            }
            return el;
        };

        const updateHtmlMarkers = () => {
            const markers = [{ lat: targetJatim.lat, lng: targetJatim.lng, alt: 0.02, type: 'hq', label: 'JATIM-CSIRT' }];
            if (selectedPolygon && selectedPolygon.properties) {
                const p = selectedPolygon.properties;
                if (!p.IS_JATIM) {
                    markers.push({
                        lat: Number(p.CENTER_LAT) || -6.2,
                        lng: Number(p.CENTER_LNG) || 113.5,
                        alt: 0.024,
                        type: 'selected',
                        label: (p.PROVINCE || 'INDONESIA').toUpperCase(),
                    });
                }
            }
            myGlobe
                .htmlElementsData(markers)
                .htmlElement(createMarkerElement)
                .htmlAltitude(d => d.alt);
        };
        updateHtmlMarkers();

        // Staggered timer handles so rapid clicks never overlap or hitch frames
        let selectStageTimer1 = null;
        let selectStageTimer2 = null;
        let provCountAnimId   = null;

        const animateProvinceCount = (el, targetVal) => {
            if (!el) return;
            if (provCountAnimId) cancelAnimationFrame(provCountAnimId);
            const startTime = performance.now();
            const duration = 580;
            const step = now => {
                const t = Math.min(1, (now - startTime) / duration);
                const eased = 1 - Math.pow(1 - t, 3);
                el.textContent = Math.round(targetVal * eased).toLocaleString('id-ID');
                if (t < 1) provCountAnimId = requestAnimationFrame(step);
            };
            provCountAnimId = requestAnimationFrame(step);
        };

        const selectProvince = feat => {
            if (!feat || !isIndonesiaProvince(feat)) return;
            if (selectStageTimer1) clearTimeout(selectStageTimer1);
            if (selectStageTimer2) clearTimeout(selectStageTimer2);

            selectedPolygon = feat;
            const p = feat.properties || {};
            const provName = p.PROVINCE || p.NAME || 'Indonesia';
            const lat = Number(p.CENTER_LAT) || targetJatim.lat;
            const lng = Number(p.CENTER_LNG) || targetJatim.lng;

            // Frame 0: Instant GPU material glow + start ultra-smooth 1200ms camera glide (Zero mesh rebuild!)
            controls.autoRotate = false;
            if (rotateIcon) rotateIcon.textContent = '▶';
            myGlobe
                .polygonCapColor(getCapColor)
                .polygonStrokeColor(getStrokeColor);

            myGlobe.pointOfView({ lat: lat - 0.55, lng, altitude: isDesktop ? 0.62 : 0.84 }, 1200);

            // Frame 0: Smooth GPU-accelerated HUD card slide-up
            const hud = document.getElementById('selected-province-hud');
            const titleEl = document.getElementById('hud-prov-title');
            const subEl = document.getElementById('hud-prov-subtitle');
            const countEl = document.getElementById('hud-prov-count');
            const vecEl = document.getElementById('hud-prov-vector');
            const coordEl = document.getElementById('hud-prov-coords');
            const barEl = document.getElementById('hud-prov-bar');

            if (titleEl) titleEl.textContent = `Provinsi ${provName}`;
            if (subEl) subEl.textContent = p.IS_JATIM ? 'PUSAT KOMANDO UTAMA CSIRT' : 'TARGET TELEMETRI DAERAH RI';

            const hash = provName.split('').reduce((acc, ch) => acc + ch.charCodeAt(0), 0);
            const provCount = p.IS_JATIM ? Math.round(displayedCount * 0.28) : 1240 + (hash * 83) % 9400;
            const vectors = ['SQL Injection (SQLi)', 'DDoS SYN Flood', 'Authentication Attack', 'Cross-Site Scripting (XSS)', 'Brute Force SSH'];
            const topVec = vectors[hash % vectors.length];
            const mitigationPct = 94 + (hash % 6);

            if (vecEl) vecEl.textContent = topVec;
            if (coordEl) coordEl.textContent = `LAT ${lat.toFixed(2)}° | LNG ${lng.toFixed(2)}° | MITIGASI ${mitigationPct}%`;
            if (barEl) {
                barEl.style.width = '18%';
                requestAnimationFrame(() => { barEl.style.width = `${mitigationPct}%`; });
            }
            if (hud) {
                hud.classList.add('prov-hud-active');
            }
            animateProvinceCount(countEl, provCount);

            // Stage 1 (+240ms mid-flight): Pop in 3D target marker & emit smooth radar sonar ring
            selectStageTimer1 = setTimeout(() => {
                if (selectedPolygon !== feat) return;
                updateHtmlMarkers();
                activeRings.push(
                    { lat, lng, rgb: '16, 185, 129', maxR: 5.0 },
                    { lat, lng, rgb: '56, 189, 248', maxR: 3.2 }
                );
                while (activeRings.length > 6) activeRings.shift();
                myGlobe.ringsData(activeRings);
            }, 240);

            // Stage 2 (+520ms as camera arrives): Fire targeted cyber attack laser arc into the province
            selectStageTimer2 = setTimeout(() => {
                if (selectedPolygon !== feat) return;
                fireAttackToProvince(lat, lng, provName);
            }, 520);
        };

        const clearSelectedProvince = () => {
            if (!selectedPolygon) return;
            if (selectStageTimer1) clearTimeout(selectStageTimer1);
            if (selectStageTimer2) clearTimeout(selectStageTimer2);
            selectedPolygon = null;

            myGlobe
                .polygonCapColor(getCapColor)
                .polygonStrokeColor(getStrokeColor);
            updateHtmlMarkers();

            const hud = document.getElementById('selected-province-hud');
            if (hud) hud.classList.remove('prov-hud-active');

            if (!userPausedRotate) {
                controls.autoRotate = true;
                if (rotateIcon) rotateIcon.textContent = '⏸';
            }
            myGlobe.pointOfView({ lat: -5, lng: 113, altitude: altitudeFinal }, 1100);
        };

        // Click on any Indonesian province to trigger Komdigi-style 3D selection animation
        myGlobe.onPolygonClick(clickedD => {
            if (isIndonesiaProvince(clickedD)) {
                if (selectedPolygon === clickedD) {
                    clearSelectedProvince();
                } else {
                    selectProvince(clickedD);
                }
            }
        });

        // Load lightweight 32 Indonesian Provinces GeoJSON (200KB)
        fetch('/data/indonesia-provinces.geojson')
            .then(r => r.json())
            .then(geoData => {
                idnProvinces = geoData.features || [];
                applyTextureMode('night');
            })
            .catch(() => {});

        myGlobe.pointOfView({ lat: -5, lng: 113, altitude: altitudeInitial }, 0);
        setTimeout(() => myGlobe.pointOfView({ lat: -5, lng: 113, altitude: altitudeFinal }, 1800), 100);

        /* ── 6. Interactive HUD Controls ── */
        const btnFocusJatim      = document.getElementById('btn-focus-jatim');
        const btnViewGlobal      = document.getElementById('btn-view-global');
        const btnModeTexture     = document.getElementById('btn-mode-texture');
        const btnToggleClouds    = document.getElementById('btn-toggle-clouds');
        const cloudsLabel        = document.getElementById('clouds-label');
        const btnToggleRotate    = document.getElementById('btn-toggle-rotate');
        const rotateIcon         = document.getElementById('rotate-icon');
        const btnZoomIn          = document.getElementById('btn-zoom-in');
        const btnZoomOut         = document.getElementById('btn-zoom-out');
        const btnCloseProvHud    = document.getElementById('btn-close-prov-hud');
        const btnSimProvAttack   = document.getElementById('btn-sim-prov-attack');

        if (btnCloseProvHud) {
            btnCloseProvHud.addEventListener('click', clearSelectedProvince);
        }
        if (btnSimProvAttack) {
            btnSimProvAttack.addEventListener('click', () => {
                if (!selectedPolygon || !selectedPolygon.properties) return;
                const p = selectedPolygon.properties;
                const lat = Number(p.CENTER_LAT) || targetJatim.lat;
                const lng = Number(p.CENTER_LNG) || targetJatim.lng;
                const provName = p.PROVINCE || 'Jawa Timur';
                fireAttackToProvince(lat, lng, provName);
                const countEl = document.getElementById('hud-prov-count');
                if (countEl) {
                    const current = parseInt(countEl.textContent.replace(/\D/g, ''), 10) || 1500;
                    countEl.textContent = (current + 1).toLocaleString('id-ID');
                }
            });
        }

        if (btnFocusJatim) {
            btnFocusJatim.addEventListener('click', () => {
                const jatimFeat = idnProvinces.find(f => isJatimProvince(f));
                if (jatimFeat) {
                    selectProvince(jatimFeat);
                } else {
                    myGlobe.pointOfView({ lat: -6.2, lng: 113.5, altitude: 0.8 }, 1000);
                }
            });
        }
        if (btnViewGlobal) {
            btnViewGlobal.addEventListener('click', () => {
                if (selectedPolygon) clearSelectedProvince();
                myGlobe.pointOfView({ lat: 8, lng: 110, altitude: 2.1 }, 1000);
            });
        }
        if (btnModeTexture) {
            const modes = ['night', 'realistic', 'vector'];
            btnModeTexture.addEventListener('click', () => {
                const nextIdx = (modes.indexOf(currentTextureMode) + 1) % modes.length;
                applyTextureMode(modes[nextIdx]);
            });
        }
        if (btnToggleClouds) {
            btnToggleClouds.addEventListener('click', () => {
                cloudsEnabled = !cloudsEnabled;
                if (cloudsMesh && currentTextureMode !== 'vector') {
                    cloudsMesh.visible = cloudsEnabled;
                }
                if (cloudsLabel) cloudsLabel.textContent = cloudsEnabled ? 'Awan: ON' : 'Awan: OFF';
                btnToggleClouds.classList.toggle('text-sky-300', cloudsEnabled);
                btnToggleClouds.classList.toggle('text-gray-500', !cloudsEnabled);
            });
        }
        if (btnToggleRotate) {
            btnToggleRotate.addEventListener('click', () => {
                userPausedRotate = !userPausedRotate;
                controls.autoRotate = !userPausedRotate;
                if (rotateIcon) rotateIcon.textContent = !userPausedRotate ? '⏸' : '▶';
                btnToggleRotate.classList.toggle('text-emerald-400', !userPausedRotate);
                btnToggleRotate.classList.toggle('text-amber-400', userPausedRotate);
            });
        }
        if (btnZoomIn) {
            btnZoomIn.addEventListener('click', () => {
                const pov = myGlobe.pointOfView();
                myGlobe.pointOfView({ ...pov, altitude: Math.max(0.55, pov.altitude - 0.35) }, 450);
            });
        }
        if (btnZoomOut) {
            btnZoomOut.addEventListener('click', () => {
                const pov = myGlobe.pointOfView();
                myGlobe.pointOfView({ ...pov, altitude: Math.min(3.4, pov.altitude + 0.35) }, 450);
            });
        }

        /* ── 7. Smooth Counter Interpolation (60fps Eased Count-Up) ── */
        let countAnimFrame = null;
        function animateCounterTo(targetVal) {
            const startVal = displayedCount;
            const diff = targetVal - startVal;
            if (diff <= 0) return;
            const duration = 650;
            const startTime = performance.now();

            if (countAnimFrame) cancelAnimationFrame(countAnimFrame);
            function step(now) {
                const t = Math.min(1, (now - startTime) / duration);
                const eased = 1 - Math.pow(1 - t, 3);
                displayedCount = Math.round(startVal + diff * eased);
                const formatted = displayedCount.toLocaleString('id-ID');
                ['live-attack-count', 'live-attack-count-mobile'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.textContent = formatted;
                });
                if (t < 1) countAnimFrame = requestAnimationFrame(step);
            }
            countAnimFrame = requestAnimationFrame(step);
        }

        /* ── 8. Fallback Catalog & State Queue ── */
        const FALLBACK_SOURCES = [
            { name:'China',     flag:'🇨🇳', lat:35.86, lng:104.19, ip:'180.243.2.151'   },
            { name:'USA',       flag:'🇺🇸', lat:37.09, lng:-95.71, ip:'172.232.238.140' },
            { name:'Russia',    flag:'🇷🇺', lat:61.52, lng:105.32, ip:'82.197.69.49'    },
            { name:'Indonesia', flag:'🇮🇩', lat:-6.20, lng:106.84, ip:'103.8.77.26'     },
            { name:'Singapore', flag:'🇸🇬', lat:1.35,  lng:103.82, ip:'165.22.221.124'  },
            { name:'Germany',   flag:'🇩🇪', lat:51.16, lng:10.45,  ip:'145.110.242.20'  },
        ];
        const FALLBACK_ATTACKS = [
            { name:'SQL Injection (SQLi)',       severity:'CRITICAL', protocol:'HTTPS/443', target:'sso.jatimprov.go.id'        },
            { name:'Authentication Attack',      severity:'HIGH',     protocol:'HTTPS/443', target:'simpeg.jatimprov.go.id'     },
            { name:'Cross-Site Scripting (XSS)', severity:'HIGH',     protocol:'HTTPS/443', target:'portal.jatimprov.go.id'     },
            { name:'Reconnaissance / Port Scan', severity:'MEDIUM',   protocol:'TCP/Multi', target:'api.jatimprov.go.id'        },
            { name:'Brute Force SSH',            severity:'HIGH',     protocol:'SSH/22',    target:'diskominfo.jatimprov.go.id' },
        ];

        let activeAttacks = [];
        let activeRings   = [];
        let eventQueue    = [];
        let telemetryRows = [];

        const rand = arr => arr[Math.floor(Math.random() * arr.length)];
        const nowTimeStr = () => new Date().toTimeString().split(' ')[0];

        /* ── 9. Render Komdigi-Style Analytics Lists with Progress Bars ── */
        function renderLists(data) {
            if (!data) return;

            if (data.total_attacks && data.total_attacks > displayedCount) {
                animateCounterTo(Number(data.total_attacks));
            }

            if (data.attacks_per_minute) {
                const apm = document.getElementById('attacks-per-min-label');
                if (apm) apm.textContent = `~${data.attacks_per_minute} serangan/mnt`;
            }

            if (Array.isArray(data.top_attacks) && data.top_attacks.length) {
                const topAttacksHtml = data.top_attacks.slice(0, 5).map((item, i) => {
                    const barColor = i === 0 ? 'bg-red-500' : i === 1 ? 'bg-orange-500' : i === 2 ? 'bg-amber-400' : 'bg-cyan-400';
                    const textColor = i === 0 ? 'text-red-400' : i === 1 ? 'text-orange-400' : i === 2 ? 'text-amber-300' : 'text-cyan-400';
                    const pct = item.percentage || Math.max(8, 35 - i * 6);
                    return `
                        <li class="space-y-1">
                            <div class="flex justify-between items-center text-[11px]">
                                <div class="flex items-center gap-1.5 min-w-0">
                                    <span class="text-[9px] font-bold text-gray-500 w-3.5 shrink-0">${i + 1}.</span>
                                    <span class="truncate text-gray-200" title="${item.name}">${item.name}</span>
                                </div>
                                <div class="flex items-center gap-2 shrink-0 ml-2">
                                    <span class="text-[9px] text-gray-400">${pct}%</span>
                                    <span class="font-bold ${textColor}">${Number(item.count).toLocaleString('id-ID')}</span>
                                </div>
                            </div>
                            <div class="w-full h-1 bg-slate-800/90 rounded-full overflow-hidden">
                                <div class="h-full ${barColor} rounded-full transition-all duration-700" style="width: ${Math.min(100, pct * 2.4)}%"></div>
                            </div>
                        </li>`;
                }).join('');

                const desktopEl = document.getElementById('top-attacks-list');
                const mobileEl  = document.getElementById('mobile-top-attacks-list');
                if (desktopEl) desktopEl.innerHTML = topAttacksHtml;
                if (mobileEl)  mobileEl.innerHTML  = topAttacksHtml;
            }

            if (Array.isArray(data.top_countries) && data.top_countries.length) {
                const countriesEl = document.getElementById('top-countries-list');
                if (countriesEl) {
                    countriesEl.innerHTML = data.top_countries.slice(0, 5).map((item, i) => {
                        const pct = item.percentage || Math.max(5, 28 - i * 5);
                        return `
                            <li class="space-y-1">
                                <div class="flex justify-between items-center text-[11px]">
                                    <div class="flex items-center gap-1.5 min-w-0">
                                        <span class="text-[9px] font-bold text-gray-500 w-3.5 shrink-0">${i + 1}.</span>
                                        <span class="truncate text-gray-200">${item.flag} ${item.name}</span>
                                    </div>
                                    <div class="flex items-center gap-2 shrink-0 ml-2">
                                        <span class="text-[9px] text-gray-400">${pct}%</span>
                                        <span class="font-bold text-cyan-400">${Number(item.count).toLocaleString('id-ID')}</span>
                                    </div>
                                </div>
                                <div class="w-full h-1 bg-slate-800/90 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full transition-all duration-700" style="width: ${Math.min(100, pct * 2.8)}%"></div>
                                </div>
                            </li>`;
                    }).join('');
                }
            }

            if (Array.isArray(data.top_ips) && data.top_ips.length) {
                const ipsEl = document.getElementById('top-ips-list');
                if (ipsEl) {
                    ipsEl.innerHTML = data.top_ips.slice(0, 5).map((item, i) => `
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default">
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="text-[9px] font-bold text-gray-500 w-3.5 shrink-0">${i + 1}.</span>
                                <span>${item.flag || '🌐'}</span>
                                <span class="px-1.5 py-0.5 rounded bg-slate-900 border border-slate-700/80 text-gray-200 text-[10px] truncate">${item.address}</span>
                            </div>
                            <span class="font-bold shrink-0 ml-2 ${i === 0 ? 'text-red-400' : i === 1 ? 'text-orange-400' : 'text-amber-300'}">${Number(item.count).toLocaleString('id-ID')}</span>
                        </li>`).join('');
                }
            }

            if (Array.isArray(data.recent_attacks) && data.recent_attacks.length) {
                data.recent_attacks.forEach(ev => {
                    if (eventQueue.length < 16) eventQueue.push(ev);
                });
            }
        }

        /* ── 10. Push Row to Live Telemetry Table ── */
        function pushTelemetryRow(ev) {
            const tbody = document.getElementById('live-telemetry-tbody');
            if (!tbody) return;

            const sevBadge = ev.severity === 'CRITICAL'
                ? '<span class="px-1.5 py-0.5 rounded bg-red-500/20 text-red-400 border border-red-500/30 text-[8px] font-bold">CRIT</span>'
                : ev.severity === 'HIGH'
                ? '<span class="px-1.5 py-0.5 rounded bg-orange-500/20 text-orange-400 border border-orange-500/30 text-[8px] font-bold">HIGH</span>'
                : '<span class="px-1.5 py-0.5 rounded bg-yellow-500/20 text-yellow-300 border border-yellow-500/30 text-[8px] font-bold">MED</span>';

            const shortAttack = ev.attackType
                .replace(' (SQLi)', '')
                .replace('Cross-Site Scripting (XSS)', 'XSS Payload')
                .replace('Reconnaissance / Port Scan', 'Port Scan');

            telemetryRows.unshift({
                time: ev.time,
                source: `${ev.flag} ${ev.ip}`,
                attack: shortAttack,
                badge: sevBadge,
            });
            if (telemetryRows.length > 4) telemetryRows.pop();

            tbody.innerHTML = telemetryRows.map((r, idx) => `
                <tr class="${idx === 0 ? 'telemetry-row-new' : ''}">
                    <td class="py-1.5 text-gray-400 whitespace-nowrap pr-2">${r.time}</td>
                    <td class="py-1.5 text-cyan-300 whitespace-nowrap pr-2 truncate max-w-[95px]">${r.source}</td>
                    <td class="py-1.5 text-gray-200 truncate max-w-[105px] pr-1">${r.attack}</td>
                    <td class="py-1.5 text-right whitespace-nowrap">${r.badge}</td>
                </tr>
            `).join('');
        }

        /* ── 11. Fire Laser Arc & Impact Rings (Zero Stutter) ── */
        function fireAttackToProvince(targetLat, targetLng, provName) {
            const c = rand(FALLBACK_SOURCES);
            const a = rand(FALLBACK_ATTACKS);
            const slug = provName.toLowerCase().replace(/[^a-z0-9]/g, '');
            const ev = {
                time:       nowTimeStr(),
                country:    c.name,
                flag:       c.flag,
                startLat:   c.lat + (Math.random() - 0.5) * 3,
                startLng:   c.lng + (Math.random() - 0.5) * 3,
                endLat:     targetLat,
                endLng:     targetLng,
                targetHost: `csirt.${slug}.go.id`,
                ip:         c.ip,
                attackType: a.name,
                protocol:   a.protocol,
                severity:   'CRITICAL',
            };

            activeAttacks.push({
                ...ev,
                strokeColor: '#10b981',
                colors: ['rgba(56, 189, 248, 0.5)', '#34d399'],
            });
            if (activeAttacks.length > 8) activeAttacks.shift();
            myGlobe.arcsData(activeAttacks);

            activeRings.push({ lat: targetLat, lng: targetLng, rgb: '52, 211, 153', maxR: 4.8 });
            if (activeRings.length > 7) activeRings.shift();
            myGlobe.ringsData(activeRings);

            animateCounterTo(displayedCount + 1);
            pushTelemetryRow(ev);
        }

        function fireAttack() {
            if (!isSectionVisible) return;

            const queued = eventQueue.shift();
            let ev;

            // If user selected a province, direct live attacks toward that province as well
            const selProps = selectedPolygon?.properties;
            const customEndLat = selProps?.CENTER_LAT ? Number(selProps.CENTER_LAT) : null;
            const customEndLng = selProps?.CENTER_LNG ? Number(selProps.CENTER_LNG) : null;
            const customSlug   = selProps?.PROVINCE ? `csirt.${selProps.PROVINCE.toLowerCase().replace(/[^a-z0-9]/g, '')}.go.id` : null;

            if (queued) {
                ev = {
                    time:       nowTimeStr(),
                    country:    queued.source_country || 'China',
                    flag:       queued.source_flag || '🇨🇳',
                    startLat:   Number(queued.source_lat) || 35.86,
                    startLng:   Number(queued.source_lng) || 104.19,
                    endLat:     customEndLat || Number(queued.target_lat) || targetJatim.lat,
                    endLng:     customEndLng || Number(queued.target_lng) || targetJatim.lng,
                    targetHost: customSlug || queued.target_host || 'sso.jatimprov.go.id',
                    ip:         queued.source_ip || '180.243.2.151',
                    attackType: queued.attack_type || 'SQL Injection (SQLi)',
                    protocol:   queued.protocol || 'HTTPS/443',
                    severity:   queued.severity || 'CRITICAL',
                };
            } else {
                const c = rand(FALLBACK_SOURCES);
                const a = rand(FALLBACK_ATTACKS);
                ev = {
                    time:       nowTimeStr(),
                    country:    c.name,
                    flag:       c.flag,
                    startLat:   c.lat + (Math.random() - 0.5) * 4,
                    startLng:   c.lng + (Math.random() - 0.5) * 4,
                    endLat:     (customEndLat || targetJatim.lat) + (Math.random() - 0.5) * 0.4,
                    endLng:     (customEndLng || targetJatim.lng) + (Math.random() - 0.5) * 0.4,
                    targetHost: customSlug || a.target,
                    ip:         c.ip,
                    attackType: a.name,
                    protocol:   a.protocol,
                    severity:   a.severity,
                };
            }

            const strokeColor = ev.severity === 'CRITICAL'
                ? '#ef4444'
                : ev.severity === 'HIGH'
                ? '#f97316'
                : '#eab308';

            const rgb = ev.severity === 'CRITICAL'
                ? '239, 68, 68'
                : ev.severity === 'HIGH'
                ? '249, 115, 22'
                : '234, 179, 8';

            activeAttacks.push({
                ...ev,
                strokeColor,
                colors: ['rgba(56, 189, 248, 0.35)', strokeColor],
            });
            if (activeAttacks.length > 8) activeAttacks.shift();
            myGlobe.arcsData(activeAttacks);

            activeRings.push({ lat: ev.endLat, lng: ev.endLng, rgb, maxR: 4.2 });
            if (activeRings.length > 5) activeRings.shift();
            myGlobe.ringsData(activeRings);

            // Smoothly increment counter
            animateCounterTo(displayedCount + Math.floor(Math.random() * 5) + 1);

            const ma = document.getElementById('mobile-top-attack');
            const mc = document.getElementById('mobile-top-country');
            if (ma) ma.textContent = ev.attackType;
            if (mc) mc.textContent = `${ev.flag} ${ev.country}`;

            pushTelemetryRow(ev);

            const pill = document.getElementById('latest-alert-pill');
            if (pill) {
                const sc = ev.severity === 'CRITICAL'
                    ? { t:'text-red-400', bg:'bg-red-500/20', b:'border-red-500/30', dot:'bg-red-500' }
                    : ev.severity === 'HIGH'
                    ? { t:'text-orange-400', bg:'bg-orange-500/20', b:'border-orange-500/30', dot:'bg-orange-500' }
                    : { t:'text-yellow-300', bg:'bg-yellow-500/20', b:'border-yellow-500/30', dot:'bg-yellow-400' };

                pill.innerHTML = `
                    <span class="relative flex h-2 w-2 sm:h-2.5 sm:w-2.5 shrink-0">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full ${sc.dot} opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-full w-full ${sc.dot}"></span>
                    </span>
                    <span class="font-mono text-[9px] sm:text-[10px] text-gray-300 truncate">
                        <span class="${sc.t} font-bold">${ev.attackType}</span>
                        &nbsp;|&nbsp; ${ev.flag} ${ev.country} <span class="text-gray-400">(${ev.ip})</span> &nbsp;&rarr;&nbsp;
                        <span class="text-cyan-400 font-bold">${ev.targetHost}</span>
                    </span>
                    <span class="${sc.bg} ${sc.t} ${sc.b} border font-mono text-[8px] sm:text-[9px] px-1.5 sm:px-2 py-0.5 rounded font-bold uppercase tracking-widest shrink-0">${ev.severity}</span>`;
            }
        }

        /* ── 12. Fetch API Immediately on Load + Periodic Refresh ── */
        function fetchThreatData() {
            if (!isSectionVisible) return;
            fetch('/api/threat-data')
                .then(r => { if (r.ok) return r.json(); throw new Error('Network error'); })
                .then(data => renderLists(data))
                .catch(() => {
                    renderLists({
                        total_attacks: 148290,
                        attacks_per_minute: 64,
                        top_attacks: [
                            { name: 'SQL Injection (SQLi)',       count: 19310, percentage: 31 },
                            { name: 'Authentication Attack',      count: 14950, percentage: 24 },
                            { name: 'Cross-Site Scripting (XSS)', count: 11830, percentage: 19 },
                            { name: 'Reconnaissance / Port Scan', count: 9340,  percentage: 15 },
                            { name: 'Brute Force SSH',            count: 6850,  percentage: 11 },
                        ],
                        top_countries: [
                            { name: 'China',     flag: '🇨🇳', count: 25100, percentage: 26 },
                            { name: 'USA',       flag: '🇺🇸', count: 20200, percentage: 21 },
                            { name: 'Russia',    flag: '🇷🇺', count: 17300, percentage: 18 },
                            { name: 'Indonesia', flag: '🇮🇩', count: 13500, percentage: 14 },
                            { name: 'Singapore', flag: '🇸🇬', count: 8680,  percentage: 9  },
                        ],
                        top_ips: [
                            { address: '180.243.2.151',   flag: '🇨🇳', count: 4120 },
                            { address: '82.197.69.49',    flag: '🇷🇺', count: 3540 },
                            { address: '172.232.238.140', flag: '🇺🇸', count: 2890 },
                            { address: '103.8.77.26',     flag: '🇮🇩', count: 2310 },
                            { address: '165.22.221.124',  flag: '🇸🇬', count: 1780 },
                        ],
                    });
                });
        }

        fetchThreatData();
        setInterval(fetchThreatData, 14000);

        setTimeout(fireAttack, 150);
        setTimeout(fireAttack, 800);
        setInterval(fireAttack, 2400);

        /* ── 13. Viewport Visibility Observer (Pause GPU Work When Off-Screen) ── */
        if (sectionEl && 'IntersectionObserver' in window) {
            const visObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    isSectionVisible = entry.isIntersecting;
                    controls.autoRotate = isSectionVisible && !userPausedRotate;
                });
            }, { threshold: 0.05 });
            visObserver.observe(sectionEl);
        }

        /* ── 14. Responsive Resize Handler ── */
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
