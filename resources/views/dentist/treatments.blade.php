{{-- ============================================================
     DENTIST TREATMENTS
     resources/views/dentist/treatments.blade.php
============================================================ --}}

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        Treatments | Shine & Smile Dental Clinic
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/dentists/dentist-treatments.css') }}"
    >

</head>

<body>

<div class="treatment-page">
<aside class="sidebar" id="sidebar">

    {{-- =====================================================
         SIDEBAR HEADER
    ====================================================== --}}

    <div class="sidebar-header">

        <div class="clinic-brand">

            <div class="clinic-logo">

                <svg
                    viewBox="0 0 64 64"
                    fill="none"
                    aria-hidden="true"
                >

                    <path
                        d="M18 10C11 12 8 19 10 27C12 34 15 39 17 48C18 53 20 56 24 56C28 56 29 51 30 46C31 42 33 42 34 46C35 51 36 56 40 56C44 56 46 53 47 48C49 39 52 34 54 27C56 19 53 12 46 10C41 8 37 11 32 12C27 11 23 8 18 10Z"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M22 22C25 19 28 18 32 19C36 18 39 19 42 22"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linecap="round"
                    />

                </svg>

            </div>


            <div class="clinic-brand-text">

                <strong>
                    Shine & Smile
                </strong>

                <span>
                    Dental Clinic
                </span>

            </div>

        </div>


        {{-- Sidebar Close Button --}}

        <button
            type="button"
            class="sidebar-close"
            id="sidebarClose"
            aria-label="Close sidebar"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                aria-hidden="true"
            >

                <path
                    d="M6 6L18 18M18 6L6 18"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />

            </svg>

        </button>

    </div>


    {{-- =====================================================
         NAVIGATION
    ====================================================== --}}

    <nav class="sidebar-navigation">

        {{-- =================================================
             MAIN MENU
        ================================================== --}}

        <div class="navigation-section-title">
            MAIN MENU
        </div>


        {{-- =================================================
             DASHBOARD
        ================================================== --}}

        <a
            href="{{ route('dentist.dashboard') }}"
            class="navigation-item {{ request()->routeIs('dentist.dashboard') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <rect
                        x="4"
                        y="4"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <rect
                        x="14"
                        y="4"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <rect
                        x="4"
                        y="14"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <rect
                        x="14"
                        y="14"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                </svg>

            </span>

            Dashboard

        </a>


        {{-- =================================================
             APPOINTMENTS
        ================================================== --}}

        <a
            href="{{ route('dentist.appointments') }}"
            class="navigation-item {{ request()->routeIs('dentist.appointments*') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <rect
                        x="4"
                        y="5"
                        width="16"
                        height="15"
                        rx="2"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <path
                        d="M8 3V7M16 3V7"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M4 10H20"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <circle
                        cx="8"
                        cy="14"
                        r="1"
                        fill="currentColor"
                    />

                    <circle
                        cx="12"
                        cy="14"
                        r="1"
                        fill="currentColor"
                    />

                    <circle
                        cx="16"
                        cy="14"
                        r="1"
                        fill="currentColor"
                    />

                </svg>

            </span>

            Appointments

        </a>


        {{-- =================================================
             PATIENT RECORDS
        ================================================== --}}

        <a
            href="{{ route('dentist.patient-records') }}"
            class="navigation-item {{ request()->routeIs('dentist.patient-records') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <circle
                        cx="9"
                        cy="8"
                        r="3"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <path
                        d="M3 20C3 16.686 5.686 14 9 14C12.314 14 15 16.686 15 20"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M16 11C18.2 11 20 9.2 20 7"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M16 15C18.8 15 21 17.2 21 20"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                </svg>

            </span>

            Patient Records

        </a>


        {{-- =================================================
             DENTAL CHART / ODONTOGRAM
        ================================================== --}}

        <a
            href="{{ route('dentist.odontogram') }}"
            class="navigation-item {{ request()->routeIs('dentist.odontogram*') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <path
                        d="M12 3C8 3 5 5.5 5 9C5 12 6.5 13.5 7 16.5C7.5 19.5 8.5 21 10 21C11.5 21 11.5 18 12 17C12.5 18 12.5 21 14 21C15.5 21 16.5 19.5 17 16.5C17.5 13.5 19 12 19 9C19 5.5 16 3 12 3Z"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linejoin="round"
                    />

                </svg>

            </span>

            Dental Chart

        </a>


        {{-- =================================================
             DIVIDER
        ================================================== --}}

        <div class="navigation-divider"></div>


        {{-- =================================================
             MANAGEMENT
        ================================================== --}}

        <div class="navigation-section-title">
            MANAGEMENT
        </div>


        {{-- =================================================
             TREATMENTS
        ================================================== --}}

        <a
            href="{{ route('dentist.treatments') }}"
            class="navigation-item {{ request()->routeIs('dentist.treatments*') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <path
                        d="M12 7V17"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M7 12H17"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                </svg>

            </span>

            Treatments

        </a>

        <a
    href="{{ route('dentist.settings') }}"
    class="navigation-item {{ request()->routeIs('dentist.settings*') ? 'active' : '' }}"
    id="settingsNavigationItem"
