<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Laporan - JatimProv CSIRT</title>
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-indigo-500 selection:text-white">

    <!-- Latar Belakang Mesh Grid & Ambient Glow -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 animate-grid-flow z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-indigo-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <div class="flex-grow max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10 pt-16">
        
        <!-- ================= HEADER & TOMBOL KEMBALI ================= -->
        <div class="mb-10 opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            <a href="/dashboard" class="inline-flex items-center text-xs font-bold text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 mb-6 transition-transform hover:-translate-x-2 duration-300 uppercase tracking-widest bg-white/50 dark:bg-slate-900/50 px-4 py-2 rounded-full border border-gray-200 dark:border-slate-800 backdrop-blur-sm shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Dashboard
            </a>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <!-- Cyber Badge -->
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-200 dark:border-indigo-800/50 text-indigo-600 dark:text-indigo-400 font-mono text-[10px] font-bold tracking-widest mb-4 uppercase rounded-full shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                        </span>
                        DATA_CLEARANCE
                    </div>
                    <h1 class="font-display text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-2 drop-shadow-sm">Verifikasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-500 dark:from-indigo-400 dark:to-violet-400">Laporan</span></h1>
                    <p class="text-gray-500 dark:text-gray-400 font-medium text-sm md:text-base max-w-2xl">Tinjau artefak, validasi kerentanan, dan distribusikan poin reputasi secara proporsional kepada para analis.</p>
                </div>
                
                <!-- TOMBOL CETAK LAPORAN -->
                <a href="/admin/laporan/cetak" target="_blank" class="group/btn relative inline-flex items-center justify-center bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-500 hover:to-teal-400 text-white text-sm font-bold py-3.5 px-6 rounded-xl transition-all shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:shadow-[0_0_25px_rgba(16,185,129,0.5)] hover:-translate-y-1 overflow-hidden shrink-0">
                    <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover/btn:-translate-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    </span>
                    <span class="transition-all duration-300 ease-out group-hover/btn:-translate-x-4 flex items-center gap-2">
                        <svg class="w-5 h-5 group-hover/btn:opacity-0 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Cetak Rekap (PDF)
                    </span>
                </a>
            </div>
        </div>

        <!-- Notifikasi Sukses Validasi -->
        @if(session('pesan'))
            <div class="mb-8 bg-emerald-50/90 dark:bg-emerald-900/30 backdrop-blur-md border border-emerald-400/50 dark:border-emerald-700/50 text-emerald-700 dark:text-emerald-400 px-5 py-4 rounded-2xl flex items-center gap-4 shadow-lg opacity-0 animate-fade-in-up">
                <div class="p-2 bg-emerald-100 dark:bg-emerald-800/50 rounded-lg shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-bold text-sm tracking-wide">{{ session('pesan') }}</span>
            </div>
        @endif

        <!-- ================= DAFTAR LAPORAN (KARTU DINAMIS) ================= -->
        <div class="space-y-8">
            @forelse($laporans as $index => $laporan)
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2rem] shadow-lg hover:shadow-2xl dark:shadow-[0_10px_30px_rgba(0,0,0,0.3)] border border-gray-200/50 dark:border-slate-700/80 overflow-hidden transition-all duration-500 opacity-0 animate-fade-in-up relative group" style="animation-delay: {{ 0.2 + ($index * 0.1) }}s;">
                    
                    <!-- Garis Neon Indikator Atas (Warna berubah sesuai status) -->
                    @if($laporan->status === 'Menunggu')
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 to-amber-600"></div>
                    @elseif($laporan->status === 'Valid')
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-emerald-600"></div>
                    @else
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-red-600"></div>
                    @endif

                    <!-- Header Card -->
                    <div class="p-6 md:px-8 md:py-6 border-b border-gray-100 dark:border-slate-800/80 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gray-50/50 dark:bg-slate-950/30 transition-colors">
                        <div>
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="px-2.5 py-1 bg-gray-200 dark:bg-slate-800 text-gray-700 dark:text-gray-300 text-[10px] font-black uppercase tracking-widest rounded-md border border-gray-300 dark:border-slate-700 font-mono shadow-sm">
                                    ID: #{{ strtoupper(substr((string) $laporan->id, 0, 8)) }}
                                </span>
                                <span class="text-[11px] font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    {{ $laporan->jenis_kerentanan }}
                                </span>
                            </div>
                            <h3 class="font-mono text-lg md:text-xl font-bold text-slate-900 dark:text-white truncate max-w-2xl" title="{{ $laporan->target_url }}">
                                {{ $laporan->target_url }}
                            </h3>
                        </div>
                        <div class="shrink-0">
                            @if($laporan->status === 'Menunggu')
                                <span class="inline-flex items-center gap-1.5 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-[11px] font-black uppercase tracking-widest px-3 py-2 rounded-lg border border-amber-200 dark:border-amber-800/50 shadow-sm">
                                    <svg class="w-3.5 h-3.5 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Menunggu Review
                                </span>
                            @elseif($laporan->status === 'Valid')
                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-[11px] font-black uppercase tracking-widest px-3 py-2 rounded-lg border border-emerald-200 dark:border-emerald-800/50 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg> Valid (+{{ $laporan->poin_diberikan }} Pts)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-[11px] font-black uppercase tracking-widest px-3 py-2 rounded-lg border border-red-200 dark:border-red-800/50 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg> Ditolak
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Body Card (Isi Laporan) -->
                    <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-gray-50/50 dark:bg-slate-950/30 p-5 rounded-2xl border border-gray-100 dark:border-slate-800">
                            <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg> Dilaporkan Oleh
                            </div>
                            <div class="font-display font-bold text-lg text-slate-900 dark:text-gray-100">
                                {{ $laporan->user->name ?? 'Unknown Hunter' }}
                            </div>
                        </div>

                        <div class="bg-gray-50/50 dark:bg-slate-950/30 p-5 rounded-2xl border border-gray-100 dark:border-slate-800">
                            <div class="text-[10px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1.5 flex items-center gap-1.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> Waktu Penemuan
                            </div>
                            <div class="font-mono text-sm font-bold text-slate-800 dark:text-gray-200 mt-1">
                                {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y - H:i:s') }} <span class="text-blue-500 text-xs ml-1">WIB</span>
                            </div>
                        </div>
                        
                        <div class="md:col-span-2">
                            <div class="text-[11px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                                Deskripsi & Dampak
                            </div>
                            <div class="bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-800 p-5 rounded-2xl text-sm text-gray-700 dark:text-gray-300 leading-relaxed font-medium shadow-inner">
                                {{ $laporan->deskripsi }}
                            </div>
                        </div>

                        <!-- Terminal PoC (Proof of Concept) -->
                        <div class="md:col-span-2">
                            <div class="text-[11px] font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                Langkah Reproduksi (Proof of Concept)
                            </div>
                            <div class="rounded-2xl overflow-hidden shadow-lg border border-slate-700/80 group/terminal">
                                <div class="bg-slate-900 px-4 py-2 border-b border-slate-800 flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 rounded-full bg-red-500/80"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-yellow-500/80"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></div>
                                    <span class="ml-2 text-[10px] text-gray-500 font-mono tracking-widest">EXPLOIT_POC.TXT</span>
                                </div>
                                <div class="bg-[#020617] p-5 text-sm font-mono whitespace-pre-wrap overflow-x-auto text-emerald-400 leading-relaxed flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div class="truncate text-xs text-slate-300">
                                        <span class="text-emerald-400 font-bold">File:</span> {{ basename($laporan->bukti_poc) }}
                                    </div>
                                    <a href="/laporan/{{ $laporan->id }}/poc" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-400 border border-emerald-500/30 rounded-xl text-xs font-bold transition-all shadow-sm shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        Buka / Unduh Bukti PoC
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Area Aksi (Panel Keputusan) -->
                    <div class="p-6 md:p-8 border-t border-gray-100 dark:border-slate-800/80 bg-blue-50/30 dark:bg-[#020817]/30">
                        <form action="/admin/laporan/{{ $laporan->id }}/validasi" method="POST" class="flex flex-col sm:flex-row items-end gap-5">
                            @csrf
                            <div class="w-full sm:w-2/5">
                                <label class="block text-[11px] font-black text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest">Keputusan Intelijen</label>
                                <div class="relative">
                                    <select name="status" class="w-full px-4 py-3.5 bg-white dark:bg-slate-950/80 border border-gray-200 dark:border-slate-700 rounded-xl text-sm font-bold focus:ring-2 focus:ring-indigo-500/50 outline-none text-gray-900 dark:text-white cursor-pointer shadow-sm appearance-none">
                                        <option value="Menunggu" {{ $laporan->status == 'Menunggu' ? 'selected' : '' }}>⌛ Review Lanjutan (Pending)</option>
                                        <option value="Valid" {{ $laporan->status == 'Valid' ? 'selected' : '' }}>✅ Validasi Berhasil (Terima)</option>
                                        <option value="Ditolak" {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>❌ Invalid / Duplikat (Tolak)</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="w-full sm:w-1/4">
                                <label class="block text-[11px] font-black text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-1.5">
                                    Reward (Pts)
                                    <span class="text-indigo-500 group-hover:animate-bounce">♦</span>
                                </label>
                                <input type="number" name="poin" value="{{ $laporan->poin_diberikan ?? 0 }}" min="0" placeholder="0" class="w-full px-4 py-3.5 bg-white dark:bg-slate-950/80 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/50 outline-none text-indigo-700 dark:text-indigo-400 font-display font-black text-center shadow-sm placeholder-gray-400">
                            </div>
                            
                            <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-violet-500 hover:from-indigo-500 hover:to-violet-400 text-white font-bold py-3.5 px-8 rounded-xl transition-all shadow-[0_0_15px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(79,70,229,0.5)] hover:-translate-y-0.5 shrink-0 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Simpan Keputusan
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <!-- Tampilan Jika Kosong -->
                <div class="bg-white/50 dark:bg-slate-900/50 backdrop-blur-xl rounded-[2rem] shadow-sm border border-dashed border-gray-300 dark:border-slate-700/80 p-16 text-center opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-6 border border-gray-200 dark:border-slate-700 shadow-inner">
                        <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="font-display text-2xl font-black text-gray-900 dark:text-white mb-2 tracking-tight">Terminal Kosong</h3>
                    <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada laporan kerentanan yang masuk dari para analis intelijen (Bug Hunter).</p>
                </div>
            @endforelse

            @if($laporans->hasPages())
                <div class="mt-8">
                    {{ $laporans->links() }}
                </div>
            @endif
        </div>

    </div>

    <!-- CHATBOT -->
    <x-chatbot />

    <!-- SCRIPT OBSERVER UNTUK ANIMASI SCROLL -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const observerOptions = { root: null, rootMargin: '0px', threshold: 0.1 };
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        entry.target.classList.remove('opacity-0');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.opacity-0.animate-fade-in-up').forEach(el => {
                setTimeout(() => el.style.opacity = '1', 800);
            });
        });
    </script>
</body>
</html>