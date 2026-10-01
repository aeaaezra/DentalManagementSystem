<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Shine & Smile Dental Clinic | Dentist Portal</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/dentists/dentist-landingpage.css') }}"
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

    <!-- Background Decorations -->

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

    <div class="sparkle sparkle-one">✦</div>
    <div class="sparkle sparkle-two">✦</div>
    <div class="sparkle sparkle-three">✦</div>

    <div class="heart-decoration heart-one">♡</div>
    <div class="heart-decoration heart-two">♡</div>


    <!-- Main Container -->

    <main class="portal-container">


        <!-- Brand -->

        <header class="brand">

            <div class="brand-logo">

                <i class="fa-solid fa-tooth"></i>

            </div>

            <div class="brand-name">

                <h1>Shine & Smile</h1>

                <span>DENTAL CLINIC</span>

            </div>

        </header>


        <!-- Small Tagline -->

        <div class="clinic-tagline">

            <span></span>

            <p>
                YOUR SMILE, OUR PRIORITY
            </p>

            <span></span>

        </div>


        <!-- Decorative Left Text -->

        <div class="side-message side-message-left">

            <span>Healthy</span>
            <span>Smiles</span>
            <span>Brighter</span>
            <span>Tomorrow</span>

            <div class="small-heart">
                ♡
            </div>

        </div>


        <!-- Decorative Right Dental -->

        <div class="dental-decoration">

            <div class="tooth-circle">

                <i class="fa-solid fa-tooth"></i>

            </div>

            <div class="dental-sparkle">
                ✦
            </div>

        </div>


        <!-- Main Portal -->

        <section class="portal-section">

            <div class="portal-card">

                <div class="portal-icon">

                    <i class="fa-solid fa-user-doctor"></i>

                </div>

                <h2>
                    Dentist Portal
                </h2>

                <p>
                    Manage appointments, patient records,
                    and treatment plans.
                </p>

            </div>


            <!-- Main Access -->

            <div class="main-access">

                <button
                    type="button"
                    id="accessPortalBtn"
                    class="access-button"
                >

                    <i class="fa-solid fa-right-to-bracket"></i>

                    Access Dentist Portal

                </button>

                <p>
                    Sign in with your assigned dentist credentials
                </p>

            </div>

        </section>


        <!-- Decorative Right Message -->

        <div class="side-message side-message-right">

            <span>Care</span>
            <span>Prevent</span>
            <span>Smile</span>

            <div class="small-heart">
                ♡
            </div>

        </div>


        <!-- Bottom Decorative Line -->

        <div class="decorative-line">

            <span></span>

            <i class="fa-solid fa-tooth"></i>

            <span></span>

        </div>


        <!-- Footer -->

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


    <!-- Dentist Login Modal -->

    <div
        class="login-modal"
        id="loginModal"
        aria-hidden="true"
    >

        <div
            class="login-overlay"
            id="loginOverlay"
        ></div>

        <div
            class="login-modal-card"
            role="dialog"
            aria-modal="true"
        >

            <button
                type="button"
                class="login-close"
                id="closeLoginModal"
            >

                <i class="fa-solid fa-xmark"></i>

            </button>


            <div class="login-icon">

                <i class="fa-solid fa-user-doctor"></i>

            </div>


            <h2>
                Dentist Login
            </h2>

            <p class="login-subtitle">
                Sign in to access your Shine & Smile dentist portal.
            </p>


            @if ($errors->any())

                <div class="login-errors">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <div>

                        @foreach ($errors->all() as $error)

                            <p>{{ $error }}</p>

                        @endforeach

                    </div>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('dentist.login.store') }}"
                class="login-form"
            >

                @csrf


                <div class="login-field">

                    <label for="dentist-email">
                        Email Address
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-envelope"></i>

                        <input
                            type="email"
                            id="dentist-email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            autocomplete="email"
                            required
                        >

                    </div>

                </div>


                <div class="login-field">

                    <label for="dentist-password">
                        Password
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-lock"></i>

                        <input
                            type="password"
                            id="dentist-password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                        >

                            <i class="fa-solid fa-eye"></i>

                        </button>

                    </div>

                </div>


                <div class="login-options">

                    <label class="remember-me">

                        <input
                            type="checkbox"
                            name="remember"
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


                <button
                    type="submit"
                    class="login-submit"
                >

                    <i class="fa-solid fa-right-to-bracket"></i>

                    Sign In

                </button>

            </form>


            <div class="login-security">

                <i class="fa-solid fa-shield-halved"></i>

                Secure dentist account access

            </div>

        </div>

    </div>


    <script
        src="{{ asset('js/dentist/dentist-landingpage.js') }}"
        defer
    ></script>

</body>

</html>
