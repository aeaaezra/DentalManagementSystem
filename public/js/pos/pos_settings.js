/* =========================================================
   SHINE AND SMILE POS
   SETTINGS JAVASCRIPT
========================================================= */


/* =========================================================
   CSRF TOKEN
========================================================= */

function csrfToken() {
    return document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content') || '';
}


/* =========================================================
   SECTION NAVIGATION
========================================================= */

function showSection(section) {

    // Hide all sections
    document
        .querySelectorAll('.settings-section')
        .forEach(element => {
            element.classList.add('hidden');
        });

    // Show selected section
    const selected = document.getElementById(
        `section-${section}`
    );

    if (selected) {
        selected.classList.remove('hidden');
    }

    // Remove active state
    document
        .querySelectorAll('.settings-nav')
        .forEach(button => {
            button.classList.remove('active');
        });

    // Add active state
    const activeButton = document.querySelector(
        `.settings-nav[data-section="${section}"]`
    );

    if (activeButton) {
        activeButton.classList.add('active');
    }

    // Remember selected section
    localStorage.setItem(
        'pos-settings-section',
        section
    );
}


/* =========================================================
   TOAST
========================================================= */

function showToast(message, type = 'success') {

    const toast = document.getElementById('toast');
    const messageElement =
        document.getElementById('toast-message');

    if (!toast || !messageElement) {
        alert(message);
        return;
    }

    messageElement.textContent = message;

    // Change toast color
    toast.classList.remove(
        'bg-red-600',
        'bg-[#251C22]'
    );

    if (type === 'error') {
        toast.classList.add('bg-red-600');
    } else {
        toast.classList.add('bg-[#251C22]');
    }

    toast.classList.remove('hidden');

    clearTimeout(window.toastTimer);

    window.toastTimer = setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
}


/* =========================================================
   API HELPER
========================================================= */

async function sendRequest(
    url,
    method = 'POST',
    data = null
) {

    const options = {
        method: method,
        headers: {
            'X-CSRF-TOKEN': csrfToken(),
            'Accept': 'application/json'
        }
    };

    // FormData
    if (data instanceof FormData) {

        options.body = data;

    }

    // JSON
    else if (data !== null) {

        options.headers['Content-Type'] =
            'application/json';

        options.body = JSON.stringify(data);
    }

    let response;

    try {

        response = await fetch(url, options);

    } catch (error) {

        throw new Error(
            'Unable to connect to the server.'
        );
    }


    /* =====================================================
       RESPONSE
    ===================================================== */

    const contentType =
        response.headers.get('content-type') || '';

    let result = {};

    if (contentType.includes('application/json')) {

        try {

            result = await response.json();

        } catch (error) {

            result = {};
        }

    } else {

        const text = await response.text();

        if (!response.ok) {

            console.error(
                'Server response:',
                text
            );

            throw new Error(
                `Server error (${response.status}). Check Laravel logs.`
            );
        }
    }


    /* =====================================================
       ERROR HANDLING
    ===================================================== */

    if (!response.ok) {

        let message =
            result.message ||
            'Something went wrong.';

        // Laravel validation errors
        if (result.errors) {

            const firstError =
                Object.values(result.errors)[0];

            if (
                Array.isArray(firstError) &&
                firstError.length
            ) {
                message = firstError[0];
            }
        }

        throw new Error(message);
    }

    return result;
}


/* =========================================================
   SAFE ELEMENT HELPERS
========================================================= */

function getElement(selector) {
    return document.querySelector(selector);
}


function getValue(selector, fallback = '') {

    const element = getElement(selector);

    return element
        ? element.value
        : fallback;
}


function isChecked(selector, fallback = false) {

    const element = getElement(selector);

    return element
        ? element.checked
        : fallback;
}


/* =========================================================
   PROFILE
========================================================= */

async function saveProfile() {

    const name =
        getValue('#profile-name').trim();

    const email =
        getValue('#profile-email').trim();

    const phone =
        getValue('#profile-phone').trim();


    // Validation
    if (!name) {

        showToast(
            'Please enter your full name.',
            'error'
        );

        return;
    }


    if (!email) {

        showToast(
            'Please enter your email address.',
            'error'
        );

        return;
    }


    try {

        const result = await sendRequest(
            '/pos/settings/profile',
            'PUT',
            {
                name: name,
                email: email,
                phone: phone
            }
        );

        showToast(
            result.message ||
            'Profile updated successfully.'
        );


        // Update displayed user name
        document
            .querySelectorAll('[data-profile-name]')
            .forEach(element => {
                element.textContent = name;
            });


    } catch (error) {

        console.error(
            'Profile error:',
            error
        );

        showToast(
            error.message,
            'error'
        );
    }
}


