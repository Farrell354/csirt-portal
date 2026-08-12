<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Publikasi - JatimProv CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">

    <!-- Font Premium: Space Grotesk (Display) & JetBrains Mono (Tech) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    <!-- Memanggil Tailwind & Custom CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SCRIPT PENDETEKSI TEMA AWAL -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 transition-colors duration-500 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen relative overflow-x-hidden selection:bg-amber-500 selection:text-white">

    <!-- Efek Jaring Animasi di Background -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 dark:opacity-100 animate-grid-flow z-0"></div>
    
    <!-- Ambient Glow Background (Aksen Amber untuk Mode Edit) -->
    <div class="fixed top-1/4 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-amber-600/5 dark:bg-amber-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <div class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10">
        
        <!-- Tombol Kembali -->
        <div class="opacity-0 animate-fade-in-up">
            <a href="/dashboard" class="inline-flex items-center text-xs font-bold text-gray-500 dark:text-gray-400 hover:text-amber-600 dark:hover:text-amber-400 mb-6 transition-transform hover:-translate-x-2 duration-300 uppercase tracking-widest bg-white/50 dark:bg-slate-900/50 px-4 py-2 rounded-full border border-gray-200 dark:border-slate-800 backdrop-blur-sm shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Manajemen
            </a>
        </div>

        <!-- Form Wrapper (Glassmorphism) -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-3xl shadow-xl dark:shadow-[0_0_40px_rgba(0,0,0,0.4)] border border-gray-200/50 dark:border-slate-700/50 overflow-hidden opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            
            <!-- Dekorasi Garis Atas Nyala (Aksen Amber/Emas) -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-500 via-yellow-400 to-amber-600"></div>

            <!-- Header Form -->
            <div class="px-8 pt-10 pb-6 border-b border-gray-100 dark:border-slate-800/80 bg-gray-50/50 dark:bg-slate-950/50 relative overflow-hidden">
                <!-- Aksen Glow Sudut Kanan Atas -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50 dark:bg-amber-900/30 border border-amber-200 dark:border-amber-800/50 text-amber-600 dark:text-amber-400 font-mono text-[10px] font-bold tracking-widest mb-4 uppercase rounded-full shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                    </span>
                    EDIT_DATA_MODE
                </div>

                <h1 class="font-display text-3xl font-black text-slate-900 dark:text-white tracking-tight mb-2">Edit Publikasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-orange-500 dark:from-amber-400 dark:to-orange-400">CSIRT</span></h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Perbarui informasi, judul, atau isi konten publikasi yang sudah tercatat di sistem.</p>
            </div>

            <!-- Area Form -->
            <div class="p-8 md:p-10">
                <form action="/dashboard/artikel/{{ $artikel->id }}" method="POST">
                    <!-- SATPAM LARAVEL -->
                    @csrf
                    @method('PUT')

                    <!-- Judul Artikel -->
                    <div class="mb-8 group">
                        <label for="judul" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2">
                            Judul Publikasi <span class="text-red-500 text-lg leading-none">*</span>
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ $artikel->judul }}" required 
                            class="w-full px-5 py-4 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-2xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none text-base font-bold text-gray-900 dark:text-white transition-all shadow-sm group-hover:border-amber-300 dark:group-hover:border-slate-600">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Kategori -->
                        <div class="group">
                            <label for="kategori" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2">
                                Kategori <span class="text-red-500 text-lg leading-none">*</span>
                            </label>
                            <div class="relative">
                                <select name="kategori" id="kategori" required class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none text-sm font-bold text-gray-900 dark:text-white cursor-pointer transition-all shadow-sm group-hover:border-amber-300 dark:group-hover:border-slate-600 appearance-none">
                                    <option value="" disabled>-- Pilih Kategori --</option>
                                    <option value="Peringatan Keamanan" {{ $artikel->kategori == 'Peringatan Keamanan' ? 'selected' : '' }} class="bg-white dark:bg-slate-800 text-gray-900 dark:text-white">Peringatan Keamanan</option>
                                    <option value="Berita Keamanan Siber" {{ $artikel->kategori == 'Berita Keamanan Siber' ? 'selected' : '' }} class="bg-white dark:bg-slate-800 text-gray-900 dark:text-white">Berita Keamanan Siber</option>
                                    <option value="Personal" {{ $artikel->kategori == 'Personal' ? 'selected' : '' }} class="bg-white dark:bg-slate-800 text-gray-900 dark:text-white">Personal</option>
                                    <option value="Web Programming" {{ $artikel->kategori == 'Web Programming' ? 'selected' : '' }} class="bg-white dark:bg-slate-800 text-gray-900 dark:text-white">Web Programming</option>
                                    <option value="Web Design" {{ $artikel->kategori == 'Web Design' ? 'selected' : '' }} class="bg-white dark:bg-slate-800 text-gray-900 dark:text-white">Web Design</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500 dark:text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Penulis -->
                        <div class="group">
                            <label for="penulis" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2">
                                Nama Penulis <span class="text-red-500 text-lg leading-none">*</span>
                            </label>
                            <input type="text" name="penulis" id="penulis" value="{{ $artikel->penulis }}" required 
                                class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none text-sm font-bold text-gray-900 dark:text-white transition-all shadow-sm group-hover:border-amber-300 dark:group-hover:border-slate-600">
                        </div>
                    </div>

                    <!-- Link Gambar -->
                    <div class="mb-8 group">
                        <label for="gambar" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2">
                            Tautan Cover (Thumbnail URL) <span class="text-red-500 text-lg leading-none">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="url" name="gambar" id="gambar" value="{{ $artikel->gambar }}" required 
                                class="w-full pl-12 pr-5 py-3.5 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none text-sm font-mono text-gray-900 dark:text-amber-400 transition-all shadow-sm group-hover:border-amber-300 dark:group-hover:border-slate-600">
                        </div>
                        <p class="text-[10px] text-amber-600 dark:text-amber-500 mt-2 font-bold uppercase tracking-wider flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            URL Gambar Aktif Saat Ini
                        </p>
                    </div>

                    <!-- Konten -->
                    <div class="mb-10 group">
                        <label for="konten" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2">
                            Isi Konten Publikasi <span class="text-red-500 text-lg leading-none">*</span>
                        </label>
                        <textarea name="konten" id="konten" rows="12" required 
                            class="w-full px-5 py-4 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-2xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none text-sm font-medium text-gray-900 dark:text-gray-200 transition-all leading-relaxed shadow-sm group-hover:border-amber-300 dark:group-hover:border-slate-600">{{ $artikel->konten }}</textarea>
                    </div>

                    <!-- Area Tombol Submit -->
                    <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4 pt-6 border-t border-gray-100 dark:border-slate-800/80">
                        <a href="/dashboard" class="w-full sm:w-auto px-6 py-3.5 text-gray-600 dark:text-gray-400 font-bold hover:bg-gray-100 dark:hover:bg-slate-800/50 rounded-xl transition-colors text-sm text-center border border-transparent hover:border-gray-200 dark:hover:border-slate-700">
                            Batalkan
                        </a>
                        
                        <button type="submit" class="group relative w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-white text-sm font-bold py-3.5 px-8 rounded-xl transition-all shadow-[0_0_15px_rgba(245,158,11,0.3)] hover:shadow-[0_0_25px_rgba(245,158,11,0.5)] hover:-translate-y-0.5 overflow-hidden">
                            <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover:-translate-x-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                            <span class="transition-all duration-300 ease-out group-hover:-translate-x-3 flex items-center gap-2">
                                <svg class="w-4 h-4 group-hover:opacity-0 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Simpan Perubahan
                            </span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Chatbot Bawaan Bos -->
    <x-chatbot />
</body>
</html>