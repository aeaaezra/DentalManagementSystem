/* ============================================================
   DENTIST DASHBOARD JAVASCRIPT
   Shine & Smile Dental Clinic
============================================================ */

document.addEventListener("DOMContentLoaded", () => {

    const sidebar =
        document.getElementById("sidebar");

    const mobileMenuButton =
        document.getElementById("mobileMenuButton");

    const sidebarClose =
        document.getElementById("sidebarClose");

    const notificationButton =
        document.getElementById("notificationButton");


    /* ========================================================
       MOBILE SIDEBAR
    ======================================================== */

    let sidebarOverlay =
        document.querySelector(".sidebar-overlay");


    if (!sidebarOverlay) {

        sidebarOverlay =
            document.createElement("div");

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

        sidebar.classList.add("open");

        sidebarOverlay.classList.add(
            "active"
        );

        document.body.style.overflow =
            "hidden";
    }


    function closeSidebar() {

        if (!sidebar) {
            return;
        }

        sidebar.classList.remove("open");

        sidebarOverlay.classList.remove(
            "active"
        );

        document.body.style.overflow =
            "";
    }


    if (mobileMenuButton) {

        mobileMenuButton.addEventListener(
            "click",
            openSidebar
        );

    }


    if (sidebarClose) {

        sidebarClose.addEventListener(
            "click",
            closeSidebar
        );

    }


    sidebarOverlay.addEventListener(
        "click",
        closeSidebar
    );


    /* ========================================================
       CLOSE SIDEBAR WHEN NAVIGATION ITEM IS CLICKED
    ======================================================== */

    const navigationItems =
        document.querySelectorAll(
            ".navigation-item"
        );


    navigationItems.forEach((item) => {

        item.addEventListener(
            "click",
            () => {

                if (
                    window.innerWidth <= 900
                ) {

                    closeSidebar();

                }

            }
        );

    });


    /* ========================================================
       ESCAPE KEY
    ======================================================== */

    document.addEventListener(
        "keydown",
        (event) => {

            if (event.key === "Escape") {

                closeSidebar();

            }

        }
    );


    /* ========================================================
       RESPONSIVE SIDEBAR RESET
    ======================================================== */

    window.addEventListener(
        "resize",
        () => {

            if (window.innerWidth > 900) {

                closeSidebar();

            }

        }
    );


    /* ========================================================
       NOTIFICATION BUTTON
    ======================================================== */

    if (notificationButton) {

        notificationButton.addEventListener(
            "click",
            () => {

                showDashboardToast(
                    "Notifications",
                    "Your notifications will appear here."
                );

            }
        );

    }


    /* ========================================================
       STAT CARD ANIMATION
    ======================================================== */

    const statNumbers =
        document.querySelectorAll(
            ".stat-number"
        );


    statNumbers.forEach((element) => {

        const target =
            parseInt(
                element.textContent.trim(),
                10
            );


        if (
            Number.isNaN(target) ||
            target < 0
        ) {

            return;

        }


        animateNumber(
            element,
            target
        );

    });


    /* ========================================================
       APPOINTMENT HOVER
    ======================================================== */

    const appointmentItems =
        document.querySelectorAll(
            ".dashboard-appointment"
        );


    appointmentItems.forEach((item) => {

        item.addEventListener(
            "mouseenter",
            () => {

                item.style.background =
                    "#fffafd";

            }
        );


        item.addEventListener(
            "mouseleave",
            () => {

                item.style.background =
                    "";

            }
        );

    });


    /* ========================================================
       QUICK ACTION KEYBOARD SUPPORT
    ======================================================== */

    const quickActions =
        document.querySelectorAll(
            ".quick-action"
        );


    quickActions.forEach((action) => {

        action.addEventListener(
            "keydown",
            (event) => {

                if (
                    event.key === "Enter" ||
                    event.key === " "
                ) {

                    event.preventDefault();

                    action.click();

                }

            }
        );

    });


    /* ========================================================
       PROGRESS BAR ANIMATION
    ======================================================== */

    const progressFill =
        document.querySelector(
            ".progress-fill"
        );


    if (progressFill) {

        const targetWidth =
            progressFill.style.width;


        progressFill.style.width =
            "0%";


        requestAnimationFrame(() => {

            setTimeout(() => {

                progressFill.style.width =
                    targetWidth;

            }, 150);

        });

    }


    /* ========================================================
       DATE DISPLAY
    ======================================================== */

    const dashboardDate =
        document.querySelector(
            ".dashboard-date"
        );


    if (dashboardDate) {

        dashboardDate.setAttribute(
            "title",
            "Today's date"
        );

    }


    /* ========================================================
       INITIALIZE
    ======================================================== */

    console.log(
        "Dentist Dashboard initialized."
    );

});


