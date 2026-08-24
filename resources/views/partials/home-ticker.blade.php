        <!-- ═══════════════════════════════════════════════════════
             TICKER — Threat Feed
        ═══════════════════════════════════════════════════════ -->
        <div class="bg-slate-950 border-y border-slate-800/80 overflow-hidden py-2.5 sm:py-3 relative z-20" aria-label="Live threat feed">
            <div class="absolute left-0 top-0 h-full w-16 sm:w-32 bg-gradient-to-r from-slate-950 to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 h-full w-16 sm:w-32 bg-gradient-to-l from-slate-950 to-transparent z-10 pointer-events-none"></div>
            <div class="ticker-track flex gap-8 sm:gap-12 whitespace-nowrap select-none" role="marquee">
                @foreach ([
                    ['🟡', 'CVE-2025-0001', 'RCE — Apache HTTPD 2.4.x'],
                    ['🔴', 'CVE-2025-1234', 'Critical — Ivanti Connect'],
                    ['🟢', 'ADVISORY', 'Jatim Shield v2.1 Deployed'],
                    ['🟡', 'CVE-2025-4321', 'High — OpenSSH Auth Bypass'],
                    ['🔵', 'UPDATE', 'Patch Tuesday Agustus 2025'],
                    ['🔴', 'INCIDENT', 'Phishing Campaign — EDU Sektor'],
                ] as $item)
                <span class="inline-flex items-center gap-2 sm:gap-3 font-mono text-[10px] sm:text-xs text-slate-400">
                    <span>{{ $item[0] }}</span>
                    <span class="text-cyan-500 font-bold">{{ $item[1] }}</span>
                    <span>{{ $item[2] }}</span>
                    <span class="text-slate-700 mx-1 sm:mx-2">▸</span>
                </span>
                @endforeach
                {{-- Duplicate for seamless loop --}}
                @foreach ([
                    ['🟡', 'CVE-2025-0001', 'RCE — Apache HTTPD 2.4.x'],
                    ['🔴', 'CVE-2025-1234', 'Critical — Ivanti Connect'],
                    ['🟢', 'ADVISORY', 'Jatim Shield v2.1 Deployed'],
                    ['🟡', 'CVE-2025-4321', 'High — OpenSSH Auth Bypass'],
                    ['🔵', 'UPDATE', 'Patch Tuesday Agustus 2025'],
                    ['🔴', 'INCIDENT', 'Phishing Campaign — EDU Sektor'],
                ] as $item)
                <span class="inline-flex items-center gap-2 sm:gap-3 font-mono text-[10px] sm:text-xs text-slate-400">
                    <span>{{ $item[0] }}</span>
                    <span class="text-cyan-500 font-bold">{{ $item[1] }}</span>
                    <span>{{ $item[2] }}</span>
                    <span class="text-slate-700 mx-1 sm:mx-2">▸</span>
                </span>
                @endforeach
            </div>
        </div>
