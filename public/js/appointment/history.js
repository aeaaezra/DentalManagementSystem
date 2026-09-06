function filterTable() {

    const searchInput = document.getElementById("searchInput");
    const monthFilter = document.getElementById("monthFilter");

    if (!searchInput || !monthFilter) {
        return;
    }

    const search = searchInput.value.toUpperCase();
    const month = monthFilter.value;

    const dentist =
        document.getElementById("dentistFilter")?.value.toUpperCase() || "";

    const service =
        document.getElementById("serviceFilter")?.value.toUpperCase() || "";

    const status =
        document.getElementById("statusFilter")?.value.toUpperCase() || "";

    const payment =
        document.getElementById("paymentFilter")?.value.toUpperCase() || "";


    const table = document.getElementById("historyTable");

    if (!table) {
        return;
    }

    const tr = table.getElementsByTagName("tr");


    for (let i = 1; i < tr.length; i++) {

        const row = tr[i];

        if (!row.cells || row.cells.length === 0) {
            continue;
        }


        const dateText =
            row.cells[0]?.textContent.trim() || "";

        const rowMonth =
            dateText.split("-")[1] || "";


        const rowDentist =
            row.cells[1]?.textContent.toUpperCase() || "";

        const rowService =
            row.cells[2]?.textContent.toUpperCase() || "";

        const rowStatus =
            row.cells[6]?.textContent.toUpperCase() || "";

        const rowPayment =
            row.cells[7]?.textContent.toUpperCase() || "";

        const rowFullText =
            row.textContent.toUpperCase();


        const matchSearch =
            rowFullText.includes(search);

        const matchMonth =
            month === "" || rowMonth === month;

        const matchDentist =
            dentist === "" || rowDentist.includes(dentist);

        const matchService =
            service === "" || rowService.includes(service);

        const matchStatus =
            status === "" || rowStatus.includes(status);

        const matchPayment =
            payment === "" || rowPayment.includes(payment);


        if (
            matchSearch &&
            matchMonth &&
            matchDentist &&
            matchService &&
            matchStatus &&
            matchPayment
        ) {

            row.style.display = "";

        } else {

            row.style.display = "none";

        }
    }
}



// ==================================================
// WAIT FOR PAGE TO LOAD
// ==================================================

document.addEventListener("DOMContentLoaded", function () {


    // ==================================================
    // MOBILE SIDEBAR
    // ==================================================

    const menuBtn =
        document.getElementById("menuBtn");

    const closeMenu =
        document.getElementById("closeMenu");

    const mobileMenu =
        document.getElementById("mobileMenu");


    if (menuBtn && mobileMenu) {

        menuBtn.addEventListener("click", function () {

            mobileMenu.style.left = "0";

        });

    }


    if (closeMenu && mobileMenu) {

        closeMenu.addEventListener("click", function () {

            mobileMenu.style.left = "-100%";

        });

    }



    // ==================================================
    // PROFILE DROPDOWN
    // ==================================================

    const profileBtn =
        document.getElementById("profileBtn");

    const profileMenu =
        document.getElementById("profileMenu");


    if (profileBtn && profileMenu) {

        profileBtn.addEventListener("click", function (e) {

            e.stopPropagation();

            profileMenu.classList.toggle("hidden");

        });

    }



    // ==================================================
    // NOTIFICATION DROPDOWN
    // ==================================================

    const notificationBtn =
        document.getElementById("notificationBtn");

    const notificationDropdown =
        document.getElementById("notificationDropdown");


    if (notificationBtn && notificationDropdown) {

        notificationBtn.addEventListener("click", function (e) {

            e.preventDefault();

            e.stopPropagation();


            notificationDropdown.classList.toggle("hidden");


            // ==========================================
            // CSRF TOKEN
            // ==========================================

            const csrfMeta =
                document.querySelector('meta[name="csrf-token"]');


            /*
             * IMPORTANT:
             *
             * Previously you had:
             *
             * document.querySelector(
             *     'meta[name="csrf-token"]'
             * ).content
             *
             * If the meta tag doesn't exist,
             * querySelector() returns null.
             *
             * We now check it first.
             */

            if (!csrfMeta) {

                console.warn(
                    "CSRF token meta tag was not found."
                );

                return;

            }


            const csrfToken =
                csrfMeta.getAttribute("content");


            if (!csrfToken) {

                console.warn(
                    "CSRF token is empty."
                );

                return;

            }


            // ==========================================
            // MARK NOTIFICATIONS AS READ
            // ==========================================

            fetch("/notifications/read-all", {

                method: "POST",

                headers: {

                    "X-CSRF-TOKEN": csrfToken,

                    "Accept": "application/json",

                    "Content-Type": "application/json"

                }

            })
            .then(response => {

                if (!response.ok) {

                    throw new Error(
                        "Failed to mark notifications as read."
                    );

                }

                return response.json().catch(() => ({}));

            })
            .then(data => {

                console.log(
                    "Notifications marked as read.",
                    data
                );

            })
            .catch(error => {

                console.error(
                    "Notification error:",
                    error
                );

            });

        });

    }



    // ==================================================
    // CLOSE DROPDOWNS
    // ==================================================

    document.addEventListener("click", function (e) {


        // PROFILE

        if (
            profileBtn &&
            profileMenu &&
            !profileBtn.contains(e.target) &&
            !profileMenu.contains(e.target)
        ) {

            profileMenu.classList.add("hidden");

        }


        // NOTIFICATIONS

        if (
            notificationBtn &&
            notificationDropdown &&
            !notificationBtn.contains(e.target) &&
            !notificationDropdown.contains(e.target)
        ) {

            notificationDropdown.classList.add("hidden");

        }

    });

});



