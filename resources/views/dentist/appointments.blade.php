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
        Appointments | Shine & Smile Dental Clinic
    </title>

    {{-- Separate CSS --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/dentists/dentist-appointments.css') }}"
    >

</head>


<body>


<div class="appointments-page">

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


    {{-- ============================================================
        MAIN
    ============================================================= --}}

    <main class="main-content">


        {{-- ========================================================
            TOP HEADER
        ========================================================= --}}

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


        <section class="page-body">
            <div class="content-header">
                <div>
                    <div class="breadcrumb">
                        <span>  Dentist  </span>
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 18L15 12L9 6"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span>  Appointments</span>
                    </div>


                    <h2>
                        Appointment Schedule
                    </h2>

                    <p>
                        View, manage, and track your patient appointments.
                    </p>

                </div>


                <button
                    type="button"
                    class="primary-button"
                    id="newAppointmentButton"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >

                        <path
                            d="M12 5V19"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                        />

                        <path
                            d="M5 12H19"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                        />

                    </svg>

                    New Appointment

                </button>

            </div>



            {{-- ====================================================
                STATISTICS
            ===================================================== --}}

            <div class="appointment-stat-grid">


                {{-- TODAY --}}

                <div class="stat-card">

                    <div class="stat-icon blue">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
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

                        </svg>

                    </div>


                    <div class="stat-information">

                        <span>
                            Today's Appointments
                        </span>

                        <strong id="todayAppointmentsCount">
                            {{ $todayAppointments ?? 0 }}
                        </strong>

                        <small>
                            Scheduled today
                        </small>

                    </div>

                </div>



                {{-- PENDING --}}

                <div class="stat-card">

                    <div class="stat-icon orange">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                                stroke="currentColor"
                                stroke-width="1.8"
                            />

                            <path
                                d="M12 7V12L15 14"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                        </svg>

                    </div>


                    <div class="stat-information">

                        <span>
                            Pending
                        </span>

                        <strong id="pendingAppointmentsCount">
                            {{ $pendingAppointments ?? 0 }}
                        </strong>

                        <small>
                            Waiting for confirmation
                        </small>

                    </div>

                </div>



                {{-- CONFIRMED --}}

                <div class="stat-card">

                    <div class="stat-icon green">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                                stroke="currentColor"
                                stroke-width="1.8"
                            />

                            <path
                                d="M8 12L11 15L17 9"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                        </svg>

                    </div>


                    <div class="stat-information">

                        <span>
                            Confirmed
                        </span>

                        <strong id="confirmedAppointmentsCount">
                            {{ $confirmedAppointments ?? 0 }}
                        </strong>

                        <small>
                            Ready for consultation
                        </small>

                    </div>

                </div>



                {{-- COMPLETED --}}

                <div class="stat-card">

                    <div class="stat-icon purple">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                            <path
                                d="M5 12L10 17L20 7"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                        </svg>

                    </div>


                    <div class="stat-information">

                        <span>
                            Completed
                        </span>

                        <strong id="completedAppointmentsCount">
                            {{ $completedAppointments ?? 0 }}
                        </strong>

                        <small>
                            Completed appointments
                        </small>

                    </div>

                </div>

            </div>



            {{-- ====================================================
                DATE NAVIGATION
            ===================================================== --}}

            <div class="date-navigation-card">


                <button
                    type="button"
                    class="date-arrow"
                    id="previousDay"
                    aria-label="Previous day"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >

                        <path
                            d="M15 18L9 12L15 6"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                    </svg>

                </button>



                <div class="date-display">

                    <span>
                        SELECTED DATE
                    </span>

                    <strong id="selectedDateLabel">
                        {{ now()->format('l, F d, Y') }}
                    </strong>

                </div>



                <button
                    type="button"
                    class="today-button"
                    id="todayButton"
                >
                    Today
                </button>



                <div class="date-picker">

                    <input
                        type="date"
                        id="appointmentDate"
                        value="{{ request('date', now()->format('Y-m-d')) }}"
                    >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
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

                    </svg>

                </div>



                <button
                    type="button"
                    class="date-arrow"
                    id="nextDay"
                    aria-label="Next day"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >

                        <path
                            d="M9 18L15 12L9 6"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                    </svg>

                </button>

            </div>



            {{-- ====================================================
                SEARCH AND FILTERS
            ===================================================== --}}

            <div class="filter-card">


                <div class="search-box">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >

                        <circle
                            cx="11"
                            cy="11"
                            r="7"
                            stroke="currentColor"
                            stroke-width="1.8"
                        />

                        <path
                            d="M16 16L21 21"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                    </svg>


                    <input
                        type="search"
                        id="appointmentSearch"
                        placeholder="Search patient name, ID, service..."
                        autocomplete="off"
                    >

                </div>



                <div class="filter-control">

                    <label for="statusFilter">
                        Status
                    </label>

                    <select id="statusFilter">

                        <option value="">
                            All Status
                        </option>

                        <option value="pending">
                            Pending
                        </option>

                        <option value="approved">
                            Confirmed
                        </option>

                        <option value="completed">
                            Completed
                        </option>

                        <option value="declined">
                            Declined
                        </option>

                        <option value="cancelled">
                            Cancelled
                        </option>

                    </select>

                </div>



                <div class="filter-control">

                    <label for="serviceFilter">
                        Service
                    </label>

                    <select id="serviceFilter">

                        <option value="">
                            All Services
                        </option>

                        @foreach($services ?? [] as $service)

                            <option
                                value="{{ $service->id }}"
                            >
                                {{ $service->name }}
                            </option>

                        @endforeach

                    </select>

                </div>



                <button
                    type="button"
                    class="reset-filter-button"
                    id="resetFilters"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >

                        <path
                            d="M3 12C3 7.02944 7.02944 3 12 3C15.1 3 17.8 4.6 19.3 7"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M19 3V7H15"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M21 12C21 16.9706 16.9706 21 12 21C8.9 21 6.2 19.4 4.7 17"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M5 21V17H9"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                    </svg>

                    Reset

                </button>

            </div>



            {{-- ====================================================
                MAIN APPOINTMENT AREA
            ===================================================== --}}

            <div class="appointment-layout">


                {{-- =================================================
                    APPOINTMENT LIST
                ================================================== --}}

                <section class="appointment-list-card">


                    <div class="card-header">


                        <div>

                            <h3>
                                Today's Appointments
                            </h3>

                            <p id="appointmentListCount">
                                {{ $appointments->count() ?? 0 }}
                                appointments
                            </p>

                        </div>


                        <button
                            type="button"
                            class="refresh-button"
                            id="refreshAppointments"
                            aria-label="Refresh appointments"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >

                                <path
                                    d="M20 11C20 6.58172 16.4183 3 12 3C8.68629 3 5.8 5.1 4.5 8"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />

                                <path
                                    d="M4 4V8H8"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                                <path
                                    d="M4 13C4 17.4183 7.58172 21 12 21C15.3 21 18.2 18.9 19.5 16"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />

                                <path
                                    d="M20 20V16H16"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </button>

                    </div>



                    {{-- APPOINTMENTS --}}

                    <div
                        class="appointments-list"
                        id="appointmentsList"
                    >


                        @forelse($appointments ?? [] as $appointment)


                            <article
                                class="appointment-item"
                                data-appointment-id="{{ $appointment->id }}"
                                data-status="{{ strtolower($appointment->status) }}"
                                data-service-id="{{ $appointment->service_id }}"
                                data-patient-name="{{ strtolower($appointment->patientRecord->patient_name ?? '') }}"
                            >


                                {{-- TIME --}}

                                <div class="appointment-time-column">

                                    <strong>

                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i') }}

                                    </strong>

                                    <span>

                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('A') }}

                                    </span>

                                </div>



                                {{-- TIMELINE --}}

                                <div class="appointment-timeline-line">

                                    <span></span>

                                </div>



                                {{-- APPOINTMENT CARD --}}

                                <div class="appointment-content-card">


                                    {{-- TOP --}}

                                    <div class="appointment-card-header">


                                        <div class="patient-summary">


                                            <div class="patient-avatar">

                                                @if(
                                                    $appointment->patientRecord &&
                                                    $appointment->patientRecord->user &&
                                                    $appointment->patientRecord->user->profile_picture
                                                )

                                                    <img
                                                        src="{{ asset('storage/' . $appointment->patientRecord->user->profile_picture) }}"
                                                        alt="{{ $appointment->patientRecord->patient_name }}"
                                                    >

                                                @else

                                                    {{ strtoupper(
                                                        substr(
                                                            $appointment->patientRecord->patient_name ?? 'P',
                                                            0,
                                                            1
                                                        )
                                                    ) }}

                                                @endif

                                            </div>


                                            <div class="patient-summary-text">

                                                <strong>

                                                    {{ $appointment->patientRecord->patient_name ?? 'Unknown Patient' }}

                                                </strong>

                                                <span>

                                                    Patient ID:
                                                    P-{{ str_pad($appointment->patient_record_id, 5, '0', STR_PAD_LEFT) }}

                                                </span>

                                            </div>

                                        </div>



                                        {{-- STATUS --}}

                                        @php

                                            $status = strtolower(
                                                $appointment->status ?? 'pending'
                                            );

                                        @endphp


                                        <span
                                            class="appointment-status status-{{ $status }}"
                                        >

                                            @switch($status)

                                                @case('pending')
                                                    Pending
                                                    @break

                                                @case('approved')
                                                    Confirmed
                                                    @break

                                                @case('completed')
                                                    Completed
                                                    @break

                                                @case('declined')
                                                    Declined
                                                    @break

                                                @case('cancelled')
                                                    Cancelled
                                                    @break

                                                @default
                                                    {{ ucfirst($status) }}

                                            @endswitch

                                        </span>

                                    </div>



                                    {{-- DETAILS --}}

                                    <div class="appointment-details">


                                        <div class="appointment-detail">

                                            <span class="detail-icon">

                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >

                                                    <rect
                                                        x="4"
                                                        y="5"
                                                        width="16"
                                                        height="15"
                                                        rx="2"
                                                        stroke="currentColor"
                                                        stroke-width="1.7"
                                                    />

                                                    <path
                                                        d="M8 3V7M16 3V7"
                                                        stroke="currentColor"
                                                        stroke-width="1.7"
                                                        stroke-linecap="round"
                                                    />

                                                    <path
                                                        d="M4 10H20"
                                                        stroke="currentColor"
                                                        stroke-width="1.7"
                                                    />

                                                </svg>

                                            </span>


                                            <div>

                                                <small>
                                                    Date
                                                </small>

                                                <strong>

                                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}

                                                </strong>

                                            </div>

                                        </div>



                                        <div class="appointment-detail">

                                            <span class="detail-icon">

                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="9"
                                                        stroke="currentColor"
                                                        stroke-width="1.7"
                                                    />

                                                    <path
                                                        d="M12 7V12L15 14"
                                                        stroke="currentColor"
                                                        stroke-width="1.7"
                                                        stroke-linecap="round"
                                                    />

                                                </svg>

                                            </span>


                                            <div>

                                                <small>
                                                    Time
                                                </small>

                                                <strong>

                                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}

                                                </strong>

                                            </div>

                                        </div>



                                        <div class="appointment-detail">

                                            <span class="detail-icon">

                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >

                                                    <path
                                                        d="M7 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3Z"
                                                        stroke="currentColor"
                                                        stroke-width="1.7"
                                                    />

                                                    <path
                                                        d="M8 8H16"
                                                        stroke="currentColor"
                                                        stroke-width="1.7"
                                                        stroke-linecap="round"
                                                    />

                                                    <path
                                                        d="M8 12H16"
                                                        stroke="currentColor"
                                                        stroke-width="1.7"
                                                        stroke-linecap="round"
                                                    />

                                                </svg>

                                            </span>


                                            <div>

                                                <small>
                                                    Service
                                                </small>

                                                <strong>

                                                    {{ $appointment->service->name ?? 'Dental Service' }}

                                                </strong>

                                            </div>

                                        </div>

                                    </div>



                                    {{-- REASON --}}

                                    @if($appointment->reason)

                                        <div class="appointment-reason">

                                            <span>
                                                Reason / Concern
                                            </span>

                                            <p>
                                                {{ $appointment->reason }}
                                            </p>

                                        </div>

                                    @endif



                                    {{-- ACTIONS --}}

                                    <div class="appointment-actions">


                                        {{-- VIEW --}}

                                        <button
                                            type="button"
                                            class="appointment-action view-appointment"
                                            data-appointment-id="{{ $appointment->id }}"
                                        >

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >

                                                <path
                                                    d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    stroke-linejoin="round"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="3"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                />

                                            </svg>

                                            View Details

                                        </button>



                                        {{-- PATIENT RECORD --}}

                                        <button
                                            type="button"
                                            class="appointment-action patient-record-button"
                                            data-patient-id="{{ $appointment->patient_record_id }}"
                                        >

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >

                                                <circle
                                                    cx="9"
                                                    cy="8"
                                                    r="3"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                />

                                                <path
                                                    d="M3 20C3 16.6863 5.68629 14 9 14C12.3137 14 15 16.6863 15 20"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    stroke-linecap="round"
                                                />

                                            </svg>

                                            Patient Record

                                        </button>



                                        {{-- CONFIRM --}}

                                        @if($status === 'pending')

                                            <button
                                                type="button"
                                                class="appointment-action confirm-button"
                                                data-appointment-id="{{ $appointment->id }}"
                                            >

                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >

                                                    <path
                                                        d="M5 12L10 17L20 7"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                    />

                                                </svg>

                                                Confirm

                                            </button>



                                            <button
                                                type="button"
                                                class="appointment-action decline-button"
                                                data-appointment-id="{{ $appointment->id }}"
                                            >

                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >

                                                    <path
                                                        d="M6 6L18 18M18 6L6 18"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                        stroke-linecap="round"
                                                    />

                                                </svg>

                                                Decline

                                            </button>

                                        @endif



                                        {{-- COMPLETE --}}

                                        @if($status === 'approved')

                                            <button
                                                type="button"
                                                class="appointment-action complete-button"
                                                data-appointment-id="{{ $appointment->id }}"
                                            >

                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >

                                                    <path
                                                        d="M5 12L10 17L20 7"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                    />

                                                </svg>

                                                Complete

                                            </button>

                                        @endif

                                    </div>

                                </div>

                            </article>


                        @empty


                            {{-- EMPTY STATE --}}

                            <div class="empty-appointments">

                                <div class="empty-appointments-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
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

                                        <path
                                            d="M9 14H15"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </div>


                                <h3>
                                    No appointments found
                                </h3>


                                <p>
                                    There are no appointments scheduled for the selected date.
                                </p>


                                <button
                                    type="button"
                                    class="primary-button"
                                    id="emptyNewAppointmentButton"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >

                                        <path
                                            d="M12 5V19"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                        />

                                        <path
                                            d="M5 12H19"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                    Create Appointment

                                </button>

                            </div>

                        @endforelse

                    </div>

                </section>



                {{-- =================================================
                    RIGHT SUMMARY
                ================================================== --}}

                <aside class="appointment-sidebar-card">


                    {{-- SUMMARY HEADER --}}

                    <div class="summary-header">

                        <div>

                            <span>
                                DAILY OVERVIEW
                            </span>

                            <h3>
                                {{ now()->format('M d, Y') }}
                            </h3>

                        </div>


                        <div class="summary-calendar-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
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

                            </svg>

                        </div>

                    </div>



                    {{-- SUMMARY --}}

                    <div class="daily-summary-grid">


                        <div class="daily-summary-item">

                            <span>
                                Total
                            </span>

                            <strong id="summaryTotal">
                                {{ $todayAppointments ?? 0 }}
                            </strong>

                        </div>


                        <div class="daily-summary-item">

                            <span>
                                Pending
                            </span>

                            <strong id="summaryPending">
                                {{ $pendingToday ?? 0 }}
                            </strong>

                        </div>


                        <div class="daily-summary-item">

                            <span>
                                Confirmed
                            </span>

                            <strong id="summaryConfirmed">
                                {{ $confirmedToday ?? 0 }}
                            </strong>

                        </div>


                        <div class="daily-summary-item">

                            <span>
                                Completed
                            </span>

                            <strong id="summaryCompleted">
                                {{ $completedToday ?? 0 }}
                            </strong>

                        </div>

                    </div>



                    {{-- NEXT APPOINTMENT --}}

                    <div class="next-appointment-section">


                        <div class="summary-section-title">
                            NEXT APPOINTMENT
                        </div>


                        <div
                            class="next-appointment"
                            id="nextAppointment"
                        >

                            @if(
                                isset($nextAppointment) &&
                                $nextAppointment
                            )


                                <div class="next-time">

                                    <strong>

                                        {{ \Carbon\Carbon::parse($nextAppointment->appointment_time)->format('h:i') }}

                                    </strong>

                                    <span>

                                        {{ \Carbon\Carbon::parse($nextAppointment->appointment_time)->format('A') }}

                                    </span>

                                </div>


                                <div class="next-patient">

                                    <strong>

                                        {{ $nextAppointment->patientRecord->patient_name ?? 'Patient' }}

                                    </strong>

                                    <span>

                                        {{ $nextAppointment->service->name ?? 'Dental Service' }}

                                    </span>

                                </div>


                            @else


                                <div class="no-next-appointment">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        />

                                        <path
                                            d="M8 12H16"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                    <span>
                                        No upcoming appointment
                                    </span>

                                </div>


                            @endif

                        </div>

                    </div>



                    {{-- TODAY'S PROGRESS --}}

                    <div class="progress-section">


                        <div class="summary-section-title">
                            TODAY'S PROGRESS
                        </div>


                        <div class="progress-bar-wrapper">

                            <div class="progress-bar">

                                <span
                                    id="appointmentProgress"
                                    style="width: {{ ($todayAppointments ?? 0) > 0 ? (($completedToday ?? 0) / $todayAppointments) * 100 : 0 }}%"
                                ></span>

                            </div>


                            <strong id="appointmentProgressText">

                                {{ ($todayAppointments ?? 0) > 0
                                    ? round((($completedToday ?? 0) / $todayAppointments) * 100)
                                    : 0
                                }}%

                            </strong>

                        </div>


                        <p>
                            Completed appointments for today.
                        </p>

                    </div>



                    {{-- QUICK ACTIONS --}}

                    <div class="quick-actions-section">


                        <div class="summary-section-title">
                            QUICK ACTIONS
                        </div>


                        <button
                            type="button"
                            class="quick-action"
                            id="openPatientRecords"
                        >

                            <span class="quick-action-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >

                                    <circle
                                        cx="9"
                                        cy="8"
                                        r="3"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    />

                                    <path
                                        d="M3 20C3 16.6863 5.68629 14 9 14C12.3137 14 15 16.6863 15 20"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span>
                                Patient Records
                            </span>


                            <svg
                                class="quick-action-arrow"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >

                                <path
                                    d="M5 12H19M13 6L19 12L13 18"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </button>



                        <button
                            type="button"
                            class="quick-action"
                            id="openDentalChart"
                        >

                            <span class="quick-action-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >

                                    <rect
                                        x="5"
                                        y="3"
                                        width="14"
                                        height="18"
                                        rx="2"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    />

                                    <path
                                        d="M8 8H16"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M8 12H16"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M8 16H13"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <span>
                                Dental Chart
                            </span>


                            <svg
                                class="quick-action-arrow"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >

                                <path
                                    d="M5 12H19M13 6L19 12L13 18"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </button>

                    </div>

                </aside>

            </div>

        </section>

    </main>

</div>



{{-- ============================================================
    APPOINTMENT DETAILS MODAL
============================================================= --}}

<div
    class="modal"
    id="appointmentDetailsModal"
    hidden
>


    <div
        class="modal-overlay"
        data-close-modal
    ></div>


    <div
        class="modal-container"
        role="dialog"
        aria-modal="true"
        aria-labelledby="appointmentModalTitle"
    >


        {{-- HEADER --}}

        <div class="modal-header">


            <div>

                <span class="modal-eyebrow">
                    APPOINTMENT DETAILS
                </span>

                <h2 id="appointmentModalTitle">
                    Appointment
                </h2>

            </div>


            <button
                type="button"
                class="modal-close"
                data-close-modal
                aria-label="Close modal"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
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



        {{-- BODY --}}

        <div class="modal-body">


            {{-- PATIENT --}}

            <div class="modal-patient">

                <div
                    class="modal-patient-avatar"
                    id="modalPatientAvatar"
                >
                    P
                </div>


                <div>

                    <h3 id="modalPatientName">
                        Patient Name
                    </h3>

                    <span id="modalPatientId">
                        Patient ID: —
                    </span>

                </div>

            </div>



            {{-- INFORMATION --}}

            <div class="modal-information-grid">


                <div class="modal-information-item">

                    <span>
                        Appointment Date
                    </span>

                    <strong id="modalAppointmentDate">
                        —
                    </strong>

                </div>


                <div class="modal-information-item">

                    <span>
                        Appointment Time
                    </span>

                    <strong id="modalAppointmentTime">
                        —
                    </strong>

                </div>


                <div class="modal-information-item">

                    <span>
                        Dental Service
                    </span>

                    <strong id="modalAppointmentService">
                        —
                    </strong>

                </div>


                <div class="modal-information-item">

                    <span>
                        Status
                    </span>

                    <strong id="modalAppointmentStatus">
                        —
                    </strong>

                </div>


                <div class="modal-information-item full">

                    <span>
                        Reason / Concern
                    </span>

                    <strong id="modalAppointmentReason">
                        —
                    </strong>

                </div>

            </div>



            {{-- MEDICAL ALERT --}}

            <div
                class="medical-alert"
                id="appointmentMedicalAlert"
                hidden
            >

                <div class="medical-alert-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >

                        <path
                            d="M12 3L21 20H3L12 3Z"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M12 9V13"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <circle
                            cx="12"
                            cy="16.5"
                            r="0.8"
                            fill="currentColor"
                        />

                    </svg>

                </div>


                <div>

                    <strong>
                        Medical Alert
                    </strong>

                    <p id="medicalAlertText">
                        —
                    </p>

                </div>

            </div>

        </div>



        {{-- FOOTER --}}

        <div class="modal-footer">


            <button
                type="button"
                class="secondary-button"
                id="modalPatientRecordButton"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >

                    <circle
                        cx="9"
                        cy="8"
                        r="3"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <path
                        d="M3 20C3 16.6863 5.68629 14 9 14C12.3137 14 15 16.6863 15 20"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                </svg>

                Patient Record

            </button>


            <button
                type="button"
                class="danger-button"
                id="modalDeclineButton"
            >

                Decline

            </button>


            <button
                type="button"
                class="primary-button"
                id="modalConfirmButton"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >

                    <path
                        d="M5 12L10 17L20 7"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />

                </svg>

                Confirm

            </button>

        </div>

    </div>

</div>



{{-- ============================================================
    NEW APPOINTMENT MODAL
============================================================= --}}

<div
    class="modal"
    id="newAppointmentModal"
    hidden
>


    <div
        class="modal-overlay"
        data-close-modal
    ></div>


    <div
        class="modal-container"
        role="dialog"
        aria-modal="true"
    >


        <div class="modal-header">


            <div>

                <span class="modal-eyebrow">
                    APPOINTMENT
                </span>

                <h2>
                    New Appointment
                </h2>

                <p>
                    Create a new appointment for a patient.
                </p>

            </div>


            <button
                type="button"
                class="modal-close"
                data-close-modal
                aria-label="Close modal"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
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



        <form
            id="newAppointmentForm"
            method="POST"
            action="{{ route('appointments.store') }}"
        >

            @csrf


            <div class="modal-body">


                <div class="form-grid">


                    {{-- PATIENT --}}

                    <div class="form-group full">

                        <label for="newPatient">

                            Patient

                            <span>
                                *
                            </span>

                        </label>


                        <select
                            id="newPatient"
                            name="patient_record_id"
                            required
                        >

                            <option value="">
                                Select patient
                            </option>


                            @foreach($patients ?? [] as $patient)

                                <option
                                    value="{{ $patient->id }}"
                                >

                                    {{ $patient->patient_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>



                    {{-- DATE --}}

                    <div class="form-group">

                        <label for="newAppointmentDate">

                            Date

                            <span>
                                *
                            </span>

                        </label>


                        <input
                            type="date"
                            id="newAppointmentDate"
                            name="appointment_date"
                            required
                        >

                    </div>



                    {{-- TIME --}}

                    <div class="form-group">

                        <label for="newAppointmentTime">

                            Time

                            <span>
                                *
                            </span>

                        </label>


                        <input
                            type="time"
                            id="newAppointmentTime"
                            name="appointment_time"
                            required
                        >

                    </div>



                    {{-- SERVICE --}}

                    <div class="form-group full">

                        <label for="newService">

                            Dental Service

                            <span>
                                *
                            </span>

                        </label>


                        <select
                            id="newService"
                            name="service_id"
                            required
                        >

                            <option value="">
                                Select dental service
                            </option>


                            @foreach($services ?? [] as $service)

                                <option
                                    value="{{ $service->id }}"
                                >

                                    {{ $service->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>



                    {{-- REASON --}}

                    <div class="form-group full">

                        <label for="newReason">
                            Reason / Concern
                        </label>


                        <textarea
                            id="newReason"
                            name="reason"
                            rows="4"
                            placeholder="Enter the reason for the appointment..."
                        ></textarea>

                    </div>

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
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >

                        <path
                            d="M20 6L9 17L4 12"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                    </svg>

                    Create Appointment

                </button>

            </div>

        </form>

    </div>

</div>



{{-- ============================================================
    CONFIRMATION MODAL
============================================================= --}}

<div
    class="modal"
    id="confirmationModal"
    hidden
>


    <div
        class="modal-overlay"
        data-close-modal
    ></div>


    <div
        class="modal-container small-modal"
        role="dialog"
        aria-modal="true"
    >


        <div class="confirmation-icon">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >

                <circle
                    cx="12"
                    cy="12"
                    r="9"
                    stroke="currentColor"
                    stroke-width="1.8"
                />

                <path
                    d="M8 12L11 15L17 9"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

            </svg>

        </div>


        <div class="confirmation-content">

            <h2 id="confirmationTitle">
                Confirm Appointment?
            </h2>

            <p id="confirmationMessage">
                Are you sure you want to confirm this appointment?
            </p>

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
                type="button"
                class="primary-button"
                id="confirmActionButton"
            >
                Confirm
            </button>

        </div>

    </div>

</div>



{{-- ============================================================
    LOADING OVERLAY
============================================================= --}}

<div
    class="loading-overlay"
    id="loadingOverlay"
    hidden
>

    <div class="loading-spinner"></div>

    <span>
        Processing...
    </span>

</div>



{{-- ============================================================
    TOAST
============================================================= --}}

<div
    class="toast-container"
    id="toastContainer"
    aria-live="polite"
    aria-atomic="true"
>
</div>

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

    window.DentistAppointments = {

        csrfToken: "{{ csrf_token() }}",

        routes: {

            index:
                "{{ route('dentist.appointments') }}",

            store:
                "{{ route('appointments.store') }}",

            patientRecords:
                "{{ route('dentist.patient-records') }}",

            appointments:
                "{{ url('/dentist/appointments') }}"

        }

    };

</script>


{{-- Separate JavaScript --}}

<script
    src="{{ asset('js/dentist-appointments.js') }}"
    defer
></script>


</body>

</html>
