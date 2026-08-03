<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Hunter - JatimProv CSIRT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 font-sans flex flex-col min-h-screen transition-colors duration-300">
    
    <x-navbar />

    <div class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        
        <!-- Kartu Selamat Datang -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6 md:p-8 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 transition-colors duration-300">
            <div>
                <h1 class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white tracking-tight">Selamat datang, <span class="text-blue-600 dark:text-blue-400">{{ auth()->user()->name ?? 'Hunter' }}</span>! 👋</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Ini adalah pusat kendali Anda untuk memantau status laporan dan reputasi.</p>
            </div>
            <a href="/dashboard/lapor" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-all shadow-lg shadow-blue-600/30 dark:shadow-none hover:shadow-xl hover:-translate-y-0.5 flex items-center gap-2 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Kirim Laporan Bug
            </a>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6 relative overflow-hidden group hover:border-blue-300 dark:hover:border-blue-500 transition-colors duration-300">
                <div class="relative z-10">
                    <div class="text-gray-400 dark:text-gray-500 text-xs font-black uppercase tracking-widest mb-1">Total Poin Reputasi</div>
                    <div class="text-4xl font-black text-gray-800 dark:text-white">0 <span class="text-lg text-gray-400 dark:text-gray-500 font-bold">Pts</span></div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6 relative overflow-hidden group hover:border-emerald-300 dark:hover:border-emerald-500 transition-colors duration-300">
                <div class="relative z-10">
                    <div class="text-gray-400 dark:text-gray-500 text-xs font-black uppercase tracking-widest mb-1">Laporan Valid</div>
                    <div class="text-4xl font-black text-emerald-500 dark:text-emerald-400">0</div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6 relative overflow-hidden group hover:border-amber-300 dark:hover:border-amber-500 transition-colors duration-300">
                <div class="relative z-10">
                    <div class="text-gray-400 dark:text-gray-500 text-xs font-black uppercase tracking-widest mb-1">Sedang Diproses</div>
                    <div class="text-4xl font-black text-amber-500 dark:text-amber-400">0</div>
                </div>
            </div>
        </div>

        <!-- Riwayat Laporan -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden transition-colors duration-300">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-slate-700 bg-gray-50/50 dark:bg-slate-800/80 flex justify-between items-center transition-colors duration-300">
                <h2 class="font-bold text-gray-800 dark:text-gray-200 text-lg">Riwayat Laporan Terakhir</h2>
            </div>
            
            <div class="p-16 text-center">
                <h3 class="text-gray-900 dark:text-white font-bold mb-1">Belum ada aktivitas</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Anda belum mengirimkan laporan kerentanan apapun. Mulai perburuan Anda sekarang!</p>
            </div>
        </div>

    </div>

    <x-chatbot />
</body>
</html>