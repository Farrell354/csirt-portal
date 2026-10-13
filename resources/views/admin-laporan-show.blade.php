<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Laporan #{{ strtoupper(substr((string) $laporan->id, 0, 8)) }} — JatimProv CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-indigo-500 selection:text-white">

    <!-- Ambient background -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 animate-grid-flow z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-indigo-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <div class="flex-grow max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10 pt-16">

        {{-- ─────────────────────────────────────────────────────────────── --}}
        {{-- FEATURE 1 & 2: BREADCRUMB NAV                                  --}}
        {{-- ─────────────────────────────────────────────────────────────── --}}
        <div class="mb-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.05s;">
            {{-- Back link --}}
            <a href="{{ route('admin.laporan.index') }}"
               class="inline-flex items-center text-xs font-bold text-gray-500 dark:text-gray-400
                      hover:text-indigo-600 dark:hover:text-indigo-400
                      transition-all hover:-translate-x-1 duration-200
                      bg-white/60 dark:bg-slate-900/60 px-4 py-2 rounded-full
                      border border-gray-200 dark:border-slate-800 backdrop-blur-sm shadow-sm
                      uppercase tracking-widest mb-5">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Antrean Tiket
            </a>

            {{-- Breadcrumb trail --}}
            <nav class="flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('dashboard') }}" class="hover:text-indigo-500 transition-colors">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('admin.laporan.index') }}" class="hover:text-indigo-500 transition-colors">Antrean Tiket</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="font-mono text-indigo-500 font-bold">{{ strtoupper(substr((string) $laporan->id, 0, 8)) }}</span>
            </nav>

            {{-- Page header --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-200 dark:border-indigo-800/50 text-indigo-600 dark:text-indigo-400 font-mono text-[10px] font-bold tracking-widest mb-3 uppercase rounded-full shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                        </span>
                        TICKET_REVIEW_MODE
                    </div>
                    <h1 class="font-display text-3xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight mb-1">
                        Verifikasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-500 dark:from-indigo-400 dark:to-violet-400">Laporan</span>
                    </h1>
                    <p class="font-mono text-sm text-gray-400 dark:text-gray-500 tracking-wide">UUID: {{ $laporan->id }}</p>
                </div>

                {{-- FEATURE 3: Dynamic Status Badge & Cetak Advisory --}}
                <div class="shrink-0 flex flex-wrap items-center gap-3">
                    @php
                        $st = $laporan->status;
                        $isResolved = in_array($st, ['Valid', 'Ditolak', 'resolved', 'validated']);
                        $isReview   = in_array($st, ['under_review']);
                        $isPending  = in_array($st, ['Menunggu', 'pending', 'submitted']);
                    @endphp

                    @if($isResolved && in_array($st, ['Valid', 'validated']))
                        <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-xs font-black uppercase tracking-widest rounded-xl border border-emerald-200 dark:border-emerald-800/50 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            TERVALIDASI (+{{ $laporan->poin_diberikan }} PTS)
                        </span>
                    @elseif(in_array($st, ['Ditolak', 'resolved']))
                        <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-black uppercase tracking-widest rounded-xl border border-red-200 dark:border-red-800/50 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            DITOLAK / CLOSED
                        </span>
                    @elseif($isReview)
                        <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-black uppercase tracking-widest rounded-xl border border-blue-200 dark:border-blue-800/50 shadow-sm">
                            <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            SEDANG DITINJAU
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs font-black uppercase tracking-widest rounded-xl border border-amber-200 dark:border-amber-800/50 shadow-sm">
                            <svg class="w-4 h-4 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            MENUNGGU TRIASE
                        </span>
                    @endif

                    <a href="{{ route('admin.laporan.advisory.cetak', $laporan) }}" target="_blank"
                       class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-500 hover:to-teal-400 text-white text-xs font-bold rounded-xl transition-all shadow-[0_0_12px_rgba(16,185,129,0.3)] hover:shadow-[0_0_20px_rgba(16,185,129,0.5)] uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        Cetak Advisory
                    </a>
                </div>
            </div>
        </div>

        {{-- Flash success / pesan --}}
        @if(session('pesan') || session('success'))
            <div class="mb-6 bg-emerald-50/90 dark:bg-emerald-900/30 backdrop-blur-md border border-emerald-400/50 dark:border-emerald-700/50 text-emerald-700 dark:text-emerald-400 px-5 py-4 rounded-2xl flex items-center gap-4 shadow-lg opacity-0 animate-fade-in-up">
                <div class="p-2 bg-emerald-100 dark:bg-emerald-800/50 rounded-lg shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="font-bold text-sm">{{ session('pesan') ?? session('success') }}</span>
            </div>
        @endif

        {{-- Flash error --}}
        @if(session('error'))
            <div class="mb-6 bg-red-50/90 dark:bg-red-900/20 border border-red-300 dark:border-red-800/50 text-red-700 dark:text-red-400 px-5 py-4 rounded-2xl flex items-center gap-4 shadow-lg opacity-0 animate-fade-in-up">
                <div class="p-2 bg-red-100 dark:bg-red-800/50 rounded-lg shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <span class="font-bold text-sm">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
            <div class="mb-6 bg-red-50/90 dark:bg-red-900/20 border border-red-300 dark:border-red-800/50 text-red-700 dark:text-red-400 px-5 py-4 rounded-2xl space-y-1 shadow-lg">
                @foreach($errors->all() as $err)
                    <p class="text-sm font-medium">⚠️ {{ $err }}</p>
                @endforeach
            </div>
        @endif

        {{-- ─────────────────────────────────────────────────────────────── --}}
        {{-- MAIN REPORT CARD                                                --}}
        {{-- ─────────────────────────────────────────────────────────────── --}}
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] shadow-lg dark:shadow-[0_10px_30px_rgba(0,0,0,0.3)] border border-gray-200/50 dark:border-slate-700/80 overflow-hidden relative opacity-0 animate-fade-in-up" style="animation-delay: 0.15s;">

            {{-- Top neon accent line --}}
            @if(in_array($laporan->status, ['Valid', 'validated']))
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-emerald-600"></div>
            @elseif(in_array($laporan->status, ['Ditolak', 'resolved']))
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-red-600"></div>
            @elseif(in_array($laporan->status, ['under_review']))
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-blue-600"></div>
            @else
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 to-amber-600"></div>
            @endif

            {{-- Card header --}}
            <div class="p-6 md:px-8 md:py-6 border-b border-gray-100 dark:border-slate-800/80 bg-gray-50/50 dark:bg-slate-950/30">
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="px-2.5 py-1 bg-gray-200 dark:bg-slate-800 text-gray-700 dark:text-gray-300 text-[10px] font-black uppercase tracking-widest rounded-md border border-gray-300 dark:border-slate-700 font-mono shadow-sm">
                        ID: #{{ strtoupper(substr((string) $laporan->id, 0, 8)) }}
                    </span>
                    <span class="text-[11px] font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        {{ $laporan->jenis_kerentanan }}
                    </span>
                </div>
                <h2 class="font-mono text-xl md:text-2xl font-bold text-slate-900 dark:text-white truncate" title="{{ $laporan->target_url }}">
                    {{ $laporan->target_url }}
                </h2>
            </div>

            {{-- 3-column info grid --}}
            <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-5">

                {{-- Reporter — Zero-Knowledge Admin View (UU PDP No. 27/2022) --}}
                <div class="bg-gray-50/50 dark:bg-slate-950/30 p-5 rounded-2xl border border-gray-100 dark:border-slate-800">
                    <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        Dilaporkan Oleh
                    </div>
                    @if($laporan->is_anonymous)
                        {{-- ── STRICT ANONYMITY MASK ── --}}
                        {{-- No name, no email, no avatar, no profile link: UU PDP data-minimisation --}}
                        <div class="mt-1 space-y-1.5">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 text-[10px] font-black uppercase tracking-widest rounded-lg border border-indigo-300 dark:border-indigo-700/50">
                                    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                    Pelapor Anonim / Pseudonim
                                </span>
                                @if($laporan->pseudonym)
                                    <span class="font-mono text-xs font-bold text-indigo-500 dark:text-indigo-400">{{ $laporan->pseudonym }}</span>
                                @endif
                            </div>
                            <p class="text-[10px] text-gray-500 dark:text-gray-500 leading-relaxed font-medium">
                                Identitas disembunyikan sesuai prinsip minimisasi data<br>
                                <span class="font-bold text-indigo-500">UU PDP No. 27/2022</span> — Zero-Knowledge Admin View.
                            </p>
                        </div>
                    @else
                        <div class="font-display font-bold text-base text-slate-900 dark:text-gray-100 mt-1">
                            {{ $laporan->user->name ?? 'Unknown Hunter' }}
                        </div>
                    @endif
                </div>

                {{-- Timestamp --}}
                <div class="bg-gray-50/50 dark:bg-slate-950/30 p-5 rounded-2xl border border-gray-100 dark:border-slate-800">
                    <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Waktu Penemuan
                    </div>
                    <div class="font-mono text-sm font-bold text-slate-800 dark:text-gray-200">
                        {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y - H:i:s') }}
                        <span class="text-blue-500 text-xs ml-1">WIB</span>
                    </div>
                </div>

                {{-- Scan status --}}
                <div class="bg-gray-50/50 dark:bg-slate-950/30 p-5 rounded-2xl border border-gray-100 dark:border-slate-800">
                    <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Scan PoC
                    </div>
                    @if($laporan->scan_status === 'clean')
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-xs font-bold rounded-lg border border-emerald-200 dark:border-emerald-800">🟢 Clean</span>
                    @elseif($laporan->scan_status === 'quarantined')
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-bold rounded-lg border border-red-200 dark:border-red-800">🔴 Quarantined</span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs font-bold rounded-lg border border-amber-200 dark:border-amber-800">🟡 Pending</span>
                    @endif
                </div>

                {{-- CVSS badge (if assigned) --}}
                @if($laporan->cvss_score !== null)
                <div class="md:col-span-3 bg-violet-50/50 dark:bg-violet-950/20 p-4 rounded-2xl border border-violet-200 dark:border-violet-800/50 flex flex-wrap items-center gap-4">
                    <div class="text-[10px] font-black text-violet-500 uppercase tracking-widest">CVSS v3.1 Score</div>
                    <span class="text-2xl font-black font-mono text-violet-700 dark:text-violet-300">{{ number_format($laporan->cvss_score, 1) }}</span>
                    @php
                        $rating = match(true) {
                            $laporan->cvss_score === 0.0 => ['None',     'bg-gray-100 text-gray-700'],
                            $laporan->cvss_score < 4.0   => ['Low',      'bg-blue-100 text-blue-700'],
                            $laporan->cvss_score < 7.0   => ['Medium',   'bg-amber-100 text-amber-700'],
                            $laporan->cvss_score < 9.0   => ['High',     'bg-orange-100 text-orange-700'],
                            default                      => ['Critical', 'bg-red-100 text-red-700'],
                        };
                    @endphp
                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold {{ $rating[1] }}">{{ $rating[0] }}</span>
                    <code class="text-[10px] font-mono text-violet-500 dark:text-violet-400 bg-violet-100 dark:bg-violet-900/30 px-3 py-1 rounded-lg truncate max-w-xs">{{ $laporan->cvss_vector }}</code>
                </div>
                @endif

                {{-- Description --}}
                <div class="md:col-span-2">
                    <div class="text-[11px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"/></svg>
                        Deskripsi & Dampak
                    </div>
                    <div class="bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-800 p-5 rounded-2xl text-sm text-gray-700 dark:text-gray-300 leading-relaxed font-medium shadow-inner">
                        {{ $laporan->deskripsi }}
                    </div>
                </div>

                @php $forensics = $laporan->getForensics(); @endphp

                {{-- ── INTEGRITAS FILE & RANTAI KUSTODIAN (NIST SP 800-61 / UU PDP) ── --}}
                <div class="md:col-span-3 opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;"
                     x-data="{ hashCopied: false }">
                    <div class="text-[11px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Integritas File &amp; Rantai Kustodian
                    </div>

                    <div class="bg-cyan-50/50 dark:bg-cyan-950/20 border border-cyan-200 dark:border-cyan-800/50 rounded-2xl p-5 space-y-4">

                        {{-- Top row: SHA-256 fingerprint --}}
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <div class="text-[10px] font-black text-cyan-600 dark:text-cyan-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                    </svg>
                                    SHA-256 Fingerprint (NIST SP 800-61 Chain-of-Custody)
                                </div>
                                @if($laporan->poc_hash)
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <code class="font-mono text-xs text-slate-800 dark:text-cyan-300 bg-white dark:bg-slate-950/70 px-3 py-1.5 rounded-xl border border-cyan-200 dark:border-cyan-800/40 break-all shadow-sm leading-relaxed">{{ $laporan->poc_hash }}</code>
                                        <button type="button"
                                                @click="navigator.clipboard.writeText({{ \Illuminate\Support\Js::from($laporan->poc_hash) }}); hashCopied = true; setTimeout(() => hashCopied = false, 2200)"
                                                class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 bg-cyan-100 dark:bg-cyan-900/30 hover:bg-cyan-200 dark:hover:bg-cyan-800/40 text-cyan-700 dark:text-cyan-400 border border-cyan-300 dark:border-cyan-700/50 rounded-xl text-[10px] font-bold transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            <span x-text="hashCopied ? '✓ Tersalin' : 'Salin Hash'"></span>
                                        </button>
                                    </div>
                                @else
                                    <span class="text-xs font-mono text-amber-600 dark:text-amber-400 italic">Hash belum tersedia (file diproses sebelum fitur ini diaktifkan).</span>
                                @endif
                            </div>
                        </div>

                        {{-- Bottom row: EXIF / Privacy status + timestamp --}}
                        <div class="flex flex-wrap items-center gap-3 pt-3 border-t border-cyan-200/60 dark:border-cyan-800/30">
                            @if($laporan->is_exif_stripped)
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase tracking-widest rounded-xl border border-emerald-300 dark:border-emerald-700/50 shadow-sm">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Metadata EXIF: Disanitasi (Privasi Pelapor Terlindungi)
                                </span>
                                <span class="text-[10px] text-emerald-600 dark:text-emerald-500 font-mono">GPS / Kamera / Timestamp EXIF dihapus — UU PDP No. 27/2022</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-slate-100 dark:bg-slate-800/50 text-slate-600 dark:text-slate-400 text-[10px] font-black uppercase tracking-widest rounded-xl border border-slate-300 dark:border-slate-700/50 shadow-sm">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Metadata EXIF: Tidak Berlaku (Non-Gambar / Tidak Diproses)
                                </span>
                                <span class="text-[10px] text-slate-400 dark:text-slate-500 font-mono">PDF / Video — tidak mengandung metadata EXIF</span>
                            @endif

                            <span class="ml-auto text-[10px] font-mono text-gray-400 dark:text-gray-500">
                                Diproses: {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y H:i:s') }} WIB
                            </span>
                        </div>

                    </div>
                </div>
                {{-- ── END CHAIN OF CUSTODY CARD ── --}}

                {{-- Terminal PoC / Forensic Card --}}
                <div class="md:col-span-3" x-data="{ showRawModal: false, showOverrideModal: false, copied: false }">
                    @if($laporan->scan_status === 'quarantined')
                        {{-- Quarantined Forensic Card --}}
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="text-[11px] font-black text-red-500 dark:text-red-400 uppercase tracking-widest flex items-center gap-2">
                                    <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"/></svg>
                                    Analisis Forensik File PoC
                                </div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-red-300 dark:border-red-700/50">
                                    <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                                    FILE DIKARANTINA
                                </span>
                            </div>
                            <div class="rounded-2xl overflow-hidden shadow-xl border border-red-300/80 dark:border-red-800/80 bg-red-50/60 dark:bg-[#0f0408]/90 backdrop-blur-md">
                                <div class="bg-red-100/80 dark:bg-red-950/80 px-5 py-3 border-b border-red-200 dark:border-red-800/50 flex flex-wrap items-center justify-between gap-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                                        <span class="text-xs font-mono font-bold text-red-900 dark:text-red-300">FORENSIC_EVIDENCE // {{ basename($laporan->bukti_poc) }}</span>
                                    </div>
                                    <span class="text-[11px] font-mono text-red-700 dark:text-red-400 font-bold">NIST SP 800-61 Triaged</span>
                                </div>
                                <div class="p-5 space-y-4">
                                    <div class="bg-white/80 dark:bg-slate-950/60 p-3.5 rounded-xl border border-red-200/60 dark:border-red-900/40">
                                        <div class="text-[10px] font-black text-red-600 dark:text-red-400 uppercase tracking-widest mb-1 flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Alasan Deteksi Anomali
                                        </div>
                                        <div class="font-mono text-xs text-red-700 dark:text-red-300 font-semibold break-words">{{ $forensics['detection_reason'] }}</div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <div class="bg-white/80 dark:bg-slate-950/60 p-3 rounded-xl border border-red-200/60 dark:border-red-900/40">
                                            <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1 flex items-center justify-between">
                                                <span>SHA-256 Hash</span>
                                                <button type="button" @click="navigator.clipboard.writeText({{ \Illuminate\Support\Js::from($forensics['sha256']) }}); copied = true; setTimeout(() => copied = false, 2000)" class="text-[10px] text-red-600 dark:text-red-400 hover:underline flex items-center gap-1 font-bold">
                                                    <span x-text="copied ? 'Tersalin!' : 'Salin'"></span>
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                                </button>
                                            </div>
                                            <div class="font-mono text-xs text-slate-800 dark:text-red-300 font-bold truncate" title="{{ $forensics['sha256'] }}">{{ $forensics['sha256_short'] }}</div>
                                        </div>
                                        <div class="bg-white/80 dark:bg-slate-950/60 p-3 rounded-xl border border-red-200/60 dark:border-red-900/40">
                                            <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">Ukuran File</div>
                                            <div class="font-mono text-xs text-slate-800 dark:text-gray-200 font-bold">{{ $forensics['size_formatted'] }} ({{ number_format($forensics['size_bytes']) }} B)</div>
                                        </div>
                                        <div class="bg-white/80 dark:bg-slate-950/60 p-3 rounded-xl border border-red-200/60 dark:border-red-900/40">
                                            <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">Detected MIME</div>
                                            <div class="font-mono text-xs text-red-600 dark:text-red-400 font-bold truncate">{{ $forensics['detected_mime'] }}</div>
                                        </div>
                                    </div>
                                    <div class="pt-2 flex flex-wrap items-center justify-between gap-3 border-t border-red-200/60 dark:border-red-900/40">
                                        <span class="text-xs text-red-600 dark:text-red-400 font-medium">🛡️ File dikarantina demi keamanan sistem.</span>
                                        <div class="flex items-center gap-2">
                                            <button type="button" @click="showRawModal = true" class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-900 hover:bg-slate-800 text-cyan-400 border border-cyan-500/40 rounded-xl text-xs font-bold transition-all shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                Intip Raw Payload
                                            </button>
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
                        {{-- Clean PoC terminal --}}
                        <div class="text-[11px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-3 flex items-center justify-between">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                Langkah Reproduksi (Proof of Concept)
                            </span>
                            <span class="text-[10px] font-mono text-emerald-500 font-bold">SHA-256: {{ $forensics['sha256_short'] }}</span>
                        </div>
                        <div class="rounded-2xl overflow-hidden shadow-lg border border-slate-700/80">
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
                                    <a href="{{ route('laporan.download', $laporan) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-400 border border-emerald-500/30 rounded-xl text-xs font-bold transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Buka / Unduh Bukti PoC
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Modal: Raw Payload Viewer --}}
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
                                     <button type="button" @click="navigator.clipboard.writeText({{ \Illuminate\Support\Js::from($forensics['raw_payload']) }}); copied = true; setTimeout(() => copied = false, 2000)" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-gray-200 text-xs font-bold rounded-xl border border-slate-700">
                                        <span x-text="copied ? 'Payload Tersalin!' : 'Salin Payload'"></span>
                                    </button>
                                    <button type="button" @click="showRawModal = false" class="px-5 py-2 bg-cyan-600 hover:bg-cyan-500 text-white text-xs font-bold rounded-xl">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal: Override Karantina --}}
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
                                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">
                                        Alasan & Justifikasi Analis <span class="text-red-400">*</span>
                                    </label>
                                    <textarea name="alasan_override" rows="3" required placeholder="Contoh: File teks PoC telah diuji di isolated sandbox dan diverifikasi aman (false-positive)." class="w-full px-4 py-3 bg-slate-950 border border-slate-700 rounded-xl text-xs font-medium text-gray-200 outline-none focus:ring-2 focus:ring-amber-500/50"></textarea>
                                </div>
                                <div class="flex items-center justify-end gap-3 pt-2">
                                    <button type="button" @click="showOverrideModal = false" class="px-4 py-2.5 text-gray-400 hover:text-white text-xs font-bold">Batal</button>
                                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-amber-600 to-orange-500 hover:from-amber-500 hover:to-orange-400 text-white text-xs font-bold rounded-xl transition-all shadow-lg">Konfirmasi & Buka Akses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── DECISION PANEL ──────────────────────────────────────────── --}}
            <div class="p-6 md:p-8 border-t border-gray-100 dark:border-slate-800/80 bg-blue-50/30 dark:bg-[#020817]/30 space-y-5"
                 x-data="{ showDispositionModal: false }">

                @php $decided = in_array($laporan->status, ['Valid', 'Ditolak', 'validated', 'resolved']); @endphp

                {{-- Resolved notice --}}
                @if($decided)
                    <div class="flex items-center gap-3 px-5 py-3.5 bg-slate-100 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-2xl text-sm text-slate-600 dark:text-slate-400 font-medium">
                        <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Keputusan telah disimpan — status <strong class="text-slate-800 dark:text-white">{{ $laporan->status }}</strong>. Form di bawah dinonaktifkan.
                    </div>
                @endif

                {{-- ── CERTIFICATE OF APPRECIATION (VDP) ──────────────────────── --}}
                @if(in_array($laporan->status, ['Valid', 'validated']))
                    @if($laporan->certificate)
                        {{-- Certificate already issued --}}
                        <div class="bg-gradient-to-r from-amber-500/10 via-yellow-500/5 to-transparent dark:from-amber-950/30 dark:via-yellow-950/10 p-5 rounded-2xl border border-amber-300/60 dark:border-amber-700/50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-yellow-600 flex items-center justify-center text-white shadow-md shadow-amber-500/20 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300 text-[10px] font-black uppercase tracking-wider rounded-md border border-amber-300 dark:border-amber-700/60 mb-1">
                                        ✓ Sertifikat Penghargaan Diterbitkan
                                    </div>
                                    <div class="font-mono text-xs font-bold text-slate-900 dark:text-amber-300">
                                        {{ $laporan->certificate->certificate_number }}
                                    </div>
                                    <p class="text-[11px] text-gray-500 font-medium">
                                        Diterbitkan: {{ $laporan->certificate->issued_at->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2.5 flex-wrap self-stretch sm:self-auto justify-end">
                                <a href="{{ route('certificates.download', $laporan->certificate) }}"
                                   class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold rounded-xl transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    Unduh PDF
                                </a>
                                <a href="{{ route('certificate.verify', $laporan->certificate->id) }}" target="_blank"
                                   class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-white dark:bg-slate-900 hover:bg-gray-50 dark:hover:bg-slate-800 text-slate-800 dark:text-gray-200 text-xs font-bold rounded-xl border border-gray-200 dark:border-slate-700 transition-all shadow-sm">
                                    Verifikasi Publik ↗
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- Certificate ready to be issued --}}
                        <div class="bg-gradient-to-r from-amber-500/10 via-yellow-500/5 to-transparent dark:from-amber-950/20 p-5 rounded-2xl border border-amber-300/50 dark:border-amber-800/40 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 border border-amber-300/60 dark:border-amber-700/50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-display text-sm font-bold text-slate-900 dark:text-white">
                                        Sertifikat Penghargaan VDP Siap Diterbitkan
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Laporan ini telah tervalidasi. Terbitkan sertifikat apresiasi resmi ber-QR Code untuk hunter.
                                    </p>
                                </div>
                            </div>

                            <form action="{{ route('admin.laporan.certificate.issue', $laporan) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menerbitkan Sertifikat Penghargaan resmi untuk tiket ini?')">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-yellow-600 hover:from-amber-400 hover:to-yellow-500 text-white rounded-xl text-xs font-bold transition-all shadow-md hover:shadow-amber-500/20 hover:-translate-y-0.5 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                    Terbitkan &amp; Kirim Sertifikat
                                </button>
                            </form>
                        </div>
                    @endif
                @endif

                {{-- Decision form --}}
                <form action="{{ route('admin.laporan.validasi', $laporan) }}" method="POST" class="flex flex-col sm:flex-row items-end gap-5">
                    @csrf
                    <div class="w-full sm:w-2/5">
                        <label class="block text-[11px] font-black text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest">Keputusan Intelijen</label>
                        <div class="relative">
                            <select name="status" {{ $decided ? 'disabled' : '' }}
                                    class="w-full px-4 py-3.5 bg-white dark:bg-slate-950/80 border border-gray-200 dark:border-slate-700 rounded-xl text-sm font-bold focus:ring-2 focus:ring-indigo-500/50 outline-none text-gray-900 dark:text-white cursor-pointer shadow-sm appearance-none disabled:opacity-50 disabled:cursor-not-allowed">
                                <option value="Menunggu" {{ $laporan->status == 'Menunggu' ? 'selected' : '' }}>⌛ Review Lanjutan (Pending)</option>
                                <option value="Valid"    {{ $laporan->status == 'Valid'    ? 'selected' : '' }}>✅ Validasi Berhasil (Terima)</option>
                                <option value="Ditolak"  {{ $laporan->status == 'Ditolak'  ? 'selected' : '' }}>❌ Invalid / Duplikat (Tolak)</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/4">
                        <label class="block text-[11px] font-black text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-1.5">
                            Reward (Pts) <span class="text-indigo-500">♦</span>
                        </label>
                        <input type="number" name="poin" value="{{ $laporan->poin_diberikan ?? 0 }}" min="0" placeholder="0"
                               {{ $decided ? 'disabled' : '' }}
                               class="w-full px-4 py-3.5 bg-white dark:bg-slate-950/80 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/50 outline-none text-indigo-700 dark:text-indigo-400 font-display font-black text-center shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    </div>

                    <div class="flex items-center gap-3 flex-wrap">
                        {{-- Save decision button --}}
                        <button type="submit"
                                {{ $decided ? 'disabled' : '' }}
                                class="bg-gradient-to-r from-indigo-600 to-violet-500 hover:from-indigo-500 hover:to-violet-400 text-white font-bold py-3.5 px-8 rounded-xl transition-all shadow-[0_0_15px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(79,70,229,0.5)] hover:-translate-y-0.5 flex items-center justify-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:translate-y-0 disabled:hover:shadow-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Simpan Keputusan
                        </button>

                        {{-- FEATURE 5: OPD Disposition button --}}
                        <button type="button" @click="showDispositionModal = true"
                                class="inline-flex items-center gap-2 py-3.5 px-6 bg-teal-600/20 hover:bg-teal-600/30 text-teal-600 dark:text-teal-400 border border-teal-500/40 rounded-xl text-sm font-bold transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Teruskan ke OPD / Buat Advisory
                        </button>
                    </div>
                </form>

                {{-- CVSS v3.1 Calculator accordion --}}
                <div x-data="{ open: false }" class="border-t border-gray-100 dark:border-slate-800/50 pt-4">
                    <button type="button" @click="open = !open" class="inline-flex items-center gap-2 px-5 py-2.5 bg-violet-100 dark:bg-violet-900/30 hover:bg-violet-200 dark:hover:bg-violet-800/40 text-violet-700 dark:text-violet-300 border border-violet-200 dark:border-violet-700/50 rounded-xl text-xs font-bold transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        🛡️ Hitung CVSS v3.1 Score
                        <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="open" x-transition class="mt-4 bg-white dark:bg-slate-900/80 border border-violet-200 dark:border-violet-800/50 rounded-2xl p-6">
                        <form action="{{ route('admin.laporan.cvss', $laporan) }}" method="POST">
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

                {{-- ── OPD DISPOSITION MODAL (FEATURE 5) ─────────────────── --}}
                <div x-show="showDispositionModal" x-cloak
                     class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <div @click.away="showDispositionModal = false"
                         @keydown.escape.window="showDispositionModal = false"
                         x-transition:enter="transition ease-out duration-250"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         class="bg-slate-900 border border-teal-600/40 rounded-3xl max-w-lg w-full p-6 shadow-[0_0_40px_rgba(20,184,166,0.15)] space-y-5">

                        {{-- Modal header --}}
                        <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-teal-600/20 border border-teal-600/40 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-display text-base font-bold text-white tracking-wide">Teruskan ke OPD / Buat Advisory</h4>
                                    <p class="text-[10px] text-teal-400 font-mono uppercase tracking-widest">Diskominfo Jatim Workflow</p>
                                </div>
                            </div>
                            <button type="button" @click="showDispositionModal = false" class="text-gray-500 hover:text-white p-1.5 rounded-lg hover:bg-slate-800 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        {{-- Info notice --}}
                        <div class="bg-teal-950/40 border border-teal-800/40 p-3.5 rounded-xl text-xs text-teal-300 flex items-start gap-2.5">
                            <svg class="w-4 h-4 shrink-0 mt-0.5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p>Tindakan ini akan mencatat entri <span class="font-mono font-bold text-teal-200">DISPOSITION_SENT</span> pada Audit Trail (NIST SP 800-61) dan mengirimkan notifikasi internal ke OPD terkait.</p>
                        </div>

                        {{-- Disposition form --}}
                        <form action="{{ route('admin.laporan.disposition', $laporan) }}" method="POST" class="space-y-4">
                            @csrf

                            {{-- OPD target --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">
                                    Target OPD / Instansi <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <select name="opd_target" required
                                            class="w-full px-4 py-3 bg-slate-950 border border-slate-700 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 rounded-xl text-sm font-bold text-white outline-none appearance-none transition-all">
                                        <option value="" disabled selected>— Pilih OPD Penerima —</option>
                                        <optgroup label="Dinas Provinsi Jawa Timur">
                                            <option>Dinas Pendidikan Jatim</option>
                                            <option>Dinas Kesehatan Jatim (Dinkes)</option>
                                            <option>Badan Pendapatan Daerah (Bapenda)</option>
                                            <option>Dinas Komunikasi dan Informatika (Diskominfo)</option>
                                            <option>Badan Perencanaan Pembangunan Daerah (Bappeda)</option>
                                            <option>Dinas Kependudukan dan Catatan Sipil (Dispendukcapil)</option>
                                            <option>Dinas Sosial Jatim</option>
                                            <option>Dinas Perhubungan Jatim</option>
                                            <option>Dinas Pertanian dan Ketahanan Pangan</option>
                                            <option>Biro Hukum Setda Jatim</option>
                                        </optgroup>
                                        <optgroup label="Lainnya">
                                            <option>BSSN (Badan Siber dan Sandi Negara)</option>
                                            <option>Tim CSIRT Pusat</option>
                                            <option>Unit Kepatuhan Internal</option>
                                        </optgroup>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Embargo date --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">
                                    Tanggal Embargo <span class="text-red-400">*</span>
                                    <span class="text-gray-500 normal-case font-normal ml-1">(tanggal kerahasiaan berakhir)</span>
                                </label>
                                <input type="date" name="embargo_date" required
                                       min="{{ now()->toDateString() }}"
                                       class="w-full px-4 py-3 bg-slate-950 border border-slate-700 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 rounded-xl text-sm font-mono text-white outline-none transition-all"
                                       style="color-scheme: dark;">
                            </div>

                            {{-- Optional notes --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">
                                    Catatan Advisory <span class="text-gray-500 font-normal normal-case">(opsional)</span>
                                </label>
                                <textarea name="catatan" rows="3" maxlength="500"
                                          placeholder="Instruksi tambahan, referensi CVE, langkah mitigasi yang disarankan..."
                                          class="w-full px-4 py-3 bg-slate-950 border border-slate-700 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 rounded-xl text-xs font-medium text-gray-200 outline-none resize-none transition-all placeholder-gray-600"></textarea>
                            </div>

                            {{-- Actions --}}
                            <div class="flex items-center justify-end gap-3 pt-1">
                                <button type="button" @click="showDispositionModal = false" class="px-4 py-2.5 text-gray-400 hover:text-white text-xs font-bold transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-teal-600 to-cyan-500 hover:from-teal-500 hover:to-cyan-400 text-white text-xs font-bold rounded-xl transition-all shadow-[0_0_12px_rgba(20,184,166,0.3)] hover:shadow-[0_0_20px_rgba(20,184,166,0.5)]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                    Kirim Disposisi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ─────────────────────────────────────────────────────────────── --}}
        {{-- FEATURE 4: ACTIVITY LOG TIMELINE                                --}}
        {{-- ─────────────────────────────────────────────────────────────── --}}
        <div class="mt-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.3s;">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 border border-indigo-200 dark:border-indigo-800/50 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-display text-xl font-bold text-slate-900 dark:text-white tracking-tight">Riwayat Aktivitas & Rantai Bukti</h2>
                    <p class="text-xs text-gray-400 dark:text-gray-500 font-mono uppercase tracking-widest">NIST SP 800-61 — Immutable Audit Trail</p>
                </div>
            </div>

            @php
                $logs = $laporan->activityLogs;

                $actionMeta = [
                    'REPORT_SUBMITTED'     => ['label' => 'Laporan Disubmit',        'color' => 'indigo',  'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    'STATUS_UPDATED'       => ['label' => 'Status Diperbarui',        'color' => 'blue',    'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    'CVSS_ASSIGNED'        => ['label' => 'CVSS Score Ditetapkan',   'color' => 'violet',  'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'],
                    'POC_DOWNLOADED'       => ['label' => 'PoC File Diunduh',         'color' => 'emerald', 'icon' => 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4'],
                    'POC_SCANNED'          => ['label' => 'Scan Heuristik Dijalankan','color' => 'cyan',    'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    'QUARANTINE_OVERRIDDEN'=> ['label' => 'Karantina Di-override',    'color' => 'amber',   'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z'],
                    'DISPOSITION_SENT'     => ['label' => 'Disposisi OPD Dikirim',    'color' => 'teal',    'icon' => 'M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z'],
                ];

                $colorMap = [
                    'indigo'  => ['dot' => 'bg-indigo-500  shadow-[0_0_8px_rgba(99,102,241,0.8)]',  'card' => 'border-indigo-200/40  dark:border-indigo-800/30',  'badge' => 'bg-indigo-50  dark:bg-indigo-900/30  text-indigo-700  dark:text-indigo-400'],
                    'blue'    => ['dot' => 'bg-blue-500    shadow-[0_0_8px_rgba(59,130,246,0.8)]',  'card' => 'border-blue-200/40    dark:border-blue-800/30',    'badge' => 'bg-blue-50    dark:bg-blue-900/30    text-blue-700    dark:text-blue-400'],
                    'violet'  => ['dot' => 'bg-violet-500  shadow-[0_0_8px_rgba(139,92,246,0.8)]',  'card' => 'border-violet-200/40  dark:border-violet-800/30',  'badge' => 'bg-violet-50  dark:bg-violet-900/30  text-violet-700  dark:text-violet-400'],
                    'emerald' => ['dot' => 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.8)]',  'card' => 'border-emerald-200/40 dark:border-emerald-800/30', 'badge' => 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400'],
                    'cyan'    => ['dot' => 'bg-cyan-500    shadow-[0_0_8px_rgba(6,182,212,0.8)]',   'card' => 'border-cyan-200/40    dark:border-cyan-800/30',    'badge' => 'bg-cyan-50    dark:bg-cyan-900/30    text-cyan-700    dark:text-cyan-400'],
                    'amber'   => ['dot' => 'bg-amber-500   shadow-[0_0_8px_rgba(245,158,11,0.8)]',  'card' => 'border-amber-200/40   dark:border-amber-800/30',   'badge' => 'bg-amber-50   dark:bg-amber-900/30   text-amber-700   dark:text-amber-400'],
                    'teal'    => ['dot' => 'bg-teal-500    shadow-[0_0_8px_rgba(20,184,166,0.8)]',  'card' => 'border-teal-200/40    dark:border-teal-800/30',    'badge' => 'bg-teal-50    dark:bg-teal-900/30    text-teal-700    dark:text-teal-400'],
                    'gray'    => ['dot' => 'bg-gray-400    shadow-[0_0_6px_rgba(156,163,175,0.6)]', 'card' => 'border-gray-200/40    dark:border-gray-700/30',    'badge' => 'bg-gray-50    dark:bg-gray-800/50    text-gray-600    dark:text-gray-400'],
                ];
            @endphp

            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] border border-gray-200/50 dark:border-slate-700/80 shadow-lg overflow-hidden">

                @if($logs->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-14 h-14 bg-gray-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-gray-200 dark:border-slate-700">
                            <svg class="w-7 h-7 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 font-medium text-sm">Belum ada entri audit log untuk laporan ini.</p>
                    </div>
                @else
                    <div class="p-6 md:p-8">
                        <div class="relative">
                            {{-- Vertical timeline rail --}}
                            <div class="absolute left-[15px] top-4 bottom-4 w-px bg-gradient-to-b from-indigo-300/50 via-slate-300/30 dark:from-indigo-800/50 dark:via-slate-700/30 to-transparent"></div>

                            <div class="space-y-5 pl-10">
                                @foreach($logs as $i => $log)
                                    @php
                                        $meta   = $actionMeta[$log->action] ?? ['label' => $log->action, 'color' => 'gray', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];
                                        $colors = $colorMap[$meta['color']];
                                        $actor  = $log->causer?->name ?? 'System';
                                        $ts     = \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->format('d M Y — H:i:s');
                                    @endphp

                                    {{-- Node dot (absolute, outside pl-10 flow) --}}
                                    <div class="relative" style="animation-delay: {{ $i * 0.06 }}s;">
                                        <div class="absolute -left-10 top-4 w-[9px] h-[9px] rounded-full {{ $colors['dot'] }} ring-2 ring-white dark:ring-slate-900 z-10"></div>

                                        {{-- Log card --}}
                                        <div class="bg-gray-50/60 dark:bg-slate-950/40 border {{ $colors['card'] }} rounded-2xl p-4 space-y-2.5 hover:bg-white/80 dark:hover:bg-slate-900/60 transition-colors">
                                            <div class="flex flex-wrap items-center justify-between gap-2">
                                                <div class="flex items-center gap-2">
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 {{ $colors['badge'] }} text-[10px] font-black uppercase tracking-widest rounded-lg border border-current/20">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $meta['icon'] }}"/></svg>
                                                        {{ $meta['label'] }}
                                                    </span>
                                                    <span class="font-mono text-xs text-gray-500 dark:text-gray-400 font-semibold">{{ $log->action }}</span>
                                                </div>
                                                <span class="font-mono text-[10px] text-gray-400 dark:text-gray-500 shrink-0">{{ $ts }} WIB</span>
                                            </div>

                                            <div class="flex flex-wrap items-center gap-4 text-xs">
                                                <div class="flex items-center gap-1.5 text-gray-600 dark:text-gray-400">
                                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                                                    <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $actor }}</span>
                                                </div>
                                                @if($log->ip_address)
                                                    <div class="flex items-center gap-1 text-gray-400 dark:text-gray-500 font-mono">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                                        {{ $log->ip_address }}
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Details --}}
                                            @if(!empty($log->details))
                                                <div class="bg-white/60 dark:bg-slate-900/50 rounded-xl p-3 border border-gray-100 dark:border-slate-800/60">
                                                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Detail Perubahan</div>
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-1">
                                                        @foreach($log->details as $key => $val)
                                                            @php
                                                                $displayVal = is_array($val) ? json_encode($val) : (string) $val;
                                                                $displayKey = str_replace('_', ' ', $key);
                                                            @endphp
                                                            <div class="flex items-baseline gap-2 min-w-0">
                                                                <span class="text-[10px] font-mono text-gray-400 dark:text-gray-500 shrink-0 uppercase">{{ $displayKey }}:</span>
                                                                <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 truncate" title="{{ $displayVal }}">{{ Str::limit($displayVal, 80) }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Footer: record count --}}
                <div class="border-t border-gray-100 dark:border-slate-800/60 px-6 py-3 flex items-center justify-between">
                    <span class="text-[10px] font-mono text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                        {{ $logs->count() }} entri log &bull; Tersimpan permanen (immutable)
                    </span>
                    <span class="text-[10px] font-mono text-gray-400 dark:text-gray-500">NIST SP 800-61 Rev.2 §3.2</span>
                </div>
            </div>
        </div>

    </div>{{-- /container --}}

    <x-chatbot />

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.opacity-0').forEach((el, i) => {
                setTimeout(() => { el.style.opacity = '1'; }, 100 + i * 80);
            });
        });
    </script>
</body>
</html>
