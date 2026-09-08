<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Shine & Smile Dental Clinic | Admin Portal</title>

    {{-- =========================================================
         DENTIST WELCOME PAGE CSS
         ========================================================= --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/dentists/dentist-landingpage.css') }}"
    >

    {{-- =========================================================
         FONT AWESOME
         ========================================================= --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    {{-- =========================================================
         GOOGLE FONTS
         ========================================================= --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@500;600;700&family=Caveat:wght@500;600&display=swap"
        rel="stylesheet"
    >

    {{-- =========================================================
         ADMIN WELCOME PAGE BUTTON CSS ONLY
         ========================================================= --}}
    <style>

        button.access-button,
        a.access-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            text-decoration: none;
            cursor: pointer;

            font-family: 'Inter', sans-serif;
        }

        button.access-button {
            border: none;
        }

        a.access-button:hover,
        a.access-button:focus,
        a.access-button:active {
            text-decoration: none;
        }

    </style>

</head>


<body>


    <div class="background-decoration decoration-left"></div>

    <div class="background-decoration decoration-right"></div>

    <div class="pink-circle circle-one"></div>

    <div class="pink-circle circle-two"></div>



    <div class="dot-pattern dots-left">

        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>

    </div>


    {{-- =========================================================
         RIGHT DOT PATTERN
         ========================================================= --}}

    <div class="dot-pattern dots-right">

        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>

    </div>


    {{-- =========================================================
         SPARKLES
         ========================================================= --}}

    <div class="sparkle sparkle-one">✦</div>

    <div class="sparkle sparkle-two">✦</div>

    <div class="sparkle sparkle-three">✦</div>


    {{-- =========================================================
         HEARTS
         ========================================================= --}}

    <div class="heart-decoration heart-one">♡</div>

    <div class="heart-decoration heart-two">♡</div>


    {{-- =========================================================
         MAIN CONTAINER
         ========================================================= --}}

    <main class="portal-container">


        {{-- =====================================================
             BRAND
             ===================================================== --}}

        <header class="brand">

            <div class="brand-logo">

                <i class="fa-solid fa-tooth"></i>

            </div>


            <div class="brand-name">

                <h1>
                    Shine & Smile
                </h1>

                <span>
                    DENTAL CLINIC
                </span>

            </div>

        </header>


        {{-- =====================================================
             TAGLINE
             ===================================================== --}}

        <div class="clinic-tagline">

            <span></span>

            <p>
                YOUR SMILE, OUR PRIORITY
            </p>

            <span></span>

        </div>


        {{-- =====================================================
             LEFT MESSAGE
             ===================================================== --}}

        <div class="side-message side-message-left">

            <span>
                Healthy
            </span>

            <span>
                Smiles
            </span>

            <span>
                Brighter
            </span>

            <span>
                Tomorrow
            </span>

            <div class="small-heart">
                ♡
            </div>

        </div>


        {{-- =====================================================
             DENTAL DECORATION
             ===================================================== --}}

        <div class="dental-decoration">

            <div class="tooth-circle">

                <i class="fa-solid fa-tooth"></i>

            </div>

            <div class="dental-sparkle">
                ✦
            </div>

        </div>


        {{-- =====================================================
             ADMIN PORTAL
             ===================================================== --}}

        <section class="portal-section">


            {{-- =================================================
                 ADMIN CARD
                 ================================================= --}}

            <div class="portal-card">

                <div class="portal-icon">

                    <i class="fa-solid fa-user-shield"></i>

                </div>


                <h2>
                    Admin Portal
                </h2>


                <p>
                    Manage users, appointments, patient records,
                    services, and daily clinic operations.
                </p>

            </div>


            {{-- =================================================
                 ADMIN ACCESS
                 ================================================= --}}

            <div class="main-access">

                @auth

                    @if (Auth::user()->role === 'admin')

                        {{-- Already logged in as admin --}}

                        <a
                            href="{{ url('/admin') }}"
                            class="access-button"
                        >

                            <i class="fa-solid fa-gauge-high"></i>

                            Access Admin Dashboard

                        </a>


                        <p>
                            You are already signed in as an administrator
                        </p>

                    @else

                        {{-- Logged-in non-admin --}}

                        <a
                            href="{{ url('/admin/login') }}"
                            class="access-button"
                        >

                            <i class="fa-solid fa-right-to-bracket"></i>

                            Access Admin Portal

                        </a>


                        <p>
                            Sign in with your assigned administrator credentials
                        </p>

                    @endif

                @else

                    {{-- Guest --}}

                    <a
                        href="{{ url('/admin/login') }}"
                        class="access-button"
                    >

                        <i class="fa-solid fa-right-to-bracket"></i>

                        Access Admin Portal

                    </a>


                    <p>
                        Sign in with your assigned administrator credentials
                    </p>

                @endauth

            </div>

        </section>


        {{-- =====================================================
             RIGHT MESSAGE
             ===================================================== --}}

        <div class="side-message side-message-right">

            <span>
                Manage
            </span>

            <span>
                Care
            </span>

            <span>
                Smile
            </span>

            <div class="small-heart">
                ♡
            </div>

        </div>


        {{-- =====================================================
             DECORATIVE LINE
             ===================================================== --}}

        <div class="decorative-line">

            <span></span>

            <i class="fa-solid fa-tooth"></i>

            <span></span>

        </div>


        {{-- =====================================================
             FOOTER
             ===================================================== --}}

        <footer>

            <p class="copyright">

                © 2026 Shine & Smile Dental Clinic.

                All rights reserved.

            </p>


            <div class="footer-links">

                <span>
                    Brighten Lives. One Smile at a Time.
                </span>


                <span class="separator">
                    |
                </span>


                <a href="#">
                    Privacy Policy
                </a>


                <span class="separator">
                    |
                </span>


                <a href="#">
                    Terms and Conditions
                </a>

            </div>

        </footer>


    </main>


</body>

</html>
