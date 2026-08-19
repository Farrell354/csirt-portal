@php
    $layananData = [
        'penanganan-insiden' => [
            'title' => 'PENANGANAN INSIDEN',
            'icon' => '<svg class="w-6 h-6 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
            'content' => '
                <p>Gov-CSIRT Indonesia akan membantu konstituen untuk melakukan penanggulangan dan pemulihan insiden keamanan siber dengan aspek-aspek manajemen insiden keamanan siber berikut:</p>
                <br>
                <p><strong>5.1.1. Triase Insiden (Incident Triage)</strong><br>
                a. Memastikan kebenaran insiden dan pelapor<br>
                b. Menilai dampak dan prioritas insiden</p>
                <br>
                <p><strong>5.1.2. Koordinasi Insiden</strong><br>
                a. Mengkoordinasikan insiden dengan konstituen<br>
                b. Menentukan kemungkinan penyebab insiden<br>
                c. Memberikan rekomendasi penanggulangan berdasarkan panduan/SOP yang dimiliki Gov-CSIRT Indonesia kepada konstituen<br>
                d. Mengkoordinasikan insiden dengan CSIRT atau pihak lain yang terkait</p>
                <br>
                <p><strong>5.1.3. Resolusi Insiden</strong><br>
                a. Melakukan investigasi dan analisis dampak insiden<br>
                b. Memberikan rekomendasi teknis untuk pemulihan pasca insiden<br>
                c. Memberikan rekomendasi teknis untuk memperbaiki kelemahan sistem</p>
                <br>
                <p>Gov-CSIRT Indonesia menyajikan data statistik mengenai insiden yang terjadi pada sektor pemerintah sebagai bentuk sentra informasi keamanan siber pada sektor pemerintah.</p>
                <br>
                <p>Silahkan hubungi kami untuk melakukan aduan siber sesuai dengan prosedur pelaporan insiden.</p>
            '
        ],
        'aduan-konten' => [
            'title' => 'ADUAN KONTEN',
            'icon' => '<svg class="w-6 h-6 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M3 3v18h2v-7h14l-2.5-4L19 6H5V3H3z"/></svg>',
            'content' => '
                <p>Ruang siber yang aman adalah tanggung jawab bersama. Melalui layanan Aduan Konten, masyarakat dan Perangkat Daerah dapat melaporkan konten negatif yang meresahkan, seperti hoaks, ujaran kebencian, maupun konten ilegal lainnya, dengan mudah dan cepat.</p>
                <br>
                <p>Setiap aduan yang masuk akan diverifikasi secara cermat oleh tim kami untuk memastikan kebenaran dan urgensi penanganannya. Selanjutnya, laporan akan dikoordinasikan dengan pihak keamanan terkait yang berwenang guna ditindaklanjuti sesuai prosedur yang berlaku, sehingga konten negatif dapat ditangani secara tepat dan bertanggung jawab.</p>
                <br>
                <p>Dengan melapor melalui CSIRT Jatimprov, Anda turut berperan aktif menjaga ruang digital Jawa Timur tetap sehat, aman, dan bebas dari konten yang merugikan masyarakat luas.</p>
                <br>
                <p>Kanal resmi :<br>
                1. <a href="#" class="text-cyan-400 hover:underline">Bersurat</a><br>
                2. <a href="#" class="text-cyan-400 hover:underline">Laporkan</a></p>
            '
        ],
        'panda-private-and-secure-data-access' => [
            'title' => 'PANDA (Private and Secure Data Access)',
            'icon' => '<svg class="w-6 h-6 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/></svg>', // Dummy paw-like or app icon, using standard shield/padlock is fine, but I'll use a generic icon
            'content' => '
                <p>PANDA (Private and Secure Data Access) merupakan solusi perlindungan data yang membantu Perangkat Daerah mengamankan data sensitif dan data pribadi pada aplikasi dan sistem informasi pemerintah.</p>
                <br>
                <p>PANDA menerapkan enkripsi pada tingkat data untuk melindungi informasi sensitif saat disimpan, diproses, maupun digunakan oleh aplikasi. PANDA juga menerapkan prinsip <em>masked by default</em>, sehingga data sensitif tidak ditampilkan dalam bentuk plaintext kecuali melalui akses yang telah ditentukan dan dapat diaudit.</p>
                <br>
                <p>PANDA mendukung integrasi dengan berbagai teknologi aplikasi melalui SDK PHP, Node.js, dan Go, termasuk framework seperti Laravel, CodeIgniter, Express, dan NestJS. PANDA juga menyediakan fitur <em>encrypted search, key rotation, crypto-shredding</em>, serta mekanisme migrasi data secara bertahap tanpa mengganggu operasional aplikasi.</p>
                <br>
                <p>Dalam penerapannya, PANDA dikembangkan dengan memperhatikan kebutuhan perlindungan data pemerintah dan dikoordinasikan dengan Badan Siber dan Sandi Negara (BSSN) melalui Bidang Persandian. Implementasinya mendukung penerapan prinsip pelindungan data pribadi sesuai dengan Undang-Undang Nomor 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP).</p>
                <br>
                <p>Dengan PANDA, Perangkat Daerah dapat meningkatkan keamanan data sensitif, mengurangi risiko akses tidak sah dan kebocoran data, serta mendukung penerapan tata kelola pelindungan data pribadi pada sistem informasi pemerintah.</p>
                <br>
                <p>Pelajari dan mulai menggunakan PANDA</p>
                <p><br><a href="https://csirt.jatimprov.go.id/panda" target="_blank" class="text-cyan-400 hover:underline font-medium flex items-center gap-1 w-max">Kunjungi PANDA &rarr;</a></p>
            '
        ],
        'itsa-it-security-assessment' => [
            'title' => 'ITSA (IT SECURITY ASSESSMENT)',
            'icon' => '<svg class="w-6 h-6 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>',
            'content' => '
                <p>Layanan IT Security Assessment (ITSA) merupakan layanan pengujian keamanan aplikasi dan sistem untuk mengidentifikasi kerentanan, kelemahan konfigurasi, serta potensi risiko keamanan sebelum dimanfaatkan oleh pihak yang tidak berwenang.</p>
                <br>
                <p>Assessment dilakukan dengan pendekatan Gray Box atau White Box. Pada metode Gray Box, pengujian dilakukan dengan akses dan informasi terbatas untuk mensimulasikan kondisi pengguna atau pihak eksternal. Sedangkan metode White Box dilakukan dengan informasi internal yang lebih lengkap sehingga pengujian dapat mencakup komponen aplikasi dan sistem secara lebih mendalam.</p>
                <br>
                <p>Tahapan pengujian meliputi reconnaissance dan information gathering, vulnerability identification, security testing, eksploitasi terkontrol untuk memvalidasi kerentanan, analisis dampak, serta penyusunan rekomendasi mitigasi.</p>
                <br>
                <p>Dalam pelaksanaannya, tim menggunakan berbagai tools keamanan seperti Kali Linux, Nmap, OWASP ZAP, dan tools pendukung lainnya sesuai kebutuhan dan karakteristik sistem yang diuji.</p>
                <br>
                <p>Untuk aplikasi web, temuan keamanan dikategorikan dengan mengacu pada OWASP Top 10: 2025. Setiap temuan divalidasi untuk memastikan kerentanan yang dilaporkan benar-benar relevan dan memiliki risiko terhadap sistem.</p>
                <br>
                <p>Hasil akhir assessment dituangkan dalam laporan yang berisi ringkasan hasil pengujian, temuan kerentanan, tingkat risiko, bukti pengujian, dampak, serta rekomendasi perbaikan. Berdasarkan hasil pengujian dan kriteria kelulusan yang ditetapkan, sistem akan diberikan status LULUS atau TIDAK LULUS.</p>
                <br>
                <p>Dengan ITSA, Perangkat Daerah dapat mengetahui kondisi keamanan aplikasinya secara lebih objektif dan memperoleh dasar teknis untuk melakukan perbaikan sebelum sistem digunakan atau dioperasikan lebih lanjut.</p>
            '
        ],
        'ctis-cyber-threat-information-sharing' => [
            'title' => 'CTIS (CYBER THREAT INFORMATION SHARING)',
            'icon' => '<svg class="w-6 h-6 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19.35 10.04A7.49 7.49 0 0012 4C9.11 4 6.6 5.64 5.35 8.04A5.994 5.994 0 000 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/></svg>',
            'content' => '
                <p>Layanan diseminasi informasi ancaman keamanan siber terkini dalam bentuk artikel dan Indicator of Compromise (IoC) yang dapat diunduh melalui laman resmi, guna meningkatkan kewaspadaan dan kesiapan Perangkat Daerah terhadap ancaman siber terbaru.</p>
                <br>
                <p>Klik <a href="/ioc" class="text-cyan-400 font-bold hover:underline">DISINI</a> untuk melihat ancaman siber terbaru</p>
            '
        ],
        'verifikasi-ptkkss' => [
            'title' => 'VERIFIKASI PTKKSS',
            'icon' => '<svg class="w-6 h-6 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>',
            'content' => '
                <p>Layanan verifikasi Pengukuran Tingkat Kematangan Keamanan Siber dan Sandi oleh Tim Verifikator Pemerintah Provinsi Jawa Timur, guna mengakomodir penilaian dan pendampingan pengisian Indeks KAMI 5.0 serta IKASANDI, sebagai dasar peningkatan tata kelola keamanan informasi Perangkat Daerah.</p>
            '
        ],
        'endpoint-monitoring-edrxdr' => [
            'title' => 'Endpoint Monitoring (EDR/XDR)',
            'icon' => '<svg class="w-6 h-6 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M21 2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h7v2H8v2h8v-2h-2v-2h7c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H3V4h18v12z"/></svg>',
            'content' => '
                <p>Endpoint Monitoring (XDR/SIEM) merupakan layanan pemantauan keamanan perangkat dan sistem secara terpusat untuk mendeteksi aktivitas mencurigakan, ancaman siber, serta potensi insiden keamanan.</p>
                <br>
                <p>Layanan ini mengumpulkan dan menganalisis informasi keamanan dari endpoint, server, maupun sumber log lainnya. Data tersebut dikorelasikan untuk membantu mengidentifikasi pola serangan, memberikan peringatan dini, serta mendukung proses investigasi dan respons terhadap insiden keamanan siber.</p>
                <br>
                <p>Dengan pemantauan secara berkelanjutan, organisasi dapat mengetahui kondisi keamanan endpoint, mengidentifikasi ancaman lebih cepat, dan mengambil tindakan sebelum insiden berkembang menjadi gangguan yang lebih besar.</p>
            '
        ]
    ];
    
    if(!array_key_exists($slug, $layananData)) {
        abort(404);
    }
    
    $data = $layananData[$slug];
