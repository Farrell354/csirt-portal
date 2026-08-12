<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - JatimProv-CSIRT</title>
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
    <div class="fixed top-0 left-0 -mt-20 -ml-20 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

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
                        [ CONTACT // 03 ]
                    </div>
                    
                    <!-- Judul Besar -->
                    <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 dark:text-white tracking-tight mb-4 drop-shadow-sm">
                        Hubungi Kami
                    </h1>
                    <p class="text-lg md:text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-cyan-400 dark:to-blue-500 tracking-wide">
                        Pusat layanan informasi, pelaporan insiden, dan koordinasi keamanan siber Provinsi Jawa Timur.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                
                <!-- KIRI: INFORMASI KONTAK -->
                <div class="flex flex-col gap-6">
                    
                    <div class="flex items-center gap-4 mb-2 reveal-on-scroll">
                        <h2 class="font-display text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Kanal Komunikasi</h2>
                        <div class="h-[2px] flex-grow bg-gradient-to-r from-cyan-500/50 to-transparent"></div>
                    </div>
                        
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <!-- 01. Lokasi -->
                        <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-6 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-1 hover:border-blue-500/50 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden" style="animation-delay: 0.1s;">
                            <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/0 to-cyan-500/0 group-hover:from-cyan-500/5 dark:group-hover:from-cyan-500/10 transition-colors duration-500 z-0"></div>
                            
                            <div class="w-12 h-12 bg-blue-50 dark:bg-slate-800 flex items-center justify-center rounded-xl mb-5 text-blue-600 dark:text-cyan-400 border border-blue-100 dark:border-slate-700 group-hover:scale-110 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 group-hover:text-white transition-all duration-500 relative z-10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <h3 class="font-display font-bold text-slate-900 dark:text-white text-base mb-2 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors relative z-10">Lokasi Server & Kantor</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed font-medium relative z-10">
                                Dinas Komunikasi dan Informatika Prov. Jatim<br>
                                Jl. Ahmad Yani 242-244 Surabaya
                            </p>
                        </div>

                        <!-- 02. Telepon -->
                        <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-6 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-1 hover:border-blue-500/50 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden" style="animation-delay: 0.2s;">
                            <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/0 to-cyan-500/0 group-hover:from-cyan-500/5 dark:group-hover:from-cyan-500/10 transition-colors duration-500 z-0"></div>

                            <div class="w-12 h-12 bg-blue-50 dark:bg-slate-800 flex items-center justify-center rounded-xl mb-5 text-blue-600 dark:text-cyan-400 border border-blue-100 dark:border-slate-700 group-hover:scale-110 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 group-hover:text-white transition-all duration-500 relative z-10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <h3 class="font-display font-bold text-slate-900 dark:text-white text-base mb-2 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors relative z-10">Call Center</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed relative z-10">
                                <a href="tel:0318294608" class="hover:underline font-mono text-base font-bold text-slate-800 dark:text-gray-200">(031) 8294608</a>
                            </p>
                        </div>

                        <!-- 03. Email -->
                        <div class="reveal-on-scroll sm:col-span-2 group bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-6 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-1 hover:border-blue-500/50 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden" style="animation-delay: 0.3s;">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/0 to-cyan-500/0 group-hover:from-cyan-500/5 dark:group-hover:from-cyan-500/10 transition-colors duration-500 z-0"></div>

                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 relative z-10">
                                <div class="flex items-start gap-5">
                                    <div class="w-14 h-14 bg-blue-50 dark:bg-slate-800 flex items-center justify-center rounded-2xl shrink-0 text-blue-600 dark:text-cyan-400 border border-blue-100 dark:border-slate-700 group-hover:scale-110 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 group-hover:text-white transition-all duration-500">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <h3 class="font-display font-bold text-slate-900 dark:text-white text-lg mb-1 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">Surat Elektronik (Email)</h3>
                                        <a href="mailto:csirt@jatimprov.go.id" class="text-blue-600 dark:text-cyan-400 font-mono font-bold hover:underline text-sm sm:text-base tracking-wide">csirt@jatimprov.go.id</a>
                                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-2 flex items-center gap-1.5 font-bold uppercase tracking-wider">
                                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2V7a5 5 0 00-5-5zm3 7H7V7a3 3 0 016 0v2z" clip-rule="evenodd"></path></svg>
                                            Disarankan menggunakan enkripsi PGP
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 04. Jam Operasional -->
                        <div class="reveal-on-scroll sm:col-span-2 group bg-gradient-to-br from-blue-50 to-white dark:from-slate-800/80 dark:to-slate-900/80 backdrop-blur-xl border border-blue-100 dark:border-slate-700 p-6 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-1 transition-all duration-500 relative overflow-hidden" style="animation-delay: 0.4s;">
                            <!-- Accent Glow -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl group-hover:bg-cyan-500/20 transition-colors"></div>
                            
                            <div class="flex items-center gap-5 relative z-10">
                                <div class="w-14 h-14 bg-white dark:bg-slate-900 flex items-center justify-center rounded-2xl shrink-0 text-blue-600 dark:text-cyan-400 border border-blue-100 dark:border-slate-700 group-hover:rotate-12 transition-all duration-500 shadow-sm">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-display font-bold text-slate-900 dark:text-white text-lg mb-2">Jam Operasional</h3>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-white dark:bg-slate-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-slate-600 shadow-sm">Senin – Jumat</span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-blue-100 dark:bg-cyan-900/30 text-blue-800 dark:text-cyan-300 border border-blue-200 dark:border-cyan-800/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 dark:bg-cyan-400 mr-2 animate-pulse"></span>
                                            07.30 – 16.30 WIB
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- 05. PGP Vault -->
                    <div class="reveal-on-scroll mt-4" style="animation-delay: 0.5s;">
                        <div class="bg-[#020817] border border-slate-800 p-1 rounded-3xl shadow-xl relative overflow-hidden group">
                            
                            <!-- Terminal Top Bar -->
                            <div class="bg-[#020617] px-5 py-3 rounded-t-[1.3rem] border-b border-slate-800/80 flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                                <div class="w-3 h-3 rounded-full bg-emerald-500/80"></div>
                                <span class="ml-3 text-[10px] text-gray-500 font-mono tracking-widest uppercase">SECURE_VAULT_PGP</span>
                            </div>
                            
                            <!-- Terminal Content -->
                            <div class="p-6 md:p-8 bg-[#020817] rounded-b-[1.3rem] relative z-10">
                                <div class="flex items-start gap-5 mb-8">
                                    <div class="p-3.5 bg-blue-500/10 rounded-xl border border-blue-500/20 text-blue-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                    <div>
                                        <h3 class="font-display font-bold text-white text-xl">Kunci Publik PGP</h3>
                                        <p class="text-sm text-gray-400 mt-2 leading-relaxed font-medium">
                                            Gunakan Public PGP Key kami untuk mengenkripsi email pelaporan insiden guna menjamin kerahasiaan dan integritas data Anda.
                                        </p>
                                    </div>
                                </div>
                                
                                <a href="{{ asset('dokumen/PANDUAN-PENGGUNAAN-OPENPGP.pdf') }}" target="_blank" download class="group/btn relative inline-flex items-center justify-center w-full overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 px-6 py-4 font-bold text-white text-xs tracking-widest uppercase transition-all shadow-[0_0_20px_rgba(6,182,212,0.3)] hover:shadow-[0_0_30px_rgba(6,182,212,0.5)]">
                                    <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover/btn:-translate-x-5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </span>
                                    <span class="transition-all duration-300 ease-out group-hover/btn:-translate-x-4 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                                        UNDUH PGP KEY (.ASC)
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KANAN: PETA GOOGLE MAPS -->
                <div class="h-full min-h-[550px] reveal-on-scroll" style="animation-delay: 0.3s;">
                    <!-- Cyber Frame Maps -->
                    <div class="w-full h-full p-1.5 rounded-[2rem] bg-gradient-to-b from-gray-200 to-gray-300 dark:from-slate-700 dark:to-slate-800 shadow-2xl relative group">
                        <!-- Glow effect -->
                        <div class="absolute inset-0 bg-cyan-500 blur-2xl opacity-0 group-hover:opacity-20 transition-opacity duration-700 rounded-[2rem]"></div>
                        
                        <div class="w-full h-full rounded-[1.6rem] overflow-hidden bg-gray-100 dark:bg-[#020817] relative z-10 border border-white dark:border-slate-800">
                            <!-- Overlay kursor interaktif untuk efek siber -->
                            <div class="absolute inset-0 bg-cyan-500/10 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-700 mix-blend-overlay z-20"></div>
                            
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.1555767345276!2d112.72918!3d-7.336418999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb44a7ee2a07%3A0xa372a10f76837d5b!2sDinas%20Komunikasi%20dan%20Informatika%20Provinsi%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1785204694076!5m2!1sid!2sid" 
                                width="100%" 
                                height="100%" 
                                style="border:0; position: absolute; top: 0; left: 0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                class="filter dark:contrast-[1.1] dark:opacity-80 dark:grayscale-[0.3] dark:group-hover:opacity-100 dark:group-hover:grayscale-0 transition-all duration-700 ease-in-out">
                            </iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-footer />

    <!-- WIDGET CHATBOT CSIRT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

    <!-- ========================================== -->
    <!-- SCRIPT OBSERVER UNTUK ANIMASI SCROLL -->
    <!-- ========================================== -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        entry.target.classList.remove('reveal-on-scroll');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>
</html>