<!-- Footer Utama -->
<footer class="bg-[#0f172a] text-gray-400 py-12 border-t border-gray-800 mt-auto w-full z-10 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            
            <!-- Kolom 1: Kategori -->
            <div>
                <h4 class="text-white font-black tracking-widest mb-6 uppercase text-xs">Kategori</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="/artikel?kategori=Peringatan Keamanan" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span class="text-blue-500 text-lg leading-none">•</span> Peringatan Keamanan</a></li>
                    <li><a href="/artikel?kategori=Berita Siber" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span class="text-blue-500 text-lg leading-none">•</span> Berita Keamanan Siber</a></li>
                    <li><a href="/artikel?kategori=Panduan Mitigasi" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span class="text-blue-500 text-lg leading-none">•</span> Panduan Mitigasi</a></li>
                </ul>
            </div>

            <!-- Kolom 2: Artikel Terkini -->
            <div>
                <h4 class="text-white font-black tracking-widest mb-6 uppercase text-xs">Artikel Terkini</h4>
                
                <!-- Kita ambil langsung dari database supaya otomatis jalan di halaman manapun -->
                @php
                    $artikelFooter = App\Models\Artikel::orderBy('tanggal_publikasi', 'desc')->take(2)->get();
                @endphp
                
                <ul class="space-y-5 text-sm">
                    @forelse($artikelFooter as $art)
                    <li>
                        <a href="/artikel/{{ $art->id }}" class="hover:text-blue-400 transition-colors line-clamp-2 leading-relaxed">
                            {{ $art->judul }}
                        </a>
                    </li>
                    @empty
                    <li>Belum ada artikel.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Kolom 3: Kontak Kami -->
            <div>
                <h4 class="text-white font-black tracking-widest mb-6 uppercase text-xs">Kontak Kami</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Jl. Ahmad Yani 242-244 Surabaya</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
                        <span>csirt@jatimprov.go.id</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>(031) 8294608</span>
                    </li>
                </ul>
            </div>

            <!-- Kolom 4: Peta Lokasi -->
            <div>
                <div class="w-full h-48 md:h-full min-h-[220px] bg-gray-800 rounded-xl overflow-hidden border border-gray-700 shadow-inner">
                    <!-- Google Maps Iframe Dinas Kominfo Jatim -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.1555767345276!2d112.72918!3d-7.336418999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb44a7ee2a07%3A0xa372a10f76837d5b!2sDinas%20Komunikasi%20dan%20Informatika%20Provinsi%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1785204694076!5m2!1sid!2sid" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                </div>
            </div>
            
        </div>

        <!-- Copyright Bar -->
        <div class="border-t border-gray-800 pt-8 flex flex-col justify-center items-center">
            <p class="text-[10px] text-gray-500 uppercase tracking-widest text-center font-bold">
                Copyright &copy; {{ date('Y') }} <span class="text-gray-300">JATIMPROV-CSIRT</span>. All Rights Reserved.
            </p>
        </div>

    </div>
</footer>