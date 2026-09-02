<?php

namespace App\Models;

class KnowledgeBase
{
    public static function getInfo(): string
    {
        return "
        === PUSAT INFORMASI & BASIS PENGETAHUAN LENGKAP JATIMPROV-CSIRT ===
        
        1. PROFIL & KELEMBAGAAN JATIMPROV-CSIRT:
           - Nama Resmi: Jawa Timur Province Computer Security Incident Response Team (JatimProv-CSIRT).
           - Induk Instansi: Dinas Komunikasi dan Informatika (Diskominfo) Provinsi Jawa Timur.
           - Tugas Pokok: Menerima, meninjau, mengkoordinasikan, dan menanggapi laporan serta aktivitas insiden keamanan siber pada infrastruktur informasi milik Pemprov Jatim.
           - Jam Layanan: 24/7 (Siaga darurat 24 jam sehari, 7 hari seminggu).
           - Wilayah Cakupan: Seluruh Organisasi Perangkat Daerah (OPD) di lingkungan Pemerintah Provinsi Jawa Timur.

        2. LAYANAN UTAMA & RESPONS INSIDEN:
           - Penanganan Insiden (Incident Handling): Membantu mitigasi, penutupan celah, dan pemulihan sistem yang mengalami peretasan, defacing, malware, atau ransomware.
           - Peringatan Dini (Security Advisories): Menyebarkan informasi kerentanan sistem terbaru kepada instansi terkait agar segera dilakukan perbaikan (patching).
           - Analisis Artefak & Forensik Digital: Mengumpulkan bukti digital pasca-serangan untuk melacak pelaku atau metode serangan.
           - Konsultasi Keamanan: Memberikan panduan penguatan sistem (hardening) bagi instansi pemerintahan di Jawa Timur.

        3. PROGRAM BUG BOUNTY & BUG HUNTER (HALL OF FAME / LEADERBOARD):
           - Apa itu Bug Bounty: Program apresiasi bagi para peneliti keamanan siber etis (Bug Hunter) yang menemukan celah kerentanan secara sah.
           - Cara Berpartisipasi: 
             * Daftar akun baru melalui menu 'Login / Daftar'.
             * Masuk ke Dashboard Hunter untuk mengirimkan detail laporan (Target URL, Jenis Kerentanan, Deskripsi, dan Bukti PoC / Proof of Concept).
           - Sistem Penilaian & Poin: Admin akan memverifikasi laporan. Jika berstatus 'Valid', Hunter akan mendapatkan Poin Reputasi.
           - Hall of Fame (Leaderboard): Halaman publik yang menampilkan peringkat global para Hunter berdasarkan akumulasi poin tertinggi. Podium utama diberikan kepada peringkat 1 (Gold), 2 (Silver), dan 3 (Bronze).
           - Aturan & Larangan Keras (Rules): Hunter DILARANG MELAKUKAN Denial of Service (DDoS/DoS), perusakan sistem secara sengaja, rekayasa sosial (phishing) ke pegawai, atau mencuri/membocorkan data warga (Data Breach). Pelanggaran akan berakibat pemblokiran akun dan jalur hukum.

        4. TATA CARA PELAPORAN INSIDEN SIBER (UNTUK PUBLIK / OPD):
           - Pelapor Umum / Instansi: Dapat menekan tombol 'Lapor Insiden' di menu navigasi utama atau mengirimkan kronologi kejadian melalui email resmi ke admin@jatimprov.go.id.
           - Informasi yang Dibutuhkan saat Lapor: Nama pelapor, instansi, waktu kejadian, jenis gangguan (misal: website diretas/deface), dan bukti tangkapan layar (screenshot).

        5. STANDAR TEKNIS & DOKUMENTASI (RFC2350):
           - Operasional tim merujuk pada standar RFC2350 yang memuat informasi deskriptif mengenai layanan CSIRT, kontak darurat, prosedur penanganan, dan kebijakan enkripsi komunikasi.

        6. PERTANYAAN UMUM (FAQ) YANG SERING DITANYAKAN:
           - Apakah layanan CSIRT berbayar? Semua layanan penanganan insiden untuk instansi pemerintah dan pelaporan celah dari hunter adalah GRATIS.
           - Bagaimana cara reset password akun Hunter? Dapat dilakukan melalui halaman login dengan memilih menu 'Lupa Password'.
           - Apakah saya bisa melapor secara anonim? Bisa, namun menyertakan identitas valid akan mempermudah koordinasi penanganan.
        ";
    }
}
