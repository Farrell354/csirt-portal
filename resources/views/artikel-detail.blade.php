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
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 font-sans flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <x-navbar />

    <!-- KONTEN ARTIKEL -->
    <div class="flex-grow bg-white dark:bg-slate-900 pb-20 transition-colors duration-300">
        
        <!-- Header Berita -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
            <a href="/artikel" class="inline-flex items-center text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 font-medium text-sm transition-colors mb-8">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Artikel
            </a>
            
            <div class="flex items-center gap-3 mb-6">
                <span class="bg-kominfo/10 dark:bg-blue-900/30 text-kominfo dark:text-blue-400 font-bold text-xs uppercase tracking-widest px-3 py-1 rounded-sm border border-kominfo/20 dark:border-blue-500/30">
                    {{ $artikel->kategori }}
                </span>
                <span class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d F Y') }}
                </span>
            </div>
            
            <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white leading-tight mb-6 transition-colors">
                {{ $artikel->judul }}
            </h1>
            
            <div class="flex items-center gap-3 pb-8 border-b border-gray-200 dark:border-slate-800 transition-colors">
                <div class="w-10 h-10 bg-gray-200 dark:bg-slate-700 rounded-full flex items-center justify-center text-gray-500 dark:text-gray-400 font-bold border-2 border-white dark:border-slate-800 shadow-sm transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-900 dark:text-white transition-colors">{{ $artikel->penulis }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">Analis Keamanan Siber</p>
                </div>
            </div>
        </div>

        <!-- Gambar Sampul -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="w-full h-[400px] md:h-[500px] bg-gray-100 dark:bg-slate-800 rounded-sm overflow-hidden shadow-lg border border-gray-200 dark:border-slate-700 transition-colors">
                <img src="{{ $artikel->gambar }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Isi Konten -->
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tambahkan dark:prose-invert di sini agar Tailwind mengatur warna teksnya otomatis -->
            <article class="prose prose-lg prose-blue dark:prose-invert max-w-none prose-headings:font-bold prose-a:text-kominfo dark:prose-a:text-blue-400 hover:prose-a:text-kominfo_dark prose-img:rounded-sm transition-colors">
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg transition-colors">
                    {!! nl2br(e($artikel->konten)) !!}
                </p>
            </article>
            
            <!-- Share Section -->
            <div class="mt-16 pt-8 border-t border-gray-200 dark:border-slate-800 flex items-center justify-between transition-colors">
                <span class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-widest transition-colors">Bagikan Informasi:</span>
                <div class="flex gap-4">
                    <button class="w-10 h-10 rounded-full bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-kominfo hover:text-white dark:hover:bg-blue-600 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></button>
                    <button class="w-10 h-10 rounded-full bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-kominfo hover:text-white dark:hover:bg-blue-600 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></button>
                    <button class="w-10 h-10 rounded-full bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-kominfo hover:text-white dark:hover:bg-blue-600 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg></button>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <!-- WIDGET CHATBOT CSIRT -->
    <button id="chatbot-toggle" class="fixed bottom-6 right-6 bg-kominfo hover:bg-kominfo_dark dark:bg-blue-600 dark:hover:bg-blue-700 text-white w-14 h-14 rounded-sm shadow-xl flex items-center justify-center transition-transform hover:scale-105 z-50 border border-blue-400/30">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
    </button>
    <div id="chatbot-window" class="fixed bottom-24 right-6 w-80 sm:w-96 bg-white dark:bg-slate-900 rounded-sm shadow-2xl overflow-hidden hidden flex-col z-50 border border-gray-300 dark:border-slate-700 transition-all duration-300">
        <!-- Chatbot Header -->
        <div class="bg-slate-900 dark:bg-slate-950 text-white px-4 py-3 flex justify-between items-center border-b border-kominfo dark:border-slate-800">
            <h3 class="font-bold text-sm tracking-wide">CSIRT Virtual Assistant</h3>
            <button id="chatbot-close" class="text-gray-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        <!-- Tambahkan area chatnya di sini kalau ada -->
    </div>

    <!-- SCRIPT TEMA & CHATBOT -->
    <script>
        // Cek LocalStorage untuk Dark Mode saat halaman dimuat
        if (localStorage.getItem('theme') === 'dark' || localStorage.getItem('color-theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }

        // Script Tombol Tema (Kalau ada di Navbar/halaman ini)
        const themeToggleBtn = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;
        
        if(themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => { 
                htmlElement.classList.toggle('dark'); 
                // Simpan pilihan ke storage
                if (htmlElement.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
            });
        }

        // Script Chatbot
        const chatbotToggle = document.getElementById('chatbot-toggle');
        const chatbotWindow = document.getElementById('chatbot-window');
        const chatbotClose = document.getElementById('chatbot-close');
        
        if(chatbotToggle && chatbotWindow) {
            chatbotToggle.addEventListener('click', () => { chatbotWindow.classList.toggle('hidden'); chatbotWindow.classList.toggle('flex'); });
            chatbotClose.addEventListener('click', () => { chatbotWindow.classList.add('hidden'); chatbotWindow.classList.remove('flex'); });
        }
    </script>
</body>
</html>