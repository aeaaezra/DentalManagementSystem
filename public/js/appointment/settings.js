    document.addEventListener(
        "DOMContentLoaded",
        function () {


            // ========================================================
            // DARK MODE
            // ========================================================

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


            // LOAD SAVED THEME

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



            // ========================================================
            // PASSWORD RULES
            // ========================================================

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



            // ========================================================
            // PASSWORD ELEMENTS
            // ========================================================

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



            // ========================================================
            // PASSWORD INPUT
            // ========================================================

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


                        // EMPTY PASSWORD

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


                        // SHOW PASSWORD CHECKER

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


                        // REMOVE OLD STRENGTH CLASSES

                        strengthText.classList.remove(
                            "weak",
                            "medium",
                            "strong"
                        );


                        // PASSWORD STRENGTH

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



            // ========================================================
            // CONFIRM PASSWORD INPUT
            // ========================================================

            if (confPass) {

                confPass.addEventListener(
                    "input",
                    validateConfirmPassword
                );

            }



            // ========================================================
            // UPDATE PASSWORD RULE
            // ========================================================

            function updateRule(
                id,
                valid
            ) {

                const item =
                    document.getElementById(
                        id
                    );


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



            // ========================================================
            // VALIDATE CONFIRM PASSWORD
            // ========================================================

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


                // EMPTY CONFIRM PASSWORD

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


                // PASSWORDS MATCH

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



            // ========================================================
            // DISABLE 2FA FORM
            // ========================================================

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



            // ========================================================
            // PASSWORD FORM SUBMIT
            // ========================================================

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



            // ========================================================
            // DOWNLOAD DATA BUTTON
            // ========================================================

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

        }
    );



    // ========================================================
    // TOGGLE PASSWORD VISIBILITY
    // ========================================================

    function togglePass(id) {

        const input =
            document.getElementById(
                id
            );


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

    }



    // ========================================================
    // PROFILE IMAGE PREVIEW
    // ========================================================

    function previewImage(event) {

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


        // CHECK IF SELECTED FILE IS IMAGE

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

    }



    // ========================================================
    // CONFIRM LOGOUT
    // ========================================================

    function confirmLogout() {

        return confirm(
            "Are you sure you want to logout?"
        );

    }
/* ========================================================
   REPORT ISSUE MODALS
   ======================================================== */

window.openReportIssueModal = function () {

    const modal =
        document.getElementById("reportIssueModal");

    if (!modal) {

        console.error(
            "ERROR: #reportIssueModal was not found."
        );

        return;
    }

    console.log("Opening Report Issue Modal");

    modal.classList.add("active");

    modal.setAttribute(
        "aria-hidden",
        "false"
    );

    document.body.style.overflow = "hidden";
};


/* ========================================================
   CLOSE REPORT MODAL
   ======================================================== */

window.closeReportIssueModal = function () {

    const modal =
        document.getElementById("reportIssueModal");

    if (!modal) {
        return;
    }

    modal.classList.remove("active");

    modal.setAttribute(
        "aria-hidden",
        "true"
    );

    document.body.style.overflow = "";
};


/* ========================================================
   OPEN CONFIRMATION MODAL
   ======================================================== */

window.openReportConfirmModal = function () {

    /*
     * IMPORTANT:
     * This must match the ID in your Blade form.
     */

    const form =
        document.getElementById("reportIssueForm");

    const confirmModal =
        document.getElementById("reportConfirmModal");


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


    /*
     * Validate form
     */

    if (!form.checkValidity()) {

        form.reportValidity();

        return;
    }


    /*
     * Close report modal
     */

    const reportModal =
        document.getElementById("reportIssueModal");


    if (reportModal) {

        reportModal.classList.remove("active");

        reportModal.setAttribute(
            "aria-hidden",
            "true"
        );
    }


    /*
     * Open confirmation modal
     */

    confirmModal.classList.add("active");

    confirmModal.setAttribute(
        "aria-hidden",
        "false"
    );

    document.body.style.overflow = "hidden";
};


/* ========================================================
   CLOSE CONFIRMATION MODAL
   ======================================================== */

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

        confirmModal.classList.remove("active");

        confirmModal.setAttribute(
            "aria-hidden",
            "true"
        );
    }


    /*
     * Return to report form
     */

    if (reportModal) {

        reportModal.classList.add("active");

        reportModal.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.style.overflow = "hidden";
    }
};


