document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* ========================================================
           SETTINGS TABS
        ======================================================== */

        const menuButtons =
            document.querySelectorAll(
                '.settings-menu'
            );


        const panels =
            document.querySelectorAll(
                '.settings-panel'
            );


        menuButtons.forEach(
            function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        const section =
                            button.dataset.section;


                        menuButtons.forEach(
                            function (item) {

                                item.classList.remove(
                                    'active'
                                );

                            }
                        );


                        panels.forEach(
                            function (panel) {

                                panel.classList.remove(
                                    'active'
                                );

                            }
                        );


                        button.classList.add(
                            'active'
                        );


                        const target =
                            document.getElementById(
                                section
                            );


                        if (target) {

                            target.classList.add(
                                'active'
                            );

                        }

                    }
                );

            }
        );



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

            profileButton.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();


                    const open =
                        profileWrapper.classList.contains(
                            'open'
                        );


                    profileWrapper.classList.toggle(
                        'open',
                        !open
                    );


                    profileButton.setAttribute(
                        'aria-expanded',
                        String(!open)
                    );

                }
            );


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

        }



        /* ========================================================
           TOAST
        ======================================================== */

        const toast =
            document.getElementById(
                'settingsToast'
            );


        function showToast(message) {

            if (!toast) {
                return;
            }


            toast.textContent =
                message;


            toast.classList.add(
                'show'
            );


            setTimeout(
                function () {

                    toast.classList.remove(
                        'show'
                    );

                },
                2500
            );

        }



        /* ========================================================
           PROFILE FORM
        ======================================================== */

        const profileForm =
            document.getElementById(
                'profileForm'
            );


        if (profileForm) {

            profileForm.addEventListener(
                'submit',
                function (event) {

                    event.preventDefault();


                    /*
                     * Database update will be connected here.
                     */

                    showToast(
                        'Profile saved successfully.'
                    );

                }
            );

        }



        /* ========================================================
           PASSWORD FORM
        ======================================================== */

        const passwordForm =
            document.getElementById(
                'passwordForm'
            );


        if (passwordForm) {

            passwordForm.addEventListener(
                'submit',
                function (event) {

                    event.preventDefault();


                    const password =
                        passwordForm.querySelector(
                            '[name="password"]'
                        );


                    const confirmation =
                        passwordForm.querySelector(
                            '[name="password_confirmation"]'
                        );


                    if (
                        password.value
                        !==
                        confirmation.value
                    ) {

                        showToast(
                            'Passwords do not match.'
                        );

                        return;

                    }


                    if (
                        password.value.length < 8
                    ) {

                        showToast(
                            'Password must be at least 8 characters.'
                        );

                        return;

                    }


                    /*
                     * Database password update
                     * will be connected here.
                     */

                    showToast(
                        'Password updated successfully.'
                    );


                    passwordForm.reset();

                }
            );

        }



        /* ========================================================
           NOTIFICATION SETTINGS
        ======================================================== */

        const switches =
            document.querySelectorAll(
                '.switch input'
            );


        switches.forEach(
            function (toggle) {

                toggle.addEventListener(
                    'change',
                    function () {

                        /*
                         * Database preference update
                         * will be connected here.
                         */

                        showToast(
                            'Preference updated.'
                        );

                    }
                );

            }
        );



        /* ========================================================
           DELETE ACCOUNT
        ======================================================== */

        const deleteButton =
            document.getElementById(
                'deleteAccountButton'
            );


        if (deleteButton) {

            deleteButton.addEventListener(
                'click',
                function () {

                    const confirmed =
                        confirm(
                            'Are you sure you want to delete your account? This action cannot be undone.'
                        );


                    if (!confirmed) {
                        return;
                    }


                    showToast(
                        'Account deletion requires confirmation.'
                    );

                }
            );

        }

    }
);
