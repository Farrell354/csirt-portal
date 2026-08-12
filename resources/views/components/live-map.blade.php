<section class="relative w-full h-[100vh] min-h-[800px] max-h-[1080px] flex flex-col overflow-hidden bg-[#050b14] border-y border-slate-800/50 text-white font-sans">

    <!-- ===================================================================== -->
    <!-- CUSTOM STYLE KHUSUS KOMPONEN -->
    <!-- ===================================================================== -->
    <style>
        .map-scrollbar::-webkit-scrollbar { width: 4px; }
        .map-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .map-scrollbar::-webkit-scrollbar-thumb { background: #0ea5e9; border-radius: 10px; }

        .clean-list-item {
            border-bottom: 1px solid rgba(30, 58, 138, 0.3);
            padding-bottom: 0.6rem;
            margin-bottom: 0.6rem;
        }
        .clean-list-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        @keyframes marquee-map {
            0% { transform: translate3d(0, 0, 0); }
            100% { transform: translate3d(-50%, 0, 0); }
        }
        .animate-marquee-map {
            animation: marquee-map 35s linear infinite;
        }
    </style>

    <!-- ===================================================================== -->
    <!-- BACKGROUND GLOBE 3D -->
    <!-- ===================================================================== -->
    <div class="absolute inset-0 z-0 flex items-center justify-center pointer-events-none">
        <!-- Wadah Globe. Sengaja dibuat agak turun (mt-12) agar pas di tengah -->
        <div id="globe-container" class="w-full h-full lg:w-[110%] lg:h-[110%] flex items-center justify-center relative mt-12 pointer-events-auto">
            <!-- Marker Placeholder (Ditiban JS nanti) -->
            <div id="jatim-marker" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center gap-2 pointer-events-none hidden">
                <span class="text-cyan-400 font-bold tracking-widest text-sm drop-shadow-md">JatimProv</span>
            </div>
        </div>
    </div>

    <!-- ===================================================================== -->
    <!-- HEADER TEXT -->
    <!-- ===================================================================== -->
    <div class="text-center relative z-10 pointer-events-none pt-10 pb-6 flex flex-col items-center animate-[fadeInUp_0.8s_ease-out_forwards]">
        <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-blue-900/30 border border-blue-500/30 rounded-full backdrop-blur-md mb-4 shadow-lg">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse shadow-[0_0_8px_#22d3ee]"></span>
            <span class="text-cyan-400 text-[10px] font-bold tracking-[0.2em] uppercase">Live Threat Intelligence</span>
        </div>
        
        <h2 class="text-3xl md:text-5xl font-black tracking-tight drop-shadow-lg text-white mb-2">
            Peta Ancaman <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">Siber Jatim</span>
        </h2>
        
        <p class="text-gray-400 font-medium text-xs md:text-sm mt-2 drop-shadow-md max-w-2xl px-4">
            Monitoring serangan siber terhadap infrastruktur digital Pemerintah Provinsi Jawa Timur secara waktu nyata.
        </p>
    </div>

    <!-- ===================================================================== -->
    <!-- AREA WIDGET (Melayang Kiri & Kanan) -->
    <!-- ===================================================================== -->
    <div class="absolute inset-0 z-10 flex flex-col lg:flex-row justify-between items-start px-4 lg:px-12 pointer-events-none pt-40 pb-28 map-scrollbar overflow-y-auto lg:overflow-hidden">
        
        <!-- ================= WIDGET KIRI ================= -->
        <div class="w-full lg:w-[340px] flex flex-col gap-6 pointer-events-auto mb-6 lg:mb-0 opacity-0 animate-[fadeInUp_0.8s_ease-out_0.2s_forwards]">
            
            <div class="bg-[#0a1122]/70 border border-slate-700/80 p-6 md:p-8 rounded-2xl backdrop-blur-xl shadow-2xl relative overflow-hidden group hover:border-blue-500/50 transition-colors">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-red-500/10 rounded-full blur-3xl"></div>
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <div class="flex items-center gap-2">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                        </span>
                        <span class="text-[11px] text-gray-400 font-bold tracking-widest uppercase">Live Attack Count</span>
                    </div>
                    <span class="text-[9px] bg-blue-900/50 text-blue-400 px-2 py-1 rounded border border-blue-800/50 uppercase font-bold tracking-wider">24 Jam</span>
                </div>
                <h3 class="text-5xl md:text-6xl font-black text-white tracking-tighter relative z-10 drop-shadow-md" id="live-attack-count">104.001</h3>
            </div>

            <div class="bg-[#0a1122]/70 border border-slate-700/80 p-6 md:p-7 rounded-2xl backdrop-blur-xl shadow-2xl flex-grow hover:border-blue-500/50 transition-colors">
                <h4 class="text-xs text-white font-bold tracking-wider mb-5 flex items-center gap-2 uppercase border-b border-slate-700/80 pb-3">
                    <div class="p-1.5 bg-cyan-900/40 rounded text-cyan-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    Aduan Kerentanan Sistem
                </h4>
                <ul class="space-y-3.5 text-xs font-mono text-gray-300">
                    @if(isset($topKerentanan) && $topKerentanan->count() > 0)
                        @foreach($topKerentanan as $index => $rentan)
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default">
                            <div class="flex items-center gap-3">
                                <span class="text-[10px] font-bold text-gray-500 w-4">{{ $index + 1 }}.</span>
                                <span class="truncate max-w-[190px]" title="{{ $rentan->nama_kerentanan }}">{{ $rentan->nama_kerentanan }}</span>
                            </div>
                            <span class="font-bold text-cyan-400">{{ number_format($rentan->jumlah, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    @else
                        <!-- Data Dummy -->
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default"><div class="flex items-center gap-3"><span class="text-[10px] font-bold text-gray-500 w-4">1.</span><span>Information Disclosure</span></div><span class="font-bold text-cyan-400">142</span></li>
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default"><div class="flex items-center gap-3"><span class="text-[10px] font-bold text-gray-500 w-4">2.</span><span>Cross-Site Scripting</span></div><span class="font-bold text-cyan-400">98</span></li>
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default"><div class="flex items-center gap-3"><span class="text-[10px] font-bold text-gray-500 w-4">3.</span><span>Insecure Direct Object</span></div><span class="font-bold text-cyan-400">75</span></li>
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default"><div class="flex items-center gap-3"><span class="text-[10px] font-bold text-gray-500 w-4">4.</span><span>SQL Injection</span></div><span class="font-bold text-cyan-400">42</span></li>
                        <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default"><div class="flex items-center gap-3"><span class="text-[10px] font-bold text-gray-500 w-4">5.</span><span>Business Logic Error</span></div><span class="font-bold text-cyan-400">21</span></li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- ================= WIDGET KANAN ================= -->
        <div class="w-full lg:w-[340px] flex flex-col gap-5 pointer-events-auto opacity-0 animate-[fadeInUp_0.8s_ease-out_0.4s_forwards]">
            
            <div class="bg-[#0a1122]/70 border border-slate-700/80 p-5 rounded-2xl backdrop-blur-md shadow-xl overflow-hidden hover:border-orange-500/50 transition-colors">
                <h4 class="text-[11px] text-white font-bold tracking-wider mb-3.5 flex items-center gap-2 uppercase border-b border-slate-700/80 pb-2.5">
                    <div class="p-1.5 bg-orange-900/40 rounded text-orange-500"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192 3 1.732 3z"></path></svg></div>
                    Top Jenis Serangan
                </h4>
                <ul id="top-attacks-list" class="space-y-2.5 text-[11px] font-mono text-gray-300">
                    <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-3"><span class="text-[10px] font-bold text-gray-500 w-4">1.</span> <span>Loading...</span></div> <span class="text-red-400 font-bold">-</span></li>
                </ul>
            </div>

            <div class="bg-[#0a1122]/70 border border-slate-700/80 p-5 rounded-2xl backdrop-blur-md shadow-xl overflow-hidden hover:border-cyan-500/50 transition-colors">
                <h4 class="text-[11px] text-white font-bold tracking-wider mb-3.5 flex items-center gap-2 uppercase border-b border-slate-700/80 pb-2.5">
                    <div class="p-1.5 bg-blue-900/40 rounded text-blue-400"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                    Negara Sumber
                </h4>
                <ul id="top-countries-list" class="space-y-2.5 text-[11px] font-mono text-gray-300">
                    <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-3"><span class="text-[10px] font-bold text-gray-500 w-4">1.</span> <span>Loading...</span></div> <span class="text-cyan-400 font-bold">-</span></li>
                </ul>
            </div>

            <div class="bg-[#0a1122]/70 border border-slate-700/80 p-5 rounded-2xl backdrop-blur-md shadow-xl overflow-hidden hover:border-red-500/50 transition-colors">
                <h4 class="text-[11px] text-white font-bold tracking-wider mb-3.5 flex items-center gap-2 uppercase border-b border-slate-700/80 pb-2.5">
                    <div class="p-1.5 bg-red-900/40 rounded text-red-400"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg></div>
                    Top IP Penyerang
                </h4>
                <ul id="top-ips-list" class="space-y-2.5 text-[11px] font-mono text-gray-300">
                    <li class="clean-list-item flex justify-between items-center"><div class="flex items-center gap-3"><span class="text-[10px] font-bold text-gray-500 w-4">1.</span> <span>Loading...</span></div> <span class="text-red-400 font-bold">-</span></li>
                </ul>
            </div>

        </div>
    </div>

    <!-- ===================================================================== -->
    <!-- WIDGET NOTIFIKASI BAWAH -->
    <!-- ===================================================================== -->
    <div class="absolute bottom-14 left-1/2 transform -translate-x-1/2 z-40 pointer-events-auto opacity-0 animate-[fadeInUp_0.8s_ease-out_0.6s_forwards]">
        <div id="latest-alert-pill" class="bg-[#0a1122]/95 border border-slate-700/80 backdrop-blur-md px-6 py-2.5 rounded-full flex items-center gap-3 shadow-[0_0_15px_rgba(0,0,0,0.5)]">
            <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-orange-500"></span></span>
            <span class="text-[10px] md:text-[11px] font-mono text-gray-300"><span class="text-orange-400 font-bold">Memulai Sistem...</span> &nbsp;|&nbsp; 🌐 Menghubungkan &nbsp;&rarr;&nbsp; <span class="text-cyan-400 font-bold">JatimProv</span></span>
            <span class="bg-blue-500/20 text-blue-500 border border-blue-500/30 text-[9px] px-2 py-0.5 rounded font-bold ml-2 uppercase tracking-widest">INFO</span>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full bg-[#050b14]/95 border-t border-slate-800/80 p-2.5 overflow-hidden flex whitespace-nowrap text-[11px] text-gray-400 font-mono z-40 shadow-[0_-5px_20px_rgba(0,0,0,0.5)]">
        <div class="animate-marquee-map inline-block whitespace-nowrap">
            <!-- SET DATA 1 -->
            <span class="mx-6"><span class="text-red-500 mr-2 font-bold animate-pulse">●</span> SQL Injection dari 82.197.69.49 &rarr; JatimProv <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
            <span class="mx-6"><span class="text-orange-500 mr-2 font-bold animate-pulse">●</span> Reconnaissance dari 165.22.221.124 &rarr; Diskominfo <span class="bg-orange-500/20 text-orange-500 border border-orange-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">HIGH</span></span>
            <span class="mx-6"><span class="text-red-500 mr-2 font-bold animate-pulse">●</span> DDoS Attempt dari 145.110.242.20 &rarr; Server Utama <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
            <span class="mx-6"><span class="text-yellow-500 mr-2 font-bold animate-pulse">●</span> Brute Force SSH dari 103.111.42.11 &rarr; DB Server <span class="bg-yellow-500/20 text-yellow-500 border border-yellow-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">MEDIUM</span></span>
            
            <!-- SET DATA 2 -->
            <span class="mx-6"><span class="text-red-500 mr-2 font-bold animate-pulse">●</span> SQL Injection dari 82.197.69.49 &rarr; JatimProv <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
            <span class="mx-6"><span class="text-orange-500 mr-2 font-bold animate-pulse">●</span> Reconnaissance dari 165.22.221.124 &rarr; Diskominfo <span class="bg-orange-500/20 text-orange-500 border border-orange-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">HIGH</span></span>
            <span class="mx-6"><span class="text-red-500 mr-2 font-bold animate-pulse">●</span> DDoS Attempt dari 145.110.242.20 &rarr; Server Utama <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
            <span class="mx-6"><span class="text-yellow-500 mr-2 font-bold animate-pulse">●</span> Brute Force SSH dari 103.111.42.11 &rarr; DB Server <span class="bg-yellow-500/20 text-yellow-500 border border-yellow-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">MEDIUM</span></span>
        </div>
    </div>
    
    <!-- ===================================================================== -->
    <!-- LOAD THREE.JS & GLOBE.GL -->
    <!-- ===================================================================== -->
    <script src="https://unpkg.com/three"></script>
    <script src="https://unpkg.com/globe.gl"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('globe-container');
            if (!container) return;

            const targetJatim = { lat: -7.2504, lng: 112.7688 };

            // 1. INIT GLOBE: BUMI GELAP + BINTANG-BINTANG (Persis seperti gambar referensi Bos)
            const myGlobe = Globe({ animateIn: true })
                (container)
                .globeImageUrl('https://unpkg.com/three-globe/example/img/earth-dark.jpg')
                .bumpImageUrl('https://unpkg.com/three-globe/example/img/earth-topology.png')
                .backgroundImageUrl('https://unpkg.com/three-globe/example/img/night-sky.png') // Bintang-bintang kembali!
                .backgroundColor('rgba(5, 11, 20, 1)') // Menyesuaikan warna background web
                .showAtmosphere(true)
                .atmosphereColor('#0ea5e9')
                .atmosphereAltitude(0.15)
                .width(container.clientWidth)
                .height(container.clientHeight);

            // 2. MARKER TARGET JATIM
            const markerEl = document.createElement('div');
            markerEl.style.pointerEvents = 'none';
            markerEl.innerHTML = `
                <div style="position:relative; display:flex; align-items:center; gap:6px; transform: translate(-4px, -4px);">
                    <span style="position:relative; display:inline-flex; width:10px; height:10px;">
                        <span class="animate-ping" style="position:absolute; inset:0; border-radius:9999px; background:#22d3ee;"></span>
                        <span style="position:relative; display:inline-flex; width:10px; height:10px; border-radius:9999px; background:#22d3ee; box-shadow:0 0 10px #22d3ee;"></span>
                    </span>
                    <span style="font-size:12px; font-family: sans-serif; font-weight:700; color:#cffafe; text-shadow: 0 0 8px rgba(0,0,0,1);">Jatim</span>
                </div>
            `;
            
            myGlobe.htmlElementsData([{ lat: targetJatim.lat, lng: targetJatim.lng }])
                .htmlElement(() => markerEl)
                .htmlAltitude(0.02);

            // Set point of view kamera
            myGlobe.pointOfView({ lat: -5, lng: 113, altitude: 2.2 }, 0);
            setTimeout(() => { myGlobe.pointOfView({ lat: -5, lng: 113, altitude: 1.8 }, 3000); }, 200);

            // 3. KONTROL KAMERA & LIGHT SABER (Laser tebal menyala)
            myGlobe
                .arcDashLength(0.4)
                .arcDashGap(0.15)
                .arcDashAnimateTime(1500)
                .arcStroke(1.2) // Laser Tebal
                .ringColor(d => d.color)
                .ringMaxRadius(4)
                .ringPropagationSpeed(2)
                .ringRepeatPeriod(0);

            myGlobe.controls().autoRotate = true;
            myGlobe.controls().autoRotateSpeed = 0.5;
            myGlobe.controls().enableZoom = false; 

            // 4. ATTACK FEED API & SIMULATION
            let activeAttacks = [];
            let activeRings = [];

            const SOURCE_COUNTRIES = [
                { name: 'India', flag: '🇮🇳', lat: 20.5936, lng: 78.9628 },
                { name: 'China', flag: '🇨🇳', lat: 35.8616, lng: 104.1953 },
                { name: 'United States', flag: '🇺🇸', lat: 37.0902, lng: -95.7128 },
                { name: 'Rusia', flag: '🇷🇺', lat: 61.5240, lng: 105.3188 },
                { name: 'Singapore', flag: '🇸🇬', lat: 1.3521, lng: 103.8198 }
            ];
            const ATTACK_TYPES = [
                { name: 'SQL Injection', severity: 'CRITICAL' },
                { name: 'Reconnaissance', severity: 'HIGH' },
                { name: 'Cross-Site Scripting', severity: 'HIGH' },
                { name: 'DDoS Attempt', severity: 'CRITICAL' }
            ];

            function runSimulatedAttack() {
                const country = SOURCE_COUNTRIES[Math.floor(Math.random() * SOURCE_COUNTRIES.length)];
                const attack = ATTACK_TYPES[Math.floor(Math.random() * ATTACK_TYPES.length)];

                const endLatOffset = targetJatim.lat + (Math.random() - 0.5) * 1.5;
                const endLngOffset = targetJatim.lng + (Math.random() - 0.5) * 1.5;
                const startLat = country.lat + (Math.random() - 0.5) * 5;
                const startLng = country.lng + (Math.random() - 0.5) * 5;
                const color = attack.severity === 'CRITICAL' ? '#ef4444' : attack.severity === 'HIGH' ? '#f97316' : '#eab308';

                const newAttack = {
                    startLat: startLat, 
                    startLng: startLng, 
                    endLat: endLatOffset,
                    endLng: endLngOffset,
                    color: color
                };

                activeAttacks.push(newAttack);
                if (activeAttacks.length > 15) activeAttacks.shift();

                // Tembakkan Laser
                myGlobe.arcsData(activeAttacks)
                    .arcStartLat(d => d.startLat)
                    .arcStartLng(d => d.startLng)
                    .arcEndLat(d => d.endLat)
                    .arcEndLng(d => d.endLng)
                    .arcColor(d => ['rgba(255,255,255,0)', d.color]);

                // Efek Cincin Ledakan Saat Laser Mendarat
                setTimeout(() => {
                    activeRings.push({ lat: endLatOffset, lng: endLngOffset, color: newAttack.color });
                    if (activeRings.length > 6) activeRings.shift();
                    myGlobe.ringsData(activeRings);
                }, 1500);

                // Update Angka Live
                const countElement = document.getElementById('live-attack-count');
                if (countElement) {
                    let current = parseInt(countElement.innerText.replace(/\./g, '')) || 104001;
                    countElement.innerText = (current + Math.floor(Math.random() * 10) + 1).toLocaleString('id-ID');
                }

                // Update Notifikasi Pill Bawah
                const pill = document.getElementById('latest-alert-pill');
                if (pill) {
                    const severityColor = attack.severity === 'CRITICAL' || attack.severity === 'HIGH'
                        ? { text: 'text-red-500', bg: 'bg-red-500/20', border: 'border-red-500/30' }
                        : { text: 'text-yellow-500', bg: 'bg-yellow-500/20', border: 'border-yellow-500/30' };

                    pill.innerHTML = `
                        <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span></span>
                        <span class="text-[10px] md:text-[11px] font-mono text-gray-300"><span class="text-orange-400 font-bold">${attack.name}</span> &nbsp;|&nbsp; ${country.flag} ${country.name} &nbsp;&rarr;&nbsp; <span class="text-cyan-400 font-bold">JatimProv</span></span>
                        <span class="${severityColor.bg} ${severityColor.text} ${severityColor.border} border text-[9px] px-2 py-0.5 rounded font-bold ml-2 uppercase tracking-widest">${attack.severity}</span>
                    `;
                }
            }

            // Fungsi Bantuan Generator List
            const updateDynamicList = (containerId, listData, itemHtmlGenerator) => {
                const container = document.getElementById(containerId);
                if (!container || !listData) return;
                let htmlString = ''; 
                listData.forEach((item, index) => {
                    htmlString += itemHtmlGenerator(item, index);
                });
                container.innerHTML = htmlString; 
            };

            // Jalankan Live Data
            setInterval(() => {
                fetch('/api/threat-data')
                    .then(response => { if(response.ok) return response.json(); throw new Error('API failed'); })
                    .then(data => {
                        const countElement = document.getElementById('live-attack-count');
                        if (countElement && data.total_attacks) {
                            countElement.innerText = data.total_attacks.toLocaleString('id-ID');
                        }

                        updateDynamicList('top-attacks-list', data.top_attacks, (item, idx) => `
                            <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default">
                                <div class="flex items-center gap-3"><span class="text-[10px] font-bold text-gray-500 w-4">${idx + 1}.</span><span class="truncate max-w-[170px]">${item.name}</span></div>
                                <span class="font-bold ${idx===0 ? 'text-red-400' : (idx===1 ? 'text-orange-400' : 'text-yellow-400')}">${item.count.toLocaleString('id-ID')}</span>
                            </li>
                        `);

                        updateDynamicList('top-countries-list', data.top_countries, (item, idx) => `
                            <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default">
                                <div class="flex items-center gap-3"><span class="text-[10px] font-bold text-gray-500 w-4">${idx + 1}.</span><span class="truncate max-w-[170px]">${item.flag} ${item.name}</span></div>
                                <span class="font-bold text-cyan-400">${item.count.toLocaleString('id-ID')}</span>
                            </li>
                        `);

                        updateDynamicList('top-ips-list', data.top_ips, (item, idx) => `
                            <li class="clean-list-item flex justify-between items-center hover:text-white transition-colors cursor-default">
                                <div class="flex items-center gap-3"><span class="text-[10px] font-bold text-gray-500 w-4">${idx + 1}.</span><span class="truncate max-w-[170px]">${item.address}</span></div>
                                <span class="font-bold ${idx===0 ? 'text-red-400' : 'text-orange-400'}">${item.count.toLocaleString('id-ID')}</span>
                            </li>
                        `);

                        if (data.recent_attacks && data.recent_attacks.length > 0) {
                            data.recent_attacks.forEach(attack => {
                                const endLatOffset = targetJatim.lat + (Math.random() - 0.5) * 1.5;
                                const endLngOffset = targetJatim.lng + (Math.random() - 0.5) * 1.5;

                                const newAttack = {
                                    startLat: attack.source_lat, 
                                    startLng: attack.source_lng, 
                                    endLat: endLatOffset,
                                    endLng: endLngOffset,
                                    color: attack.severity === 'high' ? '#ef4444' : (attack.severity === 'medium' ? '#f97316' : '#0ea5e9')
                                };

                                activeAttacks.push(newAttack);
                                if (activeAttacks.length > 15) activeAttacks.shift();

                                myGlobe.arcsData(activeAttacks)
                                    .arcStartLat(d => d.startLat)
                                    .arcStartLng(d => d.startLng)
                                    .arcEndLat(d => d.endLat)
                                    .arcEndLng(d => d.endLng)
                                    .arcColor(d => ['rgba(255,255,255,0)', d.color]);

                                setTimeout(() => {
                                    activeRings.push({ lat: endLatOffset, lng: endLngOffset, color: newAttack.color });
                                    if (activeRings.length > 6) activeRings.shift();
                                    myGlobe.ringsData(activeRings);
                                }, 1500);
                            });
                        } else {
                            runSimulatedAttack();
                        }
                    })
                    .catch(error => {
                        runSimulatedAttack();
                    });
                    
            }, 3000); 

            // Pancing tembakan pertama
            setTimeout(runSimulatedAttack, 500);

            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    myGlobe.width(container.clientWidth).height(container.clientHeight);
                }, 200);
            });
        });
    </script>
</section>