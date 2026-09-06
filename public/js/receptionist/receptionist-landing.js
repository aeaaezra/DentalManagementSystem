document.addEventListener("DOMContentLoaded", () => {

    const mobileMenuButton =
        document.getElementById("mobileMenuButton");

    const mobileNav =
        document.getElementById("mobileNav");

    const navLinks =
        document.querySelectorAll(
            '.mobile-nav a[href^="#"]'
        );


    /* ======================================================
       MOBILE MENU
    ======================================================= */

    if (mobileMenuButton && mobileNav) {

        mobileMenuButton.addEventListener(
            "click",
            () => {

                mobileNav.classList.toggle("show");

            }
        );

    }


    /* ======================================================
       CLOSE MOBILE MENU
       AFTER CLICKING A SECTION
    ======================================================= */

    navLinks.forEach(link => {

        link.addEventListener(
            "click",
            () => {

                mobileNav.classList.remove(
                    "show"
                );

            }
        );

    });


    /* ======================================================
       ACTIVE NAVIGATION
    ======================================================= */

    const sections =
        document.querySelectorAll(
            "section[id]"
        );

    const desktopLinks =
        document.querySelectorAll(
            '.desktop-nav a[href^="#"]'
        );


    function updateActiveNavigation() {

        let currentSection = "";

        sections.forEach(section => {

            const sectionTop =
                section.offsetTop - 140;

            const sectionBottom =
                sectionTop +
                section.offsetHeight;

            if (
                window.scrollY >= sectionTop &&
                window.scrollY < sectionBottom
            ) {

                currentSection =
                    section.getAttribute("id");

            }

        });


        desktopLinks.forEach(link => {

            link.classList.remove(
                "active"
            );


            if (
                link.getAttribute("href") ===
                `#${currentSection}`
            ) {

                link.classList.add(
                    "active"
                );

            }

        });

    }


    window.addEventListener(
        "scroll",
        updateActiveNavigation
    );

    updateActiveNavigation();


    /* ======================================================
       SMOOTH SCROLL
    ======================================================= */

    document.querySelectorAll(
        'a[href^="#"]'
    ).forEach(link => {

        link.addEventListener(
            "click",
            event => {

                const targetId =
                    link.getAttribute(
                        "href"
                    );

                if (
                    targetId === "#" ||
                    !targetId
                ) {
                    return;
                }


                const target =
                    document.querySelector(
                        targetId
                    );


                if (!target) {
                    return;
                }


                event.preventDefault();


                const offset = 75;

                const position =
                    target.getBoundingClientRect()
                        .top +
                    window.scrollY -
                    offset;


                window.scrollTo({
                    top: position,
                    behavior: "smooth"
                });

            }
        );

    });


    /* ======================================================
       ESCAPE KEY
    ======================================================= */

    document.addEventListener(
        "keydown",
        event => {

            if (
                event.key === "Escape"
            ) {

                mobileNav.classList.remove(
                    "show"
                );

            }

        }
    );

});
