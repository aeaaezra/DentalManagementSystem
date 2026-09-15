/*
|--------------------------------------------------------------------------
| Shine & Smile - Appointment Settings JavaScript
|--------------------------------------------------------------------------
| Fixed version
|
| Removed:
| - Old issueReportForm listener
| - Old settingsMobileMenuBtn listener
| - Duplicate openReportIssueModal()
|
| Uses the IDs from the current Blade file:
| - reportIssueForm
| - reportIssueModal
| - reportConfirmModal
| - reportSuccessModal
| - settingsHeaderMenuBtn
| - settingsMobileSidebar
| - settingsMobileSidebarOverlay
|--------------------------------------------------------------------------
*/


/* =========================================================
   SETTINGS PAGE
   ========================================================= */

document.addEventListener("DOMContentLoaded", function () {


    /* =====================================================
       DARK MODE
       ===================================================== */

    const darkModeToggle =
        document.getElementById("darkModeToggle");


    function applyDarkMode(enabled) {

        if (enabled) {

            document.documentElement.classList.add(
                "dark-mode"
            );

        } else {

            document.documentElement.classList.remove(
                "dark-mode"
            );

        }
    }


    function saveDarkMode(enabled) {

        try {

            localStorage.setItem(
                "patientDarkMode",
                enabled ? "true" : "false"
            );

        } catch (error) {

            console.warn(
                "Unable to save theme preference."
            );

        }
    }


    function getSavedDarkMode() {

        try {

            return (
                localStorage.getItem(
                    "patientDarkMode"
                ) === "true"
            );

        } catch (error) {

            return false;

        }
    }


    const savedDarkMode =
        getSavedDarkMode();


    applyDarkMode(savedDarkMode);


    if (darkModeToggle) {

        darkModeToggle.checked =
            savedDarkMode;


        darkModeToggle.addEventListener(
            "change",
            function () {

                const enabled =
                    darkModeToggle.checked;


                applyDarkMode(enabled);

                saveDarkMode(enabled);

            }
        );

    }



    /* =====================================================
       PASSWORD RULES
       ===================================================== */

    const passwordRules = {

        length: {

            text: "At least 8 characters",

            test: function (value) {

                return value.length >= 8;

            }

        },

        uppercase: {

            text: "One uppercase letter",

            test: function (value) {

                return /[A-Z]/.test(value);

            }

        },

        lowercase: {

            text: "One lowercase letter",

            test: function (value) {

                return /[a-z]/.test(value);

            }

        },

        number: {

            text: "One number",

            test: function (value) {

                return /[0-9]/.test(value);

            }

        },

        special: {

            text: "One special character",

            test: function (value) {

                return /[^A-Za-z0-9]/.test(value);

            }

        }

    };



    /* =====================================================
       PASSWORD ELEMENTS
       ===================================================== */

    const newPass =
        document.getElementById(
            "newPass"
        );


    const confPass =
        document.getElementById(
            "confPass"
        );


    const passwordChecker =
        document.getElementById(
            "passwordChecker"
        );


    const strengthText =
        document.getElementById(
            "strengthText"
        );


    const confirmError =
        document.getElementById(
            "confirmError"
        );



    /* =====================================================
       UPDATE PASSWORD RULE
       ===================================================== */

    function updateRule(
        id,
        valid
    ) {

        const item =
            document.getElementById(id);


        if (
            !item ||
            !passwordRules[id]
        ) {

            return;

        }


        const text =
            passwordRules[id].text;


        if (valid) {

            item.textContent =
                "✓ " + text;


            item.classList.remove(
                "invalid"
            );


            item.classList.add(
                "valid"
            );

        } else {

            item.textContent =
                "• " + text;


            item.classList.remove(
                "valid"
            );


            item.classList.add(
                "invalid"
            );

        }
    }



    /* =====================================================
       VALIDATE CONFIRM PASSWORD
       ===================================================== */

    function validateConfirmPassword() {

        if (
            !newPass ||
            !confPass ||
            !confirmError
        ) {

            return;

        }


        const newPassword =
            newPass.value;


        const confirmPassword =
            confPass.value;


        confPass.classList.remove(
            "password-error",
            "password-success"
        );


        if (
            confirmPassword === ""
        ) {

            confirmError.style.display =
                "none";

            confirmError.textContent =
                "";

            return;

        }


        confirmError.style.display =
            "block";


        if (
            newPassword ===
            confirmPassword
        ) {

            confirmError.textContent =
                "✓ Passwords match";


            confirmError.style.color =
                "#059669";


            confPass.classList.add(
                "password-success"
            );

        } else {

            confirmError.textContent =
                "✕ Passwords do not match";


            confirmError.style.color =
                "#dc2626";


            confPass.classList.add(
                "password-error"
            );

        }

    }



    /* =====================================================
       PASSWORD INPUT
       ===================================================== */

    if (newPass) {

        newPass.addEventListener(
            "input",
            function () {

                const value =
                    newPass.value;


                if (
                    !passwordChecker ||
                    !strengthText
                ) {

                    return;

                }


                /* EMPTY PASSWORD */

                if (
                    value.trim() === ""
                ) {

                    passwordChecker.classList.add(
                        "hidden"
                    );


                    Object.keys(
                        passwordRules
                    ).forEach(
                        function (ruleName) {

                            updateRule(
                                ruleName,
                                false
                            );

                        }
                    );


                    strengthText.textContent =
                        "";


                    strengthText.classList.remove(
                        "weak",
                        "medium",
                        "strong"
                    );


                    validateConfirmPassword();

                    return;

                }


                /* SHOW PASSWORD CHECKER */

                passwordChecker.classList.remove(
                    "hidden"
                );


                let score = 0;


                Object.keys(
                    passwordRules
                ).forEach(
                    function (ruleName) {

                        const rule =
                            passwordRules[
                                ruleName
                            ];


                        const valid =
                            rule.test(
                                value
                            );


                        if (valid) {

                            score++;

                        }


                        updateRule(
                            ruleName,
                            valid
                        );

                    }
                );


                strengthText.classList.remove(
                    "weak",
                    "medium",
                    "strong"
                );


                if (score <= 2) {

                    strengthText.textContent =
                        "Weak";


                    strengthText.classList.add(
                        "weak"
                    );

                } else if (score <= 4) {

                    strengthText.textContent =
                        "Medium";


                    strengthText.classList.add(
                        "medium"
                    );

                } else {

                    strengthText.textContent =
                        "Strong";


                    strengthText.classList.add(
                        "strong"
                    );

                }


                validateConfirmPassword();

            }
        );

    }



    /* =====================================================
       CONFIRM PASSWORD INPUT
       ===================================================== */

    if (confPass) {

        confPass.addEventListener(
            "input",
            validateConfirmPassword
        );

    }



    /* =====================================================
       DISABLE 2FA
       ===================================================== */

    const disable2faForm =
        document.getElementById(
            "disable2faForm"
        );


    if (disable2faForm) {

        disable2faForm.addEventListener(
            "submit",
            function (event) {

                event.preventDefault();


                const confirmed =
                    confirm(
                        "Are you sure you want to disable Two-Factor Authentication?"
                    );


                if (!confirmed) {

                    return;

                }


                const submitButton =
                    disable2faForm.querySelector(
                        'button[type="submit"]'
                    );


                if (submitButton) {

                    submitButton.disabled =
                        true;


                    submitButton.innerHTML =
                        "<span>Disabling...</span>";

                }


                disable2faForm.submit();

            }
        );

    }



    /* =====================================================
       PASSWORD FORM SUBMIT
       ===================================================== */

    const passwordForm =
        document.querySelector(
            'form[action*="password"]'
        );


    if (passwordForm) {

        passwordForm.addEventListener(
            "submit",
            function (event) {

                if (
                    !newPass ||
                    !confPass
                ) {

                    return;

                }


                if (
                    newPass.value !==
                    confPass.value
                ) {

                    event.preventDefault();


                    if (confirmError) {

                        confirmError.style.display =
                            "block";


                        confirmError.style.color =
                            "#dc2626";


                        confirmError.textContent =
                            "✕ Passwords do not match";

                    }


                    confPass.classList.add(
                        "password-error"
                    );


                    confPass.focus();


                    return false;

                }

            }
        );

    }



    /* =====================================================
       DOWNLOAD DATA
       ===================================================== */

    const downloadDataBtn =
        document.getElementById(
            "downloadDataBtn"
        );


    if (downloadDataBtn) {

        downloadDataBtn.addEventListener(
            "click",
            function () {

                alert(
                    "Your data download request has been received."
                );

            }
        );

    }

});



