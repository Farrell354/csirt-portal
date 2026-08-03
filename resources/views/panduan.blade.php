<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan - JatimProv-CSIRT</title>
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
                    <h1 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white tracking-tight mb-4">Panduan Penanganan Insiden Siber</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400">Dokumen Standar Operasional Prosedur (SOP) dan langkah mitigasi teknis untuk konstituen JatimProv-CSIRT.</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-sm overflow-hidden shadow-sm transition-colors duration-300">
                <div class="p-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/80 flex justify-between items-center transition-colors duration-300">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-gray-300">Daftar Dokumen</h2>
                    <div class="relative">
                        <input type="text" placeholder="Cari dokumen..." class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-sm px-4 py-2 rounded-sm outline-none focus:border-kominfo dark:focus:border-blue-500 transition-colors w-64 text-gray-700 dark:text-gray-200">
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
                            <!-- Link ke sistem Viewer dinamis -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">1</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=Panduan-Penanganan-Insiden-Serangan-SQL-Injection.pdf&judul=Panduan Penanganan Insiden Serangan SQL Injection" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Panduan Penanganan Insiden Serangan SQL Injection
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">812 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">2</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=Panduan-Penanganan-Insiden-Web-Defacement.pdf&judul=Panduan Penanganan Insiden Web Defacement" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Panduan Penanganan Insiden Web Defacement
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">1,096 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">3</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=Panduan-Penanganan-Insiden-Serangan-DDoS.pdf&judul=Panduan Penanganan Insiden Serangan DDoS" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Panduan Penanganan Insiden Serangan DDoS
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">858 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">4</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=Panduan-Penanganan-Insiden-Serangan-Phishing.pdf&judul=Panduan Penanganan Insiden Serangan Phishing" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Panduan Penanganan Insiden Serangan Phishing
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">946 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">5</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=Panduan-Penanganan-Insiden-Malware.pdf&judul=Panduan Penanganan Insiden Malware" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Panduan Penanganan Insiden Malware
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">665 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">6</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=Panduan-Penanganan-Insiden-Ransom-sign.pdf&judul=Panduan Penanganan Ransomware" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Panduan Penanganan Ransomware
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">1,072 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">7</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=Insiden Keamanan Informasi - TEMPLATE.pdf&judul=Panduan Pelaporan Insiden (Template)" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Panduan Pelaporan Insiden (Template)
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">112 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">8</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=Panduan-Manajemen-Risiko-Keamanan-Di-Tengah-Pandemi-COVID--19.pdf&judul=Panduan Manajemen Risiko Keamanan Di Tengah Pandemi COVID-19" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Panduan Manajemen Risiko Keamanan Di Tengah Pandemi COVID-19
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">561 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">9</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=PANDUAN-PENGGUNAAN-OPENPGP.pdf&judul=Panduan Penggunaan OPENPGP" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Panduan Penggunaan OPENPGP
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">9,824 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">10</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=BSSN - Panduan Menghadapi Insiden Data Breach.pdf&judul=Panduan Menghadapi Insiden Data Breach (BSSN)" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Panduan Menghadapi Insiden Data Breach (BSSN)
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">8,354 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">11</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=Perbaikan dan Mitigasi Insiden Website Judi Online.pdf&judul=Perbaikan dan Mitigasi Insiden Website Judi Online" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Perbaikan dan Mitigasi Insiden Website Judi Online
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">2,565 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">12</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=Panduan_Penanganan_Insiden_Web_Defacement_Judi_Online.pdf&judul=Panduan Penanganan Insiden Web Defacement Judi Online" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Panduan Penanganan Insiden Web Defacement Judi Online
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">1,794 KB</td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200">13</td>
                                <td class="px-6 py-4 font-semibold">
                                    <a href="/panduan/lihat?file=LANSKAP ITSA 2025 (Public).pdf&judul=Lanskap Top 5 Kerentanan 2025 (Public)" class="text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 hover:underline inline-flex items-center gap-1.5 transition-colors">
                                        Lanskap Top 5 Kerentanan 2025 (Public)
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">15,809 KB</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/80 text-xs text-gray-500 dark:text-gray-400 transition-colors duration-300">
                    Menampilkan 1 hingga 13 dari 13 dokumen.
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