>
    <span class="navigation-icon">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <circle cx="12" cy="12" r="3"></circle>

            <path d="M12 2v2"></path>
            <path d="M12 20v2"></path>
            <path d="m4.93 4.93 1.41 1.41"></path>
            <path d="m17.66 17.66 1.41 1.41"></path>
            <path d="M2 12h2"></path>
            <path d="M20 12h2"></path>
            <path d="m6.34 17.66-1.41 1.41"></path>
            <path d="m19.07 4.93-1.41 1.41"></path>

            <circle cx="12" cy="12" r="7"></circle>
        </svg>
    </span>

    <span>
        Settings
    </span>
</a>

    </nav>


    {{-- =====================================================
         SIDEBAR FOOTER
    ====================================================== --}}

    <div class="sidebar-footer">

        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                type="button"
                class="logout-button"
                id="logoutButton"
            >
                <span class="navigation-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                    >
                        <path
                            d="M10 17L15 12L10 7"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M15 12H3"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M21 19V5C21 3.9 20.1 3 19 3H13"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />
                    </svg>
                </span>

                <span>
                    Logout
                </span>
            </button>

        </form>

    </div>

</aside>
<aside
    class="sidebar"
    id="sidebar"
>

    {{-- ============================================================
         SIDEBAR HEADER
    ============================================================ --}}

    <div class="sidebar-header">

        <div class="clinic-brand">

            <div class="clinic-logo">

                <svg
                    viewBox="0 0 64 64"
                    fill="none"
                    aria-hidden="true"
                >

                    <path
                        d="M18 10C11 12 8 19 10 27C12 34 15 39 17 48C18 53 20 56 24 56C28 56 29 51 30 46C31 42 33 42 34 46C35 51 36 56 40 56C44 56 46 53 47 48C49 39 52 34 54 27C56 19 53 12 46 10C41 8 37 11 32 12C27 11 23 8 18 10Z"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M22 22C25 19 28 18 32 19C36 18 39 19 42 22"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linecap="round"
                    />

                </svg>

            </div>


            <div class="clinic-brand-text">

                <strong>
                    Shine & Smile
                </strong>

                <span>
                    Dental Clinic
                </span>

            </div>

        </div>


        {{-- Sidebar Close Button --}}

        <button
            type="button"
            class="sidebar-close"
            id="sidebarClose"
            aria-label="Close sidebar"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                aria-hidden="true"
            >

                <path
                    d="M6 6L18 18M18 6L6 18"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />

            </svg>

        </button>

    </div>


    {{-- ============================================================
         NAVIGATION
    ============================================================ --}}

    <nav class="sidebar-navigation">


        {{-- ========================================================
             MAIN MENU
        ========================================================= --}}

        <div class="navigation-section-title">
            MAIN MENU
        </div>


        {{-- ========================================================
             DASHBOARD
        ========================================================= --}}

        <a
            href="{{ route('dentist.dashboard') }}"
            class="navigation-item {{ request()->routeIs('dentist.dashboard') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <rect
                        x="4"
                        y="4"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <rect
                        x="14"
                        y="4"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <rect
                        x="4"
                        y="14"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <rect
                        x="14"
                        y="14"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                </svg>

            </span>

            <span>
                Dashboard
            </span>

        </a>


        {{-- ========================================================
             APPOINTMENTS
        ========================================================= --}}

        <a
            href="{{ route('dentist.appointments') }}"
            class="navigation-item {{ request()->routeIs('dentist.appointments*') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <rect
                        x="4"
                        y="5"
                        width="16"
                        height="15"
                        rx="2"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <path
                        d="M8 3V7M16 3V7"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M4 10H20"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <circle
                        cx="8"
                        cy="14"
                        r="1"
                        fill="currentColor"
                    />

                    <circle
                        cx="12"
                        cy="14"
                        r="1"
                        fill="currentColor"
                    />

                    <circle
                        cx="16"
                        cy="14"
                        r="1"
                        fill="currentColor"
                    />

                </svg>

            </span>

            <span>
                Appointments
            </span>

        </a>


        {{-- ========================================================
             PATIENT RECORDS
        ========================================================= --}}

        <a
            href="{{ route('dentist.patient-records') }}"
            class="navigation-item {{ request()->routeIs('dentist.patient-records') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <circle
                        cx="9"
                        cy="8"
                        r="3"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <path
                        d="M3 20C3 16.686 5.686 14 9 14C12.314 14 15 16.686 15 20"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M16 11C18.2 11 20 9.2 20 7"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M16 15C18.8 15 21 17.2 21 20"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                </svg>

            </span>

            <span>
                Patient Records
            </span>

        </a>


        {{-- ========================================================
             DENTAL CHART / ODONTOGRAM
        ========================================================= --}}

        <a
            href="{{ route('dentist.odontogram') }}"
            class="navigation-item {{ request()->routeIs('dentist.odontogram*') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <path
                        d="M12 3C8 3 5 5.5 5 9C5 12 6.5 13.5 7 16.5C7.5 19.5 8.5 21 10 21C11.5 21 11.5 18 12 17C12.5 18 12.5 21 14 21C15.5 21 16.5 19.5 17 16.5C17.5 13.5 19 12 19 9C19 5.5 16 3 12 3Z"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linejoin="round"
                    />

                </svg>

            </span>

            <span>
                Dental Chart
            </span>

        </a>


        {{-- ========================================================
             DIVIDER
        ========================================================= --}}

        <div class="navigation-divider"></div>


        {{-- ========================================================
             MANAGEMENT
        ========================================================= --}}

        <div class="navigation-section-title">
            MANAGEMENT
        </div>


        {{-- ========================================================
             TREATMENTS
        ========================================================= --}}

        <a
            href="{{ route('dentist.treatments') }}"
            class="navigation-item {{ request()->routeIs('dentist.treatments*') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <path
                        d="M12 7V17"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M7 12H17"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                </svg>

            </span>

            <span>
                Treatments
            </span>

        </a>


        {{-- ========================================================
             PROFILE
        ========================================================= --}}

        <div class="navigation-divider"></div>


        <div class="navigation-section-title">
            ACCOUNT
        </div>

        {{-- ========================================================
             SETTINGS
        ========================================================= --}}

        <a
            href="{{ route('dentist.settings') }}"
            class="navigation-item {{ request()->routeIs('dentist.settings*') ? 'active' : '' }}"
            id="settingsNavigationItem"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    aria-hidden="true"
                >

                    <circle
                        cx="12"
                        cy="12"
                        r="3"
                    />

                    <path
                        d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.8 1.8-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V20h-2.54v-.1a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.8-1.8.06-.06A1.7 1.7 0 0 0 8.12 15a1.7 1.7 0 0 0-1.56-1.03H6.5v-2.54h.06A1.7 1.7 0 0 0 8.12 10a1.7 1.7 0 0 0-.34-1.88l-.06-.06 1.8-1.8.06.06a1.7 1.7 0 0 0 1.88.34 1.7 1.7 0 0 0 1.03-1.56V5h2.54v.1a1.7 1.7 0 0 0 1.03 1.56 1.7 1.7 0 0 0 1.88-.34l.06-.06 1.8 1.8-.06.06a1.7 1.7 0 0 0-.34 1.88 1.7 1.7 0 0 0 1.56 1.03H19.5v2.54h-.06A1.7 1.7 0 0 0 19.4 15Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />

                </svg>

            </span>

            <span>
                Settings
            </span>

        </a>

    </nav>


    {{-- ============================================================
         SIDEBAR FOOTER
    ============================================================ --}}

    <div class="sidebar-footer">

        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="logout-button"
            >

                <span class="navigation-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                    >

                        <path
                            d="M10 17L15 12L10 7"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M15 12H3"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M21 19V5C21 3.9 20.1 3 19 3H13"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                    </svg>

                </span>

                <span>
                    Logout
                </span>

            </button>

        </form>

    </div>

