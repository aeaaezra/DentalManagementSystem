<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shine & Smile Dental | Your Smile. Our Technology.</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- New, self-contained assets for this page only. --}}
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="ss-body">

@if(session('success'))
    <div class="ss-alert ss-alert--success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="ss-alert ss-alert--error">{{ session('error') }}</div>
@endif

<nav id="ssNav" class="ss-nav">
    <div class="ss-container ss-nav-row">

        <a href="#home" class="ss-nav-logo">Shine & Smile</a>

        <div class="ss-nav-links">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#doctors">Doctors</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="ss-nav-actions">
            <a href="{{ route('appointments.login') }}" class="ss-btn ss-btn--ghost ss-btn--sm">Login</a>

            <button
                id="ssBurger"
                type="button"
                class="ss-burger"
                aria-label="Open menu"
                aria-expanded="false"
                aria-controls="ssMobilePanel"
            >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

    </div>
</nav>

{{-- Mobile fullscreen menu --}}
<div id="ssMobilePanel" class="ss-mobile-panel">
    <button id="ssMobileClose" type="button" class="ss-btn ss-btn--ghost ss-btn--sm" style="align-self:flex-end;" aria-label="Close menu">Close</button>
    <a href="#home">Home</a>
    <a href="#about">About</a>
    <a href="#services">Services</a>
    <a href="#doctors">Doctors</a>
    <a href="#contact">Contact</a>
    <a href="{{ route('appointments.login') }}">Login</a>
</div>

{{-- ==========================================================
     HERO
========================================================== --}}

<section id="home" class="ss-hero">
    <div class="ss-hero-media">
        <img src="{{ asset('images/FriendlyDentists.jpg') }}" alt="A dentist at Shine & Smile treating a patient in a modern clinic">
    </div>

    <div class="ss-hero-content">
        <span class="ss-hero-eyebrow">Shine & Smile Dental Clinic</span>

        <h1 class="ss-hero-title">
            <span>Your Smile.</span>
            <span class="is-accent">Our Technology.</span>
        </h1>

        <p class="ss-hero-sub">
            Experience smarter, simpler, and more connected dental care — from booking to treatment, all in one place.
        </p>

        <div class="ss-hero-actions">
            <a href="{{ route('appointments.create') }}" class="ss-btn ss-btn--solid">Book an Appointment</a>
            <a href="{{ route('appointments.login') }}" class="ss-btn ss-btn--ghost">Login</a>
        </div>
    </div>

    <div class="ss-scroll-cue" aria-hidden="true">
        <span>Scroll to Explore</span>
        <div class="ss-scroll-line"></div>
    </div>
</section>

{{-- ==========================================================
     ABOUT
========================================================== --}}

<section id="about" class="ss-section ss-section--void">
    <div class="ss-container ss-about-grid">

        <div class="ss-about-media ss-reveal ss-reveal--scale">
            <img src="{{ asset('images/clinic.jpg') }}" alt="Interior of the Shine & Smile dental clinic">
        </div>

        <div class="ss-about-text">
            <div class="ss-eyebrow-row ss-reveal">
                <span class="ss-rule"></span>
                <span class="ss-label">01 / About</span>
            </div>

            <h2 class="ss-heading ss-section-heading ss-reveal">The Future of Dental Care</h2>

            <p class="ss-reveal">
                Shine & Smile Dental Management System brings patients, dentists, and clinic staff together
                through one intelligent platform — replacing paper charts and phone-tag scheduling with a
                connected experience built around your care.
            </p>

            <p class="ss-reveal">
                From the moment you book to the moment you leave the chair, every step is tracked, recorded,
                and ready when you need it.
            </p>
        </div>

    </div>
</section>

{{-- ==========================================================
     SERVICES
========================================================== --}}

