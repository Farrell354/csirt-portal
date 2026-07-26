<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RFC 2350 - JatimProv-CSIRT</title>
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
</head>
<body class="bg-gray-50 text-gray-800 transition-colors duration-300 font-sans flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <x-navbar />

    <!-- KONTEN UTAMA -->
    <div class="flex-grow bg-slate-100 flex flex-col items-center">
        
        <!-- HEADER HALAMAN KECIL -->
        <div class="w-full bg-white border-b border-gray-200 py-8">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Dokumen RFC 2350 JatimProv-CSIRT</h1>
                <p class="text-sm text-gray-500 mt-2">Versi 2.0 | Diterbitkan pada 21 Mei 2026</p>
            </div>
        </div>

        <!-- AREA PENAMPIL PDF -->
        <div class="w-full max-w-5xl mx-auto px-4 py-10 flex-grow flex flex-col">
            <div class="w-full flex-grow min-h-[800px] border border-gray-300 rounded-sm shadow-xl bg-white overflow-hidden">
                <!-- Memanggil file PDF menggunakan iframe standar -->
                <iframe 
                    src="{{ asset('dokumen/rfc2350.pdf') }}" 
                    width="100%" 
                    height="100%" 
                    style="border: none;"
                    title="Penampil Dokumen RFC2350">
                    Browser Anda tidak mendukung penampil PDF. Silakan klik tombol unduh di bawah.
                </iframe>
            </div>
            <div class="text-center mt-6">
                <a href="{{ asset('dokumen/rfc2350.pdf') }}" download class="inline-flex items-center text-sm font-bold text-kominfo hover:text-kominfo_dark uppercase tracking-widest transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Unduh Dokumen Secara Langsung
                </a>
            </div>
        </div>
    </div>

    <!-- FOOTER SECTION (Sama dengan halaman lainnya) -->
    <footer class="bg-footer_bg text-gray-400 py-16 border-t border-gray-800 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-widest mb-6 border-b border-gray-700 pb-2">Kategori</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 bg-kominfo"></span> Peringatan Keamanan</a></li>
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 bg-kominfo"></span> Berita Keamanan Siber</a></li>
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2"><span class="w-1 h-1 bg-kominfo"></span> Panduan Mitigasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-widest mb-6 border-b border-gray-700 pb-2">Artikel Terkini</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-white transition line-clamp-2">Ungkap Aktivitas APT Turla, Lebih dari 107 Ribu Indikasi Kompromi...</a></li>
                        <li><a href="#" class="hover:text-white transition line-clamp-2">Ransomware Berbasis AI Otonom Pertama Terungkap...</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-widest mb-6 border-b border-gray-700 pb-2">Kontak Kami</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg> Jl. Ahmad Yani 242-244 Surabaya</li>
                        <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> csirt@jatimprov.go.id</li>
                        <li class="flex items-start gap-2"><svg class="w-4 h-4 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> (031) 8294608</li>
                    </ul>
                </div>
                <div>
                    <div class="w-full h-40 rounded-sm overflow-hidden border border-gray-700 bg-gray-800">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.387132177435!2d112.7301073147752!3d-7.310323394723932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbaa4c8a5a4b%3A0xc6c7619eb1899134!2sDinas%20Komunikasi%20dan%20Informatika%20Provinsi%20Jawa%20Timur!5e0!3m2!1sen!2sid!4v1680000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-xs tracking-widest uppercase">
                <p>Copyright &copy; 2026 <span class="font-bold text-gray-200">JatimProv-CSIRT</span>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WIDGET CHATBOT CSIRT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
<x-chatbot />
</html>