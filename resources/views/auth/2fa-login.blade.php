<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Two-Factor Authentication | Shine & Smile</title>

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

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            overflow-x: hidden;
        }


        /* =========================================================
           MAIN PAGE
        ========================================================= */

        .two-factor-page {
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


        .two-factor-page::before {
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


        /* =========================================================
           BACKGROUND TEXT
        ========================================================= */

        .background-word {
            position: absolute;

            right: -50px;
            bottom: -15px;

            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size:
                clamp(
                    180px,
                    25vw,
                    420px
                );

            line-height: 0.7;

            font-weight: 700;

            letter-spacing: -0.08em;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.025
                );

            pointer-events: none;

            user-select: none;

            white-space: nowrap;
        }


        /* =========================================================
           TOP BAR
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

            padding:
                0 7vw;

            border-bottom:
                1px solid
                rgba(
                    255,
                    255,
                    255,
                    0.09
                );

            background:
                rgba(
                    8,
                    8,
                    8,
                    0.72
                );

            backdrop-filter: blur(12px);
        }


        .brand {
            color: #ffffff;

            text-decoration: none;

            font-family:
                Georgia,
                "Times New Roman",
                serif;

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

            padding:
                0 20px;

            border:
                1px solid
                rgba(
                    255,
                    255,
                    255,
                    0.55
                );

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

        .two-factor-layout {
            position: relative;

            z-index: 2;

            width: 100%;

            max-width: 1240px;

            display: grid;

            grid-template-columns:
                minmax(0, 1fr)
                minmax(360px, 470px);

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
            font-family:
                Georgia,
                "Times New Roman",
                serif;

            font-size:
                clamp(
                    65px,
                    8vw,
                    120px
                );

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

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.35
                );
        }


        /* =========================================================
           2FA PANEL
        ========================================================= */

        .two-factor-panel {
            width: 100%;

            padding: 42px;

            border:
                1px solid
                rgba(
                    255,
                    255,
                    255,
                    0.14
                );

            background:
                linear-gradient(
                    145deg,
                    rgba(
                        255,
                        255,
                        255,
                        0.075
                    ),
                    rgba(
                        255,
                        255,
                        255,
                        0.025
                    )
                );

            box-shadow:
                0 35px 80px
                rgba(
                    0,
                    0,
                    0,
                    0.45
                );

            backdrop-filter: blur(18px);
        }


        /* =========================================================
           PANEL HEADER
        ========================================================= */

        .panel-label {
            color: #ec1d66;

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 0.28em;

            text-transform: uppercase;

            margin-bottom: 12px;
        }


        .two-factor-panel h2 {
            font-family:
                Georgia,
                "Times New Roman",
                serif;

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
           AUTHENTICATOR NOTICE
        ========================================================= */

        .authenticator-notice {
            display: flex;

            align-items: flex-start;

            gap: 12px;

            padding:
                14px 15px;

            margin-bottom: 27px;

            border-left:
                2px solid #ec1d66;

            background:
                rgba(
                    236,
                    29,
                    102,
                    0.06
                );

            color: #bcbcbc;

            font-size: 12px;

            line-height: 1.5;
        }


        .authenticator-icon {
            color: #ec1d66;

            font-size: 16px;

            flex-shrink: 0;
        }


        /* =========================================================
           ERROR
        ========================================================= */

        .otp-error {
            padding:
                13px 15px;

            margin-bottom: 22px;

            border:
                1px solid
                rgba(
                    239,
                    68,
                    68,
                    0.45
                );

            background:
                rgba(
                    239,
                    68,
                    68,
                    0.08
                );

            color: #ff9a9a;

            font-size: 13px;

            line-height: 1.5;
        }


        /* =========================================================
           OTP FIELD
        ========================================================= */

        .otp-label {
            display: block;

            margin-bottom: 9px;

            color: #d8d8d8;

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 0.18em;

            text-transform: uppercase;
        }


        .otp-input {
            width: 100%;

            height: 62px;

            padding:
                0 15px;

            border:
                1px solid
                rgba(
                    255,
                    255,
                    255,
                    0.18
                );

            border-radius: 0;

            outline: none;

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.045
                );

            color: #ffffff;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            font-size: 25px;

            font-weight: 600;

            letter-spacing: 0.45em;

            text-align: center;

            transition:
                border-color 0.25s ease,
                background 0.25s ease,
                box-shadow 0.25s ease;
        }


        .otp-input::placeholder {
            color: #555555;

            font-size: 14px;

            font-weight: 400;

            letter-spacing: 0.08em;
        }


        .otp-input:hover {
            border-color:
                rgba(
                    255,
                    255,
                    255,
                    0.32
                );
        }


        .otp-input:focus {
            border-color: #ec1d66;

            background:
                rgba(
                    236,
                    29,
                    102,
                    0.035
                );

            box-shadow:
                0 0 0 1px #ec1d66;
        }


        /* =========================================================
           VERIFY BUTTON
        ========================================================= */

        .verify-button {
            position: relative;

            width: 100%;

            height: 54px;

            margin-top: 22px;

            border:
                1px solid #ec1d66;

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


        .verify-button::before {
            content: "";

            position: absolute;

            inset: 0;

            transform:
                translateX(-101%);

            background: #ffffff;

            transition:
                transform 0.3s ease;
        }


        .verify-button span {
            position: relative;

            z-index: 1;
        }


        .verify-button:hover {
            color: #080808;

            transform:
                translateY(-2px);
        }


        .verify-button:hover::before {
            transform:
                translateX(0);
        }


        .verify-button:active {
            transform:
                translateY(0);
        }


        /* =========================================================
           BOTTOM LINKS
        ========================================================= */

        .links {
            margin-top: 25px;

            text-align: center;
        }


        .links a {
            color: #777777;

            font-size: 11px;

            letter-spacing: 0.08em;

            text-decoration: none;

            text-transform: uppercase;

            transition:
                color 0.2s ease;
        }


        .links a:hover {
            color: #ec1d66;
        }


        /* =========================================================
           DECORATIVE MARK
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

            .two-factor-layout {
                grid-template-columns: 1fr;

                gap: 45px;

                max-width: 600px;
            }


            .intro {
                max-width: 600px;

                text-align: center;

                margin:
                    0 auto;
            }


            .eyebrow-row {
                justify-content: center;
            }


            .intro h1 {
                font-size:
                    clamp(
                        60px,
                        13vw,
                        100px
                    );
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

                padding:
                    0 22px;
            }


            .brand {
                font-size: 21px;
            }


            .back-home {
                min-width: auto;

                height: 40px;

                padding:
                    0 13px;

                font-size: 9px;
            }


            .two-factor-page {
                padding:
                    105px
                    22px
                    50px;
            }


            .two-factor-layout {
                gap: 35px;
            }


            .intro h1 {
                font-size:
                    clamp(
                        52px,
                        16vw,
                        82px
                    );
            }


            .intro-text {
                margin-top: 28px;

                font-size: 14px;
            }


            .two-factor-panel {
                padding:
                    28px 22px;
            }


            .two-factor-panel h2 {
                font-size: 32px;
            }


            .otp-input {
                height: 58px;

                font-size: 22px;

                letter-spacing:
                    0.35em;
            }
        }


        @media (max-width: 400px) {

            .brand {
                font-size: 18px;
            }


            .back-home {
                padding:
                    0 10px;

                font-size: 8px;
            }


            .intro h1 {
                font-size: 48px;
            }


            .two-factor-panel {
                padding:
                    24px 18px;
            }
        }

    </style>

</head>


<body>

    <div class="two-factor-page">

        <!-- =====================================================
             BACKGROUND
        ====================================================== -->

        <div class="background-word">
            VERIFY
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
             MAIN CONTENT
        ====================================================== -->

        <main class="two-factor-layout">


            <!-- =================================================
                 LEFT INTRODUCTION
            ================================================== -->

            <section class="intro">

                <div class="eyebrow-row">

                    <span class="eyebrow-rule"></span>

                    <span class="eyebrow">
                        Secure Access
                    </span>

                </div>


                <h1>

                    <span class="white">
                        Verify
                    </span>

                    <span class="pink">
                        Identity.
                    </span>

                </h1>


                <p class="intro-text">
                    One more step to securely access
                    your Shine & Smile appointment portal.
                    Enter the verification code from
                    your authenticator app.
                </p>


                <div class="intro-line"></div>

            </section>


            <!-- =================================================
                 2FA PANEL
            ================================================== -->

            <section class="two-factor-panel">

                <div class="panel-label">
                    Two-Factor Authentication
                </div>


                <h2>
                    Verify Code
                </h2>


                <p class="panel-description">
                    Enter the 6-digit code generated by
                    your Google Authenticator app.
                </p>


                <!-- =================================================
                     AUTHENTICATOR NOTICE
                ================================================== -->

                <div class="authenticator-notice">

                    <span class="authenticator-icon">
                        🔐
                    </span>

                    <span>
                        Your account is protected with
                        two-factor authentication.
                    </span>

                </div>


                <!-- =================================================
                     VALIDATION ERROR
                ================================================== -->

                @error('otp')

                    <div class="otp-error">
                        {{ $message }}
                    </div>

                @enderror


                <!-- =================================================
                     OTP FORM
                ================================================== -->

                <form
                    action="{{ route('2fa.login.verify') }}"
                    method="POST"
                >

                    @csrf


                    <label
                        for="otp"
                        class="otp-label"
                    >
                        Verification Code
                    </label>


                    <input
                        id="otp"
                        type="text"
                        name="otp"
                        maxlength="6"
                        minlength="6"
                        inputmode="numeric"
                        autocomplete="one-time-code"
                        pattern="[0-9]{6}"
                        placeholder="000000"
                        value="{{ old('otp') }}"
                        required
                        autofocus
                        class="otp-input"
                    >


                    <button
                        type="submit"
                        class="verify-button"
                    >
                        <span>
                            Verify Code
                        </span>
                    </button>

                </form>


                <!-- =================================================
                     LINK
                ================================================== -->

                <div class="links">
                    <a href="{{ route('appointments.homepage') }}">
                        ← Return to Main Page
                    </a>

                </div>

            </section>

        </main>


        <!-- =====================================================
             DECORATIVE MARK
        ====================================================== -->

        <div class="corner-mark">
            Shine & Smile
        </div>

    </div>

</body>

</html>
