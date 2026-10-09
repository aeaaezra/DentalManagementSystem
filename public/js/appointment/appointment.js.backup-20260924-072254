/* =========================================================
   GLOBAL CSRF TOKEN HELPER
   ========================================================= */

function getCsrfToken() {

    const meta =
        document.querySelector(
            'meta[name="csrf-token"]'
        );

    if (meta) {

        const token =
            meta.getAttribute('content');

        if (token) {
            return token;
        }
    }


    const input =
        document.querySelector(
            'input[name="_token"]'
        );

    if (input && input.value) {
        return input.value;
    }


    console.error(
        'CSRF token could not be found.'
    );

    return null;
}



/* =========================================================
   PROFILE DROPDOWN
   ========================================================= */

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


/* =========================================================
   LOGOUT MODAL
   ========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    const logoutBtn =
        document.getElementById('logoutBtn');

    const logoutModal =
        document.getElementById('logoutModal');

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


    /* ==========================================
       OPEN MODAL
       ========================================== */

    logoutBtn.addEventListener('click', function (event) {

        event.preventDefault();
        event.stopPropagation();

        logoutModal.classList.add('show');

        logoutModal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add(
            'logout-modal-open'
        );

    });


    /* ==========================================
       CLOSE MODAL
       ========================================== */

    function closeLogoutModal() {

        logoutModal.classList.remove('show');

        logoutModal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.classList.remove(
            'logout-modal-open'
        );

    }


    /* ==========================================
       CANCEL BUTTON
       ========================================== */

    cancelLogout.addEventListener('click', function () {

        closeLogoutModal();

    });


    /* ==========================================
       CLICK OVERLAY
       ========================================== */

    if (logoutModalOverlay) {

        logoutModalOverlay.addEventListener(
            'click',
            function () {

                closeLogoutModal();

            }
        );

    }


    /* ==========================================
       CONFIRM LOGOUT
       ========================================== */

    confirmLogout.addEventListener(
        'click',
        function () {

            const form =
                document.createElement('form');

            form.method = 'POST';

            form.action = '/logout';


            const csrfToken =
                document.querySelector(
                    'meta[name="csrf-token"]'
                );


            if (csrfToken) {

                const input =
                    document.createElement('input');

                input.type = 'hidden';

                input.name = '_token';

                input.value =
                    csrfToken.getAttribute('content');

                form.appendChild(input);

            } else {

                console.error(
                    'CSRF token not found.'
                );

                return;
            }


            document.body.appendChild(form);

            form.submit();

        }
    );



    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                logoutModal.classList.contains('show')
            ) {

                closeLogoutModal();

            }

        }
    );

});


/* ========================================================
   MOBILE SIDEBAR / BURGER MENU
   ======================================================== */

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


    /* ----------------------------------------------------
       BURGER BUTTON
       ---------------------------------------------------- */

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


    /* ----------------------------------------------------
       CLOSE BUTTON
       ---------------------------------------------------- */

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


    /* ----------------------------------------------------
       OVERLAY
       ---------------------------------------------------- */

    if (mobileSidebarOverlay) {

        mobileSidebarOverlay.addEventListener(
            "click",
            function () {

                closeMobileSidebarMenu();

            }
        );

    }


    /* ----------------------------------------------------
       MOBILE SETTINGS LINKS
       ---------------------------------------------------- */

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


    /* ----------------------------------------------------
       ESCAPE KEY
       ---------------------------------------------------- */

    document.addEventListener(
        "keydown",
        function (event) {

            if (event.key === "Escape") {

                closeMobileSidebarMenu();

            }

        }
    );

}


/* ========================================================
   SCROLL REVEAL
   ======================================================== */

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


/* ========================================================
   GLOBAL ESCAPE KEY
   ======================================================== */

