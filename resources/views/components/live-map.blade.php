<section class="bg-[#050b14] text-white relative overflow-hidden font-sans min-h-screen flex flex-col border-y border-gray-800/50">
    
    <!-- CONTAINER PETA: Background Penuh Layar (Sangat Gelap) -->
    <div class="absolute inset-0 z-0 flex items-center justify-center overflow-hidden opacity-40">
        <!-- Bayangan Peta Globe Komdigi (Ganti dengan Engine JS Aslinya Nanti) -->
        <div id="globe-container" class="w-[120%] h-[120%] rounded-full shadow-[inset_0_0_100px_rgba(0,0,0,1)] bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-900/20 via-[#050b14] to-[#050b14] flex items-center justify-center relative mt-40">
             <!-- Titik Pusat "JatimProv" (Meniru gaya titik Komdigi) -->
             <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center gap-2">
                 <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                  </span>
                  <span class="text-blue-500 font-bold tracking-widest text-lg drop-shadow-md">JatimProv</span>
             </div>
        </div>
    </div>

    <!-- HEADER TEXT (Tengah Atas) -->
    <div class="text-center relative z-10 pointer-events-none pt-12 flex flex-col items-center">
        <!-- Garis Keamanan Siber -->
        <div class="flex items-center gap-4 mb-3">
            <div class="h-[1px] w-12 bg-blue-800/60"></div>
            <span class="text-blue-500/80 text-xs font-bold tracking-[0.2em] uppercase">Keamanan Siber</span>
            <div class="h-[1px] w-12 bg-blue-800/60"></div>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold tracking-wide drop-shadow-lg text-gray-100">Peta Ancaman Siber <span class="text-[#00a8ff]">Jawa Timur</span></h2>
        <p class="text-gray-500 text-xs md:text-sm mt-3 drop-shadow-md">Monitoring serangan siber terhadap infrastruktur digital Pemerintah Provinsi Jawa Timur</p>
    </div>

    <!-- AREA WIDGET (Melayang Kiri & Kanan) -->
    <div class="absolute inset-0 z-10 flex flex-col md:flex-row justify-between items-center px-4 md:px-12 pointer-events-none pt-32 pb-16">
        
        <!-- WIDGET KIRI: Total Serangan -->
        <div class="w-full md:w-auto pointer-events-auto mb-6 md:mb-0">
            <div class="bg-[#0a1122]/60 border border-gray-800/60 p-6 rounded-2xl backdrop-blur-md w-72 shadow-lg">
                <div class="flex items-center gap-2 mb-3">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-600"></span>
                    </span>
                    <span class="text-[10px] text-blue-500 font-bold tracking-widest uppercase">Live Threat Map</span>
                </div>
                <h3 class="text-5xl font-bold text-white tracking-tight" id="live-attack-count">104.001</h3>
                <p class="text-[10px] text-gray-500 mt-2 font-mono">serangan terdeteksi 24 jam terakhir</p>
            </div>
        </div>

        <!-- WIDGET KANAN: 3 Panel Tumpuk -->
        <div class="w-full md:w-[320px] flex flex-col gap-4 pointer-events-auto">
            
            <!-- Panel 1: Serangan Terbanyak -->
            <div class="bg-[#0a1122]/60 border border-gray-800/60 p-4 rounded-xl backdrop-blur-md shadow-lg">
                <h4 class="text-[10px] text-gray-400 font-bold tracking-widest mb-3 flex items-center gap-2 uppercase">
                    <svg class="w-3.5 h-3.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Serangan Terbanyak
                </h4>
                <ul class="space-y-2.5 text-[11px] font-mono">
                    <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">1</span> <span class="text-gray-300">Reconnaissance</span></div> <span class="text-red-500">37,939</span></li>
                    <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">2</span> <span class="text-gray-300">SQL Injection</span></div> <span class="text-orange-500">28,357</span></li>
                    <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">3</span> <span class="text-gray-300">Cross-Site Scripting (XSS)</span></div> <span class="text-blue-400">12,723</span></li>
                </ul>
            </div>

            <!-- Panel 2: Negara Sumber -->
            <div class="bg-[#0a1122]/60 border border-gray-800/60 p-4 rounded-xl backdrop-blur-md shadow-lg">
                <h4 class="text-[10px] text-gray-400 font-bold tracking-widest mb-3 flex items-center gap-2 uppercase">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Negara Sumber
                </h4>
                <ul class="space-y-2.5 text-[11px] font-mono">
                    <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">1</span> <span class="text-gray-300">🇮🇩 Indonesia</span></div> <span class="text-orange-500">45,493</span></li>
                    <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">2</span> <span class="text-gray-300">🇸🇬 Singapore</span></div> <span class="text-blue-400">31,987</span></li>
                    <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">3</span> <span class="text-gray-300">🇺🇸 United States</span></div> <span class="text-blue-400">11,117</span></li>
                </ul>
            </div>

            <!-- Panel 3: Top IP Penyerang -->
            <div class="bg-[#0a1122]/60 border border-gray-800/60 p-4 rounded-xl backdrop-blur-md shadow-lg">
                <h4 class="text-[10px] text-gray-400 font-bold tracking-widest mb-3 flex items-center gap-2 uppercase">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    Top IP Penyerang
                </h4>
                <ul class="space-y-2.5 text-[11px] font-mono">
                    <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">1</span> <span class="text-gray-300">180.243.2.151</span></div> <span class="text-red-500">9,050</span></li>
                    <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">2</span> <span class="text-gray-300">103.8.77.26</span></div> <span class="text-[#00a8ff]">8,647</span></li>
                    <li class="flex justify-between items-center"><div class="flex items-center"><span class="bg-yellow-600/20 text-yellow-500 border border-yellow-600/30 w-4 h-4 flex items-center justify-center rounded-[3px] mr-2.5 text-[9px]">3</span> <span class="text-gray-300">172.232.238.140</span></div> <span class="text-[#00a8ff]">6,004</span></li>
                </ul>
            </div>

        </div>
    </div>

    <!-- WIDGET NOTIFIKASI BAWAH (Pill Ticker) -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 pointer-events-auto">
        <div class="bg-[#0a1122]/90 border border-gray-700/50 backdrop-blur-md px-5 py-2.5 rounded-full flex items-center gap-3 shadow-[0_0_15px_rgba(0,0,0,0.5)]">
            <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span></span>
            <span class="text-[11px] font-mono text-gray-300"><span class="text-orange-400 font-bold">SQL Injection</span> &nbsp;🇮🇳 India &nbsp;&rarr;&nbsp; <span class="text-blue-400 font-bold">JatimProv</span></span>
            <span class="bg-red-500/20 text-red-500 border border-red-500/30 text-[9px] px-2 py-0.5 rounded font-bold ml-2">HIGH</span>
        </div>
    </div>

    <!-- TOMBOL SCROLL TO TOP (Opsional, meniru biru di kanan bawah gambar) -->
    <button class="absolute bottom-8 right-8 z-20 bg-[#00a8ff] hover:bg-blue-600 text-white w-10 h-10 rounded-full flex justify-center items-center shadow-lg transition-transform hover:scale-105 pointer-events-auto">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path></svg>
    </button>

    <!-- Ticker Running Text di Bawah (Z-Index dinaikkan agar tidak tertutup peta) -->
    <div class="absolute bottom-0 left-0 w-full bg-[#050b14]/95 border-t border-gray-800/60 p-2.5 overflow-hidden flex whitespace-nowrap text-[11px] text-gray-400 font-mono z-30 backdrop-blur-md shadow-[0_-5px_20px_rgba(0,0,0,0.5)]">
        
        <!-- Kontainer Marquee (Duplikat Data agar loop tidak putus) -->
        <div class="animate-marquee inline-block whitespace-nowrap">
            
            <!-- SET DATA 1 -->
            <span class="mx-6"><span class="text-red-500 mr-2 animate-pulse">●</span> SQL Injection dari 82.197.69.49 &rarr; JatimProv <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
            <span class="mx-6"><span class="text-orange-500 mr-2 animate-pulse">●</span> Reconnaissance dari 165.22.221.124 &rarr; Diskominfo <span class="bg-orange-500/20 text-orange-500 border border-orange-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">HIGH</span></span>
            <span class="mx-6"><span class="text-red-500 mr-2 animate-pulse">●</span> DDoS Attempt dari 145.110.242.20 &rarr; Server Utama <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
            <span class="mx-6"><span class="text-yellow-500 mr-2 animate-pulse">●</span> Brute Force SSH dari 103.111.42.11 &rarr; Database Server <span class="bg-yellow-500/20 text-yellow-500 border border-yellow-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">MEDIUM</span></span>
            <span class="mx-6"><span class="text-blue-500 mr-2 animate-pulse">●</span> Malware Payload dari 45.33.32.156 &rarr; JatimProv <span class="bg-blue-500/20 text-blue-500 border border-blue-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">LOW</span></span>

            <!-- SET DATA 2 (Sengaja diduplikat agar teksnya langsung menyambung dari belakang layar) -->
            <span class="mx-6"><span class="text-red-500 mr-2 animate-pulse">●</span> SQL Injection dari 82.197.69.49 &rarr; JatimProv <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
            <span class="mx-6"><span class="text-orange-500 mr-2 animate-pulse">●</span> Reconnaissance dari 165.22.221.124 &rarr; Diskominfo <span class="bg-orange-500/20 text-orange-500 border border-orange-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">HIGH</span></span>
            <span class="mx-6"><span class="text-red-500 mr-2 animate-pulse">●</span> DDoS Attempt dari 145.110.242.20 &rarr; Server Utama <span class="bg-red-500/20 text-red-500 border border-red-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">CRITICAL</span></span>
            <span class="mx-6"><span class="text-yellow-500 mr-2 animate-pulse">●</span> Brute Force SSH dari 103.111.42.11 &rarr; Database Server <span class="bg-yellow-500/20 text-yellow-500 border border-yellow-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">MEDIUM</span></span>
            <span class="mx-6"><span class="text-blue-500 mr-2 animate-pulse">●</span> Malware Payload dari 45.33.32.156 &rarr; JatimProv <span class="bg-blue-500/20 text-blue-500 border border-blue-500/30 px-1.5 py-0.5 rounded ml-1 font-bold">LOW</span></span>
            
        </div>
    </div>
    
    <!-- Animasi CSS untuk marquee (Wajib di dalam file ini kalau dipisah ke component) -->
    <style>
        @keyframes marquee { 
            0% { transform: translateX(0%); } 
            100% { transform: translateX(-50%); } 
        }
        .animate-marquee { 
            animation: marquee 35s linear infinite; 
            /* Kalau terasa kecepatan/kelambatan, ubah angka 35s di atas */
        }
    </style>
    <!-- ========================================== -->
    <!-- ENGINE 3D GLOBE.GL (MENGUBAH PETA JADI HIDUP) -->
    <!-- ========================================== -->
    <<!-- Load Library Globe.gl dari CDN -->
    <script src="https://unpkg.com/globe.gl"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('globe-container');
            container.innerHTML = ''; 

            const myGlobe = Globe()
                (container)
                .globeImageUrl('https://unpkg.com/three-globe/example/img/earth-dark.jpg')
                .bumpImageUrl('https://unpkg.com/three-globe/example/img/earth-topology.png')
                .backgroundColor('rgba(0,0,0,0)')
                .width(container.clientWidth)
                .height(container.clientHeight);

            const targetJatim = { lat: -7.2504, lng: 112.7688 };
            myGlobe.pointOfView({ lat: targetJatim.lat, lng: targetJatim.lng, altitude: 1.8 });

            myGlobe
                .arcDashLength(0.4)
                .arcDashGap(0.2)
                .arcDashAnimateTime(2000)
                .arcStroke(1.5)
                .ringColor(() => '#00a8ff')
                .ringMaxRadius(5)
                .ringPropagationSpeed(3)
                .ringRepeatPeriod(1000);

            myGlobe.ringsData([targetJatim]);
            myGlobe.controls().autoRotate = true;
            myGlobe.controls().autoRotateSpeed = 0.8;
            myGlobe.controls().enableZoom = false;

            // ==========================================
            // ENGINE SIMULASI SERANGAN REAL-TIME (SYNC)
            // ==========================================
            
            // Data Negara (Lengkap dengan bendera)
            const sourceCountries = [
                { name: 'India', flag: '🇮🇳', lat: 20.5936, lng: 78.9628, color: '#ef4444' },
                { name: 'China', flag: '🇨🇳', lat: 35.8616, lng: 104.1953, color: '#ef4444' },
                { name: 'United States', flag: '🇺🇸', lat: 37.0902, lng: -95.7128, color: '#f97316' },
                { name: 'Russia', flag: '🇷🇺', lat: 61.5240, lng: 105.3188, color: '#ef4444' },
                { name: 'Singapore', flag: '🇸🇬', lat: 1.3520, lng: 103.8198, color: '#00a8ff' },
                { name: 'North Korea', flag: '🇰🇵', lat: 40.3399, lng: 127.5101, color: '#ef4444' }
            ];

            // Data Jenis Serangan
            const attackTypes = [
                { name: 'SQL Injection', level: 'CRITICAL', textClass: 'text-red-500', bgClass: 'bg-red-500', badgeClass: 'bg-red-500/20 border-red-500/30 text-red-500' },
                { name: 'DDoS Attempt', level: 'HIGH', textClass: 'text-orange-500', bgClass: 'bg-orange-500', badgeClass: 'bg-orange-500/20 border-orange-500/30 text-orange-500' },
                { name: 'Cross-Site Scripting', level: 'MEDIUM', textClass: 'text-yellow-500', bgClass: 'bg-yellow-500', badgeClass: 'bg-yellow-500/20 border-yellow-500/30 text-yellow-500' },
                { name: 'Brute Force SSH', level: 'HIGH', textClass: 'text-orange-500', bgClass: 'bg-orange-500', badgeClass: 'bg-orange-500/20 border-orange-500/30 text-orange-500' },
                { name: 'Malware Payload', level: 'CRITICAL', textClass: 'text-red-500', bgClass: 'bg-red-500', badgeClass: 'bg-red-500/20 border-red-500/30 text-red-500' }
            ];

            let activeAttacks = [];

            // Eksekusi setiap 2,5 detik
            setInterval(() => {
                // 1. Acak Data Serangan
                const randomCountry = sourceCountries[Math.floor(Math.random() * sourceCountries.length)];
                const randomAttack = attackTypes[Math.floor(Math.random() * attackTypes.length)];
                // Bikin IP Address Acak (Contoh: 192.168.x.x)
                const randomIP = `${Math.floor(Math.random()*255)}.${Math.floor(Math.random()*255)}.${Math.floor(Math.random()*255)}.${Math.floor(Math.random()*255)}`;

                // 2. Tembakkan Laser di Globe
                const newAttack = {
                    startLat: randomCountry.lat + (Math.random() - 0.5) * 5,
                    startLng: randomCountry.lng + (Math.random() - 0.5) * 5,
                    endLat: targetJatim.lat,
                    endLng: targetJatim.lng,
                    color: randomCountry.color
                };

                activeAttacks.push(newAttack);
                if (activeAttacks.length > 15) activeAttacks.shift();

                myGlobe.arcsData(activeAttacks)
                       .arcStartLat(d => d.startLat)
                       .arcStartLng(d => d.startLng)
                       .arcEndLat(d => d.endLat)
                       .arcEndLng(d => d.endLng)
                       .arcColor(d => d.color);

                // ==========================================
                // 3. UPDATE NOTIFIKASI PIL (TENGAH BAWAH)
                // ==========================================
                // Cari elemen notifikasi pil berdasarkan posisinya
                const pillTicker = document.querySelector('.absolute.bottom-8.left-1\\/2 > div');
                if (pillTicker) {
                    pillTicker.innerHTML = `
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full ${randomAttack.bgClass} opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 ${randomAttack.bgClass}"></span>
                        </span>
                        <span class="text-[11px] font-mono text-gray-300"><span class="${randomAttack.textClass} font-bold">${randomAttack.name}</span> &nbsp;${randomCountry.flag} ${randomCountry.name} &nbsp;&rarr;&nbsp; <span class="text-blue-400 font-bold">JatimProv</span></span>
                        <span class="${randomAttack.badgeClass} border text-[9px] px-2 py-0.5 rounded font-bold ml-2">${randomAttack.level}</span>
                    `;
                }

                // ==========================================
                // 4. UPDATE SLIDE GESER (MARQUEE)
                // ==========================================
                const marqueeContainer = document.querySelector('.animate-marquee');
                if (marqueeContainer) {
                    // Buat elemen span baru untuk dimasukkan ke slide geser
                    const newLog = document.createElement('span');
                    newLog.className = "mx-6";
                    newLog.innerHTML = `<span class="${randomAttack.textClass} mr-2 animate-pulse">●</span> ${randomAttack.name} dari ${randomIP} &rarr; JatimProv <span class="${randomAttack.badgeClass} border px-1.5 py-0.5 rounded ml-1 font-bold">${randomAttack.level}</span>`;
                    
                    // Sisipkan di paling depan
                    marqueeContainer.prepend(newLog);

                    // Hapus data lama agar memori browser tidak jebol (maksimal 20 teks geser)
                    if (marqueeContainer.children.length > 20) {
                        marqueeContainer.removeChild(marqueeContainer.lastChild);
                    }
                }

                // ==========================================
                // 5. UPDATE ANGKA STATISTIK (KIRI)
                // ==========================================
                const countElement = document.getElementById('live-attack-count');
                if (countElement) {
                    let currentCount = parseInt(countElement.innerText.replace(/\./g, ''));
                    currentCount += Math.floor(Math.random() * 3) + 1;
                    countElement.innerText = currentCount.toLocaleString('id-ID');
                }

            }, 2500); // Tembak laser setiap 2.5 detik

            window.addEventListener('resize', () => {
                myGlobe.width(container.clientWidth).height(container.clientHeight);
            });
        });
    </script>

</section>