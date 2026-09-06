// ============================================================
// FEEDBACK SYSTEM
// ============================================================

document.addEventListener("DOMContentLoaded", function () {

    // ========================================================
    // ELEMENTS
    // ========================================================

    const feedbackModal =
        document.getElementById("feedbackModal");

    const feedbackOverlay =
        document.getElementById("feedbackOverlay");

    const closeFeedbackModalButton =
        document.getElementById("closeFeedbackModal");

    const feedbackForm =
        document.getElementById("feedbackForm");

    const feedbackServiceName =
        document.getElementById("feedbackServiceName");

    const ratingInput =
        document.getElementById("ratingInput");

    const ratingText =
        document.getElementById("ratingText");

    const feedbackComment =
        document.getElementById("feedbackComment");

    const feedbackCharacterCount =
        document.getElementById(
            "feedbackCharacterCount"
        );

    const feedbackFormError =
        document.getElementById(
            "feedbackFormError"
        );

    const submitFeedback =
        document.getElementById(
            "submitFeedback"
        );

    const feedbackSuccessModal =
        document.getElementById(
            "feedbackSuccessModal"
        );

    const feedbackSuccessOverlay =
        document.getElementById(
            "feedbackSuccessOverlay"
        );

    const closeFeedbackSuccess =
        document.getElementById(
            "closeFeedbackSuccess"
        );

    const stars =
        document.querySelectorAll(".star");

    const feedbackButtons =
        document.querySelectorAll(
            ".feedback-button"
        );


    // ========================================================
    // SELECTED RATING
    // ========================================================

    let selectedRating = 0;


    // ========================================================
    // RATING LABELS
    // ========================================================

    const ratingLabels = {

        1: "Very Dissatisfied",

        2: "Dissatisfied",

        3: "Okay",

        4: "Satisfied",

        5: "Very Satisfied"

    };


    // ========================================================
    // OPEN FEEDBACK MODAL
    // ========================================================

    function openFeedbackModal(
        appointmentId,
        serviceName
    ) {

        if (!feedbackModal) {
            console.error(
                "Feedback modal was not found."
            );

            return;
        }


        if (!feedbackForm) {
            console.error(
                "Feedback form was not found."
            );

            return;
        }


        // SET FORM ACTION

        feedbackForm.action =
            `/appointments/${appointmentId}/feedback`;


        // SET SERVICE NAME

        if (feedbackServiceName) {

            feedbackServiceName.textContent =
                serviceName || "Dental Service";

        }


        // RESET RATING

        selectedRating = 0;


        if (ratingInput) {

            ratingInput.value = "";

        }


        if (ratingText) {

            ratingText.textContent =
                "Select a rating";

        }


        // RESET STARS

        stars.forEach(function (star) {

            star.classList.remove(
                "selected"
            );

        });


        // RESET COMMENT

        if (feedbackComment) {

            feedbackComment.value = "";

        }


        // RESET COUNTER

        updateCharacterCount();


        // REMOVE ERROR

        hideFormError();


        // RESET SUBMIT BUTTON

        if (submitFeedback) {

            submitFeedback.disabled = false;

            submitFeedback.textContent =
                "Submit Feedback";

        }


        // SHOW MODAL

        feedbackModal.classList.add(
            "show"
        );

        feedbackModal.setAttribute(
            "aria-hidden",
            "false"
        );


        // PREVENT PAGE SCROLL

        document.body.classList.add(
            "feedback-modal-open"
        );

    }


    // ========================================================
    // CLOSE FEEDBACK MODAL
    // ========================================================

    function closeFeedbackModal() {

        if (!feedbackModal) {
            return;
        }


        feedbackModal.classList.remove(
            "show"
        );

        feedbackModal.setAttribute(
            "aria-hidden",
            "true"
        );


        document.body.classList.remove(
            "feedback-modal-open"
        );

    }


    // ========================================================
    // OPEN SUCCESS MODAL
    // ========================================================

    function openSuccessModal() {

        if (!feedbackSuccessModal) {
            return;
        }


        feedbackSuccessModal.classList.add(
            "show"
        );

        feedbackSuccessModal.setAttribute(
            "aria-hidden",
            "false"
        );


        document.body.classList.add(
            "feedback-modal-open"
        );

    }


    // ========================================================
    // CLOSE SUCCESS MODAL
    // ========================================================

    function closeSuccessModal() {

        if (!feedbackSuccessModal) {
            return;
        }


        feedbackSuccessModal.classList.remove(
            "show"
        );

        feedbackSuccessModal.setAttribute(
            "aria-hidden",
            "true"
        );


        document.body.classList.remove(
            "feedback-modal-open"
        );


        // RELOAD TO SHOW UPDATED FEEDBACK STATUS

        window.location.reload();

    }


    // ========================================================
    // FEEDBACK BUTTONS
    // ========================================================

    feedbackButtons.forEach(function (button) {

        button.addEventListener(
            "click",
            function () {

                const appointmentId =
                    this.dataset.appointmentId;

                const serviceName =
                    this.dataset.serviceName;


                if (!appointmentId) {

                    console.error(
                        "Appointment ID is missing."
                    );

                    return;

                }


                openFeedbackModal(
                    appointmentId,
                    serviceName
                );

            }
        );

    });


    // ========================================================
    // STAR RATING
    // ========================================================

    stars.forEach(function (star) {

        star.addEventListener(
            "click",
            function () {

                const rating =
                    parseInt(
                        this.dataset.rating,
                        10
                    );


                if (
                    isNaN(rating) ||
                    rating < 1 ||
                    rating > 5
                ) {

                    return;

                }


                selectedRating =
                    rating;


                // UPDATE HIDDEN INPUT

                if (ratingInput) {

                    ratingInput.value =
                        rating;

                }


                // UPDATE STARS

                stars.forEach(function (item) {

                    const value =
                        parseInt(
                            item.dataset.rating,
                            10
                        );


                    if (
                        value <= selectedRating
                    ) {

                        item.classList.add(
                            "selected"
                        );

                    } else {

                        item.classList.remove(
                            "selected"
                        );

                    }

                });


                // UPDATE RATING TEXT

                if (ratingText) {

                    ratingText.textContent =
                        ratingLabels[rating];

                }

            }
        );

    });


    // ========================================================
    // STAR HOVER
    // ========================================================

    stars.forEach(function (star) {

        star.addEventListener(
            "mouseenter",
            function () {

                const hoverRating =
                    parseInt(
                        this.dataset.rating,
                        10
                    );


                stars.forEach(function (item) {

                    const value =
                        parseInt(
                            item.dataset.rating,
                            10
                        );


                    if (
                        value <= hoverRating
                    ) {

                        item.classList.add(
                            "hovered"
                        );

                    } else {

                        item.classList.remove(
                            "hovered"
                        );

                    }

                });

            }
        );

    });


    // ========================================================
    // REMOVE STAR HOVER
    // ========================================================

    const starsContainer =
        document.querySelector(".stars");


    if (starsContainer) {

        starsContainer.addEventListener(
            "mouseleave",
            function () {

                stars.forEach(function (star) {

                    star.classList.remove(
                        "hovered"
                    );

                });

            }
        );

    }


    // ========================================================
    // CHARACTER COUNTER
    // ========================================================

    function updateCharacterCount() {

        if (
            !feedbackComment ||
            !feedbackCharacterCount
        ) {

            return;

        }


        feedbackCharacterCount.textContent =
            feedbackComment.value.length;

    }


    if (feedbackComment) {

        feedbackComment.addEventListener(
            "input",
            updateCharacterCount
        );

    }


    // ========================================================
    // SHOW FORM ERROR
    // ========================================================

    function showFormError(message) {

        if (!feedbackFormError) {
            return;
        }


        feedbackFormError.textContent =
            message;


        feedbackFormError.classList.remove(
            "hidden"
        );

    }


    // ========================================================
    // HIDE FORM ERROR
    // ========================================================

    function hideFormError() {

        if (!feedbackFormError) {
            return;
        }


        feedbackFormError.textContent =
            "";

        feedbackFormError.classList.add(
            "hidden"
        );

    }


    // ========================================================
    // FORM SUBMISSION
    // ========================================================

    if (feedbackForm) {

        feedbackForm.addEventListener(
            "submit",
            async function (event) {

                event.preventDefault();


                hideFormError();


                // CHECK RATING

                if (
                    selectedRating < 1 ||
                    selectedRating > 5
                ) {

                    showFormError(
                        "Please select a rating before submitting your feedback."
                    );

                    return;

                }


                // CHECK FORM ACTION

                if (!feedbackForm.action) {

                    showFormError(
                        "Feedback submission URL is missing."
                    );

                    return;

                }


                // DISABLE BUTTON

                if (submitFeedback) {

                    submitFeedback.disabled =
                        true;

                    submitFeedback.textContent =
                        "Submitting...";

                }


                try {

                    const formData =
                        new FormData(
                            feedbackForm
                        );


                    const response =
                        await fetch(
                            feedbackForm.action,
                            {

                                method: "POST",

                                body: formData,

                                headers: {

                                    "Accept":
                                        "application/json",

                                    "X-Requested-With":
                                        "XMLHttpRequest"

                                }

                            }
                        );


                    // ====================================================
                    // SUCCESS
                    // ====================================================

                    if (response.ok) {

                        closeFeedbackModal();

                        openSuccessModal();

                        return;

                    }


                    // ====================================================
                    // VALIDATION ERROR
                    // ====================================================

                    if (
                        response.status === 422
                    ) {

                        const data =
                            await response.json();

                        let message =
                            "Please check your feedback.";

                        if (
                            data.errors
                        ) {

                            const errors =
                                Object.values(
                                    data.errors
                                )
                                .flat();

                            if (
                                errors.length > 0
                            ) {

                                message =
                                    errors.join(" ");

                            }

                        } else if (
                            data.message
                        ) {

                            message =
                                data.message;

                        }


                        showFormError(
                            message
                        );

                        return;

                    }


                    // ====================================================
                    // OTHER ERROR
                    // ====================================================

                    throw new Error(
                        `Server returned ${response.status}`
                    );

                } catch (error) {

                    console.error(
                        "Feedback submission error:",
                        error
                    );


                    showFormError(
                        "We could not submit your feedback. Please try again."
                    );

                } finally {

                    if (submitFeedback) {

                        submitFeedback.disabled =
                            false;

                        submitFeedback.textContent =
                            "Submit Feedback";

                    }

                }

            }
        );

    }


    // ========================================================
    // CLOSE BUTTON
    // ========================================================

    if (closeFeedbackModalButton) {

        closeFeedbackModalButton.addEventListener(
            "click",
            closeFeedbackModal
        );

    }


    // ========================================================
    // CLICK OVERLAY
    // ========================================================

    if (feedbackOverlay) {

        feedbackOverlay.addEventListener(
            "click",
            closeFeedbackModal
        );

    }


    // ========================================================
    // SUCCESS CLOSE
    // ========================================================

    if (closeFeedbackSuccess) {

        closeFeedbackSuccess.addEventListener(
            "click",
            closeSuccessModal
        );

    }


    if (feedbackSuccessOverlay) {

        feedbackSuccessOverlay.addEventListener(
            "click",
            closeSuccessModal
        );

    }


    // ========================================================
    // ESC KEY
    // ========================================================

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape"
            ) {

                if (
                    feedbackModal &&
                    feedbackModal.classList.contains(
                        "show"
                    )
                ) {

                    closeFeedbackModal();

                }


                if (
                    feedbackSuccessModal &&
                    feedbackSuccessModal.classList.contains(
                        "show"
                    )
                ) {

                    closeSuccessModal();

                }

            }

        }
    );

});
