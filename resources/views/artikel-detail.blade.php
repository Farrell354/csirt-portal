<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artikel->judul }} - JatimProv-CSIRT</title>
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
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="flex-shrink-0 flex items-center gap-2 hover:opacity-80 transition">
                    <div class="w-9 h-9 bg-kominfo flex items-center justify-center text-white font-bold text-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight hidden sm:block text-slate-800">JatimProv<span class="text-kominfo">-CSIRT</span></span>
                </a>
                <div class="flex items-center space-x-6">
                    <div class="hidden lg:flex space-x-6">
                        <a href="/" class="hover:text-kominfo font-medium text-sm transition">Beranda</a>
                        <a href="/profil" class="hover:text-kominfo font-medium text-sm transition">Profil</a>
                        <a href="/artikel" class="text-kominfo font-bold text-sm transition border-b-2 border-kominfo pb-1">Artikel</a>
                        <a href="/rfc2350" class="hover:text-kominfo font-medium text-sm transition">RFC2350</a>
                        <a href="/layanan" class="hover:text-kominfo font-medium text-sm transition">Layanan</a>
                        <a href="/panduan" class="hover:text-kominfo font-medium text-sm transition">Panduan</a>
                        <a href="/kontak" class="hover:text-kominfo font-medium text-sm transition">Kontak</a>
                    </div>
                    <button id="theme-toggle" class="p-2 text-gray-500 hover:text-gray-700 transition">
                        <span class="block"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg></span>
                        <span class="hidden"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- KONTEN ARTIKEL -->
    <div class="flex-grow bg-white pb-20">
        
        <!-- Header Berita -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
            <a href="/artikel" class="inline-flex items-center text-kominfo hover:text-kominfo_dark font-medium text-sm transition-colors mb-8">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Artikel
            </a>
            
            <div class="flex items-center gap-3 mb-6">
                <span class="bg-kominfo/10 text-kominfo font-bold text-xs uppercase tracking-widest px-3 py-1 rounded-sm border border-kominfo/20">
                    {{ $artikel->kategori }}
                </span>
                <span class="text-sm text-gray-500 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d F Y') }}
                </span>
            </div>
            
            <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-6">
                {{ $artikel->judul }}
            </h1>
            
            <div class="flex items-center gap-3 pb-8 border-b border-gray-200">
                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold border-2 border-white shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-900">{{ $artikel->penulis }}</p>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Analis Keamanan Siber</p>
                </div>
            </div>
        </div>

        <!-- Gambar Sampul -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="w-full h-[400px] md:h-[500px] bg-gray-100 rounded-sm overflow-hidden shadow-lg border border-gray-200">
                <img src="{{ $artikel->gambar }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Isi Konten -->
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <article class="prose prose-lg prose-blue max-w-none prose-headings:font-bold prose-a:text-kominfo hover:prose-a:text-kominfo_dark prose-img:rounded-sm">
                <!-- Karena datanya sederhana, kita gunakan nl2br agar enter/baris baru terbaca -->
                <p class="text-gray-700 leading-relaxed text-lg">
                    {!! nl2br(e($artikel->konten)) !!}
                </p>
            </article>
            
            <!-- Share Section -->
            <div class="mt-16 pt-8 border-t border-gray-200 flex items-center justify-between">
                <span class="text-sm font-bold text-gray-900 uppercase tracking-widest">Bagikan Informasi:</span>
                <div class="flex gap-4">
                    <button class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-kominfo hover:text-white transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></button>
                    <button class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-kominfo hover:text-white transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></button>
                    <button class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-kominfo hover:text-white transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg></button>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER SECTION -->
    <footer class="bg-footer_bg text-gray-400 py-16 border-t border-gray-800 w-full">
        <!-- Footer sama seperti sebelumnya -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="border-t border-gray-800 pt-8 text-center text-xs tracking-widest uppercase">
                <p>Copyright &copy; 2026 <span class="font-bold text-gray-200">JatimProv-CSIRT</span>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WIDGET CHATBOT CSIRT -->
    <button id="chatbot-toggle" class="fixed bottom-6 right-6 bg-kominfo hover:bg-kominfo_dark text-white w-14 h-14 rounded-sm shadow-xl flex items-center justify-center transition-transform hover:scale-105 z-50 border border-blue-400/30">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
    </button>
    <div id="chatbot-window" class="fixed bottom-24 right-6 w-80 sm:w-96 bg-white rounded-sm shadow-2xl overflow-hidden hidden flex-col z-50 border border-gray-300 transition-all duration-300">
        <!-- Chatbot interface sama seperti sebelumnya -->
        <div class="bg-slate-900 text-white px-4 py-3 flex justify-between items-center border-b border-kominfo">
            <h3 class="font-bold text-sm tracking-wide">CSIRT Virtual Assistant</h3>
            <button id="chatbot-close" class="text-gray-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
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