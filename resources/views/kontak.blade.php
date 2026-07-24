<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - JatimProv-CSIRT</title>
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-300 dark:bg-slate-900 dark:text-gray-200 font-sans flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white dark:bg-slate-900 shadow-sm border-b border-gray-200 dark:border-slate-800 sticky top-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="flex-shrink-0 flex items-center gap-2 hover:opacity-80 transition">
                    <div class="w-9 h-9 bg-kominfo flex items-center justify-center text-white font-bold text-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight hidden sm:block text-slate-800 dark:text-white">JatimProv<span class="text-kominfo dark:text-blue-500">-CSIRT</span></span>
                </a>
                <div class="flex items-center space-x-6">
                    <div class="hidden lg:flex space-x-6">
                        <a href="/" class="hover:text-kominfo dark:hover:text-blue-400 font-medium text-sm transition">Beranda</a>
                        <a href="/profil" class="hover:text-kominfo dark:hover:text-blue-400 font-medium text-sm transition">Profil</a>
                        <a href="/artikel" class="hover:text-kominfo dark:hover:text-blue-400 font-medium text-sm transition">Artikel</a>
                        <a href="/rfc2350" class="hover:text-kominfo dark:hover:text-blue-400 font-medium text-sm transition">RFC2350</a>
                        <a href="/layanan" class="hover:text-kominfo dark:hover:text-blue-400 font-medium text-sm transition">Layanan</a>
                        <a href="/panduan" class="hover:text-kominfo dark:hover:text-blue-400 font-medium text-sm transition">Panduan</a>
                        <a href="/kontak" class="text-kominfo dark:text-blue-500 font-bold text-sm transition border-b-2 border-kominfo pb-1">Kontak</a>
                    </div>
                    <button id="theme-toggle" class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white transition">
                        <span class="block dark:hidden"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg></span>
                        <span class="hidden dark:block"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></span>
                    </button>
                    <a href="#" class="bg-kominfo hover:bg-kominfo_dark text-white px-5 py-2 text-sm font-semibold transition shadow-sm hidden sm:block rounded-sm">Login Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="flex-grow bg-white dark:bg-slate-900">
        
        <!-- HEADER HALAMAN -->
        <div class="bg-slate-50 dark:bg-slate-900 border-b border-gray-200 dark:border-slate-800 py-16">
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
                                <div class="w-12 h-12 bg-gray-100 dark:bg-slate-800 flex items-center justify-center rounded-sm mr-4 shrink-0 text-kominfo dark:text-blue-400 border border-gray-200 dark:border-slate-700">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 dark:text-white text-base">Lokasi / Alamat</h3>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1 leading-relaxed">
                                        Dinas Komunikasi dan Informatika Provinsi Jawa Timur<br>
                                        Jl. Ahmad Yani 242-244 Surabaya
                                    </p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-gray-100 dark:bg-slate-800 flex items-center justify-center rounded-sm mr-4 shrink-0 text-kominfo dark:text-blue-400 border border-gray-200 dark:border-slate-700">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 dark:text-white text-base">Surat Elektronik (Email)</h3>
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
                                <div class="w-12 h-12 bg-gray-100 dark:bg-slate-800 flex items-center justify-center rounded-sm mr-4 shrink-0 text-kominfo dark:text-blue-400 border border-gray-200 dark:border-slate-700">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 dark:text-white text-base">Telepon</h3>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1 leading-relaxed">
                                        (031) 8294608
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PGP Key Box -->
                    <div class="bg-slate-50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 p-6 rounded-sm">
                        <div class="flex items-center gap-3 mb-4">
                            <svg class="w-6 h-6 text-kominfo dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <h3 class="font-bold text-slate-900 dark:text-white">Kunci Publik PGP</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                            Untuk memastikan keamanan dan kerahasiaan pelaporan insiden, silakan gunakan Public PGP Key kami saat mengirimkan email.
                        </p>
                        <a href="{{ asset('dokumen/PANDUAN-PENGGUNAAN-OPENPGP.pdf') }}" target="_blank" download class="inline-flex items-center justify-center px-6 py-2 border-2 border-kominfo text-kominfo dark:text-blue-400 dark:border-blue-400 hover:bg-kominfo hover:text-white dark:hover:bg-blue-400 dark:hover:text-slate-900 font-bold text-xs uppercase tracking-widest transition-colors rounded-sm w-full sm:w-auto">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Unduh PGP Key
                        </a>
                    </div>
                </div>

                <!-- Kanan: Peta Google Maps -->
                <div class="h-full min-h-[400px]">
                    <div class="w-full h-full rounded-sm overflow-hidden border border-gray-200 dark:border-slate-700 shadow-sm bg-gray-100 dark:bg-slate-800 relative">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.387132177435!2d112.7301073147752!3d-7.310323394723932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbaa4c8a5a4b%3A0xc6c7619eb1899134!2sDinas%20Komunikasi%20dan%20Informatika%20Provinsi%20Jawa%20Timur!5e0!3m2!1sen!2sid!4v1680000000000!5m2!1sen!2sid" 
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
    <button id="chatbot-toggle" class="fixed bottom-6 right-6 bg-kominfo hover:bg-kominfo_dark text-white w-14 h-14 rounded-sm shadow-xl flex items-center justify-center transition-transform hover:scale-105 z-50 border border-blue-400/30">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
    </button>
    <!-- ... (Sisa kode chatbot sama persis seperti sebelumnya) ... -->
    <div id="chatbot-window" class="fixed bottom-24 right-6 w-80 sm:w-96 bg-white dark:bg-slate-900 rounded-sm shadow-2xl overflow-hidden hidden flex-col z-50 border border-gray-300 dark:border-slate-700 transition-all duration-300">
        <div class="bg-slate-900 text-white px-4 py-3 flex justify-between items-center border-b border-kominfo">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-kominfo" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <div>
                    <h3 class="font-bold text-sm tracking-wide">CSIRT Virtual Assistant</h3>
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest">Sistem Online</p>
                </div>
            </div>
            <button id="chatbot-close" class="text-gray-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        <div id="chat-messages" class="p-4 h-80 overflow-y-auto flex flex-col gap-4 bg-gray-50 dark:bg-slate-950 text-sm">
            <div class="flex flex-col gap-1 items-start">
                <div class="bg-white dark:bg-slate-800 text-gray-800 dark:text-gray-200 p-3 rounded-sm border border-gray-200 dark:border-slate-700 shadow-sm max-w-[85%] leading-relaxed">
                    Selamat datang di layanan bantuan JatimProv-CSIRT. Silakan ketik pertanyaan atau laporan indikasi insiden siber Anda.
                </div>
            </div>
        </div>
        <div class="p-3 bg-white dark:bg-slate-900 border-t border-gray-200 dark:border-slate-800 flex gap-2">
            <input type="text" id="chat-input" placeholder="Ketik pesan..." class="flex-1 bg-gray-100 dark:bg-slate-800 text-gray-800 dark:text-gray-200 px-3 py-2 rounded-sm outline-none focus:ring-1 focus:ring-kominfo border border-transparent dark:border-slate-700 text-sm">
            <button id="chat-send" class="bg-kominfo hover:bg-kominfo_dark text-white px-4 py-2 rounded-sm transition flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </div>
    </div>

    <!-- SCRIPT TEMA & CHATBOT -->
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;
        themeToggleBtn.addEventListener('click', () => { htmlElement.classList.toggle('dark'); });

        const chatbotToggle = document.getElementById('chatbot-toggle');
        const chatbotWindow = document.getElementById('chatbot-window');
        const chatbotClose = document.getElementById('chatbot-close');
        chatbotToggle.addEventListener('click', () => { chatbotWindow.classList.toggle('hidden'); chatbotWindow.classList.toggle('flex'); });
        chatbotClose.addEventListener('click', () => { chatbotWindow.classList.add('hidden'); chatbotWindow.classList.remove('flex'); });
    </script>
</body>
</html>