/* =========================================================
   PROFILE PHOTO
========================================================= */

async function uploadProfilePhoto(input) {

    if (
        !input ||
        !input.files ||
        !input.files.length
    ) {
        return;
    }


    const file = input.files[0];


    // Client-side validation
    const allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    if (!allowedTypes.includes(file.type)) {

        showToast(
            'Please select a JPG, PNG, or WEBP image.',
            'error'
        );

        input.value = '';

        return;
    }


    // 5 MB limit
    if (file.size > 5 * 1024 * 1024) {

        showToast(
            'Profile picture must not exceed 5 MB.',
            'error'
        );

        input.value = '';

        return;
    }


    try {

        const formData = new FormData();

        formData.append(
            'profile_picture',
            file
        );


        const result = await sendRequest(
            '/pos/settings/profile/photo',
            'POST',
            formData
        );


        // Update all profile images
        if (result.image_url) {

            document
                .querySelectorAll('[data-profile-image]')
                .forEach(image => {

                    image.src =
                        result.image_url +
                        '?t=' +
                        Date.now();

                });
        }


        showToast(
            result.message ||
            'Profile picture updated successfully.'
        );


    } catch (error) {

        console.error(
            'Profile photo error:',
            error
        );

        showToast(
            error.message,
            'error'
        );

    } finally {

        input.value = '';
    }
}


/* =========================================================
   REMOVE PROFILE PHOTO
========================================================= */

async function removeProfilePhoto() {

    if (
        !confirm(
            'Remove your profile picture?'
        )
    ) {
        return;
    }


    try {

        const result = await sendRequest(
            '/pos/settings/profile/photo',
            'DELETE'
        );


        if (result.image_url) {

            document
                .querySelectorAll('[data-profile-image]')
                .forEach(image => {

                    image.src =
                        result.image_url +
                        '?t=' +
                        Date.now();

                });

        } else {

            location.reload();

        }


        showToast(
            result.message ||
            'Profile picture removed.'
        );


    } catch (error) {

        console.error(
            'Remove photo error:',
            error
        );

        showToast(
            error.message,
            'error'
        );
    }
}


/* =========================================================
   PASSWORD
========================================================= */

async function updatePassword() {

    const currentPassword =
        getValue('#current-password');

    const newPassword =
        getValue('#new-password');

    const confirmPassword =
        getValue('#confirm-password');


    /* =====================================================
       VALIDATION
    ===================================================== */

    if (
        !currentPassword ||
        !newPassword ||
        !confirmPassword
    ) {

        showToast(
            'Please fill in all password fields.',
            'error'
        );

        return;
    }


    if (newPassword !== confirmPassword) {

        showToast(
            'New passwords do not match.',
            'error'
        );

        return;
    }


    if (newPassword.length < 8) {

        showToast(
            'New password must be at least 8 characters.',
            'error'
        );

        return;
    }


    try {

        const result = await sendRequest(
            '/pos/settings/password',
            'PUT',
            {
                current_password:
                    currentPassword,

                new_password:
                    newPassword,

                new_password_confirmation:
                    confirmPassword
            }
        );


        // Clear fields
        const current =
            getElement('#current-password');

        const newPass =
            getElement('#new-password');

        const confirm =
            getElement('#confirm-password');


        if (current) {
            current.value = '';
        }

        if (newPass) {
            newPass.value = '';
        }

        if (confirm) {
            confirm.value = '';
        }


        showToast(
            result.message ||
            'Password updated successfully.'
        );


    } catch (error) {

        console.error(
            'Password error:',
            error
        );

        showToast(
            error.message,
            'error'
        );
    }
}


/* =========================================================
   PASSWORD VISIBILITY
========================================================= */

function togglePassword(
    inputId,
    button
) {

    const input =
        document.getElementById(inputId);

    if (!input) {
        return;
    }


    if (input.type === 'password') {

        input.type = 'text';

    } else {

        input.type = 'password';
    }


    // Change opacity of eye icon
    if (button) {

        button.classList.toggle(
            'text-primary'
        );
    }
}


