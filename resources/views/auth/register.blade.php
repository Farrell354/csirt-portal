<x-guest-layout>
    <!-- Wadah Kartu Utama -->
    <div class="w-full sm:max-w-md bg-white shadow-2xl rounded-2xl overflow-hidden mx-auto">
        
        <!-- Bagian Header Biru -->
        <div class="bg-blue-700 p-8 text-center text-white">
            <div class="flex justify-center mb-4">
                <div class="bg-white p-3 rounded-full shadow-inner">
                    <!-- Ikon Shield -->
                    <svg class="w-10 h-10 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
            </div>
            <h2 class="text-2xl font-black tracking-tight">JatimProv-CSIRT</h2>
            <p class="text-blue-200 text-sm mt-1 font-medium">Portal Pendaftaran Bug Hunter</p>
        </div>

        <!-- Bagian Formulir -->
        <div class="p-8 bg-white">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Nama / Nickname -->
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Nama / Nickname Hacker</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus class="w-full border border-gray-300 rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent text-sm transition-all">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Alamat Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required class="w-full border border-gray-300 rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent text-sm transition-all">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" required class="w-full border border-gray-300 rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent text-sm transition-all">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-1">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full border border-gray-300 rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent text-sm transition-all">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
                </div>

                <!-- Tombol Submit -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-md transition-colors shadow-lg hover:shadow-xl">
                        DAFTAR SEBAGAI HUNTER
                    </button>
                </div>
                
                <!-- Link Login -->
                <div class="mt-6 text-center text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-blue-700 hover:text-blue-900 hover:underline transition-colors">
                        Masuk ke Sistem
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>