<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
                transition: background-color 0.3s ease, color 0.3s ease;
            }
            .font-display {
                font-family: 'Outfit', sans-serif;
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
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased text-slate-700 dark:text-slate-200 bg-[#FCFBF7] dark:bg-[#0B0E14] selection:bg-yellow-200 selection:text-yellow-900 relative overflow-hidden h-screen flex flex-col justify-between">
        
        <!-- Floating Dark Mode Toggle (Top-Right) -->
        <div class="absolute top-6 right-6 z-[9999] pointer-events-auto">
            <button id="theme-toggle-btn" class="p-2.5 rounded-xl bg-white/85 dark:bg-slate-800/85 backdrop-blur-md hover:scale-105 transition-all text-yellow-600 dark:text-yellow-400 border border-yellow-100/30 dark:border-white/5 shadow-md flex items-center justify-center shrink-0 pointer-events-auto cursor-pointer">
                <!-- Sun icon -->
                <svg class="w-4 h-4 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path>
                </svg>
                <!-- Moon icon -->
                <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
            </button>
        </div>
        
        <!-- Pastel Glowing Orbs -->
        <div class="absolute top-0 inset-x-0 h-[900px] -z-20 transition-all duration-300 dark:opacity-20" style="background: radial-gradient(circle at top, rgba(254, 240, 138, 0.15) 0%, rgba(255, 255, 255, 0) 70%);"></div>
        <div class="absolute top-[100px] left-[10%] w-[500px] h-[500px] bg-yellow-100/40 dark:bg-yellow-500/5 rounded-full blur-[100px] -z-10 animate-float-slow"></div>
        <div class="absolute top-[250px] right-[10%] w-[600px] h-[600px] bg-amber-50/50 dark:bg-amber-500/5 rounded-full blur-[120px] -z-10 animate-float-medium"></div>

        <div class="absolute inset-0 opacity-75 dark:opacity-40 -z-10" style="background-image: radial-gradient(rgba(234, 179, 8, 0.05) 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <!-- Interactive Canvas Particle Network Background -->
        <canvas id="particle-canvas" class="absolute inset-0 pointer-events-none -z-10"></canvas>

        <div class="flex-grow flex flex-col sm:justify-center items-center pt-6 sm:pt-0 z-10">
            <div class="mb-4">
                <a href="/">
                    <img src="{{ asset('images/logo-golkar.png') }}" alt="Logo Golkar" class="w-16 h-auto drop-shadow-sm hover:scale-105 transition duration-300" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white/80 dark:bg-slate-900/85 backdrop-blur-md border border-yellow-100/50 dark:border-white/5 shadow-[0_15px_30px_-5px_rgba(234,179,8,0.05)] dark:shadow-[0_15px_30px_-5px_rgba(0,0,0,0.3)] overflow-hidden sm:rounded-[24px]">
                {{ $slot }}
            </div>
        </div>

        <!-- Custom Interactive Scripts for Guest Layout -->
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

                const pCanvas = document.getElementById('particle-canvas');
                if (pCanvas) {
                    const pCtx = pCanvas.getContext('2d');
                    let pList = [];
                    const pCount = 135; // Increased count for a more active network
                    let pMouse = { x: -9999, y: -9999 };
                    
                    window.addEventListener('mousemove', (e) => {
                        pMouse.x = e.clientX;
                        pMouse.y = e.clientY;
                    });
                    window.addEventListener('mouseleave', () => {
                        pMouse.x = -9999;
                        pMouse.y = -9999;
                    });
                    window.addEventListener('touchmove', (e) => {
                        if (e.touches.length > 0) {
                            pMouse.x = e.touches[0].clientX;
                            pMouse.y = e.touches[0].clientY;
                        }
                    }, { passive: true });
                    
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
                            if (dist < 120) {
                                const force = (120 - dist) / 120;
                                const angle = Math.atan2(dy, dx);
                                this.x += Math.cos(angle) * force * 1.5;
                                this.y += Math.sin(angle) * force * 1.5;
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
                            const glowGrad = pCtx.createRadialGradient(pMouse.x, pMouse.y, 0, pMouse.x, pMouse.y, 160);
                            glowGrad.addColorStop(0, isDark ? 'rgba(250, 204, 21, 0.05)' : 'rgba(202, 138, 4, 0.16)'); // Warmer, more visible glow in light mode
                            glowGrad.addColorStop(1, 'rgba(202, 138, 4, 0)');
                            pCtx.fillStyle = glowGrad;
                            pCtx.beginPath();
                            pCtx.arc(pMouse.x, pMouse.y, 160, 0, Math.PI * 2);
                            pCtx.fill();
                        }
                        
                        pList.forEach(p => {
                            p.update();
                            p.draw();
                        });
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
            });
        </script>
    </body>
</html>