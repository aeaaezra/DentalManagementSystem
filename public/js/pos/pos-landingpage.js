document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       ELEMENTS
    ========================================================== */

    const accessPortalBtn = document.getElementById('accessPortalBtn');

    const loginModal = document.getElementById('loginModal');
    const loginOverlay = document.getElementById('loginOverlay');
    const closeLoginModal = document.getElementById('closeLoginModal');

    const passwordInput = document.getElementById('pos-password');
    const togglePassword = document.getElementById('togglePassword');

    const loginForm = document.getElementById('posLoginForm');
    const loginSubmit = document.getElementById('loginSubmit');

    const loginErrors = document.getElementById('loginErrors');


    /* =========================================================
       OPEN LOGIN MODAL
    ========================================================== */

    function openLoginModal() {

        if (!loginModal) {
            console.error('POS Login Modal was not found.');
            return;
        }

        loginModal.classList.add('active');

        loginModal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add(
            'login-modal-open'
        );

        /* Focus email field */

        setTimeout(function () {

            const emailInput =
                document.getElementById('pos-email');

            if (emailInput) {
                emailInput.focus();
            }

        }, 100);
    }


    /* =========================================================
       CLOSE LOGIN MODAL
    ========================================================== */

    function closeLogin() {

        if (!loginModal) {
            return;
        }

        loginModal.classList.remove('active');

        loginModal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.classList.remove(
            'login-modal-open'
        );

        /* Reset password visibility */

        if (passwordInput) {

            passwordInput.type = 'password';
        }

        if (togglePassword) {

            const icon =
                togglePassword.querySelector('i');

            if (icon) {

                icon.classList.remove(
                    'fa-eye-slash'
                );

                icon.classList.add(
                    'fa-eye'
                );
            }

            togglePassword.setAttribute(
                'aria-label',
                'Show password'
            );

            togglePassword.setAttribute(
                'title',
                'Show password'
            );
        }
    }


    /* =========================================================
       ACCESS POS BUTTON
    ========================================================== */

    if (accessPortalBtn) {

        accessPortalBtn.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                openLoginModal();
            }
        );

    } else {

        console.error(
            'Access POS button (#accessPortalBtn) was not found.'
        );

    }


    /* =========================================================
       CLOSE BUTTON
    ========================================================== */

    if (closeLoginModal) {

        closeLoginModal.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                closeLogin();
            }
        );
    }


    /* =========================================================
       OVERLAY CLICK
    ========================================================== */

    if (loginOverlay) {

        loginOverlay.addEventListener(
            'click',
            function () {

                closeLogin();
            }
        );
    }


    /* =========================================================
       PASSWORD SHOW / HIDE
    ========================================================== */

    if (togglePassword && passwordInput) {

        togglePassword.addEventListener(
            'click',
            function (event) {

                /*
                 * Prevent the button from submitting
                 * the login form.
                 */

                event.preventDefault();

                /*
                 * Prevent the click from reaching
                 * the modal or other elements.
                 */

                event.stopPropagation();


                const icon =
                    togglePassword.querySelector('i');


                /* =================================================
                   SHOW PASSWORD
                ================================================= */

                if (
                    passwordInput.type === 'password'
                ) {

                    passwordInput.type = 'text';


                    if (icon) {

                        icon.classList.remove(
                            'fa-eye'
                        );

                        icon.classList.add(
                            'fa-eye-slash'
                        );
                    }


                    togglePassword.setAttribute(
                        'aria-label',
                        'Hide password'
                    );

                    togglePassword.setAttribute(
                        'title',
                        'Hide password'
                    );


                }

                /* =================================================
                   HIDE PASSWORD
                ================================================= */

                else {

                    passwordInput.type = 'password';


                    if (icon) {

                        icon.classList.remove(
                            'fa-eye-slash'
                        );

                        icon.classList.add(
                            'fa-eye'
                        );
                    }


                    togglePassword.setAttribute(
                        'aria-label',
                        'Show password'
                    );

                    togglePassword.setAttribute(
                        'title',
                        'Show password'
                    );
                }

            }
        );

    } else {

        console.error(
            'Password toggle elements were not found.',
            {
                togglePassword: togglePassword,
                passwordInput: passwordInput
            }
        );

    }


    /* =========================================================
       LOGIN FORM SUBMIT
    ========================================================== */

    if (loginForm) {

        loginForm.addEventListener(
            'submit',
            function () {

                if (!loginSubmit) {
                    return;
                }


                /*
                 * Prevent multiple clicks.
                 */

                loginSubmit.disabled = true;


                /*
                 * Add loading state.
                 */

                loginSubmit.classList.add(
                    'loading'
                );


                const submitIcon =
                    loginSubmit.querySelector('i');

                const submitText =
                    loginSubmit.querySelector('span');


                /*
                 * Change icon to spinner.
                 */

                if (submitIcon) {

                    submitIcon.className =
                        'fa-solid fa-spinner fa-spin';
                }


                /*
                 * Change button text.
                 */

                if (submitText) {

                    submitText.textContent =
                        'Signing In...';
                }

            }
        );

    }


    /* =========================================================
       AUTO OPEN MODAL WHEN LOGIN ERROR EXISTS
    ========================================================== */

    if (loginErrors) {

        openLoginModal();
    }


    /* =========================================================
       ESCAPE KEY
    ========================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key !== 'Escape') {
                return;
            }


            if (
                loginModal &&
                loginModal.classList.contains('active')
            ) {

                closeLogin();
            }

        }
    );


    /* =========================================================
       INITIAL PASSWORD STATE
    ========================================================== */

    if (passwordInput) {

        passwordInput.type = 'password';
    }


    if (togglePassword) {

        const icon =
            togglePassword.querySelector('i');


        if (icon) {

            icon.classList.remove(
                'fa-eye-slash'
            );

            icon.classList.add(
                'fa-eye'
            );
        }


        togglePassword.setAttribute(
            'aria-label',
            'Show password'
        );

        togglePassword.setAttribute(
            'title',
            'Show password'
        );
    }


    /* =========================================================
       PREVENT BACKGROUND SCROLL
    ========================================================== */

    function updateBodyScroll() {

        if (
            loginModal &&
            loginModal.classList.contains('active')
        ) {

            document.body.style.overflow =
                'hidden';

        } else {

            document.body.style.overflow =
                '';
        }
    }


    if (loginModal) {

        const modalObserver =
            new MutationObserver(
                function () {

                    updateBodyScroll();
                }
            );


        modalObserver.observe(
            loginModal,
            {
                attributes: true,
                attributeFilter: ['class']
            }
        );
    }


    /* =========================================================
       ACCESSIBILITY - FOCUS TRAP
    ========================================================== */

    if (loginModal) {

        loginModal.addEventListener(
            'keydown',
            function (event) {

                if (event.key !== 'Tab') {
                    return;
                }


                const focusableElements =
                    loginModal.querySelectorAll(
                        'button:not([disabled]), input:not([disabled]), a, select, textarea'
                    );


                if (
                    !focusableElements.length
                ) {
                    return;
                }


                const firstElement =
                    focusableElements[0];

                const lastElement =
                    focusableElements[
                        focusableElements.length - 1
                    ];


                /*
                 * Shift + Tab
                 */

                if (
                    event.shiftKey &&
                    document.activeElement === firstElement
                ) {

                    event.preventDefault();

                    lastElement.focus();

                }


                /*
                 * Tab
                 */

                else if (
                    !event.shiftKey &&
                    document.activeElement === lastElement
                ) {

                    event.preventDefault();

                    firstElement.focus();
                }

            }
        );

    }


    /* =========================================================
       INITIALIZE
    ========================================================== */

    updateBodyScroll();

});
