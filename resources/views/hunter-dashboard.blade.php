<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JatimProv CSIRT</title>
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
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-40 dark:opacity-100 z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- AMBIL DATA DARI DATABASE -->
    @php
        $laporans = \App\Models\Laporan::where('user_id', auth()->id())->latest()->get();
        
        $totalLaporan = $laporans->count();
        $laporanDiproses = $laporans->whereIn('status', ['Pending', 'Diproses', 'Menunggu'])->count();
        $laporanValid = $laporans->where('status', 'Valid')->count();
        
        $totalPoin = auth()->user()->poin ?? 0;
    @endphp

    <!-- KONTEN UTAMA -->
    <div class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10">
        
        <!-- ================= KARTU SELAMAT DATANG (HERO DASHBOARD) ================= -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] border border-gray-200/50 dark:border-slate-700/80 p-8 md:p-10 mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8 relative overflow-hidden group opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            
            <!-- Garis Neon Atas -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-blue-600"></div>
            <!-- Efek Glow Kanan Bawah -->
            <div class="absolute -bottom-16 -right-16 w-48 h-48 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-cyan-800/50 text-blue-600 dark:text-cyan-400 font-mono text-[10px] font-bold tracking-widest mb-4 uppercase rounded-full shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500 shadow-[0_0_8px_#22d3ee]"></span>
                    </span>
                    COMMAND_CENTER_ACTIVE
                </div>
                <h1 class="font-display text-3xl md:text-4xl lg:text-5xl font-black text-gray-900 dark:text-white tracking-tight leading-tight">
                    Selamat datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-cyan-400 dark:to-blue-500">{{ auth()->user()->name ?? 'Hunter' }}</span>! 👋
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-3 text-sm md:text-base font-medium max-w-2xl">
                    Ini adalah pusat kendali Anda. Pantau status laporan kerentanan, kumpulkan reputasi, dan bantu kami mengamankan infrastruktur digital Jawa Timur.
                </p>
            </div>
            
            <a href="/dashboard/lapor" class="group/btn relative shrink-0 inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-sm font-bold py-4 px-8 rounded-xl transition-all shadow-[0_0_15px_rgba(6,182,212,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.5)] hover:-translate-y-1 overflow-hidden z-10">
                <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover/btn:-translate-x-5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                </span>
                <span class="transition-all duration-300 ease-out group-hover/btn:-translate-x-3 flex items-center gap-2 uppercase tracking-wide">
                    <svg class="w-5 h-5 group-hover/btn:opacity-0 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Kirim Laporan Bug
                </span>
                <div class="absolute top-0 -left-[100%] w-1/2 h-full bg-gradient-to-r from-transparent via-white/30 to-transparent skew-x-12 animate-glare z-0 pointer-events-none"></div>
            </a>
        </div>

        <!-- ================= STATISTIK DINAMIS ================= -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Poin Reputasi -->
            <div class="opacity-0 animate-fade-in-up group bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] p-6 md:p-8 shadow-lg hover:shadow-2xl hover:shadow-cyan-500/10 border border-gray-200/50 dark:border-slate-800/80 flex flex-col justify-between relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:border-cyan-300 dark:hover:border-cyan-700/50" style="animation-delay: 0.2s;">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl group-hover:bg-cyan-500/20 transition-colors duration-700"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-4 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">
                        <div class="p-1.5 bg-blue-100 dark:bg-cyan-900/30 rounded-lg text-blue-600 dark:text-cyan-400 group-hover:scale-110 transition-transform duration-300 border border-blue-200 dark:border-cyan-800/50"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                        Total Poin Reputasi
                    </div>
                    <div class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-1 tracking-tighter">{{ number_format($totalPoin) }} <span class="text-xl text-gray-400 dark:text-gray-500 font-bold font-sans">Pts</span></div>
                </div>
            </div>

            <!-- Laporan Valid -->
            <div class="opacity-0 animate-fade-in-up group bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] p-6 md:p-8 shadow-lg hover:shadow-2xl hover:shadow-emerald-500/10 border border-gray-200/50 dark:border-slate-800/80 flex flex-col justify-between relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:border-emerald-300 dark:hover:border-emerald-700/50" style="animation-delay: 0.3s;">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-colors duration-700"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-4 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                        <div class="p-1.5 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform duration-300 border border-emerald-200 dark:border-emerald-800/50"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        Laporan Tervalidasi
                    </div>
                    <div class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-1 tracking-tighter">{{ $laporanValid }}</div>
                </div>
            </div>

            <!-- Diproses -->
            <div class="opacity-0 animate-fade-in-up group bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] p-6 md:p-8 shadow-lg hover:shadow-2xl hover:shadow-amber-500/10 border border-gray-200/50 dark:border-slate-800/80 flex flex-col justify-between relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:border-amber-300 dark:hover:border-amber-700/50" style="animation-delay: 0.4s;">
                <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl group-hover:bg-amber-500/20 transition-colors duration-700"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-4 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                        <div class="p-1.5 bg-amber-100 dark:bg-amber-900/30 rounded-lg text-amber-600 dark:text-amber-400 group-hover:rotate-12 transition-transform duration-300 border border-amber-200 dark:border-amber-800/50"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        Sedang Diproses
                    </div>
                    <div class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-1 tracking-tighter">{{ $laporanDiproses }}</div>
                </div>
            </div>
        </div>

        <!-- ================= RIWAYAT LAPORAN ================= -->
        <div class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl rounded-3xl shadow-xl dark:shadow-[0_10px_30px_rgba(0,0,0,0.5)] border border-gray-200/50 dark:border-slate-700/50 overflow-hidden transition-all duration-500 relative z-10 opacity-0 animate-fade-in-up" style="animation-delay: 0.5s;">
            
            <div class="px-6 md:px-8 py-6 border-b border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-[#020817]/50 flex justify-between items-center transition-colors duration-300">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-50 dark:bg-cyan-900/30 rounded-xl border border-blue-100 dark:border-cyan-800/50 text-blue-600 dark:text-cyan-400 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h2 class="font-display text-xl font-black text-gray-900 dark:text-white tracking-tight">Riwayat Laporan Temuan</h2>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-0.5">Vulnerability Log</p>
                    </div>
                </div>
            </div>
            
            @if($laporans->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-slate-950/80 text-gray-500 dark:text-gray-400 text-[10px] font-bold uppercase tracking-widest border-b border-gray-200 dark:border-slate-800">
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Target URL</th>
                                <th class="px-6 py-4">Jenis Kerentanan</th>
                                <th class="px-6 py-4">Severity</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-800/80 text-sm bg-white dark:bg-slate-900/40">
                            @foreach($laporans as $lapor)
                                <tr class="hover:bg-blue-50/50 dark:hover:bg-cyan-900/10 transition-colors duration-200 group cursor-default">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400 text-xs font-mono group-hover:text-gray-800 dark:group-hover:text-gray-200 transition-colors">
                                        {{ $lapor->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 font-mono text-blue-600 dark:text-cyan-400 text-xs truncate max-w-[200px]" title="{{ $lapor->target_url }}">
                                        {{ $lapor->target_url }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-slate-800 dark:text-gray-200 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors">
                                        {{ $lapor->jenis_kerentanan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <!-- Severity Badges -->
                                        @if($lapor->severity == 'Critical')
                                            <span class="inline-flex items-center gap-1.5 text-red-600 dark:text-red-400 text-[10px] font-black uppercase tracking-widest">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Critical
                                            </span>
                                        @elseif($lapor->severity == 'High')
                                            <span class="inline-flex items-center gap-1.5 text-orange-600 dark:text-orange-400 text-[10px] font-black uppercase tracking-widest">
                                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> High
                                            </span>
                                        @elseif($lapor->severity == 'Medium')
                                            <span class="inline-flex items-center gap-1.5 text-amber-600 dark:text-amber-400 text-[10px] font-black uppercase tracking-widest">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Medium
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-widest">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Low
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <!-- Status Badges -->
                                        @if($lapor->status === 'Valid')
                                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase tracking-widest px-2.5 py-1 rounded border border-emerald-200 dark:border-emerald-800/50 shadow-sm">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg> Valid
                                            </span>
                                        @elseif($lapor->status === 'Ditolak')
                                            <span class="inline-flex items-center gap-1.5 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-[10px] font-black uppercase tracking-widest px-2.5 py-1 rounded border border-red-200 dark:border-red-800/50 shadow-sm">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg> Ditolak
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-[10px] font-black uppercase tracking-widest px-2.5 py-1 rounded border border-amber-200 dark:border-amber-800/50 shadow-sm">
                                                <svg class="w-3 h-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> {{ $lapor->status ?? 'Pending' }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Empty State (Jika belum ada laporan) -->
                <div class="px-6 py-20 text-center bg-gray-50/50 dark:bg-[#020817]/50 rounded-b-3xl">
                    <div class="w-20 h-20 mx-auto mb-5 bg-white dark:bg-slate-800 rounded-2xl flex items-center justify-center border-4 border-gray-100 dark:border-slate-900 shadow-md">
                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-gray-900 dark:text-white font-black text-xl mb-2 tracking-tight">Belum Ada Aktivitas</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-6">Anda belum mengirimkan laporan kerentanan satupun ke sistem kami.</p>
                    <a href="/dashboard/lapor" class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 dark:bg-slate-700 dark:hover:bg-slate-600 text-white font-bold py-2.5 px-6 rounded-xl transition-all shadow-md text-sm">
                        Mulai Perburuan Bug
                    </a>
                </div>
            @endif
        </div>

    </div>

    <!-- CHATBOT -->
    <x-chatbot />

</body>
</html>