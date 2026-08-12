<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan CSIRT - JatimProv CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">

    <!-- Font Premium untuk UI Web -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    <!-- Memanggil Tailwind & Custom CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SCRIPT PENDETEKSI TEMA AWAL (Hanya berlaku untuk background UI) -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Style khusus print yang tidak bisa di-handle oleh class Tailwind biasa -->
    <style>
        @media print {
            @page { size: A4 portrait; margin: 15mm; }
            body { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; background: white !important; }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-cyan-500 selection:text-white print:bg-white">

    <!-- ===================================================================== -->
    <!-- LATAR BELAKANG SIBER (Disembunyikan saat dicetak) -->
    <!-- ===================================================================== -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 z-0 print:hidden"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0 print:hidden"></div>

    <!-- ===================================================================== -->
    <!-- TOMBOL NAVIGASI & AKSI (Disembunyikan saat dicetak) -->
    <!-- ===================================================================== -->
    <div class="print:hidden relative z-50 max-w-4xl mx-auto px-4 w-full mt-10 mb-6 opacity-0 animate-fade-in-up">
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-slate-800 p-4 md:p-5 rounded-2xl shadow-xl flex flex-col sm:flex-row items-center justify-between gap-4">
            
            <a href="/admin/laporan" class="inline-flex items-center text-xs font-bold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors uppercase tracking-widest w-full sm:w-auto justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            
            <button onclick="window.print()" class="group/btn relative w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-xs font-bold py-3 px-6 rounded-xl transition-all shadow-[0_0_15px_rgba(6,182,212,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.5)] hover:-translate-y-0.5 overflow-hidden uppercase tracking-widest">
                <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover/btn:-translate-x-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                </span>
                <span class="transition-all duration-300 ease-out group-hover/btn:-translate-x-4 flex items-center gap-2">
                    <svg class="w-4 h-4 group-hover/btn:opacity-0 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Dokumen
                </span>
            </button>
            
        </div>
    </div>

    <!-- ===================================================================== -->
    <!-- DOKUMEN KERTAS A4 (Dipaksa Light Mode & Font Serif untuk resmi) -->
    <!-- ===================================================================== -->
    <div class="relative z-10 w-full max-w-4xl mx-auto bg-white text-black p-10 md:p-14 min-h-[297mm] shadow-2xl dark:shadow-[0_0_40px_rgba(0,0,0,0.6)] print:shadow-none print:p-0 print:m-0 mb-20 font-serif opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
        
        <!-- KOP SURAT -->
        <div class="border-b-4 border-black pb-4 mb-8 flex items-center justify-between">
            <div class="w-24">
                <img src="{{ asset('img/logo-csirt.png') }}" alt="Logo Jatim" class="w-full h-auto">
            </div>
            <div class="text-center flex-1 px-4">
                <h1 class="text-xl font-bold uppercase tracking-wider">Pemerintah Provinsi Jawa Timur</h1>
                <h2 class="text-2xl font-black uppercase tracking-widest mt-1">Dinas Komunikasi dan Informatika</h2>
                <h3 class="text-lg font-bold mt-1">Tim Tanggap Insiden Siber (JatimProv-CSIRT)</h3>
                <p class="text-xs mt-1.5 font-sans">Jl. Ahmad Yani No. 242-244, Gayungan, Surabaya, Jawa Timur 60235</p>
                <p class="text-xs font-sans">Email: csirt@jatimprov.go.id | Telp: (031) 8294608</p>
            </div>
            <div class="w-24"></div> <!-- Spacer penyeimbang tengah -->
        </div>

        <!-- JUDUL LAPORAN -->
        <div class="text-center mb-10">
            <h3 class="text-xl font-bold uppercase underline decoration-2 underline-offset-4">Rekapitulasi Laporan Kerentanan Keamanan Siber</h3>
            <p class="text-sm mt-2 font-sans font-medium">Periode Cetak: {{ date('d F Y') }}</p>
        </div>

        <!-- TABEL DATA -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border-2 border-black mb-8 text-sm font-sans">
                <thead>
                    <tr class="bg-gray-100 text-center uppercase text-xs tracking-wider">
                        <th class="border-2 border-black p-3 w-12 font-bold">No</th>
                        <th class="border-2 border-black p-3 font-bold">Tanggal</th>
                        <th class="border-2 border-black p-3 font-bold">Pelapor (Hunter)</th>
                        <th class="border-2 border-black p-3 font-bold">Jenis Kerentanan</th>
                        <th class="border-2 border-black p-3 font-bold">Target URL</th>
                        <th class="border-2 border-black p-3 font-bold">Status</th>
                        <th class="border-2 border-black p-3 w-16 font-bold">Poin</th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    @forelse($laporans as $index => $laporan)
                    <tr class="even:bg-gray-50">
                        <td class="border border-black p-2.5 text-center font-bold">{{ $index + 1 }}</td>
                        <td class="border border-black p-2.5 whitespace-nowrap text-center">{{ \Carbon\Carbon::parse($laporan->created_at)->format('d/m/Y') }}</td>
                        <td class="border border-black p-2.5 font-bold">{{ $laporan->user->name ?? 'Anonim' }}</td>
                        <td class="border border-black p-2.5 font-medium">{{ $laporan->jenis_kerentanan }}</td>
                        <td class="border border-black p-2.5 text-blue-700 underline break-all">{{ $laporan->target_url }}</td>
                        <td class="border border-black p-2.5 text-center font-bold">
                            @if($laporan->status === 'Valid') 
                                <span class="text-emerald-700">Valid</span>
                            @elseif($laporan->status === 'Ditolak') 
                                <span class="text-red-700">Ditolak</span>
                            @else 
                                <span class="text-amber-600">Proses</span>
                            @endif
                        </td>
                        <td class="border border-black p-2.5 text-center font-black text-sm">{{ $laporan->poin_diberikan ?? 0 }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="border border-black p-6 text-center text-gray-500 font-medium italic">
                            Belum ada data laporan yang direkam dalam sistem.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TANDA TANGAN -->
        <div class="flex justify-end mt-16 font-sans">
            <div class="text-center w-64">
                <p class="mb-1">Surabaya, {{ date('d F Y') }}</p>
                <p class="font-bold">Administrator JatimProv-CSIRT,</p>
                <br><br><br><br>
                <p class="font-bold uppercase underline decoration-1 underline-offset-4">{{ auth()->user()->name ?? 'Administrator Resmi' }}</p>
                <p class="text-xs mt-1">NIP. 19801231 200501 1 001</p>
            </div>
        </div>

    </div>

    <!-- SCRIPT OBSERVER UNTUK ANIMASI SCROLL (UI Web) -->
    <script class="print:hidden">
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
                setTimeout(() => el.style.opacity = '1', 600);
            });
        });
    </script>
</body>
</html>