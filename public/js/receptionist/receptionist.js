document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById("searchInput");
    const statusFilter = document.getElementById("statusFilter");
    const rows = document.querySelectorAll(".appointment-row");
    const countElement = document.querySelector(".appointment-count");

    function filterAppointments() {

        const search = searchInput
            ? searchInput.value.toLowerCase().trim()
            : "";

        const selectedStatus = statusFilter
            ? statusFilter.value.toLowerCase().trim()
            : "all";

        let visibleCount = 0;

        rows.forEach(function (row) {

            const patientName = (row.dataset.name || "")
                .toLowerCase()
                .trim();

            const appointmentStatus = (row.dataset.status || "")
                .toLowerCase()
                .trim();

            const matchesSearch =
                patientName.includes(search);

            const matchesStatus =
                selectedStatus === "all" ||
                appointmentStatus === selectedStatus;

            if (matchesSearch && matchesStatus) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }

        });

        if (countElement) {

            countElement.textContent =
                visibleCount +
                (
                    visibleCount === 1
                        ? " Appointment"
                        : " Appointments"
                );

        }

    }

    if (searchInput) {

        searchInput.addEventListener(
            "input",
            filterAppointments
        );

    }

    if (statusFilter) {

        statusFilter.addEventListener(
            "change",
            filterAppointments
        );

    }

    filterAppointments();


    const logoutButton =
        document.getElementById("logoutButton");

    const logoutModal =
        document.getElementById("logoutModal");

    const logoutModalOverlay =
        document.getElementById("logoutModalOverlay");

    const cancelLogout =
        document.getElementById("cancelLogout");

    const confirmLogout =
        document.getElementById("confirmLogout");

    const logoutForm =
        document.getElementById("logoutForm");


    function openLogoutModal() {

        if (!logoutModal) return;

        logoutModal.classList.add("show");

        logoutModal.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.classList.add(
            "logout-modal-open"
        );

    }


    function closeLogoutModal() {

        if (!logoutModal) return;

        logoutModal.classList.remove("show");

        logoutModal.setAttribute(
            "aria-hidden",
            "true"
        );

        document.body.classList.remove(
            "logout-modal-open"
        );

    }


    if (logoutButton) {

        logoutButton.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                openLogoutModal();

            }
        );

    }


    if (cancelLogout) {

        cancelLogout.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                closeLogoutModal();

            }
        );

    }


    if (logoutModalOverlay) {

        logoutModalOverlay.addEventListener(
            "click",
            function (event) {

                if (event.target === logoutModalOverlay) {
                    closeLogoutModal();
                }

            }
        );

    }


    if (confirmLogout && logoutForm) {

        confirmLogout.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                confirmLogout.disabled = true;

                logoutForm.submit();

            }
        );

    }


    let selectedForm = null;


    const actionModal =
        document.getElementById(
            "appointmentActionModal"
        );

    const successModal =
        document.getElementById(
            "appointmentSuccessModal"
        );

    const errorModal =
        document.getElementById(
            "appointmentErrorModal"
        );


    const actionModalTitle =
        document.getElementById(
            "appointmentActionModalTitle"
        );

    const actionModalMessage =
        document.getElementById(
            "appointmentActionModalMessage"
        );

    const confirmActionButton =
        document.getElementById(
            "confirmAppointmentAction"
        );

    const cancelActionButton =
        document.getElementById(
            "cancelAppointmentAction"
        );


    const successMessage =
        document.getElementById(
            "appointmentSuccessMessage"
        );

    const errorMessage =
        document.getElementById(
            "appointmentErrorMessage"
        );


    const actionOverlay =
        document.getElementById(
            "appointmentActionModalOverlay"
        );

    const successOverlay =
        document.getElementById(
            "appointmentSuccessModalOverlay"
        );

    const errorOverlay =
        document.getElementById(
            "appointmentErrorModalOverlay"
        );


    const closeSuccessButton =
        document.getElementById(
            "closeAppointmentSuccess"
        );

    const closeErrorButton =
        document.getElementById(
            "closeAppointmentError"
        );


    function openModal(modal) {

        if (!modal) return;

        modal.classList.add("show");

        modal.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.style.overflow = "hidden";

    }


    function closeModal(modal) {

        if (!modal) return;

        modal.classList.remove("show");

        modal.setAttribute(
            "aria-hidden",
            "true"
        );

        const openModals =
            document.querySelectorAll(".show");

        if (openModals.length === 0) {
            document.body.style.overflow = "";
        }

    }


    document.addEventListener(
        "click",
        function (event) {

            const button =
                event.target.closest(
                    ".appointment-action-button"
                );

            if (!button) return;

            event.preventDefault();

            event.stopPropagation();

            selectedForm =
                button.closest("form");

            if (!selectedForm) {

                console.error(
                    "Appointment form was not found."
                );

                return;

            }


            if (
                !actionModal ||
                !actionModalTitle ||
                !actionModalMessage ||
                !confirmActionButton
            ) {

                console.error(
                    "Appointment modal elements are missing."
                );

                return;

            }


            actionModalTitle.textContent =
                button.dataset.confirmTitle ||
                "Are you sure?";


            actionModalMessage.textContent =
                button.dataset.confirmMessage ||
                "Please confirm this action.";


            confirmActionButton.textContent =
                button.dataset.actionLabel ||
                "Confirm";


            confirmActionButton.disabled = false;


            openModal(actionModal);

        },
        true
    );


    if (confirmActionButton) {

        confirmActionButton.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                if (!selectedForm) return;


                confirmActionButton.disabled = true;

                confirmActionButton.textContent =
                    "Processing...";


                selectedForm.submit();

            }
        );

    }


    if (cancelActionButton) {

        cancelActionButton.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                selectedForm = null;

                closeModal(actionModal);

            }
        );

    }


    if (actionOverlay) {

        actionOverlay.addEventListener(
            "click",
            function (event) {

                if (
                    event.target === actionOverlay
                ) {

                    selectedForm = null;

                    closeModal(actionModal);

                }

            }
        );

    }


    if (closeSuccessButton) {

        closeSuccessButton.addEventListener(
            "click",
            function () {

                closeModal(successModal);

            }
        );

    }


    if (successOverlay) {

        successOverlay.addEventListener(
            "click",
            function (event) {

                if (
                    event.target === successOverlay
                ) {

                    closeModal(successModal);

                }

            }
        );

    }


    if (closeErrorButton) {

        closeErrorButton.addEventListener(
            "click",
            function () {

                closeModal(errorModal);

            }
        );

    }


    if (errorOverlay) {

        errorOverlay.addEventListener(
            "click",
            function (event) {

                if (
                    event.target === errorOverlay
                ) {

                    closeModal(errorModal);

                }

            }
        );

    }


    if (
        window.appointmentActionSuccess &&
        window.appointmentActionSuccess.message
    ) {

        if (successMessage) {

            successMessage.textContent =
                window.appointmentActionSuccess.message;

        }

        openModal(successModal);

    }


    if (
        window.appointmentActionError &&
        window.appointmentActionError.message
    ) {

        if (errorMessage) {

            errorMessage.textContent =
                window.appointmentActionError.message;

        }

        openModal(errorModal);

    }


    document.addEventListener(
        "keydown",
        function (event) {

            if (event.key !== "Escape") return;


            selectedForm = null;


            closeLogoutModal();

            closeModal(actionModal);

            closeModal(successModal);

            closeModal(errorModal);

        }
    );

});


