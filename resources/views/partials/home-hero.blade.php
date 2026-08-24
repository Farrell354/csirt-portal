        <!-- ═══════════════════════════════════════════════════════
             HERO
        ═══════════════════════════════════════════════════════ -->
        <header class="scanlines relative w-full min-h-screen flex items-center justify-center overflow-hidden">

            <!-- Dark base -->
            <div class="absolute inset-0 bg-slate-950 z-0"></div>

            <!-- Photo -->
            <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                <img
                    src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=1200&auto=format&fit=crop"
                    alt=""
                    loading="eager"
                    class="w-full h-full object-cover opacity-[0.12] grayscale animate-pan-bg"
                >
                <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/60 to-slate-950"></div>
            </div>

            <!-- Ambient Orbs -->
            <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                <div class="absolute top-[15%] left-[10%] w-[40vw] max-w-[500px] h-[40vw] max-h-[500px] bg-cyan-600/10 rounded-full blur-[120px] animate-pulse"></div>
                <div class="absolute bottom-[5%] right-[5%] w-[35vw] max-w-[400px] h-[35vw] max-h-[400px] bg-indigo-600/10 rounded-full blur-[100px]"></div>
            </div>

            <!-- Interactive Neural-Net Canvas (desktop only) -->
            <canvas id="neural-canvas" aria-hidden="true"></canvas>

            <!-- ─── Hero Content ─── -->
            <div class="relative z-10 w-full max-w-5xl mx-auto px-5 sm:px-8 lg:px-8 text-center flex flex-col items-center pt-28 pb-28 sm:pt-32 sm:pb-36">

                <!-- Status Badge -->
                <div class="opacity-0 animate-fade-in-up mb-6 sm:mb-8">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-slate-900/70 border border-cyan-500/20 text-cyan-400 font-mono text-[9px] sm:text-[10px] font-bold tracking-[0.2em] uppercase rounded-full backdrop-blur-xl shadow-[0_0_30px_rgba(6,182,212,0.1)]">
                        <span class="relative flex h-1.5 w-1.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-cyan-500 shadow-[0_0_6px_rgba(6,182,212,0.8)]"></span>
                        </span>
                        <span class="hidden sm:inline">ALL SYSTEMS OPERATIONAL //&nbsp;</span>JATIM SHIELD ACTIVE
                    </div>
                </div>

                <!-- Main Heading -->
                <div class="opacity-0 animate-fade-in-up delay-100 mb-5 sm:mb-6 w-full flex flex-col items-center">
                    <div class="font-mono text-[8px] sm:text-[9px] text-slate-500 tracking-[0.25em] sm:tracking-[0.4em] uppercase mb-3 sm:mb-4 px-2">
                        Computer Security Incident Response Team
                    </div>
                    <h1 class="hero-title-container font-display font-black leading-[0.92] tracking-tighter text-white w-full transition-transform duration-200 ease-out cursor-default" style="transform-style: preserve-3d;">
                        <span class="block text-[2.8rem] xs:text-5xl sm:text-6xl md:text-7xl lg:text-[6.5rem] hacker-text" data-text="JatimProv">JatimProv</span>
                        <span class="block text-shimmer text-[2.8rem] xs:text-5xl sm:text-6xl md:text-7xl lg:text-[6.5rem] mt-1 hacker-text relative" data-text="-CSIRT" style="transform: translateZ(20px);">-CSIRT</span>
                    </h1>
                </div>

                <!-- Descriptor -->
                <div class="opacity-0 animate-fade-in-up delay-200 mb-8 sm:mb-12 max-w-xl px-2">
                    <p class="text-slate-400 text-sm sm:text-base md:text-lg leading-relaxed font-medium">
                        Garda terdepan keamanan siber Jawa Timur. Merespons insiden, mengamankan infrastruktur kritis, dan membangun ekosistem digital yang tangguh.
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="opacity-0 animate-fade-in-up delay-300 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 w-full max-w-sm sm:max-w-none justify-center">
                    <a href="/login" class="group relative inline-flex items-center justify-center gap-2.5 px-7 py-3.5 sm:py-4 bg-cyan-500 hover:bg-cyan-400 active:bg-cyan-600 text-slate-950 font-bold text-xs sm:text-sm tracking-widest uppercase rounded-xl transition-all duration-300 shadow-[0_0_25px_rgba(6,182,212,0.3)] hover:shadow-[0_0_40px_rgba(6,182,212,0.5)] hover:-translate-y-0.5 overflow-hidden">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Lapor Insiden
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out pointer-events-none"></div>
                    </a>

                    <a href="/profil" class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 sm:py-4 border border-slate-700 hover:border-slate-500 active:border-slate-400 text-slate-400 hover:text-white font-bold text-xs sm:text-sm tracking-widest uppercase rounded-xl transition-all duration-300 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Tentang CSIRT
                    </a>
                </div>

                <!-- Stats Row -->
                <div class="opacity-0 animate-fade-in-up delay-500 mt-14 sm:mt-20 grid grid-cols-3 gap-0 w-full max-w-xs sm:max-w-md border-t border-slate-800/80 pt-6 sm:pt-8">
                    <div class="text-center px-2">
                        <div class="font-display text-2xl sm:text-3xl md:text-4xl font-black text-white mb-0.5 sm:mb-1">24/7</div>
                        <div class="font-mono text-[8px] sm:text-[9px] text-slate-500 uppercase tracking-[0.1em] sm:tracking-[0.15em]">Monitor</div>
                    </div>
                    <div class="text-center px-2 border-x border-slate-800/80">
                        <div class="font-display text-2xl sm:text-3xl md:text-4xl font-black text-cyan-400 mb-0.5 sm:mb-1">{{ \App\Models\Laporan::count() }}</div>
                        <div class="font-mono text-[8px] sm:text-[9px] text-slate-500 uppercase tracking-[0.1em] sm:tracking-[0.15em]">Laporan</div>
                    </div>
                    <div class="text-center px-2">
                        <div class="font-display text-2xl sm:text-3xl md:text-4xl font-black text-white mb-0.5 sm:mb-1">{{ \App\Models\User::where('role','hunter')->count() }}</div>
                        <div class="font-mono text-[8px] sm:text-[9px] text-slate-500 uppercase tracking-[0.1em] sm:tracking-[0.15em]">Hunters</div>
                    </div>
                </div>

            </div>

            <!-- Bottom Fade -->
            <div class="absolute bottom-0 inset-x-0 h-24 sm:h-32 bg-gradient-to-t from-slate-950 to-transparent z-10" aria-hidden="true"></div>

            <!-- Scroll Indicator -->
            <div class="scroll-indicator absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-1.5 opacity-40" aria-hidden="true">
                <div class="font-mono text-[8px] text-slate-500 tracking-[0.2em] uppercase">Scroll</div>
                <div class="w-px h-8 bg-gradient-to-b from-slate-500 to-transparent"></div>
            </div>
        </header>
