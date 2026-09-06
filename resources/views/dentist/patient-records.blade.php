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

    <title>Patient Records | Shine & Smile Dental Clinic</title>

    {{-- CSS --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/dentists/dentist-patientrecords.css') }}"
    >
</head>

<body>

{{-- ============================================================
    PAGE WRAPPER
============================================================ --}}

<div class="patient-records-page">

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


    {{-- ========================================================
        MAIN CONTENT
    ========================================================= --}}

    <main class="main-content">


        {{-- ====================================================
            TOP HEADER
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
            PAGE BODY
        ===================================================== --}}

        <section class="page-body">


            {{-- =================================================
                PATIENT LIST VIEW
            ================================================== --}}

            <div
                class="patient-list-view"
                id="patientListView"
            >


                {{-- Page Header --}}

                <div class="content-header">

                    <div>

                        <h2>
                            All Patients
                        </h2>

                        <p>
                            View and manage registered patient records.
                        </p>

                    </div>

                    <button
                        type="button"
                        class="primary-button"
                        id="addPatientButton"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 5V19M5 12H19"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                            />
                        </svg>

                        <span>
                            Add Patient
                        </span>

                    </button>

                </div>



                {{-- =============================================
                    STAT CARDS
                ============================================== --}}

                <div class="patient-stat-grid">


                    <div class="patient-stat-card">

                        <div class="stat-icon blue">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M16 20V18C16 15.7909 14.2091 14 12 14H7C4.79086 14 3 15.7909 3 18V20"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />

                                <circle
                                    cx="9.5"
                                    cy="7"
                                    r="3"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                />

                                <path
                                    d="M17 11C18.6569 11 20 9.65685 20 8C20 6.34315 18.6569 5 17 5"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                />
                            </svg>

                        </div>

                        <div class="stat-content">

                            <span>
                                Total Patients
                            </span>

                            <strong id="totalPatients">
                                {{ $totalPatients ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    <div class="patient-stat-card">

                        <div class="stat-icon green">

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

                        </div>

                        <div class="stat-content">

                            <span>
                                Active Patients
                            </span>

                            <strong id="activePatients">
                                {{ $activePatients ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    <div class="patient-stat-card">

                        <div class="stat-icon pink">

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
                                    d="M8 3V7M16 3V7M4 10H20"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />
                            </svg>

                        </div>

                        <div class="stat-content">

                            <span>
                                Today's Appointments
                            </span>

                            <strong id="todayAppointments">
                                {{ $todayAppointments ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    <div class="patient-stat-card">

                        <div class="stat-icon orange">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M12 3L14.7 8.3L20.5 9.1L16.3 13.2L17.3 19L12 16.3L6.7 19L7.7 13.2L3.5 9.1L9.3 8.3L12 3Z"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linejoin="round"
                                />
                            </svg>

                        </div>

                        <div class="stat-content">

                            <span>
                                New This Month
                            </span>

                            <strong id="newPatients">
                                {{ $newPatients ?? 0 }}
                            </strong>

                        </div>

                    </div>

                </div>



                {{-- =============================================
                    SEARCH / FILTER BAR
                ============================================== --}}

                <div class="patient-filter-card">

                    <div class="patient-search">

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
                            id="patientSearch"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search patient by name, ID, phone or email..."
                            autocomplete="off"
                        >

                    </div>


                    <div class="filter-group">

                        <label for="patientStatus">
                            Status
                        </label>

                        <select
                            id="patientStatus"
                            name="status"
                        >

                            <option value="">
                                All Patients
                            </option>

                            <option
                                value="active"
                                {{ request('status') === 'active' ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                {{ request('status') === 'inactive' ? 'selected' : '' }}
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                    <button
                        type="button"
                        class="filter-reset-button"
                        id="resetFilters"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M3 12C3 7.02944 7.02944 3 12 3C15.0899 3 17.8154 4.55508 19.3473 6.93333"
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
                                d="M21 12C21 16.9706 16.9706 21 12 21C8.91007 21 6.18459 19.4449 4.65271 17.0667"
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



                {{-- =============================================
                    PATIENT TABLE
                ============================================== --}}

                <div class="patient-table-card">

                    <div class="table-header">

                        <div>

                            <h3>
                                Patient Directory
                            </h3>

                            <p>
                                {{ isset($patients) ? $patients->count() : 0 }}
                                patients displayed
                            </p>

                        </div>

                    </div>


                    <div class="table-wrapper">

                        <table class="patient-table">

                            <thead>

                                <tr>

                                    <th>
                                        Patient
                                    </th>

                                    <th>
                                        Patient ID
                                    </th>

                                    <th>
                                        Contact
                                    </th>

                                    <th>
                                        Age
                                    </th>

                                    <th>
                                        Sex
                                    </th>

                                    <th>
                                        Last Visit
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody id="patientTableBody">

                                @forelse($patients as $patient)

                                    <tr
                                        class="patient-row"
                                        data-patient-id="{{ $patient->id }}"
                                    >

                                        <td>

                                            <div class="patient-cell">

                                                <div class="patient-avatar">

                                                    @if(
                                                        $patient->user &&
                                                        $patient->user->profile_picture
                                                    )

                                                        <img
                                                            src="{{ asset('storage/' . $patient->user->profile_picture) }}"
                                                            alt="{{ $patient->patient_name }}"
                                                        >

                                                    @else

                                                        {{ strtoupper(substr($patient->patient_name, 0, 1)) }}

                                                    @endif

                                                </div>

                                                <div class="patient-cell-info">

                                                    <strong>
                                                        {{ $patient->patient_name }}
                                                    </strong>

                                                    <span>
                                                        {{ $patient->user->email ?? 'No email' }}
                                                    </span>

                                                </div>

                                            </div>

                                        </td>


                                        <td>

                                            <span class="patient-id">
                                                P-{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}
                                            </span>

                                        </td>


                                        <td>

                                            <span class="contact-number">
                                                {{ $patient->tel_no ?? '—' }}
                                            </span>

                                        </td>


                                        <td>
                                            {{ $patient->age ?? '—' }}
                                        </td>


                                        <td>
                                            {{ $patient->sex ?? '—' }}
                                        </td>


                                        <td>

                                            @php
                                                $lastVisit = $patient->appointments
                                                    ->whereIn('status', ['completed', 'approved'])
                                                    ->sortByDesc('appointment_date')
                                                    ->first();
                                            @endphp

                                            @if($lastVisit)

                                                <span class="visit-date">
                                                    {{ \Carbon\Carbon::parse($lastVisit->appointment_date)->format('M d, Y') }}
                                                </span>

                                            @else

                                                <span class="muted-text">
                                                    No visit yet
                                                </span>

                                            @endif

                                        </td>


                                        <td>

                                            <span class="status-badge status-active">
                                                Active
                                            </span>

                                        </td>


                                        <td>

                                            <button
                                                type="button"
                                                class="view-patient-button"
                                                data-patient-id="{{ $patient->id }}"
                                            >

                                                View Record

                                                <svg
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

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="8"
                                            class="empty-table"
                                        >

                                            <div class="empty-state">

                                                <div class="empty-state-icon">

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

                                                </div>

                                                <h3>
                                                    No patients found
                                                </h3>

                                                <p>
                                                    There are currently no patient records matching your search.
                                                </p>

                                            </div>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}

                    @if(method_exists($patients, 'links'))

                        <div class="pagination-wrapper">

                            {{ $patients->links() }}

                        </div>

                    @endif

                </div>

            </div>




            {{-- =================================================
                PATIENT RECORD VIEW
                Form-style dental record UI
            ================================================== --}}

            <div class="patient-record-view" id="patientRecordView" hidden>

                <div class="record-header">
                    <button type="button" class="back-button" id="backToPatients">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5M11 18L5 12L11 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Back to Patients
                    </button>
                    <div class="record-header-actions">
                        <button type="button" class="secondary-button" id="printPatientRecord">Print Record</button>
                        <button type="button" class="primary-button" id="editPatientButton">Edit Record</button>
                    </div>
                </div>

                <div class="patient-profile-card" id="patientProfileCard">
                    <div class="patient-profile-main">
                    <div class="large-patient-avatar" id="recordPatientAvatar">

                        <img
                            id="recordPatientImage"
                            src=""
                            alt="Patient Profile"
                        >

                        <span id="recordPatientInitial">
                            P
                        </span>

                    </div>

                        <div class="patient-profile-details">
                            <div class="patient-name-row">
                                <h2 id="recordPatientName">Patient Name</h2>
                                <span class="status-badge status-active" id="recordPatientStatus">Active</span>
                            </div>
                            <p class="record-patient-id" id="recordPatientId">Patient ID: —</p>
                            <div class="patient-quick-info">
                                <div><span>Age</span><strong id="recordPatientAge">—</strong></div>
                                <div><span>Sex</span><strong id="recordPatientSex">—</strong></div>
                                <div><span>Contact</span><strong id="recordPatientPhone">—</strong></div>
                                <div><span>Email</span><strong id="recordPatientEmail">—</strong></div>
                            </div>
                        </div>
                    </div>
                    <div class="patient-profile-meta">
                        <div><span>Registered</span><strong id="recordPatientRegistered">—</strong></div>
                        <div><span>Last Visit</span><strong id="recordPatientLastVisit">—</strong></div>
                    </div>
                </div>

                <section class="record-ui-card">
                    <div class="record-ui-card-header"><h2>Patient Information</h2></div>
                    <div class="record-ui-form-grid">
                        <div class="record-ui-form-group"><label>Full Name</label><div class="record-ui-value" id="overviewFullName">—</div></div>
                        <div class="record-ui-form-group"><label>Age</label><div class="record-ui-value" id="overviewAge">—</div></div>
                        <div class="record-ui-form-group"><label>Sex</label><div class="record-ui-value" id="overviewSex">—</div></div>
                        <div class="record-ui-form-group"><label>Civil Status</label><div class="record-ui-value" id="overviewCivilStatus">—</div></div>
                        <div class="record-ui-form-group"><label>Contact Number</label><div class="record-ui-value" id="overviewPhone">—</div></div>
                        <div class="record-ui-form-group"><label>Occupation</label><div class="record-ui-value" id="overviewOccupation">—</div></div>
                        <div class="record-ui-form-group full-width"><label>Address</label><div class="record-ui-value record-ui-textarea" id="overviewAddress">—</div></div>
                    </div>
                </section>

                <section class="record-ui-card">
                    <div class="record-ui-card-header"><h2>Medical History</h2></div>
                    <div class="medical-ui-grid">
                        <div class="medical-ui-item" id="medicalCardHeart"><label class="medical-ui-check-label"><input type="checkbox" id="medicalHeartCheckbox" disabled><span class="medical-ui-checkmark"></span><strong>Heart Condition</strong></label><p id="medicalHeartCondition" class="medical-ui-status">No</p><div id="medicalHeartDetails" class="medical-ui-details">—</div></div>
                        <div class="medical-ui-item" id="medicalCardAllergy"><label class="medical-ui-check-label"><input type="checkbox" id="medicalAllergyCheckbox" disabled><span class="medical-ui-checkmark"></span><strong>Allergy</strong></label><p id="medicalAllergy" class="medical-ui-status">No</p><div id="medicalAllergyDetails" class="medical-ui-details">—</div></div>
                        <div class="medical-ui-item" id="medicalCardDiabetes"><label class="medical-ui-check-label"><input type="checkbox" id="medicalDiabetesCheckbox" disabled><span class="medical-ui-checkmark"></span><strong>Diabetes</strong></label><p id="medicalDiabetes" class="medical-ui-status">No</p><div id="medicalDiabetesDetails" class="medical-ui-details">—</div></div>
                        <div class="medical-ui-item" id="medicalCardHypertension"><label class="medical-ui-check-label"><input type="checkbox" id="medicalHypertensionCheckbox" disabled><span class="medical-ui-checkmark"></span><strong>Hypertension / High Blood Pressure</strong></label><p id="medicalHypertension" class="medical-ui-status">No</p><div id="medicalHypertensionDetails" class="medical-ui-details">—</div></div>
                        <div class="medical-ui-item" id="medicalCardBleeding"><label class="medical-ui-check-label"><input type="checkbox" id="medicalBleedingCheckbox" disabled><span class="medical-ui-checkmark"></span><strong>Bleeding Tendency</strong></label><p id="medicalBleeding" class="medical-ui-status">No</p><div id="medicalBleedingDetails" class="medical-ui-details">—</div></div>
                        <div class="medical-ui-item" id="medicalCardAsthma"><label class="medical-ui-check-label"><input type="checkbox" id="medicalAsthmaCheckbox" disabled><span class="medical-ui-checkmark"></span><strong>Asthma</strong></label><p id="medicalAsthma" class="medical-ui-status">No</p><div id="medicalAsthmaDetails" class="medical-ui-details">—</div></div>
                    </div>
                    <div class="medical-ui-other"><label>Other Diseases / Abnormalities &amp; Treatments</label><div id="medicalOtherConditions" class="medical-ui-other-box">None recorded.</div></div>
                    <div class="medical-record-signature"><div class="signature-line"></div><span>Patient / Guardian Signature</span></div>
                </section>



                <section class="record-ui-card">
                    <div class="record-ui-card-header"><h2>Appointment Details</h2></div>
                    <div class="record-ui-form-grid">
                        <div class="record-ui-form-group full-width"><label>Dental Service</label><div class="record-ui-value" id="recordAppointmentService">—</div></div>
                        <div class="record-ui-form-group"><label>Appointment Date</label><div class="record-ui-value" id="recordAppointmentDate">—</div></div>
                        <div class="record-ui-form-group"><label>Available Time Slot</label><div class="record-ui-value" id="recordAppointmentTime">—</div></div>
                        <div class="record-ui-form-group full-width"><label>Reason for Visit</label><div class="record-ui-value record-ui-textarea" id="recordAppointmentReason">—</div></div>
                    </div>
                    <div class="appointment-list" id="appointmentList"><div class="empty-record-message">No appointments recorded.</div></div>
                </section>

                <section class="record-ui-card">
                    <div class="record-ui-card-header treatment-header"><div><h2>Treatment / Payment History</h2><p>Record dental procedures and payment information.</p></div></div>
                    <div class="patient-treatment-table-wrapper">
                        <table class="patient-treatment-table">
                            <thead><tr><th>Date</th><th>Problem &amp; Diagnosis</th><th>Amount</th><th>Deposit</th><th>Balance</th><th>Action</th></tr></thead>
                            <tbody id="treatmentTableBody"><tr><td colspan="6" class="empty-table"><div class="empty-state">No treatment records available.</div></td></tr></tbody>
                            <tfoot id="treatmentTableFooter"><tr><td colspan="2"><strong>Total</strong></td><td><strong id="totalTreatmentAmount">₱0.00</strong></td><td><strong id="totalTreatmentDeposit">₱0.00</strong></td><td><strong id="totalTreatmentBalance">₱0.00</strong></td><td></td></tr></tfoot>
                        </table>
                    </div>
                </section>


                <section class="record-ui-card">
                    <div class="record-ui-card-header"><div><h2>Clinical Notes</h2><p>Additional notes related to the patient's dental care.</p></div><button type="button" class="primary-button" id="addNoteButton">+ Add Note</button></div>
                    <div id="notesList" class="notes-list"><div class="empty-record-message">No clinical notes recorded.</div></div>
                </section>

                <div class="patient-record-js-compat" aria-hidden="true">
                    <div id="tab-overview"></div><div id="tab-medical-history"></div><div id="tab-dental-chart"></div><div id="tab-treatments"></div><div id="tab-appointments"></div><div id="tab-prescriptions"></div><div id="tab-notes"></div>
                    <div id="overviewMedicalAlerts"></div><div id="overviewRecentTreatments"></div><div id="overviewUpcomingAppointment"></div>
                </div>
            </div>

{{-- ============================================================
    LOADING OVERLAY
============================================================ --}}

<div
    class="loading-overlay"
    id="loadingOverlay"
    hidden
>

    <div class="loading-spinner"></div>

    <p>
        Loading patient record...
    </p>

</div>



<div
    class="toast-container"
    id="toastContainer"
    aria-live="polite"
    aria-atomic="true"
>

</div>


<div
    class="modal"
    id="editPatientModal"
    hidden
>

    <div class="modal-overlay" data-close-modal></div>

    <div
        class="modal-container"
        role="dialog"
        aria-modal="true"
        aria-labelledby="editPatientModalTitle"
    >

        <div class="modal-header">

            <div>

                <h2 id="editPatientModalTitle">
                    Edit Patient Record
                </h2>

                <p>
                    Update patient information
                </p>

            </div>

            <button
                type="button"
                class="modal-close"
                data-close-modal
                aria-label="Close"
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
            id="editPatientForm"
            method="POST"
        >

            @csrf

            @method('PUT')

            <input
                type="hidden"
                name="patient_id"
                id="editPatientId"
            >


            <div class="modal-body">

                <div class="form-grid">


                    <div class="form-group">

                        <label for="editPatientName">
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="editPatientName"
                            name="patient_name"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="editPatientAge">
                            Age
                        </label>

                        <input
                            type="number"
                            id="editPatientAge"
                            name="age"
                            min="0"
                            max="150"
                        >

                    </div>


                    <div class="form-group">

                        <label for="editPatientSex">
                            Sex
                        </label>

                        <select
                            id="editPatientSex"
                            name="sex"
                        >

                            <option value="">
                                Select sex
                            </option>

                            <option value="Male">
                                Male
                            </option>

                            <option value="Female">
                                Female
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="editCivilStatus">
                            Civil Status
                        </label>

                        <select
                            id="editCivilStatus"
                            name="civil_status"
                        >

                            <option value="">
                                Select status
                            </option>

                            <option value="Single">
                                Single
                            </option>

                            <option value="Married">
                                Married
                            </option>

                            <option value="Widowed">
                                Widowed
                            </option>

                            <option value="Separated">
                                Separated
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="editPhone">
                            Phone Number
                        </label>

                        <input
                            type="tel"
                            id="editPhone"
                            name="tel_no"
                        >

                    </div>


                    <div class="form-group">

                        <label for="editOccupation">
                            Occupation
                        </label>

                        <input
                            type="text"
                            id="editOccupation"
                            name="occupation"
                        >

                    </div>


                    <div class="form-group full">

                        <label for="editAddress">
                            Address
                        </label>

                        <textarea
                            id="editAddress"
                            name="address"
                            rows="3"
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

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</div>

<div
    class="modal"
    id="treatmentModal"
    hidden
>

    <div
        class="modal-overlay"
        data-close-modal
    ></div>


    <div
        class="modal-container treatment-modal-container"
        role="dialog"
        aria-modal="true"
        aria-labelledby="treatmentModalTitle"
    >

        <div class="modal-header">

            <div>

                <h2 id="treatmentModalTitle">
                    Add Treatment Record
                </h2>

                <p>
                    Record the patient's problem, diagnosis and payment.
                </p>

            </div>


            <button
                type="button"
                class="modal-close"
                data-close-modal
                aria-label="Close"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
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
            id="treatmentForm"
            method="POST"
        >

            @csrf


            <input
                type="hidden"
                name="patient_record_id"
                id="treatmentPatientId"
            >


            <div class="modal-body">

                <div class="form-grid">

                    <div class="form-group">

                        <label for="treatmentDate">
                            Date
                        </label>

                        <input
                            type="date"
                            id="treatmentDate"
                            name="treatment_date"
                            required
                        >

                    </div>


                    <div class="form-group full">

                        <label for="treatmentProblemDiagnosis">
                            Problem &amp; Diagnosis
                        </label>

                        <textarea
                            id="treatmentProblemDiagnosis"
                            name="problem_diagnosis"
                            rows="4"
                            placeholder="Enter the patient's problem and diagnosis..."
                            required
                        ></textarea>

                    </div>

                    <div class="form-group">

                        <label for="treatmentAmount">
                            Amount
                        </label>

                        <div class="currency-input">

                            <span>
                                ₱
                            </span>

                            <input
                                type="number"
                                id="treatmentAmount"
                                name="amount"
                                min="0"
                                step="0.01"
                                placeholder="0.00"
                                required
                            >

                        </div>

                    </div>


                    <div class="form-group">

                        <label for="treatmentDeposit">
                            Deposit
                        </label>

                        <div class="currency-input">

                            <span>
                                ₱
                            </span>

                            <input
                                type="number"
                                id="treatmentDeposit"
                                name="deposit"
                                min="0"
                                step="0.01"
                                placeholder="0.00"
                                value="0"
                                required
                            >

                        </div>

                    </div>


                    {{-- BALANCE --}}

                    <div class="form-group full">

                        <label for="treatmentBalance">
                            Balance
                        </label>

                        <div class="currency-input balance-input">

                            <span>
                                ₱
                            </span>

                            <input
                                type="number"
                                id="treatmentBalance"
                                name="balance"
                                value="0"
                                readonly
                            >

                        </div>

                        <small class="form-help">
                            Balance is automatically calculated as Amount minus Deposit.
                        </small>

                    </div>


                </div>

            </div>


            {{-- FOOTER --}}

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
                    >

                        <path
                            d="M20 6L9 17L4 12"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                    </svg>

                    Save Record

                </button>

            </div>

        </form>

    </div>

</div>



{{-- ============================================================
    ADD PRESCRIPTION MODAL
============================================================ --}}

<div
    class="modal"
    id="prescriptionModal"
    hidden
>

    <div class="modal-overlay" data-close-modal></div>

    <div
        class="modal-container"
        role="dialog"
        aria-modal="true"
    >

        <div class="modal-header">

            <div>

                <h2>
                    Add Prescription
                </h2>

                <p>
                    Create a patient prescription
                </p>

            </div>

            <button
                type="button"
                class="modal-close"
                data-close-modal
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
            id="prescriptionForm"
            method="POST"
        >

            @csrf

            <div class="modal-body">

                <input
                    type="hidden"
                    name="patient_record_id"
                    id="prescriptionPatientId"
                >


                <div class="form-grid">


                    <div class="form-group full">

                        <label for="medicineName">
                            Medicine
                        </label>

                        <input
                            type="text"
                            id="medicineName"
                            name="medicine_name"
                            placeholder="e.g. Amoxicillin"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="prescriptionDosage">
                            Dosage
                        </label>

                        <input
                            type="text"
                            id="prescriptionDosage"
                            name="dosage"
                            placeholder="e.g. 500 mg"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="prescriptionFrequency">
                            Frequency
                        </label>

                        <input
                            type="text"
                            id="prescriptionFrequency"
                            name="frequency"
                            placeholder="e.g. 3 times a day"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="prescriptionDuration">
                            Duration
                        </label>

                        <input
                            type="text"
                            id="prescriptionDuration"
                            name="duration"
                            placeholder="e.g. 7 days"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="prescriptionDate">
                            Prescription Date
                        </label>

                        <input
                            type="date"
                            id="prescriptionDate"
                            name="prescription_date"
                            required
                        >

                    </div>


                    <div class="form-group full">

                        <label for="prescriptionInstructions">
                            Instructions
                        </label>

                        <textarea
                            id="prescriptionInstructions"
                            name="instructions"
                            rows="4"
                            placeholder="Additional instructions..."
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
                    Save Prescription
                </button>

            </div>

        </form>

    </div>

</div>



{{-- ============================================================
    ADD DENTIST NOTE MODAL
============================================================ --}}

<div
    class="modal"
    id="noteModal"
    hidden
>

    <div class="modal-overlay" data-close-modal></div>

    <div
        class="modal-container"
        role="dialog"
        aria-modal="true"
    >

        <div class="modal-header">

            <div>

                <h2>
                    Add Dentist Note
                </h2>

                <p>
                    Record a clinical observation
                </p>

            </div>

            <button
                type="button"
                class="modal-close"
                data-close-modal
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
            id="noteForm"
            method="POST"
        >

            @csrf

            <div class="modal-body">

                <input
                    type="hidden"
                    name="patient_record_id"
                    id="notePatientId"
                >


                <div class="form-group">

                    <label for="noteTitle">
                        Note Title
                    </label>

                    <input
                        type="text"
                        id="noteTitle"
                        name="title"
                        placeholder="e.g. Initial Examination"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="noteContent">
                        Clinical Note
                    </label>

                    <textarea
                        id="noteContent"
                        name="note"
                        rows="7"
                        placeholder="Enter clinical observations..."
                        required
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
                >
                    Save Note
                </button>

            </div>

        </form>

    </div>

</div>



{{-- ============================================================
    ODONTOGRAM CONDITION MODAL
============================================================ --}}

<div
    class="modal"
    id="toothConditionModal"
    hidden
>

    <div class="modal-overlay" data-close-modal></div>

    <div
        class="modal-container small-modal"
        role="dialog"
        aria-modal="true"
    >

        <div class="modal-header">

            <div>

                <h2>
                    Tooth Condition
                </h2>

                <p>
                    Tooth <strong id="selectedToothNumber">—</strong>
                </p>

            </div>

            <button
                type="button"
                class="modal-close"
                data-close-modal
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


        <form id="toothConditionForm">

            @csrf

            <div class="modal-body">

                <input
                    type="hidden"
                    name="patient_record_id"
                    id="odontogramPatientId"
                >

                <input
                    type="hidden"
                    name="tooth_number"
                    id="selectedToothInput"
                >


                <div class="form-group">

                    <label for="toothCondition">
                        Condition
                    </label>

                    <select
                        id="toothCondition"
                        name="condition"
                    >

                        <option value="healthy">
                            Healthy
                        </option>

                        <option value="caries">
                            Caries
                        </option>

                        <option value="filled">
                            Filled
                        </option>

                        <option value="missing">
                            Missing
                        </option>

                        <option value="extraction">
                            Extraction
                        </option>

                        <option value="crown">
                            Crown
                        </option>

                        <option value="root-canal">
                            Root Canal
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="toothRemarks">
                        Remarks
                    </label>

                    <textarea
                        id="toothRemarks"
                        name="remarks"
                        rows="4"
                        placeholder="Enter remarks..."
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
                >
                    Save Condition
                </button>

            </div>

        </form>

    </div>

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
    window.PatientRecordsConfig = {
        csrfToken: "{{ csrf_token() }}",
        routes: {
            index: "{{ route('dentist.patient-records') }}",
            show: "{{ url('/dentist/patient-records') }}",
            update: "{{ url('/dentist/patient-records') }}",
            treatments: "{{ route('dentist.treatments.store') }}",
            odontogram: "{{ route('dentist.odontogram.save') }}",
            odontogramClear: "{{ route('dentist.odontogram.clear') }}"
        }
    };
</script>

<script
    src="{{ asset('js/dentist-patientrecords.js') }}"
    defer
></script>


</body>
</html>
