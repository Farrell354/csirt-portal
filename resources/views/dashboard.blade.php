<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Artikel') }}
            </h2>
            <a href="/dashboard/artikel/create" class="bg-blue-700 hover:bg-blue-800 text-white text-sm font-bold py-2 px-4 rounded transition-colors shadow-md">
    + Tambah Berita Baru
</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-6 flex justify-end">
                <a href="/admin/laporan" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg font-bold shadow-md transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Verifikasi Laporan Bug</span>
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    
                    <!-- Tabel Daftar Artikel -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Judul Artikel</th>
                                    <th scope="col" class="px-6 py-3">Kategori</th>
                                    <th scope="col" class="px-6 py-3">Tanggal Publikasi</th>
                                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($artikels as $index => $artikel)
                                <tr class="bg-white border-b hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-bold text-blue-700 line-clamp-2" title="{{ $artikel->judul }}">
                                        {{ $artikel->judul }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block whitespace-nowrap bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded border border-blue-400">
    {{ $artikel->kategori }}
</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center space-x-3">
    <!-- Tombol Edit (Kita siapkan link-nya sekalian) -->
    <a href="/dashboard/artikel/{{ $artikel->id }}/edit" class="text-amber-500 hover:text-amber-700 font-bold uppercase text-xs tracking-wider transition-colors">Edit</a>
    
    <span class="text-gray-300">|</span>
    
    <!-- Tombol Hapus (Menggunakan Form + Konfirmasi) -->
    <form action="/dashboard/artikel/{{ $artikel->id }}" method="POST" class="inline m-0 p-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini secara permanen?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500 hover:text-red-700 font-bold uppercase text-xs tracking-wider transition-colors cursor-pointer">
            Hapus
        </button>
    </form>
</div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        Belum ada artikel berita yang diterbitkan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>