document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* ========================================================
           PROFILE DROPDOWN
        ======================================================== */

        const profileButton =
            document.getElementById(
                'profileDropdownButton'
            );


        const profileWrapper =
            document.querySelector(
                '.customer-profile-wrapper'
            );


        if (
            profileButton &&
            profileWrapper
        ) {


            /* ====================================================
               OPEN / CLOSE DROPDOWN
            ==================================================== */

            profileButton.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();


                    const isOpen =
                        profileWrapper.classList.contains(
                            'open'
                        );


                    profileWrapper.classList.toggle(
                        'open',
                        !isOpen
                    );


                    profileButton.setAttribute(
                        'aria-expanded',
                        String(!isOpen)
                    );

                }
            );


            /* ====================================================
               CLOSE WHEN CLICKING OUTSIDE
            ==================================================== */

            document.addEventListener(
                'click',
                function (event) {

                    if (
                        !profileWrapper.contains(
                            event.target
                        )
                    ) {

                        profileWrapper.classList.remove(
                            'open'
                        );


                        profileButton.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                    }

                }
            );


            /* ====================================================
               CLOSE WITH ESCAPE
            ==================================================== */

            document.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Escape'
                    ) {

                        profileWrapper.classList.remove(
                            'open'
                        );


                        profileButton.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                    }

                }
            );

        }



        /* ========================================================
           EDIT PROFILE BUTTON
        ======================================================== */

        const editButton =
            document.querySelector(
                '.edit-profile-button'
            );


        if (editButton) {

            editButton.addEventListener(
                'click',
                function (event) {

                    const target =
                        document.getElementById(
                            'personalInformation'
                        );


                    if (target) {

                        event.preventDefault();


                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                    }

                }
            );

        }

    }
);
