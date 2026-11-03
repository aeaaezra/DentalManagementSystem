<x-filament-panels::page>

<style>
/* =========================================================
   SHINE & SMILE SETTINGS
   LIGHT + DARK MODE
========================================================= */

.settings-page {
    --ss-primary: #e91e63;
    --ss-primary-dark: #d81b60;
    --ss-pink-soft: #fff1f5;
    --ss-pink-border: #fce7f3;
    --ss-text: #172033;
    --ss-muted: #64748b;
    --ss-card: #ffffff;
    --ss-input: #ffffff;
    --ss-border: #e2e8f0;
    --ss-background: #f8fafc;

    width: 100%;
    max-width: 1450px;
    margin: 0 auto;
    padding-bottom: 50px;
    color: var(--ss-text);
}

/* =========================================================
   DARK MODE
========================================================= */

.dark .settings-page {
    --ss-primary: #ec4899;
    --ss-primary-dark: #db2777;
    --ss-pink-soft: rgba(236, 72, 153, 0.10);
    --ss-pink-border: rgba(236, 72, 153, 0.28);
    --ss-text: #f8fafc;
    --ss-muted: #94a3b8;
    --ss-card: #111827;
    --ss-input: #172033;
    --ss-border: #263247;
    --ss-background: #0f172a;
}

/* =========================================================
   PAGE HEADER
========================================================= */

.ss-page-header {
    margin-bottom: 24px;
    padding: 28px 30px;
    border: 1px solid var(--ss-pink-border);
    border-radius: 24px;
    background:
        linear-gradient(
            135deg,
            var(--ss-pink-soft),
            var(--ss-card) 55%,
            var(--ss-pink-soft)
        );
    box-shadow: 0 10px 35px rgba(15, 23, 42, .06);
}

.dark .ss-page-header {
    box-shadow: 0 15px 40px rgba(0,0,0,.25);
}

.ss-header-content {
    display: flex;
    align-items: center;
    gap: 17px;
}

.ss-header-icon {
    width: 56px;
    height: 56px;
    border-radius: 17px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    background: linear-gradient(135deg, #e91e63, #ec4899);
    color: #fff;
    font-size: 24px;
    box-shadow: 0 8px 20px rgba(233,30,99,.25);
}

.ss-page-title {
    margin: 0;
    color: var(--ss-text);
    font-size: 28px;
    font-weight: 800;
}

.ss-page-description {
    margin: 5px 0 0;
    color: var(--ss-muted);
    font-size: 14px;
}

/* =========================================================
   GRID
========================================================= */

.ss-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.ss-card {
    min-width: 0;
    overflow: hidden;
    border: 1px solid var(--ss-border);
    border-radius: 22px;
    background: var(--ss-card);
    box-shadow: 0 7px 25px rgba(15, 23, 42, .05);
}

.dark .ss-card {
    box-shadow: 0 12px 35px rgba(0,0,0,.20);
}

.ss-card-full {
    grid-column: 1 / -1;
}

.ss-card-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 20px 23px;
    border-bottom: 1px solid var(--ss-border);
}

.ss-card-icon {
    width: 43px;
    height: 43px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    background: var(--ss-pink-soft);
    color: var(--ss-primary);
    font-size: 19px;
}

.ss-card-title {
    margin: 0;
    color: var(--ss-text);
    font-size: 17px;
    font-weight: 800;
}

.ss-card-description {
    margin: 3px 0 0;
    color: var(--ss-muted);
    font-size: 12px;
}

.ss-card-body {
    padding: 23px;
}

/* =========================================================
   FORM
========================================================= */

.ss-fields {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 17px;
}

.ss-field-full {
    grid-column: 1 / -1;
}

.ss-label {
    display: block;
    margin-bottom: 7px;
    color: var(--ss-text);
    font-size: 13px;
    font-weight: 700;
}

.ss-input,
.ss-select,
.ss-textarea {
    width: 100%;
    box-sizing: border-box;
    border: 1px solid var(--ss-border);
    border-radius: 12px;
    background: var(--ss-input);
    color: var(--ss-text);
    padding: 12px 14px;
    font-size: 14px;
    outline: none;
    transition: .2s ease;
}

.ss-input::placeholder,
.ss-textarea::placeholder {
    color: #94a3b8;
}

.ss-input:focus,
.ss-select:focus,
.ss-textarea:focus {
    border-color: var(--ss-primary);
    box-shadow: 0 0 0 3px rgba(233,30,99,.10);
}

.dark .ss-input:focus,
.dark .ss-select:focus,
.dark .ss-textarea:focus {
    box-shadow: 0 0 0 3px rgba(236,72,153,.12);
}

.ss-textarea {
    min-height: 100px;
    resize: vertical;
}

/* =========================================================
   SAVE BUTTON
========================================================= */

.ss-save {
    margin-top: 19px;
    border: 0;
    border-radius: 11px;
    padding: 11px 18px;
    background: linear-gradient(135deg, #e91e63, #ec4899);
    color: #fff;
    font-size: 13px;
    font-weight: 750;
    cursor: pointer;
    box-shadow: 0 7px 18px rgba(233,30,99,.20);
    transition: .2s ease;
}

.ss-save:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 22px rgba(233,30,99,.28);
}

.ss-save:disabled {
    opacity: .55;
    cursor: not-allowed;
}

/* =========================================================
   SWITCH
========================================================= */

.ss-setting-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 14px 0;
    border-bottom: 1px solid var(--ss-border);
}

.ss-setting-row:last-child {
    border-bottom: 0;
}

.ss-setting-title {
    color: var(--ss-text);
    font-size: 14px;
    font-weight: 700;
}

.ss-setting-description {
    margin-top: 3px;
    color: var(--ss-muted);
    font-size: 12px;
}

.ss-switch {
    position: relative;
    width: 46px;
    height: 25px;
    flex-shrink: 0;
}

.ss-switch input {
    width: 0;
    height: 0;
    opacity: 0;
}

.ss-slider {
    position: absolute;
    inset: 0;
    cursor: pointer;
    border-radius: 999px;
    background: #cbd5e1;
    transition: .2s;
}

.ss-slider::before {
    content: "";
    position: absolute;
    left: 3px;
    top: 3px;
    width: 19px;
    height: 19px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 1px 4px rgba(0,0,0,.18);
    transition: .2s;
}

.ss-switch input:checked + .ss-slider {
    background: var(--ss-primary);
}

.ss-switch input:checked + .ss-slider::before {
    transform: translateX(21px);
}

/* =========================================================
   ADMINISTRATOR PROFILE
========================================================= */

.ss-profile-upload {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 24px;
}

.ss-avatar-wrap {
    position: relative;
    width: 128px;
    height: 128px;
    flex-shrink: 0;
}

.ss-avatar,
.ss-avatar-placeholder {
    width: 128px;
    height: 128px;
    border-radius: 50%;
}

.ss-avatar {
    display: block;
    object-fit: cover;
    border: 4px solid var(--ss-card);
    box-shadow:
        0 0 0 1px var(--ss-border),
        0 10px 25px rgba(15,23,42,.12);
}

