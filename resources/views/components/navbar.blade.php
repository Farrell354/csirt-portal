<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-lg shadow-[0_4px_30px_rgba(0,0,0,0.05)] border-b border-gray-200/50 dark:border-slate-800/50 sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex justify-between h-12 sm:h-14 lg:h-16 items-center">
            
            <!-- Logo & Brand -->
            <a href="/" class="flex-shrink-0 flex items-center gap-2 sm:gap-3 group transition-transform duration-300 hover:scale-105">
                <div class="relative">
                    <div class="absolute inset-0 bg-blue-500 blur-lg opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                    <img src="{{ asset('img/logo-csirt.png') }}" alt="Logo CSIRT" class="h-7 sm:h-8 lg:h-10 w-auto relative z-10 drop-shadow-md">
                </div>
                <span class="font-black text-base sm:text-lg lg:text-xl tracking-tight text-slate-800 dark:text-white">
                    JatimProv<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-blue-400 dark:to-cyan-300">-CSIRT</span>
                </span>
            </a>
            
            <div class="flex items-center space-x-2 sm:space-x-4 lg:space-x-6">
                <!-- Desktop Menu -->
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
                                    Ancaman Siber & IoC
                                </a>
                                <a href="/pembelajaran-insiden" class="block px-5 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-700/50 hover:text-blue-600 dark:hover:text-blue-400 hover:pl-7 transition-all duration-300 {{ request()->is('pembelajaran-insiden') ? 'font-bold text-blue-600 dark:text-blue-400 border-l-2 border-blue-500 bg-blue-50/50 dark:bg-slate-700/30' : 'border-l-2 border-transparent' }}">
                                    Pembelajaran Insiden
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
                    <div class="hidden lg:flex items-center gap-2 xl:gap-3">
                        <!-- Tombol Pengaturan Akun -->
                        <a href="/settings" class="flex items-center gap-1.5 bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200 px-3 py-2 rounded-xl text-sm font-bold transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Pengaturan</span>
                        </a>
                        <!-- Tombol Dashboard -->
                        <a href="/dashboard" class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white text-sm font-bold py-2 px-5 rounded-xl transition-all shadow-[0_0_15px_rgba(59,130,246,0.4)] hover:shadow-[0_0_25px_rgba(59,130,246,0.6)] transform hover:-translate-y-0.5">
                            Dashboard
                        </a>
                        <!-- Tombol Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="bg-red-500/10 hover:bg-red-500 text-red-600 dark:text-red-400 hover:text-white border border-red-500/20 text-sm font-bold py-2 px-4 rounded-xl transition-all shadow-sm">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                <!-- KONDISI JIKA USER BELUM LOGIN -->
                    <div class="hidden lg:flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-bold text-sm transition-colors py-2">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="relative inline-flex h-9 items-center justify-center overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 font-bold text-white text-sm transition-all shadow-[0_0_15px_rgba(59,130,246,0.4)] hover:shadow-[0_0_25px_rgba(59,130,246,0.6)] hover:scale-105">
                            <span class="relative z-10">Daftar</span>
                        </a>
                    </div>
                @endauth

                <!-- Hamburger button (mobile only) -->
                <button id="hamburger-btn" class="lg:hidden p-2 rounded-xl bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-all" aria-label="Toggle menu" aria-expanded="false">
                    <!-- Open icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <!-- Close icon (hidden) -->
                    <svg class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Drawer Menu -->
<div id="mobile-menu" class="hidden lg:hidden sticky top-12 sm:top-14 z-40 bg-white/98 dark:bg-slate-900/98 backdrop-blur-xl border-b border-gray-200/50 dark:border-slate-800/50 shadow-xl px-4 pb-5 pt-3">
    <div class="flex flex-col space-y-1 max-w-7xl mx-auto">
        <a href="/" class="px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->is('/') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-blue-600' }} transition-all">Beranda</a>
        <a href="/profil" class="px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->is('profil') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-blue-600' }} transition-all">Profil</a>
        <a href="/artikel" class="px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->is('artikel*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-blue-600' }} transition-all">Artikel</a>
        <div class="px-3 pt-1 pb-0.5">
            <div class="font-mono text-[9px] text-gray-400 uppercase tracking-widest mb-1">Dokumen</div>
        </div>
        <a href="/rfc2350" class="px-3 py-2 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-blue-600 transition-all ml-3">RFC 2350</a>
        <a href="/panduan" class="px-3 py-2 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-blue-600 transition-all ml-3">Panduan Penanganan</a>
        <a href="/ioc" class="px-3 py-2 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-blue-600 transition-all ml-3">Ancaman Siber & IoC</a>
        <a href="/pembelajaran-insiden" class="px-3 py-2 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-blue-600 transition-all ml-3">Pembelajaran Insiden</a>
        <a href="/layanan" class="px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->is('layanan') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-blue-600' }} transition-all">Layanan</a>
        <a href="/kontak" class="px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->is('kontak') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-blue-600' }} transition-all">Kontak</a>
        <a href="/leaderboard" class="px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->is('leaderboard') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-blue-600' }} transition-all">Leaderboard</a>

        <div class="border-t border-gray-100 dark:border-slate-800 pt-3 mt-1 flex flex-col gap-2">
            @auth
                <a href="/settings" class="px-3 py-2.5 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-800 flex items-center gap-2 transition-all">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Pengaturan
                </a>
                <a href="/dashboard" class="px-3 py-2.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-500 text-center shadow-md">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full px-3 py-2.5 rounded-xl text-sm font-bold text-red-500 border border-red-200 dark:border-red-800/50 hover:bg-red-500 hover:text-white transition-all text-center">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-3 py-2.5 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-300 text-center border border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-800 transition-all">Masuk</a>
                <a href="{{ route('register') }}" class="px-3 py-2.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-500 text-center shadow-md">Daftar Sekarang</a>
            @endauth
        </div>
    </div>
