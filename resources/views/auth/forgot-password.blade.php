<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemulihan Sandi - JatimProv CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    
    <!-- Memanggil Tailwind bawaan Laravel -->
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
    </style>
</head>
<body class="bg-gray-50 dark:bg-slate-950 text-gray-800 dark:text-gray-200 transition-colors duration-300 font-sans flex items-center justify-center min-h-screen py-8 px-4 relative overflow-x-hidden">

    <!-- Efek Jaring Animasi di Background -->
    <div class="fixed inset-0 pointer-events-none bg-cyber-grid animate-grid-flow z-0"></div>
    
    <!-- Ambient Glow Background (Amber/Orange untuk tema Recovery) -->
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-amber-500/10 dark:bg-amber-500/10 rounded-full blur-[100px] pointer-events-none z-0"></div>

    <!-- MAIN RECOVERY CARD -->
    <div class="w-full max-w-md relative z-10 opacity-0 animate-fade-in-up">
        
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-2xl shadow-2xl dark:shadow-[0_0_40px_rgba(0,0,0,0.5)] overflow-hidden border border-gray-200/50 dark:border-slate-700/50 relative">
            
            <!-- Dekorasi Garis Atas Nyala -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-500 via-orange-400 to-amber-500"></div>

            <!-- Header / Logo Area -->
            <div class="px-8 pt-10 pb-4 text-center relative">
                
                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 dark:bg-amber-900/30 border border-amber-200 dark:border-amber-800 text-amber-600 dark:text-amber-400 font-mono text-[10px] font-bold tracking-widest mb-4 uppercase rounded-full shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                    </span>
                    SYSTEM RECOVERY
                </div>

                <div class="w-14 h-14 bg-amber-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-inner border border-amber-100 dark:border-slate-700 transform rotate-3">
                    <svg class="w-7 h-7 text-amber-600 dark:text-amber-400 transform -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                </div>
                <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Pemulihan <span class="text-amber-600 dark:text-amber-400">Sandi</span></h2>
            </div>

            <!-- Form Area -->
            <div class="px-8 pb-8">
                
                <!-- Deskripsi Bawaan Laravel yang sudah dipercantik -->
                <div class="mb-6 text-sm text-gray-600 dark:text-gray-400 text-center leading-relaxed">
                    Lupa kata sandi? Tidak masalah. Masukkan alamat email Anda yang terdaftar, dan sistem kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
                </div>

                <!-- Session Status (Notifikasi jika email berhasil dikirim) -->
                <x-auth-session-status class="mb-5 p-3 rounded-lg bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-sm font-medium border border-green-200 dark:border-green-800 text-center" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-[11px] font-bold text-gray-700 dark:text-gray-300 mb-1.5 uppercase tracking-wide">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none transition-all text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-600" 
                                placeholder="Masukkan email terdaftar">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-red-500 dark:text-red-400 text-[11px] font-bold" />
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-3">
                        <button type="submit" class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl text-sm font-bold uppercase tracking-widest text-white bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 shadow-[0_0_20px_rgba(245,158,11,0.3)] hover:shadow-[0_0_30px_rgba(245,158,11,0.5)] transition-all duration-300 hover:-translate-y-0.5 overflow-hidden">
                            <span class="relative z-10 flex items-center gap-2">
                                Kirim Tautan Pemulihan
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Link Kembali ke Login -->
            <div class="bg-gray-50 dark:bg-slate-900/50 border-t border-gray-100 dark:border-slate-800 px-8 py-4">
                <a href="{{ route('login') }}" class="text-[11px] font-bold text-gray-500 dark:text-gray-400 hover:text-amber-600 dark:hover:text-amber-400 flex items-center justify-center transition-colors uppercase tracking-wider group">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Halaman Login
                </a>
            </div>
        </div>
        
        <!-- Tulisan kecil di bawah -->
        <p class="text-center text-gray-500 dark:text-gray-600 text-[10px] font-mono mt-6 uppercase tracking-widest">
            &copy; {{ date('Y') }} JatimProv-CSIRT. SECURE PROTOCOL.
        </p>
    </div>

</body>
</html>