// ============================================================
// APPOINTMENT BOOKING JAVASCRIPT
// ============================================================

let currentStep = 1;
const totalSteps = 3;


// ============================================================
// STEP NAVIGATION
// ============================================================

function nextStep() {

    if (currentStep === 1) {

        updateSummary();

    }

    if (currentStep < totalSteps) {

        currentStep++;

        showStep(
            currentStep
        );

    }

}


function previousStep() {

    if (currentStep > 1) {

        currentStep--;

        showStep(
            currentStep
        );

    }

}


function showStep(step) {

    const steps =
        document.querySelectorAll(
            ".form-step"
        );

    steps.forEach(
        function (page) {

            page.classList.remove(
                "active"
            );

        }
    );


    const currentPage =
        document.getElementById(
            "step" + step
        );

    if (currentPage) {

        currentPage.classList.add(
            "active"
        );

    }


    const trackerSteps =
        document.querySelectorAll(
            ".tracker-step"
        );

    trackerSteps.forEach(
        function (item, index) {

            item.classList.remove(
                "active",
                "completed"
            );

            if (index + 1 === step) {

                item.classList.add(
                    "active"
                );

            } else if (index + 1 < step) {

                item.classList.add(
                    "completed"
                );

            }

        }
    );


    const progress =
        document.querySelector(
            ".tracker-progress"
        );

    if (
        progress &&
        totalSteps > 1
    ) {

        const percentage =
            ((step - 1) /
                (totalSteps - 1)
            ) * 100;

        progress.style.width =
            percentage + "%";

    }


    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });

}


// ============================================================
// LOAD AVAILABLE TIME SLOTS
// ============================================================

async function loadSlots(date) {

    if (!date) {

        return;

    }


    const container =
        document.getElementById(
            "slots"
        );

    if (!container) {

        return;

    }


    const serviceSelect =
        document.getElementById(
            "service_id"
        );

    if (
        !serviceSelect ||
        !serviceSelect.value
    ) {

        container.innerHTML =
            '<p class="text-gray-500">Please select a dental service first.</p>';

        return;

    }


    try {

        container.innerHTML =
            '<p class="text-gray-500">Loading available slots...</p>';


        const response =
            await fetch(
                `/available-slots?date=${encodeURIComponent(date)}&service_id=${encodeURIComponent(serviceSelect.value)}`
            );


        if (!response.ok) {

            throw new Error(
                "Unable to load time slots."
            );

        }


        const slots =
            await response.json();


        container.innerHTML =
            "";


        if (
            !slots ||
            slots.length === 0
        ) {

            container.innerHTML =
                '<p class="text-gray-500">No available time slots for this service.</p>';

            return;

        }


        slots.forEach(
            function (slot) {

                const button =
                    document.createElement(
                        "button"
                    );

                button.type =
                    "button";

                button.classList.add(
                    "slot-btn"
                );

                button.textContent =
                    slot.time;

                button.dataset.start =
                    slot.start;

                button.dataset.end =
                    slot.end;


                if (!slot.available) {

                    button.classList.add(
                        "disabled"
                    );

                    button.disabled =
                        true;

                } else {

                    button.addEventListener(
                        "click",
                        function () {

                            document
                                .querySelectorAll(
                                    ".slot-btn"
                                )
                                .forEach(
                                    function (btn) {

                                        btn.classList.remove(
                                            "active"
                                        );

                                    }
                                );


                            button.classList.add(
                                "active"
                            );


                            const startTime =
                                document.getElementById(
                                    "start_time"
                                );

                            const endTime =
                                document.getElementById(
                                    "end_time"
                                );


                            if (startTime) {

                                startTime.value =
                                    slot.start;

                            }


                            if (endTime) {

                                endTime.value =
                                    slot.end;

                            }


                            console.log(
                                "Selected appointment:",
                                {
                                    start:
                                        slot.start,

                                    end:
                                        slot.end,

                                    duration:
                                        slot.duration,
                                }
                            );

                        }
                    );

                }


                container.appendChild(
                    button
                );

            }
        );

    } catch (error) {

        console.error(
            "Time slot error:",
            error
        );

        container.innerHTML =
            '<p class="text-red-500">Unable to load available time slots.</p>';

    }

}


// ============================================================
// GET INPUT VALUE
// ============================================================

function getValue(selector) {

    const element =
        document.querySelector(
            selector
        );

    if (!element) {

        return "";

    }

    return String(
        element.value || ""
    ).trim();

}


// ============================================================
// SET SUMMARY VALUE
// ============================================================

function setSummary(id, value) {

    const element =
        document.getElementById(
            id
        );

    if (element) {

        element.textContent =
            value || "—";

    }

}