/* ============================================================
   NUMBER ANIMATION
============================================================ */

function animateNumber(
    element,
    target
) {

    const duration = 650;

    const startTime =
        performance.now();


    function updateNumber(
        currentTime
    ) {

        const elapsed =
            currentTime - startTime;


        const progress =
            Math.min(
                elapsed / duration,
                1
            );


        const eased =
            1 -
            Math.pow(
                1 - progress,
                3
            );


        const currentValue =
            Math.floor(
                target * eased
            );


        element.textContent =
            currentValue;


        if (progress < 1) {

            requestAnimationFrame(
                updateNumber
            );

        } else {

            element.textContent =
                target;

        }

    }


    requestAnimationFrame(
        updateNumber
    );

}


/* ============================================================
   DASHBOARD TOAST
============================================================ */

function showDashboardToast(
    title,
    message
) {

    let container =
        document.querySelector(
            ".dashboard-toast-container"
        );


    if (!container) {

        container =
            document.createElement(
                "div"
            );

        container.className =
            "dashboard-toast-container";


        container.style.position =
            "fixed";

        container.style.right =
            "20px";

        container.style.bottom =
            "20px";

        container.style.zIndex =
            "9999";


        document.body.appendChild(
            container
        );

    }


    const toast =
        document.createElement(
            "div"
        );


    toast.style.minWidth =
        "260px";

    toast.style.padding =
        "14px 16px";

    toast.style.marginTop =
        "10px";

    toast.style.border =
        "1px solid #e5e7eb";

    toast.style.borderRadius =
        "12px";

    toast.style.background =
        "#ffffff";

    toast.style.boxShadow =
        "0 8px 25px rgba(0,0,0,.10)";

    toast.style.fontFamily =
        "Inter, sans-serif";


    const titleElement =
        document.createElement(
            "strong"
        );


    titleElement.textContent =
        title;

    titleElement.style.display =
        "block";

    titleElement.style.fontSize =
        "12px";


    const messageElement =
        document.createElement(
            "span"
        );


    messageElement.textContent =
        message;

    messageElement.style.display =
        "block";

    messageElement.style.marginTop =
        "4px";

    messageElement.style.fontSize =
        "10px";

    messageElement.style.color =
        "#6b7280";


    toast.appendChild(
        titleElement
    );

    toast.appendChild(
        messageElement
    );


    container.appendChild(
        toast
    );


    setTimeout(() => {

        toast.style.opacity =
            "0";

        toast.style.transform =
            "translateY(8px)";

        toast.style.transition =
            "all .25s ease";


        setTimeout(() => {

            toast.remove();

        }, 250);

    }, 3000);

}


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



