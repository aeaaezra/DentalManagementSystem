/* ============================================================
   SHINE & SMILE
   DENTIST TREATMENTS
   DATABASE CONNECTED JAVASCRIPT
============================================================ */

document.addEventListener("DOMContentLoaded", () => {

    "use strict";


    /* ========================================================
       CONFIG
    ======================================================== */

    const config =
        window.TREATMENTS_CONFIG || {};

    const csrf =
        config.csrfToken ||
        document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content") ||
        "";


    /* ========================================================
       HELPERS
    ======================================================== */

    const $ = selector =>
        document.querySelector(selector);

    const $$ = selector =>
        [...document.querySelectorAll(selector)];


    /* ========================================================
       ELEMENTS
    ======================================================== */

    const sidebar =
        $("#sidebar");

    const mobileMenuButton =
        $("#mobileMenuButton");

    const sidebarClose =
        $("#sidebarClose");

    const notificationButton =
        $("#notificationButton");

    const addTreatmentButton =
        $("#addTreatmentButton");

    const emptyAddTreatment =
        $("#emptyAddTreatment");

    const treatmentModal =
        $("#treatmentModal");

    const viewTreatmentModal =
        $("#viewTreatmentModal");

    const deleteModal =
        $("#deleteModal");

    const treatmentForm =
        $("#treatmentForm");

    const treatmentId =
        $("#treatmentId");

    const modalTitle =
        $("#modalTitle");

    const formPatient =
        $("#formPatient");

    const formTooth =
        $("#formTooth");

    const formTreatment =
        $("#formTreatment");

    const formDate =
        $("#formDate");

    const formStatus =
        $("#formStatus");

    const formCost =
        $("#formCost");

    const formDescription =
        $("#formDescription");

    const formNotes =
        $("#formNotes");

    const saveTreatmentButton =
        $("#saveTreatmentButton");

    const treatmentSearch =
        $("#treatmentSearch");

    const statusFilter =
        $("#statusFilter");

    const treatmentFilter =
        $("#treatmentFilter");

    const resetFilters =
        $("#resetFilters");

    const recordCount =
        $("#recordCount");

    const totalTreatments =
        $("#totalTreatments");

    const inProgressCount =
        $("#inProgressCount");

    const completedCount =
        $("#completedCount");

    const plannedCount =
        $("#plannedCount");

    const confirmDeleteButton =
        $("#confirmDeleteButton");

    const toastContainer =
        $("#toastContainer");


    let deleteId = null;


    /* ========================================================
       TOAST
    ======================================================== */

    function showToast(
        message,
        type = "success"
    ) {

        if (!toastContainer) {
            alert(message);
            return;
        }

        const toast =
            document.createElement("div");

        toast.className =
            `toast ${type}`;

        toast.textContent =
            message;

        toastContainer.appendChild(
            toast
        );

        setTimeout(() => {

            toast.remove();

        }, 3000);
    }


    /* ========================================================
       API REQUEST
    ======================================================== */

    async function request(
        url,
        options = {}
    ) {

        const response =
            await fetch(
                url,
                {
                    credentials: "same-origin",

                    headers: {
                        "Accept":
                            "application/json",

                        "Content-Type":
                            "application/json",

                        "X-CSRF-TOKEN":
                            csrf,

                        "X-Requested-With":
                            "XMLHttpRequest",

                        ...(options.headers || {})
                    },

                    ...options
                }
            );

        let data = {};

        try {

            data =
                await response.json();

        } catch (error) {

            data = {};

        }

        if (!response.ok) {

            throw new Error(
                data.message ||
                data.error ||
                `Request failed: ${response.status}`
            );
        }

        return data;
    }


    /* ========================================================
       MODAL
    ======================================================== */

    function openModal(modal) {

        if (!modal) {
            return;
        }

        modal.classList.add("show");

        modal.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.style.overflow =
            "hidden";
    }


    function closeModal(modal) {

        if (!modal) {
            return;
        }

        modal.classList.remove("show");

        modal.setAttribute(
            "aria-hidden",
            "true"
        );

        const anyOpenModal =
            document.querySelector(
                ".modal.show"
            );

        if (!anyOpenModal) {

            document.body.style.overflow =
                "";
        }
    }


    $$("[data-close-modal]")
        .forEach(element => {

            element.addEventListener(
                "click",
                () => {

                    closeModal(
                        element.closest(".modal")
                    );
                }
            );

        });


    document.addEventListener(
        "keydown",
        event => {

            if (
                event.key === "Escape"
            ) {

                $$(".modal.show")
                    .forEach(
                        closeModal
                    );
            }

        }
    );


    /* ========================================================
       SIDEBAR
    ======================================================== */

    mobileMenuButton
        ?.addEventListener(
            "click",
            () => {

                sidebar
                    ?.classList
                    .add("open");

                document.body
                    .classList
                    .add("sidebar-open");
            }
        );


    sidebarClose
        ?.addEventListener(
            "click",
            () => {

                sidebar
                    ?.classList
                    .remove("open");

                document.body
                    .classList
                    .remove(
                        "sidebar-open"
                    );
            }
        );


    /* ========================================================
       NOTIFICATION
    ======================================================== */

    notificationButton
        ?.addEventListener(
            "click",
            () => {

                showToast(
                    "No new notifications."
                );
            }
        );


    /* ========================================================
       OPEN ADD TREATMENT
    ======================================================== */

    function openAddTreatment() {

        treatmentForm?.reset();

        treatmentId.value = "";

        modalTitle.textContent =
            "Add Treatment";

        saveTreatmentButton.textContent =
            "Save Treatment";

        if (formDate) {

            const today =
                new Date()
                    .toISOString()
                    .split("T")[0];

            formDate.value =
                today;
        }

        if (formStatus) {

            formStatus.value =
                "planned";
        }

        openModal(
            treatmentModal
        );
    }


    addTreatmentButton
        ?.addEventListener(
            "click",
            openAddTreatment
        );


    emptyAddTreatment
        ?.addEventListener(
            "click",
            openAddTreatment
        );


    /* ========================================================
       FILTER
    ======================================================== */

    function applyFilters() {

        const search =
            (
                treatmentSearch?.value ||
                ""
            )
            .trim()
            .toLowerCase();

        const status =
            statusFilter?.value ||
            "";

        const treatment =
            treatmentFilter?.value ||
            "";

        const rows =
            $$(".treatment-row");

        let visible =
            0;


        rows.forEach(row => {

            const patient =
                row.dataset.patient ||
                "";

            const treatmentName =
                row.dataset.treatment ||
                "";

            const rowStatus =
                row.dataset.status ||
                "";


            const matchesSearch =
                !search ||
                patient.includes(search) ||
                treatmentName.includes(search);


            const matchesStatus =
                !status ||
                rowStatus === status;


            const matchesTreatment =
                !treatment ||
                treatmentName === treatment;


            const show =
                matchesSearch &&
                matchesStatus &&
                matchesTreatment;


            row.style.display =
                show ? "" : "none";


            if (show) {
                visible++;
            }

        });


        if (recordCount) {

            recordCount.textContent =
                `${visible} records`;
        }
    }


    treatmentSearch
        ?.addEventListener(
            "input",
            applyFilters
        );


    statusFilter
        ?.addEventListener(
            "change",
            applyFilters
        );


    treatmentFilter
        ?.addEventListener(
            "change",
            applyFilters
        );


    resetFilters
        ?.addEventListener(
            "click",
            () => {

                treatmentSearch.value =
                    "";

                statusFilter.value =
                    "";

                treatmentFilter.value =
                    "";

                applyFilters();
            }
        );


    /* ========================================================
       SHOW TREATMENT
    ======================================================== */

    async function viewTreatment(
        id
    ) {

        if (!config.showUrl) {

            showToast(
                "Treatment view URL is not configured.",
                "error"
            );

            return;
        }


        try {

            const url =
                config.showUrl.replace(
                    "__ID__",
                    id
                );


            const data =
                await request(
                    url,
                    {
                        method: "GET"
                    }
                );


            const treatment =
                data.treatment ||
                data;


            $("#viewPatient")
                .textContent =
                    treatment.patient_name ||
                    "Unknown Patient";


            $("#viewPatientId")
                .textContent =
                    treatment.patient_record_id
                        ? `P-${String(
                            treatment.patient_record_id
                        ).padStart(5, "0")}`
                        : "—";


            $("#viewAvatar")
                .textContent =
                    (
                        treatment.patient_name ||
                        "P"
                    )
                    .charAt(0)
                    .toUpperCase();


            $("#viewTooth")
                .textContent =
                    treatment.tooth_number ||
                    "—";


            $("#viewTreatment")
                .textContent =
                    treatment.treatment_name ||
                    "—";


            $("#viewDentist")
                .textContent =
                    treatment.dentist_name ||
                    "—";


            $("#viewDate")
                .textContent =
                    treatment.treatment_date ||
                    "—";


            $("#viewStatus")
                .textContent =
                    formatStatus(
                        treatment.status
                    );


            $("#viewCost")
                .textContent =
                    `₱${Number(
                        treatment.cost || 0
                    ).toLocaleString(
                        "en-PH",
                        {
                            minimumFractionDigits: 2
                        }
                    )}`;


            $("#viewDescription")
                .textContent =
                    treatment.description ||
                    "No description.";


            $("#viewNotes")
                .textContent =
                    treatment.notes ||
                    "No additional notes.";


            openModal(
                viewTreatmentModal
            );


        } catch (error) {

            console.error(error);

            showToast(
                error.message,
                "error"
            );
        }
    }


    /* ========================================================
       EDIT TREATMENT
    ======================================================== */

    async function editTreatment(
        id
    ) {

        if (!config.showUrl) {

            showToast(
                "Treatment URL is not configured.",
                "error"
            );

            return;
        }


        try {

            const url =
                config.showUrl.replace(
                    "__ID__",
                    id
                );


            const data =
                await request(
                    url,
                    {
                        method: "GET"
                    }
                );


            const treatment =
                data.treatment ||
                data;


            treatmentId.value =
                treatment.id;


            formPatient.value =
                treatment.patient_record_id ||
                "";


            formTooth.value =
                treatment.tooth_number ||
                "";


            formTreatment.value =
                treatment.treatment_name ||
                "";


            formDate.value =
                treatment.treatment_date ||
                "";


            formStatus.value =
                treatment.status ||
                "planned";


            formCost.value =
                treatment.cost ||
                "";


            formDescription.value =
                treatment.description ||
                "";


            formNotes.value =
                treatment.notes ||
                "";


            modalTitle.textContent =
                "Edit Treatment";


            saveTreatmentButton.textContent =
                "Update Treatment";


            openModal(
                treatmentModal
            );


        } catch (error) {

            console.error(error);

            showToast(
                error.message,
                "error"
            );
        }
    }


    /* ========================================================
       DELETE TREATMENT
    ======================================================== */

    function openDelete(
        id
    ) {

        deleteId =
            id;

        openModal(
            deleteModal
        );
    }


    /* ========================================================
       TABLE ACTIONS
    ======================================================== */

    document.addEventListener(
        "click",
        event => {

            const button =
                event.target.closest(
                    ".table-action"
                );


            if (!button) {
                return;
            }


            const id =
                button.dataset.id;


            const action =
                button.dataset.action;


            if (!id) {
                return;
            }


            if (action === "view") {

                viewTreatment(id);

            }

            else if (
                action === "edit"
            ) {

                editTreatment(id);

            }

            else if (
                action === "delete"
            ) {

                openDelete(id);

            }

        }
    );


    /* ========================================================
       SAVE / UPDATE
    ======================================================== */

    treatmentForm
        ?.addEventListener(
            "submit",
            async event => {

                event.preventDefault();


                if (
                    !formPatient.value
                ) {

                    showToast(
                        "Please select a patient.",
                        "error"
                    );

                    return;
                }


                if (
                    !formTreatment.value.trim()
                ) {

                    showToast(
                        "Please enter a treatment.",
                        "error"
                    );

                    return;
                }


                const id =
                    treatmentId.value;


                const editing =
                    Boolean(id);


                const url =
                    editing
                        ? config.updateUrl.replace(
                            "__ID__",
                            id
                        )
                        : config.storeUrl;


                saveTreatmentButton.disabled =
                    true;


                saveTreatmentButton.textContent =
                    editing
                        ? "Updating..."
                        : "Saving...";


                try {

                    const payload = {

                        patient_record_id:
                            formPatient.value,

                        tooth_number:
                            formTooth.value ||
                            null,

                        treatment_name:
                            formTreatment.value
                                .trim(),

                        treatment_date:
                            formDate.value,

                        status:
                            formStatus.value,

                        cost:
                            formCost.value ||
                            0,

                        description:
                            formDescription.value
                                .trim(),

                        notes:
                            formNotes.value
                                .trim()
                    };


                    const data =
                        await request(
                            url,
                            {
                                method:
                                    editing
                                        ? "PUT"
                                        : "POST",

                                body:
                                    JSON.stringify(
                                        payload
                                    )
                            }
                        );


                    closeModal(
                        treatmentModal
                    );


                    showToast(
                        data.message ||
                        (
                            editing
                                ? "Treatment updated successfully."
                                : "Treatment added successfully."
                        )
                    );


                    setTimeout(
                        () => {

                            window.location.reload();

                        },
                        700
                    );


                } catch (error) {

                    console.error(error);

                    showToast(
                        error.message,
                        "error"
                    );


                } finally {

                    saveTreatmentButton.disabled =
                        false;

                    saveTreatmentButton.textContent =
                        editing
                            ? "Update Treatment"
                            : "Save Treatment";
                }

            }
        );


    /* ========================================================
       CONFIRM DELETE
    ======================================================== */

    confirmDeleteButton
        ?.addEventListener(
            "click",
            async () => {

                if (!deleteId) {
                    return;
                }


                if (!config.deleteUrl) {

                    showToast(
                        "Delete URL is not configured.",
                        "error"
                    );

                    return;
                }


                confirmDeleteButton.disabled =
                    true;


                confirmDeleteButton.textContent =
                    "Deleting...";


                try {

                    const url =
                        config.deleteUrl.replace(
                            "__ID__",
                            deleteId
                        );


                    const data =
                        await request(
                            url,
                            {
                                method: "DELETE"
                            }
                        );


                    closeModal(
                        deleteModal
                    );


                    showToast(
                        data.message ||
                        "Treatment deleted successfully."
                    );


                    setTimeout(
                        () => {

                            window.location.reload();

                        },
                        700
                    );


                } catch (error) {

                    console.error(error);

                    showToast(
                        error.message,
                        "error"
                    );


                } finally {

                    confirmDeleteButton.disabled =
                        false;

                    confirmDeleteButton.textContent =
                        "Delete Treatment";

                    deleteId =
                        null;
                }

            }
        );


    /* ========================================================
       FORMAT STATUS
    ======================================================== */

    function formatStatus(
        status
    ) {

        if (!status) {
            return "—";
        }

        return status
            .replaceAll(
                "_",
                " "
            )
            .replace(
                /\b\w/g,
                letter =>
                    letter.toUpperCase()
            );
    }


    /* ========================================================
       INITIALIZE
    ======================================================== */

    applyFilters();


    console.log(
        "Dentist Treatments initialized."
    );

});


// =========================================================
// LOGOUT CONFIRMATION MODAL
// =========================================================

function initializeLogoutModal() {
    const logoutButton = document.getElementById("logoutButton");
    const logoutModal = document.getElementById("logoutModal");
    const cancelLogout = document.getElementById("cancelLogout");
    const confirmLogout = document.getElementById("confirmLogout");
    const logoutOverlay = document.querySelector(".logout-modal-overlay");

    if (!logoutButton || !logoutModal) {
        return;
    }

    const logoutForm = logoutButton.closest("form");

    function openLogoutModal() {
        logoutModal.classList.remove("hidden");
    }

    function closeLogoutModal() {
        logoutModal.classList.add("hidden");
    }

    logoutButton.addEventListener("click", function () {
        openLogoutModal();
    });

    if (cancelLogout) {
        cancelLogout.addEventListener("click", function () {
            closeLogoutModal();
        });
    }

    if (logoutOverlay) {
        logoutOverlay.addEventListener("click", function () {
            closeLogoutModal();
        });
    }

    if (confirmLogout) {
        confirmLogout.addEventListener("click", function () {
            if (logoutForm) {
                logoutForm.submit();
            }
        });
    }

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeLogoutModal();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initializeLogoutModal();
});
