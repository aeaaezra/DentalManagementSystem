<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Settings - Shine and Smile POS</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',

            theme: {
                extend: {
                    colors: {
                        primary: '#E91E63',
                        secondary: '#F8BBD0',
                        highlight: '#EC4899',
                        bgLight: '#FFF1F5',
                        darkBg: '#181216',
                        darkCard: '#251C22'
                    },

                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        };
    </script>

    <!-- Inter -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >
</head>


<body
    class="min-h-screen
           bg-[#FFF1F5]
           dark:bg-[#181216]
           text-gray-800
           dark:text-gray-100
           font-sans"
>


<!-- =========================================================
     HEADER
========================================================= -->

<header
    class="h-16
           bg-white
           dark:bg-[#251C22]
           border-b
           border-pink-100
           dark:border-pink-900/30
           px-4 md:px-6
           flex items-center justify-between
           shadow-sm
           sticky top-0 z-50"
>

    <!-- LEFT -->

    <div class="flex items-center gap-3">

        <!-- Back to POS -->

        <a
            href="{{ url('/pos/homepage') }}"
            class="w-10 h-10
                   rounded-xl
                   bg-pink-50
                   dark:bg-pink-950/40
                   text-primary
                   flex items-center justify-center
                   hover:bg-pink-100
                   dark:hover:bg-pink-900/50
                   transition"
            title="Back to POS"
        >

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                />
            </svg>

        </a>


        <!-- Settings Icon -->

        <div
            class="w-10 h-10
                   rounded-xl
                   bg-gradient-to-tr
                   from-primary
                   to-highlight
                   text-white
                   flex items-center justify-center
                   shadow-md
                   shadow-pink-500/20"
        >

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10.325 4.317
                       a1.724 1.724 0 013.35 0
                       1.724 1.724 0 002.573 1.066
                       1.724 1.724 0 012.37 2.37
                       1.724 1.724 0 001.065 2.573
                       1.724 1.724 0 010 3.35
                       1.724 1.724 0 00-1.066 2.573
                       1.724 1.724 0 01-2.37 2.37
                       1.724 1.724 0 00-2.573 1.065
                       1.724 1.724 0 01-3.35 0
                       1.724 1.724 0 00-2.573-1.066
                       1.724 1.724 0 01-2.37-2.37
                       1.724 1.724 0 00-1.065-2.573
                       1.724 1.724 0 010-3.35
                       1.724 1.724 0 001.066-2.573
                       1.724 1.724 0 012.37-2.37
                       1.724 1.724 0 002.573-1.065z"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 12a3 3 0 11-6 0
                       3 3 0 016 0z"
                />
            </svg>

        </div>


        <div>

            <h1 class="font-bold text-lg">
                Settings
            </h1>

            <p class="text-xs text-gray-400">
                Manage your POS system
            </p>

        </div>

    </div>


    <!-- RIGHT -->

    <div class="flex items-center gap-2">

        <!-- Dark Mode -->

        <button
            type="button"
            onclick="toggleDarkMode()"
            class="w-10 h-10
                   rounded-xl
                   bg-pink-50
                   dark:bg-pink-950/40
                   text-primary
                   flex items-center justify-center
                   hover:bg-pink-100
                   dark:hover:bg-pink-900/50
                   transition"
            title="Toggle dark mode"
        >

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 12.79A9 9 0 1111.21 3
                       7 7 0 0021 12.79z"
                />
            </svg>

        </button>


        <!-- User -->

        @auth

            <div
                class="hidden sm:flex
                       items-center gap-2
                       bg-pink-50
                       dark:bg-pink-950/40
                       px-3 py-1.5
                       rounded-xl"
            >

                <img
                    src="{{ auth()->user()->profile_picture
                        ? asset('storage/' . auth()->user()->profile_picture)
                        : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=E91E63&color=ffffff'
                    }}"
                    alt="{{ auth()->user()->name }}"
                    class="w-8 h-8 rounded-full object-cover"
                >

                <div>

                    <p class="text-xs font-semibold">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-[10px] text-gray-500 dark:text-gray-400">
                        {{ auth()->user()->role ?? 'Cashier' }}
                    </p>

                </div>

            </div>

        @endauth

    </div>

</header>



<!-- =========================================================
     MAIN
========================================================= -->

<main class="max-w-7xl mx-auto px-4 md:px-6 py-8">


    <!-- PAGE HEADER -->

    <div class="mb-8">

        <h2 class="text-2xl md:text-3xl font-extrabold">
            System Settings
        </h2>

        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Customize your account and Shine and Smile POS preferences.
        </p>

    </div>



    <!-- =====================================================
         SETTINGS LAYOUT
    ====================================================== -->

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">


        <!-- =================================================
             SIDEBAR
        ================================================== -->

        <aside
            class="bg-white
                   dark:bg-[#251C22]
                   rounded-3xl
                   border
                   border-pink-100
                   dark:border-pink-900/30
                   shadow-sm
                   p-3
                   h-fit"
        >

            <!-- Profile -->

            <button
                type="button"
                onclick="showSection('profile')"
                data-section="profile"
                class="settings-nav active w-full
                       flex items-center gap-3
                       px-4 py-3
                       rounded-xl
                       text-left
                       transition"
            >

                <span
                    class="settings-icon
                           w-9 h-9
                           rounded-xl
                           bg-pink-100
                           dark:bg-pink-950/40
                           text-primary
                           flex items-center justify-center"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0
                               4 4 0 018 0z
                               M12 14a7 7 0 00-7 7h14
                               a7 7 0 00-7-7z"
                        />
                    </svg>

                </span>

                <span>
                    <span class="block text-sm font-semibold">
                        Profile
                    </span>

                    <span class="block text-[11px] text-gray-400">
                        Personal information
                    </span>
                </span>

            </button>


            <!-- Password -->

            <button
                type="button"
                onclick="showSection('password')"
                data-section="password"
                class="settings-nav w-full
                       flex items-center gap-3
                       px-4 py-3
                       rounded-xl
                       text-left
                       transition"
            >

                <span
                    class="settings-icon
                           w-9 h-9
                           rounded-xl
                           bg-gray-100
                           dark:bg-gray-800
                           text-gray-500
                           flex items-center justify-center"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 15v2
                               m-6 4h12
                               a2 2 0 002-2v-6
                               a2 2 0 00-2-2H6
                               a2 2 0 00-2 2v6
                               a2 2 0 002 2z
                               M8 11V7
                               a4 4 0 118 0v4"
                        />
                    </svg>

                </span>

                <span>
                    <span class="block text-sm font-semibold">
                        Password
                    </span>

                    <span class="block text-[11px] text-gray-400">
                        Change password
                    </span>
                </span>

            </button>


            <!-- POS -->

            <button
                type="button"
                onclick="showSection('pos')"
                data-section="pos"
                class="settings-nav w-full
                       flex items-center gap-3
                       px-4 py-3
                       rounded-xl
                       text-left
                       transition"
            >

                <span
                    class="settings-icon
                           w-9 h-9
                           rounded-xl
                           bg-gray-100
                           dark:bg-gray-800
                           text-gray-500
                           flex items-center justify-center"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <rect
                            x="3"
                            y="4"
                            width="18"
                            height="16"
                            rx="2"
                            stroke-width="2"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-width="2"
                            d="M7 8h10M7 12h4M7 16h2"
                        />
                    </svg>

                </span>

                <span>
                    <span class="block text-sm font-semibold">
                        POS Settings
                    </span>

                    <span class="block text-[11px] text-gray-400">
                        Register preferences
                    </span>
                </span>

            </button>


            <!-- Appearance -->

            <button
                type="button"
                onclick="showSection('appearance')"
                data-section="appearance"
                class="settings-nav w-full
                       flex items-center gap-3
                       px-4 py-3
                       rounded-xl
                       text-left
                       transition"
            >

                <span
                    class="settings-icon
                           w-9 h-9
                           rounded-xl
                           bg-gray-100
                           dark:bg-gray-800
                           text-gray-500
                           flex items-center justify-center"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 3v1
                               M12 20v1
                               M4.22 4.22l.7.7
                               M19.08 19.08l.7.7
                               M3 12h1
                               M20 12h1
                               M4.22 19.78l.7-.7
                               M19.08 4.92l.7-.7
                               M12 7a5 5 0 100 10
                               5 5 0 000-10z"
                        />
                    </svg>

                </span>

                <span>
                    <span class="block text-sm font-semibold">
                        Appearance
                    </span>

                    <span class="block text-[11px] text-gray-400">
                        Theme and display
                    </span>
                </span>

            </button>


            <!-- Notifications -->

            <button
                type="button"
                onclick="showSection('notifications')"
                data-section="notifications"
                class="settings-nav w-full
                       flex items-center gap-3
                       px-4 py-3
                       rounded-xl
                       text-left
                       transition"
            >

                <span
                    class="settings-icon
                           w-9 h-9
                           rounded-xl
                           bg-gray-100
                           dark:bg-gray-800
                           text-gray-500
                           flex items-center justify-center"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M18 8a6 6 0 00-12 0
                               c0 7-3 7-3 9h18c0-2-3-2-3-9z
                               M13.73 21a2 2 0 01-3.46 0"
                        />
                    </svg>

                </span>

                <span>
                    <span class="block text-sm font-semibold">
                        Notifications
                    </span>

                    <span class="block text-[11px] text-gray-400">
                        Alerts and reminders
                    </span>
                </span>

            </button>


            <!-- Security -->

            <button
                type="button"
                onclick="showSection('security')"
                data-section="security"
                class="settings-nav w-full
                       flex items-center gap-3
                       px-4 py-3
                       rounded-xl
                       text-left
                       transition"
            >

                <span
                    class="settings-icon
                           w-9 h-9
                           rounded-xl
                           bg-gray-100
                           dark:bg-gray-800
                           text-gray-500
                           flex items-center justify-center"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 2l8 4v6
                               c0 5-3.5 8.5-8 10
                               C7.5 20.5 4 17 4 12V6l8-4z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4"
                        />
                    </svg>

                </span>

                <span>
                    <span class="block text-sm font-semibold">
                        Security
                    </span>

                    <span class="block text-[11px] text-gray-400">
                        Account security
                    </span>
                </span>

            </button>


            <!-- System -->

            <button
                type="button"
                onclick="showSection('system')"
                data-section="system"
                class="settings-nav w-full
                       flex items-center gap-3
                       px-4 py-3
                       rounded-xl
                       text-left
                       transition"
            >

                <span
                    class="settings-icon
                           w-9 h-9
                           rounded-xl
                           bg-gray-100
                           dark:bg-gray-800
                           text-gray-500
                           flex items-center justify-center"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 4h16v16H4z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 8h8M8 12h8M8 16h5"
                        />
                    </svg>

                </span>

                <span>
                    <span class="block text-sm font-semibold">
                        System
                    </span>

                    <span class="block text-[11px] text-gray-400">
                        System information
                    </span>
                </span>

            </button>

        </aside>



        <!-- =================================================
             SETTINGS CONTENT
        ================================================== -->

        <section class="lg:col-span-3">


            <!-- =================================================
                 PROFILE
            ================================================== -->

            <div
                id="section-profile"
                class="settings-section"
            >

                <div class="settings-card">

                    <div class="settings-header">

                        <div class="settings-header-icon">

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0
                                       4 4 0 018 0z
                                       M12 14a7 7 0 00-7 7h14
                                       a7 7 0 00-7-7z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2>
                                Profile Information
                            </h2>

                            <p>
                                Manage your personal account details.
                            </p>

                        </div>

                    </div>


                    <!-- Profile Picture -->

                    <div
                        class="flex flex-col sm:flex-row
                               sm:items-center gap-5
                               p-5
                               rounded-2xl
                               bg-pink-50
                               dark:bg-pink-950/30
                               mb-6"
                    >

                        @auth

                            <img
                                src="{{ auth()->user()->profile_picture
                                    ? asset('storage/' . auth()->user()->profile_picture)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=E91E63&color=ffffff&size=160'
                                }}"
                                class="w-20 h-20
                                       rounded-2xl
                                       object-cover
                                       border-4
                                       border-white
                                       dark:border-[#251C22]
                                       shadow-md"
                            >

                            <div class="flex-1">

                                <h3 class="font-bold">
                                    {{ auth()->user()->name }}
                                </h3>

                                <p class="text-xs text-gray-500 mt-1">
                                    {{ auth()->user()->email }}
                                </p>

                                <div class="mt-3 flex gap-2">

                                    <button
                                        type="button"
                                        class="px-3 py-2
                                               rounded-lg
                                               bg-white
                                               dark:bg-[#251C22]
                                               border
                                               border-pink-200
                                               dark:border-pink-900/40
                                               text-xs
                                               font-semibold
                                               text-primary"
                                    >
                                        Change Photo
                                    </button>

                                    <button
                                        type="button"
                                        class="px-3 py-2
                                               rounded-lg
                                               text-xs
                                               font-semibold
                                               text-red-500
                                               hover:bg-red-50
                                               dark:hover:bg-red-950/30"
                                    >
                                        Remove
                                    </button>

                                </div>

                            </div>

                        @endauth

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Name -->

                        <div>

                            <label class="settings-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                value="{{ auth()->user()->name ?? '' }}"
                                class="settings-input"
                            >

                        </div>


                        <!-- Email -->

                        <div>

                            <label class="settings-label">
                                Email Address
                            </label>

                            <input
                                type="email"
                                value="{{ auth()->user()->email ?? '' }}"
                                class="settings-input"
                            >

                        </div>


                        <!-- Phone -->

                        <div>

                            <label class="settings-label">
                                Phone Number
                            </label>

                            <input
                                type="text"
                                value="{{ auth()->user()->phone ?? '' }}"
                                placeholder="+63 9XX XXX XXXX"
                                class="settings-input"
                            >

                        </div>


                        <!-- Role -->

                        <div>

                            <label class="settings-label">
                                Role
                            </label>

                            <input
                                type="text"
                                value="{{ auth()->user()->role ?? 'Cashier' }}"
                                disabled
                                class="settings-input
                                       opacity-60
                                       cursor-not-allowed"
                            >

                        </div>

                    </div>


                    <div class="settings-footer">

                        <button
                            type="button"
                            class="primary-button"
                            onclick="showToast('Profile changes saved successfully.')"
                        >
                            Save Changes
                        </button>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 PASSWORD
            ================================================== -->

            <div
                id="section-password"
                class="settings-section hidden"
            >

                <div class="settings-card">

                    <div class="settings-header">

                        <div class="settings-header-icon">

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 15v2
                                       m-6 4h12
                                       a2 2 0 002-2v-6
                                       a2 2 0 00-2-2H6
                                       a2 2 0 00-2 2v6
                                       a2 2 0 002 2z
                                       M8 11V7
                                       a4 4 0 118 0v4"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2>
                                Change Password
                            </h2>

                            <p>
                                Update your password to keep your account secure.
                            </p>

                        </div>

                    </div>


                    <div class="space-y-5">

                        <!-- Current -->

                        <div>

                            <label class="settings-label">
                                Current Password
                            </label>

                            <div class="relative">

                                <input
                                    type="password"
                                    id="current-password"
                                    class="settings-input pr-12"
                                    placeholder="Enter current password"
                                >

                                <button
                                    type="button"
                                    onclick="togglePassword('current-password', this)"
                                    class="password-eye"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M2 12s3.5-7 10-7
                                               10 7 10 7-3.5 7-10 7
                                               S2 12 2 12z"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="3"
                                            stroke-width="2"
                                        />
                                    </svg>
                                </button>

                            </div>

                        </div>


                        <!-- New -->

                        <div>

                            <label class="settings-label">
                                New Password
                            </label>

                            <input
                                type="password"
                                id="new-password"
                                class="settings-input"
                                placeholder="Enter new password"
                            >

                        </div>


                        <!-- Confirm -->

                        <div>

                            <label class="settings-label">
                                Confirm New Password
                            </label>

                            <input
                                type="password"
                                id="confirm-password"
                                class="settings-input"
                                placeholder="Confirm new password"
                            >

                        </div>


                        <!-- Requirements -->

                        <div
                            class="p-4
                                   rounded-xl
                                   bg-gray-50
                                   dark:bg-[#181216]"
                        >

                            <p class="text-xs font-semibold mb-2">
                                Password requirements
                            </p>

                            <ul
                                class="text-xs
                                       text-gray-500
                                       dark:text-gray-400
                                       space-y-1"
                            >

                                <li>• At least 8 characters</li>
                                <li>• Contains uppercase and lowercase letters</li>
                                <li>• Contains at least one number</li>
                                <li>• Contains at least one special character</li>

                            </ul>

                        </div>

                    </div>


                    <div class="settings-footer">

                        <button
                            type="button"
                            class="primary-button"
                            onclick="showToast('Password update ready.')"
                        >
                            Update Password
                        </button>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 POS SETTINGS
            ================================================== -->

            <div
                id="section-pos"
                class="settings-section hidden"
            >

                <div class="settings-card">

                    <div class="settings-header">

                        <div class="settings-header-icon">

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <rect
                                    x="3"
                                    y="4"
                                    width="18"
                                    height="16"
                                    rx="2"
                                    stroke-width="2"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-width="2"
                                    d="M7 8h10M7 12h4M7 16h2"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2>
                                POS Settings
                            </h2>

                            <p>
                                Configure how your dental POS operates.
                            </p>

                        </div>

                    </div>


                    <div class="space-y-6">

                        <!-- Register -->

                        <div>

                            <h3 class="font-semibold mb-3">
                                Register
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <div>

                                    <label class="settings-label">
                                        Register Number
                                    </label>

                                    <input
                                        type="text"
                                        value="Register #04"
                                        class="settings-input"
                                    >

                                </div>


                                <div>

                                    <label class="settings-label">
                                        Currency
                                    </label>

                                    <select class="settings-input">

                                        <option selected>
                                            Philippine Peso (₱)
                                        </option>

                                        <option>
                                            US Dollar ($)
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>


                        <!-- Receipt -->

                        <div>

                            <h3 class="font-semibold mb-3">
                                Receipt
                            </h3>

                            <div class="space-y-3">

                                <label class="setting-toggle">

                                    <span>

                                        <strong>
                                            Show cashier name
                                        </strong>

                                        <small>
                                            Display cashier information on receipts.
                                        </small>

                                    </span>

                                    <input
                                        type="checkbox"
                                        checked
                                        class="toggle-input"
                                    >

                                </label>


                                <label class="setting-toggle">

                                    <span>

                                        <strong>
                                            Show customer information
                                        </strong>

                                        <small>
                                            Include customer/patient information.
                                        </small>

                                    </span>

                                    <input
                                        type="checkbox"
                                        checked
                                        class="toggle-input"
                                    >

                                </label>


                                <label class="setting-toggle">

                                    <span>

                                        <strong>
                                            Show product SKU
                                        </strong>

                                        <small>
                                            Display SKU on printed receipts.
                                        </small>

                                    </span>

                                    <input
                                        type="checkbox"
                                        class="toggle-input"
                                    >

                                </label>

                            </div>

                        </div>


                        <!-- Inventory -->

                        <div>

                            <h3 class="font-semibold mb-3">
                                Inventory
                            </h3>

                            <div class="space-y-3">

                                <label class="setting-toggle">

                                    <span>

                                        <strong>
                                            Prevent negative stock
                                        </strong>

                                        <small>
                                            Prevent checkout when inventory is insufficient.
                                        </small>

                                    </span>

                                    <input
                                        type="checkbox"
                                        checked
                                        class="toggle-input"
                                    >

                                </label>


                                <label class="setting-toggle">

                                    <span>

                                        <strong>
                                            Low-stock warnings
                                        </strong>

                                        <small>
                                            Alert cashiers when products are running low.
                                        </small>

                                    </span>

                                    <input
                                        type="checkbox"
                                        checked
                                        class="toggle-input"
                                    >

                                </label>

                            </div>

                        </div>

                    </div>


                    <div class="settings-footer">

                        <button
                            type="button"
                            class="primary-button"
                            onclick="showToast('POS settings saved successfully.')"
                        >
                            Save POS Settings
                        </button>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 APPEARANCE
            ================================================== -->

            <div
                id="section-appearance"
                class="settings-section hidden"
            >

                <div class="settings-card">

                    <div class="settings-header">

                        <div class="settings-header-icon">

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 3v1
                                       M12 20v1
                                       M4.22 4.22l.7.7
                                       M19.08 19.08l.7.7
                                       M3 12h1
                                       M20 12h1
                                       M4.22 19.78l.7-.7
                                       M19.08 4.92l.7-.7
                                       M12 7a5 5 0 100 10
                                       5 5 0 000-10z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2>
                                Appearance
                            </h2>

                            <p>
                                Customize the look and feel of your POS.
                            </p>

                        </div>

                    </div>


                    <!-- Theme -->

                    <div>

                        <label class="settings-label">
                            Theme
                        </label>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


                            <!-- Light -->

                            <button
                                type="button"
                                onclick="setTheme('light')"
                                class="theme-card"
                            >

                                <div class="theme-preview light-preview">

                                    <div class="h-3 bg-white border-b"></div>

                                    <div class="p-2">
                                        <div class="w-16 h-2 bg-pink-200 rounded"></div>
                                        <div class="w-24 h-2 bg-gray-200 rounded mt-2"></div>
                                    </div>

                                </div>

                                <div class="mt-3">

                                    <p class="font-semibold text-sm">
                                        Light
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        Clean and bright
                                    </p>

                                </div>

                            </button>


                            <!-- Dark -->

                            <button
                                type="button"
                                onclick="setTheme('dark')"
                                class="theme-card"
                            >

                                <div class="theme-preview dark-preview">

                                    <div class="h-3 bg-[#251C22] border-b border-pink-900/30"></div>

                                    <div class="p-2">
                                        <div class="w-16 h-2 bg-pink-700 rounded"></div>
                                        <div class="w-24 h-2 bg-gray-700 rounded mt-2"></div>
                                    </div>

                                </div>

                                <div class="mt-3">

                                    <p class="font-semibold text-sm">
                                        Dark
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        Easy on the eyes
                                    </p>

                                </div>

                            </button>

                        </div>

                    </div>


                    <!-- Compact -->

                    <div class="mt-6">

                        <label class="setting-toggle">

                            <span>

                                <strong>
                                    Compact POS layout
                                </strong>

                                <small>
                                    Show more products and cart items on smaller screens.
                                </small>

                            </span>

                            <input
                                type="checkbox"
                                class="toggle-input"
                            >

                        </label>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 NOTIFICATIONS
            ================================================== -->

            <div
                id="section-notifications"
                class="settings-section hidden"
            >

                <div class="settings-card">

                    <div class="settings-header">

                        <div class="settings-header-icon">

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M18 8a6 6 0 00-12 0
                                       c0 7-3 7-3 9h18c0-2-3-2-3-9z
                                       M13.73 21a2 2 0 01-3.46 0"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2>
                                Notifications
                            </h2>

                            <p>
                                Choose which alerts you want to receive.
                            </p>

                        </div>

                    </div>


                    <div class="space-y-3">

                        <label class="setting-toggle">

                            <span>

                                <strong>
                                    Low-stock alerts
                                </strong>

                                <small>
                                    Notify when dental supplies reach low stock.
                                </small>

                            </span>

                            <input
                                type="checkbox"
                                checked
                                class="toggle-input"
                            >

                        </label>


                        <label class="setting-toggle">

                            <span>

                                <strong>
                                    Completed sale notifications
                                </strong>

                                <small>
                                    Show a notification after every completed sale.
                                </small>

                            </span>

                            <input
                                type="checkbox"
                                checked
                                class="toggle-input"
                            >

                        </label>


                        <label class="setting-toggle">

                            <span>

                                <strong>
                                    System announcements
                                </strong>

                                <small>
                                    Receive important system updates.
                                </small>

                            </span>

                            <input
                                type="checkbox"
                                checked
                                class="toggle-input"
                            >

                        </label>


                        <label class="setting-toggle">

                            <span>

                                <strong>
                                    Sound notifications
                                </strong>

                                <small>
                                    Play a sound for important POS events.
                                </small>

                            </span>

                            <input
                                type="checkbox"
                                class="toggle-input"
                            >

                        </label>

                    </div>


                    <div class="settings-footer">

                        <button
                            type="button"
                            class="primary-button"
                            onclick="showToast('Notification settings saved.')"
                        >
                            Save Notifications
                        </button>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 SECURITY
            ================================================== -->

            <div
                id="section-security"
                class="settings-section hidden"
            >

                <div class="settings-card">

                    <div class="settings-header">

                        <div class="settings-header-icon">

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 2l8 4v6
                                       c0 5-3.5 8.5-8 10
                                       C7.5 20.5 4 17 4 12V6l8-4z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2>
                                Security
                            </h2>

                            <p>
                                Protect your account and POS access.
                            </p>

                        </div>

                    </div>


                    <!-- Current Session -->

                    <div
                        class="p-5
                               rounded-2xl
                               bg-emerald-50
                               dark:bg-emerald-950/20
                               border
                               border-emerald-100
                               dark:border-emerald-900/30
                               mb-5"
                    >

                        <div class="flex items-start gap-3">

                            <div
                                class="w-10 h-10
                                       rounded-xl
                                       bg-emerald-100
                                       dark:bg-emerald-900/40
                                       text-emerald-600
                                       flex items-center justify-center"
                            >

                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 12.55a11 11 0 0114.08 0
                                           M1.42 9a16 16 0 0121.16 0
                                           M8.53 16.11a6 6 0 016.94 0
                                           M12 20h.01"
                                    />
                                </svg>

                            </div>

                            <div>

                                <p class="font-semibold text-emerald-700 dark:text-emerald-400">
                                    Current session is active
                                </p>

                                <p class="text-xs text-emerald-600/80 dark:text-emerald-400/70 mt-1">
                                    You are currently signed in to the Shine and Smile POS.
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Security Options -->

                    <div class="space-y-3">

                        <label class="setting-toggle">

                            <span>

                                <strong>
                                    Auto logout
                                </strong>

                                <small>
                                    Automatically log out after inactivity.
                                </small>

                            </span>

                            <input
                                type="checkbox"
                                class="toggle-input"
                            >

                        </label>


                        <label class="setting-toggle">

                            <span>

                                <strong>
                                    Confirm before logout
                                </strong>

                                <small>
                                    Ask for confirmation before ending the session.
                                </small>

                            </span>

                            <input
                                type="checkbox"
                                checked
                                class="toggle-input"
                            >

                        </label>

                    </div>


                    <div
                        class="mt-6
                               p-4
                               rounded-xl
                               bg-red-50
                               dark:bg-red-950/20
                               border
                               border-red-100
                               dark:border-red-900/30"
                    >

                        <h3 class="font-semibold text-red-600">
                            Sign out of this account
                        </h3>

                        <p class="text-xs text-red-500/80 mt-1">
                            This will end your current POS session.
                        </p>

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                            class="mt-3"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="px-4 py-2
                                       rounded-lg
                                       bg-red-500
                                       text-white
                                       text-xs
                                       font-semibold
                                       hover:bg-red-600
                                       transition"
                            >
                                Sign Out
                            </button>

                        </form>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 SYSTEM
            ================================================== -->

            <div
                id="section-system"
                class="settings-section hidden"
            >

                <div class="settings-card">

                    <div class="settings-header">

                        <div class="settings-header-icon">

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4h16v16H4z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 8h8M8 12h8M8 16h5"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2>
                                System Information
                            </h2>

                            <p>
                                Information about your Shine and Smile POS.
                            </p>

                        </div>

                    </div>


                    <div class="space-y-3">

                        <div class="system-row">
                            <span>System Name</span>
                            <strong>Shine and Smile POS</strong>
                        </div>

                        <div class="system-row">
                            <span>System Type</span>
                            <strong>Dental Supply Point of Sale</strong>
                        </div>

                        <div class="system-row">
                            <span>Payment Method</span>
                            <strong>Cash Only</strong>
                        </div>

                        <div class="system-row">
                            <span>Register</span>
                            <strong>Register #04</strong>
                        </div>

                        <div class="system-row">
                            <span>Environment</span>
                            <span
                                class="px-2.5 py-1
                                       rounded-full
                                       bg-emerald-50
                                       dark:bg-emerald-950/30
                                       text-emerald-600
                                       text-xs
                                       font-semibold"
                            >
                                Online
                            </span>
                        </div>

                    </div>


                    <div
                        class="mt-6
                               p-4
                               rounded-xl
                               bg-pink-50
                               dark:bg-pink-950/30"
                    >

                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Shine and Smile POS
                        </p>

                        <p class="font-bold text-primary mt-1">
                            Dental Management System
                        </p>

                        <p class="text-[11px] text-gray-400 mt-1">
                            POS configuration and system preferences.
                        </p>

                    </div>

                </div>

            </div>

        </section>

    </div>

</main>



<!-- =========================================================
     TOAST
========================================================= -->

<div
    id="toast"
    class="fixed
           bottom-6
           right-6
           hidden
           z-[9999]
           bg-[#251C22]
           text-white
           px-5 py-3
           rounded-xl
           shadow-2xl"
>

    <div class="flex items-center gap-3">

        <div
            class="w-7 h-7
                   rounded-full
                   bg-emerald-500
                   flex items-center justify-center"
        >

            <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7"
                />
            </svg>

        </div>

        <span
            id="toast-message"
            class="text-sm font-medium"
        ></span>

    </div>

</div>



</body>
</html>
