<footer class="bg-[#161b22] text-gray-300 pt-12 pb-6 border-t border-gray-800 transition-colors duration-300">
    <!-- WADAH UTAMA (Membatasi lebar agar sejajar dengan Navbar) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- GRID 4 KOLOM -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            
            <!-- Kolom 1: Kategori -->
            <div>
                <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4 pb-2 border-b border-gray-700">Kategori</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span class="text-blue-500">•</span> Peringatan Keamanan</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span class="text-blue-500">•</span> Berita Keamanan Siber</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span class="text-blue-500">•</span> Panduan Mitigasi</a></li>
                </ul>
            </div>

            <!-- Kolom 2: Artikel Terkini -->
            <div>
                <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4 pb-2 border-b border-gray-700">Artikel Terkini</h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="artikel/ungkap-aktivitas-apt-turla" class="hover:text-blue-400 transition hover:underline line-clamp-2">
                            Ungkap Aktivitas APT Turla, Lebih dari 107 Ribu Indikasi Kompromi...
                        </a>
                    </li>
                    <li>
                        <a href="artikel/ransomware-berbasis-ai-otonom-pertama" class="hover:text-blue-400 transition hover:underline line-clamp-2">
                            Ransomware Berbasis AI Otonom Pertama Terungkap...
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kolom 3: Kontak Kami -->
            <div>
                <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4 pb-2 border-b border-gray-700">Kontak Kami</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Jl. Ahmad Yani 242-244 Surabaya</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <a href="mailto:csirt@jatimprov.go.id" class="hover:text-blue-400 transition">csirt@jatimprov.go.id</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>(031) 8294608</span>
                    </li>
                </ul>
            </div>

            <!-- Kolom 4: Lokasi / Peta -->
            <div>
                <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-4 pb-2 border-b border-gray-700">Lokasi</h4>
                <div class="w-full h-36 rounded-lg overflow-hidden border border-gray-700 shadow-sm">
                    <iframe 
                        class="w-full h-full border-0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.291771192801!2d112.7303357!3d-7.3211181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb217f22312d%3A0xb3514c6fb73d120a!2sDinas%20Komunikasi%20dan%20Informatika%20Provinsi%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>

        <!-- GARIS PONDASI & COPYRIGHT -->
        <div class="border-t border-gray-800 pt-6 text-center text-xs text-gray-500">
            <p>COPYRIGHT © {{ date('Y') }} <span class="font-bold text-gray-400">JATIMPROV-CSIRT</span>. ALL RIGHTS RESERVED.</p>
        </div>

    </div>
</footer>