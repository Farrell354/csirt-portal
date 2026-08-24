<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JatimProv-CSIRT | Cyber Command Center</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-csirt.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;900&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        /* ──────────────────────────────────
           TICKER
        ────────────────────────────────── */
        @keyframes ticker {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .ticker-track { animation: ticker 40s linear infinite; }
        .ticker-track:hover { animation-play-state: paused; }

        /* ──────────────────────────────────
           SHIMMER GRADIENT TEXT
        ────────────────────────────────── */
        @keyframes shimmer {
            0%   { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }
        .text-shimmer {
            background: linear-gradient(90deg, #38bdf8, #818cf8, #22d3ee, #818cf8, #38bdf8);
            background-size: 300% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 5s linear infinite;
        }

        /* ──────────────────────────────────
           CANVAS — hidden on touch devices
        ────────────────────────────────── */
        #neural-canvas {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 2;
        }
        @media (hover: none) {
            /* Touch / mobile: hide canvas, save battery */
            #neural-canvas { display: none; }
        }

        /* ──────────────────────────────────
           CURSOR GLOW — desktop only
        ────────────────────────────────── */
        #cursor-glow {
            position: fixed;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(6,182,212,0.07) 0%, transparent 70%);
            transition: left 0.05s linear, top 0.05s linear;
        }
        @media (hover: none) {
            #cursor-glow { display: none; }
        }

        /* ──────────────────────────────────
           SCANLINES
        ────────────────────────────────── */
        .scanlines::after {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                rgba(0,0,0,0.04) 0px, rgba(0,0,0,0.04) 1px,
                transparent 1px, transparent 4px
            );
            pointer-events: none;
            z-index: 3;
        }
        @media (max-width: 640px) {
            /* Lighter on mobile for readability */
            .scanlines::after { opacity: 0.4; }
        }

        /* ──────────────────────────────────
           CARD TILT — desktop only
        ────────────────────────────────── */
        .card-tilt { transition: transform 0.15s ease-out, box-shadow 0.15s ease-out; }
        @media (hover: none) {
            .card-tilt { transition: none; }
        }

        /* ──────────────────────────────────
           ANIMATION DELAYS
        ────────────────────────────────── */
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-500 { animation-delay: 0.5s; }

        /* ──────────────────────────────────
           SCROLL INDICATOR — hide on short screens
        ────────────────────────────────── */
        @media (max-height: 700px) {
            .scroll-indicator { display: none; }
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 transition-colors duration-500 dark:bg-[#030712] dark:text-gray-100 font-sans flex flex-col min-h-screen overflow-x-hidden selection:bg-cyan-500/20 selection:text-cyan-700 dark:selection:text-cyan-300">

    <div id="cursor-glow" aria-hidden="true"></div>
    <div class="fixed inset-0 bg-mesh-grid opacity-60 dark:opacity-30 pointer-events-none z-0" aria-hidden="true"></div>

    <x-navbar />

    <div class="flex-grow relative z-10">
        @include('partials.home-hero')
        @include('partials.home-ticker')
        @include('partials.home-livemap')
        @include('partials.home-articles')
    </div>

    <x-footer />
    <x-chatbot />

    @include('partials.home-scripts')

</body>
</html>
