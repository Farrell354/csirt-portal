<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-white dark:bg-slate-900 shadow-sm border-b border-gray-200 dark:border-slate-800 sticky top-0 z-50 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <a href="/" class="flex-shrink-0 flex items-center gap-2 hover:opacity-80 transition">
                <div class="w-9 h-9 bg-blue-700 flex items-center justify-center text-white font-bold text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                <span class="font-bold text-xl tracking-tight hidden sm:block text-slate-800 dark:text-white">JatimProv<span class="text-blue-700 dark:text-blue-500">-CSIRT</span></span>
            </a>
            
            <div class="flex items-center space-x-6">
                <!-- Menu Tengah (Lengkap & Pintar) -->
                <div class="hidden lg:flex space-x-6">
                    <a href="/" class="{{ request()->is('/') ? 'text-blue-700 dark:text-blue-500 font-bold border-b-2 border-blue-700 dark:border-blue-500' : 'text-gray-700 dark:text-gray-200 hover:text-blue-700 dark:hover:text-blue-400 font-medium' }} text-sm transition pb-1">Beranda</a>
                    
                    <a href="/profil" class="{{ request()->is('profil') ? 'text-blue-700 dark:text-blue-500 font-bold border-b-2 border-blue-700 dark:border-blue-500' : 'text-gray-700 dark:text-gray-200 hover:text-blue-700 dark:hover:text-blue-400 font-medium' }} text-sm transition pb-1">Profil</a>
                    
                    <a href="/artikel" class="{{ request()->is('artikel*') ? 'text-blue-700 dark:text-blue-500 font-bold border-b-2 border-blue-700 dark:border-blue-500' : 'text-gray-700 dark:text-gray-200 hover:text-blue-700 dark:hover:text-blue-400 font-medium' }} text-sm transition pb-1">Artikel</a>

                    <a href="/rfc2350" class="{{ request()->is('rfc2350') ? 'text-blue-700 dark:text-blue-500 font-bold border-b-2 border-blue-700 dark:border-blue-500' : 'text-gray-700 dark:text-gray-200 hover:text-blue-700 dark:hover:text-blue-400 font-medium' }} text-sm transition pb-1">RFC2350</a>

                    <a href="/layanan" class="{{ request()->is('layanan') ? 'text-blue-700 dark:text-blue-500 font-bold border-b-2 border-blue-700 dark:border-blue-500' : 'text-gray-700 dark:text-gray-200 hover:text-blue-700 dark:hover:text-blue-400 font-medium' }} text-sm transition pb-1">Layanan</a>

                    <a href="/panduan" class="{{ request()->is('panduan') ? 'text-blue-700 dark:text-blue-500 font-bold border-b-2 border-blue-700 dark:border-blue-500' : 'text-gray-700 dark:text-gray-200 hover:text-blue-700 dark:hover:text-blue-400 font-medium' }} text-sm transition pb-1">Panduan</a>

                    <a href="/kontak" class="{{ request()->is('kontak') ? 'text-blue-700 dark:text-blue-500 font-bold border-b-2 border-blue-700 dark:border-blue-500' : 'text-gray-700 dark:text-gray-200 hover:text-blue-700 dark:hover:text-blue-400 font-medium' }} text-sm transition pb-1">Kontak</a>
                    
                    <a href="/leaderboard" class="{{ request()->is('leaderboard') ? 'text-blue-700 dark:text-blue-500 font-bold border-b-2 border-blue-700 dark:border-blue-500' : 'text-gray-700 dark:text-gray-200 hover:text-blue-700 dark:hover:text-blue-400 font-medium' }} text-sm transition pb-1">Leaderboard</a>
                </div>

                <!-- Tombol Dark Mode -->
                <button id="theme-toggle" class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white transition cursor-pointer">
                    <span class="block dark:hidden"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg></span>
                    <span class="hidden dark:block"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></span>
                </button>
                
                <!-- Tombol Lapor / Dashboard -->
                @auth
                    <a href="/dashboard" class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 text-sm font-semibold transition shadow-sm hidden sm:block rounded-sm">Dashboard Hunter</a>
                @else
                    <a href="/login" class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 text-sm font-semibold transition shadow-sm hidden sm:block rounded-sm">Lapor / Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>