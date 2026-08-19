<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan - JatimProv-CSIRT</title>
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
    <div class="fixed top-0 right-1/4 -mt-20 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- KONTEN UTAMA -->
    <div class="flex-grow relative z-10 transition-colors duration-300">
        
        <!-- HEADER HALAMAN -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-gray-200 dark:border-slate-800/80 py-20 transition-colors duration-300 relative overflow-hidden">
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-3xl opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-cyan-500/30 text-blue-600 dark:text-cyan-400 font-mono text-[11px] font-bold tracking-widest mb-6 uppercase rounded-full shadow-sm animate-float-subtle">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500 shadow-[0_0_8px_#22d3ee]"></span>
                        </span>
                        [ SERVICES // 02 ]
                    </div>
                    
                    <!-- Judul Besar -->
                    <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 dark:text-white tracking-tight mb-4 drop-shadow-sm">
                        Layanan Utama
                    </h1>
                    <p class="text-lg md:text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-cyan-400 dark:to-blue-500 tracking-wide">
                        Kerangka kerja profesional dalam penanggulangan dan pemulihan insiden siber.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            
            <!-- Deskripsi Pembuka -->
            <div class="mb-16 reveal-on-scroll">
                <div class="border-l-4 border-cyan-500 pl-6 py-2">
                    <p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed max-w-4xl font-medium">
                        <strong class="text-slate-900 dark:text-white font-display">JatimProv-CSIRT</strong> berkomitmen untuk memberikan perlindungan, pencegahan, dan mitigasi ancaman siber secara komprehensif bagi seluruh konstituen Pemerintah Provinsi Jawa Timur melalui ekosistem layanan berstandar internasional.
                    </p>
                </div>
            </div>

            <!-- GRID KARTU LAYANAN -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                
                <!-- 01. Penanganan Insiden -->
                <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-8 hover:border-blue-500 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden rounded-3xl hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-2 flex flex-col h-full" style="animation-delay: 0.1s;">
                    <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/0 to-cyan-500/0 group-hover:from-cyan-500/5 dark:group-hover:from-cyan-500/10 transition-colors duration-500 z-0"></div>
                    <div class="font-display text-8xl font-black text-gray-50 dark:text-slate-800/50 absolute -top-4 -right-2 pointer-events-none transition-transform duration-500 group-hover:scale-110 group-hover:text-blue-50 dark:group-hover:text-cyan-900/20 z-0">01</div>
                    
                    <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-slate-800 flex items-center justify-center mb-6 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 transition-colors duration-500 border border-blue-100 dark:border-slate-700 relative z-10 shadow-sm">
                        <svg class="w-6 h-6 text-blue-600 dark:text-cyan-400 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div class="relative z-10 flex-grow">
                        <h3 class="font-display text-xl font-bold text-slate-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">Penanganan Insiden</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-6 font-medium">
                            Respons cepat dan penanganan tuntas atas insiden keamanan siber yang menyerang sistem pemerintahan.
                        </p>
                    </div>
                    <a href="/layanan/penanganan-insiden" class="inline-flex items-center text-blue-600 dark:text-cyan-400 font-bold text-xs uppercase tracking-widest mt-auto group-hover:text-blue-800 dark:group-hover:text-cyan-300 transition-colors relative z-10">
                        Selengkapnya <svg class="w-4 h-4 ml-2 transform transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <!-- 02. Aduan Konten -->
                <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-8 hover:border-blue-500 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden rounded-3xl hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-2 flex flex-col h-full" style="animation-delay: 0.2s;">
                    <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/0 to-cyan-500/0 group-hover:from-cyan-500/5 dark:group-hover:from-cyan-500/10 transition-colors duration-500 z-0"></div>
                    <div class="font-display text-8xl font-black text-gray-50 dark:text-slate-800/50 absolute -top-4 -right-2 pointer-events-none transition-transform duration-500 group-hover:scale-110 group-hover:text-blue-50 dark:group-hover:text-cyan-900/20 z-0">02</div>
                    
                    <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-slate-800 flex items-center justify-center mb-6 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 transition-colors duration-500 border border-blue-100 dark:border-slate-700 relative z-10 shadow-sm">
                        <svg class="w-6 h-6 text-blue-600 dark:text-cyan-400 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                    </div>
                    <div class="relative z-10 flex-grow">
                        <h3 class="font-display text-xl font-bold text-slate-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">Aduan Konten</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-6 font-medium">
                            Laporkan konten negatif, hoaks, atau materi melanggar hukum untuk ditindaklanjuti oleh pihak berwenang.
                        </p>
                    </div>
                    <a href="/layanan/aduan-konten" class="inline-flex items-center text-blue-600 dark:text-cyan-400 font-bold text-xs uppercase tracking-widest mt-auto group-hover:text-blue-800 dark:group-hover:text-cyan-300 transition-colors relative z-10">
                        Selengkapnya <svg class="w-4 h-4 ml-2 transform transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <!-- 03. PANDA -->
                <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-8 hover:border-blue-500 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden rounded-3xl hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-2 flex flex-col h-full" style="animation-delay: 0.3s;">
                    <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/0 to-cyan-500/0 group-hover:from-cyan-500/5 dark:group-hover:from-cyan-500/10 transition-colors duration-500 z-0"></div>
                    <div class="font-display text-8xl font-black text-gray-50 dark:text-slate-800/50 absolute -top-4 -right-2 pointer-events-none transition-transform duration-500 group-hover:scale-110 group-hover:text-blue-50 dark:group-hover:text-cyan-900/20 z-0">03</div>
                    
                    <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-slate-800 flex items-center justify-center mb-6 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 transition-colors duration-500 border border-blue-100 dark:border-slate-700 relative z-10 shadow-sm">
                        <svg class="w-6 h-6 text-blue-600 dark:text-cyan-400 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div class="relative z-10 flex-grow">
                        <h3 class="font-display text-xl font-bold text-slate-900 dark:text-white mb-1 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">PANDA</h3>
                        <p class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-3">Private & Secure Data Access</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-6 font-medium">
                            Enkripsi kuat tingkat lanjut yang melindungi data sensitif Anda di setiap tahap siklus penggunaannya.
                        </p>
                    </div>
                    <a href="/layanan/panda-private-and-secure-data-access" class="inline-flex items-center text-blue-600 dark:text-cyan-400 font-bold text-xs uppercase tracking-widest mt-auto group-hover:text-blue-800 dark:group-hover:text-cyan-300 transition-colors relative z-10">
                        Selengkapnya <svg class="w-4 h-4 ml-2 transform transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <!-- 04. ITSA -->
                <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-8 hover:border-blue-500 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden rounded-3xl hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-2 flex flex-col h-full" style="animation-delay: 0.1s;">
                    <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/0 to-cyan-500/0 group-hover:from-cyan-500/5 dark:group-hover:from-cyan-500/10 transition-colors duration-500 z-0"></div>
                    <div class="font-display text-8xl font-black text-gray-50 dark:text-slate-800/50 absolute -top-4 -right-2 pointer-events-none transition-transform duration-500 group-hover:scale-110 group-hover:text-blue-50 dark:group-hover:text-cyan-900/20 z-0">04</div>
                    
                    <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-slate-800 flex items-center justify-center mb-6 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 transition-colors duration-500 border border-blue-100 dark:border-slate-700 relative z-10 shadow-sm">
                        <svg class="w-6 h-6 text-blue-600 dark:text-cyan-400 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div class="relative z-10 flex-grow">
                        <h3 class="font-display text-xl font-bold text-slate-900 dark:text-white mb-1 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">ITSA</h3>
                        <p class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-3">IT Security Assessment</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-6 font-medium">
                            Uji keamanan aplikasi secara menyeluruh dan dapatkan rekomendasi mitigasi serta status kelulusan.
                        </p>
                    </div>
                    <a href="/layanan/itsa-it-security-assessment" class="inline-flex items-center text-blue-600 dark:text-cyan-400 font-bold text-xs uppercase tracking-widest mt-auto group-hover:text-blue-800 dark:group-hover:text-cyan-300 transition-colors relative z-10">
                        Selengkapnya <svg class="w-4 h-4 ml-2 transform transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <!-- 05. CTIS -->
                <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-8 hover:border-blue-500 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden rounded-3xl hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-2 flex flex-col h-full" style="animation-delay: 0.2s;">
                    <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/0 to-cyan-500/0 group-hover:from-cyan-500/5 dark:group-hover:from-cyan-500/10 transition-colors duration-500 z-0"></div>
                    <div class="font-display text-8xl font-black text-gray-50 dark:text-slate-800/50 absolute -top-4 -right-2 pointer-events-none transition-transform duration-500 group-hover:scale-110 group-hover:text-blue-50 dark:group-hover:text-cyan-900/20 z-0">05</div>
                    
                    <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-slate-800 flex items-center justify-center mb-6 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 transition-colors duration-500 border border-blue-100 dark:border-slate-700 relative z-10 shadow-sm">
                        <svg class="w-6 h-6 text-blue-600 dark:text-cyan-400 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                    </div>
                    <div class="relative z-10 flex-grow">
                        <h3 class="font-display text-xl font-bold text-slate-900 dark:text-white mb-1 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">CTIS</h3>
                        <p class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-3">Cyber Threat Info Sharing</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-6 font-medium">
                            Artikel dan *Indicator of Compromise* (IoC) terkini, siap diunduh untuk memperkuat kewaspadaan instansi.
                        </p>
                    </div>
                    <a href="/layanan/ctis-cyber-threat-information-sharing" class="inline-flex items-center text-blue-600 dark:text-cyan-400 font-bold text-xs uppercase tracking-widest mt-auto group-hover:text-blue-800 dark:group-hover:text-cyan-300 transition-colors relative z-10">
                        Selengkapnya <svg class="w-4 h-4 ml-2 transform transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <!-- 06. Verifikasi PTKKSS -->
                <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-8 hover:border-blue-500 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden rounded-3xl hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-2 flex flex-col h-full" style="animation-delay: 0.3s;">
                    <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/0 to-cyan-500/0 group-hover:from-cyan-500/5 dark:group-hover:from-cyan-500/10 transition-colors duration-500 z-0"></div>
                    <div class="font-display text-8xl font-black text-gray-50 dark:text-slate-800/50 absolute -top-4 -right-2 pointer-events-none transition-transform duration-500 group-hover:scale-110 group-hover:text-blue-50 dark:group-hover:text-cyan-900/20 z-0">06</div>
                    
                    <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-slate-800 flex items-center justify-center mb-6 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 transition-colors duration-500 border border-blue-100 dark:border-slate-700 relative z-10 shadow-sm">
                        <svg class="w-6 h-6 text-blue-600 dark:text-cyan-400 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    </div>
                    <div class="relative z-10 flex-grow">
                        <h3 class="font-display text-xl font-bold text-slate-900 dark:text-white mb-1 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">Verifikasi PTKKSS</h3>
                        <p class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-3">Sertifikasi & Kepatuhan</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-6 font-medium">
                            Pendampingan penilaian Indeks KAMI 5.0 dan IKASANDI secara resmi berstandar BSSN.
                        </p>
                    </div>
                    <a href="/layanan/verifikasi-ptkkss" class="inline-flex items-center text-blue-600 dark:text-cyan-400 font-bold text-xs uppercase tracking-widest mt-auto group-hover:text-blue-800 dark:group-hover:text-cyan-300 transition-colors relative z-10">
                        Selengkapnya <svg class="w-4 h-4 ml-2 transform transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

            </div>

            <!-- 07. WIDE BANNER CARD (Endpoint Monitoring) -->
            <div class="reveal-on-scroll mb-16" style="animation-delay: 0.2s;">
                <div class="group bg-gradient-to-br from-slate-900 to-slate-800 dark:from-slate-800 dark:to-slate-900 border border-blue-500/30 p-8 md:p-10 rounded-[2rem] shadow-xl relative overflow-hidden transition-all duration-500 hover:shadow-cyan-500/20 hover:-translate-y-1">
                    
                    <!-- Dekorasi Background -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-cyan-500/20 transition-colors duration-700"></div>
                    <div class="font-display text-9xl font-black text-white/5 dark:text-black/20 absolute -bottom-10 -right-6 pointer-events-none transform group-hover:scale-110 transition-transform duration-700">07</div>
                    
                    <div class="flex flex-col md:flex-row gap-8 items-center relative z-10">
                        <!-- Ikon Utama -->
                        <div class="w-20 h-20 rounded-2xl bg-cyan-500/10 flex items-center justify-center shrink-0 border border-cyan-500/30 group-hover:bg-cyan-600 group-hover:border-cyan-400 transition-all duration-500">
                            <svg class="w-10 h-10 text-cyan-400 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                        </div>
                        
                        <!-- Konten Banner -->
                        <div class="flex-grow text-center md:text-left">
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-cyan-500/20 border border-cyan-500/30 text-cyan-300 text-[10px] font-bold tracking-widest mb-3 uppercase rounded">
                                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                                Featured Service
                            </div>
                            <h3 class="font-display text-2xl md:text-3xl font-bold text-white mb-3">Endpoint Monitoring <span class="text-cyan-400 font-mono">(EDR/XDR)</span></h3>
                            <p class="text-sm md:text-base text-gray-300 leading-relaxed max-w-3xl font-medium">
                                Pemantauan keamanan *endpoint* secara terpusat dan *real-time* untuk mendeteksi, menganalisis, dan merespons ancaman siber (malware, ransomware) lebih cepat sebelum menyebar di jaringan institusi.
                            </p>
                        </div>
                        
                        <!-- Tombol CTA Dalam Banner -->
                        <div class="shrink-0 mt-4 md:mt-0">
                            <a href="/layanan/endpoint-monitoring-edrxdr" class="inline-flex items-center justify-center px-6 py-3.5 border-2 border-cyan-500 text-cyan-400 hover:bg-cyan-500 hover:text-white font-bold text-xs uppercase tracking-widest transition-all rounded-xl group-hover:shadow-[0_0_15px_rgba(6,182,212,0.5)]">
                                Selengkapnya <svg class="w-4 h-4 ml-2 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action Banner Bawah -->
            <div class="reveal-on-scroll bg-white/80 dark:bg-slate-800/50 backdrop-blur-xl p-8 sm:p-10 border-l-4 border-blue-600 dark:border-cyan-500 rounded-2xl shadow-lg">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex-1 text-center md:text-left">
                        <h4 class="font-display text-slate-900 dark:text-white text-xl font-bold mb-2">Sentra Informasi Keamanan Siber</h4>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-4 font-medium">
                            JatimProv-CSIRT secara rutin menyajikan data statistik mengenai insiden yang terjadi pada sektor pemerintah daerah. Kami hadir sebagai pusat rujukan informasi keamanan siber terpercaya.
                        </p>
                        <p class="text-slate-800 dark:text-gray-300 font-bold text-sm flex items-center justify-center md:justify-start gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                            Menemukan indikasi celah keamanan atau insiden?
                        </p>
                    </div>
                    <a href="/login" class="group relative bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white px-8 py-4 text-sm font-bold tracking-wide uppercase transition-all shadow-[0_0_15px_rgba(6,182,212,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.5)] rounded-xl hover:-translate-y-0.5 whitespace-nowrap overflow-hidden">
                        <span class="relative z-10 flex items-center gap-2">Lapor Insiden Sekarang <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></span>
                        <div class="absolute top-0 -left-[100%] w-1/2 h-full bg-gradient-to-r from-transparent via-white/30 to-transparent skew-x-12 animate-glare z-0 pointer-events-none"></div>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <x-footer />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

    <!-- SCRIPT OBSERVER UNTUK ANIMASI SCROLL -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const observerOptions = { root: null, rootMargin: '0px', threshold: 0.15 };
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        entry.target.classList.remove('reveal-on-scroll');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
