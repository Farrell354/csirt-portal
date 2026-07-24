<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $artikels = [
            // Artikel 1-6 (Asli)
            [
                'judul' => 'Ungkap Aktivitas APT Turla, Lebih dari 107 Ribu Indikasi Kompromi Terdeteksi...',
                'kategori' => 'Peringatan Keamanan',
                'penulis' => 'Harits Mustya Pratama',
                'gambar' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Ini adalah isi lengkap contoh artikel mengenai peringatan keamanan siber. Dalam kondisi nyata, konten ini akan sangat panjang dan detail sesuai temuan tim CSIRT di lapangan...',
                'tanggal_publikasi' => '2026-07-23',
            ],
            [
                'judul' => 'Ransomware Berbasis AI Otonom Pertama Terungkap, Mampu Menyerang...',
                'kategori' => 'Peringatan Keamanan',
                'penulis' => 'Harits Mustya Pratama',
                'gambar' => 'https://images.unsplash.com/photo-1614064641913-6b7140414c71?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Ini adalah isi lengkap contoh artikel mengenai ancaman Ransomware. Pengguna dihimbau untuk selalu mencadangkan data ke server terpisah...',
                'tanggal_publikasi' => '2026-07-23',
            ],
            [
                'judul' => 'WordPress Rilis Pembaruan Darurat 7.0.2, Celah Kritis WP2Shell...',
                'kategori' => 'Peringatan Keamanan',
                'penulis' => 'Harits Mustya Pratama',
                'gambar' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Ini adalah isi lengkap tentang kerentanan sistem CMS. Segera lakukan pembaruan sistem Anda untuk menghindari eksploitasi...',
                'tanggal_publikasi' => '2026-07-20',
            ],
            [
                'judul' => 'Waspada Kampanye Phishing Mengatasnamakan Instansi Pemerintah...',
                'kategori' => 'Berita Siber',
                'penulis' => 'Tim JatimProv-CSIRT',
                'gambar' => 'https://images.unsplash.com/photo-1563206767-5b18f218e8de?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Ini adalah isi lengkap artikel peringatan Phishing email. Jangan klik tautan sembarangan dari email yang tidak dikenal...',
                'tanggal_publikasi' => '2026-07-18',
            ],
            [
                'judul' => 'Kerentanan Zero-Day pada Perangkat Firewall Populer Terdeteksi...',
                'kategori' => 'Peringatan Keamanan',
                'penulis' => 'Tim JatimProv-CSIRT',
                'gambar' => 'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Ini adalah penjelasan teknis terkait celah Zero-Day pada perangkat keras jaringan tertentu...',
                'tanggal_publikasi' => '2026-07-15',
            ],
            [
                'judul' => 'Panduan Praktis Mengamankan Perangkat Seluler ASN dari Malware...',
                'kategori' => 'Berita Siber',
                'penulis' => 'Tim JatimProv-CSIRT',
                'gambar' => 'https://images.unsplash.com/photo-1624969862644-791f3dc98927?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Berikut adalah daftar checklist untuk mengamankan perangkat seluler aparatur sipil negara saat mengakses jaringan publik...',
                'tanggal_publikasi' => '2026-07-10',
            ],
            
            // Artikel 7-12 (Tambahan Baru)
            [
                'judul' => 'Serangan DDoS Meningkat di Kuartal Ketiga, Sektor Pemerintahan Menjadi Sasaran Utama...',
                'kategori' => 'Peringatan Keamanan',
                'penulis' => 'Tim JatimProv-CSIRT',
                'gambar' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Laporan terbaru menunjukkan adanya lonjakan lalu lintas botnet yang mengarah ke server-server layanan publik. Segera terapkan mitigasi traffic filtering...',
                'tanggal_publikasi' => '2026-06-28',
            ],
            [
                'judul' => 'Pentingnya Autentikasi Dua Faktor (2FA) untuk Mengamankan Akun Email Kedinasan...',
                'kategori' => 'Panduan Mitigasi',
                'penulis' => 'Harits Mustya Pratama',
                'gambar' => 'https://images.unsplash.com/photo-1614064642226-7bc285c50ceb?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Password saja tidak cukup. Penerapan 2FA wajib dilakukan oleh seluruh ASN untuk mencegah kebocoran data dari metode credential stuffing...',
                'tanggal_publikasi' => '2026-06-15',
            ],
            [
                'judul' => 'Analisis Malware Berbahaya Jenis Baru yang Mengincar Pengguna Android...',
                'kategori' => 'Berita Siber',
                'penulis' => 'Tim JatimProv-CSIRT',
                'gambar' => 'https://images.unsplash.com/photo-1601599561213-832382fd07ba?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Ditemukan aplikasi palsu berkedok layanan pemerintah yang diam-diam mencuri SMS OTP. Pastikan hanya mengunduh aplikasi dari sumber resmi...',
                'tanggal_publikasi' => '2026-06-02',
            ],
            [
                'judul' => 'Mitigasi Kerentanan SQL Injection pada Aplikasi Layanan Publik Berbasis Web...',
                'kategori' => 'Panduan Mitigasi',
                'penulis' => 'Harits Mustya Pratama',
                'gambar' => 'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Masih banyak ditemukan query SQL yang tidak diparameterisasi. Berikut adalah langkah teknis menutup celah SQLi pada sistem backend...',
                'tanggal_publikasi' => '2026-05-20',
            ],
            [
                'judul' => 'Laporan Tahunan Lanskap Ancaman Keamanan Siber Jawa Timur 2025-2026...',
                'kategori' => 'Berita Siber',
                'penulis' => 'Tim JatimProv-CSIRT',
                'gambar' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Statistik menunjukkan penurunan insiden defacement, namun peningkatan signifikan pada percobaan social engineering...',
                'tanggal_publikasi' => '2026-05-10',
            ],
            [
                'judul' => 'Workshop Peningkatan Kapasitas SDM CSIRT Kabupaten/Kota se-Jawa Timur Sukses Digelar...',
                'kategori' => 'Berita Siber',
                'penulis' => 'Tim JatimProv-CSIRT',
                'gambar' => 'https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?ixlib=rb-4.0.3&w=800&q=80',
                'konten' => 'Guna menyamakan standar penanganan insiden, Diskominfo Jatim menyelenggarakan bimbingan teknis selama tiga hari berturut-turut...',
                'tanggal_publikasi' => '2026-05-01',
            ],
        ];

        foreach ($artikels as $artikel) {
            Artikel::create($artikel);
        }
    }
}