<section id="services" class="ss-section ss-section--charcoal">
    <div class="ss-container">

        <div class="ss-eyebrow-row ss-reveal">
            <span class="ss-rule"></span>
            <span class="ss-label">02 / Services</span>
        </div>

        <h2 class="ss-heading ss-section-heading ss-reveal">Our Services</h2>

        <div class="ss-services-grid">
            @php
                $services = [
                    ['01', 'General Dentistry', 'Routine exams, cleanings, and preventive care to keep every visit simple.'],
                    ['02', 'Orthodontics', 'Braces and alignment plans built around your bite and your timeline.'],
                    ['03', 'Dental Cleaning', 'Professional cleaning that clears plaque and tartar beyond daily brushing.'],
                    ['04', 'Restorative Dentistry', 'Fillings, crowns, and repairs that bring damaged teeth back to full function.'],
                    ['05', 'Endodontics', 'Root canal therapy focused on saving teeth and easing pain fast.'],
                    ['06', 'Prosthodontics', 'Bridges, dentures, and implants for a complete, confident smile.'],
                    ['07', 'Oral Surgery', 'Extractions and surgical care handled with precision and comfort in mind.'],
                    ['08', 'Cosmetic Dentistry', 'Whitening, veneers, and bonding designed around how you want to smile.'],
                ];
            @endphp

            @foreach($services as $service)
                <div class="ss-service-card ss-reveal" tabindex="0">
                    <span class="ss-service-num">{{ $service[0] }}</span>
                    <div>
                        <h3 class="ss-service-name">{{ $service[1] }}</h3>
                        <p class="ss-service-desc">{{ $service[2] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ==========================================================
     APPOINTMENT CTA BAND
========================================================== --}}

<section class="ss-cta-band">
    <div class="ss-cta-media">
        <img src="{{ asset('images/whyus.jpg') }}" alt="Shine & Smile dental team">
    </div>

    <div class="ss-container ss-cta-content">
        <h2 class="ss-heading ss-cta-title ss-reveal">
            <span>Ready to</span>
            <span class="is-accent">Shine?</span>
        </h2>
        <p class="ss-reveal">Book your dental appointment in just a few steps.</p>
        <a href="{{ route('appointments.create') }}" class="ss-btn ss-btn--solid ss-reveal">Book an Appointment</a>
    </div>
</section>

{{-- ==========================================================
     HOW IT WORKS
========================================================== --}}

<section class="ss-section ss-section--void">
    <div class="ss-container">

        <div class="ss-eyebrow-row ss-reveal">
            <span class="ss-rule"></span>
            <span class="ss-label">03 / How It Works</span>
        </div>

        <h2 class="ss-heading ss-section-heading ss-reveal">
            <span>Your Visit.</span>
            <span>Made Simple.</span>
        </h2>

        <div class="ss-timeline">
            @php
                $steps = [
                    'Choose Your Service',
                    'Choose Your Schedule',
                    'Confirm Your Appointment',
                    'Visit the Clinic',
                ];
            @endphp

            @foreach($steps as $i => $step)
                <div class="ss-timeline-step ss-reveal">
                    <span class="ss-timeline-num">{{ sprintf('%02d', $i + 1) }}</span>
                    <span class="ss-timeline-label">{{ $step }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ==========================================================
     DOCTORS

     NOTE FOR DEVELOPER: this welcome route does not currently
     receive dentist data. To show real dentists here, pass a
     $dentists collection from the controller serving this view,
     e.g. return view('welcome', ['dentists' => User::where('role','dentist')->get()]);
     using whatever fields already exist on your dentist/user model
     (name, specialization, bio, photo). Until then, this section
     renders clearly-labeled placeholder cards below.
========================================================== --}}