// ============================================================
// CHECKBOX SUMMARY
// ============================================================

function updateCheckboxSummary(
    name,
    summaryId
) {

    const checkbox =
        document.querySelector(
            `input[name="${name}"]`
        );

    const summary =
        document.getElementById(
            summaryId
        );

    if (
        !checkbox ||
        !summary
    ) {

        return;

    }


    summary.textContent =
        checkbox.checked
            ? "Yes"
            : "No";

}


// ============================================================
// FORMAT DATE
// ============================================================

function formatDate(dateValue) {

    if (!dateValue) {

        return "—";

    }


    const date =
        new Date(
            dateValue +
            "T00:00:00"
        );


    if (isNaN(date.getTime())) {

        return dateValue;

    }


    return date.toLocaleDateString(
        "en-US",
        {
            month: "long",
            day: "numeric",
            year: "numeric"
        }
    );

}


// ============================================================
// FORMAT TIME
// ============================================================

function formatTime(timeValue) {

    if (!timeValue) {

        return "";

    }


    const parts =
        timeValue.split(
            ":"
        );


    let hours =
        parseInt(
            parts[0],
            10
        );


    const minutes =
        parts[1] || "00";


    if (isNaN(hours)) {

        return timeValue;

    }


    const ampm =
        hours >= 12
            ? "PM"
            : "AM";


    hours =
        hours % 12 || 12;


    return `${hours}:${minutes} ${ampm}`;

}


// ============================================================
// UPDATE APPOINTMENT SUMMARY
// ============================================================

function updateSummary() {

    setSummary(
        "summary_patient_name",
        getValue(
            'input[name="patient_name"]'
        )
    );


    setSummary(
        "summary_age",
        getValue(
            'input[name="age"]'
        )
    );


    setSummary(
        "summary_sex",
        getValue(
            'select[name="sex"]'
        )
    );


    setSummary(
        "summary_civil_status",
        getValue(
            'select[name="civil_status"]'
        )
    );


    setSummary(
        "summary_tel_no",
        getValue(
            'input[name="tel_no"]'
        )
    );


    setSummary(
        "summary_occupation",
        getValue(
            'select[name="occupation"]'
        )
    );


    setSummary(
        "summary_address",
        getValue(
            'textarea[name="address"]'
        )
    );


    // ========================================================
    // MEDICAL HISTORY
    // ========================================================

    updateCheckboxSummary(
        "heart_condition",
        "summary_heart_condition"
    );


    updateCheckboxSummary(
        "allergy",
        "summary_allergy"
    );


    updateCheckboxSummary(
        "diabetes",
        "summary_diabetes"
    );


    updateCheckboxSummary(
        "hypertension",
        "summary_hypertension"
    );


    updateCheckboxSummary(
        "bleeding_tendency",
        "summary_bleeding_tendency"
    );


    updateCheckboxSummary(
        "asthma",
        "summary_asthma"
    );


    setSummary(
        "summary_other_conditions",
        getValue(
            'textarea[name="other_conditions"]'
        ) || "None"
    );


    // ========================================================
    // APPOINTMENT DATE AND TIME
    // ========================================================

    const appointmentDate =
        getValue(
            'input[name="appointment_date"]'
        );


    const startTime =
        document.getElementById(
            "start_time"
        );


    const endTime =
        document.getElementById(
            "end_time"
        );


    setSummary(
        "summary_date",
        formatDate(
            appointmentDate
        )
    );


    let timeSummary =
        "—";


    if (
        startTime &&
        startTime.value
    ) {

        timeSummary =
            formatTime(
                startTime.value
            );


        if (
            endTime &&
            endTime.value
        ) {

            timeSummary +=
                " - " +
                formatTime(
                    endTime.value
                );

        }

    }


    setSummary(
        "summary_time",
        timeSummary
    );

}


// ============================================================
// GET APPOINTMENT FORM
// ============================================================

function getAppointmentForm() {

    return (
        document.querySelector(
            'form[action*="appointments"]'
        ) ||
        document.querySelector(
            "form"
        )
    );

}


// ============================================================
// OPEN SUBMIT MODAL
// ============================================================

function openSubmitModal(event) {

    if (event) {

        event.preventDefault();

    }


    const form =
        getAppointmentForm();


    const startTime =
        document.getElementById(
            "start_time"
        );


    if (!form) {

        console.error(
            "Appointment form not found."
        );

        return false;

    }


    if (!form.checkValidity()) {

        form.reportValidity();

        return false;

    }


    if (
        !startTime ||
        !startTime.value
    ) {

        alert(
            "⚠️ Please select a valid time slot."
        );

        return false;

    }


    updateSummary();


    const modal =
        document.getElementById(
            "submitModal"
        );


    if (!modal) {

        console.error(
            "Submit modal not found."
        );

        return false;

    }


    modal.classList.add(
        "active"
    );


    document.body.style.overflow =
        "hidden";


    return false;

}


