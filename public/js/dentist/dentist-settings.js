// ============================================================
// SHINE & SMILE
// DENTIST SETTINGS JAVASCRIPT
// ============================================================

document.addEventListener("DOMContentLoaded", function () {

    "use strict";


    // ============================================================
    // CONFIGURATION
    // ============================================================

    const config =
        window.DENTIST_SETTINGS || {};


    const csrfToken =
        config.csrf ||
        document
            .querySelector(
                'meta[name="csrf-token"]'
            )
            ?.getAttribute(
                "content"
            ) ||
        "";


    // ============================================================
    // GENERAL ELEMENTS
    // ============================================================

    const settingsMenu =
        document.querySelector(
            ".settings-menu"
        );


    const menuItems =
        document.querySelectorAll(
            ".settings-menu-item"
        );


    const settingsSections =
        document.querySelectorAll(
            ".settings-section"
        );


    // ============================================================
    // DEBUG
    // ============================================================

    console.log(
        "Dentist settings initialized."
    );


    console.log(
        "Settings menu:",
        settingsMenu
    );


    console.log(
        "Settings menu items:",
        menuItems.length
    );


    console.log(
        "Settings sections:",
        settingsSections.length
    );


    // ============================================================
    // TOAST FUNCTION
    // ============================================================

    function showToast(
        message,
        type = "success"
    ) {

        const container =
            document.getElementById(
                "toastContainer"
            );


        if (!container) {

            console.log(
                `[${type}] ${message}`
            );

            return;
        }


        const toast =
            document.createElement(
                "div"
            );


        toast.className =
            `toast ${type}`;


        toast.textContent =
            message;


        container.appendChild(
            toast
        );


        setTimeout(
            function () {

                toast.remove();

            },
            3500
        );
    }


    // ============================================================
    // SETTINGS NAVIGATION
    // ============================================================

    function activateSection(
        target
    ) {

        if (!target) {

            return;
        }


        console.log(
            "Opening settings section:",
            target
        );


        // --------------------------------------------------------
        // REMOVE ACTIVE FROM ALL MENU ITEMS
        // --------------------------------------------------------

        menuItems.forEach(
            function (item) {

                item.classList.remove(
                    "active"
                );


                item.setAttribute(
                    "aria-selected",
                    "false"
                );
            }
        );


        // --------------------------------------------------------
        // HIDE ALL SECTIONS
        // --------------------------------------------------------

        settingsSections.forEach(
            function (section) {

                section.classList.remove(
                    "active"
                );


                section.style.display =
                    "none";
            }
        );


        // --------------------------------------------------------
        // FIND MENU ITEM
        // --------------------------------------------------------

        const selectedMenu =
            document.querySelector(
                `.settings-menu-item[data-section="${target}"]`
            );


        // --------------------------------------------------------
        // FIND SECTION
        // --------------------------------------------------------

        const selectedSection =
            document.getElementById(
                `${target}Section`
            );


        // --------------------------------------------------------
        // MENU NOT FOUND
        // --------------------------------------------------------

        if (!selectedMenu) {

            console.error(
                "Settings menu item not found:",
                target
            );

            return;
        }


        // --------------------------------------------------------
        // SECTION NOT FOUND
        // --------------------------------------------------------

        if (!selectedSection) {

            console.error(
                "Settings section not found:",
                `${target}Section`
            );

            return;
        }


        // --------------------------------------------------------
        // ACTIVATE MENU ITEM
        // --------------------------------------------------------

        selectedMenu.classList.add(
            "active"
        );


        selectedMenu.setAttribute(
            "aria-selected",
            "true"
        );


        // --------------------------------------------------------
        // ACTIVATE SECTION
        // --------------------------------------------------------

        selectedSection.classList.add(
            "active"
        );


        selectedSection.style.display =
            "block";


        // --------------------------------------------------------
        // UPDATE URL
        // --------------------------------------------------------

        history.replaceState(
            null,
            "",
            `#${target}`
        );
    }


    // ============================================================
    // SETTINGS MENU CLICK
    // ============================================================

    if (settingsMenu) {

        settingsMenu.addEventListener(
            "click",
            function (event) {

                const menuItem =
                    event.target.closest(
                        ".settings-menu-item"
                    );


                if (!menuItem) {

                    return;
                }


                event.preventDefault();

                event.stopPropagation();


                const target =
                    menuItem.dataset.section;


                if (!target) {

                    console.error(
                        "Missing data-section on settings menu item."
                    );

                    return;
                }


                activateSection(
                    target
                );
            }
        );

    } else {

        console.error(
            "Settings menu .settings-menu was not found."
        );
    }


    // ============================================================
    // MAKE SETTINGS ITEMS CLICKABLE
    // ============================================================

    menuItems.forEach(
        function (item) {

            item.style.cursor =
                "pointer";

            item.style.pointerEvents =
                "auto";

            item.setAttribute(
                "role",
                "tab"
            );
        }
    );


    // ============================================================
    // LOAD SECTION FROM URL
    // ============================================================

    const currentHash =
        window.location.hash
            .replace(
                "#",
                ""
            )
            .trim();


    if (
        currentHash &&
        document.getElementById(
            `${currentHash}Section`
        )
    ) {

        activateSection(
            currentHash
        );

    } else {

        const activeItem =
            document.querySelector(
                ".settings-menu-item.active"
            );


        const defaultTarget =
            activeItem?.dataset.section ||
            "profile";


        activateSection(
            defaultTarget
        );
    }


    // ============================================================
    // BROWSER HASH CHANGE
    // ============================================================

    window.addEventListener(
        "hashchange",
        function () {

            const target =
                window.location.hash
                    .replace(
                        "#",
                        ""
                    )
                    .trim();


            if (
                target &&
                document.getElementById(
                    `${target}Section`
                )
            ) {

                activateSection(
                    target
                );
            }
        }
    );


    // ============================================================
    // PROFILE FORM
    // ============================================================

    const profileForm =
        document.getElementById(
            "profileForm"
        );


    if (profileForm) {

        profileForm.addEventListener(
            "submit",
            async function (event) {

                event.preventDefault();


                if (!config.profileUrl) {

                    showToast(
                        "Profile update URL is missing.",
                        "error"
                    );

                    return;
                }


                const submitButton =
                    profileForm.querySelector(
                        'button[type="submit"]'
                    );


                const originalText =
                    submitButton?.textContent ||
                    "Save Changes";


                if (submitButton) {

                    submitButton.disabled =
                        true;

                    submitButton.textContent =
                        "Saving...";
                }


                try {

                    const formData =
                        new FormData(
                            profileForm
                        );


                    const response =
                        await fetch(
                            config.profileUrl,
                            {
                                method:
                                    "POST",

                                headers: {

                                    "Accept":
                                        "application/json",

                                    "X-CSRF-TOKEN":
                                        csrfToken,

                                    "X-Requested-With":
                                        "XMLHttpRequest"
                                },

                                credentials:
                                    "same-origin",

                                body:
                                    formData
                            }
                        );


                    const data =
                        await response.json();


                    if (!response.ok) {

                        if (
                            data.errors
                        ) {

                            const firstError =
                                Object.values(
                                    data.errors
                                )[0];


                            throw new Error(
                                Array.isArray(
                                    firstError
                                )
                                    ? firstError[0]
                                    : firstError
                            );
                        }


                        throw new Error(
                            data.message ||
                            "Unable to update profile."
                        );
                    }


                    showToast(
                        data.message ||
                        "Profile updated successfully.",
                        "success"
                    );


                    // ------------------------------------------------
                    // UPDATE AVATAR IF RETURNED
                    // ------------------------------------------------

                    if (
                        data.profile_photo_url
                    ) {

                        const avatar =
                            document.getElementById(
                                "profileAvatar"
                            );


                        if (avatar) {

                            avatar.innerHTML = `
                                <img
                                    src="${data.profile_photo_url}"
                                    alt="Profile photo"
                                >
                            `;
                        }
                    }


                } catch (error) {

                    console.error(
                        "Profile update error:",
                        error
                    );


                    showToast(
                        error.message ||
                        "Unable to update profile.",
                        "error"
                    );

                } finally {

                    if (submitButton) {

                        submitButton.disabled =
                            false;

                        submitButton.textContent =
                            originalText;
                    }
                }

            }
        );
    }


    // ============================================================
    // PASSWORD FORM
    // ============================================================

    const passwordForm =
        document.getElementById(
            "passwordForm"
        );


    if (passwordForm) {

        passwordForm.addEventListener(
            "submit",
            async function (event) {

                event.preventDefault();


                if (!config.passwordUrl) {

                    showToast(
                        "Password update URL is missing.",
                        "error"
                    );

                    return;
                }


                const submitButton =
                    passwordForm.querySelector(
                        'button[type="submit"]'
                    );


                const originalText =
                    submitButton?.textContent ||
                    "Update Password";


                if (submitButton) {

                    submitButton.disabled =
                        true;

                    submitButton.textContent =
                        "Updating...";
                }


                try {

                    const formData =
                        new FormData(
                            passwordForm
                        );


                    const response =
                        await fetch(
                            config.passwordUrl,
                            {
                                method:
                                    "POST",

                                headers: {

                                    "Accept":
                                        "application/json",

                                    "X-CSRF-TOKEN":
                                        csrfToken,

                                    "X-Requested-With":
                                        "XMLHttpRequest"
                                },

                                credentials:
                                    "same-origin",

                                body:
                                    formData
                            }
                        );


                    const data =
                        await response.json();


                    if (!response.ok) {

                        if (
                            data.errors
                        ) {

                            const firstError =
                                Object.values(
                                    data.errors
                                )[0];


                            throw new Error(
                                Array.isArray(
                                    firstError
                                )
                                    ? firstError[0]
                                    : firstError
                            );
                        }


                        throw new Error(
                            data.message ||
                            "Unable to update password."
                        );
                    }


                    showToast(
                        data.message ||
                        "Password updated successfully.",
                        "success"
                    );


                    passwordForm.reset();


                } catch (error) {

                    console.error(
                        "Password update error:",
                        error
                    );


                    showToast(
                        error.message ||
                        "Unable to update password.",
                        "error"
                    );

                } finally {

                    if (submitButton) {

                        submitButton.disabled =
                            false;

                        submitButton.textContent =
                            originalText;
                    }
                }

            }
        );
    }


    // ============================================================
    // PREFERENCE FORM
    // ============================================================

    const preferencesForm =
        document.getElementById(
            "preferencesForm"
        );


    if (preferencesForm) {

        preferencesForm.addEventListener(
            "submit",
            async function (event) {

                event.preventDefault();


                if (
                    !config.preferencesUrl
                ) {

                    showToast(
                        "Preferences update URL is missing.",
                        "error"
                    );

                    return;
                }


                const submitButton =
                    preferencesForm.querySelector(
                        'button[type="submit"]'
                    );


                const originalText =
                    submitButton?.textContent ||
                    "Save Preferences";


                if (submitButton) {

                    submitButton.disabled =
                        true;

                    submitButton.textContent =
                        "Saving...";
                }


                try {

                    const formData =
                        new FormData(
                            preferencesForm
                        );


                    const response =
                        await fetch(
                            config.preferencesUrl,
                            {
                                method:
                                    "POST",

                                headers: {

                                    "Accept":
                                        "application/json",

                                    "X-CSRF-TOKEN":
                                        csrfToken,

                                    "X-Requested-With":
                                        "XMLHttpRequest"
                                },

                                credentials:
                                    "same-origin",

                                body:
                                    formData
                            }
                        );


                    const data =
                        await response.json();


                    if (!response.ok) {

                        throw new Error(
                            data.message ||
                            "Unable to save preferences."
                        );
                    }


                    showToast(
                        data.message ||
                        "Preferences saved successfully.",
                        "success"
                    );


                } catch (error) {

                    console.error(
                        "Preferences error:",
                        error
                    );


                    showToast(
                        error.message ||
                        "Unable to save preferences.",
                        "error"
                    );

                } finally {

                    if (submitButton) {

                        submitButton.disabled =
                            false;

                        submitButton.textContent =
                            originalText;
                    }
                }

            }
        );
    }


    // ============================================================
    // APPEARANCE FORM
    // ============================================================

    const appearanceForm =
        document.getElementById(
            "appearanceForm"
        );


    if (appearanceForm) {

        appearanceForm.addEventListener(
            "submit",
            async function (event) {

                event.preventDefault();


                if (
                    !config.appearanceUrl
                ) {

                    showToast(
                        "Appearance update URL is missing.",
                        "error"
                    );

                    return;
                }


                const submitButton =
                    appearanceForm.querySelector(
                        'button[type="submit"]'
                    );


                const originalText =
                    submitButton?.textContent ||
                    "Save Appearance";


                if (submitButton) {

                    submitButton.disabled =
                        true;

                    submitButton.textContent =
                        "Saving...";
                }


                try {

                    const formData =
                        new FormData(
                            appearanceForm
                        );


                    const response =
                        await fetch(
                            config.appearanceUrl,
                            {
                                method:
                                    "POST",

                                headers: {

                                    "Accept":
                                        "application/json",

                                    "X-CSRF-TOKEN":
                                        csrfToken,

                                    "X-Requested-With":
                                        "XMLHttpRequest"
                                },

                                credentials:
                                    "same-origin",

                                body:
                                    formData
                            }
                        );


                    const data =
                        await response.json();


                    if (!response.ok) {

                        throw new Error(
                            data.message ||
                            "Unable to save appearance settings."
                        );
                    }


                    showToast(
                        data.message ||
                        "Appearance settings saved successfully.",
                        "success"
                    );


                } catch (error) {

                    console.error(
                        "Appearance error:",
                        error
                    );


                    showToast(
                        error.message ||
                        "Unable to save appearance settings.",
                        "error"
                    );

                } finally {

                    if (submitButton) {

                        submitButton.disabled =
                            false;

                        submitButton.textContent =
                            originalText;
                    }
                }

            }
        );
    }


    // ============================================================
    // PROFILE IMAGE PREVIEW
    // ============================================================

    const profilePhotoInput =
        document.getElementById(
            "profilePhoto"
        );


    const profileAvatar =
        document.getElementById(
            "profileAvatar"
        );


    if (
        profilePhotoInput &&
        profileAvatar
    ) {

        profilePhotoInput.addEventListener(
            "change",
            function () {

                const file =
                    this.files?.[0];


                if (!file) {

                    return;
                }


                // ------------------------------------------------
                // VALIDATE TYPE
                // ------------------------------------------------

                const allowedTypes = [
                    "image/jpeg",
                    "image/png",
                    "image/webp"
                ];


                if (
                    !allowedTypes.includes(
                        file.type
                    )
                ) {

                    showToast(
                        "Please select a JPG, PNG, or WEBP image.",
                        "error"
                    );


                    this.value =
                        "";

                    return;
                }


                // ------------------------------------------------
                // VALIDATE SIZE
                // ------------------------------------------------

                const maxSize =
                    2 * 1024 * 1024;


                if (
                    file.size >
                    maxSize
                ) {

                    showToast(
                        "Profile photo must not exceed 2 MB.",
                        "error"
                    );


                    this.value =
                        "";

                    return;
                }


                // ------------------------------------------------
                // PREVIEW
                // ------------------------------------------------

                const reader =
                    new FileReader();


                reader.onload =
                    function (event) {

                        profileAvatar.innerHTML = `
                            <img
                                src="${event.target.result}"
                                alt="Profile preview"
                            >
                        `;
                    };


                reader.readAsDataURL(
                    file
                );
            }
        );
    }


    // ============================================================
    // PASSWORD VISIBILITY
    // ============================================================

    const passwordToggles =
        document.querySelectorAll(
            "[data-password-toggle]"
        );


    passwordToggles.forEach(
        function (button) {

            button.addEventListener(
                "click",
                function () {

                    const targetId =
                        this.dataset.passwordToggle;


                    const input =
                        document.getElementById(
                            targetId
                        );


                    if (!input) {

                        return;
                    }


                    if (
                        input.type ===
                        "password"
                    ) {

                        input.type =
                            "text";

                    } else {

                        input.type =
                            "password";
                    }
                }
            );
        }
    );


    // ============================================================
    // NOTIFICATION BUTTON
    // ============================================================

    const notificationButton =
        document.getElementById(
            "notificationButton"
        );


    if (notificationButton) {

        notificationButton.addEventListener(
            "click",
            function () {

                console.log(
                    "Notification button clicked."
                );


                const dropdown =
                    document.getElementById(
                        "notificationDropdown"
                    );


                if (!dropdown) {

                    return;
                }


                dropdown.classList.toggle(
                    "show"
                );
            }
        );
    }


    // ============================================================
    // CLOSE NOTIFICATION DROPDOWN
    // ============================================================

    document.addEventListener(
        "click",
        function (event) {

            const dropdown =
                document.getElementById(
                    "notificationDropdown"
                );


            if (
                !dropdown ||
                !notificationButton
            ) {

                return;
            }


            if (
                !dropdown.contains(
                    event.target
                ) &&
                !notificationButton.contains(
                    event.target
                )
            ) {

                dropdown.classList.remove(
                    "show"
                );
            }
        }
    );


    // ============================================================
    // MOBILE MENU
    // ============================================================

    const mobileMenuButton =
        document.getElementById(
            "mobileMenuButton"
        );


    if (mobileMenuButton) {

        mobileMenuButton.addEventListener(
            "click",
            function () {

                document.body.classList.toggle(
                    "mobile-menu-open"
                );


                const sidebar =
                    document.querySelector(
                        ".sidebar"
                    );


                if (sidebar) {

                    sidebar.classList.toggle(
                        "open"
                    );
                }
            }
        );
    }


    // ============================================================
    // CLOSE MOBILE MENU
    // ============================================================

    document.addEventListener(
        "click",
        function (event) {

            const sidebar =
                document.querySelector(
                    ".sidebar"
                );


            if (
                !sidebar ||
                !mobileMenuButton
            ) {

                return;
            }


            if (
                window.innerWidth <=
                768
            ) {

                if (
                    sidebar.contains(
                        event.target
                    ) ||
                    mobileMenuButton.contains(
                        event.target
                    )
                ) {

                    return;
                }


                sidebar.classList.remove(
                    "open"
                );


                document.body.classList.remove(
                    "mobile-menu-open"
                );
            }
        }
    );


    // ============================================================
    // FINISHED
    // ============================================================

    console.log(
        "Dentist settings JavaScript loaded successfully."
    );

});
