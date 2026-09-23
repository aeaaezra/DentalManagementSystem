document.addEventListener("DOMContentLoaded", function () {

    const profileBtn = document.getElementById("profileBtn");
    const profileMenu = document.getElementById("profileMenu");

    if (!profileBtn || !profileMenu) {
        console.error("Profile dropdown elements not found.");
        return;
    }

    profileBtn.addEventListener("click", function (event) {

        event.preventDefault();
        event.stopPropagation();

        const isOpen =
            profileMenu.classList.contains("profile-open");

        if (isOpen) {

            profileMenu.classList.remove("profile-open");
            profileMenu.style.display = "none";

            profileBtn.setAttribute(
                "aria-expanded",
                "false"
            );

        } else {

            profileMenu.classList.add("profile-open");
            profileMenu.style.display = "block";

            profileBtn.setAttribute(
                "aria-expanded",
                "true"
            );
        }
    });


    profileMenu.addEventListener("click", function (event) {
        event.stopPropagation();
    });


    document.addEventListener("click", function (event) {

        if (
            !profileBtn.contains(event.target) &&
            !profileMenu.contains(event.target)
        ) {

            profileMenu.classList.remove("profile-open");

            profileMenu.style.display = "none";

            profileBtn.setAttribute(
                "aria-expanded",
                "false"
            );
        }
    });


    document.addEventListener("keydown", function (event) {

        if (event.key === "Escape") {

            profileMenu.classList.remove("profile-open");

            profileMenu.style.display = "none";

            profileBtn.setAttribute(
                "aria-expanded",
                "false"
            );
        }
    });

});