/* =========================================================
   POS SETTINGS
========================================================= */

async function savePOSSettings() {

    const data = {

        register_number:
            getValue(
                '[name="register_number"]'
            ),

        currency:
            getValue(
                '[name="currency"]',
                'PHP'
            ),

        show_cashier_name:
            isChecked(
                '[name="show_cashier_name"]'
            ),

        show_customer_information:
            isChecked(
                '[name="show_customer_information"]'
            ),

        show_product_sku:
            isChecked(
                '[name="show_product_sku"]'
            ),

        prevent_negative_stock:
            isChecked(
                '[name="prevent_negative_stock"]'
            ),

        low_stock_warnings:
            isChecked(
                '[name="low_stock_warnings"]'
            )
    };


    try {

        const result = await sendRequest(
            '/pos/settings/pos',
            'PUT',
            data
        );


        showToast(
            result.message ||
            'POS settings saved successfully.'
        );


    } catch (error) {

        console.error(
            'POS settings error:',
            error
        );

        showToast(
            error.message,
            'error'
        );
    }
}


/* =========================================================
   APPEARANCE
========================================================= */

async function saveAppearance() {

    const theme =
        localStorage.getItem(
            'pos-theme'
        ) || 'light';


    const compact =
        isChecked(
            '[name="compact_layout"]'
        );


    try {

        const result = await sendRequest(
            '/pos/settings/appearance',
            'PUT',
            {
                theme: theme,
                compact_layout: compact
            }
        );


        showToast(
            result.message ||
            'Appearance settings saved successfully.'
        );


    } catch (error) {

        console.error(
            'Appearance error:',
            error
        );

        showToast(
            error.message,
            'error'
        );
    }
}


/* =========================================================
   THEME
========================================================= */

function setTheme(theme) {

    if (theme === 'dark') {

        document.documentElement
            .classList.add('dark');

    } else {

        document.documentElement
            .classList.remove('dark');
    }


    localStorage.setItem(
        'pos-theme',
        theme
    );


    // Only save if user is authenticated
    saveAppearance();
}


function toggleDarkMode() {

    const isDark =
        document.documentElement
            .classList.contains('dark');


    setTheme(
        isDark
            ? 'light'
            : 'dark'
    );
}


/* =========================================================
   NOTIFICATIONS
========================================================= */

async function saveNotifications() {

    const data = {

        low_stock_alerts:
            isChecked(
                '[name="low_stock_alerts"]'
            ),

        completed_sale_notifications:
            isChecked(
                '[name="completed_sale_notifications"]'
            ),

        system_announcements:
            isChecked(
                '[name="system_announcements"]'
            ),

        sound_notifications:
            isChecked(
                '[name="sound_notifications"]'
            )
    };


    try {

        const result = await sendRequest(
            '/pos/settings/notifications',
            'PUT',
            data
        );


        showToast(
            result.message ||
            'Notification settings saved successfully.'
        );


    } catch (error) {

        console.error(
            'Notification settings error:',
            error
        );

        showToast(
            error.message,
            'error'
        );
    }
}


/* =========================================================
   SECURITY
========================================================= */

async function saveSecurity() {

    const data = {

        auto_logout:
            isChecked(
                '[name="auto_logout"]'
            ),

        confirm_before_logout:
            isChecked(
                '[name="confirm_before_logout"]',
                true
            )
    };


    try {

        const result = await sendRequest(
            '/pos/settings/security',
            'PUT',
            data
        );


        showToast(
            result.message ||
            'Security settings saved successfully.'
        );


    } catch (error) {

        console.error(
            'Security settings error:',
            error
        );

        showToast(
            error.message,
            'error'
        );
    }
}


/* =========================================================
   INITIALIZE
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    () => {

        /* ================================================
           THEME
        ================================================ */

        const savedTheme =
            localStorage.getItem(
                'pos-theme'
            );


        if (savedTheme === 'dark') {

            document.documentElement
                .classList.add('dark');

        } else {

            document.documentElement
                .classList.remove('dark');
        }


        /* ================================================
           SETTINGS SECTION
        ================================================ */

        const savedSection =
            localStorage.getItem(
                'pos-settings-section'
            );


        const validSections = [
            'profile',
            'password',
            'pos',
            'appearance',
            'notifications',
            'security',
            'system'
        ];


        const section =
            validSections.includes(savedSection)
                ? savedSection
                : 'profile';


        showSection(section);
    }
);
