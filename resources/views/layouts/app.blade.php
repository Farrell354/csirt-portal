<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'JatimProv-CSIRT | Portal Keamanan Siber' }}</title>

    <!-- FAVICON PUSAT -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">

    <!-- Tailwind CDN / Config -->
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
<body class="bg-gray-50 text-gray-800 transition-colors duration-300 dark:bg-slate-900 dark:text-gray-200 font-sans flex flex-col min-h-screen">

    <!-- NAVBAR PUSAT -->
    <x-navbar />

    <!-- KONTEN HALAMAN FLEXIBEL -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- CHATBOT PUSAT -->
    <x-chatbot />

</body>
</html>