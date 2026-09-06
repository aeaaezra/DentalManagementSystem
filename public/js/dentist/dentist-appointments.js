/* ============================================================
   DENTIST APPOINTMENTS JAVASCRIPT
   Shine & Smile Dental Clinic
============================================================ */

document.addEventListener("DOMContentLoaded", () => {

    /* ========================================================
       CONFIG
    ======================================================== */

    const config =
        window.DentistAppointments || {};

    const csrfToken =
        config.csrfToken ||
        document
            .querySelector(
                'meta[name="csrf-token"]'
            )
            ?.getAttribute("content");


    /* ========================================================
       ELEMENTS
    ======================================================== */

    const sidebar =
        document.getElementById("sidebar");

    const mobileMenuButton =
        document.getElementById(
            "mobileMenuButton"
        );

    const sidebarClose =
        document.getElementById(
            "sidebarClose"
        );

    const searchInput =
        document.getElementById(
            "appointmentSearch"
        );

    const statusFilter =
        document.getElementById(
            "statusFilter"
        );

    const serviceFilter =
        document.getElementById(
            "serviceFilter"
        );

    const resetFilters =
        document.getElementById(
            "resetFilters"
        );

    const appointmentDate =
        document.getElementById(
            "appointmentDate"
        );

    const selectedDateLabel =
        document.getElementById(
            "selectedDateLabel"
        );

    const previousDay =
        document.getElementById(
            "previousDay"
        );

    const nextDay =
        document.getElementById(
            "nextDay"
        );

    const todayButton =
        document.getElementById(
            "todayButton"
        );

    const refreshAppointments =
        document.getElementById(
            "refreshAppointments"
        );

    const newAppointmentButton =
        document.getElementById(
            "newAppointmentButton"
        );

    const emptyNewAppointmentButton =
        document.getElementById(
            "emptyNewAppointmentButton"
        );

    const appointmentList =
        document.getElementById(
            "appointmentsList"
        );

    const appointmentListCount =
        document.getElementById(
            "appointmentListCount"
        );


    /* ========================================================
       MODALS
    ======================================================== */

    const detailsModal =
        document.getElementById(
            "appointmentDetailsModal"
        );

    const newAppointmentModal =
        document.getElementById(
            "newAppointmentModal"
        );

    const confirmationModal =
        document.getElementById(
            "confirmationModal"
        );

    const loadingOverlay =
        document.getElementById(
            "loadingOverlay"
        );


    /* ========================================================
       SIDEBAR
    ======================================================== */

    let sidebarOverlay =
        document.querySelector(
            ".sidebar-overlay"
        );

    if (!sidebarOverlay) {

        sidebarOverlay =
            document.createElement(
                "div"
            );

        sidebarOverlay.className =
            "sidebar-overlay";

        document.body.appendChild(
            sidebarOverlay
        );

    }


    function openSidebar() {

        if (!sidebar) {
            return;
        }

        sidebar.classList.add(
            "open"
        );

        sidebarOverlay.classList.add(
            "show"
        );

        document.body.style.overflow =
            "hidden";

    }


    function closeSidebar() {

        if (!sidebar) {
            return;
        }

        sidebar.classList.remove(
            "open"
        );

        sidebarOverlay.classList.remove(
            "show"
        );

        document.body.style.overflow =
            "";

    }


    mobileMenuButton?.addEventListener(
        "click",
        openSidebar
    );


    sidebarClose?.addEventListener(
        "click",
        closeSidebar
    );


    sidebarOverlay?.addEventListener(
        "click",
        closeSidebar
    );


    /* ========================================================
       MODAL HELPERS
    ======================================================== */

    function openModal(modal) {

        if (!modal) {
            console.error(
                "Modal element not found."
            );

            return;
        }


        /*
         * Remove the hidden attribute.
         */
        modal.removeAttribute(
            "hidden"
        );


        /*
         * Add show class.
         * This makes the modal work even when
         * CSS uses .show for visibility.
         */
        modal.classList.add(
            "show"
        );


        /*
         * Prevent background scrolling.
         */
        document.body.style.overflow =
            "hidden";

    }


    function closeModal(modal) {

        if (!modal) {
            return;
        }


        modal.classList.remove(
            "show"
        );


        modal.setAttribute(
            "hidden",
            ""
        );


        /*
         * Only restore scrolling if
         * all modals are closed.
         */
        if (
            detailsModal?.hasAttribute(
                "hidden"
            ) &&
            newAppointmentModal?.hasAttribute(
                "hidden"
            ) &&
            confirmationModal?.hasAttribute(
                "hidden"
            )
        ) {

            document.body.style.overflow =
                "";

        }

    }


    function closeAllModals() {

        [
            detailsModal,
            newAppointmentModal,
            confirmationModal
        ].forEach(
            modal => {

                if (!modal) {
                    return;
                }


                modal.classList.remove(
                    "show"
                );


                modal.setAttribute(
                    "hidden",
                    ""
                );

            }
        );


        document.body.style.overflow =
            "";

    }


    /*
     * Close buttons and overlays.
     */
    document
        .querySelectorAll(
            "[data-close-modal]"
        )
        .forEach(
            element => {

                element.addEventListener(
                    "click",
                    event => {

                        event.preventDefault();

                        closeAllModals();

                    }
                );

            }
        );


    /* ========================================================
       VIEW APPOINTMENT
    ======================================================== */

    const viewButtons =
        document.querySelectorAll(
            ".view-appointment"
        );


    let currentAppointmentId =
        null;

    let currentPatientId =
        null;


    viewButtons.forEach(
        button => {

            button.addEventListener(
                "click",
                () => {

                    currentAppointmentId =
                        button.dataset
                            .appointmentId;

                    currentPatientId =
                        button.dataset
                            .patientId;


                    const patientName =
                        button.dataset
                            .patientName ||
                        "Patient";


                    const patientId =
                        button.dataset
                            .patientId ||
                        "—";


                    const date =
                        button.dataset
                            .date ||
                        "—";


                    const time =
                        button.dataset
                            .time ||
                        "—";


                    const service =
                        button.dataset
                            .service ||
                        "Dental Service";


                    const status =
                        button.dataset
                            .status ||
                        "pending";


                    const reason =
                        button.dataset
                            .reason ||
                        "No reason provided.";


                    setText(
                        "modalPatientName",
                        patientName
                    );


                    setText(
                        "modalPatientId",
                        "Patient ID: P-" +
                        String(
                            patientId
                        ).padStart(
                            5,
                            "0"
                        )
                    );


                    setText(
                        "modalAppointmentDate",
                        date
                    );


                    setText(
                        "modalAppointmentTime",
                        time
                    );


                    setText(
                        "modalAppointmentService",
                        service
                    );


                    setText(
                        "modalAppointmentReason",
                        reason
                    );


                    const avatar =
                        document.getElementById(
                            "modalPatientAvatar"
                        );


                    if (avatar) {

                        avatar.textContent =
                            patientName
                                .trim()
                                .charAt(0)
                                .toUpperCase() ||
                            "P";

                    }


                    const statusElement =
                        document.getElementById(
                            "modalAppointmentStatus"
                        );


                    if (statusElement) {

                        statusElement.className =
                            "modal-status status-" +
                            status;

                        statusElement.textContent =
                            getStatusLabel(
                                status
                            );

                    }


                    updateModalActions(
                        status
                    );


                    openModal(
                        detailsModal
                    );

                }
            );

        }
    );


    function updateModalActions(
        status
    ) {

        const confirmButton =
            document.getElementById(
                "modalConfirmButton"
            );

        const declineButton =
            document.getElementById(
                "modalDeclineButton"
            );


        if (
            !confirmButton ||
            !declineButton
        ) {
            return;
        }


        confirmButton.style.display =
            status === "pending"
                ? "inline-flex"
                : "none";


        declineButton.style.display =
            status === "pending"
                ? "inline-flex"
                : "none";

    }


    function getStatusLabel(
        status
    ) {

        const labels = {

            pending:
                "Pending",

            approved:
                "Confirmed",

            completed:
                "Completed",

            declined:
                "Declined",

            cancelled:
                "Cancelled"

        };


        return (
            labels[status] ||
            capitalize(status)
        );

    }


    /* ========================================================
       CONFIRMATION MODAL
    ======================================================== */

    const confirmationTitle =
        document.getElementById(
            "confirmationTitle"
        );

    const confirmationMessage =
        document.getElementById(
            "confirmationMessage"
        );

    const confirmActionButton =
        document.getElementById(
            "confirmActionButton"
        );


    let pendingAction =
        null;


    function askConfirmation(
        action,
        appointmentId,
        patientName
    ) {

        pendingAction = {

            action,
            appointmentId,
            patientName

        };


        if (action === "confirm") {

            if (confirmationTitle) {

                confirmationTitle.textContent =
                    "Confirm Appointment?";

            }


            if (confirmationMessage) {

                confirmationMessage.textContent =
                    `Confirm the appointment for ${patientName}?`;

            }


            if (confirmActionButton) {

                confirmActionButton.textContent =
                    "Confirm";

            }

        }


        if (action === "decline") {

            if (confirmationTitle) {

                confirmationTitle.textContent =
                    "Decline Appointment?";

            }


            if (confirmationMessage) {

                confirmationMessage.textContent =
                    `Are you sure you want to decline the appointment for ${patientName}?`;

            }


            if (confirmActionButton) {

                confirmActionButton.textContent =
                    "Decline";

            }

        }


        if (action === "complete") {

            if (confirmationTitle) {

                confirmationTitle.textContent =
                    "Complete Appointment?";

            }


            if (confirmationMessage) {

                confirmationMessage.textContent =
                    `Mark the appointment for ${patientName} as completed?`;

            }


            if (confirmActionButton) {

                confirmActionButton.textContent =
                    "Complete";

            }

        }


        openModal(
            confirmationModal
        );

    }


    document
        .querySelectorAll(
            ".confirm-button"
        )
        .forEach(
            button => {

                button.addEventListener(
                    "click",
                    () => {

                        askConfirmation(
                            "confirm",
                            button.dataset
                                .appointmentId,
                            button.dataset
                                .patient ||
                            "this patient"
                        );

                    }
                );

            }
        );


    document
        .querySelectorAll(
            ".decline-button"
        )
        .forEach(
            button => {

                button.addEventListener(
                    "click",
                    () => {

                        askConfirmation(
                            "decline",
                            button.dataset
                                .appointmentId,
                            button.dataset
                                .patient ||
                            "this patient"
                        );

                    }
                );

            }
        );


    document
        .querySelectorAll(
            ".complete-button"
        )
        .forEach(
            button => {

                button.addEventListener(
                    "click",
                    () => {

                        askConfirmation(
                            "complete",
                            button.dataset
                                .appointmentId,
                            button.dataset
                                .patient ||
                            "this patient"
                        );

                    }
                );

            }
        );


    confirmActionButton?.addEventListener(
        "click",
        async () => {

            if (!pendingAction) {
                return;
            }


            const {
                action,
                appointmentId
            } = pendingAction;


            await performAppointmentAction(
                action,
                appointmentId
            );

        }
    );


    /* ========================================================
       APPOINTMENT ACTION
    ======================================================== */

    async function performAppointmentAction(
        action,
        appointmentId
    ) {

        if (!appointmentId) {

            showToast(
                "Appointment ID is missing.",
                "error"
            );

            return;

        }


        showLoading();


        try {

            const route =
                getActionRoute(
                    action,
                    appointmentId
                );


            if (!route) {

                throw new Error(
                    "Appointment action route is missing."
                );

            }


            const response =
                await fetch(
                    route,
                    {

                        method: "POST",

                        headers: {

                            "Content-Type":
                                "application/json",

                            "Accept":
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


            if (response.ok) {

                closeAllModals();


                showToast(
                    getSuccessMessage(
                        action
                    ),
                    "success"
                );


                setTimeout(
                    () => {

                        window.location.reload();

                    },
                    700
                );


                return;

            }


            let message =
                "Unable to update appointment.";


            try {

                const data =
                    await response.json();


                if (data.message) {

                    message =
                        data.message;

                }

            } catch (error) {

                console.warn(
                    "Response was not JSON.",
                    error
                );

            }


            throw new Error(
                message
            );


        } catch (error) {

            console.error(
                "Appointment action error:",
                error
            );


            showToast(
                error.message ||
                "Something went wrong.",
                "error"
            );


        } finally {

            hideLoading();

        }

    }


    function getActionRoute(
        action,
        appointmentId
    ) {

        const base =
            config.appointments ||
            "/dentist/appointments";


        const routes = {

            confirm:
                `${base}/${appointmentId}/confirm`,

            decline:
                `${base}/${appointmentId}/decline`,

            complete:
                `${base}/${appointmentId}/complete`

        };


        return routes[action];

    }


    function getSuccessMessage(
        action
    ) {

        const messages = {

            confirm:
                "Appointment confirmed successfully.",

            decline:
                "Appointment declined successfully.",

            complete:
                "Appointment marked as completed."

        };


        return (
            messages[action] ||
            "Appointment updated."
        );

    }


    /* ========================================================
       PATIENT RECORD BUTTONS
    ======================================================== */

    document
        .querySelectorAll(
            ".patient-record-button"
        )
        .forEach(
            button => {

                button.addEventListener(
                    "click",
                    () => {

                        const patientId =
                            button.dataset
                                .patientId;


                        if (!patientId) {

                            showToast(
                                "Patient record ID is missing.",
                                "error"
                            );

                            return;

                        }


                        const base =
                            config.patientRecords ||
                            "/dentist/patient-records";


                        window.location.href =
                            `${base}/${patientId}`;

                    }
                );

            }
        );


    const modalPatientRecordButton =
        document.getElementById(
            "modalPatientRecordButton"
        );


    modalPatientRecordButton?.addEventListener(
        "click",
        () => {

            if (!currentPatientId) {

                showToast(
                    "Patient record ID is missing.",
                    "error"
                );

                return;

            }


            const base =
                config.patientRecords ||
                "/dentist/patient-records";


            window.location.href =
                `${base}/${currentPatientId}`;

        }
    );


    /* ========================================================
       MODAL DIRECT ACTIONS
    ======================================================== */

    document
        .getElementById(
            "modalConfirmButton"
        )
        ?.addEventListener(
            "click",
            () => {

                askConfirmation(
                    "confirm",
                    currentAppointmentId,
                    document.getElementById(
                        "modalPatientName"
                    )?.textContent ||
                    "this patient"
                );

            }
        );


    document
        .getElementById(
            "modalDeclineButton"
        )
        ?.addEventListener(
            "click",
            () => {

                askConfirmation(
                    "decline",
                    currentAppointmentId,
                    document.getElementById(
                        "modalPatientName"
                    )?.textContent ||
                    "this patient"
                );

            }
        );


    /* ========================================================
       NEW APPOINTMENT
    ======================================================== */

    function openNewAppointment() {

        console.log(
            "New Appointment button clicked."
        );


        if (!newAppointmentModal) {

            console.error(
                "ERROR: #newAppointmentModal was not found."
            );

            return;

        }


        /*
         * Open the modal.
         */
        newAppointmentModal.removeAttribute(
            "hidden"
        );


        newAppointmentModal.classList.add(
            "show"
        );


        /*
         * Lock background scrolling.
         */
        document.body.style.overflow =
            "hidden";


        /*
         * Automatically use today's date.
         */
        const dateInput =
            document.getElementById(
                "newAppointmentDate"
            );


        if (
            dateInput &&
            !dateInput.value
        ) {

            dateInput.value =
                getLocalDate();

        }


        console.log(
            "New Appointment modal opened."
        );

    }


    function closeNewAppointment() {

        if (!newAppointmentModal) {
            return;
        }


        newAppointmentModal.classList.remove(
            "show"
        );


        newAppointmentModal.setAttribute(
            "hidden",
            ""
        );


        /*
         * Restore scrolling.
         */
        document.body.style.overflow =
            "";

    }


    /*
     * MAIN NEW APPOINTMENT BUTTON
     */
    if (newAppointmentButton) {

        newAppointmentButton.addEventListener(
            "click",
            event => {

                event.preventDefault();

                event.stopPropagation();

                openNewAppointment();

            }
        );

    } else {

        console.error(
            "ERROR: #newAppointmentButton was not found."
        );

    }


    /*
     * EMPTY STATE NEW APPOINTMENT BUTTON
     */
    if (emptyNewAppointmentButton) {

        emptyNewAppointmentButton.addEventListener(
            "click",
            event => {

                event.preventDefault();

                event.stopPropagation();

                openNewAppointment();

            }
        );

    }


    /*
     * NEW APPOINTMENT CLOSE BUTTONS
     */
    if (newAppointmentModal) {

        newAppointmentModal
            .querySelectorAll(
                "[data-close-modal]"
            )
            .forEach(
                element => {

                    element.addEventListener(
                        "click",
                        event => {

                            event.preventDefault();

                            closeNewAppointment();

                        }
                    );

                }
            );

    }


    /* ========================================================
       SEARCH
    ======================================================== */

    function applyFilters() {

        const search =
            (
                searchInput?.value ||
                ""
            )
                .trim()
                .toLowerCase();


        const status =
            statusFilter?.value ||
            "";


        const service =
            serviceFilter?.value ||
            "";


        const items =
            document.querySelectorAll(
                ".appointment-item"
            );


        let visibleCount =
            0;


        items.forEach(
            item => {

                const itemSearch =
                    item.dataset.search ||
                    "";


                const itemStatus =
                    item.dataset.status ||
                    "";


                const itemService =
                    item.dataset.serviceId ||
                    "";


                const matchesSearch =
                    !search ||
                    itemSearch.includes(
                        search
                    );


                const matchesStatus =
                    !status ||
                    itemStatus ===
                        status;


                const matchesService =
                    !service ||
                    itemService ===
                        service;


                const visible =
                    matchesSearch &&
                    matchesStatus &&
                    matchesService;


                item.classList.toggle(
                    "hidden",
                    !visible
                );


                if (visible) {

                    visibleCount++;

                }

            }
        );


        if (appointmentListCount) {

            appointmentListCount.textContent =
                `${visibleCount} appointment${visibleCount === 1 ? "" : "s"}`;

        }


        updateEmptyFilterState(
            visibleCount,
            items.length
        );

    }


    searchInput?.addEventListener(
        "input",
        applyFilters
    );


    statusFilter?.addEventListener(
        "change",
        applyFilters
    );


    serviceFilter?.addEventListener(
        "change",
        applyFilters
    );


    function updateEmptyFilterState(
        visibleCount,
        totalCount
    ) {

        let empty =
            document.getElementById(
                "filterEmptyState"
            );


        if (
            visibleCount > 0 ||
            totalCount === 0
        ) {

            empty?.remove();

            return;

        }


        if (!appointmentList) {
            return;
        }


        if (!empty) {

            empty =
                document.createElement(
                    "div"
                );


            empty.id =
                "filterEmptyState";


            empty.className =
                "empty-appointments";


            empty.innerHTML = `

                <div class="empty-appointments-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                    >

                        <circle
                            cx="11"
                            cy="11"
                            r="7"
                            stroke="currentColor"
                            stroke-width="1.8"
                        />

                        <path
                            d="M16 16L21 21"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                    </svg>

                </div>


                <h3>
                    No matching appointments
                </h3>


                <p>
                    Try changing your search or filters.
                </p>

            `;


            appointmentList.appendChild(
                empty
            );

        }

    }


    /* ========================================================
       RESET FILTERS
    ======================================================== */

    resetFilters?.addEventListener(
        "click",
        () => {

            if (searchInput) {

                searchInput.value =
                    "";

            }


            if (statusFilter) {

                statusFilter.value =
                    "";

            }


            if (serviceFilter) {

                serviceFilter.value =
                    "";

            }


            applyFilters();

        }
    );


    /* ========================================================
       DATE NAVIGATION
    ======================================================== */

    function changeDate(
        days
    ) {

        if (!appointmentDate) {
            return;
        }


        const current =
            parseLocalDate(
                appointmentDate.value
            );


        current.setDate(
            current.getDate() +
            days
        );


        setDateAndReload(
            current
        );

    }


    previousDay?.addEventListener(
        "click",
        () => {

            changeDate(-1);

        }
    );


    nextDay?.addEventListener(
        "click",
        () => {

            changeDate(1);

        }
    );


    todayButton?.addEventListener(
        "click",
        () => {

            setDateAndReload(
                new Date()
            );

        }
    );


    appointmentDate?.addEventListener(
        "change",
        () => {

            if (
                !appointmentDate.value
            ) {
                return;
            }


            const date =
                parseLocalDate(
                    appointmentDate.value
                );


            updateDateLabel(
                date
            );


            reloadWithDate(
                appointmentDate.value
            );

        }
    );


    function setDateAndReload(
        date
    ) {

        const value =
            formatDate(
                date
            );


        if (appointmentDate) {

            appointmentDate.value =
                value;

        }


        updateDateLabel(
            date
        );


        reloadWithDate(
            value
        );

    }


    function reloadWithDate(
        date
    ) {

        const url =
            new URL(
                window.location.href
            );


        url.searchParams.set(
            "date",
            date
        );


        window.location.href =
            url.toString();

    }


    function updateDateLabel(
        date
    ) {

        if (!selectedDateLabel) {
            return;
        }


        selectedDateLabel.textContent =
            date.toLocaleDateString(
                "en-US",
                {
                    weekday:
                        "long",

                    month:
                        "long",

                    day:
                        "2-digit",

                    year:
                        "numeric"
                }
            );

    }


    function parseLocalDate(
        value
    ) {

        if (!value) {

            return new Date();

        }


        const [
            year,
            month,
            day
        ] =
            value
                .split("-")
                .map(Number);


        return new Date(
            year,
            month - 1,
            day
        );

    }


    function formatDate(
        date
    ) {

        const year =
            date.getFullYear();


        const month =
            String(
                date.getMonth() + 1
            ).padStart(
                2,
                "0"
            );


        const day =
            String(
                date.getDate()
            ).padStart(
                2,
                "0"
            );


        return `${year}-${month}-${day}`;

    }


    function getLocalDate() {

        return formatDate(
            new Date()
        );

    }


    /* ========================================================
       REFRESH
    ======================================================== */

    refreshAppointments?.addEventListener(
        "click",
        () => {

            refreshAppointments.classList.add(
                "refreshing"
            );


            window.location.reload();

        }
    );


    /* ========================================================
       QUICK ACTIONS
    ======================================================== */

    document
        .getElementById(
            "openPatientRecords"
        )
        ?.addEventListener(
            "click",
            () => {

                window.location.href =
                    config.patientRecords ||
                    "/dentist/patient-records";

            }
        );


    document
        .getElementById(
            "openDentalChart"
        )
        ?.addEventListener(
            "click",
            () => {

                const link =
                    document.querySelector(
                        'a[href*="/dentist/odontogram"]'
                    );


                if (link) {

                    window.location.href =
                        link.href;

                }

            }
        );


    /* ========================================================
       NEW APPOINTMENT FORM
    ======================================================== */

    const newAppointmentForm =
        document.getElementById(
            "newAppointmentForm"
        );


    newAppointmentForm?.addEventListener(
        "submit",
        event => {

            const date =
                document.getElementById(
                    "newAppointmentDate"
                );


            /*
             * Do not allow appointments
             * in the past.
             */
            if (
                date &&
                date.value &&
                date.value <
                    getLocalDate()
            ) {

                event.preventDefault();


                showToast(
                    "Appointment date cannot be in the past.",
                    "error"
                );


                return;

            }


            const submitButton =
                newAppointmentForm.querySelector(
                    "button[type='submit']"
                );


            if (submitButton) {

                submitButton.disabled =
                    true;


                submitButton.textContent =
                    "Creating...";

            }


            showLoading();

        }
    );


    /* ========================================================
       ESCAPE KEY
    ======================================================== */

    document.addEventListener(
        "keydown",
        event => {

            if (
                event.key ===
                "Escape"
            ) {

                closeAllModals();

                closeSidebar();

            }

        }
    );


    /* ========================================================
       LOADING
    ======================================================== */

    function showLoading() {

        if (!loadingOverlay) {
            return;
        }


        loadingOverlay.hidden =
            false;

    }


    function hideLoading() {

        if (!loadingOverlay) {
            return;
        }


        loadingOverlay.hidden =
            true;

    }


    /* ========================================================
       TOAST
    ======================================================== */

    function showToast(
        message,
        type = "success"
    ) {

        const container =
            document.getElementById(
                "toastContainer"
            );


        if (!container) {
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
            () => {

                toast.style.opacity =
                    "0";

                toast.style.transform =
                    "translateY(8px)";

                toast.style.transition =
                    "all 0.25s ease";


                setTimeout(
                    () => {

                        toast.remove();

                    },
                    250
                );

            },
            3500
        );

    }


    /* ========================================================
       HELPERS
    ======================================================== */

    function setText(
        id,
        value
    ) {

        const element =
            document.getElementById(
                id
            );


        if (element) {

            element.textContent =
                value ?? "—";

        }

    }


    function capitalize(
        value
    ) {

        if (!value) {
            return "";
        }


        return (
            value.charAt(0)
                .toUpperCase() +
            value.slice(1)
        );

    }


    /* ========================================================
       INITIALIZE
    ======================================================== */

    applyFilters();


    console.log(
        "Dentist Appointments initialized."
    );


    /*
     * Debug checks.
     */
    console.log(
        "New Appointment Button:",
        newAppointmentButton
    );


    console.log(
        "New Appointment Modal:",
        newAppointmentModal
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