</aside>



    {{-- ========================================================
         MAIN
    ========================================================= --}}

    <main class="main-content">


        {{-- ====================================================
             HEADER
        ===================================================== --}}

        <header class="top-header">

            <div class="header-left">

                <button
                    type="button"
                    class="mobile-menu-button"
                    id="mobileMenuButton"
                    aria-label="Open menu"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M4 6H20M4 12H20M4 18H20"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                        />
                    </svg>

                </button>

                <div>

                    <h1 class="page-title">
                        Patient Records
                    </h1>

                    <p class="page-subtitle">
                        Manage and review patient dental records
                    </p>

                </div>

            </div>


            <div class="header-right">


                {{-- Notification --}}

                <button
                    type="button"
                    class="header-icon-button"
                    id="notificationButton"
                    aria-label="Notifications"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M18 8C18 4.68629 15.3137 2 12 2C8.68629 2 6 4.68629 6 8C6 15 3 15 3 17H21C21 15 18 15 18 8Z"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M10 21H14"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />
                    </svg>

                    <span class="notification-badge">
                        0
                    </span>

                </button>


                {{-- Dentist Profile --}}

                <div class="header-profile">

                    <div class="header-profile-avatar">

                        @if(auth()->user()->profile_picture)

                            <img
                                src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                alt="{{ auth()->user()->name }}"
                            >

                        @else

                            <span>
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>

                        @endif

                    </div>

                    <div class="header-profile-info">

                        <strong>
                            Dr. {{ auth()->user()->name }}
                        </strong>

                        <span>
                            Dentist
                        </span>

                    </div>


                </div>

            </div>

        </header>

        {{-- ====================================================
             PAGE CONTENT
        ===================================================== --}}

        <section class="page-content">


            {{-- PAGE HEADING --}}

            <div class="page-heading">

                <div>

                    <div class="breadcrumb">

                        <span>
                            Dentist
                        </span>

                        <span>/</span>

                        <span>
                            Treatments
                        </span>

                    </div>

                    <h1>
                        Treatments
                    </h1>

                    <p>
                        Manage and monitor patient dental treatments.
                    </p>

                </div>


                <button
                    type="button"
                    class="primary-button"
                    id="addTreatmentButton"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path d="M12 5v14"/>
                        <path d="M5 12h14"/>
                    </svg>

                    Add Treatment

                </button>

            </div>


            {{-- =================================================
                 STATISTICS
            ================================================== --}}

            <div class="stats-grid">


                <div class="stat-card">

                    <div class="stat-icon pink">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M4 19h16"/>
                            <path d="M7 16l10-10"/>
                            <path d="M6 8l2-2"/>
                            <path d="M16 18l2-2"/>
                        </svg>

                    </div>

                    <div>

                        <span>
                            Total Treatments
                        </span>

                        <strong id="totalTreatments">
                            {{ $treatments->count() }}
                        </strong>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon blue">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="M12 7v5l3 2"/>
                        </svg>

                    </div>

                    <div>

                        <span>
                            In Progress
                        </span>

                        <strong id="inProgressCount">
                            {{ $treatments->where('status', 'in_progress')->count() }}
                        </strong>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon green">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M5 12l4 4L19 6"/>
                        </svg>

                    </div>

                    <div>

                        <span>
                            Completed
                        </span>

                        <strong id="completedCount">
                            {{ $treatments->where('status', 'completed')->count() }}
                        </strong>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon orange">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="M12 8v4"/>
                            <path d="M12 16h.01"/>
                        </svg>

                    </div>

                    <div>

                        <span>
                            Planned
                        </span>

                        <strong id="plannedCount">
                            {{ $treatments->where('status', 'planned')->count() }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 FILTER BAR
            ================================================== --}}

            <div class="filter-card">

                <div class="search-box">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <circle
                            cx="11"
                            cy="11"
                            r="7"
                        />

                        <path d="m20 20-4-4"/>
                    </svg>

                    <input
                        type="text"
                        id="treatmentSearch"
                        placeholder="Search patient or treatment..."
                    >

                </div>


                <select
                    id="statusFilter"
                    class="filter-select"
                >

                    <option value="">
                        All Status
                    </option>

                    <option value="planned">
                        Planned
                    </option>

                    <option value="in_progress">
                        In Progress
                    </option>

                    <option value="completed">
                        Completed
                    </option>

                    <option value="cancelled">
                        Cancelled
                    </option>

                </select>


                <select
                    id="treatmentFilter"
                    class="filter-select"
                >

                    <option value="">
                        All Treatments
                    </option>

                    @foreach($treatments->pluck('treatment_name')->unique() as $treatmentName)

                        <option value="{{ strtolower($treatmentName) }}">
                            {{ $treatmentName }}
                        </option>

                    @endforeach

                </select>


                <button
                    type="button"
                    class="reset-button"
                    id="resetFilters"
                >

                    Reset

                </button>

            </div>


            {{-- =================================================
                 TREATMENT TABLE
            ================================================== --}}

            <div class="treatments-card">

                <div class="table-header">

                    <div>

                        <h2>
                            Treatment Records
                        </h2>

                        <p>
                            Patient treatment history and procedures.
                        </p>

                    </div>

                    <span
                        class="record-count"
                        id="recordCount"
                    >
                        {{ $treatments->count() }}
                        records
                    </span>

                </div>


                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Patient
                                </th>

                                <th>
                                    Tooth
                                </th>

                                <th>
                                    Treatment
                                </th>

                                <th>
                                    Dentist
                                </th>

                                <th>
                                    Date
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Cost
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody id="treatmentTableBody">

                            @forelse($treatments as $treatment)

                                <tr
                                    class="treatment-row"
                                    data-patient="{{ strtolower($treatment->patient_name ?? '') }}"
                                    data-treatment="{{ strtolower($treatment->treatment_name ?? '') }}"
                                    data-status="{{ $treatment->status }}"
                                >

                                    <td>

                                        <div class="patient-cell">

                                            <div class="patient-avatar">

                                                {{ strtoupper(substr($treatment->patient_name ?? 'P', 0, 1)) }}

                                            </div>

                                            <div>

                                                <strong>
                                                    {{ $treatment->patient_name ?? 'Unknown Patient' }}
                                                </strong>

                                                <span>
                                                    P-{{ str_pad($treatment->patient_record_id, 5, '0', STR_PAD_LEFT) }}
                                                </span>

                                            </div>

                                        </div>

                                    </td>


                                    <td>

                                        @if($treatment->tooth_number)

                                            <span class="tooth-badge">
                                                {{ $treatment->tooth_number }}
                                            </span>

                                        @else

                                            <span class="muted-text">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <div class="treatment-name">

                                            <strong>
                                                {{ $treatment->treatment_name }}
                                            </strong>

                                            @if($treatment->description)

                                                <span>
                                                    {{ Str::limit($treatment->description, 45) }}
                                                </span>

                                            @endif

                                        </div>

                                    </td>


                                    <td>

                                        <span class="dentist-name">
                                            {{ $treatment->dentist_name ?? '—' }}
                                        </span>

                                    </td>


                                    <td>

                                        <span class="date-text">

                                            {{ $treatment->treatment_date
                                                ? \Carbon\Carbon::parse($treatment->treatment_date)->format('M d, Y')
                                                : '—'
                                            }}

                                        </span>

                                    </td>


                                    <td>

                                        <span
                                            class="status-badge status-{{ $treatment->status }}"
                                        >

                                            {{ ucwords(str_replace('_', ' ', $treatment->status)) }}

                                        </span>

                                    </td>


                                    <td>

                                        <strong class="cost">

                                            ₱{{ number_format($treatment->cost ?? 0, 2) }}

                                        </strong>

                                    </td>


                                    <td>

                                        <div class="action-buttons">

                                            <button
                                                type="button"
                                                class="table-action view"
                                                data-action="view"
                                                data-id="{{ $treatment->id }}"
                                                title="View"
                                            >

                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"
                                                    />

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="2.5"
                                                    />
                                                </svg>

                                            </button>


                                            <button
                                                type="button"
                                                class="table-action edit"
                                                data-action="edit"
                                                data-id="{{ $treatment->id }}"
                                                title="Edit"
                                            >

                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        d="M12 20h9"
                                                    />

                                                    <path
                                                        d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4z"
                                                    />
                                                </svg>

                                            </button>


                                            <button
                                                type="button"
                                                class="table-action delete"
                                                data-action="delete"
                                                data-id="{{ $treatment->id }}"
                                                title="Delete"
                                            >

                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        d="M4 7h16"
                                                    />

                                                    <path
                                                        d="M10 11v6"
                                                    />

                                                    <path
                                                        d="M14 11v6"
                                                    />

                                                    <path
                                                        d="M6 7l1 14h10l1-14"
                                                    />

                                                    <path
                                                        d="M9 7V4h6v3"
                                                    />
                                                </svg>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr id="emptyTreatmentRow">

                                    <td
                                        colspan="8"
                                        class="empty-state"
                                    >

                                        <div class="empty-icon">

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            >
                                                <path d="M4 19h16"/>
                                                <path d="M7 16l10-10"/>
                                                <path d="M6 8l2-2"/>
                                                <path d="M16 18l2-2"/>
                                            </svg>

                                        </div>

                                        <h3>
                                            No treatments found
                                        </h3>

                                        <p>
                                            Treatment records will appear here.
                                        </p>

                                        <button
                                            type="button"
                                            class="primary-button small"
                                            id="emptyAddTreatment"
                                        >
                                            Add Treatment
                                        </button>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </section>

    </main>

