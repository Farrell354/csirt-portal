<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Laporan - JatimProv CSIRT</title>
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-indigo-500 selection:text-white">

    <!-- Latar Belakang Mesh Grid & Ambient Glow -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 animate-grid-flow z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-indigo-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <div class="flex-grow max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10 pt-16">
        
        <!-- ================= HEADER & TOMBOL KEMBALI ================= -->
        <div class="mb-10 opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-xs font-bold text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 mb-6 transition-transform hover:-translate-x-2 duration-300 uppercase tracking-widest bg-white/50 dark:bg-slate-900/50 px-4 py-2 rounded-full border border-gray-200 dark:border-slate-800 backdrop-blur-sm shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Dashboard
            </a>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <!-- Cyber Badge -->
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-200 dark:border-indigo-800/50 text-indigo-600 dark:text-indigo-400 font-mono text-[10px] font-bold tracking-widest mb-4 uppercase rounded-full shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                        </span>
                        DATA_CLEARANCE
                    </div>
                    <h1 class="font-display text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-2 drop-shadow-sm">Verifikasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-500 dark:from-indigo-400 dark:to-violet-400">Laporan</span></h1>
                    <p class="text-gray-500 dark:text-gray-400 font-medium text-sm md:text-base max-w-2xl">Tinjau artefak, validasi kerentanan, dan distribusikan poin reputasi secara proporsional kepada para analis.</p>
                </div>
                
                <!-- TOMBOL CETAK LAPORAN -->
                <a href="/admin/laporan/cetak" target="_blank" class="group/btn relative inline-flex items-center justify-center bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-500 hover:to-teal-400 text-white text-sm font-bold py-3.5 px-6 rounded-xl transition-all shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:shadow-[0_0_25px_rgba(16,185,129,0.5)] hover:-translate-y-1 overflow-hidden shrink-0">
                    <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover/btn:-translate-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    </span>
                    <span class="transition-all duration-300 ease-out group-hover/btn:-translate-x-4 flex items-center gap-2">
                        <svg class="w-5 h-5 group-hover/btn:opacity-0 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Cetak Rekap (PDF)
                    </span>
                </a>
            </div>
        </div>

        <!-- Notifikasi Sukses Validasi -->
        @if(session('pesan'))
            <div class="mb-8 bg-emerald-50/90 dark:bg-emerald-900/30 backdrop-blur-md border border-emerald-400/50 dark:border-emerald-700/50 text-emerald-700 dark:text-emerald-400 px-5 py-4 rounded-2xl flex items-center gap-4 shadow-lg opacity-0 animate-fade-in-up">
                <div class="p-2 bg-emerald-100 dark:bg-emerald-800/50 rounded-lg shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-bold text-sm tracking-wide">{{ session('pesan') }}</span>
            </div>
        @endif

        <!-- ================= SEARCH BAR (BLIND-INDEX & MULTI-FIELD) ================= -->
        <div class="mb-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.15s;">
            <form action="{{ route('admin.laporan.index') }}" method="GET" class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-slate-800 p-2.5 rounded-2xl shadow-lg flex flex-col sm:flex-row items-center gap-2.5">
                <div class="relative flex-1 w-full">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 dark:text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari email hunter (Blind-Index SHA-256), UUID, target URL, jenis kerentanan..."
                           class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-slate-950/60 border border-gray-200 dark:border-slate-800 rounded-xl text-xs font-medium text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-mono">
                </div>
                <div class="flex items-center gap-2 w-full sm:w-auto shrink-0">
                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-500 hover:from-indigo-500 hover:to-violet-400 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-all shadow-md hover:shadow-indigo-500/25 flex items-center justify-center gap-1.5 cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cari Tiket
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.laporan.index') }}" class="px-4 py-2.5 bg-gray-200 dark:bg-slate-800 hover:bg-gray-300 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-300 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Reset
                        </a>
                    @endif
                </div>
            </form>
            @if(request('search'))
                <div class="mt-2.5 px-3 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 font-mono">
                    <span>Hasil pencarian: <strong class="text-indigo-600 dark:text-indigo-400">"{{ request('search') }}"</strong> ({{ $laporans->total() }} tiket ditemukan)</span>
                    <span class="text-[10px] text-gray-400 uppercase tracking-wider">Deterministic Blind-Index Search Active</span>
                </div>
            @endif
        </div>

        <!-- ================= DAFTAR LAPORAN (KARTU DINAMIS) ================= -->
        <div class="space-y-8">
            @forelse($laporans as $index => $laporan)
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] shadow-lg hover:shadow-2xl dark:shadow-[0_10px_30px_rgba(0,0,0,0.3)] border border-gray-200/50 dark:border-slate-700/80 overflow-hidden transition-all duration-500 opacity-0 animate-fade-in-up relative group" style="animation-delay: {{ 0.2 + ($index * 0.1) }}s;">
                    
                    <!-- Garis Neon Indikator Atas (Warna berubah sesuai status) -->
                    @if($laporan->status === 'Menunggu')
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 to-amber-600"></div>
                    @elseif($laporan->status === 'Valid')
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-emerald-600"></div>
                    @else
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-red-600"></div>
                    @endif

                    <!-- Header Card -->
                    <div class="p-6 md:px-8 md:py-6 border-b border-gray-100 dark:border-slate-800/80 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gray-50/50 dark:bg-slate-950/30 transition-colors">
                        <div>
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="px-2.5 py-1 bg-gray-200 dark:bg-slate-800 text-gray-700 dark:text-gray-300 text-[10px] font-black uppercase tracking-widest rounded-md border border-gray-300 dark:border-slate-700 font-mono shadow-sm">
                                    ID: #{{ strtoupper(substr((string) $laporan->id, 0, 8)) }}
                                </span>
                                <span class="text-[11px] font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    {{ $laporan->jenis_kerentanan }}
                                </span>
                            </div>
                            <h3 class="font-mono text-lg md:text-xl font-bold text-slate-900 dark:text-white truncate max-w-2xl" title="{{ $laporan->target_url }}">
                                {{ $laporan->target_url }}
                            </h3>
                        </div>
                        <div class="shrink-0 flex items-center gap-3">
                            @if($laporan->status === 'Menunggu')
                                <span class="inline-flex items-center gap-1.5 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-[11px] font-black uppercase tracking-widest px-3 py-2 rounded-lg border border-amber-200 dark:border-amber-800/50 shadow-sm">
                                    <svg class="w-3.5 h-3.5 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Menunggu Review
                                </span>
                            @elseif($laporan->status === 'Valid')
                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-[11px] font-black uppercase tracking-widest px-3 py-2 rounded-lg border border-emerald-200 dark:border-emerald-800/50 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg> Valid (+{{ $laporan->poin_diberikan }} Pts)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-[11px] font-black uppercase tracking-widest px-3 py-2 rounded-lg border border-red-200 dark:border-red-800/50 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg> Ditolak
                                </span>
                            @endif

                            {{-- Link to dedicated review page (UUID in URL) --}}
                            <a href="{{ route('admin.laporan.show', $laporan) }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600/10 hover:bg-indigo-600/20 text-indigo-600 dark:text-indigo-400 border border-indigo-300/40 dark:border-indigo-700/50 rounded-lg text-[11px] font-black uppercase tracking-widest transition-all hover:-translate-y-0.5 shadow-sm">
                                Tinjau Detail
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Body Card (Isi Laporan) -->
                    <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Reporter — Zero-Knowledge Admin View (UU PDP No. 27/2022) --}}
                        <div class="bg-gray-50/50 dark:bg-slate-950/30 p-5 rounded-2xl border border-gray-100 dark:border-slate-800">
                            <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg> Dilaporkan Oleh
                            </div>
                            @if($laporan->is_anonymous)
                                <div class="mt-1 space-y-1">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 text-[10px] font-black uppercase tracking-widest rounded-lg border border-indigo-300 dark:border-indigo-700/50">
                                            <svg class="w-2.5 h-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                            Anonim
                                        </span>
                                        @if($laporan->pseudonym)
                                            <span class="font-mono text-xs font-bold text-indigo-500 dark:text-indigo-400">{{ $laporan->pseudonym }}</span>
                                        @endif
                                    </div>
                                    <p class="text-[10px] text-gray-400 dark:text-gray-600">UU PDP No. 27/2022</p>
                                </div>
                            @else
                                <div class="font-display font-bold text-lg text-slate-900 dark:text-gray-100">
                                    {{ $laporan->user->name ?? 'Unknown Hunter' }}
                                </div>
                            @endif
                        </div>

                        {{-- Waktu Penemuan --}}
                        <div class="bg-gray-50/50 dark:bg-slate-950/30 p-5 rounded-2xl border border-gray-100 dark:border-slate-800">
                            <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> Waktu Penemuan
                            </div>
                            <div class="font-mono text-sm font-bold text-slate-800 dark:text-gray-200 mt-1">
                                {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y - H:i:s') }} <span class="text-blue-500 text-xs ml-1">WIB</span>
                            </div>
                        </div>

                        {{-- Enhancement 4: Scan Status Badge --}}
                        <div class="bg-gray-50/50 dark:bg-slate-950/30 p-5 rounded-2xl border border-gray-100 dark:border-slate-800">
                            <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg> Scan PoC
                            </div>
                            @if($laporan->scan_status === 'clean')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-xs font-bold rounded-lg border border-emerald-200 dark:border-emerald-800">🟢 Clean</span>
                            @elseif($laporan->scan_status === 'quarantined')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-bold rounded-lg border border-red-200 dark:border-red-800">🔴 Quarantined</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs font-bold rounded-lg border border-amber-200 dark:border-amber-800">🟡 Pending</span>
                            @endif
                        </div>

                        {{-- Enhancement 1: CVSS Score display (if assigned) --}}
                        @if($laporan->cvss_score !== null)
                        <div class="md:col-span-3 bg-violet-50/50 dark:bg-violet-950/20 p-4 rounded-2xl border border-violet-200 dark:border-violet-800/50 flex flex-wrap items-center gap-4">
                            <div class="text-[10px] font-black text-violet-500 uppercase tracking-widest">CVSS v3.1 Score</div>
                            <span class="text-2xl font-black font-mono text-violet-700 dark:text-violet-300">{{ number_format($laporan->cvss_score, 1) }}</span>
                            @php
                                $rating = match(true) {
                                    $laporan->cvss_score === 0.0   => ['None',     'bg-gray-100 text-gray-700'],
                                    $laporan->cvss_score < 4.0     => ['Low',      'bg-blue-100 text-blue-700'],
                                    $laporan->cvss_score < 7.0     => ['Medium',   'bg-amber-100 text-amber-700'],
                                    $laporan->cvss_score < 9.0     => ['High',     'bg-orange-100 text-orange-700'],
                                    default                         => ['Critical', 'bg-red-100 text-red-700'],
                                };
                            @endphp
                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold {{ $rating[1] }}">{{ $rating[0] }}</span>
                            <code class="text-[10px] font-mono text-violet-500 dark:text-violet-400 bg-violet-100 dark:bg-violet-900/30 px-3 py-1 rounded-lg truncate max-w-xs">{{ $laporan->cvss_vector }}</code>
                        </div>
                        @endif

                        
                        <div class="md:col-span-2">
                            <div class="text-[11px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                                Deskripsi & Dampak
                            </div>
                            <div class="bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-800 p-5 rounded-2xl text-sm text-gray-700 dark:text-gray-300 leading-relaxed font-medium shadow-inner">
                                {{ $laporan->deskripsi }}
                            </div>
                        </div>

                        @php $forensics = $laporan->getForensics(); @endphp

                        <!-- Terminal PoC / Forensic Card Component -->
                        <div class="md:col-span-3" x-data="{ showRawModal: false, showOverrideModal: false, copied: false }">
                            @if($laporan->scan_status === 'quarantined')
                                <!-- Interactive Forensic Card for Quarantined File -->
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div class="text-[11px] font-black text-red-500 dark:text-red-400 uppercase tracking-widest flex items-center gap-2">
                                            <svg class="w-4 h-4 text-red-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"/></svg>
                                            Analisis Forensik File PoC
                                        </div>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-red-300 dark:border-red-700/50">
                                            <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                                            FILE DIKARANTINA
                                        </span>
                                    </div>

                                    <div class="rounded-2xl overflow-hidden shadow-xl border border-red-300/80 dark:border-red-800/80 bg-red-50/60 dark:bg-[#0f0408]/90 backdrop-blur-md">
                                        <!-- Forensic Card Header -->
                                        <div class="bg-red-100/80 dark:bg-red-950/80 px-5 py-3 border-b border-red-200 dark:border-red-800/50 flex flex-wrap items-center justify-between gap-2">
                                            <div class="flex items-center gap-2">
                                                <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                                                <span class="text-xs font-mono font-bold text-red-900 dark:text-red-300">FORENSIC_EVIDENCE // {{ basename($laporan->bukti_poc) }}</span>
                                            </div>
                                            <span class="text-[11px] font-mono text-red-700 dark:text-red-400 font-bold">NIST SP 800-61 Triaged</span>
                                        </div>

                                        <!-- Forensic Pillars Grid -->
                                        <div class="p-5 space-y-4">
                                            <!-- Detection Reason -->
                                            <div class="bg-white/80 dark:bg-slate-950/60 p-3.5 rounded-xl border border-red-200/60 dark:border-red-900/40">
                                                <div class="text-[10px] font-black text-red-600 dark:text-red-400 uppercase tracking-widest mb-1 flex items-center gap-1.5">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    Alasan Deteksi Anomali
                                                </div>
                                                <div class="font-mono text-xs text-red-700 dark:text-red-300 font-semibold break-words">
                                                    {{ $forensics['detection_reason'] }}
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                                <!-- SHA-256 Hash with Copy -->
                                                <div class="bg-white/80 dark:bg-slate-950/60 p-3 rounded-xl border border-red-200/60 dark:border-red-900/40">
                                                    <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1 flex items-center justify-between">
                                                        <span>SHA-256 Hash</span>
                                                        <button type="button" @click="navigator.clipboard.writeText('{{ $forensics['sha256'] }}'); copied = true; setTimeout(() => copied = false, 2000)" class="text-[10px] text-red-600 dark:text-red-400 hover:underline flex items-center gap-1 font-bold">
                                                            <span x-text="copied ? 'Tersalin!' : 'Salin'"></span>
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                                        </button>
                                                    </div>
                                                    <div class="font-mono text-xs text-slate-800 dark:text-red-300 font-bold truncate" title="{{ $forensics['sha256'] }}">
                                                        {{ $forensics['sha256_short'] }}
                                                    </div>
                                                </div>

                                                <!-- File Size -->
                                                <div class="bg-white/80 dark:bg-slate-950/60 p-3 rounded-xl border border-red-200/60 dark:border-red-900/40">
                                                    <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">
                                                        Ukuran File
                                                    </div>
                                                    <div class="font-mono text-xs text-slate-800 dark:text-gray-200 font-bold">
                                                        {{ $forensics['size_formatted'] }} ({{ number_format($forensics['size_bytes']) }} B)
                                                    </div>
                                                </div>

                                                <!-- Detected MIME Signature -->
                                                <div class="bg-white/80 dark:bg-slate-950/60 p-3 rounded-xl border border-red-200/60 dark:border-red-900/40">
                                                    <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">
                                                        Detected MIME
                                                    </div>
                                                    <div class="font-mono text-xs text-red-600 dark:text-red-400 font-bold truncate" title="{{ $forensics['detected_mime'] }}">
                                                        {{ $forensics['detected_mime'] }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Safe Analyst Actions Toolbar -->
                                            <div class="pt-2 flex flex-wrap items-center justify-between gap-3 border-t border-red-200/60 dark:border-red-900/40">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-xs text-red-600 dark:text-red-400 font-medium">🛡️ File dikarantina demi keamanan sistem.</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <!-- Action 1: Intip Raw Payload -->
                                                    <button type="button" @click="showRawModal = true" class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-900 hover:bg-slate-800 text-cyan-400 border border-cyan-500/40 rounded-xl text-xs font-bold transition-all shadow-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                        Intip Raw Payload
                                                    </button>

                                                    <!-- Action 2: Override Karantina -->
                                                    <button type="button" @click="showOverrideModal = true" class="inline-flex items-center gap-1.5 px-4 py-2 bg-amber-600/20 hover:bg-amber-600/30 text-amber-600 dark:text-amber-400 border border-amber-500/40 rounded-xl text-xs font-bold transition-all shadow-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                                        Override Karantina
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Clean / Verified PoC Terminal -->
                                <div class="text-[11px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-3 flex items-center justify-between">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                        Langkah Reproduksi (Proof of Concept)
                                    </span>
                                    <span class="text-[10px] font-mono text-emerald-500 font-bold">SHA-256: {{ $forensics['sha256_short'] }}</span>
                                </div>
                                <div class="rounded-2xl overflow-hidden shadow-lg border border-slate-700/80 group/terminal">
                                    <div class="bg-slate-900 px-4 py-2 border-b border-slate-800 flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2.5 h-2.5 rounded-full bg-red-500/80"></div>
                                            <div class="w-2.5 h-2.5 rounded-full bg-yellow-500/80"></div>
                                            <div class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></div>
                                            <span class="ml-2 text-[10px] text-gray-500 font-mono tracking-widest">EXPLOIT_POC.TXT</span>
                                        </div>
                                        <span class="text-[10px] font-mono text-gray-400">{{ $forensics['size_formatted'] }} • {{ $forensics['detected_mime'] }}</span>
                                    </div>
                                    <div class="bg-[#020617] p-5 text-sm font-mono whitespace-pre-wrap overflow-x-auto text-emerald-400 leading-relaxed flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                        <div class="truncate text-xs text-slate-300">
                                            <span class="text-emerald-400 font-bold">File:</span> {{ basename($laporan->bukti_poc) }}
                                        </div>
                                        <div class="flex items-center gap-2 shrink-0">
                                            <button type="button" @click="showRawModal = true" class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-800 hover:bg-slate-700 text-cyan-400 border border-cyan-500/30 rounded-xl text-xs font-bold transition-all shadow-sm">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                Intip Raw
                                            </button>
                                            <a href="/laporan/{{ $laporan->id }}/poc" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-400 border border-emerald-500/30 rounded-xl text-xs font-bold transition-all shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                Buka / Unduh Bukti PoC
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Modal: Intip Raw Payload (Safe Hex/ASCII Viewer) -->
                            <div x-show="showRawModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
                                <div @click.away="showRawModal = false" class="bg-slate-900 border border-slate-700 rounded-3xl max-w-4xl w-full p-6 shadow-2xl space-y-4">
                                    <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                                        <div class="flex items-center gap-2">
                                            <span class="w-3 h-3 rounded-full bg-cyan-400 animate-pulse"></span>
                                            <h4 class="font-mono text-sm font-bold text-white uppercase tracking-wider">RAW_PAYLOAD_INSPECTION // {{ basename($laporan->bukti_poc) }}</h4>
                                        </div>
                                        <button type="button" @click="showRawModal = false" class="text-gray-400 hover:text-white p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                    <div class="flex flex-wrap items-center justify-between gap-2 text-xs font-mono text-gray-400 bg-slate-950/70 p-3 rounded-xl border border-slate-800">
                                        <div><strong class="text-gray-300">SHA-256:</strong> {{ $forensics['sha256'] }}</div>
                                        <div><strong class="text-gray-300">Ukuran:</strong> {{ $forensics['size_formatted'] }}</div>
                                        <div><strong class="text-gray-300">MIME:</strong> {{ $forensics['detected_mime'] }}</div>
                                    </div>
                                    <div class="bg-black/90 p-4 rounded-2xl border border-slate-800 max-h-96 overflow-auto">
                                        <pre class="font-mono text-xs text-emerald-400 leading-relaxed whitespace-pre selection:bg-emerald-900"><code>{{ $forensics['raw_payload'] }}</code></pre>
                                    </div>
                                    <div class="flex items-center justify-between pt-2">
                                        <span class="text-[11px] text-gray-500 font-mono">Sandbox viewer: karakter non-printable disanitasi & payload di-escape dengan aman.</span>
                                        <div class="flex items-center gap-3">
                                            <button type="button" @click="navigator.clipboard.writeText('{{ addslashes($forensics['raw_payload']) }}'); copied = true; setTimeout(() => copied = false, 2000)" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-gray-200 text-xs font-bold rounded-xl border border-slate-700">
                                                <span x-text="copied ? 'Payload Tersalin!' : 'Salin Payload'"></span>
                                            </button>
                                            <button type="button" @click="showRawModal = false" class="px-5 py-2 bg-cyan-600 hover:bg-cyan-500 text-white text-xs font-bold rounded-xl">
                                                Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal: Override Karantina -->
                            <div x-show="showOverrideModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
                                <div @click.away="showOverrideModal = false" class="bg-slate-900 border border-amber-600/50 rounded-3xl max-w-lg w-full p-6 shadow-2xl space-y-4">
                                    <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                                        <div class="flex items-center gap-2">
                                            <span class="w-3 h-3 rounded-full bg-amber-500 animate-pulse"></span>
                                            <h4 class="font-display text-base font-bold text-white tracking-wide">Konfirmasi Override Karantina</h4>
                                        </div>
                                        <button type="button" @click="showOverrideModal = false" class="text-gray-400 hover:text-white p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                    <div class="bg-amber-950/30 border border-amber-800/40 p-3.5 rounded-xl text-xs text-amber-300 space-y-1">
                                        <p class="font-bold">⚠️ Perhatian Analis CSIRT:</p>
                                        <p>Tindakan override akan menandai file sebagai <strong>Clean</strong> dan mengaktifkan tombol unduh PoC. Aksi ini akan dicatat ke <strong>Audit Trail (NIST SP 800-61)</strong>.</p>
                                    </div>
                                    <form action="{{ route('admin.laporan.override-quarantine', $laporan) }}" method="POST" class="space-y-4">
                                        @csrf
                                        <div>
                                            <label for="alasan_override_{{ $laporan->id }}" class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">
                                                Alasan & Justifikasi Analis <span class="text-red-400">*</span>
                                            </label>
                                            <textarea name="alasan_override" id="alasan_override_{{ $laporan->id }}" rows="3" required placeholder="Contoh: File teks PoC telah diuji di isolated sandbox dan diverifikasi aman (false-positive)." class="w-full px-4 py-3 bg-slate-950 border border-slate-700 rounded-xl text-xs font-medium text-gray-200 outline-none focus:ring-2 focus:ring-amber-500/50"></textarea>
                                        </div>
                                        <div class="flex items-center justify-end gap-3 pt-2">
                                            <button type="button" @click="showOverrideModal = false" class="px-4 py-2.5 text-gray-400 hover:text-white text-xs font-bold">
                                                Batal
                                            </button>
                                            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-amber-600 to-orange-500 hover:from-amber-500 hover:to-orange-400 text-white text-xs font-bold rounded-xl transition-all shadow-lg">
                                                Konfirmasi & Buka Akses
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Area Aksi (Panel Keputusan) -->
                    <div class="p-6 md:p-8 border-t border-gray-100 dark:border-slate-800/80 bg-blue-50/30 dark:bg-[#020817]/30 space-y-5">
                        {{-- Existing: Status & Points form --}}
                        <form action="/admin/laporan/{{ $laporan->id }}/validasi" method="POST" class="flex flex-col sm:flex-row items-end gap-5">
                            @csrf
                            <div class="w-full sm:w-2/5">
                                <label class="block text-[11px] font-black text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest">Keputusan Intelijen</label>
                                <div class="relative">
                                    <select name="status" class="w-full px-4 py-3.5 bg-white dark:bg-slate-950/80 border border-gray-200 dark:border-slate-700 rounded-xl text-sm font-bold focus:ring-2 focus:ring-indigo-500/50 outline-none text-gray-900 dark:text-white cursor-pointer shadow-sm appearance-none">
                                        <option value="Menunggu" {{ $laporan->status == 'Menunggu' ? 'selected' : '' }}>⌛ Review Lanjutan (Pending)</option>
                                        <option value="Valid" {{ $laporan->status == 'Valid' ? 'selected' : '' }}>✅ Validasi Berhasil (Terima)</option>
                                        <option value="Ditolak" {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>❌ Invalid / Duplikat (Tolak)</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full sm:w-1/4">
                                <label class="block text-[11px] font-black text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-1.5">
                                    Reward (Pts) <span class="text-indigo-500">♦</span>
                                </label>
                                <input type="number" name="poin" value="{{ $laporan->poin_diberikan ?? 0 }}" min="0" placeholder="0" class="w-full px-4 py-3.5 bg-white dark:bg-slate-950/80 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/50 outline-none text-indigo-700 dark:text-indigo-400 font-display font-black text-center shadow-sm placeholder-gray-400">
                            </div>
                            <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-violet-500 hover:from-indigo-500 hover:to-violet-400 text-white font-bold py-3.5 px-8 rounded-xl transition-all shadow-[0_0_15px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(79,70,229,0.5)] hover:-translate-y-0.5 shrink-0 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Simpan Keputusan
                            </button>
                        </form>

                        {{-- Enhancement 1: CVSS v3.1 Calculator --}}
                        <div x-data="{ open: false }" class="border-t border-gray-100 dark:border-slate-800/50 pt-4">
                            <button type="button" @click="open = !open" class="inline-flex items-center gap-2 px-5 py-2.5 bg-violet-100 dark:bg-violet-900/30 hover:bg-violet-200 dark:hover:bg-violet-800/40 text-violet-700 dark:text-violet-300 border border-violet-200 dark:border-violet-700/50 rounded-xl text-xs font-bold transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                🛡️ Hitung CVSS v3.1 Score
                                <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="open" x-transition class="mt-4 bg-white dark:bg-slate-900/80 border border-violet-200 dark:border-violet-800/50 rounded-2xl p-6">
                                <form action="{{ route('admin.laporan.cvss', $laporan) }}" method="POST" id="cvss-form-{{ $laporan->id }}">
                                    @csrf
                                    <p class="text-[10px] font-black text-violet-500 uppercase tracking-widest mb-4">CVSS v3.1 Base Metrics (FIRST.org)</p>

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                        @php
                                        $cvssMetrics = [
                                            ['name'=>'cvss_av','label'=>'Attack Vector (AV)','options'=>['N'=>'Network','A'=>'Adjacent','L'=>'Local','P'=>'Physical']],
                                            ['name'=>'cvss_ac','label'=>'Attack Complexity (AC)','options'=>['L'=>'Low','H'=>'High']],
                                            ['name'=>'cvss_pr','label'=>'Privileges Required (PR)','options'=>['N'=>'None','L'=>'Low','H'=>'High']],
                                            ['name'=>'cvss_ui','label'=>'User Interaction (UI)','options'=>['N'=>'None','R'=>'Required']],
                                            ['name'=>'cvss_s','label'=>'Scope (S)','options'=>['U'=>'Unchanged','C'=>'Changed']],
                                            ['name'=>'cvss_c','label'=>'Confidentiality (C)','options'=>['N'=>'None','L'=>'Low','H'=>'High']],
                                            ['name'=>'cvss_i','label'=>'Integrity (I)','options'=>['N'=>'None','L'=>'Low','H'=>'High']],
                                            ['name'=>'cvss_a','label'=>'Availability (A)','options'=>['N'=>'None','L'=>'Low','H'=>'High']],
                                        ];
                                        @endphp

                                        @foreach($cvssMetrics as $m)
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">{{ $m['label'] }}</label>
                                            <select name="{{ $m['name'] }}" required class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700 rounded-lg text-xs font-bold text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-violet-500/50 appearance-none">
                                                @foreach($m['options'] as $val => $lbl)
                                                    <option value="{{ $val }}">{{ $val }}: {{ $lbl }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-violet-600 to-purple-500 hover:from-violet-500 hover:to-purple-400 text-white text-xs font-bold rounded-xl transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            Simpan Skor CVSS
                                        </button>
                                        <p class="text-[10px] text-gray-400 dark:text-gray-500">Skor dihitung menggunakan formula resmi CVSS v3.1 (FIRST.org) sesuai ISO/IEC 30111.</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
                <!-- Tampilan Jika Kosong -->
                <div class="bg-white/50 dark:bg-slate-900/50 backdrop-blur-xl rounded-[2rem] shadow-sm border border-dashed border-gray-300 dark:border-slate-700/80 p-16 text-center opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-gray-200 dark:border-slate-700 shadow-inner">
                        <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="font-display text-2xl font-black text-gray-900 dark:text-white mb-2 tracking-tight">Terminal Kosong</h3>
                    <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada laporan kerentanan yang masuk dari para analis intelijen (Bug Hunter).</p>
                </div>
            @endforelse

            @if($laporans->hasPages())
                <div class="mt-8">
                    {{ $laporans->links() }}
                </div>
            @endif
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
                setTimeout(() => el.style.opacity = '1', 800);
            });
        });
    </script>
</body>
</html>