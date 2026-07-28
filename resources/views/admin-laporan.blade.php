<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Laporan Bug - JatimProv CSIRT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 font-sans flex flex-col min-h-screen transition-colors duration-300">

    <x-navbar />

    <div class="flex-grow max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        
        <!-- Header & Tombol Kembali -->
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <a href="/dashboard" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 mb-4 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Dashboard
                </a>
                <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Verifikasi Laporan Bug</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Tinjau, validasi kerentanan, dan berikan poin reputasi kepada para Bug Hunter.</p>
            </div>
            
            <!-- TOMBOL CETAK LAPORAN -->
            <a href="/admin/laporan/cetak" target="_blank" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold py-2.5 px-5 rounded-lg transition-all shadow-md flex items-center justify-center gap-2 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Rekap (PDF)
            </a>
        </div>

        <!-- Notifikasi Sukses Validasi -->
        @if(session('pesan'))
            <div class="mb-6 bg-emerald-100 dark:bg-emerald-900/30 border border-emerald-400 dark:border-emerald-700 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-xl flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-bold">{{ session('pesan') }}</span>
            </div>
        @endif

        <!-- Daftar Laporan (Looping Card) -->
        <div class="space-y-6">
            @forelse($laporans as $laporan)
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                    
                    <!-- Header Card -->
                    <div class="p-6 border-b border-gray-200 dark:border-slate-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400 mb-1 block">{{ $laporan->jenis_kerentanan }}</span>
                            <h3 class="text-lg font-black text-gray-900 dark:text-white">{{ $laporan->target_url }}</h3>
                        </div>
                        <div>
                            @if($laporan->status === 'Menunggu')
                                <span class="bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-400 text-xs font-bold px-3 py-1.5 rounded-lg border border-amber-300 dark:border-amber-700">⌛ Menunggu Review</span>
                            @elseif($laporan->status === 'Valid')
                                <span class="bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-400 text-xs font-bold px-3 py-1.5 rounded-lg border border-emerald-300 dark:border-emerald-700">✅ Valid (+{{ $laporan->poin_diberikan }} Poin)</span>
                            @else
                                <span class="bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-400 text-xs font-bold px-3 py-1.5 rounded-lg border border-red-300 dark:border-red-700">❌ Ditolak</span>
                            @endif
                        </div>
                    </div>

                    <!-- Body Card (Isi Laporan) -->
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50/30 dark:bg-slate-800/50">
                        <div>
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Dilaporkan Oleh</div>
                            <div class="font-bold text-gray-900 dark:text-gray-200 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                {{ $laporan->user->name ?? 'Unknown Hunter' }}
                            </div>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Waktu Pelaporan</div>
                            <div class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y - H:i WIB') }}
                            </div>
                        </div>
                        
                        <div class="md:col-span-2 mt-2">
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Deskripsi Dampak</div>
                            <div class="bg-white dark:bg-slate-900/50 border border-gray-200 dark:border-slate-700 p-4 rounded-xl text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $laporan->deskripsi }}
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Langkah Reproduksi (PoC)</div>
                            <div class="bg-gray-900 text-gray-300 p-4 rounded-xl text-sm font-mono whitespace-pre-wrap overflow-x-auto border border-gray-800">
{{ $laporan->bukti_poc }}
                            </div>
                        </div>
                    </div>

                    <!-- Area Aksi (Hanya muncul jika belum Valid/Ditolak atau ingin diubah) -->
                    <div class="p-6 border-t border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800">
                        <form action="/admin/laporan/{{ $laporan->id }}/validasi" method="POST" class="flex flex-col sm:flex-row items-end gap-4">
                            @csrf
                            <div class="w-full sm:w-1/3">
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-2">Keputusan Tim CSIRT</label>
                                <select name="status" class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white cursor-pointer">
                                    <option value="Menunggu" {{ $laporan->status == 'Menunggu' ? 'selected' : '' }}>⌛ Menunggu Review</option>
                                    <option value="Valid" {{ $laporan->status == 'Valid' ? 'selected' : '' }}>✅ Valid (Terima)</option>
                                    <option value="Ditolak" {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>❌ Ditolak (Invalid/Duplikat)</option>
                                </select>
                            </div>
                            <div class="w-full sm:w-1/4">
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-2">Poin Reputasi</label>
                                <input type="number" name="poin" value="{{ $laporan->poin_diberikan ?? 0 }}" min="0" placeholder="Misal: 50" class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white font-bold text-center">
                            </div>
                            <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-md shadow-indigo-500/30 hover:shadow-lg shrink-0">
                                Eksekusi
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <!-- Tampilan jika tidak ada laporan sama sekali -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-dashed border-gray-300 dark:border-slate-600 p-16 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Kotak Masuk Kosong</h3>
                    <p class="text-gray-500 dark:text-gray-400">Belum ada laporan kerentanan yang masuk dari para Bug Hunter.</p>
                </div>
            @endforelse
        </div>

    </div>

    <x-chatbot />
</body>
</html>