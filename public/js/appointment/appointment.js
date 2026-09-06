// ============================================================
// SHINE & SMILE - APPOINTMENT JAVASCRIPT
// CLEAN FIXED VERSION
// ============================================================

document.addEventListener("DOMContentLoaded", function () {

    // ========================================================
    // CSRF TOKEN
    // ========================================================

    function getCsrfToken() {
        return document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");
    }


    // ========================================================
    // NOTIFICATION ELEMENTS
    // ========================================================

    const notificationBtn =
        document.getElementById("notificationBtn");

    const notificationDropdown =
        document.getElementById("notificationDropdown");

    const notificationFilters =
        document.querySelectorAll(".notification-filter");

    const clearAllNotifications =
        document.getElementById("clearAllNotifications");

    const confirmClearNotifications =
        document.getElementById("confirmClearNotifications");

    const cancelClearNotifications =
        document.getElementById("cancelClearNotifications");

    const clearConfirmModal =
        document.getElementById("clearNotificationsConfirmModal");

    const clearSuccessModal =
        document.getElementById("clearNotificationsSuccessModal");

    const closeClearNotificationsSuccess =
        document.getElementById("closeClearNotificationsSuccess");


    // ========================================================
    // NOTIFICATION DROPDOWN
    // ========================================================

    if (notificationBtn && notificationDropdown) {

        notificationBtn.addEventListener(
            "click",
            async function (event) {

                event.preventDefault();
                event.stopPropagation();

                const wasHidden =
                    notificationDropdown.classList.contains("hidden");

                notificationDropdown.classList.toggle("hidden");

                if (wasHidden) {
                    await markNotificationsAsRead();
                }
            }
        );
    }


    // ========================================================
    // MARK NOTIFICATIONS AS READ
    // ========================================================

    async function markNotificationsAsRead() {

        const csrfToken = getCsrfToken();

        if (!csrfToken) {
            console.error("CSRF token not found.");
            return false;
        }

        const readAllUrl =
            window.notificationRoutes?.readAll ||
            new URL(
                "../notifications/read-all",
                window.location.href
            ).href;

        try {

            const response = await fetch(
                readAllUrl,
                {
                    method: "POST",

                    credentials: "same-origin",

                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }
            );

            if (!response.ok) {

                console.error(
                    "Failed to mark notifications as read:",
                    response.status
                );

                return false;
            }

            let data = {};

            try {
                data = await response.json();
            } catch (error) {
                data = {};
            }

            if (data.success === false) {
                return false;
            }

            document
                .querySelectorAll(".notification-item")
                .forEach(function (item) {

                    item.dataset.notificationStatus = "read";

                });

            document
                .querySelectorAll(".notification-badge")
                .forEach(function (badge) {

                    badge.remove();

                });

            updateNotificationFilterCounts();

            return true;

        } catch (error) {

            console.error(
                "Mark notifications as read error:",
                error
            );

            return false;
        }
    }


    // ========================================================
    // NOTIFICATION FILTERS
    // ========================================================

    notificationFilters.forEach(function (button) {

        button.addEventListener(
            "click",
            function (event) {

                event.preventDefault();
                event.stopPropagation();

                const filter =
                    button.dataset.filter || "all";

                applyNotificationFilter(filter);
            }
        );
    });


    // ========================================================
    // APPLY NOTIFICATION FILTER
    // ========================================================

    function applyNotificationFilter(filter) {

        const notificationItems =
            document.querySelectorAll(
                ".notification-item"
            );

        notificationItems.forEach(function (item) {

            const status =
                item.dataset.notificationStatus || "read";

            if (filter === "all") {

                item.style.display = "";

            } else if (filter === "unread") {

                item.style.display =
                    status === "unread"
                        ? ""
                        : "none";

            } else if (filter === "read") {

                item.style.display =
                    status === "read"
                        ? ""
                        : "none";

            }

        });


        notificationFilters.forEach(function (button) {

            button.classList.toggle(
                "active",
                button.dataset.filter === filter
            );

        });


        showFilteredEmptyMessage(filter);
    }


    // ========================================================
    // UPDATE NOTIFICATION COUNTS
    // ========================================================

    function updateNotificationFilterCounts() {

        const items =
            Array.from(
                document.querySelectorAll(
                    ".notification-item"
                )
            );

        const unreadCount =
            items.filter(function (item) {

                return (
                    item.dataset.notificationStatus ===
                    "unread"
                );

            }).length;

        const readCount =
            items.filter(function (item) {

                return (
                    item.dataset.notificationStatus ===
                    "read"
                );

            }).length;

        const allCount =
            items.length;


        notificationFilters.forEach(function (button) {

            const filter =
                button.dataset.filter;

            let count = 0;

            if (filter === "all") {
                count = allCount;
            }

            if (filter === "unread") {
                count = unreadCount;
            }

            if (filter === "read") {
                count = readCount;
            }

            const countElement =
                button.querySelector(
                    ".notification-filter-count"
                );

            if (countElement) {
                countElement.textContent = count;
            }

        });
    }


    // ========================================================
    // CLEAR ALL NOTIFICATIONS - OPEN MODAL
    // ========================================================

    if (clearAllNotifications) {

        clearAllNotifications.addEventListener(
            "click",
            function (event) {

                event.preventDefault();
                event.stopPropagation();

                const items =
                    document.querySelectorAll(
                        ".notification-item"
                    );

                if (items.length === 0) {
                    return;
                }

                clearConfirmModal?.classList.remove(
                    "hidden"
                );
            }
        );
    }


    // ========================================================
    // CANCEL CLEAR ALL
    // ========================================================

    if (cancelClearNotifications) {

        cancelClearNotifications.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                clearConfirmModal?.classList.add(
                    "hidden"
                );
            }
        );
    }


    // ========================================================
    // CLOSE CLEAR MODAL BY BACKDROP
    // ========================================================

    document
        .querySelectorAll("[data-close-clear-modal]")
        .forEach(function (backdrop) {

            backdrop.addEventListener(
                "click",
                function () {

                    clearConfirmModal?.classList.add(
                        "hidden"
                    );
                }
            );

        });


    // ========================================================
    // CONFIRM CLEAR ALL
    // ========================================================

    if (confirmClearNotifications) {

        confirmClearNotifications.addEventListener(
            "click",
            async function (event) {

                event.preventDefault();
                event.stopPropagation();

                const csrfToken =
                    getCsrfToken();

                if (!csrfToken) {

                    console.error(
                        "CSRF token not found."
                    );

                    return;
                }

                const clearAllUrl =
                    window.notificationRoutes?.clearAll ||
                    clearAllNotifications?.dataset.clearUrl ||
                    "/notifications";


                try {

                    confirmClearNotifications.disabled =
                        true;

                    confirmClearNotifications.textContent =
                        "Clearing...";


                    const response =
                        await fetch(
                            clearAllUrl,
                            {
                                method: "DELETE",

                                credentials:
                                    "same-origin",

                                headers: {
                                    "X-CSRF-TOKEN":
                                        csrfToken,

                                    "Accept":
                                        "application/json",

                                    "X-Requested-With":
                                        "XMLHttpRequest"
                                }
                            }
                        );


                    if (!response.ok) {

                        throw new Error(
                            "Failed to clear notifications."
                        );
                    }


                    let data = {};

                    try {

                        data =
                            await response.json();

                    } catch (error) {

                        data = {};

                    }


                    if (
                        data.success === false
                    ) {

                        throw new Error(
                            "Server failed to clear notifications."
                        );
                    }


                    // Remove notification items
                    document
                        .querySelectorAll(
                            ".notification-item"
                        )
                        .forEach(function (item) {

                            item.remove();

                        });


                    // Remove notification badges
                    document
                        .querySelectorAll(
                            ".notification-badge"
                        )
                        .forEach(function (badge) {

                            badge.remove();

                        });


                    updateNotificationFilterCounts();


                    // Close confirmation
                    clearConfirmModal?.classList.add(
                        "hidden"
                    );


                    // Show success
                    clearSuccessModal?.classList.remove(
                        "hidden"
                    );


                    showEmptyNotificationMessage();


                } catch (error) {

                    console.error(
                        "Clear notifications error:",
                        error
                    );

                    alert(
                        "Unable to clear notifications. Please try again."
                    );

                } finally {

                    confirmClearNotifications.disabled =
                        false;

                    confirmClearNotifications.textContent =
                        "Yes, clear all";
                }

            }
        );
    }


    // ========================================================
    // CLOSE SUCCESS MODAL
    // ========================================================

    if (closeClearNotificationsSuccess) {

        closeClearNotificationsSuccess.addEventListener(
            "click",
            function () {

                clearSuccessModal?.classList.add(
                    "hidden"
                );

            }
        );
    }


    // ========================================================
    // DELETE ONE NOTIFICATION
    // ========================================================

    document.addEventListener(
        "click",
        async function (event) {

            const deleteButton =
                event.target.closest(
                    ".delete-notification"
                );

            if (!deleteButton) {
                return;
            }

            event.preventDefault();
            event.stopPropagation();

            const notificationId =
                deleteButton.dataset.notificationId;

            const csrfToken =
                getCsrfToken();

            if (!notificationId) {

                console.error(
                    "Notification ID not found."
                );

                return;
            }

            if (!csrfToken) {

                console.error(
                    "CSRF token not found."
                );

                return;
            }


            try {

                deleteButton.disabled = true;


                const response =
                    await fetch(
                        `/notifications/${notificationId}`,
                        {
                            method: "DELETE",

                            credentials:
                                "same-origin",

                            headers: {
                                "X-CSRF-TOKEN":
                                    csrfToken,

                                "Accept":
                                    "application/json",

                                "X-Requested-With":
                                    "XMLHttpRequest"
                            }
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        "Failed to delete notification."
                    );
                }


                const notificationItem =
                    deleteButton.closest(
                        ".notification-item"
                    );


                notificationItem?.remove();


                updateNotificationFilterCounts();

                showEmptyNotificationMessage();

            } catch (error) {

                console.error(
                    "Delete notification error:",
                    error
                );

                deleteButton.disabled = false;
            }

        }
    );


    // ========================================================
    // EMPTY NOTIFICATION MESSAGE
    // ========================================================

    function showEmptyNotificationMessage() {

        if (!notificationDropdown) {
            return;
        }

        const notificationItems =
            notificationDropdown.querySelectorAll(
                ".notification-item"
            );

        const existingMessage =
            document.getElementById(
                "noNotificationsMessage"
            );


        if (notificationItems.length === 0) {

            if (!existingMessage) {

                const message =
                    document.createElement("div");

                message.id =
                    "noNotificationsMessage";

                message.className =
                    "p-6 text-center text-sm text-gray-500";

                message.textContent =
                    "No notifications.";

                notificationDropdown.appendChild(
                    message
                );
            }

        } else {

            existingMessage?.remove();
        }
    }


    // ========================================================
    // FILTERED EMPTY MESSAGE
    // ========================================================

    function showFilteredEmptyMessage(filter) {

        const items =
            Array.from(
                document.querySelectorAll(
                    ".notification-item"
                )
            );


        const visibleItems =
            items.filter(function (item) {

                return (
                    item.style.display !== "none"
                );

            });


        const existingMessage =
            document.getElementById(
                "noFilteredNotificationsMessage"
            );


        if (
            visibleItems.length === 0 &&
            items.length > 0
        ) {

            if (!existingMessage) {

                const message =
                    document.createElement("div");

                message.id =
                    "noFilteredNotificationsMessage";

                message.className =
                    "p-6 text-center text-sm text-gray-500";


                if (filter === "unread") {

                    message.textContent =
                        "No unread notifications.";

                } else if (filter === "read") {

                    message.textContent =
                        "No read notifications.";

                } else {

                    message.textContent =
                        "No notifications.";
                }


                notificationDropdown?.appendChild(
                    message
                );
            }

        } else {

            existingMessage?.remove();
        }
    }


    // ========================================================
    // CLOSE NOTIFICATION DROPDOWN WHEN CLICKING OUTSIDE
    // ========================================================

    document.addEventListener(
        "click",
        function (event) {

            if (
                notificationBtn &&
                notificationDropdown &&
                !notificationBtn.contains(
                    event.target
                ) &&
                !notificationDropdown.contains(
                    event.target
                )
            ) {

                notificationDropdown.classList.add(
                    "hidden"
                );
            }

        }
    );


    // ========================================================
    // LOGOUT CONFIRMATION MODAL
    // ========================================================

    const logoutButton =
        document.getElementById("logoutButton");

    const logoutModal =
        document.getElementById("logoutModal");

    const cancelLogout =
        document.getElementById("cancelLogout");

    const logoutModalOverlay =
        document.getElementById(
            "logoutModalOverlay"
        );


    if (logoutButton && logoutModal) {

        logoutButton.addEventListener(
            "click",
            function (event) {

                event.preventDefault();
                event.stopPropagation();

                logoutModal.classList.add(
                    "show"
                );

                logoutModal.setAttribute(
                    "aria-hidden",
                    "false"
                );
            }
        );


        cancelLogout?.addEventListener(
            "click",
            function () {

                logoutModal.classList.remove(
                    "show"
                );

                logoutModal.setAttribute(
                    "aria-hidden",
                    "true"
                );
            }
        );


        logoutModalOverlay?.addEventListener(
            "click",
            function () {

                logoutModal.classList.remove(
                    "show"
                );

                logoutModal.setAttribute(
                    "aria-hidden",
                    "true"
                );
            }
        );
    }


    // ========================================================
    // SETTINGS MOBILE BACK BUTTON
    // ========================================================

    document
        .querySelectorAll(
            ".mobile-settings-back"
        )
        .forEach(function (button) {

            button.addEventListener(
                "click",
                function (event) {

                    event.preventDefault();

                    window.history.back();

                }
            );

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

});


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
// LOGOUT CONFIRMATION FUNCTION
// ============================================================

function confirmLogout() {

    return confirm(
        "Are you sure you want to logout?"
    );
}
