
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Sign Up | Ordering System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --pink: #ed2479;
            --pink-dark: #d91768;
            --pink-light: #fff0f6;
            --border: #f3d5e2;
            --text: #202438;
            --muted: #73798c;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 36px 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, #fbd0e3 0, transparent 240px),
                radial-gradient(circle at bottom right, #fac5dc 0, transparent 300px),
                #fff6fa;
        }

        .signup-wrapper {
            width: 100%;
            max-width: 520px;
        }

        .brand {
            text-align: center;
            margin-bottom: 25px;
        }

        .brand-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid var(--pink);
            border-radius: 50%;
            color: var(--pink);
            background: white;
            font-size: 32px;
            box-shadow: 0 8px 25px #ed24791a;
        }

        .brand h1 {
            margin: 0;
            font-size: clamp(25px, 5vw, 32px);
            letter-spacing: -1px;
        }

        .brand h1 span {
            color: var(--pink);
        }

        .brand p {
            color: var(--muted);
            font-size: 14px;
            margin: 10px 0 0;
        }

        .signup-card {
            padding: 30px 32px;
            background: #fff;
            border: 1px solid #ffd0e3;
            border-radius: 20px;
            box-shadow: 0 18px 60px #d84b8512;
        }

        .card-heading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 25px;
            color: var(--pink);
            font-size: 21px;
            font-weight: 700;
        }

        .card-heading::before,
        .card-heading::after {
            content: "";
            height: 1px;
            flex: 1;
            background: #f6dce7;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 17px 14px;
        }

        .field {
            min-width: 0;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap input {
            width: 100%;
            height: 49px;
            padding: 0 43px 0 14px;
            border: 1px solid #e9dce3;
            border-radius: 10px;
            outline: none;
            background: #fff;
            color: var(--text);
            font-size: 14px;
            transition: border-color .2s, box-shadow .2s;
        }

        .input-wrap input:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px #ed247916;
        }

        .input-wrap input::placeholder {
            color: #a0a3af;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            padding: 6px;
            background: transparent;
            color: var(--pink);
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .field-hint {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .error-text {
            display: block;
            margin-top: 6px;
            color: #d92345;
            font-size: 12px;
        }

        .password-meter {
            height: 5px;
            margin-top: 9px;
            overflow: hidden;
            border-radius: 10px;
            background: #f0e8ed;
        }

        .password-meter-fill {
            height: 100%;
            width: 0;
            border-radius: inherit;
            background: #d92345;
            transition: width .2s, background .2s;
        }

        .password-status {
            margin-top: 6px;
            color: var(--muted);
            font-size: 11px;
        }

        .password-checks {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 7px;
            margin-top: 10px;
            color: var(--muted);
            font-size: 11px;
        }

        .password-checks span::before {
            content: "○";
            margin-right: 6px;
        }

        .password-checks span.valid {
            color: #16834a;
        }

        .password-checks span.valid::before {
            content: "✓";
        }

        .match-status {
            min-height: 15px;
            margin-top: 6px;
            font-size: 11px;
        }

        .terms {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-top: 22px;
            font-size: 12px;
            line-height: 1.6;
            color: var(--muted);
        }

        .terms input {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin: 2px 0 0;
            accent-color: var(--pink);
        }

        .terms a,
        .login-link a {
            color: var(--pink);
            font-weight: 700;
            text-decoration: none;
        }

        .terms a:hover,
        .login-link a:hover {
            text-decoration: underline;
        }

        .submit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 52px;
            margin-top: 22px;
            border: 0;
            border-radius: 10px;
            color: white;
            background: linear-gradient(110deg, #ec4a95, #e91872);
            box-shadow: 0 10px 24px #ed24792c;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
        }

        .submit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 13px 28px #ed247936;
        }

        .submit-btn:disabled {
            cursor: not-allowed;
            opacity: .65;
            transform: none;
        }

        .login-link {
            margin-top: 22px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }

        .security-note {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            margin-top: 20px;
            color: var(--muted);
            font-size: 11px;
        }

        .alert-error {
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid #ffc8d1;
            border-radius: 10px;
            background: #fff1f3;
            color: #b4233c;
            font-size: 13px;
        }

        .alert-error ul {
            margin: 6px 0 0;
            padding-left: 20px;
        }

        @media (max-width: 480px) {
            body {
                padding: 24px 12px;
                align-items: flex-start;
            }

            .signup-card {
                padding: 24px 18px;
                border-radius: 16px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .field.full {
                grid-column: auto;
            }

            .password-checks {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>

<body>
<div class="signup-wrapper">

    <header class="brand">
        <div class="brand-icon" aria-hidden="true">🛒</div>
        <h1><span>Ordering</span> System</h1>
        <p>Create your customer account to get started.</p>
    </header>

    <main class="signup-card">
        <div class="card-heading">Create Account</div>

        @if ($errors->any())
            <div class="alert-error" role="alert">
                <strong>Please check your information.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="signupForm"
              action="{{ url('/customer/register') }}"
              method="POST">
            @csrf

            <div class="form-grid">

                <div class="field">
                    <label for="name">Full Name *</label>
                    <div class="input-wrap">
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            autocomplete="name"
                            maxlength="100"
                            required>
                    </div>
                    @error('name')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label for="phone">Phone Number</label>
                    <div class="input-wrap">
                        <input
                            id="phone"
                            name="phone"
                            type="tel"
                            value="{{ old('phone') }}"
                            placeholder="e.g. 09XXXXXXXXX"
                            autocomplete="tel"
                            maxlength="20">
                    </div>
                    @error('phone')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field full">
                    <label for="email">Email Address *</label>
                    <div class="input-wrap">
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            autocomplete="email"
                            maxlength="255"
                            required>
                    </div>
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field full">
                    <label for="password">Password *</label>
                    <div class="input-wrap">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Create a strong password"
                            autocomplete="new-password"
                            minlength="8"
                            required>
                        <button class="toggle-password"
                                type="button"
                                data-target="password"
                                aria-label="Show password"
                                aria-pressed="false">SHOW</button>
                    </div>

                    <div class="password-meter">
                        <div id="passwordMeterFill"
                             class="password-meter-fill"></div>
                    </div>
                    <div id="passwordStatus" class="password-status">
                        Use at least 8 characters.
                    </div>

                    <div class="password-checks">
                        <span id="checkLength">At least 8 characters</span>
                        <span id="checkUpper">One uppercase letter</span>
                        <span id="checkLower">One lowercase letter</span>
                        <span id="checkNumber">One number</span>
                        <span id="checkSymbol">One special character</span>
                    </div>

                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field full">
                    <label for="password_confirmation">
                        Confirm Password *
                    </label>
                    <div class="input-wrap">
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="Enter your password again"
                            autocomplete="new-password"
                            minlength="8"
                            required>
                        <button class="toggle-password"
                                type="button"
                                data-target="password_confirmation"
                                aria-label="Show confirmation password"
                                aria-pressed="false">SHOW</button>
                    </div>
                    <div id="matchStatus"
                         class="match-status"
                         aria-live="polite"></div>
                </div>

            </div>

            <label class="terms">
                <input id="terms" name="terms" type="checkbox" value="1"
                       required>
                <span>
                    I agree to the
                    <a href="{{ url('/terms') }}" target="_blank"
                       rel="noopener">Terms and Conditions</a>
                    and
                    <a href="{{ url('/privacy-policy') }}" target="_blank"
                       rel="noopener">Privacy Policy</a>.
                </span>
            </label>

            <button id="submitButton" class="submit-btn" type="submit">
                Create My Account
            </button>
        </form>

        <div class="login-link">
            Already have an account?
            <a href="{{ url('/customer/login') }}">Sign In</a>
        </div>

        <div class="security-note">
            <span aria-hidden="true">🔒</span>
            Your account information is protected.
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const password = document.getElementById('password');
    const confirmation = document.getElementById('password_confirmation');
    const form = document.getElementById('signupForm');
    const meter = document.getElementById('passwordMeterFill');
    const status = document.getElementById('passwordStatus');
    const matchStatus = document.getElementById('matchStatus');

    // Show / hide password buttons
    document.querySelectorAll('.toggle-password').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(button.dataset.target);
            const showPassword = input.type === 'password';

            input.type = showPassword ? 'text' : 'password';
            button.textContent = showPassword ? 'HIDE' : 'SHOW';
            button.setAttribute('aria-pressed', String(showPassword));
            button.setAttribute(
                'aria-label',
                (showPassword ? 'Hide ' : 'Show ') +
                (input.id === 'password' ? 'password' : 'confirmation password')
            );
        });
    });

    function updatePasswordStrength() {
        const value = password.value;

        const checks = {
            checkLength: value.length >= 8,
            checkUpper: /[A-Z]/.test(value),
            checkLower: /[a-z]/.test(value),
            checkNumber: /[0-9]/.test(value),
            checkSymbol: /[^A-Za-z0-9]/.test(value)
        };

        let score = 0;

        Object.keys(checks).forEach(function (id) {
            const element = document.getElementById(id);
            element.classList.toggle('valid', checks[id]);
            if (checks[id]) score++;
        });

        const widths = ['0%', '20%', '40%', '60%', '80%', '100%'];
        meter.style.width = widths[score];

        const labels = [
            'Use at least 8 characters.',
            'Very weak',
            'Weak',
            'Fair',
            'Good',
            'Strong password'
        ];

        status.textContent = value.length ? labels[score] : labels[0];
        meter.style.background =
            score <= 2 ? '#d92345' :
            score <= 3 ? '#e6a23c' :
            score === 4 ? '#3182ce' : '#16834a';

        updatePasswordMatch();
    }

    function updatePasswordMatch() {
        if (!confirmation.value) {
            matchStatus.textContent = '';
            matchStatus.style.color = '';
            confirmation.setCustomValidity('');
            return;
        }

        const matches = password.value === confirmation.value;

        matchStatus.textContent = matches
            ? '✓ Passwords match'
            : 'Passwords do not match';

        matchStatus.style.color = matches ? '#16834a' : '#d92345';
        confirmation.setCustomValidity(
            matches ? '' : 'Passwords do not match.'
        );
    }

    password.addEventListener('input', updatePasswordStrength);
    confirmation.addEventListener('input', updatePasswordMatch);

    form.addEventListener('submit', function (event) {
        updatePasswordStrength();
        updatePasswordMatch();

        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
        }
    });
});
</script>
</body>
</html>
