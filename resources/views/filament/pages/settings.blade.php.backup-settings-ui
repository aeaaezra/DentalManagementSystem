<x-filament-panels::page>

    <style>
        /* =========================================================
           2FA SETTINGS CARD
        ========================================================= */

        .settings-2fa-card {
            background: linear-gradient(
                135deg,
                #ffffff 0%,
                #fff5f8 100%
            );
            border: 1px solid #fbcfe8;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(219, 39, 119, 0.08);
        }

        .settings-2fa-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }

        .settings-2fa-icon {
            width: 56px;
            height: 56px;
            min-width: 56px;
            border-radius: 16px;
            background: linear-gradient(
                135deg,
                #db2777,
                #ec4899
            );
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(219, 39, 119, 0.20);
        }

        .settings-2fa-icon svg {
            width: 28px;
            height: 28px;
        }

        .settings-2fa-title {
            font-size: 20px;
            line-height: 1.3;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .settings-2fa-description {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
            margin: 5px 0 0;
        }

        /* =========================================================
           STATUS
        ========================================================= */

        .settings-2fa-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            margin: 4px 0 18px;
        }

        .settings-2fa-enabled {
            background: #dcfce7;
            color: #15803d;
        }

        .settings-2fa-disabled {
            background: #fef2f2;
            color: #dc2626;
        }

        /* =========================================================
           BUTTONS
        ========================================================= */

        .settings-pink-button,
        .settings-danger-button {
            min-height: 44px;
            border-radius: 10px;
            padding: 11px 18px;
            font-weight: 600;
            cursor: pointer;
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                opacity 0.2s ease;
        }

        .settings-pink-button {
            background: linear-gradient(
                135deg,
                #db2777,
                #ec4899
            );
            color: white;
            border: none;
            box-shadow: 0 5px 14px rgba(219, 39, 119, 0.14);
        }

        .settings-pink-button:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(219, 39, 119, 0.25);
        }

        .settings-danger-button {
            background: white;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .settings-danger-button:hover:not(:disabled) {
            background: #fef2f2;
        }

        .settings-pink-button:disabled,
        .settings-danger-button:disabled {
            cursor: not-allowed;
            opacity: 0.6;
            transform: none;
        }

        /* =========================================================
           MODAL BACKDROP
        ========================================================= */

        .twofa-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.70);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            z-index: 9998;
        }

        /* =========================================================
           MODAL WRAPPER
        ========================================================= */

        .twofa-modal-wrapper {
            position: fixed;
            inset: 0;
            z-index: 9999;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 16px;

            pointer-events: none;
        }

        /* =========================================================
           MODAL
        ========================================================= */

        .twofa-modal {
            width: min(100%, 540px);

            max-height: calc(100vh - 32px);
            max-height: calc(100dvh - 32px);

            display: flex;
            flex-direction: column;

            background: #ffffff;
            border: 1px solid #f3f4f6;
            border-radius: 22px;

            overflow: hidden;

            box-shadow:
                0 30px 80px rgba(0, 0, 0, 0.35),
                0 10px 30px rgba(219, 39, 119, 0.10);

            pointer-events: auto;
            position: relative;
        }

        /* =========================================================
           MODAL HEADER
        ========================================================= */

        .twofa-modal-header {
            flex-shrink: 0;

            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;

            padding: 20px 22px;

            background: #ffffff;
            border-bottom: 1px solid #f3f4f6;
        }

        .twofa-modal-title {
            margin: 0;
            color: #111827;
            font-size: 20px;
            line-height: 1.3;
            font-weight: 700;
        }

        .twofa-modal-subtitle {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
        }

        .twofa-close {
            width: 40px;
            height: 40px;
            min-width: 40px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;
            border: 1px solid #fbcfe8;

            background: #fdf2f8;
            color: #db2777;

            cursor: pointer;
            font-size: 24px;
            line-height: 1;

            transition:
                background 0.2s ease,
                transform 0.2s ease;
        }

        .twofa-close:hover {
            background: #fce7f3;
            transform: scale(1.03);
        }

        /* =========================================================
           MODAL BODY
        ========================================================= */

        .twofa-modal-body {
            flex: 1;

            overflow-y: auto;
            overscroll-behavior: contain;

            padding: 22px;
        }

        .twofa-modal-body::-webkit-scrollbar {
            width: 7px;
        }

        .twofa-modal-body::-webkit-scrollbar-track {
            background: #f9fafb;
        }

        .twofa-modal-body::-webkit-scrollbar-thumb {
            background: #f9a8d4;
            border-radius: 999px;
        }

        /* =========================================================
           INSTRUCTIONS
        ========================================================= */

        .twofa-instructions {
            margin: 0;
            color: #4b5563;
            font-size: 14px;
            line-height: 1.75;
        }

        .twofa-instructions strong {
            color: #374151;
        }

        /* =========================================================
           QR CODE
        ========================================================= */

        .twofa-qr-container {
            min-height: 220px;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 16px;

            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;

            margin: 18px 0;
        }

        .twofa-qr-container img {
            display: block;

            width: 200px;
            height: 200px;
            max-width: 100%;

            object-fit: contain;

            image-rendering: pixelated;
        }

        /* =========================================================
           MANUAL KEY
        ========================================================= */

        .twofa-manual-key {
            background: #fdf2f8;
            border: 1px solid #fbcfe8;
            border-radius: 12px;

            padding: 14px;

            margin-bottom: 20px;
        }

        .twofa-manual-key-label {
            display: block;

            margin-bottom: 8px;

            color: #9d174d !important;

            font-size: 14px;
            font-weight: 700;
        }

        .twofa-secret-row {
            display: flex;
            align-items: stretch;
            gap: 8px;
        }

        .twofa-secret {
            flex: 1;
            min-width: 0;

            font-family:
                ui-monospace,
                SFMono-Regular,
                Menlo,
                Monaco,
                Consolas,
                "Liberation Mono",
                monospace;

            font-size: 13px;
            line-height: 1.5;
            font-weight: 700;

            color: #831843 !important;

            background: #ffffff;

            border: 1px solid #fbcfe8;
            border-radius: 9px;

            padding: 10px 12px;

            word-break: break-all;
            overflow-wrap: anywhere;
        }

        .twofa-copy-button {
            flex-shrink: 0;

            min-width: 76px;

            border: 1px solid #f9a8d4;
            border-radius: 9px;

            background: #ffffff;
            color: #be185d;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition:
                background 0.2s ease,
                border-color 0.2s ease;
        }

        .twofa-copy-button:hover {
            background: #fdf2f8;
            border-color: #f472b6;
        }

        /* =========================================================
           OTP SECTION
        ========================================================= */

        .twofa-field {
            margin-top: 2px;
        }

        .twofa-label {
            display: block;

            margin-bottom: 8px;

            color: #374151;

            font-size: 14px;
            font-weight: 700;
        }

        .twofa-input {
            width: 100%;
            box-sizing: border-box;

            padding: 13px 16px;

            border: 2px solid #fbcfe8;
            border-radius: 12px;

            outline: none;

            background: #ffffff;
            color: #111827;

            font-family:
                ui-monospace,
                SFMono-Regular,
                Menlo,
                Monaco,
                Consolas,
                "Liberation Mono",
                monospace;

            font-size: 25px;
            line-height: 1.2;

            text-align: center;
            letter-spacing: 9px;
            font-weight: 700;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .twofa-input::placeholder {
            color: #d1d5db;
            opacity: 1;
        }

        .twofa-input:focus {
            border-color: #db2777;
            box-shadow:
                0 0 0 4px rgba(219, 39, 119, 0.10);
        }

        /* =========================================================
           MESSAGES
        ========================================================= */

        .twofa-error,
        .twofa-success {
            margin-top: 10px;

            padding: 10px 12px;

            border-radius: 9px;

            font-size: 13px;
            line-height: 1.5;
        }

        .twofa-error {
            color: #b91c1c;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .twofa-success {
            color: #15803d;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        /* =========================================================
           MODAL ACTIONS
        ========================================================= */

        .twofa-actions {
            display: flex;
            gap: 10px;

            margin-top: 20px;
        }

        .twofa-actions .settings-pink-button {
            flex: 1;
        }

        .twofa-actions .settings-danger-button {
            min-width: 92px;
        }

        /* =========================================================
           LOADING SPINNER
        ========================================================= */

        .twofa-spinner {
            width: 16px;
            height: 16px;

            border: 2px solid rgba(255, 255, 255, 0.45);
            border-top-color: #ffffff;

            border-radius: 50%;

            animation: twofa-spin 0.7s linear infinite;
        }

        @keyframes twofa-spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* =========================================================
           DARK MODE
        ========================================================= */

        .dark .settings-2fa-card {
            background: linear-gradient(
                135deg,
                #18181b 0%,
                #24151f 100%
            );

            border-color: #4a1d35;
        }

        .dark .settings-2fa-title {
            color: #f9fafb;
        }

        .dark .settings-2fa-description {
            color: #a1a1aa;
        }

        .dark .twofa-modal {
            background: #18181b;
            border-color: #3f3f46;
        }

        .dark .twofa-modal-header {
            background: #18181b;
            border-bottom-color: #3f3f46;
        }

        .dark .twofa-modal-title {
            color: #f9fafb;
        }

        .dark .twofa-modal-subtitle {
            color: #a1a1aa;
        }

        .dark .twofa-modal-body {
            background: #18181b;
        }

        .dark .twofa-instructions {
            color: #a1a1aa;
        }

        .dark .twofa-instructions strong {
            color: #e5e7eb;
        }

        .dark .twofa-qr-container {
            background: #ffffff;
            border-color: #3f3f46;
        }

        .dark .twofa-manual-key {
            background: #2a1723;
            border-color: #5b2442;
        }

        .dark .twofa-manual-key-label {
            color: #f9a8d4 !important;
        }

        .dark .twofa-secret {
            background: #ffffff;
            color: #831843 !important;
            border-color: #fbcfe8;
        }

        .dark .twofa-copy-button {
            background: #27272a;
            border-color: #831843;
            color: #f9a8d4;
        }

        .dark .twofa-label {
            color: #e5e7eb;
        }

        .dark .twofa-input {
            background: #27272a;
            color: #f9fafb;
            border-color: #831843;
        }

        .dark .twofa-input::placeholder {
            color: #71717a;
        }

        .dark .twofa-close {
            background: #2a1723;
            border-color: #5b2442;
        }

        .dark .settings-danger-button {
            background: #18181b;
            border-color: #7f1d1d;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 640px) {

            .settings-2fa-card {
                padding: 18px;
                border-radius: 16px;
            }

            .settings-2fa-header {
                align-items: flex-start;
            }

            .settings-2fa-icon {
                width: 48px;
                height: 48px;
                min-width: 48px;
                border-radius: 13px;
            }

            .settings-2fa-icon svg {
                width: 24px;
                height: 24px;
            }

            .settings-2fa-title {
                font-size: 18px;
            }

            .twofa-modal-wrapper {
                padding: 8px;
            }

            .twofa-modal {
                max-height: calc(100vh - 16px);
                max-height: calc(100dvh - 16px);
                border-radius: 17px;
            }

            .twofa-modal-header {
                padding: 16px;
            }

            .twofa-modal-body {
                padding: 16px;
            }

            .twofa-modal-title {
                font-size: 18px;
            }

            .twofa-qr-container {
                min-height: 190px;
                margin: 16px 0;
            }

            .twofa-qr-container img {
                width: 180px;
                height: 180px;
            }

            .twofa-input {
                font-size: 22px;
                letter-spacing: 7px;
            }

            .twofa-secret-row {
                flex-direction: column;
            }

            .twofa-copy-button {
                min-height: 42px;
            }

            .twofa-actions {
                flex-direction: column;
            }

            .twofa-actions button {
                width: 100%;
            }

            .twofa-actions .settings-danger-button {
                min-width: 0;
            }
        }

        @media (max-width: 380px) {

            .twofa-input {
                font-size: 20px;
                letter-spacing: 5px;
            }

            .twofa-qr-container img {
                width: 165px;
                height: 165px;
            }
        }
    </style>


    {{-- =========================================================
         ALPINE 2FA COMPONENT
    ========================================================== --}}

    <div
        x-data="{
            showModal: false,
            loading: false,
            verifying: false,

            qrCode: '',
            secret: '',
            otp: '',

            error: '',
            success: '',

            copied: false,

            enabled: {{ auth()->user()->two_factor_enabled ? 'true' : 'false' }},

            csrfToken() {
                const meta = document.querySelector(
                    'meta[name=csrf-token]'
                );

                return meta
                    ? meta.getAttribute('content')
                    : '';
            },

            async enableTwoFactor() {

                if (this.loading) {
                    return;
                }

                this.loading = true;
                this.error = '';
                this.success = '';
                this.otp = '';
                this.copied = false;

                try {

                    const response = await fetch(
                        '{{ route('2fa.enable') }}',
                        {
                            method: 'POST',

                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': this.csrfToken()
                            }
                        }
                    );

                    const data = await response.json();

                    if (!response.ok || !data.success) {

                        this.error =
                            data.message ||
                            'Unable to start two-factor authentication.';

                        return;
                    }

                    this.qrCode = data.qrCode || '';
                    this.secret = data.secret || '';

                    if (!this.qrCode) {

                        this.error =
                            'The QR code could not be generated.';

                        return;
                    }

                    this.showModal = true;

                    /*
                     * Wait until x-if creates the modal,
                     * then reset its scroll position and focus OTP.
                     */

                    this.$nextTick(() => {

                        if (this.$refs.twofaModal) {
                            this.$refs.twofaModal.scrollTop = 0;
                        }

                        setTimeout(() => {

                            if (this.$refs.otpInput) {
                                this.$refs.otpInput.focus();
                            }

                        }, 150);

                    });

                } catch (error) {

                    console.error(
                        '2FA enable error:',
                        error
                    );

                    this.error =
                        'Something went wrong while starting 2FA. Please try again.';

                } finally {

                    this.loading = false;
                }
            },


            async verifyTwoFactor() {

                if (this.verifying) {
                    return;
                }

                this.error = '';
                this.success = '';

                this.otp =
                    String(this.otp)
                        .replace(/[^0-9]/g, '')
                        .slice(0, 6);

                if (this.otp.length !== 6) {

                    this.error =
                        'Please enter the complete 6-digit authentication code.';

                    if (this.$refs.otpInput) {
                        this.$refs.otpInput.focus();
                    }

                    return;
                }

                this.verifying = true;

                try {

                    const response = await fetch(
                        '{{ route('2fa.verify') }}',
                        {
                            method: 'POST',

                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': this.csrfToken()
                            },

                            body: JSON.stringify({
                                otp: this.otp
                            })
                        }
                    );

                    const data = await response.json();

                    if (!response.ok || !data.success) {

                        this.error =
                            data.message ||
                            'Invalid authentication code.';

                        return;
                    }

                    this.success =
                        'Two-factor authentication enabled successfully.';

                    this.enabled = true;
                    this.otp = '';

                    setTimeout(() => {

                        this.closeModal();

                    }, 1200);

                } catch (error) {

                    console.error(
                        '2FA verification error:',
                        error
                    );

                    this.error =
                        'Unable to verify the authentication code. Please try again.';

                } finally {

                    this.verifying = false;
                }
            },


            async disableTwoFactor() {

                if (this.loading) {
                    return;
                }

                if (
                    !confirm(
                        'Are you sure you want to disable two-factor authentication?'
                    )
                ) {
                    return;
                }

                this.loading = true;
                this.error = '';

                try {

                    const response = await fetch(
                        '{{ route('2fa.disable') }}',
                        {
                            method: 'POST',

                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': this.csrfToken()
                            }
                        }
                    );

                    const data = await response.json();

                    if (!response.ok || !data.success) {

                        alert(
                            data.message ||
                            'Unable to disable 2FA.'
                        );

                        return;
                    }

                    this.enabled = false;

                    alert(
                        'Two-factor authentication has been disabled.'
                    );

                } catch (error) {

                    console.error(
                        '2FA disable error:',
                        error
                    );

                    alert(
                        'Something went wrong while disabling 2FA.'
                    );

                } finally {

                    this.loading = false;
                }
            },


            async copySecret() {

                if (!this.secret) {
                    return;
                }

                try {

                    await navigator.clipboard.writeText(
                        this.secret
                    );

                    this.copied = true;

                    setTimeout(() => {
                        this.copied = false;
                    }, 1800);

                } catch (error) {

                    /*
                     * Clipboard API may be unavailable
                     * in some browser environments.
                     */

                    this.error =
                        'Unable to copy the setup key. Please copy it manually.';
                }
            },


            closeModal() {

                this.showModal = false;

                this.qrCode = '';
                this.secret = '';
                this.otp = '';

                this.error = '';
                this.success = '';

                this.copied = false;
                this.verifying = false;
            }
        }"

        @keydown.escape.window="if (showModal) closeModal()"
    >


        {{-- =====================================================
             TWO-FACTOR AUTHENTICATION CARD
        ====================================================== --}}

        <div class="settings-2fa-card">

            <div class="settings-2fa-header">

                <div class="settings-2fa-icon">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        aria-hidden="true"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 00-9 0v3.75m-1.5 0h12a1.5 1.5 0 011.5 1.5v7.5A1.5 1.5 0 0118 21H6a1.5 1.5 0 01-1.5-1.5V12A1.5 1.5 0 016 10.5z"
                        />

                    </svg>

                </div>


                <div>

                    <h2 class="settings-2fa-title">
                        Two-Factor Authentication
                    </h2>

                    <p class="settings-2fa-description">
                        Add an extra layer of security to your administrator account.
                    </p>

                </div>

            </div>


            {{-- =================================================
                 STATUS
            ================================================== --}}

            <template x-if="enabled">

                <div class="settings-2fa-status settings-2fa-enabled">

                    <span aria-hidden="true">✓</span>

                    <span>
                        Two-factor authentication is enabled
                    </span>

                </div>

            </template>


            <template x-if="!enabled">

                <div class="settings-2fa-status settings-2fa-disabled">

                    <span aria-hidden="true">●</span>

                    <span>
                        Two-factor authentication is disabled
                    </span>

                </div>

            </template>


            {{-- =================================================
                 ACTION BUTTONS
            ================================================== --}}

            <div
                style="
                    display:flex;
                    gap:10px;
                    flex-wrap:wrap;
                "
            >

                <template x-if="!enabled">

                    <button
                        type="button"
                        class="settings-pink-button"
                        @click="enableTwoFactor()"
                        :disabled="loading"
                    >

                        <span
                            x-show="!loading"
                        >
                            Enable Two-Factor Authentication
                        </span>

                        <span
                            x-show="loading"
                            style="
                                display:inline-flex;
                                align-items:center;
                                gap:8px;
                            "
                        >

                            <span class="twofa-spinner"></span>

                            Generating secure setup...

                        </span>

                    </button>

                </template>


                <template x-if="enabled">

                    <button
                        type="button"
                        class="settings-danger-button"
                        @click="disableTwoFactor()"
                        :disabled="loading"
                    >

                        <span x-show="!loading">
                            Disable Two-Factor Authentication
                        </span>

                        <span x-show="loading">
                            Disabling...
                        </span>

                    </button>

                </template>

            </div>


            {{-- =================================================
                 OUTSIDE-MODAL ERROR
            ================================================== --}}

            <template x-if="error && !showModal">

                <div
                    class="twofa-error"
                    x-text="error"
                    role="alert"
                ></div>

            </template>

        </div>


        {{-- =====================================================
             2FA SETUP MODAL
        ====================================================== --}}

        <template x-if="showModal">

            <div>

                {{-- BACKDROP --}}

                <div
                    class="twofa-modal-overlay"
                    @click="closeModal()"
                    aria-hidden="true"
                ></div>


                {{-- MODAL WRAPPER --}}

                <div
                    class="twofa-modal-wrapper"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="twofa-modal-title"
                >

                    <div
                        x-ref="twofaModal"
                        class="twofa-modal"
                        @click.stop
                    >


                        {{-- =====================================
                             HEADER
                        ====================================== --}}

                        <div class="twofa-modal-header">

                            <div>

                                <h2
                                    id="twofa-modal-title"
                                    class="twofa-modal-title"
                                >
                                    Set Up Two-Factor Authentication
                                </h2>

                                <p class="twofa-modal-subtitle">
                                    Secure your administrator account with Google Authenticator.
                                </p>

                            </div>


                            <button
                                type="button"
                                class="twofa-close"
                                @click="closeModal()"
                                aria-label="Close two-factor authentication setup"
                            >
                                ×
                            </button>

                        </div>


                        {{-- =====================================
                             BODY
                        ====================================== --}}

                        <div class="twofa-modal-body">


                            {{-- INSTRUCTIONS --}}

                            <p class="twofa-instructions">

                                <strong>1.</strong>
                                Open Google Authenticator on your phone.

                                <br>

                                <strong>2.</strong>
                                Scan the QR code below.

                                <br>

                                <strong>3.</strong>
                                Enter the 6-digit verification code generated by the app.

                            </p>


                            {{-- =================================
                                 QR CODE
                            ================================== --}}

                            <template x-if="qrCode">

                                <div class="twofa-qr-container">

                                    <img
                                        :src="qrCode"
                                        alt="Google Authenticator QR Code"
                                        draggable="false"
                                    >

                                </div>

                            </template>


                            {{-- =================================
                                 MANUAL SETUP KEY
                            ================================== --}}

                            <div class="twofa-manual-key">

                                <span class="twofa-manual-key-label">
                                    Manual setup key
                                </span>


                                <div class="twofa-secret-row">

                                    <div
                                        class="twofa-secret"
                                        x-text="secret"
                                    ></div>


                                    <button
                                        type="button"
                                        class="twofa-copy-button"
                                        @click="copySecret()"
                                        :disabled="!secret"
                                    >

                                        <span
                                            x-show="!copied"
                                        >
                                            Copy
                                        </span>

                                        <span
                                            x-show="copied"
                                        >
                                            ✓ Copied
                                        </span>

                                    </button>

                                </div>

                            </div>


                            {{-- =================================
                                 OTP INPUT
                            ================================== --}}

                            <div class="twofa-field">

                                <label
                                    for="twofa-authentication-code"
                                    class="twofa-label"
                                >
                                    Authentication Code
                                </label>


                                <input
                                    id="twofa-authentication-code"
                                    x-ref="otpInput"

                                    type="text"

                                    inputmode="numeric"
                                    autocomplete="one-time-code"

                                    maxlength="6"

                                    class="twofa-input"

                                    x-model="otp"

                                    @input="
                                        otp = otp
                                            .replace(/[^0-9]/g, '')
                                            .slice(0, 6)
                                    "

                                    @keydown.enter.prevent="verifyTwoFactor()"

                                    placeholder="000000"

                                    aria-label="6-digit authentication code"
                                    aria-describedby="twofa-code-help"

                                    required
                                >


                                <div
                                    id="twofa-code-help"
                                    style="
                                        margin-top:7px;
                                        color:#6b7280;
                                        font-size:12px;
                                        text-align:center;
                                    "
                                >
                                    Enter the current 6-digit code from Google Authenticator.
                                </div>

                            </div>


                            {{-- =================================
                                 ERROR
                            ================================== --}}

                            <template x-if="error">

                                <div
                                    class="twofa-error"
                                    x-text="error"
                                    role="alert"
                                ></div>

                            </template>


                            {{-- =================================
                                 SUCCESS
                            ================================== --}}

                            <template x-if="success">

                                <div
                                    class="twofa-success"
                                    x-text="success"
                                    role="status"
                                ></div>

                            </template>


                            {{-- =================================
                                 ACTIONS
                            ================================== --}}

                            <div class="twofa-actions">


                                <button
                                    type="button"
                                    class="settings-pink-button"
                                    @click="verifyTwoFactor()"
                                    :disabled="verifying || otp.length !== 6"
                                >

                                    <span
                                        x-show="!verifying"
                                    >
                                        Verify & Enable
                                    </span>


                                    <span
                                        x-show="verifying"
                                        style="
                                            display:inline-flex;
                                            align-items:center;
                                            justify-content:center;
                                            gap:8px;
                                        "
                                    >

                                        <span class="twofa-spinner"></span>

                                        Verifying...

                                    </span>

                                </button>


                                <button
                                    type="button"
                                    class="settings-danger-button"
                                    @click="closeModal()"
                                    :disabled="verifying"
                                >
                                    Cancel
                                </button>


                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </template>

    </div>

</x-filament-panels::page>
