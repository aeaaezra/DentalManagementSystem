/* =========================================================
   DENTIST PATIENT RECORDS
   Shine & Smile Dental Management System
========================================================= */


/* =========================================================
   DOM ELEMENTS
========================================================= */

const patientSearch =
    document.getElementById("patientSearch");

const patientList =
    document.getElementById("patientList");

const patientRecord =
    document.getElementById("patientRecord");

const patientGrid =
    document.getElementById("patientGrid");

const noResults =
    document.getElementById("noResults");

const notesModal =
    document.getElementById("notesModal");

const clinicalNote =
    document.getElementById("clinicalNote");

const characterCount =
    document.getElementById("characterCount");


/* =========================================================
   PATIENT SEARCH
========================================================= */

if (patientSearch) {

    patientSearch.addEventListener(
        "input",
        function () {

            const searchValue =
                this.value
                    .toLowerCase()
                    .trim();


            const patientCards =
                document.querySelectorAll(
                    ".patient-card"
                );


            let visiblePatients = 0;


            patientCards.forEach(
                function (card) {

                    const searchableText =
                        (
                            card.dataset.search ||
                            ""
                        ).toLowerCase();


                    const isMatch =
                        searchableText.includes(
                            searchValue
                        );


                    if (isMatch) {

                        card.style.display =
                            "block";

                        visiblePatients++;

                    } else {

                        card.style.display =
                            "none";

                    }

                }
            );


            /* Show / hide no results */

            if (noResults) {

                if (
                    visiblePatients === 0 &&
                    searchValue !== ""
                ) {

                    noResults.classList.add(
                        "show"
                    );

                } else {

                    noResults.classList.remove(
                        "show"
                    );

                }

            }

        }
    );

}


/* =========================================================
   OPEN PATIENT RECORD
========================================================= */

function openPatientRecord() {

    if (!patientList || !patientRecord) {
        return;
    }


    patientList.style.display =
        "none";


    patientRecord.classList.add(
        "show"
    );


    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });

}


/* =========================================================
   CLOSE PATIENT RECORD
========================================================= */

function closePatientRecord() {

    if (!patientList || !patientRecord) {
        return;
    }


    patientRecord.classList.remove(
        "show"
    );


    patientList.style.display =
        "block";


    /* Reset search */

    if (patientSearch) {

        patientSearch.value = "";

    }


    /* Show all patient cards */

    const patientCards =
        document.querySelectorAll(
            ".patient-card"
        );


    patientCards.forEach(
        function (card) {

            card.style.display =
                "block";

        }
    );


    if (noResults) {

        noResults.classList.remove(
            "show"
        );

    }


    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });

}


/* =========================================================
   TAB SWITCHING
========================================================= */

function switchTab(event, tabId) {

    const tabButtons =
        document.querySelectorAll(
            ".tab-btn"
        );

    const tabContents =
        document.querySelectorAll(
            ".tab-content"
        );


    /* Remove active state from buttons */

    tabButtons.forEach(
        function (button) {

            button.classList.remove(
                "active"
            );

        }
    );


    /* Hide all contents */

    tabContents.forEach(
        function (content) {

            content.classList.remove(
                "active"
            );

        }
    );


    /* Activate selected button */

    if (event && event.currentTarget) {

        event.currentTarget.classList.add(
            "active"
        );

    }


    /* Activate selected tab */

    const selectedTab =
        document.getElementById(
            tabId
        );


    if (selectedTab) {

        selectedTab.classList.add(
            "active"
        );

    }

}


/* =========================================================
   TOOTH SELECTION
========================================================= */

function selectTooth(
    tooth,
    toothNumber
) {

    if (!tooth) {
        return;
    }


    /* Remove previous selection */

    const allTeeth =
        document.querySelectorAll(
            ".tooth"
        );


    allTeeth.forEach(
        function (item) {

            item.classList.remove(
                "selected"
            );

        }
    );


    /* Select clicked tooth */

    tooth.classList.add(
        "selected"
    );


    /*
     * Temporary action.
     *
     * Later this can be connected
     * to the Laravel odontogram table.
     */

    console.log(
        "Selected tooth:",
        toothNumber
    );

}


/* =========================================================
   OPEN NOTES MODAL
========================================================= */

function openNotesModal() {

    if (!notesModal) {
        return;
    }


    notesModal.classList.add(
        "show"
    );


    notesModal.setAttribute(
        "aria-hidden",
        "false"
    );


    /* Focus textarea */

    setTimeout(
        function () {

            if (clinicalNote) {

                clinicalNote.focus();

            }

        },
        100
    );

}


/* =========================================================
   CLOSE NOTES MODAL
========================================================= */

function closeNotesModal() {

    if (!notesModal) {
        return;
    }


    notesModal.classList.remove(
        "show"
    );


    notesModal.setAttribute(
        "aria-hidden",
        "true"
    );

}


/* =========================================================
   CHARACTER COUNTER
========================================================= */

if (clinicalNote) {

    clinicalNote.addEventListener(
        "input",
        function () {

            const maxLength = 1000;

            let currentLength =
                this.value.length;


            if (currentLength > maxLength) {

                this.value =
                    this.value.substring(
                        0,
                        maxLength
                    );

                currentLength =
                    maxLength;

            }


            if (characterCount) {

                characterCount.textContent =
                    currentLength +
                    " / " +
                    maxLength;

            }

        }
    );

}


/* =========================================================
   SAVE NOTE
========================================================= */

function saveNote() {

    if (!clinicalNote) {
        return;
    }


    const noteText =
        clinicalNote.value.trim();


    const noteTypeElement =
        document.getElementById(
            "noteType"
        );


    const noteType =
        noteTypeElement
            ? noteTypeElement.value
            : "Clinical Observation";


    /* Validate */

    if (noteText === "") {

        alert(
            "Please enter a clinical note."
        );

        clinicalNote.focus();

        return;

    }


    /*
     * TEMPORARY FRONT-END FUNCTION
     *
     * Later this will be replaced
     * with a Laravel POST request.
     */

    console.log(
        "Note Type:",
        noteType
    );

    console.log(
        "Clinical Note:",
        noteText
    );


    alert(
        "Clinical note saved successfully."
    );


    /* Clear form */

    clinicalNote.value = "";


    if (characterCount) {

        characterCount.textContent =
            "0 / 1000";

    }


    /* Close modal */

    closeNotesModal();

}


/* =========================================================
   CLOSE MODAL WHEN CLICKING OUTSIDE
========================================================= */

if (notesModal) {

    notesModal.addEventListener(
        "click",
        function (event) {

            if (
                event.target ===
                notesModal
            ) {

                closeNotesModal();

            }

        }
    );

}


/* =========================================================
   ESCAPE KEY
========================================================= */

document.addEventListener(
    "keydown",
    function (event) {

        if (
            event.key === "Escape" &&
            notesModal &&
            notesModal.classList.contains("show")
        ) {

            closeNotesModal();

        }

    }
);


/* =========================================================
   INITIALIZE
========================================================= */

document.addEventListener(
    "DOMContentLoaded",
    function () {

        /*
         * Make sure the Overview tab
         * is active when the page loads.
         */

        const overviewTab =
            document.getElementById(
                "overview"
            );

        const firstTab =
            document.querySelector(
                ".tab-btn"
            );


        if (overviewTab) {

            overviewTab.classList.add(
                "active"
            );

        }


        if (firstTab) {

            firstTab.classList.add(
                "active"
            );

        }

    }
);
