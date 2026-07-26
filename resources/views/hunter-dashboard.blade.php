<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hunter Workspace') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Kartu Profil & Poin Hunter -->
            <div class="bg-blue-900 overflow-hidden shadow-sm sm:rounded-lg mb-6 text-white">
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}! 🕵️‍♂️</h3>
                        <p class="text-blue-200 mt-1">Selamat datang di program Bug Bounty JatimProv-CSIRT.</p>
                    </div>
                    <div class="text-right bg-blue-800 p-4 rounded-xl border border-blue-700">
                        <p class="text-sm text-blue-300 uppercase tracking-wider font-bold">Total Poin Reputasi</p>
                        <p class="text-4xl font-black text-yellow-400">{{ Auth::user()->poin }} <span class="text-lg text-yellow-200">pts</span></p>
                    </div>
                </div>
            </div>

            <!-- Tabel Riwayat Laporan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Riwayat Laporan Temuan</h3>
                        <a href="/dashboard/lapor" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                            + Lapor Celah Keamanan
                        </a>
                    </div>

                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-200">
                                <th class="p-3 font-semibold text-gray-700">Tanggal</th>
                                <th class="p-3 font-semibold text-gray-700">Target URL</th>
                                <th class="p-3 font-semibold text-gray-700">Jenis Bug</th>
                                <th class="p-3 font-semibold text-gray-700">Status</th>
                                <th class="p-3 font-semibold text-gray-700">Poin Didapat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporans as $laporan)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="p-3">{{ $laporan->created_at->format('d M Y') }}</td>
                                <td class="p-3 font-mono text-sm text-blue-600">{{ $laporan->target_url }}</td>
                                <td class="p-3"><span class="bg-gray-200 px-2 py-1 rounded text-xs font-bold">{{ $laporan->jenis_kerentanan }}</span></td>
                                <td class="p-3">
                                    @if($laporan->status == 'Menunggu')
                                        <span class="text-yellow-600 font-bold">⏳ Menunggu</span>
                                    @elseif($laporan->status == 'Valid')
                                        <span class="text-green-600 font-bold">✅ Valid</span>
                                    @else
                                        <span class="text-red-600 font-bold">❌ Ditolak</span>
                                    @endif
                                </td>
                                <td class="p-3 font-bold text-green-600">+{{ $laporan->poin_diberikan }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-500 italic">Belum ada laporan celah keamanan yang disubmit.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>