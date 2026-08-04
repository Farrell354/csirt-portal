<x-guest-layout>
    <!-- Wadah Kartu Utama -->
    <div class="w-full sm:max-w-md bg-white shadow-2xl rounded-2xl overflow-hidden mx-auto">
        
        <!-- Bagian Header Biru -->
        <div class="bg-blue-700 p-8 text-center text-white">
            <h2 class="text-2xl font-black tracking-tight">JatimProv-CSIRT</h2>
            <p class="text-blue-200 text-sm mt-1 font-medium">Portal Pendaftaran Bug Hunter</p>
        </div>

        <!-- Bagian Formulir -->
        <div class="p-8 bg-white">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Nama / Nickname -->
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Nama / Nickname</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full border border-gray-300 rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent text-sm transition-all">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-300 rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent text-sm transition-all">
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
                        DAFTAR AKUN
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