document.addEventListener("DOMContentLoaded", function () {

    const logoutButton =
        document.getElementById("openLogoutModal");

    const logoutModal =
        document.getElementById("logoutModal");

    const logoutForm =
        document.getElementById("logoutForm");

    const confirmLogout =
        document.getElementById("confirmLogout");

    const cancelLogout =
        document.getElementById("cancelLogout");

    const logoutModalOverlay =
        document.getElementById("logoutModalOverlay");


    function openLogoutModal() {

        if (!logoutModal) {
            return;
        }

        logoutModal.classList.add("active");

        logoutModal.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.classList.add(
            "logout-modal-open"
        );

    }


    function closeLogoutModal() {

        if (!logoutModal) {
            return;
        }

        logoutModal.classList.remove("active");

        logoutModal.setAttribute(
            "aria-hidden",
            "true"
        );

        document.body.classList.remove(
            "logout-modal-open"
        );

    }


    if (logoutButton) {

        logoutButton.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                openLogoutModal();

            }
        );

    }


    if (cancelLogout) {

        cancelLogout.addEventListener(
            "click",
            function () {

                closeLogoutModal();

            }
        );

    }


    if (confirmLogout) {

        confirmLogout.addEventListener(
            "click",
            function () {

                if (!logoutForm) {
                    return;
                }

                confirmLogout.disabled = true;

                confirmLogout.textContent =
                    "Logging out...";

                logoutForm.submit();

            }
        );

    }


    if (logoutModalOverlay) {

        logoutModalOverlay.addEventListener(
            "click",
            function () {

                closeLogoutModal();

            }
        );

    }


    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                logoutModal &&
                logoutModal.classList.contains("active")
            ) {

                closeLogoutModal();

            }

        }
    );

});

