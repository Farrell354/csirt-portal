<!-- resources/views/components/footer.blade.php -->
<footer class="bg-slate-950 text-gray-400 py-16 border-t border-slate-800/80 mt-auto w-full z-10 relative overflow-hidden shadow-[0_-10px_30px_rgba(0,0,0,0.3)]">
    
    <!-- Efek Cahaya Ambient di Background Footer -->
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[600px] h-32 bg-blue-600/5 blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
            
            <!-- Kolom 1: Kategori -->
            <div>
                <h4 class="text-white font-black tracking-widest mb-6 uppercase text-xs flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-blue-500 shadow-[0_0_8px_#3b82f6]"></span>
                    Kategori
                </h4>
                <ul class="space-y-3 text-sm font-medium">
                    <li>
                        <a href="/artikel?kategori=Peringatan Keamanan" class="hover:text-blue-400 transition-all duration-300 flex items-center gap-2 group">
                            <span class="text-blue-500 group-hover:translate-x-1 transition-transform">&#8250;</span> Peringatan Keamanan
                        </a>
                    </li>
                    <li>
                        <a href="/artikel?kategori=Berita Keamanan Siber" class="hover:text-blue-400 transition-all duration-300 flex items-center gap-2 group">
                            <span class="text-blue-500 group-hover:translate-x-1 transition-transform">&#8250;</span> Berita Keamanan Siber
                        </a>
                    </li>
                    <li>
                        <a href="/artikel?kategori=Personal" class="hover:text-blue-400 transition-all duration-300 flex items-center gap-2 group">
                            <span class="text-blue-500 group-hover:translate-x-1 transition-transform">&#8250;</span> Personal
                        </a>
                    </li>
                    <li>
                        <a href="/artikel?kategori=Web Programming" class="hover:text-blue-400 transition-all duration-300 flex items-center gap-2 group">
                            <span class="text-blue-500 group-hover:translate-x-1 transition-transform">&#8250;</span> Web Programming
                        </a>
                    </li>
                    <li>
                        <a href="/artikel?kategori=Web Design" class="hover:text-blue-400 transition-all duration-300 flex items-center gap-2 group">
                            <span class="text-blue-500 group-hover:translate-x-1 transition-transform">&#8250;</span> Web Design
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kolom 2: Artikel Terkini -->
            <div>
                <h4 class="text-white font-black tracking-widest mb-6 uppercase text-xs flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-cyan-400 shadow-[0_0_8px_#22d3ee]"></span>
                    Artikel Terkini
                </h4>
                
                @php
                    $artikelFooter = App\Models\Artikel::orderBy('tanggal_publikasi', 'desc')->take(2)->get();
                @endphp
                
                <ul class="space-y-4 text-sm font-medium">
                    @forelse($artikelFooter as $art)
                    <li>
                        <a href="/artikel/{{ $art->id }}" class="hover:text-blue-400 transition-colors line-clamp-2 leading-relaxed group block">
                            <span class="text-xs text-gray-500 block mb-1 font-mono">{{ \Carbon\Carbon::parse($art->tanggal_publikasi)->format('d M Y') }}</span>
                            <span class="group-hover:underline">{{ $art->judul }}</span>
                        </a>
                    </li>
                    @empty
                    <li class="text-gray-500 italic">Belum ada artikel.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Kolom 3: Kontak Kami -->
            <div>
                <h4 class="text-white font-black tracking-widest mb-6 uppercase text-xs flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_8px_#34d399]"></span>
                    Kontak Kami
                </h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="leading-relaxed">Jl. Ahmad Yani 242-244 Surabaya</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
                        <span>csirt@jatimprov.go.id</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>(031) 8294608</span>
                    </li>
                </ul>
            </div>

            <!-- Kolom 4: Peta Lokasi -->
            <div>
                <h4 class="text-white font-black tracking-widest mb-6 uppercase text-xs flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-orange-400 shadow-[0_0_8px_#fbbf24]"></span>
                    Lokasi Server & Kantor
                </h4>
                <div class="w-full h-44 bg-slate-900 rounded-xl overflow-hidden border border-slate-700/80 shadow-lg relative group">
                    <!-- Google Maps Iframe Dinas Kominfo Jatim -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.1555767345276!2d112.72918!3d-7.336418999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb44a7ee2a07%3A0xa372a10f76837d5b!2sDinas%20Komunikasi%20dan%20Informatika%20Provinsi%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1785204694076!5m2!1sid!2sid" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" class="filter contrast-125 opacity-80 group-hover:opacity-100 transition-opacity"></iframe>
                </div>
            </div>
            
        </div>

        <!-- Copyright Bar -->
        <div class="border-t border-slate-800/80 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-[11px] text-gray-500 uppercase tracking-widest font-mono">
                Copyright &copy; {{ date('Y') }} <span class="text-gray-300 font-bold">JATIMPROV-CSIRT</span>. All Rights Reserved.
            </p>
            <div class="flex items-center gap-4 text-xs font-mono text-gray-500">
                <span class="flex items-center gap-1.5"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-ping"></span> SECURE PROTOCOL ACTIVE</span>
            </div>
        </div>

    </div>
</footer>