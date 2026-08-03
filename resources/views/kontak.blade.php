<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - JatimProv-CSIRT</title>
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
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 font-sans flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <x-navbar />

    <!-- KONTEN UTAMA -->
    <div class="flex-grow bg-white dark:bg-slate-900 transition-colors duration-300">
        
        <!-- HEADER HALAMAN -->
        <div class="bg-slate-50 dark:bg-slate-800/50 border-b border-gray-200 dark:border-slate-700 py-16 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <h1 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white tracking-tight mb-4">Hubungi Kami</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400">Pusat layanan informasi, pelaporan insiden, dan koordinasi keamanan siber Provinsi Jawa Timur.</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Kiri: Informasi Kontak -->
                <div class="space-y-10">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6 border-b border-gray-200 dark:border-slate-700 pb-4">Informasi Kontak JatimProv-CSIRT</h2>
                        
                        <div class="space-y-6">
                            <!-- Alamat -->
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-gray-100 dark:bg-slate-800 flex items-center justify-center rounded-sm mr-4 shrink-0 text-kominfo dark:text-blue-400 border border-gray-200 dark:border-slate-700 transition-colors duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 dark:text-gray-200 text-base">Lokasi / Alamat</h3>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1 leading-relaxed">
                                        Dinas Komunikasi dan Informatika Provinsi Jawa Timur<br>
                                        Jl. Ahmad Yani 242-244 Surabaya
                                    </p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-gray-100 dark:bg-slate-800 flex items-center justify-center rounded-sm mr-4 shrink-0 text-kominfo dark:text-blue-400 border border-gray-200 dark:border-slate-700 transition-colors duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 dark:text-gray-200 text-base">Surat Elektronik (Email)</h3>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1 leading-relaxed">
                                        <a href="mailto:csirt@jatimprov.go.id" class="text-kominfo dark:text-blue-400 hover:underline">csirt@jatimprov.go.id</a>
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-2">
                                        Silakan gunakan PGP untuk komunikasi e-mail terenkripsi.
                                    </p>
                                </div>
                            </div>

                            <!-- Telepon -->
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-gray-100 dark:bg-slate-800 flex items-center justify-center rounded-sm mr-4 shrink-0 text-kominfo dark:text-blue-400 border border-gray-200 dark:border-slate-700 transition-colors duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 dark:text-gray-200 text-base">Telepon</h3>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1 leading-relaxed">
                                        (031) 8294608
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PGP Key Box -->
                    <div class="bg-slate-50 dark:bg-slate-800/80 border border-gray-200 dark:border-slate-700 p-6 rounded-sm transition-colors duration-300">
                        <div class="flex items-center gap-3 mb-4">
                            <svg class="w-6 h-6 text-kominfo dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <h3 class="font-bold text-slate-900 dark:text-white">Kunci Publik PGP</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                            Untuk memastikan keamanan dan kerahasiaan pelaporan insiden, silakan gunakan Public PGP Key kami saat mengirimkan email.
                        </p>
                        <a href="{{ asset('dokumen/PANDUAN-PENGGUNAAN-OPENPGP.pdf') }}" target="_blank" download class="inline-flex items-center justify-center px-6 py-2 border-2 border-kominfo dark:border-blue-500 text-kominfo dark:text-blue-400 hover:bg-kominfo dark:hover:bg-blue-600 hover:text-white font-bold text-xs uppercase tracking-widest transition-colors rounded-sm w-full sm:w-auto">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Unduh PGP Key
                        </a>
                    </div>
                </div>

                <!-- Kanan: Peta Google Maps -->
                <div class="h-full min-h-[400px]">
                    <div class="w-full h-full rounded-sm overflow-hidden border border-gray-200 dark:border-slate-700 shadow-sm bg-gray-100 dark:bg-slate-800 relative transition-colors duration-300">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.1555767345276!2d112.72918!3d-7.336418999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb44a7ee2a07%3A0xa372a10f76837d5b!2sDinas%20Komunikasi%20dan%20Informatika%20Provinsi%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1785204694076!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0; position: absolute; top: 0; left: 0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-footer />

    <!-- WIDGET CHATBOT CSIRT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

    <!-- Script Penggerak Dark Mode -->
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;

        // Fungsi saat tombol diklik
        if(themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function() {
                htmlElement.classList.toggle('dark');
                
                // Simpan pilihan user di memori browser
                if (htmlElement.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
            });
        }

        // Cek ingatan browser (apakah sebelumnya user pakai dark mode?)
        if (localStorage.getItem('theme') === 'dark') {
            htmlElement.classList.add('dark');
        }
    </script>
</body>
</html>