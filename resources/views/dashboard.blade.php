<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - JatimProv CSIRT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 font-sans flex flex-col min-h-screen transition-colors duration-300">

    <!-- Navbar Bawaan Bos -->
    <x-navbar />

    <!-- Konten Utama Admin -->
    <div class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        
        <!-- Header Admin -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white tracking-tight">Manajemen CSIRT</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Selamat datang, Admin! Kelola artikel publikasi dan validasi laporan bug di sini.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto shrink-0">
                <a href="/admin/laporan" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2.5 px-5 rounded-lg transition-all shadow-md flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Verifikasi Laporan
                </a>
                <a href="/dashboard/artikel/create" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2.5 px-5 rounded-lg transition-all shadow-md flex items-center justify-center gap-2">
                    + Tambah Berita
                </a>
            </div>
        </div>

        <!-- Tabel Artikel -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-slate-700 bg-gray-50/50 dark:bg-slate-800/50">
                <h2 class="font-bold text-gray-800 dark:text-gray-100 text-lg">Daftar Artikel Publikasi</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-100 dark:bg-slate-700/50">
                        <tr>
                            <th scope="col" class="px-6 py-4">No</th>
                            <th scope="col" class="px-6 py-4">Judul Artikel</th>
                            <th scope="col" class="px-6 py-4">Kategori</th>
                            <th scope="col" class="px-6 py-4">Tanggal Publikasi</th>
                            <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artikels as $index => $artikel)
                        <tr class="border-b dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-bold text-blue-600 dark:text-blue-400 line-clamp-2" title="{{ $artikel->judul }}">
                                {{ $artikel->judul }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block whitespace-nowrap bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300 text-xs font-semibold px-2.5 py-0.5 rounded border border-blue-400 dark:border-blue-700">
                                    {{ $artikel->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="/dashboard/artikel/{{ $artikel->id }}/edit" class="text-amber-500 hover:text-amber-600 font-bold uppercase text-xs tracking-wider transition-colors">Edit</a>
                                    <span class="text-gray-300 dark:text-gray-600">|</span>
                                    <form action="/dashboard/artikel/{{ $artikel->id }}" method="POST" class="inline m-0 p-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini secara permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600 font-bold uppercase text-xs tracking-wider transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                Belum ada artikel berita yang diterbitkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Chatbot Bawaan Bos -->
    <x-chatbot />
</body>
</html>