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
