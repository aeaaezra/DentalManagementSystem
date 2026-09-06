<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Google Authenticator Setup
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/receptionist-settings.css') }}"
    >

</head>


<body>

<div class="two-factor-setup-page">

    <div class="two-factor-setup-card">

        {{-- HEADER --}}

        <div class="two-factor-setup-header">

            <div class="setup-icon">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="28"
                    height="28"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <rect
                        x="3"
                        y="11"
                        width="18"
                        height="10"
                        rx="2"
                    ></rect>

                    <path
                        d="M7 11V7a5 5 0 0 1 10 0v4"
                    ></path>

                </svg>

            </div>


            <h1>
                Set Up Google Authenticator
            </h1>

            <p>
                Secure your receptionist account with
                two-factor authentication.
            </p>

        </div>


        {{-- STEP 1 --}}

        <div class="setup-step">

            <div class="step-number">
                1
            </div>

            <div>

                <h3>
                    Install Google Authenticator
                </h3>

                <p>
                    Open the Google Authenticator app
                    on your phone.
                </p>

            </div>

        </div>


        {{-- STEP 2 --}}

        <div class="setup-step">

            <div class="step-number">
                2
            </div>

            <div>

                <h3>
                    Scan the QR Code
                </h3>

                <p>
                    Scan the QR code below using
                    Google Authenticator.
                </p>

            </div>

        </div>


        {{-- QR CODE --}}

        <div class="qr-code-container">

            <div
                id="qrCode"
                data-url="{{ $qrCodeUrl }}"
            ></div>

        </div>


        {{-- SECRET --}}

        <div class="secret-container">

            <span>
                Can't scan the QR code?
            </span>

            <strong>
                {{ $secret }}
            </strong>

        </div>


        {{-- STEP 3 --}}

        <div class="setup-step">

            <div class="step-number">
                3
            </div>

            <div>

                <h3>
                    Enter Verification Code
                </h3>

                <p>
                    Enter the 6-digit code displayed
                    in Google Authenticator.
                </p>

            </div>

        </div>


        {{-- VERIFY FORM --}}

        <form
            action="{{ route('receptionist.settings.2fa.verify') }}"
            method="POST"
            class="two-factor-verify-form"
        >

            @csrf


            <label for="code">
                Verification Code
            </label>


            <input
                type="text"
                id="code"
                name="code"
                inputmode="numeric"
                maxlength="6"
                pattern="[0-9]{6}"
                placeholder="000000"
                autocomplete="one-time-code"
                required
            >


            @error('code')

                <div class="security-error">
                    {{ $message }}
                </div>

            @enderror


            @if(session('two_factor_error'))

                <div class="security-error">

                    {{ session('two_factor_error') }}

                </div>

            @endif


            <button
                type="submit"
                class="primary-button setup-submit-button"
            >

                Verify & Enable

            </button>

        </form>


        {{-- CANCEL --}}

        <a
            href="{{ route('receptionist.settings') }}"
            class="setup-cancel"
        >
            Cancel
        </a>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>

<script src="{{ asset('js/receptionist-settings.js') }}"></script>

</body>

</html>
