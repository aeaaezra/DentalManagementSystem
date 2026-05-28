<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shine & Smile | Enterprise Dental Practice Management</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        :root {
            --brand-primary: #0f172a;
            --brand-accent: #db2777;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
            background-color: #ffffff;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid #f1f5f9;
        }

        .hero-gradient {
            background: radial-gradient(circle at top right, #fdf2f8 0%, #ffffff 50%);
        }

        .btn-premium {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px -10px rgba(219, 39, 119, 0.3);
        }

        .dev-card {
            transition: all 0.4s ease;
        }

        .dev-card:hover {
            transform: translateY(-10px);
        }

        .map-container {
            filter: grayscale(1) contrast(1.2) opacity(0.8);
            transition: all 0.5s ease;
        }

        .map-container:hover {
            filter: grayscale(0) contrast(1) opacity(1);
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 9999px;
            background: #f8fafc;
            color: #94a3b8;
            transition: all 0.3s ease;
        }

        .social-btn.li:hover {
            background-color: #0A66C2;
        }

        .social-btn:hover {
            color: white;
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
        }

        .social-btn.fb:hover { background-color: #1877F2; }
        .social-btn.tt:hover { background-color: #000000; }
        .social-btn.ig:hover {
            background: radial-gradient(circle at 30% 107%,
                #fdf497 0%,
                #fdf497 5%,
                #fd5949 45%,
                #d6249f 60%,
                #285AEB 90%);
        }
        .social-btn.gm:hover { background-color: #EA4335; }

        .logo-sparkle {
            animation: sparkle 3s ease-in-out infinite;
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0.4; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.2); }
        }
    </style>
</head>
<body class="text-slate-900 antialiased">

    <div class="bg-slate-900 text-white py-2 text-center text-xs font-medium tracking-wide">
        TRUSTED BY OVER 2,500+ DENTAL PROFESSIONALS NATIONWIDE
    </div>

    <nav class="glass-nav sticky w-full z-50 top-0 left-0 transition-all duration-300 h-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-pink-600 to-rose-400 rounded-xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                        <div class="relative bg-white p-2 rounded-xl border border-slate-100 shadow-sm">
                            <svg width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 2L2 10V20C2 28.5 8.5 36.2 20 38C31.5 36.2 38 28.5 38 20V10L20 2Z" fill="#DB2777" />
                                <path d="M20 38C26 36.5 31 32 34.5 26.5L20 20V38Z" fill="#BE185D" />
                                <circle cx="20" cy="16" r="6" fill="white" fill-opacity="0.2" />
                                <path class="logo-sparkle" d="M20 8L21.5 14.5L28 16L21.5 17.5L20 24L18.5 17.5L12 16L18.5 14.5L20 8Z" fill="white" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight text-slate-900">
                        Shine<span class="text-pink-600">&</span>Smile
                    </span>
                </div>

                <div class="hidden md:flex space-x-10 items-center font-semibold text-sm">
                    <a href="#platform" class="text-slate-600 hover:text-pink-600 transition-colors">Platform</a>
                    <a href="#solutions" class="text-slate-600 hover:text-pink-600 transition-colors">Solutions</a>
                    <a href="#about-dev" class="text-slate-600 hover:text-pink-600 transition-colors">The Team</a>
                    <a href="#location" class="text-slate-600 hover:text-pink-600 transition-colors">Location</a>
                    <div class="h-6 w-px bg-slate-200 mx-2"></div>

                    @auth
                        <a href="{{ url('/admin') }}" class="text-slate-600 hover:text-pink-600 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 hover:text-pink-600 transition-colors">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-premium bg-pink-600 text-white px-6 py-2.5 rounded-lg font-bold shadow-lg hover:bg-pink-700 transition-all">
                                Sign Up
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="md:hidden">
                    <button id="menu-btn" class="p-2 text-slate-900" type="button">
                        <i data-lucide="align-right" class="w-7 h-7"></i>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col gap-4 font-semibold text-sm">
                    <a href="#platform" class="text-slate-600 py-2">Platform</a>
                    <a href="#solutions" class="text-slate-600 py-2">Solutions</a>
                    <a href="#about-dev" class="text-slate-600 py-2">The Team</a>
                    <a href="#location" class="text-slate-600 py-2">Location</a>

                    @auth
                        <a href="{{ url('/admin') }}" class="text-slate-600 py-2">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 py-2">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-premium bg-pink-600 text-white px-6 py-2.5 rounded-lg font-bold shadow-lg text-center">
                                Get Started Now
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-20 pb-20 lg:pt-32 lg:pb-40 overflow-hidden hero-gradient">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-start">
                <div>
                    <div class="flex items-center gap-2 mb-8">
                        <span class="w-12 h-px bg-pink-600"></span>
                        <span class="text-pink-600 font-bold text-xs uppercase tracking-[0.2em]">Next-Gen Clinical OS</span>
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 leading-[1.1] mb-8 tracking-tight">
                        The Operating System for
                        <span class="text-pink-600 underline decoration-pink-100 underline-offset-8">Modern Dentistry.</span>
                    </h1>
                    <p class="text-xl text-slate-500 mb-10 max-w-xl leading-relaxed">
                        Scale your practice with a unified platform for clinical excellence, patient engagement, and financial intelligence.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-5 mb-12">
                        @auth
                            <a href="{{ url('/admin') }}" class="btn-premium bg-slate-900 text-white px-10 py-5 rounded-xl font-bold text-lg flex items-center justify-center gap-3">
                                Go to Dashboard
                                <i data-lucide="chevron-right" class="w-5 h-5"></i>
                            </a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-premium bg-slate-900 text-white px-10 py-5 rounded-xl font-bold text-lg flex items-center justify-center gap-3">
                                    Sign Up Now
                                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="relative lg:mt-0 mt-12">
                    <div class="relative z-20 shadow-2xl rounded-3xl overflow-hidden border border-slate-200">
                        <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&q=80&w=2000" alt="Dashboard" class="w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about-dev" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-pink-600 font-bold tracking-widest uppercase text-xs mb-4">The Engineering Core</h2>
                <h2 class="text-4xl lg:text-5xl font-extrabold text-slate-900 mb-4">The Minds Behind the Code</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">A specialized task force of architects and engineers dedicated to dental health technology.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="dev-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-100">
                    <div class="aspect-square overflow-hidden bg-slate-200">
                        <img src="{{ asset('images/owen.jpg') }}" alt="Owen Boyd T. Delos Santos" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-slate-900">Owen Boyd T. Delos Santos</h4>
                        <p class="text-pink-600 text-sm font-semibold mb-3 uppercase tracking-wider">Documenter</p>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">Focused on documentation of our system.</p>

                        <div class="flex gap-2 mt-4 pt-4 border-t border-slate-50">
                            <a href="https://www.facebook.com" target="_blank" class="social-btn fb" title="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.19 2.23.19v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.77l-.44 2.89h-2.33v6.99A10 10 0 0 0 22 12z"/>
                                </svg>
                            </a>

                            <a href="https://www.instagram.com" target="_blank" class="social-btn ig" title="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zM17 6.25a.75.75 0 1 1 0 1.5.75.75 0 0 1 0-1.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5A3.5 3.5 0 1 0 12 15.5 3.5 3.5 0 0 0 12 8.5z"/>
                                </svg>
                            </a>

                            <a href="https://www.tiktok.com" target="_blank" class="social-btn tt" title="TikTok">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.03 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.44 1.43-1.58 2.42-.14 1.01.23 2.08.94 2.82.65.7 1.61 1.07 2.54 1.02.94-.03 1.84-.54 2.39-1.3.4-.53.61-1.18.61-1.83.03-3.93.01-7.85.02-11.77z"/>
                                </svg>
                            </a>

                            <a href="https://www.linkedin.com/in/yourprofile" target="_blank" class="social-btn li" title="LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                                    <path d="M19 0h-14C2.24 0 0 2.24 0 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zM7.12 20.45H3.56V9h3.56v11.45zM5.34 7.43c-1.14 0-2.06-.93-2.06-2.07 0-1.14.92-2.07 2.06-2.07 1.14 0 2.06.93 2.06 2.07 0 1.14-.92 2.07-2.06 2.07zM20.45 20.45h-3.56v-5.6c0-1.34-.02-3.07-1.87-3.07-1.87 0-2.16 1.46-2.16 2.97v5.7H9.3V9h3.41v1.56h.05c.48-.9 1.64-1.87 3.37-1.87 3.6 0 4.27 2.37 4.27 5.45v6.31z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dev-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-100">
                    <div class="aspect-square overflow-hidden bg-slate-200">
                        <img src="{{ asset('images/myimage.jpg') }}" alt="Mark Andrew M. Gella" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-slate-900">Mark Andrew M. Gella</h4>
                        <p class="text-pink-600 text-sm font-semibold mb-3 uppercase tracking-wider">System Analyst and Programmer</p>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">
                            Focuses on understanding problems, gathering requirements, designing how the system should work, writing code, debugging, and making sure the system functions correctly.
                        </p>

                        <div class="flex gap-2 mt-4 pt-4 border-t border-slate-50">
                            <a href="https://www.facebook.com/profile.php?id=61577351831675" target="_blank" class="social-btn fb" title="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.19 2.23.19v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.77l-.44 2.89h-2.33v6.99A10 10 0 0 0 22 12z"/>
                                </svg>
                            </a>

                            <a href="https://www.instagram.com/urfavvy_mark?igsh=OGtjNmFmbGVnbThu" target="_blank" class="social-btn ig" title="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zM17 6.25a.75.75 0 1 1 0 1.5.75.75 0 0 1 0-1.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5A3.5 3.5 0 1 0 12 15.5 3.5 3.5 0 0 0 12 8.5z"/>
                                </svg>
                            </a>

                            <a href="https://www.tiktok.com/@ezra.1020?is_from_webapp=1&sender_device=pc" target="_blank" class="social-btn tt" title="TikTok">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.03 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.44 1.43-1.58 2.42-.14 1.01.23 2.08.94 2.82.65.7 1.61 1.07 2.54 1.02.94-.03 1.84-.54 2.39-1.3.4-.53.61-1.18.61-1.83.03-3.93.01-7.85.02-11.77z"/>
                                </svg>
                            </a>

                            <a href="https://www.linkedin.com/in/yourprofile" target="_blank" class="social-btn li" title="LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                                    <path d="M19 0h-14C2.24 0 0 2.24 0 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zM7.12 20.45H3.56V9h3.56v11.45zM5.34 7.43c-1.14 0-2.06-.93-2.06-2.07 0-1.14.92-2.07 2.06-2.07 1.14 0 2.06.93 2.06 2.07 0 1.14-.92 2.07-2.06 2.07zM20.45 20.45h-3.56v-5.6c0-1.34-.02-3.07-1.87-3.07-1.87 0-2.16 1.46-2.16 2.97v5.7H9.3V9h3.41v1.56h.05c.48-.9 1.64-1.87 3.37-1.87 3.6 0 4.27 2.37 4.27 5.45v6.31z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dev-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-100">
                    <div class="aspect-square overflow-hidden bg-slate-200">
                        <img src="{{ asset('images/Gilbertjpg.jpg') }}" alt="Gilbert V. Ligason" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-slate-900">Gilbert V. Ligason</h4>
                        <p class="text-pink-600 text-sm font-semibold mb-3 uppercase tracking-wider">UI/UX Designer</p>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">Developing AI diagnostic aids and financial forecasting models.</p>

                        <div class="flex gap-2 mt-4 pt-4 border-t border-slate-50">
                            <a href="https://www.facebook.com" target="_blank" class="social-btn fb" title="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.19 2.23.19v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.77l-.44 2.89h-2.33v6.99A10 10 0 0 0 22 12z"/>
                                </svg>
                            </a>

                            <a href="https://www.instagram.com" target="_blank" class="social-btn ig" title="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zM17 6.25a.75.75 0 1 1 0 1.5.75.75 0 0 1 0-1.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5A3.5 3.5 0 1 0 12 15.5 3.5 3.5 0 0 0 12 8.5z"/>
                                </svg>
                            </a>

                            <a href="https://www.tiktok.com" target="_blank" class="social-btn tt" title="TikTok">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.03 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.44 1.43-1.58 2.42-.14 1.01.23 2.08.94 2.82.65.7 1.61 1.07 2.54 1.02.94-.03 1.84-.54 2.39-1.3.4-.53.61-1.18.61-1.83.03-3.93.01-7.85.02-11.77z"/>
                                </svg>
                            </a>

                            <a href="https://www.linkedin.com/in/yourprofile" target="_blank" class="social-btn li" title="LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                                    <path d="M19 0h-14C2.24 0 0 2.24 0 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zM7.12 20.45H3.56V9h3.56v11.45zM5.34 7.43c-1.14 0-2.06-.93-2.06-2.07 0-1.14.92-2.07 2.06-2.07 1.14 0 2.06.93 2.06 2.07 0 1.14-.92 2.07-2.06 2.07zM20.45 20.45h-3.56v-5.6c0-1.34-.02-3.07-1.87-3.07-1.87 0-2.16 1.46-2.16 2.97v5.7H9.3V9h3.41v1.56h.05c.48-.9 1.64-1.87 3.37-1.87 3.6 0 4.27 2.37 4.27 5.45v6.31z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dev-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-100">
                    <div class="aspect-square overflow-hidden bg-slate-200">
                        <img src="{{ asset('images/joeyjpg.jpg') }}" alt="Joey M. Payos" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-slate-900">Joey M. Payos</h4>
                        <p class="text-pink-600 text-sm font-semibold mb-3 uppercase tracking-wider">Security Lead</p>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">Overseeing end-to-end encryption and SOC audit protocols.</p>

                        <div class="flex gap-2 mt-4 pt-4 border-t border-slate-50">
                            <a href="https://www.facebook.com" target="_blank" class="social-btn fb" title="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.19 2.23.19v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.77l-.44 2.89h-2.33v6.99A10 10 0 0 0 22 12z"/>
                                </svg>
                            </a>

                            <a href="https://www.instagram.com" target="_blank" class="social-btn ig" title="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zM17 6.25a.75.75 0 1 1 0 1.5.75.75 0 0 1 0-1.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5A3.5 3.5 0 1 0 12 15.5 3.5 3.5 0 0 0 12 8.5z"/>
                                </svg>
                            </a>

                            <a href="https://www.tiktok.com" target="_blank" class="social-btn tt" title="TikTok">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.03 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.44 1.43-1.58 2.42-.14 1.01.23 2.08.94 2.82.65.7 1.61 1.07 2.54 1.02.94-.03 1.84-.54 2.39-1.3.4-.53.61-1.18.61-1.83.03-3.93.01-7.85.02-11.77z"/>
                                </svg>
                            </a>

                            <a href="https://www.linkedin.com/in/yourprofile" target="_blank" class="social-btn li" title="LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                                    <path d="M19 0h-14C2.24 0 0 2.24 0 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zM7.12 20.45H3.56V9h3.56v11.45zM5.34 7.43c-1.14 0-2.06-.93-2.06-2.07 0-1.14.92-2.07 2.06-2.07 1.14 0 2.06.93 2.06 2.07 0 1.14-.92 2.07-2.06 2.07zM20.45 20.45h-3.56v-5.6c0-1.34-.02-3.07-1.87-3.07-1.87 0-2.16 1.46-2.16 2.97v5.7H9.3V9h3.41v1.56h.05c.48-.9 1.64-1.87 3.37-1.87 3.6 0 4.27 2.37 4.27 5.45v6.31z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="location" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-pink-600 font-bold tracking-widest uppercase text-xs mb-4">Our Flagship Clinic</h2>
                <h2 class="text-4xl lg:text-5xl font-extrabold text-slate-900 mb-4">Visit Us in the Heart of the City</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">Experience the future of dentistry at our showcase facility where we test every new platform feature.</p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8 items-start">
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100">
                        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                            <i data-lucide="map-pin" class="text-pink-600"></i> Headquarters
                        </h3>
                        <p class="text-slate-600 leading-relaxed mb-6">
                            Door 5, MDFI Bldg,<br>
                            Rafael Alunan Ave, <br>
                            Brgy. Zone III,<br>
                            Koronadal, South Cotabato (9506)<br>
                        </p>

                        <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                            <i data-lucide="clock" class="text-pink-600"></i> Hours
                        </h3>
                        <ul class="text-slate-600 space-y-2 mb-6">
                            <li class="flex justify-between"><span>Mon - Fri</span> <span class="font-semibold text-slate-900">8AM - 6PM</span></li>
                            <li class="flex justify-between"><span>Saturday</span> <span class="font-semibold text-slate-900">9AM - 2PM</span></li>
                        </ul>

                        <a href="https://www.google.com/maps/dir/?api=1&destination=Door+5+MDFI+Bldg+Rafael+Alunan+Ave+Koronadal+South+Cotabato+9506"
                           target="_blank"
                           class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold hover:bg-slate-800 transition-all flex items-center justify-center gap-2">
                            Get Directions
                            <i data-lucide="corner-up-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-2 rounded-3xl overflow-hidden shadow-2xl border border-slate-200 map-container h-[500px]">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.8354345093747!2d-122.41941550000001!3d37.7749295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1715000000000!5m2!1sen!2sus"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-slate-50 pt-24 pb-12 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-4 gap-12 mb-20">
                <div class="col-span-2">
                    <div class="flex items-center gap-3 mb-8">
                        <svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 2L2 10V20C2 28.5 8.5 36.2 20 38C31.5 36.2 38 28.5 38 20V10L20 2Z" fill="#DB2777" />
                            <path d="M20 38C26 36.5 31 32 34.5 26.5L20 20V38Z" fill="#BE185D" />
                            <path d="M20 8L21.5 14.5L28 16L21.5 17.5L20 24L18.5 17.5L12 16L18.5 14.5L20 8Z" fill="white" />
                        </svg>
                        <span class="text-xl font-extrabold tracking-tight text-slate-900">Shine & Smile</span>
                    </div>
                    <p class="text-slate-500 max-w-sm mb-8 leading-relaxed">
                        Redefining dental practice management with a focus on clinician efficiency and patient outcomes.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase text-xs tracking-widest">Platform</h4>
                    <ul class="space-y-4 text-slate-500 text-sm font-medium">
                        <li><a href="#" class="hover:text-pink-600 transition-colors">Clinical Records</a></li>
                        <li><a href="#" class="hover:text-pink-600 transition-colors">Billing Engine</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase text-xs tracking-widest">Company</h4>
                    <ul class="space-y-4 text-slate-500 text-sm font-medium">
                        <li><a href="#" class="hover:text-pink-600 transition-colors">Our Mission</a></li>
                        <li><a href="#" class="hover:text-pink-600 transition-colors">Privacy</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-200 text-center text-slate-400 text-xs">
                © 2025 Shine & Smile Systems Inc. | All Rights Reserved.
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (!nav) return;

            if (window.scrollY > 50) {
                nav.classList.add('shadow-xl', 'h-16');
                nav.classList.remove('h-20');
            } else {
                nav.classList.remove('shadow-xl', 'h-16');
                nav.classList.add('h-20');
            }
        });
    </script>
</body>
</html>