// ============================================================
// CLOSE SUBMIT MODAL
// ============================================================

function closeSubmitModal() {

    const modal =
        document.getElementById(
            "submitModal"
        );


    if (modal) {

        modal.classList.remove(
            "active"
        );

    }


    document.body.style.overflow =
        "";

}


// ============================================================
// CONFIRM SUBMIT
// ============================================================

function confirmSubmit() {

    const form =
        getAppointmentForm();


    if (!form) {

        console.error(
            "Appointment form not found."
        );

        return;

    }


    const confirmButton =
        document.querySelector(
            ".modal-confirm-btn"
        );


    if (confirmButton) {

        confirmButton.disabled =
            true;

        confirmButton.textContent =
            "Submitting...";

    }


    form.submit();

}


// ============================================================
// PAGE INITIALIZATION
// ============================================================

document.addEventListener(
    "DOMContentLoaded",
    function () {

        // ========================================================
        // INITIALIZE TRACKER
        // ========================================================

        showStep(
            1
        );


        // ========================================================
        // INITIALIZE ODONTOGRAM
        // ========================================================

        initializeOdontogram();


        // ========================================================
        // DATE INPUT
        // ========================================================

        const dateInput =
            document.getElementById(
                "date"
            );


        if (dateInput) {

            dateInput.addEventListener(
                "change",
                function () {

                    loadSlots(
                        this.value
                    );

                }
            );

        }


        // ========================================================
        // SUBMIT MODAL
        // ========================================================

        const openModalButton =
            document.getElementById(
                "openSubmitModalBtn"
            );


        const cancelSubmitButton =
            document.querySelector(
                ".modal-cancel-btn"
            );


        const confirmSubmitButton =
            document.querySelector(
                ".modal-confirm-btn"
            );


        const submitModalOverlay =
            document.querySelector(
                ".submit-modal-overlay"
            );


        if (openModalButton) {

            openModalButton.addEventListener(
                "click",
                openSubmitModal
            );

        }


        if (cancelSubmitButton) {

            cancelSubmitButton.addEventListener(
                "click",
                closeSubmitModal
            );

        }


        if (confirmSubmitButton) {

            confirmSubmitButton.addEventListener(
                "click",
                confirmSubmit
            );

        }


        if (submitModalOverlay) {

            submitModalOverlay.addEventListener(
                "click",
                closeSubmitModal
            );

        }


        // ========================================================
        // NOTIFICATION DROPDOWN
        // ========================================================
const notificationBtn = document.getElementById("notificationBtn");
const notificationDropdown = document.getElementById("notificationDropdown");
const closeNotificationBtn = document.getElementById("closeNotificationBtn");
const notificationList = document.getElementById("notificationList");

function getCsrfToken() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');

    return csrfToken ? csrfToken.getAttribute("content") : "";
}

function updateNotificationCount() {
    if (!notificationBtn) {
        return;
    }

    const notificationItems =
        document.querySelectorAll(".notification-item");

    let unreadCount = 0;
    let readCount = 0;

    notificationItems.forEach(function (item) {
        if (
            item.dataset.notificationStatus === "unread"
        ) {
            unreadCount++;
        }

        if (
            item.dataset.notificationStatus === "read"
        ) {
            readCount++;
        }
    });

    const totalCount =
        unreadCount + readCount;

    const badge =
        notificationBtn.querySelector(
            ".notification-badge"
        );

    if (unreadCount > 0) {
        if (badge) {
            badge.textContent = unreadCount;
        }
    } else if (badge) {
        badge.remove();
    }

    notificationFilters.forEach(
        function (button) {
            const filter =
                button.dataset.filter;

            if (filter === "all") {
                button.textContent =
                    `All ${totalCount}`;
            }

            if (filter === "unread") {
                button.textContent =
                    `Unread ${unreadCount}`;
            }

            if (filter === "read") {
                button.textContent =
                    `Read ${readCount}`;
            }
        }
    );
}
async function markNotificationAsRead(notificationItem) {
    if (!notificationItem) {
        return;
    }

    if (
        notificationItem.dataset.notificationStatus === "read"
    ) {
        return;
    }

    const notificationId =
        notificationItem.dataset.notificationId;

    if (!notificationId) {
        return;
    }

    try {
        const response = await fetch(
            `/notifications/${notificationId}/mark-read`,
            {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": getCsrfToken(),
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }
            }
        );

        if (!response.ok) {
            throw new Error(
                `HTTP error: ${response.status}`
            );
        }

        notificationItem.dataset.notificationStatus = "read";

        notificationItem.classList.remove(
            "bg-pink-50/30"
        );

        notificationItem.classList.add(
            "bg-white"
        );

        const unreadDot =
            notificationItem.querySelector(
                ".absolute.left-2.top-5"
            );

        if (unreadDot) {
            unreadDot.remove();
        }

        updateNotificationCount();

    } catch (error) {
        console.error(
            "Failed to mark notification as read:",
            error
        );
    }
}

