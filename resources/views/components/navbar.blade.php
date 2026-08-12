<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-lg shadow-[0_4px_30px_rgba(0,0,0,0.05)] border-b border-gray-200/50 dark:border-slate-800/50 sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo & Brand (Dengan Efek Hover Scale & Gradient) -->
            <a href="/" class="flex-shrink-0 flex items-center gap-3 group transition-transform duration-300 hover:scale-105">
                <div class="relative">
                    <div class="absolute inset-0 bg-blue-500 blur-lg opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                    <img src="{{ asset('img/logo-csirt.png') }}" alt="Logo CSIRT" class="h-10 w-auto relative z-10 drop-shadow-md">
                </div>
                <span class="font-black text-xl tracking-tight hidden sm:block text-slate-800 dark:text-white">
                    JatimProv<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-blue-400 dark:to-cyan-300">-CSIRT</span>
                </span>
            </a>
            
            <div class="flex items-center space-x-6">
                <!-- Menu Tengah (Animasi Hover Garis Bawah) -->
                <div class="hidden lg:flex items-center space-x-6">
                    
                    <a href="/" class="relative group {{ request()->is('/') ? 'text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium' }} text-sm transition-colors py-2">
                        Beranda
                        <span class="absolute bottom-0 left-0 h-[2px] bg-gradient-to-r from-blue-600 to-cyan-400 transition-all duration-300 {{ request()->is('/') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    
                    <a href="/profil" class="relative group {{ request()->is('profil') ? 'text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium' }} text-sm transition-colors py-2">
                        Profil
                        <span class="absolute bottom-0 left-0 h-[2px] bg-gradient-to-r from-blue-600 to-cyan-400 transition-all duration-300 {{ request()->is('profil') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    
                    <a href="/artikel" class="relative group {{ request()->is('artikel*') ? 'text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium' }} text-sm transition-colors py-2">
                        Artikel
                        <span class="absolute bottom-0 left-0 h-[2px] bg-gradient-to-r from-blue-600 to-cyan-400 transition-all duration-300 {{ request()->is('artikel*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>

                    <!-- MENU DROPDOWN DOKUMEN (Dengan Slide-Up & Glassmorphism) -->
                    <div class="relative group py-2">
                        <!-- Tombol Induk -->
                        <button class="relative flex items-center gap-1 {{ request()->is('rfc2350') || request()->is('panduan') || request()->is('ioc') ? 'text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium' }} text-sm transition-colors focus:outline-none">
                            Dokumen
                            <svg class="w-4 h-4 transform group-hover:-rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            <span class="absolute -bottom-2 left-0 h-[2px] bg-gradient-to-r from-blue-600 to-cyan-400 transition-all duration-300 {{ request()->is('rfc2350') || request()->is('panduan') || request()->is('ioc') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                        </button>
                        
                        <!-- Isi Dropdown -->
                        <div class="absolute left-0 top-full pt-4 w-52 opacity-0 invisible translate-y-4 group-hover:translate-y-0 group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-out z-50">
                            <div class="bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl rounded-xl shadow-2xl border border-gray-100 dark:border-slate-700/50 py-2 overflow-hidden transform origin-top">
                                
                                <a href="/rfc2350" class="block px-5 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-700/50 hover:text-blue-600 dark:hover:text-blue-400 hover:pl-7 transition-all duration-300 {{ request()->is('rfc2350') ? 'font-bold text-blue-600 dark:text-blue-400 border-l-2 border-blue-500 bg-blue-50/50 dark:bg-slate-700/30' : 'border-l-2 border-transparent' }}">
                                    RFC 2350
                                </a>
                                
                                <div class="border-t border-gray-100 dark:border-slate-700/50 my-1 mx-3"></div>
                                
                                <a href="/panduan" class="block px-5 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-700/50 hover:text-blue-600 dark:hover:text-blue-400 hover:pl-7 transition-all duration-300 {{ request()->is('panduan') ? 'font-bold text-blue-600 dark:text-blue-400 border-l-2 border-blue-500 bg-blue-50/50 dark:bg-slate-700/30' : 'border-l-2 border-transparent' }}">
                                    Panduan Penanganan
                                </a>
                                
                                <a href="/ioc" class="block px-5 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-700/50 hover:text-blue-600 dark:hover:text-blue-400 hover:pl-7 transition-all duration-300 {{ request()->is('ioc') ? 'font-bold text-blue-600 dark:text-blue-400 border-l-2 border-blue-500 bg-blue-50/50 dark:bg-slate-700/30' : 'border-l-2 border-transparent' }}">
                                    Indicator of Compromise
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="/layanan" class="relative group {{ request()->is('layanan') ? 'text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium' }} text-sm transition-colors py-2">
                        Layanan
                        <span class="absolute bottom-0 left-0 h-[2px] bg-gradient-to-r from-blue-600 to-cyan-400 transition-all duration-300 {{ request()->is('layanan') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>

                    <a href="/kontak" class="relative group {{ request()->is('kontak') ? 'text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium' }} text-sm transition-colors py-2">
                        Kontak
                        <span class="absolute bottom-0 left-0 h-[2px] bg-gradient-to-r from-blue-600 to-cyan-400 transition-all duration-300 {{ request()->is('kontak') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    
                    <a href="/leaderboard" class="relative group {{ request()->is('leaderboard') ? 'text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium' }} text-sm transition-colors py-2">
                        Leaderboard
                        <span class="absolute bottom-0 left-0 h-[2px] bg-gradient-to-r from-blue-600 to-cyan-400 transition-all duration-300 {{ request()->is('leaderboard') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                </div>

                <!-- Pemisah Vertikal -->
                <div class="hidden lg:block h-6 w-px bg-gray-300 dark:bg-slate-700"></div>

                <!-- Tombol Dark Mode (Dengan animasi putar) -->
                <button id="theme-toggle" class="p-2 rounded-full bg-gray-100 dark:bg-slate-800 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition-all duration-300 hover:rotate-12 hover:shadow-md cursor-pointer">
                    <span class="block dark:hidden">
                        <!-- Icon Matahari -->
                        <svg class="w-5 h-5 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </span>
                    <span class="hidden dark:block">
                        <!-- Icon Bulan -->
                        <svg class="w-5 h-5 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </span>
                </button>
                
                <!-- KONDISI JIKA USER SUDAH LOGIN -->
                @auth
                    <div class="flex items-center gap-3">
                        <!-- Tombol Pengaturan Akun -->
                        <a href="/settings" class="flex items-center gap-1.5 bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-xl text-sm font-bold transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="hidden sm:inline">Pengaturan</span>
                        </a>    
                        <!-- Tombol Dashboard (Glow Effect) -->
                        <a href="/dashboard" class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white text-sm font-bold py-2 px-5 rounded-xl transition-all shadow-[0_0_15px_rgba(59,130,246,0.4)] hover:shadow-[0_0_25px_rgba(59,130,246,0.6)] transform hover:-translate-y-0.5">
                            Dashboard
                        </a>
                        
                        <!-- Tombol Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="bg-red-500/10 hover:bg-red-500 text-red-600 dark:text-red-400 hover:text-white border border-red-500/20 text-sm font-bold py-2 px-4 rounded-xl transition-all shadow-sm group">
                                <span class="hidden sm:inline">Logout</span>
                                <svg class="w-4 h-4 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                @else
                <!-- KONDISI JIKA USER BELUM LOGIN -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-bold text-sm transition-colors py-2">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="relative inline-flex h-9 items-center justify-center overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-6 font-bold text-white text-sm transition-all shadow-[0_0_15px_rgba(59,130,246,0.4)] hover:shadow-[0_0_25px_rgba(59,130,246,0.6)] hover:scale-105">
                            <span class="relative z-10">Daftar Sekarang</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Script Standalone Penanganan Dark Mode -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const themeToggleBtn = document.getElementById('theme-toggle');
        
        // Cek dan set tema saat halaman dimuat
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Event listener dengan fallback agar tidak bentrok dengan script barbar
        if(themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function(e) {
                // Hentikan agar tidak diklik dua kali oleh script global (jika ada)
                e.stopPropagation(); 
                
                document.documentElement.classList.toggle('dark');

                if (document.documentElement.classList.contains('dark')) {
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    localStorage.setItem('color-theme', 'light');
                }
            });
        }
    });
</script>