.ss-avatar-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e91e63, #ec4899);
    color: #fff;
    font-size: 42px;
    font-weight: 800;
    border: 4px solid var(--ss-card);
    box-shadow:
        0 0 0 1px var(--ss-border),
        0 10px 25px rgba(15,23,42,.12);
}

.ss-camera-button {
    position: absolute;
    right: 1px;
    bottom: 3px;
    width: 37px;
    height: 37px;
    border: 3px solid var(--ss-card);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ec4899;
    color: #fff;
    cursor: pointer;
    box-shadow: 0 5px 15px rgba(236,72,153,.30);
}

.ss-upload-area {
    flex: 1;
    min-width: 0;
    border: 1.5px dashed #f472b6;
    border-radius: 15px;
    padding: 18px 20px;
    background: var(--ss-pink-soft);
    cursor: pointer;
    transition: .2s;
}

.ss-upload-area:hover {
    border-color: var(--ss-primary);
    transform: translateY(-1px);
}

.ss-upload-title {
    color: var(--ss-primary);
    font-size: 14px;
    font-weight: 800;
}

.ss-upload-description {
    margin-top: 4px;
    color: var(--ss-muted);
    font-size: 12px;
}

.ss-upload-file {
    display: none;
}

.ss-preview {
    margin-top: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--ss-muted);
    font-size: 12px;
}

.ss-preview img {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    object-fit: cover;
}

/* =========================================================
   PASSWORD
========================================================= */

.ss-password-wrapper {
    position: relative;
}

.ss-password-wrapper .ss-input {
    padding-right: 48px;
}

.ss-eye {
    position: absolute;
    right: 9px;
    top: 50%;
    transform: translateY(-50%);
    width: 35px;
    height: 35px;
    border: 0;
    border-radius: 9px;
    background: transparent;
    color: var(--ss-muted);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ss-eye:hover {
    background: var(--ss-pink-soft);
    color: var(--ss-primary);
}

.ss-password-strength {
    margin-top: 9px;
}

.ss-strength-bar {
    height: 7px;
    width: 100%;
    overflow: hidden;
    border-radius: 999px;
    background: var(--ss-border);
}

.ss-strength-fill {
    height: 100%;
    border-radius: inherit;
    transition: width .25s ease, background .25s ease;
}

.ss-strength-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-top: 5px;
}

.ss-strength-label {
    color: var(--ss-muted);
    font-size: 11px;
    font-weight: 700;
}

.ss-strength-value {
    font-size: 11px;
    font-weight: 800;
}

.ss-password-help {
    margin-top: 9px;
    padding: 11px 13px;
    border-radius: 11px;
    background: var(--ss-pink-soft);
    color: var(--ss-muted);
    font-size: 11px;
    line-height: 1.6;
}

.ss-requirements {
    display: grid;
    grid-template-columns: repeat(2, minmax(0,1fr));
    gap: 4px 15px;
    margin-top: 9px;
}

.ss-requirement {
    color: var(--ss-muted);
    font-size: 11px;
}

.ss-requirement.ok {
    color: #16a34a;
    font-weight: 700;
}

/* =========================================================
   SECURITY / 2FA
========================================================= */

.ss-security-box {
    margin-top: 26px;
    padding: 19px;
    border: 1px solid var(--ss-pink-border);
    border-radius: 17px;
    background: var(--ss-pink-soft);
}

.ss-security-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.ss-security-left {
    display: flex;
    align-items: center;
    gap: 13px;
}

.ss-security-icon {
    width: 47px;
    height: 47px;
    border-radius: 14px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e91e63, #ec4899);
    color: #fff;
    font-size: 20px;
}

.ss-security-title {
    color: var(--ss-text);
    font-size: 14px;
    font-weight: 800;
}

.ss-security-description {
    margin-top: 3px;
    color: var(--ss-muted);
    font-size: 12px;
}

.ss-status {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 7px;
    color: #94a3b8;
    font-size: 11px;
    font-weight: 700;
}

.ss-status.enabled {
    color: #16a34a;
}

.ss-status-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: currentColor;
}

/* =========================================================
   BUTTONS
========================================================= */

.ss-pink-button,
.ss-danger-button {
    border-radius: 11px;
    padding: 11px 17px;
    font-size: 13px;
    font-weight: 750;
    cursor: pointer;
    transition: .2s;
}

.ss-pink-button {
    border: 0;
    background: linear-gradient(135deg, #e91e63, #ec4899);
    color: #fff;
    box-shadow: 0 6px 15px rgba(233,30,99,.20);
}

.ss-pink-button:hover {
    transform: translateY(-1px);
}

.ss-pink-button:disabled {
    opacity: .5;
    cursor: not-allowed;
}

.ss-danger-button {
    border: 1px solid #fecaca;
    background: transparent;
    color: #dc2626;
}

.ss-danger-button:hover {
    background: #fef2f2;
}

/* =========================================================
   2FA MODAL
========================================================= */

.twofa-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 9998;
    background: rgba(15,23,42,.70);
    backdrop-filter: blur(5px);
}

.twofa-modal-wrapper {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    overflow-y: auto;
}

.twofa-modal {
    width: 100%;
    max-width: 540px;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
    border-radius: 22px;
    background: var(--ss-card);
    color: var(--ss-text);
    box-shadow: 0 30px 80px rgba(0,0,0,.30);
}

.twofa-modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    padding: 21px 23px;
    border-bottom: 1px solid var(--ss-border);
}

.twofa-modal-title {
    margin: 0;
    color: var(--ss-text);
    font-size: 19px;
    font-weight: 800;
}

.twofa-modal-subtitle {
    margin: 4px 0 0;
    color: var(--ss-muted);
    font-size: 12px;
}

.twofa-close {
    width: 35px;
    height: 35px;
    border: 0;
    border-radius: 10px;
    background: var(--ss-pink-soft);
    color: var(--ss-muted);
    font-size: 22px;
    cursor: pointer;
}

.twofa-modal-body {
    padding: 23px;
}

.twofa-instructions {
    padding: 14px;
    border-radius: 12px;
    background: var(--ss-pink-soft);
    color: var(--ss-muted);
    font-size: 12px;
    line-height: 1.8;
}

.twofa-qr-container {
    display: flex;
    justify-content: center;
    margin: 20px auto;
    padding: 14px;
    width: fit-content;
    border: 1px solid var(--ss-border);
    border-radius: 15px;
    background: #fff;
}

.twofa-qr-container img {
    display: block;
    width: 190px;
    height: 190px;
}

.twofa-manual-key {
    margin-bottom: 18px;
}

.twofa-manual-key-label {
    display: block;
    margin-bottom: 6px;
    color: var(--ss-text);
    font-size: 12px;
    font-weight: 700;
}

.twofa-secret-row {
    display: flex;
    gap: 8px;
}

.twofa-secret {
    flex: 1;
    min-width: 0;
    padding: 10px;
    border: 1px solid var(--ss-border);
    border-radius: 10px;
    background: var(--ss-input);
    color: var(--ss-text);
    font-family: monospace;
    font-size: 11px;
    word-break: break-all;
}

