<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel & Berita - JatimProv-CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        kominfo: '#0056B3',
                        kominfo_dark: '#0A3A64',
                        accent: '#F59E0B',
                        footer_bg: '#161b22'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 font-sans flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <x-navbar />

    <!-- KONTEN UTAMA -->
    <div class="flex-grow bg-white dark:bg-slate-900 transition-colors duration-300">
        
        <!-- HEADER HALAMAN -->
        <div class="bg-slate-50 dark:bg-slate-800/50 border-b border-gray-200 dark:border-slate-700 py-16 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="max-w-2xl">
                    <h1 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white tracking-tight mb-4">Artikel & Publikasi</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400">Peringatan keamanan, berita siber terbaru, dan buletin resmi dari JatimProv-CSIRT.</p>
                </div>
                
                <!-- Kotak Pencarian -->
                <form action="/artikel" method="GET" class="w-full md:w-80 relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..." class="w-full bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-600 text-sm px-4 py-3 rounded-sm outline-none focus:border-kominfo dark:focus:border-blue-500 transition-colors text-gray-700 dark:text-gray-200 shadow-sm">
                    <button type="submit" class="absolute right-3 top-3 text-gray-400 dark:text-gray-500 hover:text-kominfo dark:hover:text-blue-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            
            <!-- GRID ARTIKEL (Dinamis dari Database) -->
            <!-- AREA KONTEN ARTIKEL -->
            @if($artikels->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($artikels as $artikel)
                        <!-- Kartu Artikel -->
                        <div class="group border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 hover:border-kominfo dark:hover:border-blue-500 transition-all duration-300 flex flex-col rounded-sm overflow-hidden shadow-sm hover:shadow-md">
                            <div class="relative h-48 bg-gray-900 overflow-hidden">
                                <img src="{{ $artikel->gambar }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover opacity-70 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500">
                                <div class="absolute top-4 left-4 bg-slate-900 text-white text-[10px] font-bold px-2 py-1 uppercase tracking-widest border-l-2 border-kominfo">
                                    {{ $artikel->kategori }}
                                </div>
                            </div>
                            <div class="p-6 flex-grow flex flex-col">
                                <h3 class="font-bold text-lg mb-3 text-slate-900 dark:text-white leading-snug group-hover:text-kominfo dark:group-hover:text-blue-400 transition-colors line-clamp-2" title="{{ $artikel->judul }}">
                                    {{ $artikel->judul }}
                                </h3>
                                <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-6 uppercase tracking-wider font-semibold mt-auto">
                                    {{ $artikel->penulis }} <span class="mx-1 text-gray-300 dark:text-gray-600">|</span> {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('M d, Y') }}
                                </p>
                                <a href="/artikel/{{ $artikel->id }}" class="inline-flex items-center text-kominfo dark:text-blue-400 font-bold text-xs uppercase tracking-widest hover:text-kominfo_dark dark:hover:text-blue-300 transition-colors">
                                    Baca Selengkapnya 
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination (Navigasi Halaman Otomatis) -->
                <div class="flex justify-center mt-10">
                    {{ $artikels->links() }}
                </div>
            @else
                <!-- Tampilan Jika Pencarian Kosong -->
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-gray-300 dark:text-slate-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="text-xl font-bold text-gray-600 dark:text-gray-300">Artikel tidak ditemukan</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Coba gunakan kata kunci pencarian yang lain, misalnya: "Malware" atau "Ransomware".</p>
                    <a href="/artikel" class="inline-block mt-6 px-6 py-2 bg-kominfo dark:bg-blue-600 hover:bg-kominfo_dark dark:hover:bg-blue-700 text-white text-sm font-bold rounded-sm transition-colors shadow-sm">Tampilkan Semua Artikel</a>
                </div>
            @endif

        </div>
    </div>

    <x-footer />

    <!-- WIDGET CHATBOT CSIRT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />
</body>
</html>