</div>


{{-- ============================================================
     ADD / EDIT TREATMENT MODAL
============================================================ --}}

<div
    class="modal"
    id="treatmentModal"
    aria-hidden="true"
>

    <div
        class="modal-overlay"
        data-close-modal
    ></div>


    <div class="modal-container">

        <div class="modal-header">

            <div>

                <span>
                    Treatment
                </span>

                <h2 id="modalTitle">
                    Add Treatment
                </h2>

            </div>

            <button
                type="button"
                class="modal-close"
                data-close-modal
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path d="M6 6l12 12"/>
                    <path d="M18 6L6 18"/>
                </svg>

            </button>

        </div>


        <form
            id="treatmentForm"
        >

            <input
                type="hidden"
                id="treatmentId"
            >


            <div class="modal-body">


                {{-- PATIENT --}}

                <div class="form-group">

                    <label>
                        Patient
                        <span>*</span>
                    </label>

                    <select
                        id="formPatient"
                        required
                    >

                        <option value="">
                            Select patient...
                        </option>

                        @foreach($patients as $patient)

                            <option
                                value="{{ $patient->id }}"
                            >
                                {{ $patient->patient_name }}
                                —
                                P-{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="form-grid two">


                    {{-- TOOTH --}}

                    <div class="form-group">

                        <label>
                            Tooth Number
                        </label>

                        <select
                            id="formTooth"
                        >

                            <option value="">
                                Select tooth...
                            </option>

                            @foreach([
                                '11','12','13','14','15','16','17','18',
                                '21','22','23','24','25','26','27','28',
                                '31','32','33','34','35','36','37','38',
                                '41','42','43','44','45','46','47','48'
                            ] as $tooth)

                                <option value="{{ $tooth }}">
                                    Tooth {{ $tooth }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- TREATMENT --}}

                    <div class="form-group">

                        <label>
                            Treatment
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            id="formTreatment"
                            placeholder="e.g. Dental Filling"
                            required
                        >

                    </div>

                </div>


                <div class="form-grid two">


                    {{-- DATE --}}

                    <div class="form-group">

                        <label>
                            Treatment Date
                            <span>*</span>
                        </label>

                        <input
                            type="date"
                            id="formDate"
                            required
                        >

                    </div>


                    {{-- STATUS --}}

                    <div class="form-group">

                        <label>
                            Status
                            <span>*</span>
                        </label>

                        <select
                            id="formStatus"
                            required
                        >

                            <option value="planned">
                                Planned
                            </option>

                            <option value="in_progress">
                                In Progress
                            </option>

                            <option value="completed">
                                Completed
                            </option>

                            <option value="cancelled">
                                Cancelled
                            </option>

                        </select>

                    </div>

                </div>


                {{-- COST --}}

                <div class="form-group">

                    <label>
                        Cost
                    </label>

                    <div class="currency-input">

                        <span>
                            ₱
                        </span>

                        <input
                            type="number"
                            id="formCost"
                            min="0"
                            step="0.01"
                            placeholder="0.00"
                        >

                    </div>

                </div>


                {{-- DESCRIPTION --}}

                <div class="form-group">

                    <label>
                        Description
                    </label>

                    <textarea
                        id="formDescription"
                        rows="3"
                        placeholder="Describe the treatment..."
                    ></textarea>

                </div>


                {{-- NOTES --}}

                <div class="form-group">

                    <label>
                        Notes
                    </label>

                    <textarea
                        id="formNotes"
                        rows="3"
                        placeholder="Additional clinical notes..."
                    ></textarea>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="secondary-button"
                    data-close-modal
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="primary-button"
                    id="saveTreatmentButton"
                >

                    Save Treatment

                </button>

            </div>

        </form>

    </div>

