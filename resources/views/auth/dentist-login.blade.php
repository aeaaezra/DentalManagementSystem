<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fce7f0">
    <title>Dentist Portal Login | Shine and Smile</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: #302432;
            background:
                radial-gradient(circle at 12% 12%, #ffe0ed 0, transparent 32%),
                radial-gradient(circle at 90% 90%, #fbd4e5 0, transparent 30%),
                #fff8fb;
        }

        .page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 18px;
            position: relative;
            overflow: hidden;
        }

        .decoration {
            position: absolute;
            width: 230px;
            height: 230px;
            border-radius: 50%;
            background: #f8b7d2;
            opacity: .22;
            pointer-events: none;
        }

        .decoration.one {
            top: -100px;
            left: -65px;
        }

        .decoration.two {
            bottom: -120px;
            right: -60px;
            width: 300px;
            height: 300px;
        }

        .login-card {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            max-width: 920px;
            overflow: hidden;
            background: #fff;
            border: 1px solid #f6d8e5;
            border-radius: 24px;
            box-shadow: 0 22px 65px rgba(166, 55, 104, .12);
        }

        .brand-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 34px;
            text-align: center;
            background: linear-gradient(150deg, #fff0f6, #fbd5e5);
        }

        .logo-wrap {
            width: 190px;
            height: 190px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
            padding: 12px;
            background: #fff;
            border: 1px solid #f6d3e2;
            border-radius: 24px;
            box-shadow: 0 10px 28px rgba(186, 70, 120, .10);
        }

        .logo-wrap img {
            display: block;
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .brand-panel h1 {
            color: #a92760;
            font-size: 27px;
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .brand-panel p {
            max-width: 310px;
            color: #795568;
            font-size: 14px;
            line-height: 1.8;
        }

        .portal-tag {
            display: inline-block;
            margin-top: 24px;
            padding: 9px 15px;
            color: #a92760;
            background: rgba(255,255,255,.75);
            border: 1px solid #efbfd4;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .form-panel {
            padding: 54px 46px;
            align-self: center;
        }

        .eyebrow {
            color: #d04483;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            margin-bottom: 13px;
        }

        .form-panel h2 {
            color: #302432;
            font-size: 30px;
            line-height: 1.25;
            margin-bottom: 12px;
        }

        .intro {
            color: #827681;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .error-summary {
            margin-bottom: 20px;
            padding: 13px 15px;
            border: 1px solid #f4b8c8;
            border-radius: 10px;
            background: #fff1f4;
            color: #b4234e;
            font-size: 13px;
            line-height: 1.6;
        }

        .error-summary ul {
            padding-left: 18px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #443540;
            font-size: 13px;
            font-weight: 700;
        }

        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="text"] {
            width: 100%;
            height: 51px;
            padding: 0 14px;
            color: #302432;
            background: #fff;
            border: 1px solid #e9d6e0;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-group input:focus {
            border-color: #e65b98;
            box-shadow: 0 0 0 3px rgba(230, 91, 152, .13);
        }

        .password-wrap {
            position: relative;
        }

        .password-wrap input {
            padding-right: 76px !important;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #c13e7b;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin: 2px 0 25px;
            font-size: 12px;
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #756874;
            cursor: pointer;
        }

        .remember input {
            accent-color: #d83e82;
            width: 15px;
            height: 15px;
        }

        a {
            color: #c73578;
            font-weight: 700;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            min-height: 51px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(110deg, #e94d91, #c82c72);
            color: white;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(200, 44, 114, .2);
            transition: transform .2s, box-shadow .2s;
        }

        .submit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 11px 22px rgba(200, 44, 114, .26);
        }

        .back-link {
            display: block;
            margin-top: 24px;
            text-align: center;
            font-size: 13px;
            color: #827681;
        }

        .security-note {
            margin-top: 28px;
            padding-top: 17px;
            border-top: 1px solid #f2e7ed;
            color: #9a8b96;
            text-align: center;
            font-size: 11px;
            line-height: 1.6;
        }

        @media (max-width: 700px) {
            .page {
                padding: 20px 14px;
            }

            .login-card {
                max-width: 470px;
                grid-template-columns: 1fr;
                border-radius: 18px;
            }

            .brand-panel {
                padding: 27px 22px;
            }

            .logo-wrap {
                width: 95px;
                height: 95px;
                margin-bottom: 15px;
                border-radius: 17px;
            }

            .brand-panel h1 {
                font-size: 21px;
            }

            .brand-panel p {
                font-size: 13px;
            }

            .portal-tag {
                margin-top: 14px;
            }

            .form-panel {
                padding: 32px 25px;
            }

            .form-panel h2 {
                font-size: 26px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                transition: none !important;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="decoration one"></div>
        <div class="decoration two"></div>

        <section class="login-card" aria-label="Dentist portal login">
            <div class="brand-panel">
                <div class="logo-wrap">
                    <img
                        src="{{ asset('images/logo.jpg') }}"
                        alt="Shine and Smile logo"
                        onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=&quot;color:#c73578;font-size:38px;font-weight:800&quot;>S&amp;S</span>';"
                    >
                </div>

                <h1>Shine and Smile</h1>
                <p>
                    Your professional workspace for managing dental
                    care and accessing your dentist portal.
                </p>

                <span class="portal-tag">DENTIST PORTAL</span>
            </div>

            <div class="form-panel">
                <div class="eyebrow">Welcome back</div>
                <h2>Sign in to your portal</h2>
                <p class="intro">
                    Enter your registered dentist account credentials
                    to continue.
                </p>

                @if ($errors->any())
                    <div class="error-summary" role="alert">
                        <strong>We couldn't sign you in.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="error-summary" role="status"
                         style="background:#f0fff5;border-color:#b7e5c5;color:#176b3a;">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('dentist.login.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            autocomplete="username"
                            required
                            autofocus
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-wrap">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >
                            <button
                                class="toggle-password"
                                type="button"
                                id="togglePassword"
                                aria-controls="password"
                                aria-pressed="false"
                            >Show</button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember" for="remember">
                            <input
                                id="remember"
                                type="checkbox"
                                name="remember"
                                value="1"
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            Remember me
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button class="submit-btn" type="submit">
                        Sign in to Dentist Portal
                    </button>
                </form>

                <a class="back-link" href="{{ url('/dentist/welcome') }}">
                    &larr; Back to dentist landing page
                </a>

                <div class="security-note">
                    Authorized dentist accounts only.
                    Your session is protected by secure authentication.
                </div>
            </div>
        </section>
    </main>

    <script>
        (function () {
            const password = document.getElementById('password');
            const toggle = document.getElementById('togglePassword');

            if (password && toggle) {
                toggle.addEventListener('click', function () {
                    const showPassword = password.type === 'password';

                    password.type = showPassword ? 'text' : 'password';
                    toggle.textContent = showPassword ? 'Hide' : 'Show';
                    toggle.setAttribute('aria-pressed', String(showPassword));
                });
            }
        })();
    </script>
</body>
</html>
