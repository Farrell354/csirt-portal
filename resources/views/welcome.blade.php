<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JatimProv-CSIRT | Portal Keamanan Siber</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">

    <!-- Font Premium: Space Grotesk (Display) & JetBrains Mono (Tech) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    <!-- Memanggil Tailwind & Custom CSS via Vite (Wajib jalankan 'npm run dev' atau 'npm run build') -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SCRIPT PENDETEKSI TEMA AWAL -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<script src="{{ asset('js/hero-interactive.js') }}" defer></script>
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen overflow-x-hidden selection:bg-cyan-500 selection:text-white">

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- KONTEN UTAMA -->
    <div class="flex-grow relative">
        
        <!-- ===================================================================== -->
        <!-- HERO SECTION (Bersih, Megah, Profesional) -->
        <!-- ===================================================================== -->
        <header class="relative w-full min-h-screen flex items-center justify-center bg-slate-950 overflow-hidden pt-20 pb-32 lg:py-0">
            
            <!-- BACKGROUND IMAGE & MESH GRID -->
<div class="absolute inset-0 z-0 pointer-events-none">
    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070&auto=format&fit=crop" alt="Cyber Background" class="w-full h-full object-cover opacity-20 grayscale animate-pan-bg">
    <div class="absolute inset-0 bg-gradient-to-b from-[#020617]/95 via-[#020617]/80 to-[#020617]/95"></div>
    <div class="absolute inset-0 bg-mesh-grid"></div>
    <!-- Glow Core di Tengah -->
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-blue-600/20 rounded-full blur-[120px] animate-pulse"></div>
</div>

