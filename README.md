# 🛡️ Portal JatimProv-CSIRT & Bug Bounty System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Three.js-000000?style=for-the-badge&logo=threedotjs&logoColor=white" alt="Three.js">
  <img src="https://img.shields.io/badge/Groq_AI-F05032?style=for-the-badge&logo=openai&logoColor=white" alt="Groq AI">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
</p>

**JatimProv-CSIRT** (*Jawa Timur Province Computer Security Incident Response Team*) adalah platform resmi tanggap darurat dan intelijen siber milik Pemerintah Provinsi Jawa Timur. Platform ini dirancang dengan antarmuka **Ultra-Premium Cyber Glassmorphism**, menyediakan pemantauan ancaman *real-time*, manajemen insiden, program *Bug Bounty* (*Ethical Hacking*), serta layanan asisten AI berbasis pengetahuan institusi.

---

## ✨ Fitur Unggulan Terkini

### 🌍 1. Live 3D Cyber Threat Map
Pemetaan interaktif serangan siber secara *real-time* menggunakan rendering WebGL 3D (`Globe.gl`). Dilengkapi animasi lintasan proyektil serangan (*attack arcs*), *live counter*, dan notifikasi insiden seketika yang dapat diputar (rotasi), digeser (pan), maupun diperbesar (zoom).

### 📊 2. Cyber Threat Intelligence (IoC) Dashboard
*Dashboard* khusus intelijen ancaman siber dengan visualisasi data *dummy* dinamis untuk memantau:
- **Kerentanan (CVE):** Skor CVSS, grafis distribusi tingkat keparahan (Critical, High, Medium).
- **Malware & Botnet:** Identifikasi *hash* dan tipe infeksi terbaru.
- **Phishing (Link & Domain):** Analisis TLD dan perbandingan protokol HTTP/HTTPS.
- **IP Feeds:** Reputasi alamat IP dengan indikator berbahaya.

### 🤖 3. Smart AI Assistant (Groq Cloud)
Chatbot pintar yang dikonfigurasi secara ketat (*system prompt*) untuk hanya menjawab berdasarkan pedoman dan layanan resmi JatimProv-CSIRT. Berbekal teknologi pemrosesan bahasa alami berkecepatan tinggi yang dapat menoleransi *typo* pengguna, mengandalkan model `openai/gpt-oss-20b` (Via API Groq).

### 🏆 4. Bug Bounty & Leaderboard
Sistem penghargaan untuk *Security Researcher* atau *Hunter* dengan mekanik Poin Reputasi. Dilengkapi dengan podium 3 Besar (Gold, Silver, Bronze), dan halaman profil publik *Hunter*.

### 📚 5. Pembelajaran Insiden & Layanan Terintegrasi
- **Grid Masonry Pembelajaran Insiden:** Koleksi studi kasus insiden siber yang diformat menjadi *card* estetik dengan kategori khusus.
- **Modul Layanan Lengkap:** Dokumentasi komprehensif terkait Penanganan Insiden, PANDA (*Private and Secure Data Access*), ITSA (*IT Security Assessment*), CTIS, EDR/XDR, dan verifikasi kepatuhan.

---

## 🛠️ Spesifikasi Teknologi

- **Backend:** Laravel 10.x / PHP 8.1+
- **Frontend:** Blade Templating, Tailwind CSS (JIT Compiler), Vanilla JS
- **Visualisasi 3D:** Three.js / Globe.gl
- **Database:** MySQL / MariaDB
- **AI Engine:** Groq Cloud API

---

## 🚀 Panduan Instalasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan pengembangan Anda:

### 1. Kloning Repository & Instalasi Dependensi
```bash
git clone https://github.com/jatimprov/csirt-portal.git
cd csirt-portal
composer install
npm install
```

### 2. Konfigurasi Lingkungan (.env)
```bash
cp .env.example .env
```
Sesuaikan konfigurasi database Anda di dalam file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=csirt_db
DB_USERNAME=root
DB_PASSWORD=

# Kunci API untuk Asisten AI (Chatbot)
GROQ_API_KEY=gsk_IsiDenganApiKeyGroqAnda
```

### 3. Migrasi Database & Kompilasi Aset
```bash
php artisan key:generate
php artisan migrate --seed
npm run build
```

### 4. Jalankan Aplikasi
```bash
php artisan serve
```
Akses portal melalui browser di `http://127.0.0.1:8000`.

---
*Copyright © 2026 JatimProv-CSIRT. All rights reserved.*
