<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shine & Smile Dental | Creating Healthy, Beautiful Smiles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/appointment.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-white text-[#2D2D2D]">

<nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md shadow-sm">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <div class="text-2xl font-bold text-[#E91E63]">
            Shine & Smile
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex space-x-8 font-medium">
            <a href="#home" class="hover:text-[#E91E63] transition">Home</a>
            <a href="#services" class="hover:text-[#E91E63] transition">Services</a>
            <a href="#about" class="hover:text-[#E91E63] transition">About Us</a>
            <a href="#testimonials" class="hover:text-[#E91E63] transition">Testimonials</a>
            <a href="#FAQs" class="hover:text-[#E91E63] transition">FAQs</a>
            <a href="#location" class="hover:text-[#E91E63] transition">Location</a>
            <a href="#contact" class="hover:text-[#E91E63] transition">Contact</a>
        </div>

        <!-- Login & Sign Up -->
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}"
            class="bg-[#E91E63] border-2 border-[#E91E63] text-white px-5 py-2 rounded-full font-medium hover:bg-[#D81B60] hover:border-[#D81B60] transition">
                Login
            </a>

        </div>

    </div>
</nav>

    <section id = "home"class= "pt-32 pb-20 bg-pink-gradient">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">Creating Healthy, Beautiful Smiles Every Day</h1>
                <p class="text-lg mb-8 text-gray-600">Experience exceptional dental care with a team dedicated to your comfort, confidence, and oral health.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#contact" class="bg-[#E91E63] text-white px-8 py-4 rounded-full font-semibold hover:shadow-lg transition">Book a Consultation</a>
                    <a href="#contact" class="border-2 border-[#E91E63] text-[#E91E63] px-8 py-4 rounded-full font-semibold hover:bg-[#FCE4EC] transition">Contact Us</a>
                </div>
            </div>
            <div class="relative">
                <img src="{{asset ('images/FriendlyDentists.jpg') }}" alt="Dentist" class="rounded-3xl shadow-2xl">
                <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-2xl shadow-xl hidden md:block">
                    <p class="font-bold text-[#E91E63]">✓ 15+ Years Experience</p>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="py-20">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl text-center mb-16">Our Premium Services</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Service Cards -->
                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition border border-gray-100">
                    <div class="w-12 h-12 bg-[#FCE4EC] rounded-full flex items-center justify-center mb-4 text-[#E91E63]">🦷</div>
                    <h3 class="text-xl mb-2"> Cosmetic Surgery</h3>
                    <p class="text-sm text-gray-500">Enhance the appearance of your smile with advanced cosmetic dental procedures designed for confidence and aesthetics.</p>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition border border-gray-100">
                    <div class="w-12 h-12 bg-[#FCE4EC] rounded-full flex items-center justify-center mb-4 text-[#E91E63]">✨</div>
                    <h3 class="text-xl mb-2">Endodontics</h3>
                    <p class="text-sm text-gray-500">Specialized treatment for the inner parts of your teeth.</p>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition border border-gray-100">
                    <div class="w-12 h-12 bg-[#FCE4EC] rounded-full flex items-center justify-center mb-4 text-[#E91E63]">✨</div>
                    <h3 class="text-xl mb-2">Esthetics</h3>
                    <p class="text-sm text-gray-500">Achieve a brighter and more attractive smile through veneers, whitening, bonding, and other aesthetic treatments.
                    </p>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition border border-gray-100">
                    <div class="w-12 h-12 bg-[#FCE4EC] rounded-full flex items-center justify-center mb-4 text-[#E91E63]">💎</div>
                    <h3 class="text-xl mb-2">Oral Surgery</h3>
                    <p class="text-sm text-gray-500">Expert surgical procedures including tooth extractions, wisdom tooth removal, and treatment of oral conditions.</p>
                </div>

                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition border border-gray-100">
                    <div class="w-12 h-12 bg-[#FCE4EC] rounded-full flex items-center justify-center mb-4 text-[#E91E63]">🪥</div>
                    <h3 class="text-xl mb-2">Orthodontics</h3>
                    <p class="text-sm text-gray-500">Straighten teeth and improve bite alignment with modern braces and orthodontic treatment solutions.
    </p>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition border border-gray-100">
                    <div class="w-12 h-12 bg-[#FCE4EC] rounded-full flex items-center justify-center mb-4 text-[#E91E63]">🦷</div>
                    <h3 class="text-xl mb-2">Prosthodontics</h3>
                    <p class="text-sm text-gray-500">Restore missing or damaged teeth with crowns, bridges, dentures, and dental implants for a complete smile.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-20 bg-[#FCE4EC]">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl mb-6">Why Shine & Smile?</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">At Shine & Smile Dental, we are committed to delivering exceptional dental care in a warm and welcoming environment. Our experienced team combines advanced technology with personalized treatment to help every patient achieve a healthy, confident smile.</p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3">✅ <span class="font-medium">Experienced Dental Team</span></li>
                        <li class="flex items-center gap-3">✅ <span class="font-medium">Advanced Dental Technology</span></li>
                        <li class="flex items-center gap-3">✅ <span class="font-medium">Personalized Treatment Plans</span></li>
                    </ul>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <img src="{{asset('images/clinic.jpg')}}" class="rounded-2xl" alt="Clinic Interior">
                    <img src="{{asset('images/whyus.jpg')}}" class="rounded-2xl mt-8" alt="Team">
                </div>
            </div>
        </div>
    </section>

<section id="testimonials" class="py-20 bg-[#FFF5F8]">

    <div class="container mx-auto px-6">

        <!-- Section Header -->
        <div class="text-center mb-16">
            <p class="text-[#E91E63] font-semibold uppercase tracking-wider mb-2">
                Testimonials
            </p>

            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                What Our Patients Say
            </h2>

            <p class="text-gray-500 max-w-2xl mx-auto">
                We are proud to provide exceptional dental care and create beautiful smiles for our patients.
            </p>
        </div>

        <!-- Testimonial Cards -->
        <div class="grid md:grid-cols-3 gap-8">

            <!-- Testimonial 1 -->
            <div class="bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition">
                <div class="flex text-yellow-400 mb-4">
                    ⭐⭐⭐⭐⭐
                </div>

                <p class="text-gray-600 mb-6 italic">
                    "The staff were incredibly friendly and professional. My dental cleaning was painless and comfortable. Highly recommended!"
                </p>

                <div class="flex items-center gap-4">
                    <img src="{{asset('images/testimonialimg.jpg')}}"
                         class="w-14 h-14 rounded-full"
                         alt="Patient">

                    <div>
                        <h4 class="font-bold">Anna Santos</h4>
                        <p class="text-sm text-gray-500">Patient</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition">
                <div class="flex text-yellow-400 mb-4">
                    ⭐⭐⭐⭐⭐
                </div>

                <p class="text-gray-600 mb-6 italic">
                    "I had my teeth whitening done here and the results were amazing. The clinic is modern, clean, and welcoming."
                </p>

                <div class="flex items-center gap-4">
                    <img src="{{asset('images/test2.jpg')}}"
                         class="w-14 h-14 rounded-full"
                         alt="Patient">

                    <div>
                        <h4 class="font-bold">Mark Reyes</h4>
                        <p class="text-sm text-gray-500">Patient</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition">
                <div class="flex text-yellow-400 mb-4">
                    ⭐⭐⭐⭐⭐
                </div>

                <p class="text-gray-600 mb-6 italic">
                    "Excellent service and caring dentists. They explained every procedure clearly and made me feel at ease."
                </p>

                <div class="flex items-center gap-4">
                    <img src="{{asset('images/test3.jpg')}}"
                         class="w-14 h-14 rounded-full"
                         alt="Patient">

                    <div>
                        <h4 class="font-bold">John Dela Cruz</h4>
                        <p class="text-sm text-gray-500">Patient</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Stats -->
        <div class="grid md:grid-cols-4 gap-6 mt-16">

            <div class="bg-white p-6 rounded-2xl text-center shadow">
                <h3 class="text-3xl font-bold text-[#E91E63]">5000+</h3>
                <p class="text-gray-500">Happy Patients</p>
            </div>

            <div class="bg-white p-6 rounded-2xl text-center shadow">
                <h3 class="text-3xl font-bold text-[#E91E63]">15+</h3>
                <p class="text-gray-500">Years Experience</p>
            </div>

            <div class="bg-white p-6 rounded-2xl text-center shadow">
                <h3 class="text-3xl font-bold text-[#E91E63]">98%</h3>
                <p class="text-gray-500">Patient Satisfaction</p>
            </div>

            <div class="bg-white p-6 rounded-2xl text-center shadow">
                <h3 class="text-3xl font-bold text-[#E91E63]">100+</h3>
                <p class="text-gray-500">Monthly Appointments</p>
            </div>

        </div>

    </div>

</section>

<section id ="FAQs" class="py-20">
        <div class="container mx-auto px-6 max-w-3xl">
            <h2 class="text-4xl text-center mb-12">Frequently Asked Questions</h2>
            <div class="space-y-4">

                <div class="border rounded-xl">
    <button onclick="toggleFaq(this)" class="w-full text-left p-6 font-semibold flex justify-between">
        How often should I visit the dentist?
        <span>+</span>
    </button>
    <div class="hidden p-6 pt-0 text-gray-600">
        We recommend visiting the dentist every six months for regular check-ups and professional cleaning.
    </div>
</div>

<div class="border rounded-xl">
    <button onclick="toggleFaq(this)" class="w-full text-left p-6 font-semibold flex justify-between">
        Is teeth whitening safe?
        <span>+</span>
    </button>
    <div class="hidden p-6 pt-0 text-gray-600">
        Yes, professional teeth whitening is safe and effective when performed by qualified dental professionals.
    </div>
</div>

<div class="border rounded-xl">
    <button onclick="toggleFaq(this)" class="w-full text-left p-6 font-semibold flex justify-between">
        Do you treat children?
        <span>+</span>
    </button>
    <div class="hidden p-6 pt-0 text-gray-600">
        Yes, we provide gentle and friendly dental care for children of all ages.
    </div>
</div>

<div class="border rounded-xl">
    <button onclick="toggleFaq(this)" class="w-full text-left p-6 font-semibold flex justify-between">
        Can I book an appointment online?
        <span>+</span>
    </button>
    <div class="hidden p-6 pt-0 text-gray-600">
        Yes, our online appointment system allows you to schedule appointments anytime at your convenience.
    </div>
</div>

<div class="border rounded-xl">
    <button onclick="toggleFaq(this)" class="w-full text-left p-6 font-semibold flex justify-between">
        What payment methods do you accept?
        <span>+</span>
    </button>
    <div class="hidden p-6 pt-0 text-gray-600">
        We accept cash, debit cards, credit cards, and selected digital payment methods.
    </div>
</div>

<div class="border rounded-xl">
    <button onclick="toggleFaq(this)" class="w-full text-left p-6 font-semibold flex justify-between">
        What should I do during a dental emergency?
        <span>+</span>
    </button>
    <div class="hidden p-6 pt-0 text-gray-600">
        Contact our clinic immediately so we can provide guidance and arrange urgent treatment if needed.
    </div>
</div>

            </div>
        </div>
    </section>

<section id="location" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-pink-600 font-bold tracking-widest uppercase text-xs mb-4">Our Flagship Clinic</h2>
                <h2 class="text-4xl lg:text-5xl font-extrabold text-slate-900 mb-4">Visit us in the Crown City of the South</h2>
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
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d256354.9240519452!2d124.58331667902091!3d6.489816879239853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f818eb3b42365f%3A0xdeeaa89b952730b5!2sShine%20%26%20Smile%20Dental%20Clinic!5e1!3m2!1sen!2sph!4v1780745828224!5m2!1sen!2sph"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen
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

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
    <script src="{{ asset('js/appointment.js') }}"></script>
</body>
</html>
