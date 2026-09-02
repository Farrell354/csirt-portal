<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSIRT CMS - Command Center</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    
    <!-- Ultra-Premium Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;900&family=JetBrains+Mono:wght@400;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Dark Mode Enforcement with Smooth Transition -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-[#020617] dark:text-gray-100 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-cyan-500/30 selection:text-cyan-200 transition-colors duration-500">

    <!-- GLOBAL BACKGROUND (Mesh Grid & Ambient Orbs) -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-40 dark:opacity-100 z-0"></div>
    <div class="fixed -top-[20%] -left-[10%] w-[70vw] h-[70vw] bg-blue-600/10 dark:bg-indigo-900/20 rounded-full blur-[150px] pointer-events-none z-0"></div>
    <div class="fixed bottom-[10%] -right-[10%] w-[50vw] h-[50vw] bg-cyan-500/10 dark:bg-cyan-900/20 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- QUERY STATISTIK ADMIN -->
    @php
        $totalLaporan   = \App\Models\Laporan::count();
        $laporanValid   = \App\Models\Laporan::where('status', 'Valid')->count();
        $laporanPending = \App\Models\Laporan::whereIn('status', ['Pending', 'Menunggu'])->count();
        $totalHunter    = \App\Models\User::where('role', 'hunter')->count();
        $totalPoin      = \App\Models\User::sum('poin');
        $systemMetrics  = $systemMetrics ?? (new \App\Services\SystemMetricService())->getMetrics();
    @endphp

    <main class="flex-grow max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10">
        
        <!-- ================= HERO COMMAND CENTER (CYBER GLASS CARD) ================= -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] border border-gray-200/50 dark:border-slate-700/80 p-8 md:p-10 mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8 relative overflow-hidden group opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            
            <!-- Garis Neon Indikator Atas -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600"></div>
            <!-- Efek Glow Kanan Bawah -->
            <div class="absolute -bottom-16 -right-16 w-48 h-48 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 font-mono text-[10px] font-bold tracking-widest mb-4 uppercase rounded-full shadow-[0_0_15px_rgba(16,185,129,0.15)]">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
                    </span>
                    ADMINISTRATOR_ACCESS // CSIRT_COMMAND_CENTER
                </div>
                <h1 class="font-display text-3xl md:text-4xl lg:text-5xl font-black text-gray-900 dark:text-white tracking-tight leading-tight">
                    Command <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-500 dark:from-cyan-400 dark:via-blue-400 dark:to-indigo-300">Center</span>
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-3 text-sm md:text-base font-medium max-w-2xl leading-relaxed">
                    Sistem pemantauan intelijen keamanan siber JatimProv-CSIRT. Kelola laporan kerentanan masuk, validasi temuan bug hunter, dan publikasikan buletin keamanan terkini.
                </p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3 shrink-0 relative z-10">
                <a href="/admin/laporan" class="group/btn relative shrink-0 inline-flex items-center justify-center bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-sm font-bold py-4 px-7 rounded-xl transition-all shadow-[0_0_20px_rgba(59,130,246,0.35)] hover:shadow-[0_0_30px_rgba(6,182,212,0.5)] hover:-translate-y-1 overflow-hidden">
                    <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover/btn:-translate-x-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                    <span class="transition-all duration-300 ease-out group-hover/btn:-translate-x-3 flex items-center gap-2 font-mono uppercase tracking-wider text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Verifikasi Laporan
                    </span>
                    <div class="absolute top-0 -left-[100%] w-1/2 h-full bg-gradient-to-r from-transparent via-white/30 to-transparent skew-x-12 animate-glare z-0 pointer-events-none"></div>
                </a>

                <a href="/admin/laporan/cetak" target="_blank" class="inline-flex items-center gap-2 px-4 py-4 rounded-xl text-xs font-mono font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800/80 border border-gray-200 dark:border-slate-700 hover:border-cyan-500/50 hover:text-cyan-400 transition-all shadow-sm hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Rekap
                </a>
            </div>
        </div>

        <!-- ================= STATISTIK GRID (THEMED CYBER CARDS) ================= -->
        <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-12">
            
            <!-- Stat 1: Laporan Pending -->
            <div class="group relative bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-slate-700/80 rounded-[2rem] p-6 shadow-lg dark:shadow-[0_10px_30px_rgba(0,0,0,0.3)] hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 to-orange-500 shadow-[0_0_10px_#f59e0b]"></div>
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-amber-500/10 rounded-full blur-2xl group-hover:bg-amber-500/20 transition-colors"></div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5 text-amber-600 dark:text-amber-400">
                        <div class="p-2.5 bg-amber-50 dark:bg-amber-900/30 rounded-xl border border-amber-200 dark:border-amber-800/50 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="font-mono text-[11px] font-bold tracking-widest uppercase">Laporan Pending</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-mono font-bold bg-amber-500/10 text-amber-500 border border-amber-500/20 uppercase">Review</span>
                </div>
                <div class="font-display text-4xl font-black text-gray-900 dark:text-white tracking-tighter">{{ $laporanPending }}</div>
                <p class="text-[11px] font-mono text-gray-500 dark:text-gray-400 mt-2 flex items-center gap-1">
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-amber-400"></span> Menunggu tindakan CSIRT
                </p>
            </div>

            <!-- Stat 2: Total Valid -->
            <div class="group relative bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-slate-700/80 rounded-[2rem] p-6 shadow-lg dark:shadow-[0_10px_30px_rgba(0,0,0,0.3)] hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-teal-500 shadow-[0_0_10px_#10b981]"></div>
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-colors"></div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5 text-emerald-600 dark:text-emerald-400">
                        <div class="p-2.5 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl border border-emerald-200 dark:border-emerald-800/50 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="font-mono text-[11px] font-bold tracking-widest uppercase">Total Valid</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-mono font-bold bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 uppercase">Approved</span>
                </div>
                <div class="font-display text-4xl font-black text-gray-900 dark:text-white tracking-tighter">{{ $laporanValid }}</div>
                <p class="text-[11px] font-mono text-gray-500 dark:text-gray-400 mt-2 flex items-center gap-1">
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Telah terverifikasi & scored
                </p>
            </div>

            <!-- Stat 3: Total Hunter -->
            <div class="group relative bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-slate-700/80 rounded-[2rem] p-6 shadow-lg dark:shadow-[0_10px_30px_rgba(0,0,0,0.3)] hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 to-blue-500 shadow-[0_0_10px_#06b6d4]"></div>
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-cyan-500/10 rounded-full blur-2xl group-hover:bg-cyan-500/20 transition-colors"></div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5 text-cyan-600 dark:text-cyan-400">
                        <div class="p-2.5 bg-cyan-50 dark:bg-cyan-900/30 rounded-xl border border-cyan-200 dark:border-cyan-800/50 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <span class="font-mono text-[11px] font-bold tracking-widest uppercase">Bug Hunter</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-mono font-bold bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 uppercase">Network</span>
                </div>
                <div class="font-display text-4xl font-black text-gray-900 dark:text-white tracking-tighter">{{ $totalHunter }}</div>
                <p class="text-[11px] font-mono text-gray-500 dark:text-gray-400 mt-2 flex items-center gap-1">
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-cyan-400"></span> Peneliti keamanan aktif
                </p>
            </div>

            <!-- Stat 4: Points Distributed -->
            <div class="group relative bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-slate-700/80 rounded-[2rem] p-6 shadow-lg dark:shadow-[0_10px_30px_rgba(0,0,0,0.3)] hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-purple-500 shadow-[0_0_10px_#6366f1]"></div>
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-indigo-500/10 rounded-full blur-2xl group-hover:bg-indigo-500/20 transition-colors"></div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5 text-indigo-600 dark:text-indigo-400">
                        <div class="p-2.5 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl border border-indigo-200 dark:border-indigo-800/50 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="font-mono text-[11px] font-bold tracking-widest uppercase">Reward Poin</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-mono font-bold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 uppercase">Bounty</span>
                </div>
                <div class="font-display text-4xl font-black text-gray-900 dark:text-white tracking-tighter">{{ number_format($totalPoin) }}</div>
                <p class="text-[11px] font-mono text-gray-500 dark:text-gray-400 mt-2 flex items-center gap-1">
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-indigo-400"></span> Total reputasi disalurkan
                </p>
            </div>
        </section>

        <!-- ================= MAIN SPLIT (CMS ARTIKEL & REAL-TIME TELEMETRY) ================= -->
        <section class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <!-- Kiri: Tabel Publikasi Berita / Artikel -->
            <div class="xl:col-span-2 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-slate-700/80 rounded-[2rem] overflow-hidden shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] relative">
                
                <!-- Garis Aksen Neon Atas -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600"></div>

                <div class="px-7 py-6 border-b border-gray-100 dark:border-slate-800/80 bg-gray-50/50 dark:bg-slate-950/40 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8"></path></svg>
                        </div>
                        <div>
                            <h2 class="font-display font-bold text-lg text-gray-900 dark:text-white leading-tight">Database Publikasi Keamanan</h2>
                            <p class="font-mono text-[10px] text-cyan-600 dark:text-cyan-400 font-bold uppercase tracking-widest">ARTICLES_MANAGEMENT_SYS</p>
                        </div>
                    </div>
                    
                    <a href="/dashboard/artikel/create" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-mono text-xs font-bold uppercase tracking-wider py-2.5 px-5 rounded-xl transition-all shadow-[0_0_15px_rgba(6,182,212,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.5)] hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        Tulis Berita
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/80 dark:bg-slate-950/60 border-b border-gray-100 dark:border-slate-800/80 font-mono text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                            <tr>
                                <th class="px-7 py-4">ID</th>
                                <th class="px-7 py-4">Judul Artikel</th>
                                <th class="px-7 py-4">Kategori</th>
                                <th class="px-7 py-4">Publikasi</th>
                                <th class="px-7 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-800/60 text-sm">
                            @forelse($artikels as $index => $artikel)
                            <tr class="hover:bg-blue-50/30 dark:hover:bg-slate-800/40 transition-colors group">
                                <td class="px-7 py-4 font-mono text-xs text-gray-400 dark:text-gray-500 group-hover:text-cyan-400 transition-colors">
                                    #{{ str_pad((string) $artikel->id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-7 py-4">
                                    <div class="font-bold text-gray-900 dark:text-gray-200 line-clamp-1 break-words group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">
                                        {{ $artikel->judul }}
                                    </div>
                                </td>
                                <td class="px-7 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-mono font-bold border border-cyan-200 dark:border-cyan-800/50 text-cyan-700 dark:text-cyan-300 bg-cyan-50 dark:bg-cyan-950/40 whitespace-nowrap">
                                        {{ $artikel->kategori }}
                                    </span>
                                </td>
                                <td class="px-7 py-4 font-mono text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d M Y') }}
                                </td>
                                <td class="px-7 py-4 text-right">
                                    <div class="inline-flex gap-2">
                                        <a href="/dashboard/artikel/{{ $artikel->id }}/edit" class="p-2 text-gray-400 hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/30 rounded-xl transition-all" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="/dashboard/artikel/{{ $artikel->id }}" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini secara permanen?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-xl transition-all" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-7 py-16 text-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-gray-200 dark:border-slate-700 shadow-inner">
                                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8"></path></svg>
                                    </div>
                                    <h4 class="font-display font-bold text-base text-gray-900 dark:text-white mb-1">Belum Ada Publikasi Keamanan</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium max-w-sm mx-auto mb-4">Tulis buletin keamanan atau himbauan mitigasi celah untuk dibagikan kepada seluruh OPD dan publik.</p>
                                    <a href="/dashboard/artikel/create" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-mono font-bold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-cyan-400 border border-blue-200 dark:border-blue-800/50 hover:bg-blue-600 hover:text-white transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                        Buat Artikel Pertama
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kanan: Real-Time Telemetry & Aksi Cepat -->
            <div class="flex flex-col gap-8">
                
                <!-- Real Server Status / Telemetry Monitor -->
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] p-7 border border-gray-200/50 dark:border-slate-700/80 shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] relative overflow-hidden flex flex-col justify-between group">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 via-indigo-500 to-blue-600"></div>
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(99,102,241,0.12),transparent_60%)] pointer-events-none"></div>
                    
                    <!-- Header -->
                    <div class="relative z-10 flex justify-between items-start mb-5">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-mono text-[10px] text-cyan-600 dark:text-cyan-400 font-bold tracking-widest uppercase">HARDWARE TELEMETRY</span>
                                <span id="metric-sync-badge" class="px-2 py-0.5 rounded-full text-[9px] font-mono font-bold bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30">LIVE</span>
                            </div>
                            <h3 class="text-gray-900 dark:text-white font-display font-black text-xl tracking-tight flex items-center gap-2">
                                System Load
                                <span class="text-xs font-mono text-indigo-600 dark:text-indigo-400 font-normal">({{ $systemMetrics['cores'] }} Cores)</span>
                            </h3>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider {{ $systemMetrics['status'] === 'CRITICAL' ? 'bg-red-500/20 text-red-600 dark:text-red-300 border border-red-500/40' : ($systemMetrics['status'] === 'ELEVATED' ? 'bg-amber-500/20 text-amber-600 dark:text-amber-300 border border-amber-500/40' : 'bg-emerald-500/20 text-emerald-600 dark:text-emerald-300 border border-emerald-500/40') }}" id="system-status-pill">
                                <span class="w-1.5 h-1.5 rounded-full {{ $systemMetrics['status'] === 'CRITICAL' ? 'bg-red-500 animate-ping' : ($systemMetrics['status'] === 'ELEVATED' ? 'bg-amber-500' : 'bg-emerald-500 animate-pulse') }}" id="system-status-dot"></span>
                                <span id="system-status-text">{{ $systemMetrics['status'] }}</span>
                            </span>
                            <p class="text-[9px] font-mono text-gray-400 mt-1" id="metric-timestamp-label">Sync: <span id="metric-timestamp">{{ $systemMetrics['timestamp'] }}</span></p>
                        </div>
                    </div>

                    <!-- Metric Badges Row (Angka Nyata) -->
                    <div class="relative z-10 grid grid-cols-3 gap-2.5 mb-5 font-mono">
                        <div class="bg-gray-50/80 dark:bg-slate-950/60 border border-gray-200 dark:border-slate-800 rounded-2xl p-3 text-center">
                            <span class="text-[9px] uppercase tracking-wider text-indigo-600 dark:text-indigo-400 block mb-0.5 font-bold">CPU Load</span>
                            <span class="text-base font-black text-gray-900 dark:text-white" id="metric-cpu">{{ $systemMetrics['cpu_percent'] }}%</span>
                            <span class="text-[9px] text-gray-500 dark:text-gray-400 block truncate" id="metric-cpu-load">1m: {{ $systemMetrics['load_1m'] }}</span>
                        </div>
                        <div class="bg-gray-50/80 dark:bg-slate-950/60 border border-gray-200 dark:border-slate-800 rounded-2xl p-3 text-center">
                            <span class="text-[9px] uppercase tracking-wider text-cyan-600 dark:text-cyan-400 block mb-0.5 font-bold">RAM Usage</span>
                            <span class="text-base font-black text-gray-900 dark:text-white" id="metric-ram">{{ $systemMetrics['ram_percent'] }}%</span>
                            <span class="text-[9px] text-gray-500 dark:text-gray-400 block truncate" id="metric-ram-used">{{ $systemMetrics['ram_used_gb'] }}/{{ $systemMetrics['ram_total_gb'] }}G</span>
                        </div>
                        <div class="bg-gray-50/80 dark:bg-slate-950/60 border border-gray-200 dark:border-slate-800 rounded-2xl p-3 text-center">
                            <span class="text-[9px] uppercase tracking-wider text-emerald-600 dark:text-emerald-400 block mb-0.5 font-bold">Disk Space</span>
                            <span class="text-base font-black text-gray-900 dark:text-white" id="metric-disk">{{ $systemMetrics['disk_percent'] }}%</span>
                            <span class="text-[9px] text-gray-500 dark:text-gray-400 block truncate" id="metric-disk-used">{{ $systemMetrics['disk_used_gb'] }}/{{ $systemMetrics['disk_total_gb'] }}G</span>
                        </div>
                    </div>

                    <!-- Real Metric Dynamic Bars -->
                    <div class="relative z-10">
                        <div class="flex items-end justify-between gap-2 h-20 px-2 pt-2 bg-gray-50/80 dark:bg-slate-950/60 rounded-2xl border border-gray-200/80 dark:border-slate-800/80" id="metric-bars-container">
                            @foreach($systemMetrics['bars'] as $idx => $bar)
                                <div class="flex-1 flex flex-col items-center h-full justify-end group/bar relative">
                                    <span class="text-[9px] font-mono font-bold text-cyan-600 dark:text-cyan-400 mb-1 opacity-90 transition-opacity bar-val-label" id="bar-val-{{ $idx }}">
                                        {{ $bar['val'] }}
                                    </span>
                                    <div class="w-full bg-gradient-to-t from-blue-600 to-cyan-400 rounded-t transition-all duration-700 ease-out shadow-[0_0_8px_rgba(6,182,212,0.35)] bar-pillar"
                                         id="bar-pillar-{{ $idx }}"
                                         style="height: {{ max(12, $bar['pct']) }}%;"></div>
                                    <span class="text-[8px] font-mono text-gray-500 dark:text-gray-400 mt-1 uppercase truncate max-w-full">
                                        {{ $bar['label'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quick Action List -->
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-slate-700/80 rounded-[2rem] p-7 shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] relative overflow-hidden flex-1">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-cyan-400"></div>

                    <h3 class="font-display font-bold text-lg text-gray-900 dark:text-white mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Aksi Cepat Admin
                    </h3>
                    
                    <div class="space-y-3 font-medium">
                        <a href="/admin/laporan" class="flex items-center justify-between p-3.5 rounded-2xl bg-gray-50/80 hover:bg-blue-50 dark:bg-slate-950/60 dark:hover:bg-slate-800/60 border border-gray-200/60 dark:border-slate-800/80 hover:border-blue-300 dark:hover:border-cyan-800 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center border border-amber-500/20 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">Review Laporan Masuk</p>
                                    <p class="text-[11px] font-mono text-gray-500">{{ $laporanPending }} laporan menunggu validasi</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-cyan-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                        
                        <a href="/admin/laporan/cetak" target="_blank" class="flex items-center justify-between p-3.5 rounded-2xl bg-gray-50/80 hover:bg-emerald-50 dark:bg-slate-950/60 dark:hover:bg-slate-800/60 border border-gray-200/60 dark:border-slate-800/80 hover:border-emerald-300 dark:hover:border-emerald-800 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center border border-emerald-500/20 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-gray-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">Cetak Rekap Laporan</p>
                                    <p class="text-[11px] font-mono text-gray-500">Ekspor berkas audit resmi</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>

                        <a href="/settings" class="flex items-center justify-between p-3.5 rounded-2xl bg-gray-50/80 hover:bg-cyan-50 dark:bg-slate-950/60 dark:hover:bg-slate-800/60 border border-gray-200/60 dark:border-slate-800/80 hover:border-cyan-300 dark:hover:border-cyan-800 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-cyan-500/10 text-cyan-600 dark:text-cyan-400 flex items-center justify-center border border-cyan-500/20 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-gray-100 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">Konfigurasi Akun & Sistem</p>
                                    <p class="text-[11px] font-mono text-gray-500">Kelola profil, sandi, & preferensi</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-cyan-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            
        </section>

    </main>

    <x-chatbot />

    <!-- LIVE TELEMETRY POLLING SCRIPT -->
    <script nonce="{{ csp_nonce() }}">
        (function() {
            const fetchMetrics = async () => {
                try {
                    const res = await fetch('/api/system-metrics', {
                        headers: { 'Accept': 'application/json' }
                    });
                    if (!res.ok) return;
                    const d = await res.json();
                    
                    // Update main badges
                    const cpuEl = document.getElementById('metric-cpu');
                    const cpuLoadEl = document.getElementById('metric-cpu-load');
                    const ramEl = document.getElementById('metric-ram');
                    const ramUsedEl = document.getElementById('metric-ram-used');
                    const diskEl = document.getElementById('metric-disk');
                    const diskUsedEl = document.getElementById('metric-disk-used');
                    const timeEl = document.getElementById('metric-timestamp');
                    const statusPill = document.getElementById('system-status-pill');
                    const statusText = document.getElementById('system-status-text');
                    const statusDot = document.getElementById('system-status-dot');

                    if (cpuEl) cpuEl.textContent = d.cpu_percent + '%';
                    if (cpuLoadEl) cpuLoadEl.textContent = '1m: ' + d.load_1m;
                    if (ramEl) ramEl.textContent = d.ram_percent + '%';
                    if (ramUsedEl) ramUsedEl.textContent = d.ram_used_gb + '/' + d.ram_total_gb + 'G';
                    if (diskEl) diskEl.textContent = d.disk_percent + '%';
                    if (diskUsedEl) diskUsedEl.textContent = d.disk_used_gb + '/' + d.disk_total_gb + 'G';
                    if (timeEl) timeEl.textContent = d.timestamp;

                    if (statusText) statusText.textContent = d.status;
                    if (statusPill && statusDot) {
                        if (d.status === 'CRITICAL') {
                            statusPill.className = 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-red-500/20 text-red-600 dark:text-red-300 border border-red-500/40';
                            statusDot.className = 'w-1.5 h-1.5 rounded-full bg-red-500 animate-ping';
                        } else if (d.status === 'ELEVATED') {
                            statusPill.className = 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-amber-500/20 text-amber-600 dark:text-amber-300 border border-amber-500/40';
                            statusDot.className = 'w-1.5 h-1.5 rounded-full bg-amber-500';
                        } else {
                            statusPill.className = 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-emerald-500/20 text-emerald-600 dark:text-emerald-300 border border-emerald-500/40';
                            statusDot.className = 'w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse';
                        }
                    }

                    // Update individual chart bars
                    if (Array.isArray(d.bars)) {
                        d.bars.forEach((bar, idx) => {
                            const valLabel = document.getElementById('bar-val-' + idx);
                            const pillar = document.getElementById('bar-pillar-' + idx);
                            if (valLabel) valLabel.textContent = bar.val;
                            if (pillar) pillar.style.height = Math.max(12, bar.pct) + '%';
                        });
                    }
                } catch (err) {
                    console.debug('Telemetry sync paused:', err);
                }
            };

            // Poll every 4 seconds
            setInterval(fetchMetrics, 4000);
        })();
    </script>
</body>
</html>