// ==================================================
// PRINT APPOINTMENT HISTORY
// ==================================================

function printHistory() {

    const historyTable =
        document.getElementById("historyTable");


    if (!historyTable) {

        console.error(
            "historyTable was not found."
        );

        return;

    }


    const table =
        historyTable.outerHTML;


    const printWindow =
        window.open(
            "",
            "",
            "width=1000,height=700"
        );


    if (!printWindow) {

        alert(
            "Please allow pop-ups to print your appointment history."
        );

        return;

    }


    printWindow.document.write(`

        <!DOCTYPE html>

        <html>

        <head>

            <title>
                Appointment History
            </title>


            <style>

                body {
                    font-family: Arial, sans-serif;
                    padding: 30px;
                }

                h2 {
                    text-align: center;
                    margin-bottom: 20px;
                }

                h3 {
                    text-align: center;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                th,
                td {
                    border: 1px solid #ccc;
                    padding: 10px;
                    text-align: left;
                }

                th {
                    background: #fce7f3;
                }

            </style>

        </head>


        <body>

            <h2>
                Shine & Smile Dental Clinic
            </h2>

            <h3>
                Appointment History
            </h3>

            ${table}

        </body>

        </html>

    `);


    printWindow.document.close();


    printWindow.onload = function () {

        printWindow.focus();

        printWindow.print();


        setTimeout(function () {

            printWindow.close();

        }, 500);

    };

}