async function deleteNotification(deleteButton) {
    if (!deleteButton) {
        return;
    }

    const deleteUrl =
        deleteButton.dataset.deleteUrl;

    if (!deleteUrl) {
        return;
    }

    const notificationItem =
        deleteButton.closest(".notification-item");

    try {
        const response = await fetch(
            deleteUrl,
            {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": getCsrfToken(),
                    "Accept": "application/json"
                }
            }
        );

        if (!response.ok) {
            throw new Error(
                `HTTP error: ${response.status}`
            );
        }

        if (notificationItem) {
            notificationItem.remove();
        }

        updateNotificationCount();

    } catch (error) {
        console.error(
            "Failed to delete notification:",
            error
        );
    }
}

if (
    notificationBtn &&
    notificationDropdown
) {
    notificationBtn.addEventListener(
        "click",
        function (event) {
            event.preventDefault();
            event.stopPropagation();

            notificationDropdown.classList.toggle(
                "hidden"
            );

            notificationBtn.setAttribute(
                "aria-expanded",
                String(
                    !notificationDropdown.classList.contains(
                        "hidden"
                    )
                )
            );
        }
    );
}

if (
    closeNotificationBtn &&
    notificationDropdown
) {
    closeNotificationBtn.addEventListener(
        "click",
        function (event) {
            event.preventDefault();
            event.stopPropagation();

            notificationDropdown.classList.add(
                "hidden"
            );

            if (notificationBtn) {
                notificationBtn.setAttribute(
                    "aria-expanded",
                    "false"
                );
            }
        }
    );
}

if (notificationList) {
    notificationList.addEventListener(
        "click",
        function (event) {
            const deleteButton =
                event.target.closest(
                    ".delete-notification"
                );

            if (deleteButton) {
                event.preventDefault();
                event.stopPropagation();

                deleteNotification(
                    deleteButton
                );

                return;
            }

            const notificationItem =
                event.target.closest(
                    ".notification-item"
                );

            if (notificationItem) {
                markNotificationAsRead(
                    notificationItem
                );
            }
        }
    );
}

document.addEventListener(
    "click",
    function (event) {
        if (
            notificationDropdown &&
            notificationBtn &&
            !notificationDropdown.contains(
                event.target
            ) &&
            !notificationBtn.contains(
                event.target
            )
        ) {
            notificationDropdown.classList.add(
                "hidden"
            );

            notificationBtn.setAttribute(
                "aria-expanded",
                "false"
            );
        }
    }
);

const clearAllNotifications =
    document.getElementById("clearAllNotifications");

const clearNotificationsConfirmModal =
    document.getElementById(
        "clearNotificationsConfirmModal"
    );

const cancelClearNotifications =
    document.getElementById(
        "cancelClearNotifications"
    );

const confirmClearNotifications =
    document.getElementById(
        "confirmClearNotifications"
    );

const clearNotificationsSuccessModal =
    document.getElementById(
        "clearNotificationsSuccessModal"
    );

const closeClearNotificationsSuccess =
    document.getElementById(
        "closeClearNotificationsSuccess"
    );

function openClearNotificationsModal() {
    if (clearNotificationsConfirmModal) {
        clearNotificationsConfirmModal.classList.remove(
            "hidden"
        );
    }
}

function closeClearNotificationsModal() {
    if (clearNotificationsConfirmModal) {
        clearNotificationsConfirmModal.classList.add(
            "hidden"
        );
    }
}

function openClearNotificationsSuccessModal() {
    if (clearNotificationsSuccessModal) {
        clearNotificationsSuccessModal.classList.remove(
            "hidden"
        );
    }
}

function closeClearNotificationsSuccessModal() {
    if (clearNotificationsSuccessModal) {
        clearNotificationsSuccessModal.classList.add(
            "hidden"
        );
    }
}

if (clearAllNotifications) {
    clearAllNotifications.addEventListener(
        "click",
        function (event) {
            event.preventDefault();
            event.stopPropagation();

            openClearNotificationsModal();
        }
    );
}

if (cancelClearNotifications) {
    cancelClearNotifications.addEventListener(
        "click",
        function (event) {
            event.preventDefault();

            closeClearNotificationsModal();
        }
    );
}

