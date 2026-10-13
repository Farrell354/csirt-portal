<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Tidak Ditemukan — JatimProv-CSIRT</title>
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-rose-500 selection:text-white">

    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 animate-grid-flow z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-rose-600/5 dark:bg-rose-500/10 rounded-full blur-[130px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <main class="flex-grow max-w-2xl mx-auto px-4 sm:px-6 py-16 w-full relative z-10 pt-24 text-center">

        <div class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-2xl rounded-[2.5rem] shadow-2xl border border-gray-200/80 dark:border-slate-800 p-8 sm:p-12 space-y-6">

            <!-- Red Alert Icon -->
            <div class="w-20 h-20 mx-auto rounded-3xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900/60 flex items-center justify-center text-rose-500 shadow-xl shadow-rose-500/10">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800/50 text-rose-600 dark:text-rose-400 font-mono text-xs font-bold tracking-widest uppercase rounded-full">
                INVALID / UNVERIFIED RECORD
            </div>

            <h1 class="font-display text-2xl sm:text-3xl font-black text-slate-900 dark:text-white">
                Sertifikat Tidak Ditemukan / Tidak Valid
            </h1>

            <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed max-w-md mx-auto">
                Pengenal sertifikat yang Anda masukkan tidak terdaftar dalam catatan resmi basis data penerbitan JatimProv-CSIRT atau dokumen ini tidak valid.
            </p>

            @if(!empty($attemptedUuid))
                <div class="bg-gray-50 dark:bg-slate-950/60 p-3 rounded-xl border border-gray-200 dark:border-slate-800 font-mono text-xs text-gray-500 break-all select-all">
                    Identifier: {{ $attemptedUuid }}
                </div>
            @endif

            <div class="pt-4 border-t border-gray-100 dark:border-slate-800/80 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ url('/') }}"
                   class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-slate-900 to-slate-800 hover:from-slate-800 hover:to-slate-700 dark:from-slate-800 dark:to-slate-700 text-white rounded-xl text-xs font-bold transition-all shadow-md">
                    Kembali ke Beranda CSIRT
                </a>
                <a href="{{ url('/kontak') }}"
                   class="w-full sm:w-auto px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200 rounded-xl text-xs font-bold transition-all border border-gray-200 dark:border-slate-700">
                    Hubungi Tim CSIRT
                </a>
            </div>

        </div>

    </main>

    <footer class="mt-auto py-6 text-center text-xs text-gray-400 dark:text-gray-600 border-t border-gray-100 dark:border-slate-900 relative z-10">
        JatimProv-CSIRT — Keamanan Siber &amp; Perlindungan Data Terpadu Jawa Timur
    </footer>

</body>
</html>
