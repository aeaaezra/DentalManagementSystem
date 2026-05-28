<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shine & Smile - Premium Family Dental & Medical Clinic</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fdf2f8',
                            100: '#fce7f3',
                            500: '#db2777', // Dynamic Pink
                            600: '#be185d',
                            700: '#9d174d',
                            900: '#500724',
                        },
                        secondary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .carousel-item {
            transition: transform 0.7s ease-in-out, opacity 0.7s ease-in-out;
        }
        #map {
            z-index: 10;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">

    <nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="#hero" class="flex items-center gap-2.5 group">
                    <div class="w-11 h-11 bg-gradient-to-tr from-primary-500 to-rose-400 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-500/30 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-tooth text-lg"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-extrabold text-slate-900 tracking-tight block leading-none">Shine<span class="text-primary-500">&</span>Smile</span>
                        <span class="text-xs font-semibold text-slate-400 tracking-wider uppercase">Medical & Dental Clinic</span>
                    </div>
                </a>

                <div class="hidden lg:flex items-center gap-8 font-medium text-slate-600">
                    <a href="#hero" class="hover:text-primary-600 transition-colors">Home</a>
                    <a href="#services" class="hover:text-primary-600 transition-colors">Services</a>
                    <a href="#booking-section" class="hover:text-primary-600 transition-colors">Book Online</a>
                    <a href="#location" class="hover:text-primary-600 transition-colors">Find Us</a>
                    <div class="h-5 w-px bg-slate-200"></div>
                </div>

                <div class="hidden lg:flex items-center gap-4" id="nav-actions-desktop">
                    <div id="guest-buttons" class="flex items-center gap-3">
                        <a href="{{ url('/auth') }}" class="text-slate-700 hover:text-primary-600 font-semibold px-4 py-2 rounded-xl hover:bg-slate-50 transition-all">Sign In</a>
                        <a href="{{ url('/register') }}" class="bg-slate-900 hover:bg-slate-800 text-white font-semibold px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">Register</a>

                    </div>
                    <div id="user-profile" class="hidden flex items-center gap-4">
                        <button onclick="toggleDashboard()" class="flex items-center gap-2 bg-slate-50 hover:bg-slate-100 border border-slate-200 py-1.5 px-3 rounded-xl transition-all">
                            <div class="w-8 h-8 rounded-lg bg-primary-500 text-white flex items-center justify-center font-bold" id="user-avatar">U</div>
                            <span class="font-semibold text-slate-700 text-sm" id="user-name">User</span>
                        </button>
                        <button onclick="logout()" class="text-slate-400 hover:text-rose-600 text-lg transition-colors p-2" title="Logout">
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                    </div>
                </div>

                <button onclick="toggleMobileMenu()" class="lg:hidden flex items-center justify-center p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors">
                    <i id="mobile-menu-icon" class="fa-solid fa-bars text-2xl"></i>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-100 bg-white shadow-xl px-4 py-6 space-y-4">
            <a href="#hero" onclick="toggleMobileMenu()" class="block font-semibold text-slate-700 hover:text-primary-600 py-2">Home</a>
            <a href="#services" onclick="toggleMobileMenu()" class="block font-semibold text-slate-700 hover:text-primary-600 py-2">Services</a>
            <a href="#booking-section" onclick="toggleMobileMenu()" class="block font-semibold text-slate-700 hover:text-primary-600 py-2">Book Online</a>
            <a href="#location" onclick="toggleMobileMenu()" class="block font-semibold text-slate-700 hover:text-primary-600 py-2">Find Us</a>
            <hr class="border-slate-100 my-2">
            <div id="mobile-auth-actions" class="space-y-3">
                <div id="mobile-guest-buttons" class="space-y-3">

                      <a href="{{ url('/auth') }}" class="w-full text-center border border-slate-200 text-slate-700 font-semibold py-3 rounded-xl hover:bg-slate-50 transition-all">Sign In</a>
                    <a href="{{ url('/register') }}" class="w-full text-center bg-slate-900 text-white font-semibold py-3 rounded-xl shadow-md transition-all">Register</a>

                </div>
                <div id="mobile-user-profile" class="hidden space-y-3">
                    <div class="flex items-center gap-3 bg-slate-50 p-3 rounded-xl">
                        <div class="w-10 h-10 rounded-lg bg-primary-500 text-white flex items-center justify-center font-bold text-lg" id="mobile-user-avatar">U</div>
                        <span class="font-semibold text-slate-700" id="mobile-user-name">User</span>
                    </div>
                    <button onclick="toggleDashboard(); toggleMobileMenu()" class="w-full bg-slate-100 text-slate-700 font-semibold py-3 rounded-xl transition-all">
                        <i class="fa-regular fa-calendar-days mr-2"></i>My Appointments
                    </button>
                    <button onclick="logout(); toggleMobileMenu()" class="w-full bg-rose-50 text-rose-600 font-semibold py-3 rounded-xl transition-all">
                        <i class="fa-solid fa-power-off mr-2"></i>Sign Out
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div id="toast-container" class="fixed bottom-6 right-6 z-50 flex flex-col gap-3 pointer-events-none"></div>

    <header id="hero" class="relative overflow-hidden bg-slate-900 h-[500px] sm:h-[600px] lg:h-[680px]">
        <div class="relative w-full h-full overflow-hidden" id="carousel-slides">
            <div class="carousel-item absolute inset-0 w-full h-full opacity-100 scale-100 transition-all duration-700 flex items-center" data-index="0">
                <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?q=80&w=2070" alt="State-of-the-art Healthcare Clinic" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/80 to-transparent"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
                    <div class="max-w-2xl text-white">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-primary-500/20 text-primary-400 text-xs font-bold uppercase tracking-wider mb-5 border border-primary-500/30">
                            <i class="fa-solid fa-circle-check"></i> Certified Dental & Medical Experts
                        </span>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6 leading-[1.1]">Your Smile. <br class="hidden sm:inline">Our Dedicated Passion.</h1>
                        <p class="text-lg text-slate-300 mb-8 leading-relaxed">Experience gentle, patient-centered oral health and wellness care tailored specifically to you. Enjoy our warm environment and expert, friendly staff.</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#booking-section" class="bg-primary-600 hover:bg-primary-700 text-white text-center font-bold px-7 py-4 rounded-xl shadow-lg shadow-primary-600/30 hover:shadow-xl hover:-translate-y-0.5 transition-all">Book Your Visit Now</a>
                            <a href="#services" class="bg-white/10 hover:bg-white/20 border border-white/20 text-white text-center font-bold px-7 py-4 rounded-xl transition-all">Explore Our Services</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item absolute inset-0 w-full h-full opacity-0 scale-95 transition-all duration-700 flex items-center" data-index="1">
                <img src="https://images.unsplash.com/photo-1629909615184-74f495363b67?q=80&w=2070" alt="Advanced Diagnostic Technology" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/80 to-transparent"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
                    <div class="max-w-2xl text-white">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-primary-500/20 text-primary-400 text-xs font-bold uppercase tracking-wider mb-5 border border-primary-500/30">
                            <i class="fa-solid fa-microscope"></i> Modern Treatment Rooms
                        </span>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6 leading-[1.1]">Advanced Technology, Painless Care.</h1>
                        <p class="text-lg text-slate-300 mb-8 leading-relaxed">We utilize the latest breakthroughs in high-resolution digital imaging, laser treatment systems, and state-of-the-art diagnostic dental equipment.</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#booking-section" class="bg-primary-600 hover:bg-primary-700 text-white text-center font-bold px-7 py-4 rounded-xl shadow-lg shadow-primary-600/30 hover:shadow-xl hover:-translate-y-0.5 transition-all">Schedule Today</a>
                            <a href="#location" class="bg-white/10 hover:bg-white/20 border border-white/20 text-white text-center font-bold px-7 py-4 rounded-xl transition-all">Get Clinic Map</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item absolute inset-0 w-full h-full opacity-0 scale-95 transition-all duration-700 flex items-center" data-index="2">
                <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?q=80&w=2070" alt="Beautiful Patient Smile" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/80 to-transparent"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
                    <div class="max-w-2xl text-white">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-primary-500/20 text-primary-400 text-xs font-bold uppercase tracking-wider mb-5 border border-primary-500/30">
                            <i class="fa-solid fa-heart-pulse"></i> Comprehensive Health Plans
                        </span>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6 leading-[1.1]">Complete Family Medical Support.</h1>
                        <p class="text-lg text-slate-300 mb-8 leading-relaxed">From pediatric check-ups and preventative physicals to full cosmetic alignments, we offer convenient integrated health services for every generation.</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#booking-section" class="bg-primary-600 hover:bg-primary-700 text-white text-center font-bold px-7 py-4 rounded-xl shadow-lg shadow-primary-600/30 hover:shadow-xl hover:-translate-y-0.5 transition-all">Reserve Slots Now</a>
                            <a href="#services" class="bg-white/10 hover:bg-white/20 border border-white/20 text-white text-center font-bold px-7 py-4 rounded-xl transition-all">View Service Pricing</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button onclick="prevSlide()" class="absolute left-4 sm:left-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/25 text-white w-12 h-12 rounded-full border border-white/10 flex items-center justify-center backdrop-blur-md transition-all z-30 group" aria-label="Previous Slide">
            <i class="fa-solid fa-arrow-left text-lg group-hover:-translate-x-0.5 transition-transform"></i>
        </button>
        <button onclick="nextSlide()" class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/25 text-white w-12 h-12 rounded-full border border-white/10 flex items-center justify-center backdrop-blur-md transition-all z-30 group" aria-label="Next Slide">
            <i class="fa-solid fa-arrow-right text-lg group-hover:translate-x-0.5 transition-transform"></i>
        </button>

        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3 z-30" id="carousel-dots">
            <button onclick="jumpToSlide(0)" class="w-10 h-2 bg-white rounded-full transition-all" data-dot="0"></button>
            <button onclick="jumpToSlide(1)" class="w-3 h-2 bg-white/40 hover:bg-white/80 rounded-full transition-all" data-dot="1"></button>
            <button onclick="jumpToSlide(2)" class="w-3 h-2 bg-white/40 hover:bg-white/80 rounded-full transition-all" data-dot="2"></button>
        </div>
    </header>

    <div class="bg-white py-8 border-b border-slate-100 shadow-sm relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-4 divide-y md:divide-y-0 md:divide-x divide-slate-100">
                <div class="flex items-center gap-4 px-2 py-4 md:py-0">
                    <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600">
                        <i class="fa-solid fa-star text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-2xl font-black text-slate-900 leading-none">4.9 / 5</span>
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Patient Rating</span>
                    </div>
                </div>
                <div class="flex items-center gap-4 px-2 md:pl-6 py-4 md:py-0">
                    <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600">
                        <i class="fa-solid fa-user-doctor text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-2xl font-black text-slate-900 leading-none">15+</span>
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Top Specialists</span>
                    </div>
                </div>
                <div class="flex items-center gap-4 px-2 md:pl-6 py-4 md:py-0">
                    <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600">
                        <i class="fa-solid fa-hospital-user text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-2xl font-black text-slate-900 leading-none">12K+</span>
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Happy Patients</span>
                    </div>
                </div>
                <div class="flex items-center gap-4 px-2 md:pl-6 py-4 md:py-0">
                    <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600">
                        <i class="fa-solid fa-clock text-xl"></i>
                    </div>
                    <div>
                        <span class="block text-2xl font-black text-slate-900 leading-none">15 Min</span>
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Max Wait Time</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="services" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-extrabold text-primary-600 uppercase tracking-wider bg-primary-50 px-3 py-1.5 rounded-full">Outstanding Clinic Portfolio</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-3 tracking-tight">Our Professional Services</h2>
                <div class="w-16 h-1 bg-primary-500 mx-auto mt-4 rounded-full"></div>
                <p class="text-slate-500 mt-4 leading-relaxed">We offer tailored solutions designed for continuous preventative, aesthetic, and therapeutic care.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div onclick="selectService('Prosthodontics')" class="group bg-slate-50 hover:bg-white rounded-3xl p-8 border border-slate-100 hover:border-primary-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer">
                    <div class="w-14 h-14 bg-primary-50 group-hover:bg-primary-500 rounded-2xl flex items-center justify-center text-primary-600 group-hover:text-white mb-6 shadow-sm transition-all duration-300">
                        <i class="fa-solid fa-tooth text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary-600 transition-colors">Prosthodontics</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Prosthodontics focuses on the restoration and replacement of missing or damaged teeth to improve oral function and comfort.
                    It utilizes advanced treatments such as crowns, bridges, dentures, and dental implants. This specialty aims to restore both the integrity and aesthetics of a patient’s smile.</p>
                    <div class="flex items-center justify-between text-xs font-bold text-slate-400 group-hover:text-primary-600 transition-colors">
                        <span>Includes: Dental Crowns, Bridges, Dental Implants, Dentures, Veneers, Tooth Restorations</span>
                        <i class="fa-solid fa-arrow-right-long group-hover:translate-x-1.5 transition-transform"></i>
                    </div>
                </div>

                <div onclick="selectService('Esthetics')" class="group bg-slate-50 hover:bg-white rounded-3xl p-8 border border-slate-100 hover:border-primary-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer">
                    <div class="w-14 h-14 bg-primary-50 group-hover:bg-primary-500 rounded-2xl flex items-center justify-center text-primary-600 group-hover:text-white mb-6 shadow-sm transition-all duration-300">
                        <i class="fa-solid fa-stethoscope text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary-600 transition-colors">Esthetics</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Esthetics is dedicated to enhancing the visual appearance of teeth and overall smile harmony.
                         It involves careful attention to color, shape, alignment, and proportion.
                        The goal is to achieve a natural, balanced, and confident-looking smile.</p>
                    <div class="flex items-center justify-between text-xs font-bold text-slate-400 group-hover:text-primary-600 transition-colors">
                        <span>Includes: Teeth Whitening, Dental Veeners, Smile Makeover, Tooth Reshaping/ Contouring, Gum Contouring, Polishing and Cleaning</span>
                        <i class="fa-solid fa-arrow-right-long group-hover:translate-x-1.5 transition-transform"></i>
                    </div>
                </div>

                <div onclick="selectService('Cosmetic Surgery')" class="group bg-slate-50 hover:bg-white rounded-3xl p-8 border border-slate-100 hover:border-primary-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer">
                    <div class="w-14 h-14 bg-primary-50 group-hover:bg-primary-500 rounded-2xl flex items-center justify-center text-primary-600 group-hover:text-white mb-6 shadow-sm transition-all duration-300">
                        <i class="fa-solid fa-wand-magic-sparkles text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary-600 transition-colors">Cosmetic Surgery</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Cosmetic Surgery involves procedures designed to refine and enhance facial features for improved appearance.
                        It focuses on achieving facial balance, symmetry, and overall aesthetic harmony.
                        These treatments can significantly boost self-confidence and personal well-being.</p>
                    <div class="flex items-center justify-between text-xs font-bold text-slate-400 group-hover:text-primary-600 transition-colors">
                        <span>Includes: Botox Treatments, Dermal Fillers, Lip Enhancements, Facial Contouring, Minor  Surgical Aesthetic Procedures</span>
                        <i class="fa-solid fa-arrow-right-long group-hover:translate-x-1.5 transition-transform"></i>
                    </div>


                </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div onclick="selectService('Endodontics')" class="group bg-slate-50 hover:bg-white rounded-3xl p-8 border border-slate-100 hover:border-primary-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer">
                    <div class="w-14 h-14 bg-primary-50 group-hover:bg-primary-500 rounded-2xl flex items-center justify-center text-primary-600 group-hover:text-white mb-6 shadow-sm transition-all duration-300">
                        <i class="fa-solid fa-tooth text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary-600 transition-colors">Endodontics</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Endodontics specializes in the diagnosis and treatment of conditions affecting the dental pulp and inner structures of the tooth.
                        Procedures such as root canal therapy are performed to eliminate infection and preserve natural teeth.
                        This field plays a vital role in maintaining long-term oral health and function.</p>
                    <div class="flex items-center justify-between text-xs font-bold text-slate-400 group-hover:text-primary-600 transition-colors">
                        <span>Includes: Root Canal Treatment, Retreatment of Root Canals, Treatment of Infection, Therapy, Abscess Management</span>
                        <i class="fa-solid fa-arrow-right-long group-hover:translate-x-1.5 transition-transform"></i>
                    </div>
                </div>


            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div onclick="selectService('Orthodontics')" class="group bg-slate-50 hover:bg-white rounded-3xl p-8 border border-slate-100 hover:border-primary-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 cursor-pointer">
                    <div class="w-14 h-14 bg-primary-50 group-hover:bg-primary-500 rounded-2xl flex items-center justify-center text-primary-600 group-hover:text-white mb-6 shadow-sm transition-all duration-300">
                        <i class="fa-solid fa-tooth text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary-600 transition-colors">Orthodontics</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">Orthodontics focuses on correcting misaligned teeth and jaws to improve both function and appearance.
                        Treatment options include traditional braces, clear aligners, and other corrective devices.
                        Proper orthodontic care can significantly enhance your smile and overall oral health.</p>
                    <div class="flex items-center justify-between text-xs font-bold text-slate-400 group-hover:text-primary-600 transition-colors">
                        <span>Includes: Braces, Clear Aligners, Retainers, Bite Correction, Teeth Straightening</span>
                        <i class="fa-solid fa-arrow-right-long group-hover:translate-x-1.5 transition-transform"></i>
                    </div>
                </div>
        </div>
    </section>

     <section id="about-dev" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-pink-600 font-bold tracking-widest uppercase text-xs mb-4">Our Dentists</h2>
                <h2 class="text-4xl lg:text-5xl font-extrabold text-slate-900 mb-4">The Dentist Behind the Smile</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">Meet the skilled professionals who are dedicated to providing exceptional dental care and creating beautiful smiles.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="dev-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-100">
                    <div class="aspect-square overflow-hidden bg-slate-200">
                        <img src="{{ asset('images/dentist 1.jpg') }}" alt="Dentist 1" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-slate-900">Dentist 1</h4>
                        <p class="text-pink-600 text-sm font-semibold mb-3 uppercase tracking-wider">Orthodontics</p>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">I focused on correcting misaligned teeth and jaws to improve both oral health and the appearance of a person’s smile.</p>

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
                        <img src="{{ asset('images/dentist 2.jpg') }}" alt="Dentist 2" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-slate-900">Dentist 2</h4>
                        <p class="text-pink-600 text-sm font-semibold mb-3 uppercase tracking-wider">Prosthodontics</p>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">
                           I restores missing or damaged teeth using crowns, bridges, and dentures.
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
                        <img src="{{ asset('images/dentist3.jpg') }}" alt="Dentist 3" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-slate-900">Dentist 3</h4>
                        <p class="text-pink-600 text-sm font-semibold mb-3 uppercase tracking-wider">Esthetics</p>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">
                           I focuses on improving the appearance of teeth and creating a beautiful smile.
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
                        <img src="{{ asset('images/dentist 4.jpg') }}" alt="Dentist 4" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-slate-900">Dentist 4</h4>
                        <p class="text-pink-600 text-sm font-semibold mb-3 uppercase tracking-wider">Cosmetic Surgery</p>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">
                           I enhances facial features to improve overall appearance and confidence.
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
                        <img src="{{ asset('images/dentist 5.jpg') }}" alt="Dentist 5" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-slate-900">Dentist 5</h4>
                        <p class="text-pink-600 text-sm font-semibold mb-3 uppercase tracking-wider">Endodontics</p>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6"> I treats the inside of the tooth, especially through procedures like root canals.</p>

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

    <div id="login-modal" class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl relative border border-slate-100">
            <button onclick="closeModal('login-modal')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 text-lg"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-2">Welcome Back</h3>
            <p class="text-xs text-slate-400 mb-6">Access your digital clinic dashboard logs seamlessly.</p>
            <form onsubmit="handleLogin(event)" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Email Address</label>
                    <input type="email" id="login-email" required placeholder="mark@example.com" class="w-full p-3.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Security Password</label>
                    <input type="password" id="login-password" required placeholder="••••••••" class="w-full p-3.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold p-4 rounded-xl shadow-lg shadow-primary-600/20 transition-all text-sm">Authenticate Account</button>
            </form>
        </div>
    </div>

    <div id="signup-modal" class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl relative border border-slate-100">
            <button onclick="closeModal('signup-modal')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 text-lg"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-2">Create Clinic Account</h3>
            <p class="text-xs text-slate-400 mb-6">Register to control schedules and monitor dental treatments.</p>
            <form onsubmit="handleSignup(event)" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Full Legal Name</label>
                    <input type="text" id="signup-name" required placeholder="Mark Andrew Gella" class="w-full p-3.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Email Address</label>
                    <input type="email" id="signup-email" required placeholder="mark@example.com" class="w-full p-3.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Password</label>
                    <input type="password" id="signup-password" required placeholder="••••••••" class="w-full p-3.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                </div>
                <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold p-4 rounded-xl shadow-lg transition-all text-sm">Register Account</button>
            </form>
        </div>
    </div>

    <footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800 mt-auto text-center text-sm">
        <p>&copy; 2026 Shine & Smile Family Clinic. All Rights Reserved.</p>
    </footer>

    <script>
        // --- State Management ---
        let currentUser = null;
        let activeAppointment = null;
        let currentSlideIndex = 0;
        const totalSlides = 3;
        let mapInstance = null;

        // --- Core Page Load Event Handlers ---
        window.addEventListener('DOMContentLoaded', () => {
            initCarouselAutoplay();
            initLeafletMap();
            checkLocalSession();
        });

        // --- Leaflet Map Configuration ---
        function initLeafletMap() {
            try {
                // Centered around Norala, South Cotabato
                mapInstance = L.map('map').setView([11.4882, 122.7538], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(mapInstance);

                L.marker([11.4882, 122.7538]).addTo(mapInstance)
                    .bindPopup('<b>Shine & Smile Clinic</b><br>Premium Family Healthcare.')
                    .openPopup();
            } catch (error) {
                console.error("Map loading failure: ", error);
            }
        }

        // --- Session Cache Logics ---
        function checkLocalSession() {
            const cachedUser = localStorage.getItem('shine_user');
            const cachedBooking = localStorage.getItem('shine_booking');
            if(cachedUser) {
                currentUser = JSON.parse(cachedUser);
                updateAuthVisualInterfaces();
            }
            if(cachedBooking) {
                activeAppointment = JSON.parse(cachedBooking);
                updateDashboardDisplay();
            }
        }

        // --- Responsive Mobile Drawer Toggle Logics ---
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const icon = document.getElementById('mobile-menu-icon');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                icon.className = "fa-solid fa-xmark text-2xl";
            } else {
                menu.classList.add('hidden');
                icon.className = "fa-solid fa-bars text-2xl";
            }
        }

        // --- Toast System Event Handlers ---
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `pointer-events-auto flex items-center gap-3 bg-white border-l-4 ${type === 'success' ? 'border-primary-500' : 'border-rose-500'} p-4 rounded-xl shadow-xl transition-all duration-300 translate-y-4 opacity-0 max-w-sm`;

            const icon = type === 'success' ? 'fa-circle-check text-primary-500' : 'fa-circle-exclamation text-rose-500';
            toast.innerHTML = `
                <i class="fa-solid ${icon} text-lg"></i>
                <p class="text-xs font-semibold text-slate-700">${message}</p>
            `;
            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('translate-y-4', 'opacity-0');
            }, 50);

            setTimeout(() => {
                toast.classList.add('translate-y-4', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        // --- Modal Control Functions ---
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        // --- Authentication Event Actions ---
        function handleSignup(e) {
            e.preventDefault();
            const name = document.getElementById('signup-name').value;
            const email = document.getElementById('signup-email').value;

            currentUser = { name, email };
            localStorage.setItem('shine_user', JSON.stringify(currentUser));

            closeModal('signup-modal');
            updateAuthVisualInterfaces();
            showToast(`Welcome Account Registration Successful, ${name}!`);
        }

        function handleLogin(e) {
            e.preventDefault();
            const email = document.getElementById('login-email').value;
            const fallbackName = email.split('@')[0];

            currentUser = { name: fallbackName.toUpperCase(), email };
            localStorage.setItem('shine_user', JSON.stringify(currentUser));

            closeModal('login-modal');
            updateAuthVisualInterfaces();
            showToast(`Authenticated Successfully! Welcome back.`);
        }

        function logout() {
            currentUser = null;
            localStorage.removeItem('shine_user');
            updateAuthVisualInterfaces();
            showToast("Session disconnected gracefully.");
        }

        function updateAuthVisualInterfaces() {
            const guestD = document.getElementById('guest-buttons');
            const userD = document.getElementById('user-profile');
            const guestM = document.getElementById('mobile-guest-buttons');
            const userM = document.getElementById('mobile-user-profile');
            const badge = document.getElementById('dashboard-user-badge');

            if(currentUser) {
                guestD.classList.add('hidden'); userD.classList.remove('hidden');
                guestM.classList.add('hidden'); userM.classList.remove('hidden');
                badge.className = "bg-primary-100 text-primary-800 text-xs font-bold px-3 py-1 rounded-full";
                badge.innerText = "Verified Profile";

                document.getElementById('user-name').innerText = currentUser.name;
                document.getElementById('user-avatar').innerText = currentUser.name.charAt(0).toUpperCase();
                document.getElementById('mobile-user-name').innerText = currentUser.name;
                document.getElementById('mobile-user-avatar').innerText = currentUser.name.charAt(0).toUpperCase();

                // Prefill booking input if blank
                if(!document.getElementById('booking-fullname').value) {
                    document.getElementById('booking-fullname').value = currentUser.name;
                }
            } else {
                guestD.classList.remove('hidden'); userD.classList.add('hidden');
                guestM.classList.remove('hidden'); userM.classList.add('hidden');
                badge.className = "bg-slate-100 text-slate-600 text-xs font-bold px-3 py-1 rounded-full";
                badge.innerText = "Guest Mode";
            }
        }

        // --- Image Slider Carousel Logics ---
        function initCarouselAutoplay() {
            setInterval(() => nextSlide(), 6000);
        }

        function updateCarouselDisplay() {
            const items = document.querySelectorAll('.carousel-item');
            const dots = document.querySelectorAll('#carousel-dots button');

            items.forEach((item, index) => {
                if(index === currentSlideIndex) {
                    item.classList.remove('opacity-0', 'scale-95');
                    item.classList.add('opacity-100', 'scale-100', 'z-10');
                } else {
                    item.classList.remove('opacity-100', 'scale-100', 'z-10');
                    item.classList.add('opacity-0', 'scale-95');
                }
            });

            dots.forEach((dot, index) => {
                if(index === currentSlideIndex) {
                    dot.className = "w-10 h-2 bg-white rounded-full transition-all duration-300";
                } else {
                    dot.className = "w-3 h-2 bg-white/40 hover:bg-white/80 rounded-full transition-all duration-300";
                }
            });
        }

        function nextSlide() {
            currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
            updateCarouselDisplay();
        }
        function prevSlide() {
            currentSlideIndex = (currentSlideIndex - 1 + totalSlides) % totalSlides;
            updateCarouselDisplay();
        }
        function jumpToSlide(index) {
            currentSlideIndex = index;
            updateCarouselDisplay();
        }

        // --- Multi-Step Booking Wizard Layout Logics ---
        function selectService(serviceName) {
            document.getElementById('booking-service').value = serviceName;
            goToStep(2);
            document.getElementById('booking-section').scrollIntoView({ behavior: 'smooth' });
        }

        function goToStep(stepNumber) {
            // Validate step inputs before progressing
            if(stepNumber === 2 && !document.getElementById('booking-service').value) {
                showToast("Please choose a valid treatment clinic service portfolio option.", "error");
                return;
            }
            if(stepNumber === 3 && !document.getElementById('booking-date').value) {
                showToast("Please choose a target assessment execution date.", "error");
                return;
            }

            // Hide all steps
            document.getElementById('step-form-1').classList.add('hidden');
            document.getElementById('step-form-2').classList.add('hidden');
            document.getElementById('step-form-3').classList.add('hidden');

            // Show active step
            document.getElementById(`step-form-${stepNumber}`).classList.remove('hidden');

            // Update Wizard Progression Timeline
            updateWizardTimelineUI(stepNumber);
        }

        function updateWizardTimelineUI(step) {
            const s2Num = document.getElementById('num-step-2');
            const s2Txt = document.getElementById('txt-step-2');
            const s3Num = document.getElementById('num-step-3');
            const s3Txt = document.getElementById('txt-step-3');
            const line1 = document.getElementById('line-step-1');
            const line2 = document.getElementById('line-step-2');

            if(step >= 2) {
                document.getElementById('step-ind-2').classList.remove('opacity-50');
                s2Num.className = "w-8 h-8 rounded-full bg-primary-600 text-white font-bold flex items-center justify-center text-sm";
                s2Txt.className = "text-sm font-bold text-slate-800";
                line1.classList.add('bg-primary-500');
            } else {
                document.getElementById('step-ind-2').classList.add('opacity-50');
                s2Num.className = "w-8 h-8 rounded-full bg-slate-200 text-slate-600 font-bold flex items-center justify-center text-sm";
                s2Txt.className = "text-sm font-semibold text-slate-500";
                line1.classList.remove('bg-primary-500');
            }

            if(step === 3) {
                document.getElementById('step-ind-3').classList.remove('opacity-50');
                s3Num.className = "w-8 h-8 rounded-full bg-primary-600 text-white font-bold flex items-center justify-center text-sm";
                s3Txt.className = "text-sm font-bold text-slate-800";
                line2.classList.add('bg-primary-500');
            } else {
                document.getElementById('step-ind-3').classList.add('opacity-50');
                s3Num.className = "w-8 h-8 rounded-full bg-slate-200 text-slate-600 font-bold flex items-center justify-center text-sm";
                s3Txt.className = "text-sm font-semibold text-slate-500";
                line2.classList.remove('bg-primary-500');
            }
        }

        // --- Appointment Form Submission & Dashboard Management ---
        function handleBookingSubmit(e) {
            e.preventDefault();
            const service = document.getElementById('booking-service').value;
            const date = document.getElementById('booking-date').value;
            const time = document.getElementById('booking-time').value;
            const name = document.getElementById('booking-fullname').value;
            const phone = document.getElementById('booking-phone').value;

            if(!name || !phone) {
                showToast("Please provide required details.", "error");
                return;
            }

            activeAppointment = { service, date, time, name, phone };
            localStorage.setItem('shine_booking', JSON.stringify(activeAppointment));

            updateDashboardDisplay();
            showToast("Success! Your booking reservation is locked.");

            // Reset Wizard to step 1
            document.getElementById('wizard-form').reset();
            goToStep(1);
        }

        function updateDashboardDisplay() {
            const emptyState = document.getElementById('dashboard-empty');
            const contentState = document.getElementById('dashboard-content');

            if(activeAppointment) {
                emptyState.classList.add('hidden');
                contentState.classList.remove('hidden');

                document.getElementById('dash-service').innerText = activeAppointment.service;
                document.getElementById('dash-date').innerText = activeAppointment.date;
                document.getElementById('dash-time').innerText = activeAppointment.time;
                document.getElementById('dash-name').innerText = activeAppointment.name;
            } else {
                emptyState.classList.remove('hidden');
                contentState.classList.add('hidden');
            }
        }

        function cancelBooking() {
            activeAppointment = null;
            localStorage.removeItem('shine_booking');
            updateDashboardDisplay();
            showToast("Treatment cancellation processing completed.", "error");
        }

        function toggleDashboard() {
            document.getElementById('booking-section').scrollIntoView({ behavior: 'smooth' });
            showToast("Navigated to Live Monitoring Schedule Panels Dashboard.");
        }
    </script>
</body>
</html>
