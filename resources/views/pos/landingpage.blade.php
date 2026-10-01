<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Shine & Smile Dental Clinic | POS
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/pos/pos-landingpage.css') }}"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@500;600;700&family=Caveat:wght@500;600&display=swap"
        rel="stylesheet"
    >

</head>

<body>

    {{-- =====================================================
        BACKGROUND DECORATIONS
    ====================================================== --}}

    <div class="background-decoration decoration-left"></div>

    <div class="background-decoration decoration-right"></div>

    <div class="pink-circle circle-one"></div>

    <div class="pink-circle circle-two"></div>


    {{-- =====================================================
        DOT PATTERN - LEFT
    ====================================================== --}}

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


    {{-- =====================================================
        DOT PATTERN - RIGHT
    ====================================================== --}}

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


    {{-- =====================================================
        SPARKLES
    ====================================================== --}}

    <div class="sparkle sparkle-one">
        ✦
    </div>

    <div class="sparkle sparkle-two">
        ✦
    </div>

    <div class="sparkle sparkle-three">
        ✦
    </div>


    {{-- =====================================================
        HEART DECORATIONS
    ====================================================== --}}

    <div class="heart-decoration heart-one">
        ♡
    </div>

    <div class="heart-decoration heart-two">
        ♡
    </div>


    {{-- =====================================================
        MAIN CONTAINER
    ====================================================== --}}

    <main class="portal-container">


        {{-- =================================================
            BRAND
        ================================================== --}}

        <header class="brand">

            <div class="brand-logo">

                <i class="fa-solid fa-cash-register"></i>

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


        {{-- =================================================
            TAGLINE
        ================================================== --}}

        <div class="clinic-tagline">

            <span></span>

            <p>
                SIMPLE • SECURE • SMART SALES
            </p>

            <span></span>

        </div>


        {{-- =================================================
            LEFT DECORATIVE MESSAGE
        ================================================== --}}

        <div class="side-message side-message-left">

            <span>
                Serve
            </span>

            <span>
                Smile
            </span>

            <span>
                Sell
            </span>

            <span>
                Better
            </span>

            <div class="small-heart">
                ♡
            </div>

        </div>


        {{-- =================================================
            POS DECORATION
        ================================================== --}}

        <div class="dental-decoration">

            <div class="tooth-circle">

                <i class="fa-solid fa-receipt"></i>

            </div>

            <div class="dental-sparkle">
                ✦
            </div>

        </div>


        {{-- =================================================
            MAIN POS PORTAL
        ================================================== --}}

        <section class="portal-section">


            {{-- POS CARD --}}

            <div class="portal-card">

                <div class="portal-icon">

                    <i class="fa-solid fa-cash-register"></i>

                </div>


                <h2>
                    Cashier Portal
                </h2>


                <p>
                    Process sales, manage transactions,
                    and handle your dental clinic's
                    point-of-sale operations.
                </p>

            </div>


            {{-- MAIN ACCESS BUTTON --}}

            <div class="main-access">

                <button
                    type="button"
                    id="accessPortalBtn"
                    class="access-button"
                >

                    <i class="fa-solid fa-right-to-bracket"></i>

                    <span>
                        Access POS System
                    </span>

                </button>


                <p>
                    Sign in with your assigned cashier credentials
                </p>

            </div>

        </section>


        {{-- =================================================
            RIGHT DECORATIVE MESSAGE
        ================================================== --}}

        <div class="side-message side-message-right">

            <span>
                Fast
            </span>

            <span>
                Secure
            </span>

            <span>
                Accurate
            </span>

            <div class="small-heart">
                ♡
            </div>

        </div>


        {{-- =================================================
            DECORATIVE LINE
        ================================================== --}}

        <div class="decorative-line">

            <span></span>

            <i class="fa-solid fa-cash-register"></i>

            <span></span>

        </div>


        {{-- =================================================
            FOOTER
        ================================================== --}}

        <footer>

            <p class="copyright">
                © 2026 Shine & Smile Dental Clinic.
                All rights reserved.
            </p>


            <div class="footer-links">

                <span>
                    Better Service. Better Smiles.
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


    {{-- =====================================================
        CASHIER LOGIN MODAL
    ====================================================== --}}

    <div
        class="login-modal"
        id="loginModal"
        aria-hidden="true"
    >

        {{-- OVERLAY --}}

        <div
            class="login-overlay"
            id="loginOverlay"
        ></div>


        {{-- LOGIN CARD --}}

        <div
            class="login-modal-card"
            role="dialog"
            aria-modal="true"
            aria-labelledby="posLoginTitle"
        >


            {{-- CLOSE BUTTON --}}

            <button
                type="button"
                class="login-close"
                id="closeLoginModal"
                aria-label="Close login"
            >

                <i class="fa-solid fa-xmark"></i>

            </button>


            {{-- LOGIN ICON --}}

            <div class="login-icon">

                <i class="fa-solid fa-cash-register"></i>

            </div>


            {{-- TITLE --}}

            <h2 id="posLoginTitle">
                Cashier Login
            </h2>


            <p class="login-subtitle">
                Sign in to access the Shine & Smile
                Point-of-Sale system.
            </p>


            {{-- =================================================
                LOGIN ERRORS
            ================================================== --}}

            @if ($errors->any())

                <div
                    class="login-errors"
                    id="loginErrors"
                >

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <div>

                        @foreach ($errors->all() as $error)

                            <p>
                                {{ $error }}
                            </p>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- =================================================
                LOGIN FORM
            ================================================== --}}

            <form
                method="POST"
                action="{{ route('pos.login.post') }}"
                class="login-form"
                id="posLoginForm"
            >

                @csrf


                {{-- EMAIL --}}

                <div class="login-field">

                    <label for="pos-email">
                        Email Address
                    </label>


                    <div class="input-wrapper">

                        <i class="fa-solid fa-envelope"></i>


                        <input
                            type="email"
                            id="pos-email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            autocomplete="email"
                            required
                        >

                    </div>

                </div>


                {{-- PASSWORD --}}

                <div class="login-field">

                    <label for="pos-password">
                        Password
                    </label>


                    <div class="input-wrapper">

                        <i class="fa-solid fa-lock"></i>


                        <input
                            type="password"
                            id="pos-password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >


                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Show password"
                        >

                            <i class="fa-solid fa-eye"></i>

                        </button>

                    </div>

                </div>


                {{-- LOGIN OPTIONS --}}

                <div class="login-options">

                    <label class="remember-me">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >

                        <span>
                            Remember me
                        </span>

                    </label>


                    <a
                        href="{{ url('/forgot-password') }}"
                        class="forgot-password"
                    >
                        Forgot password?
                    </a>

                </div>


                {{-- SUBMIT --}}

                <button
                    type="submit"
                    class="login-submit"
                    id="loginSubmit"
                >

                    <i class="fa-solid fa-right-to-bracket"></i>

                    <span>
                        Sign In
                    </span>

                </button>

            </form>


            {{-- SECURITY MESSAGE --}}

            <div class="login-security">

                <i class="fa-solid fa-shield-halved"></i>

                Secure cashier account access

            </div>

        </div>

    </div>


    <script
        src="{{ asset('js/pos/pos-landingpage.js') }}"
        defer
    ></script>

</body>

</html>
