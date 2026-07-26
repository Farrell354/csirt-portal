<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall of Fame - JatimProv CSIRT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Konfigurasi agar Tailwind mengenali Dark Mode berbasis Class -->
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>
<!-- Tambahkan transisi dan warna dasar dark mode (dark:bg-slate-900 dark:text-gray-200) di body -->
<body class="bg-gray-50 text-gray-900 transition-colors duration-300 dark:bg-slate-900 dark:text-gray-200 font-sans antialiased selection:bg-blue-300">
    
    <!-- NAVBAR (Gaya Profesional - Welcome Blade) -->
    <x-navbar />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Banner Hall of Fame (Dark Mode) -->
    <div class="bg-[#111827] text-white py-16 px-4 relative overflow-hidden">
        <!-- Background Grid Pattern -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between relative z-10">
            <div class="mb-10 md:mb-0 md:w-2/3">
                <span class="bg-[#1e293b] text-emerald-400 px-3 py-1 rounded-full text-xs font-bold tracking-widest border border-emerald-900/50 mb-4 inline-flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> LIVE GLOBAL RANKING
                </span>
                <h1 class="text-4xl md:text-5xl font-black mb-4">Hall of <span class="text-amber-500">Fame & Elite</span></h1>
                <p class="text-gray-400 text-base md:text-lg max-w-xl leading-relaxed">Panggung kehormatan bagi para peneliti keamanan siber yang berdedikasi. Peringkat ini dihitung secara kumulatif berdasarkan validitas dan dampak laporan sepanjang masa.</p>
                
                <div class="flex gap-4 mt-8">
                    <div class="bg-[#1e293b] border border-gray-800 rounded-xl p-4 w-40 flex items-center gap-3 shadow-lg">
                        <div class="bg-blue-900/50 p-2 rounded-lg"><svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></div>
                        <div>
                            <div class="text-gray-500 text-[10px] font-black uppercase mb-0.5">Total Partisipan</div>
                            <div class="text-xl font-black text-white leading-none">{{ $totalHunter }} <span class="text-xs font-normal text-gray-500">Hunter</span></div>
                        </div>
                    </div>
                    <div class="bg-[#1e293b] border border-gray-800 rounded-xl p-4 w-40 flex items-center gap-3 shadow-lg">
                        <div class="bg-emerald-900/50 p-2 rounded-lg"><svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <div>
                            <div class="text-gray-500 text-[10px] font-black uppercase mb-0.5">Laporan Valid</div>
                            <div class="text-xl font-black text-white leading-none">{{ $totalLaporanValid }} <span class="text-xs font-normal text-gray-500">Terverifikasi</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ilustrasi Mesin Engine -->
            <div class="md:w-1/3 flex justify-center md:justify-end">
                <div class="bg-[#0f172a] border border-gray-800 p-6 rounded-2xl shadow-2xl relative w-full max-w-sm rotate-1 hover:rotate-0 transition-transform duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-xs text-emerald-400 font-mono flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            >_ csirt-rank-engine
                        </div>
                        <div class="text-[10px] text-gray-500 font-mono">v1.2.0-stable</div>
                    </div>
                    <div class="text-sm text-gray-400 font-mono space-y-1 mb-6">
                        <div class="animate-pulse">> Fetching historical_data...</div>
                        <div>> Aggregating points (all-time)... <span class="text-emerald-400">Done</span></div>
                        <div>> Calculating reputation score...</div>
                    </div>
                    <div class="bg-[#1e293b] rounded-xl p-4 border border-gray-700/50">
                        <div class="text-[10px] tracking-widest text-gray-500 font-bold mb-2 flex items-center gap-2">
                            <span class="text-amber-500">🏆</span> CURRENT LEADER
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-amber-400 to-orange-500 flex items-center justify-center text-white font-bold text-sm">
                                    {{ $top3->count() > 0 ? substr($top3[0]->name, 0, 1) : '?' }}
                                </div>
                                <div class="text-gray-200 font-bold text-sm">{{ $top3->count() > 0 ? $top3[0]->name : 'Menunggu Pahlawan...' }}</div>
                            </div>
                            <div class="text-emerald-400 font-mono text-sm font-bold">{{ $top3->count() > 0 ? $top3[0]->poin : 0 }} Pts</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Podium & List -->
    <div class="max-w-5xl mx-auto px-4 py-16">
        
        <!-- ================= PODIUM TOP 3 ================= -->
        @if($top3->count() > 0)
        <div class="flex flex-col md:flex-row items-end justify-center gap-4 md:gap-6 mb-20 md:h-[350px]">
            
            <!-- JUARA 2 (Silver) -->
            @if(isset($top3[1]))
            <div class="bg-white rounded-[2rem] shadow-lg w-full md:w-[28%] h-[260px] border border-gray-100 text-center relative pt-10 px-4 pb-6 flex flex-col justify-between transform transition hover:-translate-y-2">
                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-gray-100 text-gray-500 w-12 h-12 rounded-2xl rotate-3 flex items-center justify-center font-black text-xl border-4 border-white shadow-sm">2</div>
                
                <div class="flex flex-col items-center">
                    <!-- Avatar Dummy -->
                    <div class="w-16 h-16 rounded-full bg-slate-200 border-2 border-slate-300 mb-3 overflow-hidden">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $top3[1]->name }}" alt="avatar">
                    </div>
                    <h3 class="font-black text-lg text-gray-800 truncate w-full px-2" title="{{ $top3[1]->name }}">{{ $top3[1]->name }}</h3>
                    <p class="text-[10px] font-black tracking-widest text-slate-400 uppercase mt-1">Silver Guardian</p>
                </div>

                <div class="flex justify-center divide-x divide-gray-200 mt-4">
                    <div class="px-4">
                        <div class="text-[10px] text-gray-400 font-bold mb-1">POIN</div>
                        <div class="text-lg font-black text-gray-700">{{ $top3[1]->poin }}</div>
                    </div>
                    <div class="px-4">
                        <div class="text-[10px] text-emerald-500 font-bold mb-1 uppercase">Valid</div>
                        <div class="text-lg font-black text-emerald-600">{{ $top3[1]->laporans->where('status', 'Valid')->count() ?? 0 }}</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- JUARA 1 (Gold) -->
            @if(isset($top3[0]))
            <div class="bg-gradient-to-b from-amber-50 to-white rounded-[2.5rem] shadow-2xl w-full md:w-[36%] h-[340px] border border-amber-100 text-center relative pt-14 px-6 pb-8 flex flex-col justify-between z-10 transform transition hover:-translate-y-2">
                
                <!-- Mahkota -->
                <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 text-5xl drop-shadow-lg animate-bounce" style="animation-duration: 2s;">👑</div>
                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-amber-400 text-white w-16 h-16 rounded-2xl -rotate-3 flex items-center justify-center font-black text-3xl border-4 border-white shadow-xl">1</div>
                
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-amber-100 border-4 border-amber-300 mb-4 overflow-hidden shadow-inner ring-4 ring-amber-50">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $top3[0]->name }}&backgroundColor=fef3c7" alt="avatar">
                    </div>
                    <h3 class="font-black text-2xl text-gray-900 truncate w-full px-2" title="{{ $top3[0]->name }}">{{ $top3[0]->name }}</h3>
                    <p class="text-xs font-black tracking-widest text-amber-500 uppercase mt-1 flex items-center gap-1 justify-center">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Lvl 3 Expert
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-amber-100 flex justify-center divide-x divide-gray-100 mt-4 p-3">
                    <div class="px-6 flex flex-col items-center">
                        <div class="text-[10px] text-amber-600 font-bold mb-1 uppercase tracking-wider flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> Total Poin</div>
                        <div class="text-3xl font-black text-gray-800">{{ number_format($top3[0]->poin / 1000, 1) }}k</div>
                    </div>
                    <div class="px-6 flex flex-col items-center">
                        <div class="text-[10px] text-emerald-500 font-bold mb-1 uppercase tracking-wider flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Valid</div>
                        <div class="text-3xl font-black text-gray-800">{{ $top3[0]->laporans->where('status', 'Valid')->count() ?? 0 }}</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- JUARA 3 (Bronze) -->
            @if(isset($top3[2]))
            <div class="bg-white rounded-[2rem] shadow-lg w-full md:w-[28%] h-[240px] border border-gray-100 text-center relative pt-10 px-4 pb-6 flex flex-col justify-between transform transition hover:-translate-y-2">
                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-orange-100 text-orange-700 w-12 h-12 rounded-2xl -rotate-3 flex items-center justify-center font-black text-xl border-4 border-white shadow-sm">3</div>
                
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-orange-50 border-2 border-orange-200 mb-3 overflow-hidden">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $top3[2]->name }}" alt="avatar">
                    </div>
                    <h3 class="font-black text-lg text-gray-800 truncate w-full px-2" title="{{ $top3[2]->name }}">{{ $top3[2]->name }}</h3>
                    <p class="text-[10px] font-black tracking-widest text-orange-500 uppercase mt-1">Bronze Striker</p>
                </div>

                <div class="flex justify-center divide-x divide-gray-200 mt-4">
                    <div class="px-4">
                        <div class="text-[10px] text-gray-400 font-bold mb-1 uppercase">Poin</div>
                        <div class="text-lg font-black text-gray-700">{{ $top3[2]->poin }}</div>
                    </div>
                    <div class="px-4">
                        <div class="text-[10px] text-emerald-500 font-bold mb-1 uppercase">Valid</div>
                        <div class="text-lg font-black text-emerald-600">{{ $top3[2]->laporans->where('status', 'Valid')->count() ?? 0 }}</div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @else
        <div class="text-center py-20 text-gray-400 font-medium border-2 border-dashed border-gray-200 rounded-3xl mb-12">
            Belum ada Hunter yang memiliki poin.<br>Jadilah yang pertama untuk memecahkan rekor!
        </div>
        @endif

        <!-- ================= LIST RANK 4 & SETERUSNYA ================= -->
        @if($lainnya->count() > 0)
        <div class="mt-8 mb-4">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 px-2">Urutan Peringkat Selanjutnya</h3>
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden">
                <div class="divide-y divide-gray-100">
                    @foreach($lainnya as $index => $hunter)
                    <div class="flex items-center justify-between p-4 md:px-8 md:py-5 hover:bg-slate-50 transition-colors group">
                        
                        <div class="flex items-center gap-4 md:gap-6 w-full">
                            <!-- Nomor -->
                            <div class="text-gray-300 font-black text-xl w-8 text-center group-hover:text-blue-500 transition-colors">#{{ $index + 4 }}</div>
                            
                            <!-- Avatar Kecil -->
                            <div class="w-12 h-12 bg-slate-100 rounded-full border border-slate-200 overflow-hidden flex-shrink-0">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $hunter->name }}" alt="avatar" class="w-full h-full object-cover">
                            </div>
                            
                            <!-- Info -->
                            <div class="flex-1">
                                <div class="font-bold text-gray-900 flex items-center gap-2">
                                    {{ $hunter->name }}
                                    @if($index + 4 <= 10) <span class="bg-blue-100 text-blue-700 text-[10px] px-2 py-0.5 rounded uppercase font-black tracking-widest hidden md:inline-block">TOP 10</span> @endif
                                </div>
                                <div class="text-xs text-gray-500 flex items-center gap-2 mt-1">
                                    <svg class="w-3 h-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    {{ $hunter->laporans->where('status', 'Valid')->count() ?? 0 }} Valid
                                </div>
                            </div>

                            <!-- Poin -->
                            <div class="text-right">
                                <div class="text-[10px] text-gray-400 font-bold mb-0.5 flex justify-end items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg> POIN</div>
                                <div class="font-black text-gray-800 text-xl">{{ $hunter->poin }}</div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

    </div>

</body>
<!-- Script Penggerak Dark Mode -->
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;

        // Fungsi saat tombol diklik
        themeToggleBtn.addEventListener('click', function() {
            htmlElement.classList.toggle('dark');
            
            // Simpan pilihan user di memori browser
            if (htmlElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });

        // Cek ingatan browser (apakah sebelumnya user pakai dark mode?)
        if (localStorage.getItem('theme') === 'dark') {
            htmlElement.classList.add('dark');
        }
    </script>
</body>
<x-chatbot />
</html>
