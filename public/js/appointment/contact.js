// ============================================================
// CONTACT PAGE JAVASCRIPT
// ============================================================

document.addEventListener(
    "DOMContentLoaded",
    function () {


        // ====================================================
        // MESSAGE CHARACTER COUNT
        // ====================================================

        const message =
            document.getElementById(
                "message"
            );

        const characterCount =
            document.getElementById(
                "characterCount"
            );


        if (
            message &&
            characterCount
        ) {

            function updateCharacterCount() {

                const length =
                    message.value.length;

                characterCount.textContent =
                    length + " / 1000";

            }


            message.addEventListener(
                "input",
                updateCharacterCount
            );


            updateCharacterCount();

        }


        // ====================================================
        // CONTACT FORM
        // ====================================================

        const contactForm =
            document.getElementById(
                "contactForm"
            );

        const contactSubmit =
            document.getElementById(
                "contactSubmit"
            );


        if (
            contactForm &&
            contactSubmit
        ) {

            contactForm.addEventListener(
                "submit",
                function () {

                    contactSubmit.classList.add(
                        "loading"
                    );


                    contactSubmit.querySelector(
                        "span"
                    ).textContent =
                        "Sending...";

                }
            );

        }


        // ====================================================
        // OPEN MAP
        // ====================================================

        const openMapButton =
            document.getElementById(
                "openMapButton"
            );


        if (openMapButton) {

            openMapButton.addEventListener(
                "click",
                function () {

                    /*
                     * Replace this URL with the
                     * actual Google Maps location
                     * of your clinic.
                     */

                    const mapUrl =
                        "https://www.google.com/maps";


                    window.open(
                        mapUrl,
                        "_blank",
                        "noopener,noreferrer"
                    );

                }
            );

        }

    }
);


