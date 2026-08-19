<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                
                <form action="/dashboard/lapor" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Target URL -->
                    <div class="mb-8 group">
                        <label for="target_url" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2">
                            Target URL / Domain <span class="text-red-500 text-lg leading-none">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            </div>
                            <input type="url" name="target_url" id="target_url" required placeholder="https://vulnerable-domain.jatimprov.go.id/path" value="{{ old('target_url') }}"
                                class="w-full pl-12 pr-5 py-4 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-2xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none text-sm font-mono text-gray-900 dark:text-blue-300 transition-all shadow-sm group-hover:border-blue-300 dark:group-hover:border-slate-600 placeholder-gray-400 dark:placeholder-gray-600 break-words">
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
                                    <option value="SQL Injection (SQLi)" {{ old('jenis_kerentanan') == 'SQL Injection (SQLi)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">SQL Injection (SQLi)</option>
                                    <option value="Cross-Site Scripting (XSS)" {{ old('jenis_kerentanan') == 'Cross-Site Scripting (XSS)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Cross-Site Scripting (XSS)</option>
                                    <option value="Remote Code Execution (RCE)" {{ old('jenis_kerentanan') == 'Remote Code Execution (RCE)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Remote Code Execution (RCE)</option>
                                    <option value="Insecure Direct Object Reference (IDOR)" {{ old('jenis_kerentanan') == 'Insecure Direct Object Reference (IDOR)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">IDOR</option>
                                    <option value="Cross-Site Request Forgery (CSRF)" {{ old('jenis_kerentanan') == 'Cross-Site Request Forgery (CSRF)' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">CSRF</option>
                                    <option value="Authentication Bypass" {{ old('jenis_kerentanan') == 'Authentication Bypass' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Authentication Bypass</option>
                                    <option value="Sensitive Data Exposure" {{ old('jenis_kerentanan') == 'Sensitive Data Exposure' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Sensitive Data Exposure</option>
                                    <option value="Business Logic Flaw" {{ old('jenis_kerentanan') == 'Business Logic Flaw' ? 'selected' : '' }} class="bg-white dark:bg-slate-800">Business Logic Flaw</option>
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

                    <!-- NDA -->
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
                        
                        <button type="submit" class="group relative w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-sm font-bold py-3.5 px-8 rounded-xl transition-all shadow-[0_0_15px_rgba(59,130,246,0.3)] hover:shadow-[0_0_25px_rgba(59,130,246,0.5)] hover:-translate-y-0.5 overflow-hidden">
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