<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ request('judul') ?? 'Penampil Dokumen' }} - JatimProv-CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: { colors: { kominfo: '#0056B3', kominfo_dark: '#0A3A64' } }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 font-sans flex flex-col min-h-screen">

    <x-navbar />

    <div class="flex-grow bg-slate-100 dark:bg-slate-900 transition-colors duration-300 flex flex-col items-center">
        
        <!-- HEADER HALAMAN KECIL -->
        <div class="w-full bg-white dark:bg-slate-800/50 border-b border-gray-200 dark:border-slate-700 py-6 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 text-center relative">
                <!-- Tombol Kembali -->
                <a href="/panduan" class="hidden md:inline-flex items-center absolute left-4 top-1 text-sm font-bold text-gray-500 hover:text-kominfo dark:hover:text-blue-400 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
                
                <h1 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white tracking-tight">{{ request('judul') ?? 'Dokumen Panduan' }}</h1>
            </div>
        </div>

        <!-- AREA PENAMPIL PDF -->
        <div class="w-full max-w-5xl mx-auto px-4 py-8 flex-grow flex flex-col">
            <div class="w-full h-[75vh] md:h-[85vh] border border-gray-300 dark:border-slate-700 rounded-sm shadow-xl bg-white dark:bg-slate-800 overflow-hidden transition-colors duration-300">
                <iframe 
                    src="{{ asset('dokumen/' . request('file')) }}" 
                    class="w-full h-full"
                    style="border: none;"
                    title="Penampil Dokumen">
                </iframe>
            </div>
            
            <div class="text-center mt-6">
                <a href="{{ asset('dokumen/' . request('file')) }}" download class="inline-flex items-center text-sm font-bold text-kominfo dark:text-blue-400 hover:text-kominfo_dark dark:hover:text-blue-300 uppercase tracking-widest transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Unduh File Asli
                </a>
            </div>
        </div>
    </div>

    <x-footer />
    <script>
        if (localStorage.getItem('theme') === 'dark' || localStorage.getItem('color-theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>