if (confirmClearNotifications) {
    confirmClearNotifications.addEventListener(
        "click",
        async function (event) {
            event.preventDefault();

            const clearUrl =
                clearAllNotifications
                    ? clearAllNotifications.dataset.clearUrl
                    : null;

            if (!clearUrl) {
                return;
            }

            try {
                confirmClearNotifications.disabled = true;

                const response = await fetch(
                    clearUrl,
                    {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": getCsrfToken(),
                            "Accept": "application/json"
                        }
                    }
                );

                if (!response.ok) {
                    throw new Error(
                        `HTTP error: ${response.status}`
                    );
                }

                if (notificationList) {
                    notificationList.innerHTML = `
                        <div
                            id="noNotificationsMessage"
                            class="py-12 px-4 text-center"
                        >
                            <div class="w-12 h-12 bg-pink-50 text-pink-400 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                    />
                                </svg>
                            </div>

                            <p class="text-sm font-medium text-gray-600">
                                No notifications found
                            </p>

                            <p class="text-xs text-gray-400 mt-0.5">
                                You're all caught up for now!
                            </p>
                        </div>
                    `;
                }

                updateNotificationCount();

                closeClearNotificationsModal();

                openClearNotificationsSuccessModal();

            } catch (error) {
                console.error(
                    "Failed to clear notifications:",
                    error
                );
            } finally {
                confirmClearNotifications.disabled = false;
            }
        }
    );
}

if (closeClearNotificationsSuccess) {
    closeClearNotificationsSuccess.addEventListener(
        "click",
        function (event) {
            event.preventDefault();

            closeClearNotificationsSuccessModal();
        }
    );
}

// ============================================================
// PROFILE DROPDOWN
// ============================================================

const profileBtn =
    document.getElementById("profileBtn");

const profileMenu =
    document.getElementById("profileMenu");

profileBtn?.addEventListener("click", function (event) {

    event.preventDefault();
    event.stopPropagation();

    profileMenu?.classList.toggle("hidden");

    // Close notification dropdown
    notificationDropdown?.classList.add("hidden");
});


// ============================================================
// CLOSE DROPDOWNS WHEN CLICKING OUTSIDE
// ============================================================

document.addEventListener("click", function (event) {

    // Close profile dropdown
    if (
        profileBtn &&
        profileMenu &&
        !profileBtn.contains(event.target) &&
        !profileMenu.contains(event.target)
    ) {
        profileMenu.classList.add("hidden");
    }

    // Close notification dropdown
    if (
        notificationBtn &&
        notificationDropdown &&
        !notificationBtn.contains(event.target) &&
        !notificationDropdown.contains(event.target)
    ) {
        notificationDropdown.classList.add("hidden");
    }

});


// ============================================================
// ESCAPE KEY
// ============================================================

document.addEventListener("keydown", function (event) {

    if (event.key === "Escape") {

        profileMenu?.classList.add("hidden");

        notificationDropdown?.classList.add("hidden");

    }

});


        // ========================================================
        // SERVICE CHANGE
        // ========================================================

        const serviceSelect =
            document.getElementById(
                "service_id"
            );


        if (serviceSelect) {

            serviceSelect.addEventListener(
                "change",
                function () {

                    const dateInput =
                        document.getElementById(
                            "date"
                        );

                    if (
                        dateInput &&
                        dateInput.value
                    ) {

                        loadSlots(
                            dateInput.value
                        );

                    }

                }
            );

        }


        // ========================================================
        // UPDATE SUMMARY ON INPUT
        // ========================================================

        const summaryFields =
            document.querySelectorAll(
                [
                    'input[name="patient_name"]',
                    'input[name="age"]',
                    'select[name="sex"]',
                    'select[name="civil_status"]',
                    'input[name="tel_no"]',
                    'select[name="occupation"]',
                    'textarea[name="address"]',
                    'textarea[name="other_conditions"]',
                    'input[name="appointment_date"]'
                ].join(
                    ","
                )
            );


        summaryFields.forEach(
            function (field) {

                field.addEventListener(
                    "input",
                    function () {

                        updateSummary();

                    }
                );


                field.addEventListener(
                    "change",
                    function () {

                        updateSummary();

                    }
                );

            }
        );


        // ========================================================
        // MEDICAL HISTORY CHECKBOXES
        // ========================================================

        const medicalCheckboxes =
            [
                "heart_condition",
                "allergy",
                "diabetes",
                "hypertension",
                "bleeding_tendency",
                "asthma"
            ];


        medicalCheckboxes.forEach(
            function (name) {

                const checkbox =
                    document.querySelector(
                        `input[name="${name}"]`
                    );


                if (checkbox) {

                    checkbox.addEventListener(
                        "change",
                        function () {

                            updateSummary();

                        }
                    );

                }

            }
        );


        // ========================================================
        // FORM SUBMIT PROTECTION
        // ========================================================

        const appointmentForm =
            getAppointmentForm();


        if (appointmentForm) {

            appointmentForm.addEventListener(
                "submit",
                function (event) {

                    /*
                    The Save Appointment button is type="button",
                    so this normally will not trigger.

                    This is only a safety check if another element
                    submits the form directly.
                    */

                    const startTime =
                        document.getElementById(
                            "start_time"
                        );


                    if (
                        !startTime ||
                        !startTime.value
                    ) {

                        event.preventDefault();

                        alert(
                            "⚠️ Please select a valid time slot."
                        );

                        return false;

                    }

                }
            );

        }


        // ========================================================
        // INITIAL SUMMARY
        // ========================================================

        updateSummary();

    }
);


