<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JatimProv-CSIRT | Cyber Command Center</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;900&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        /* ──────────────────────────────────
           TICKER
        ────────────────────────────────── */
        @keyframes ticker {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .ticker-track { animation: ticker 40s linear infinite; }
        .ticker-track:hover { animation-play-state: paused; }

        /* ──────────────────────────────────
           SHIMMER GRADIENT TEXT
        ────────────────────────────────── */
        @keyframes shimmer {
            0%   { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }
        .text-shimmer {
            background: linear-gradient(90deg, #38bdf8, #818cf8, #22d3ee, #818cf8, #38bdf8);
            background-size: 300% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 5s linear infinite;
        }

        /* ──────────────────────────────────
           CANVAS — hidden on touch devices
        ────────────────────────────────── */
        #neural-canvas {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 2;
        }
        @media (hover: none) {
            /* Touch / mobile: hide canvas, save battery */
            #neural-canvas { display: none; }
        }

        /* ──────────────────────────────────
           CURSOR GLOW — desktop only
        ────────────────────────────────── */
        #cursor-glow {
            position: fixed;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(6,182,212,0.07) 0%, transparent 70%);
            transition: left 0.05s linear, top 0.05s linear;
        }
        @media (hover: none) {
            #cursor-glow { display: none; }
        }

        /* ──────────────────────────────────
           SCANLINES
        ────────────────────────────────── */
        .scanlines::after {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                rgba(0,0,0,0.04) 0px, rgba(0,0,0,0.04) 1px,
                transparent 1px, transparent 4px
            );
            pointer-events: none;
            z-index: 3;
        }
        @media (max-width: 640px) {
            /* Lighter on mobile for readability */
            .scanlines::after { opacity: 0.4; }
        }

        /* ──────────────────────────────────
           CARD TILT — desktop only
        ────────────────────────────────── */
        .card-tilt { transition: transform 0.15s ease-out, box-shadow 0.15s ease-out; }
        @media (hover: none) {
            .card-tilt { transition: none; }
        }

        /* ──────────────────────────────────
           ANIMATION DELAYS
        ────────────────────────────────── */
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-500 { animation-delay: 0.5s; }

        /* ──────────────────────────────────
           SCROLL INDICATOR — hide on short screens
        ────────────────────────────────── */
        @media (max-height: 700px) {
            .scroll-indicator { display: none; }
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 transition-colors duration-500 dark:bg-[#030712] dark:text-gray-100 font-sans flex flex-col min-h-screen overflow-x-hidden selection:bg-cyan-500/20 selection:text-cyan-700 dark:selection:text-cyan-300">

    <!-- Cursor Glow (desktop only via CSS) -->
    <div id="cursor-glow" aria-hidden="true"></div>

    <!-- Global Mesh Grid -->
    <div class="fixed inset-0 bg-mesh-grid opacity-60 dark:opacity-30 pointer-events-none z-0" aria-hidden="true"></div>

    <!-- Navbar -->
    <x-navbar />

    <div class="flex-grow relative z-10">

        <!-- ═══════════════════════════════════════════════════════
             HERO
        ═══════════════════════════════════════════════════════ -->
        <header class="scanlines relative w-full min-h-screen flex items-center justify-center overflow-hidden">

            <!-- Dark base -->
            <div class="absolute inset-0 bg-slate-950 z-0"></div>

            <!-- Photo -->
            <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                <img
                    src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=1200&auto=format&fit=crop"
                    alt=""
                    loading="eager"
                    class="w-full h-full object-cover opacity-[0.12] grayscale animate-pan-bg"
                >
                <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/60 to-slate-950"></div>
            </div>

            <!-- Ambient Orbs -->
            <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                <div class="absolute top-[15%] left-[10%] w-[40vw] max-w-[500px] h-[40vw] max-h-[500px] bg-cyan-600/10 rounded-full blur-[120px] animate-pulse"></div>
                <div class="absolute bottom-[5%] right-[5%] w-[35vw] max-w-[400px] h-[35vw] max-h-[400px] bg-indigo-600/10 rounded-full blur-[100px]"></div>
            </div>

            <!-- Interactive Neural-Net Canvas (desktop only) -->
            <canvas id="neural-canvas" aria-hidden="true"></canvas>

            <!-- ─── Hero Content ─── -->
            <div class="relative z-10 w-full max-w-5xl mx-auto px-5 sm:px-8 lg:px-8 text-center flex flex-col items-center pt-28 pb-28 sm:pt-32 sm:pb-36">

                <!-- Status Badge -->
                <div class="opacity-0 animate-fade-in-up mb-6 sm:mb-8">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-slate-900/70 border border-cyan-500/20 text-cyan-400 font-mono text-[9px] sm:text-[10px] font-bold tracking-[0.2em] uppercase rounded-full backdrop-blur-xl shadow-[0_0_30px_rgba(6,182,212,0.1)]">
                        <span class="relative flex h-1.5 w-1.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-cyan-500 shadow-[0_0_6px_rgba(6,182,212,0.8)]"></span>
                        </span>
                        <span class="hidden sm:inline">ALL SYSTEMS OPERATIONAL //&nbsp;</span>JATIM SHIELD ACTIVE
                    </div>
                </div>

                <!-- Main Heading -->
                <div class="opacity-0 animate-fade-in-up delay-100 mb-5 sm:mb-6 w-full flex flex-col items-center">
                    <div class="font-mono text-[8px] sm:text-[9px] text-slate-500 tracking-[0.25em] sm:tracking-[0.4em] uppercase mb-3 sm:mb-4 px-2">
                        Computer Security Incident Response Team
                    </div>
                    <h1 class="hero-title-container font-display font-black leading-[0.92] tracking-tighter text-white w-full transition-transform duration-200 ease-out cursor-default" style="transform-style: preserve-3d;">
                        <span class="block text-[2.8rem] xs:text-5xl sm:text-6xl md:text-7xl lg:text-[6.5rem] hacker-text" data-text="JatimProv">JatimProv</span>
                        <span class="block text-shimmer text-[2.8rem] xs:text-5xl sm:text-6xl md:text-7xl lg:text-[6.5rem] mt-1 hacker-text relative" data-text="-CSIRT" style="transform: translateZ(20px);">-CSIRT</span>
                    </h1>
                </div>

                <!-- Descriptor -->
                <div class="opacity-0 animate-fade-in-up delay-200 mb-8 sm:mb-12 max-w-xl px-2">
                    <p class="text-slate-400 text-sm sm:text-base md:text-lg leading-relaxed font-medium">
                        Garda terdepan keamanan siber Jawa Timur. Merespons insiden, mengamankan infrastruktur kritis, dan membangun ekosistem digital yang tangguh.
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="opacity-0 animate-fade-in-up delay-300 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 w-full max-w-sm sm:max-w-none justify-center">
                    <a href="/login" class="group relative inline-flex items-center justify-center gap-2.5 px-7 py-3.5 sm:py-4 bg-cyan-500 hover:bg-cyan-400 active:bg-cyan-600 text-slate-950 font-bold text-xs sm:text-sm tracking-widest uppercase rounded-xl transition-all duration-300 shadow-[0_0_25px_rgba(6,182,212,0.3)] hover:shadow-[0_0_40px_rgba(6,182,212,0.5)] hover:-translate-y-0.5 overflow-hidden">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Lapor Insiden
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out pointer-events-none"></div>
                    </a>

                    <a href="/profil" class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 sm:py-4 border border-slate-700 hover:border-slate-500 active:border-slate-400 text-slate-400 hover:text-white font-bold text-xs sm:text-sm tracking-widest uppercase rounded-xl transition-all duration-300 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Tentang CSIRT
                    </a>
                </div>

                <!-- Stats Row -->
                <div class="opacity-0 animate-fade-in-up delay-500 mt-14 sm:mt-20 grid grid-cols-3 gap-0 w-full max-w-xs sm:max-w-md border-t border-slate-800/80 pt-6 sm:pt-8">
                    <div class="text-center px-2">
                        <div class="font-display text-2xl sm:text-3xl md:text-4xl font-black text-white mb-0.5 sm:mb-1">24/7</div>
                        <div class="font-mono text-[8px] sm:text-[9px] text-slate-500 uppercase tracking-[0.1em] sm:tracking-[0.15em]">Monitor</div>
                    </div>
                    <div class="text-center px-2 border-x border-slate-800/80">
                        <div class="font-display text-2xl sm:text-3xl md:text-4xl font-black text-cyan-400 mb-0.5 sm:mb-1">{{ \App\Models\Laporan::count() }}</div>
                        <div class="font-mono text-[8px] sm:text-[9px] text-slate-500 uppercase tracking-[0.1em] sm:tracking-[0.15em]">Laporan</div>
                    </div>
                    <div class="text-center px-2">
                        <div class="font-display text-2xl sm:text-3xl md:text-4xl font-black text-white mb-0.5 sm:mb-1">{{ \App\Models\User::where('role','hunter')->count() }}</div>
                        <div class="font-mono text-[8px] sm:text-[9px] text-slate-500 uppercase tracking-[0.1em] sm:tracking-[0.15em]">Hunters</div>
                    </div>
                </div>

            </div>

            <!-- Bottom Fade -->
            <div class="absolute bottom-0 inset-x-0 h-24 sm:h-32 bg-gradient-to-t from-slate-950 to-transparent z-10" aria-hidden="true"></div>

            <!-- Scroll Indicator -->
            <div class="scroll-indicator absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-1.5 opacity-40" aria-hidden="true">
                <div class="font-mono text-[8px] text-slate-500 tracking-[0.2em] uppercase">Scroll</div>
                <div class="w-px h-8 bg-gradient-to-b from-slate-500 to-transparent"></div>
            </div>
        </header>

        <!-- ═══════════════════════════════════════════════════════
             TICKER — Threat Feed
        ═══════════════════════════════════════════════════════ -->
        <div class="bg-slate-950 border-y border-slate-800/80 overflow-hidden py-2.5 sm:py-3 relative z-20" aria-label="Live threat feed">
            <div class="absolute left-0 top-0 h-full w-16 sm:w-32 bg-gradient-to-r from-slate-950 to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 h-full w-16 sm:w-32 bg-gradient-to-l from-slate-950 to-transparent z-10 pointer-events-none"></div>
            <div class="ticker-track flex gap-8 sm:gap-12 whitespace-nowrap select-none" role="marquee">
                @foreach ([
                    ['🟡', 'CVE-2025-0001', 'RCE — Apache HTTPD 2.4.x'],
                    ['🔴', 'CVE-2025-1234', 'Critical — Ivanti Connect'],
                    ['🟢', 'ADVISORY', 'Jatim Shield v2.1 Deployed'],
                    ['🟡', 'CVE-2025-4321', 'High — OpenSSH Auth Bypass'],
                    ['🔵', 'UPDATE', 'Patch Tuesday Agustus 2025'],
                    ['🔴', 'INCIDENT', 'Phishing Campaign — EDU Sektor'],
                ] as $item)
                <span class="inline-flex items-center gap-2 sm:gap-3 font-mono text-[10px] sm:text-xs text-slate-400">
                    <span>{{ $item[0] }}</span>
                    <span class="text-cyan-500 font-bold">{{ $item[1] }}</span>
                    <span>{{ $item[2] }}</span>
                    <span class="text-slate-700 mx-1 sm:mx-2">▸</span>
                </span>
                @endforeach
                {{-- Duplicate for seamless loop --}}
                @foreach ([
                    ['🟡', 'CVE-2025-0001', 'RCE — Apache HTTPD 2.4.x'],
                    ['🔴', 'CVE-2025-1234', 'Critical — Ivanti Connect'],
                    ['🟢', 'ADVISORY', 'Jatim Shield v2.1 Deployed'],
                    ['🟡', 'CVE-2025-4321', 'High — OpenSSH Auth Bypass'],
                    ['🔵', 'UPDATE', 'Patch Tuesday Agustus 2025'],
                    ['🔴', 'INCIDENT', 'Phishing Campaign — EDU Sektor'],
                ] as $item)
                <span class="inline-flex items-center gap-2 sm:gap-3 font-mono text-[10px] sm:text-xs text-slate-400">
                    <span>{{ $item[0] }}</span>
                    <span class="text-cyan-500 font-bold">{{ $item[1] }}</span>
                    <span>{{ $item[2] }}</span>
                    <span class="text-slate-700 mx-1 sm:mx-2">▸</span>
                </span>
                @endforeach
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════
             LIVE MAP
        ═══════════════════════════════════════════════════════ -->
        <div class="relative z-20 bg-white dark:bg-[#030712]">
            <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-cyan-500/30 to-transparent" aria-hidden="true"></div>
            <x-live-map />
        </div>

        <!-- ═══════════════════════════════════════════════════════
             LATEST INTEL (ARTICLES)
        ═══════════════════════════════════════════════════════ -->
        <section class="bg-gray-50 dark:bg-[#030712] py-16 sm:py-24 lg:py-32 relative overflow-hidden">

            <div class="absolute inset-0 bg-mesh-grid opacity-60 dark:opacity-30 pointer-events-none" aria-hidden="true"></div>
            <div class="absolute -top-24 right-0 w-[50vw] h-[50vw] bg-indigo-600/5 dark:bg-indigo-900/10 rounded-full blur-[160px] pointer-events-none" aria-hidden="true"></div>

            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <!-- Section Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 sm:gap-6 mb-8 sm:mb-12 lg:mb-16 reveal-on-scroll">
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="h-1 w-8 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full"></div>
                            <span class="font-mono text-[9px] sm:text-[10px] font-bold text-cyan-600 dark:text-cyan-500 uppercase tracking-[0.15em] sm:tracking-[0.2em]">Security Advisories</span>
                        </div>
                        <h2 class="font-display text-3xl sm:text-4xl md:text-5xl font-black tracking-tighter text-gray-900 dark:text-white">
                            Publikasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-cyan-400 dark:to-blue-400">Intelijen</span>
                        </h2>
                    </div>

                    <a href="/artikel" class="group self-start sm:self-auto shrink-0 inline-flex items-center gap-2 font-mono text-[10px] sm:text-[11px] font-bold text-gray-600 dark:text-gray-400 uppercase tracking-widest px-5 py-2.5 sm:px-6 sm:py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl hover:bg-gray-900 hover:text-white dark:hover:bg-white dark:hover:text-gray-900 active:scale-95 transition-all">
                        Seluruh Arsip
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <!-- Articles Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8">
                    @foreach($artikelTerkini as $index => $artikel)
                    <article class="card-tilt group relative flex flex-col rounded-2xl sm:rounded-3xl overflow-hidden bg-white/80 dark:bg-gray-900/60 backdrop-blur-xl border border-gray-200/50 dark:border-gray-800/80 shadow-sm hover:shadow-xl hover:shadow-cyan-500/5 dark:hover:shadow-cyan-500/10 transition-shadow duration-300 reveal-on-scroll">

                        <!-- Top Accent Line -->
                        <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-blue-500 via-cyan-400 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10" aria-hidden="true"></div>

                        <!-- Image -->
                        <div class="relative h-48 sm:h-52 lg:h-60 bg-gray-100 dark:bg-gray-800 overflow-hidden shrink-0">
                            <img src="{{ $artikel->gambar }}" alt="{{ $artikel->judul }}" loading="lazy" class="w-full h-full object-cover scale-100 group-hover:scale-105 transition-transform duration-700 ease-out">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 via-gray-900/20 to-transparent"></div>

                            <div class="absolute top-4 left-4 sm:top-5 sm:left-5">
                                <span class="inline-block bg-black/30 backdrop-blur-md border border-white/10 text-white font-mono text-[8px] sm:text-[9px] font-bold px-2.5 py-1 sm:px-3 uppercase tracking-[0.1em] sm:tracking-[0.15em] rounded-full group-hover:border-cyan-400/40 group-hover:text-cyan-300 transition-colors">
                                    {{ $artikel->kategori }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5 sm:p-6 lg:p-8 flex-grow flex flex-col">
                            <div class="flex items-center gap-2 font-mono text-[8px] sm:text-[9px] text-gray-500 mb-3 sm:mb-4 uppercase tracking-[0.1em] font-bold">
                                <svg class="w-3 h-3 text-blue-500 dark:text-cyan-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d M Y') }}
                            </div>

                            <h3 class="font-display font-bold text-base sm:text-lg lg:text-xl leading-snug text-gray-900 dark:text-white mb-4 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors line-clamp-3 break-words">
                                {{ $artikel->judul }}
                            </h3>

                            <div class="mt-auto pt-4 sm:pt-5 flex items-center justify-between border-t border-gray-100 dark:border-gray-800/60">
                                <div class="inline-flex items-center gap-1.5 sm:gap-2 font-mono text-[8px] sm:text-[9px] uppercase tracking-widest text-gray-500">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 dark:bg-cyan-500 shrink-0"></span>
                                    <span class="truncate max-w-[100px] sm:max-w-[120px]">{{ $artikel->penulis }}</span>
                                </div>

                                <a href="/artikel/{{ $artikel->id }}" class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 dark:text-gray-400 group-hover:bg-gray-900 group-hover:text-white dark:group-hover:bg-cyan-500 dark:group-hover:text-gray-900 transition-colors shrink-0" aria-label="Baca artikel">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

    </div><!-- /flex-grow -->

    <x-footer />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

    <!-- ═══════════════════════════════════════════════════════
         SCRIPTS
    ═══════════════════════════════════════════════════════ -->
    <script>
    (() => {
        const isTouchDevice = window.matchMedia('(hover: none)').matches;

        /* ─── Cursor Glow (desktop only) ─── */
        if (!isTouchDevice) {
            const glow = document.getElementById('cursor-glow');
            document.addEventListener('mousemove', e => {
                glow.style.left = e.clientX + 'px';
                glow.style.top  = e.clientY + 'px';
            }, { passive: true });
        }

        /* ─── Neural-Net Canvas (desktop only) ─── */
        if (!isTouchDevice) {
            const canvas = document.getElementById('neural-canvas');
            const ctx    = canvas.getContext('2d');
            let W, H, particles;
            let mouse = { x: -9999, y: -9999 };
            const COUNT      = 70;
            const MAX_DIST   = 150;
            const MOUSE_DIST = 180;

            const resize = () => {
                W = canvas.width  = canvas.offsetWidth;
                H = canvas.height = canvas.offsetHeight;
            };

            class Particle {
                constructor() { this.reset(true); }
                reset(init = false) {
                    this.x  = Math.random() * W;
                    this.y  = Math.random() * H;
                    this.vx = (Math.random() - 0.5) * 0.45;
                    this.vy = (Math.random() - 0.5) * 0.45;
                    this.r  = Math.random() * 1.5 + 0.5;
                }
                update() {
                    const dx = this.x - mouse.x;
                    const dy = this.y - mouse.y;
                    const d  = Math.sqrt(dx * dx + dy * dy);
                    if (d < MOUSE_DIST && d > 0) {
                        const force = (MOUSE_DIST - d) / MOUSE_DIST;
                        this.vx += (dx / d) * force * 0.9;
                        this.vy += (dy / d) * force * 0.9;
                    }
                    const speed = Math.sqrt(this.vx * this.vx + this.vy * this.vy);
                    if (speed > 2.5) { this.vx = (this.vx / speed) * 2.5; this.vy = (this.vy / speed) * 2.5; }
                    this.vx *= 0.98;
                    this.vy *= 0.98;
                    this.x += this.vx;
                    this.y += this.vy;
                    if (this.x < -10) this.x = W + 10;
                    if (this.x > W + 10) this.x = -10;
                    if (this.y < -10) this.y = H + 10;
                    if (this.y > H + 10) this.y = -10;
                }
                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                    ctx.fillStyle = 'rgba(6,182,212,0.75)';
                    ctx.fill();
                }
            }

            const init = () => {
                resize();
                particles = Array.from({ length: COUNT }, () => new Particle());
            };

            const drawLines = () => {
                for (let i = 0; i < particles.length; i++) {
                    for (let j = i + 1; j < particles.length; j++) {
                        const a = particles[i], b = particles[j];
                        const dx = a.x - b.x, dy = a.y - b.y;
                        const dist = Math.sqrt(dx * dx + dy * dy);
                        if (dist < MAX_DIST) {
                            const alpha = (1 - dist / MAX_DIST) * 0.3;
                            ctx.beginPath();
                            ctx.strokeStyle = `rgba(6,182,212,${alpha})`;
                            ctx.lineWidth = 0.7;
                            ctx.moveTo(a.x, a.y);
                            ctx.lineTo(b.x, b.y);
                            ctx.stroke();
                        }
                    }
                }
            };

            const loop = () => {
                ctx.clearRect(0, 0, W, H);
                particles.forEach(p => { p.update(); p.draw(); });
                drawLines();
                requestAnimationFrame(loop);
            };

            const header = canvas.closest('header');
            header.addEventListener('mousemove', e => {
                const rect = canvas.getBoundingClientRect();
                mouse.x = e.clientX - rect.left;
                mouse.y = e.clientY - rect.top;
            }, { passive: true });
            header.addEventListener('mouseleave', () => { mouse.x = -9999; mouse.y = -9999; });

            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(resize, 100);
            }, { passive: true });

            init();
            loop();
        }

        /* ─── Card Magnetic Tilt (desktop only) ─── */
        if (!isTouchDevice) {
            document.querySelectorAll('.card-tilt').forEach(card => {
                card.addEventListener('mousemove', e => {
                    const rect = card.getBoundingClientRect();
                    const cx   = rect.left + rect.width / 2;
                    const cy   = rect.top  + rect.height / 2;
                    const dx   = (e.clientX - cx) / (rect.width / 2);
                    const dy   = (e.clientY - cy) / (rect.height / 2);
                    card.style.transform  = `perspective(800px) rotateX(${-dy * 3}deg) rotateY(${dx * 3}deg) translateY(-4px)`;
                    card.style.boxShadow  = `${-dx * 6}px ${dy * 6}px 40px rgba(6,182,212,0.07)`;
                }, { passive: true });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = '';
                    card.style.boxShadow = '';
                });
            });
        }

        /* ─── Scroll Reveal ─── */
        const ro = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    entry.target.style.opacity = '1';
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });

        document.querySelectorAll('.reveal-on-scroll').forEach(el => {
            el.style.opacity = '0';
            ro.observe(el);
        });

        /* ─── Hero Title Hacker Scramble & 3D Tilt (desktop only) ─── */
        if (!isTouchDevice) {
            const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;':,./<>?";
            
            document.querySelectorAll('.hacker-text').forEach(element => {
                element.addEventListener('mouseover', event => {
                    let iterations = 0;
                    const target = event.target;
                    const originalText = target.dataset.text;
                    
                    if(target.dataset.animating === "true") return;
                    target.dataset.animating = "true";
                    
                    clearInterval(target.interval);
                    
                    target.interval = setInterval(() => {
                        target.innerText = originalText.split("")
                            .map((letter, index) => {
                                if(index < iterations) {
                                    return originalText[index];
                                }
                                return letters[Math.floor(Math.random() * 63)]
                            })
                            .join("");
                        
                        if(iterations >= originalText.length) {
                            clearInterval(target.interval);
                            target.dataset.animating = "false";
                        }
                        
                        iterations += 1 / 3;
                    }, 30);
                });
            });

            const titleContainer = document.querySelector('.hero-title-container');
            if(titleContainer) {
                titleContainer.addEventListener('mousemove', (e) => {
                    const rect = titleContainer.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const xPct = (x / rect.width - 0.5) * 20; 
                    const yPct = (y / rect.height - 0.5) * -20;
                    
                    titleContainer.style.transform = `perspective(1000px) rotateX(${yPct}deg) rotateY(${xPct}deg) scale(1.02)`;
                }, { passive: true });
                titleContainer.addEventListener('mouseleave', () => {
                    titleContainer.style.transform = `perspective(1000px) rotateX(0) rotateY(0) scale(1)`;
                });
            }
        }
    })();
    </script>
</body>
</html>