<section id="doctors" class="ss-section ss-section--charcoal">
    <div class="ss-container">

        <div class="ss-eyebrow-row ss-reveal">
            <span class="ss-rule"></span>
            <span class="ss-label">04 / Our Team</span>
        </div>

        <h2 class="ss-heading ss-section-heading ss-reveal">Meet Our Dentists</h2>

        <div class="ss-doctors-grid">
            @if(isset($dentists) && count($dentists))
                @foreach($dentists as $dentist)
                    <div class="ss-doctor-card ss-reveal">
                        @if(!empty($dentist->profile_picture))
                            <img src="{{ asset('storage/' . $dentist->profile_picture) }}" alt="{{ $dentist->name }}" class="ss-doctor-avatar" style="object-fit:cover;">
                        @else
                            <div class="ss-doctor-avatar">{{ strtoupper(substr($dentist->name ?? 'D', 0, 1)) }}</div>
                        @endif
                        <h3>{{ $dentist->name ?? 'Dentist' }}</h3>
                        <p class="ss-doctor-spec">{{ $dentist->specialization ?? 'General Dentistry' }}</p>
                        @if(!empty($dentist->bio))
                            <p class="ss-doctor-bio">{{ $dentist->bio }}</p>
                        @endif
                    </div>
                @endforeach
            @else
                @foreach(['Dr. Reyes' => 'General Dentistry', 'Dr. Santos' => 'Orthodontics', 'Dr. Dela Cruz' => 'Cosmetic Dentistry'] as $name => $spec)
                    <div class="ss-doctor-card ss-reveal">
                        <div class="ss-doctor-avatar">{{ substr($name, 4, 1) }}</div>
                        <h3>{{ $name }}</h3>
                        <p class="ss-doctor-spec">{{ $spec }}</p>
                        <p class="ss-doctor-bio">Profile details will appear here once dentist records are connected to this page.</p>
                    </div>
                @endforeach
            @endif
        </div>

        @if(!isset($dentists))
            <p class="ss-doctors-note ss-reveal">
                Showing placeholder profiles — connect dentist data to this view to display your real team.
            </p>
        @endif

        <div style="margin-top:2.5rem;">
            <a href="{{ route('appointments.dentists') }}" class="ss-btn ss-btn--ghost ss-reveal">View All Dentists</a>
        </div>
    </div>
</section>

{{-- ==========================================================
     TECHNOLOGY
========================================================== --}}

