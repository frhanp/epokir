<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-POKIR Golkar') }}</title>
    
    <!-- Dark Mode Init -->
    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF9F3;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .font-display {
            font-family: 'Outfit', sans-serif;
        }

        /* Pastel Soft Gradient Background */
        .pastel-bg {
            background: linear-gradient(180deg, #FFFDF0 0%, #FFFEFA 40%, #FFFFFF 100%);
        }

        /* Soft Glassmorphism Nav */
        .glass-nav {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(250, 204, 21, 0.15);
            box-shadow: 0 10px 30px -10px rgba(234, 179, 8, 0.05);
            transition: all 0.3s ease;
        }

        .pastel-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(234, 179, 8, 0.2);
            box-shadow: 0 20px 40px -10px rgba(234, 179, 8, 0.04);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .pastel-card:hover {
            background: #FFFFFF;
            border-color: rgba(234, 179, 8, 0.35);
            box-shadow: 0 30px 50px -15px rgba(234, 179, 8, 0.1);
            transform: translateY(-4px);
        }

        /* Soft Pastel Glow */
        .glow-btn {
            background: linear-gradient(135deg, #FDE047 0%, #FACC15 100%);
            box-shadow: 0 10px 25px -5px rgba(250, 204, 21, 0.4);
            transition: all 0.3s ease;
        }

        .glow-btn:hover {
            box-shadow: 0 15px 35px -5px rgba(250, 204, 21, 0.6);
            transform: translateY(-2px);
        }

        /* Animated Floating Soft Orbs */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-15px) scale(1.05); }
        }

        @keyframes float-medium {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-10px) scale(0.97); }
        }

        .animate-float-slow {
            animation: float-slow 7s ease-in-out infinite;
        }

        .animate-float-medium {
            animation: float-medium 5s ease-in-out infinite;
        }

        /* Grid overlay background */
        .soft-grid {
            background-image: radial-gradient(rgba(234, 179, 8, 0.08) 1.5px, transparent 1.5px);
            background-size: 32px 32px;
        }

        /* --- DARK THEME OVERRIDES --- */
        .dark body {
            background-color: #0B0E14;
            color: #E2E8F0;
        }
        .dark .pastel-bg {
            background: radial-gradient(circle, rgba(234, 179, 8, 0.05) 0%, rgba(234, 179, 8, 0) 70%);
        }
        .dark .glass-nav {
            background: rgba(17, 22, 34, 0.75);
            border-color: rgba(255, 255, 255, 0.06);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.3);
        }
        .dark .pastel-card {
            background: rgba(17, 22, 34, 0.85);
            border-color: rgba(255, 255, 255, 0.06);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.4);
        }
        .dark .pastel-card:hover {
            background: #111622;
            border-color: rgba(250, 204, 21, 0.35);
            box-shadow: 0 30px 50px -15px rgba(250, 204, 21, 0.1);
        }
        .dark .text-slate-900, .dark .text-slate-800, .dark h2, .dark h3 {
            color: #FFFFFF !important;
        }
        .dark .text-slate-500, .dark .text-slate-400 {
            color: #94A3B8 !important;
        }
        .dark .bg-slate-50, .dark .bg-yellow-50\/30 {
            background-color: #1A202C !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
        }
        .dark .bg-white {
            background-color: #111622 !important;
            border-color: rgba(255, 255, 255, 0.06) !important;
        }
        .dark .border-slate-100 {
            border-color: rgba(255, 255, 255, 0.05) !important;
        }

        /* --- PREMIUM HOVER & INTERACTIVE ANIMATIONS --- */
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #EAB308;
            transition: width 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-link:hover::after {
            width: 100%;
        }

        .glow-btn {
            position: relative;
            overflow: hidden;
        }
        .glow-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transform: skewX(-25deg);
            transition: none;
        }
        .glow-btn:hover::before {
            left: 150%;
            transition: left 0.85s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            background-color: rgba(234, 179, 8, 0.25) !important;
            color: #CA8A04 !important;
        }
        .feature-icon {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            opacity: 0;
            animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* 3D tilt perspective container */
        .tilt-container {
            perspective: 1000px;
        }
        .tilt-card {
            transition: transform 0.15s ease-out;
            transform-style: preserve-3d;
        }
        .tilt-card > * {
            transform: translateZ(20px);
        }

        /* Scroll fade up animation for other sections */
        .scroll-fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .scroll-fade-up.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Footer Link Underline Animation */
        .footer-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .footer-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #EAB308;
            transition: width 0.3s ease;
        }
        .footer-link:hover::after {
            width: 100%;
        }
        .footer-link:hover {
            color: #EAB308 !important;
        }

        /* Badge floating animations */
        @keyframes floatBadge1 {
            0%, 100% { transform: translateY(0px) rotate(-1deg); }
            50% { transform: translateY(-8px) rotate(1deg); }
        }
        @keyframes floatBadge2 {
            0%, 100% { transform: translateY(0px) rotate(1.5deg); }
            50% { transform: translateY(8px) rotate(-1deg); }
        }
        .animate-float-badge-1 {
            animation: floatBadge1 6s ease-in-out infinite;
        }
        .animate-float-badge-2 {
            animation: floatBadge2 7s ease-in-out infinite;
        }
    </style>
