<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .font-display {
            font-family: 'Outfit', sans-serif;
        }

        /* --- GLOBAL PASTEL & VIBRANT THEME --- */
        body, .min-h-screen, .bg-gray-100 {
            background-color: #FAF9F3 !important; /* Soft warm-cream background */
        }
        
        /* Modernized Custom Cards - Vibrantly Colored */
        main .bg-white {
            background-color: #FFFFFF !important;
            border-radius: 24px !important;
            border: 1px solid rgba(234, 179, 8, 0.2) !important;
            box-shadow: 0 15px 35px -5px rgba(234, 179, 8, 0.05) !important;
            transition: all 0.3s ease;
        }
        
        main .bg-white:hover {
            box-shadow: 0 20px 40px -5px rgba(234, 179, 8, 0.08) !important;
        }

        /* Nav links & active indicators */
        aside a.bg-yellow-100 {
            background-color: rgba(254, 240, 138, 0.6) !important;
            color: #713F12 !important;
            border-radius: 12px !important;
            border-left: 4px solid #EAB308 !important;
            font-weight: 700 !important;
        }
        
        /* Sub-panel header strips - Vibrantly Colored Pastels */
        main .bg-yellow-55, main .bg-yellow-50, main .bg-indigo-55, main .bg-indigo-50, main .bg-green-50, main .bg-blue-50 {
            background: linear-gradient(90deg, #FEF9C3 0%, #FFFBEB 100%) !important;
            border-bottom: 1px solid rgba(234, 179, 8, 0.2) !important;
        }
        main .text-yellow-700, main .text-indigo-700, main .text-green-700, main .text-blue-700 {
            color: #A16207 !important;
        }
        main .bg-yellow-250, main .bg-yellow-200, main .bg-indigo-200, main .bg-green-200, main .bg-blue-200 {
            background-color: #FEF08A !important;
            color: #713F12 !important;
            border-radius: 8px !important;
            font-weight: 700 !important;
        }

        /* Table structures */
        table thead {
            background-color: rgba(254, 240, 138, 0.25) !important;
            border-bottom: 1.5px solid rgba(234, 179, 8, 0.25) !important;
        }
        table thead th {
            color: #854D0E !important;
            font-weight: 750 !important;
        }
        table tbody tr {
            transition: background-color 0.2s ease;
        }
        table tbody tr:hover {
            background-color: rgba(254, 252, 232, 0.4) !important;
        }

        /* Headings display styling */
        h2, h3.text-lg, h3.text-xl, h3.text-2xl {
            font-family: 'Outfit', sans-serif !important;
            font-weight: 800 !important;
            color: #1E293B !important;
        }

        /* Soft inputs style */
        select, input[type="text"], input[type="number"], input[type="date"], textarea {
            border: 1px solid rgba(234, 179, 8, 0.3) !important;
            border-radius: 12px !important;
            background-color: rgba(255, 255, 255, 0.8) !important;
            color: #334155 !important;
            font-size: 0.875rem !important;
            transition: all 0.2s ease !important;
        }
        select:focus, input[type="text"]:focus, input[type="number"]:focus, input[type="date"]:focus, textarea:focus {
            border-color: #FACC15 !important;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.25) !important;
            outline: none !important;
        }

        /* Soft primary action buttons override */
        .bg-yellow-500, button[type="submit"], .bg-indigo-600, .bg-indigo-500, .bg-indigo-700, x-primary-button, .bg-slate-900.text-white {
            background: linear-gradient(135deg, #FDE047 0%, #FACC15 100%) !important;
            color: #1E293B !important;
            border: none !important;
            border-radius: 12px !important;
            font-weight: 800 !important;
            box-shadow: 0 8px 20px -5px rgba(250, 204, 21, 0.4) !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            transition: all 0.2s ease !important;
        }
        .bg-yellow-500:hover, button[type="submit"]:hover, .bg-indigo-600:hover, .bg-indigo-500:hover, .bg-indigo-700:hover, x-primary-button:hover, .bg-slate-900.text-white:hover {
            box-shadow: 0 10px 25px -5px rgba(250, 204, 21, 0.6) !important;
            transform: translateY(-1.5px) !important;
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(254, 252, 232, 0.2); border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #FDE047; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #FACC15; }

        /* --- DARK THEME OVERRIDES --- */
        .dark body, .dark .min-h-screen, .dark .bg-gray-100 {
            background-color: #0B0E14 !important;
            color: #E2E8F0 !important;
        }

        .dark main .bg-white {
            background-color: #111622 !important;
            border: 1px solid rgba(255, 255, 255, 0.06) !important;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5) !important;
        }
        
        .dark main .bg-white:hover {
            border-color: rgba(250, 204, 21, 0.3) !important;
            box-shadow: 0 20px 45px -15px rgba(250, 204, 21, 0.05) !important;
        }

        .dark aside, .dark header {
            background-color: #111622 !important;
            border-color: rgba(255, 255, 255, 0.06) !important;
        }

        .dark aside a:not(.bg-yellow-100) {
            color: #94A3B8 !important;
        }
        
        .dark aside a:not(.bg-yellow-100):hover {
            background-color: rgba(255, 255, 255, 0.02) !important;
            color: #FACC15 !important;
        }

        .dark main .bg-yellow-55, .dark main .bg-yellow-50, .dark main .bg-indigo-55, .dark main .bg-indigo-50, .dark main .bg-green-50, .dark main .bg-blue-50 {
            background: linear-gradient(90deg, #1E1B4B 0%, #111827 100%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
        }

        .dark main .text-yellow-700, .dark main .text-indigo-700, .dark main .text-green-700, .dark main .text-blue-700 {
            color: #FDE047 !important;
        }

        .dark main .bg-yellow-250, .dark main .bg-yellow-200, .dark main .bg-indigo-200, .dark main .bg-green-200, .dark main .bg-blue-200 {
            background-color: #312E81 !important;
            color: #E0E7FF !important;
        }

        .dark table thead {
            background-color: rgba(15, 23, 42, 0.6) !important;
            border-bottom: 1.5px solid rgba(255, 255, 255, 0.06) !important;
        }

        .dark table thead th {
            color: #FACC15 !important;
        }

        .dark table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.03) !important;
        }

        .dark table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.02) !important;
        }

        .dark h2, .dark h3.text-lg, .dark h3.text-xl, .dark h3.text-2xl {
            color: #FFFFFF !important;
        }

        .dark .text-slate-800, .dark .text-slate-900, .dark .text-gray-800, .dark .text-gray-900 {
            color: #E2E8F0 !important;
        }

        .dark .text-slate-500, .dark .text-gray-500, .dark .text-slate-400 {
            color: #94A3B8 !important;
        }

        .dark select, .dark input[type="text"], .dark input[type="number"], .dark input[type="date"], .dark textarea {
            background-color: #1F2937 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #F3F4F6 !important;
        }

        .dark select:focus, .dark input[type="text"]:focus, .dark input[type="number"]:focus, .dark input[type="date"]:focus {
            border-color: #FACC15 !important;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.3) !important;
        }

        .dark .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.02); }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #EAB308; }
        
        .dark div.bg-yellow-50 {
            background-color: #1E293B !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ sidebarOpen: false }" class="antialiased bg-[#FCFBF7] text-slate-700 selection:bg-yellow-200 selection:text-yellow-900 overflow-x-hidden">
    <!-- Glowing background decorative circles -->
    <div class="fixed top-[-200px] right-[-100px] w-[600px] h-[600px] bg-yellow-400/5 dark:bg-yellow-400/10 rounded-full blur-[120px] pointer-events-none -z-10 animate-pulse"></div>
    <div class="fixed bottom-[-100px] left-[-200px] w-[700px] h-[700px] bg-indigo-400/5 dark:bg-indigo-400/10 rounded-full blur-[150px] pointer-events-none -z-10 animate-pulse"></div>

    <div class="min-h-screen flex w-full relative">

        <!-- Sidebar -->
        <div
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 w-64 z-30 bg-white border-r border-yellow-100/60 transform transition-transform duration-200 ease-in-out md:relative md:translate-x-0 md:z-auto"
        >
            @include('layouts.navigation')
        </div>

        <!-- Overlay -->
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-cloak
            class="fixed inset-0 bg-black bg-opacity-25 z-20 md:hidden"
        ></div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col w-full">

            <!-- Mobile topbar -->
            <header class="bg-white border-b border-yellow-100/60 px-4 py-3 flex items-center justify-between md:hidden relative">
                <!-- Tombol hamburger -->
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            
                <!-- Judul di tengah -->
                <div class="absolute left-1/2 transform -translate-x-1/2 text-lg font-bold text-gray-800">
                    {{ config('app.name', 'MY APP') }}
                </div>
            </header>
            

            <!-- Optional header (desktop only) -->
            @isset($header)
                <header class="bg-white border-b border-yellow-100/60 hidden md:block">
                    <div class="px-6 py-7">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // --- A. HANDLING SESSION FLASH (Success/Error) ---
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL!',
                text: "{{ session('success') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#f0fdf4', // Hijau muda
                iconColor: '#16a34a'   // Hijau tua
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'GAGAL!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#ef4444',
            });
        @endif

        // --- B. GLOBAL DELETE FUNCTION ---
        // Panggil fungsi ini di tombol hapus manapun: onclick="confirmDelete(this)"
        window.confirmDelete = function(button, message = 'Data yang dihapus tidak dapat dikembalikan!') {
            // Mencegah Accordion terbuka saat tombol diklik (Stop Propagation)
            if(event) event.stopPropagation();
            if(event) event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',     // Merah
                cancelButtonColor: '#3085d6',   // Biru
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Cari form terdekat dari tombol ini dan submit
                    button.closest('form').submit();
                }
            });
        }

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