<section class="min-h-screen bg-[#050b14] text-white py-20 px-4 font-sans">
    <div class="max-w-5xl mx-auto">
        
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-black tracking-tight drop-shadow-lg mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">Hall of Fame</span>
            </h1>
            <p class="text-gray-400 text-sm md:text-base max-w-2xl mx-auto">
                Papan peringkat para peneliti keamanan siber (Bug Hunter) yang telah berkontribusi melindungi infrastruktur digital Pemerintah Provinsi Jawa Timur.
            </p>
        </div>

        <!-- Leaderboard Table/List -->
        <div class="bg-gray-900/60 border border-gray-800/80 rounded-2xl backdrop-blur-sm overflow-hidden shadow-2xl">
            
            <!-- Table Header -->
            <div class="grid grid-cols-12 gap-4 p-4 border-b border-gray-800/80 bg-gray-950/50 text-xs md:text-sm font-bold text-gray-400 tracking-wider uppercase">
                <div class="col-span-2 md:col-span-1 text-center">Rank</div>
                <div class="col-span-6 md:col-span-5">Bug Hunter</div>
                <div class="col-span-4 md:col-span-3 text-center">Valid Bugs</div>
                <div class="hidden md:block md:col-span-3 text-right pr-4">Reputation Score</div>
            </div>

            <!-- Table Body (Looping Data) -->
            <div class="divide-y divide-gray-800/50">
                @foreach ($hunters as $hunter)
                    <div class="grid grid-cols-12 gap-4 p-4 items-center hover:bg-gray-800/30 transition-colors group">
                        
                        <!-- RANK COLUMN -->
                        <div class="col-span-2 md:col-span-1 flex justify-center">
                            @if ($hunter->rank == 1)
                                <div class="w-8 h-8 rounded-full bg-yellow-500/20 border border-yellow-500 text-yellow-500 flex items-center justify-center font-black shadow-[0_0_15px_rgba(234,179,8,0.4)]">1</div>
                            @elseif ($hunter->rank == 2)
                                <div class="w-8 h-8 rounded-full bg-gray-400/20 border border-gray-400 text-gray-300 flex items-center justify-center font-black shadow-[0_0_15px_rgba(156,163,175,0.4)]">2</div>
                            @elseif ($hunter->rank == 3)
                                <div class="w-8 h-8 rounded-full bg-amber-700/20 border border-amber-700 text-amber-600 flex items-center justify-center font-black shadow-[0_0_15px_rgba(180,83,9,0.4)]">3</div>
                            @else
                                <div class="w-8 h-8 rounded-full bg-gray-800 text-gray-500 flex items-center justify-center font-bold font-mono">{{ $hunter->rank }}</div>
                            @endif
                        </div>

                        <!-- HUNTER NAME & AVATAR COLUMN -->
                        <div class="col-span-6 md:col-span-5 flex items-center gap-4">
                            <img src="{{ $hunter->avatar }}" alt="Avatar" class="w-10 h-10 rounded-full border border-gray-700 grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300">
                            <div>
                                <h3 class="font-bold text-gray-200 group-hover:text-blue-400 transition-colors font-mono">{{ $hunter->username }}</h3>
                                <!-- Badge kecil untuk top 3 -->
                                @if ($hunter->rank == 1)
                                    <span class="text-[10px] text-yellow-500 flex items-center gap-1 mt-0.5"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"></path></svg> Grand Master</span>
                                @endif
                            </div>
                        </div>

                        <!-- VALID BUGS COLUMN -->
                        <div class="col-span-4 md:col-span-3 flex justify-center items-center">
                            <span class="bg-blue-500/10 text-blue-400 border border-blue-500/20 px-3 py-1 rounded-md text-xs font-bold font-mono">
                                {{ $hunter->valid_bugs }} Bugs
                            </span>
                        </div>

                        <!-- SCORE COLUMN -->
                        <div class="hidden md:flex md:col-span-3 justify-end items-center pr-4">
                            <span class="text-xl font-black {{ $hunter->rank <= 3 ? 'text-white drop-shadow-[0_0_8px_rgba(255,255,255,0.5)]' : 'text-gray-400' }} font-mono">
                                {{ number_format($hunter->score, 0, ',', '.') }} <span class="text-xs text-gray-500 font-normal">pts</span>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Footer Table -->
            <div class="p-4 bg-gray-950/50 border-t border-gray-800/80 text-center">
                <p class="text-[11px] text-gray-500">* Peringkat dihitung berdasarkan akumulasi Severity (Tingkat Keparahan) dari laporan yang telah divalidasi dan dinyatakan valid oleh tim JatimProv-CSIRT.</p>
            </div>
        </div>

    </div>
</section>