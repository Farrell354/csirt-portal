<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - JatimProv CSIRT</title>
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

    <!-- Efek Jaring Animasi di Background (Mewarisi style dari app.css) -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- KONTEN UTAMA ADMIN -->
    <div class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10 pt-16">
        
        <!-- ================= HEADER ADMIN ================= -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8 mb-10 opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            <div>
                <!-- Badge Admin -->
                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800/50 text-emerald-600 dark:text-emerald-400 font-mono text-[10px] font-bold tracking-widest mb-4 uppercase rounded-full shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    ADMIN_AUTHORIZED
                </div>
                
                <h1 class="font-display text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-2 drop-shadow-sm">
                    Manajemen <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-blue-400 dark:to-cyan-300">CSIRT</span>
                </h1>
                <p class="text-gray-500 dark:text-gray-400 font-medium text-sm md:text-base">Sistem kendali terpusat untuk publikasi berita dan verifikasi laporan kerentanan.</p>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto shrink-0">
                <!-- Tombol Verifikasi -->
                <a href="/admin/laporan" class="group/btn relative inline-flex items-center justify-center bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-bold py-3.5 px-6 rounded-xl transition-all shadow-[0_0_15px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(79,70,229,0.5)] hover:-translate-y-1 overflow-hidden">
                    <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover/btn:-translate-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                    <span class="transition-all duration-300 ease-out group-hover/btn:-translate-x-4 flex items-center gap-2">
                        <svg class="w-5 h-5 group-hover/btn:opacity-0 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Verifikasi Laporan
                    </span>
                </a>
                
                <!-- Tombol Tambah Berita -->
                <a href="/dashboard/artikel/create" class="group/btn relative inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-sm font-bold py-3.5 px-6 rounded-xl transition-all shadow-[0_0_15px_rgba(6,182,212,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.5)] hover:-translate-y-1 overflow-hidden">
                    <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover/btn:-translate-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </span>
                    <span class="transition-all duration-300 ease-out group-hover/btn:-translate-x-4 flex items-center gap-2">
                        <svg class="w-5 h-5 group-hover/btn:opacity-0 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Tulis Berita Baru
                    </span>
                </a>
            </div>
        </div>

        <!-- ================= TABEL ARTIKEL (Terminal Style) ================= -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] border border-gray-200/50 dark:border-slate-700/80 overflow-hidden relative opacity-0 animate-fade-in-up" style="animation-delay: 0.3s;">
            
            <!-- Garis Indikator Atas -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-blue-600"></div>

            <!-- Terminal Header -->
            <div class="px-6 md:px-8 py-5 border-b border-gray-200 dark:border-slate-800 bg-gray-50/50 dark:bg-[#020817]/50 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500/80 shadow-[0_0_5px_rgba(239,68,68,0.5)]"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500/80 shadow-[0_0_5px_rgba(234,179,8,0.5)]"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-500/80 shadow-[0_0_5px_rgba(16,185,129,0.5)]"></div>
                    </div>
                    <h2 class="font-mono text-gray-800 dark:text-gray-200 text-xs font-bold tracking-widest uppercase mt-0.5">Database_Artikel_Berita</h2>
                </div>
                <div class="text-[10px] font-mono text-cyan-600 dark:text-cyan-400 font-bold tracking-widest animate-pulse flex items-center gap-1.5 border border-cyan-200 dark:border-cyan-800/50 bg-cyan-50 dark:bg-cyan-900/20 px-2 py-0.5 rounded">
                    LIVE SYNC
                </div>
            </div>
            
            <!-- Konten Tabel -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead class="text-[11px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest bg-gray-50/80 dark:bg-slate-950/80 border-b border-gray-200 dark:border-slate-800">
                        <tr>
                            <th scope="col" class="px-8 py-5 text-center">No</th>
                            <th scope="col" class="px-6 py-5">Judul Artikel</th>
                            <th scope="col" class="px-6 py-5 text-center">Kategori</th>
                            <th scope="col" class="px-6 py-5 text-center">Tgl. Publikasi</th>
                            <th scope="col" class="px-6 py-5 text-center">Aksi Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-slate-800/80 bg-white dark:bg-slate-900/40">
                        @forelse($artikels as $index => $artikel)
                        <tr class="hover:bg-blue-50/50 dark:hover:bg-cyan-900/10 transition-colors group cursor-default">
                            <td class="px-8 py-5 font-mono font-bold text-gray-400 dark:text-gray-500 text-center group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-5">
                                <span class="font-bold text-slate-800 dark:text-gray-200 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors line-clamp-2 leading-relaxed" title="{{ $artikel->judul }}">
                                    {{ $artikel->judul }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded bg-blue-50/80 dark:bg-blue-900/30 text-blue-700 dark:text-cyan-400 text-[10px] font-bold uppercase tracking-wider border border-blue-200/80 dark:border-blue-800/50 shadow-sm whitespace-nowrap">
                                    {{ $artikel->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center whitespace-nowrap font-mono text-xs text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center space-x-3">
                                    <!-- Tombol Edit -->
                                    <a href="/dashboard/artikel/{{ $artikel->id }}/edit" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 hover:bg-amber-500 hover:text-white dark:hover:bg-amber-500 dark:hover:text-white transition-all border border-amber-200 dark:border-amber-800/50 hover:shadow-[0_0_15px_rgba(245,158,11,0.4)] hover:-translate-y-0.5" title="Edit Artikel">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    
                                    <!-- Tombol Hapus -->
                                    <form action="/dashboard/artikel/{{ $artikel->id }}" method="POST" class="inline m-0 p-0" onsubmit="return confirm('⚠️ PERINGATAN SISTEM: \nApakah Anda yakin ingin menghapus berita ini secara permanen? Data tidak dapat dipulihkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-500 hover:text-white dark:hover:bg-red-500 dark:hover:text-white transition-all border border-red-200 dark:border-red-800/50 hover:shadow-[0_0_15px_rgba(239,68,68,0.4)] hover:-translate-y-0.5" title="Hapus Artikel">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-2xl flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <p class="text-gray-800 dark:text-gray-200 font-bold text-lg mb-1">Database Kosong</p>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada artikel atau berita yang diterbitkan di sistem.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Footer Tabel -->
            <div class="px-6 py-4 border-t border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-[#020817]/50">
                <p class="text-[10px] text-gray-400 dark:text-gray-500 uppercase tracking-widest font-mono font-bold text-center">
                    Total Rekaman: {{ count($artikels) }} Entry
                </p>
            </div>
        </div>

    </div>

    <!-- CHATBOT -->
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
                // Beri sedikit delay agar tidak semua muncul bersamaan jika tanpa di-scroll
                setTimeout(() => el.style.opacity = '1', 600);
            });
        });
    </script>
</body>
</html>