/* =========================================================
   PASSWORD VISIBILITY
   ========================================================= */

window.togglePass = function (id) {

    const input =
        document.getElementById(id);


    if (!input) {

        return;

    }


    const wrapper =
        input.closest(
            ".password-wrapper"
        );


    if (!wrapper) {

        return;

    }


    const iconContainer =
        wrapper.querySelector(
            ".eye-icon"
        );


    if (
        input.type ===
        "password"
    ) {

        input.type =
            "text";


        if (iconContainer) {

            iconContainer.setAttribute(
                "aria-label",
                "Hide password"
            );

        }

    } else {

        input.type =
            "password";


        if (iconContainer) {

            iconContainer.setAttribute(
                "aria-label",
                "Show password"
            );

        }

    }

};



/* =========================================================
   PROFILE IMAGE PREVIEW
   ========================================================= */

window.previewImage = function (event) {

    const input =
        event.target;


    const preview =
        document.getElementById(
            "preview"
        );


    if (
        !preview ||
        !input.files ||
        !input.files[0]
    ) {

        return;

    }


    const file =
        input.files[0];


    if (
        !file.type.startsWith(
            "image/"
        )
    ) {

        alert(
            "Please select a valid image file."
        );


        input.value =
            "";


        return;

    }


    const objectURL =
        URL.createObjectURL(
            file
        );


    preview.src =
        objectURL;


    preview.onload =
        function () {

            URL.revokeObjectURL(
                objectURL
            );

        };

};



