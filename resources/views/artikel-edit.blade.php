<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - JatimProv CSIRT</title>
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
        <div class="bg-white dark:bg-slate-800 rounded-t-2xl border-b-4 border-amber-500 p-8 shadow-sm">
            <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Edit Berita / Artikel</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">Perbarui informasi, judul, atau isi konten berita yang sudah dipublikasikan.</p>
        </div>

        <!-- Area Form -->
        <div class="bg-white dark:bg-slate-800 rounded-b-2xl shadow-sm p-8 mt-1 border border-gray-100 dark:border-slate-700">
            
            <!-- Pastikan route action-nya mengarah ke update beserta ID artikelnya -->
            <form action="/dashboard/artikel/{{ $artikel->id }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Judul Artikel -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" id="judul" value="{{ $artikel->judul }}" required 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-amber-500 outline-none text-gray-900 dark:text-white transition-all">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Kategori (SUDAH DISESUAIKAN DENGAN YANG BARU BESERTA LOGIKA SELECTED) -->
                    <div>
                        <label for="kategori" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori" id="kategori" required class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-amber-500 outline-none text-gray-900 dark:text-white cursor-pointer transition-all">
                            <option value="" disabled>-- Pilih Kategori --</option>
                            <option value="Peringatan Keamanan" {{ $artikel->kategori == 'Peringatan Keamanan' ? 'selected' : '' }}>Peringatan Keamanan</option>
                            <option value="Berita Keamanan Siber" {{ $artikel->kategori == 'Berita Keamanan Siber' ? 'selected' : '' }}>Berita Keamanan Siber</option>
                            <option value="Personal" {{ $artikel->kategori == 'Personal' ? 'selected' : '' }}>Personal</option>
                            <option value="Web Programming" {{ $artikel->kategori == 'Web Programming' ? 'selected' : '' }}>Web Programming</option>
                            <option value="Web Design" {{ $artikel->kategori == 'Web Design' ? 'selected' : '' }}>Web Design</option>
                        </select>
                    </div>

                    <!-- Penulis -->
                    <div>
                        <label for="penulis" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Penulis <span class="text-red-500">*</span></label>
                        <input type="text" name="penulis" id="penulis" value="{{ $artikel->penulis }}" required 
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-amber-500 outline-none text-gray-900 dark:text-white transition-all">
                    </div>
                </div>

                <!-- Link Gambar -->
                <div class="mb-6">
                    <label for="gambar" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">URL Gambar (Thumbnail) <span class="text-red-500">*</span></label>
                    <input type="url" name="gambar" id="gambar" value="{{ $artikel->gambar }}" required 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-amber-500 outline-none text-gray-900 dark:text-white transition-all text-sm font-mono">
                </div>

                <!-- Konten -->
                <div class="mb-8">
                    <label for="konten" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Isi Konten Berita <span class="text-red-500">*</span></label>
                    <textarea name="konten" id="konten" rows="10" required 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-amber-500 outline-none text-gray-900 dark:text-white transition-all leading-relaxed">{{ $artikel->konten }}</textarea>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end gap-3 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <a href="/dashboard" class="px-6 py-3.5 text-gray-500 dark:text-gray-400 font-bold hover:bg-gray-100 dark:hover:bg-slate-700 rounded-xl transition-colors text-sm">Batal</a>
                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3.5 px-8 rounded-xl transition-all shadow-lg shadow-amber-500/30 hover:shadow-xl flex items-center gap-2 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>

    <x-chatbot />
</body>
</html>