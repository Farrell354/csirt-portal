        <!-- ═══════════════════════════════════════════════════════
             LATEST INTEL (ARTICLES)
        ═══════════════════════════════════════════════════════ -->
        <section class="bg-gray-50 dark:bg-[#030712] py-16 sm:py-24 lg:py-32 relative overflow-hidden">

            <div class="absolute inset-0 bg-mesh-grid opacity-60 dark:opacity-30 pointer-events-none" aria-hidden="true"></div>
            <div class="absolute -top-24 right-0 w-[50vw] h-[50vw] bg-indigo-600/5 dark:bg-indigo-900/10 rounded-full blur-[160px] pointer-events-none" aria-hidden="true"></div>

            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <!-- Section Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 sm:gap-6 mb-8 sm:mb-12 lg:mb-16 reveal-on-scroll">
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="h-1 w-8 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full"></div>
                            <span class="font-mono text-[9px] sm:text-[10px] font-bold text-cyan-600 dark:text-cyan-500 uppercase tracking-[0.15em] sm:tracking-[0.2em]">Security Advisories</span>
                        </div>
                        <h2 class="font-display text-3xl sm:text-4xl md:text-5xl font-black tracking-tighter text-gray-900 dark:text-white">
                            Publikasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-cyan-400 dark:to-blue-400">Intelijen</span>
                        </h2>
                    </div>

                    <a href="/artikel" class="group self-start sm:self-auto shrink-0 inline-flex items-center gap-2 font-mono text-[10px] sm:text-[11px] font-bold text-gray-600 dark:text-gray-400 uppercase tracking-widest px-5 py-2.5 sm:px-6 sm:py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl hover:bg-gray-900 hover:text-white dark:hover:bg-white dark:hover:text-gray-900 active:scale-95 transition-all">
                        Seluruh Arsip
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <!-- Articles Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8">
                    @foreach($artikelTerkini as $index => $artikel)
                    <article class="card-tilt group relative flex flex-col rounded-2xl sm:rounded-3xl overflow-hidden bg-white/80 dark:bg-gray-900/60 backdrop-blur-xl border border-gray-200/50 dark:border-gray-800/80 shadow-sm hover:shadow-xl hover:shadow-cyan-500/5 dark:hover:shadow-cyan-500/10 transition-shadow duration-300 reveal-on-scroll">

                        <!-- Top Accent Line -->
                        <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-blue-500 via-cyan-400 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10" aria-hidden="true"></div>

                        <!-- Image -->
                        <div class="relative h-48 sm:h-52 lg:h-60 bg-gray-100 dark:bg-gray-800 overflow-hidden shrink-0">
                            <img src="{{ $artikel->gambar }}" alt="{{ $artikel->judul }}" loading="lazy" class="w-full h-full object-cover scale-100 group-hover:scale-105 transition-transform duration-700 ease-out">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 via-gray-900/20 to-transparent"></div>

                            <div class="absolute top-4 left-4 sm:top-5 sm:left-5">
                                <span class="inline-block bg-black/30 backdrop-blur-md border border-white/10 text-white font-mono text-[8px] sm:text-[9px] font-bold px-2.5 py-1 sm:px-3 uppercase tracking-[0.1em] sm:tracking-[0.15em] rounded-full group-hover:border-cyan-400/40 group-hover:text-cyan-300 transition-colors">
                                    {{ $artikel->kategori }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5 sm:p-6 lg:p-8 flex-grow flex flex-col">
                            <div class="flex items-center gap-2 font-mono text-[8px] sm:text-[9px] text-gray-500 mb-3 sm:mb-4 uppercase tracking-[0.1em] font-bold">
                                <svg class="w-3 h-3 text-blue-500 dark:text-cyan-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('d M Y') }}
                            </div>

                            <h3 class="font-display font-bold text-base sm:text-lg lg:text-xl leading-snug text-gray-900 dark:text-white mb-4 group-hover:text-blue-600 dark:group-hover:text-cyan-400 transition-colors line-clamp-3 break-words">
                                {{ $artikel->judul }}
                            </h3>

                            <div class="mt-auto pt-4 sm:pt-5 flex items-center justify-between border-t border-gray-100 dark:border-gray-800/60">
                                <div class="inline-flex items-center gap-1.5 sm:gap-2 font-mono text-[8px] sm:text-[9px] uppercase tracking-widest text-gray-500">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 dark:bg-cyan-500 shrink-0"></span>
                                    <span class="truncate max-w-[100px] sm:max-w-[120px]">{{ $artikel->penulis }}</span>
                                </div>

                                <a href="/artikel/{{ $artikel->id }}" class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 dark:text-gray-400 group-hover:bg-gray-900 group-hover:text-white dark:group-hover:bg-cyan-500 dark:group-hover:text-gray-900 transition-colors shrink-0" aria-label="Baca artikel">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