// =========================================================
// LOGOUT MODAL
// =========================================================
document.addEventListener('DOMContentLoaded', function () {

    const logoutBtn = document.getElementById('logoutBtn');
    const logoutModal = document.getElementById('logoutModal');
    const logoutModalOverlay =
        document.getElementById('logoutModalOverlay');
    const cancelLogout =
        document.getElementById('cancelLogout');
    const confirmLogout =
        document.getElementById('confirmLogout');

    if (
        !logoutBtn ||
        !logoutModal ||
        !cancelLogout ||
        !confirmLogout
    ) {
        console.warn('Logout modal elements not found.');
        return;
    }

    // ==========================================
    // OPEN MODAL
    // ==========================================
    logoutBtn.addEventListener('click', function (event) {

        event.preventDefault();
        event.stopPropagation();

        logoutModal.classList.add('show');
        logoutModal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('logout-modal-open');

    });


    // ==========================================
    // CLOSE MODAL
    // ==========================================
    function closeLogoutModal() {

        logoutModal.classList.remove('show');
        logoutModal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('logout-modal-open');

    }


    // ==========================================
    // CANCEL BUTTON
    // ==========================================
    cancelLogout.addEventListener('click', function () {

        closeLogoutModal();

    });


    // ==========================================
    // CLICK OVERLAY
    // ==========================================
    if (logoutModalOverlay) {

        logoutModalOverlay.addEventListener('click', function () {

            closeLogoutModal();

        });

    }


    // ==========================================
    // CONFIRM LOGOUT
    // ==========================================
    confirmLogout.addEventListener('click', function () {

        const form = document.createElement('form');

        form.method = 'POST';
        form.action = '/logout';

        const csrfToken = document.querySelector(
            'meta[name="csrf-token"]'
        );

        if (csrfToken) {

            const input = document.createElement('input');

            input.type = 'hidden';
            input.name = '_token';
            input.value = csrfToken.getAttribute('content');

            form.appendChild(input);

        } else {

            console.error('CSRF token not found.');

            return;

        }

        document.body.appendChild(form);

        form.submit();

    });


    // ==========================================
    // ESC KEY
    // ==========================================
    document.addEventListener('keydown', function (event) {

        if (
            event.key === 'Escape' &&
            logoutModal.classList.contains('show')
        ) {

            closeLogoutModal();

        }

    });

});
    // ========================================================
    // MOBILE SIDEBAR / BURGER MENU
    // ========================================================

    const mobileMenuBtn =
        document.getElementById(
            "mobileMenuBtn"
        );

    const mobileSidebar =
        document.getElementById(
            "mobileSidebar"
        );

    const mobileSidebarOverlay =
        document.getElementById(
            "mobileSidebarOverlay"
        );

    const closeMobileSidebar =
        document.getElementById(
            "closeMobileSidebar"
        );


    if (
        mobileMenuBtn &&
        mobileSidebar
    ) {


        function openMobileSidebar() {

            mobileSidebar.classList.remove(
                "-translate-x-full"
            );


            if (mobileSidebarOverlay) {

                mobileSidebarOverlay.classList.remove(
                    "hidden"
                );
            }


            mobileMenuBtn.setAttribute(
                "aria-expanded",
                "true"
            );


            document.body.style.overflow =
                "hidden";
        }


        function closeMobileSidebarMenu() {

            mobileSidebar.classList.add(
                "-translate-x-full"
            );


            if (mobileSidebarOverlay) {

                mobileSidebarOverlay.classList.add(
                    "hidden"
                );
            }


            mobileMenuBtn.setAttribute(
                "aria-expanded",
                "false"
            );


            document.body.style.overflow =
                "";
        }


        // ----------------------------------------------------
        // BURGER BUTTON
        // ----------------------------------------------------

        mobileMenuBtn.addEventListener(
            "click",
            function (event) {

                event.preventDefault();
                event.stopPropagation();


                const isClosed =
                    mobileSidebar.classList.contains(
                        "-translate-x-full"
                    );


                if (isClosed) {

                    openMobileSidebar();

                } else {

                    closeMobileSidebarMenu();

                }

            }
        );


        // ----------------------------------------------------
        // CLOSE BUTTON
        // ----------------------------------------------------

        if (closeMobileSidebar) {

            closeMobileSidebar.addEventListener(
                "click",
                function (event) {

                    event.preventDefault();
                    event.stopPropagation();

                    closeMobileSidebarMenu();

                }
            );
        }


        // ----------------------------------------------------
        // OVERLAY
        // ----------------------------------------------------

        if (mobileSidebarOverlay) {

            mobileSidebarOverlay.addEventListener(
                "click",
                function () {

                    closeMobileSidebarMenu();

                }
            );
        }


        // ----------------------------------------------------
        // MOBILE SETTINGS LINKS
        // ----------------------------------------------------

        mobileSidebar
            .querySelectorAll(
                ".settings-mobile-link"
            )
            .forEach(function (link) {

                link.addEventListener(
                    "click",
                    function () {

                        closeMobileSidebarMenu();

                    }
                );

            });


        // ----------------------------------------------------
        // ESCAPE KEY
        // ----------------------------------------------------

        document.addEventListener(
            "keydown",
            function (event) {

                if (event.key === "Escape") {

                    closeMobileSidebarMenu();

                }

            }
        );

    }


    // ========================================================
    // SCROLL REVEAL
    // ========================================================

    const sections =
        document.querySelectorAll(
            "#home, #services, #about, #testimonials, #FAQs, #location, footer"
        );


    if (
        sections.length > 0 &&
        "IntersectionObserver" in window
    ) {

        const observer =
            new IntersectionObserver(
                function (entries) {

                    entries.forEach(
                        function (entry) {

                            if (
                                entry.isIntersecting
                            ) {

                                entry.target.classList.add(
                                    "show"
                                );
                            }

                        }
                    );

                },
                {
                    threshold: 0.2
                }
            );


        sections.forEach(
            function (section) {

                section.classList.add(
                    "scroll-section"
                );

                observer.observe(
                    section
                );

            }
        );
    }


    // ========================================================
    // GLOBAL ESCAPE KEY
    // ========================================================

    document.addEventListener(
        "keydown",
        function (event) {

            if (event.key !== "Escape") {
                return;
            }


            notificationDropdown?.classList.add(
                "hidden"
            );


            clearConfirmModal?.classList.add(
                "hidden"
            );


            clearSuccessModal?.classList.add(
                "hidden"
            );


            if (
                logoutModal &&
                logoutModal.classList.contains("show")
            ) {

                logoutModal.classList.remove(
                    "show"
                );

                logoutModal.setAttribute(
                    "aria-hidden",
                    "true"
                );
            }

        }
    );




// ============================================================
// SKELETON LOADER
// ============================================================

window.addEventListener(
    "load",
    function () {

        const skeletonLoader =
            document.getElementById(
                "skeleton-loader"
            );


        if (!skeletonLoader) {
            return;
        }


        setTimeout(
            function () {

                skeletonLoader.classList.add(
                    "loaded"
                );


                setTimeout(
                    function () {

                        skeletonLoader.remove();

                    },
                    700
                );

            },
            500
        );

    }
);