</div>


{{-- ============================================================
     VIEW TREATMENT MODAL
============================================================ --}}

<div
    class="modal"
    id="viewTreatmentModal"
    aria-hidden="true"
>

    <div
        class="modal-overlay"
        data-close-modal
    ></div>


    <div class="modal-container view-modal">

        <div class="modal-header">

            <div>

                <span>
                    Treatment Record
                </span>

                <h2>
                    Treatment Details
                </h2>

            </div>

            <button
                type="button"
                class="modal-close"
                data-close-modal
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path d="M6 6l12 12"/>
                    <path d="M18 6L6 18"/>
                </svg>

            </button>

        </div>


        <div class="view-body">

            <div class="view-patient">

                <div
                    class="view-avatar"
                    id="viewAvatar"
                >
                    P
                </div>

                <div>

                    <span>
                        Patient
                    </span>

                    <strong id="viewPatient">
                        —
                    </strong>

                    <small id="viewPatientId">
                        —
                    </small>

                </div>

            </div>


            <div class="details-grid">

                <div class="detail-item">

                    <span>
                        Tooth
                    </span>

                    <strong id="viewTooth">
                        —
                    </strong>

                </div>


                <div class="detail-item">

                    <span>
                        Treatment
                    </span>

                    <strong id="viewTreatment">
                        —
                    </strong>

                </div>


                <div class="detail-item">

                    <span>
                        Dentist
                    </span>

                    <strong id="viewDentist">
                        —
                    </strong>

                </div>


                <div class="detail-item">

                    <span>
                        Date
                    </span>

                    <strong id="viewDate">
                        —
                    </strong>

                </div>


                <div class="detail-item">

                    <span>
                        Status
                    </span>

                    <strong id="viewStatus">
                        —
                    </strong>

                </div>


                <div class="detail-item">

                    <span>
                        Cost
                    </span>

                    <strong id="viewCost">
                        —
                    </strong>

                </div>

            </div>


            <div class="view-text-section">

                <span>
                    Description
                </span>

                <p id="viewDescription">
                    —
                </p>

            </div>


            <div class="view-text-section">

                <span>
                    Notes
                </span>

                <p id="viewNotes">
                    —
                </p>

            </div>

        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="secondary-button"
                data-close-modal
            >
                Close
            </button>

        </div>

    </div>

