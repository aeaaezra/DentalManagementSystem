<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Receptionist | Shine & Smile Dental Clinic
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/receptionist/receptionist-landing.css') }}"
    >

</head>


<body>


    <!-- =====================================================
         NAVIGATION
    ====================================================== -->

    <header class="navbar">

        <div class="nav-container">


            <!-- LOGO -->

            <a
                href="{{ route('receptionist.landing') }}"
                class="logo"
            >

                <div class="logo-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >

                        <path
                            d="M7 3C5.2 3 4 4.5 4 6.5C4 9.5 5.2 11.5 6 14.5C6.6 16.8 6.8 21 9 21C10.8 21 11 17 12 17C13 17 13.2 21 15 21C17.2 21 17.4 16.8 18 14.5C18.8 11.5 20 9.5 20 6.5C20 4.5 18.8 3 17 3C15.3 3 14.1 4.2 12 4.2C9.9 4.2 8.7 3 7 3Z"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M9 8.5C10 7.8 11 7.5 12 7.5C13 7.5 14 7.8 15 8.5"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                        />

                    </svg>

                </div>


                <div class="logo-text">

                    <span class="logo-main">
                        Shine & Smile
                    </span>

                    <span class="logo-sub">
                        Dental Clinic
                    </span>

                </div>

            </a>


            <!-- DESKTOP NAV -->

            <nav class="desktop-nav">

                <a
                    href="#home"
                    class="nav-link active"
                >
                    Home
                </a>

                <a
                    href="#services"
                    class="nav-link"
                >
                    Services
                </a>

                <a
                    href="#about"
                    class="nav-link"
                >
                    About
                </a>

                <a
                    href="#contact"
                    class="nav-link"
                >
                    Contact
                </a>

            </nav>


            <!-- LOGIN -->

            <a
                href="{{ route('login') }}"
                class="login-button"
            >

                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >

                    <path
                        d="M15 3H19C20.1 3 21 3.9 21 5V19C21 20.1 20.1 21 19 21H15"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />

                    <path
                        d="M10 17L15 12L10 7"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M15 12H3"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />

                </svg>

                Receptionist Login

            </a>


            <!-- MOBILE MENU -->

            <button
                type="button"
                class="mobile-menu-button"
                id="mobileMenuButton"
            >

                <svg
                    id="menuIcon"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >

                    <path
                        d="M4 6H20"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />

                    <path
                        d="M4 12H20"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />

                    <path
                        d="M4 18H20"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />

                </svg>

            </button>

        </div>


        <!-- MOBILE NAV -->

        <div
            class="mobile-nav"
            id="mobileNav"
        >

            <a href="#home">
                Home
            </a>

            <a href="#services">
                Services
            </a>

            <a href="#about">
                About
            </a>

            <a href="#contact">
                Contact
            </a>

            <a
                href="{{ route('login') }}"
                class="mobile-login"
            >
                Receptionist Login
            </a>

        </div>

    </header>



    <!-- =====================================================
         HERO
    ====================================================== -->

    <main>


        <section
            class="hero"
            id="home"
        >

            <div class="hero-background-circle circle-one"></div>

            <div class="hero-background-circle circle-two"></div>


            <div class="hero-container">


                <!-- LEFT -->

                <div class="hero-content">

                    <div class="hero-badge">

                        <span class="badge-dot"></span>

                        Receptionist Portal

                    </div>


                    <h1>

                        Your Front Desk,

                        <span>
                            Made Simple.
                        </span>

                    </h1>


                    <p class="hero-description">

                        Manage appointments, patients, check-ins,
                        and daily clinic operations from one
                        simple and organized workspace.

                    </p>


                    <div class="hero-buttons">

                        <a
                            href="{{ route('login') }}"
                            class="primary-button"
                        >

                            <svg
                                width="19"
                                height="19"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >

                                <path
                                    d="M15 3H19C20.1 3 21 3.9 21 5V19C21 20.1 20.1 21 19 21H15"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                />

                                <path
                                    d="M10 17L15 12L10 7"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                                <path
                                    d="M15 12H3"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                />

                            </svg>

                            Login to Receptionist Portal

                        </a>


                        <a
                            href="#services"
                            class="secondary-button"
                        >
                            Explore Features
                        </a>

                    </div>


                    <!-- TRUST -->

                    <div class="hero-trust">

                        <div class="trust-icon">

                            <svg
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >

                                <path
                                    d="M12 3L20 6V11C20 16.2 16.6 20 12 21C7.4 20 4 16.2 4 11V6L12 3Z"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linejoin="round"
                                />

                                <path
                                    d="M8.5 12L11 14.5L15.5 10"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </div>

                        <div>

                            <strong>
                                Secure Receptionist Access
                            </strong>

                            <span>
                                Authorized clinic staff only
                            </span>

                        </div>

                    </div>

                </div>



                <!-- RIGHT VISUAL -->

                <div class="hero-visual">


                    <div class="dashboard-card">


                        <!-- CARD HEADER -->

                        <div class="dashboard-header">

                            <div>

                                <span>
                                    Receptionist Dashboard
                                </span>

                                <strong>
                                    Today's Overview
                                </strong>

                            </div>


                            <div class="dashboard-avatar">

                                <svg
                                    width="22"
                                    height="22"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >

                                    <circle
                                        cx="12"
                                        cy="8"
                                        r="4"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    />

                                    <path
                                        d="M4 21C4.8 16.9 7.5 15 12 15C16.5 15 19.2 16.9 20 21"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </div>

                        </div>


                        <!-- STATS -->

                        <div class="dashboard-stats">


                            <div class="stat-box">

                                <div class="stat-icon appointment-icon">

                                    <svg
                                        width="19"
                                        height="19"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >

                                        <rect
                                            x="3"
                                            y="5"
                                            width="18"
                                            height="16"
                                            rx="2"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        />

                                        <path
                                            d="M16 3V7M8 3V7M3 10H21"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </div>

                                <div>

                                    <strong>
                                        12
                                    </strong>

                                    <span>
                                        Appointments
                                    </span>

                                </div>

                            </div>


                            <div class="stat-box">

                                <div class="stat-icon patient-icon">

                                    <svg
                                        width="19"
                                        height="19"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >

                                        <circle
                                            cx="9"
                                            cy="8"
                                            r="4"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        />

                                        <path
                                            d="M2 21C2.7 17.3 5 15.5 9 15.5C13 15.5 15.3 17.3 16 21"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                        />

                                        <path
                                            d="M17 11C19.8 11.2 21.5 12.8 22 15"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </div>

                                <div>

                                    <strong>
                                        48
                                    </strong>

                                    <span>
                                        Patients
                                    </span>

                                </div>

                            </div>


                        </div>


                        <!-- QUEUE -->

                        <div class="queue-title">

                            <span>
                                Today's Patient Queue
                            </span>

                            <span class="queue-count">
                                4 waiting
                            </span>

                        </div>


                        <div class="queue-list">


                            <div class="queue-item">

                                <div class="queue-avatar">
                                    JD
                                </div>

                                <div class="queue-info">

                                    <strong>
                                        Juan Dela Cruz
                                    </strong>

                                    <span>
                                        Dental Cleaning • 09:00 AM
                                    </span>

                                </div>

                                <span class="queue-status waiting">
                                    Waiting
                                </span>

                            </div>


                            <div class="queue-item">

                                <div class="queue-avatar">
                                    MS
                                </div>

                                <div class="queue-info">

                                    <strong>
                                        Maria Santos
                                    </strong>

                                    <span>
                                        Consultation • 10:00 AM
                                    </span>

                                </div>

                                <span class="queue-status checked">
                                    Checked In
                                </span>

                            </div>


                            <div class="queue-item">

                                <div class="queue-avatar">
                                    PC
                                </div>

                                <div class="queue-info">

                                    <strong>
                                        Pedro Cruz
                                    </strong>

                                    <span>
                                        Tooth Extraction • 11:00 AM
                                    </span>

                                </div>

                                <span class="queue-status treatment">
                                    Treatment
                                </span>

                            </div>


                        </div>


                        <!-- CARD FOOTER -->

                        <div class="dashboard-footer">

                            <span>
                                Clinic operations
                            </span>

                            <span class="online-status">

                                <span></span>

                                System Online

                            </span>

                        </div>

                    </div>


                    <!-- FLOATING CARD -->

                    <div class="floating-card">

                        <div class="floating-icon">

                            <svg
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >

                                <path
                                    d="M5 12L10 17L19 7"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </div>

                        <div>

                            <strong>
                                Check-in Complete
                            </strong>

                            <span>
                                Patient is ready
                            </span>

                        </div>

                    </div>


                </div>

            </div>

        </section>



        <!-- =================================================
             FEATURES
        ================================================== -->

        <section
            class="features-section"
            id="services"
        >

            <div class="section-container">


                <div class="section-heading">

                    <span>
                        FRONT DESK TOOLS
                    </span>

                    <h2>
                        Everything you need at the front desk
                    </h2>

                    <p>
                        Keep your clinic organized and provide
                        patients with a smooth experience from
                        arrival to checkout.
                    </p>

                </div>


                <div class="features-grid">


                    <!-- FEATURE 1 -->

                    <div class="feature-card">

                        <div class="feature-icon">

                            <svg
                                width="25"
                                height="25"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >

                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="16"
                                    rx="2"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                />

                                <path
                                    d="M16 3V7M8 3V7M3 10H21"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />

                            </svg>

                        </div>

                        <h3>
                            Appointment Management
                        </h3>

                        <p>
                            View today's schedule and keep
                            appointments organized throughout
                            the clinic day.
                        </p>

                    </div>


                    <!-- FEATURE 2 -->

                    <div class="feature-card">

                        <div class="feature-icon">

                            <svg
                                width="25"
                                height="25"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >

                                <circle
                                    cx="9"
                                    cy="8"
                                    r="4"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                />

                                <path
                                    d="M2 21C2.7 17.3 5 15.5 9 15.5C13 15.5 15.3 17.3 16 21"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />

                                <path
                                    d="M17 8H22M19.5 5.5V10.5"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />

                            </svg>

                        </div>

                        <h3>
                            Patient Management
                        </h3>

                        <p>
                            Quickly search patient records and
                            access appointment history when
                            patients arrive.
                        </p>

                    </div>


                    <!-- FEATURE 3 -->

                    <div class="feature-card">

                        <div class="feature-icon">

                            <svg
                                width="25"
                                height="25"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >

                                <path
                                    d="M4 12L9 17L20 6"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </div>

                        <h3>
                            Patient Check-In
                        </h3>

                        <p>
                            Record patient arrival and keep the
                            treatment queue updated in real time.
                        </p>

                    </div>


                </div>

            </div>

        </section>



        <!-- =================================================
             ABOUT
        ================================================== -->

        <section
            class="about-section"
            id="about"
        >

            <div class="about-container">


                <div class="about-content">

                    <span class="section-label">
                        FOR RECEPTIONISTS
                    </span>

                    <h2>
                        A smoother clinic starts at the front desk.
                    </h2>

                    <p>
                        Shine & Smile's receptionist portal helps
                        your front desk team manage the daily
                        patient flow without unnecessary complexity.
                    </p>

                    <p>
                        From appointment confirmation and patient
                        arrival to treatment status and checkout,
                        everything is organized in one workspace.
                    </p>


                    <a
                        href="{{ route('login') }}"
                        class="primary-button"
                    >

                        Access Receptionist Portal

                        <svg
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                            <path
                                d="M5 12H19"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                            />

                            <path
                                d="M13 6L19 12L13 18"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                        </svg>

                    </a>

                </div>


                <div class="about-visual">

                    <div class="about-card">

                        <div class="about-card-icon">

                            <svg
                                width="30"
                                height="30"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >

                                <path
                                    d="M12 3L20 6V11C20 16.2 16.6 20 12 21C7.4 20 4 16.2 4 11V6L12 3Z"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linejoin="round"
                                />

                                <path
                                    d="M8.5 12L11 14.5L15.5 10"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </div>

                        <h3>
                            Secure & Organized
                        </h3>

                        <p>
                            Receptionist access is protected by
                            your clinic's authentication system.
                        </p>

                    </div>

                </div>

            </div>

        </section>



        <!-- =================================================
             CONTACT
        ================================================== -->

        <section
            class="contact-section"
            id="contact"
        >

            <div class="section-container">


                <div class="contact-card">


                    <div>

                        <span class="section-label">
                            NEED HELP?
                        </span>

                        <h2>
                            We're here to help.
                        </h2>

                        <p>
                            Contact the clinic administrator if
                            you need assistance accessing the
                            receptionist portal.
                        </p>

                    </div>


                    <a
                        href="mailto:admin@shineandsmile.com"
                        class="contact-button"
                    >

                        Contact Administrator

                        <svg
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                            <path
                                d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z"
                                stroke="currentColor"
                                stroke-width="1.8"
                            />

                            <path
                                d="M22 6L12 13L2 6"
                                stroke="currentColor"
                                stroke-width="1.8"
                            />

                        </svg>

                    </a>

                </div>

            </div>

        </section>

    </main>



    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <footer class="footer">

        <div class="footer-container">

            <div class="footer-brand">

                <strong>
                    Shine & Smile
                </strong>

                <span>
                    Dental Clinic
                </span>

            </div>

            <p>
                © {{ date('Y') }} Shine & Smile Dental Clinic.
                All rights reserved.
            </p>

        </div>

    </footer>


    <script
        src="{{ asset('js/receptionist/receptionist-landing.js') }}"
    ></script>

</body>

</html>