/* Patient details modal: fetch and safely render the existing JSON endpoint. */
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("patientDetailsModal");
    const content = document.getElementById("patientDetailsContent");
    const title = document.getElementById("patientDetailsTitle");
    const subtitle = document.getElementById("patientDetailsSubtitle");

    if (!modal || !content) return;

    const text = (value) => {
        if (value === null || value === undefined || value === "") return "Not provided";
        if (typeof value === "boolean") return value ? "Yes" : "No";
        if (typeof value === "object") return "Details available";
        return String(value);
    };

    const addField = (grid, label, value) => {
        const field = document.createElement("div");
        field.className = "patient-details-field";
        const caption = document.createElement("span");
        caption.textContent = label;
        const valueNode = document.createElement("strong");
        valueNode.textContent = text(value);
        field.append(caption, valueNode);
        grid.appendChild(field);
    };

    const addSection = (heading, fields) => {
        const section = document.createElement("section");
        section.className = "patient-details-section";
        const h3 = document.createElement("h3");
        h3.textContent = heading;
        section.appendChild(h3);

        const grid = document.createElement("div");
        grid.className = "patient-details-grid";
        fields.forEach(([label, value]) => addField(grid, label, value));
        section.appendChild(grid);
        content.appendChild(section);
    };

    const formatDate = (value) => {
        if (!value) return "Not available";
        const date = new Date(value);
        return Number.isNaN(date.getTime())
            ? text(value)
            : date.toLocaleString(undefined, {
                year: "numeric", month: "short", day: "numeric"
            });
    };

    const addEntries = (heading, entries, getFields) => {
        const section = document.createElement("section");
        section.className = "patient-details-section";
        const h3 = document.createElement("h3");
        h3.textContent = heading;
        section.appendChild(h3);

        const list = document.createElement("div");
        list.className = "patient-details-list";

        if (!Array.isArray(entries) || entries.length === 0) {
            const empty = document.createElement("p");
            empty.className = "patient-details-muted";
            empty.textContent = "No records available.";
            list.appendChild(empty);
        } else {
            entries.forEach((entry) => {
                const card = document.createElement("div");
                card.className = "patient-details-entry";
                getFields(entry).forEach(([label, value]) => {
                    const p = document.createElement("p");
                    const strong = document.createElement("strong");
                    strong.textContent = label + ": ";
                    p.append(strong, document.createTextNode(text(value)));
                    card.appendChild(p);
                });
                list.appendChild(card);
            });
        }

        section.appendChild(list);
        content.appendChild(section);
    };

    const closeModal = () => {
        modal.classList.remove("is-open");
        modal.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    };

    modal.querySelectorAll("[data-patient-modal-close]").forEach((button) => {
        button.addEventListener("click", closeModal);
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && modal.classList.contains("is-open")) {
            closeModal();
        }
    });

    document.querySelectorAll(".patient-view-button[data-patient-url]").forEach((button) => {
        button.addEventListener("click", async () => {
            modal.classList.add("is-open");
            modal.setAttribute("aria-hidden", "false");
            document.body.style.overflow = "hidden";
            title.textContent = "Patient Details";
            subtitle.textContent = "Loading patient record...";
            content.replaceChildren();
            const loading = document.createElement("p");
            loading.textContent = "Loading patient record...";
            content.appendChild(loading);

            try {
                const response = await fetch(button.dataset.patientUrl, {
                    headers: { "Accept": "application/json" },
                    credentials: "same-origin"
                });
                if (!response.ok) throw new Error("Unable to load patient record (HTTP " + response.status + ").");

                const result = await response.json();
                if (!result.success || !result.patient) {
                    throw new Error("The server returned an unexpected patient record.");
                }

                const p = result.patient;
                content.replaceChildren();
                title.textContent = text(p.patient_name);
                subtitle.textContent = "Patient ID: " + text(p.id);

                addSection("Personal Information", [
                    ["Patient ID", p.id], ["Full Name", p.patient_name],
                    ["Age", p.age], ["Sex", p.sex],
                    ["Civil Status", p.civil_status], ["Phone", p.tel_no],
                    ["Email", p.email], ["Occupation", p.occupation],
                    ["Address", p.address], ["Record Created", formatDate(p.created_at)]
                ]);

                addSection("Medical History", [
                    ["Heart Condition", p.heart_condition],
                    ["Heart Condition Details", p.heart_condition_details],
                    ["Allergy", p.allergy], ["Allergy Details", p.allergy_details],
                    ["Diabetes", p.diabetes], ["Diabetes Details", p.diabetes_details],
                    ["Hypertension", p.hypertension],
                    ["Hypertension Details", p.hypertension_details],
                    ["Bleeding Tendency", p.bleeding_tendency],
                    ["Bleeding Details", p.bleeding_tendency_details],
                    ["Asthma", p.asthma], ["Asthma Details", p.asthma_details],
                    ["Other Conditions", p.other_conditions]
                ]);

                addSection("Recent and Upcoming Visits", [
                    ["Last Visit", p.last_visit ? formatDate(p.last_visit.date) : "None recorded"],
                    ["Last Visit Status", p.last_visit?.status],
                    ["Upcoming Appointment", p.upcoming_appointment ? formatDate(p.upcoming_appointment.date) : "None scheduled"],
                    ["Upcoming Time", p.upcoming_appointment?.time],
                    ["Upcoming Status", p.upcoming_appointment?.status]
                ]);

                addEntries("Appointments", p.appointments, (a) => [
                    ["Date", formatDate(a.appointment_date)],
                    ["Time", a.appointment_time],
                    ["Status", a.status],
                    ["Service", a.service_name || a.service || a.service_type]
                ]);

                addEntries("Odontograms", p.odontograms, (o) => [
                    ["Record ID", o.id],
                    ["Date", formatDate(o.created_at || o.updated_at)],
                    ["Notes", o.notes || o.description],
                    ["Status", o.status]
                ]);
            } catch (error) {
                content.replaceChildren();
                const message = document.createElement("p");
                message.className = "patient-details-error";
                message.textContent = error.message || "Could not load patient details. Please try again.";
                content.appendChild(message);
                subtitle.textContent = "Unable to load record";
            }
        });
    });
});
