<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall of Fame - JatimProv CSIRT</title>
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-amber-500 selection:text-white">

    <!-- Efek Jaring Animasi di Background (Mewarisi style dari app.css) -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 z-0"></div>
    
    <!-- Ambient Glow Background (Warna Emas/Amber khusus Hall of Fame) -->
    <div class="fixed top-1/4 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-amber-500/5 dark:bg-amber-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- KONTEN UTAMA -->
    <div class="flex-grow relative z-10 transition-colors duration-300 pt-16">
        
        <!-- Banner Hall of Fame (Cyber Terminal Style) -->
        <div class="bg-slate-950 border-y border-slate-800/80 text-white py-20 px-4 relative overflow-hidden">
            <div class="absolute inset-0 bg-mesh-grid opacity-20"></div>
            <!-- Spotlight effect -->
            <div class="absolute -top-40 right-10 w-96 h-96 bg-amber-600/10 rounded-full blur-[100px] pointer-events-none"></div>
            
            <div class="max-w-6xl mx-auto flex flex-col lg:flex-row items-center justify-between relative z-10 gap-12">
                <div class="w-full lg:w-3/5 opacity-0 animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-900/80 border border-slate-700 text-emerald-400 font-mono text-[11px] font-bold tracking-widest mb-6 uppercase rounded-full shadow-sm backdrop-blur-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        LIVE GLOBAL RANKING
                    </div>
                    
                    <h1 class="font-display text-4xl md:text-6xl font-black mb-6 text-white tracking-tight drop-shadow-lg">
                        Hall of 
                        <span class="bg-gradient-to-r from-amber-500 via-yellow-200 to-amber-500 bg-[length:200%_auto] text-transparent bg-clip-text animate-shine-text drop-shadow-[0_0_20px_rgba(251,191,36,0.4)]">
                            Fame & Elite
                        </span>
                    </h1>
                    <p class="text-gray-400 text-base md:text-lg max-w-xl leading-relaxed font-medium">
                        Panggung kehormatan bagi para peneliti keamanan siber yang berdedikasi. Peringkat ini dihitung secara kumulatif berdasarkan validitas dan dampak laporan sepanjang masa.
                    </p>
                    
                    <!-- Box Statistik Cepat -->
                    <div class="flex flex-wrap gap-4 mt-8">
                        <div class="bg-slate-900/80 backdrop-blur-sm border border-slate-800 rounded-2xl p-4 w-[45%] sm:w-48 flex items-center gap-4 shadow-lg hover:border-slate-600 transition-colors group">
                            <div class="bg-blue-500/10 p-2.5 rounded-xl border border-blue-500/20 text-blue-400 group-hover:bg-blue-500/20 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-[10px] font-black uppercase mb-0.5 tracking-wider">Partisipan</div>
                                <div class="font-display text-2xl font-black text-white leading-none">{{ $totalHunter }}</div>
                            </div>
                        </div>
                        <div class="bg-slate-900/80 backdrop-blur-sm border border-slate-800 rounded-2xl p-4 w-[45%] sm:w-48 flex items-center gap-4 shadow-lg hover:border-slate-600 transition-colors group">
                            <div class="bg-emerald-500/10 p-2.5 rounded-xl border border-emerald-500/20 text-emerald-400 group-hover:bg-emerald-500/20 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-[10px] font-black uppercase mb-0.5 tracking-wider">Laporan Valid</div>
                                <div class="font-display text-2xl font-black text-white leading-none">{{ $totalLaporanValid }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ilustrasi Mesin Engine (Kanan) -->
                <div class="w-full lg:w-2/5 flex justify-center lg:justify-end opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="bg-slate-900 border border-slate-700/80 p-1.5 rounded-3xl shadow-2xl relative w-full max-w-sm rotate-2 hover:rotate-0 transition-all duration-500 group">
                        <div class="bg-slate-950 rounded-[1.25rem] p-6 relative overflow-hidden h-full">
                            <!-- Terminal reflection -->
                            <div class="absolute top-0 right-0 w-full h-1/2 bg-gradient-to-b from-white/5 to-transparent pointer-events-none transform -skew-y-12 translate-y-[-50%]"></div>
                            
                            <div class="flex justify-between items-center mb-6 border-b border-slate-800 pb-4">
                                <div class="text-xs text-emerald-400 font-mono flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    >_ csirt_rank_engine
                                </div>
                                <div class="text-[10px] text-gray-600 font-mono">v1.2.0-stable</div>
                            </div>
                            
                            <div class="text-xs text-gray-400 font-mono space-y-2 mb-6">
                                <div class="animate-pulse">> Fetching historical_data...</div>
                                <div>> Aggregating points... <span class="text-emerald-400">[OK]</span></div>
                                <div>> Calculating reputation score...</div>
                            </div>
                            
                            <div class="bg-slate-900/80 rounded-xl p-4 border border-slate-800 group-hover:border-amber-500/30 transition-colors">
                                <div class="text-[10px] tracking-widest text-gray-500 font-bold mb-3 flex items-center gap-2">
                                    <span class="text-amber-500">🏆</span> CURRENT LEADER
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-amber-400 to-orange-500 flex items-center justify-center text-white font-bold text-sm shadow-[0_0_10px_rgba(245,158,11,0.5)]">
                                            {{ $top3->count() > 0 ? substr($top3[0]->name, 0, 1) : '?' }}
                                        </div>
                                        <div class="text-gray-200 font-bold text-sm truncate max-w-[120px]">{{ $top3->count() > 0 ? $top3[0]->name : 'Menunggu Pahlawan...' }}</div>
                                    </div>
                                    <div class="text-emerald-400 font-mono text-sm font-bold">{{ $top3->count() > 0 ? $top3[0]->poin : 0 }} Pts</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Podium & List Peringkat -->
        <div class="max-w-6xl mx-auto px-4 py-20">
            
            <!-- ================= PODIUM TOP 3 ================= -->
            @if($top3->count() > 0)
            <div class="flex flex-col md:flex-row items-end justify-center gap-6 mb-24 md:h-[380px] mt-10">
                
                <!-- JUARA 2 (Silver) -->
                @if(isset($top3[1]))
                <a href="/hunter/{{ $top3[1]->id }}" class="reveal-on-scroll w-full md:w-[28%] block transform transition-all duration-500 hover:-translate-y-4 cursor-pointer group" style="animation-delay: 0.2s;">
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-[2rem] shadow-xl dark:shadow-[0_0_30px_rgba(148,163,184,0.1)] h-[280px] border border-gray-200 dark:border-slate-700/80 text-center relative pt-12 px-5 pb-6 flex flex-col justify-between group-hover:border-slate-400 dark:group-hover:border-slate-500 transition-colors">
                        <!-- Rank Badge -->
                        <div class="font-display absolute -top-6 left-1/2 transform -translate-x-1/2 bg-gradient-to-b from-gray-100 to-gray-300 dark:from-slate-600 dark:to-slate-700 text-gray-700 dark:text-white w-12 h-12 rounded-2xl rotate-3 flex items-center justify-center font-black text-xl border-4 border-white dark:border-slate-900 shadow-md transition-transform group-hover:scale-110">2</div>
                        
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-700 border-4 border-slate-200 dark:border-slate-600 mb-3 overflow-hidden transition-transform group-hover:scale-110">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $top3[1]->name }}" alt="avatar" class="w-full h-full object-cover">
                            </div>
                            <h3 class="font-display font-black text-lg text-slate-900 dark:text-white truncate w-full px-2" title="{{ $top3[1]->name }}">{{ $top3[1]->name }}</h3>
                            <p class="text-[10px] font-black tracking-widest text-slate-400 dark:text-slate-500 uppercase mt-1">Silver Guardian</p>
                        </div>

                        <div class="bg-slate-50/80 dark:bg-slate-900/50 rounded-2xl p-3 border border-slate-100 dark:border-slate-700/50 flex justify-center divide-x divide-slate-200 dark:divide-slate-700 mt-4">
                            <div class="px-4 w-1/2">
                                <div class="text-[10px] text-gray-500 dark:text-gray-400 font-bold mb-1">POIN</div>
                                <div class="font-display text-xl font-black text-slate-700 dark:text-gray-200">{{ $top3[1]->poin }}</div>
                            </div>
                            <div class="px-4 w-1/2">
                                <div class="text-[10px] text-emerald-500 font-bold mb-1 uppercase">Valid</div>
                                <div class="font-display text-xl font-black text-emerald-600 dark:text-emerald-400">{{ $top3[1]->laporans->where('status', 'Valid')->count() ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </a>
                @endif

                <!-- JUARA 1 (Gold) -->
                @if(isset($top3[0]))
                <a href="/hunter/{{ $top3[0]->id }}" class="reveal-on-scroll w-full md:w-[34%] z-10 block transform transition-all duration-500 hover:-translate-y-4 cursor-pointer group" style="animation-delay: 0.1s;">
                    <div class="bg-gradient-to-b from-amber-50/90 to-white/90 dark:from-amber-900/30 dark:to-slate-800/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl dark:shadow-[0_0_40px_rgba(245,158,11,0.15)] h-[360px] border border-amber-200 dark:border-amber-700/50 text-center relative pt-16 px-6 pb-8 flex flex-col justify-between group-hover:border-amber-400 transition-colors">
                        
                        <!-- Crown & Badge -->
                        <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 text-5xl drop-shadow-[0_10px_10px_rgba(245,158,11,0.5)] animate-bounce" style="animation-duration: 2s;">👑</div>
                        <div class="font-display absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gradient-to-b from-amber-400 to-orange-500 text-white w-16 h-16 rounded-2xl -rotate-3 flex items-center justify-center font-black text-3xl border-4 border-white dark:border-slate-900 shadow-xl transition-transform group-hover:scale-110">1</div>
                        
                        <div class="flex flex-col items-center">
                            <div class="w-24 h-24 rounded-full bg-amber-100 dark:bg-amber-900/50 border-4 border-amber-300 dark:border-amber-500 mb-4 overflow-hidden shadow-[0_0_20px_rgba(245,158,11,0.3)] transition-transform group-hover:scale-110">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $top3[0]->name }}&backgroundColor=fef3c7" alt="avatar" class="w-full h-full object-cover">
                            </div>
                            <h3 class="font-display font-black text-2xl text-slate-900 dark:text-white truncate w-full px-2" title="{{ $top3[0]->name }}">{{ $top3[0]->name }}</h3>
                            <p class="text-xs font-black tracking-widest text-amber-500 dark:text-amber-400 uppercase mt-2 flex items-center gap-1 justify-center">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Lvl 3 Expert
                            </p>
                        </div>

                        <div class="bg-white/90 dark:bg-slate-900/80 rounded-2xl shadow-sm border border-amber-100 dark:border-amber-900/50 flex justify-center divide-x divide-gray-100 dark:divide-slate-800 mt-6 p-4">
                            <div class="px-4 w-1/2 flex flex-col items-center">
                                <div class="text-[10px] text-amber-600 dark:text-amber-500 font-bold mb-1 uppercase tracking-wider flex items-center gap-1">Total Poin</div>
                                <div class="font-display text-2xl font-black text-slate-800 dark:text-gray-100">{{ number_format($top3[0]->poin / 1000, 1) }}k</div>
                            </div>
                            <div class="px-4 w-1/2 flex flex-col items-center">
                                <div class="text-[10px] text-emerald-500 font-bold mb-1 uppercase tracking-wider flex items-center gap-1">Valid</div>
                                <div class="font-display text-2xl font-black text-slate-800 dark:text-gray-100">{{ $top3[0]->laporans->where('status', 'Valid')->count() ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </a>
                @endif

                <!-- JUARA 3 (Bronze) -->
                @if(isset($top3[2]))
                <a href="/hunter/{{ $top3[2]->id }}" class="reveal-on-scroll w-full md:w-[28%] block transform transition-all duration-500 hover:-translate-y-4 cursor-pointer group" style="animation-delay: 0.3s;">
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-[2rem] shadow-xl dark:shadow-[0_0_30px_rgba(234,88,12,0.1)] h-[260px] border border-gray-200 dark:border-slate-700/80 text-center relative pt-10 px-4 pb-6 flex flex-col justify-between group-hover:border-orange-300 dark:group-hover:border-orange-700/50 transition-colors">
                        <!-- Rank Badge -->
                        <div class="font-display absolute -top-6 left-1/2 transform -translate-x-1/2 bg-gradient-to-b from-orange-200 to-orange-400 dark:from-orange-700 dark:to-orange-900 text-orange-900 dark:text-white w-12 h-12 rounded-2xl -rotate-3 flex items-center justify-center font-black text-xl border-4 border-white dark:border-slate-900 shadow-md transition-transform group-hover:scale-110">3</div>
                        
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-orange-50 dark:bg-orange-900/30 border-4 border-orange-200 dark:border-orange-800/50 mb-3 overflow-hidden transition-transform group-hover:scale-110">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $top3[2]->name }}" alt="avatar" class="w-full h-full object-cover">
                            </div>
                            <h3 class="font-display font-black text-lg text-slate-900 dark:text-white truncate w-full px-2" title="{{ $top3[2]->name }}">{{ $top3[2]->name }}</h3>
                            <p class="text-[10px] font-black tracking-widest text-orange-500 uppercase mt-1">Bronze Striker</p>
                        </div>

                        <div class="bg-slate-50/80 dark:bg-slate-900/50 rounded-2xl p-3 border border-slate-100 dark:border-slate-700/50 flex justify-center divide-x divide-slate-200 dark:divide-slate-700 mt-4">
                            <div class="px-4 w-1/2">
                                <div class="text-[10px] text-gray-500 dark:text-gray-400 font-bold mb-1 uppercase">Poin</div>
                                <div class="font-display text-xl font-black text-slate-700 dark:text-gray-200">{{ $top3[2]->poin }}</div>
                            </div>
                            <div class="px-4 w-1/2">
                                <div class="text-[10px] text-emerald-500 font-bold mb-1 uppercase">Valid</div>
                                <div class="font-display text-xl font-black text-emerald-600 dark:text-emerald-400">{{ $top3[2]->laporans->where('status', 'Valid')->count() ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </a>
                @endif
            </div>
            @else
            <div class="text-center py-24 text-gray-500 dark:text-gray-400 font-medium border-2 border-dashed border-gray-300 dark:border-slate-700 rounded-3xl mb-12 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm">
                <span class="text-4xl mb-4 block">📡</span>
                Belum ada Hunter yang memiliki poin.<br>Jadilah yang pertama untuk memecahkan rekor di sistem kami!
            </div>
            @endif

            <!-- ================= LIST RANK 4 & SETERUSNYA ================= -->
            @if($lainnya->count() > 0)
            <div class="mt-16 mb-8 reveal-on-scroll" style="animation-delay: 0.4s;">
                <h3 class="font-display text-sm font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6 px-2 flex items-center gap-3">
                    <span class="h-px bg-slate-300 dark:bg-slate-700 flex-grow"></span>
                    Urutan Peringkat Global
                    <span class="h-px bg-slate-300 dark:bg-slate-700 flex-grow"></span>
                </h3>
                
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-3xl shadow-lg border border-gray-200/50 dark:border-slate-700/50 overflow-hidden">
                    <div class="divide-y divide-gray-100 dark:divide-slate-800/80">
                        @foreach($lainnya as $index => $hunter)
                        <a href="/hunter/{{ $hunter->id }}" class="flex items-center justify-between p-4 md:px-8 md:py-5 hover:bg-amber-50/50 dark:hover:bg-amber-900/10 transition-all duration-300 group cursor-pointer block relative">
                            
                            <!-- Aksen Hover Kiri -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-amber-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                            <div class="flex items-center gap-4 md:gap-6 w-full">
                                <!-- Nomor Rank -->
                                <div class="font-display text-slate-300 dark:text-slate-600 font-black text-xl md:text-2xl w-8 text-center group-hover:text-amber-500 dark:group-hover:text-amber-400 transition-colors transform group-hover:scale-110">
                                    #{{ $index + 4 }}
                                </div>
                                
                                <!-- Avatar -->
                                <div class="w-12 h-12 bg-slate-100 dark:bg-slate-800 rounded-full border border-slate-200 dark:border-slate-700 overflow-hidden flex-shrink-0 group-hover:border-amber-300 dark:group-hover:border-amber-500 transition-colors">
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $hunter->name }}" alt="avatar" class="w-full h-full object-cover">
                                </div>
                                
                                <!-- Info Detail -->
                                <div class="flex-1">
                                    <div class="font-display font-bold text-slate-900 dark:text-white flex items-center gap-2 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors text-base md:text-lg">
                                        {{ $hunter->name }}
                                        @if($index + 4 <= 10) 
                                        <span class="bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300 text-[10px] px-2 py-0.5 rounded uppercase font-black tracking-widest hidden md:inline-flex items-center gap-1 border border-amber-200 dark:border-amber-800">
                                            TOP 10
                                        </span> 
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1.5 mt-1 font-medium">
                                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        {{ $hunter->laporans->where('status', 'Valid')->count() ?? 0 }} Valid Reports
                                    </div>
                                </div>

                                <!-- Total Poin -->
                                <div class="text-right">
                                    <div class="text-[10px] text-gray-400 dark:text-gray-500 font-bold mb-0.5 flex justify-end items-center gap-1 uppercase tracking-wider">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> Poin
                                    </div>
                                    <div class="font-display font-black text-slate-800 dark:text-white text-xl group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                                        {{ number_format($hunter->poin) }}
                                    </div>
                                </div>
                            </div>

                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

    <!-- FOOTER -->
    <x-footer />

    <!-- CHATBOT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

    <!-- SCRIPT ANIMASI SCROLL -->
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