// ============================================================
// CANCELLATION SUCCESS MODAL
// ============================================================

document.addEventListener('DOMContentLoaded', function () {

    const successModal =
        document.getElementById('cancellationSuccessModal');

    const successContent =
        document.getElementById('cancellationSuccessModalContent');

    const closeSuccessButton =
        document.getElementById('closeCancellationSuccessModal');

    // ========================================================
    // CHECK REQUIRED ELEMENTS
    // ========================================================

    if (
        !successModal ||
        !successContent ||
        !closeSuccessButton
    ) {
        console.warn(
            'Cancellation success modal elements not found.'
        );

        return;
    }

    // ========================================================
    // OPEN SUCCESS MODAL
    // ========================================================

    function openCancellationSuccessModal() {

        successModal.classList.remove('hidden');

        successModal.classList.add('flex');

        requestAnimationFrame(function () {

            successContent.classList.remove(
                'scale-95',
                'opacity-0'
            );

            successContent.classList.add(
                'scale-100',
                'opacity-100'
            );

        });
    }

    // ========================================================
    // CLOSE SUCCESS MODAL
    // ========================================================

    function closeCancellationSuccessModal() {

        successContent.classList.remove(
            'scale-100',
            'opacity-100'
        );

        successContent.classList.add(
            'scale-95',
            'opacity-0'
        );

        setTimeout(function () {

            successModal.classList.remove('flex');

            successModal.classList.add('hidden');

        }, 200);
    }

    // ========================================================
    // CLOSE BUTTON
    // ========================================================

    closeSuccessButton.addEventListener(
        'click',
        function (event) {

            event.preventDefault();

            event.stopPropagation();

            closeCancellationSuccessModal();

        }
    );

    // ========================================================
    // CLICK OUTSIDE MODAL
    // ========================================================

    successModal.addEventListener(
        'click',
        function (event) {

            if (event.target === successModal) {

                closeCancellationSuccessModal();

            }

        }
    );

    // ========================================================
    // ESCAPE KEY
    // ========================================================

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                !successModal.classList.contains('hidden')
            ) {

                closeCancellationSuccessModal();

            }

        }
    );

});// ============================================================
// CANCELLATION MODAL
// ============================================================

document.addEventListener('DOMContentLoaded', function () {

    const cancelButtons =
        document.querySelectorAll('.open-cancel-modal');

    const cancelModal =
        document.getElementById('cancelModal');

    const cancelModalContent =
        document.getElementById('cancelModalContent');

    const closeCancelModal =
        document.getElementById('closeCancelModal');

    const cancelModalKeepButton =
        document.getElementById('cancelModalKeepButton');

    const cancelAppointmentForm =
        document.getElementById('cancelAppointmentForm');

    console.log(
        'Cancellation buttons found:',
        cancelButtons.length
    );

    // ----------------------------------------------------------
    // CHECK MODAL
    // ----------------------------------------------------------

    if (!cancelModal) {
        console.error('cancelModal not found.');
        return;
    }

    // Do NOT stop the entire script if buttons aren't present.
    // This allows the rest of appointment.js to continue working.
    if (cancelButtons.length === 0) {
        console.warn(
            '.open-cancel-modal buttons not found.'
        );
        return;
    }

    // ----------------------------------------------------------
    // OPEN MODAL
    // ----------------------------------------------------------

    cancelButtons.forEach(function (button) {

        button.addEventListener('click', function (event) {

            event.preventDefault();
            event.stopPropagation();

            const originalForm =
                button.closest('.cancel-appointment-form');

            if (!originalForm) {
                console.error(
                    'cancel-appointment-form not found.'
                );
                return;
            }

            const action =
                originalForm.getAttribute('action');

            if (cancelAppointmentForm && action) {

                cancelAppointmentForm.setAttribute(
                    'action',
                    action
                );

            }

            cancelModal._originalForm = originalForm;

            cancelModal.classList.remove('hidden');
            cancelModal.classList.add('flex');

            document.body.style.overflow = 'hidden';

            if (cancelModalContent) {

                requestAnimationFrame(function () {

                    cancelModalContent.classList.remove(
                        'scale-95',
                        'opacity-0'
                    );

                    cancelModalContent.classList.add(
                        'scale-100',
                        'opacity-100'
                    );

                });

            }

        });

    });

    // ----------------------------------------------------------
    // CLOSE MODAL
    // ----------------------------------------------------------

    function closeCancellationModal() {

        if (cancelModalContent) {

            cancelModalContent.classList.remove(
                'scale-100',
                'opacity-100'
            );

            cancelModalContent.classList.add(
                'scale-95',
                'opacity-0'
            );

        }

        setTimeout(function () {

            cancelModal.classList.remove('flex');
            cancelModal.classList.add('hidden');

            document.body.style.overflow = '';

        }, 200);

    }

    // ----------------------------------------------------------
    // CLOSE X BUTTON
    // ----------------------------------------------------------

    if (closeCancelModal) {

        closeCancelModal.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                closeCancellationModal();

            }
        );

    }

    // ----------------------------------------------------------
    // NO, KEEP IT
    // ----------------------------------------------------------

    if (cancelModalKeepButton) {

        cancelModalKeepButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                closeCancellationModal();

            }
        );

    }

    // ----------------------------------------------------------
    // CLICK OUTSIDE
    // ----------------------------------------------------------

    cancelModal.addEventListener(
        'click',
        function (event) {

            if (event.target === cancelModal) {

                closeCancellationModal();

            }

        }
    );

    // ----------------------------------------------------------
    // ESCAPE
    // ----------------------------------------------------------

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                !cancelModal.classList.contains('hidden')
            ) {

                closeCancellationModal();

            }

        }
    );

});
// ============================================================
// PROFILE DROPDOWN
// ============================================================

