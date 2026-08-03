<section class="min-h-screen bg-[#050b14] text-white py-20 px-4 font-sans">
    <div class="max-w-5xl mx-auto">
        
        <!-- Header Section -->
        <div class="text-center mb-16 flex flex-col items-center">
            <h1 class="text-4xl md:text-5xl font-black tracking-tight drop-shadow-lg mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">Hall of Fame</span>
            </h1>
            <p class="text-gray-400 text-sm md:text-base max-w-2xl mx-auto mb-6">
                Papan peringkat para peneliti keamanan siber (Bug Hunter) yang telah berkontribusi melindungi infrastruktur digital Pemerintah Provinsi Jawa Timur.
            </p>

            <!-- TOMBOL BUKA POP-UP (MANUAL) -->
            <button onclick="openRulesModal()" class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold text-blue-400 bg-blue-900/20 border border-blue-500/30 rounded-xl hover:bg-blue-800/40 hover:text-white transition-all shadow-lg shadow-blue-900/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Sistem Penilaian
            </button>
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

<!-- ========================================== -->
<!-- MODAL SISTEM PENILAIAN & ATURAN LEADERBOARD -->
<!-- ========================================== -->
<div id="rulesModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6 transition-opacity duration-300">
    
    <!-- Box Modal -->
    <div class="bg-[#0f172a] w-full max-w-3xl rounded-2xl shadow-2xl border border-slate-700 overflow-hidden my-8 max-h-[90vh] flex flex-col">
        
        <!-- Header Modal -->
        <div class="bg-[#1e293b] text-white px-6 py-5 flex items-center justify-between border-b border-slate-700 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600/20 border border-blue-500/30 flex items-center justify-center text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white tracking-tight">Sistem Penilaian</h3>
                    <p class="text-xs text-gray-400">Ketentuan Poin & Klasifikasi Level</p>
                </div>
            </div>
            <!-- Tombol Close (X) -->
            <button onclick="closeRulesModal()" class="w-9 h-9 bg-slate-800 hover:bg-slate-700 text-gray-400 hover:text-white rounded-xl flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Body Modal (Scrollable) -->
        <div class="p-6 overflow-y-auto space-y-8 text-gray-300 text-sm">
            
            <!-- 1. PERHITUNGAN POIN -->
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-7 h-7 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold text-xs">🧮</span>
                    <h4 class="text-base font-bold text-white">Perhitungan Poin</h4>
                </div>
                <p class="text-xs text-gray-400 mb-4">
                    Poin diberikan untuk setiap laporan kerentanan yang telah divalidasi dan berstatus 
                    <span class="font-bold text-emerald-400">Valid</span>, 
                    <span class="font-bold text-blue-400">Sertifikat</span>, atau 
                    <span class="font-bold text-purple-400">Selesai</span>[cite: 2].
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Prioritas 1: Skor CVSS -->
                    <div class="bg-blue-950/20 border border-blue-900/50 p-4 rounded-xl">
                        <div class="flex items-center gap-2 text-blue-400 font-bold text-xs mb-2">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span> Prioritas 1: Skor CVSS
                        </div>
                        <p class="text-[11px] text-gray-400 mb-3">Jika laporan memiliki skor CVSS (v4.0), poin dihitung berdasarkan skor tersebut.</p>
                        
                        <div class="bg-slate-900 border border-slate-800 p-3 rounded-lg text-center font-mono font-bold text-xs text-blue-400 mb-3">
                            Poin = Skor CVSS × 10
                        </div>

                        <div class="space-y-1.5 text-xs font-mono">
                            <div class="flex justify-between text-gray-300"><span>CVSS 9.0 (Critical)</span><span class="font-bold text-blue-400">90 poin</span></div>
                            <div class="flex justify-between text-gray-300"><span>CVSS 7.5 (High)</span><span class="font-bold text-blue-400">75 poin</span></div>
                            <div class="flex justify-between text-gray-300"><span>CVSS 5.0 (Medium)</span><span class="font-bold text-blue-400">50 poin</span></div>
                        </div>
                    </div>

                    <!-- Prioritas 2: Severity Manual -->
                    <div class="bg-amber-950/20 border border-amber-900/50 p-4 rounded-xl">
                        <div class="flex items-center gap-2 text-amber-400 font-bold text-xs mb-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Prioritas 2: Severity Manual
                        </div>
                        <p class="text-[11px] text-gray-400 mb-3">Jika tidak ada skor CVSS, poin ditentukan berdasarkan tingkat severity manual.</p>
                        
                        <div class="space-y-2 font-mono text-xs pt-2">
                            <div class="flex justify-between items-center bg-slate-900 p-2 rounded border border-slate-800">
                                <span class="flex items-center gap-2 text-red-500 font-bold"><span class="w-2 h-2 rounded-full bg-red-500"></span> Critical</span>
                                <span class="bg-red-950/50 text-red-400 font-bold px-2 py-0.5 rounded">90 poin</span>
                            </div>
                            <div class="flex justify-between items-center bg-slate-900 p-2 rounded border border-slate-800">
                                <span class="flex items-center gap-2 text-orange-500 font-bold"><span class="w-2 h-2 rounded-full bg-orange-500"></span> High</span>
                                <span class="bg-orange-950/50 text-orange-400 font-bold px-2 py-0.5 rounded">70 poin</span>
                            </div>
                            <div class="flex justify-between items-center bg-slate-900 p-2 rounded border border-slate-800">
                                <span class="flex items-center gap-2 text-amber-500 font-bold"><span class="w-2 h-2 rounded-full bg-amber-500"></span> Medium</span>
                                <span class="bg-amber-950/50 text-amber-400 font-bold px-2 py-0.5 rounded">40 poin</span>
                            </div>
                            <div class="flex justify-between items-center bg-slate-900 p-2 rounded border border-slate-800">
                                <span class="flex items-center gap-2 text-blue-500 font-bold"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Low</span>
                                <span class="bg-blue-950/50 text-blue-400 font-bold px-2 py-0.5 rounded">10 poin</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-slate-700/50" />

            <!-- 2. KLASIFIKASI LEVEL -->
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-7 h-7 rounded-lg bg-purple-500/10 text-purple-400 flex items-center justify-center font-bold text-xs">🏅</span>
                    <h4 class="text-base font-bold text-white">Klasifikasi Level</h4>
                </div>
                <p class="text-xs text-gray-400 mb-4">Level hunter ditentukan berdasarkan total poin akumulatif. Semakin tinggi poin, semakin tinggi level dan reputasi Anda.</p>

                <div class="space-y-3">
                    <!-- Level 1: Newcomer -->
                    <div class="bg-slate-800/40 border border-slate-700 p-3.5 rounded-xl flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-900 border border-slate-700 rounded-xl flex flex-col items-center justify-center shrink-0">
                            <span class="text-lg font-black text-gray-200">1</span>
                            <span class="text-[9px] text-gray-400 font-bold tracking-widest uppercase">LVL</span>
                        </div>
                        <div class="flex-grow">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-white">Newcomer</span>
                                <span class="bg-slate-700 text-gray-300 text-[10px] font-mono font-bold px-2 py-0.5 rounded">0 - 499 poin[cite: 1]</span>
                            </div>
                            <p class="text-xs text-gray-400">Awal perjalanan sebagai bug hunter[cite: 1].</p>
                        </div>
                    </div>

                    <!-- Level 2: Hunter -->
                    <div class="bg-emerald-950/20 border border-emerald-900/50 p-3.5 rounded-xl flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-900 border border-emerald-800 rounded-xl flex flex-col items-center justify-center shrink-0">
                            <span class="text-lg font-black text-emerald-400">2</span>
                            <span class="text-[9px] text-emerald-500 font-bold tracking-widest uppercase">LVL</span>
                        </div>
                        <div class="flex-grow">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-emerald-300">Hunter</span>
                                <span class="bg-emerald-900/50 text-emerald-300 text-[10px] font-mono font-bold px-2 py-0.5 rounded">500 - 999 poin[cite: 1]</span>
                            </div>
                            <p class="text-xs text-emerald-400/80">Telah membuktikan kontribusi nyata[cite: 1].</p>
                        </div>
                    </div>

                    <!-- Level 3: Expert -->
                    <div class="bg-blue-950/20 border border-blue-900/50 p-3.5 rounded-xl flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-900 border border-blue-800 rounded-xl flex flex-col items-center justify-center shrink-0">
                            <span class="text-lg font-black text-blue-400">3</span>
                            <span class="text-[9px] text-blue-500 font-bold tracking-widest uppercase">LVL</span>
                        </div>
                        <div class="flex-grow">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-blue-300">Expert</span>
                                <span class="bg-blue-900/50 text-blue-300 text-[10px] font-mono font-bold px-2 py-0.5 rounded">1.000 - 4.999 poin[cite: 1]</span>
                            </div>
                            <p class="text-xs text-blue-400/80">Ahli keamanan yang berpengalaman[cite: 1].</p>
                        </div>
                    </div>

                    <!-- Level 4: Elite -->
                    <div class="bg-purple-950/20 border border-purple-900/50 p-3.5 rounded-xl flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-900 border border-purple-800 rounded-xl flex flex-col items-center justify-center shrink-0">
                            <span class="text-lg font-black text-purple-400">4</span>
                            <span class="text-[9px] text-purple-500 font-bold tracking-widest uppercase">LVL</span>
                        </div>
                        <div class="flex-grow">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-purple-300">Elite</span>
                                <span class="bg-purple-900/50 text-purple-300 text-[10px] font-mono font-bold px-2 py-0.5 rounded">5.000 - 9.999 poin[cite: 1]</span>
                            </div>
                            <p class="text-xs text-purple-400/80">Peneliti keamanan elit dengan track record luar biasa[cite: 1].</p>
                        </div>
                    </div>

                    <!-- Level 5: Master -->
                    <div class="bg-amber-950/30 border border-amber-800/60 p-3.5 rounded-xl flex items-center gap-4 shadow-sm">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-amber-600 text-white rounded-xl flex flex-col items-center justify-center shrink-0 shadow-md">
                            <span class="text-lg font-black">5</span>
                            <span class="text-[9px] font-bold tracking-widest uppercase opacity-90">LVL</span>
                        </div>
                        <div class="flex-grow">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-amber-300">Master</span>
                                <span class="bg-amber-900/70 text-amber-200 text-[10px] font-mono font-bold px-2 py-0.5 rounded">10.000+ poin[cite: 1]</span>
                                <span class="bg-amber-500 text-white text-[9px] font-black px-1.5 py-0.5 rounded uppercase tracking-wider">MAX[cite: 1]</span>
                            </div>
                            <p class="text-xs text-amber-400/90">Level tertinggi. Master keamanan siber dengan dampak besar bagi Indonesia[cite: 1].</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-slate-700/50" />

            <!-- 3. STATUS LAPORAN YANG DIHITUNG -->
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-500/10 text-blue-400 flex items-center justify-center font-bold text-xs">📄</span>
                    <h4 class="text-base font-bold text-white">Status Laporan yang Dihitung</h4>
                </div>
                <p class="text-xs text-gray-400 mb-4">Hanya laporan dengan status berikut yang dihitung dalam perolehan poin[cite: 2]:</p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="bg-emerald-950/20 border border-emerald-900/40 p-4 rounded-xl text-center">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h5 class="font-bold text-emerald-300 text-xs">Valid[cite: 2]</h5>
                        <p class="text-[10px] text-emerald-400/80 mt-0.5">Terverifikasi[cite: 2]</p>
                    </div>

                    <div class="bg-blue-950/20 border border-blue-900/40 p-4 rounded-xl text-center">
                        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h5 class="font-bold text-blue-300 text-xs">Sertifikat[cite: 2]</h5>
                        <p class="text-[10px] text-blue-400/80 mt-0.5">Dalam proses[cite: 2]</p>
                    </div>

                    <div class="bg-purple-950/20 border border-purple-900/40 p-4 rounded-xl text-center">
                        <div class="w-8 h-8 rounded-full bg-purple-500 text-white flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h5 class="font-bold text-purple-300 text-xs">Selesai[cite: 2]</h5>
                        <p class="text-[10px] text-purple-400/80 mt-0.5">Proses tuntas[cite: 2]</p>
                    </div>
                </div>
            </div>

            <!-- 4. CATATAN PENTING -->
            <div class="bg-slate-800/60 border border-slate-700 p-4 rounded-xl flex gap-3">
                <div class="w-8 h-8 rounded-lg bg-slate-700 text-slate-300 flex items-center justify-center shrink-0 mt-0.5">
                    💡
                </div>
                <div class="space-y-1 text-xs text-gray-300">
                    <h5 class="font-bold text-white">Catatan Penting[cite: 2]:</h5>
                    <ul class="list-disc list-inside space-y-1 text-[11px] leading-relaxed">
                        <li>Poin dihitung secara otomatis saat status laporan berubah[cite: 2].</li>
                        <li>Peringkat diurutkan berdasarkan total poin, lalu jumlah laporan valid[cite: 2].</li>
                        <li>Laporan <span class="font-bold">Tidak Valid</span> atau masih <span class="font-bold">Diproses</span> tidak memberikan poin[cite: 2].</li>
                        <li>Level naik otomatis saat ambang batas poin tercapai[cite: 2].</li>
                        <li>Skor CVSS lebih diprioritaskan daripada severity manual dalam perhitungan[cite: 2].</li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- Footer Modal -->
        <div class="bg-slate-800/80 px-6 py-4 border-t border-slate-700 flex justify-end shrink-0">
            <button onclick="closeRulesModal()" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl transition-all shadow-lg shadow-blue-600/20">
                Paham & Tutup
            </button>
        </div>

    </div>
</div>

<!-- ========================================== -->
<!-- SCRIPT LOGIKA LOCALSTORAGE (AUTO POP-UP 1X) -->
<!-- ========================================== -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('rulesModal');
        // Cek localStorage apakah user sudah pernah melihat modal ini
        const hasSeenRules = localStorage.getItem('hasSeenLeaderboardRules');

        if (!hasSeenRules) {
            // Jika BELUM pernah -> munculkan modal
            openRulesModal();
            // Simpan penanda ke localStorage
            localStorage.setItem('hasSeenLeaderboardRules', 'true');
        }
    });

    function openRulesModal() {
        const modal = document.getElementById('rulesModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Mencegah background ter-scroll saat modal buka
    }

    function closeRulesModal() {
        const modal = document.getElementById('rulesModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto'; // Kembalikan scroll background
    }
</script>