</div>


{{-- ============================================================
     DELETE MODAL
============================================================ --}}

<div
    class="modal"
    id="deleteModal"
    aria-hidden="true"
>

    <div
        class="modal-overlay"
        data-close-modal
    ></div>


    <div class="delete-container">

        <div class="delete-icon">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path d="M12 9v4"/>
                <path d="M12 17h.01"/>

                <path
                    d="M10.3 3.8 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.8a2 2 0 0 0-3.4 0z"
                />
            </svg>

        </div>

        <h2>
            Delete Treatment?
        </h2>

        <p>
            This treatment record will be permanently deleted.
            This action cannot be undone.
        </p>


        <div class="delete-actions">

            <button
                type="button"
                class="secondary-button"
                data-close-modal
            >
                Cancel
            </button>

            <button
                type="button"
                class="danger-button"
                id="confirmDeleteButton"
            >
                Delete Treatment
            </button>

        </div>

    </div>

</div>


{{-- ============================================================
     TOAST
============================================================ --}}

<div
    class="toast-container"
    id="toastContainer"
></div>

<div id="logoutModal" class="logout-modal hidden">

    <div class="logout-modal-overlay"></div>

    <div class="logout-modal-content">

        <div class="logout-modal-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                aria-hidden="true"
            >
                <path
                    d="M10 17L15 12L10 7"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

                <path
                    d="M15 12H3"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />

                <path
                    d="M21 19V5C21 3.9 20.1 3 19 3H13"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />
            </svg>
        </div>

        <h3>Confirm Logout</h3>

        <p>
            Are you sure you want to logout from your account?
        </p>

        <div class="logout-modal-actions">

            <button
                type="button"
                id="cancelLogout"
                class="cancel-logout-btn"
            >
                Cancel
            </button>

            <button
                type="button"
                id="confirmLogout"
                class="confirm-logout-btn"
            >
                Yes, Logout
            </button>

        </div>

    </div>

</div>

<script>

    window.TREATMENTS_CONFIG = {

        indexUrl:
            @json(route('dentist.treatments')),

        storeUrl:
            @json(route('dentist.treatments.store')),

        showUrl:
            @json(route('dentist.treatments.show', ['treatment' => '__ID__'])),

        updateUrl:
            @json(route('dentist.treatments.update', ['treatment' => '__ID__'])),

        deleteUrl:
            @json(route('dentist.treatments.destroy', ['treatment' => '__ID__'])),

        csrfToken:
            @json(csrf_token())

    };

</script>


<script
    src="{{ asset('js/dentist/dentist-treatments.js') }}"
></script>

</body>
</html>