<section class="ss-section ss-tech">
    <div class="ss-container ss-tech-grid">

        <div>
            <div class="ss-eyebrow-row ss-reveal">
                <span class="ss-rule"></span>
                <span class="ss-label">05 / Technology</span>
            </div>

            <h2 class="ss-heading ss-section-heading ss-reveal">
                <span>Dentistry.</span>
                <span>Reimagined.</span>
            </h2>

            <div class="ss-tech-list">
                @foreach([
                    'Online appointment booking',
                    'Digital dental records',
                    'Interactive odontogram',
                    'Real-time appointment notifications',
                    'Dentist scheduling',
                    'Patient management dashboard',
                    'Secure account access',
                ] as $item)
                    <div class="ss-tech-item ss-reveal">
                        <span class="ss-tech-dot"></span>
                        <span>{{ $item }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="ss-tech-visual ss-reveal ss-reveal--scale" aria-hidden="true">
            <div class="ss-tech-crosshair">Odontogram · Records · Scheduling</div>
        </div>

    </div>
</section>

{{-- ==========================================================
     STATISTICS
========================================================== --}}

<section class="ss-section ss-section--void">
    <div class="ss-container">
        <div class="ss-stats">
            <div class="ss-reveal">
                <div class="ss-stat-num">24/7</div>
                <div class="ss-stat-label">Online Booking</div>
            </div>
            <div class="ss-reveal">
                <div class="ss-stat-num">01</div>
                <div class="ss-stat-label">Connected System</div>
            </div>
            <div class="ss-reveal">
                <div class="ss-stat-num">100%</div>
                <div class="ss-stat-label">Patient Focused</div>
            </div>
        </div>
    </div>
</section>

{{-- ==========================================================
     FAQ
========================================================== --}}

<section class="ss-section ss-section--charcoal">
    <div class="ss-container" style="max-width:820px;">

        <div class="ss-eyebrow-row ss-reveal">
            <span class="ss-rule"></span>
            <span class="ss-label">Frequently Asked</span>
        </div>

        <h2 class="ss-heading ss-section-heading ss-reveal">Questions & Answers</h2>

        <div style="margin-top:2.5rem;">
            @php
                $faqs = [
                    ['How often should I visit the dentist?', 'We recommend visiting the dentist every six months for regular check-ups and professional cleaning.'],
                    ['Is teeth whitening safe?', 'Yes, professional teeth whitening is safe and effective when performed by qualified dental professionals.'],
                    ['Do you treat children?', 'Yes, we provide gentle and friendly dental care for children of all ages.'],
                    ['Can I book an appointment online?', 'Yes, our online appointment system lets you schedule a visit anytime, at your convenience.'],
                    ['What payment methods do you accept?', 'We accept cash, debit cards, credit cards, and selected digital payment methods.'],
                    ['What should I do during a dental emergency?', 'Contact our clinic immediately so we can provide guidance and arrange urgent treatment if needed.'],
                ];
            @endphp

            @foreach($faqs as $faq)
                <div class="ss-faq-item ss-reveal">
                    <button type="button" class="ss-faq-q" aria-expanded="false">
                        <span>{{ $faq[0] }}</span>
                        <span class="ss-faq-icon" aria-hidden="true"></span>
                    </button>
                    <div class="ss-faq-a">
                        <p>{{ $faq[1] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ==========================================================
     FINAL CTA
========================================================== --}}

<section class="ss-final-cta">
    <div class="ss-container">
        <h2 class="ss-heading ss-hero-title ss-reveal">
            <span>Your Smile</span>
            <span class="is-accent">Starts Here.</span>
        </h2>
        <p class="ss-reveal" style="margin-top:1.5rem;color:var(--c-silver);max-width:36ch;">
            Take the first step toward better dental care.
        </p>
        <div class="ss-final-cta-actions">
            <a href="{{ route('appointments.create') }}" class="ss-btn ss-btn--solid ss-reveal">Book an Appointment</a>
            <a href="{{ route('appointments.login') }}" class="ss-btn ss-btn--ghost ss-reveal">Login</a>
        </div>
    </div>
</section>

{{-- ==========================================================
     LOCATION (kept from existing page — working map + address)
========================================================== --}}

<section id="location" class="ss-section ss-section--charcoal">
    <div class="ss-container">

        <div class="ss-eyebrow-row ss-reveal">
            <span class="ss-rule"></span>
            <span class="ss-label">Our Flagship Clinic</span>
        </div>

        <h2 class="ss-heading ss-section-heading ss-reveal">Visit Us in Koronadal</h2>

        <div class="ss-contact-grid">

            <div class="ss-reveal">
                <div class="ss-contact-info-item">
                    <div>
                        <span class="ss-label">Headquarters</span>
                        <p>
                            Door 5, MDFI Bldg,<br>
                            Rafael Alunan Ave,<br>
                            Brgy. Zone III,<br>
                            Koronadal, South Cotabato (9506)
                        </p>
                    </div>
                </div>

                <div class="ss-contact-info-item">
                    <div>
                        <span class="ss-label">Hours</span>
                        <p>Mon – Fri: 8AM – 6PM<br>Saturday: 9AM – 2PM</p>
                    </div>
                </div>

                <a
                    href="https://www.google.com/maps/dir/?api=1&destination=Door+5+MDFI+Bldg+Rafael+Alunan+Ave+Koronadal+South+Cotabato+9506"
                    target="_blank"
                    rel="noopener"
                    class="ss-btn ss-btn--solid"
                    style="margin-top:1.5rem;"
                >
                    Get Directions
                </a>
            </div>

            <div class="ss-reveal ss-reveal--scale" style="min-height:380px;border:1px solid rgba(255,255,255,0.08);overflow:hidden;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d256354.9240519452!2d124.58331667902091!3d6.489816879239853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f818eb3b42365f%3A0xdeeaa89b952730b5!2sShine%20%26%20Smile%20Dental%20Clinic!5e1!3m2!1sen!2sph!4v1780745828224!5m2!1sen!2sph"
                    width="100%"
                    height="100%"
                    style="border:0;min-height:380px;filter:grayscale(60%) invert(92%) contrast(85%);"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Shine & Smile Dental Clinic location"
                ></iframe>
            </div>

        </div>
    </div>
</section>

<section id="contact" class="ss-section ss-section--void">

    <div class="ss-container">

        <div class="ss-eyebrow-row ss-reveal">
            <span class="ss-rule"></span>
            <span class="ss-label">Get In Touch</span>
        </div>

        <h2 class="ss-heading ss-section-heading ss-reveal">
            Contact Shine & Smile
        </h2>

        <div class="ss-contact-grid">

            <div class="ss-reveal">

                <div class="ss-contact-info-item">
                    <div>
                        <span class="ss-label">Phone</span>
                        <p>Contact the clinic</p>
                    </div>
                </div>

                <div class="ss-contact-info-item">
                    <div>
                        <span class="ss-label">Email</span>
                        <p>Send us an email</p>
                    </div>
                </div>

                <div class="ss-contact-info-item">
                    <div>
                        <span class="ss-label">Clinic Address</span>
                        <p>
                            Door 5, MDFI Bldg, Rafael Alunan Ave,
                            Brgy. Zone III, Koronadal, South Cotabato
                        </p>
                    </div>
                </div>

            </div>

            <div class="ss-reveal">

                <form
                    action="{{ route('contact.send') }}"
                    method="POST"
                >
                    @csrf

                    <div class="ss-field">
                        <label for="contact-name">
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="contact-name"
                            name="name"
                            placeholder="Enter your full name"
                            value="{{ old('name') }}"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="ss-field">
                        <label for="contact-email">
                            Email Address
                        </label>

                        <input
                            type="email"
                            id="contact-email"
                            name="email"
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="ss-field">
                        <label for="contact-phone">
                            Phone Number
                        </label>

                        <input
                            type="tel"
                            id="contact-phone"
                            name="phone"
                            placeholder="Enter your phone number"
                            maxlength="50"
                        >
                    </div>

                    <div class="ss-field">
                        <label for="contact-subject">
                            Subject
                        </label>

                        <input
                            type="text"
                            id="contact-subject"
                            name="subject"
                            placeholder="What can we help you with?"
                            value="{{ old('subject') }}"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="ss-field">
                        <label for="contact-message">
                            Message
                        </label>

                        <textarea
                            id="contact-message"
                            name="message"
                            placeholder="Write your message here..."
                            maxlength="1000"
                            required
                        >{{ old('message') }}</textarea>
                    </div>

                    <button
                        type="submit"
                        class="ss-btn ss-btn--solid"
                        style="width:100%;"
                    >
                        Send Message
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>
{{-- ==========================================================
     FOOTER
========================================================== --}}

<footer class="ss-footer">
    <div class="ss-container">
        <div class="ss-footer-grid">

            <div>
                <div class="ss-footer-brand">Shine & Smile</div>
                <p>Dental Management System</p>
            </div>

            <div>
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4>Account</h4>
                <ul>
                    <li><a href="{{ route('appointments.login') }}">Login</a></li>
                    <li><a href="{{ route('appointments.create') }}">Book Appointment</a></li>
                </ul>
            </div>

        </div>

        <div class="ss-footer-bottom">
            &copy; 2026 Shine & Smile Dental Management System. All Rights Reserved.
        </div>
    </div>
</footer>

<script src="{{ asset('js/appointment/welcome.js') }}"></script>

</body>
</html>
