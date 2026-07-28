<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita Baru - JatimProv CSIRT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 font-sans flex flex-col min-h-screen transition-colors duration-300">

    <x-navbar />

    <div class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        
        <!-- Tombol Kembali -->
        <a href="/dashboard" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 mb-6 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>

        <!-- Header Form -->
        <div class="bg-white dark:bg-slate-800 rounded-t-2xl border-b-4 border-blue-600 p-8 shadow-sm">
            <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Tulis Berita / Artikel Baru</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">Publikasikan informasi terbaru seputar keamanan siber, peringatan ancaman, atau panduan ke masyarakat.</p>
        </div>

        <!-- Area Form -->
        <div class="bg-white dark:bg-slate-800 rounded-b-2xl shadow-sm p-8 mt-1 border border-gray-100 dark:border-slate-700">
            
            <form action="/dashboard/artikel" method="POST">
                <!-- SATPAM LARAVEL -->
                @csrf

                <!-- Judul Artikel -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" id="judul" required placeholder="Contoh: Waspada Serangan Ransomware Varian Baru..." 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white transition-all">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori" id="kategori" required class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white cursor-pointer transition-all">
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <option value="Peringatan Keamanan">Peringatan Keamanan</option>
                            <option value="Berita Siber">Berita Siber</option>
                            <option value="Panduan Mitigasi">Panduan Mitigasi</option>
                            <option value="Rilis Resmi">Rilis Resmi</option>
                        </select>
                    </div>

                    <!-- Penulis -->
                    <div>
                        <label for="penulis" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Penulis <span class="text-red-500">*</span></label>
                        <input type="text" name="penulis" id="penulis" value="{{ auth()->user()->name ?? 'Admin CSIRT' }}" required 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white transition-all">
                    </div>
                </div>

                <!-- Link Gambar -->
                <div class="mb-6">
                    <label for="gambar" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">URL Gambar (Thumbnail) <span class="text-red-500">*</span></label>
                    <input type="url" name="gambar" id="gambar" required placeholder="https://contoh.com/gambar-hacker.jpg" 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white transition-all text-sm font-mono">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">*Masukkan link/URL gambar dari internet untuk sementara (agar lebih mudah tanpa harus upload).</p>
                </div>

                <!-- Konten -->
                <div class="mb-8">
                    <label for="konten" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Isi Konten Berita <span class="text-red-500">*</span></label>
                    <textarea name="konten" id="konten" rows="10" required placeholder="Tulis isi berita atau artikel di sini..." 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white transition-all leading-relaxed"></textarea>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end gap-3 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <a href="/dashboard" class="px-6 py-3.5 text-gray-500 dark:text-gray-400 font-bold hover:bg-gray-100 dark:hover:bg-slate-700 rounded-xl transition-colors text-sm">Batal</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl transition-all shadow-lg shadow-blue-600/30 hover:shadow-xl flex items-center gap-2 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Publikasikan Berita
                    </button>
                </div>
            </form>

        </div>
    </div>

    <x-chatbot />
</body>
</html>