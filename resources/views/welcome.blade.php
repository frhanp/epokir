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
    </style>
</head>
<body class="antialiased text-slate-700 selection:bg-yellow-200 selection:text-yellow-900 overflow-x-hidden">

    <!-- Pastel Glowing Orbs -->
    <div class="absolute top-0 inset-x-0 h-[900px] pastel-bg -z-20"></div>
    <div class="absolute top-[100px] left-[10%] w-[500px] h-[500px] bg-yellow-100/40 rounded-full blur-[100px] -z-10 animate-float-slow"></div>
    <div class="absolute top-[250px] right-[10%] w-[600px] h-[600px] bg-amber-50/50 rounded-full blur-[120px] -z-10 animate-float-medium"></div>

    <div class="absolute inset-0 soft-grid h-[900px] opacity-75 -z-10"></div>

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
            <a href="#features" class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-yellow-600 transition-colors mr-2">Fitur</a>
            
            <!-- Dark Mode Toggle Button -->
            <button onclick="toggleDarkMode()" class="p-2 rounded-xl bg-yellow-50/50 hover:bg-yellow-100/80 text-yellow-600 border border-yellow-250/20 dark:bg-slate-800 dark:hover:bg-slate-700 dark:border-slate-700 dark:text-yellow-400 transition shrink-0">
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

    <!-- Hero Section -->
    <section class="relative pt-36 pb-20 lg:pt-48 lg:pb-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <!-- Hero Info -->
                <div class="text-center lg:text-left">
                    <h1 class="text-5xl lg:text-6xl font-normal font-title text-slate-900 leading-tight mb-6">
                        Karya Nyata untuk <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-amber-600">Aspirasi Rakyat Gorontalo.</span>
                    </h1>
                    
                    <p class="text-base sm:text-lg text-slate-500 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Platform digital Fraksi Partai Golkar untuk pengelolaan Pokok Pikiran DPRD yang transparan, akuntabel, dan tepat sasaran demi pembangunan Gorontalo yang lebih maju.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('login') }}" class="glow-btn px-8 py-4 text-slate-950 font-bold rounded-xl shadow-lg transition duration-300 flex items-center justify-center gap-2">
                            Mulai Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                        <a href="#features" class="px-8 py-4 bg-white text-slate-600 border border-slate-200 font-bold rounded-xl hover:bg-slate-50 transition flex items-center justify-center">
                            Pelajari Fitur
                        </a>
                    </div>
                </div>

                <!-- Hero Graphic UI Mockup (Google Stitch Aligned) -->
                <div class="relative lg:block">
                    <!-- Glassmorphism Card Mockup -->
                    <div class="animate-float-slow pastel-card rounded-[32px] p-8 border border-white/60 relative z-10 shadow-2xl bg-white/70 max-w-md mx-auto">
                        <!-- Status Badge -->
                        <div class="flex justify-center mb-6">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 text-xs font-bold rounded-full border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Usulan Disetujui
                            </span>
                        </div>
                        
                        <!-- Logo & Branding -->
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 mx-auto mb-4 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-slate-100">
                                <img src="{{ asset('images/logo-golkar.png') }}" alt="Golkar Logo" class="h-12 w-auto">
                            </div>
                            <h3 class="text-2xl font-extrabold text-slate-900 tracking-wider">E-POKIR</h3>
                            <p class="text-xs font-medium text-slate-400 mt-1">Elektronik Pokok Pikiran DPRD</p>
                        </div>
                        
                        <!-- Value Tracker Box -->
                        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center text-yellow-600">
                                <span class="font-bold text-sm">Rp</span>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-slate-800">Rp 15.000.000.000</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Total Pagu</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Key Features Section -->
    <section id="features" class="py-24 bg-slate-50 border-t border-b border-slate-100 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-normal font-title text-slate-900 mb-4">Suara Golkar, Suara Rakyat</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">Kami menghadirkan sistem yang memudahkan pengelolaan aspirasi masyarakat agar terealisasi secara efektif.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="pastel-card p-8 rounded-[24px] shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 border border-slate-100 flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-yellow-500/10 rounded-2xl flex items-center justify-center text-yellow-600 mb-6 border border-yellow-500/20">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Transparansi Data</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">
                        Seluruh usulan dan pagu anggaran tercatat secara digital, meminimalisir kesalahan dan memudahkan pelacakan program.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="pastel-card p-8 rounded-[24px] shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 border border-slate-100 flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-yellow-500/10 rounded-2xl flex items-center justify-center text-yellow-600 mb-6 border border-yellow-500/20">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Efisiensi Proses</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">
                        Dari input usulan Excel hingga rekapitulasi per Aleg dilakukan secara otomatis, mempercepat proses kerja administrasi.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="pastel-card p-8 rounded-[24px] shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 border border-slate-100 flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-yellow-500/10 rounded-2xl flex items-center justify-center text-yellow-600 mb-6 border border-yellow-500/20">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Akurasi & Realisasi</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">
                        Memastikan setiap pagu anggaran terserap sesuai dengan program kegiatan yang paling dibutuhkan masyarakat Gorontalo.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-golkar.png') }}" alt="Logo" class="h-8 w-auto grayscale opacity-45 hover:grayscale-0 hover:opacity-100 transition duration-300">
                <span class="text-xs font-semibold text-slate-400">
                    &copy; 2026 Fraksi Partai Golkar Gorontalo. All rights reserved.
                </span>
            </div>
            <div class="flex gap-6 text-xs text-slate-400 font-medium">
                <a href="#" class="hover:text-yellow-600 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-yellow-600 transition-colors">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-yellow-600 transition-colors">Hubungi Kami</a>
            </div>
        </div>
    </footer>

    <!-- Dark Mode Toggle Script -->
    <script>
        window.toggleDarkMode = function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
            }
        }
    </script>
</body>
</html>