<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Customer Login | Ordering System</title>

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
            min-height: 100%;
        }

        body {
            min-height: 100vh;

            margin: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: #29242a;

            background:
                radial-gradient(
                    circle at center,
                    #ffffff 0%,
                    #fff7fb 45%,
                    #ffe8f2 100%
                );

            overflow-x: hidden;
        }


        /* =========================================================
           MAIN PAGE
        ========================================================= */

        .login-page {
            position: relative;

            min-height: 100vh;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            padding: 40px 20px;

            overflow: hidden;
        }


        /* =========================================================
           BACKGROUND PINK SHAPES
        ========================================================= */

        .pink-shape-top {
            position: absolute;

            top: -170px;
            left: -180px;

            width: 520px;
            height: 310px;

            background:
                linear-gradient(
                    135deg,
                    #f48ab6,
                    #fbd2e1
                );

            border-radius:
                0 0 65% 50%;

            transform: rotate(-7deg);

            opacity: .75;

            pointer-events: none;
        }


        .pink-shape-bottom {
            position: absolute;

            right: -180px;
            bottom: -180px;

            width: 520px;
            height: 310px;

            background:
                linear-gradient(
                    135deg,
                    #ffd5e4,
                    #f374ab
                );

            border-radius:
                65% 0 0 0;

            transform: rotate(-8deg);

            opacity: .8;

            pointer-events: none;
        }


        /* =========================================================
           DOTS
        ========================================================= */

        .dots {
            position: absolute;

            display: grid;

            grid-template-columns:
                repeat(4, 6px);

            gap: 10px;

            pointer-events: none;

            z-index: 1;
        }

        .dots span {
            width: 6px;
            height: 6px;

            background: #eb71a5;

            border-radius: 50%;

            opacity: .8;
        }

        .dots-top {
            top: 45px;
            right: 50px;
        }

        .dots-bottom {
            bottom: 45px;
            left: 40px;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .header {
            position: relative;

            z-index: 2;

            width: 100%;

            text-align: center;

            margin-bottom: 25px;
        }


        /* =========================================================
           LOGO
        ========================================================= */

        .logo {
            width: 85px;
            height: 85px;

            margin:
                0 auto 15px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                2px solid #e9327b;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, .75);

            box-shadow:
                0 8px 25px
                rgba(225, 45, 115, .12);
        }

        .logo svg {
            width: 42px;
            height: 42px;

            color: #e9327b;
        }


        /* =========================================================
           HEADER TITLE
        ========================================================= */

        .header h1 {
            font-size: 32px;

            line-height: 1.15;

            font-weight: 700;

            letter-spacing: -.6px;
        }

        .header h1 .pink {
            color: #df2873;
        }

        .header h1 .dark {
            color: #29252a;
        }

        .header p {
            margin-top: 7px;

            color: #68636a;

            font-size: 14px;

            line-height: 1.5;
        }


        /* =========================================================
           LOGIN CARD
        ========================================================= */

        .login-card {
            position: relative;

            z-index: 3;

            width: 100%;

            max-width: 500px;

            padding: 32px;

            background:
                rgba(255, 255, 255, .97);

            border:
                1px solid
                rgba(235, 78, 140, .24);

            border-radius: 16px;

            box-shadow:
                0 20px 55px
                rgba(221, 52, 116, .14);
        }


        /* =========================================================
           CARD HEADING
        ========================================================= */

        .card-heading {
            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 25px;
        }

        .heading-line {
            flex: 1;

            height: 1px;

            background:
                linear-gradient(
                    to right,
                    transparent,
                    #ef91b8
                );
        }

        .heading-line.right {
            background:
                linear-gradient(
                    to left,
                    transparent,
                    #ef91b8
                );
        }

        .heading-icon {
            width: 38px;
            height: 38px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #fde5ef;

            color: #e52d76;

            border-radius: 50%;
        }

        .heading-icon svg {
            width: 20px;
            height: 20px;
        }

        .card-heading h2 {
            color: #df2873;

            font-size: 21px;

            font-weight: 700;

            white-space: nowrap;
        }


        /* =========================================================
           ERROR MESSAGE
        ========================================================= */

        .error-summary {
            margin-bottom: 20px;

            padding: 12px 14px;

            border-left:
                3px solid #e52d76;

            border-radius: 6px;

            background: #fff0f5;

            color: #c12665;

            font-size: 13px;

            line-height: 1.5;
        }

        .error {
            margin-top: 6px;

            color: #d62c6f;

            font-size: 11px;
        }


        /* =========================================================
           FORM
        ========================================================= */

        .form-group {
            margin-bottom: 19px;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            color: #302b31;

            font-size: 14px;

            font-weight: 700;
        }


        /* =========================================================
           INPUT WRAPPER
        ========================================================= */

        .input-wrapper {
            position: relative;

            width: 100%;
        }


        /* =========================================================
           INPUT ICON
        ========================================================= */

        .input-icon {
            position: absolute;

            left: 15px;
            top: 50%;

            width: 19px;
            height: 19px;

            transform:
                translateY(-50%);

            color: #ed4387;

            pointer-events: none;
        }


        /* =========================================================
           INPUT
        ========================================================= */

        .input-wrapper input {
            width: 100%;

            height: 52px;

            padding:
                0 45px;

            border:
                1.5px solid #f3bfd4;

            border-radius: 9px;

            outline: none;

            background: #ffffff;

            color: #29252b;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            font-size: 14px;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .input-wrapper input::placeholder {
            color: #aaa6aa;
        }

        .input-wrapper input:hover {
            border-color: #ed8bb4;
        }

        .input-wrapper input:focus {
            border-color: #e9367d;

            background: #fffafd;

            box-shadow:
                0 0 0 3px
                rgba(233, 54, 125, .08);
        }


        /* =========================================================
           PASSWORD TOGGLE
        ========================================================= */

        .toggle-password {
            position: absolute;

            right: 7px;
            top: 50%;

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            transform:
                translateY(-50%);

            border: none;

            border-radius: 6px;

            background: transparent;

            color: #e9367d;

            cursor: pointer;
        }

        .toggle-password:hover {
            background: #fff0f6;
        }

        .toggle-password svg {
            width: 19px;
            height: 19px;
        }


        /* =========================================================
           OPTIONS
        ========================================================= */

        .form-options {
            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 20px;
        }

        .remember {
            display: flex;

            align-items: center;

            gap: 8px;

            color: #403a40;

            font-size: 13px;

            cursor: pointer;
        }

        .remember input {
            width: 18px;
            height: 18px;

            margin: 0;

            accent-color: #e9347d;

            cursor: pointer;
        }

        .forgot-password {
            color: #df2873;

            font-size: 13px;

            font-weight: 700;

            text-decoration: none;
        }

        .forgot-password:hover {
            color: #bc185d;

            text-decoration: underline;
        }


        /* =========================================================
           SIGN IN BUTTON
        ========================================================= */

        .login-button {
            width: 100%;

            height: 54px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 10px;

            border: none;

            border-radius: 9px;

            background:
                linear-gradient(
                    135deg,
                    #ed4c91,
                    #e91e70
                );

            color: #ffffff;

            font-size: 16px;

            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 8px 20px
                rgba(229, 44, 115, .20);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .login-button:hover {
            transform:
                translateY(-1px);

            box-shadow:
                0 12px 25px
                rgba(229, 44, 115, .28);
        }

        .login-button:active {
            transform:
                translateY(0);
        }

        .login-button svg {
            width: 21px;
            height: 21px;
        }


        /* =========================================================
           SUPPORT
        ========================================================= */

        .support {
            position: relative;

            z-index: 2;

            margin-top: 24px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            color: #6c676d;

            font-size: 13px;

            text-align: center;
        }

        .support svg {
            width: 19px;
            height: 19px;

            color: #e9347d;
        }

        .support a {
            color: #df2873;

            font-weight: 600;

            text-decoration: none;
        }

        .support a:hover {
            text-decoration: underline;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .footer {
            position: relative;

            z-index: 2;

            margin-top: 25px;

            color: #8b858b;

            font-size: 11px;

            text-align: center;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 600px) {

            .login-page {
                padding:
                    30px 15px;
            }

            .logo {
                width: 72px;
                height: 72px;
            }

            .logo svg {
                width: 36px;
                height: 36px;
            }

            .header h1 {
                font-size: 27px;
            }

            .header p {
                font-size: 13px;
            }

            .login-card {
                max-width: 450px;

                padding:
                    25px 20px;
            }

            .card-heading h2 {
                font-size: 18px;
            }

            .heading-icon {
                width: 34px;
                height: 34px;
            }

            .form-options {
                gap: 10px;
            }

            .remember,
            .forgot-password {
                font-size: 12px;
            }

            .support {
                flex-wrap: wrap;
            }

            .dots-top {
                top: 20px;
                right: 20px;
            }

            .dots-bottom {
                bottom: 20px;
                left: 20px;
            }

            .pink-shape-top {
                width: 350px;
                height: 200px;
            }

            .pink-shape-bottom {
                width: 350px;
                height: 220px;
            }
        }


        @media (max-width: 400px) {

            .login-card {
                padding:
                    22px 16px;
            }

            .card-heading {
                gap: 7px;
            }

            .card-heading h2 {
                font-size: 16px;
            }

            .form-options {
                flex-direction: column;

                align-items: flex-start;
            }

            .forgot-password {
                align-self: flex-end;
            }
        }

    </style>

</head>


<body>

    <div class="login-page">


        <!-- =====================================================
             BACKGROUND
        ====================================================== -->

        <div class="pink-shape-top"></div>

        <div class="pink-shape-bottom"></div>


        <!-- =====================================================
             TOP DOTS
        ====================================================== -->

        <div class="dots dots-top">

            <span></span>
            <span></span>
            <span></span>
            <span></span>

            <span></span>
            <span></span>
            <span></span>
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


        <!-- =====================================================
             BOTTOM DOTS
        ====================================================== -->

        <div class="dots dots-bottom">

            <span></span>
            <span></span>
            <span></span>
            <span></span>

            <span></span>
            <span></span>
            <span></span>
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


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <header class="header">


            <!-- LOGO -->

            <div class="logo">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.7"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 3h2l2.4 11.2a2 2 0 002 1.6h7.8a2 2 0 001.9-1.4L21 7H6"
                    />

                    <circle
                        cx="10"
                        cy="20"
                        r="1.2"
                    />

                    <circle
                        cx="18"
                        cy="20"
                        r="1.2"
                    />

                    <path
                        stroke-linecap="round"
                        d="M12 9.5c.7-1.3 3-1.1 3 .7 0 1.5-3 3-3 3s-3-1.5-3-3c0-1.8 2.3-2 3-.7z"
                    />

                </svg>

            </div>


            <!-- TITLE -->

            <h1>

                <span class="pink">
                    Ordering
                </span>

                <span class="dark">
                    System
                </span>

            </h1>


            <p>
                Welcome back! Please sign in to continue.
            </p>

        </header>


        <!-- =====================================================
             LOGIN CARD
        ====================================================== -->

        <main class="login-card">


            <!-- CARD HEADING -->

            <div class="card-heading">

                <div class="heading-line"></div>


                <div class="heading-icon">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M6 11h12l1 9H5l1-9z"
                        />

                    </svg>

                </div>


                <h2>
                    Customer Login
                </h2>


                <div class="heading-line right"></div>

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
                action="{{ route('customer.login.store') }}"
            >

                @csrf


                <!-- =================================================
                     EMAIL
                ================================================== -->

                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>


                    <div class="input-wrapper">


                        <!-- EMAIL ICON -->

                        <svg
                            class="input-icon"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />

                        </svg>


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

                    </div>


                    @error('email')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- =================================================
                     PASSWORD
                ================================================== -->

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>


                    <div class="input-wrapper">


                        <!-- PASSWORD ICON -->

                        <svg
                            class="input-icon"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 11h14a1 1 0 011 1v8a1 1 0 01-1 1H5a1 1 0 01-1-1v-8a1 1 0 011-1z"
                            />

                        </svg>


                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                        >


                        <!-- PASSWORD TOGGLE -->

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


                <!-- =================================================
                     OPTIONS
                ================================================== -->

                <div class="form-options">


                    <!-- REMEMBER ME -->

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >

                        <span>
                            Remember me
                        </span>

                    </label>


                    <!-- FORGOT PASSWORD -->

                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="forgot-password"
                        >
                            Forgot Password?
                        </a>

                    @endif

                </div>


                <!-- =================================================
                     SIGN IN BUTTON
                ================================================== -->

                <button
                    type="submit"
                    class="login-button"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"
                        />

                    </svg>


                    <span>
                        Sign In
                    </span>

                </button>

            </form>

        </main>


        <!-- =====================================================
             SUPPORT
        ====================================================== -->

        <div class="support">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M18 10a6 6 0 00-12 0v3a2 2 0 002 2h1v-5H7a5 5 0 0110 0h-2v5h1a2 2 0 002-2v-3zM9 20h6"
                />

            </svg>


            <span>
                Need help?
            </span>


            <a href="{{ route('contact') }}">
                Contact our support team.
            </a>

        </div>


        <!-- =====================================================
             FOOTER
        ====================================================== -->

        <footer class="footer">

            © {{ date('Y') }}
            Ordering System.
            All rights reserved.

        </footer>

    </div>


    <!-- =========================================================
         PASSWORD VISIBILITY
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