@endphp
<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['title'] }} - Layanan CSIRT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#020617] text-gray-200 font-sans flex flex-col min-h-screen selection:bg-cyan-500 selection:text-white dark">
    
    <div class="fixed inset-0 pointer-events-none bg-mesh-grid opacity-30 z-0"></div>

    <div class="relative z-50"><x-navbar /></div>

    <div class="flex-grow relative z-10 w-full pt-16 pb-24">
        <div class="w-full max-w-5xl mx-auto px-6 sm:px-8 lg:px-12">
            
            <!-- Breadcrumb -->
            <div class="text-[11px] font-medium text-slate-400 mb-8 tracking-wider uppercase flex items-center gap-2">
                <a href="/layanan" class="text-cyan-500 hover:text-cyan-400 transition-colors">Layanan</a> 
                <span class="text-slate-600">/</span> 
                <span class="text-slate-300">{{ $data['title'] }}</span>
            </div>

            <!-- Title Area -->
            <div class="flex items-center gap-4 mb-10">
                <div class="w-12 h-12 rounded-xl bg-cyan-900/40 border border-cyan-800 flex items-center justify-center shrink-0 shadow-[0_0_15px_rgba(6,182,212,0.15)]">
                    {!! $data['icon'] !!}
                </div>
                <h1 class="font-display text-2xl md:text-3xl font-bold text-white tracking-tight uppercase">
                    {{ $data['title'] }}
                </h1>
            </div>

            <!-- Content Area -->
            <div class="prose prose-sm md:prose-base prose-invert prose-p:text-slate-300 prose-p:leading-[1.8] prose-p:font-medium max-w-none mb-12">
                {!! $data['content'] !!}
            </div>

            <!-- Back Button -->
            <div class="mt-16 pt-8 border-t border-slate-800">
                <a href="/layanan" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border border-slate-700 bg-slate-900/50 hover:bg-slate-800 hover:border-slate-600 text-sm font-medium text-slate-300 hover:text-white transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Layanan
                </a>
            </div>

        </div>
    </div>

    <x-footer />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-chatbot />
</body>
</html>
