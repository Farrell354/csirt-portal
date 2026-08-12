<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel & Berita - JatimProv CSIRT</title>
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

    <!-- Latar Belakang Mesh Grid & Ambient Glow -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 z-0"></div>
    <div class="fixed top-0 right-0 -mt-20 -mr-20 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- KONTEN UTAMA -->
    <div class="flex-grow relative z-10 transition-colors duration-300">
        
        <!-- ================= HEADER HALAMAN ================= -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-gray-200 dark:border-slate-800/80 pt-24 pb-12 transition-colors duration-300 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
                    
                    <div class="max-w-2xl">
                        <!-- Cyber Badge -->
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-cyan-500/30 text-blue-600 dark:text-cyan-400 font-mono text-[11px] font-bold tracking-widest mb-6 uppercase rounded-full shadow-sm animate-float-subtle">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500 shadow-[0_0_8px_#22d3ee]"></span>
                            </span>
                            [ INTEL // 04 ]
                        </div>
                        
                        <h1 class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-4 drop-shadow-sm">
                            Artikel & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-cyan-400 dark:to-blue-500">Publikasi</span>
                        </h1>
                        <p class="text-base md:text-lg text-gray-500 dark:text-gray-400 font-medium">
                            Peringatan keamanan, berita siber terbaru, dan buletin resmi dari JatimProv-CSIRT.
                        </p>
                    </div>
                    
                    <!-- Kotak Pencarian (Terminal Style) -->
                    <form action="/artikel" method="GET" class="w-full lg:w-96 relative group/search">
                        @if(request()->has('kategori') && request('kategori') != '')
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        @endif
                        
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within/search:text-cyan-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel atau intelijen..." 
                            class="w-full bg-white/50 dark:bg-slate-950/50 backdrop-blur-md border border-gray-200 dark:border-slate-700/80 text-sm pl-11 pr-24 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-500 transition-all text-gray-800 dark:text-gray-200 shadow-sm placeholder-gray-400 dark:placeholder-gray-500">
                        
                        <button type="submit" class="absolute right-2 top-2 bottom-2 bg-blue-600 hover:bg-blue-700 dark:bg-cyan-600 dark:hover:bg-cyan-500 text-white font-bold text-xs px-4 rounded-xl transition-colors shadow-md uppercase tracking-widest">
                            Cari
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            
            <!-- ================= BANNER PENANDA FILTER KATEGORI ================= -->
            @if(request()->has('kategori') && request('kategori') != '')
                <div class="mb-10 p-5 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-lg relative overflow-hidden opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-blue-600 to-cyan-400"></div>
                    
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-50 dark:bg-cyan-900/30 rounded-lg text-blue-600 dark:text-cyan-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 block mb-0.5">Menampilkan Kategori:</span>
                            <span class="text-base font-black text-slate-900 dark:text-white">{{ request('kategori') }}</span>
                        </div>
                    </div>
                    
                    <a href="/artikel" class="inline-flex items-center justify-center px-4 py-2 text-xs font-bold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-500/10 hover:bg-red-500 hover:text-white dark:hover:bg-red-500 dark:hover:text-white rounded-lg transition-all border border-red-200 dark:border-red-500/20 uppercase tracking-widest">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Hapus Filter
                    </a>
                </div>
            @endif

            <!-- ================= AREA KONTEN ARTIKEL ================= -->
            @if($artikels->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    @foreach($artikels as $index => $artikel)
                        <!-- Kartu Artikel (Glassmorphism + Neon Top Border) -->
                        <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 hover:border-blue-300 dark:hover:border-cyan-700/50 transition-all duration-500 flex flex-col rounded-[2rem] overflow-hidden shadow-lg hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-2 relative" 
                             style="animation-delay: {{ $index * 0.1 }}s;">
                            
                            <!-- Garis aksen atas -->
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-20"></div>

                            <div class="relative h-56 bg-gray-100 dark:bg-slate-800 overflow-hidden shrink-0 z-10 border-b border-gray-100 dark:border-slate-800">
                                <img src="{{ $artikel->gambar }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover transform scale-100 group-hover:scale-110 transition-transform duration-700 ease-out">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                <!-- Kategori Badge -->
                                <div class="absolute top-5 left-5 bg-white/20 dark:bg-slate-900/50 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1.5 uppercase tracking-widest rounded-lg border border-white/30 dark:border-slate-700 shadow-[0_4px_15px_rgba(0,0,0,0.3)] group-hover:border-cyan-400/50 group-hover:text-cyan-300 transition-colors duration-300 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                                    {{ $artikel->kategori }}
                                </div>
                            </div>
                            
                            <div class="p-6 md:p-8 flex-grow flex flex-col relative z-10">
                                <!-- Tanggal & Penulis -->
                                <div class="flex items-center gap-2 text-[10px] text-gray-500 dark:text-gray-400 mb-4 uppercase tracking-widest font-bold font-mono">
                                    <svg class="w-3.5 h-3.5 text-blue-600 dark:text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d M Y') }}
                                    <span class="mx-1 text-gray-300 dark:text-slate-700">|</span>
                                    <span class="truncate max-w-[100px]">{{ $artikel->penulis }}</span>
                                </div>
                                
                                <h3 class="font-display font-bold text-xl md:text-2xl mb-6 text-slate-900 dark:text-white leading-snug group-hover:text-blue-700 dark:group-hover:text-cyan-400 transition-colors line-clamp-3" title="{{ $artikel->judul }}">
                                    {{ $artikel->judul }}
                                </h3>
                                
                                <!-- Tombol Baca -->
                                <div class="mt-auto pt-4 border-t border-gray-100 dark:border-slate-800">
                                    <a href="/artikel/{{ $artikel->id }}" class="inline-flex items-center text-blue-600 dark:text-cyan-400 font-bold text-xs uppercase tracking-widest hover:text-blue-800 dark:hover:text-cyan-300 transition-colors">
                                        Baca Selengkapnya 
                                        <svg class="w-4 h-4 ml-1.5 transform transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination (Navigasi Halaman) -->
                <div class="flex justify-center mt-12 mb-8 reveal-on-scroll">
                    <!-- Wrapper agar style bawaan Laravel pagination rapi -->
                    <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl px-6 py-3 rounded-2xl shadow-lg border border-gray-200 dark:border-slate-800">
                        {{ $artikels->links() }}
                    </div>
                </div>
            @else
                <!-- ================= TAMPILAN JIKA KOSONG ================= -->
                <div class="text-center py-24 bg-white/50 dark:bg-slate-900/50 backdrop-blur-xl border border-dashed border-gray-300 dark:border-slate-700 rounded-[2rem] shadow-sm opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="w-20 h-20 mx-auto bg-gray-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mb-6 border border-gray-200 dark:border-slate-700 shadow-inner">
                        <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="font-display text-2xl font-black text-gray-800 dark:text-white tracking-tight mb-2">Intelijen Tidak Ditemukan</h3>
                    <p class="text-gray-500 dark:text-gray-400 font-medium mb-8 max-w-md mx-auto">Sistem tidak menemukan artikel yang cocok dengan kata kunci atau filter kategori Anda. Silakan coba kata kunci lain.</p>
                    <a href="/artikel" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 dark:bg-cyan-600 dark:hover:bg-cyan-500 text-white text-xs font-bold uppercase tracking-widest rounded-xl transition-all shadow-[0_0_15px_rgba(37,99,235,0.3)] hover:shadow-[0_0_25px_rgba(37,99,235,0.5)] hover:-translate-y-0.5">
                        Tampilkan Seluruh Arsip
                    </a>
                </div>
            @endif

        </div>
    </div>

    <!-- FOOTER -->
    <x-footer />

    <!-- WIDGET CHATBOT CSIRT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

    <!-- SCRIPT OBSERVER UNTUK ANIMASI SCROLL -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const observerOptions = { root: null, rootMargin: '0px', threshold: 0.1 };
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        entry.target.classList.remove('reveal-on-scroll', 'opacity-0');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-on-scroll, .opacity-0.animate-fade-in-up').forEach(el => {
                // Beri sedikit delay paksa untuk memastikan elemen yang di view atas langsung tampil
                if(el.classList.contains('opacity-0')) {
                    setTimeout(() => el.style.opacity = '1', 800);
                } else {
                    observer.observe(el);
                }
            });
        });
    </script>
</body>
</html>