<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - JatimProv-CSIRT</title>
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
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 animate-grid-flow z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-blue-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- KONTEN UTAMA -->
    <div class="flex-grow relative z-10 transition-colors duration-300">
        
        <!-- HEADER HALAMAN -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-gray-200 dark:border-slate-800 py-20 transition-colors duration-300 relative overflow-hidden">
            <!-- Dekorasi Lingkaran Glow -->
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-3xl reveal-on-scroll" style="animation-delay: 0.1s;">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 text-blue-600 dark:text-blue-400 font-mono text-[11px] font-bold tracking-widest mb-6 uppercase rounded-full shadow-sm animate-float-subtle">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                        </span>
                        [ PROFILE // 01 ]
                    </div>
                    <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 dark:text-white tracking-tight mb-4 drop-shadow-sm">JatimProv-CSIRT</h1>
                    <p class="text-lg md:text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-cyan-300 uppercase tracking-widest">Computer Security Incident Response Team</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            
            <!-- Deskripsi Institusi -->
            <div class="mb-24 reveal-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl p-8 md:p-10 rounded-3xl shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.3)] border border-gray-100 dark:border-slate-800 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-blue-600 to-cyan-400"></div>
                    <p class="text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed max-w-4xl mb-5">
                        <strong class="text-slate-900 dark:text-white">Jawa Timur Province Computer Security Incident Response Team (JatimProv-CSIRT).</strong>
                    </p>
                    <p class="text-base text-gray-600 dark:text-gray-400 leading-relaxed max-w-4xl mb-5">
                        Bertanggung Jawab sebagai ketua JatimProv CSIRT adalah Kepala Dinas Komunikasi dan Informatika Provinsi Jawa Timur.
                    </p>
                    <p class="text-base text-gray-600 dark:text-gray-400 leading-relaxed max-w-4xl">
                        Anggota Tim dari JatimProv CSIRT adalah seluruh staf teknis seksi persandian dan keamanan informasi.
                    </p>
                </div>
            </div>

            <!-- Visi/Misi -->
            <div class="mb-24">
                <div class="flex items-center gap-4 mb-10 reveal-on-scroll">
                    <h2 class="font-display text-2xl md:text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Misi Pembentukan</h2>
                    <div class="h-[2px] flex-grow bg-gradient-to-r from-blue-500/50 to-transparent"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Misi 1 -->
                    <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-8 hover:border-blue-500 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden rounded-3xl hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-2">
                        <div class="font-display text-8xl font-black text-gray-50 dark:text-slate-800/50 absolute -top-4 -right-4 pointer-events-none transition-transform duration-500 group-hover:scale-110 group-hover:text-blue-50 dark:group-hover:text-cyan-900/20">01</div>
                        <div class="relative z-10">
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center mb-6 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 transition-colors duration-500">
                                <svg class="w-5 h-5 text-blue-600 dark:text-cyan-400 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed font-medium group-hover:text-gray-900 dark:group-hover:text-gray-200 transition-colors">
                                Membangun, mengkoordinasikan, mengolaborasikan dan mengoperasionalkan sistem mitigasi, manajemen krisis, penanggulangan dan pemulihan terhadap insiden keamanan siber pada lingkungan Pemerintah Provinsi Jawa Timur.
                            </p>
                        </div>
                    </div>

                    <!-- Misi 2 -->
                    <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-8 hover:border-blue-500 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden rounded-3xl hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-2" style="animation-delay: 0.2s;">
                        <div class="font-display text-8xl font-black text-gray-50 dark:text-slate-800/50 absolute -top-4 -right-4 pointer-events-none transition-transform duration-500 group-hover:scale-110 group-hover:text-blue-50 dark:group-hover:text-cyan-900/20">02</div>
                        <div class="relative z-10">
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center mb-6 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 transition-colors duration-500">
                                <svg class="w-5 h-5 text-blue-600 dark:text-cyan-400 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed font-medium group-hover:text-gray-900 dark:group-hover:text-gray-200 transition-colors">
                                Membangun kerja sama dalam rangka penanggulangan dan pemulihan insiden kemanan siber di lingkungan Pemerintah Provinsi Jawa Timur.
                            </p>
                        </div>
                    </div>

                    <!-- Misi 3 -->
                    <div class="reveal-on-scroll group bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-8 hover:border-blue-500 dark:hover:border-cyan-500/50 transition-all duration-500 relative overflow-hidden rounded-3xl hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-2" style="animation-delay: 0.4s;">
                        <div class="font-display text-8xl font-black text-gray-50 dark:text-slate-800/50 absolute -top-4 -right-4 pointer-events-none transition-transform duration-500 group-hover:scale-110 group-hover:text-blue-50 dark:group-hover:text-cyan-900/20">03</div>
                        <div class="relative z-10">
                            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center mb-6 group-hover:bg-blue-600 dark:group-hover:bg-cyan-500 transition-colors duration-500">
                                <svg class="w-5 h-5 text-blue-600 dark:text-cyan-400 group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed font-medium group-hover:text-gray-900 dark:group-hover:text-gray-200 transition-colors">
                                Membangun kapasitas sumber daya penganggulangan dan pemulihan insiden keamanan siber di lingkungan Pemerintah Provinsi Jawa Timur.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konstituen -->
            <div class="reveal-on-scroll mb-24">
                <div class="bg-gradient-to-br from-slate-900 to-slate-800 dark:from-slate-800 dark:to-slate-900 p-1 relative overflow-hidden rounded-3xl shadow-xl">
                    <div class="absolute inset-0 bg-mesh-grid opacity-20"></div>
                    <div class="bg-slate-900 dark:bg-slate-950 p-8 sm:p-10 rounded-[1.4rem] relative z-10 border-l-4 border-cyan-500">
                        <h4 class="text-cyan-400 text-xs font-bold mb-3 uppercase tracking-widest flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            Ruang Lingkup Konstituen
                        </h4>
                        <p class="text-gray-300 dark:text-gray-400 text-sm md:text-base leading-relaxed max-w-4xl font-medium">
                            Konstituen JatimProv-CSIRT meliputi <strong class="text-white">Satuan Kerja Perangkat Daerah (SKPD)</strong> di lingkungan Provinsi Jawa Timur dan Kabupaten/kota yang menggunakan layanan Data Center Provinsi Jawa Timur.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Kinerja & Prestasi (ANIMATED SECTION) -->
            <div class="reveal-on-scroll">
                <div class="flex items-center gap-4 mb-10">
                    <h2 class="font-display text-2xl md:text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Indeks Kinerja & Kepatuhan</h2>
                    <div class="h-[2px] flex-grow bg-gradient-to-r from-cyan-500/50 to-transparent"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="stats-container">
                    
                    <!-- Indeks KAMI -->
                    <div class="group bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-6 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-full blur-2xl group-hover:bg-cyan-500/10 transition-colors duration-500"></div>
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 block mb-1">Skor Tertinggi</span>
                                <div class="font-display text-5xl font-black text-slate-900 dark:text-white tracking-tighter flex items-baseline gap-1">
                                    <span class="counter" data-target="851">0</span>
                                </div>
                            </div>
                            <div class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-cyan-400 border border-blue-200 dark:border-cyan-800/50 text-[10px] font-bold px-2.5 py-1 rounded-full shadow-sm">2026</div>
                        </div>
                        <h3 class="text-base font-bold text-blue-600 dark:text-cyan-400 mb-2 relative z-10">INDEKS KAMI 5.0 (PTKKSS)</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed relative z-10 font-medium">
                            Hasil evaluasi "Baik" dan Tingkat Kematangan Keamanan Informasi Level IV (Terkelola), terverifikasi langsung oleh BSSN pada 2026.
                        </p>
                    </div>

                    <!-- IKASANDI -->
                    <div class="group bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-6 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-cyan-500/10 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden" style="animation-delay: 0.2s;">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-500/5 rounded-full blur-2xl group-hover:bg-cyan-500/10 transition-colors duration-500"></div>
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 block mb-1">Indeks Capaian</span>
                                <div class="font-display text-5xl font-black text-slate-900 dark:text-white tracking-tighter flex items-baseline gap-1">
                                    <span class="counter" data-target="4.14" data-decimal="true">0,00</span>
                                </div>
                            </div>
                            <div class="bg-cyan-50 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 text-[10px] font-bold px-2.5 py-1 rounded-full shadow-sm">2026</div>
                        </div>
                        <h3 class="text-base font-bold text-cyan-600 dark:text-cyan-400 mb-2 relative z-10">IKASANDI (PTKKSS)</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed relative z-10 font-medium">
                            Tingkat Kematangan Keamanan Siber & Persandian mencapai Level 4 (Terkelola), melampaui target nilai 2,51, terverifikasi oleh BSSN.
                        </p>
                    </div>

                    <!-- ISO 27001 -->
                    <div class="group bg-gradient-to-br from-slate-900 to-slate-800 border border-blue-600/30 dark:border-cyan-500/30 p-6 rounded-3xl shadow-lg relative overflow-hidden border-t-4 border-t-blue-600 dark:border-t-cyan-500 hover:shadow-[0_0_20px_rgba(6,182,212,0.2)] hover:-translate-y-1 transition-all duration-300" style="animation-delay: 0.4s;">
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity duration-500 transform group-hover:scale-110 group-hover:rotate-12">
                            <svg class="w-20 h-20 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        </div>
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-cyan-400 block mb-1">Re-certified for 2026</span>
                                <div class="font-display text-3xl font-black text-white mt-1 tracking-tight">ISO 27001<span class="text-blue-500 dark:text-cyan-500">:2022</span></div>
                            </div>
                            <div class="bg-cyan-500/20 border border-cyan-500/50 text-cyan-300 text-[10px] font-bold px-2 py-1 rounded animate-pulse">CERTIFIED</div>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed relative z-10 mt-6 font-medium">
                            Sertifikasi ISO/IEC 27001:2022 dipertahankan pada 2026, menegaskan komitmen CSIRT Jatimprov dalam menerapkan standar keamanan informasi kelas dunia.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <x-footer />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

    <!-- ========================================== -->
    <!-- SCRIPT ANIMASI SCROLL & NUMBER COUNTER -->
    <!-- ========================================== -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // 1. Logika Fade-In-Up saat di-scroll
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15
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

            // 2. Logika Animated Number Counter (Angka Berjalan)
            const statsContainer = document.getElementById('stats-container');
            let hasAnimated = false;

            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !hasAnimated) {
                        hasAnimated = true;
                        
                        const counters = document.querySelectorAll('.counter');
                        const speed = 200; // Semakin kecil semakin cepat

                        counters.forEach(counter => {
                            const updateCount = () => {
                                const target = parseFloat(counter.getAttribute('data-target'));
                                const isDecimal = counter.getAttribute('data-decimal') === 'true';
                                
                                // Parse isi HTML saat ini, bersihkan koma jika ada (format indo)
                                let currentStr = counter.innerText.replace(',', '.');
                                const count = parseFloat(currentStr) || 0;
                                
                                const inc = target / speed;

                                if (count < target) {
                                    let newVal = count + inc;
                                    
                                    if(isDecimal) {
                                        counter.innerText = newVal.toFixed(2).replace('.', ',');
                                    } else {
                                        counter.innerText = Math.ceil(newVal);
                                    }
                                    setTimeout(updateCount, 10);
                                } else {
                                    if(isDecimal) {
                                        counter.innerText = target.toFixed(2).replace('.', ',');
                                    } else {
                                        counter.innerText = target;
                                    }
                                }
                            };
                            updateCount();
                        });
                    }
                });
            }, { threshold: 0.5 });

            if(statsContainer) {
                counterObserver.observe(statsContainer);
            }
        });
    </script>
</body>
</html>