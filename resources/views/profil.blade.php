<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - JatimProv-CSIRT</title>
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
                    <h1 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight mb-4">Profil JatimProv-CSIRT</h1>
                    <p class="text-lg text-gray-600">Garda terdepan dalam menjaga keamanan informasi dan ruang siber institusi Pemerintah Provinsi Jawa Timur.</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            
            <!-- Deskripsi Institusi -->
            <div class="mb-20">
                <div class="border-l-4 border-kominfo pl-6 py-2">
                    <p class="text-base text-gray-700 leading-relaxed max-w-4xl mb-4">
                        <strong class="text-slate-900">Jawa Timur Province Computer Security Incident Response Team (JatimProv-CSIRT)</strong> dipimpin dan dipertanggungjawabkan langsung oleh Kepala Dinas Komunikasi dan Informatika Provinsi Jawa Timur.
                    </p>
                    <p class="text-base text-gray-700 leading-relaxed max-w-4xl">
                        Keanggotaan tim dari JatimProv-CSIRT terdiri atas seluruh staf teknis Seksi Persandian dan Keamanan Informasi, yang didedikasikan penuh untuk memastikan keandalan serta keamanan sistem elektronik pemerintah daerah.
                    </p>
                </div>
            </div>

            <!-- Visi/Misi -->
            <div class="mb-20">
                <h2 class="text-2xl font-bold text-slate-900 mb-8 border-b border-gray-200 pb-4">Misi Pembentukan</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Misi 1 -->
                    <div class="group border border-gray-200 p-8 bg-white hover:border-kominfo transition-colors duration-300 relative">
                        <div class="text-6xl font-black text-gray-100 absolute top-6 right-6 pointer-events-none transition-colors group-hover:text-blue-50">01</div>
                        <div class="relative z-10">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Sistem Mitigasi & Operasi</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Membangun, mengkoordinasikan, mengolaborasikan dan mengoperasionalkan sistem mitigasi, manajemen krisis, penanggulangan dan pemulihan terhadap insiden keamanan siber pada lingkungan Pemerintah Provinsi Jawa Timur.
                            </p>
                        </div>
                    </div>

                    <!-- Misi 2 -->
                    <div class="group border border-gray-200 p-8 bg-white hover:border-kominfo transition-colors duration-300 relative">
                        <div class="text-6xl font-black text-gray-100 absolute top-6 right-6 pointer-events-none transition-colors group-hover:text-blue-50">02</div>
                        <div class="relative z-10">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Sinergi & Kerja Sama</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Membangun kerja sama strategis dalam rangka penanggulangan dan pemulihan insiden keamanan siber lintas sektoral di lingkungan Pemerintah Provinsi Jawa Timur guna menciptakan ekosistem siber yang tangguh.
                            </p>
                        </div>
                    </div>

                    <!-- Misi 3 -->
                    <div class="group border border-gray-200 p-8 bg-white hover:border-kominfo transition-colors duration-300 relative">
                        <div class="text-6xl font-black text-gray-100 absolute top-6 right-6 pointer-events-none transition-colors group-hover:text-blue-50">03</div>
                        <div class="relative z-10">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Peningkatan Kapasitas</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Membangun dan meningkatkan kapasitas sumber daya manusia (SDM) serta infrastruktur penanggulangan dan pemulihan insiden keamanan siber yang andal di lingkungan Pemerintah Provinsi Jawa Timur.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konstituen -->
            <div class="bg-slate-900 p-8 sm:p-10 border-l-4 border-kominfo shadow-xl">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex-1">
                        <h4 class="text-white text-lg font-bold mb-3">Konstituen JatimProv-CSIRT</h4>
                        <p class="text-gray-400 text-sm leading-relaxed max-w-4xl">
                            Ruang lingkup dan konstituen layanan perlindungan kami meliputi seluruh <strong class="text-gray-200">Satuan Kerja Perangkat Daerah (SKPD)</strong> di lingkungan Provinsi Jawa Timur, serta entitas Kabupaten/Kota yang terintegrasi dan menggunakan layanan infrastruktur Data Center Provinsi Jawa Timur.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER SECTION -->
    <footer class="bg-footer_bg text-gray-400 py-16 border-t border-gray-800 w-full">
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
                        <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg> Jl. Ahmad Yani 242-244 Surabaya</li>
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