<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IoC - JatimProv-CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { colors: { kominfo: '#0056B3', kominfo_dark: '#0A3A64', accent: '#F59E0B', footer_bg: '#161b22' } } }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 font-sans flex flex-col min-h-screen">

    <x-navbar />

    <div class="flex-grow bg-white dark:bg-slate-900 transition-colors duration-300">
        <div class="bg-slate-50 dark:bg-slate-800/50 border-b border-gray-200 dark:border-slate-700 py-16 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <h1 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white tracking-tight mb-4">Dokumen Indicator of Compromise (IoC)</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400">Daftar artefak teknis, alamat IP, hash, dan domain berbahaya sebagai indikator kompromi keamanan siber di lingkungan Provinsi Jawa Timur.</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-sm overflow-hidden shadow-sm transition-colors duration-300">
                <div class="p-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/80 flex justify-between items-center transition-colors duration-300">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-gray-300">Daftar Dokumen IoC</h2>
                    <div class="relative">
                        <input type="text" placeholder="Cari dokumen IoC..." class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-sm px-4 py-2 rounded-sm outline-none focus:border-kominfo dark:focus:border-blue-500 transition-colors w-64 text-gray-700 dark:text-gray-200">
                        <svg class="w-4 h-4 absolute right-3 top-2.5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-100 dark:bg-slate-700/50 border-b border-gray-200 dark:border-slate-700">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-bold w-16">No</th>
                                <th scope="col" class="px-6 py-4 font-bold">Nama Dokumen</th>
                                <th scope="col" class="px-6 py-4 font-bold w-32 text-right">Ukuran</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                            
                            <!-- Baris 1 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">1</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=Ungkap Aktivitas APT Turla, Lebih dari 107 Ribu Indikasi Kompromi Terdeteksi di Indonesia - File Pendukung.pdf&judul=Ungkap Aktivitas APT Turla" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Ungkap Aktivitas APT Turla, Lebih dari 107 Ribu Indikasi Kompromi Terdeteksi di Indonesia
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">1,245 KB</td>
                            </tr>

                            <!-- Baris 2 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">2</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=Ransomware Berbasis AI Otonom Pertama Terungkap, Mampu Menyerang Tanpa Campur Tangan Manusia - File Pendukung.pdf&judul=Ransomware Berbasis AI Otonom" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Ransomware Berbasis AI Otonom Pertama Terungkap, Mampu Menyerang Tanpa Campur Tangan Manusia
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">890 KB</td>
                            </tr>

                            <!-- Baris 3 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">3</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=Ekstensi Microsoft Edge Berbahaya Jadi Senjata Baru Sebar Ransomware, Pengguna Diminta Waspada - File Pendukung.pdf&judul=Ekstensi Microsoft Edge Berbahaya" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Ekstensi Microsoft Edge Berbahaya Jadi Senjata Baru Sebar Ransomware, Pengguna Diminta Waspada
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">1,432 KB</td>
                            </tr>

                            <!-- Baris 4 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">4</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=Ransomware VECT 2.0 Disebut Rusak, File Korban Justru Tak Bisa Dipulihkan Permanen - File Pendukung.pdf&judul=Ransomware VECT 2.0" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Ransomware VECT 2.0 Disebut Rusak, File Korban Justru Tak Bisa Dipulihkan Permanen
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">985 KB</td>
                            </tr>

                            <!-- Baris 5 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">5</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=Warning! Malware ShadowPad 'Berevolusi', Gandeng Ransomware Baru NailaoLocker Serang Jaringan Global - File Pendukung.pdf&judul=Malware ShadowPad Berevolusi" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Warning! Malware ShadowPad 'Berevolusi', Gandeng Ransomware Baru NailaoLocker Serang Jaringan Global
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">2,104 KB</td>
                            </tr>

                            <!-- Baris 6 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">6</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=Canggih dan Ganas, Begini Cara Kerja LockBit 5 Kelabui Sistem Keamanan - File Pendukung.pdf&judul=Cara Kerja LockBit 5" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Canggih dan Ganas, Begini Cara Kerja LockBit 5 Kelabui Sistem Keamanan
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">1,750 KB</td>
                            </tr>

                            <!-- Baris 7 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">7</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=TA584 Gencar Serang Korban Global, Andalkan ClickFix dan Tsundere Bot - File Pendukung.pdf&judul=TA584 Gencar Serang Korban Global" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        TA584 Gencar Serang Korban Global, Andalkan ClickFix dan Tsundere Bot
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">832 KB</td>
                            </tr>

                            <!-- Baris 8 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">8</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=Jejak Evolusi Akira Ransomware: Dari Taktik 2024 hingga Jadi Organisasi Kriminal Matang di 2026 - File Pendukung.pdf&judul=Jejak Evolusi Akira Ransomware" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Jejak Evolusi Akira Ransomware: Dari Taktik 2024 hingga Jadi Organisasi Kriminal Matang di 2026
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">3,120 KB</td>
                            </tr>

                            <!-- Baris 9 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">9</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=Qilin : Ransomware-as-a-Service yang Menargetkan Windows dan Linux - File Pendukung.pdf&judul=Qilin Ransomware-as-a-Service" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Qilin : Ransomware-as-a-Service yang Menargetkan Windows dan Linux
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">1,675 KB</td>
                            </tr>

                            <!-- Baris 10 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">10</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=Penjahat Siber Memanfaatkan Popularitas DeepSeek AI - File Pendukung.pdf&judul=Penjahat Siber Memanfaatkan DeepSeek AI" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Penjahat Siber Memanfaatkan Popularitas DeepSeek AI
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">945 KB</td>
                            </tr>

                            <!-- Baris 11 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">11</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=GHOST RANSOMWARE   ANCAMAN GLOBAL PADA INFRASTRUKTUR KRITIS - File Pendukung .pdf&judul=GHOST RANSOMWARE" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        GHOST RANSOMWARE - ANCAMAN GLOBAL PADA INFRASTRUKTUR KRITIS
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">1,820 KB</td>
                            </tr>

                            <!-- Baris 12 -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">12</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/ioc/lihat?file=Lumma Stealer, Malware Stealer dengan Pemanfaatan Halaman CAPTCHA Palsu - File Pendukung.pdf&judul=Lumma Stealer CAPTCHA Palsu" target="_blank" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Lumma Stealer, Malware Stealer dengan Pemanfaatan Halaman CAPTCHA Palsu
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">1,115 KB</td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/80 text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300">
                    Menampilkan 1 hingga 12 dari 12 dokumen.
                </div>
            </div>
        </div>
    </div>

    <x-footer />
    <x-chatbot />
    
    <script>
        if (localStorage.getItem('theme') === 'dark' || localStorage.getItem('color-theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>