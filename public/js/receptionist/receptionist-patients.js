document.addEventListener("DOMContentLoaded", () => {

    const patientModal =
        document.getElementById("patientModal");

    const addPatientModal =
        document.getElementById("addPatientModal");

    const openAddPatient =
        document.getElementById("openAddPatient");


    /* ======================================================
       ADD PATIENT MODAL
    ======================================================= */

    if (openAddPatient) {

        openAddPatient.addEventListener("click", () => {

            addPatientModal.classList.remove("hidden");

            document.body.style.overflow = "hidden";

        });

    }


    /* ======================================================
       CLOSE ADD PATIENT MODAL
    ======================================================= */

    document.querySelectorAll("[data-close-add]")
        .forEach(button => {

            button.addEventListener("click", () => {

                addPatientModal.classList.add("hidden");

                document.body.style.overflow = "";

            });

        });


    /* ======================================================
       VIEW PATIENT
    ======================================================= */

    document.querySelectorAll(".btn-view")
        .forEach(button => {

            button.addEventListener("click", async () => {

                const patientId =
                    button.dataset.patientId;

                await loadPatient(patientId);

            });

        });


    /* ======================================================
       LOAD PATIENT
    ======================================================= */

    async function loadPatient(patientId) {

        const history =
            document.getElementById(
                "appointmentHistory"
            );

        history.innerHTML = `
            <div class="loading">
                Loading patient information...
            </div>
        `;

        patientModal.classList.remove("hidden");

        document.body.style.overflow = "hidden";


        try {

            const response =
                await fetch(
                    `/receptionist/patients/${patientId}`,
                    {
                        method: "GET",

                        headers: {
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    }
                );


            if (!response.ok) {

                throw new Error(
                    "Unable to load patient."
                );

            }


            const data =
                await response.json();


            if (!data.success) {

                throw new Error(
                    "Patient information unavailable."
                );

            }


            const patient =
                data.patient;


            const appointments =
                data.appointments;


            /* ==================================================
               PATIENT INFORMATION
            =================================================== */

            document.getElementById(
                "modalPatientName"
            ).textContent = patient.name;


            document.getElementById(
                "modalSummaryName"
            ).textContent = patient.name;


            document.getElementById(
                "modalPatientId"
            ).textContent =
                `Patient ID: PT-${String(patient.id).padStart(5, "0")}`;


            document.getElementById(
                "modalInitials"
            ).textContent =
                getInitials(patient.name);


            /* ==================================================
               APPOINTMENT HISTORY
            =================================================== */

            if (!appointments.length) {

                history.innerHTML = `
                    <div class="loading">
                        No appointment history found.
                    </div>
                `;

                return;

            }


            history.innerHTML =
                appointments
                    .map(appointment => {

                        return `
                            <div class="history-item">

                                <div>

                                    <div class="history-service">
                                        ${escapeHtml(
                                            appointment.service
                                        )}
                                    </div>

                                    <div class="history-date">
                                        ${escapeHtml(
                                            appointment.date
                                        )}
                                        •
                                        ${escapeHtml(
                                            appointment.time
                                        )}
                                    </div>

                                </div>

                                <span class="history-status">
                                    ${escapeHtml(
                                        appointment.status
                                    )}
                                </span>

                            </div>
                        `;

                    })
                    .join("");

        }

        catch (error) {

            console.error(error);

            history.innerHTML = `
                <div class="loading">
                    Unable to load patient information.
                    Please try again.
                </div>
            `;

        }

    }


    /* ======================================================
       CLOSE PATIENT MODAL
    ======================================================= */

    document.querySelectorAll("[data-close-modal]")
        .forEach(button => {

            button.addEventListener("click", () => {

                patientModal.classList.add("hidden");

                document.body.style.overflow = "";

            });

        });


    /* ======================================================
       CLOSE WHEN CLICKING OUTSIDE
    ======================================================= */

    [patientModal, addPatientModal]
        .forEach(modal => {

            modal.addEventListener("click", event => {

                if (event.target === modal) {

                    modal.classList.add("hidden");

                    document.body.style.overflow = "";

                }

            });

        });


    /* ======================================================
       ESCAPE KEY
    ======================================================= */

    document.addEventListener("keydown", event => {

        if (event.key !== "Escape") {
            return;
        }

        patientModal.classList.add("hidden");

        addPatientModal.classList.add("hidden");

        document.body.style.overflow = "";

    });


    /* ======================================================
       INITIALS
    ======================================================= */

    function getInitials(name) {

        return name
            .trim()
            .split(/\s+/)
            .slice(0, 2)
            .map(
                word =>
                    word
                        .charAt(0)
                        .toUpperCase()
            )
            .join("") || "P";

    }


    /* ======================================================
       HTML ESCAPE
    ======================================================= */

    function escapeHtml(value) {

        const div =
            document.createElement("div");

        div.textContent =
            value ?? "";

        return div.innerHTML;

    }

});
