<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen RFC 2350 - JatimProv CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">

    <!-- Font Premium: Space Grotesk (Display) & JetBrains Mono (Tech) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    <!-- Memanggil Tailwind & Custom CSS via Vite -->
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen overflow-x-hidden selection:bg-cyan-500 selection:text-white">

    <!-- Latar Belakang Mesh Grid & Ambient Glow (Mewarisi style dari app.css) -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-40 dark:opacity-100 z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- KONTEN UTAMA -->
    <div class="flex-grow relative z-10 flex flex-col items-center w-full pt-12 pb-24">
        
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- ================= HEADER HALAMAN ================= -->
            <div class="text-center mb-10 opacity-0 animate-fade-in-up">
                <!-- Cyber Badge -->
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-cyan-500/30 text-blue-600 dark:text-cyan-400 text-xs font-bold tracking-widest uppercase rounded-full backdrop-blur-md shadow-sm dark:shadow-[0_0_15px_rgba(6,182,212,0.15)] animate-float-subtle mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500 shadow-[0_0_8px_#22d3ee]"></span>
                    </span>
                    OFFICIAL_DOCUMENT
                </div>
                
                <!-- Judul Besar -->
                <h1 class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-4">
                    Dokumen <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-cyan-400 dark:to-blue-500">RFC 2350</span>
                </h1>
                
                <!-- Deskripsi Pendek -->
                <p class="text-sm md:text-base text-gray-500 dark:text-slate-400 font-medium max-w-2xl mx-auto leading-relaxed">
                    Profil resmi JatimProv-CSIRT yang mendefinisikan kebijakan operasional, layanan, dan prosedur pelaporan insiden keamanan siber sesuai dengan standar internasional.
                </p>
                
                <!-- Metadata Dokumen -->
                <div class="mt-4 flex items-center justify-center gap-3 text-xs font-mono text-gray-400 dark:text-slate-500">
                    <span class="bg-gray-200 dark:bg-slate-800 px-2.5 py-1 rounded">VERSION 2.0</span>
                    <span>|</span>
                    <span>PUBLISHED: 21 MAY 2026</span>
                </div>
            </div>

            <!-- ================= AREA PENAMPIL PDF (Glassmorphism) ================= -->
            <div class="w-full opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-3xl shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] border border-gray-200/50 dark:border-slate-700/80 p-2 md:p-3 relative overflow-hidden group">
                    
                    <!-- Garis Neon Atas -->
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-blue-600"></div>

                    <!-- Kotak Iframe -->
                    <div class="w-full h-[70vh] md:h-[80vh] rounded-[1.25rem] overflow-hidden border border-gray-100 dark:border-slate-800 bg-gray-100 dark:bg-[#020817] relative">
                        <!-- Loading SVG (Kelihatan sekilas sebelum PDF termuat) -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center -z-10 text-gray-400 dark:text-slate-600">
                            <svg class="w-10 h-10 animate-spin mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            <span class="text-xs font-mono font-bold tracking-widest uppercase">Membuka Dokumen...</span>
                        </div>
                        
                        <iframe 
                            src="{{ asset('dokumen/rfc2350.pdf') }}" 
                            class="w-full h-full relative z-10"
                            style="border: none;"
                            title="Penampil Dokumen RFC2350">
                            Browser Anda tidak mendukung penampil PDF. Silakan klik tombol unduh di bawah.
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- ================= TOMBOL UNDUH ================= -->
            <div class="mt-10 flex justify-center opacity-0 animate-fade-in-up" style="animation-delay: 0.4s;">
                <a href="{{ asset('dokumen/rfc2350.pdf') }}" download class="group relative inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-sm font-bold py-4 px-10 rounded-2xl transition-all shadow-[0_0_15px_rgba(6,182,212,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.5)] hover:-translate-y-1 overflow-hidden">
                    <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover:-translate-x-5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    </span>
                    <span class="transition-all duration-300 ease-out group-hover:-translate-x-3 flex items-center gap-2">
                        <svg class="w-4 h-4 group-hover:opacity-0 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Unduh Dokumen Resmi (PDF)
                    </span>
                    <!-- Glare Effect (Cahaya Lewat) -->
                    <div class="absolute top-0 -left-[100%] w-1/2 h-full bg-gradient-to-r from-transparent via-white/30 to-transparent skew-x-12 animate-glare z-0 pointer-events-none"></div>
                </a>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <x-footer />

    <!-- CHATBOT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

</body>
</html>