<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Laporan Bug - JatimProv CSIRT</title>
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
            <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Kirim Laporan Kerentanan</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">Bantu kami mengamankan ekosistem digital JatimProv. Pastikan laporan Anda menyertakan bukti (PoC) yang jelas.</p>
        </div>

        <!-- Area Form -->
        <div class="bg-white dark:bg-slate-800 rounded-b-2xl shadow-sm p-8 mt-1 border border-gray-100 dark:border-slate-700">
            
            <form action="/dashboard/lapor" method="POST">
                @csrf

                <!-- Target URL -->
                <div class="mb-6">
                    <label for="target_url" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Target URL / Domain <span class="text-red-500">*</span></label>
                    <input type="url" name="target_url" id="target_url" required placeholder="https://vulnerable-domain.jatimprov.go.id/path" 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white transition-all font-mono text-sm">
                </div>

                <!-- Jenis Kerentanan -->
                <div class="mb-6">
                    <label for="jenis_kerentanan" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Jenis Kerentanan (Vulnerability) <span class="text-red-500">*</span></label>
                    <select name="jenis_kerentanan" id="jenis_kerentanan" required class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white cursor-pointer transition-all">
                        <option value="" disabled selected>-- Pilih Kategori Kerentanan --</option>
                        <option value="SQL Injection (SQLi)">SQL Injection (SQLi)</option>
                        <option value="Cross-Site Scripting (XSS)">Cross-Site Scripting (XSS)</option>
                        <option value="Insecure Direct Object Reference (IDOR)">Insecure Direct Object Reference (IDOR)</option>
                        <option value="Remote Code Execution (RCE)">Remote Code Execution (RCE)</option>
                        <option value="Information Disclosure">Information Disclosure</option>
                        <option value="Lainnya">Lainnya...</option>
                    </select>
                </div>

                <!-- Deskripsi Dampak -->
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Deskripsi & Dampak Kerentanan <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" required placeholder="Jelaskan apa kerentanannya dan apa dampak terburuk jika celah ini dieksploitasi oleh pihak tak bertanggung jawab..." 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white transition-all leading-relaxed"></textarea>
                </div>

                <!-- Proof of Concept (PoC) -->
                <div class="mb-8">
                    <label for="bukti_poc" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Langkah Reproduksi (Proof of Concept) <span class="text-red-500">*</span></label>
                    <textarea name="bukti_poc" id="bukti_poc" rows="6" required placeholder="1. Buka URL target&#10;2. Masukkan payload berikut pada parameter 'id': ' OR 1=1--&#10;3. Klik tombol submit&#10;4. Halaman akan menampilkan seluruh data database" 
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-emerald-400 font-mono transition-all leading-relaxed text-sm placeholder-gray-600"></textarea>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">*Tuliskan langkah-langkah secara sistematis agar tim CSIRT dapat mereproduksi dan memvalidasi temuan Anda.</p>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end gap-3 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <a href="/dashboard" class="px-6 py-3.5 text-gray-500 dark:text-gray-400 font-bold hover:bg-gray-100 dark:hover:bg-slate-700 rounded-xl transition-colors text-sm">Batal</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl transition-all shadow-lg shadow-blue-600/30 hover:shadow-xl flex items-center gap-2 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        Kirim Laporan
                    </button>
                </div>
            </form>

        </div>
    </div>

    <x-chatbot />
</body>
</html>