// ============================================================
// TOOTH / ODONTOGRAM VARIABLES
// ============================================================

let selectedTooth =
    null;

let selectedCondition =
    null;


// ============================================================
// TOOTH CONDITION MODAL
// ============================================================

const toothConditionModal =
    document.getElementById(
        "toothConditionModal"
    );


const confirmConditionModal =
    document.getElementById(
        "confirmConditionModal"
    );


const selectedToothNumber =
    document.getElementById(
        "selectedToothNumber"
    );


const selectedConditionText =
    document.getElementById(
        "selectedConditionText"
    );


// ============================================================
// OPEN TOOTH CONDITION MODAL
// ============================================================

function openToothConditionModal(
    tooth
) {

    selectedTooth =
        tooth;

    selectedCondition =
        null;


    if (
        selectedToothNumber &&
        tooth
    ) {

        selectedToothNumber.textContent =
            tooth.dataset.tooth ||
            tooth.dataset.number ||
            tooth.id ||
            "Selected Tooth";

    }


    if (toothConditionModal) {

        toothConditionModal.classList.add(
            "active"
        );

    }

}


// ============================================================
// CLOSE TOOTH CONDITION MODAL
// ============================================================

function closeToothConditionModal() {

    if (toothConditionModal) {

        toothConditionModal.classList.remove(
            "active"
        );

    }


    selectedTooth =
        null;

    selectedCondition =
        null;

}


// ============================================================
// SELECT TOOTH CONDITION
// ============================================================

function selectToothCondition(
    condition
) {

    selectedCondition =
        condition;


    document
        .querySelectorAll(
            ".condition-option"
        )
        .forEach(
            function (option) {

                option.classList.remove(
                    "active"
                );

            }
        );


    const selectedOption =
        document.querySelector(
            `.condition-option[data-condition="${condition}"]`
        );


    if (selectedOption) {

        selectedOption.classList.add(
            "active"
        );

    }

}


// ============================================================
// SHOW CONDITION CONFIRMATION
// ============================================================

function showConditionConfirmation() {

    if (!selectedTooth) {

        return;

    }


    if (!selectedCondition) {

        alert(
            "Please select a tooth condition."
        );

        return;

    }


    if (selectedConditionText) {

        selectedConditionText.textContent =
            selectedCondition;

    }


    if (confirmConditionModal) {

        confirmConditionModal.classList.add(
            "active"
        );

    }

}


// ============================================================
// CLOSE CONDITION CONFIRMATION
// ============================================================

function closeConditionConfirmation() {

    if (confirmConditionModal) {

        confirmConditionModal.classList.remove(
            "active"
        );

    }

}


// ============================================================
// APPLY TOOTH CONDITION
// ============================================================

function applyToothCondition() {

    if (
        !selectedTooth ||
        !selectedCondition
    ) {

        return;

    }


    selectedTooth.dataset.condition =
        selectedCondition;


    selectedTooth.classList.remove(
        "healthy",
        "cavity",
        "filled",
        "missing",
        "crown",
        "root-canal",
        "extraction",
        "implant"
    );


    selectedTooth.classList.add(
        selectedCondition
    );


    closeConditionConfirmation();

    closeToothConditionModal();

}


// ============================================================
// TOOTH CLICK INITIALIZATION
// ============================================================

function initializeOdontogram() {

    const teeth =
        document.querySelectorAll(
            ".tooth"
        );


    if (!teeth.length) {

        return;

    }


    teeth.forEach(
        function (tooth) {

            tooth.addEventListener(
                "click",
                function () {

                    openToothConditionModal(
                        tooth
                    );

                }
            );

        }
    );

}


// ============================================================
// CONDITION OPTION BUTTONS
// ============================================================

