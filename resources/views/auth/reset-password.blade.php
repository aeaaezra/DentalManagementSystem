
<x-guest-layout>
    <style>
        .reset-page {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background:
                radial-gradient(circle at top left, rgba(249,168,212,.20), transparent 35%),
                linear-gradient(135deg, #fff7fa 0%, #fff 55%, #fff1f6 100%);
            font-family: Arial, sans-serif;
            color: #111827;
        }

        .reset-page *,
        .reset-page *::before,
        .reset-page *::after {
            box-sizing: border-box;
        }

        .reset-brand {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 22px;
        }

        .reset-logo {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: #e91e63;
            color: white;
            box-shadow: 0 7px 18px rgba(233,30,99,.20);
        }

        .reset-logo svg {
            width: 27px;
            height: 27px;
        }

        .reset-brand-text {
            display: flex;
            flex-direction: column;
        }

        .reset-brand-text strong {
            color: #111827;
            font-size: 17px;
            font-weight: 800;
            line-height: 1.2;
        }

        .reset-brand-text span {
            margin-top: 3px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 600;
            line-height: 1.2;
        }

        .reset-card {
            width: 100%;
            max-width: 440px;
            padding: 35px;
            background: #fff;
            border: 1px solid #f3e8ee;
            border-radius: 22px;
            box-shadow: 0 18px 50px rgba(15,23,42,.08);
        }

        .reset-icon {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border-radius: 16px;
            background: #fce7f3;
            color: #e91e63;
            border: 1px solid #fbcfe8;
        }

        .reset-icon svg {
            width: 28px;
            height: 28px;
        }

        .reset-heading {
            margin-bottom: 25px;
            text-align: center;
        }

        .reset-heading h1 {
            margin: 0;
            color: #111827;
            font-size: 25px;
            font-weight: 800;
            line-height: 1.25;
            letter-spacing: -.02em;
        }

        .reset-heading p {
            margin: 9px auto 0;
            max-width: 350px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.65;
        }

        .reset-group {
            width: 100%;
            margin-top: 17px;
        }

        .reset-group label {
            display: block;
            margin-bottom: 7px;
            color: #374151;
            font-size: 12px;
            font-weight: 700;
        }

        .reset-input-wrap {
            display: flex;
            align-items: center;
            width: 100%;
            min-height: 46px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            border-radius: 11px;
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
        }

        .reset-input-wrap:focus-within {
            border-color: #e91e63;
            box-shadow: 0 0 0 3px rgba(233,30,99,.09);
        }

        .reset-input-wrap input {
            width: 100%;
            min-width: 0;
            height: 44px;
            padding: 0 13px;
            border: 0;
            outline: none;
            background: transparent;
            color: #1f2937;
            font-family: inherit;
            font-size: 13px;
            box-shadow: none;
        }

        .reset-input-wrap input:focus {
            outline: none;
            box-shadow: none;
        }

        .reset-input-wrap input::placeholder {
            color: #cbd5e1;
        }

        .reset-toggle {
            flex-shrink: 0;
            height: 44px;
            padding: 0 13px;
            border: 0;
            background: transparent;
            color: #e91e63;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .reset-toggle:hover {
            color: #be185d;
        }

        .reset-error {
            margin-top: 7px;
            color: #dc2626;
            font-size: 11px;
            line-height: 1.5;
        }

        .reset-checker {
            margin-top: 11px;
            padding: 13px;
            border: 1px solid #f3e8ee;
            border-radius: 11px;
            background: #fff9fc;
        }

        .reset-checker-heading {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
            color: #374151;
            font-size: 11px;
            font-weight: 700;
        }

        .reset-strength-label {
            color: #64748b;
        }

        .reset-strength-track {
            display: flex;
            gap: 5px;
            margin-bottom: 13px;
        }

        .reset-strength-segment {
            flex: 1;
            height: 5px;
            border-radius: 99px;
            background: #e5e7eb;
        }

        .reset-strength-segment.active {
            background: #e91e63;
        }

        .reset-rules {
            display: grid;
            grid-template-columns: 1fr;
            gap: 7px;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .reset-rules li {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
            font-size: 11px;
            line-height: 1.45;
        }

        .reset-rule-icon {
            display: inline-flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            width: 17px;
            height: 17px;
            border: 1px solid #d1d5db;
            border-radius: 50%;
            font-size: 10px;
        }

        .reset-rules li.passed {
            color: #15803d;
        }

        .reset-rules li.passed .reset-rule-icon {
            border-color: #86efac;
            background: #f0fdf4;
        }

        .reset-match {
            min-height: 17px;
            margin-top: 7px;
            color: #64748b;
            font-size: 11px;
        }

        .reset-submit {
            width: 100%;
            min-height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 21px;
            border: 0;
            border-radius: 11px;
            background: #e91e63;
            color: #fff;
            cursor: pointer;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 7px 18px rgba(233,30,99,.18);
            transition: background .2s, transform .2s, box-shadow .2s;
        }

        .reset-submit:hover {
            background: #d81b60;
            transform: translateY(-1px);
            box-shadow: 0 9px 22px rgba(233,30,99,.24);
        }

        .reset-submit:focus-visible,
        .reset-toggle:focus-visible {
            outline: 3px solid rgba(233,30,99,.22);
            outline-offset: 2px;
        }

        .reset-security {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-top: 23px;
            padding-top: 17px;
            border-top: 1px solid #f3e8ee;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.55;
        }

        .reset-security svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
            margin-top: 1px;
            color: #e91e63;
        }

        .reset-footer {
            margin-top: 20px;
            color: #a1a1aa;
            font-size: 10px;
            text-align: center;
        }

        @media (max-width: 600px) {
            .reset-page {
                padding: 25px 15px;
            }

            .reset-card {
                padding: 28px 22px;
                border-radius: 18px;
            }

            .reset-heading h1 {
                font-size: 22px;
            }
        }

        @media (max-width: 380px) {
            .reset-page {
                padding: 20px 12px;
            }

            .reset-card {
                padding: 25px 18px;
            }

            .reset-heading h1 {
                font-size: 20px;
            }
        }
    </style>

    <main class="reset-page">
        <header class="reset-brand">
            <div class="reset-logo" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3.2c-2.1-1.5-5.2-.7-6.4 1.5-1.6 2.8-.1 6.2.8 9.2.8 2.6 1.2 6.5 3.1 6.5 1.6 0 1.2-5.1 2.5-5.1s.9 5.1 2.5 5.1c1.9 0 2.3-3.9 3.1-6.5.9-3 2.4-6.4.8-9.2C17.2 2.5 14.1 1.7 12 3.2Z"/>
                </svg>
            </div>
            <div class="reset-brand-text">
                <strong>Shine &amp; Smile</strong>
                <span>Dental Management System</span>
            </div>
        </header>

        <section class="reset-card">
            <div class="reset-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <rect x="4" y="10" width="16" height="11" rx="2"/>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                    <path d="M12 14v3"/>
                </svg>
            </div>

            <div class="reset-heading">
                <h1>Create a new password</h1>
                <p>Choose a strong password to help keep your Shine &amp; Smile account secure.</p>
            </div>

            @if (session('status'))
                <div role="status" style="margin-bottom:16px;color:#15803d;font-size:12px;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="reset-group">
                    <label for="email">Email address</label>
                    <div class="reset-input-wrap">
                        <input id="email" type="email" name="email"
                               value="{{ old('email', $request->email) }}"
                               required autofocus autocomplete="username"
                               placeholder="you@example.com">
                    </div>
                    @if ($errors->get('email'))
                        <div class="reset-error" role="alert">
                            @foreach ($errors->get('email') as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="reset-group">
                    <label for="password">New password</label>
                    <div class="reset-input-wrap">
                        <input id="password" type="password" name="password"
                               required autocomplete="new-password"
                               placeholder="Enter your new password">
                        <button class="reset-toggle" type="button"
                                data-toggle-password="password"
                                aria-controls="password" aria-pressed="false">Show</button>
                    </div>

                    @if ($errors->get('password'))
                        <div class="reset-error" role="alert">
                            @foreach ($errors->get('password') as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <section class="reset-checker" aria-live="polite">
                        <div class="reset-checker-heading">
                            <span>Password strength</span>
                            <span class="reset-strength-label" id="strength-label">Not entered</span>
                        </div>

                        <div class="reset-strength-track" aria-hidden="true">
                            <span class="reset-strength-segment"></span>
                            <span class="reset-strength-segment"></span>
                            <span class="reset-strength-segment"></span>
                            <span class="reset-strength-segment"></span>
                        </div>

                        <ul class="reset-rules">
                            <li data-rule="length"><span class="reset-rule-icon">•</span>At least 8 characters</li>
                            <li data-rule="lower"><span class="reset-rule-icon">•</span>One lowercase letter (a–z)</li>
                            <li data-rule="upper"><span class="reset-rule-icon">•</span>One uppercase letter (A–Z)</li>
                            <li data-rule="number"><span class="reset-rule-icon">•</span>One number (0–9)</li>
                            <li data-rule="symbol"><span class="reset-rule-icon">•</span>One special character</li>
                        </ul>
                    </section>
                </div>

                <div class="reset-group">
                    <label for="password_confirmation">Confirm new password</label>
                    <div class="reset-input-wrap">
                        <input id="password_confirmation" type="password"
                               name="password_confirmation" required
                               autocomplete="new-password"
                               placeholder="Enter your password again">
                        <button class="reset-toggle" type="button"
                                data-toggle-password="password_confirmation"
                                aria-controls="password_confirmation"
                                aria-pressed="false">Show</button>
                    </div>

                    <div class="reset-match" id="password-match" aria-live="polite"></div>

                    @if ($errors->get('password_confirmation'))
                        <div class="reset-error" role="alert">
                            @foreach ($errors->get('password_confirmation') as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <button class="reset-submit" type="submit">RESET PASSWORD</button>
            </form>

            <div class="reset-security">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/>
                    <path d="m9 12 2 2 4-4"/>
                </svg>
                <span>Your password is protected by the Shine &amp; Smile account security process. Never share it with anyone.</span>
            </div>
        </section>

        <footer class="reset-footer">© {{ date('Y') }} Shine &amp; Smile Dental. All rights reserved.</footer>
    </main>

    <script>
        (() => {
            const password = document.getElementById('password');
            const confirmation = document.getElementById('password_confirmation');

            if (!password || !confirmation) return;

            document.querySelectorAll('[data-toggle-password]').forEach(button => {
                button.addEventListener('click', () => {
                    const input = document.getElementById(button.dataset.togglePassword);
                    if (!input) return;

                    const show = input.type === 'password';
                    input.type = show ? 'text' : 'password';
                    button.textContent = show ? 'Hide' : 'Show';
                    button.setAttribute('aria-pressed', String(show));
                });
            });

            const rules = {
                length: value => value.length >= 8,
                lower: value => /[a-z]/.test(value),
                upper: value => /[A-Z]/.test(value),
                number: value => /[0-9]/.test(value),
                symbol: value => /[^A-Za-z0-9]/.test(value)
            };

            const strengthLabel = document.getElementById('strength-label');
            const segments = document.querySelectorAll('.reset-strength-segment');
            const matchMessage = document.getElementById('password-match');

            function updatePasswordMatch() {
                if (!confirmation.value) {
                    matchMessage.textContent = '';
                    matchMessage.style.color = '';
                } else if (password.value === confirmation.value) {
                    matchMessage.textContent = '✓ Passwords match';
                    matchMessage.style.color = '#15803d';
                } else {
                    matchMessage.textContent = 'Passwords do not match yet';
                    matchMessage.style.color = '#dc2626';
                }
            }

            function updatePasswordChecker() {
                const value = password.value;
                let passed = 0;

                Object.entries(rules).forEach(([name, test]) => {
                    const item = document.querySelector(`[data-rule="${name}"]`);
                    const valid = test(value);

                    if (valid) passed++;

                    if (item) {
                        item.classList.toggle('passed', valid);
                        const icon = item.querySelector('.reset-rule-icon');
                        if (icon) icon.textContent = valid ? '✓' : '•';
                    }
                });

                segments.forEach((segment, index) => {
                    segment.classList.toggle(
                        'active',
                        value.length > 0 && index < Math.min(4, Math.ceil(passed * 4 / 5))
                    );
                });

                if (!value) {
                    strengthLabel.textContent = 'Not entered';
                } else if (passed <= 2) {
                    strengthLabel.textContent = 'Weak';
                } else if (passed <= 4) {
                    strengthLabel.textContent = 'Moderate';
                } else {
                    strengthLabel.textContent = 'Strong';
                }

                updatePasswordMatch();
            }

            password.addEventListener('input', updatePasswordChecker);
            confirmation.addEventListener('input', updatePasswordMatch);

            updatePasswordChecker();
        })();
    </script>
</x-guest-layout>
