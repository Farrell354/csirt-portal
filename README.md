#  Portal JatimProv-CSIRT & Bug Bounty System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Groq_AI-F05032?style=for-the-badge&logo=openai&logoColor=white" alt="Groq AI">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/License-MIT-blue.style=for-the-badge" alt="License">
</p>

**JatimProv-CSIRT** (*Jawa Timur Province Computer Security Incident Response Team*) adalah platform resmi tanggap darurat siber milik Pemerintah Provinsi Jawa Timur. Platform ini dirancang untuk menangani insiden keamanan siber, mengelola program *Bug Bounty* bagi para peneliti keamanan (*Ethical Hacker*), serta menyediakan layanan AI Chatbot interaktif 24/7.

---

##  Fitur Unggulan

###  1. Smart AI Assistant (Groq & LLaMA 3.1)
- **Toleran Terhadap Typo**: Didukung oleh prompt AI pintar yang mampu memahami maksud pengguna meskipun terdapat kesalahan pengetikan atau bahasa tidak baku.
- **Dedicated Knowledge Base**: Sistem jawaban terisolasi pada basis pengetahuan resmi CSIRT Jatim (`app/KnowledgeBase.php`).
- **Respon Super Cepat**: Menggunakan API Groq dengan model `llama-3.1-8b-instant`.

###  2. Bug Bounty & Hall of Fame (Leaderboard)
- **Sistem Poin Reputasi**: Memberikan apresiasi real-time kepada *Bug Hunter* yang berhasil menemukan kerentanan sistem secara sah.
- **Top Podium Status**: Tampilan khusus podium 3 besar (Gold, Silver, Bronze) serta daftar peringkat publik global.
- **Verifikasi Laporan**: Panel khusus admin untuk memvalidasi laporan insiden/kerentanan sebelum poin dialokasikan.

###  3. Portal Informasi & Kepatuhan Standar
- **Pedoman RFC2350**: Mengikuti dokumentasi standar internasional untuk penanganan insiden siber.
- **Dark Mode Support**: Antarmuka responsif yang dilengkapi switch mode gelap/terang berbasis Tailwind CSS.
- **Sistem Pelaporan Terpadu**: Formulir pelaporan insiden langsung bagi Organisasi Perangkat Daerah (OPD) dan masyarakat umum.

---

##  Spesifikasi Teknologi

- **Backend**: Laravel 10.x / PHP 8.1+
- **Frontend**: Blade Templating, Tailwind CSS, Alpine.js / Vite
- **Database**: MySQL / MariaDB
- **AI Engine**: Groq Cloud API (`llama-3.1-8b-instant`)

---

##  Panduan Instalasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

### 1. Kloning Repository
```bash
git clone [https://github.com/USERNAME_ANDA/NAMA_REPO_ANDA.git](https://github.com/USERNAME_ANDA/NAMA_REPO_ANDA.git)
cd NAMA_REPO_ANDA