.twofa-copy-button {
    border: 1px solid var(--ss-border);
    border-radius: 10px;
    padding: 9px 12px;
    background: var(--ss-input);
    color: var(--ss-text);
    cursor: pointer;
    font-size: 12px;
    font-weight: 700;
}

.twofa-input {
    width: 100%;
    box-sizing: border-box;
    padding: 13px;
    border: 1px solid var(--ss-border);
    border-radius: 11px;
    background: var(--ss-input);
    color: var(--ss-text);
    text-align: center;
    font-size: 22px;
    font-weight: 800;
    letter-spacing: .45em;
    outline: none;
}

.twofa-input:focus {
    border-color: var(--ss-primary);
    box-shadow: 0 0 0 3px rgba(233,30,99,.10);
}

.twofa-error,
.twofa-success {
    margin-top: 13px;
    padding: 11px;
    border-radius: 10px;
    font-size: 12px;
}

.twofa-error {
    background: #fef2f2;
    color: #dc2626;
}

.twofa-success {
    background: #f0fdf4;
    color: #16a34a;
}

.twofa-actions {
    display: flex;
    justify-content: flex-end;
    gap: 9px;
    margin-top: 20px;
}


/* =========================================================
   SVG ICONS
========================================================= */

.ss-icon {
    width: 22px;
    height: 22px;
    flex-shrink: 0;
    display: block;
}

.ss-card-icon .ss-icon {
    width: 21px;
    height: 21px;
}

.ss-header-icon .ss-icon {
    width: 28px;
    height: 28px;
}

.ss-camera-button .ss-icon {
    width: 18px;
    height: 18px;
}

.ss-upload-title,
.ss-save,
.ss-pink-button,
.ss-danger-button,
.ss-security-icon,
.ss-eye,
.twofa-close,
.twofa-copy-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
}

.ss-eye .ss-icon {
    width: 19px;
    height: 19px;
}

.ss-eye .ss-icon-hidden {
    display: none;
}

/* =========================================================
   SETTINGS TABS
========================================================= */

.ss-tabs-wrapper {
    position: sticky;
    top: 0;
    z-index: 40;
    margin: 0 0 24px;
    padding: 8px 0;
    background: var(--ss-background);
}

.ss-tabs {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 7px;
    overflow-x: auto;
    scrollbar-width: none;
    border: 1px solid var(--ss-border);
    border-radius: 16px;
    background: rgba(17,24,39,.96);
    box-shadow: 0 10px 30px rgba(0,0,0,.16);
}

.ss-tabs::-webkit-scrollbar {
    display: none;
}

.ss-tab {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 0 15px;
    flex: 0 0 auto;
    border: 1px solid transparent;
    border-radius: 11px;
    background: transparent;
    color: #94a3b8;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    transition: .2s ease;
}

.ss-tab:hover {
    color: #fff;
    background: rgba(236,72,153,.10);
    border-color: rgba(236,72,153,.20);
}

.ss-tab.active {
    color: #fff;
    background: linear-gradient(135deg,#e91e63,#ec4899);
    border-color: #ec4899;
    box-shadow: 0 6px 18px rgba(236,72,153,.25);
}

.ss-tab .ss-icon {
    width: 18px;
    height: 18px;
}

@media (max-width: 650px) {
    .ss-tabs-wrapper {
        margin-bottom: 17px;
    }

    .ss-tabs {
        border-radius: 13px;
    }

    .ss-tab {
        min-height: 40px;
        padding: 0 12px;
        font-size: 12px;
    }

    .ss-tab .ss-icon {
        width: 17px;
        height: 17px;
    }
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 950px) {
    .ss-grid {
        grid-template-columns: 1fr;
    }

    .ss-card-full {
        grid-column: auto;
    }
}

@media (max-width: 650px) {
    .ss-page-header {
        padding: 20px;
    }

    .ss-page-title {
        font-size: 22px;
    }

    .ss-fields {
        grid-template-columns: 1fr;
    }

    .ss-field-full {
        grid-column: auto;
    }

    .ss-card-body {
        padding: 17px;
    }

    .ss-card-header {
        padding: 17px;
    }

    .ss-profile-upload {
        flex-direction: column;
        align-items: flex-start;
    }

    .ss-upload-area {
        width: 100%;
        box-sizing: border-box;
    }

    .ss-security-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .ss-security-content > * {
        width: 100%;
    }

    .ss-security-content .ss-pink-button,
    .ss-security-content .ss-danger-button {
        width: 100%;
    }

    .ss-requirements {
        grid-template-columns: 1fr;
    }

    .twofa-actions {
        flex-direction: column-reverse;
    }

    .twofa-actions button {
        width: 100%;
    }
}
</style>


<div
    class="settings-page"
    x-data="{
        showModal: false,
        qrCode: '',
        secret: '',
        otp: '',
        error: '',
        success: '',
        verifying: false,
        copied: false,

        openModal() {
            this.showModal = true
            this.error = ''
            this.success = ''
            this.otp = ''
            this.qrCode = ''
            this.secret = ''
            this.copied = false
            this.generateTwoFactor()
        },

        closeModal() {
            if (this.verifying) return

            this.showModal = false
            this.error = ''
            this.success = ''
            this.otp = ''
        },

        async generateTwoFactor() {
            try {
                const response = await fetch('{{ route('2fa.enable') }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN':
                            document.querySelector('meta[name=csrf-token]')?.content ||
                            '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })

                const data = await response.json()

                if (!response.ok || !data.success) {
                    this.error = data.message || 'Unable to generate the 2FA setup.'
                    return
                }

                this.qrCode = data.qrCode || ''
                this.secret = data.secret || ''

            } catch (error) {
                console.error(error)
                this.error = 'Unable to connect to the server.'
            }
        },

        async verifyTwoFactor() {
            if (this.verifying || this.otp.length !== 6) return

            this.verifying = true
            this.error = ''
            this.success = ''

            try {
                const response = await fetch('{{ route('2fa.verify') }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN':
                            document.querySelector('meta[name=csrf-token]')?.content ||
                            '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        otp: this.otp
                    })
                })

                const data = await response.json()

                if (!response.ok || !data.success) {
                    this.error = data.message || 'Invalid authentication code.'
                    return
                }

                this.success =
                    data.message ||
                    'Two-factor authentication enabled successfully.'

                setTimeout(() => {
                    window.location.reload()
                }, 900)

            } catch (error) {
                console.error(error)
                this.error = 'Unable to verify the authentication code.'
            } finally {
                this.verifying = false
            }
        },

        async copySecret() {
            if (!this.secret) return

            try {
                await navigator.clipboard.writeText(this.secret)
                this.copied = true

                setTimeout(() => {
                    this.copied = false
                }, 1800)

            } catch (error) {
                this.error = 'Unable to copy the secret key.'
            }
        }
    }"
