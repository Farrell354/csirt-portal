<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JatimProv-CSIRT | Portal Keamanan Siber</title>
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-300 dark:bg-slate-900 dark:text-gray-200 font-sans flex flex-col min-h-screen">

    <!-- NAVBAR (Gaya Profesional) -->
    <x-navbar />

    <!-- KONTEN UTAMA -->
    <div class="flex-grow">
        
        <!-- HERO SECTION (Desain Command Center) -->
        <header class="relative w-full min-h-[calc(100vh-64px)] flex items-center justify-center bg-slate-900 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070&auto=format&fit=crop" alt="Cyber Background" class="w-full h-full object-cover opacity-20 grayscale">
                <div class="absolute inset-0 bg-gradient-to-b from-slate-950/90 via-slate-900/80 to-slate-950/95"></div>
            </div>

            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white pb-10">
                <div class="inline-block border border-kominfo/50 text-kominfo px-3 py-1 text-xs font-bold tracking-widest uppercase mb-6 bg-kominfo/10">
                    Pusat Tanggap Darurat Siber 24/7
                </div>
                <h1 class="text-4xl md:text-6xl font-black tracking-tight mb-6 drop-shadow-xl">
                    JatimProv-CSIRT
                </h1>
                <p class="text-sm md:text-base text-gray-400 mb-10 leading-relaxed max-w-3xl mx-auto">
                    Jawa Timur Province Computer Security Incident Response Team ( JatimProv-CSIRT ). Bertanggung jawab sebagai ketua adalah Kepala Dinas Komunikasi dan Informatika Provinsi Jawa Timur. Tim tanggap darurat yang beranggotakan staf teknis seksi persandian dan keamanan informasi.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="/profil" class="px-8 py-3 border border-gray-500 text-gray-300 hover:bg-white hover:text-slate-900 hover:border-white transition-all duration-300 font-semibold text-sm tracking-wide rounded-sm">Pelajari Lebih Lanjut</a>
                    <a href="/login" class="px-8 py-3 bg-kominfo border border-kominfo text-white hover:bg-kominfo_dark hover:border-kominfo_dark transition-all duration-300 font-semibold text-sm tracking-wide rounded-sm shadow-lg shadow-kominfo/20">Lapor Insiden</a>
                </div>
            </div>
        </header>

        <!-- LATEST POST SECTION (Gaya Editorial Tajam) -->
        <section class="bg-white dark:bg-slate-900 py-20 border-t border-gray-200 dark:border-slate-800 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Section Header -->
                <div class="flex justify-between items-end border-b border-gray-200 dark:border-slate-800 pb-4 mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white uppercase tracking-wide">Publikasi Terbaru</h2>
                    <a href="/artikel" class="text-sm font-bold text-kominfo hover:text-kominfo_dark dark:text-blue-500 uppercase tracking-wide">Lihat Semua &rarr;</a>
                </div>
                
                <!-- GRID ARTIKEL BERANDA (Dinamis) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($artikelTerkini as $artikel)
                <div class="group border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:border-kominfo dark:hover:border-kominfo transition-all duration-300 flex flex-col rounded-sm overflow-hidden shadow-sm hover:shadow-md">
                    <div class="relative h-48 bg-gray-900 overflow-hidden">
                        <img src="{{ $artikel->gambar }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500">
                        <div class="absolute top-4 left-4 bg-slate-900 text-white text-[10px] font-bold px-2 py-1 uppercase tracking-widest border-l-2 border-kominfo">
                            {{ $artikel->kategori }}
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="font-bold text-lg mb-3 dark:text-white leading-snug group-hover:text-kominfo transition-colors line-clamp-2" title="{{ $artikel->judul }}">
                            {{ $artikel->judul }}
                        </h3>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-6 uppercase tracking-wider font-semibold mt-auto">
                            {{ $artikel->penulis }} <span class="mx-1">|</span> {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('M d, Y') }}
                        </p>
                        <a href="/artikel/{{ $artikel->id }}" class="inline-flex items-center text-kominfo font-bold text-xs uppercase tracking-widest hover:text-kominfo_dark transition-colors">
                            Baca Selengkapnya 
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
        </section>
    </div>

    <!-- FOOTER SECTION (Tajam & Elegan) -->
    <footer class="bg-footer_bg text-gray-400 py-16 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-widest mb-6 border-b border-gray-700 pb-2">Kategori</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 bg-kominfo"></span> Peringatan Keamanan</a></li>
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 bg-kominfo"></span> Berita Keamanan Siber</a></li>
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 bg-kominfo"></span> Panduan Mitigasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-widest mb-6 border-b border-gray-700 pb-2">Artikel Terkini</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-white transition line-clamp-2">Ungkap Aktivitas APT Turla, Lebih dari 107 Ribu Indikasi Kompromi...</a></li>
                        <li><a href="#" class="hover:text-white transition line-clamp-2">Ransomware Berbasis AI Otonom Pertama Terungkap...</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-widest mb-6 border-b border-gray-700 pb-2">Kontak Kami</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Jl. Ahmad Yani 242-244 Surabaya</li>
                        <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> csirt@jatimprov.go.id</li>
                        <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> (031) 8294608</li>
                    </ul>
                </div>
                <div>
                    <div class="w-full h-40 rounded-sm overflow-hidden border border-gray-700 bg-gray-800">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.387132177435!2d112.7301073147752!3d-7.310323394723932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbaa4c8a5a4b%3A0xc6c7619eb1899134!2sDinas%20Komunikasi%20dan%20Informatika%20Provinsi%20Jawa%20Timur!5e0!3m2!1sen!2sid!4v1680000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-xs tracking-widest uppercase">
                <p>Copyright &copy; 2026 <span class="font-bold text-gray-200">JatimProv-CSIRT</span>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
<x-chatbot />
</html>