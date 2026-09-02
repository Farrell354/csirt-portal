<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Sandi - JatimProv CSIRT</title>
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
    
    <!-- Ambient Glow Background (Cyan/Amber untuk tema Recovery) -->
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-cyan-500/10 dark:bg-amber-500/10 rounded-full blur-[100px] pointer-events-none z-0"></div>

    <!-- MAIN RESET CARD -->
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
                    KEY_UPDATE // RECOVERY
                </div>

                <div class="w-14 h-14 bg-amber-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-inner border border-amber-100 dark:border-slate-700 transform rotate-3">
                    <svg class="w-7 h-7 text-amber-600 dark:text-amber-400 transform -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Atur Ulang <span class="text-amber-600 dark:text-amber-400">Sandi</span></h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 font-medium">Buat kata sandi baru yang kuat untuk mengamankan akun CSIRT Anda.</p>
            </div>

            <!-- Form Area -->
            <div class="px-8 pb-8">

                <!-- Alert Error Global -->
                @if ($errors->any())
                    <div class="mb-5 p-3.5 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 rounded-xl text-xs text-red-600 dark:text-red-400 font-medium">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-[11px] font-bold text-gray-700 dark:text-gray-300 mb-1.5 uppercase tracking-wide">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" 
                                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none transition-all text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-600" 
                                placeholder="Email terdaftar">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-red-500 dark:text-red-400 text-[11px] font-bold" />
                    </div>

                    <!-- Kata Sandi Baru -->
                    <div>
                        <label for="password" class="block text-[11px] font-bold text-gray-700 dark:text-gray-300 mb-1.5 uppercase tracking-wide">Kata Sandi Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="new-password" 
                                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none transition-all text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-600" 
                                placeholder="Minimal 8 karakter">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-red-500 dark:text-red-400 text-[11px] font-bold" />
                        <p class="text-[10px] text-gray-500 dark:text-gray-400 font-mono mt-1">Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol.</p>
                    </div>

                    <!-- Konfirmasi Kata Sandi Baru -->
                    <div>
                        <label for="password_confirmation" class="block text-[11px] font-bold text-gray-700 dark:text-gray-300 mb-1.5 uppercase tracking-wide">Konfirmasi Kata Sandi Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none transition-all text-sm text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-600" 
                                placeholder="Ulangi kata sandi baru">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-red-500 dark:text-red-400 text-[11px] font-bold" />
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-3">
                        <button type="submit" class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl text-sm font-bold uppercase tracking-widest text-white bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 shadow-[0_0_20px_rgba(245,158,11,0.3)] hover:shadow-[0_0_30px_rgba(245,158,11,0.5)] transition-all duration-300 hover:-translate-y-0.5 overflow-hidden">
                            <span class="relative z-10 flex items-center gap-2">
                                Simpan Sandi Baru
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
                    Batalkan & Kembali ke Login
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
