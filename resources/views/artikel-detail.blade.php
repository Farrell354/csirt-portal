<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artikel->judul }} - JatimProv CSIRT</title>
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-cyan-500 selection:text-white">

    <!-- Latar Belakang Mesh Grid & Ambient Glow (Mewarisi style dari app.css) -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- KONTEN ARTIKEL -->
    <div class="flex-grow relative z-10 pb-24 pt-16">
        
        <!-- Header Berita -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            <!-- Tombol Kembali -->
            <a href="/artikel" class="inline-flex items-center text-xs font-bold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 mb-8 transition-transform hover:-translate-x-2 duration-300 uppercase tracking-widest bg-white/50 dark:bg-slate-900/50 px-4 py-2 rounded-xl border border-gray-200 dark:border-slate-800 backdrop-blur-md shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Arsip Publikasi
            </a>
            
            <div class="flex items-center flex-wrap gap-4 mb-6">
                <!-- Badge Kategori -->
                <span class="bg-blue-100/50 dark:bg-cyan-900/30 text-blue-700 dark:text-cyan-400 font-bold text-[10px] uppercase tracking-widest px-3 py-1.5 rounded-lg border border-blue-200 dark:border-cyan-800/50 shadow-sm flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 animate-pulse"></span>
                    {{ $artikel->kategori }}
                </span>
                
                <!-- Tanggal Publikasi -->
                <span class="text-xs font-mono font-bold text-gray-500 dark:text-gray-400 flex items-center tracking-widest uppercase">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d F Y') }}
                </span>
            </div>
            
            <!-- Judul Artikel -->
            <h1 class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white leading-tight mb-8 drop-shadow-sm">
                {{ $artikel->judul }}
            </h1>
            
            <!-- Profil Penulis -->
            <div class="flex items-center gap-4 pb-8 border-b border-gray-200/80 dark:border-slate-800/80">
                <div class="w-12 h-12 bg-white dark:bg-slate-800 rounded-2xl flex items-center justify-center text-blue-500 dark:text-cyan-500 font-bold border border-gray-200 dark:border-slate-700 shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <p class="text-base font-bold text-slate-900 dark:text-white">{{ $artikel->penulis }}</p>
                    <p class="text-[10px] text-gray-500 dark:text-gray-400 font-mono tracking-widest uppercase mt-0.5">Authorised Intel Analyst</p>
                </div>
            </div>
        </div>

        <!-- Gambar Sampul -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="w-full h-[400px] md:h-[550px] bg-gray-100 dark:bg-slate-800 rounded-[2rem] overflow-hidden shadow-2xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] border border-gray-200 dark:border-slate-700/80 group">
                <img src="{{ $artikel->gambar }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
            </div>
        </div>

        <!-- Isi Konten Artikel -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.3s;">
            
            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl p-8 md:p-12 rounded-3xl shadow-lg border border-gray-200/50 dark:border-slate-800/80">
                <!-- Gunakan prose tailwind untuk typography artikel yang nyaman dibaca -->
                <article class="prose prose-lg prose-slate dark:prose-invert max-w-none 
                                prose-headings:font-display prose-headings:font-bold 
                                prose-a:text-blue-600 dark:prose-a:text-cyan-400 hover:prose-a:text-blue-800 dark:hover:prose-a:text-cyan-300 
                                prose-img:rounded-2xl prose-img:shadow-md 
                                marker:text-cyan-500 selection:bg-cyan-500 selection:text-white">
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed tracking-wide text-[17px] font-medium">
                        {!! nl2br(e($artikel->konten)) !!}
                    </p>
                </article>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <x-footer />

    <!-- CHATBOT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Saya ganti logika hardcoded chatbot di file lawas dengan komponen Blade kita yang sudah mantap -->
    <x-chatbot />

    <!-- SCRIPT OBSERVER UNTUK ANIMASI SCROLL -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const observerOptions = { root: null, rootMargin: '0px', threshold: 0.1 };
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        entry.target.classList.remove('opacity-0');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.opacity-0.animate-fade-in-up').forEach(el => {
                // Tunda sedikit supaya loading font selesai
                setTimeout(() => el.style.opacity = '1', 600);
            });
        });
    </script>
</body>
</html>