/* =========================================================
   LOGOUT
   ========================================================= */

window.confirmLogout = function () {

    return confirm(
        "Are you sure you want to logout?"
    );

};



/* =========================================================
   REPORT ISSUE MODALS
   ========================================================= */


/* =========================================================
   OPEN REPORT ISSUE MODAL
   ========================================================= */

window.openReportIssueModal = function () {

    const modal =
        document.getElementById(
            "reportIssueModal"
        );


    if (!modal) {

        console.error(
            "ERROR: #reportIssueModal was not found."
        );

        return;

    }


    console.log(
        "Opening Report Issue Modal"
    );


    modal.classList.add(
        "active"
    );


    modal.setAttribute(
        "aria-hidden",
        "false"
    );


    document.body.style.overflow =
        "hidden";

};



/* =========================================================
   CLOSE REPORT ISSUE MODAL
   ========================================================= */

window.closeReportIssueModal = function () {

    const modal =
        document.getElementById(
            "reportIssueModal"
        );


    if (!modal) {

        return;

    }


    modal.classList.remove(
        "active"
    );


    modal.setAttribute(
        "aria-hidden",
        "true"
    );


    document.body.style.overflow =
        "";

};



/* =========================================================
   OPEN REPORT CONFIRMATION MODAL
   ========================================================= */

window.openReportConfirmModal = function () {

    const form =
        document.getElementById(
            "reportIssueForm"
        );


    const confirmModal =
        document.getElementById(
            "reportConfirmModal"
        );


    if (!form) {

        console.error(
            "ERROR: #reportIssueForm was not found."
        );

        return;

    }


    if (!confirmModal) {

        console.error(
            "ERROR: #reportConfirmModal was not found."
        );

        return;

    }


    /* VALIDATE FORM */

    if (
        !form.checkValidity()
    ) {

        form.reportValidity();

        return;

    }


    /* CLOSE REPORT FORM MODAL */

    const reportModal =
        document.getElementById(
            "reportIssueModal"
        );


    if (reportModal) {

        reportModal.classList.remove(
            "active"
        );


        reportModal.setAttribute(
            "aria-hidden",
            "true"
        );

    }


    /* OPEN CONFIRMATION */

    confirmModal.classList.add(
        "active"
    );


    confirmModal.setAttribute(
        "aria-hidden",
        "false"
    );


    document.body.style.overflow =
        "hidden";

};