document.addEventListener('DOMContentLoaded', function () {

    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');

    console.log('Profile button:', profileBtn);
    console.log('Profile menu:', profileMenu);

    if (!profileBtn || !profileMenu) {
        console.error('Profile dropdown elements not found.');
        return;
    }

    profileBtn.addEventListener('click', function (event) {

        event.preventDefault();
        event.stopPropagation();

        console.log('Profile button clicked');

        profileMenu.classList.toggle('hidden');

    });

    // Close when clicking outside
    document.addEventListener('click', function (event) {

        if (
            !profileBtn.contains(event.target) &&
            !profileMenu.contains(event.target)
        ) {
            profileMenu.classList.add('hidden');
        }

    });

});
/* =========================================================
   SHINE & SMILE
   NOTIFICATION SYSTEM
   ========================================================= */

document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       ELEMENTS
       ===================================================== */

    const notificationBtn =
        document.getElementById(
            "notificationBtn"
        );

    const notificationDropdown =
        document.getElementById(
            "notificationDropdown"
        );

    const closeNotificationBtn =
        document.getElementById(
            "closeNotificationBtn"
        );

    const notificationFilters =
        document.querySelectorAll(
            ".notification-filter"
        );

    const notificationList =
        document.getElementById(
            "notificationList"
        );

    const notificationFilterEmpty =
        document.getElementById(
            "notificationFilterEmpty"
        );

    const notificationFilterEmptyTitle =
        document.getElementById(
            "notificationFilterEmptyTitle"
        );

    const notificationFilterEmptyMessage =
        document.getElementById(
            "notificationFilterEmptyMessage"
        );


    /* =====================================================
       MODAL
       ===================================================== */

    const notificationModal =
        document.getElementById(
            "notificationModal"
        );

    const notificationModalOverlay =
        document.getElementById(
            "notificationModalOverlay"
        );

    const closeNotificationModalBtn =
        document.getElementById(
            "closeNotificationModal"
        );

    const notificationModalDone =
        document.getElementById(
            "notificationModalDone"
        );

    const notificationModalTitle =
        document.getElementById(
            "notificationModalTitle"
        );

    const notificationModalMessage =
        document.getElementById(
            "notificationModalMessage"
        );

    const notificationModalTime =
        document.getElementById(
            "notificationModalTime"
        );


    /* =====================================================
       STATE
       ===================================================== */

    let currentNotificationFilter =
        "all";


    /* =====================================================
       GET NOTIFICATION ITEMS
       ===================================================== */

    function getNotificationItems() {

        if (!notificationList) {
            return [];
        }

        return Array.from(
            notificationList.querySelectorAll(
                ".notification-item"
            )
        );

    }


    /* =====================================================
       CSRF TOKEN
       ===================================================== */

    function getCsrfToken() {

        const meta =
            document.querySelector(
                'meta[name="csrf-token"]'
            );

        if (!meta) {

            console.error(
                "CSRF token meta tag not found."
            );

            return null;
        }

        return meta.getAttribute(
            "content"
        );

    }


    /* =====================================================
       UPDATE COUNTERS
       ===================================================== */

    function updateNotificationCounters() {

        const items =
            getNotificationItems();


        let unreadCount = 0;

        let readCount = 0;


        items.forEach(function (item) {

            const status =
                item.dataset.notificationStatus;


            if (status === "unread") {

                unreadCount++;

            }

            else if (status === "read") {

                readCount++;

            }

        });


        const allCount =
            items.length;


        /* -----------------------------------------------
           All
           ----------------------------------------------- */

        const allButton =
            document.querySelector(
                '.notification-filter[data-filter="all"]'
            );

        if (allButton) {

            const count =
            allButton.querySelector(".notification-filter-count");

            if (count) {

                count.textContent =
                    allCount;

            }

        }


        /* -----------------------------------------------
           Unread
           ----------------------------------------------- */

        const unreadButton =
            document.querySelector(
                '.notification-filter[data-filter="unread"]'
            );

        if (unreadButton) {

            const count =
            allButton.querySelector(".notification-filter-count");

            if (count) {

                count.textContent =
                    unreadCount;

            }

        }


        /* -----------------------------------------------
           Read
           ----------------------------------------------- */

        const readButton =
            document.querySelector(
                '.notification-filter[data-filter="read"]'
            );

        if (readButton) {

            const count =
            allButton.querySelector(".notification-filter-count");

            if (count) {

                count.textContent =
                    readCount;

            }

        }


        /* -----------------------------------------------
           Notification badge
           ----------------------------------------------- */

        const badge =
            document.getElementById(
                "notificationBadge"
            );


        if (unreadCount > 0) {

            if (badge) {

                badge.textContent =
                    unreadCount > 99
                        ? "99+"
                        : unreadCount;

                badge.style.display =
                    "flex";

            }

        }

        else {

            if (badge) {

                badge.style.display =
                    "none";

            }

        }


        console.log(
            `Notifications | All: ${allCount} | Unread: ${unreadCount} | Read: ${readCount}`
        );

    }


    /* =====================================================
       UPDATE EMPTY STATE
       ===================================================== */

    function updateEmptyState(
        filter,
        visibleCount
    ) {

        if (!notificationFilterEmpty) {
            return;
        }


        if (visibleCount === 0) {

            notificationFilterEmpty.classList.remove(
                "hidden"
            );


            if (notificationFilterEmptyTitle) {

                if (filter === "unread") {

                    notificationFilterEmptyTitle.textContent =
                        "No unread notifications";

                }

                else if (filter === "read") {

                    notificationFilterEmptyTitle.textContent =
                        "No read notifications";

                }

                else {

                    notificationFilterEmptyTitle.textContent =
                        "No notifications";

                }

            }


            if (notificationFilterEmptyMessage) {

                if (filter === "unread") {

                    notificationFilterEmptyMessage.textContent =
                        "You're all caught up.";

                }

                else if (filter === "read") {

                    notificationFilterEmptyMessage.textContent =
                        "There are no read notifications.";

                }

                else {

                    notificationFilterEmptyMessage.textContent =
                        "There are no notifications in this category.";

                }

            }

        }

        else {

            notificationFilterEmpty.classList.add(
                "hidden"
            );

        }

    }


    /* =====================================================
       APPLY FILTER
       ===================================================== */

    function applyNotificationFilter(
        filter
    ) {

        currentNotificationFilter =
            filter;


        const items =
            getNotificationItems();


        let visibleCount = 0;


        items.forEach(function (item) {

            const status =
                item.dataset.notificationStatus ||
                "read";


            let showItem =
                false;


            /* -------------------------------------------
               ALL
               ------------------------------------------- */

            if (filter === "all") {

                showItem =
                    true;

            }


            /* -------------------------------------------
               UNREAD
               ------------------------------------------- */

            else if (filter === "unread") {

                showItem =
                    status === "unread";

            }


            /* -------------------------------------------
               READ
               ------------------------------------------- */

            else if (filter === "read") {

                showItem =
                    status === "read";

            }


            /* -------------------------------------------
               IMPORTANT:
               Use CSS class instead of
               item.style.display.
               ------------------------------------------- */

            if (showItem) {

                item.classList.remove(
                    "notification-hidden"
                );

                visibleCount++;

            }

            else {

                item.classList.add(
                    "notification-hidden"
                );

            }

        });


        /* =================================================
           ACTIVE TAB
           ================================================= */

        notificationFilters.forEach(
            function (button) {

                const isActive =
                    button.dataset.filter ===
                    filter;


                button.classList.toggle(
                    "active",
                    isActive
                );


                button.setAttribute(
                    "aria-selected",
                    isActive
                        ? "true"
                        : "false"
                );

            }
        );


        /* =================================================
           EMPTY STATE
           ================================================= */

        updateEmptyState(
            filter,
            visibleCount
        );

    }


    /* =====================================================
       OPEN NOTIFICATION DROPDOWN
       ===================================================== */

    function openNotificationDropdown() {

        if (!notificationDropdown) {
            return;
        }


        notificationDropdown.classList.remove(
            "hidden"
        );


        notificationDropdown.setAttribute(
            "aria-hidden",
            "false"
        );


        if (notificationBtn) {

            notificationBtn.setAttribute(
                "aria-expanded",
                "true"
            );

        }

    }


    /* =====================================================
       CLOSE NOTIFICATION DROPDOWN
       ===================================================== */

    function closeNotificationDropdown() {

        if (!notificationDropdown) {
            return;
        }


        notificationDropdown.classList.add(
            "hidden"
        );


        notificationDropdown.setAttribute(
            "aria-hidden",
            "true"
        );


        if (notificationBtn) {

            notificationBtn.setAttribute(
                "aria-expanded",
                "false"
            );

        }

    }


    /* =====================================================
       TOGGLE DROPDOWN
       ===================================================== */

    notificationBtn?.addEventListener(
        "click",
        function (event) {

            event.preventDefault();

            event.stopPropagation();


            if (
                notificationDropdown.classList.contains(
                    "hidden"
                )
            ) {

                openNotificationDropdown();

            }

            else {

                closeNotificationDropdown();

            }

        }
    );


    /* =====================================================
       CLOSE DROPDOWN BUTTON
       ===================================================== */

    closeNotificationBtn?.addEventListener(
        "click",
        function (event) {

            event.preventDefault();

            event.stopPropagation();

            closeNotificationDropdown();

        }
    );


    /* =====================================================
       FILTER BUTTONS
       ===================================================== */

    notificationFilters.forEach(
        function (button) {

            button.addEventListener(
                "click",
                function (event) {

                    event.preventDefault();

                    event.stopPropagation();


                    const filter =
                        button.dataset.filter ||
                        "all";


                    applyNotificationFilter(
                        filter
                    );

                }
            );

        }
    );


    /* =====================================================
       MARK ONE NOTIFICATION AS READ
       ===================================================== */

    async function markNotificationAsRead(
        notification
    ) {

        const notificationId =
            notification.dataset.notificationId;


        if (!notificationId) {

            console.error(
                "Notification ID is missing."
            );

            return false;

        }


        /*
         * Already read.
         */

        if (
            notification.dataset.notificationStatus ===
            "read"
        ) {

            return true;

        }


        const csrfToken =
            getCsrfToken();


        if (!csrfToken) {

            return false;

        }


        try {

            const response =
                await fetch(
                    `/notifications/${notificationId}/read`,
                    {
                        method: "POST",

                        headers: {
                            "X-CSRF-TOKEN":
                                csrfToken,

                            "Accept":
                                "application/json",

                            "Content-Type":
                                "application/json"
                        }
                    }
                );


            const data =
                await response.json();


            if (
                !response.ok ||
                !data.success
            ) {

                throw new Error(
                    data.message ||
                    "Unable to mark notification as read."
                );

            }


            /*
             * Change UNREAD → READ.
             */

            notification.dataset.notificationStatus =
                "read";


            /*
             * Remove unread dot.
             */

            const unreadDot =
                notification.querySelector(
                    ".notification-unread-dot"
                );


            if (unreadDot) {

                unreadDot.remove();

            }


            /*
             * Update counters.
             */

            updateNotificationCounters();


            /*
             * IMPORTANT:
             * Re-apply the current filter.
             *
             * If currently on UNREAD,
             * this notification disappears.
             */

            applyNotificationFilter(
                currentNotificationFilter
            );


            console.log(
                `Notification ${notificationId} marked as read.`
            );


            return true;

        }

        catch (error) {

            console.error(
                "Unable to mark notification as read:",
                error
            );


            return false;

        }

    }


    /* =====================================================
       OPEN MODAL
       ===================================================== */

    function openNotificationModal(
        notification
    ) {

        if (!notificationModal) {
            return;
        }


        const titleElement =
            notification.querySelector(
                ".notification-title"
            );


        const messageElement =
            notification.querySelector(
                ".notification-message"
            );


        const timeElement =
            notification.querySelector(
                ".notification-time"
            );


        const title =
            titleElement
                ? titleElement.textContent.trim()
                : "Notification";


        const message =
            messageElement
                ? messageElement.textContent.trim()
                : "";


        const time =
            timeElement
                ? timeElement.textContent.trim()
                : "";


        if (notificationModalTitle) {

            notificationModalTitle.textContent =
                title;

        }


        if (notificationModalMessage) {

            notificationModalMessage.textContent =
                message;

        }


        if (notificationModalTime) {

            notificationModalTime.textContent =
                time;

        }


        /*
         * Close dropdown.
         */

        closeNotificationDropdown();


        /*
         * Open modal.
         */

        notificationModal.classList.add(
            "show"
        );


        notificationModal.setAttribute(
            "aria-hidden",
            "false"
        );


        document.body.style.overflow =
            "hidden";

    }


    /* =====================================================
       CLOSE MODAL
       ===================================================== */

    function closeNotificationModal() {

        if (!notificationModal) {
            return;
        }


        notificationModal.classList.remove(
            "show"
        );


        notificationModal.setAttribute(
            "aria-hidden",
            "true"
        );


        document.body.style.overflow =
            "";

    }


    /* =====================================================
       NOTIFICATION CLICK EVENTS
       ===================================================== */

    function attachNotificationClicks() {

        const items =
            getNotificationItems();


        items.forEach(
            function (notification) {

                if (
                    notification.dataset.clickAttached ===
                    "true"
                ) {

                    return;

                }


                notification.dataset.clickAttached =
                    "true";


                notification.addEventListener(
                    "click",
                    async function (event) {

                        /*
                         * Ignore buttons/links if
                         * you add them later.
                         */

                        if (
                            event.target.closest(
                                "button"
                            ) ||
                            event.target.closest(
                                "a"
                            )
                        ) {

                            return;

                        }


                        /*
                         * Mark as read first.
                         */

                        await markNotificationAsRead(
                            notification
                        );


                        /*
                         * Then open full notification.
                         */

                        openNotificationModal(
                            notification
                        );

                    }
                );


                /*
                 * Keyboard accessibility.
                 */

                notification.addEventListener(
                    "keydown",
                    function (event) {

                        if (
                            event.key === "Enter" ||
                            event.key === " "
                        ) {

                            event.preventDefault();

                            notification.click();

                        }

                    }
                );

            }
        );

    }


    /* =====================================================
       MODAL BUTTONS
       ===================================================== */

    closeNotificationModalBtn?.addEventListener(
        "click",
        function () {

            closeNotificationModal();

        }
    );


    notificationModalDone?.addEventListener(
        "click",
        function () {

            closeNotificationModal();

        }
    );


    notificationModalOverlay?.addEventListener(
        "click",
        function () {

            closeNotificationModal();

        }
    );


    /* =====================================================
       ESCAPE KEY
       ===================================================== */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape"
            ) {

                if (
                    notificationModal &&
                    notificationModal.classList.contains(
                        "show"
                    )
                ) {

                    closeNotificationModal();

                }

                else if (
                    notificationDropdown &&
                    !notificationDropdown.classList.contains(
                        "hidden"
                    )
                ) {

                    closeNotificationDropdown();

                }

            }

        }
    );


    /* =====================================================
       CLICK OUTSIDE DROPDOWN
       ===================================================== */

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

                closeNotificationDropdown();

            }

        }
    );


    /* =====================================================
       INITIALIZE
       ===================================================== */

    updateNotificationCounters();

    attachNotificationClicks();

    applyNotificationFilter(
        "all"
    );

});
function getCsrfToken() {
    const meta = document.querySelector(
        'meta[name="csrf-token"]'
    );

    if (meta) {
        return meta.getAttribute('content');
    }

    const input = document.querySelector(
        'input[name="_token"]'
    );

    if (input) {
        return input.value;
    }

    console.error('CSRF token could not be found.');

    return null;
}