>


    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="ss-page-header">

        <div class="ss-header-content">

            <div class="ss-header-icon">
                <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.7 1.7-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V20h-2.4v-.2a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.7-1.7.06-.06A1.7 1.7 0 0 0 8.4 15a1.7 1.7 0 0 0-1.56-1.03H6v-2.4h.84A1.7 1.7 0 0 0 8.4 10a1.7 1.7 0 0 0-.34-1.88L8 8.06l1.7-1.7.06.06A1.7 1.7 0 0 0 11.64 6a1.7 1.7 0 0 0 1.03-1.56V4h2.4v.44A1.7 1.7 0 0 0 16.1 6a1.7 1.7 0 0 0 1.88-.34l.06-.06 1.7 1.7-.06.06A1.7 1.7 0 0 0 19.34 10a1.7 1.7 0 0 0 1.56 1.03H21v2.4h-.1A1.7 1.7 0 0 0 19.4 15z"/></svg>
            </div>

            <div>
                <h1 class="ss-page-title">
                    System Settings
                </h1>

                <p class="ss-page-description">
                    Manage your clinic, appointments, inventory,
                    POS, security and administrator preferences.
                </p>
            </div>

        </div>

    </div>


    {{-- =========================================================
         SETTINGS TABS
    ========================================================== --}}

    <div class="ss-tabs-wrapper">
        <nav class="ss-tabs" aria-label="Settings sections">

            <a href="#clinic" class="ss-tab active" data-settings-tab="clinic">
                <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21h18M4.5 21V7.5h15V21M8 21v-6h3v6m2-6h3v6M7 7.5V5.25A2.25 2.25 0 0 1 9.25 3h5.5A2.25 2.25 0 0 1 17 5.25V7.5"/></svg>
                <span>Clinic</span>
            </a>

            <a href="#appointments" class="ss-tab" data-settings-tab="appointments">
                <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4.5" width="18" height="17" rx="2"/><path d="M8 2.5v4M16 2.5v4M3 9h18M8 13h2M14 13h2M8 17h2"/></svg>
                <span>Appointments</span>
            </a>

            <a href="#notifications" class="ss-tab" data-settings-tab="notifications">
                <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 12.5V10a6 6 0 0 0-12 0v2.5c0 1.5-.5 3-1.5 4.25h15C18.5 15.5 18 14 18 12.5zM10 21h4"/></svg>
                <span>Notifications</span>
            </a>

            <a href="#inventory" class="ss-tab" data-settings-tab="inventory">
                <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.5 7.5 12 3l8.5 4.5v9L12 21l-8.5-4.5v-9zM3.5 7.5 12 12l8.5-4.5M12 12v9"/></svg>
                <span>Inventory</span>
            </a>

            <a href="#pos" class="ss-tab" data-settings-tab="pos">
                <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 8h10M7 12h2m2 0h2m2 0h2M7 16h2m2 0h2m2 0h2"/></svg>
                <span>POS</span>
            </a>

            <a href="#system" class="ss-tab" data-settings-tab="system">
                <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.7 1.7-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V20h-2.4v-.2a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.7-1.7.06-.06A1.7 1.7 0 0 0 8.4 15a1.7 1.7 0 0 0-1.56-1.03H6v-2.4h.84A1.7 1.7 0 0 0 8.4 10a1.7 1.7 0 0 0-.34-1.88L8 8.06l1.7-1.7.06.06A1.7 1.7 0 0 0 11.64 6a1.7 1.7 0 0 0 1.03-1.56V4h2.4v.44A1.7 1.7 0 0 0 16.1 6a1.7 1.7 0 0 0 1.88-.34l.06-.06 1.7 1.7-.06.06A1.7 1.7 0 0 0 19.34 10a1.7 1.7 0 0 0 1.56 1.03H21v2.4h-.1A1.7 1.7 0 0 0 19.4 15z"/></svg>
                <span>System</span>
            </a>

            <a href="#features" class="ss-tab" data-settings-tab="features">
                <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3 1.8 5.2L19 9.5l-4.2 3.4 1.3 5.3-4.1-3-4.1 3 1.3-5.3L5 9.5l5.2-1.3L12 3z"/></svg>
                <span>Features</span>
            </a>

            <a href="#profile" class="ss-tab" data-settings-tab="profile">
                <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="3.5"/><path d="M5 21a7 7 0 0 1 14 0"/></svg>
                <span>Profile</span>
            </a>

            <a href="#security" class="ss-tab" data-settings-tab="security">
                <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/><path d="M12 14v3"/></svg>
                <span>Security</span>
            </a>

        </nav>
    </div>


    {{-- =========================================================
         SETTINGS GRID
    ========================================================== --}}

    <div class="ss-grid">


        {{-- =====================================================
             CLINIC
        ====================================================== --}}

        <section id="clinic" class="ss-card">

            <div class="ss-card-header">

                <div class="ss-card-icon">
                    <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21h18M4.5 21V7.5h15V21M8 21v-6h3v6m2-6h3v6M7 7.5V5.25A2.25 2.25 0 0 1 9.25 3h5.5A2.25 2.25 0 0 1 17 5.25V7.5"/></svg>
                </div>

                <div>
                    <h2 class="ss-card-title">
                        Clinic Information
                    </h2>

                    <p class="ss-card-description">
                        Basic information about your dental clinic.
                    </p>
                </div>

            </div>

            <div class="ss-card-body">

                <div class="ss-fields">

                    <div>
                        <label class="ss-label">
                            Clinic Name
                        </label>

                        <input
                            type="text"
                            class="ss-input"
                            wire:model.defer="clinic.name"
                            placeholder="Shine & Smile Dental Clinic"
                        >
                    </div>

                    <div>
                        <label class="ss-label">
                            Phone
                        </label>

                        <input
                            type="text"
                            class="ss-input"
                            wire:model.defer="clinic.phone"
                            placeholder="+63 900 000 0000"
                        >
                    </div>

                    <div>
                        <label class="ss-label">
                            Email
                        </label>

                        <input
                            type="email"
                            class="ss-input"
                            wire:model.defer="clinic.email"
                            placeholder="clinic@example.com"
                        >
                    </div>

                    <div class="ss-field-full">
                        <label class="ss-label">
                            Address
                        </label>

                        <textarea
                            class="ss-textarea"
                            wire:model.defer="clinic.address"
                            placeholder="Clinic address"
                        ></textarea>
                    </div>

                </div>

                <button
                    type="button"
                    class="ss-save"
                    wire:click="saveClinic"
                >
                    Save Clinic Information
                </button>

            </div>

        </section>


        {{-- =====================================================
             APPOINTMENTS
        ====================================================== --}}

        <section id="appointments" class="ss-card">

            <div class="ss-card-header">

                <div class="ss-card-icon">
                    <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4.5" width="18" height="17" rx="2"/><path d="M8 2.5v4M16 2.5v4M3 9h18M8 13h2M14 13h2M8 17h2"/></svg>
                </div>

                <div>
                    <h2 class="ss-card-title">
                        Appointment Settings
                    </h2>

                    <p class="ss-card-description">
                        Configure appointment scheduling.
                    </p>
                </div>

            </div>

            <div class="ss-card-body">

                <div class="ss-fields">

                    <div>
                        <label class="ss-label">
                            Opening Time
                        </label>

                        <input
                            type="time"
                            class="ss-input"
                            wire:model.defer="appointment.opening_time"
                        >
                    </div>

                    <div>
                        <label class="ss-label">
                            Closing Time
                        </label>

                        <input
                            type="time"
                            class="ss-input"
                            wire:model.defer="appointment.closing_time"
                        >
                    </div>

                    <div>
                        <label class="ss-label">
                            Appointment Duration
                        </label>

                        <input
                            type="number"
                            min="5"
                            class="ss-input"
                            wire:model.defer="appointment.duration"
                        >
                    </div>

                    <div>
                        <label class="ss-label">
                            Maximum Daily Appointments
                        </label>

                        <input
                            type="number"
                            min="1"
                            class="ss-input"
                            wire:model.defer="appointment.max_daily"
                        >
                    </div>

                </div>

                <div class="ss-setting-row">

                    <div>
                        <div class="ss-setting-title">
                            Online Booking
                        </div>

                        <div class="ss-setting-description">
                            Allow patients to book appointments online.
                        </div>
                    </div>

                    <label class="ss-switch">

                        <input
                            type="checkbox"
                            wire:model.defer="appointment.online_booking"
                        >

                        <span class="ss-slider"></span>

                    </label>

                </div>

                <button
                    type="button"
                    class="ss-save"
                    wire:click="saveAppointment"
                >
                    Save Appointment Settings
                </button>

            </div>

        </section>


        {{-- =====================================================
             NOTIFICATIONS
        ====================================================== --}}

        <section id="notifications" class="ss-card">

            <div class="ss-card-header">

                <div class="ss-card-icon">
                    <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 12.5V10a6 6 0 0 0-12 0v2.5c0 1.5-.5 3-1.5 4.25h15C18.5 15.5 18 14 18 12.5zM10 21h4"/></svg>
                </div>

                <div>
                    <h2 class="ss-card-title">
                        Notifications
                    </h2>

                    <p class="ss-card-description">
                        Control important system notifications.
                    </p>
                </div>

            </div>

            <div class="ss-card-body">

                <div class="ss-setting-row">

                    <div>
                        <div class="ss-setting-title">
                            Appointment Reminders
                        </div>

                        <div class="ss-setting-description">
                            Remind patients about upcoming appointments.
                        </div>
                    </div>

                    <label class="ss-switch">
                        <input
                            type="checkbox"
                            wire:model.defer="notification.appointment_reminder"
                        >
                        <span class="ss-slider"></span>
                    </label>

                </div>

                <div class="ss-setting-row">

                    <div>
                        <div class="ss-setting-title">
                            Email Notifications
                        </div>

                        <div class="ss-setting-description">
                            Enable important system emails.
                        </div>
                    </div>

                    <label class="ss-switch">
                        <input
                            type="checkbox"
                            wire:model.defer="notification.email_notification"
                        >
                        <span class="ss-slider"></span>
                    </label>

                </div>

                <div class="ss-setting-row">

                    <div>
                        <div class="ss-setting-title">
                            Low Stock Alerts
                        </div>

                        <div class="ss-setting-description">
                            Notify staff when products reach low stock.
                        </div>
                    </div>

                    <label class="ss-switch">
                        <input
                            type="checkbox"
                            wire:model.defer="notification.low_stock_alert"
                        >
                        <span class="ss-slider"></span>
                    </label>

                </div>

                <div class="ss-setting-row">

                    <div>
                        <div class="ss-setting-title">
                            Expiration Alerts
                        </div>

                        <div class="ss-setting-description">
                            Alert staff about products nearing expiration.
                        </div>
                    </div>

                    <label class="ss-switch">
                        <input
                            type="checkbox"
                            wire:model.defer="notification.expiration_alert"
                        >
                        <span class="ss-slider"></span>
                    </label>

                </div>

                <button
                    type="button"
                    class="ss-save"
                    wire:click="saveNotification"
                >
                    Save Notification Settings
                </button>

            </div>

        </section>


        {{-- =====================================================
             INVENTORY
        ====================================================== --}}

        <section id="inventory" class="ss-card">

            <div class="ss-card-header">

                <div class="ss-card-icon">
                    <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.5 7.5 12 3l8.5 4.5v9L12 21l-8.5-4.5v-9zM3.5 7.5 12 12l8.5-4.5M12 12v9"/></svg>
                </div>

                <div>
                    <h2 class="ss-card-title">
                        Inventory
                    </h2>

                    <p class="ss-card-description">
                        Configure stock monitoring.
                    </p>
                </div>

            </div>

            <div class="ss-card-body">

                <label class="ss-label">
                    Low Stock Limit
                </label>

                <input
                    type="number"
                    min="0"
                    class="ss-input"
                    wire:model.defer="inventory.low_stock_limit"
                >

                <div class="ss-setting-row">

                    <div>
                        <div class="ss-setting-title">
                            Automatic Stock Updates
                        </div>

                        <div class="ss-setting-description">
                            Update inventory automatically after transactions.
                        </div>
                    </div>

                    <label class="ss-switch">
                        <input
                            type="checkbox"
                            wire:model.defer="inventory.auto_update"
                        >
                        <span class="ss-slider"></span>
                    </label>

                </div>

                <button
                    type="button"
                    class="ss-save"
                    wire:click="saveInventory"
                >
                    Save Inventory Settings
                </button>

            </div>

        </section>


        {{-- =====================================================
             POS
        ====================================================== --}}

        <section id="pos" class="ss-card">

            <div class="ss-card-header">

                <div class="ss-card-icon">
                    <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 8h10M7 12h2m2 0h2m2 0h2M7 16h2m2 0h2m2 0h2"/></svg>
                </div>

                <div>
                    <h2 class="ss-card-title">
                        Point of Sale
                    </h2>

                    <p class="ss-card-description">
                        Configure POS and receipt preferences.
                    </p>
                </div>

            </div>

            <div class="ss-card-body">

                <label class="ss-label">
                    Tax Rate (%)
                </label>

                <input
                    type="number"
                    min="0"
                    step="0.01"
                    class="ss-input"
                    wire:model.defer="pos.tax_rate"
                >

                <div class="ss-setting-row">

                    <div>
                        <div class="ss-setting-title">
                            Allow Discounts
                        </div>

                        <div class="ss-setting-description">
                            Allow cashiers to apply discounts.
                        </div>
                    </div>

                    <label class="ss-switch">
                        <input
                            type="checkbox"
                            wire:model.defer="pos.allow_discount"
                        >
                        <span class="ss-slider"></span>
                    </label>

                </div>

                <div style="margin-top:17px;">

                    <label class="ss-label">
                        Receipt Footer
                    </label>

                    <textarea
                        class="ss-textarea"
                        wire:model.defer="pos.receipt_footer"
                    ></textarea>

                </div>

                <button
                    type="button"
                    class="ss-save"
                    wire:click="savePos"
                >
                    Save POS Settings
                </button>

            </div>

        </section>


        {{-- =====================================================
             SYSTEM
        ====================================================== --}}

        <section id="system" class="ss-card">

            <div class="ss-card-header">

                <div class="ss-card-icon">
                    <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.7 1.7-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V20h-2.4v-.2a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.7-1.7.06-.06A1.7 1.7 0 0 0 8.4 15a1.7 1.7 0 0 0-1.56-1.03H6v-2.4h.84A1.7 1.7 0 0 0 8.4 10a1.7 1.7 0 0 0-.34-1.88L8 8.06l1.7-1.7.06.06A1.7 1.7 0 0 0 11.64 6a1.7 1.7 0 0 0 1.03-1.56V4h2.4v.44A1.7 1.7 0 0 0 16.1 6a1.7 1.7 0 0 0 1.88-.34l.06-.06 1.7 1.7-.06.06A1.7 1.7 0 0 0 19.34 10a1.7 1.7 0 0 0 1.56 1.03H21v2.4h-.1A1.7 1.7 0 0 0 19.4 15z"/></svg>
                </div>

                <div>
                    <h2 class="ss-card-title">
                        System Settings
                    </h2>

                    <p class="ss-card-description">
                        Configure system-wide preferences.
                    </p>
                </div>

            </div>

            <div class="ss-card-body">

                <label class="ss-label">
                    Timezone
                </label>

                <select
                    class="ss-select"
                    wire:model.defer="system.timezone"
                >
                    <option value="Asia/Manila">
                        Asia/Manila
                    </option>

                    <option value="UTC">
                        UTC
                    </option>

                    <option value="Asia/Singapore">
                        Asia/Singapore
                    </option>

                    <option value="Asia/Tokyo">
                        Asia/Tokyo
                    </option>
                </select>

                <div class="ss-setting-row">

                    <div>
                        <div class="ss-setting-title">
                            Maintenance Mode
                        </div>

                        <div class="ss-setting-description">
                            Temporarily restrict public system access.
                        </div>
                    </div>

                    <label class="ss-switch">

                        <input
                            type="checkbox"
                            wire:model.defer="system.maintenance_mode"
                        >

                        <span class="ss-slider"></span>

                    </label>

                </div>

                <button
                    type="button"
                    class="ss-save"
                    wire:click="saveSystem"
                >
                    Save System Settings
                </button>

            </div>

        </section>


        {{-- =====================================================
             FEATURES
        ====================================================== --}}

        <section id="features" class="ss-card">

            <div class="ss-card-header">

                <div class="ss-card-icon">
                    <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3 1.8 5.2L19 9.5l-4.2 3.4 1.3 5.3-4.1-3-4.1 3 1.3-5.3L5 9.5l5.2-1.3L12 3z"/></svg>
                </div>

                <div>
                    <h2 class="ss-card-title">
                        Feature Settings
                    </h2>

                    <p class="ss-card-description">
                        Enable or disable optional features.
                    </p>
                </div>

            </div>

            <div class="ss-card-body">

                @foreach ($features as $key => $value)

                    <div class="ss-setting-row">

                        <div>
                            <div class="ss-setting-title">
                                {{ ucwords(str_replace('_', ' ', $key)) }}
                            </div>

                            <div class="ss-setting-description">
                                Control this system feature.
                            </div>
                        </div>

                        <label class="ss-switch">

                            <input
                                type="checkbox"
                                wire:model.defer="features.{{ $key }}"
                            >

                            <span class="ss-slider"></span>

                        </label>

                    </div>

                @endforeach

                <button
                    type="button"
                    class="ss-save"
                    wire:click="saveFeatures"
                >
                    Save Feature Settings
                </button>

            </div>

        </section>


        {{-- =====================================================
             ADMINISTRATOR PROFILE
        ====================================================== --}}

        <section id="profile" class="ss-card ss-card-full">

            <div class="ss-card-header">

                <div class="ss-card-icon">
                    <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="3.5"/><path d="M5 21a7 7 0 0 1 14 0"/></svg>
                </div>

                <div>
                    <h2 class="ss-card-title">
                        Administrator Profile
                    </h2>

                    <p class="ss-card-description">
                        Update the administrator account information.
                    </p>
                </div>

            </div>

            <div class="ss-card-body">

                <div class="ss-profile-upload">

                    <div class="ss-avatar-wrap">

                        @if (auth()->user()->profile_picture)

                            <img
                                src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                alt="Administrator Profile"
                                class="ss-avatar"
                            >

                        @else

                            <div class="ss-avatar-placeholder">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            </div>

                        @endif

                        <label
                            for="admin-profile-image"
                            class="ss-camera-button"
                            title="Change profile picture"
                        >
                            <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14.5 4h-5L8 6H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-3L14.5 4z"/><circle cx="12" cy="12.5" r="3.5"/></svg>
                        </label>

                    </div>


                    <label
                        for="admin-profile-image"
                        class="ss-upload-area"
                    >

                        <div class="ss-upload-title">
                            <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 16V4m0 0L7.5 8.5M12 4l4.5 4.5"/><path d="M5 13v5a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-5"/></svg>
                            Change Profile Picture
                        </div>

                        <div class="ss-upload-description">
                            JPG, JPEG, PNG or WEBP — maximum 2 MB.
                        </div>

                        <input
                            id="admin-profile-image"
                            type="file"
                            class="ss-upload-file"
                            accept="image/jpeg,image/png,image/webp"
                            wire:model="profileImage"
                        >

                        @if ($profileImage)

                            <div class="ss-preview">

                                <img
                                    src="{{ $profileImage->temporaryUrl() }}"
                                    alt="New profile preview"
                                >

                                <span>
                                    New image selected. Click Save Profile to upload it.
                                </span>

                            </div>

                        @endif

                    </label>

                </div>


                <div class="ss-fields">

                    <div>

                        <label class="ss-label">
                            Name
                        </label>

                        <input
                            type="text"
                            class="ss-input"
                            wire:model.defer="profile.name"
                            placeholder="Administrator Name"
                        >

                    </div>

                    <div>

                        <label class="ss-label">
                            Email
                        </label>

                        <input
                            type="email"
                            class="ss-input"
                            wire:model.defer="profile.email"
                            placeholder="admin@example.com"
                        >

                    </div>

                </div>


                <button
                    type="button"
                    class="ss-save"
                    wire:click="saveProfile"
                    wire:loading.attr="disabled"
                >
                    <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 3h11l3 3v15H5z"/><path d="M8 3v6h8V3M8 21v-7h8v7"/></svg>
                    Save Profile
                </button>

            </div>

        </section>


        {{-- =====================================================
             SECURITY
        ====================================================== --}}

        <section
            id="security"
            class="ss-card ss-card-full"
            x-data="{
                showCurrent: false,
                showNew: false,
                showConfirm: false,

                password: @entangle('security.new_password'),

                get lengthOk() {
                    return this.password.length >= 8
                },

                get uppercaseOk() {
                    return /[A-Z]/.test(this.password)
                },

                get lowercaseOk() {
                    return /[a-z]/.test(this.password)
                },

                get numberOk() {
                    return /[0-9]/.test(this.password)
                },

                get symbolOk() {
                    return /[^A-Za-z0-9]/.test(this.password)
                },

                get score() {
                    let score = 0

                    if (this.lengthOk) score++
                    if (this.uppercaseOk) score++
                    if (this.lowercaseOk) score++
                    if (this.numberOk) score++
                    if (this.symbolOk) score++

                    return score
                },

                get strength() {
                    if (!this.password.length) {
                        return 'Not entered'
                    }

                    if (this.score <= 2) {
                        return 'Weak'
                    }

                    if (this.score === 3) {
                        return 'Fair'
                    }

                    if (this.score === 4) {
                        return 'Good'
                    }

                    return 'Strong'
                },

                get strengthWidth() {
                    return (this.score / 5) * 100
                },

                get strengthColor() {
                    if (this.score <= 2) {
                        return '#ef4444'
                    }

                    if (this.score === 3) {
                        return '#f59e0b'
                    }

                    if (this.score === 4) {
                        return '#84cc16'
                    }

                    return '#22c55e'
                }
            }"
        >

            <div class="ss-card-header">

                <div class="ss-card-icon">
                    <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/><path d="M12 14v3"/></svg>
                </div>

                <div>
                    <h2 class="ss-card-title">
                        Security
                    </h2>

                    <p class="ss-card-description">
                        Manage your password and two-factor authentication.
                    </p>
                </div>

            </div>


            <div class="ss-card-body">

                <div class="ss-fields">

                    {{-- CURRENT PASSWORD --}}

                    <div class="ss-field-full">

                        <label class="ss-label">
                            Current Password
                        </label>

                        <div class="ss-password-wrapper">

                            <input
                                :type="showCurrent ? 'text' : 'password'"
                                class="ss-input"
                                wire:model.defer="security.current_password"
                                autocomplete="current-password"
                                placeholder="Enter your current password"
                            >

                            <button
                                type="button"
                                class="ss-eye"
                                @click="showCurrent = !showCurrent"
                                :title="showCurrent ? 'Hide password' : 'Show password'"
                            >
                                <span x-show="!showCurrent"><svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"/><circle cx="12" cy="12" r="2.5"/></svg></span>
                                <span x-show="showCurrent"><svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3l18 18M10.6 10.6a2 2 0 0 0 2.8 2.8M9.9 5.2A10.7 10.7 0 0 1 12 5c6 0 9.5 7 9.5 7a16.7 16.7 0 0 1-3.1 3.8M6.1 6.1C3.8 7.8 2.5 12 2.5 12S6 19 12 19a10.7 10.7 0 0 0 3.1-.45"/></svg></span>
                            </button>

                        </div>

                    </div>


                    {{-- NEW PASSWORD --}}

                    <div>

                        <label class="ss-label">
                            New Password
                        </label>

                        <div class="ss-password-wrapper">

                            <input
                                :type="showNew ? 'text' : 'password'"
                                class="ss-input"
                                wire:model.defer="security.new_password"
                                x-model="password"
                                autocomplete="new-password"
                                placeholder="Enter new password"
                            >

                            <button
                                type="button"
                                class="ss-eye"
                                @click="showNew = !showNew"
                                :title="showNew ? 'Hide password' : 'Show password'"
                            >
                                <span x-show="!showNew"><svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"/><circle cx="12" cy="12" r="2.5"/></svg></span>
                                <span x-show="showNew"><svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3l18 18M10.6 10.6a2 2 0 0 0 2.8 2.8M9.9 5.2A10.7 10.7 0 0 1 12 5c6 0 9.5 7 9.5 7a16.7 16.7 0 0 1-3.1 3.8M6.1 6.1C3.8 7.8 2.5 12 2.5 12S6 19 12 19a10.7 10.7 0 0 0 3.1-.45"/></svg></span>
                            </button>

                        </div>


                        <div class="ss-password-strength">

                            <div class="ss-strength-bar">

                                <div
                                    class="ss-strength-fill"
                                    :style="
                                        'width:' + strengthWidth +
                                        '%;background:' + strengthColor
                                    "
                                ></div>

                            </div>

                            <div class="ss-strength-info">

                                <span class="ss-strength-label">
                                    Password strength
                                </span>

                                <span
                                    class="ss-strength-value"
                                    :style="'color:' + strengthColor"
                                    x-text="strength"
                                ></span>

                            </div>

                        </div>


                        <div class="ss-requirements">

                            <div
                                class="ss-requirement"
                                :class="{ 'ok': lengthOk }"
                            >
                                <span x-show="lengthOk"><svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg></span><span x-show="!lengthOk" style="font-size:14px;">○</span>
                                At least 8 characters
                            </div>

                            <div
                                class="ss-requirement"
                                :class="{ 'ok': uppercaseOk }"
                            >
                                <span x-show="uppercaseOk"><svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg></span><span x-show="!uppercaseOk" style="font-size:14px;">○</span>
                                Uppercase letter
                            </div>

                            <div
                                class="ss-requirement"
                                :class="{ 'ok': lowercaseOk }"
                            >
                                <span x-show="lowercaseOk"><svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg></span><span x-show="!lowercaseOk" style="font-size:14px;">○</span>
                                Lowercase letter
                            </div>

                            <div
                                class="ss-requirement"
                                :class="{ 'ok': numberOk }"
                            >
                                <span x-show="numberOk"><svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg></span><span x-show="!numberOk" style="font-size:14px;">○</span>
                                Number
                            </div>

                            <div
                                class="ss-requirement"
                                :class="{ 'ok': symbolOk }"
                            >
                                <span x-show="symbolOk"><svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg></span><span x-show="!symbolOk" style="font-size:14px;">○</span>
                                Special character
                            </div>

                        </div>

                    </div>


                    {{-- CONFIRM PASSWORD --}}

                    <div>

                        <label class="ss-label">
                            Confirm New Password
                        </label>

                        <div class="ss-password-wrapper">

                            <input
                                :type="showConfirm ? 'text' : 'password'"
                                class="ss-input"
                                wire:model.defer="security.new_password_confirmation"
                                autocomplete="new-password"
                                placeholder="Confirm new password"
                            >

                            <button
                                type="button"
                                class="ss-eye"
                                @click="showConfirm = !showConfirm"
                                :title="showConfirm ? 'Hide password' : 'Show password'"
                            >
                                <span x-show="!showConfirm"><svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"/><circle cx="12" cy="12" r="2.5"/></svg></span>
                                <span x-show="showConfirm"><svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3l18 18M10.6 10.6a2 2 0 0 0 2.8 2.8M9.9 5.2A10.7 10.7 0 0 1 12 5c6 0 9.5 7 9.5 7a16.7 16.7 0 0 1-3.1 3.8M6.1 6.1C3.8 7.8 2.5 12 2.5 12S6 19 12 19a10.7 10.7 0 0 0 3.1-.45"/></svg></span>
                            </button>

                        </div>

                    </div>

                </div>


                <div class="ss-password-help">

                    <strong>Password security:</strong>

                    Use at least 8 characters with a mixture of uppercase,
                    lowercase, numbers and special characters.

                </div>


                <button
                    type="button"
                    class="ss-save"
                    wire:click="changePassword"
                    wire:loading.attr="disabled"
                >
                    <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="8" cy="15" r="3.5"/><path d="m10.5 12.5 8-8M15 5l2 2M17 3l2 2"/></svg>
                    Change Password
                </button>


                {{-- =================================================
                     TWO FACTOR AUTHENTICATION
                ================================================== --}}

                <div class="ss-security-box">

                    <div class="ss-security-content">

                        <div class="ss-security-left">

                            <div class="ss-security-icon">
                                <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3 19 6v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="m9 12 2 2 4-4"/></svg>
                            </div>

                            <div>

                                <div class="ss-security-title">
                                    Two-Factor Authentication
                                </div>

                                <div class="ss-security-description">
                                    Protect your administrator account with Google Authenticator.
                                </div>

                                @if (auth()->user()->two_factor_enabled)

                                    <div class="ss-status enabled">

                                        <span class="ss-status-dot"></span>

                                        Enabled

                                    </div>

                                @else

                                    <div class="ss-status">

                                        <span class="ss-status-dot"></span>

                                        Not Enabled

                                    </div>

                                @endif

                            </div>

                        </div>


                        @if (auth()->user()->two_factor_enabled)

                            <form
                                method="POST"
                                action="{{ route('2fa.disable') }}"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="ss-danger-button"
                                    onclick="return confirm('Are you sure you want to disable two-factor authentication?')"
                                >
                                    Disable 2FA
                                </button>

                            </form>

                        @else

                            <button
                                type="button"
                                class="ss-pink-button"
                                @click="openModal()"
                            >
                                Enable 2FA
                            </button>

                        @endif

                    </div>

                </div>

            </div>

        </section>

    </div>


    {{-- =========================================================
         2FA MODAL
    ========================================================== --}}

    <template x-if="showModal">

        <div>

            <div
                class="twofa-modal-overlay"
                @click="closeModal()"
            ></div>

            <div
                class="twofa-modal-wrapper"
                role="dialog"
                aria-modal="true"
            >

                <div
                    class="twofa-modal"
                    @click.stop
                >

                    <div class="twofa-modal-header">

                        <div>

                            <h2 class="twofa-modal-title">
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
                        >
                            <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18"/></svg>
                        </button>

                    </div>


                    <div class="twofa-modal-body">

                        <div class="twofa-instructions">

                            <strong>1.</strong>
                            Open Google Authenticator on your phone.
                            <br>

                            <strong>2.</strong>
                            Scan the QR code below.
                            <br>

                            <strong>3.</strong>
                            Enter the 6-digit verification code.

                        </div>


                        <template x-if="qrCode">

                            <div class="twofa-qr-container">

                                <img
                                    :src="qrCode"
                                    alt="Google Authenticator QR Code"
                                >

                            </div>

                        </template>


                        <div
                            x-show="!qrCode && !error"
                            style="text-align:center;padding:25px;color:#94a3b8;font-size:13px;"
                        >
                            Generating secure QR code...
                        </div>


                        <div
                            class="twofa-manual-key"
                            x-show="secret"
                        >

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
                                >
                                    <span x-show="!copied">
                                        Copy
                                    </span>

                                    <span x-show="copied" style="display:inline-flex;align-items:center;gap:5px;">
                                        <svg class="ss-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg> Copied
                                    </span>
                                </button>

                            </div>

                        </div>


                        <label
                            class="ss-label"
                            for="twofa-authentication-code"
                        >
                            Authentication Code
                        </label>

                        <input
                            id="twofa-authentication-code"
                            type="text"
                            class="twofa-input"
                            x-model="otp"
                            maxlength="6"
                            inputmode="numeric"
                            autocomplete="one-time-code"
                            placeholder="000000"
                            @input="otp = otp.replace(/[^0-9]/g, '').slice(0,6)"
                            @keydown.enter.prevent="verifyTwoFactor()"
                        >


                        <div
                            style="
                                margin-top:7px;
                                color:#94a3b8;
                                font-size:11px;
                                text-align:center;
                            "
                        >
                            Enter the current 6-digit code from Google Authenticator.
                        </div>


                        <div
                            class="twofa-error"
                            x-show="error"
                            x-text="error"
                        ></div>


                        <div
                            class="twofa-success"
                            x-show="success"
                            x-text="success"
                        ></div>


                        <div class="twofa-actions">

                            <button
                                type="button"
                                class="ss-pink-button"
                                @click="verifyTwoFactor()"
                                :disabled="verifying || otp.length !== 6"
                            >

                                <span x-show="!verifying">
                                    Verify & Enable
                                </span>

                                <span x-show="verifying">
                                    Verifying...
                                </span>

                            </button>

                            <button
                                type="button"
                                class="ss-danger-button"
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

    <script>
        (function () {
            function initSettingsTabs() {
                const tabs = document.querySelectorAll('[data-settings-tab]');
                const sections = Array.from(tabs)
                    .map(tab => document.getElementById(tab.dataset.settingsTab))
                    .filter(Boolean);

                if (!tabs.length || !sections.length) return;

                function setActiveTab(id, scrollTab = false) {
                    tabs.forEach(tab => {
                        tab.classList.toggle('active', tab.dataset.settingsTab === id);
                    });

                    if (scrollTab) {
                        const activeTab = document.querySelector(`[data-settings-tab="${id}"]`);
                        if (activeTab) {
                            activeTab.scrollIntoView({
                                behavior: 'smooth',
                                block: 'nearest',
                                inline: 'center'
                            });
                        }
                    }
                }

                tabs.forEach(tab => {
                    if (tab.dataset.settingsBound === '1') return;
                    tab.dataset.settingsBound = '1';

                    tab.addEventListener('click', function (event) {
                        event.preventDefault();

                        const section = document.getElementById(this.dataset.settingsTab);
                        if (!section) return;

                        const top = section.getBoundingClientRect().top + window.scrollY - 110;

                        window.scrollTo({
                            top,
                            behavior: 'smooth'
                        });

                        setActiveTab(this.dataset.settingsTab, true);
                    });
                });

                if (!window.__shineSmileSettingsObserver) {
                    window.__shineSmileSettingsObserver = new IntersectionObserver(
                        entries => {
                            const visible = entries
                                .filter(entry => entry.isIntersecting)
                                .sort((a, b) => b.intersectionRatio - a.intersectionRatio);

                            if (visible.length) {
                                setActiveTab(visible[0].target.id);
                            }
                        },
                        {
                            rootMargin: '-110px 0px -55% 0px',
                            threshold: [0.1, 0.25, 0.5]
                        }
                    );

                    sections.forEach(section => {
                        window.__shineSmileSettingsObserver.observe(section);
                    });
                }
            }

            document.addEventListener('DOMContentLoaded', initSettingsTabs);
            document.addEventListener('livewire:navigated', initSettingsTabs);
            initSettingsTabs();
        })();
    </script>

</div>

</x-filament-panels::page>
