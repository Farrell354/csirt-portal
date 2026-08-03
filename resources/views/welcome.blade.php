<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JatimProv-CSIRT | Portal Keamanan Siber</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        kominfo: '#0056B3',
                        kominfo_dark: '#0A3A64',
                        accent: '#F59E0B',
                        footer_bg: '#161b22'
                    }
                }
            }
        }
    </script>
    
    <!-- ========================================== -->
    <!-- ANIMASI BACKGROUND HERO SECTION -->
    <!-- ========================================== -->
    <style>
        @keyframes panImage {
            0% { transform: scale(1) translate(0px, 0px); }
            50% { transform: scale(1.1) translate(-15px, 10px); }
            100% { transform: scale(1) translate(0px, 0px); }
        }
        .animate-pan-bg {
            animation: panImage 25s infinite alternate ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 transition-colors duration-300 dark:bg-slate-900 dark:text-gray-200 font-sans flex flex-col min-h-screen">

    <!-- NAVBAR (Gaya Profesional) -->
    <x-navbar />

    <!-- KONTEN UTAMA -->
    <div class="flex-grow">
        
        <!-- HERO SECTION (Desain Command Center) -->
        <header class="relative w-full min-h-[calc(100vh-64px)] flex items-center justify-center bg-slate-900 overflow-hidden">
            <!-- BACKGROUND IMAGE DENGAN ANIMASI -->
            <div class="absolute inset-0 z-0">
                <!-- Class animate-pan-bg ditambahkan di sini -->
                <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070&auto=format&fit=crop" alt="Cyber Background" class="w-full h-full object-cover opacity-20 grayscale animate-pan-bg">
                <div class="absolute inset-0 bg-gradient-to-b from-slate-950/90 via-slate-900/80 to-slate-950/95"></div>
            </div>

            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white pb-10">
                <div class="inline-block border border-kominfo/50 text-kominfo px-3 py-1 text-xs font-bold tracking-widest uppercase mb-6 bg-kominfo/10">
                    Pusat Tanggap Darurat Siber 24/7
                </div>
                <h1 class="text-4xl md:text-6xl font-black tracking-tight mb-6 drop-shadow-xl">
                    JatimProv-CSIRT
                </h1>
                <p class="text-sm md:text-base text-gray-400 mb-10 leading-relaxed max-w-3xl mx-auto">
                    Jawa Timur Province Computer Security Incident Response Team ( JatimProv-CSIRT ). Bertanggung jawab sebagai ketua adalah Kepala Dinas Komunikasi dan Informatika Provinsi Jawa Timur. Tim tanggap darurat yang beranggotakan bidang persandian dan keamanan informasi.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="/profil" class="px-8 py-3 border border-gray-500 text-gray-300 hover:bg-white hover:text-slate-900 hover:border-white transition-all duration-300 font-semibold text-sm tracking-wide rounded-sm">Pelajari Lebih Lanjut</a>
                    <a href="/login" class="px-8 py-3 bg-kominfo border border-kominfo text-white hover:bg-kominfo_dark hover:border-kominfo_dark transition-all duration-300 font-semibold text-sm tracking-wide rounded-sm shadow-lg shadow-kominfo/20">Lapor Insiden</a>
                </div>
            </div>
        </header>

<x-live-map />
<!-- ========================================== -->
<!-- SCRIPT ENGINE BOLA DUNIA (GLOBE.GL) ULTIMATE -->
<!-- ========================================== -->
<script src="https://unpkg.com/three"></script>
<script src="https://unpkg.com/globe.gl"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.getElementById('globe-container');
        container.innerHTML = ''; 

        // 1. Inisialisasi Dasar Globe
        const world = Globe()(container)
            .globeImageUrl('https://unpkg.com/three-globe/example/img/earth-dark.jpg')
            .bumpImageUrl('https://unpkg.com/three-globe/example/img/earth-topology.png')
            .backgroundColor('rgba(0,0,0,0)') 
            .width(container.clientWidth)
            .height(500);

        // ==========================================
        // 2. DATA PETA & TOOLTIP (KOTAK DATA)
        // ==========================================
        fetch('https://raw.githubusercontent.com/vasturiano/globe.gl/master/example/datasets/ne_110m_admin_0_countries.geojson')
            .then(res => res.json())
            .then(countries => {
                world.polygonsData(countries.features)
                    .polygonCapColor(feat => feat.properties.ISO_A2 === 'ID' ? 'rgba(0, 200, 255, 0.1)' : 'rgba(0,0,0,0)') 
                    .polygonStrokeColor(feat => feat.properties.ISO_A2 === 'ID' ? '#00e5ff' : '#1f2937')
                    // Efek warna berubah saat mouse melakukan hover
                    .polygonHoverColor(() => 'rgba(0, 229, 255, 0.3)')
                    // Desain kotak data (Tooltip) persis seperti referensi Komdigi
                    .polygonLabel(feat => `
                        <div class="bg-[#0f172a] border border-gray-700 rounded-lg p-3 shadow-2xl font-sans" style="min-width: 180px;">
                            <div class="flex items-center gap-2 mb-1 border-b border-gray-700 pb-2">
                                <span class="text-white font-bold text-sm tracking-wide">${feat.properties.ADMIN}</span>
                                <span class="text-gray-500 text-xs">${feat.properties.ISO_A2}</span>
                            </div>
                            <div class="text-xs mt-2">
                                ${feat.properties.ISO_A2 === 'ID' 
                                    ? '<span class="text-emerald-400">● Tidak ada serangan kritis</span>' 
                                    : '<span class="text-gray-500">● Data tidak dimonitor</span>'}
                            </div>
                        </div>
                    `);
            });

        // ==========================================
        // 3. MARKER TITIK LOKASI (Titik Biru CSIRT)
        // ==========================================
        const targetLat = -7.250445; // Koordinat Surabaya
        const targetLng = 112.768845;
        
        world.htmlElementsData([{ lat: targetLat, lng: targetLng, name: 'JatimProv' }])
             .htmlElement(d => {
                 const el = document.createElement('div');
                 el.innerHTML = `
                    <div class="flex items-center gap-1.5 cursor-pointer transform -translate-x-1/2 -translate-y-1/2 hover:scale-110 transition-transform">
                        <span class="relative flex h-4 w-4">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-4 w-4 bg-blue-500 border-2 border-gray-900"></span>
                        </span>
                        <span class="text-blue-400 font-bold text-sm bg-gray-900/80 px-2 py-0.5 rounded shadow-lg backdrop-blur-sm border border-blue-900/50">
                            ${d.name}
                        </span>
                    </div>
                 `;
                 return el;
             });

        // ==========================================
        // 4. ANIMASI LASER SERANGAN
        // ==========================================
        const arcsData = [...Array(12).keys()].map(() => ({
            startLat: (Math.random() - 0.5) * 180,
            startLng: (Math.random() - 0.5) * 360,
            endLat: targetLat,
            endLng: targetLng,
            color: ['#ff0000', '#ff7a00', '#00e5ff'][Math.floor(Math.random() * 3)]
        }));

        world
            .arcsData(arcsData)
            .arcColor('color')
            .arcDashLength(0.4)
            .arcDashGap(4)
            .arcDashInitialGap(() => Math.random() * 5)
            .arcDashAnimateTime(2000)
            .arcStroke(0.6);

        // ==========================================
        // 5. KONTROL KAMERA & AUTO-ROTATE CERDAS
        // ==========================================
        world.controls().enableZoom = true;
        
        // Atur posisi awal (Fokus ke Indonesia)
        world.pointOfView({ lat: -2.0, lng: 118.0, altitude: 0.9 });

        const controls = world.controls();
        controls.autoRotate = true; // Otomatis muter nyala di awal
        controls.autoRotateSpeed = 0.8; // Kecepatan muter yang pas (elegan)

        // Logika Pintar: Kalau mouse berinteraksi, berhenti muter. Kalau nganggur 3 detik, muter lagi.
        let interactionTimeout;
        const resetInteraction = () => {
            controls.autoRotate = false; // Matikan rotasi
            clearTimeout(interactionTimeout);
            interactionTimeout = setTimeout(() => {
                controls.autoRotate = true; // Nyalakan lagi setelah 3 detik dicuekin
            }, 3000); 
        };

        // Deteksi semua jenis sentuhan/geseran pengguna di area kanvas globe
        container.addEventListener('mousedown', resetInteraction);
        container.addEventListener('mousemove', resetInteraction);
        container.addEventListener('wheel', resetInteraction);
        container.addEventListener('touchstart', resetInteraction);

        // Responsive jika browser di-resize
        window.addEventListener('resize', () => {
            world.width(container.clientWidth);
        });
    });