document.addEventListener('DOMContentLoaded', function () {

    const notificationBtn =
        document.getElementById('notificationBtn');

    const notificationDropdown =
        document.getElementById('notificationDropdown');

    if (!notificationBtn || !notificationDropdown) {
        return;
    }

    function syncNotificationState() {
        notificationBtn.setAttribute(
            'aria-expanded',
            notificationDropdown.classList.contains('hidden')
                ? 'false'
                : 'true'
        );
    }

    const observer = new MutationObserver(syncNotificationState);

    observer.observe(notificationDropdown, {
        attributes: true,
        attributeFilter: ['class']
    });

    syncNotificationState();

});
document.addEventListener('DOMContentLoaded', function () {
    const feedbackModal = document.getElementById('feedbackModal');
    const feedbackSuccessModal = document.getElementById('feedbackSuccessModal');
    const feedbackOverlay = document.getElementById('feedbackOverlay');
    const feedbackSuccessOverlay = document.getElementById('feedbackSuccessOverlay');
    const closeFeedbackModal = document.getElementById('closeFeedbackModal');
    const closeFeedbackSuccess = document.getElementById('closeFeedbackSuccess');
    const feedbackForm = document.getElementById('feedbackForm');
    const feedbackServiceName = document.getElementById('feedbackServiceName');
    const ratingInput = document.getElementById('ratingInput');
    const ratingText = document.getElementById('ratingText');
    const feedbackComment = document.getElementById('feedbackComment');
    const feedbackCharacterCount = document.getElementById('feedbackCharacterCount');
    const feedbackFormError = document.getElementById('feedbackFormError');
    const submitFeedback = document.getElementById('submitFeedback');
    const stars = document.querySelectorAll('.star');

    let selectedAppointmentId = null;
    let selectedRating = 0;

    const ratingLabels = {
        1: 'Very poor',
        2: 'Poor',
        3: 'Good',
        4: 'Very good',
        5: 'Excellent'
    };

    function openModal(modal) {
        if (!modal) return;

        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('feedback-open');
    }

    function closeModal(modal) {
        if (!modal) return;

        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');

        if (
            (!feedbackModal || !feedbackModal.classList.contains('show')) &&
            (!feedbackSuccessModal || !feedbackSuccessModal.classList.contains('show'))
        ) {
            document.body.classList.remove('feedback-open');
        }
    }

    function resetFeedbackForm() {
        selectedRating = 0;
        selectedAppointmentId = null;

        if (feedbackForm) {
            feedbackForm.reset();
        }

        if (ratingInput) {
            ratingInput.value = '';
        }

        if (ratingText) {
            ratingText.textContent = 'Select a rating';
        }

        stars.forEach(function (star) {
            star.classList.remove('selected');
        });

        if (feedbackComment && feedbackCharacterCount) {
            feedbackCharacterCount.textContent = feedbackComment.value.length;
        }

        if (feedbackFormError) {
            feedbackFormError.classList.add('hidden');
            feedbackFormError.textContent = '';
        }

        if (submitFeedback) {
            submitFeedback.disabled = false;
            submitFeedback.textContent = 'Submit Feedback';
        }
    }

    document.querySelectorAll('.feedback-button').forEach(function (button) {
        button.addEventListener('click', function () {
            selectedAppointmentId = this.dataset.appointmentId || null;

            const serviceName =
                this.dataset.serviceName || 'Dental Service';

            if (feedbackServiceName) {
                feedbackServiceName.textContent = serviceName;
            }

            resetFeedbackForm();

            selectedAppointmentId = this.dataset.appointmentId || null;

            if (feedbackServiceName) {
                feedbackServiceName.textContent = serviceName;
            }

            openModal(feedbackModal);
        });
    });

    stars.forEach(function (star) {
        star.addEventListener('click', function () {
            selectedRating = Number(this.dataset.rating || 0);

            if (ratingInput) {
                ratingInput.value = selectedRating;
            }

            stars.forEach(function (item) {
                item.classList.toggle(
                    'selected',
                    Number(item.dataset.rating || 0) <= selectedRating
                );
            });

            if (ratingText) {
                ratingText.textContent =
                    ratingLabels[selectedRating] || 'Select a rating';
            }

            if (feedbackFormError) {
                feedbackFormError.classList.add('hidden');
                feedbackFormError.textContent = '';
            }
        });
    });

    if (feedbackComment && feedbackCharacterCount) {
        feedbackComment.addEventListener('input', function () {
            feedbackCharacterCount.textContent = this.value.length;
        });
    }

    function showFeedbackError(message) {
        if (!feedbackFormError) {
            alert(message);
            return;
        }

        feedbackFormError.textContent = message;
        feedbackFormError.classList.remove('hidden');
    }

    if (feedbackForm) {
        feedbackForm.addEventListener('submit', async function (event) {
            event.preventDefault();

            if (!selectedAppointmentId) {
                showFeedbackError('Please select an appointment first.');
                return;
            }

            if (!selectedRating) {
                showFeedbackError('Please select a rating before submitting.');
                return;
            }

            const csrfMeta =
                document.querySelector('meta[name="csrf-token"]');

            if (!csrfMeta) {
                showFeedbackError(
                    'Security token was not found. Please refresh the page and try again.'
                );
                return;
            }

            /*
             * The Blade file originally had an empty form action.
             * We only submit automatically when a real action has been
             * supplied by your existing feedback backend.
             */
            const formAction = feedbackForm.getAttribute('action');

            if (!formAction || formAction === window.location.href) {
                showFeedbackError(
                    'The feedback form is ready, but the feedback submission route is not configured yet.'
                );
                return;
            }

            submitFeedback.disabled = true;
            submitFeedback.textContent = 'Submitting...';

            try {
                const formData = new FormData(feedbackForm);

                const response = await fetch(formAction, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfMeta.getAttribute('content'),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });

                const data = await response.json().catch(function () {
                    return {};
                });

                if (!response.ok) {
                    throw new Error(
                        data.message ||
                        'Unable to submit your feedback. Please try again.'
                    );
                }

                closeModal(feedbackModal);
                openModal(feedbackSuccessModal);

            } catch (error) {
                console.error('Feedback submission error:', error);

                showFeedbackError(
                    error.message ||
                    'Unable to submit your feedback. Please try again.'
                );

                submitFeedback.disabled = false;
                submitFeedback.textContent = 'Submit Feedback';
            }
        });
    }

    if (closeFeedbackModal) {
        closeFeedbackModal.addEventListener('click', function () {
            closeModal(feedbackModal);
        });
    }

    if (feedbackOverlay) {
        feedbackOverlay.addEventListener('click', function () {
            closeModal(feedbackModal);
        });
    }

    if (closeFeedbackSuccess) {
        closeFeedbackSuccess.addEventListener('click', function () {
            closeModal(feedbackSuccessModal);
            window.location.reload();
        });
    }

    if (feedbackSuccessOverlay) {
        feedbackSuccessOverlay.addEventListener('click', function () {
            closeModal(feedbackSuccessModal);
            window.location.reload();
        });
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeModal(feedbackModal);
            closeModal(feedbackSuccessModal);
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('appointmentHistoryModal');
    const overlay = document.getElementById('appointmentHistoryOverlay');
    const closeButton = document.getElementById('closeAppointmentHistoryModal');
    const closeFooterButton = document.getElementById('closeAppointmentHistoryModalFooter');

    const fields = {
        date: document.getElementById('viewAppointmentDate'),
        time: document.getElementById('viewAppointmentTime'),
        service: document.getElementById('viewAppointmentService'),
        total: document.getElementById('viewAppointmentTotal'),
        paid: document.getElementById('viewAppointmentPaid'),
        balance: document.getElementById('viewAppointmentBalance'),
        status: document.getElementById('viewAppointmentStatus')
    };

    function openModal(button) {
        fields.date.textContent = button.dataset.date || 'N/A';
        fields.time.textContent = button.dataset.time || 'N/A';
        fields.service.textContent = button.dataset.service || 'N/A';
        fields.total.textContent = button.dataset.total || '₱0.00';
        fields.paid.textContent = button.dataset.paid || '₱0.00';
        fields.balance.textContent = button.dataset.balance || '₱0.00';
        fields.status.textContent = button.dataset.status || 'N/A';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('overflow-hidden');
    }

    document.querySelectorAll('.view-history-button').forEach(function (button) {
        button.addEventListener('click', function () {
            openModal(button);
        });
    });

    [overlay, closeButton, closeFooterButton].forEach(function (element) {
        if (element) {
            element.addEventListener('click', closeModal);
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});


/* ============================================================
   LOGOUT CONFIRMATION
   ============================================================ */

document.addEventListener("DOMContentLoaded", function () {

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

        if (!logoutModal) {
            return;
        }

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

        if (!logoutModal) {
            return;
        }

        logoutModal.classList.remove("show");

        logoutModal.setAttribute(
            "aria-hidden",
            "true"
        );

        document.body.classList.remove(
            "logout-modal-open"
        );
    }


    logoutButton?.addEventListener(
        "click",
        function (event) {

            event.preventDefault();
            event.stopPropagation();

            openLogoutModal();

        }
    );


    cancelLogout?.addEventListener(
        "click",
        function () {

            closeLogoutModal();

        }
    );


    logoutModalOverlay?.addEventListener(
        "click",
        function () {

            closeLogoutModal();

        }
    );


    confirmLogout?.addEventListener(
        "click",
        function () {

            if (logoutForm) {
                logoutForm.submit();
            }

        }
    );


    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                logoutModal?.classList.contains("show")
            ) {
                closeLogoutModal();
            }

        }
    );

});