document.addEventListener("DOMContentLoaded", function () {

    // ============================================================
    // CONTACT FORM
    // ============================================================

    const contactForm =
        document.getElementById("contactForm");

    const contactSubmit =
        document.getElementById("contactSubmit");

    const contactSubmitText =
        document.getElementById("contactSubmitText");


    // ============================================================
    // SUCCESS MODAL
    // ============================================================

    const successModal =
        document.getElementById("successModal");

    const closeSuccessModal =
        document.getElementById("closeSuccessModal");

    const successModalOverlay =
        document.getElementById("successModalOverlay");


    // ============================================================
    // ERROR MODAL
    // ============================================================

    const errorModal =
        document.getElementById("errorModal");

    const closeErrorModal =
        document.getElementById("closeErrorModal");

    const errorModalOverlay =
        document.getElementById("errorModalOverlay");


    // ============================================================
    // OPEN MODAL
    // ============================================================

    function openModal(modal) {

        if (!modal) {
            return;
        }

        modal.classList.add("show");

        modal.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.classList.add(
            "modal-open"
        );
    }


    // ============================================================
    // CLOSE MODAL
    // ============================================================

    function closeModal(modal) {

        if (!modal) {
            return;
        }

        modal.classList.remove("show");

        modal.setAttribute(
            "aria-hidden",
            "true"
        );

        document.body.classList.remove(
            "modal-open"
        );
    }


    // ============================================================
    // CHARACTER COUNTER
    // ============================================================

    const message =
        document.getElementById("message");

    const characterCount =
        document.getElementById("characterCount");


    if (
        message &&
        characterCount
    ) {

        function updateCharacterCount() {

            characterCount.textContent =
                message.value.length +
                " / 1000";

        }


        message.addEventListener(
            "input",
            updateCharacterCount
        );


        updateCharacterCount();

    }


    // ============================================================
    // CONTACT FORM SUBMISSION
    // ============================================================

    if (
        contactForm &&
        contactSubmit
    ) {

        contactForm.addEventListener(
            "submit",
            async function (event) {

                event.preventDefault();


                // ================================================
                // PREVENT DOUBLE CLICK
                // ================================================

                if (
                    contactSubmit.disabled
                ) {

                    return;

                }


                // ================================================
                // CSRF
                // ================================================

                const csrfMeta =
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    );


                if (!csrfMeta) {

                    console.error(
                        "CSRF token not found."
                    );

                    openModal(
                        errorModal
                    );

                    return;

                }


                const csrfToken =
                    csrfMeta.getAttribute(
                        "content"
                    );


                // ================================================
                // LOADING
                // ================================================

                contactSubmit.disabled =
                    true;

                contactSubmit.classList.add(
                    "loading"
                );


                if (contactSubmitText) {

                    contactSubmitText.textContent =
                        "Sending...";

                }


                try {

                    // ============================================
                    // SEND FORM TO LARAVEL
                    // ============================================

                    const response =
                        await fetch(
                            contactForm.action,
                            {
                                method: "POST",

                                headers: {

                                    "X-CSRF-TOKEN":
                                        csrfToken,

                                    "Accept":
                                        "application/json",

                                    "X-Requested-With":
                                        "XMLHttpRequest"

                                },

                                body:
                                    new FormData(
                                        contactForm
                                    )

                            }
                        );


                    console.log(
                        "Contact response:",
                        response.status
                    );


                    // ============================================
                    // SUCCESS
                    // ============================================

                    if (
                        response.ok
                    ) {

                        console.log(
                            "Message successfully sent."
                        );


                        // Reset form

                        contactForm.reset();


                        // Reset character counter

                        if (
                            characterCount
                        ) {

                            characterCount.textContent =
                                "0 / 1000";

                        }


                        // Show success modal

                        openModal(
                            successModal
                        );


                    }

                    // ============================================
                    // VALIDATION ERROR
                    // ============================================

                    else if (
                        response.status === 422
                    ) {

                        console.error(
                            "Validation error."
                        );


                        openModal(
                            errorModal
                        );

                    }

                    // ============================================
                    // OTHER SERVER ERROR
                    // ============================================

                    else {

                        console.error(
                            "Server error:",
                            response.status
                        );


                        openModal(
                            errorModal
                        );

                    }

                }

                // ================================================
                // NETWORK ERROR
                // ================================================

                catch (error) {

                    console.error(
                        "Contact form error:",
                        error
                    );


                    openModal(
                        errorModal
                    );

                }

                // ================================================
                // RESET BUTTON
                // ================================================

                finally {

                    contactSubmit.disabled =
                        false;


                    contactSubmit.classList.remove(
                        "loading"
                    );


                    if (
                        contactSubmitText
                    ) {

                        contactSubmitText.textContent =
                            "Send Message";

                    }

                }

            }
        );

    }


    // ============================================================
    // CLOSE SUCCESS MODAL
    // ============================================================

    if (closeSuccessModal) {

        closeSuccessModal.addEventListener(
            "click",
            function () {

                closeModal(
                    successModal
                );

            }
        );

    }


    if (successModalOverlay) {

        successModalOverlay.addEventListener(
            "click",
            function () {

                closeModal(
                    successModal
                );

            }
        );

    }


    // ============================================================
    // CLOSE ERROR MODAL
    // ============================================================

    if (closeErrorModal) {

        closeErrorModal.addEventListener(
            "click",
            function () {

                closeModal(
                    errorModal
                );

            }
        );

    }


    if (errorModalOverlay) {

        errorModalOverlay.addEventListener(
            "click",
            function () {

                closeModal(
                    errorModal
                );

            }
        );

    }


    // ============================================================
    // ESC KEY
    // ============================================================

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key !== "Escape"
            ) {

                return;

            }


            closeModal(
                successModal
            );

            closeModal(
                errorModal
            );

        }
    );


    // ============================================================
    // OPEN MAP
    // ============================================================

    const openMapButton =
        document.getElementById(
            "openMapButton"
        );


    if (openMapButton) {

        openMapButton.addEventListener(
            "click",
            function () {

                window.open(
                    "https://www.google.com/maps",
                    "_blank",
                    "noopener,noreferrer"
                );

            }
        );

    }

});