document.addEventListener(
    "DOMContentLoaded",
    function () {

        document
            .querySelectorAll(
                ".condition-option"
            )
            .forEach(
                function (option) {

                    option.addEventListener(
                        "click",
                        function () {

                            const condition =
                                option.dataset.condition;

                            if (condition) {

                                selectToothCondition(
                                    condition
                                );

                            }

                        }
                    );

                }
            );

    }
);


// ============================================================
// SIGNATURE SYSTEM
// ============================================================

document.addEventListener(
    "DOMContentLoaded",
    function () {

        const addSignatureButton =
            document.getElementById(
                "addSignatureButton"
            );

        const clearSignatureButton =
            document.getElementById(
                "clearSignatureButton"
            );

        const signatureModal =
            document.getElementById(
                "signatureModal"
            );

        const signatureModalOverlay =
            document.getElementById(
                "signatureModalOverlay"
            );

        const closeSignatureModalButton =
            document.getElementById(
                "closeSignatureModal"
            );

        const cancelSignatureButton =
            document.getElementById(
                "cancelSignatureButton"
            );

        const resetSignatureButton =
            document.getElementById(
                "resetSignatureButton"
            );

        const saveSignatureButton =
            document.getElementById(
                "saveSignatureButton"
            );

        const signatureCanvas =
            document.getElementById(
                "signatureCanvas"
            );

        const signatureCanvasPlaceholder =
            document.getElementById(
                "signatureCanvasPlaceholder"
            );

        const signatureImage =
            document.getElementById(
                "signatureImage"
            );

        const signaturePlaceholder =
            document.getElementById(
                "signaturePlaceholder"
            );

        const patientSignature =
            document.getElementById(
                "patientSignature"
            );


        // ====================================================
        // CHECK REQUIRED ELEMENTS
        // ====================================================

        if (!signatureCanvas) {

            console.error(
                "signatureCanvas not found."
            );

            return;

        }


        const context =
            signatureCanvas.getContext(
                "2d"
            );


        let isDrawing =
            false;

        let hasDrawnSignature =
            false;


        // ====================================================
        // RESIZE CANVAS
        // ====================================================

        function resizeSignatureCanvas() {

            const rect =
                signatureCanvas.getBoundingClientRect();


            if (
                rect.width === 0 ||
                rect.height === 0
            ) {

                return;

            }


            signatureCanvas.width =
                rect.width;

            signatureCanvas.height =
                rect.height;


            context.lineWidth =
                3;

            context.lineCap =
                "round";

            context.lineJoin =
                "round";

        }


        // ====================================================
        // OPEN MODAL
        // ====================================================

        function openSignatureModal() {

            if (!signatureModal) {

                console.error(
                    "signatureModal not found."
                );

                return;

            }


            signatureModal.classList.add(
                "active"
            );

            signatureModal.setAttribute(
                "aria-hidden",
                "false"
            );


            document.body.style.overflow =
                "hidden";


            setTimeout(
                function () {

                    resizeSignatureCanvas();

                },
                50
            );

        }


        // ====================================================
        // CLOSE MODAL
        // ====================================================

        function closeSignatureModal() {

            if (signatureModal) {

                signatureModal.classList.remove(
                    "active"
                );

                signatureModal.setAttribute(
                    "aria-hidden",
                    "true"
                );

            }


            document.body.style.overflow =
                "";

        }


        // ====================================================
        // GET POINTER POSITION
        // ====================================================

        function getCanvasPosition(
            event
        ) {

            const rect =
                signatureCanvas.getBoundingClientRect();


            return {

                x:
                    event.clientX -
                    rect.left,

                y:
                    event.clientY -
                    rect.top

            };

        }


        // ====================================================
        // START DRAWING
        // ====================================================

        function startDrawing(
            event
        ) {

            isDrawing =
                true;


            const position =
                getCanvasPosition(
                    event
                );


            context.beginPath();

            context.moveTo(
                position.x,
                position.y
            );


            hasDrawnSignature =
                true;


            if (
                signatureCanvasPlaceholder
            ) {

                signatureCanvasPlaceholder.style.display =
                    "none";

            }

        }


        // ====================================================
        // DRAW
        // ====================================================

        function drawSignature(
            event
        ) {

            if (!isDrawing) {

                return;

            }


            const position =
                getCanvasPosition(
                    event
                );


            context.lineTo(
                position.x,
                position.y
            );

            context.stroke();

        }


        // ====================================================
        // STOP DRAWING
        // ====================================================

        function stopDrawing() {

            if (!isDrawing) {

                return;

            }


            isDrawing =
                false;


            context.closePath();

        }


        // ====================================================
        // MOUSE EVENTS
        // ====================================================

        signatureCanvas.addEventListener(
            "mousedown",
            startDrawing
        );

        signatureCanvas.addEventListener(
            "mousemove",
            drawSignature
        );

        signatureCanvas.addEventListener(
            "mouseup",
            stopDrawing
        );

        signatureCanvas.addEventListener(
            "mouseleave",
            stopDrawing
        );


        // ====================================================
        // TOUCH EVENTS
        // ====================================================

        signatureCanvas.addEventListener(
            "touchstart",
            function (event) {

                event.preventDefault();


                const touch =
                    event.touches[0];


                startDrawing(
                    {
                        clientX:
                            touch.clientX,

                        clientY:
                            touch.clientY
                    }
                );

            },
            {
                passive: false
            }
        );


        signatureCanvas.addEventListener(
            "touchmove",
            function (event) {

                event.preventDefault();


                if (
                    event.touches.length === 0
                ) {

                    return;

                }


                const touch =
                    event.touches[0];


                drawSignature(
                    {
                        clientX:
                            touch.clientX,

                        clientY:
                            touch.clientY
                    }
                );

            },
            {
                passive: false
            }
        );


        signatureCanvas.addEventListener(
            "touchend",
            stopDrawing
        );


        // ====================================================
        // ADD SIGNATURE BUTTON
        // ====================================================

        if (addSignatureButton) {

            addSignatureButton.addEventListener(
                "click",
                function (event) {

                    event.preventDefault();

                    console.log(
                        "Add Signature clicked"
                    );


                    openSignatureModal();

                }
            );

        }


        // ====================================================
        // CLOSE BUTTON
        // ====================================================

        if (
            closeSignatureModalButton
        ) {

            closeSignatureModalButton.addEventListener(
                "click",
                closeSignatureModal
            );

        }


        // ====================================================
        // CANCEL BUTTON
        // ====================================================

        if (
            cancelSignatureButton
        ) {

            cancelSignatureButton.addEventListener(
                "click",
                closeSignatureModal
            );

        }


        // ====================================================
        // OVERLAY CLICK
        // ====================================================

        if (
            signatureModalOverlay
        ) {

            signatureModalOverlay.addEventListener(
                "click",
                closeSignatureModal
            );

        }


        // ====================================================
        // CLEAR CANVAS
        // ====================================================

        if (
            resetSignatureButton
        ) {

            resetSignatureButton.addEventListener(
                "click",
                function () {

                    context.clearRect(
                        0,
                        0,
                        signatureCanvas.width,
                        signatureCanvas.height
                    );


                    hasDrawnSignature =
                        false;


                    if (
                        signatureCanvasPlaceholder
                    ) {

                        signatureCanvasPlaceholder.style.display =
                            "flex";

                    }

                }
            );

        }


        // ====================================================
        // SAVE SIGNATURE
        // ====================================================

        if (
            saveSignatureButton
        ) {

            saveSignatureButton.addEventListener(
                "click",
                function () {

                    if (
                        !hasDrawnSignature
                    ) {

                        alert(
                            "Please add your signature first."
                        );

                        return;

                    }


                    const signatureData =
                        signatureCanvas.toDataURL(
                            "image/png"
                        );


                    // SAVE TO HIDDEN INPUT

                    if (
                        patientSignature
                    ) {

                        patientSignature.value =
                            signatureData;

                    }


                    // SHOW PREVIEW IMAGE

                    if (
                        signatureImage
                    ) {

                        signatureImage.src =
                            signatureData;

                        signatureImage.style.display =
                            "block";

                    }


                    // HIDE PLACEHOLDER

                    if (
                        signaturePlaceholder
                    ) {

                        signaturePlaceholder.style.display =
                            "none";

                    }


                    closeSignatureModal();

                }
            );

        }


        // ====================================================
        // CLEAR SAVED SIGNATURE
        // ====================================================

        if (
            clearSignatureButton
        ) {

            clearSignatureButton.addEventListener(
                "click",
                function (event) {

                    event.preventDefault();


                    if (
                        patientSignature
                    ) {

                        patientSignature.value =
                            "";

                    }


                    if (
                        signatureImage
                    ) {

                        signatureImage.src =
                            "";

                        signatureImage.style.display =
                            "none";

                    }


                    if (
                        signaturePlaceholder
                    ) {

                        signaturePlaceholder.style.display =
                            "block";

                    }


                    context.clearRect(
                        0,
                        0,
                        signatureCanvas.width,
                        signatureCanvas.height
                    );


                    hasDrawnSignature =
                        false;

                }
            );

        }


        // ====================================================
        // ESCAPE KEY
        // ====================================================

        document.addEventListener(
            "keydown",
            function (event) {

                if (
                    event.key === "Escape" &&
                    signatureModal &&
                    signatureModal.classList.contains(
                        "active"
                    )
                ) {

                    closeSignatureModal();

                }

            }
        );

    }
);

//Mobile Sidebar Toggle