/* ========================================================
   SUBMIT REPORT
   ======================================================== */

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


    /*
     * Validate form
     */

    if (!form.checkValidity()) {

        form.reportValidity();

        return;
    }


    /*
     * Disable submit button
     */

    const submitButton =
        document.querySelector(
            "#reportConfirmModal .report-submit-btn"
        );


    if (submitButton) {

        submitButton.disabled = true;

        submitButton.textContent =
            "Submitting...";
    }


    /*
     * Submit form normally
     */

    form.submit();
};


/* ========================================================
   CLOSE SUCCESS MODAL
   ======================================================== */

window.closeReportSuccessModal = function () {

    const modal =
        document.getElementById(
            "reportSuccessModal"
        );


    if (!modal) {
        return;
    }


    modal.classList.remove("active");

    modal.setAttribute(
        "aria-hidden",
        "true"
    );

    document.body.style.overflow = "";
};


/* ========================================================
   CLICK OUTSIDE MODALS
   ======================================================== */

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


        /*
         * Report modal
         */

        if (
            reportModal &&
            event.target === reportModal
        ) {

            window.closeReportIssueModal();

            return;
        }


        /*
         * Confirmation modal
         */

        if (
            confirmModal &&
            event.target === confirmModal
        ) {

            window.closeReportConfirmModal();

            return;
        }


        /*
         * Success modal
         */

        if (
            successModal &&
            event.target === successModal
        ) {

            window.closeReportSuccessModal();

            return;
        }

    }
);


/* ========================================================
   ESC KEY
   ======================================================== */