/* =========================================================
   CLOSE REPORT CONFIRMATION MODAL
   ========================================================= */

window.closeReportConfirmModal = function () {

    const confirmModal =
        document.getElementById(
            "reportConfirmModal"
        );


    const reportModal =
        document.getElementById(
            "reportIssueModal"
        );


    if (confirmModal) {

        confirmModal.classList.remove(
            "active"
        );


        confirmModal.setAttribute(
            "aria-hidden",
            "true"
        );

    }


    /* RETURN TO REPORT FORM */

    if (reportModal) {

        reportModal.classList.add(
            "active"
        );


        reportModal.setAttribute(
            "aria-hidden",
            "false"
        );


        document.body.style.overflow =
            "hidden";

    }

};



/* =========================================================
   SUBMIT REPORT
   ========================================================= */

window.submitIssueReport = function () {

    const form =
        document.getElementById(
            "reportIssueForm"
        );


    if (!form) {

        console.error(
            "ERROR: #reportIssueForm was not found."
        );

        return;

    }


    /* VALIDATE */

    if (
        !form.checkValidity()
    ) {

        form.reportValidity();

        return;

    }


    /* DISABLE CONFIRM BUTTON */

    const submitButton =
        document.querySelector(
            "#reportConfirmModal .report-btn-submit"
        );


    if (submitButton) {

        submitButton.disabled =
            true;


        submitButton.textContent =
            "Submitting...";

    }


    /* SUBMIT FORM */

    form.submit();

};



/* =========================================================
   CLOSE SUCCESS MODAL
   ========================================================= */

window.closeReportSuccessModal = function () {

    const modal =
        document.getElementById(
            "reportSuccessModal"
        );


    if (!modal) {

        return;

    }


    modal.classList.remove(
        "active"
    );


    modal.setAttribute(
        "aria-hidden",
        "true"
    );


    document.body.style.overflow =
        "";

};



/* =========================================================
   CLICK OUTSIDE REPORT MODALS
   ========================================================= */

document.addEventListener(
    "click",
    function (event) {

        const reportModal =
            document.getElementById(
                "reportIssueModal"
            );


        const confirmModal =
            document.getElementById(
                "reportConfirmModal"
            );


        const successModal =
            document.getElementById(
                "reportSuccessModal"
            );


        /* REPORT MODAL */

        if (
            reportModal &&
            event.target === reportModal
        ) {

            window.closeReportIssueModal();

            return;

        }


        /* CONFIRMATION MODAL */

        if (
            confirmModal &&
            event.target === confirmModal
        ) {

            window.closeReportConfirmModal();

            return;

        }


        /* SUCCESS MODAL */

        if (
            successModal &&
            event.target === successModal
        ) {

            window.closeReportSuccessModal();

            return;

        }

    }
);



/* =========================================================
   ESC KEY
   ========================================================= */

document.addEventListener(
    "keydown",
    function (event) {

        if (
            event.key !== "Escape"
        ) {

            return;

        }


        const confirmModal =
            document.getElementById(
                "reportConfirmModal"
            );


        const reportModal =
            document.getElementById(
                "reportIssueModal"
            );


        const successModal =
            document.getElementById(
                "reportSuccessModal"
            );


        /* CLOSE CONFIRMATION FIRST */

        if (
            confirmModal &&
            confirmModal.classList.contains(
                "active"
            )
        ) {

            window.closeReportConfirmModal();

            return;

        }


        /* CLOSE REPORT FORM */

        if (
            reportModal &&
            reportModal.classList.contains(
                "active"
            )
        ) {

            window.closeReportIssueModal();

            return;

        }


        /* CLOSE SUCCESS */

        if (
            successModal &&
            successModal.classList.contains(
                "active"
            )
        ) {

            window.closeReportSuccessModal();

        }

    }
);
