<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - JatimProv CSIRT</title>
    <!-- Memanggil Tailwind bawaan Laravel -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen font-sans bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
    
    <div class="w-full max-w-md bg-white rounded-lg shadow-2xl overflow-hidden border border-gray-200 m-4">
        <!-- Header / Logo Area -->
        <div class="bg-blue-700 p-8 text-center relative overflow-hidden">
            <!-- Dekorasi Background -->
            <div class="absolute top-0 left-0 w-full h-full bg-blue-800 opacity-20 transform -skew-y-6 scale-125 -translate-y-4"></div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg border-4 border-blue-500/30">
                    <svg class="w-8 h-8 text-blue-700" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                <h2 class="text-2xl font-black text-white tracking-tight">JatimProv<span class="text-blue-300">-CSIRT</span></h2>
                <p class="text-blue-100 text-sm mt-1 font-medium tracking-wide">Portal Manajemen Redaksi</p>
            </div>
        </div>

        <!-- Form Login -->
        <div class="p-8">
            <!-- Notifikasi Error/Sukses Bawaan -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Input Username -->
                <div class="mb-5">
                    <label for="username" class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600/50 focus:border-blue-600 outline-none transition-all text-sm bg-gray-50" placeholder="Masukkan Username">
                    <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-500 text-xs font-semibold" />
                </div>

                <!-- Input Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600/50 focus:border-blue-600 outline-none transition-all text-sm bg-gray-50" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs font-semibold" />
                </div>

                <!-- Checkbox & Lupa Password -->
                <div class="flex items-center justify-between mb-8">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-700 shadow-sm focus:ring-blue-700 w-4 h-4 cursor-pointer" name="remember">
                        <span class="ml-2 text-sm text-gray-600 font-medium group-hover:text-blue-700 transition-colors">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-700 hover:text-blue-900 font-bold transition-colors" href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3.5 px-4 rounded-md transition-all duration-300 text-sm uppercase tracking-widest shadow-lg shadow-blue-700/30 hover:shadow-xl hover:-translate-y-0.5">
                    Masuk Ke Sistem
                </button>
                <div class="mt-6 text-center text-sm text-gray-600">
    Belum punya akun Bug Hunter? 
    <a href="{{ route('register') }}" class="font-bold text-blue-700 hover:text-blue-900 hover:underline transition-colors">
        Daftar di sini
    </a>
</div>
                
                <!-- Link Kembali -->
                <div class="mt-8 text-center pt-6 border-t border-gray-100">
                    <a href="/" class="text-xs font-bold text-gray-400 hover:text-blue-700 flex items-center justify-center transition-colors uppercase tracking-wider">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Halaman Utama
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>