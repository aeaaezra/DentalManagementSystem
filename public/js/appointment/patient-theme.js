(function () {
    'use strict';

    const STORAGE_KEY = 'patientDarkMode';


    // ============================================================
    // GET SAVED THEME
    // ============================================================

    function getSavedTheme() {
        try {
            return localStorage.getItem(STORAGE_KEY) === 'true';
        } catch (error) {
            return false;
        }
    }


    // ============================================================
    // APPLY THEME
    // ============================================================

    function applyTheme(isDark) {

        const root = document.documentElement;

        // Apply to HTML
        root.classList.toggle('dark-mode', isDark);

        // Apply to BODY when available
        if (document.body) {
            document.body.classList.toggle('dark-mode', isDark);
        }

        // Browser color scheme
        root.style.colorScheme = isDark
            ? 'dark'
            : 'light';
    }


    // ============================================================
    // SAVE THEME
    // ============================================================

    function saveTheme(isDark) {

        try {

            localStorage.setItem(
                STORAGE_KEY,
                isDark ? 'true' : 'false'
            );

        } catch (error) {

            console.error(
                'Unable to save theme preference:',
                error
            );

        }
    }


    // ============================================================
    // APPLY SAVED THEME IMMEDIATELY
    // ============================================================

    applyTheme(getSavedTheme());


    // ============================================================
    // PAGE LOADED
    // ============================================================

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            // Apply saved theme again after BODY exists
            applyTheme(getSavedTheme());


            // Find Settings dark-mode switch
            const toggle =
                document.getElementById(
                    'darkModeToggle'
                );


            if (!toggle) {
                return;
            }


            // Set switch to saved value
            toggle.checked = getSavedTheme();


            // Prevent duplicate listeners
            if (
                toggle.dataset.themeListenerAttached === 'true'
            ) {
                return;
            }


            toggle.dataset.themeListenerAttached = 'true';


            // ====================================================
            // TOGGLE DARK MODE
            // ====================================================

            toggle.addEventListener(
                'change',
                function () {

                    const isDark = this.checked;


                    // Apply
                    applyTheme(isDark);


                    // Save
                    saveTheme(isDark);


                    // Notify other scripts
                    window.dispatchEvent(
                        new CustomEvent(
                            'patient-theme-change',
                            {
                                detail: {
                                    dark: isDark
                                }
                            }
                        )
                    );

                }
            );

        }
    );


    // ============================================================
    // GLOBAL API
    // ============================================================

    window.PatientTheme = {

        isDark: function () {

            return document.documentElement
                .classList
                .contains('dark-mode');

        },


        set: function (isDark) {

            const value = Boolean(isDark);

            applyTheme(value);
            saveTheme(value);

            window.dispatchEvent(
                new CustomEvent(
                    'patient-theme-change',
                    {
                        detail: {
                            dark: value
                        }
                    }
                )
            );

        },


        get: function () {

            return getSavedTheme();

        }

    };

})();
