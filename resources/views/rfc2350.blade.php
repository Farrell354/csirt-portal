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

    <x-footer />

    <!-- WIDGET CHATBOT CSIRT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
<x-chatbot />
</html>