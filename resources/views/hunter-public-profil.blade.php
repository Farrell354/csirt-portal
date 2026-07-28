<!DOCTYPE html>
<html lang="id" class="light">
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
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">
    
    <x-navbar />

    <div class="flex-grow max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        
        <!-- Tombol Kembali -->
        <a href="/leaderboard" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-blue-600 mb-6 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Leaderboard
        </a>

        <!-- ================= BAGIAN HEADER & PROFIL ================= -->
        <div class="mb-8 relative">
            <!-- Banner Ungu -->
            <div class="h-32 md:h-40 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-t-3xl relative">
                <button class="absolute top-4 right-4 bg-white/20 hover:bg-white/30 p-2 rounded-xl text-white backdrop-blur-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                </button>
            </div>

            <!-- Area Info Profil -->
            <div class="bg-white rounded-b-3xl shadow-sm border-x border-b border-gray-200 px-6 pb-8 pt-16 md:pt-20 relative flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
                
                <!-- Avatar Overlapping -->
                <div class="absolute -top-12 md:-top-16 left-6 md:left-10">
                    <div class="relative">
                        <div class="w-24 h-24 md:w-32 md:h-32 bg-white rounded-3xl p-1 shadow-lg ring-1 ring-gray-100">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $hunter->name }}&backgroundColor=ffdfbf" alt="Avatar" class="w-full h-full rounded-[1.25rem] object-cover bg-orange-100">
                        </div>
                        @if($hunter->poin >= 1000)
                        <div class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white text-[10px] md:text-xs font-bold px-3 py-1 rounded-full border-2 border-white shadow-sm flex items-center gap-1 whitespace-nowrap">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span> TOP HUNTER
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Info Nama & Username -->
                <div class="md:ml-40 mt-4 md:mt-0 w-full">
                    <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 mb-3">
                        <h1 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight">{{ $hunter->name }}</h1>
                        <span class="bg-indigo-50 text-indigo-500 font-medium text-sm px-3 py-1 rounded-lg border border-indigo-100 w-fit">
                            {{ $hunter->email }}
                        </span>
                    </div>
                    
                    <!-- Badges -->
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1 bg-amber-50 border border-amber-200 text-amber-600 text-xs font-bold px-2.5 py-1 rounded-md">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 1l2.5 5 5.5.75-4 3.75 1 5.5L10 13.5l-5 2.5 1-5.5-4-3.75 5.5-.75L10 1z" clip-rule="evenodd"></path></svg> 
                            Lvl {{ floor($hunter->poin / 1000) + 1 }} Expert
                        </span>
                        <span class="inline-flex items-center gap-1 bg-emerald-50 border border-emerald-100 text-emerald-600 text-xs font-bold px-2.5 py-1 rounded-md">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Verified
                        </span>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-4 md:mt-0 w-full md:w-auto shrink-0 flex gap-2">
                    <button class="w-full md:w-auto bg-gray-900 hover:bg-gray-800 text-white text-sm font-bold py-2.5 px-5 rounded-xl transition shadow-md flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6.632l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                        Bagikan Profil
                    </button>
                </div>
            </div>
        </div>

        <!-- ================= KOTAK STATISTIK ================= -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Box Total Skor -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-blue-50 rounded-full blur-2xl"></div>
                <div>
                    <div class="flex items-center gap-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">
                        <div class="p-1.5 bg-blue-100 rounded-lg text-blue-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                        Total Skor
                    </div>
                    <div class="text-4xl font-black text-gray-900 mb-1">{{ number_format($hunter->poin) }} <span class="text-lg font-bold text-gray-400 lowercase">pts</span></div>
                </div>
            </div>

            <!-- Box Validitas -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-emerald-50 rounded-full blur-2xl"></div>
                <div>
                    <div class="flex items-center gap-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">
                        <div class="p-1.5 bg-emerald-100 rounded-lg text-emerald-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        Tingkat Validitas
                    </div>
                    <div class="text-4xl font-black text-gray-900 mb-2">{{ $validitas }}%</div>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-1.5 mt-4">
                    <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $validitas }}%"></div>
                </div>
            </div>

            <!-- Box Laporan Valid -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-50 rounded-full blur-2xl"></div>
                <div>
                    <div class="flex items-center gap-2 text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">
                        <div class="p-1.5 bg-orange-100 rounded-lg text-orange-500"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A12.014 12.014 0 0010 1a11.999 11.999 0 00-9.96 5.378.01.01 0 00-.007.01C.017 6.47 0 6.55 0 6.64v8.72c0 .088.017.17.033.253a.01.01 0 00.007.01 11.999 11.999 0 009.96 5.378A12.014 12.014 0 0010 21a11.999 11.999 0 009.96-5.378.01.01 0 00.007-.01c.016-.083.033-.165.033-.253v-8.72c0-.09-.017-.17-.033-.253a.01.01 0 00-.007-.01A11.999 11.999 0 0011.3 1.046z" clip-rule="evenodd"></path></svg></div>
                        Laporan Tervalidasi
                    </div>
                    <div class="text-4xl font-black text-gray-900 mb-1">{{ $laporanValid }} <span class="text-base font-bold text-gray-500 lowercase">Bugs</span></div>
                </div>
            </div>
        </div>

        <!-- ================= AREA BAWAH (ACHIEVEMENTS & INFO) ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Hall of Achievements (Lebar 2 Kolom, Tema Gelap) -->
            <div class="lg:col-span-2 bg-slate-900 rounded-3xl p-6 md:p-8 shadow-md">
                <div class="flex justify-between items-center mb-6 border-b border-slate-800 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-amber-500/20 rounded-lg text-amber-500"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"></path></svg></div>
                        <h2 class="text-xl font-bold text-white">Hall of Achievements</h2>
                    </div>
                    <span class="text-xs font-bold bg-slate-800 text-slate-300 px-3 py-1 rounded-full border border-slate-700">3 Unlocked</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Achievement 1 -->
                    <div class="bg-slate-800/50 rounded-2xl p-5 border border-slate-700/50 hover:bg-slate-800 transition">
                        <div class="flex flex-col items-center text-center mb-2">
                            <div class="w-12 h-12 bg-slate-700 rounded-full flex items-center justify-center mb-3 ring-4 ring-slate-800">
                                <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                            <h4 class="text-sm font-bold text-gray-200">Expert Hunter</h4>
                            <p class="text-[10px] text-gray-500 font-bold tracking-widest mt-1">TIER SILVER</p>
                        </div>
                    </div>

                    <!-- Achievement 2 -->
                    <div class="bg-slate-800/50 rounded-2xl p-5 border border-slate-700/50 hover:bg-slate-800 transition">
                        <div class="flex flex-col items-center text-center mb-2">
                            <div class="w-12 h-12 bg-slate-700 rounded-full flex items-center justify-center mb-3 ring-4 ring-slate-800">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            <h4 class="text-sm font-bold text-gray-200">Sharp Eye</h4>
                            <p class="text-[10px] text-orange-500 font-bold tracking-widest mt-1">TIER BRONZE</p>
                        </div>
                    </div>

                    <!-- Achievement 3 -->
                    <div class="bg-slate-800/50 rounded-2xl p-5 border border-slate-700/50 hover:bg-slate-800 transition">
                        <div class="flex flex-col items-center text-center mb-2">
                            <div class="w-12 h-12 bg-slate-700 rounded-full flex items-center justify-center mb-3 ring-4 ring-slate-800">
                                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h4 class="text-sm font-bold text-gray-200">System Breaker</h4>
                            <p class="text-[10px] text-emerald-500 font-bold tracking-widest mt-1">TIER PLATINUM</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan (Bio & Sosial Media) -->
            <div class="space-y-6">
                <!-- Box Tentang Hunter -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Tentang Hunter</h3>
                    <p class="text-sm text-gray-700">Peneliti keamanan siber independen. Berdedikasi untuk menemukan dan melaporkan celah keamanan guna menciptakan ekosistem digital yang lebih aman.</p>
                </div>

                <!-- Box Media Sosial -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Kontak & Media Sosial</h3>
                    <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="bg-blue-600 text-white p-2 rounded-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-gray-900">Hubungi via Email</div>
                            <div class="text-xs text-gray-500 truncate w-32 md:w-40">{{ $hunter->email }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ================= RIWAYAT LAPORAN (LOG) ================= -->
        <div class="mt-8 bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Riwayat Temuan (Log Laporan)</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50/50">
                        <tr>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider">Tanggal Lapor</th>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider">Kategori Kerentanan</th>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider">Status Validasi</th>
                            <th scope="col" class="px-4 py-3 font-bold tracking-wider text-right">Poin Reward</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($hunter->laporans()->orderBy('created_at', 'desc')->get() as $laporan)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-4 py-4 whitespace-nowrap text-gray-500 text-xs font-medium">
                                {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4 font-bold text-gray-800">
                                {{ $laporan->jenis_kerentanan }}
                            </td>
                            <td class="px-4 py-4">
                                @if($laporan->status === 'Valid')
                                    <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-600 text-xs font-bold px-2.5 py-1 rounded-md border border-emerald-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Valid
                                    </span>
                                @elseif($laporan->status === 'Menunggu')
                                    <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-600 text-xs font-bold px-2.5 py-1 rounded-md border border-amber-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Proses
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-red-50 text-red-600 text-xs font-bold px-2.5 py-1 rounded-md border border-red-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-right font-black text-blue-600">
                                +{{ $laporan->poin_diberikan ?? 0 }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center">
                                <div class="text-gray-400 mb-1">Belum ada riwayat laporan yang tercatat.</div>
                                <div class="text-xs text-gray-300">Aktivitas Hunter ini masih kosong.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    <!-- INI ADALAH PENUTUP DARI max-w-6xl YANG SUDAH ADA SEBELUMNYA -->
    </div>
    <!-- JANGAN DIHAPUS </div> YANG DI ATAS INI YAA -->

</body>
</html>

</body>
</html>