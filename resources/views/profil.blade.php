<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - JatimProv-CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
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

    <x-footer />

    <!-- WIDGET CHATBOT CSIRT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
<x-chatbot />
</html>