</div>

<!-- Dark Mode + Scroll Shrink + Hamburger -->
<script>
    document.addEventListener("DOMContentLoaded", () => {

        /* ── Dark Mode ── */
        const themeToggleBtn = document.getElementById('theme-toggle');
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                document.documentElement.classList.toggle('dark');
                localStorage.setItem('color-theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            });
        }

        /* ── Scroll Shrink ── */
        const nav = document.querySelector('nav');
        if (nav) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 24) {
                    nav.classList.add('shadow-[0_4px_40px_rgba(0,0,0,0.15)]', 'dark:bg-slate-950/90');
                    nav.classList.remove('shadow-[0_4px_30px_rgba(0,0,0,0.05)]');
                } else {
                    nav.classList.remove('shadow-[0_4px_40px_rgba(0,0,0,0.15)]', 'dark:bg-slate-950/90');
                    nav.classList.add('shadow-[0_4px_30px_rgba(0,0,0,0.05)]');
                }
            }, { passive: true });
        }

        /* ── Hamburger Mobile Menu ── */
        const hamburger  = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (hamburger && mobileMenu) {
            hamburger.addEventListener('click', () => {
                const isOpen = !mobileMenu.classList.contains('hidden');
                mobileMenu.classList.toggle('hidden', isOpen);
                hamburger.setAttribute('aria-expanded', String(!isOpen));
                hamburger.querySelectorAll('svg').forEach((svg, i) => {
                    svg.classList.toggle('hidden', isOpen ? i === 1 : i === 0);
                });
            });

            /* Close when clicking a link inside mobile menu */
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    hamburger.setAttribute('aria-expanded', 'false');
                    hamburger.querySelectorAll('svg').forEach((svg, i) => svg.classList.toggle('hidden', i !== 0));
                });
            });
        }

        /* ── Fast Page Transition Loader ── */
        (function() {
            const loader = document.createElement('div');
            loader.style.cssText = 'position:fixed;top:0;left:0;height:3px;background:linear-gradient(90deg, #38bdf8, #818cf8, #22d3ee);z-index:999999;width:0%;transition:width 0.3s ease, opacity 0.3s ease;opacity:0;box-shadow:0 0 15px rgba(34,211,238,1);pointer-events:none;';
            document.body.appendChild(loader);

            // Page load complete animation
            requestAnimationFrame(() => {
                loader.style.opacity = '1';
                loader.style.width = '100%';
                setTimeout(() => {
                    loader.style.opacity = '0';
                    setTimeout(() => loader.style.width = '0%', 300);
                }, 300);
            });

            // Intercept clicks for exit animation
            document.addEventListener('click', (e) => {
                const link = e.target.closest('a');
                if (!link) return;
                
                const href = link.getAttribute('href');
                const target = link.getAttribute('target');
                
                // Only intercept internal links (start with / and not an anchor link /#)
                if (href && href.startsWith('/') && !href.includes('#') && target !== '_blank' && !e.ctrlKey && !e.metaKey && !e.shiftKey) {
                    // Ignore download links or specific js links if any
                    if(link.hasAttribute('download') || link.getAttribute('onclick')) return;

                    e.preventDefault();
                    
                    loader.style.opacity = '1';
                    loader.style.width = '45%';
                    
                    // Add rapid blur/fade to content
                    document.body.style.transition = 'opacity 0.15s ease-out, filter 0.15s ease-out';
                    document.body.style.opacity = '0.3';
                    document.body.style.filter = 'blur(5px)';
                    
                    setTimeout(() => loader.style.width = '80%', 50);
                    
                    setTimeout(() => {
                        window.location.href = href;
                    }, 150); // Ultra fast 150ms delay
                }
            });
        })();
    });
</script>