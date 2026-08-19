@php
    $type = request('type', 'threat');
    $id = request('id', 'Unknown Indicator');
    
    $score = rand(40, 100) / 10;
    $status = $score >= 7 ? 'CRITICAL' : ($score >= 4 ? 'ELEVATED' : 'LOW');
    
    // Explicit tailwind class mappings for JIT compiler
    $colors = [
        'CRITICAL' => ['text' => 'text-red-500', 'border' => 'border-t-red-500', 'badge_bg' => 'bg-red-500/10', 'badge_border' => 'border-red-500/50', 'badge_text' => 'text-red-600 dark:text-red-400', 'glow' => 'bg-red-600/5 dark:bg-red-500/10'],
        'ELEVATED' => ['text' => 'text-amber-500', 'border' => 'border-t-amber-500', 'badge_bg' => 'bg-amber-500/10', 'badge_border' => 'border-amber-500/50', 'badge_text' => 'text-amber-600 dark:text-amber-400', 'glow' => 'bg-amber-600/5 dark:bg-amber-500/10'],
        'LOW'      => ['text' => 'text-cyan-500', 'border' => 'border-t-cyan-500', 'badge_bg' => 'bg-cyan-500/10', 'badge_border' => 'border-cyan-500/50', 'badge_text' => 'text-cyan-600 dark:text-cyan-400', 'glow' => 'bg-cyan-600/5 dark:bg-cyan-500/10']
    ];
    $c = $colors[$status];
@endphp
<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelijen Detail - {{ $id }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-[#020617] dark:text-gray-200 font-sans flex flex-col min-h-screen overflow-x-hidden selection:bg-cyan-500 selection:text-white">

    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-40 dark:opacity-100 z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] {{ $c['glow'] }} rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="relative z-50"><x-navbar /></div>

    <div class="flex-grow relative z-10 flex flex-col items-center w-full pt-16 pb-24">
        <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <a href="/ioc?feed={{ $type }}" class="inline-flex items-center text-[10px] font-bold font-mono text-gray-500 dark:text-gray-400 hover:text-blue-500 mb-8 transition-transform hover:-translate-x-2 duration-300 uppercase tracking-widest bg-white/50 dark:bg-slate-900/50 px-4 py-2 rounded-xl border border-gray-200 dark:border-slate-800 backdrop-blur-md shadow-sm">
                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar
            </a>

            <!-- Header Laporan -->
            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-gray-200 dark:border-slate-800 rounded-3xl p-8 md:p-12 shadow-xl mb-8 border-t-4 {{ $c['border'] }} relative overflow-hidden">
                <!-- Watermark -->
                <div class="absolute -right-10 -top-10 text-[150px] font-black text-slate-900/5 dark:text-white/5 pointer-events-none font-display uppercase">
                    {{ substr($type, 0, 3) }}
                </div>

                <div class="flex items-center gap-3 mb-6 relative z-10">
                    <span class="px-3 py-1 {{ $c['badge_bg'] }} {{ $c['badge_border'] }} {{ $c['badge_text'] }} font-mono text-[9px] font-bold uppercase tracking-widest rounded">
                        INTEL REPORT // {{ strtoupper($type) }}
                    </span>
                    <span class="px-3 py-1 bg-red-500/10 border border-red-500/50 text-red-600 dark:text-red-400 font-mono text-[9px] font-bold uppercase tracking-widest rounded animate-pulse">
                        {{ $status }}
                    </span>
                </div>

                <h1 class="font-mono text-2xl md:text-3xl font-bold text-slate-900 dark:text-white tracking-tight mb-8 break-all relative z-10 leading-relaxed">
                    {{ $id }}
                </h1>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 relative z-10 pt-8 border-t border-gray-200 dark:border-slate-800/80">
                    <div>
                        <div class="text-[9px] font-mono text-slate-500 uppercase tracking-widest mb-1">Threat Score</div>
                        <div class="text-2xl font-display font-bold {{ $c['text'] }}">{{ $score }}/10</div>
                    </div>
                    <div>
                        <div class="text-[9px] font-mono text-slate-500 uppercase tracking-widest mb-1">First Seen</div>
                        <div class="text-sm font-mono font-bold text-slate-300">15 Aug 2026</div>
                    </div>
                    <div>
                        <div class="text-[9px] font-mono text-slate-500 uppercase tracking-widest mb-1">Confidence</div>
                        <div class="text-sm font-mono font-bold text-green-500">98% (High)</div>
                    </div>
                    <div>
                        <div class="text-[9px] font-mono text-slate-500 uppercase tracking-widest mb-1">Status</div>
                        <div class="text-sm font-mono font-bold text-red-500">ACTIVE</div>
                    </div>
                </div>
            </div>

            <!-- Terminal Data Dump -->
            <div class="bg-[#0f172a] rounded-2xl overflow-hidden shadow-2xl border border-slate-800">
                <div class="bg-slate-900 px-4 py-3 border-b border-slate-800 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="ml-2 text-[9px] font-mono text-slate-500 uppercase tracking-widest">RAW_ANALYSIS.JSON</span>
                    </div>
                    <button class="text-[9px] font-mono text-cyan-400 hover:text-white uppercase tracking-widest transition-colors">COPY</button>
                </div>
                <div class="p-6 overflow-x-auto text-xs font-mono text-cyan-300 leading-relaxed">
<pre><code>{
  "indicator": "{{ $id }}",
  "type": "{{ $type }}",
  "threat_level": "{{ $status }}",
  "cvss_score": {{ $score }},
  "tlp": "AMBER",
  "tags": [
    "malicious",
    "targeted-attack",
    "apt-related"
  ],
  "analysis": {
    "sandbox_status": "malicious behavior detected",
    "c2_connections": 4,
    "dropped_files": [
      "/tmp/setup.sh",
      "/var/run/kswapd0"
    ],
    "mitre_attck": [
      "T1059.004",
      "T1071.001",
      "T1573.001"
    ]
  },
  "recommended_action": "Block indicator at firewall/EDR immediately."
}</code></pre>
                </div>
            </div>

        </div>
    </div>

    <x-footer />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />
</body>
</html>