document.addEventListener(
    "keydown",
    function (event) {

        if (event.key !== "Escape") {
            return;
        }


        if (typeof notificationDropdown !== "undefined") {

            notificationDropdown?.classList.add(
                "hidden"
            );

        }


        if (typeof clearConfirmModal !== "undefined") {

            clearConfirmModal?.classList.add(
                "hidden"
            );

        }


        if (typeof clearSuccessModal !== "undefined") {

            clearSuccessModal?.classList.add(
                "hidden"
            );

        }


        const logoutModal =
            document.getElementById(
                "logoutModal"
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


/* ============================================================
   SKELETON LOADER
   ============================================================ */

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


/* ============================================================
   CANCELLATION SUCCESS MODAL
   ============================================================ */

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const successModal =
            document.getElementById(
                'cancellationSuccessModal'
            );

        const successContent =
            document.getElementById(
                'cancellationSuccessModalContent'
            );

        const closeSuccessButton =
            document.getElementById(
                'closeCancellationSuccessModal'
            );


        /* ========================================================
           CHECK REQUIRED ELEMENTS
           ======================================================== */

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


        /* ========================================================
           OPEN SUCCESS MODAL
           ======================================================== */

        function openCancellationSuccessModal() {

            successModal.classList.remove(
                'hidden'
            );

            successModal.classList.add(
                'flex'
            );


            requestAnimationFrame(
                function () {

                    successContent.classList.remove(
                        'scale-95',
                        'opacity-0'
                    );

                    successContent.classList.add(
                        'scale-100',
                        'opacity-100'
                    );

                }
            );

        }


        /* ========================================================
           CLOSE SUCCESS MODAL
           ======================================================== */

        function closeCancellationSuccessModal() {

            successContent.classList.remove(
                'scale-100',
                'opacity-100'
            );

            successContent.classList.add(
                'scale-95',
                'opacity-0'
            );


            setTimeout(
                function () {

                    successModal.classList.remove(
                        'flex'
                    );

                    successModal.classList.add(
                        'hidden'
                    );

                },
                200
            );

        }


        /* ========================================================
           CLOSE BUTTON
           ======================================================== */

        closeSuccessButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                event.stopPropagation();

                closeCancellationSuccessModal();

            }
        );


        /* ========================================================
           CLICK OUTSIDE MODAL
           ======================================================== */

        successModal.addEventListener(
            'click',
            function (event) {

                if (
                    event.target === successModal
                ) {

                    closeCancellationSuccessModal();

                }

            }
        );


        /* ========================================================
           ESCAPE KEY
           ======================================================== */

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

    }
);


/* =========================================================
   PROFILE DROPDOWN
   ========================================================= */

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


/* =========================================================
   LOGOUT MODAL
   ========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    const logoutBtn =
        document.getElementById('logoutBtn');

    const logoutModal =
        document.getElementById('logoutModal');

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


    /* ==========================================
       OPEN MODAL
       ========================================== */

    logoutBtn.addEventListener('click', function (event) {

        event.preventDefault();
        event.stopPropagation();

        logoutModal.classList.add('show');

        logoutModal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add(
            'logout-modal-open'
        );

    });


    /* ==========================================
       CLOSE MODAL
       ========================================== */

    function closeLogoutModal() {

        logoutModal.classList.remove('show');

        logoutModal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.classList.remove(
            'logout-modal-open'
        );

    }


    /* ==========================================
       CANCEL BUTTON
       ========================================== */

    cancelLogout.addEventListener('click', function () {

        closeLogoutModal();

    });


    /* ==========================================
       CLICK OVERLAY
       ========================================== */

    if (logoutModalOverlay) {

        logoutModalOverlay.addEventListener(
            'click',
            function () {

                closeLogoutModal();

            }
        );

    }


    /* ==========================================
       CONFIRM LOGOUT
       ========================================== */

    confirmLogout.addEventListener(
        'click',
        function () {

            const form =
                document.createElement('form');

            form.method = 'POST';

            form.action = '/logout';


            const csrfToken =
                document.querySelector(
                    'meta[name="csrf-token"]'
                );


            if (csrfToken) {

                const input =
                    document.createElement('input');

                input.type = 'hidden';

                input.name = '_token';

                input.value =
                    csrfToken.getAttribute('content');

                form.appendChild(input);

            } else {

                console.error(
                    'CSRF token not found.'
                );

                return;
            }


            document.body.appendChild(form);

            form.submit();

        }
    );


    /* ==========================================
       ESC KEY
       ========================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                logoutModal.classList.contains('show')
            ) {

                closeLogoutModal();

            }

        }
    );

});


/* ========================================================
   MOBILE SIDEBAR / BURGER MENU
   ======================================================== */

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


    /* ----------------------------------------------------
       BURGER BUTTON
       ---------------------------------------------------- */

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


    /* ----------------------------------------------------
       CLOSE BUTTON
       ---------------------------------------------------- */

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


    /* ----------------------------------------------------
       OVERLAY
       ---------------------------------------------------- */

    if (mobileSidebarOverlay) {

        mobileSidebarOverlay.addEventListener(
            "click",
            function () {

                closeMobileSidebarMenu();

            }
        );

    }


    /* ----------------------------------------------------
       MOBILE SETTINGS LINKS
       ---------------------------------------------------- */

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


    /* ----------------------------------------------------
       ESCAPE KEY
       ---------------------------------------------------- */

    document.addEventListener(
        "keydown",
        function (event) {

            if (event.key === "Escape") {

                closeMobileSidebarMenu();

            }

        }
    );

}


