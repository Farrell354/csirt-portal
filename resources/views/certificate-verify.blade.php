<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Sertifikat Resmi — JatimProv-CSIRT</title>
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
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-emerald-600/5 dark:bg-emerald-500/10 rounded-full blur-[130px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <main class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full relative z-10 pt-20">

        <!-- Top Status Indicator -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-300 dark:border-emerald-700/60 text-emerald-700 dark:text-emerald-400 font-mono text-xs font-bold tracking-widest uppercase rounded-full shadow-[0_0_20px_rgba(16,185,129,0.2)] mb-4">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
                </span>
                VALID &amp; RESMI DITERBITKAN
            </div>
            <h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight">
                Verifikasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-500 dark:from-emerald-400 dark:via-teal-300 dark:to-cyan-400">Keaslian Sertifikat</span>
            </h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm md:text-base font-medium max-w-xl mx-auto">
                Dokumen ini terdaftar secara sah dalam basis data verifikasi publik JatimProv-CSIRT Vulnerability Disclosure Program.
            </p>
        </div>

        <!-- Verification Certificate Card -->
        <div class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-2xl rounded-[2.5rem] shadow-2xl border border-gray-200/80 dark:border-slate-800 overflow-hidden relative"
             x-data="{ copied: false }">

            <!-- Decorative Gold/Emerald Accent Top Bar -->
            <div class="h-2.5 bg-gradient-to-r from-emerald-500 via-teal-400 to-cyan-500"></div>

            <div class="p-6 sm:p-10 space-y-8">

                <!-- Header Block with CSIRT Emblem & Cert Number -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 pb-6 border-b border-gray-100 dark:border-slate-800/80">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-700 flex items-center justify-center text-white shadow-lg shadow-emerald-500/20 shrink-0">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-widest block">
                                PEMERINTAH PROVINSI JAWA TIMUR
                            </span>
                            <h2 class="font-display text-xl font-bold text-slate-900 dark:text-white">
                                JATIMPROV-CSIRT
                            </h2>
                            <p class="text-xs text-gray-400">Vulnerability Disclosure Program</p>
                        </div>
                    </div>

                    <div class="sm:text-right">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Nomor Registrasi</span>
                        <span class="font-mono text-xs sm:text-sm font-bold text-slate-900 dark:text-cyan-400 bg-gray-100 dark:bg-slate-950 px-3 py-1.5 rounded-xl border border-gray-200 dark:border-slate-800 inline-block shadow-inner">
                            {{ $certificate->certificate_number }}
                        </span>
                    </div>
                </div>

                <!-- Recipient & Citation Info -->
                <div class="bg-emerald-50/40 dark:bg-emerald-950/20 rounded-2xl p-6 border border-emerald-100 dark:border-emerald-800/40 space-y-3">
                    <span class="text-[10px] font-black text-emerald-700 dark:text-emerald-400 uppercase tracking-widest block">
                        Diberikan Sebagai Apresiasi Kepada:
                    </span>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <h3 class="font-display text-2xl sm:text-3xl font-black text-slate-900 dark:text-white">
                            {{ $displayName }}
                        </h3>

                        @if($isMasked)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-indigo-50 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 text-[10px] font-bold uppercase tracking-widest rounded-lg border border-indigo-200 dark:border-indigo-800/50 self-start sm:self-auto">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                Identitas Dilindungi (UU PDP No. 27/2022)
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed font-medium">
                        Atas dedikasi profesional dalam mengidentifikasi dan melaporkan kerentanan secara bertanggung jawab (Responsible Disclosure) demi keamanan ruang digital Jawa Timur.
                    </p>
                </div>

                <!-- Findings Details Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-gray-50/80 dark:bg-slate-950/50 p-4 rounded-xl border border-gray-200/60 dark:border-slate-800">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Tanggal Terbit</span>
                        <span class="font-mono text-xs font-bold text-slate-800 dark:text-gray-200">
                            {{ $certificate->issued_at->translatedFormat('d M Y') }}
                        </span>
                    </div>

                    <div class="bg-gray-50/80 dark:bg-slate-950/50 p-4 rounded-xl border border-gray-200/60 dark:border-slate-800">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Lingkup Target</span>
                        <span class="font-mono text-xs font-bold text-cyan-600 dark:text-cyan-400 truncate block" title="{{ $targetHost }}">
                            {{ $targetHost }}
                        </span>
                    </div>

                    <div class="bg-gray-50/80 dark:bg-slate-950/50 p-4 rounded-xl border border-gray-200/60 dark:border-slate-800">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Severity</span>
                        @php
                            $sev = strtoupper($certificate->severity);
                            $badgeClass = match($sev) {
                                'CRITICAL' => 'text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-950/40 border-red-200 dark:border-red-900/50',
                                'HIGH'     => 'text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-950/40 border-orange-200 dark:border-orange-900/50',
                                'MEDIUM'   => 'text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/40 border-amber-200 dark:border-amber-900/50',
                                default    => 'text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 border-emerald-200 dark:border-emerald-900/50',
                            };
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-widest border {{ $badgeClass }}">
                            {{ $sev }}
                        </span>
                    </div>

                    <div class="bg-gray-50/80 dark:bg-slate-950/50 p-4 rounded-xl border border-gray-200/60 dark:border-slate-800">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Skor CVSS v3.1</span>
                        <span class="font-mono text-sm font-black text-indigo-600 dark:text-indigo-400">
                            {{ $certificate->cvss_score !== null ? number_format($certificate->cvss_score, 1) : '-' }}
                        </span>
                    </div>
                </div>

                <!-- Classification Details -->
                <div class="p-4 bg-gray-50/50 dark:bg-slate-950/30 rounded-xl border border-gray-200/50 dark:border-slate-800 flex items-center justify-between gap-4">
                    <div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block">Kategori Kerentanan</span>
                        <span class="font-bold text-sm text-slate-800 dark:text-gray-200">{{ $report->jenis_kerentanan }}</span>
                    </div>
                    <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-[10px] font-bold uppercase rounded-lg border border-emerald-300 dark:border-emerald-700/50 shrink-0">
                        Status Laporan: VALID
                    </span>
                </div>

                <!-- Cryptographic SHA-256 Hash Verification Block -->
                <div class="bg-gray-900 text-gray-200 p-5 rounded-2xl border border-gray-800 space-y-2">
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <span class="text-[10px] font-mono text-emerald-400 font-bold uppercase tracking-widest flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Tanda Tangan Integritas Kriptografi (SHA-256)
                        </span>

                        <button type="button"
                                @click="navigator.clipboard.writeText({{ \Illuminate\Support\Js::from($certificate->verification_hash) }}); copied = true; setTimeout(() => copied = false, 2000)"
                                class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white rounded-lg text-[10px] font-mono transition-all border border-gray-700">
                            <span x-text="copied ? '✓ Tersalin!' : 'Salin Hash'"></span>
                        </button>
                    </div>
                    <code class="font-mono text-xs text-cyan-300 break-all block leading-relaxed bg-black/40 p-3 rounded-xl border border-gray-800 select-all">
                        {{ $certificate->verification_hash }}
                    </code>
                    <p class="text-[10px] text-gray-400 font-mono">
                        Hash dihitung secara deterministik dari metadata penerbitan untuk menjamin dokumen asli dan bebas dari pemalsuan.
                    </p>
                </div>

            </div>

            <!-- Footer Card -->
            <div class="p-6 bg-gray-50/70 dark:bg-slate-950/60 border-t border-gray-100 dark:border-slate-800/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
                <div class="text-xs text-gray-500 dark:text-gray-400">
                    Sertifikat resmi dikeluarkan oleh <strong>JatimProv-CSIRT</strong>.
                    <br class="hidden sm:inline"> Hak Cipta &copy; {{ date('Y') }} Pemerintah Provinsi Jawa Timur.
                </div>
                <a href="{{ url('/') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-900 hover:bg-gray-100 dark:hover:bg-slate-800 text-slate-800 dark:text-gray-200 border border-gray-200 dark:border-slate-700 rounded-xl text-xs font-bold transition-all shadow-sm">
                    Kembali ke Beranda CSIRT
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

        </div>

    </main>

    <footer class="mt-auto py-6 text-center text-xs text-gray-400 dark:text-gray-600 border-t border-gray-100 dark:border-slate-900 relative z-10">
        JatimProv-CSIRT — Keamanan Siber &amp; Perlindungan Data Terpadu Jawa Timur
    </footer>

</body>
</html>
