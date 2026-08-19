<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelajaran Insiden - JatimProv-CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-[#020617] text-gray-200 font-sans flex flex-col min-h-screen overflow-x-hidden selection:bg-cyan-500 selection:text-white dark">
    <!-- Forcing dark mode classes essentially by default on body just in case, but keeping standard structure -->
    
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-100 z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-cyan-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50"><x-navbar /></div>

    <div class="flex-grow relative z-10 flex flex-col items-center w-full pt-16 pb-24">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- HEADER -->
            <div class="text-center mb-10 opacity-0 animate-fade-in-up">
                <h1 class="font-display text-4xl md:text-5xl font-black text-white tracking-tight mb-4 uppercase text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">
                    PEMBELAJARAN INSIDEN
                </h1>
                <p class="text-xs md:text-sm text-slate-400 font-medium max-w-3xl mx-auto leading-relaxed">
                    Studi kasus insiden siber nyata — kronologi, dampak, dan rekomendasi.
                </p>
            </div>

            <!-- SEARCH -->
            <div class="max-w-2xl mx-auto mb-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="relative group">
                    <input type="text" placeholder="Cari insiden berdasarkan judul atau kutipan..." class="w-full bg-slate-900/80 border border-slate-700/80 text-sm px-5 py-3.5 rounded-xl outline-none focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-500 transition-all text-gray-200 shadow-sm placeholder-slate-500 pl-11">
                    <svg class="w-5 h-5 absolute left-4 top-3.5 text-slate-500 group-focus-within:text-cyan-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            <!-- TAGS -->
            <div class="flex flex-wrap justify-center gap-2.5 mb-12 opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                <button class="px-4 py-1.5 bg-cyan-900/30 border border-cyan-500 text-cyan-400 font-mono text-[10px] font-bold rounded-md hover:bg-cyan-500 hover:text-white transition-colors">Semua</button>
                @foreach(['#Account Hijacking', '#Anomali Traffic', '#Data Leak', '#Injection', '#Judol', '#Malware', '#Sensitive Data Exposure', '#Session Hijacking', '#Weak Password', '#Web Defacement'] as $tag)
                <button class="px-3 py-1.5 bg-slate-900/50 border border-indigo-900/50 text-indigo-400 font-mono text-[10px] font-bold rounded-md hover:border-indigo-500 hover:text-indigo-300 transition-colors">{{ $tag }}</button>
                @endforeach
            </div>

            <!-- MASONRY GRID -->
            @php
                $cases = [
                    [
                        'tags' => ['MALWARE', 'ACCOUNT HIJACKING', 'SESSION HIJACKING'],
                        'severity' => 'KRITIS', 'sev_color' => 'red', 'sev_icon' => '🔴',
                        'quote' => 'Peretas mencuri session cookie untuk mengambil alih sesi aktif dan menyebarkan pesan spam tanpa perlu melakukan login ulang atau memicu otentikasi 2FA.',
                        'date' => 'August 2026'
                    ],
                    [
                        'tags' => ['DATA LEAK', 'INJECTION', 'WEAK PASSWORD'],
                        'severity' => 'KRITIS', 'sev_color' => 'red', 'sev_icon' => '🔴',
                        'quote' => 'Ditemukan celah SQL Injection yang membocorkan struktur basis data serta penggunaan kredensial default yang berisiko tinggi terhadap akses tidak sah.',
                        'date' => 'July 2026'
                    ],
                    [
                        'tags' => ['MALWARE', 'ANOMALI TRAFFIC'],
                        'severity' => 'SEDANG', 'sev_color' => 'amber', 'sev_icon' => '🟡',
                        'quote' => 'Terdeteksi komunikasi dua arah dengan domain berbahaya yang mengindikasikan 100% status compromise pada perangkat terdampak.',
                        'date' => 'July 2026'
                    ],
                    [
                        'tags' => ['SENSITIVE DATA EXPOSURE'],
                        'severity' => 'SEDANG', 'sev_color' => 'amber', 'sev_icon' => '🟡',
                        'quote' => 'Informasi sensitif yang tak terproteksi adalah pintu terbuka bagi siapa saja. Pencarian sederhana di mesin pencari sudah cukup untuk mengekspos data pribadi yang seharusnya terlindungi.',
                        'date' => 'July 2026'
                    ],
                    [
                        'tags' => ['WEB DEFACEMENT', 'JUDOL'],
                        'severity' => 'TINGGI', 'sev_color' => 'orange', 'sev_icon' => '🟠',
                        'quote' => 'Penyisipan konten judi online yang mengganggu integritas halaman web resmi instansi akibat celah...',
                        'date' => 'June 2026'
                    ],
                    [
                        'tags' => ['DATA LEAK', 'REKAP'],
                        'severity' => 'SEDANG', 'sev_color' => 'amber', 'sev_icon' => '🟡',
                        'quote' => 'Lemahnya kontrol akses pada repositori publik website Produk Hukum memicu kebocoran data pribadi yang tidak disengaja.',
                        'date' => 'June 2026'
                    ]
                ];
                
                // Mappings for severity tailwind classes (JIT safe)
                $colors = [
                    'red' => 'bg-red-500/10 border-red-500/50 text-red-500',
                    'amber' => 'bg-amber-500/10 border-amber-500/50 text-amber-500',
                    'orange' => 'bg-orange-500/10 border-orange-500/50 text-orange-500'
                ];
            @endphp

            <div class="columns-1 md:columns-2 lg:columns-3 xl:columns-4 gap-6 opacity-0 animate-fade-in-up" style="animation-delay: 0.3s;">
                @foreach($cases as $case)
                <div class="break-inside-avoid bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-2xl p-6 mb-6 shadow-xl hover:border-cyan-500/50 transition-colors group cursor-pointer relative overflow-hidden">
                    
                    <!-- Glow effect on hover -->
                    <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/0 to-cyan-500/0 group-hover:from-cyan-500/5 transition-all duration-500"></div>

                    <!-- Small Tags -->
                    <div class="flex flex-wrap gap-2 mb-4 relative z-10">
                        @foreach($case['tags'] as $tag)
                        <span class="px-2 py-0.5 bg-cyan-900/30 border border-cyan-800 text-cyan-400 font-mono text-[8px] font-bold uppercase rounded">{{ $tag }}</span>
                        @endforeach
                    </div>

                    <!-- Severity Pill -->
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 {{ $colors[$case['sev_color']] }} border font-mono text-[9px] font-bold rounded mb-5 relative z-10">
                        <span>{{ $case['sev_icon'] }}</span> {{ $case['severity'] }}
                    </div>

                    <!-- Quote Text -->
                    <div class="relative z-10 mb-6">
                        <span class="text-cyan-400 font-display text-2xl font-black absolute -left-2 -top-1">"</span>
                        <p class="text-sm text-slate-300 font-medium leading-relaxed pl-2 group-hover:text-white transition-colors">
                            {{ $case['quote'] }}<span class="text-cyan-400 font-display text-lg font-black">"</span>
                        </p>
                    </div>

                    <!-- Footer / Date -->
                    <div class="flex items-center gap-2 text-slate-500 pt-4 border-t border-slate-800/80 relative z-10">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="font-mono text-[10px] uppercase tracking-widest">{{ $case['date'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>

    <x-footer />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.opacity-0.animate-fade-in-up').forEach(el => {
                setTimeout(() => el.style.opacity = '1', parseInt(el.style.animationDelay)*1000 || 300);
            });
        });
    </script>
</body>
</html>
