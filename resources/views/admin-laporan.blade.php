<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verifikasi Laporan Bug Hunter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Sukses -->
            @if(session('pesan'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm font-bold">
                {{ session('pesan') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-800 text-white border-b-2 border-gray-200">
                                <th class="p-3 font-semibold rounded-tl-lg">Identitas Hunter</th>
                                <th class="p-3 font-semibold">Target & Kerentanan</th>
                                <th class="p-3 font-semibold">Deskripsi & Bukti</th>
                                <th class="p-3 font-semibold">Status</th>
                                <th class="p-3 font-semibold rounded-tr-lg">Aksi Validasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporans as $laporan)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <!-- Hunter -->
                                <td class="p-3 align-top">
                                    <div class="font-black text-blue-700">{{ $laporan->user->name }}</div>
                                    <div class="text-xs text-gray-500 font-medium">{{ $laporan->user->email }}</div>
                                </td>
                                
                                <!-- Target & Bug -->
                                <td class="p-3 align-top">
                                    <div class="font-mono text-sm text-red-600 mb-1 font-bold">{{ $laporan->target_url }}</div>
                                    <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded text-xs font-bold">{{ $laporan->jenis_kerentanan }}</span>
                                </td>
                                
                                <!-- PoC -->
                                <td class="p-3 align-top text-sm max-w-xs">
                                    <div class="truncate mb-2 text-gray-600" title="{{ $laporan->deskripsi }}">{{ $laporan->deskripsi }}</div>
                                    <a href="{{ $laporan->bukti_poc }}" target="_blank" class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-2 py-1 rounded text-xs font-bold transition-colors">Lihat Bukti (PoC) 🔗</a>
                                </td>
                                
                                <!-- Status -->
                                <td class="p-3 align-top">
                                    @if($laporan->status == 'Menunggu')
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">⏳ Menunggu</span>
                                    @elseif($laporan->status == 'Valid')
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">✅ Valid (+{{ $laporan->poin_diberikan }})</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-bold">❌ Ditolak</span>
                                    @endif
                                </td>
                                
                                <!-- Aksi -->
                                <td class="p-3 align-top">
                                    @if($laporan->status == 'Menunggu')
                                    <form action="/admin/laporan/{{ $laporan->id }}/validasi" method="POST" class="flex flex-col space-y-2">
                                        @csrf
                                        <input type="number" name="poin" placeholder="Beri Poin (Mis: 50)" required class="w-full text-sm border-gray-300 rounded px-2 py-1 focus:ring-blue-500 focus:border-blue-500 font-bold">
                                        <div class="flex space-x-2">
                                            <button type="submit" name="status" value="Valid" class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-xs font-bold transition-colors w-full cursor-pointer">Sah (Valid)</button>
                                            <button type="submit" name="status" value="Ditolak" onclick="this.form.poin.value=0;" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs font-bold transition-colors w-full cursor-pointer">Tolak</button>
                                        </div>
                                    </form>
                                    @else
                                    <span class="text-gray-400 italic text-sm font-medium">Sudah diproses</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500 font-medium">Belum ada laporan bug yang masuk dari para Hunter.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>