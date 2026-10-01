<x-guest-layout>

    <style>
        /* ==========================================================
           SHINE & SMILE
           FORGOT PASSWORD PAGE
        ========================================================== */

        .forgot-password-page {
            width: 100%;
            min-height: 100vh;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 40px 20px;

            background:
                radial-gradient(
                    circle at top left,
                    rgba(249, 168, 212, 0.20),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #fff7fa 0%,
                    #ffffff 55%,
                    #fff1f6 100%
                );
        }


        /* ==========================================================
           BRAND
        ========================================================== */

        .forgot-brand {
            display: flex;
            align-items: center;

            gap: 11px;

            margin-bottom: 22px;
        }

        .forgot-logo {
            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 13px;

            background: #e91e63;
            color: #ffffff;

            box-shadow:
                0 7px 18px rgba(233, 30, 99, 0.20);
        }

        .forgot-logo svg {
            width: 27px;
            height: 27px;
        }

        .forgot-brand-text {
            display: flex;
            flex-direction: column;
        }

        .forgot-brand-text strong {
            color: #111827;

            font-size: 17px;
            font-weight: 800;

            line-height: 1.2;
        }

        .forgot-brand-text span {
            margin-top: 3px;

            color: #94a3b8;

            font-size: 10px;
            font-weight: 600;

            line-height: 1.2;
        }


        /* ==========================================================
           CARD
        ========================================================== */

        .forgot-card {
            width: 100%;
            max-width: 440px;

            padding: 35px;

            background: #ffffff;

            border: 1px solid #f3e8ee;
            border-radius: 22px;

            box-shadow:
                0 18px 50px rgba(15, 23, 42, 0.08);
        }


        /* ==========================================================
           ICON
        ========================================================== */

        .forgot-icon {
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

        .forgot-icon svg {
            width: 28px;
            height: 28px;
        }


        /* ==========================================================
           HEADING
        ========================================================== */

        .forgot-heading {
            text-align: center;

            margin-bottom: 26px;
        }

        .forgot-heading h1 {
            margin: 0;

            color: #111827;

            font-size: 25px;
            font-weight: 800;

            line-height: 1.25;

            letter-spacing: -0.02em;
        }

        .forgot-heading p {
            margin: 9px auto 0;

            max-width: 350px;

            color: #64748b;

            font-size: 12px;
            line-height: 1.65;
        }


        /* ==========================================================
           SUCCESS MESSAGE
        ========================================================== */

        .forgot-success {
            display: block;

            margin-bottom: 18px;

            padding: 12px 14px;

            border: 1px solid #bbf7d0;
            border-radius: 10px;

            background: #f0fdf4;

            color: #15803d;

            font-size: 12px;
            line-height: 1.5;
        }


        /* ==========================================================
           FORM
        ========================================================== */

        .forgot-form {
            width: 100%;
        }

        .forgot-form-group {
            width: 100%;
        }

        .forgot-form-group label {
            display: block;

            margin-bottom: 7px;

            color: #374151;

            font-size: 12px;
            font-weight: 700;
        }


        /* ==========================================================
           INPUT
        ========================================================== */

        .forgot-input-wrapper {
            position: relative;

            width: 100%;
        }

        .forgot-input-wrapper svg {
            position: absolute;

            top: 50%;
            left: 14px;

            width: 18px;
            height: 18px;

            transform: translateY(-50%);

            color: #94a3b8;

            pointer-events: none;
        }

        .forgot-input-wrapper input {
            width: 100%;
            height: 46px;

            padding: 0 14px 0 43px;

            border: 1px solid #e5e7eb;
            border-radius: 11px;

            outline: none;

            background: #ffffff;
            color: #1f2937;

            font-family: inherit;
            font-size: 13px;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .forgot-input-wrapper input::placeholder {
            color: #cbd5e1;
        }

        .forgot-input-wrapper input:hover {
            border-color: #f9a8d4;
        }

        .forgot-input-wrapper input:focus {
            border-color: #e91e63;

            box-shadow:
                0 0 0 3px rgba(233, 30, 99, 0.09);
        }


        /* ==========================================================
           ERROR
        ========================================================== */

        .forgot-error {
            margin-top: 7px;

            color: #dc2626;

            font-size: 11px;
            line-height: 1.5;
        }


        /* ==========================================================
           SUBMIT BUTTON
        ========================================================== */

        .forgot-submit {
            width: 100%;
            height: 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            margin-top: 18px;

            border: 0;
            border-radius: 11px;

            background: #e91e63;
            color: #ffffff;

            cursor: pointer;

            font-family: inherit;
            font-size: 12px;
            font-weight: 700;

            box-shadow:
                0 7px 18px rgba(233, 30, 99, 0.18);

            transition:
                background 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .forgot-submit svg {
            width: 17px;
            height: 17px;
        }

        .forgot-submit:hover {
            background: #d81b60;

            transform: translateY(-1px);

            box-shadow:
                0 9px 22px rgba(233, 30, 99, 0.24);
        }

        .forgot-submit:active {
            transform: translateY(0);
        }

        .forgot-submit:focus-visible {
            outline: 3px solid rgba(233, 30, 99, 0.18);
            outline-offset: 2px;
        }


        /* ==========================================================
           BACK TO LOGIN
        ========================================================== */

        .forgot-back-login {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 6px;

            margin-top: 22px;

            color: #64748b;

            font-size: 12px;
            font-weight: 600;

            text-decoration: none;

            transition: color 0.2s ease;
        }

        .forgot-back-login svg {
            width: 16px;
            height: 16px;
        }

        .forgot-back-login:hover {
            color: #e91e63;
        }


        /* ==========================================================
           SECURITY MESSAGE
        ========================================================== */

        .forgot-security {
            display: flex;
            align-items: flex-start;

            gap: 8px;

            margin-top: 24px;
            padding-top: 18px;

            border-top: 1px solid #f3e8ee;

            color: #94a3b8;

            font-size: 10px;
            line-height: 1.55;
        }

        .forgot-security svg {
            width: 15px;
            height: 15px;

            flex-shrink: 0;

            margin-top: 1px;

            color: #e91e63;
        }


        /* ==========================================================
           FOOTER
        ========================================================== */

        .forgot-footer {
            margin: 20px 0 0;

            color: #a1a1aa;

            font-size: 10px;

            text-align: center;
        }


        /* ==========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 600px) {

            .forgot-password-page {
                padding: 25px 15px;
            }

            .forgot-card {
                padding: 28px 22px;

                border-radius: 18px;
            }

            .forgot-heading h1 {
                font-size: 22px;
            }

            .forgot-heading p {
                font-size: 11px;
            }

            .forgot-logo {
                width: 42px;
                height: 42px;
            }

            .forgot-brand-text strong {
                font-size: 16px;
            }
        }


        @media (max-width: 380px) {

            .forgot-password-page {
                padding: 20px 12px;
            }

            .forgot-card {
                padding: 25px 18px;
            }

            .forgot-heading h1 {
                font-size: 20px;
            }
        }
    </style>


    {{-- ==========================================================
         MAIN PAGE
    =========================================================== --}}

    <div class="forgot-password-page">


        {{-- ======================================================
             BRAND
        ======================================================= --}}

        <div class="forgot-brand">

            <div class="forgot-logo">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path
                        d="M7 3C5.2 3 4 4.5 4 6.5C4 9.5 5.2 11.5 6 14.5C6.6 16.8 6.8 21 9 21C10.8 21 11 17 12 17C13 17 13.2 21 15 21C17.2 21 17.4 16.8 18 14.5C18.8 11.5 20 9.5 20 6.5C20 4.5 18.8 3 17 3C15.3 3 14.1 4.2 12 4.2C9.9 4.2 8.7 3 7 3Z"
                    />

                </svg>

            </div>


            <div class="forgot-brand-text">

                <strong>
                    Shine & Smile
                </strong>

                <span>
                    Dental Clinic
                </span>

            </div>

        </div>


        {{-- ======================================================
             FORGOT PASSWORD CARD
        ======================================================= --}}

        <div class="forgot-card">


            {{-- Icon --}}

            <div class="forgot-icon">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <rect
                        x="3"
                        y="5"
                        width="18"
                        height="14"
                        rx="2"
                    />

                    <path d="m3 7 9 6 9-6" />

                    <path d="M16 16h3" />

                </svg>

            </div>


            {{-- Heading --}}

            <div class="forgot-heading">

                <h1>
                    Forgot your password?
                </h1>

                <p>
                    No worries. Enter the email address
                    associated with your account and we'll
                    send you a secure password reset link.
                </p>

            </div>


            {{-- ==================================================
                 SUCCESS MESSAGE
            =================================================== --}}

            <x-auth-session-status
                class="forgot-success"
                :status="session('status')"
            />


            {{-- ==================================================
                 FORM
            =================================================== --}}

            <form
                method="POST"
                action="{{ route('password.email') }}"
                class="forgot-form"
            >

                @csrf


                {{-- EMAIL --}}

                <div class="forgot-form-group">

                    <label for="email">
                        Email Address
                    </label>


                    <div class="forgot-input-wrapper">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="14"
                                rx="2"
                            />

                            <path d="m3 7 9 6 9-6" />

                        </svg>


                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email address"
                            autocomplete="email"
                            required
                            autofocus
                        >

                    </div>


                    {{-- ERROR --}}

                    @if ($errors->get('email'))

                        <div class="forgot-error">

                            @foreach ($errors->get('email') as $error)

                                <span>
                                    {{ $error }}
                                </span>

                            @endforeach

                        </div>

                    @endif

                </div>


                {{-- SUBMIT --}}

                <button
                    type="submit"
                    class="forgot-submit"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path d="M22 2 11 13" />

                        <path d="m22 2-7 20-4-9-9-4Z" />

                    </svg>

                    <span>
                        Send Reset Link
                    </span>

                </button>

            </form>


            <a
                href="{{ route('login') }}"
                class="forgot-back-login"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path d="m15 18-6-6 6-6" />

                </svg>

                <span>
                    Back to Login
                </span>

            </a>


            <div class="forgot-security">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <rect
                        x="4"
                        y="10"
                        width="16"
                        height="11"
                        rx="2"
                    />

                    <path d="M8 10V7a4 4 0 0 1 8 0v3" />

                    <circle
                        cx="12"
                        cy="15"
                        r="1"
                    />

                </svg>


                <span>
                    Your account information is protected
                    and your reset link is securely generated.
                </span>

            </div>

        </div>


        <p class="forgot-footer">

            © {{ date('Y') }}
            Shine & Smile Dental Clinic.
            All rights reserved.

        </p>

    </div>

</x-guest-layout>
