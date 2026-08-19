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
<body class="bg-gray-50 text-gray-900 dark:bg-[#030712] dark:text-gray-100 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-cyan-500/30 selection:text-cyan-200 transition-colors duration-500">

    <!-- GLOBAL BACKGROUND (Mesh Grid & Ambient Orbs) -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-50 dark:opacity-40 z-0"></div>
    <div class="fixed -top-[20%] -left-[10%] w-[70vw] h-[70vw] bg-indigo-600/10 dark:bg-indigo-900/20 rounded-full blur-[150px] pointer-events-none z-0"></div>
    <div class="fixed bottom-[10%] -right-[10%] w-[50vw] h-[50vw] bg-cyan-500/10 dark:bg-cyan-900/20 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- QUERY STATISTIK ADMIN -->
    @php
        $totalLaporan = \App\Models\Laporan::count();
        $laporanValid = \App\Models\Laporan::where('status', 'Valid')->count();
        $laporanPending = \App\Models\Laporan::whereIn('status', ['Pending', 'Menunggu'])->count();
        $totalHunter = \App\Models\User::where('role', 'hunter')->count();
        $totalPoin = \App\Models\User::sum('poin');
    @endphp

    <main class="flex-grow max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10 pt-10">
        
        <!-- HEADER CMS -->
        <header class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6 mb-12 opacity-0 animate-fade-in-up">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 font-mono text-[10px] font-bold tracking-widest mb-4 uppercase rounded-full shadow-[0_0_15px_rgba(16,185,129,0.1)]">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    ADMINISTRATOR_ACCESS // GRANTED
                </div>
                <h1 class="font-display text-4xl lg:text-5xl font-black tracking-tight mb-3">
                    Command <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-cyan-500 dark:from-indigo-400 dark:to-cyan-400">Center</span>
                </h1>
                <p class="text-gray-500 dark:text-gray-400 font-medium text-sm lg:text-base">
                    Sistem pemantauan pusat JatimProv-CSIRT. Pantau masuknya laporan kerentanan, kelola publikasi keamanan, dan verifikasi temuan *bug hunter*.
                </p>
            </div>
            
            <div class="flex flex-wrap gap-4 shrink-0">
                <a href="/admin/laporan" class="group relative inline-flex items-center justify-center bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold text-sm py-3 px-6 rounded-xl transition-all shadow-[0_8px_30px_rgba(0,0,0,0.12)] hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10 flex items-center gap-2 font-mono uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Verifikasi Laporan
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-800 to-black dark:from-gray-100 dark:to-gray-300 opacity-0 group-hover:opacity-100 transition-opacity z-0"></div>
                </a>
            </div>
        </header>

        <!-- STATISTIK GRID (NEON BORDERS) -->
        <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-12">
            <!-- Stat 1: Laporan Masuk -->
            <div class="group relative bg-white/70 dark:bg-gray-900/60 backdrop-blur-xl border border-gray-200/50 dark:border-gray-800 rounded-3xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-amber-400 to-amber-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-amber-500/10 rounded-full blur-2xl group-hover:bg-amber-500/20 transition-colors"></div>
                
                <div class="flex items-center gap-3 mb-4 text-amber-600 dark:text-amber-500">
                    <div class="p-2 bg-amber-100 dark:bg-amber-900/30 rounded-lg border border-amber-200 dark:border-amber-800/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="font-mono text-[11px] font-bold tracking-widest uppercase">Laporan Pending</span>
                </div>
                <div class="font-display text-4xl font-black text-gray-900 dark:text-white tracking-tighter">{{ $laporanPending }}</div>
            </div>

            <!-- Stat 2: Laporan Valid -->
            <div class="group relative bg-white/70 dark:bg-gray-900/60 backdrop-blur-xl border border-gray-200/50 dark:border-gray-800 rounded-3xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-colors"></div>
                
                <div class="flex items-center gap-3 mb-4 text-emerald-600 dark:text-emerald-500">
                    <div class="p-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg border border-emerald-200 dark:border-emerald-800/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="font-mono text-[11px] font-bold tracking-widest uppercase">Total Valid</span>
                </div>
                <div class="font-display text-4xl font-black text-gray-900 dark:text-white tracking-tighter">{{ $laporanValid }}</div>
            </div>

            <!-- Stat 3: Total Hunter -->
            <div class="group relative bg-white/70 dark:bg-gray-900/60 backdrop-blur-xl border border-gray-200/50 dark:border-gray-800 rounded-3xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-cyan-400 to-cyan-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-cyan-500/10 rounded-full blur-2xl group-hover:bg-cyan-500/20 transition-colors"></div>
                
                <div class="flex items-center gap-3 mb-4 text-cyan-600 dark:text-cyan-500">
                    <div class="p-2 bg-cyan-100 dark:bg-cyan-900/30 rounded-lg border border-cyan-200 dark:border-cyan-800/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <span class="font-mono text-[11px] font-bold tracking-widest uppercase">Bug Hunter Aktif</span>
                </div>
                <div class="font-display text-4xl font-black text-gray-900 dark:text-white tracking-tighter">{{ $totalHunter }}</div>
            </div>

            <!-- Stat 4: Points Distributed -->
            <div class="group relative bg-white/70 dark:bg-gray-900/60 backdrop-blur-xl border border-gray-200/50 dark:border-gray-800 rounded-3xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-indigo-400 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-indigo-500/10 rounded-full blur-2xl group-hover:bg-indigo-500/20 transition-colors"></div>
                
                <div class="flex items-center gap-3 mb-4 text-indigo-600 dark:text-indigo-500">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg border border-indigo-200 dark:border-indigo-800/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="font-mono text-[11px] font-bold tracking-widest uppercase">Poin Didistribusikan</span>
                </div>
                <div class="font-display text-4xl font-black text-gray-900 dark:text-white tracking-tighter">{{ number_format($totalPoin) }}</div>
            </div>
        </section>

        <!-- MAIN SPLIT (CMS ARTIKEL & CHART MOCKUP) -->
        <section class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <!-- Kiri: Tabel Artikel Berita -->
            <div class="xl:col-span-2 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-gray-800 rounded-3xl overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.05)] dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)]">
                
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-black/20 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white shadow-inner">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8"></path></svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-gray-900 dark:text-white leading-none mb-1">Database Publikasi Keamanan</h2>
                            <p class="font-mono text-[10px] text-gray-500 uppercase tracking-widest">Articles_Management_Sys</p>
                        </div>
                    </div>
                    
                    <a href="/dashboard/artikel/create" class="inline-flex items-center gap-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-cyan-400 font-mono text-[11px] font-bold uppercase tracking-wider py-2 px-4 rounded-lg border border-blue-200 dark:border-blue-800/50 hover:bg-blue-600 hover:text-white dark:hover:bg-cyan-500 dark:hover:text-gray-900 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        Tulis Berita
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/80 dark:bg-black/40 border-b border-gray-100 dark:border-gray-800 font-mono text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                            <tr>
                                <th class="px-6 py-4">ID</th>
                                <th class="px-6 py-4">Judul Artikel</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Publikasi</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800/60 text-sm">
                            @forelse($artikels as $index => $artikel)
                            <tr class="hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors group">
                                <td class="px-6 py-4 font-mono text-xs text-gray-400 dark:text-gray-600 group-hover:text-cyan-500 transition-colors">
                                    #{{ str_pad($artikel->id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900 dark:text-gray-200 line-clamp-1 break-words group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">
                                        {{ $artikel->judul }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 whitespace-nowrap">
                                        {{ $artikel->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-gray-500 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex gap-2">
                                        <a href="/dashboard/artikel/{{ $artikel->id }}/edit" class="p-1.5 text-gray-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-900/30 rounded-lg transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="/dashboard/artikel/{{ $artikel->id }}" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini permanen?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <p class="font-mono text-xs tracking-widest uppercase">NO_DATA_FOUND</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kanan: Sistem / Status -->
            <div class="flex flex-col gap-6">
                <!-- Server Status / Chart Mockup -->
                <div class="bg-gradient-to-br from-indigo-900 to-black rounded-3xl p-6 border border-indigo-500/30 shadow-[0_0_30px_rgba(79,70,229,0.2)] relative overflow-hidden h-64 flex flex-col justify-between group">
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPjxyZWN0IHdpZHRoPSI0IiBoZWlnaHQ9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4xKSIvPjwvc3ZnPg==')] opacity-30"></div>
                    
                    <div class="relative z-10 flex justify-between items-start">
                        <div>
                            <p class="font-mono text-[10px] text-indigo-300 font-bold tracking-widest uppercase mb-1">Traffic Insights</p>
                            <h3 class="text-white font-bold text-lg">System Load</h3>
                        </div>
                        <span class="flex h-3 w-3 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500 border-2 border-indigo-900"></span>
                        </span>
                    </div>

                    <!-- CSS Chart Bars -->
                    <div class="relative z-10 flex items-end gap-2 h-24 mt-auto">
                        <div class="w-full bg-indigo-500/20 rounded-t-sm h-[30%] hover:bg-cyan-400 transition-all cursor-crosshair"></div>
                        <div class="w-full bg-indigo-500/20 rounded-t-sm h-[60%] hover:bg-cyan-400 transition-all cursor-crosshair"></div>
                        <div class="w-full bg-indigo-500/40 rounded-t-sm h-[45%] hover:bg-cyan-400 transition-all cursor-crosshair"></div>
                        <div class="w-full bg-cyan-500/80 rounded-t-sm h-[85%] hover:bg-cyan-300 transition-all cursor-crosshair shadow-[0_0_15px_rgba(6,182,212,0.5)]"></div>
                        <div class="w-full bg-indigo-500/20 rounded-t-sm h-[50%] hover:bg-cyan-400 transition-all cursor-crosshair"></div>
                        <div class="w-full bg-indigo-500/20 rounded-t-sm h-[25%] hover:bg-cyan-400 transition-all cursor-crosshair"></div>
                        <div class="w-full bg-indigo-500/20 rounded-t-sm h-[65%] hover:bg-cyan-400 transition-all cursor-crosshair"></div>
                    </div>
                </div>

                <!-- Quick Action List -->
                <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-gray-800 rounded-3xl p-6 shadow-lg flex-1">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Aksi Cepat
                    </h3>
                    
                    <div class="space-y-3">
                        <a href="/admin/laporan" class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-indigo-50 dark:bg-gray-800 dark:hover:bg-indigo-900/30 border border-transparent hover:border-indigo-200 dark:hover:border-indigo-800 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-gray-100">Review Laporan Masuk</p>
                                    <p class="text-[10px] font-mono text-gray-500">{{ $laporanPending }} pending verifikasi</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                        
                        <a href="/profile" class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-indigo-50 dark:bg-gray-800 dark:hover:bg-indigo-900/30 border border-transparent hover:border-indigo-200 dark:hover:border-indigo-800 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-gray-100">Konfigurasi Sistem</p>
                                    <p class="text-[10px] font-mono text-gray-500">Akses profile & preferensi</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            
        </section>

    </main>

    <x-chatbot />
</body>
</html>