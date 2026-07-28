<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-white dark:bg-slate-900 shadow-sm border-b border-gray-200 dark:border-slate-800 sticky top-0 z-50 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
<a href="/" class="flex-shrink-0 flex items-center gap-2 hover:opacity-80 transition">
    
    <!-- INI BAGIAN YANG DIUBAH (Ganti SVG dengan tag IMG) -->
    <img src="{{ asset('img/logo-csirt.png') }}" alt="Logo CSIRT" class="h-10 w-auto">
    
    <!-- Teks Judul (Tetap dibiarkan) -->
    <span class="font-bold text-xl tracking-tight hidden sm:block text-slate-800 dark:text-white">
        JatimProv<span class="text-blue-700 dark:text-blue-500">-CSIRT</span>
    </span>
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
                <!-- KONDISI JIKA USER SUDAH LOGIN -->
@auth
    <div class="flex items-center gap-2">
        <!-- Tombol Dashboard -->
        <a href="/dashboard" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded-lg transition-colors">
            Dashboard
        </a>
        
        <!-- Tombol Logout -->
        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm font-bold py-2 px-4 rounded-lg transition-colors shadow-md">
                Logout
            </button>
        </form>
    </div>
@else
<!-- KONDISI JIKA USER BELUM LOGIN -->
    <div class="flex items-center gap-2">
        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-bold text-sm transition-colors">
            Masuk
        </a>
        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded-lg transition-colors shadow-md">
            Daftar
        </a>
    </div>
@endauth
            </div>
        </div>
    </div>
</nav>

<script>
    const themeToggleBtn = document.getElementById('theme-toggle');

    // 1. Cek tema saat halaman pertama kali dimuat (dari memori browser atau sistem OS)
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    // 2. Fungsi saat tombol Dark Mode diklik
    themeToggleBtn.addEventListener('click', function() {
        // Tambah/hapus kelas 'dark' pada tag <html>
        document.documentElement.classList.toggle('dark');

        // Simpan pilihan user di memori browser agar tidak hilang saat refresh
        if (document.documentElement.classList.contains('dark')) {
            localStorage.setItem('color-theme', 'dark');
        } else {
            localStorage.setItem('color-theme', 'light');
        }
    });
</script>