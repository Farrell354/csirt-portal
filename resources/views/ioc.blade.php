<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IoC - JatimProv-CSIRT</title>
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen overflow-x-hidden selection:bg-cyan-500 selection:text-white">

    <!-- Latar Belakang Mesh Grid & Ambient Glow (Mewarisi style dari app.css) -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-40 dark:opacity-100 z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <!-- NAVBAR -->
    <div class="relative z-50">
        <x-navbar />
    </div>

    <!-- KONTEN UTAMA -->
    <div class="flex-grow relative z-10 flex flex-col items-center w-full pt-12 pb-24">
        
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- ================= HEADER HALAMAN ================= -->
            <div class="text-center mb-12 opacity-0 animate-fade-in-up">
                <!-- Cyber Badge -->
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-cyan-500/30 text-blue-600 dark:text-cyan-400 text-xs font-bold tracking-widest uppercase rounded-full backdrop-blur-md shadow-sm dark:shadow-[0_0_15px_rgba(6,182,212,0.15)] animate-float-subtle mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500 shadow-[0_0_8px_#ef4444]"></span>
                    </span>
                    THREAT_INTEL_DB
                </div>
                
                <!-- Judul Besar -->
                <h1 class="font-display text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight mb-4">
                    Dokumen <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-cyan-400 dark:to-blue-500">Indicator of Compromise</span>
                </h1>
                
                <!-- Deskripsi Pendek -->
                <p class="text-sm md:text-base text-gray-500 dark:text-slate-400 font-medium max-w-3xl mx-auto leading-relaxed">
                    Daftar artefak teknis, alamat IP, hash, dan domain berbahaya sebagai indikator kompromi keamanan siber di lingkungan Provinsi Jawa Timur.
                </p>
            </div>

            <!-- ================= AREA TABEL DOKUMEN (Glassmorphism) ================= -->
            <div class="w-full opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-3xl shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.5)] border border-gray-200/50 dark:border-slate-700/80 overflow-hidden relative group">
                    
                    <!-- Garis Neon Atas -->
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 via-orange-400 to-red-500"></div>

                    <!-- Header Tabel & Search Bar -->
                    <div class="p-6 md:p-8 border-b border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-[#020817]/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 transition-colors duration-300">
                        <h2 class="text-sm font-black uppercase tracking-widest text-slate-800 dark:text-gray-200 flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                            Arsip Dokumen IoC
                        </h2>
                        
                        <!-- Search Input ala Terminal -->
                        <div class="relative w-full md:w-80 group/search">
                            <input type="text" placeholder="Cari payload, CVE, atau jenis ancaman..." class="w-full bg-white dark:bg-slate-950 border border-gray-200 dark:border-slate-700/80 text-sm px-5 py-2.5 rounded-xl outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500 transition-all text-gray-700 dark:text-gray-200 shadow-sm placeholder-gray-400">
                            <svg class="w-4 h-4 absolute right-4 top-3 text-gray-400 group-focus-within/search:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>

                    <!-- Isi Tabel -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
                            <thead class="text-xs text-gray-500 dark:text-gray-400 uppercase bg-gray-50/80 dark:bg-slate-800/40 border-b border-gray-100 dark:border-slate-800 font-mono tracking-widest">
                                <tr>
                                    <th scope="col" class="px-8 py-5 font-bold w-20 text-center">No</th>
                                    <th scope="col" class="px-6 py-5 font-bold">Nama Indikator / Laporan Ancaman</th>
                                    <th scope="col" class="px-8 py-5 font-bold w-32 text-right">Ukuran</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-slate-800/80">
                                
                                <!-- Komponen Baris Tabel (Looping Data Lebih Rapih) -->
                                @php
                                    $ioc_docs = [
                                        ['file' => 'Ungkap Aktivitas APT Turla, Lebih dari 107 Ribu Indikasi Kompromi Terdeteksi di Indonesia - File Pendukung.pdf', 'judul' => 'Ungkap Aktivitas APT Turla, Lebih dari 107 Ribu Indikasi Kompromi Terdeteksi di Indonesia', 'size' => '1,245 KB'],
                                        ['file' => 'Ransomware Berbasis AI Otonom Pertama Terungkap, Mampu Menyerang Tanpa Campur Tangan Manusia - File Pendukung.pdf', 'judul' => 'Ransomware Berbasis AI Otonom Pertama Terungkap, Mampu Menyerang Tanpa Campur Tangan Manusia', 'size' => '890 KB'],
                                        ['file' => 'Ekstensi Microsoft Edge Berbahaya Jadi Senjata Baru Sebar Ransomware, Pengguna Diminta Waspada - File Pendukung.pdf', 'judul' => 'Ekstensi Microsoft Edge Berbahaya Jadi Senjata Baru Sebar Ransomware', 'size' => '1,432 KB'],
                                        ['file' => 'Ransomware VECT 2.0 Disebut Rusak, File Korban Justru Tak Bisa Dipulihkan Permanen - File Pendukung.pdf', 'judul' => 'Ransomware VECT 2.0 Disebut Rusak, File Korban Justru Tak Bisa Dipulihkan Permanen', 'size' => '985 KB'],
                                        ['file' => 'Warning! Malware ShadowPad \'Berevolusi\', Gandeng Ransomware Baru NailaoLocker Serang Jaringan Global - File Pendukung.pdf', 'judul' => 'Warning! Malware ShadowPad \'Berevolusi\', Gandeng Ransomware Baru NailaoLocker', 'size' => '2,104 KB'],
                                        ['file' => 'Canggih dan Ganas, Begini Cara Kerja LockBit 5 Kelabui Sistem Keamanan - File Pendukung.pdf', 'judul' => 'Canggih dan Ganas, Begini Cara Kerja LockBit 5 Kelabui Sistem Keamanan', 'size' => '1,750 KB'],
                                        ['file' => 'TA584 Gencar Serang Korban Global, Andalkan ClickFix dan Tsundere Bot - File Pendukung.pdf', 'judul' => 'TA584 Gencar Serang Korban Global, Andalkan ClickFix dan Tsundere Bot', 'size' => '832 KB'],
                                        ['file' => 'Jejak Evolusi Akira Ransomware: Dari Taktik 2024 hingga Jadi Organisasi Kriminal Matang di 2026 - File Pendukung.pdf', 'judul' => 'Jejak Evolusi Akira Ransomware: Dari Taktik 2024 hingga Jadi Organisasi Kriminal Matang di 2026', 'size' => '3,120 KB'],
                                        ['file' => 'Qilin : Ransomware-as-a-Service yang Menargetkan Windows dan Linux - File Pendukung.pdf', 'judul' => 'Qilin : Ransomware-as-a-Service yang Menargetkan Windows dan Linux', 'size' => '1,675 KB'],
                                        ['file' => 'Penjahat Siber Memanfaatkan Popularitas DeepSeek AI - File Pendukung.pdf', 'judul' => 'Penjahat Siber Memanfaatkan Popularitas DeepSeek AI', 'size' => '945 KB'],
                                        ['file' => 'GHOST RANSOMWARE   ANCAMAN GLOBAL PADA INFRASTRUKTUR KRITIS - File Pendukung .pdf', 'judul' => 'GHOST RANSOMWARE - ANCAMAN GLOBAL PADA INFRASTRUKTUR KRITIS', 'size' => '1,820 KB'],
                                        ['file' => 'Lumma Stealer, Malware Stealer dengan Pemanfaatan Halaman CAPTCHA Palsu - File Pendukung.pdf', 'judul' => 'Lumma Stealer, Malware Stealer dengan Pemanfaatan Halaman CAPTCHA Palsu', 'size' => '1,115 KB']
                                    ];
                                @endphp

                                @foreach($ioc_docs as $index => $doc)
                                <tr class="hover:bg-red-50/50 dark:hover:bg-slate-800/50 transition-colors duration-300 group relative">
                                    <!-- Aksen garis kiri saat di hover -->
                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    
                                    <td class="px-8 py-5 font-mono text-xs font-bold text-slate-400 dark:text-slate-500 text-center group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="px-6 py-5">
                                        <a href="/ioc/lihat?file={{ $doc['file'] }}&judul={{ urlencode($doc['judul']) }}" target="_blank" class="inline-flex items-center gap-3 font-semibold text-slate-800 dark:text-gray-200 hover:text-blue-600 dark:hover:text-cyan-400 transition-colors leading-relaxed">
                                            <div class="p-2 bg-gray-100 dark:bg-slate-900 rounded-lg group-hover:bg-red-100 dark:group-hover:bg-red-900/30 transition-colors shrink-0">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 group-hover:text-red-600 dark:group-hover:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                            </div>
                                            <span class="group-hover:translate-x-1 transition-transform duration-300">{{ $doc['judul'] }}</span>
                                        </a>
                                    </td>
                                    <td class="px-8 py-5 text-right font-mono text-xs text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-gray-200 transition-colors">
                                        {{ $doc['size'] }}
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <!-- Footer Tabel -->
                    <div class="p-5 border-t border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-[#020817]/50 text-xs font-mono font-bold uppercase tracking-widest text-gray-400 dark:text-slate-500 text-center transition-colors duration-300">
                        Menampilkan 1 hingga 12 dari 12 dokumen IoC.
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <x-footer />

    <!-- CHATBOT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

    <!-- SCRIPT OBSERVER UNTUK ANIMASI SCROLL -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const observerOptions = { root: null, rootMargin: '0px', threshold: 0.15 };
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-on-scroll', 'is-visible', 'animate-fade-in-up');
                        entry.target.classList.remove('reveal-on-scroll', 'opacity-0');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-on-scroll, .opacity-0.animate-fade-in-up').forEach(el => {
                if(!el.classList.contains('mb-12') && !el.classList.contains('w-full')) {
                    observer.observe(el);
                } else {
                    setTimeout(() => el.style.opacity = '1', 500);
                }
            });
        });
    </script>
</body>
</html>