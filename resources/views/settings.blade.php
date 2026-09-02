<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - JatimProv CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    
    <!-- Font Premium: Space Grotesk & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Vite: CSS dan JS Induk -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SCRIPT PENDETEKSI TEMA AWAL -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-[#020617] text-gray-800 dark:text-gray-200 font-sans flex flex-col min-h-screen transition-colors duration-500 relative overflow-x-hidden selection:bg-cyan-500 selection:text-white">

    <!-- Efek Jaring Animasi di Background (Sudah dipanggil dari app.css) -->
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid dark:bg-mesh-grid opacity-30 dark:opacity-100 z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/5 dark:bg-blue-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50">
        <x-navbar />
    </div>

    <div class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full relative z-10 opacity-0 animate-fade-in-up">
        
        <!-- Header -->
        <div class="mb-10 text-center md:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 text-blue-600 dark:text-blue-400 font-mono text-[10px] font-bold tracking-widest mb-4 uppercase rounded-full shadow-sm animate-float-subtle">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                SYSTEM_PREFERENCES
            </div>
            <h1 class="font-display text-3xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight">Pengaturan Akun</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm font-medium">Kelola identitas siber dan kredensial keamanan Anda.</p>
        </div>

        <!-- Notifikasi Sukses -->
        @if(session('sukses') || session('status') == 'profile-updated')
            <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-700/50 text-emerald-700 dark:text-emerald-400 px-5 py-4 rounded-2xl flex items-center gap-3 shadow-sm">
                <div class="p-1 bg-emerald-100 dark:bg-emerald-800/50 rounded-lg shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-bold text-sm tracking-wide">Profil siber berhasil diperbarui!</span>
            </div>
        @endif

        <!-- Error Validasi -->
        @if ($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700/50 text-red-700 dark:text-red-400 px-5 py-4 rounded-2xl shadow-sm">
                <div class="flex items-center gap-2 mb-2 font-bold text-sm">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                    Terdapat kesalahan input:
                </div>
                <ul class="list-disc pl-7 text-xs font-medium space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Area Form (Glassmorphism) -->
        <div class="bg-white/90 dark:bg-slate-900/80 backdrop-blur-xl rounded-3xl shadow-xl dark:shadow-[0_10px_40px_rgba(0,0,0,0.4)] border border-gray-200/50 dark:border-slate-800/80 overflow-hidden relative">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-blue-600"></div>

            <form action="/settings" method="POST" class="p-8 md:p-10" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- ================= INFORMASI DASAR ================= -->
                <div class="flex items-center gap-3 mb-8 border-b border-gray-100 dark:border-slate-800 pb-4">
                    <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-cyan-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-wider">Identitas Dasar</h3>
                </div>
                
                <!-- BLOK FOTO PROFIL (SINKRONISASI DICEBEAR) -->
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 mb-10 bg-gray-50 dark:bg-slate-950/50 p-6 rounded-2xl border border-gray-100 dark:border-slate-800">
                    
                    <!-- Avatar Logika: Jika ada avatar di DB pakai itu, jika tidak pakai DiceBear -->
                    <div class="relative w-28 h-28 rounded-3xl overflow-hidden border-4 border-white dark:border-slate-800 shadow-[0_0_20px_rgba(59,130,246,0.3)] shrink-0 bg-blue-50 dark:bg-slate-700 group">
                        @if(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-full h-full object-cover">
                        @else
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode(auth()->user()->name) }}&backgroundColor=dbeafe" alt="Avatar Kartun" class="w-full h-full object-cover">
                        @endif
                    </div>
                    
                    <div class="text-center sm:text-left flex-grow">
                        <h4 class="text-2xl font-black text-slate-900 dark:text-white mb-1">{{ auth()->user()->name }}</h4>
                        <p class="text-xs text-blue-600 dark:text-cyan-400 mb-2 font-bold tracking-widest uppercase">
                            {{ auth()->user()->role === 'admin' ? 'Administrator CSIRT' : 'Bug Hunter Elite' }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">
                            Avatar digenerate otomatis secara dinamis berdasarkan identitas nama akun Anda.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <!-- Input Nama -->
                    <div>
                        <label for="name" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/50 outline-none text-sm font-medium text-gray-900 dark:text-white transition-all">
                    </div>

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest">Alamat Email Taut</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/50 outline-none text-sm font-medium text-gray-900 dark:text-white transition-all">
                    </div>
                </div>

                <!-- ================= KEAMANAN & PASSWORD ================= -->
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 dark:border-slate-800 pb-4 mt-8">
                    <div class="p-2 bg-amber-50 dark:bg-amber-900/30 rounded-lg text-amber-600 dark:text-amber-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-wider">Kredensial Akses</h3>
                </div>
                
                <p class="text-[11px] text-amber-600 dark:text-amber-500 mb-6 font-bold tracking-widest bg-amber-50 dark:bg-amber-900/20 inline-block px-3 py-1 rounded-md border border-amber-100 dark:border-amber-800/50 uppercase">
                    ⚠ Kosongkan bidang ini jika tidak ingin mengubah sandi.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div>
                        <label for="current_password" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest">Sandi Saat Ini</label>
                        <input type="password" name="current_password" id="current_password" placeholder="Wajib jika ganti sandi..."
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none text-sm font-medium text-gray-900 dark:text-white transition-all placeholder-gray-400">
                    </div>
                    <div>
                        <label for="password" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest">Sandi Baru</label>
                        <input type="password" name="password" id="password" placeholder="Minimal 8 karakter..." 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none text-sm font-medium text-gray-900 dark:text-white transition-all placeholder-gray-400">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase tracking-widest">Konfirmasi Sandi Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi sandi baru..." 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 outline-none text-sm font-medium text-gray-900 dark:text-white transition-all placeholder-gray-400">
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end pt-6 border-t border-gray-100 dark:border-slate-800">
                    <button type="submit" class="group relative inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-sm font-bold py-3.5 px-8 rounded-xl transition-all shadow-[0_0_15px_rgba(6,182,212,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.5)] hover:-translate-y-0.5 overflow-hidden">
                        <span class="absolute right-0 translate-x-full transition-transform duration-300 ease-out group-hover:-translate-x-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                        <span class="transition-all duration-300 ease-out group-hover:-translate-x-3 flex items-center gap-2">
                            Simpan Konfigurasi
                        </span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <x-chatbot />
</body>
</html>