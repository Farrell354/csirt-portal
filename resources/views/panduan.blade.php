<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan - JatimProv-CSIRT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        kominfo: '#0056B3',
                        kominfo_dark: '#0A3A64',
                        accent: '#F59E0B',
                        footer_bg: '#161b22'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 transition-colors duration-300 font-sans flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <x-navbar />

    <!-- KONTEN UTAMA -->
    <div class="flex-grow bg-white">
        
        <!-- HEADER HALAMAN -->
        <div class="bg-slate-50 border-b border-gray-200 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <h1 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight mb-4">Panduan Penanganan Insiden Siber</h1>
                    <p class="text-lg text-gray-600">Dokumen Standar Operasional Prosedur (SOP) dan langkah mitigasi teknis untuk konstituen JatimProv-CSIRT.</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            
            <!-- Tabel Data -->
            <div class="bg-white border border-gray-200 rounded-sm overflow-hidden shadow-sm">
                
                <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-slate-700">Daftar Dokumen</h2>
                    <div class="relative">
                        <input type="text" placeholder="Cari dokumen..." class="bg-white border border-gray-300 text-sm px-4 py-2 rounded-sm outline-none focus:border-kominfo transition-colors w-64 text-gray-700">
                        <svg class="w-4 h-4 absolute right-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-bold w-16">No</th>
                                <th scope="col" class="px-6 py-4 font-bold">Nama Dokumen</th>
                                <th scope="col" class="px-6 py-4 font-bold w-32 text-right">Ukuran</th>
                                <th scope="col" class="px-6 py-4 font-bold w-24 text-center">Unduh</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <!-- Baris 1 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">1</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Panduan Penanganan Insiden Serangan SQL Injection</td>
                                <td class="px-6 py-4 text-right">812 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/Panduan-Penanganan-Insiden-Serangan-SQL-Injection.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 2 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">2</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Panduan Penanganan Insiden Web Defacement</td>
                                <td class="px-6 py-4 text-right">1,096 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/Panduan-Penanganan-Insiden-Web-Defacement.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 3 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">3</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Panduan Penanganan Insiden Serangan DDoS</td>
                                <td class="px-6 py-4 text-right">858 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/Panduan-Penanganan-Insiden-Serangan-DDoS.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 4 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">4</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Panduan Penanganan Insiden Serangan Phishing</td>
                                <td class="px-6 py-4 text-right">946 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/Panduan-Penanganan-Insiden-Serangan-Phishing.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 5 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">5</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Panduan Penanganan Insiden Malware</td>
                                <td class="px-6 py-4 text-right">665 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/Panduan-Penanganan-Insiden-Malware.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 6 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">6</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Panduan Penanganan Ransomware</td>
                                <td class="px-6 py-4 text-right">1,072 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/Panduan-Penanganan-Insiden-Ransom-sign.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 7 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">7</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Panduan Pelaporan Insiden (Template)</td>
                                <td class="px-6 py-4 text-right">112 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/Insiden Keamanan Informasi - TEMPLATE.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 8 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">8</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Panduan Manajemen Risiko Keamanan Di Tengah Pandemi COVID-19</td>
                                <td class="px-6 py-4 text-right">561 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/Panduan-Manajemen-Risiko-Keamanan-Di-Tengah-Pandemi-COVID--19.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 9 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">9</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Panduan Penggunaan OPENPGP</td>
                                <td class="px-6 py-4 text-right">9,824 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/PANDUAN-PENGGUNAAN-OPENPGP.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 10 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">10</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Panduan Menghadapi Insiden Data Breach (BSSN)</td>
                                <td class="px-6 py-4 text-right">8,354 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/BSSN - Panduan Menghadapi Insiden Data Breach.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 11 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">11</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Perbaikan dan Mitigasi Insiden Website Judi Online</td>
                                <td class="px-6 py-4 text-right">2,565 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/Perbaikan dan Mitigasi Insiden Website Judi Online.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 12 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">12</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Panduan Penanganan Insiden Web Defacement Judi Online</td>
                                <td class="px-6 py-4 text-right">1,794 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/Panduan_Penanganan_Insiden_Web_Defacement_Judi_Online.pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 13 -->
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900">13</td>
                                <td class="px-6 py-4 font-semibold text-kominfo">Lanskap Top 5 Kerentanan 2025 (Public)</td>
                                <td class="px-6 py-4 text-right">15,809 KB</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('dokumen/LANSKAP ITSA 2025 (Public).pdf') }}" target="_blank" download class="inline-block text-gray-400 hover:text-kominfo transition-colors" title="Unduh File">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Tabel -->
                <div class="p-4 border-t border-gray-200 bg-gray-50 text-xs text-gray-500">
                    Menampilkan 1 hingga 13 dari 13 dokumen.
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER SECTION -->
    <footer class="bg-footer_bg text-gray-400 py-16 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-widest mb-6 border-b border-gray-700 pb-2">Kategori</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 bg-kominfo"></span> Peringatan Keamanan</a></li>
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 bg-kominfo"></span> Berita Keamanan Siber</a></li>
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 bg-kominfo"></span> Panduan Mitigasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-widest mb-6 border-b border-gray-700 pb-2">Artikel Terkini</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-white transition line-clamp-2">Ungkap Aktivitas APT Turla, Lebih dari 107 Ribu Indikasi Kompromi...</a></li>
                        <li><a href="#" class="hover:text-white transition line-clamp-2">Ransomware Berbasis AI Otonom Pertama Terungkap...</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-widest mb-6 border-b border-gray-700 pb-2">Kontak Kami</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Jl. Ahmad Yani 242-244 Surabaya</li>
                        <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> csirt@jatimprov.go.id</li>
                        <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> (031) 8294608</li>
                    </ul>
                </div>
                <div>
                    <div class="w-full h-40 rounded-sm overflow-hidden border border-gray-700 bg-gray-800">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.387132177435!2d112.7301073147752!3d-7.310323394723932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbaa4c8a5a4b%3A0xc6c7619eb1899134!2sDinas%20Komunikasi%20dan%20Informatika%20Provinsi%20Jawa%20Timur!5e0!3m2!1sen!2sid!4v1680000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-xs tracking-widest uppercase">
                <p>Copyright &copy; 2026 <span class="font-bold text-gray-200">JatimProv-CSIRT</span>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WIDGET CHATBOT CSIRT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
<x-chatbot />
</html>