/* ========================================================
   SCROLL REVEAL
   ======================================================== */

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


/* ========================================================
   GLOBAL ESCAPE KEY
   ======================================================== */

document.addEventListener(
    "keydown",
    function (event) {

        if (event.key !== "Escape") {
            return;
        }


        if (typeof notificationDropdown !== "undefined") {

            notificationDropdown?.classList.add(
                "hidden"
            );

        }


        if (typeof clearConfirmModal !== "undefined") {

            clearConfirmModal?.classList.add(
                "hidden"
            );

        }


        if (typeof clearSuccessModal !== "undefined") {

            clearSuccessModal?.classList.add(
                "hidden"
            );

        }


        const logoutModal =
            document.getElementById(
                "logoutModal"
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


/* ============================================================
   SKELETON LOADER
   ============================================================ */

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


/* ============================================================
   CANCELLATION SUCCESS MODAL
   ============================================================ */

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const successModal =
            document.getElementById(
                'cancellationSuccessModal'
            );

        const successContent =
            document.getElementById(
                'cancellationSuccessModalContent'
            );

        const closeSuccessButton =
            document.getElementById(
                'closeCancellationSuccessModal'
            );


        /* ========================================================
           CHECK REQUIRED ELEMENTS
           ======================================================== */

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


        /* ========================================================
           OPEN SUCCESS MODAL
           ======================================================== */

        function openCancellationSuccessModal() {

            successModal.classList.remove(
                'hidden'
            );

            successModal.classList.add(
                'flex'
            );


            requestAnimationFrame(
                function () {

                    successContent.classList.remove(
                        'scale-95',
                        'opacity-0'
                    );

                    successContent.classList.add(
                        'scale-100',
                        'opacity-100'
                    );

                }
            );

        }


        /* ========================================================
           CLOSE SUCCESS MODAL
           ======================================================== */

        function closeCancellationSuccessModal() {

            successContent.classList.remove(
                'scale-100',
                'opacity-100'
            );

            successContent.classList.add(
                'scale-95',
                'opacity-0'
            );


            setTimeout(
                function () {

                    successModal.classList.remove(
                        'flex'
                    );

                    successModal.classList.add(
                        'hidden'
                    );

                },
                200
            );

        }


        /* ========================================================
           CLOSE BUTTON
           ======================================================== */

        closeSuccessButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                event.stopPropagation();

                closeCancellationSuccessModal();

            }
        );


        /* ========================================================
           CLICK OUTSIDE MODAL
           ======================================================== */

        successModal.addEventListener(
            'click',
            function (event) {

                if (
                    event.target === successModal
                ) {

                    closeCancellationSuccessModal();

                }

            }
        );


        /* ========================================================
           ESCAPE KEY
           ======================================================== */

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

    }
);
