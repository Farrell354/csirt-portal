import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                display: ['"Space Grotesk"', 'sans-serif'],
                mono: ['"JetBrains Mono"', 'monospace'],
            },
            colors: {
                kominfo: '#0056B3',
                kominfo_dark: '#0A3A64',
                accent: '#F59E0B',
                footer_bg: '#161b22',
                komdigi_purple: '#7b3aed',
                dark_card: '#1e293b',
            },
            animation: {
                'fade-in-up': 'fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                'fade-in': 'fadeIn 1.5s ease-out forwards',
                'zoom-in-up': 'zoomInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards',
                'float-subtle': 'floatSubtle 6s ease-in-out infinite',
                'shine-text': 'shineText 4s linear infinite',
                'glare': 'glare 3s ease-in-out infinite',
                'pulse-glow': 'pulseGlow 3s ease-in-out infinite',
                'grid-flow': 'gridFlow 20s linear infinite',
                'marquee': 'marquee 35s linear infinite',
                'marquee-map': 'marqueeMap 35s linear infinite',
                'marker-pulse-map': 'markerPulseMap 1.8s ease-out infinite',
                'float-map': 'floatMap 6s ease-in-out infinite',
            },
            keyframes: {
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(40px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                zoomInUp: {
                    '0%': { opacity: '0', transform: 'scale(0.95) translateY(30px)' },
                    '100%': { opacity: '1', transform: 'scale(1) translateY(0)' },
                },
                floatSubtle: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-8px)' },
                },
                shineText: {
                    '0%': { backgroundPosition: '200% center' },
                    '100%': { backgroundPosition: '-200% center' },
                },
                glare: {
                    '0%': { left: '-100%' },
                    '20%, 100%': { left: '200%' },
                },
                pulseGlow: {
                    '0%, 100%': { boxShadow: '0 0 20px rgba(6, 182, 212, 0.4)' },
                    '50%': { boxShadow: '0 0 40px rgba(6, 182, 212, 0.7)' },
                },
                gridFlow: {
                    '0%': { backgroundPosition: '0 0' },
                    '100%': { backgroundPosition: '50px 50px' }
                },
                marquee: {
                    '0%': { transform: 'translate3d(0, 0, 0)' },
                    '100%': { transform: 'translate3d(-50%, 0, 0)' },
                },
                marqueeMap: {
                    '0%': { transform: 'translate3d(0, 0, 0)' },
                    '100%': { transform: 'translate3d(-50%, 0, 0)' },
                },
                markerPulseMap: {
                    '0%': { transform: 'scale(0.6)', opacity: '0.6' },
                    '50%': { transform: 'scale(1.4)', opacity: '0' },
                    '100%': { transform: 'scale(0.6)', opacity: '0' },
                },
                floatMap: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-8px)' },
                }
            }
        },
    },
    plugins: [],
};