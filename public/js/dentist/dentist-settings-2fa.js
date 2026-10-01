// ============================================================
// SHINE & SMILE
// DENTIST SETTINGS - TWO FACTOR AUTHENTICATION
// ============================================================

document.addEventListener(
    "DOMContentLoaded",
    function () {

        "use strict";


        // ========================================================
        // CONFIGURATION
        // ========================================================

        const config =
            window.DENTIST_SETTINGS || {};


        const csrfToken =
            config.csrf ||
            document
                .querySelector(
                    'meta[name="csrf-token"]'
                )
                ?.getAttribute(
                    "content"
                ) ||
            "";


        // ========================================================
        // ELEMENTS
        // ========================================================

        const enableButton =
            document.getElementById(
                "enableTwoFactorButton"
            );


        const setupPanel =
            document.getElementById(
                "twoFactorSetup"
            );


        const qrContainer =
            document.getElementById(
                "twoFactorQr"
            );


        const secretElement =
            document.getElementById(
                "twoFactorSecret"
            );


        const codeInput =
            document.getElementById(
                "twoFactorCode"
            );


        const verifyButton =
            document.getElementById(
                "verifyTwoFactorButton"
            );


        const cancelButton =
            document.getElementById(
                "cancelTwoFactorButton"
            );


        const disableButton =
            document.getElementById(
                "disableTwoFactorButton"
            );


        const enabledPanel =
            document.getElementById(
                "twoFactorEnabled"
            );


        const disabledPanel =
            document.getElementById(
                "twoFactorDisabled"
            );


        // ========================================================
        // DEBUG
        // ========================================================

        console.log(
            "=========================================="
        );

        console.log(
            "Dentist 2FA JavaScript initialized."
        );

        console.log(
            "Setup URL:",
            config.twoFactorSetupUrl
        );

        console.log(
            "Verify URL:",
            config.twoFactorVerifyUrl
        );

        console.log(
            "Disable URL:",
            config.twoFactorDisableUrl
        );

        console.log(
            "Enable button:",
            enableButton
        );

        console.log(
            "Setup panel:",
            setupPanel
        );

        console.log(
            "QR container:",
            qrContainer
        );

        console.log(
            "=========================================="
        );


        // ========================================================
        // TOAST
        // ========================================================

        function showToast(
            message,
            type = "success"
        ) {

            const container =
                document.getElementById(
                    "toastContainer"
                );


            if (!container) {

                alert(message);

                return;
            }


            const toast =
                document.createElement(
                    "div"
                );


            toast.className =
                `toast ${type}`;


            toast.textContent =
                message;


            container.appendChild(
                toast
            );


            setTimeout(
                function () {

                    toast.remove();

                },
                3500
            );
        }


        // ========================================================
        // SHOW SETUP PANEL
        // ========================================================

        function showSetupPanel() {

            if (!setupPanel) {

                console.error(
                    "Element #twoFactorSetup was not found."
                );

                return;
            }


            setupPanel.style.display =
                "block";


            setupPanel.hidden =
                false;


            setupPanel.classList.add(
                "active"
            );


            console.log(
                "2FA setup panel displayed."
            );


            setTimeout(
                function () {

                    setupPanel.scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    });

                },
                100
            );
        }


        // ========================================================
        // HIDE SETUP PANEL
        // ========================================================

        function hideSetupPanel() {

            if (!setupPanel) {

                return;
            }


            setupPanel.style.display =
                "none";


            setupPanel.hidden =
                true;


            setupPanel.classList.remove(
                "active"
            );


            if (codeInput) {

                codeInput.value =
                    "";
            }
        }


        // ========================================================
        // ENABLE 2FA
        // ========================================================

        if (enableButton) {

            enableButton.addEventListener(
                "click",
                async function () {

                    console.log(
                        "Enable 2FA button clicked."
                    );


                    // ------------------------------------------------
                    // CHECK SETUP ROUTE
                    // ------------------------------------------------

                    if (
                        !config.twoFactorSetupUrl
                    ) {

                        showToast(
                            "2FA setup URL is missing.",
                            "error"
                        );


                        return;
                    }


                    // ------------------------------------------------
                    // BUTTON LOADING
                    // ------------------------------------------------

                    const originalText =
                        enableButton.textContent;


                    enableButton.disabled =
                        true;


                    enableButton.textContent =
                        "Setting up...";


                    try {

                        // ============================================
                        // REQUEST SETUP
                        // ============================================

                        const response =
                            await fetch(
                                config.twoFactorSetupUrl,
                                {
                                    method:
                                        "GET",

                                    headers: {

                                        "Accept":
                                            "application/json",

                                        "X-Requested-With":
                                            "XMLHttpRequest"
                                    },

                                    credentials:
                                        "same-origin"
                                }
                            );


                        console.log(
                            "2FA setup HTTP status:",
                            response.status
                        );


                        // ============================================
                        // READ RESPONSE
                        // ============================================

                        const data =
                            await response.json();


                        console.log(
                            "FULL 2FA SETUP RESPONSE:",
                            data
                        );


                        // ============================================
                        // SERVER ERROR
                        // ============================================

                        if (
                            !response.ok
                        ) {

                            throw new Error(
                                data.message ||
                                `Server returned HTTP ${response.status}.`
                            );
                        }


                        // ============================================
                        // SUCCESS CHECK
                        // ============================================

                        if (
                            data.success === false
                        ) {

                            throw new Error(
                                data.message ||
                                "Unable to start 2FA setup."
                            );
                        }


                        // ============================================
                        // DISPLAY SECRET
                        // ============================================

                        if (
                            secretElement
                        ) {

                            secretElement.textContent =
                                data.secret ||
                                "Secret key unavailable";


                            console.log(
                                "2FA secret displayed."
                            );
                        }


                        // ============================================
                        // CLEAR QR CONTAINER
                        // ============================================

                        if (
                            qrContainer
                        ) {

                            qrContainer.innerHTML =
                                "";
                        }


                        // ============================================
                        // DISPLAY QR CODE
                        // ============================================

                        if (
                            qrContainer
                        ) {

                            // ----------------------------------------
                            // QR CODE SVG
                            // ----------------------------------------

                            if (
                                data.qrCodeSvg
                            ) {

                                qrContainer.innerHTML =
                                    data.qrCodeSvg;


                                console.log(
                                    "QR source: qrCodeSvg"
                                );
                            }


                            // ----------------------------------------
                            // ALTERNATIVE QR CODE
                            // ----------------------------------------

                            else if (
                                data.qr_code
                            ) {

                                qrContainer.innerHTML =
                                    data.qr_code;


                                console.log(
                                    "QR source: qr_code"
                                );
                            }


                            // ----------------------------------------
                            // ALTERNATIVE QR CODE
                            // ----------------------------------------

                            else if (
                                data.qrCode
                            ) {

                                qrContainer.innerHTML =
                                    data.qrCode;


                                console.log(
                                    "QR source: qrCode"
                                );
                            }


                            // ----------------------------------------
                            // QR IMAGE URL
                            // ----------------------------------------

                            else if (
                                data.qrCodeUrl
                            ) {

                                const image =
                                    document.createElement(
                                        "img"
                                    );


                                image.src =
                                    data.qrCodeUrl;


                                image.alt =
                                    "Google Authenticator QR Code";


                                image.style.width =
                                    "220px";


                                image.style.height =
                                    "220px";


                                image.style.display =
                                    "block";


                                image.style.margin =
                                    "0 auto";


                                qrContainer.appendChild(
                                    image
                                );


                                console.log(
                                    "QR source: qrCodeUrl"
                                );
                            }


                            // ----------------------------------------
                            // QR NOT FOUND
                            // ----------------------------------------

                            else {

                                console.error(
                                    "QR code was not returned."
                                );


                                console.error(
                                    "Response keys:",
                                    Object.keys(data)
                                );


                                qrContainer.innerHTML = `
                                    <div
                                        style="
                                            color: #dc2626;
                                            text-align: center;
                                            padding: 20px;
                                        "
                                    >
                                        QR code was not returned
                                        by the server.
                                    </div>
                                `;
                            }
                        }


                        // ============================================
                        // SHOW SETUP PANEL
                        // ============================================

                        showSetupPanel();


                        // ============================================
                        // CLEAR CODE INPUT
                        // ============================================

                        if (
                            codeInput
                        ) {

                            codeInput.value =
                                "";


                            setTimeout(
                                function () {

                                    codeInput.focus();

                                },
                                300
                            );
                        }


                        // ============================================
                        // SUCCESS MESSAGE
                        // ============================================

                        showToast(
                            "2FA setup started. Scan the QR code with Google Authenticator.",
                            "success"
                        );


                    } catch (
                        error
                    ) {

                        console.error(
                            "2FA setup error:",
                            error
                        );


                        showToast(
                            error.message ||
                            "Unable to start 2FA setup.",
                            "error"
                        );


                    } finally {

                        enableButton.disabled =
                            false;


                        enableButton.textContent =
                            originalText;
                    }

                }
            );

        } else {

            console.error(
                "Enable 2FA button not found."
            );
        }


        // ========================================================
        // CANCEL 2FA SETUP
        // ========================================================

        if (cancelButton) {

            cancelButton.addEventListener(
                "click",
                function () {

                    console.log(
                        "2FA setup cancelled."
                    );


                    hideSetupPanel();

                }
            );
        }


        // ========================================================
        // VERIFICATION CODE INPUT
        // ========================================================

        if (codeInput) {

            codeInput.addEventListener(
                "input",
                function () {

                    this.value =
                        this.value
                            .replace(
                                /\D/g,
                                ""
                            )
                            .substring(
                                0,
                                6
                            );
                }
            );


            // ----------------------------------------------------
            // ENTER KEY
            // ----------------------------------------------------

            codeInput.addEventListener(
                "keydown",
                function (
                    event
                ) {

                    if (
                        event.key ===
                        "Enter"
                    ) {

                        event.preventDefault();


                        if (
                            verifyButton
                        ) {

                            verifyButton.click();
                        }
                    }
                }
            );
        }


        // ========================================================
        // VERIFY 2FA
        // ========================================================

        if (verifyButton) {

            verifyButton.addEventListener(
                "click",
                async function () {

                    console.log(
                        "Verify 2FA button clicked."
                    );


                    const code =
                        codeInput?.value.trim() ||
                        "";


                    // ------------------------------------------------
                    // VALIDATE CODE
                    // ------------------------------------------------

                    if (
                        !/^\d{6}$/.test(
                            code
                        )
                    ) {

                        showToast(
                            "Please enter the 6-digit authentication code.",
                            "error"
                        );


                        codeInput?.focus();


                        return;
                    }


                    // ------------------------------------------------
                    // CHECK VERIFY URL
                    // ------------------------------------------------

                    if (
                        !config.twoFactorVerifyUrl
                    ) {

                        showToast(
                            "2FA verification URL is missing.",
                            "error"
                        );


                        return;
                    }


                    // ------------------------------------------------
                    // BUTTON LOADING
                    // ------------------------------------------------

                    const originalText =
                        verifyButton.textContent;


                    verifyButton.disabled =
                        true;


                    verifyButton.textContent =
                        "Verifying...";


                    try {

                        // ============================================
                        // SEND VERIFICATION
                        // ============================================

                        const response =
                            await fetch(
                                config.twoFactorVerifyUrl,
                                {
                                    method:
                                        "POST",

                                    headers: {

                                        "Accept":
                                            "application/json",

                                        "Content-Type":
                                            "application/json",

                                        "X-CSRF-TOKEN":
                                            csrfToken,

                                        "X-Requested-With":
                                            "XMLHttpRequest"
                                    },

                                    credentials:
                                        "same-origin",

                                    body:
                                        JSON.stringify({
                                            otp:
                                                code
                                        })
                                }
                            );


                        // ============================================
                        // READ RESPONSE
                        // ============================================

                        const data =
                            await response.json();


                        console.log(
                            "2FA verification response:",
                            data
                        );


                        // ============================================
                        // VALIDATION ERRORS
                        // ============================================

                        if (
                            data.errors
                        ) {

                            const firstError =
                                Object.values(
                                    data.errors
                                )[0];


                            throw new Error(
                                Array.isArray(
                                    firstError
                                )
                                    ? firstError[0]
                                    : firstError
                            );
                        }


                        // ============================================
                        // SERVER ERROR
                        // ============================================

                        if (
                            !response.ok
                        ) {

                            throw new Error(
                                data.message ||
                                "Verification failed."
                            );
                        }


                        // ============================================
                        // FAILED VERIFICATION
                        // ============================================

                        if (
                            data.success === false
                        ) {

                            throw new Error(
                                data.message ||
                                "Invalid authentication code."
                            );
                        }


                        // ============================================
                        // SUCCESS
                        // ============================================

                        showToast(
                            data.message ||
                            "Two-factor authentication enabled successfully.",
                            "success"
                        );


                        // ============================================
                        // RELOAD PAGE
                        // ============================================

                        setTimeout(
                            function () {

                                window.location.reload();

                            },
                            800
                        );


                    } catch (
                        error
                    ) {

                        console.error(
                            "2FA verification error:",
                            error
                        );


                        showToast(
                            error.message ||
                            "Unable to verify the authentication code.",
                            "error"
                        );


                    } finally {

                        verifyButton.disabled =
                            false;


                        verifyButton.textContent =
                            originalText;
                    }

                }
            );

        } else {

            console.warn(
                "Verify 2FA button not found."
            );
        }


        // ========================================================
        // DISABLE 2FA
        // ========================================================

        if (disableButton) {

            disableButton.addEventListener(
                "click",
                async function () {

                    console.log(
                        "Disable 2FA button clicked."
                    );


                    // ------------------------------------------------
                    // CONFIRM
                    // ------------------------------------------------

                    const confirmed =
                        window.confirm(
                            "Are you sure you want to disable two-factor authentication?"
                        );


                    if (!confirmed) {

                        return;
                    }


                    // ------------------------------------------------
                    // CHECK URL
                    // ------------------------------------------------

                    if (
                        !config.twoFactorDisableUrl
                    ) {

                        showToast(
                            "2FA disable URL is missing.",
                            "error"
                        );


                        return;
                    }


                    // ------------------------------------------------
                    // BUTTON LOADING
                    // ------------------------------------------------

                    const originalText =
                        disableButton.textContent;


                    disableButton.disabled =
                        true;


                    disableButton.textContent =
                        "Disabling...";


                    try {

                        // ============================================
                        // SEND DISABLE REQUEST
                        // ============================================

                        const response =
                            await fetch(
                                config.twoFactorDisableUrl,
                                {
                                    method:
                                        "POST",

                                    headers: {

                                        "Accept":
                                            "application/json",

                                        "Content-Type":
                                            "application/json",

                                        "X-CSRF-TOKEN":
                                            csrfToken,

                                        "X-Requested-With":
                                            "XMLHttpRequest"
                                    },

                                    credentials:
                                        "same-origin",

                                    body:
                                        JSON.stringify({})
                                }
                            );


                        // ============================================
                        // READ RESPONSE
                        // ============================================

                        const data =
                            await response.json();


                        console.log(
                            "2FA disable response:",
                            data
                        );


                        // ============================================
                        // ERROR
                        // ============================================

                        if (
                            !response.ok
                        ) {

                            throw new Error(
                                data.message ||
                                "Unable to disable 2FA."
                            );
                        }


                        if (
                            data.success === false
                        ) {

                            throw new Error(
                                data.message ||
                                "Unable to disable 2FA."
                            );
                        }


                        // ============================================
                        // SUCCESS
                        // ============================================

                        showToast(
                            data.message ||
                            "Two-factor authentication disabled.",
                            "success"
                        );


                        // ============================================
                        // RELOAD
                        // ============================================

                        setTimeout(
                            function () {

                                window.location.reload();

                            },
                            800
                        );


                    } catch (
                        error
                    ) {

                        console.error(
                            "2FA disable error:",
                            error
                        );


                        showToast(
                            error.message ||
                            "Unable to disable 2FA.",
                            "error"
                        );


                    } finally {

                        disableButton.disabled =
                            false;


                        disableButton.textContent =
                            originalText;
                    }

                }
            );
        }


        // ========================================================
        // INITIAL STATE
        // ========================================================

        if (
            setupPanel
        ) {

            // Keep setup hidden initially.
            // It will be displayed after clicking Enable 2FA.
            setupPanel.style.display =
                "none";


            setupPanel.hidden =
                true;
        }


        // ========================================================
        // FINISHED
        // ========================================================

        console.log(
            "Dentist 2FA handlers registered successfully."
        );

    }
);
