<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Appointment Login | Shine & Smile</title>

    <style>
        /* =========================================================
           RESET
        ========================================================= */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            background: #080808;
            color: #f5f2ef;
            font-family: Arial, Helvetica, sans-serif;
            overflow-x: hidden;
        }

        /* =========================================================
           BACKGROUND
        ========================================================= */

        .login-page {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 110px 7vw 70px;
            overflow: hidden;
            background:
                radial-gradient(
                    circle at 78% 25%,
                    rgba(236, 29, 102, 0.12),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 20% 80%,
                    rgba(236, 29, 102, 0.07),
                    transparent 30%
                ),
                #080808;
        }

        .login-page::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(
                    90deg,
                    rgba(0, 0, 0, 0.92) 0%,
                    rgba(0, 0, 0, 0.72) 48%,
                    rgba(0, 0, 0, 0.94) 100%
                );
        }

        .background-word {
            position: absolute;
            right: -40px;
            bottom: -20px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(180px, 25vw, 420px);
            line-height: 0.7;
            font-weight: 700;
            letter-spacing: -0.08em;
            color: rgba(255, 255, 255, 0.025);
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
        }

        /* =========================================================
           TOP NAVIGATION
        ========================================================= */

        .topbar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10;

            height: 92px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 7vw;

            border-bottom: 1px solid rgba(255, 255, 255, 0.09);

            background: rgba(8, 8, 8, 0.72);
            backdrop-filter: blur(12px);
        }

        .brand {
            color: #ffffff;
            text-decoration: none;

            font-family: Georgia, "Times New Roman", serif;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .brand span {
            color: #ec1d66;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 110px;
            height: 46px;

            padding: 0 20px;

            border: 1px solid rgba(255, 255, 255, 0.55);

            color: #ffffff;
            text-decoration: none;

            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;

            transition:
                background 0.25s ease,
                border-color 0.25s ease,
                color 0.25s ease;
        }

        .back-home:hover {
            background: #ec1d66;
            border-color: #ec1d66;
            color: #ffffff;
        }

        /* =========================================================
           MAIN LAYOUT
        ========================================================= */

        .login-layout {
            position: relative;
            z-index: 2;

            width: 100%;
            max-width: 1240px;

            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(360px, 470px);
            gap: 100px;

            align-items: center;
        }

        /* =========================================================
           LEFT SIDE
        ========================================================= */

        .intro {
            max-width: 650px;
        }

        .eyebrow-row {
            display: flex;
            align-items: center;
            gap: 15px;

            margin-bottom: 25px;
        }

        .eyebrow-rule {
            width: 45px;
            height: 1px;
            background: #ec1d66;
        }

        .eyebrow {
            color: #ec1d66;

            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.35em;
            text-transform: uppercase;
        }

        .intro h1 {
            font-family: Georgia, "Times New Roman", serif;

            font-size: clamp(70px, 8vw, 125px);
            line-height: 0.82;

            font-weight: 400;
            letter-spacing: -0.065em;

            text-transform: uppercase;
        }

        .intro h1 .white {
            display: block;
            color: #f7f4f1;
        }

        .intro h1 .pink {
            display: block;
            color: #ec1d66;
        }

        .intro-text {
            max-width: 470px;

            margin-top: 38px;

            color: #a7a7a7;

            font-size: 16px;
            line-height: 1.75;
        }

        .intro-line {
            width: 80px;
            height: 1px;

            margin-top: 35px;

            background: rgba(255, 255, 255, 0.35);
        }

        /* =========================================================
           LOGIN PANEL
        ========================================================= */

        .login-panel {
            width: 100%;

            padding: 42px;

            border: 1px solid rgba(255, 255, 255, 0.14);

            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.075),
                    rgba(255, 255, 255, 0.025)
                );

            box-shadow:
                0 35px 80px rgba(0, 0, 0, 0.45);

            backdrop-filter: blur(18px);
        }

        .panel-label {
            color: #ec1d66;

            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;

            margin-bottom: 12px;
        }

        .login-panel h2 {
            font-family: Georgia, "Times New Roman", serif;

            font-size: 38px;
            line-height: 1;

            font-weight: 400;

            margin-bottom: 10px;
        }

        .panel-description {
            color: #929292;

            font-size: 13px;
            line-height: 1.6;

            margin-bottom: 28px;
        }

        /* =========================================================
           SECURITY BADGE
        ========================================================= */

        .security-badge {
            display: flex;
            align-items: flex-start;
            gap: 12px;

            padding: 14px 15px;

            margin-bottom: 27px;

            border-left: 2px solid #ec1d66;

            background: rgba(236, 29, 102, 0.06);

            color: #bcbcbc;

            font-size: 12px;
            line-height: 1.5;
        }

        .security-icon {
            color: #ec1d66;
            font-size: 15px;
            flex-shrink: 0;
        }

        /* =========================================================
           ERRORS
        ========================================================= */

        .error-summary {
            padding: 13px 15px;

            margin-bottom: 22px;

            border: 1px solid rgba(239, 68, 68, 0.45);

            background: rgba(239, 68, 68, 0.08);

            color: #ff9a9a;

            font-size: 13px;
            line-height: 1.5;
        }

        .error {
            margin-top: 7px;

            color: #ff8b8b;

            font-size: 12px;
            line-height: 1.4;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;

            margin-bottom: 9px;

            color: #d8d8d8;

            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .form-group input {
            width: 100%;
            height: 52px;

            padding: 0 16px;

            border: 1px solid rgba(255, 255, 255, 0.18);

            border-radius: 0;

            outline: none;

            background: rgba(255, 255, 255, 0.045);

            color: #ffffff;

            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;

            transition:
                border-color 0.25s ease,
                background 0.25s ease,
                box-shadow 0.25s ease;
        }

        .form-group input::placeholder {
            color: #666666;
        }

        .form-group input:hover {
            border-color: rgba(255, 255, 255, 0.32);
        }

        .form-group input:focus {
            border-color: #ec1d66;

            background: rgba(236, 29, 102, 0.035);

            box-shadow:
                0 0 0 1px #ec1d66;
        }

        /* =========================================================
           PASSWORD
        ========================================================= */

        .password-wrapper {
            position: relative;
            width: 100%;
        }

        .password-wrapper input {
            padding-right: 55px;
        }

        .toggle-password {
            position: absolute;

            right: 12px;
            top: 50%;

            transform: translateY(-50%);

            display: flex;
            align-items: center;
            justify-content: center;

            width: 34px;
            height: 34px;

            border: none;

            background: transparent;

            color: #777777;

            cursor: pointer;

            transition: color 0.2s ease;
        }

        .toggle-password:hover {
            color: #ec1d66;
        }

        .toggle-password svg {
            width: 19px;
            height: 19px;
        }

        /* =========================================================
           LOGIN BUTTON
        ========================================================= */

        .login-button {
            position: relative;

            width: 100%;
            height: 54px;

            border: 1px solid #ec1d66;

            border-radius: 0;

            background: #ec1d66;

            color: #ffffff;

            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;

            cursor: pointer;

            overflow: hidden;

            transition:
                background 0.25s ease,
                color 0.25s ease,
                transform 0.25s ease;
        }

        .login-button::before {
            content: "";

            position: absolute;

            inset: 0;

            transform: translateX(-101%);

            background: #ffffff;

            transition: transform 0.3s ease;
        }

        .login-button span {
            position: relative;
            z-index: 1;
        }

        .login-button:hover {
            color: #080808;
            transform: translateY(-2px);
        }

        .login-button:hover::before {
            transform: translateX(0);
        }

        .login-button:active {
            transform: translateY(0);
        }

        /* =========================================================
           LINKS
        ========================================================= */

        .links {
            margin-top: 25px;

            text-align: center;
        }

        .links a {
            color: #a0a0a0;

            font-size: 12px;

            text-decoration: none;

            transition:
                color 0.2s ease;
        }

        .links a:hover {
            color: #ec1d66;
        }

        .back-link {
            margin-top: 15px;
        }

        .back-link a {
            color: #686868;

            font-size: 11px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        /* =========================================================
           DECORATIVE ELEMENT
        ========================================================= */

        .corner-mark {
            position: absolute;

            right: 7vw;
            bottom: 38px;

            display: flex;
            align-items: center;
            gap: 12px;

            color: #656565;

            font-size: 9px;
            letter-spacing: 0.3em;
            text-transform: uppercase;

            writing-mode: vertical-rl;
        }

        .corner-mark::before {
            content: "";

            width: 1px;
            height: 55px;

            background: #ec1d66;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1000px) {

            .login-layout {
                grid-template-columns: 1fr;
                gap: 45px;
                max-width: 600px;
            }

            .intro {
                max-width: 600px;
                text-align: center;
                margin: 0 auto;
            }

            .eyebrow-row {
                justify-content: center;
            }

            .intro h1 {
                font-size: clamp(65px, 13vw, 100px);
            }

            .intro-text {
                margin-left: auto;
                margin-right: auto;
            }

            .intro-line {
                margin-left: auto;
                margin-right: auto;
            }

            .corner-mark {
                display: none;
            }
        }

        @media (max-width: 650px) {

            .topbar {
                height: 76px;
                padding: 0 22px;
            }

            .brand {
                font-size: 21px;
            }

            .back-home {
                min-width: auto;
                height: 40px;
                padding: 0 13px;

                font-size: 9px;
            }

            .login-page {
                padding:
                    105px
                    22px
                    50px;
            }

            .login-layout {
                gap: 35px;
            }

            .intro h1 {
                font-size: clamp(52px, 16vw, 82px);
            }

            .intro-text {
                margin-top: 28px;
                font-size: 14px;
            }

            .login-panel {
                padding: 28px 22px;
            }

            .login-panel h2 {
                font-size: 32px;
            }
        }

        @media (max-width: 400px) {

            .brand {
                font-size: 18px;
            }

            .back-home {
                padding: 0 10px;
                font-size: 8px;
            }

            .intro h1 {
                font-size: 48px;
            }

            .login-panel {
                padding: 24px 18px;
            }
        }
    </style>

</head>

<body>

    <div class="login-page">

        <!-- Decorative background text -->
        <div class="background-word">
            SMILE
        </div>

        <!-- =====================================================
             TOP BAR
        ====================================================== -->

        <header class="topbar">

            <a
                href="{{ route('appointments.homepage') }}"
                class="brand"
            >
                Shine <span>&</span> Smile
            </a>

            <a
                href="{{ route('appointments.homepage') }}"
                class="back-home"
            >
                Back Home
            </a>

        </header>


        <!-- =====================================================
             LOGIN CONTENT
        ====================================================== -->

        <main class="login-layout">

            <!-- =================================================
                 LEFT INTRODUCTION
            ================================================== -->

            <section class="intro">

                <div class="eyebrow-row">

                    <span class="eyebrow-rule"></span>

                    <span class="eyebrow">
                        Shine & Smile Dental Clinic
                    </span>

                </div>


                <h1>

                    <span class="white">
                        Welcome
                    </span>

                    <span class="pink">
                        Back.
                    </span>

                </h1>


                <p class="intro-text">
                    Sign in to manage your dental appointments
                    and access your patient portal.
                </p>


                <div class="intro-line"></div>

            </section>


            <!-- =================================================
                 LOGIN PANEL
            ================================================== -->

            <section class="login-panel">

                <div class="panel-label">
                    Appointment Portal
                </div>


                <h2>
                    Sign In
                </h2>


                <p class="panel-description">
                    Enter your account details to continue
                    to your Shine & Smile appointment portal.
                </p>


                <!-- =================================================
                     SECURITY NOTICE
                ================================================== -->

                <div class="security-badge">

                    <span class="security-icon">
                        🔐
                    </span>

                    <span>
                        This portal requires two-factor
                        authentication for added security.
                    </span>

                </div>


                <!-- =================================================
                     VALIDATION ERRORS
                ================================================== -->

                @if ($errors->any())

                    <div class="error-summary">

                        {{ $errors->first() }}

                    </div>

                @endif


                <!-- =================================================
                     LOGIN FORM
                ================================================== -->

                <form
                    method="POST"
                    action="{{ route('appointments.login.store') }}"
                >

                    @csrf


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email Address
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter your email"
                        >

                        @error('email')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="password-wrapper">

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                            >


                            <!-- SHOW / HIDE PASSWORD -->

                            <button
                                type="button"
                                class="toggle-password"
                                id="togglePassword"
                                aria-label="Show password"
                            >

                                <svg
                                    id="eyeIcon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.25 12s3.75-7.5 9.75-7.5S21.75 12 21.75 12 18 19.5 12 19.5 2.25 12 2.25 12z"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="3"
                                        stroke-width="2"
                                    />

                                </svg>

                            </button>

                        </div>


                        @error('password')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- LOGIN BUTTON -->

                    <button
                        type="submit"
                        class="login-button"
                    >
                        <span>
                            Sign In to Appointment Portal
                        </span>
                    </button>

                </form>


                <!-- =================================================
                     LINKS
                ================================================== -->

                <div class="links">

                    @if (Route::has('password.request'))

                        <div>

                            <a
                                href="{{ route('password.request') }}"
                            >
                                Forgot your password?
                            </a>

                        </div>

                    @endif


                    <div class="back-link">
                        <a
                           href="{{ route('appointments.homepage') }}"
                        >
                            ← Back to Main Page
                        </a>

                    </div>

                </div>

            </section>

        </main>


        <!-- =====================================================
             DECORATIVE SCROLL/MARK
        ====================================================== -->

        <div class="corner-mark">
            Shine & Smile
        </div>

    </div>


    <!-- =========================================================
         PASSWORD VISIBILITY JAVASCRIPT
    ========================================================== -->

    <script>

        const togglePassword =
            document.getElementById('togglePassword');

        const password =
            document.getElementById('password');

        const eyeIcon =
            document.getElementById('eyeIcon');


        if (
            togglePassword &&
            password &&
            eyeIcon
        ) {

            togglePassword.addEventListener(
                'click',
                function () {

                    const isPassword =
                        password.type === 'password';


                    password.type =
                        isPassword
                            ? 'text'
                            : 'password';


                    this.setAttribute(
                        'aria-label',
                        isPassword
                            ? 'Hide password'
                            : 'Show password'
                    );


                    eyeIcon.innerHTML =
                        isPassword
                            ? `
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 3l18 18M10.584 10.587A2 2 0 0012 14a2 2 0 001.414-.586M9.88 4.24A10.94 10.94 0 0112 4.5c6 0 9.75 7.5 9.75 7.5a17.55 17.55 0 01-3.184 4.24M6.228 6.228C3.78 8.18 2.25 12 2.25 12S6 19.5 12 19.5a9.73 9.73 0 004.72-1.25"
                                />
                            `
                            : `
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M2.25 12s3.75-7.5 9.75-7.5S21.75 12 21.75 12 18 19.5 12 19.5 2.25 12 2.25 12z"
                                />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="3"
                                    stroke-width="2"
                                />
                            `;

                }
            );

        }

    </script>

</body>

</html>
