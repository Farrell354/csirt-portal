<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulir Laporan Kerentanan (VDP)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="mb-6 border-l-4 border-blue-600 bg-blue-50 p-4 rounded">
                        <h3 class="font-bold text-blue-800 text-lg mb-2">Panduan Pelaporan:</h3>
                        <ul class="list-disc list-inside text-sm text-blue-700">
                            <li>Pastikan target domain berada di bawah naungan jatimprov.go.id.</li>
                            <li>Sertakan langkah-langkah reproduksi (PoC) yang jelas agar mudah diverifikasi.</li>
                            <li>Laporan yang valid akan mendapatkan poin reputasi sesuai tingkat keparahan.</li>
                        </ul>
                    </div>

                    <!-- Form Input Laporan -->
                    <form action="/dashboard/lapor" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Target URL -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Target URL (Yang Diretas/Rentan)</label>
                            <input type="url" name="target_url" placeholder="https://dinascontoh.jatimprov.go.id" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Jenis Kerentanan -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kerentanan (Bug)</label>
                            <select name="jenis_kerentanan" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="" disabled selected>-- Pilih Kategori Bug --</option>
                                <option value="SQL Injection (SQLi)">SQL Injection (SQLi)</option>
                                <option value="Cross-Site Scripting (XSS)">Cross-Site Scripting (XSS)</option>
                                <option value="Remote Code Execution (RCE)">Remote Code Execution (RCE)</option>
                                <option value="Insecure Direct Object Reference (IDOR)">Insecure Direct Object Reference (IDOR)</option>
                                <option value="Information Disclosure">Information Disclosure</option>
                                <option value="Lainnya">Lainnya...</option>
                            </select>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi & Dampak</label>
                            <textarea name="deskripsi" rows="4" placeholder="Jelaskan bagaimana bug ini bekerja dan apa dampaknya jika dieksploitasi..." required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>

                        <!-- Bukti PoC -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Bukti Eksploitasi (Proof of Concept)</label>
                            <input type="text" name="bukti_poc" placeholder="Sertakan link gambar (Imgur) atau video bukti eksploitasi" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end pt-4">
                            <a href="/dashboard" class="text-gray-500 hover:text-gray-700 font-medium mr-4">Batal</a>
                            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                                Kirim Laporan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>