document.addEventListener(
    "keydown",
    function (event) {

        if (event.key !== "Escape") {
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


        /*
         * Close confirmation first
         */

        if (
            confirmModal &&
            confirmModal.classList.contains("active")
        ) {

            window.closeReportConfirmModal();

            return;
        }


        /*
         * Close report modal
         */

        if (
            reportModal &&
            reportModal.classList.contains("active")
        ) {

            window.closeReportIssueModal();

            return;
        }


        /*
         * Close success modal
         */

        if (
            successModal &&
            successModal.classList.contains("active")
        ) {

            window.closeReportSuccessModal();
        }

    }
);
window.openReportIssueModal = function () {

    console.log("REPORT BUTTON CLICKED");

    const modal = document.getElementById("reportIssueModal");

    console.log("Modal:", modal);

    if (!modal) {
        console.error("reportIssueModal NOT FOUND");
        return;
    }

    modal.style.display = "flex";
    modal.classList.add("active");

    modal.setAttribute("aria-hidden", "false");

    document.body.style.overflow = "hidden";

    console.log("REPORT MODAL OPENED");
};

document.addEventListener("DOMContentLoaded", function () {

    const headerMenuBtn =
        document.getElementById("settingsHeaderMenuBtn");

    const existingMenuBtn =
        document.getElementById("settingsMobileMenuBtn");

    if (headerMenuBtn && existingMenuBtn) {

        headerMenuBtn.addEventListener("click", function () {
            existingMenuBtn.click();
        });

    }

});
document.addEventListener("DOMContentLoaded", function () {

    const mobileMenuBtn =
        document.getElementById("settingsMobileMenuBtn");

    const mobileSidebar =
        document.getElementById("settingsMobileSidebar");

    const mobileSidebarOverlay =
        document.getElementById("settingsMobileSidebarOverlay");

    const closeMobileSidebar =
        document.getElementById("settingsMobileCloseBtn");


    if (!mobileMenuBtn || !mobileSidebar) {
        console.warn("Settings mobile menu elements not found.");
        return;
    }


    /* =========================================
       OPEN
       ========================================= */

    function openMobileSidebar() {

        mobileSidebar.classList.add("active");

        mobileSidebar.setAttribute(
            "aria-hidden",
            "false"
        );

        if (mobileSidebarOverlay) {
            mobileSidebarOverlay.classList.add("active");

            mobileSidebarOverlay.setAttribute(
                "aria-hidden",
                "false"
            );
        }

        mobileMenuBtn.setAttribute(
            "aria-expanded",
            "true"
        );

        document.body.style.overflow = "hidden";
    }


    /* =========================================
       CLOSE
       ========================================= */

    function closeMobileMenu() {

        mobileSidebar.classList.remove("active");

        mobileSidebar.setAttribute(
            "aria-hidden",
            "true"
        );

        if (mobileSidebarOverlay) {
            mobileSidebarOverlay.classList.remove("active");

            mobileSidebarOverlay.setAttribute(
                "aria-hidden",
                "true"
            );
        }

        mobileMenuBtn.setAttribute(
            "aria-expanded",
            "false"
        );

        document.body.style.overflow = "";
    }


    /* =========================================
       BURGER
       ========================================= */

    mobileMenuBtn.addEventListener(
        "click",
        function (event) {

            event.preventDefault();
            event.stopPropagation();

            openMobileSidebar();
        }
    );


    /* =========================================
       CLOSE BUTTON
       ========================================= */

    if (closeMobileSidebar) {

        closeMobileSidebar.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                closeMobileMenu();
            }
        );
    }


    /* =========================================
       OVERLAY
       ========================================= */

    if (mobileSidebarOverlay) {

        mobileSidebarOverlay.addEventListener(
            "click",
            function () {

                closeMobileMenu();
            }
        );
    }


    /* =========================================
       NAVIGATION
       ========================================= */

    mobileSidebar
        .querySelectorAll(".settings-mobile-link")
        .forEach(function (link) {

            link.addEventListener(
                "click",
                function () {

                    closeMobileMenu();
                }
            );
        });


    /* =========================================
       ESC
       ========================================= */

    document.addEventListener(
        "keydown",
        function (event) {

            if (event.key === "Escape") {

                closeMobileMenu();
            }
        }
    );

});


document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('issueReportForm');
    const openButton = document.getElementById('openReportConfirm');
    const modal = document.getElementById('reportConfirmModal');
    const cancelButton = document.getElementById('cancelReportConfirm');
    const confirmButton = document.getElementById('confirmReportSubmit');

    console.log('Issue Report Modal JS loaded');

    if (!form) {
        console.error('issueReportForm not found');
        return;
    }

    if (!openButton) {
        console.error('openReportConfirm button not found');
        return;
    }

    if (!modal) {
        console.error('reportConfirmModal not found');
        return;
    }

    // OPEN MODAL
    openButton.addEventListener('click', function () {

        console.log('Submit Report button clicked');

        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('report-modal-open');
    });


    // CANCEL
    cancelButton.addEventListener('click', function () {

        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('report-modal-open');
    });


    // CONFIRM SUBMIT
    confirmButton.addEventListener('click', function () {

        console.log('Confirm Submit clicked');

        // Actually submit the form
        form.submit();
    });


    // CLICK OUTSIDE MODAL
    modal.addEventListener('click', function (event) {

        if (event.target === modal) {

            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');

            document.body.classList.remove('report-modal-open');
        }

    });


    // ESC KEY
    document.addEventListener('keydown', function (event) {

        if (
            event.key === 'Escape' &&
            modal.classList.contains('is-open')
        ) {

            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');

            document.body.classList.remove('report-modal-open');
        }

    });

});
