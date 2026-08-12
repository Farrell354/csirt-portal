<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil {{ $hunter->name }} - JatimProv CSIRT</title>
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
    
    <!-- Latar Belakang Mesh Grid & Ambient Glow (Mewarisi style dari app.css) -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- KONTEN UTAMA -->
    <div class="flex-grow max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10 pt-8">
        
        <!-- Tombol Kembali -->
        <div class="opacity-0 animate-fade-in-up">
            <a href="/leaderboard" class="inline-flex items-center text-xs font-bold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 mb-8 transition-transform hover:-translate-x-1 duration-300 uppercase tracking-widest bg-white/50 dark:bg-slate-900/50 px-4 py-2 rounded-xl border border-gray-200 dark:border-slate-800 backdrop-blur-md shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Peringkat Global
            </a>
        </div>

        <!-- ================= BAGIAN HEADER & PROFIL (DOSSIER) ================= -->
        <div class="mb-10 relative z-20 opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            
            <!-- Banner Atas -->
            <div class="h-32 md:h-48 bg-gradient-to-r from-blue-700 via-blue-600 to-cyan-500 rounded-t-[2rem] relative overflow-hidden group shadow-lg">
                <!-- Glare Effect Hover -->
                <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000 ease-in-out skew-x-12"></div>
                <!-- ID Dossier -->
                <div class="absolute top-5 right-6 text-white/40 text-[10px] font-mono tracking-widest font-bold">
                    DOSSIER_ID: {{ sprintf('%04d', $hunter->id) }}
                </div>
            </div>

            <!-- Kartu Info Utama -->
            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-b-[2rem] shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] border-x border-b border-gray-200/50 dark:border-slate-800/80 px-6 pb-8 pt-16 md:pt-6 relative flex flex-col md:flex-row justify-between items-start md:items-center gap-6 transition-colors duration-300">
                
                <!-- Avatar Dinamis (SINKRONISASI DICEBEAR) -->
                <div class="absolute -top-12 md:-top-16 left-6 md:left-10 z-30 group cursor-default">
                    <div class="relative group-hover:-rotate-3 group-hover:scale-105 transition-all duration-500 ease-out">
                        <div class="w-24 h-24 md:w-32 md:h-32 bg-white dark:bg-slate-800 rounded-3xl p-1.5 shadow-2xl border border-gray-100 dark:border-slate-700 transition-colors duration-300 group-hover:shadow-[0_0_30px_rgba(6,182,212,0.4)] group-hover:border-cyan-200 dark:group-hover:border-cyan-700 overflow-hidden bg-gray-50 dark:bg-slate-900">
                            
                            <!-- Cek upload foto vs default DiceBear -->
                            @if($hunter->profile_photo_path)
                                <img src="{{ asset('storage/' . $hunter->profile_photo_path) }}" alt="Foto Profil" class="w-full h-full rounded-[1.2rem] object-cover">
                            @else
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode($hunter->name) }}&backgroundColor=dbeafe" alt="Avatar" class="w-full h-full rounded-[1.2rem] object-cover">
                            @endif

                        </div>
                        
                        <!-- Badge Elite jika poin > 1000 -->
                        @if($hunter->poin >= 1000)
                        <div class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-amber-400 to-orange-500 text-white text-[10px] md:text-xs font-black px-4 py-1 rounded-full border-2 border-white dark:border-slate-900 shadow-lg flex items-center gap-1.5 whitespace-nowrap group-hover:-translate-y-1 transition-transform duration-300">
                            <span class="text-sm drop-shadow">👑</span> ELITE
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Info Teks -->
                <div class="flex-grow pt-12 md:pt-0 md:pl-44 relative z-20">
                    <h1 class="font-display text-3xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight mb-2 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">
                        {{ $hunter->name }}
                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-2 mt-2">
                        <span class="inline-flex items-center gap-1.5 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800/50 text-blue-700 dark:text-cyan-400 text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-md shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 1l2.5 5 5.5.75-4 3.75 1 5.5L10 13.5l-5 2.5 1-5.5-4-3.75 5.5-.75L10 1z" clip-rule="evenodd"></path></svg> 
                            Level {{ floor($hunter->poin / 1000) + 1 }} Agent
                        </span>
                        <span class="inline-flex items-center gap-2 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800/50 text-emerald-700 dark:text-emerald-400 text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-md shadow-sm">
                            <span class="flex h-2 w-2 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            ID Terverifikasi
                        </span>
                    </div>
                </div>

                <!-- Status Banner -->
                <div class="mt-6 md:mt-0 w-full md:w-auto shrink-0 flex relative z-20">
                    <div class="w-full md:w-auto bg-gray-50 dark:bg-[#020817] border border-gray-200 dark:border-slate-800 px-6 py-3.5 rounded-2xl flex items-center justify-between gap-6 shadow-inner">
                        <div>
                            <div class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1">Status Profil</div>
                            <div class="text-sm font-black text-emerald-600 dark:text-emerald-400 font-mono tracking-wide">ACTIVE_DUTY</div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/20 flex items-center justify-center text-emerald-500 border border-emerald-200 dark:border-emerald-800/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= KOTAK STATISTIK ================= -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 relative z-20">
            <!-- Poin -->
            <div class="opacity-0 animate-fade-in-up group bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] p-6 shadow-lg hover:shadow-2xl hover:shadow-cyan-500/10 border border-gray-200/50 dark:border-slate-800/80 flex flex-col justify-between relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:border-cyan-300 dark:hover:border-cyan-700/50" style="animation-delay: 0.2s;">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl group-hover:bg-cyan-500/20 transition-colors duration-700"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-4 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">
                        <div class="p-1.5 bg-blue-100 dark:bg-cyan-900/30 rounded-lg text-blue-600 dark:text-cyan-400 group-hover:scale-110 transition-transform duration-300 border border-blue-200 dark:border-cyan-800/50"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                        Total Skor Reputasi
                    </div>
                    <div class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-1 tracking-tighter">{{ number_format($hunter->poin) }}</div>
                </div>
            </div>

            <!-- Laporan Valid -->
            <div class="opacity-0 animate-fade-in-up group bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] p-6 shadow-lg hover:shadow-2xl hover:shadow-emerald-500/10 border border-gray-200/50 dark:border-slate-800/80 flex flex-col justify-between relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:border-emerald-300 dark:hover:border-emerald-700/50" style="animation-delay: 0.3s;">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-colors duration-700"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-4 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                        <div class="p-1.5 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform duration-300 border border-emerald-200 dark:border-emerald-800/50"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        Bug Terverifikasi
                    </div>
                    <div class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-1 tracking-tighter">{{ $laporanValid ?? 0 }} <span class="text-sm font-bold text-gray-400 uppercase tracking-widest font-sans">Valid</span></div>
                </div>
            </div>

            <!-- Akurasi -->
            <div class="opacity-0 animate-fade-in-up group bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] p-6 shadow-lg hover:shadow-2xl hover:shadow-amber-500/10 border border-gray-200/50 dark:border-slate-800/80 flex flex-col justify-between relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:border-amber-300 dark:hover:border-amber-700/50" style="animation-delay: 0.4s;">
                <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl group-hover:bg-amber-500/20 transition-colors duration-700"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-4 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                        <div class="p-1.5 bg-amber-100 dark:bg-amber-900/30 rounded-lg text-amber-600 dark:text-amber-400 group-hover:rotate-12 transition-transform duration-300 border border-amber-200 dark:border-amber-800/50"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg></div>
                        Akurasi Laporan
                    </div>
                    <div class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-2 tracking-tighter">{{ $validitas ?? 100 }}<span class="text-2xl text-gray-400 font-sans">%</span></div>
                </div>
                
                <!-- Progress Bar Animasi -->
                <div class="w-full bg-gray-100 dark:bg-slate-800 rounded-full h-1.5 mt-2 relative z-10 overflow-hidden border border-gray-200 dark:border-slate-700/50">
                    <div class="bg-gradient-to-r from-amber-500 to-orange-400 h-full rounded-full transition-all duration-1000 ease-out relative" style="width: 0%;" onload="this.style.width='{{ $validitas ?? 100 }}%'">
                        <div class="absolute top-0 right-0 bottom-0 w-4 bg-white/40 blur-[2px]"></div>
                    </div>
                    <script>setTimeout(() => { document.currentScript.previousElementSibling.style.width = '{{ $validitas ?? 100 }}%'; }, 500);</script>
                </div>
            </div>
        </div>

        <!-- ================= AREA BAWAH (BIO & KONTAK) ================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-30 opacity-0 animate-fade-in-up" style="animation-delay: 0.5s;">
            
            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] p-6 md:p-8 shadow-lg border border-gray-200/50 dark:border-slate-800/80 transition-all duration-300 group hover:shadow-2xl hover:border-blue-300 dark:hover:border-cyan-700/50 relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-blue-600 to-cyan-400 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                <h3 class="text-[11px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg> 
                    Profil Singkat
                </h3>
                <p class="text-sm md:text-base text-gray-700 dark:text-gray-300 leading-relaxed font-medium">
                    Peneliti keamanan siber independen (Bug Hunter). Terdaftar secara resmi di <strong class="text-slate-900 dark:text-white font-display">JatimProv-CSIRT</strong>. Berdedikasi untuk menemukan, memvalidasi, dan melaporkan kerentanan sistem guna menciptakan infrastruktur digital pemerintahan yang kebal terhadap serangan.
                </p>
            </div>

            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] p-6 md:p-8 shadow-lg border border-gray-200/50 dark:border-slate-800/80 transition-all duration-300 relative overflow-hidden">
                <h3 class="text-[11px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg> 
                    Jalur Komunikasi
                </h3>
                
                <a href="mailto:{{ $hunter->email }}" class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-[#020817] rounded-2xl border border-gray-200 dark:border-slate-800 transition-all duration-300 group hover:-translate-y-1 hover:shadow-xl hover:border-cyan-300 dark:hover:border-cyan-700/50 cursor-pointer">
                    <div class="bg-gradient-to-br from-blue-600 to-cyan-500 text-white p-3.5 rounded-xl shrink-0 group-hover:rotate-12 transition-transform duration-300 shadow-md">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </div>
                    <div class="overflow-hidden w-full">
                        <div class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-0.5">Secure Email Link</div>
                        <div class="text-sm md:text-base font-bold text-slate-900 dark:text-white truncate w-full flex justify-between items-center group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">
                            <span>{{ $hunter->email }}</span>
                            <svg class="w-4 h-4 text-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity translate-x-2 group-hover:translate-x-0 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- ================= RIWAYAT LAPORAN (LOG) ================= -->
        <div class="mt-10 bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl rounded-3xl p-6 md:p-8 shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] border border-gray-200/50 dark:border-slate-800/80 transition-all duration-500 relative z-10 opacity-0 animate-fade-in-up" style="animation-delay: 0.6s;">
            
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-100 dark:border-slate-800">
                <div class="flex items-center gap-4">
                    <div class="p-2.5 bg-cyan-50 dark:bg-cyan-900/30 rounded-xl border border-cyan-100 dark:border-cyan-800/50 text-cyan-600 dark:text-cyan-400 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h2 class="font-display text-xl md:text-2xl font-black text-slate-900 dark:text-white tracking-tight">Log Temuan Kerentanan</h2>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-0.5">Vulnerability Discovery History</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-gray-200 dark:border-slate-800">
                <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead class="text-[11px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest bg-gray-100 dark:bg-[#020817] border-b border-gray-200 dark:border-slate-800">
                        <tr>
                            <th scope="col" class="px-6 py-5 rounded-tl-2xl">Tanggal Submit</th>
                            <th scope="col" class="px-6 py-5">Kategori Ancaman</th>
                            <th scope="col" class="px-6 py-5">Status Verifikasi</th>
                            <th scope="col" class="px-6 py-5 text-right rounded-tr-2xl">Reward (Pts)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-slate-800/80 bg-white dark:bg-slate-900/40">
                        @forelse($hunter->laporans()->orderBy('created_at', 'desc')->get() as $laporan)
                        <tr class="hover:bg-blue-50/50 dark:hover:bg-cyan-900/10 transition-colors duration-200 group cursor-default">
                            
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400 text-xs font-mono group-hover:text-gray-800 dark:group-hover:text-gray-200 transition-colors">
                                {{ \Carbon\Carbon::parse($laporan->created_at)->format('d/m/Y - H:i') }}
                            </td>
                            
                            <td class="px-6 py-4 font-bold text-slate-800 dark:text-gray-200 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">
                                {{ $laporan->jenis_kerentanan }}
                            </td>
                            
                            <td class="px-6 py-4">
                                @if($laporan->status === 'Valid')
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase tracking-widest px-2.5 py-1 rounded border border-emerald-200 dark:border-emerald-800/50 shadow-sm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg> Valid
                                    </span>
                                @elseif($laporan->status === 'Menunggu' || $laporan->status === 'Diproses' || $laporan->status === 'Pending')
                                    <span class="inline-flex items-center gap-1.5 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-[10px] font-black uppercase tracking-widest px-2.5 py-1 rounded border border-amber-200 dark:border-amber-800/50 shadow-sm">
                                        <svg class="w-3 h-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Proses
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-[10px] font-black uppercase tracking-widest px-2.5 py-1 rounded border border-red-200 dark:border-red-800/50 shadow-sm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg> Ditolak
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-right font-display font-black text-slate-800 dark:text-white text-lg group-hover:text-blue-600 dark:group-hover:text-cyan-400 group-hover:scale-110 transition-all origin-right">
                                +{{ $laporan->poin_diberikan ?? 0 }}
                            </td>
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center bg-gray-50/50 dark:bg-[#020817]/50 rounded-b-2xl">
                                <div class="w-16 h-16 mx-auto mb-4 bg-gray-200 dark:bg-slate-800 rounded-2xl flex items-center justify-center border-4 border-white dark:border-slate-900 shadow-sm">
                                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="text-gray-800 dark:text-gray-300 font-bold mb-1 text-base">Log Kosong</div>
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-500">Hunter belum mencatatkan laporan kerentanan apapun ke dalam sistem.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <x-footer />
    
    <!-- CHATBOT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

</body>
</html>