<!-- Canvas partikel interaktif — sekarang mencakup seluruh hero -->
<canvas id="hero-particles-canvas" class="absolute inset-0 pointer-events-none" style="z-index: 5;"></canvas>

            <!-- KONTEN HERO -->
            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white flex flex-col items-center">
                
                <!-- Badge Atas -->
                <div class="opacity-0 animate-fade-in-up mb-8" style="animation-delay: 0.1s;">
                    <div class="inline-flex items-center gap-3 px-5 py-2 bg-blue-950/50 border border-cyan-500/30 text-cyan-300 text-xs font-bold tracking-widest uppercase rounded-full backdrop-blur-xl shadow-[0_0_20px_rgba(6,182,212,0.15)] animate-float-subtle">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-400 shadow-[0_0_8px_#22d3ee]"></span>
                        </span>
                        Pusat Tanggap Darurat Siber 24/7
                    </div>
                </div>
                
                <!-- Judul Utama -->
<div class="opacity-0 animate-fade-in-up mb-6 w-full flex justify-center" style="animation-delay: 0.3s;">
    <div class="relative inline-block cursor-default px-10 py-8 md:px-16 md:py-10" id="hero-title-region" style="perspective: 1000px;">
        <h1 id="hero-title"
            class="relative font-display text-5xl md:text-7xl lg:text-[5.5rem] font-black tracking-tight leading-tight will-change-transform"
            style="transition: transform 400ms ease-out, text-shadow 250ms ease-out;">
            JatimProv<span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-200 via-white to-cyan-200 bg-[length:200%_auto] animate-shine-text">-CSIRT</span>
        </h1>
        <span id="hero-title-underline"
              class="pointer-events-none absolute left-1/2 -bottom-3 md:-bottom-4 -translate-x-1/2 h-[2px] w-0 bg-gradient-to-r from-transparent via-cyan-400 to-transparent transition-all duration-500 ease-out"></span>
    </div>
</div>
                
                <!-- Deskripsi -->
                <div class="opacity-0 animate-fade-in-up mb-12 w-full" style="animation-delay: 0.5s;">
                    <p class="text-sm md:text-lg text-slate-400 leading-relaxed max-w-3xl mx-auto font-medium">
                        Garda terdepan keamanan informasi Pemerintah Provinsi Jawa Timur. Mengamankan infrastruktur, merespons insiden, dan membangun ekosistem digital yang tangguh.
                    </p>
                </div>
                
                <!-- Tombol Aksi -->
                <div class="opacity-0 animate-fade-in-up flex flex-col sm:flex-row justify-center items-center gap-5 w-full" style="animation-delay: 0.7s;">
                    <!-- Tombol Lapor -->
                    <a href="/login" class="group relative px-10 py-4 bg-gradient-to-r from-blue-700 to-cyan-500 text-white font-black text-sm tracking-widest uppercase rounded-2xl animate-pulse-glow transition-transform hover:-translate-y-1 overflow-hidden w-full sm:w-auto flex justify-center">
                        <span class="relative z-10 flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                            Lapor Insiden
                        </span>
                        <div class="absolute top-0 -left-[100%] w-1/2 h-full bg-gradient-to-r from-transparent via-white/40 to-transparent skew-x-12 animate-glare z-0 pointer-events-none"></div>
                    </a>
                    
                    <!-- Tombol Pelajari -->
                    <a href="/profil" class="px-10 py-4 bg-slate-900/50 border border-slate-700 hover:bg-slate-800 hover:border-slate-500 text-gray-300 hover:text-white transition-all duration-300 font-bold text-sm tracking-widest uppercase rounded-2xl backdrop-blur-md shadow-lg w-full sm:w-auto flex justify-center hover:-translate-y-1">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

            </div>
        </header>

        <!-- ===================================================================== -->
        <!-- KOMPONEN PETA LIVE MAP -->
        <!-- ===================================================================== -->
        <div class="relative z-20 shadow-[0_-20px_50px_rgba(0,0,0,0.7)] bg-[#020617]">
            <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-cyan-500/50 to-transparent z-30"></div>
            <!-- Cukup panggil tag ini saja. Script 3D sudah tertanam di dalamnya. -->
            <x-live-map />
        </div>

        <!-- ===================================================================== -->
        <!-- LATEST POST SECTION -->
        <!-- ===================================================================== -->
        <section class="bg-gray-50 dark:bg-[#020617] py-32 relative overflow-hidden transition-colors duration-500">
            <!-- Dekorasi Latar Belakang -->
            <div class="absolute inset-0 bg-mesh-grid opacity-50 dark:opacity-100 pointer-events-none"></div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Section Header -->
                <div class="reveal-on-scroll flex flex-col md:flex-row justify-between items-start md:items-end border-b border-gray-200 dark:border-slate-800/80 pb-6 mb-16 gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-8 h-1 bg-blue-600 dark:bg-cyan-500 rounded-full inline-block"></span>
                            <span class="text-blue-700 dark:text-cyan-400 text-xs font-bold tracking-widest uppercase">Intelijen Terbuka</span>
                        </div>
                        <h2 class="font-display text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight">
                            Publikasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-cyan-400 dark:to-blue-500">Terbaru</span>
                        </h2>
                    </div>
                    <a href="/artikel" class="text-xs font-bold text-slate-700 hover:text-white dark:text-gray-300 dark:hover:text-white uppercase tracking-widest flex items-center gap-2 group transition-all px-6 py-3 bg-white hover:bg-blue-700 dark:bg-slate-900/50 dark:hover:bg-blue-600 rounded-xl border border-gray-200 dark:border-slate-700 shadow-sm hover:shadow-xl hover:border-blue-700 dark:hover:border-blue-500 shrink-0">
                        Lihat Semua Artikel
                        <svg class="w-4 h-4 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                
                <!-- GRID ARTIKEL BERANDA -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($artikelTerkini as $index => $artikel)
                    <!-- Kartu Artikel -->
                    <div class="reveal-on-scroll group relative flex flex-col rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl hover:shadow-cyan-500/10 transition-all duration-500 hover:-translate-y-2 bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-100 dark:border-slate-800" style="animation-delay: {{ $index * 0.15 }}s;">
                        
                        <!-- Garis aksen atas -->
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-blue-400 opacity-70 group-hover:opacity-100 transition-opacity duration-500 z-20"></div>

                        <!-- Gambar Header -->
                        <div class="relative h-60 bg-gray-100 dark:bg-slate-800 overflow-hidden shrink-0 z-10">
                            <img src="{{ $artikel->gambar }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover transform scale-100 group-hover:scale-105 transition-transform duration-700 ease-out">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            <div class="absolute top-5 left-5 bg-white/10 backdrop-blur-md text-white text-[10px] font-bold px-4 py-1.5 uppercase tracking-widest rounded-full border border-white/20 shadow-[0_4px_15px_rgba(0,0,0,0.5)] group-hover:border-cyan-400/50 group-hover:text-cyan-300 transition-colors duration-300">
                                {{ $artikel->kategori }}
                            </div>
                        </div>
                        
                        <!-- Konten Berita -->
                        <div class="p-8 flex-grow flex flex-col relative z-10">
                            <div class="flex items-center gap-2 text-[10px] text-gray-500 dark:text-gray-400 mb-4 uppercase tracking-widest font-bold">
                                <svg class="w-3.5 h-3.5 text-blue-600 dark:text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d M Y') }}
                            </div>
                            
                            <h3 class="font-display font-bold text-xl mb-4 text-slate-900 dark:text-white leading-relaxed group-hover:text-blue-700 dark:group-hover:text-cyan-400 transition-colors line-clamp-2" title="{{ $artikel->judul }}">
                                {{ $artikel->judul }}
                            </h3>
                            
                            <!-- Footer Kartu -->
                            <div class="mt-auto pt-6 flex items-center justify-between">
                                <div class="text-[11px] text-gray-500 dark:text-gray-400 font-medium flex items-center gap-2 bg-gray-100 dark:bg-slate-800/50 px-3 py-1.5 rounded-full">
                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span class="text-gray-800 dark:text-gray-200 font-bold truncate max-w-[100px]">{{ $artikel->penulis }}</span>
                                </div>
                                
                                <a href="/artikel/{{ $artikel->id }}" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-gray-600 dark:text-gray-300 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-[0_0_15px_rgba(0,86,179,0.4)]">
                                    <svg class="w-4 h-4 transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 12h16m0 0l-6-6m6 6l-6 6"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    <x-footer />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

    <!-- SCRIPT OBSERVER UNTUK ANIMASI SCROLL -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const observerOptions = { root: null, rootMargin: '0px', threshold: 0.15 };
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-on-scroll', 'is-visible');
                        entry.target.classList.remove('reveal-on-scroll');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>