<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kirim Laporan Bug - JatimProv CSIRT</title>
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-blue-500 selection:text-white">

    <!-- Latar Belakang Mesh Grid & Ambient Glow -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-40 dark:opacity-100 z-0"></div>
    <div class="fixed top-1/4 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-blue-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- KONTEN UTAMA -->
    <div class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10">
        
        <!-- Tombol Kembali -->
        <div class="opacity-0 animate-fade-in-up">
            <a href="/dashboard" class="inline-flex items-center text-xs font-bold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 mb-6 transition-transform hover:-translate-x-2 duration-300 uppercase tracking-widest bg-white/50 dark:bg-slate-900/50 px-4 py-2 rounded-full border border-gray-200 dark:border-slate-800 backdrop-blur-sm shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Dashboard
            </a>
        </div>

        <!-- Header Form (Glassmorphism) -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] border border-gray-200/50 dark:border-slate-700/80 overflow-hidden opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            
            <!-- Dekorasi Garis Atas Nyala -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-blue-600"></div>

            <div class="px-8 pt-10 pb-8 border-b border-gray-100 dark:border-slate-800/80 bg-gray-50/50 dark:bg-[#020817]/50 relative overflow-hidden">
                <!-- Aksen Glow Sudut Kanan Atas -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800/50 text-blue-600 dark:text-blue-400 font-mono text-[10px] font-bold tracking-widest mb-4 uppercase rounded-full shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500 shadow-[0_0_8px_#3b82f6]"></span>
                    </span>
                    FORM PELAPORAN
                </div>

                <h1 class="font-display text-3xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight mb-2">Kirim Laporan <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-blue-400 dark:to-cyan-400">Kerentanan</span></h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Bantu kami mengamankan ekosistem digital JatimProv. Pastikan laporan Anda menyertakan bukti eksploitasi (PoC) yang jelas.</p>
            </div>

            <!-- Area Form -->
            <div class="p-8 md:p-10">
                
                <!-- PESAN ERROR VALIDASI -->
                @if ($errors->any())
                    <div class="mb-8 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 rounded-2xl p-5 shadow-sm">
                        <div class="flex items-center gap-2 text-red-600 dark:text-red-400 font-bold text-sm mb-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                            Gagal mengirim laporan! Terdapat kesalahan:
                        </div>
                        <ul class="list-disc ml-6 text-sm text-red-700 dark:text-red-300/80 font-medium space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="break-words">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="/dashboard/lapor" method="POST" enctype="multipart/form-data" x-data="{
                        verifyState: 'idle',
                        verifyMsg: '',
                        httpCode: null,
                        resolvedIp: '',
                        debounceTimer: null,
                        scopeOk: null,

                        triggerVerify(url) {
                            clearTimeout(this.debounceTimer);
                            if (!url || url.length < 10) {
                                this.verifyState = 'idle';
                                this.scopeOk = null;
                                return;
                            }
                            this.debounceTimer = setTimeout(() => this.doVerify(url), 900);
                        },

                        async doVerify(url) {
                            this.verifyState = 'checking';
                            this.verifyMsg = '';
                            this.scopeOk = null;
                            try {
                                const resp = await fetch('{{ route('api.verify-target') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content ?? '',
                                        'Accept': 'application/json',
                                    },
                                    body: JSON.stringify({ url }),
                                });
                                const data = await resp.json();

                                if (data.status === 'verified') {
                                    this.verifyState = 'verified';
                                    this.httpCode = data.http_code;
                                    this.resolvedIp = data.ip ?? '';
                                    this.verifyMsg = data.message;
                                    this.scopeOk = true;
                                } else if (data.status === 'out_of_scope') {
                                    this.verifyState = 'out_of_scope';
                                    this.verifyMsg = data.message;
                                    this.scopeOk = false;
                                } else if (data.status === 'offline' || data.status === 'dns_failure') {
                                    this.verifyState = 'offline';
                                    this.verifyMsg = data.message;
                                    this.scopeOk = false;
                                } else if (data.status === 'prohibited_target') {
                                    this.verifyState = 'blocked';
                                    this.verifyMsg = data.message;
                                    this.scopeOk = false;
                                } else {
                                    this.verifyState = 'error';
                                    this.verifyMsg = data.message ?? 'Verifikasi gagal.';
                                    this.scopeOk = false;
                                }
                            } catch (e) {
                                this.verifyState = 'error';
                                this.verifyMsg = 'Tidak dapat menghubungi server verifikasi.';
                                this.scopeOk = false;
                            }
                        }
                    }">
                    @csrf

                    <!-- Target URL + Live Asset & Anti-SSRF Verifier -->
                    <div class="mb-8 group">
                        <label for="target_url" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2">
                            Target URL / Domain <span class="text-red-500 text-lg leading-none">*</span>
                            <span class="text-[10px] normal-case font-normal text-gray-400 dark:text-gray-500 ml-1">— Hanya *.jatimprov.go.id</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            </div>
                            <input type="url" name="target_url" id="target_url" required
                                placeholder="https://portal.jatimprov.go.id/path/vuln"
                                value="{{ old('target_url') }}"
                                @input="triggerVerify($event.target.value)"
                                @blur="triggerVerify($event.target.value)"
                                :class="{
                                    'border-emerald-500 dark:border-emerald-600 focus:ring-emerald-500/50': verifyState === 'verified',
                                    'border-red-400 dark:border-red-600 focus:ring-red-500/50': verifyState === 'out_of_scope' || verifyState === 'blocked',
                                    'border-amber-400 dark:border-amber-600 focus:ring-amber-500/50': verifyState === 'offline' || verifyState === 'error',
                                    'border-blue-400 dark:border-blue-600 animate-pulse': verifyState === 'checking',
                                }"
                                class="w-full pl-12 pr-10 py-4 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-2xl focus:ring-2 focus:border-blue-500 outline-none text-sm font-mono text-gray-900 dark:text-blue-300 transition-all shadow-sm group-hover:border-blue-300 dark:group-hover:border-slate-600 placeholder-gray-400 dark:placeholder-gray-600">

                            <!-- Spinning indicator when checking -->
                            <div x-show="verifyState === 'checking'" class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-blue-500 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                </svg>
                            </div>
                            <!-- Check mark when verified -->
                            <div x-show="verifyState === 'verified'" class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <!-- Warning when out-of-scope / blocked -->
                            <div x-show="verifyState === 'out_of_scope' || verifyState === 'blocked'" class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </div>
                        </div>

                        <!-- ===== VERIFICATION STATUS INDICATOR ===== -->

                        <!-- Idle hint -->
                        <p x-show="verifyState === 'idle'" class="mt-2 text-[11px] text-gray-400 dark:text-gray-500 font-mono flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Ketik URL target untuk memulai verifikasi scope & keaktifan aset secara otomatis.
                        </p>

                        <!-- Checking / spinner text -->
                        <div x-show="verifyState === 'checking'" class="mt-2 flex items-center gap-2">
                            <span class="inline-block w-2 h-2 rounded-full bg-blue-500 animate-ping"></span>
                            <p class="text-[11px] text-blue-600 dark:text-blue-400 font-mono font-bold">Memeriksa keaktifan & scope aset Pemprov Jatim...</p>
                        </div>

                        <!-- VERIFIED ✅ -->
                        <div x-show="verifyState === 'verified'"
                             class="mt-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-800/50 rounded-xl px-4 py-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                <span class="text-xs font-bold text-emerald-700 dark:text-emerald-400">
                                    Aset Resmi Terverifikasi &amp; Aktif
                                    <span x-text="httpCode ? '(HTTP ' + httpCode + ')' : ''" class="font-mono ml-1"></span>
                                </span>
                            </div>
                            <div class="flex items-center gap-3 flex-wrap">
                                <span x-text="resolvedIp ? 'IP: ' + resolvedIp : ''" class="text-[10px] font-mono text-emerald-600 dark:text-emerald-500"></span>
                                <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-widest bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400 px-2.5 py-1 rounded-full border border-emerald-300 dark:border-emerald-700/50">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Safe Harbor Eligible
                                </span>
                            </div>
                        </div>

                        <!-- OUT-OF-SCOPE 🚫 -->
                        <div x-show="verifyState === 'out_of_scope'"
                             class="mt-3 flex items-start gap-2 bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-800/50 rounded-xl px-4 py-3">
                            <svg class="w-4 h-4 text-red-600 dark:text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                            <div>
                                <p class="text-xs font-bold text-red-700 dark:text-red-400">Di Luar Kewenangan JatimProv-CSIRT</p>
                                <p x-text="verifyMsg" class="text-[11px] text-red-600 dark:text-red-400/80 mt-0.5"></p>
                                <p class="text-[10px] text-red-500/70 dark:text-red-500/50 mt-1 font-mono">Target harus berakhiran *.jatimprov.go.id untuk diterima sistem.</p>
                            </div>
                        </div>

                        <!-- BLOCKED / PROHIBITED 🛑 -->
                        <div x-show="verifyState === 'blocked'"
                             class="mt-3 flex items-start gap-2 bg-red-50 dark:bg-red-950/30 border border-red-300 dark:border-red-700/50 rounded-xl px-4 py-3">
                            <svg class="w-4 h-4 text-red-700 dark:text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"/></svg>
                            <div>
                                <p class="text-xs font-bold text-red-800 dark:text-red-300">Target Diblokir — Keamanan Sistem</p>
                                <p x-text="verifyMsg" class="text-[11px] text-red-700 dark:text-red-400/80 mt-0.5"></p>
                            </div>
                        </div>

                        <!-- OFFLINE / DNS FAILURE ⚠️ -->
                        <div x-show="verifyState === 'offline'"
                             class="mt-3 flex items-start gap-2 bg-amber-50 dark:bg-amber-950/20 border border-amber-200 dark:border-amber-800/40 rounded-xl px-4 py-3">
                            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div>
                                <p class="text-xs font-bold text-amber-700 dark:text-amber-400">Target Tidak Merespons / Domain Tidak Aktif</p>
                                <p x-text="verifyMsg" class="text-[11px] text-amber-600 dark:text-amber-400/80 mt-0.5"></p>
                                <p class="text-[10px] text-amber-500/70 dark:text-amber-500/50 mt-1">Anda tetap dapat mengirim laporan jika yakin target ada, namun pastikan URL sudah benar.</p>
                            </div>
                        </div>

                        <!-- ERROR -->
                        <div x-show="verifyState === 'error'"
                             class="mt-3 flex items-center gap-2 text-[11px] text-gray-500 dark:text-gray-400 font-mono px-2">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span x-text="verifyMsg"></span>
                        </div>

                        <!-- Submit gate notice when out-of-scope / blocked -->
                        <div x-show="scopeOk === false && (verifyState === 'out_of_scope' || verifyState === 'blocked')"
                             class="mt-2 text-[11px] font-bold text-red-600 dark:text-red-400 font-mono">
                            ⚠ Laporan tidak dapat dikirim untuk target di luar scope atau terlarang.
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Jenis Kerentanan -->
                        <div class="group">
                            <label class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2" for="jenis_kerentanan">
                                Kategori Kerentanan <span class="text-red-500 text-lg leading-none">*</span>
                            </label>
                            <div class="relative">
                                <select name="jenis_kerentanan" id="jenis_kerentanan" required class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none text-sm font-bold text-gray-900 dark:text-white cursor-pointer transition-all shadow-sm group-hover:border-blue-300 dark:group-hover:border-slate-600 appearance-none">
                                    <option value="" disabled selected class="text-gray-500">-- Pilih Jenis Kerentanan --</option>
                                    {{-- Injection --}}
                                    <option value="SQL Injection" {{ old('jenis_kerentanan') == 'SQL Injection' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">SQL Injection</option>
                                    <option value="SQL Injection (SQLi)" {{ old('jenis_kerentanan') == 'SQL Injection (SQLi)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">SQL Injection (SQLi)</option>
                                    <option value="XML External Entity (XXE)" {{ old('jenis_kerentanan') == 'XML External Entity (XXE)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">XML External Entity (XXE)</option>
                                    <option value="Local File Inclusion (LFI)" {{ old('jenis_kerentanan') == 'Local File Inclusion (LFI)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Local File Inclusion (LFI)</option>
                                    <option value="Remote File Inclusion (RFI)" {{ old('jenis_kerentanan') == 'Remote File Inclusion (RFI)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Remote File Inclusion (RFI)</option>
                                    <option value="Remote Code Execution (RCE)" {{ old('jenis_kerentanan') == 'Remote Code Execution (RCE)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Remote Code Execution (RCE)</option>
                                    <option value="Server-Side Request Forgery (SSRF)" {{ old('jenis_kerentanan') == 'Server-Side Request Forgery (SSRF)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Server-Side Request Forgery (SSRF)</option>
                                    {{-- Client-Side Attacks --}}
                                    <option value="Cross-Site Scripting (XSS)" {{ old('jenis_kerentanan') == 'Cross-Site Scripting (XSS)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Cross-Site Scripting (XSS)</option>
                                    <option value="Cross-Site Request Forgery (CSRF)" {{ old('jenis_kerentanan') == 'Cross-Site Request Forgery (CSRF)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Cross-Site Request Forgery (CSRF)</option>
                                    <option value="Open Redirect" {{ old('jenis_kerentanan') == 'Open Redirect' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Open Redirect</option>
                                    {{-- Access & Authentication --}}
                                    <option value="Broken Authentication" {{ old('jenis_kerentanan') == 'Broken Authentication' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Broken Authentication</option>
                                    <option value="Authentication Bypass" {{ old('jenis_kerentanan') == 'Authentication Bypass' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Authentication Bypass</option>
                                    <option value="Broken Access Control" {{ old('jenis_kerentanan') == 'Broken Access Control' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Broken Access Control</option>
                                    <option value="Insecure Direct Object Reference (IDOR)" {{ old('jenis_kerentanan') == 'Insecure Direct Object Reference (IDOR)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Insecure Direct Object Reference (IDOR)</option>
                                    {{-- Data & Configuration --}}
                                    <option value="Sensitive Data Exposure" {{ old('jenis_kerentanan') == 'Sensitive Data Exposure' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Sensitive Data Exposure</option>
                                    <option value="Security Misconfiguration" {{ old('jenis_kerentanan') == 'Security Misconfiguration' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Security Misconfiguration</option>
                                    <option value="Insecure Deserialization" {{ old('jenis_kerentanan') == 'Insecure Deserialization' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Insecure Deserialization</option>
                                    <option value="Using Components with Known Vulnerabilities" {{ old('jenis_kerentanan') == 'Using Components with Known Vulnerabilities' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Using Components with Known Vulnerabilities</option>
                                    <option value="Insufficient Logging &amp; Monitoring" {{ old('jenis_kerentanan') == 'Insufficient Logging & Monitoring' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Insufficient Logging &amp; Monitoring</option>
                                    {{-- Logic --}}
                                    <option value="Business Logic Vulnerability" {{ old('jenis_kerentanan') == 'Business Logic Vulnerability' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Business Logic Vulnerability</option>
                                    <option value="Business Logic Flaw" {{ old('jenis_kerentanan') == 'Business Logic Flaw' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Business Logic Flaw</option>
                                    {{-- Catch-all --}}
                                    <option value="Lainnya" {{ old('jenis_kerentanan') == 'Lainnya' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Lainnya (Other)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500 dark:text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Severity -->
                        <div class="group">
                            <label class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2" for="severity">
                                Tingkat Keparahan <span class="text-red-500 text-lg leading-none">*</span>
                            </label>
                            <div class="relative">
                                <select name="severity" id="severity" required class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none text-sm font-bold text-gray-900 dark:text-white cursor-pointer transition-all shadow-sm group-hover:border-blue-300 dark:group-hover:border-slate-600 appearance-none">
                                    <option value="" disabled selected class="text-gray-500">-- Est. Severity --</option>
                                    <option value="Informational" {{ old('severity') == 'Informational' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">🔵 Informational (Tidak berdampak langsung)</option>
                                    <option value="Low" {{ old('severity') == 'Low' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">🟢 Low (Dampak minim)</option>
                                    <option value="Medium" {{ old('severity') == 'Medium' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">🟡 Medium (Berdampak sebagian)</option>
                                    <option value="High" {{ old('severity') == 'High' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">🟠 High (Merusak/mencuri data)</option>
                                    <option value="Critical" {{ old('severity') == 'Critical' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">🔴 Critical (Pengambilalihan penuh)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500 dark:text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Dampak -->
                    <div class="mb-8 group">
                        <label for="deskripsi" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2">
                            Deskripsi & Dampak Kerentanan <span class="text-red-500 text-lg leading-none">*</span>
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" required placeholder="Jelaskan secara singkat celah keamanan yang ditemukan dan dampak terburuk jika dieksploitasi..." 
                            class="w-full px-5 py-4 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-2xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none text-sm font-medium text-gray-900 dark:text-gray-200 transition-all leading-relaxed shadow-sm group-hover:border-blue-300 dark:group-hover:border-slate-600 placeholder-gray-400 dark:placeholder-gray-600 break-words">{{ old('deskripsi') }}</textarea>
                    </div>

                    <!-- Lampiran Bukti PoC (Upload File) -->
                    <div class="mb-10 group">
                        <label class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2" for="bukti_poc">
                            Lampiran Bukti (PoC) <span class="text-red-500 text-lg leading-none">*</span>
                        </label>
                        
                        <div class="flex items-center justify-center w-full">
                            <label for="bukti_poc" class="flex flex-col items-center justify-center w-full h-36 border-2 border-blue-300 dark:border-slate-600 border-dashed rounded-2xl cursor-pointer bg-blue-50/50 dark:bg-slate-950/50 hover:bg-blue-50 dark:hover:bg-slate-900 transition-colors group-hover:border-blue-400 dark:group-hover:border-blue-500/50 relative overflow-hidden group/upload">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <div class="p-3 bg-blue-100 dark:bg-slate-800 rounded-full mb-3 text-blue-500 dark:text-blue-400 group-hover/upload:scale-110 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    </div>
                                    <p id="file-name-display" class="mb-1 text-sm text-gray-600 dark:text-gray-300 font-bold">Klik untuk upload file PoC</p>
                                    <p class="text-[11px] text-gray-500 dark:text-gray-500 font-medium">JPG, PNG, PDF, atau MP4 (Maks. 5MB)</p>
                                </div>
                                <input id="bukti_poc" name="bukti_poc" type="file" required class="sr-only" accept=".jpg,.png,.pdf,.mp4" onchange="document.getElementById('file-name-display').innerText = this.files[0] ? this.files[0].name : 'Klik untuk upload file PoC'" />
                            </label>
                        </div>
                    </div>

                    {{-- Enhancement 3: Pseudonymous / Anonymous Reporting Toggle (ISO/IEC 29147 / UU PDP) --}}
                    <div class="mb-6 bg-indigo-50 dark:bg-indigo-900/10 border border-indigo-200 dark:border-indigo-800/50 p-5 rounded-2xl">
                        <div class="flex items-center justify-between gap-4 mb-3">
                            <div>
                                <p class="text-sm font-bold text-indigo-800 dark:text-indigo-300 flex items-center gap-2">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Laporkan Secara Anonim / Pseudonim
                                </p>
                                <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-1">Identitas Anda tidak akan ditampilkan kepada tim CSIRT. Sesuai prinsip data minimisasi UU PDP No. 27/2022.</p>
                            </div>
                            {{-- Toggle switch --}}
                            <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1" class="sr-only peer"
                                    onchange="
                                        document.getElementById('pseudonym-field').classList.toggle('hidden', !this.checked);
                                        document.getElementById('anon-poin-warning').classList.toggle('hidden', !this.checked);
                                    "
                                    {{ old('is_anonymous') ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-indigo-500/50 dark:bg-slate-700 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-slate-600 peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                        {{-- Poin warning: shown only when toggle is ON --}}
                        <div id="anon-poin-warning" class="{{ old('is_anonymous') ? '' : 'hidden' }} mt-2 flex items-start gap-2.5 bg-amber-50 dark:bg-amber-900/10 border border-amber-300 dark:border-amber-700/50 px-4 py-3 rounded-xl">
                            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <p class="text-xs text-amber-700 dark:text-amber-300 font-medium leading-relaxed">
                                <strong class="font-bold">Perhatian:</strong> Laporan anonim tidak akan mendapatkan poin reputasi pada Leaderboard / Hall of Fame demi menjamin kerahasiaan identitas Anda secara mutlak.
                            </p>
                        </div>
                        {{-- Pseudonym field, hidden unless toggle is on --}}
                        <div id="pseudonym-field" class="{{ old('is_anonymous') ? '' : 'hidden' }} mt-2">
                            <label for="pseudonym" class="block text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-1.5">Handle / Pseudonim <span class="text-gray-400 font-normal normal-case">(opsional)</span></label>
                            <input type="text" name="pseudonym" id="pseudonym" value="{{ old('pseudonym') }}"
                                placeholder="Contoh: sec_researcher_anon atau h4ck3r_x"
                                maxlength="80"
                                class="w-full px-4 py-3 bg-white dark:bg-slate-950/50 border border-indigo-200 dark:border-indigo-700/50 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none text-sm font-mono text-gray-900 dark:text-indigo-300 transition-all shadow-sm placeholder-gray-400 dark:placeholder-gray-600">
                            <p class="text-[10px] text-gray-500 dark:text-gray-500 mt-1.5">Hanya huruf, angka, spasi, tanda hubung dan titik. Tidak boleh berisi nama asli atau informasi pribadi.</p>
                        </div>
                    </div>

                    {{-- NDA --}}
                    <div class="mb-8 bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-800/50 p-5 rounded-2xl">
                        <label class="flex items-start gap-4 cursor-pointer group">
                            <div class="relative flex items-center justify-center mt-0.5 shrink-0">
                                <input type="checkbox" name="nda_agreement" required class="peer appearance-none w-5 h-5 border-2 border-amber-300 dark:border-amber-700 rounded bg-white dark:bg-slate-800 checked:bg-amber-500 checked:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/30 transition-all cursor-pointer">
                                <svg class="absolute w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-xs text-gray-700 dark:text-gray-300 leading-relaxed font-medium">
                                <strong class="text-amber-700 dark:text-amber-500 font-bold uppercase tracking-widest text-[10px] block mb-1">Non-Disclosure Agreement (NDA)</strong>
                                Dengan mengirimkan laporan ini, saya setuju untuk merahasiakan celah keamanan ini dan <strong class="text-red-600 dark:text-red-400">TIDAK AKAN</strong> mempublikasikannya ke pihak luar/sosial media sampai celah diperbaiki sepenuhnya oleh JatimProv-CSIRT. Identitas saya akan dienkripsi dan dilindungi.
                            </span>
                        </label>
                    </div>

                    <!-- Area Tombol Submit -->
                    <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4 pt-6 border-t border-gray-100 dark:border-slate-800/80">
                        <a href="/dashboard" class="w-full sm:w-auto px-6 py-3.5 text-gray-600 dark:text-gray-400 font-bold hover:bg-gray-100 dark:hover:bg-slate-800/50 rounded-xl transition-colors text-sm text-center border border-transparent hover:border-gray-200 dark:hover:border-slate-700">
                            Batalkan
                        </a>
                        
                        <button type="submit"
                            :disabled="scopeOk === false && (verifyState === 'out_of_scope' || verifyState === 'blocked')"
                            :class="(scopeOk === false && (verifyState === 'out_of_scope' || verifyState === 'blocked'))
                                ? 'opacity-40 cursor-not-allowed'
                                : 'hover:from-blue-500 hover:to-cyan-400 hover:shadow-[0_0_25px_rgba(59,130,246,0.5)] hover:-translate-y-0.5'"
                            class="group relative w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-500 text-white text-sm font-bold py-3.5 px-8 rounded-xl transition-all shadow-[0_0_15px_rgba(59,130,246,0.3)] overflow-hidden">
                            <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover:-translate-x-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </span>
                            <span class="transition-all duration-300 ease-out group-hover:-translate-x-3 flex items-center gap-2">
                                <svg class="w-4 h-4 group-hover:opacity-0 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                Kirim Laporan
                            </span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <x-chatbot />
</body>
</html>