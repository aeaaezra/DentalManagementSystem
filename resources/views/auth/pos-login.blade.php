
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cashier Login | Shine &amp; Smile Dental Clinic</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: Inter, ui-sans-serif, system-ui, sans-serif;
            background: linear-gradient(135deg, #fff8fc, #fff 55%, #fff3f8);
            color: #334155;
        }

        .login-card {
            width: 100%;
            max-width: 500px;
            overflow: hidden;
            background: #fff;
            border-radius: 28px;
            box-shadow: 0 20px 55px rgba(190, 24, 93, .13);
            border: 1px solid #fce7f3;
        }

        .card-content { padding: 34px 36px 26px; }

        .access-badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 11px 17px;
            border-radius: 999px;
            background: #fff0f6;
            color: #ec1675;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .field-label {
            display: block;
            margin-bottom: 10px;
            font-size: 15px;
            font-weight: 700;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute;
            left: 19px;
            top: 50%;
            transform: translateY(-50%);
            color: #c77da6;
        }

        .field {
            width: 100%;
            height: 64px;
            padding: 0 48px 0 54px;
            border: 1px solid #dfe5ef;
            border-radius: 15px;
            background: #fff;
            color: #334155;
            font-size: 16px;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .field:focus {
            border-color: #ec2787;
            box-shadow: 0 0 0 4px rgba(236, 39, 135, .12);
        }

        .password-field { background: #e8f0ff; }

        .toggle-password {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #ec2787;
            cursor: pointer;
        }

        .submit-button {
            width: 100%;
            min-height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border: 0;
            border-radius: 15px;
            background: linear-gradient(110deg, #ed43a0, #df1977);
            color: white;
            font-size: 17px;
            font-weight: 800;
            box-shadow: 0 14px 28px rgba(219, 39, 119, .20);
            cursor: pointer;
            transition: transform .2s, filter .2s;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            filter: brightness(1.04);
        }

        .error-message {
            margin-top: 7px;
            color: #ff3838;
            font-size: 14px;
        }

        .card-footer {
            padding: 18px 16px 24px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            background: radial-gradient(ellipse at bottom left,
                #fff0f7 0, #fff0f7 18%, transparent 18.5%),
                radial-gradient(ellipse at bottom right,
                #fff0f7 0, #fff0f7 18%, transparent 18.5%);
        }

        .card-footer strong { color: #ec1675; }

        @media (max-width: 480px) {
            body { padding: 14px; }
            .login-card { border-radius: 22px; }
            .card-content { padding: 27px 22px 22px; }
            .field { height: 58px; font-size: 15px; }
            .submit-button { min-height: 59px; font-size: 15px; }
        }
    </style>
</head>

<body>
    <main class="login-card">
        <div class="card-content">
            <div class="text-center mb-9">
                <span class="access-badge">
                    <i class="fa-solid fa-cash-register"></i>
                    CASHIER ACCESS
                </span>
            </div>

            <form action="{{ route('pos.login.post') }}" method="POST" class="space-y-7">
                @csrf

                <div>
                    <label for="email" class="field-label">Email Address</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="field"
                            placeholder="Enter your cashier email"
                            autocomplete="username"
                            required
                            autofocus
                        >
                    </div>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="field-label">Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="field password-field"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >
                        <button type="button" id="togglePassword"
                                class="toggle-password"
                                aria-label="Show password">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between gap-3 flex-wrap">
                    <label class="flex items-center gap-2 text-sm text-slate-500 cursor-pointer">
                        <input type="checkbox" name="remember" value="1"
                               class="h-5 w-5 accent-pink-600">
                        Remember me
                    </label>

                    <a href="{{ route('password.request') }}"
                       class="text-sm font-semibold text-pink-600 hover:underline">
                        Forgot password?
                    </a>
                </div>

                @if (session('status'))
                    <p class="text-sm text-green-600">{{ session('status') }}</p>
                @endif

                <button type="submit" class="submit-button">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Sign In to POS
                </button>
            </form>

            <div class="mt-8 text-center text-xs font-bold tracking-widest text-slate-400">
                <i class="fa-solid fa-shield-halved text-pink-500 mr-2"></i>
                AUTHORIZED CASHIERS ONLY
            </div>
        </div>

        <footer class="card-footer">
            &copy; {{ date('Y') }}
            <strong>Shine &amp; Smile Dental Clinic.</strong>
            All rights reserved.
        </footer>
    </main>

    <script>
        const toggleButton = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        toggleButton.addEventListener('click', function () {
            const showing = passwordInput.type === 'password';
            passwordInput.type = showing ? 'text' : 'password';
            toggleButton.innerHTML = showing
                ? '<i class="fa-solid fa-eye-slash"></i>'
                : '<i class="fa-solid fa-eye"></i>';
            toggleButton.setAttribute(
                'aria-label',
                showing ? 'Hide password' : 'Show password'
            );
        });
    </script>
</body>
</html>
