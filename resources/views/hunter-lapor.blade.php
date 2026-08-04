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
            
            <!-- PESAN ERROR VALIDASI (AGAR BOS TAHU KALAU ADA YANG SALAH) -->
            @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/30 border border-red-500 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg relative mb-6">
                    <strong class="font-bold text-sm">Gagal mengirim laporan!</strong>
                    <ul class="list-disc ml-5 mt-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- TAMBAHKAN enctype="multipart/form-data" -->
            <form action="/dashboard/lapor" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Target URL -->
                <div class="mb-6">
                    <label for="target_url" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Target URL / Domain <span class="text-red-500">*</span></label>
                    <input type="url" name="target_url" id="target_url" required placeholder="https://vulnerable-domain.jatimprov.go.id/path" value="{{ old('target_url') }}"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white transition-all font-mono text-sm">
                </div>

                <!-- Jenis Kerentanan -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="bug_type">
                        Kategori Kerentanan <span class="text-red-500">*</span>
                    </label>
                    <select name="jenis_kerentanan" id="jenis_kerentanan" required class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
    <option value="" disabled selected>-- Pilih Jenis Kerentanan --</option>
    <option value="SQL Injection (SQLi)" {{ old('jenis_kerentanan') == 'SQL Injection (SQLi)' ? 'selected' : '' }}>SQL Injection (SQLi)</option>
    <option value="Cross-Site Scripting (XSS)" {{ old('jenis_kerentanan') == 'Cross-Site Scripting (XSS)' ? 'selected' : '' }}>Cross-Site Scripting (XSS)</option>
    <option value="Remote Code Execution (RCE)" {{ old('jenis_kerentanan') == 'Remote Code Execution (RCE)' ? 'selected' : '' }}>Remote Code Execution (RCE)</option>
    <option value="Insecure Direct Object Reference (IDOR)" {{ old('jenis_kerentanan') == 'Insecure Direct Object Reference (IDOR)' ? 'selected' : '' }}>IDOR</option>
    <option value="Cross-Site Request Forgery (CSRF)" {{ old('jenis_kerentanan') == 'Cross-Site Request Forgery (CSRF)' ? 'selected' : '' }}>CSRF</option>
    <option value="Authentication Bypass" {{ old('jenis_kerentanan') == 'Authentication Bypass' ? 'selected' : '' }}>Authentication Bypass</option>
    <option value="Sensitive Data Exposure" {{ old('jenis_kerentanan') == 'Sensitive Data Exposure' ? 'selected' : '' }}>Sensitive Data Exposure</option>
    <option value="Business Logic Flaw" {{ old('jenis_kerentanan') == 'Business Logic Flaw' ? 'selected' : '' }}>Business Logic Flaw</option>
</select>
                </div>

                <!-- Deskripsi Dampak -->
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Deskripsi & Dampak Kerentanan <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" required placeholder="Jelaskan apa kerentanannya dan apa dampak terburuk jika celah ini dieksploitasi oleh pihak tak bertanggung jawab..." 
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-gray-900 dark:text-white transition-all leading-relaxed">{{ old('deskripsi') }}</textarea>
                </div>

                <!-- Proof of Concept (PoC) -->
                <div class="mb-8">
                    <label for="bukti_poc" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Langkah Reproduksi (Proof of Concept) <span class="text-red-500">*</span></label>
                    <textarea name="bukti_poc" id="bukti_poc" rows="6" required placeholder="1. Buka URL target&#10;2. Masukkan payload berikut pada parameter 'id': ' OR 1=1--&#10;3. Klik tombol submit&#10;4. Halaman akan menampilkan seluruh data database" 
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-emerald-400 font-mono transition-all leading-relaxed text-sm placeholder-gray-600">{{ old('bukti_poc') }}</textarea>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">*Tuliskan langkah-langkah secara sistematis agar tim CSIRT dapat mereproduksi dan memvalidasi temuan Anda.</p>
                </div>

                <!-- Lampiran Bukti -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="attachment">
                        Lampiran Bukti (Screenshot / Video) <span class="text-gray-400 font-normal ml-1">(Opsional, tapi sangat disarankan)</span>
                    </label>
                    
                    <div class="flex items-center justify-center w-full">
                        <label for="attachment" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold text-blue-600 dark:text-blue-400">Klik untuk upload</span> atau drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500">PNG, JPG, PDF, atau MP4 (Maks. 5MB)</p>
                            </div>
                            <input id="attachment" name="attachment" type="file" class="hidden" accept=".png, .jpg, .jpeg, .pdf, .mp4" />
                        </label>
                    </div>
                </div>

                <!-- Severity -->
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="severity">
                        Perkiraan Tingkat Keparahan (Severity) <span class="text-red-500">*</span>
                    </label>
                    <select name="severity" id="severity" required class="w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <option value="" disabled selected>-- Pilih Tingkat Keparahan --</option>
                        <option value="Low" {{ old('severity') == 'Low' ? 'selected' : '' }}>🟢 Low (Rendah - Tidak berdampak pada data sensitif)</option>
                        <option value="Medium" {{ old('severity') == 'Medium' ? 'selected' : '' }}>🟡 Medium (Sedang - Berdampak sebagian)</option>
                        <option value="High" {{ old('severity') == 'High' ? 'selected' : '' }}>🟠 High (Tinggi - Berpotensi merusak/mencuri data)</option>
                        <option value="Critical" {{ old('severity') == 'Critical' ? 'selected' : '' }}>🔴 Critical (Kritis - Pengambilalihan server/sistem penuh)</option>
                    </select>
                </div>

                <!-- NDA -->
                <div class="mb-6 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-800 p-4 rounded-lg">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="nda_agreement" required class="mt-1 w-4 h-4 text-blue-500 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 rounded focus:ring-blue-500">
                        <span class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                            <strong>Persetujuan & Kebijakan Privasi (NDA):</strong> Dengan mengirimkan laporan ini, saya setuju untuk merahasiakan celah keamanan ini dan <strong>TIDAK AKAN</strong> mempublikasikannya ke pihak luar/sosial media sampai celah diperbaiki oleh JatimProv-CSIRT. Identitas saya akan dienkripsi dan dilindungi.
                        </span>
                    </label>
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