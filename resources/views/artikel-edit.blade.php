<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="/dashboard" class="text-gray-500 hover:text-amber-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Edit Berita') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 p-8">
                
                <form action="/dashboard/artikel/{{ $artikel->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Artikel</label>
                        <input type="text" name="judul" value="{{ $artikel->judul }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-amber-500 focus:border-amber-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                            <select name="kategori" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-amber-500 focus:border-amber-500">
                                <option value="Berita Siber" {{ $artikel->kategori == 'Berita Siber' ? 'selected' : '' }}>Berita Siber</option>
                                <option value="Peringatan Keamanan" {{ $artikel->kategori == 'Peringatan Keamanan' ? 'selected' : '' }}>Peringatan Keamanan</option>
                                <option value="Panduan Mitigasi" {{ $artikel->kategori == 'Panduan Mitigasi' ? 'selected' : '' }}>Panduan Mitigasi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Penulis</label>
                            <input type="text" name="penulis" value="{{ $artikel->penulis }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-amber-500 focus:border-amber-500">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Link Gambar *Thumbnail*</label>
                        <input type="url" name="gambar" value="{{ $artikel->gambar }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-amber-500 focus:border-amber-500">
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Isi Konten Berita</label>
                        <textarea name="konten" rows="8" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-amber-500 focus:border-amber-500">{{ $artikel->konten }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-6 rounded transition-colors shadow-md uppercase text-sm tracking-wider">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>