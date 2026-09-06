document.addEventListener("DOMContentLoaded", function () {

    const loginModal = document.getElementById("loginModal");
    const openLoginModal = document.getElementById("openLoginModal");
    const accessPortalBtn = document.getElementById("accessPortalBtn");
    const closeLoginModal = document.getElementById("closeLoginModal");
    const loginOverlay = document.getElementById("loginOverlay");

    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("dentist-password");

    function openModal() {

        if (!loginModal) {
            return;
        }

        loginModal.classList.add("active");

        loginModal.setAttribute(
            "aria-hidden",
            "false"
        );

        document.body.classList.add("modal-open");

        setTimeout(function () {

            const emailInput =
                document.getElementById("dentist-email");

            if (emailInput) {
                emailInput.focus();
            }

        }, 250);
    }


    function closeModal() {

        if (!loginModal) {
            return;
        }

        loginModal.classList.remove("active");

        loginModal.setAttribute(
            "aria-hidden",
            "true"
        );

        document.body.classList.remove("modal-open");
    }


    if (openLoginModal) {

        openLoginModal.addEventListener(
            "click",
            function () {

                openModal();

            }
        );

    }


    if (accessPortalBtn) {

        accessPortalBtn.addEventListener(
            "click",
            function () {

                openModal();

            }
        );

    }


    if (closeLoginModal) {

        closeLoginModal.addEventListener(
            "click",
            function () {

                closeModal();

            }
        );

    }


    if (loginOverlay) {

        loginOverlay.addEventListener(
            "click",
            function () {

                closeModal();

            }
        );

    }


    document.addEventListener(
        "keydown",
        function (event) {

            if (event.key === "Escape") {

                closeModal();

            }

        }
    );


    if (togglePassword && passwordInput) {

        togglePassword.addEventListener(
            "click",
            function () {

                const isPassword =
                    passwordInput.type === "password";

                passwordInput.type =
                    isPassword
                        ? "text"
                        : "password";

                togglePassword.innerHTML =
                    isPassword
                        ? '<i class="fa-solid fa-eye-slash"></i>'
                        : '<i class="fa-solid fa-eye"></i>';

                togglePassword.setAttribute(
                    "aria-label",
                    isPassword
                        ? "Hide password"
                        : "Show password"
                );

            }
        );

    }

});
