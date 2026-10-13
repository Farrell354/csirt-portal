<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advisory Remediasi Kerentanan #{{ strtoupper(substr((string) $laporan->id, 0, 8)) }} — JatimProv-CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @media print {
            @page {
                size: A4 portrait;
                margin: 15mm 12mm 15mm 12mm;
            }
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                background-color: #ffffff !important;
                color: #000000 !important;
                font-family: ui-serif, Georgia, Cambria, "Times New Roman", Times, serif !important;
            }
            .print-no-break {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }
            .print-hidden {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 font-serif min-h-screen flex flex-col items-center py-8 print:py-0 print:bg-white selection:bg-indigo-500 selection:text-white">

    <!-- Top Action Toolbar (Hidden during print) -->
    <div class="print:hidden w-full max-w-4xl px-4 mb-6">
        <div class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl border border-gray-200 dark:border-slate-800 p-4 rounded-2xl shadow-xl flex flex-col sm:flex-row items-center justify-between gap-4 font-sans">
            <a href="{{ route('admin.laporan.show', $laporan) }}"
               class="inline-flex items-center text-xs font-bold text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors uppercase tracking-widest">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Review Tiket
            </a>

            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-500 font-mono">Format Dokumen Resmi Diskominfo Jatim</span>
                <button onclick="window.print()"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-500 hover:from-indigo-500 hover:to-violet-400 text-white text-xs font-bold py-2.5 px-6 rounded-xl transition-all shadow-md hover:shadow-indigo-500/30 uppercase tracking-wider cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak / Simpan PDF
                </button>
            </div>
        </div>
    </div>

    <!-- Official Document Sheet (A4 format) -->
    <div class="w-full max-w-4xl bg-white text-black p-10 md:p-14 shadow-2xl print:shadow-none print:p-0 print:m-0 border border-gray-200 print:border-none print-no-break">

        <!-- KOP SURAT RESMI -->
        <div class="border-b-4 border-black pb-4 mb-6 flex items-center justify-between">
            <div class="w-24 shrink-0 flex items-center justify-center">
                <img src="{{ asset('img/logo-csirt.png') }}" alt="Logo CSIRT" class="w-20 h-auto">
            </div>
            <div class="text-center flex-1 px-4">
                <h1 class="text-lg md:text-xl font-bold uppercase tracking-wider">Pemerintah Provinsi Jawa Timur</h1>
                <h2 class="text-xl md:text-2xl font-black uppercase tracking-widest mt-0.5">Dinas Komunikasi dan Informatika</h2>
                <h3 class="text-base md:text-lg font-bold mt-0.5">Tim Tanggap Insiden Siber (JatimProv-CSIRT)</h3>
                <p class="text-[11px] mt-1 font-sans text-gray-700">Jl. Ahmad Yani No. 242-244, Gayungan, Surabaya, Jawa Timur 60235</p>
                <p class="text-[11px] font-sans text-gray-700">Website: csirt.jatimprov.go.id | Email: csirt@jatimprov.go.id | Telp: (031) 8294608</p>
            </div>
            <div class="w-24 shrink-0"></div>
        </div>

        <!-- NOMOR & JUDUL ADVISORY -->
        <div class="text-center mb-8 font-sans">
            <div class="inline-block px-3 py-1 bg-gray-100 border border-gray-300 text-[10px] font-mono font-bold tracking-widest uppercase rounded mb-2">
                DOKUMEN_KLASIFIKASI: TERBATAS // TLP:AMBER
            </div>
            <h2 class="text-lg md:text-xl font-black uppercase underline decoration-2 underline-offset-4 font-serif">
                Vulnerability Remediation Advisory
            </h2>
            <p class="text-xs text-gray-600 font-mono mt-1">
                Nomor: CSIRT-ADV/{{ date('Y') }}/{{ strtoupper(substr((string) $laporan->id, 0, 8)) }}
            </p>
        </div>

        <!-- 1. INFORMASI UMUM INSIDEN & TIKET -->
        <div class="mb-6 font-sans print-no-break">
            <h3 class="text-xs font-black uppercase tracking-wider bg-gray-100 border-l-4 border-black px-3 py-1.5 mb-3 font-sans">
                I. Informasi Umum & Registrasi Tiket
            </h3>
            <table class="w-full border-collapse border border-black text-xs">
                <tbody>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold w-1/4">ID Tiket (UUID v4)</td>
                        <td class="border border-black p-2 font-mono break-all">{{ $laporan->id }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold">Target Aset / Domain</td>
                        <td class="border border-black p-2 font-mono font-bold break-all text-blue-900">{{ $laporan->target_url }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold">Klasifikasi Kerentanan</td>
                        <td class="border border-black p-2 font-semibold">{{ $laporan->jenis_kerentanan }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold">Tingkat Keparahan (Severity)</td>
                        <td class="border border-black p-2 font-bold">
                            @if($laporan->severity === 'Critical')
                                <span class="text-red-700 font-black">CRITICAL</span>
                            @elseif($laporan->severity === 'High')
                                <span class="text-orange-700 font-black">HIGH</span>
                            @elseif($laporan->severity === 'Medium')
                                <span class="text-amber-700 font-bold">MEDIUM</span>
                            @else
                                <span class="text-emerald-700 font-bold">LOW</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold">Waktu Submit Laporan</td>
                        <td class="border border-black p-2 font-mono">
                            {{ \Carbon\Carbon::parse($laporan->created_at)->setTimezone('Asia/Jakarta')->format('d F Y — H:i:s') }} WIB
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold">Pelapor (Bug Hunter)</td>
                        <td class="border border-black p-2">
                            @if($laporan->is_anonymous)
                                <span class="font-mono text-gray-700">{{ $laporan->pseudonym ?: 'Analis Independen (Anonim)' }} [Identitas Terlindungi]</span>
                            @else
                                <span class="font-bold">{{ $laporan->user->name ?? 'Analis Independen' }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold">Status Triase & Validasi</td>
                        <td class="border border-black p-2 font-bold">
                            {{ strtoupper($laporan->status) }} (Reward: {{ $laporan->poin_diberikan }} Poin)
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- 2. SKOR DAN VEKTOR CVSS v3.1 (ISO/IEC 30111) -->
        <div class="mb-6 font-sans print-no-break">
            <h3 class="text-xs font-black uppercase tracking-wider bg-gray-100 border-l-4 border-black px-3 py-1.5 mb-3 font-sans">
                II. Metrik Penilaian Risiko (CVSS v3.1 — FIRST.org)
            </h3>
            <table class="w-full border-collapse border border-black text-xs">
                <tbody>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold w-1/4">CVSS Base Score</td>
                        <td class="border border-black p-2">
                            @if($laporan->cvss_score !== null)
                                <span class="text-base font-mono font-black">{{ number_format($laporan->cvss_score, 1) }}</span>
                                <span class="ml-2 px-2 py-0.5 border border-black font-bold uppercase text-[10px]">
                                    @php
                                        $sev = match(true) {
                                            $laporan->cvss_score === 0.0 => 'None',
                                            $laporan->cvss_score < 4.0   => 'Low',
                                            $laporan->cvss_score < 7.0   => 'Medium',
                                            $laporan->cvss_score < 9.0   => 'High',
                                            default                      => 'Critical',
                                        };
                                    @endphp
                                    {{ $sev }}
                                </span>
                            @else
                                <span class="text-gray-500 italic">Skor CVSS sedang dalam tahap review analis.</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold">CVSS v3.1 Vector String</td>
                        <td class="border border-black p-2 font-mono text-[11px] break-all">
                            {{ $laporan->cvss_vector ?: 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold">Standar Kepatuhan</td>
                        <td class="border border-black p-2 font-sans text-gray-700">
                            ISO/IEC 30111:2019 (Vulnerability Handling Processes) & NIST SP 800-61 Rev. 2
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- 3. DESKRIPSI TEKNIS & BUKTI EKSPLOITASI -->
        <div class="mb-6 print-no-break">
            <h3 class="text-xs font-black uppercase tracking-wider bg-gray-100 border-l-4 border-black px-3 py-1.5 mb-3 font-sans">
                III. Ringkasan Eksekutif & Deskripsi Kerentanan
            </h3>
            <div class="border border-black p-4 text-xs leading-relaxed text-justify font-sans bg-gray-50/50 whitespace-pre-line">
{{ $laporan->deskripsi }}
            </div>
        </div>

        <!-- 4. ANALISIS FORENSIK BUKTI ARTEFAK (PoC) -->
        @php $forensics = $laporan->getForensics(); @endphp
        <div class="mb-6 font-sans print-no-break">
            <h3 class="text-xs font-black uppercase tracking-wider bg-gray-100 border-l-4 border-black px-3 py-1.5 mb-3 font-sans">
                IV. Integritas Artefak Bukti (Proof of Concept)
            </h3>
            <table class="w-full border-collapse border border-black text-xs">
                <tbody>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold w-1/4">Nama Berkas Bukti</td>
                        <td class="border border-black p-2 font-mono break-all">{{ basename($laporan->bukti_poc) }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold">Hash SHA-256 (Integritas)</td>
                        <td class="border border-black p-2 font-mono text-[11px] break-all">{{ $forensics['sha256'] }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold">Ukuran Berkas / MIME</td>
                        <td class="border border-black p-2 font-mono">{{ $forensics['size_formatted'] }} ({{ $forensics['detected_mime'] }})</td>
                    </tr>
                    <tr>
                        <td class="border border-black p-2 bg-gray-50 font-bold">Status Pemindaian Keamanan</td>
                        <td class="border border-black p-2 font-bold">
                            {{ strtoupper($laporan->scan_status) }} — Heuristic Multi-pass Scan Verified
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- 5. REKOMENDASI REMEDIASI DISKOMINFO JATIM -->
        <div class="mb-8 print-no-break font-sans">
            <h3 class="text-xs font-black uppercase tracking-wider bg-gray-100 border-l-4 border-black px-3 py-1.5 mb-3">
                V. Rekomendasi Remediasi & Langkah Mitigasi
            </h3>
            <ol class="list-decimal pl-5 text-xs space-y-2 text-justify">
                <li>
                    <strong>Validasi Input & Parameterisasi Query:</strong>
                    Terapkan validasi ketat (whitelisting) pada seluruh parameter input pengguna pada sisi server. Gunakan parameterized queries / Prepared Statements untuk mitigasi SQL Injection, serta context-aware output encoding untuk mencegah XSS.
                </li>
                <li>
                    <strong>Pembaruan & Patching Sistem:</strong>
                    Segera lakukan pembaruan perangkat lunak, dependensi pustaka, dan framework yang digunakan ke versi rilis terbaru yang telah menambal celah keamanan terkait.
                </li>
                <li>
                    <strong>Prinsip Hak Akses Terendah (Least Privilege):</strong>
                    Batasi hak akses akun basis data dan service account pada server aplikasi hanya pada tingkat kewenangan minimal yang diperlukan.
                </li>
                <li>
                    <strong>Penguatan Pertahanan Berlapis (Defense-in-Depth):</strong>
                    Aktifkan Web Application Firewall (WAF), HTTP Security Headers (HSTS, CSP, X-Frame-Options, X-Content-Type-Options), serta konfigurasi monitoring log terpusat untuk mendeteksi anomali akses lanjutan.
                </li>
                <li>
                    <strong>Uji Penetrasi Ulang (Regression Re-test):</strong>
                    Setelah perbaikan diimplementasikan pada lingkungan staging, jadwalkan pengujian ulang bersama tim teknis OPD dan JatimProv-CSIRT sebelum dideploy ke lingkungan produksi.
                </li>
            </ol>
        </div>

        <!-- 6. LEMBAR PENGESAHAN & TANDA TANGAN -->
        <div class="flex justify-between items-end pt-6 border-t-2 border-black font-sans text-xs print-no-break">
            <div>
                <p class="font-mono text-[10px] text-gray-500">KODE VERIFIKASI DIGITAL:</p>
                <p class="font-mono text-[10px] text-gray-700 break-all max-w-xs">
                    {{ hash('sha256', $laporan->id . '|' . $laporan->target_url . '|' . $laporan->created_at) }}
                </p>
                <p class="text-[10px] text-gray-500 mt-2 font-sans">Dicetak pada: {{ now()->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') }} WIB</p>
            </div>

            <div class="text-center w-64">
                <p class="mb-1">Surabaya, {{ now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y') }}</p>
                <p class="font-bold">Analis Tim Tanggap Insiden Siber,</p>
                <p class="text-[11px] text-gray-600 font-sans">JatimProv-CSIRT Diskominfo Jatim</p>
                <div class="my-6">
                    <!-- Seal / Badge Placeholder -->
                    <div class="inline-block border-2 border-dashed border-gray-400 px-4 py-2 rounded text-[10px] font-mono uppercase text-gray-500 tracking-wider">
                        [ MATERAI / TTD ELEKTRONIK CSIRT ]
                    </div>
                </div>
                <p class="font-bold uppercase underline decoration-1 underline-offset-4">
                    {{ auth()->user()->name ?? 'Administrator JatimProv-CSIRT' }}
                </p>
                <p class="text-[10px] text-gray-600 mt-0.5">NIP. 19801231 200501 1 001</p>
            </div>
        </div>

    </div>

</body>
</html>
