document.addEventListener("DOMContentLoaded", () => {

    "use strict";

    const config = window.PatientRecordsConfig || {};

    const csrfToken =
        config.csrfToken ||
        document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") ||
        "";

    const $ = (selector, parent = document) =>
        parent.querySelector(selector);

    const $$ = (selector, parent = document) =>
        [...parent.querySelectorAll(selector)];

    const patientListView = $("#patientListView");
    const patientRecordView = $("#patientRecordView");

    const patientSearch = $("#patientSearch");
    const patientStatus = $("#patientStatus");
    const resetFilters = $("#resetFilters");

    const backToPatients = $("#backToPatients");

    const loadingOverlay = $("#loadingOverlay");
    const toastContainer = $("#toastContainer");

    let currentPatientId = null;
    let currentPatient = null;

    let selectedTooth = null;

    function showLoading(message = "Loading patient record...") {

        if (!loadingOverlay) {
            return;
        }

        const text = loadingOverlay.querySelector("p");

        if (text) {
            text.textContent = message;
        }

        loadingOverlay.hidden = false;
    }

    function hideLoading() {

        if (!loadingOverlay) {
            return;
        }

        loadingOverlay.hidden = true;
    }

    function showToast(message, type = "info") {

        if (!toastContainer) {
            alert(message);
            return;
        }

        const toast = document.createElement("div");

        toast.className = `toast ${type}`;

        toast.innerHTML = `
            <div class="toast-message"></div>

            <button
                type="button"
                class="toast-close"
                aria-label="Close notification"
            >
                ×
            </button>
        `;

        const messageElement =
            toast.querySelector(".toast-message");

        messageElement.textContent = message;

        toastContainer.appendChild(toast);

        const closeButton =
            toast.querySelector(".toast-close");

        closeButton.addEventListener("click", () => {
            toast.remove();
        });

        setTimeout(() => {

            if (toast.isConnected) {
                toast.remove();
            }

        }, 4000);
    }

    async function apiRequest(url, options = {}) {

        const headers = {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",

            ...(options.headers || {})
        };

        if (csrfToken) {
            headers["X-CSRF-TOKEN"] = csrfToken;
        }

        if (
            options.body &&
            !(options.body instanceof FormData)
        ) {
            headers["Content-Type"] =
                "application/json";
        }

        const response = await fetch(url, {
            ...options,
            headers
        });

        const contentType =
            response.headers.get("content-type") || "";

        let data;

        if (contentType.includes("application/json")) {
            data = await response.json();
        } else {
            data = await response.text();
        }

        if (!response.ok) {

            let message =
                `Request failed (${response.status})`;

            if (
                data &&
                typeof data === "object"
            ) {
                message =
                    data.message ||
                    data.error ||
                    message;

                if (data.errors) {

                    const errors =
                        Object.values(data.errors)
                            .flat()
                            .join("\n");

                    if (errors) {
                        message = errors;
                    }
                }
            }

            throw new Error(message);
        }

        return data;
    }

    function patientBaseUrl() {

        return (
            config.routes?.show ||
            config.routes?.index ||
            "/dentist/patient-records"
        ).replace(/\/$/, "");
    }

    function patientUrl(id) {

        return `${patientBaseUrl()}/${id}`;
    }

    function showPatientList() {

        if (patientRecordView) {
            patientRecordView.hidden = true;
        }

        if (patientListView) {
            patientListView.hidden = false;
        }

        currentPatientId = null;
        currentPatient = null;

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }

    function showPatientRecord() {

        if (patientListView) {
            patientListView.hidden = true;
        }

        if (patientRecordView) {
            patientRecordView.hidden = false;
        }

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }

    function escapeHtml(value) {

        if (
            value === null ||
            value === undefined
        ) {
            return "";
        }

        const div = document.createElement("div");

        div.textContent = String(value);

        return div.innerHTML;
    }

    function formatDate(dateValue) {

        if (!dateValue) {
            return "—";
        }

        const date =
            new Date(dateValue);

        if (Number.isNaN(date.getTime())) {
            return dateValue;
        }

        return date.toLocaleDateString(
            "en-US",
            {
                month: "short",
                day: "numeric",
                year: "numeric"
            }
        );
    }

    function formatStatus(status) {

        if (!status) {
            return "Unknown";
        }

        return String(status)
            .replace(/[_-]/g, " ")
            .replace(/\b\w/g, letter =>
                letter.toUpperCase()
            );
    }

    function setText(id, value) {

        const element = document.getElementById(id);

        if (!element) {
            return;
        }

        element.textContent =
            value === null ||
            value === undefined ||
            value === ""
                ? "—"
                : value;
    }

    async function loadPatient(patientId) {

        if (!patientId) {
            return;
        }

        currentPatientId = patientId;

        showLoading(
            "Loading patient record..."
        );

        try {

            const data =
                await apiRequest(
                    patientUrl(patientId)
                );

            currentPatient =
                data?.patient ||
                data?.data ||
                data;

            renderPatientRecord(
                currentPatient
            );

            showPatientRecord();

        } catch (error) {

            console.error(
                "Patient record error:",
                error
            );

            showToast(
                error.message ||
                "Unable to load patient record.",
                "error"
            );

        } finally {

            hideLoading();
        }
    }

    function renderPatientRecord(patient) {

        if (!patient) {
            return;
        }

        const user =
            patient.user || {};

        const name =
            patient.patient_name ||
            patient.name ||
            user.name ||
            "Patient";

        const email =
            patient.email ||
            user.email ||
            "No email";

        const phone =
            patient.tel_no ||
            patient.phone ||
            patient.contact_number ||
            "—";

        const id =
            patient.id ||
            patient.patient_id ||
            "—";

        const age =
            patient.age ||
            "—";

        const sex =
            patient.sex ||
            "—";

        const civilStatus =
            patient.civil_status ||
            "—";

        const occupation =
            patient.occupation ||
            "—";

        const address =
            patient.address ||
            "—";

        const registered =
            patient.created_at
                ? formatDate(patient.created_at)
                : "—";

        setText(
            "recordPatientName",
            name
        );

        setText(
            "recordPatientId",
            `Patient ID: P-${String(id).padStart(5, "0")}`
        );

        setText(
            "recordPatientAge",
            age
        );

        setText(
            "recordPatientSex",
            sex
        );

        setText(
            "recordPatientPhone",
            phone
        );

        setText(
            "recordPatientEmail",
            email
        );

        setText(
            "recordPatientRegistered",
            registered
        );

        const recordPatientImage =
            $("#recordPatientImage");

        const recordPatientInitial =
            $("#recordPatientInitial");

        const profilePicture =
            user.profile_picture ||
            patient.profile_picture ||
            "";

        if (
            recordPatientImage &&
            recordPatientInitial
        ) {

            if (profilePicture) {

                const imageUrl =
                    profilePicture.startsWith("http")
                        ? profilePicture
                        : `/storage/${profilePicture}`;

                recordPatientImage.src =
                    imageUrl;

                recordPatientImage.style.display =
                    "block";

                recordPatientInitial.style.display =
                    "none";

                recordPatientImage.onerror =
                    function () {

                        recordPatientImage.style.display =
                            "none";

                        recordPatientInitial.style.display =
                            "flex";

                        recordPatientInitial.textContent =
                            name
                                .trim()
                                .charAt(0)
                                .toUpperCase() || "P";
                    };

            } else {

                recordPatientImage.removeAttribute(
                    "src"
                );

                recordPatientImage.style.display =
                    "none";

                recordPatientInitial.style.display =
                    "flex";

                recordPatientInitial.textContent =
                    name
                        .trim()
                        .charAt(0)
                        .toUpperCase() || "P";
            }
        }

        setText(
            "overviewFullName",
            name
        );

        setText(
            "overviewAge",
            age
        );

        setText(
            "overviewSex",
            sex
        );

        setText(
            "overviewCivilStatus",
            civilStatus
        );

        setText(
            "overviewPhone",
            phone
        );

        setText(
            "overviewOccupation",
            occupation
        );

        setText(
            "overviewAddress",
            address
        );

        const appointments =
            patient.appointments || [];

        const validAppointments =
            appointments.filter(item =>
                [
                    "completed",
                    "approved"
                ].includes(
                    String(item.status || "").toLowerCase()
                )
            );

        validAppointments.sort(
            (a, b) =>
                new Date(
                    b.appointment_date
                ) -
                new Date(
                    a.appointment_date
                )
        );

        const lastVisit =
            validAppointments[0];

        setText(
            "recordPatientLastVisit",
            lastVisit
                ? formatDate(lastVisit.appointment_date)
                : "No visit yet"
        );

        renderMedicalHistory(
            patient
        );

        renderTreatments(
            patient.treatments || []
        );

        renderAppointments(
            appointments
        );

        renderPrescriptions(
            patient.prescriptions || []
        );

        renderNotes(
            patient.notes || []
        );

        renderOdontogram(
            patient.odontogram ||
            patient.odontograms ||
            patient.tooth_conditions ||
            []
        );
    }

    function renderMedicalHistory(patient) {

        if (!patient) {
            return;
        }

        const history =
            patient.medical_history ||
            patient.medicalHistory ||
            patient;

        updateMedicalValue(
            "medicalHeartCheckbox",
            "medicalHeartCondition",
            "medicalHeartDetails",
            history.heart_condition,
            history.heart_condition_details
        );

        updateMedicalValue(
            "medicalAllergyCheckbox",
            "medicalAllergy",
            "medicalAllergyDetails",
            history.allergy,
            history.allergy_details
        );

        updateMedicalValue(
            "medicalDiabetesCheckbox",
            "medicalDiabetes",
            "medicalDiabetesDetails",
            history.diabetes,
            history.diabetes_details
        );

        updateMedicalValue(
            "medicalHypertensionCheckbox",
            "medicalHypertension",
            "medicalHypertensionDetails",
            history.hypertension,
            history.hypertension_details
        );

        updateMedicalValue(
            "medicalBleedingCheckbox",
            "medicalBleeding",
            "medicalBleedingDetails",
            history.bleeding_tendency,
            history.bleeding_tendency_details
        );

        updateMedicalValue(
            "medicalAsthmaCheckbox",
            "medicalAsthma",
            "medicalAsthmaDetails",
            history.asthma,
            history.asthma_details
        );

        setText(
            "medicalOtherConditions",
            history.other_conditions ||
            "None recorded."
        );
    }

    function updateMedicalValue(
        checkboxId,
        valueId,
        detailsId,
        value,
        details
    ) {

        const checkbox =
            document.getElementById(
                checkboxId
            );

        const valueElement =
            document.getElementById(
                valueId
            );

        const detailsElement =
            document.getElementById(
                detailsId
            );

        const falseValues = [
            null,
            undefined,
            "",
            0,
            "0",
            false,
            "false",
            "False",
            "no",
            "No",
            "none",
            "None"
        ];

        const hasCondition =
            !falseValues.includes(value);

        if (checkbox) {
            checkbox.checked =
                hasCondition;
        }

        if (valueElement) {
            valueElement.textContent =
                hasCondition
                    ? "Yes"
                    : "No";
        }

        if (detailsElement) {

            if (!hasCondition) {

                detailsElement.textContent =
                    "—";

            } else {

                detailsElement.textContent =
                    details ||
                    (
                        typeof value === "string" &&
                        ![
                            "true",
                            "True",
                            "yes",
                            "Yes",
                            "1"
                        ].includes(value)
                            ? value
                            : "Recorded"
                    );
            }
        }
    }

    function renderTreatments(treatments) {

        const body =
            $("#treatmentTableBody");

        const recentList =
            $("#overviewRecentTreatments");

        if (!body) {
            return;
        }

        if (
            !Array.isArray(treatments) ||
            treatments.length === 0
        ) {

            body.innerHTML = `
                <tr>
                    <td
                        colspan="7"
                        class="empty-table"
                    >
                        <div class="empty-state compact">
                            <p>
                                No treatment records available.
                            </p>
                        </div>
                    </td>
                </tr>
            `;

            if (recentList) {
                recentList.innerHTML = `
                    <div class="empty-record-message">
                        No treatment records available.
                    </div>
                `;
            }

            return;
        }

        body.innerHTML =
            treatments.map(treatment => {

                const status =
                    String(
                        treatment.status ||
                        "planned"
                    ).toLowerCase();

                const statusClass =
                    status.replace(/_/g, "-");

                return `
                    <tr>
                        <td>
                            ${escapeHtml(
                                formatDate(
                                    treatment.treatment_date ||
                                    treatment.date
                                )
                            )}
                        </td>

                        <td>
                            ${escapeHtml(
                                treatment.treatment_name ||
                                treatment.name ||
                                "—"
                            )}
                        </td>

                        <td>
                            ${escapeHtml(
                                treatment.tooth_number ||
                                treatment.tooth ||
                                "—"
                            )}
                        </td>

                        <td>
                            ${escapeHtml(
                                treatment.dentist?.name ||
                                treatment.dentist_name ||
                                "—"
                            )}
                        </td>

                        <td>
                            <span class="
                                status-badge
                                status-${statusClass}
                            ">
                                ${escapeHtml(
                                    formatStatus(status)
                                )}
                            </span>
                        </td>

                        <td>
                            ${escapeHtml(
                                treatment.notes ||
                                "—"
                            )}
                        </td>

                        <td>
                            <button
                                type="button"
                                class="card-action-button"
                                data-treatment-id="${escapeHtml(
                                    treatment.id || ""
                                )}"
                                title="View treatment"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >
                                    <path
                                        d="M5 12H19M13 6L19 12L13 18"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </button>
                        </td>
                    </tr>
                `;
            }).join("");

        if (recentList) {

            recentList.innerHTML =
                treatments
                    .slice(0, 3)
                    .map(treatment => `
                        <div class="recent-treatment-item">

                            <strong>
                                ${escapeHtml(
                                    treatment.treatment_name ||
                                    treatment.name ||
                                    "Dental Treatment"
                                )}
                            </strong>

                            <p>
                                ${escapeHtml(
                                    formatDate(
                                        treatment.treatment_date ||
                                        treatment.date
                                    )
                                )}

                                ${treatment.tooth_number
                                    ? ` • Tooth ${escapeHtml(
                                        treatment.tooth_number
                                    )}`
                                    : ""}
                            </p>

                        </div>
                    `)
                    .join("");
        }
    }
    function renderAppointments(appointments) {

        const container =
            $("#appointmentList");

        const upcoming =
            $("#overviewUpcomingAppointment");

        if (!container) {
            return;
        }

        if (
            !Array.isArray(appointments) ||
            appointments.length === 0
        ) {

            container.innerHTML = `
                <div class="empty-record-message">
                    No appointment records available.
                </div>
            `;

            if (upcoming) {
                upcoming.innerHTML = `
                    <div class="empty-record-message">
                        No upcoming appointment.
                    </div>
                `;
            }

            return;
        }

        const sorted =
            [...appointments].sort(
                (a, b) =>
                    new Date(
                        b.appointment_date
                    ) -
                    new Date(
                        a.appointment_date
                    )
            );

        container.innerHTML =
            sorted.map(appointment => {

                const status =
                    String(
                        appointment.status ||
                        "pending"
                    ).toLowerCase();

                return `
                    <div class="appointment-item">

                        <div class="appointment-date">
                            <strong>
                                ${escapeHtml(
                                    formatDate(
                                        appointment.appointment_date
                                    )
                                )}
                            </strong>

                            <span>
                                ${escapeHtml(
                                    appointment.appointment_time ||
                                    "Time not specified"
                                )}
                            </span>
                        </div>

                        <div>
                            <strong>
                                ${escapeHtml(
                                    appointment.service?.name ||
                                    appointment.service_name ||
                                    "Dental Appointment"
                                )}
                            </strong>

                            <p>
                                ${escapeHtml(
                                    appointment.notes ||
                                    "No appointment notes."
                                )}
                            </p>
                        </div>

                        <span class="
                            status-badge
                            status-${status.replace(/_/g, "-")}
                        ">
                            ${escapeHtml(
                                formatStatus(status)
                            )}
                        </span>

                    </div>
                `;

            }).join("");

        const now = new Date();

        const upcomingAppointment =
            sorted
                .filter(appointment => {

                    if (!appointment.appointment_date) {
                        return false;
                    }

                    const date =
                        new Date(
                            appointment.appointment_date
                        );

                    return (
                        date >= now &&
                        ![
                            "cancelled",
                            "completed",
                            "declined"
                        ].includes(
                            String(
                                appointment.status || ""
                            ).toLowerCase()
                        )
                    );
                })
                .sort(
                    (a, b) =>
                        new Date(
                            a.appointment_date
                        ) -
                        new Date(
                            b.appointment_date
                        )
                )[0];

        if (upcoming) {

            if (!upcomingAppointment) {

                upcoming.innerHTML = `
                    <div class="empty-record-message">
                        No upcoming appointment.
                    </div>
                `;

            } else {

                upcoming.innerHTML = `
                    <div class="appointment-item">

                        <div class="appointment-date">
                            <strong>
                                ${escapeHtml(
                                    formatDate(
                                        upcomingAppointment.appointment_date
                                    )
                                )}
                            </strong>

                            <span>
                                ${escapeHtml(
                                    upcomingAppointment.appointment_time ||
                                    "Time not specified"
                                )}
                            </span>
                        </div>

                        <div>
                            <strong>
                                ${escapeHtml(
                                    upcomingAppointment.service?.name ||
                                    upcomingAppointment.service_name ||
                                    "Dental Appointment"
                                )}
                            </strong>
                        </div>

                        <span class="
                            status-badge
                            status-${String(
                                upcomingAppointment.status ||
                                "pending"
                            ).replace(/_/g, "-")}
                        ">
                            ${escapeHtml(
                                formatStatus(
                                    upcomingAppointment.status ||
                                    "pending"
                                )
                            )}
                        </span>

                    </div>
                `;
            }
        }
    }


    function renderPrescriptions(
        prescriptions
    ) {

        const container =
            $("#prescriptionList");

        if (!container) {
            return;
        }

        if (
            !Array.isArray(prescriptions) ||
            prescriptions.length === 0
        ) {

            container.innerHTML = `
                <div class="empty-record-message">
                    No prescriptions recorded.
                </div>
            `;

            return;
        }

        container.innerHTML =
            prescriptions.map(item => `
                <div class="prescription-item">

                    <div>

                        <h4>
                            ${escapeHtml(
                                item.medicine_name ||
                                item.medicine ||
                                "Medicine"
                            )}
                        </h4>

                        <p>
                            <strong>Dosage:</strong>
                            ${escapeHtml(
                                item.dosage || "—"
                            )}
                        </p>

                        <p>
                            <strong>Frequency:</strong>
                            ${escapeHtml(
                                item.frequency || "—"
                            )}
                        </p>

                        <p>
                            <strong>Duration:</strong>
                            ${escapeHtml(
                                item.duration || "—"
                            )}
                        </p>

                        <p>
                            ${escapeHtml(
                                item.instructions || ""
                            )}
                        </p>

                    </div>

                    <span class="status-badge status-completed">
                        ${escapeHtml(
                            formatDate(
                                item.prescription_date ||
                                item.date
                            )
                        )}
                    </span>

                </div>
            `)
            .join("");
    }


    function renderNotes(notes) {

        const container =
            $("#notesList");

        if (!container) {
            return;
        }

        if (
            !Array.isArray(notes) ||
            notes.length === 0
        ) {

            container.innerHTML = `
                <div class="empty-record-message">
                    No dentist notes recorded.
                </div>
            `;

            return;
        }

        container.innerHTML =
            notes.map(note => `
                <div class="note-item">

                    <h4>
                        ${escapeHtml(
                            note.title ||
                            "Clinical Note"
                        )}
                    </h4>

                    <p>
                        ${escapeHtml(
                            note.note ||
                            note.content ||
                            "No content."
                        )}
                    </p>

                    <p>
                        <strong>
                            ${escapeHtml(
                                note.dentist?.name ||
                                note.dentist_name ||
                                "Dentist"
                            )}
                        </strong>

                        •

                        ${escapeHtml(
                            formatDate(
                                note.created_at ||
                                note.date
                            )
                        )}
                    </p>

                </div>
            `)
            .join("");
    }


    function renderOdontogram(
        conditions
    ) {

        const teeth =
            $$(".odontogram-tooth");

        const map = {};

        if (Array.isArray(conditions)) {

            conditions.forEach(item => {

                const toothNumber =
                    item.tooth_number ||
                    item.tooth;

                if (!toothNumber) {
                    return;
                }

                map[String(toothNumber)] =
                    item;
            });
        }

        teeth.forEach(tooth => {

            const number =
                tooth.dataset.tooth;

            const item =
                map[number];

            const condition =
                item?.condition ||
                "healthy";

            tooth.dataset.condition =
                condition;

            tooth.classList.remove(
                "selected"
            );

            tooth.classList.remove(
                "condition-healthy",
                "condition-caries",
                "condition-filled",
                "condition-missing",
                "condition-crown",
                "condition-root-canal",
                "condition-extraction",
                "condition-fractured"
            );

            tooth.classList.add(
                `condition-${String(condition)
                    .toLowerCase()
                    .replace(/\s+/g, "-")}`
            );
        });

        renderToothSummary(map);
    }


    function renderToothSummary(
        conditionMap
    ) {

        const list =
            $("#toothConditionList");

        const count =
            $("#odontogramToothCount");

        if (!list) {
            return;
        }

        const entries =
            Object.entries(conditionMap);

        if (count) {
            count.textContent =
                `${entries.length} ${
                    entries.length === 1
                        ? "tooth"
                        : "teeth"
                }`;
        }

        if (!entries.length) {

            list.innerHTML = `
                <div class="empty-record-message">
                    No tooth conditions recorded.
                </div>
            `;

            return;
        }

        list.innerHTML =
            entries.map(
                ([tooth, item]) => `
                    <div class="tooth-condition-item">

                        <strong>
                            Tooth ${escapeHtml(tooth)}
                        </strong>

                        <span>
                            ${escapeHtml(
                                formatStatus(
                                    item.condition
                                )
                            )}
                        </span>

                        ${
                            item.remarks
                                ? `
                                    <small>
                                        ${escapeHtml(
                                            item.remarks
                                        )}
                                    </small>
                                `
                                : ""
                        }

                    </div>
                `
            ).join("");
    }


    function activateTab(tabName) {

        const tabs =
            $$(".record-tab");

        const contents =
            $$(".record-tab-content");

        tabs.forEach(tab => {

            const active =
                tab.dataset.tab === tabName;

            tab.classList.toggle(
                "active",
                active
            );

            tab.setAttribute(
                "aria-selected",
                active ? "true" : "false"
            );
        });

        contents.forEach(content => {

            const active =
                content.id ===
                `tab-${tabName}`;

            content.hidden =
                !active;

            content.classList.toggle(
                "active",
                active
            );
        });
    }


    $$(".record-tab").forEach(tab => {

        tab.addEventListener(
            "click",
            () => {

                const tabName =
                    tab.dataset.tab;

                if (tabName) {
                    activateTab(
                        tabName
                    );
                }
            }
        );
    });


    $$("[data-tab-target]").forEach(
        button => {

            button.addEventListener(
                "click",
                () => {

                    const target =
                        button.dataset.tabTarget;

                    if (target) {
                        activateTab(
                            target
                        );
                    }
                }
            );
        }
    );


    $$(".view-patient-button").forEach(
        button => {

            button.addEventListener(
                "click",
                event => {

                    event.preventDefault();

                    const patientId =
                        button.dataset.patientId;

                    if (patientId) {
                        loadPatient(
                            patientId
                        );
                    }
                }
            );
        }
    );


    $$(".patient-row").forEach(row => {

        row.addEventListener(
            "dblclick",
            () => {

                const id =
                    row.dataset.patientId;

                if (id) {
                    loadPatient(id);
                }
            }
        );
    });


    if (backToPatients) {

        backToPatients.addEventListener(
            "click",
            showPatientList
        );
    }


    let searchTimer = null;

    function applyPatientFilters() {

        const search =
            patientSearch?.value
                .trim()
                .toLowerCase() || "";

        const status =
            patientStatus?.value
                .trim()
                .toLowerCase() || "";

        $$(".patient-row").forEach(row => {

            const text =
                row.textContent
                    .toLowerCase();

            const rowStatus =
                row.querySelector(
                    ".status-badge"
                )?.textContent
                    .trim()
                    .toLowerCase() || "";

            const matchesSearch =
                !search ||
                text.includes(search);

            const matchesStatus =
                !status ||
                rowStatus.includes(status);

            row.style.display =
                matchesSearch &&
                matchesStatus
                    ? ""
                    : "none";
        });
    }


    if (patientSearch) {

        patientSearch.addEventListener(
            "input",
            () => {

                clearTimeout(
                    searchTimer
                );

                searchTimer =
                    setTimeout(
                        applyPatientFilters,
                        150
                    );
            }
        );
    }


    if (patientStatus) {

        patientStatus.addEventListener(
            "change",
            applyPatientFilters
        );
    }


    if (resetFilters) {

        resetFilters.addEventListener(
            "click",
            () => {

                if (patientSearch) {
                    patientSearch.value = "";
                }

                if (patientStatus) {
                    patientStatus.value = "";
                }

                applyPatientFilters();

                const url =
                    new URL(
                        window.location.href
                    );

                url.search = "";

                window.history.replaceState(
                    {},
                    "",
                    url
                );
            }
        );
    }


    const sidebar =
        $("#sidebar");

    const mobileMenuButton =
        $("#mobileMenuButton");

    const sidebarClose =
        $("#sidebarClose");

    let sidebarOverlay =
        $(".sidebar-mobile-overlay");

    if (!sidebarOverlay) {

        sidebarOverlay =
            document.createElement("div");

        sidebarOverlay.className =
            "sidebar-mobile-overlay";

        document.body.appendChild(
            sidebarOverlay
        );
    }


    function openSidebar() {

        sidebar?.classList.add(
            "open"
        );

        sidebarOverlay?.classList.add(
            "show"
        );

        document.body.classList.add(
            "sidebar-open"
        );
    }


    function closeSidebar() {

        sidebar?.classList.remove(
            "open"
        );

        sidebarOverlay?.classList.remove(
            "show"
        );

        document.body.classList.remove(
            "sidebar-open"
        );
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


    function openModal(id) {

        const modal =
            document.getElementById(id);

        if (!modal) {
            return;
        }

        modal.hidden = false;

        modal.classList.add("open");

        document.body.style.overflow =
            "hidden";

        const firstInput =
            modal.querySelector(
                "input:not([type='hidden']), select, textarea"
            );

        if (firstInput) {

            setTimeout(
                () => firstInput.focus(),
                100
            );
        }
    }


    function closeModal(modal) {

        if (!modal) {
            return;
        }

        modal.hidden = true;

        modal.classList.remove("open");

        const anyOpenModal =
            $(".modal:not([hidden])");

        if (!anyOpenModal) {
            document.body.style.overflow =
                "";
        }
    }


    $$("[data-close-modal]").forEach(
        element => {

            element.addEventListener(
                "click",
                () => {

                    const modal =
                        element.closest(
                            ".modal"
                        );

                    closeModal(modal);
                }
            );
        }
    );


    document.addEventListener(
        "click",
        event => {

            const closeButton =
                event.target.closest(
                    "[data-close-modal]"
                );

            if (!closeButton) {
                return;
            }

            const modal =
                closeButton.closest(
                    ".modal"
                );

            closeModal(modal);
        }
    );


    document.addEventListener(
        "keydown",
        event => {

            if (event.key !== "Escape") {
                return;
            }

            const modal =
                $(".modal:not([hidden])");

            if (modal) {
                closeModal(modal);
                return;
            }

            closeSidebar();
        }
    );
        const editPatientButton =
        $("#editPatientButton");

    const editPatientForm =
        $("#editPatientForm");

    function fillEditPatientForm(
        patient
    ) {

        if (!patient) {
            return;
        }

        const user =
            patient.user || {};

        const patientIdInput =
            $("#editPatientId");

        const patientNameInput =
            $("#editPatientName");

        const patientAgeInput =
            $("#editPatientAge");

        const patientSexInput =
            $("#editPatientSex");

        const civilStatusInput =
            $("#editCivilStatus");

        const phoneInput =
            $("#editPhone");

        const occupationInput =
            $("#editOccupation");

        const addressInput =
            $("#editAddress");

        if (patientIdInput) {
            patientIdInput.value =
                patient.id || "";
        }

        if (patientNameInput) {
            patientNameInput.value =
                patient.patient_name ||
                patient.name ||
                user.name ||
                "";
        }

        if (patientAgeInput) {
            patientAgeInput.value =
                patient.age || "";
        }

        if (patientSexInput) {
            patientSexInput.value =
                patient.sex || "";
        }

        if (civilStatusInput) {
            civilStatusInput.value =
                patient.civil_status || "";
        }

        if (phoneInput) {
            phoneInput.value =
                patient.tel_no ||
                patient.phone ||
                "";
        }

        if (occupationInput) {
            occupationInput.value =
                patient.occupation ||
                "";
        }

        if (addressInput) {
            addressInput.value =
                patient.address ||
                "";
        }
    }

    editPatientButton?.addEventListener(
        "click",
        () => {

            if (!currentPatient) {

                showToast(
                    "Please open a patient record first.",
                    "error"
                );

                return;
            }

            fillEditPatientForm(
                currentPatient
            );

            openModal(
                "editPatientModal"
            );
        }
    );

    editPatientForm?.addEventListener(
        "submit",
        async event => {

            event.preventDefault();

            const patientId =
                $("#editPatientId")?.value;

            if (!patientId) {

                showToast(
                    "Patient ID is missing.",
                    "error"
                );

                return;
            }

            const formData =
                new FormData(
                    editPatientForm
                );

            formData.append(
                "_method",
                "PUT"
            );

            showLoading(
                "Saving patient record..."
            );

            try {

                const result =
                    await apiRequest(
                        patientUrl(patientId),
                        {
                            method: "POST",
                            body: formData
                        }
                    );

                currentPatient =
                    result?.patient ||
                    result?.data ||
                    result;

                renderPatientRecord(
                    currentPatient
                );

                closeModal(
                    $("#editPatientModal")
                );

                showToast(
                    "Patient record updated successfully.",
                    "success"
                );

            } catch (error) {

                console.error(
                    "Update patient error:",
                    error
                );

                showToast(
                    error.message ||
                    "Unable to update patient.",
                    "error"
                );

            } finally {

                hideLoading();
            }
        }
    );


    $("#addTreatmentButton")
        ?.addEventListener(
            "click",
            () => {

                if (!currentPatientId) {

                    showToast(
                        "Please select a patient first.",
                        "error"
                    );

                    return;
                }

                const patientIdInput =
                    $("#treatmentPatientId");

                if (patientIdInput) {
                    patientIdInput.value =
                        currentPatientId;
                }

                const date =
                    $("#treatmentDate");

                if (
                    date &&
                    !date.value
                ) {

                    date.value =
                        new Date()
                            .toISOString()
                            .split("T")[0];
                }

                openModal(
                    "treatmentModal"
                );
            }
        );


    const treatmentForm =
        $("#treatmentForm");

    treatmentForm?.addEventListener(
        "submit",
        async event => {

            event.preventDefault();

            const patientId =
                $("#treatmentPatientId")?.value;

            if (!patientId) {

                showToast(
                    "Patient ID is missing.",
                    "error"
                );

                return;
            }

            const formData =
                new FormData(
                    treatmentForm
                );

            showLoading(
                "Saving treatment..."
            );

            try {

                const url =
                    config.routes?.treatments
                        ? `${config.routes.treatments}/${patientId}/treatments`
                        : `${patientUrl(patientId)}/treatments`;

                await apiRequest(
                    url,
                    {
                        method: "POST",
                        body: formData
                    }
                );

                closeModal(
                    $("#treatmentModal")
                );

                treatmentForm.reset();

                showToast(
                    "Treatment saved successfully.",
                    "success"
                );

                await loadPatient(
                    patientId
                );

            } catch (error) {

                console.error(
                    "Save treatment error:",
                    error
                );

                showToast(
                    error.message ||
                    "Unable to save treatment.",
                    "error"
                );

            } finally {

                hideLoading();
            }
        }
    );


    $("#addPrescriptionButton")
        ?.addEventListener(
            "click",
            () => {

                if (!currentPatientId) {

                    showToast(
                        "Please select a patient first.",
                        "error"
                    );

                    return;
                }

                const patientIdInput =
                    $("#prescriptionPatientId");

                if (patientIdInput) {
                    patientIdInput.value =
                        currentPatientId;
                }

                const date =
                    $("#prescriptionDate");

                if (
                    date &&
                    !date.value
                ) {

                    date.value =
                        new Date()
                            .toISOString()
                            .split("T")[0];
                }

                openModal(
                    "prescriptionModal"
                );
            }
        );


    const prescriptionForm =
        $("#prescriptionForm");

    prescriptionForm?.addEventListener(
        "submit",
        async event => {

            event.preventDefault();

            const patientId =
                $("#prescriptionPatientId")?.value;

            if (!patientId) {

                showToast(
                    "Patient ID is missing.",
                    "error"
                );

                return;
            }

            const formData =
                new FormData(
                    prescriptionForm
                );

            showLoading(
                "Saving prescription..."
            );

            try {

                const url =
                    config.routes?.prescriptions
                        ? `${config.routes.prescriptions}/${patientId}/prescriptions`
                        : `${patientUrl(patientId)}/prescriptions`;

                await apiRequest(
                    url,
                    {
                        method: "POST",
                        body: formData
                    }
                );

                closeModal(
                    $("#prescriptionModal")
                );

                prescriptionForm.reset();

                showToast(
                    "Prescription saved successfully.",
                    "success"
                );

                await loadPatient(
                    patientId
                );

            } catch (error) {

                console.error(
                    "Save prescription error:",
                    error
                );

                showToast(
                    error.message ||
                    "Unable to save prescription.",
                    "error"
                );

            } finally {

                hideLoading();
            }
        }
    );


    $("#addNoteButton")
        ?.addEventListener(
            "click",
            () => {

                if (!currentPatientId) {

                    showToast(
                        "Please select a patient first.",
                        "error"
                    );

                    return;
                }

                const patientIdInput =
                    $("#notePatientId");

                if (patientIdInput) {
                    patientIdInput.value =
                        currentPatientId;
                }

                openModal(
                    "noteModal"
                );
            }
        );


    const noteForm =
        $("#noteForm");

    noteForm?.addEventListener(
        "submit",
        async event => {

            event.preventDefault();

            const patientId =
                $("#notePatientId")?.value;

            if (!patientId) {

                showToast(
                    "Patient ID is missing.",
                    "error"
                );

                return;
            }

            const formData =
                new FormData(
                    noteForm
                );

            showLoading(
                "Saving dentist note..."
            );

            try {

                const url =
                    config.routes?.notes
                        ? `${config.routes.notes}/${patientId}/notes`
                        : `${patientUrl(patientId)}/notes`;

                await apiRequest(
                    url,
                    {
                        method: "POST",
                        body: formData
                    }
                );

                closeModal(
                    $("#noteModal")
                );

                noteForm.reset();

                showToast(
                    "Dentist note saved successfully.",
                    "success"
                );

                await loadPatient(
                    patientId
                );

            } catch (error) {

                console.error(
                    "Save note error:",
                    error
                );

                showToast(
                    error.message ||
                    "Unable to save note.",
                    "error"
                );

            } finally {

                hideLoading();
            }
        }
    );


    $$(".odontogram-tooth").forEach(
        tooth => {

            tooth.addEventListener(
                "click",
                () => {

                    if (!currentPatientId) {

                        showToast(
                            "Please select a patient first.",
                            "error"
                        );

                        return;
                    }

                    selectedTooth =
                        tooth.dataset.tooth;

                    const selectedToothNumber =
                        $("#selectedToothNumber");

                    const selectedToothInput =
                        $("#selectedToothInput");

                    const odontogramPatientId =
                        $("#odontogramPatientId");

                    const toothCondition =
                        $("#toothCondition");

                    if (selectedToothNumber) {
                        selectedToothNumber.textContent =
                            selectedTooth;
                    }

                    if (selectedToothInput) {
                        selectedToothInput.value =
                            selectedTooth;
                    }

                    if (odontogramPatientId) {
                        odontogramPatientId.value =
                            currentPatientId;
                    }

                    if (toothCondition) {
                        toothCondition.value =
                            tooth.dataset.condition ||
                            "healthy";
                    }

                    $$(".odontogram-tooth")
                        .forEach(item => {
                            item.classList.remove(
                                "selected"
                            );
                        });

                    tooth.classList.add(
                        "selected"
                    );

                    openModal(
                        "toothConditionModal"
                    );
                }
            );
        }
    );


    const toothConditionForm =
        $("#toothConditionForm");

    toothConditionForm?.addEventListener(
        "submit",
        async event => {

            event.preventDefault();

            if (!currentPatientId) {

                showToast(
                    "Please select a patient first.",
                    "error"
                );

                return;
            }

            const formData =
                new FormData(
                    toothConditionForm
                );

            showLoading(
                "Saving tooth condition..."
            );

            try {

                const url =
                    config.routes?.odontogram
                        ? `${config.routes.odontogram}/${currentPatientId}/odontogram`
                        : `${patientUrl(currentPatientId)}/odontogram`;

                await apiRequest(
                    url,
                    {
                        method: "POST",
                        body: formData
                    }
                );

                closeModal(
                    $("#toothConditionModal")
                );

                showToast(
                    "Tooth condition saved successfully.",
                    "success"
                );

                const patientId =
                    currentPatientId;

                await loadPatient(
                    patientId
                );

                activateTab(
                    "dental-chart"
                );

            } catch (error) {

                console.error(
                    "Save tooth condition error:",
                    error
                );

                showToast(
                    error.message ||
                    "Unable to save tooth condition.",
                    "error"
                );

            } finally {

                hideLoading();
            }
        }
    );


    $("#editOdontogramButton")
        ?.addEventListener(
            "click",
            () => {

                activateTab(
                    "dental-chart"
                );

                showToast(
                    "Click a tooth to update its condition.",
                    "info"
                );
            }
        );


    $$(
        '[data-action="edit-personal"]'
    ).forEach(button => {

        button.addEventListener(
            "click",
            () => {

                if (editPatientButton) {
                    editPatientButton.click();
                }
            }
        );
    });


    $$(
        '[data-action="edit-medical-history"]'
    ).forEach(button => {

        button.addEventListener(
            "click",
            () => {

                showToast(
                    "Medical history editing can be connected to your medical-history endpoint.",
                    "info"
                );
            }
        );
    });


    $("#printPatientRecord")
        ?.addEventListener(
            "click",
            () => {

                if (!currentPatientId) {

                    showToast(
                        "Please open a patient record first.",
                        "error"
                    );

                    return;
                }

                window.print();
            }
        );


    $("#addPatientButton")
        ?.addEventListener(
            "click",
            () => {

                showToast(
                    "Connect this button to your patient registration route.",
                    "info"
                );
            }
        );


    $("#notificationButton")
        ?.addEventListener(
            "click",
            () => {

                showToast(
                    "No new notifications.",
                    "info"
                );
            }
        );


    activateTab(
        "overview"
    );


    const pathParts =
        window.location.pathname
            .split("/")
            .filter(Boolean);

    const patientRecordIndex =
        pathParts.indexOf(
            "patient-records"
        );

    if (
        patientRecordIndex !== -1 &&
        pathParts[
            patientRecordIndex + 1
        ]
    ) {

        const possibleId =
            pathParts[
                patientRecordIndex + 1
            ];

        if (
            /^\d+$/.test(
                possibleId
            )
        ) {

            loadPatient(
                possibleId
            );
        }
    }

});


function initializeLogoutModal() {

    const logoutButton =
        document.getElementById(
            "logoutButton"
        );

    const logoutModal =
        document.getElementById(
            "logoutModal"
        );

    const cancelLogout =
        document.getElementById(
            "cancelLogout"
        );

    const confirmLogout =
        document.getElementById(
            "confirmLogout"
        );

    const logoutOverlay =
        document.querySelector(
            ".logout-modal-overlay"
        );

    if (
        !logoutButton ||
        !logoutModal
    ) {
        return;
    }

    const logoutForm =
        logoutButton.closest("form");


    function openLogoutModal() {

        logoutModal.classList.remove(
            "hidden"
        );
    }


    function closeLogoutModal() {

        logoutModal.classList.add(
            "hidden"
        );
    }


    logoutButton.addEventListener(
        "click",
        function (event) {

            event.preventDefault();

            openLogoutModal();
        }
    );


    if (cancelLogout) {

        cancelLogout.addEventListener(
            "click",
            function () {

                closeLogoutModal();
            }
        );
    }


    if (logoutOverlay) {

        logoutOverlay.addEventListener(
            "click",
            function (event) {

                if (
                    event.target ===
                    logoutOverlay
                ) {

                    closeLogoutModal();
                }
            }
        );
    }


    if (confirmLogout) {

        confirmLogout.addEventListener(
            "click",
            function () {

                if (logoutForm) {
                    logoutForm.submit();
                }
            }
        );
    }


    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key ===
                "Escape"
            ) {

                closeLogoutModal();
            }
        }
    );
}


document.addEventListener(
    "DOMContentLoaded",
    function () {

        initializeLogoutModal();
    }
);
