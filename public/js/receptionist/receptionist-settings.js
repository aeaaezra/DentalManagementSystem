document.addEventListener("DOMContentLoaded", function () {

    /*
    ==========================================================
    PASSWORD VISIBILITY
    ==========================================================
    */

    document
        .querySelectorAll(".password-toggle")
        .forEach(function (button) {

            button.addEventListener("click", function () {

                const targetId = this.dataset.target;

                const input =
                    document.getElementById(targetId);

                if (!input) {
                    return;
                }

                const isPassword =
                    input.type === "password";

                input.type =
                    isPassword
                        ? "text"
                        : "password";

                this.textContent =
                    isPassword
                        ? "Hide"
                        : "Show";

                this.setAttribute(
                    "aria-label",
                    isPassword
                        ? "Hide password"
                        : "Show password"
                );

            });

        });


    /*
    ==========================================================
    PASSWORD STRENGTH
    ==========================================================
    */

    const passwordInput =
        document.getElementById("password");

    const passwordConfirmation =
        document.getElementById("password_confirmation");

    const passwordMatch =
        document.getElementById("passwordMatch");

    const strengthBar =
        document.getElementById("passwordStrengthBar");

    const strengthText =
        document.getElementById("passwordStrengthText");


    function updateRequirement(id, passed) {

        const element =
            document.getElementById(id);

        if (!element) {
            return;
        }

        const icon =
            element.querySelector("span");

        if (passed) {

            element.classList.add("passed");

            if (icon) {
                icon.textContent = "✓";
            }

        } else {

            element.classList.remove("passed");

            if (icon) {
                icon.textContent = "○";
            }

        }

    }


    function updatePasswordStrength() {

        if (!passwordInput) {
            return;
        }

        const password =
            passwordInput.value;

        const requirements = {

            length:
                password.length >= 8,

            uppercase:
                /[A-Z]/.test(password),

            lowercase:
                /[a-z]/.test(password),

            number:
                /[0-9]/.test(password),

            special:
                /[^A-Za-z0-9]/.test(password)

        };


        let score = 0;

        Object.values(requirements).forEach(
            function (passed) {

                if (passed) {
                    score++;
                }

            }
        );


        updateRequirement(
            "lengthRequirement",
            requirements.length
        );

        updateRequirement(
            "uppercaseRequirement",
            requirements.uppercase
        );

        updateRequirement(
            "lowercaseRequirement",
            requirements.lowercase
        );

        updateRequirement(
            "numberRequirement",
            requirements.number
        );

        updateRequirement(
            "specialRequirement",
            requirements.special
        );


        if (!strengthBar || !strengthText) {
            return;
        }


        if (!password) {

            strengthBar.style.width = "0%";

            strengthText.textContent =
                "Not entered";

            strengthText.className = "";

            return;

        }


        const percentage =
            (score / 5) * 100;

        strengthBar.style.width =
            percentage + "%";


        strengthText.className = "";


        if (score <= 2) {

            strengthText.textContent =
                "Weak";

            strengthText.classList.add(
                "strength-weak"
            );

        } else if (score === 3) {

            strengthText.textContent =
                "Fair";

            strengthText.classList.add(
                "strength-fair"
            );

        } else if (score === 4) {

            strengthText.textContent =
                "Good";

            strengthText.classList.add(
                "strength-good"
            );

        } else {

            strengthText.textContent =
                "Strong";

            strengthText.classList.add(
                "strength-strong"
            );

        }

    }


    /*
    ==========================================================
    PASSWORD MATCH
    ==========================================================
    */

    function checkPasswordMatch() {

        if (
            !passwordInput ||
            !passwordConfirmation ||
            !passwordMatch
        ) {
            return true;
        }


        if (!passwordConfirmation.value) {

            passwordMatch.textContent = "";

            passwordMatch.className =
                "password-match";

            return true;

        }


        if (
            passwordInput.value ===
            passwordConfirmation.value
        ) {

            passwordMatch.textContent =
                "✓ Passwords match.";

            passwordMatch.className =
                "password-match match";

            return true;

        }


        passwordMatch.textContent =
            "Passwords do not match.";

        passwordMatch.className =
            "password-match no-match";

        return false;

    }


    if (passwordInput) {

        passwordInput.addEventListener(
            "input",
            function () {

                updatePasswordStrength();

                checkPasswordMatch();

            }
        );

    }


    if (passwordConfirmation) {

        passwordConfirmation.addEventListener(
            "input",
            checkPasswordMatch
        );

    }


    /*
    ==========================================================
    QR CODE
    ==========================================================
    */

    const qrContainer =
        document.getElementById("qrCode");


    if (
        qrContainer &&
        typeof QRCode !== "undefined"
    ) {

        const qrUrl =
            qrContainer.dataset.url;

        if (qrUrl) {

            qrContainer.innerHTML = "";

            new QRCode(
                qrContainer,
                {
                    text: qrUrl,
                    width: 220,
                    height: 220,
                    correctLevel:
                        QRCode.CorrectLevel.M
                }
            );

        }

    }


    /*
    ==========================================================
    SETTINGS CONFIRMATION MODAL
    ==========================================================
    */

    let selectedForm = null;
    let selectedButton = null;


    const settingsModal =
        document.getElementById(
            "settingsConfirmModal"
        );

    const confirmButton =
        document.getElementById(
            "confirmSettingsAction"
        );

    const cancelButton =
        document.getElementById(
            "cancelSettingsAction"
        );

    const modalTitle =
        document.getElementById(
            "settingsConfirmTitle"
        );

    const modalMessage =
        document.getElementById(
            "settingsConfirmMessage"
        );


    function openSettingsModal() {

        if (!settingsModal) {
            return;
        }

        settingsModal.classList.add("active");

        settingsModal.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.style.overflow =
            "hidden";


        if (cancelButton) {

            setTimeout(function () {

                cancelButton.focus();

            }, 100);

        }

    }


    function closeSettingsModal() {

        if (!settingsModal) {
            return;
        }

        settingsModal.classList.remove("active");

        settingsModal.setAttribute(
            "aria-hidden",
            "true"
        );

        document.body.style.overflow = "";

        selectedForm = null;
        selectedButton = null;


        if (confirmButton) {

            confirmButton.disabled = false;

        }

    }


    /*
    ==========================================================
    OPEN MODAL FROM SAVE BUTTONS
    ==========================================================
    */

    document
        .querySelectorAll(
            ".open-settings-confirm"
        )
        .forEach(function (button) {

            button.addEventListener(
                "click",
                function () {

                    const formId =
                        this.dataset.form;

                    const form =
                        document.getElementById(
                            formId
                        );


                    if (!form) {

                        console.error(
                            "Settings form not found: " +
                            formId
                        );

                        return;

                    }


                    /*
                    Browser validation first
                    */

                    if (!form.checkValidity()) {

                        form.reportValidity();

                        return;

                    }


                    /*
                    Password-specific validation
                    */

                    if (
                        formId === "passwordForm"
                    ) {

                        updatePasswordStrength();

                        const passwordsMatch =
                            checkPasswordMatch();


                        if (!passwordsMatch) {

                            if (
                                passwordConfirmation
                            ) {

                                passwordConfirmation.focus();

                            }

                            return;

                        }

                    }


                    selectedForm = form;

                    selectedButton = this;


                    if (modalTitle) {

                        modalTitle.textContent =
                            this.dataset.title ||
                            "Confirm Action";

                    }


                    if (modalMessage) {

                        modalMessage.textContent =
                            this.dataset.message ||
                            "Are you sure you want to continue?";

                    }


                    if (confirmButton) {

                        confirmButton.textContent =
                            this.dataset.confirm ||
                            "Confirm";

                    }


                    openSettingsModal();

                }
            );

        });


    /*
    ==========================================================
    CONFIRM ACTION
    ==========================================================
    */

    if (confirmButton) {

        confirmButton.addEventListener(
            "click",
            function () {

                if (!selectedForm) {
                    return;
                }


                confirmButton.disabled = true;

                const originalText =
                    confirmButton.textContent;

                confirmButton.textContent =
                    "Saving...";


                /*
                Use requestSubmit when possible.
                This allows normal submit validation.
                */

                if (
                    typeof selectedForm.requestSubmit ===
                    "function"
                ) {

                    selectedForm.requestSubmit();

                } else {

                    selectedForm.submit();

                }


                setTimeout(function () {

                    if (
                        confirmButton &&
                        document.body.contains(
                            confirmButton
                        )
                    ) {

                        confirmButton.disabled =
                            false;

                        confirmButton.textContent =
                            originalText;

                    }

                }, 1500);

            }
        );

    }


    /*
    ==========================================================
    CANCEL MODAL
    ==========================================================
    */

    if (cancelButton) {

        cancelButton.addEventListener(
            "click",
            function () {

                closeSettingsModal();

            }
        );

    }


    /*
    ==========================================================
    CLICK OUTSIDE MODAL
    ==========================================================
    */

    if (settingsModal) {

        settingsModal.addEventListener(
            "click",
            function (event) {

                if (
                    event.target === settingsModal
                ) {

                    closeSettingsModal();

                }

            }
        );

    }


    /*
    ==========================================================
    ESCAPE KEY
    ==========================================================
    */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                settingsModal &&
                settingsModal.classList.contains(
                    "active"
                )
            ) {

                closeSettingsModal();

            }

        }
    );


    /*
    ==========================================================
    PREVENT PASSWORD FORM FROM BYPASSING
    PASSWORD MATCH VALIDATION
    ==========================================================
    */

    const passwordForm =
        document.getElementById(
            "passwordForm"
        );


    if (passwordForm) {

        passwordForm.addEventListener(
            "submit",
            function (event) {

                if (!checkPasswordMatch()) {

                    event.preventDefault();

                    if (
                        passwordConfirmation
                    ) {

                        passwordConfirmation.focus();

                    }

                }

            }
        );

    }


    /*
    ==========================================================
    AUTO-HIDE ALERTS
    ==========================================================
    */

    const alerts =
        document.querySelectorAll(
            ".alert-success"
        );


    alerts.forEach(function (alert) {

        setTimeout(function () {

            alert.classList.add("alert-hide");

            setTimeout(function () {

                if (
                    alert.parentNode
                ) {

                    alert.remove();

                }

            }, 400);

        }, 4000);

    });

});