</script>
        <!-- LATEST POST SECTION (Gaya Editorial Tajam) -->
        <section class="bg-white dark:bg-slate-900 py-20 border-t border-gray-200 dark:border-slate-800 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Section Header -->
                <div class="flex justify-between items-end border-b border-gray-200 dark:border-slate-800 pb-4 mb-12">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white uppercase tracking-wide">Publikasi Terbaru</h2>
                    <a href="/artikel" class="text-sm font-bold text-kominfo hover:text-kominfo_dark dark:text-blue-500 uppercase tracking-wide">Lihat Semua &rarr;</a>
                </div>
                
                <!-- GRID ARTIKEL BERANDA (Dinamis) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($artikelTerkini as $artikel)
                <div class="group border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:border-kominfo dark:hover:border-kominfo transition-all duration-300 flex flex-col rounded-sm overflow-hidden shadow-sm hover:shadow-md">
                    <div class="relative h-48 bg-gray-900 overflow-hidden">
                        <img src="{{ $artikel->gambar }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500">
                        <div class="absolute top-4 left-4 bg-slate-900 text-white text-[10px] font-bold px-2 py-1 uppercase tracking-widest border-l-2 border-kominfo">
                            {{ $artikel->kategori }}
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="font-bold text-lg mb-3 dark:text-white leading-snug group-hover:text-kominfo transition-colors line-clamp-2" title="{{ $artikel->judul }}">
                            {{ $artikel->judul }}
                        </h3>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-6 uppercase tracking-wider font-semibold mt-auto">
                            {{ $artikel->penulis }} <span class="mx-1">|</span> {{ \Carbon\Carbon::parse($artikel->tanggal_publikasi)->format('M d, Y') }}
                        </p>
                        <a href="/artikel/{{ $artikel->id }}" class="inline-flex items-center text-kominfo font-bold text-xs uppercase tracking-widest hover:text-kominfo_dark transition-colors">
                            Baca Selengkapnya 
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
        </section>
    </div>

    <x-footer />

    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
<x-chatbot />
</html>