<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Laporan #{{ strtoupper(substr((string) $laporan->id, 0, 8)) }} — Hunter Command Center</title>
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-cyan-500 selection:text-white">

    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 animate-grid-flow z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <div class="flex-grow max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10 pt-16">

        <!-- Back Button & Breadcrumbs -->
        <div class="mb-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.05s;">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center text-xs font-bold text-gray-500 dark:text-gray-400
                      hover:text-cyan-600 dark:hover:text-cyan-400
                      transition-all hover:-translate-x-1 duration-200
                      bg-white/60 dark:bg-slate-900/60 px-4 py-2 rounded-full
                      border border-gray-200 dark:border-slate-800 backdrop-blur-sm shadow-sm
                      uppercase tracking-widest mb-5">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Dashboard Hunter
            </a>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-cyan-50 dark:bg-cyan-900/30 border border-cyan-200 dark:border-cyan-800/50 text-cyan-600 dark:text-cyan-400 font-mono text-[10px] font-bold tracking-widest mb-3 uppercase rounded-full shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500"></span>
                        </span>
                        HUNTER_TICKET_TRACKER
                    </div>
                    <h1 class="font-display text-3xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight mb-1">
                        Detail <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-500 dark:from-cyan-400 dark:to-blue-400">Temuan Bug</span>
                    </h1>
                    <p class="font-mono text-xs text-gray-400 dark:text-gray-500">ID: {{ $laporan->id }}</p>
                </div>

                <!-- Status Badge -->
                <div class="shrink-0">
                    @if($laporan->status === 'Valid')
                        <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-xs font-black uppercase tracking-widest rounded-xl border border-emerald-200 dark:border-emerald-800/50 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            TERVALIDASI (+{{ $laporan->poin_diberikan }} PTS)
                        </span>
                    @elseif($laporan->status === 'Ditolak')
                        <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-black uppercase tracking-widest rounded-xl border border-red-200 dark:border-red-800/50 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            DITOLAK / INVALID
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs font-black uppercase tracking-widest rounded-xl border border-amber-200 dark:border-amber-800/50 shadow-sm">
                            <svg class="w-4 h-4 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            DALAM PROSES TRIASE
                        </span>
                    @endif
                </div>
            </div>
        </div>

        @if($laporan->certificate)
            <!-- Certificate of Appreciation Award Card -->
            <div class="mb-8 bg-gradient-to-r from-amber-500/15 via-yellow-500/10 to-amber-500/5 dark:from-amber-950/40 dark:via-yellow-950/20 dark:to-slate-900/40 backdrop-blur-xl rounded-[2rem] p-6 sm:p-8 border border-amber-300/80 dark:border-amber-700/60 shadow-xl shadow-amber-500/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400 via-yellow-500 to-amber-600 flex items-center justify-center text-white shadow-lg shadow-amber-500/30 shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-100 dark:bg-amber-900/50 text-amber-800 dark:text-amber-300 text-[10px] font-black uppercase tracking-widest rounded-full border border-amber-300 dark:border-amber-700/60 mb-2">
                            ★ CERTIFICATE OF APPRECIATION TERSEDIA
                        </div>
                        <h2 class="font-display text-xl sm:text-2xl font-black text-slate-900 dark:text-white">
                            Sertifikat Penghargaan Resmi Diterbitkan
                        </h2>
                        <p class="font-mono text-xs text-amber-700 dark:text-amber-400 mt-1">
                            No. Registrasi: {{ $laporan->certificate->certificate_number }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 flex-wrap w-full sm:w-auto justify-end">
                    <a href="{{ route('certificates.download', $laporan->certificate) }}"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-amber-500 to-yellow-600 hover:from-amber-400 hover:to-yellow-500 text-white rounded-xl text-xs font-bold transition-all shadow-lg shadow-amber-500/25 hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh Sertifikat PDF
                    </a>
                    <a href="{{ route('certificate.verify', $laporan->certificate->id) }}" target="_blank"
                       class="inline-flex items-center justify-center gap-1.5 px-4 py-3.5 bg-white dark:bg-slate-900 hover:bg-gray-50 dark:hover:bg-slate-800 text-slate-800 dark:text-gray-200 border border-gray-200 dark:border-slate-700 rounded-xl text-xs font-bold transition-all shadow-sm">
                        Verifikasi Publik ↗
                    </a>
                </div>
            </div>
        @endif

        <!-- Main Report Card -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] shadow-xl border border-gray-200/50 dark:border-slate-800 overflow-hidden mb-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.15s;">
            <div class="p-6 md:p-8 border-b border-gray-100 dark:border-slate-800/80 bg-gray-50/50 dark:bg-slate-950/30">
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2.5 py-1 bg-gray-200 dark:bg-slate-800 text-gray-700 dark:text-gray-300 text-[10px] font-black uppercase tracking-widest rounded-md border border-gray-300 dark:border-slate-700 font-mono shadow-sm">
                        {{ $laporan->jenis_kerentanan }}
                    </span>
                    <span class="text-xs font-mono text-cyan-600 dark:text-cyan-400 font-bold">Severity: {{ $laporan->severity }}</span>
                </div>
                <h2 class="font-mono text-xl md:text-2xl font-bold text-slate-900 dark:text-white break-all">
                    {{ $laporan->target_url }}
                </h2>
            </div>

            <div class="p-6 md:p-8 space-y-6">
                <!-- Metadata Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50/60 dark:bg-slate-950/40 p-4 rounded-2xl border border-gray-100 dark:border-slate-800/60">
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tanggal Submit</div>
                        <div class="font-mono text-xs font-bold text-slate-800 dark:text-gray-200">
                            {{ $laporan->created_at->format('d M Y - H:i') }} WIB
                        </div>
                    </div>
                    <div class="bg-gray-50/60 dark:bg-slate-950/40 p-4 rounded-2xl border border-gray-100 dark:border-slate-800/60">
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Identitas Pelapor</div>
                        <div class="text-xs font-bold text-slate-800 dark:text-gray-200">
                            @if($laporan->is_anonymous)
                                <span class="text-cyan-500 font-mono">{{ $laporan->pseudonym ?: 'Anonim' }} (Mode Anonim)</span>
                            @else
                                {{ $laporan->user->name ?? 'Hunter' }}
                            @endif
                        </div>
                    </div>
                    <div class="bg-gray-50/60 dark:bg-slate-950/40 p-4 rounded-2xl border border-gray-100 dark:border-slate-800/60">
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Poin Diberikan</div>
                        <div class="font-mono text-base font-black text-cyan-600 dark:text-cyan-400">
                            +{{ $laporan->poin_diberikan }} PTS
                        </div>
                    </div>
                </div>

                <!-- CVSS Score (if officially assigned by CSIRT) -->
                @if($laporan->cvss_score !== null)
                    <div class="bg-violet-50/50 dark:bg-violet-950/20 p-4 rounded-2xl border border-violet-200 dark:border-violet-800/50 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="text-2xl font-black font-mono text-violet-700 dark:text-violet-300">{{ number_format($laporan->cvss_score, 1) }}</div>
                            <div>
                                <div class="text-[10px] font-black text-violet-500 uppercase tracking-widest">Official CVSS v3.1 Base Score</div>
                                <div class="text-xs font-mono text-violet-400 truncate max-w-xs">{{ $laporan->cvss_vector }}</div>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-violet-200/50 dark:bg-violet-900/40 text-violet-700 dark:text-violet-300 rounded-lg text-xs font-bold">
                            Diverifikasi oleh Tim CSIRT
                        </span>
                    </div>
                @endif

                <!-- Deskripsi -->
                <div>
                    <div class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Deskripsi Kerentanan & Bukti Eksploitasi</div>
                    <div class="bg-gray-50/70 dark:bg-slate-950/50 p-5 rounded-2xl border border-gray-100 dark:border-slate-800 text-sm leading-relaxed text-gray-700 dark:text-gray-300 font-medium whitespace-pre-line">
                        {{ $laporan->deskripsi }}
                    </div>
                </div>

                <!-- Proof of Concept File -->
                <div class="pt-2 flex items-center justify-between border-t border-gray-100 dark:border-slate-800">
                    <div class="text-xs text-gray-500 font-mono">
                        Berkas Bukti PoC: <strong class="text-slate-800 dark:text-gray-200">{{ basename($laporan->bukti_poc) }}</strong>
                    </div>
                    <a href="{{ route('laporan.download', $laporan) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-cyan-600 to-blue-500 hover:from-cyan-500 hover:to-blue-400 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-all shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh PoC Saya
                    </a>
                </div>
            </div>
        </div>

        <!-- ================= EXTERNAL TICKET TIMELINE ================= -->
        <div class="opacity-0 animate-fade-in-up" style="animation-delay: 0.25s;">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-8 h-8 bg-cyan-100 dark:bg-cyan-900/30 border border-cyan-200 dark:border-cyan-800/50 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-display text-xl font-bold text-slate-900 dark:text-white tracking-tight">Perkembangan Status Tiket</h2>
                    <p class="text-xs text-gray-400 dark:text-gray-500 font-mono uppercase tracking-widest">Pembaruan Resmi Tim JatimProv-CSIRT</p>
                </div>
            </div>

            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] border border-gray-200/50 dark:border-slate-800 shadow-xl overflow-hidden p-6 md:p-8">
                @php
                    $externalLogs = $laporan->externalActivityLogs;
                @endphp

                @if($externalLogs->isEmpty())
                    <p class="text-center text-sm text-gray-500 py-6">Belum ada pembaruan status untuk tiket ini.</p>
                @else
                    <div class="relative">
                        <div class="absolute left-[15px] top-4 bottom-4 w-px bg-gradient-to-b from-cyan-400 via-blue-500 to-transparent"></div>

                        <div class="space-y-6 pl-10">
                            @foreach($externalLogs as $log)
                                @php
                                    $isSub = $log->action === 'REPORT_SUBMITTED';
                                    $isCvss = $log->action === 'CVSS_ASSIGNED';
                                    $isStat = $log->action === 'STATUS_UPDATED';
                                @endphp
                                <div class="relative">
                                    <div class="absolute -left-10 top-3.5 w-3 h-3 rounded-full {{ $isSub ? 'bg-indigo-500' : ($isCvss ? 'bg-violet-500' : 'bg-emerald-500') }} ring-4 ring-white dark:ring-slate-900 z-10"></div>

                                    <div class="bg-gray-50/70 dark:bg-slate-950/50 border border-gray-100 dark:border-slate-800 p-4 rounded-2xl space-y-2">
                                        <div class="flex flex-wrap items-center justify-between gap-2">
                                            <span class="text-xs font-bold font-mono {{ $isSub ? 'text-indigo-600 dark:text-indigo-400' : ($isCvss ? 'text-violet-600 dark:text-violet-400' : 'text-emerald-600 dark:text-emerald-400') }}">
                                                @if($isSub)
                                                    📥 LAPORAN DITERIMA SISTEM
                                                @elseif($isCvss)
                                                    🛡️ SKOR KERENTANAN (CVSS) DITETAPKAN
                                                @else
                                                    🔄 STATUS TIKET DIPERBARUI
                                                @endif
                                            </span>
                                            <span class="text-[10px] font-mono text-gray-400">
                                                {{ \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->format('d M Y — H:i') }} WIB
                                            </span>
                                        </div>

                                        <p class="text-xs text-gray-600 dark:text-gray-300">
                                            @if($isSub)
                                                Laporan kerentanan Anda telah berhasil masuk ke antrean triase tim JatimProv-CSIRT.
                                            @elseif($isCvss)
                                                Analis CSIRT telah menghitung dan menetapkan skor keparahan resmi berdasarkan standar CVSS v3.1.
                                            @elseif($isStat)
                                                Status laporan Anda telah diperbarui menjadi <strong>{{ $log->details['new_status'] ?? $laporan->status }}</strong>.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

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