</head>
<body class="antialiased text-slate-700 selection:bg-yellow-200 selection:text-yellow-900 overflow-hidden h-screen flex flex-col justify-between">

    <!-- Pastel Glowing Orbs -->
    <div class="absolute top-0 inset-x-0 h-[900px] pastel-bg -z-20"></div>
    <div class="absolute top-[100px] left-[10%] w-[500px] h-[500px] bg-yellow-100/40 rounded-full blur-[100px] -z-10 animate-float-slow"></div>
    <div class="absolute top-[250px] right-[10%] w-[600px] h-[600px] bg-amber-50/50 rounded-full blur-[120px] -z-10 animate-float-medium"></div>
    
    <div class="absolute bottom-[50px] left-[30%] w-[400px] h-[400px] bg-yellow-200/30 rounded-full blur-[90px] -z-10 animate-float-slow"></div>
    <div class="absolute top-[50px] right-[30%] w-[350px] h-[350px] bg-yellow-300/20 rounded-full blur-[100px] -z-10 animate-float-medium"></div>
    <div class="absolute inset-0 soft-grid h-[900px] opacity-75 -z-10"></div>
    
    <!-- Interactive Canvas Particle Network Background -->
    <canvas id="particle-canvas" class="absolute inset-0 pointer-events-none -z-10"></canvas>

    <!-- Soft Glassmorphism Navigation Bar -->
    <nav class="fixed top-4 left-1/2 -translate-x-1/2 w-[92%] max-w-7xl z-50 glass-nav rounded-2xl px-6 py-3.5 flex justify-between items-center transition-all duration-300">
        <!-- Logo Branding -->
        <div class="flex items-center gap-3">
            <div class="p-1.5 bg-yellow-50 rounded-xl border border-yellow-200/40">
                <img src="{{ asset('images/logo-golkar.png') }}" alt="Logo" class="h-9 w-auto">
            </div>
            <div class="leading-tight hidden sm:block">
                <span class="block text-md font-extrabold text-slate-800 tracking-wide uppercase font-display">Fraksi Partai Golkar</span>
                <span class="block text-[9px] font-bold text-slate-400 tracking-wider uppercase">DPRD PROVINSI GORONTALO</span>
            </div>
        </div>

        <!-- Links & Action Button -->
        <div class="flex items-center gap-4">
            
            <!-- Dark Mode Toggle Button -->
            <button id="theme-toggle-btn" class="p-2 rounded-xl bg-yellow-50/50 hover:bg-yellow-100/80 text-yellow-600 border border-yellow-250/20 dark:bg-slate-800 dark:hover:bg-slate-700 dark:border-slate-700 dark:text-yellow-400 transition shrink-0">
                <!-- Sun icon -->
                <svg class="w-4 h-4 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path>
                </svg>
                <!-- Moon icon -->
                <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
            </button>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-bold rounded-xl text-xs uppercase tracking-wider transition-all">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="glow-btn px-6 py-2.5 text-slate-900 font-extrabold rounded-xl text-xs uppercase tracking-wider">
                        Masuk Sistem
                    </a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section (Centering dynamically for single-screen layout) -->
    <section class="flex-grow flex items-center justify-center relative overflow-hidden w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full py-4 md:py-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <!-- Hero Info -->
                <div class="text-center lg:text-left">
                    <h1 class="text-5xl lg:text-6.5xl font-black font-display text-slate-900 leading-tight mb-6 tracking-tight animate-fade-in-up" style="animation-delay: 150ms;">
                        Aspirasi Rakyat, <br>
                        <span id="changing-title" class="inline-block text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 via-amber-500 to-yellow-600 transition-all duration-500 transform">Karya Nyata Kami.</span>
                    </h1>
                    
                    <p class="text-base sm:text-lg text-slate-500 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0 animate-fade-in-up" style="animation-delay: 300ms;">
                        Sistem digital transparansi dan akuntabilitas Pokok Pikiran DPRD Provinsi Gorontalo.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-fade-in-up" style="animation-delay: 450ms;">
                        <a href="{{ route('login') }}" class="glow-btn px-8 py-4 text-slate-950 font-extrabold rounded-xl shadow-lg transition duration-300 flex items-center justify-center gap-2 hover:scale-105 hover:shadow-yellow-500/40">
                            Akses E-Pokir
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Hero Graphic UI Mockup (Google Stitch Aligned) -->
                <div class="relative lg:block tilt-container animate-fade-in-up" style="animation-delay: 600ms;">
                    <!-- Floating Info Badge 1 (Top-Left) -->
                    <div class="absolute -top-6 -left-12 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border border-yellow-250/40 dark:border-white/5 rounded-2xl p-3 shadow-xl flex items-center gap-3 animate-float-badge-1 z-25 select-none hover:scale-105 transition-transform duration-300">
                        <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center text-yellow-600 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 dark:text-white">1.284 Usulan</div>
                            <div class="text-[9px] text-slate-400 font-medium">Aspirasi Terdaftar</div>
                        </div>
                    </div>

                    <!-- Floating Info Badge 2 (Bottom-Right) -->
                    <div class="absolute -bottom-6 -right-12 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border border-yellow-250/40 dark:border-white/5 rounded-2xl p-3 shadow-xl flex items-center gap-3 animate-float-badge-2 z-25 select-none hover:scale-105 transition-transform duration-300">
                        <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center text-green-600 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 dark:text-white">100% Transparan</div>
                            <div class="text-[9px] text-slate-400 font-medium">Sistem Terbuka</div>
                        </div>
                    </div>

                    <!-- Glassmorphism Card Mockup -->
                    <div id="mockup-card" class="tilt-card animate-float-slow pastel-card rounded-[32px] p-8 border border-white/60 relative z-10 shadow-2xl bg-white/70 max-w-md mx-auto">
                        <!-- Status Badge -->
                        <div class="flex justify-center mb-6">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50/70 dark:bg-green-500/10 text-green-700 dark:text-green-400 text-xs font-bold rounded-full border border-green-200/50">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </span>
                                Usulan Disetujui
                            </span>
                        </div>
                        
                        <!-- Logo & Branding -->
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 mx-auto mb-4 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-slate-100 transition-all duration-300 hover:scale-110">
                                <img src="{{ asset('images/logo-golkar.png') }}" alt="Golkar Logo" class="h-12 w-auto">
                            </div>
                            <h3 class="text-2xl font-extrabold text-slate-900 tracking-wider">E-POKIR</h3>
                            <p class="text-xs font-medium text-slate-400 mt-1">Elektronik Pokok Pikiran DPRD</p>
                        </div>
                        
                        <!-- Value Tracker Box -->
                        <div class="bg-slate-50 dark:bg-slate-900/55 border border-slate-100 dark:border-white/5 rounded-2xl p-4 flex items-center gap-3 transition-all duration-300 hover:bg-yellow-50/20 hover:border-yellow-200/30">
                            <div class="w-9 h-9 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center text-yellow-600 transition-transform duration-300 hover:rotate-12 shrink-0">
                                <span class="font-bold text-sm">Rp</span>
                            </div>
                            <div class="flex-grow">
                                <div id="count-up-pagu" class="text-sm font-bold text-slate-800 dark:text-white">Rp 0</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Total Pagu</div>
                            </div>
                            <!-- Mini Sparkline Area Chart -->
                            <div class="w-16 h-8 opacity-80 hover:opacity-100 transition-opacity ml-2 shrink-0 hidden sm:block">
                                <svg viewBox="0 0 100 40" class="w-full h-full">
                                    <defs>
                                        <linearGradient id="chart-grad" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="#FACC15" stop-opacity="0.3"></stop>
                                            <stop offset="100%" stop-color="#FACC15" stop-opacity="0"></stop>
                                        </linearGradient>
                                    </defs>
                                    <path d="M 0 35 Q 20 15, 40 25 T 80 5 T 100 12 L 100 40 L 0 40 Z" fill="url(#chart-grad)"></path>
                                    <path d="M 0 35 Q 20 15, 40 25 T 80 5 T 100 12" fill="none" stroke="#FACC15" stroke-width="2" stroke-linecap="round"></path>
                                    <circle cx="100" cy="12" r="3" fill="#FACC15"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer (Translucent, single-screen style) -->
    <footer class="w-full bg-white/60 dark:bg-[#0B0E14]/60 backdrop-blur-md border-t border-slate-200 dark:border-white/5 py-4 z-10">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-golkar.png') }}" alt="Logo" class="h-6 w-auto grayscale opacity-55 hover:grayscale-0 hover:opacity-100 transition duration-300">
                <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400">
                    &copy; 2026 Fraksi Partai Golkar Gorontalo. All rights reserved.
                </span>
            </div>
            <div class="flex gap-6 text-[11px] text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">
                <a href="#" class="footer-link hover:text-yellow-600 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="footer-link hover:text-yellow-600 transition-colors">Syarat & Ketentuan</a>
                <a href="#" class="footer-link hover:text-yellow-600 transition-colors">Hubungi Kami</a>
            </div>
        </div>
    </footer>

    <!-- Custom Interactive Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Theme toggle event listener
            const toggleBtn = document.getElementById('theme-toggle-btn');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('darkMode', 'false');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('darkMode', 'true');
                    }
                });
            }

            // 1. 3D Tilt Effect for Hero Mockup Card
            const card = document.getElementById('mockup-card');
            if (card) {
                const container = card.parentElement;
                
                container.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const xc = rect.width / 2;
                    const yc = rect.height / 2;
                    
                    // Tilt range: 12 degrees
                    const rotateX = ((yc - y) / yc) * 12;
                    const rotateY = ((x - xc) / xc) * 12;
                    
                    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.03, 1.03, 1.03)`;
                });
                
                container.addEventListener('mouseleave', () => {
                    card.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)`;
                });
            }

            // 2. Count-up Animation for Pagu budget
            const countObj = document.getElementById('count-up-pagu');
            if (countObj) {
                const targetValue = 15000000000; // 15 Billion
                const duration = 2200; // 2.2 seconds
                let startTimestamp = null;
                
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    // Easing out quadratic
                    const easeProgress = progress * (2 - progress);
                    const currentVal = Math.floor(easeProgress * targetValue);
                    
                    countObj.innerHTML = "Rp " + currentVal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            // 3. Canvas Particle Network Background
            const pCanvas = document.getElementById('particle-canvas');
            if (pCanvas) {
                const pCtx = pCanvas.getContext('2d');
                let pList = [];
                let sparkList = [];
                const pCount = 500; // Increased count for a more active network
                let pMouse = { x: -9999, y: -9999 };
                
                // Track mouse position on window
                window.addEventListener('mousemove', (e) => {
                    pMouse.x = e.clientX;
                    pMouse.y = e.clientY;
                    
                    // Spawn cursor sparks
                    if (Math.random() < 0.65) {
                        sparkList.push(new Spark(e.clientX, e.clientY));
                    }
                });
                window.addEventListener('mouseleave', () => {
                    pMouse.x = -9999;
                    pMouse.y = -9999;
                });
                window.addEventListener('touchmove', (e) => {
                    if (e.touches.length > 0) {
                        pMouse.x = e.touches[0].clientX;
                        pMouse.y = e.touches[0].clientY;
                        if (Math.random() < 0.4) {
                            sparkList.push(new Spark(e.touches[0].clientX, e.touches[0].clientY));
                        }
                    }
                }, { passive: true });

                class Spark {
                    constructor(x, y) {
                        this.x = x;
                        this.y = y;
                        this.vx = (Math.random() - 0.5) * 2.0; // Sebaran lebih lebar (sebelumnya 1.6)
        this.vy = (Math.random() - 0.5) * 2.0;
                        this.alpha = 1.0;
                        this.radius = Math.random() * 2 + 1.5;
                    }
                    update() {
                        this.x += this.vx;
                        this.y += this.vy;
                        this.alpha -= 0.001; // Fade out SANGAT lambat, meninggalkan jejak (sebelumnya 0.024)
        if (this.radius > 0.1) this.radius -= 0.015; // Menyusut lebih lambat
                    }
                    draw() {
                        pCtx.beginPath();
                        pCtx.arc(this.x, this.y, Math.max(0.1, this.radius), 0, Math.PI * 2);
                        pCtx.fillStyle = document.documentElement.classList.contains('dark')
                            ? `rgba(250, 204, 21, ${this.alpha * 0.45})`
                            : `rgba(234, 179, 8, ${this.alpha * 0.6})`;
                        pCtx.fill();
                    }
                }
                
                class Particle {
                    constructor() {
                        this.x = Math.random() * pCanvas.width;
                        this.y = Math.random() * pCanvas.height;
                        this.vx = (Math.random() - 0.5) * 0.35;
                        this.vy = (Math.random() - 0.5) * 0.35;
                        this.radius = Math.random() * 2 + 0.8;
                    }
                    update() {
                        this.x += this.vx;
                        this.y += this.vy;
                        
                        if (this.x < 0 || this.x > pCanvas.width) this.vx *= -1;
                        if (this.y < 0 || this.y > pCanvas.height) this.vy *= -1;
                        
                        // Push particles away from the cursor
                        const dx = this.x - pMouse.x;
                        const dy = this.y - pMouse.y;
                        const dist = Math.sqrt(dx * dx + dy * dy);
                        if (dist < 140) {
                            const force = (140 - dist) / 140;
                            const angle = Math.atan2(dy, dx);
                            this.x += Math.cos(angle) * force * 1.6;
                            this.y += Math.sin(angle) * force * 1.6;
                        }
                    }
                    draw() {
                        pCtx.beginPath();
                        pCtx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                        pCtx.fillStyle = document.documentElement.classList.contains('dark') 
                            ? 'rgba(250, 204, 21, 0.12)' 
                            : 'rgba(202, 138, 4, 0.28)'; // Higher contrast gold/amber in light mode
                        pCtx.fill();
                    }
                }
                
                function init() {
                    pCanvas.width = window.innerWidth;
                    pCanvas.height = window.innerHeight;
                    pList = [];
                    for (let i = 0; i < pCount; i++) {
                        pList.push(new Particle());
                    }
                }
                
                function drawConnections() {
                    for (let i = 0; i < pList.length; i++) {
                        for (let j = i + 1; j < pList.length; j++) {
                            const dx = pList[i].x - pList[j].x;
                            const dy = pList[i].y - pList[j].y;
                            const dist = Math.sqrt(dx * dx + dy * dy);
                            if (dist < 100) {
                                pCtx.beginPath();
                                pCtx.moveTo(pList[i].x, pList[i].y);
                                pCtx.lineTo(pList[j].x, pList[j].y);
                                const alpha = 0.08 * (1 - dist / 100);
                                pCtx.strokeStyle = document.documentElement.classList.contains('dark')
                                    ? `rgba(250, 204, 21, ${alpha * 0.8})`
                                    : `rgba(202, 138, 4, ${alpha * 2.8})`; // Higher contrast lines in light mode
                                pCtx.lineWidth = 0.5;
                                pCtx.stroke();
                            }
                        }
                    }
                }
                
                function loop() {
                    pCtx.clearRect(0, 0, pCanvas.width, pCanvas.height);
                    
                    // Soft golden radial cursor-following glow
                    if (pMouse.x > -1000 && pMouse.y > -1000) {
                        const isDark = document.documentElement.classList.contains('dark');
                        const glowGrad = pCtx.createRadialGradient(pMouse.x, pMouse.y, 0, pMouse.x, pMouse.y, 180);
                        glowGrad.addColorStop(0, isDark ? 'rgba(250, 204, 21, 0.05)' : 'rgba(202, 138, 4, 0.16)'); // Warmer, more visible glow in light mode
                        glowGrad.addColorStop(1, 'rgba(202, 138, 4, 0)');
                        pCtx.fillStyle = glowGrad;
                        pCtx.beginPath();
                        pCtx.arc(pMouse.x, pMouse.y, 180, 0, Math.PI * 2);
                        pCtx.fill();
                    }
                    
                    // Update and draw particles
                    pList.forEach(p => {
                        p.update();
                        p.draw();
                    });
                    
                    // Update and draw cursor sparks
                    for (let i = sparkList.length - 1; i >= 0; i--) {
                        sparkList[i].update();
                        if (sparkList[i].alpha <= 0) {
                            sparkList.splice(i, 1);
                        } else {
                            sparkList[i].draw();
                        }
                    }
                    
                    drawConnections();
                    requestAnimationFrame(loop);
                }
                
                window.addEventListener('resize', () => {
                    pCanvas.width = window.innerWidth;
                    pCanvas.height = window.innerHeight;
                });
                
                init();
                loop();
            }

            // 4. Changing Title Word Animation
            const titleWords = ["Karya Nyata Kami.", "Pembangunan Daerah.", "Harapan Bersama.", "Gorontalo Maju."];
            let titleIndex = 0;
            const titleEl = document.getElementById('changing-title');
            if (titleEl) {
                setInterval(() => {
                    titleEl.classList.add('opacity-0', 'translate-y-2');
                    setTimeout(() => {
                        titleIndex = (titleIndex + 1) % titleWords.length;
                        titleEl.textContent = titleWords[titleIndex];
                        titleEl.classList.remove('opacity-0', 'translate-y-2');
                    }, 500);
                }, 4000);
            }
        });
    </script>
</body>
</html>