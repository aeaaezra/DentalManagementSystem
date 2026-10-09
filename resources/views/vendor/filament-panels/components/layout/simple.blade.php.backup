<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Login | Shine & Smile Dental Clinic</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@500;600;700&family=Caveat:wght@500;600&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at 5% 50%, rgba(244, 114, 182, 0.20), transparent 22%),
                radial-gradient(circle at 95% 20%, rgba(244, 114, 182, 0.14), transparent 20%),
                linear-gradient(135deg, #fff7fa 0%, #ffffff 50%, #fff5f8 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Background decorations */

        .background-circle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .circle-left {
            width: 330px;
            height: 330px;
            left: -180px;
            top: 25%;
            background: rgba(244, 114, 182, 0.12);
        }

        .circle-right {
            width: 280px;
            height: 280px;
            right: -140px;
            bottom: 5%;
            background: rgba(244, 114, 182, 0.10);
        }

        .small-circle {
            position: fixed;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(251, 207, 232, 0.35);
            pointer-events: none;
            z-index: 0;
        }

        .small-circle-one {
            left: -60px;
            top: 10%;
        }

        .small-circle-two {
            right: -50px;
            top: 10%;
        }

        /* Dot patterns */

        .dots {
            position: fixed;
            display: grid;
            grid-template-columns: repeat(3, 7px);
            gap: 10px;
            z-index: 0;
            opacity: 0.65;
        }

        .dots span {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #f9a8d4;
        }

        .dots-left {
            left: 42px;
            top: 120px;
        }

        .dots-right {
            right: 45px;
            bottom: 120px;
        }

        /* Sparkles */

        .sparkle {
            position: fixed;
            color: #f472b6;
            font-size: 28px;
            z-index: 0;
            pointer-events: none;
        }

        .sparkle-one {
            left: 75px;
            top: 80px;
        }

        .sparkle-two {
            right: 80px;
            top: 155px;
        }

        .sparkle-three {
            left: 65px;
            bottom: 90px;
        }

        /* Hearts */

        .heart {
            position: fixed;
            color: #f9a8d4;
            font-size: 42px;
            z-index: 0;
            pointer-events: none;
        }

        .heart-one {
            left: 145px;
            bottom: 75px;
        }

        .heart-two {
            right: 50px;
            bottom: 70px;
            font-size: 55px;
        }

        /* Main wrapper */

        .page-wrapper {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 45px 20px;
        }

        /* Back button */

        .back-button {
            position: fixed;
            top: 28px;
            left: 30px;
            z-index: 10;

            display: flex;
            align-items: center;
            gap: 8px;

            color: #64748b;
            font-size: 15px;
            font-weight: 600;

            text-decoration: none;

            transition: all 0.2s ease;
        }

        .back-button:hover {
            color: #db2777;
            transform: translateX(-2px);
        }

        /* Main card */

        .login-container {
            width: 100%;
            max-width: 470px;

            background: rgba(255, 255, 255, 0.96);

            border: 1px solid rgba(244, 114, 182, 0.18);

            border-radius: 28px;

            padding: 42px;

            box-shadow:
                0 25px 60px rgba(190, 24, 93, 0.10),
                0 10px 25px rgba(15, 23, 42, 0.06);

            position: relative;
            overflow: hidden;
        }

        /* Decorative bottom shapes */

        .login-container::before {
            content: "";
            position: absolute;
            width: 180px;
            height: 100px;
            border-radius: 50%;
            background: rgba(251, 207, 232, 0.28);
            left: -90px;
            bottom: -50px;
        }

        .login-container::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 100px;
            border-radius: 50%;
            background: rgba(251, 207, 232, 0.28);
            right: -90px;
            bottom: -50px;
        }

        /* Logo */

        .brand {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
        }

        .brand-logo {
            width: 68px;
            height: 68px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(
                135deg,
                #ec4899,
                #db2777
            );

            color: white;

            font-size: 29px;

            box-shadow:
                0 12px 25px rgba(219, 39, 119, 0.25);
        }

        .brand-text {
            text-align: left;
        }

        .brand-text h1 {
            margin: 0;

            font-family: 'Playfair Display', serif;

            color: #db2777;

            font-size: 28px;
            font-weight: 700;

            line-height: 1;
        }

        .brand-text span {
            display: block;

            margin-top: 7px;

            color: #9f8290;

            font-size: 9px;
            font-weight: 700;

            letter-spacing: 5px;
        }

        /* Tagline */

        .tagline {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 13px;

            margin: 25px 0 30px;
        }

        .tagline-line {
            width: 45px;
            height: 1px;
            background: #f9a8d4;
        }

        .tagline-text {
            color: #db2777;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 3px;

            white-space: nowrap;
        }

        /* Admin icon */

        .admin-icon-wrapper {
            width: 78px;
            height: 78px;

            margin: 0 auto 18px;

            border-radius: 22px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #fce7f3;

            color: #db2777;

            font-size: 32px;

            box-shadow:
                0 10px 25px rgba(219, 39, 119, 0.10);
        }

        /* Heading */

        .login-heading {
            text-align: center;
            margin-bottom: 8px;
        }

        .login-heading h2 {
            margin: 0;

            color: #172033;

            font-size: 28px;
            font-weight: 800;
        }

        .login-heading p {
            margin: 9px 0 0;

            color: #64748b;

            font-size: 14px;

            line-height: 1.6;
        }

        /* Admin badge */

        .admin-badge {
            width: fit-content;

            margin: 18px auto 28px;

            padding: 7px 13px;

            border-radius: 999px;

            background: #fff1f7;

            color: #db2777;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 1.4px;

            text-transform: uppercase;
        }

        /* Error */

        .error-box {
            display: flex;
            gap: 10px;

            padding: 13px 14px;

            margin-bottom: 20px;

            border-radius: 10px;

            background: #fff1f2;

            border: 1px solid #fecdd3;

            color: #dc2626;

            font-size: 13px;
        }

        .error-box i {
            margin-top: 2px;
        }

        .error-box p {
            margin: 0 0 4px;
        }

        .error-box p:last-child {
            margin-bottom: 0;
        }

        /* Form */

        .form-group {
            margin-bottom: 21px;
        }

        .form-label {
            display: block;

            margin-bottom: 8px;

            color: #334155;

            font-size: 13px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;

            left: 15px;
            top: 50%;

            transform: translateY(-50%);

            color: #c084a7;

            font-size: 15px;

            pointer-events: none;
        }

        .form-input {
            width: 100%;

            height: 50px;

            padding: 0 45px 0 43px;

            border: 1px solid #e2e8f0;

            border-radius: 11px;

            outline: none;

            background: #fff;

            color: #1e293b;

            font-size: 14px;

            transition: all 0.2s ease;
        }

        .form-input::placeholder {
            color: #a8b1bd;
        }

        .form-input:focus {
            border-color: #db2777;

            box-shadow:
                0 0 0 3px rgba(219, 39, 119, 0.10);
        }

        .password-toggle {
            position: absolute;

            right: 14px;
            top: 50%;

            transform: translateY(-50%);

            border: 0;
            background: transparent;

            color: #db2777;

            cursor: pointer;

            font-size: 15px;
        }

        .password-toggle:hover {
            color: #be185d;
        }

        .field-error {
            margin-top: 6px;

            color: #ef4444;

            font-size: 12px;
        }

        /* Options */

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin: 5px 0 24px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;

            color: #64748b;

            font-size: 13px;

            cursor: pointer;
        }

        .remember-label input {
            width: 16px;
            height: 16px;

            accent-color: #db2777;

            cursor: pointer;
        }

        .forgot-link {
            color: #db2777;

            font-size: 13px;
            font-weight: 600;

            text-decoration: none;
        }

        .forgot-link:hover {
            color: #be185d;
        }

        /* Submit */

        .submit-button {
            width: 100%;
            height: 52px;

            border: 0;
            border-radius: 11px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            background: linear-gradient(
                135deg,
                #ec4899,
                #db2777
            );

            color: white;

            font-size: 15px;
            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 10px 22px rgba(219, 39, 119, 0.22);

            transition: all 0.2s ease;
        }

        .submit-button:hover {
            transform: translateY(-1px);

            box-shadow:
                0 14px 28px rgba(219, 39, 119, 0.28);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        /* Security */

        .security-message {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            margin-top: 25px;

            color: #94a3b8;

            font-size: 10px;
            font-weight: 700;

            letter-spacing: 1.5px;

            text-transform: uppercase;
        }

        .security-message i {
            color: #db2777;
        }

        /* Footer */

        .footer {
            text-align: center;

            margin-top: 25px;

            color: #94a3b8;

            font-size: 11px;
        }

        .footer strong {
            color: #db2777;
        }

        /* Responsive */

        @media (max-width: 600px) {

            .page-wrapper {
                padding: 80px 16px 30px;
            }

            .login-container {
                padding: 30px 22px;
                border-radius: 22px;
            }

            .back-button {
                top: 20px;
                left: 20px;
            }

            .brand-logo {
                width: 58px;
                height: 58px;
                font-size: 25px;
            }

            .brand-text h1 {
                font-size: 24px;
            }

            .brand-text span {
                font-size: 8px;
                letter-spacing: 4px;
            }

            .login-heading h2 {
                font-size: 24px;
            }

            .circle-left,
            .circle-right {
                opacity: 0.5;
            }

            .dots-left {
                left: 15px;
            }

            .dots-right {
                right: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- Background Decorations -->

    <div class="background-circle circle-left"></div>
    <div class="background-circle circle-right"></div>

    <div class="small-circle small-circle-one"></div>
    <div class="small-circle small-circle-two"></div>

    <div class="dots dots-left">
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

    <div class="dots dots-right">
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

    <div class="heart heart-one">♡</div>
    <div class="heart heart-two">♡</div>


    <!-- Back -->



    <!-- Main -->

    <main class="page-wrapper">

        <div class="login-container">

            <!-- Brand -->

            <div class="brand">

                <div class="brand-logo">
                    <i class="fa-solid fa-tooth"></i>
                </div>

                <div class="brand-text">
                    <h1>Shine & Smile</h1>
                    <span>DENTAL CLINIC</span>
                </div>

            </div>


            <!-- Tagline -->

            <div class="tagline">

                <span class="tagline-line"></span>

                <span class="tagline-text">
                    YOUR SMILE, OUR PRIORITY
                </span>

                <span class="tagline-line"></span>

            </div>


            <!-- Admin Icon -->

            <div class="admin-icon-wrapper">
                <i class="fa-solid fa-user-shield"></i>
            </div>


            <!-- Heading -->

            <div class="login-heading">

                <h2>
                    Admin Login
                </h2>

                <p>
                    Sign in to access the Shine & Smile
                    Dental Management System.
                </p>

            </div>


            <!-- Admin Badge -->

            <div class="admin-badge">
                <i class="fa-solid fa-shield-halved"></i>
                Administrator Access
            </div>


            <!-- Status -->

            @if (session('status'))

                <div class="error-box"
                     style="background:#f0fdf4; border-color:#bbf7d0; color:#16a34a;">

                    <i class="fa-solid fa-circle-check"></i>

                    <div>
                        {{ session('status') }}
                    </div>

                </div>

            @endif


            <!-- Login Form -->

            <form
                method="POST"
                action="{{ route('admin.login.store') }}"
            >

                @csrf


                <!-- Email -->

                <div class="form-group">

                    <label
                        for="email"
                        class="form-label"
                    >
                        Email Address
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-envelope input-icon"></i>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter your administrator email"
                            class="form-input"
                        >

                    </div>

                    @error('email')

                        <p class="field-error">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <!-- Password -->

                <div class="form-group">

                    <label
                        for="password"
                        class="form-label"
                    >
                        Password
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-lock input-icon"></i>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="form-input"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword()"
                            aria-label="Show password"
                        >
                            <i
                                id="eyeIcon"
                                class="fa-solid fa-eye"
                            ></i>
                        </button>

                    </div>

                    @error('password')

                        <p class="field-error">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <!-- Options -->

                <div class="form-options">

                    <label class="remember-label">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >

                        <span>
                            Remember me
                        </span>

                    </label>


                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="forgot-link"
                        >
                            Forgot password?
                        </a>

                    @endif

                </div>


                <!-- Submit -->

                <button
                    type="submit"
                    class="submit-button"
                >

                    <i class="fa-solid fa-right-to-bracket"></i>

                    Sign In to Admin Portal

                </button>

            </form>


            <!-- Security -->

            <div class="security-message">

                <i class="fa-solid fa-shield-halved"></i>

                Authorized Administrators Only

            </div>


            <!-- Footer -->

            <div class="footer">

                © 2026
                <strong>Shine & Smile Dental Clinic</strong>.
                All rights reserved.

            </div>

        </div>

    </main>


    <!-- Password Toggle -->

    <script>

        function togglePassword() {

            const password =
                document.getElementById('password');

            const eyeIcon =
                document.getElementById('eyeIcon');

            if (password.type === 'password') {

                password.type = 'text';

                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');

            } else {

                password.type = 'password';

                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');

            }

        }

    </script>

</body>

</html>
