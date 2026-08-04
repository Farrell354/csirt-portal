<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil {{ $hunter->name }} - JatimProv CSIRT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        komdigi_purple: '#7b3aed',
                        dark_card: '#1e293b',
                    }
                }
            }
        }
    </script>
    <!-- CUSTOM ANIMATION CSS -->
    <style>
        /* Animasi Muncul dari Bawah */
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Pengatur Delay agar munculnya bergantian */
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }

        /* Smooth Scrolling untuk seluruh halaman */
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 font-sans flex flex-col min-h-screen transition-colors duration-500 overflow-x-hidden">
    
    <x-navbar />

    <div class="flex-grow max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10">
        
        <!-- Tombol Kembali -->
        <a href="/leaderboard" class="inline-flex items-center text-sm font-bold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 mb-6 transition-transform hover:-translate-x-2 duration-300">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Leaderboard
        </a>

        <!-- ================= BAGIAN HEADER & PROFIL (Animasi 1) ================= -->
        <div class="mb-8 relative z-20 animate-fade-in-up delay-100">
            <!-- Banner Ungu dengan animasi gradien -->
            <div class="h-32 md:h-40 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-t-3xl relative overflow-hidden group">
                <!-- Aksen cahaya yang lewat saat dihover -->
                <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000 ease-in-out skew-x-12"></div>
            </div>

            <!-- Area Info Profil -->
            <div class="bg-white dark:bg-slate-800 rounded-b-3xl shadow-sm border-x border-b border-gray-200 dark:border-slate-700 px-6 pb-8 pt-16 md:pt-6 relative flex flex-col md:flex-row justify-between items-start md:items-center gap-4 transition-colors duration-300">
                
                <!-- Avatar Dinamis (Membesar & Miring saat disentuh) -->
                <div class="absolute -top-12 md:-top-16 left-6 md:left-10 z-30 group cursor-pointer">
                    <div class="relative group-hover:rotate-3 group-hover:scale-105 transition-all duration-500 ease-out">
                        <div class="w-24 h-24 md:w-32 md:h-32 bg-white dark:bg-slate-800 rounded-3xl p-1 shadow-lg ring-1 ring-gray-100 dark:ring-slate-700 transition-colors duration-300 group-hover:shadow-blue-500/30 group-hover:ring-blue-500/50">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $hunter->name }}&backgroundColor=ffdfbf" alt="Avatar" class="w-full h-full rounded-[1.25rem] object-cover bg-orange-100">
                        </div>
                        @if($hunter->poin >= 1000)
                        <div class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-[10px] md:text-xs font-bold px-3 py-1 rounded-full border-2 border-white dark:border-slate-800 shadow-lg flex items-center gap-1 whitespace-nowrap animate-bounce">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> TOP HUNTER
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Info Nama & Username -->
                <div class="flex-grow pt-12 md:pt-0 md:pl-40 relative z-20">
                    <h1 class="text-3xl md:text-4xl font-black text-gray-900 dark:text-white tracking-tight">{{ $hunter->name }}</h1>
                    
                    <!-- Badges -->
                    <div class="flex flex-wrap items-center gap-2 mt-2">
                        <span class="inline-flex items-center gap-1 bg-amber-50 dark:bg-amber-900/30 border border-amber-200 dark:border-amber-700/50 text-amber-600 dark:text-amber-400 text-xs font-bold px-2.5 py-1 rounded-md hover:bg-amber-100 dark:hover:bg-amber-800/40 transition-colors cursor-default">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 1l2.5 5 5.5.75-4 3.75 1 5.5L10 13.5l-5 2.5 1-5.5-4-3.75 5.5-.75L10 1z" clip-rule="evenodd"></path></svg> 
                            Lvl {{ floor($hunter->poin / 1000) + 1 }} Expert
                        </span>
                        <span class="inline-flex items-center gap-1 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-100 dark:border-emerald-700/50 text-emerald-600 dark:text-emerald-400 text-xs font-bold px-2.5 py-1 rounded-md hover:bg-emerald-100 dark:hover:bg-emerald-800/40 transition-colors cursor-default">
                            <svg class="w-3.5 h-3.5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Verified
                        </span>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-4 md:mt-0 w-full md:w-auto shrink-0 flex gap-2 relative z-20">
                    <button class="w-full md:w-auto bg-gray-900 dark:bg-gray-100 hover:bg-gray-800 dark:hover:bg-white text-white dark:text-gray-900 text-sm font-bold py-2.5 px-5 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-1 active:translate-y-0 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6.632l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                        Bagikan Profil
                    </button>
                </div>
            </div>
        </div>

        <!-- ================= KOTAK STATISTIK (Animasi 2) ================= -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 relative z-20 animate-fade-in-up delay-200">
            
            <!-- Box Total Skor (Hover Mengambang & Glow) -->
            <div class="group bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-xl hover:shadow-blue-500/10 border border-gray-100 dark:border-slate-700 flex flex-col justify-between relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 cursor-default">
                <!-- Background Blob Breathing -->
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-blue-50 dark:bg-blue-900/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 ease-in-out animate-pulse"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        <div class="p-1.5 bg-blue-100 dark:bg-blue-900/40 rounded-lg text-blue-600 dark:text-blue-400 group-hover:rotate-12 transition-transform duration-300"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                        Total Skor
                    </div>
                    <div class="text-4xl font-black text-gray-900 dark:text-white mb-1">{{ number_format($hunter->poin) }} <span class="text-lg font-bold text-gray-400 dark:text-gray-500 lowercase">pts</span></div>
                </div>
            </div>

            <!-- Box Validitas -->
            <div class="group bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 border border-gray-100 dark:border-slate-700 flex flex-col justify-between relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 cursor-default">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-emerald-50 dark:bg-emerald-900/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 ease-in-out animate-pulse"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                        <div class="p-1.5 bg-emerald-100 dark:bg-emerald-900/40 rounded-lg text-emerald-600 dark:text-emerald-400 group-hover:-rotate-12 transition-transform duration-300"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        Tingkat Validitas
                    </div>
                    <div class="text-4xl font-black text-gray-900 dark:text-white mb-2">{{ $validitas ?? 100 }}%</div>
                </div>
                <!-- Progress Bar dengan efek loading pelan -->
                <div class="w-full bg-gray-100 dark:bg-slate-700 rounded-full h-1.5 mt-4 relative z-10 overflow-hidden">
                    <div class="bg-emerald-500 h-1.5 rounded-full transition-all duration-1000 ease-out" style="width: 0%;" onload="this.style.width='{{ $validitas ?? 100 }}%'"></div>
                    <!-- Inline script trick biar bar-nya jalan saat render -->
                    <script>setTimeout(() => { document.currentScript.previousElementSibling.style.width = '{{ $validitas ?? 100 }}%'; }, 300);</script>
                </div>
            </div>

            <!-- Box Laporan Valid -->
            <div class="group bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-xl hover:shadow-orange-500/10 border border-gray-100 dark:border-slate-700 flex flex-col justify-between relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 cursor-default">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-50 dark:bg-orange-900/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 ease-in-out animate-pulse"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 group-hover:text-orange-500 dark:group-hover:text-orange-400 transition-colors">
                        <div class="p-1.5 bg-orange-100 dark:bg-orange-900/40 rounded-lg text-orange-500 dark:text-orange-400 group-hover:scale-110 transition-transform duration-300"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A12.014 12.014 0 0010 1a11.999 11.999 0 00-9.96 5.378.01.01 0 00-.007.01C.017 6.47 0 6.55 0 6.64v8.72c0 .088.017.17.033.253a.01.01 0 00.007.01 11.999 11.999 0 009.96 5.378A12.014 12.014 0 0010 21a11.999 11.999 0 009.96-5.378.01.01 0 00.007-.01c.016-.083.033-.165.033-.253v-8.72c0-.09-.017-.17-.033-.253a.01.01 0 00-.007-.01A11.999 11.999 0 0011.3 1.046z" clip-rule="evenodd"></path></svg></div>
                        Laporan Tervalidasi
                    </div>
                    <div class="text-4xl font-black text-gray-900 dark:text-white mb-1">{{ $laporanValid ?? 0 }} <span class="text-base font-bold text-gray-500 dark:text-gray-400 lowercase">Bugs</span></div>
                </div>
            </div>
        </div>

        <!-- ================= AREA BAWAH (ACHIEVEMENTS & INFO) (Animasi 3) ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 relative z-30 animate-fade-in-up delay-300">
            
            <!-- Hall of Achievements -->
            <div class="lg:col-span-2 bg-slate-900 rounded-3xl p-6 md:p-8 shadow-md border border-slate-800 relative z-30 overflow-hidden">
                <!-- Efek sinar muter -->
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-amber-500/10 rounded-full blur-3xl"></div>
                
                <div class="flex justify-between items-center mb-6 border-b border-slate-800 pb-4 relative z-10">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-amber-500/20 rounded-lg text-amber-500"><svg class="w-5 h-5 animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"></path></svg></div>
                        <h2 class="text-xl font-bold text-white">Hall of Achievements</h2>
                    </div>
                    <span class="text-xs font-bold bg-slate-800 text-slate-300 px-3 py-1 rounded-full border border-slate-700">3 Unlocked</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 relative z-10">
                    <!-- Achievement 1 -->
                    <div class="group bg-slate-800/50 rounded-2xl p-5 border border-slate-700/50 hover:bg-slate-800 hover:border-slate-600 transition-all duration-300 hover:-translate-y-1 cursor-pointer">
                        <div class="flex flex-col items-center text-center mb-2">
                            <div class="w-12 h-12 bg-slate-700 rounded-full flex items-center justify-center mb-3 ring-4 ring-slate-800 group-hover:ring-slate-600 transition-all duration-300 group-hover:rotate-12">
                                <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                            <h4 class="text-sm font-bold text-gray-200">Expert Hunter</h4>
                            <p class="text-[10px] text-gray-500 group-hover:text-gray-400 font-bold tracking-widest mt-1 transition-colors">TIER SILVER</p>
                        </div>
                    </div>
                    <!-- Achievement 2 -->
                    <div class="group bg-slate-800/50 rounded-2xl p-5 border border-slate-700/50 hover:bg-slate-800 hover:border-slate-600 transition-all duration-300 hover:-translate-y-1 cursor-pointer">
                        <div class="flex flex-col items-center text-center mb-2">
                            <div class="w-12 h-12 bg-slate-700 rounded-full flex items-center justify-center mb-3 ring-4 ring-slate-800 group-hover:ring-slate-600 transition-all duration-300 group-hover:-rotate-12">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            <h4 class="text-sm font-bold text-gray-200">Sharp Eye</h4>
                            <p class="text-[10px] text-orange-500/70 group-hover:text-orange-400 font-bold tracking-widest mt-1 transition-colors">TIER BRONZE</p>
                        </div>
                    </div>
                    <!-- Achievement 3 -->
                    <div class="group bg-slate-800/50 rounded-2xl p-5 border border-slate-700/50 hover:bg-slate-800 hover:border-slate-600 transition-all duration-300 hover:-translate-y-1 cursor-pointer">
                        <div class="flex flex-col items-center text-center mb-2">
                            <div class="w-12 h-12 bg-slate-700 rounded-full flex items-center justify-center mb-3 ring-4 ring-slate-800 group-hover:ring-slate-600 transition-all duration-300 group-hover:scale-110">
                                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h4 class="text-sm font-bold text-gray-200">System Breaker</h4>
                            <p class="text-[10px] text-emerald-500/70 group-hover:text-emerald-400 font-bold tracking-widest mt-1 transition-colors">TIER PLATINUM</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan (Bio & Kontak) -->
            <div class="space-y-6 relative z-40">
                <!-- Box Tentang Hunter -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-md border border-gray-100 dark:border-slate-700 transition-all duration-300 hover:border-blue-200 dark:hover:border-slate-600 group">
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500 group-hover:animate-ping"></span> Tentang Hunter
                    </h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">Peneliti keamanan siber independen. Berdedikasi untuk menemukan dan melaporkan celah keamanan guna menciptakan ekosistem digital yang lebih aman.</p>
                </div>

                <!-- Box Media Sosial (LinkedIn Dihapus) -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-700 transition-colors duration-300">
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Kontak</h3>
                    
                    <div class="space-y-3">
                        <!-- Kotak Email -->
                        <a href="mailto:{{ $hunter->email }}" class="flex items-center gap-4 p-3 bg-gray-50 dark:bg-slate-700/50 hover:bg-gray-100 dark:hover:bg-slate-700 rounded-2xl border border-gray-100 dark:border-slate-600 transition-all duration-300 group hover:-translate-y-1">
                            <div class="bg-blue-600 text-white p-2 rounded-xl shrink-0 group-hover:rotate-12 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </div>
                            <div class="overflow-hidden w-full">
                                <div class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Hubungi via Email</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 truncate w-full flex justify-between items-center mt-0.5">
                                    <span>{{ $hunter->email }}</span>
                                    <svg class="w-3.5 h-3.5 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity translate-x-2 group-hover:translate-x-0 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= RIWAYAT LAPORAN (LOG) (Animasi 4) ================= -->
        <div class="mt-8 bg-white dark:bg-slate-800 rounded-3xl p-6 md:p-8 shadow-sm hover:shadow-lg border border-gray-100 dark:border-slate-700 transition-all duration-500 relative z-10 animate-fade-in-up delay-400">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-slate-700">
                <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                    <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Riwayat Temuan (Log Laporan)</h2>
            </div>

            <div class="overflow-x-auto rounded-xl">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-400 dark:text-gray-500 uppercase bg-gray-50 dark:bg-slate-900/80">
                        <tr>
                            <th scope="col" class="px-4 py-4 font-bold tracking-wider rounded-tl-xl">Tanggal Lapor</th>
                            <th scope="col" class="px-4 py-4 font-bold tracking-wider">Kategori Kerentanan</th>
                            <th scope="col" class="px-4 py-4 font-bold tracking-wider">Status Validasi</th>
                            <th scope="col" class="px-4 py-4 font-bold tracking-wider text-right rounded-tr-xl">Poin Reward</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-slate-700/50 bg-white dark:bg-transparent">
                        @forelse($hunter->laporans()->orderBy('created_at', 'desc')->get() as $laporan)
                        <tr class="hover:bg-blue-50/50 dark:hover:bg-slate-700/40 transition-colors duration-200 group cursor-default">
                            <td class="px-4 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400 text-xs font-medium group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors">
                                {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4 font-bold text-gray-800 dark:text-gray-200 group-hover:translate-x-1 transition-transform duration-300">
                                {{ $laporan->jenis_kerentanan }}
                            </td>
                            <td class="px-4 py-4">
                                @if($laporan->status === 'Valid')
                                    <span class="inline-flex items-center gap-1 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-xs font-bold px-2.5 py-1 rounded-md border border-emerald-200 dark:border-emerald-800/50 shadow-sm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Valid
                                    </span>
                                @elseif($laporan->status === 'Menunggu' || $laporan->status === 'Diproses' || $laporan->status === 'Pending')
                                    <span class="inline-flex items-center gap-1 bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-xs font-bold px-2.5 py-1 rounded-md border border-amber-200 dark:border-amber-800/50 shadow-sm">
                                        <svg class="w-3 h-3 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Proses
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-xs font-bold px-2.5 py-1 rounded-md border border-red-200 dark:border-red-800/50 shadow-sm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-right font-black text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform origin-right">
                                +{{ $laporan->poin_diberikan ?? 0 }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center bg-gray-50/50 dark:bg-slate-800/50 rounded-b-xl">
                                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center animate-pulse">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <div class="text-gray-500 dark:text-gray-400 font-bold mb-1">Belum ada riwayat laporan yang tercatat.</div>
                                <div class="text-xs text-gray-400 dark:text-gray-500">Aktivitas Hunter ini masih kosong.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>