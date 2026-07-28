<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan CSIRT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pengaturan khusus saat dicetak (Print) */
        @media print {
            body { background-color: white; }
            @page { size: A4 portrait; margin: 15mm; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-gray-200 text-black font-serif text-sm">

    <!-- Tombol Navigasi (Disembunyikan saat dicetak) -->
    <div class="no-print max-w-4xl mx-auto my-6 flex justify-between bg-white p-4 rounded-xl shadow">
        <a href="/admin/laporan" class="text-gray-600 hover:text-blue-600 font-bold px-4 py-2">&larr; Kembali</a>
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Dokumen (PDF)
        </button>
    </div>

    <!-- Kertas A4 -->
    <div class="max-w-4xl mx-auto bg-white p-10 min-h-[297mm] shadow-lg print:shadow-none print:p-0 print:m-0">
        
        <!-- KOP SURAT -->
        <div class="border-b-4 border-black pb-4 mb-6 flex items-center justify-between">
            <!-- Bisa diganti logo JatimProv -->
            <div class="w-20">
                <img src="{{ asset('img/logo-csirt.png') }}" alt="Logo Jatim" class="w-full">
            </div>
            <div class="text-center flex-1">
                <h1 class="text-xl font-bold uppercase tracking-wider">Pemerintah Provinsi Jawa Timur</h1>
                <h2 class="text-2xl font-black uppercase tracking-widest mt-1">Dinas Komunikasi dan Informatika</h2>
                <h3 class="text-lg font-bold">Tim Tanggap Insiden Siber (JatimProv-CSIRT)</h3>
                <p class="text-xs mt-1">Jl. Ahmad Yani No. 242-244, Gayungan, Surabaya, Jawa Timur 60235</p>
                <p class="text-xs">Email: csirt@jatimprov.go.id | Telp: (031) 8294608</p>
            </div>
            <div class="w-20"></div> <!-- Spacer biar teks tetap di tengah -->
        </div>

        <!-- JUDUL LAPORAN -->
        <div class="text-center mb-8">
            <h3 class="text-lg font-bold underline uppercase">Rekapitulasi Laporan Kerentanan Keamanan Siber</h3>
            <p class="text-sm mt-1">Periode: {{ date('d F Y') }}</p>
        </div>

        <!-- TABEL DATA -->
        <table class="w-full border-collapse border border-black mb-8 text-sm">
            <thead>
                <tr class="bg-gray-100 text-center">
                    <th class="border border-black p-2 w-10">No</th>
                    <th class="border border-black p-2">Tanggal</th>
                    <th class="border border-black p-2">Pelapor (Hunter)</th>
                    <th class="border border-black p-2">Jenis Kerentanan</th>
                    <th class="border border-black p-2">Target URL</th>
                    <th class="border border-black p-2">Status</th>
                    <th class="border border-black p-2 w-16">Poin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporans as $index => $laporan)
                <tr>
                    <td class="border border-black p-2 text-center">{{ $index + 1 }}</td>
                    <td class="border border-black p-2 whitespace-nowrap">{{ \Carbon\Carbon::parse($laporan->created_at)->format('d/m/Y') }}</td>
                    <td class="border border-black p-2 font-semibold">{{ $laporan->user->name ?? 'Anonim' }}</td>
                    <td class="border border-black p-2">{{ $laporan->jenis_kerentanan }}</td>
                    <td class="border border-black p-2 text-blue-600 underline text-xs break-all">{{ $laporan->target_url }}</td>
                    <td class="border border-black p-2 text-center font-bold">
                        @if($laporan->status === 'Valid') ✅ Valid
                        @elseif($laporan->status === 'Ditolak') ❌ Ditolak
                        @else ⌛ Proses
                        @endif
                    </td>
                    <td class="border border-black p-2 text-center font-bold">{{ $laporan->poin_diberikan ?? 0 }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="border border-black p-4 text-center text-gray-500">Belum ada data laporan yang masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- TANDA TANGAN -->
        <div class="flex justify-end mt-12">
            <div class="text-center">
                <p>Surabaya, {{ date('d F Y') }}</p>
                <p class="font-bold mt-1">Admin JatimProv-CSIRT,</p>
                <br><br><br>
                <p class="font-bold underline">{{ auth()->user()->name ?? 'Administrator' }}</p>
                <p class="text-xs">NIP. 19801231 200501 1 001</p>
            </div>
        </div>

    </div>

</body>
</html>