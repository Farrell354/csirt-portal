<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan - JatimProv-CSIRT</title>
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
                    <h1 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight mb-4">Layanan JatimProv-CSIRT</h1>
                    <p class="text-lg text-gray-600">Kerangka kerja profesional dalam manajemen, penanggulangan, dan pemulihan insiden keamanan siber di lingkungan pemerintahan.</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            
            <!-- Deskripsi Pembuka -->
            <div class="mb-16">
                <div class="border-l-4 border-kominfo pl-6 py-2">
                    <p class="text-base text-gray-700 leading-relaxed max-w-4xl">
                        Gov-CSIRT Indonesia berkomitmen untuk membantu konstituen dalam melakukan penanggulangan dan pemulihan insiden keamanan siber secara komprehensif, dengan fokus pada tiga pilar utama manajemen insiden:
                    </p>
                </div>
            </div>

            <!-- Kartu Layanan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                
                <!-- Layanan 1 -->
                <div class="group border border-gray-200 p-8 bg-white hover:border-kominfo transition-colors duration-300 relative">
                    <div class="text-6xl font-black text-gray-100 absolute top-6 right-6 pointer-events-none transition-colors group-hover:text-blue-50">01</div>
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold text-slate-900 mb-1">5.1.1. Triase Insiden</h3>
                        <p class="text-xs font-bold text-kominfo uppercase tracking-widest mb-6">Incident Triage</p>
                        <ul class="space-y-4 text-sm text-gray-600">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-kominfo mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="leading-relaxed">Memastikan kebenaran insiden dan pelapor.</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-kominfo mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="leading-relaxed">Menilai dampak dan menetapkan prioritas penanganan insiden.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Layanan 2 -->
                <div class="group border border-gray-200 p-8 bg-white hover:border-kominfo transition-colors duration-300 relative">
                    <div class="text-6xl font-black text-gray-100 absolute top-6 right-6 pointer-events-none transition-colors group-hover:text-blue-50">02</div>
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold text-slate-900 mb-1">5.1.2. Koordinasi Insiden</h3>
                        <p class="text-xs font-bold text-kominfo uppercase tracking-widest mb-6">Incident Coordination</p>
                        <ul class="space-y-4 text-sm text-gray-600">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-kominfo mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="leading-relaxed">Mengkoordinasikan insiden dengan konstituen secara real-time.</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-kominfo mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="leading-relaxed">Menentukan dan menganalisis kemungkinan penyebab insiden.</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-kominfo mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="leading-relaxed">Memberikan rekomendasi penanggulangan berdasarkan SOP.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Layanan 3 -->
                <div class="group border border-gray-200 p-8 bg-white hover:border-kominfo transition-colors duration-300 relative">
                    <div class="text-6xl font-black text-gray-100 absolute top-6 right-6 pointer-events-none transition-colors group-hover:text-blue-50">03</div>
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold text-slate-900 mb-1">5.1.3. Resolusi Insiden</h3>
                        <p class="text-xs font-bold text-kominfo uppercase tracking-widest mb-6">Incident Resolution</p>
                        <ul class="space-y-4 text-sm text-gray-600">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-kominfo mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="leading-relaxed">Melakukan investigasi mendalam dan analisis dampak insiden.</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-kominfo mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="leading-relaxed">Memberikan rekomendasi teknis untuk fase pemulihan pasca insiden.</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-kominfo mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="leading-relaxed">Audit dan perbaikan kelemahan arsitektur sistem.</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Call to Action -->
            <div class="bg-slate-900 p-8 sm:p-10 border-l-4 border-kominfo shadow-xl">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex-1">
                        <h4 class="text-white text-lg font-bold mb-2">Sentra Informasi Keamanan Siber</h4>
                        <p class="text-gray-400 text-sm leading-relaxed mb-4">
                            Gov-CSIRT Indonesia secara rutin menyajikan data statistik mengenai insiden yang terjadi pada sektor pemerintah. Kami hadir sebagai pusat rujukan informasi keamanan siber.
                        </p>
                        <p class="text-gray-300 font-medium text-sm">
                            Menemukan indikasi celah keamanan atau insiden?
                        </p>
                    </div>
                    <a href="/kontak" class="bg-kominfo hover:bg-kominfo_dark text-white px-8 py-3 text-sm font-semibold transition-colors whitespace-nowrap">
                        Lapor Insiden Sekarang
                    </a>
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