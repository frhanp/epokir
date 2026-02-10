<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-POKIR Golkar') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-gray-900 bg-white selection:bg-yellow-200 selection:text-yellow-900">

    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-golkar.png') }}" alt="Logo" class="h-10 w-auto drop-shadow-sm">
                    <div class="leading-tight hidden sm:block">
                        <span class="block text-lg font-extrabold text-yellow-500 tracking-wide uppercase">Fraksi Partai Golkar</span>
                        <span class="block text-xs font-semibold text-gray-500 tracking-wider">DPRD Provinsi Gorontalo</span>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-bold text-gray-700 hover:text-yellow-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 bg-yellow-500 text-white font-bold rounded-full shadow-lg shadow-yellow-500/30 hover:bg-yellow-600 hover:shadow-yellow-500/50 transition transform hover:-translate-y-0.5">
                                Masuk Sistem
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-yellow-100 rounded-full blur-3xl opacity-50 z-0"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-yellow-50 rounded-full blur-3xl opacity-50 z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-50 border border-yellow-200 text-yellow-700 text-xs font-bold uppercase tracking-wider mb-6">
                        <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                        Sistem Informasi Pokok Pikiran
                    </div>
                    
                    <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                        Karya Nyata untuk <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-yellow-600">Aspirasi Rakyat.</span>
                    </h1>
                    
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Platform digital Fraksi Partai Golkar untuk pengelolaan Pokok Pikiran DPRD yang transparan, akuntabel, dan tepat sasaran demi pembangunan Gorontalo yang lebih maju.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-yellow-500 text-white font-bold rounded-xl shadow-xl hover:bg-gray-800 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            Mulai Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                        <a href="#features" class="px-8 py-4 bg-white text-gray-700 border border-gray-200 font-bold rounded-xl hover:bg-gray-50 hover:text-yellow-600 transition flex items-center justify-center">
                            Pelajari Fitur
                        </a>
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <div class="absolute top-0 right-0 bg-white p-4 rounded-2xl shadow-2xl border border-gray-100 z-20 transform rotate-3 animate-float-slow">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400">Status</div>
                                <div class="font-bold text-gray-800">Usulan Disetujui</div>
                            </div>
                        </div>
                        <div class="h-2 w-32 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-green-500 w-full"></div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-yellow-500 to-yellow-400 rounded-3xl p-1 shadow-2xl transform -rotate-1">
                        <div class="bg-white rounded-[20px] overflow-hidden h-96 flex items-center justify-center relative">
                            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#F59E0B 1px, transparent 1px); background-size: 20px 20px;"></div>
                            
                            <div class="text-center p-8">
                                <img src="{{ asset('images/logo-golkar.png') }}" class="h-24 mx-auto mb-4 opacity-90" alt="Golkar">
                                <h3 class="text-2xl font-bold text-gray-800">E-POKIR</h3>
                                <p class="text-gray-500 mt-2">Elektronik Pokok Pikiran DPRD</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-10 left-0 bg-white p-4 rounded-2xl shadow-2xl border border-gray-100 z-20 transform -rotate-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400">Total Pagu</div>
                                <div class="font-bold text-gray-800">Rp 15.000.000.000</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Suara Golkar, Suara Rakyat</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Kami menghadirkan sistem yang memudahkan pengelolaan aspirasi masyarakat agar terealisasi secara efektif.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition border border-gray-100">
                    <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Transparansi Data</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Seluruh usulan dan pagu anggaran tercatat secara digital, meminimalisir kesalahan dan memudahkan pelacakan program.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition border border-gray-100">
                    <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Efisiensi Proses</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dari input usulan Excel hingga rekapitulasi per Aleg dilakukan secara otomatis, mempercepat proses kerja administrasi.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition border border-gray-100">
                    <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Akurasi & Realisasi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Memastikan setiap pagu anggaran terserap sesuai dengan program kegiatan yang paling dibutuhkan masyarakat Gorontalo.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-200 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-golkar.png') }}" alt="Logo" class="h-8 w-auto grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition">
                <span class="text-sm font-semibold text-gray-500">
                    &copy; 2026 Fraksi Partai Golkar Gorontalo.
                </span>
            </div>
            <div class="flex gap-6 text-sm text-gray-400 font-medium">
                <a href="#" class="hover:text-yellow-600 transition">Kebijakan Privasi</a>
                <a href="#" class="hover:text-yellow-600 transition">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-yellow-600 transition">Kontak Admin</a>
            </div>
        </div>
    </footer>

    <style>
        @keyframes float-slow {
            0%, 100% { transform: translateY(0) rotate(3deg); }
            50% { transform: translateY(-10px) rotate(3deg); }
        }
        .animate-float-slow {
            animation: float-slow 5s ease-in-out infinite;
        }
    </style>
</body>
</html>