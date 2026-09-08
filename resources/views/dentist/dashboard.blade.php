<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard | Shine & Smile Dental Clinic</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/dentists/dentist-dashboard.css') }}"
    >
</head>

<body>

<div class="dashboard-page">
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

    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <main class="main-content">


        {{-- =====================================================
             HEADER
        ====================================================== --}}
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


        {{-- =====================================================
             DASHBOARD BODY
        ====================================================== --}}

        <section class="dashboard-body">


            {{-- PAGE INTRO --}}

            <div class="dashboard-intro">

                <div>

                    <div class="breadcrumb">

                        <span>
                            Dentist
                        </span>

                        <svg viewBox="0 0 24 24" fill="none">

                            <path
                                d="M9 18L15 12L9 6"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                        </svg>

                        <span>
                            Dashboard
                        </span>

                    </div>

                    <h2>
                        Today's Overview
                    </h2>

                    <p>
                        Here's what's happening at your clinic today.
                    </p>

                </div>


                <div class="dashboard-date">

                    <svg viewBox="0 0 24 24" fill="none">

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

                    {{ now()->format('F d, Y') }}

                </div>

            </div>


            {{-- =================================================
                 STAT CARDS
            ================================================== --}}

            <div class="stats-grid">


                {{-- TODAY'S APPOINTMENTS --}}

                <div class="dashboard-stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon blue">

                            <svg viewBox="0 0 24 24" fill="none">

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

                        <span class="stat-label">
                            TODAY
                        </span>

                    </div>

                    <strong class="stat-number">
                        {{ $todayAppointments ?? 0 }}
                    </strong>

                    <span class="stat-description">
                        Appointments scheduled
                    </span>

                </div>


                {{-- PENDING --}}

                <div class="dashboard-stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon orange">

                            <svg viewBox="0 0 24 24" fill="none">

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
                                />

                            </svg>

                        </div>

                        <span class="stat-label">
                            PENDING
                        </span>

                    </div>

                    <strong class="stat-number">
                        {{ $pendingAppointments ?? 0 }}
                    </strong>

                    <span class="stat-description">
                        Need your attention
                    </span>

                </div>


                {{-- CONFIRMED --}}

                <div class="dashboard-stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon green">

                            <svg viewBox="0 0 24 24" fill="none">

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

                        <span class="stat-label">
                            CONFIRMED
                        </span>

                    </div>

                    <strong class="stat-number">
                        {{ $confirmedAppointments ?? 0 }}
                    </strong>

                    <span class="stat-description">
                        Ready for consultation
                    </span>

                </div>


                {{-- PATIENTS --}}

                <div class="dashboard-stat-card">

                    <div class="stat-card-top">

                        <div class="stat-icon purple">

                            <svg viewBox="0 0 24 24" fill="none">

                                <circle
                                    cx="9"
                                    cy="8"
                                    r="3"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                />

                                <path
                                    d="M3 20C3 16.7 5.7 14 9 14C12.3 14 15 16.7 15 20"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />

                                <circle
                                    cx="17"
                                    cy="9"
                                    r="2"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                />

                            </svg>

                        </div>

                        <span class="stat-label">
                            PATIENTS
                        </span>

                    </div>

                    <strong class="stat-number">
                        {{ $totalPatients ?? 0 }}
                    </strong>

                    <span class="stat-description">
                        Registered patients
                    </span>

                </div>

            </div>


            {{-- =================================================
                 MAIN GRID
            ================================================== --}}

            <div class="dashboard-grid">


                {{-- =================================================
                     TODAY'S APPOINTMENTS
                ================================================== --}}

                <section class="dashboard-card appointments-card">


                    <div class="card-header">

                        <div>

                            <h3>
                                Today's Appointments
                            </h3>

                            <p>
                                Your scheduled consultations for today.
                            </p>

                        </div>


                        <a
                            href="{{ route('dentist.appointments') }}"
                            class="view-all-link"
                        >
                            View All

                            <svg viewBox="0 0 24 24" fill="none">

                                <path
                                    d="M5 12H19"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />

                                <path
                                    d="M13 6L19 12L13 18"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </a>

                    </div>


                    <div class="appointment-list">

                        @forelse($todayAppointmentList ?? [] as $appointment)

                            @php
                                $status = strtolower(
                                    $appointment->status ?? 'pending'
                                );
                            @endphp


                            <div
                                class="dashboard-appointment"
                                data-status="{{ $status }}"
                            >


                                <div class="appointment-time">

                                    <strong>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i') }}
                                    </strong>

                                    <span>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('A') }}
                                    </span>

                                </div>


                                <div class="appointment-patient">

                                    <div class="patient-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $appointment->patientRecord->patient_name ?? 'P',
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>


                                    <div>

                                        <strong>
                                            {{ $appointment->patientRecord->patient_name ?? 'Unknown Patient' }}
                                        </strong>

                                        <span>
                                            {{ $appointment->service->name ?? 'Dental Service' }}
                                        </span>

                                    </div>

                                </div>


                                <span
                                    class="appointment-status status-{{ $status }}"
                                >

                                    {{ ucfirst($status) }}

                                </span>

                            </div>


                        @empty

                            <div class="dashboard-empty-state">

                                <div class="empty-icon">

                                    <svg viewBox="0 0 24 24" fill="none">

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

                                <strong>
                                    No appointments today
                                </strong>

                                <span>
                                    Your schedule is currently clear.
                                </span>

                            </div>

                        @endforelse

                    </div>

                </section>


                {{-- =================================================
                     NEXT APPOINTMENT
                ================================================== --}}

                <section class="dashboard-card next-card">


                    <div class="card-header">

                        <div>

                            <h3>
                                Next Appointment
                            </h3>

                            <p>
                                Your upcoming patient.
                            </p>

                        </div>

                    </div>


                    @if($nextAppointment ?? false)


                        <div class="next-appointment-box">


                            <div class="next-appointment-time">

                                <span>
                                    NEXT
                                </span>

                                <strong>
                                    {{ \Carbon\Carbon::parse($nextAppointment->appointment_time)->format('h:i A') }}
                                </strong>

                            </div>


                            <div class="next-patient-avatar">

                                {{ strtoupper(
                                    substr(
                                        $nextAppointment->patientRecord->patient_name ?? 'P',
                                        0,
                                        1
                                    )
                                ) }}

                            </div>


                            <h4>

                                {{ $nextAppointment->patientRecord->patient_name ?? 'Patient' }}

                            </h4>


                            <p>

                                {{ $nextAppointment->service->name ?? 'Dental Service' }}

                            </p>


                            <a
                                href="{{ route(
                                    'dentist.appointments.show',
                                    $nextAppointment->id
                                ) }}"
                                class="next-view-button"
                            >

                                View Appointment

                                <svg viewBox="0 0 24 24" fill="none">

                                    <path
                                        d="M5 12H19"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M13 6L19 12L13 18"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />

                                </svg>

                            </a>

                        </div>


                    @else


                        <div class="dashboard-empty-state compact">

                            <div class="empty-icon">

                                <svg viewBox="0 0 24 24" fill="none">

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

                            </div>

                            <strong>
                                No upcoming appointment
                            </strong>

                            <span>
                                You're all caught up.
                            </span>

                        </div>

                    @endif

                </section>


            </div>


            {{-- =================================================
                 LOWER GRID
            ================================================== --}}

            <div class="dashboard-grid lower-grid">


                {{-- =================================================
                     PATIENT RECORDS
                ================================================== --}}

                <section class="dashboard-card">


                    <div class="card-header">

                        <div>

                            <h3>
                                Recent Patients
                            </h3>

                            <p>
                                Recently registered or updated patients.
                            </p>

                        </div>


                        <a
                            href="{{ route('dentist.patient-records') }}"
                            class="view-all-link"
                        >
                            View All

                            <svg viewBox="0 0 24 24" fill="none">

                                <path
                                    d="M5 12H19"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />

                                <path
                                    d="M13 6L19 12L13 18"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </a>

                    </div>


                    <div class="patient-list">

                        @forelse($recentPatients ?? [] as $patient)

                            <div class="recent-patient">

                                <div class="patient-avatar">

                                    {{ strtoupper(
                                        substr(
                                            $patient->patient_name ?? 'P',
                                            0,
                                            1
                                        )
                                    ) }}

                                </div>


                                <div class="recent-patient-info">

                                    <strong>
                                        {{ $patient->patient_name }}
                                    </strong>

                                    <span>
                                        Patient ID:
                                        P-{{ str_pad(
                                            $patient->id,
                                            5,
                                            '0',
                                            STR_PAD_LEFT
                                        ) }}
                                    </span>

                                </div>


                                <a
                                    href="{{ route(
                                        'dentist.patient-records.show',
                                        $patient->id
                                    ) }}"
                                    class="patient-view-button"
                                    title="View patient"
                                >

                                    <svg viewBox="0 0 24 24" fill="none">

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

                                </a>

                            </div>

                        @empty

                            <div class="dashboard-empty-state">

                                <strong>
                                    No recent patients
                                </strong>

                                <span>
                                    Patient records will appear here.
                                </span>

                            </div>

                        @endforelse

                    </div>

                </section>


                {{-- =================================================
                     QUICK ACTIONS
                ================================================== --}}

                <section class="dashboard-card quick-actions-card">


                    <div class="card-header">

                        <div>

                            <h3>
                                Quick Actions
                            </h3>

                            <p>
                                Frequently used dentist tools.
                            </p>

                        </div>

                    </div>


                    <div class="quick-actions">


                        <a
                            href="{{ route('dentist.appointments') }}"
                            class="quick-action"
                        >

                            <div class="quick-action-icon blue">

                                <svg viewBox="0 0 24 24" fill="none">

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

                            <div>

                                <strong>
                                    Manage Appointments
                                </strong>

                                <span>
                                    View today's schedule
                                </span>

                            </div>

                            <svg
                                class="quick-arrow"
                                viewBox="0 0 24 24"
                                fill="none"
                            >

                                <path
                                    d="M5 12H19M13 6L19 12L13 18"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </a>


                        <a
                            href="{{ route('dentist.patient-records') }}"
                            class="quick-action"
                        >

                            <div class="quick-action-icon purple">

                                <svg viewBox="0 0 24 24" fill="none">

                                    <circle
                                        cx="9"
                                        cy="8"
                                        r="3"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    />

                                    <path
                                        d="M3 20C3 16.7 5.7 14 9 14C12.3 14 15 16.7 15 20"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </div>

                            <div>

                                <strong>
                                    Patient Records
                                </strong>

                                <span>
                                    View patient information
                                </span>

                            </div>

                            <svg
                                class="quick-arrow"
                                viewBox="0 0 24 24"
                                fill="none"
                            >

                                <path
                                    d="M5 12H19M13 6L19 12L13 18"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </a>


                        <a
                            href="{{ route('dentist.odontogram') }}"
                            class="quick-action"
                        >

                            <div class="quick-action-icon green">

                                <svg viewBox="0 0 24 24" fill="none">

                                    <path
                                        d="M12 3C8 3 5 5.5 5 9C5 12 6.5 13.5 7 16.5C7.5 19.5 8.5 21 10 21C11.5 21 11.5 18 12 17C12.5 18 12.5 21 14 21C15.5 21 16.5 19.5 17 16.5C17.5 13.5 19 12 19 9C19 5.5 16 3 12 3Z"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                        stroke-linejoin="round"
                                    />

                                </svg>

                            </div>

                            <div>

                                <strong>
                                    Dental Chart
                                </strong>

                                <span>
                                    Manage tooth records
                                </span>

                            </div>

                            <svg
                                class="quick-arrow"
                                viewBox="0 0 24 24"
                                fill="none"
                            >

                                <path
                                    d="M5 12H19M13 6L19 12L13 18"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </a>




                            <div class="quick-action-icon orange">

                                <svg viewBox="0 0 24 24" fill="none">

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

                                </svg>

                            </div>

                            <div>

                                <strong>
                                    Prescriptions
                                </strong>

                                <span>
                                    Manage prescriptions
                                </span>

                            </div>

                            <svg
                                class="quick-arrow"
                                viewBox="0 0 24 24"
                                fill="none"
                            >

                                <path
                                    d="M5 12H19M13 6L19 12L13 18"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </a>

                    </div>

                </section>

            </div>


            {{-- =================================================
                 CLINIC SUMMARY
            ================================================== --}}

            <section class="dashboard-card clinic-summary-card">


                <div class="clinic-summary-header">

                    <div>

                        <h3>
                            Today's Progress
                        </h3>

                        <p>
                            Overview of your appointment completion.
                        </p>

                    </div>

                    <strong>
                        {{ $todayAppointments ?? 0 }} Appointments
                    </strong>

                </div>


                <div class="progress-container">

                    @php

                        $progress =
                            ($todayAppointments ?? 0) > 0
                                ? (($completedToday ?? 0) / $todayAppointments) * 100
                                : 0;

                    @endphp


                    <div class="progress-track">

                        <div
                            class="progress-fill"
                            style="width: {{ $progress }}%;"
                        ></div>

                    </div>


                    <span>
                        {{ round($progress) }}% completed
                    </span>

                </div>


                <div class="progress-stats">

                    <div>

                        <span class="progress-dot pending"></span>

                        <strong>
                            {{ $pendingToday ?? 0 }}
                        </strong>

                        <small>
                            Pending
                        </small>

                    </div>


                    <div>

                        <span class="progress-dot confirmed"></span>

                        <strong>
                            {{ $confirmedToday ?? 0 }}
                        </strong>

                        <small>
                            Confirmed
                        </small>

                    </div>


                    <div>

                        <span class="progress-dot completed"></span>

                        <strong>
                            {{ $completedToday ?? 0 }}
                        </strong>

                        <small>
                            Completed
                        </small>

                    </div>

                </div>

            </section>

        </section>

    </main>

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

{{-- =========================================================
     JAVASCRIPT CONFIG
========================================================== --}}

<script>

    window.DentistDashboard = {

        routes: {

            dashboard:
                "{{ route('dentist.dashboard') }}",

            appointments:
                "{{ route('dentist.appointments') }}",

            patients:
                "{{ route('dentist.patient-records') }}"

        },

        csrfToken:
            "{{ csrf_token() }}"

    };

</script>


<script
    src="{{ asset('js/dentist/dentist-dashboard.js') }}"
    defer
></script>

</body>
</html>
