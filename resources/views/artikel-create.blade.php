<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita Baru - JatimProv CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    
    <!-- Memanggil Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        kominfo: '#0056B3',
                        kominfo_dark: '#0A3A64',
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'grid-flow': 'gridFlow 20s linear infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        gridFlow: {
                            '0%': { backgroundPosition: '0 0' },
                            '100%': { backgroundPosition: '50px 50px' }
                        }
                    }
                }
            }
        }
    </script>

    <!-- SCRIPT PENDETEKSI TEMA AWAL -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        
        .bg-cyber-grid {
            background-image: 
                linear-gradient(to right, rgba(0, 168, 255, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 168, 255, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        .dark .bg-cyber-grid {
            background-image: 
                linear-gradient(to right, rgba(56, 189, 248, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(56, 189, 248, 0.05) 1px, transparent 1px);
        }
        
        /* Custom Scrollbar untuk Textarea */
        textarea::-webkit-scrollbar { width: 6px; }
        textarea::-webkit-scrollbar-track { background: transparent; }
        textarea::-webkit-scrollbar-thumb { background: #0ea5e9; border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-slate-950 text-gray-800 dark:text-gray-200 font-sans flex flex-col min-h-screen transition-colors duration-300 relative overflow-x-hidden">

    <!-- Efek Jaring Animasi di Background -->
    <div class="fixed inset-0 pointer-events-none bg-cyber-grid animate-grid-flow z-0"></div>
    
    <!-- Ambient Glow Background -->
    <div class="fixed top-1/4 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/10 dark:bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <div class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full relative z-10">
        
        <!-- Tombol Kembali -->
        <div class="opacity-0 animate-fade-in-up">
            <a href="/dashboard" class="inline-flex items-center text-xs font-bold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-cyan-400 mb-6 transition-transform hover:-translate-x-2 duration-300 uppercase tracking-widest bg-white/50 dark:bg-slate-900/50 px-4 py-2 rounded-full border border-gray-200 dark:border-slate-800 backdrop-blur-sm shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Manajemen
            </a>
        </div>

        <!-- Form Wrapper (Glassmorphism) -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-3xl shadow-xl dark:shadow-[0_0_40px_rgba(0,0,0,0.4)] border border-gray-200/50 dark:border-slate-700/50 overflow-hidden opacity-0 animate-fade-in-up delay-100 relative">
            
            <!-- Dekorasi Garis Atas Nyala -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-blue-600"></div>

            <!-- Header Form -->
            <div class="px-8 pt-10 pb-6 border-b border-gray-100 dark:border-slate-800/80 bg-gray-50/50 dark:bg-slate-950/50 relative overflow-hidden">
                <!-- Aksen Glow Sudut Kanan Atas -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 text-blue-600 dark:text-blue-400 font-mono text-[10px] font-bold tracking-widest mb-4 uppercase rounded-full shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500"></span>
                    </span>
                    DATA_ENTRY_MODE
                </div>

                <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight mb-2">Tulis Publikasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-cyan-400 dark:to-blue-500">Baru</span></h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Sistem publikasi informasi, peringatan ancaman, dan literasi keamanan siber.</p>
            </div>

            <!-- Area Form -->
            <div class="p-8 md:p-10">
                <form action="/dashboard/artikel" method="POST">
                    <!-- SATPAM LARAVEL -->
                    @csrf

                    <!-- Judul Artikel -->
                    <div class="mb-8 group">
                        <label for="judul" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2">
                            Judul Publikasi <span class="text-red-500 text-lg leading-none">*</span>
                        </label>
                        <input type="text" name="judul" id="judul" required placeholder="Contoh: Waspada Serangan Ransomware Varian Baru..." 
                            class="w-full px-5 py-4 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-2xl focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 outline-none text-base font-bold text-gray-900 dark:text-white transition-all shadow-sm group-hover:border-blue-300 dark:group-hover:border-slate-600 placeholder-gray-400 dark:placeholder-gray-600">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Kategori -->
                        <div class="group">
                            <label for="kategori" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2">
                                Kategori <span class="text-red-500 text-lg leading-none">*</span>
                            </label>
                            <div class="relative">
                                <select name="kategori" id="kategori" required class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-xl focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 outline-none text-sm font-bold text-gray-900 dark:text-white cursor-pointer transition-all shadow-sm group-hover:border-blue-300 dark:group-hover:border-slate-600 appearance-none">
                                    <option value="" disabled selected class="text-gray-500">-- Tetapkan Kategori --</option>
                                    <option value="Peringatan Keamanan" class="bg-white dark:bg-slate-800 text-gray-900 dark:text-white">Peringatan Keamanan</option>
                                    <option value="Berita Keamanan Siber" class="bg-white dark:bg-slate-800 text-gray-900 dark:text-white">Berita Keamanan Siber</option>
                                    <option value="Personal" class="bg-white dark:bg-slate-800 text-gray-900 dark:text-white">Personal</option>
                                    <option value="Web Programming" class="bg-white dark:bg-slate-800 text-gray-900 dark:text-white">Web Programming</option>
                                    <option value="Web Design" class="bg-white dark:bg-slate-800 text-gray-900 dark:text-white">Web Design</option>
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
                            <input type="text" name="penulis" id="penulis" value="{{ auth()->user()->name ?? 'Admin CSIRT' }}" required 
                                class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-xl focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 outline-none text-sm font-bold text-gray-900 dark:text-white transition-all shadow-sm group-hover:border-blue-300 dark:group-hover:border-slate-600">
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
                            <input type="url" name="gambar" id="gambar" required placeholder="https://unsplash.com/..." 
                                class="w-full pl-12 pr-5 py-3.5 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-xl focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 outline-none text-sm font-mono text-gray-900 dark:text-blue-300 transition-all shadow-sm group-hover:border-blue-300 dark:group-hover:border-slate-600 placeholder-gray-400 dark:placeholder-gray-600">
                        </div>
                        <p class="text-[10px] text-amber-600 dark:text-amber-500 mt-2 font-bold uppercase tracking-wider flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Gunakan Direct Link Image (JPG/PNG/WEBP).
                        </p>
                    </div>

                    <!-- Konten -->
                    <div class="mb-10 group">
                        <label for="konten" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest flex items-center gap-2">
                            Isi Konten Publikasi <span class="text-red-500 text-lg leading-none">*</span>
                        </label>
                        <textarea name="konten" id="konten" rows="12" required placeholder="Tulis rincian informasi keamanan siber di sini..." 
                            class="w-full px-5 py-4 bg-gray-50 dark:bg-slate-950/50 border border-gray-200 dark:border-slate-700/80 rounded-2xl focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 outline-none text-sm font-medium text-gray-900 dark:text-gray-200 transition-all leading-relaxed shadow-sm group-hover:border-blue-300 dark:group-hover:border-slate-600 placeholder-gray-400 dark:placeholder-gray-600"></textarea>
                    </div>

                    <!-- Area Tombol Submit -->
                    <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4 pt-6 border-t border-gray-100 dark:border-slate-800/80">
                        
                        <a href="/dashboard" class="w-full sm:w-auto px-6 py-3.5 text-gray-600 dark:text-gray-400 font-bold hover:bg-gray-100 dark:hover:bg-slate-800/50 rounded-xl transition-colors text-sm text-center border border-transparent hover:border-gray-200 dark:hover:border-slate-700">
                            Batalkan
                        </a>
                        
                        <button type="submit" class="group relative w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-sm font-bold py-3.5 px-8 rounded-xl transition-all shadow-[0_0_15px_rgba(6,182,212,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.5)] hover:-translate-y-0.5 overflow-hidden">
                            <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover:-translate-x-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </span>
                            <span class="transition-all duration-300 ease-out group-hover:-translate-x-3 flex items-center gap-2">
                                <svg class="w-4 h-4 group-hover:opacity-0 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                Publikasikan Sekarang
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