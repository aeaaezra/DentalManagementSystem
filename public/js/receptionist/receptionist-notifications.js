document.addEventListener("DOMContentLoaded", function () {

    let selectedForm = null;

    const markAllModal =
        document.getElementById("markAllModal");

    const markReadModal =
        document.getElementById("markReadModal");

    const deleteModal =
        document.getElementById("deleteModal");


    function openModal(modal) {

        if (!modal) {
            console.error("Modal not found.");
            return;
        }

        modal.classList.add("active");

        document.body.style.overflow = "hidden";

    }


    function closeModal(modal) {

        if (!modal) {
            return;
        }

        modal.classList.remove("active");

        document.body.style.overflow = "";

        selectedForm = null;

    }


    /*
    |--------------------------------------------------------------------------
    | MARK ALL AS READ
    |--------------------------------------------------------------------------
    */

    const markAllButton =
        document.getElementById("openMarkAllModal");


    if (markAllButton) {

        markAllButton.addEventListener(
            "click",
            function () {

                selectedForm =
                    this.closest("form");

                if (!selectedForm) {

                    console.error(
                        "Mark all as read form not found."
                    );

                    return;

                }

                openModal(markAllModal);

            }
        );

    }


    const confirmMarkAll =
        document.getElementById("confirmMarkAll");


    if (confirmMarkAll) {

        confirmMarkAll.addEventListener(
            "click",
            function () {

                if (!selectedForm) {

                    console.error(
                        "No form selected for mark all."
                    );

                    return;

                }

                selectedForm.submit();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | MARK AS READ
    |--------------------------------------------------------------------------
    */

    const markReadButtons =
        document.querySelectorAll(
            ".open-mark-read-modal"
        );


    markReadButtons.forEach(
        function (button) {

            button.addEventListener(
                "click",
                function () {

                    selectedForm =
                        this.closest("form");

                    if (!selectedForm) {

                        console.error(
                            "Mark as read form not found."
                        );

                        return;

                    }

                    openModal(markReadModal);

                }
            );

        }
    );


    const confirmMarkRead =
        document.getElementById("confirmMarkRead");


    if (confirmMarkRead) {

        confirmMarkRead.addEventListener(
            "click",
            function () {

                if (!selectedForm) {

                    console.error(
                        "No notification selected."
                    );

                    return;

                }

                selectedForm.submit();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE NOTIFICATION
    |--------------------------------------------------------------------------
    */

    const deleteButtons =
        document.querySelectorAll(
            ".open-delete-modal"
        );


    deleteButtons.forEach(
        function (button) {

            button.addEventListener(
                "click",
                function () {

                    selectedForm =
                        this.closest("form");

                    if (!selectedForm) {

                        console.error(
                            "Delete form not found."
                        );

                        return;

                    }

                    openModal(deleteModal);

                }
            );

        }
    );


    const confirmDelete =
        document.getElementById("confirmDelete");


    if (confirmDelete) {

        confirmDelete.addEventListener(
            "click",
            function () {

                if (!selectedForm) {

                    console.error(
                        "No notification selected for deletion."
                    );

                    return;

                }

                selectedForm.submit();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE BUTTONS
    |--------------------------------------------------------------------------
    */

    const closeButtons =
        document.querySelectorAll(
            "[data-close]"
        );


    closeButtons.forEach(
        function (button) {

            button.addEventListener(
                "click",
                function () {

                    const modalId =
                        this.getAttribute(
                            "data-close"
                        );

                    const modal =
                        document.getElementById(
                            modalId
                        );

                    closeModal(modal);

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CLOSE WHEN CLICKING OUTSIDE
    |--------------------------------------------------------------------------
    */

    const modalOverlays =
        document.querySelectorAll(
            ".notification-modal-overlay"
        );


    modalOverlays.forEach(
        function (modal) {

            modal.addEventListener(
                "click",
                function (event) {

                    if (
                        event.target === modal
                    ) {

                        closeModal(modal);

                    }

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CLOSE WITH ESCAPE KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape"
            ) {

                document
                    .querySelectorAll(
                        ".notification-modal-overlay.active"
                    )
                    .forEach(
                        function (modal) {

                            closeModal(modal);

                        }
                    );

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | AUTO HIDE ALERTS
    |--------------------------------------------------------------------------
    */

    const alerts =
        document.querySelectorAll(
            ".alert-message"
        );


    alerts.forEach(
        function (alert) {

            setTimeout(
                function () {

                    alert.classList.add(
                        "hide"
                    );

                },
                4500
            );

        }
    );

});

/*
=========================================
SUCCESS MODAL
=========================================
*/

const successModal =
    document.getElementById("successModal");

const closeSuccessModal =
    document.getElementById("closeSuccessModal");


if (successModal) {

    document.body.style.overflow = "hidden";

}


if (closeSuccessModal) {

    closeSuccessModal.addEventListener(
        "click",
        function () {

            successModal.classList.remove("active");

            document.body.style.overflow = "";

        }
    );

}


if (successModal) {

    successModal.addEventListener(
        "click",
        function (event) {

            if (event.target === successModal) {

                successModal.classList.remove("active");

                document.body.style.overflow = "";

            }

        }
    );

}

document.addEventListener(
    "keydown",
    function (event) {

        if (event.key === "Escape") {

            document
                .querySelectorAll(
                    ".notification-modal-overlay.active"
                )
                .forEach(
                    function (modal) {

                        modal.classList.remove("active");

                    }
                );

            document.body.style.overflow = "";

        }

    }
);
