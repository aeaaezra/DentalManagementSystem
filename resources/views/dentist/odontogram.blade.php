<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Odontogram | Shine & Smile Dental Clinic</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/dentists/dentist-odontogram.css') }}"
    >
</head>

<body>

<div class="odontogram-page">
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




    <main class="main-content">


        <!-- HEADER -->

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




        <section class="page-content">


            <!-- PAGE HEADER -->

            <div class="page-heading">

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
                            Odontogram
                        </span>

                    </div>


                    <h2>
                        Dental Chart
                    </h2>

                    <p>
                        Record and manage the dental condition of your patient.
                    </p>

                </div>


                <button
                    type="button"
                    class="save-button"
                    id="saveChartButton"
                >

                    <svg viewBox="0 0 24 24" fill="none">

                        <path
                            d="M5 3H17L20 6V21H5V3Z"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M8 3V9H16V3"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M8 21V14H16V21"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round"
                        />

                    </svg>

                    Save Chart

                </button>

            </div>


            <!-- =================================================
                 PATIENT SELECTOR
            ================================================== -->

            <section class="patient-selector-card">

                <div class="patient-selector-icon">

                    <svg viewBox="0 0 24 24" fill="none">

                        <circle
                            cx="12"
                            cy="8"
                            r="3"
                            stroke="currentColor"
                            stroke-width="1.8"
                        />

                        <path
                            d="M5 21C5 17.7 8.1 15 12 15C15.9 15 19 17.7 19 21"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                    </svg>

                </div>


                <div class="patient-selector-content">

                    <label for="patientSelect">
                        SELECT PATIENT
                    </label>

                    <select id="patientSelect" name="patient_id">
    <option value="">Choose a patient...</option>

    @forelse($patients as $patient)
        <option
            value="{{ $patient->id }}"
            data-name="{{ $patient->patient_name }}"
            data-age="{{ $patient->age ?? '' }}"
            data-gender="{{ $patient->sex ? ucfirst($patient->sex) : '' }}"
        >
            {{ $patient->patient_name }}
            — P-{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}
        </option>
    @empty
        <option value="" disabled>No patients available</option>
    @endforelse
</select>

                </div>


                <div
                    class="patient-information"
                    id="patientInformation"
                >

                    <div>

                        <span>
                            PATIENT
                        </span>

                        <strong id="patientName">
                            —
                        </strong>

                    </div>


                    <div>

                        <span>
                            PATIENT ID
                        </span>

                        <strong id="patientId">
                            —
                        </strong>

                    </div>


                    <div>

                        <span>
                            AGE
                        </span>

                        <strong id="patientAge">
                            —
                        </strong>

                    </div>


                    <div>

                        <span>
                            GENDER
                        </span>

                        <strong id="patientGender">
                            —
                        </strong>

                    </div>

                </div>

            </section>


            <!-- =================================================
                 CHART + DETAILS
            ================================================== -->

            <div class="odontogram-layout">


                <!-- =================================================
                     DENTAL CHART
                ================================================== -->

                <section class="chart-card">

                    <div class="chart-header">

                        <div>

                            <h3>Complete Odontogram</h3>

                                <p>
                                    Permanent and primary dentition — FDI tooth numbering system
                                </p>

                        </div>


                        <div class="chart-tools">

                            <button
                                type="button"
                                class="chart-tool-button active"
                                data-view="full"
                            >
                                Full Chart
                            </button>

                            <button
                                type="button"
                                class="chart-tool-button"
                                data-view="upper"
                            >
                                Upper
                            </button>

                            <button
                                type="button"
                                class="chart-tool-button"
                                data-view="lower"
                            >
                                Lower
                            </button>

                        </div>

                    </div>


                    <div class="chart-body">

@php
    $upperPermanentLeft = ['18', '17', '16', '15', '14', '13', '12', '11'];
    $upperPermanentRight = ['21', '22', '23', '24', '25', '26', '27', '28'];

    $upperPrimaryLeft = ['55', '54', '53', '52', '51'];
    $upperPrimaryRight = ['61', '62', '63', '64', '65'];

    $lowerPrimaryLeft = ['85', '84', '83', '82', '81'];
    $lowerPrimaryRight = ['71', '72', '73', '74', '75'];

    $lowerPermanentLeft = ['48', '47', '46', '45', '44', '43', '42', '41'];
    $lowerPermanentRight = ['31', '32', '33', '34', '35', '36', '37', '38'];
@endphp

<div class="full-odontogram">

    <div class="jaw-section" id="upperJaw">

        <div class="jaw-label">
            <span>UPPER JAW</span>
            <small>Maxillary</small>
        </div>

        <div class="odontogram-row permanent-row">

            <div class="tooth-group">
                @foreach($upperPermanentLeft as $toothNumber)
                    <button
                        type="button"
                        class="tooth"
                        data-tooth="{{ $toothNumber }}"
                        aria-label="Tooth {{ $toothNumber }}"
                    >
                        <span class="tooth-number">{{ $toothNumber }}</span>

                        <svg
                            class="tooth-svg"
                            viewBox="0 0 80 100"
                            fill="none"
                        >
                            <path
                                d="M24 9C16 11 12 19 14 30C16 40 21 46 22 61C23 76 27 91 35 91C42 91 39 75 40 67C41 75 38 91 45 91C53 91 57 76 58 61C59 46 64 40 66 30C68 19 64 11 56 9C50 8 45 12 40 13C35 12 30 8 24 9Z"
                                stroke="currentColor"
                                stroke-width="2.4"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M24 27C29 22 35 22 40 27C45 22 51 22 56 27"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />
                        </svg>
                    </button>
                @endforeach
            </div>

            <div class="odontogram-midline"></div>

            <div class="tooth-group">
                @foreach($upperPermanentRight as $toothNumber)
                    <button
                        type="button"
                        class="tooth"
                        data-tooth="{{ $toothNumber }}"
                        aria-label="Tooth {{ $toothNumber }}"
                    >
                        <span class="tooth-number">{{ $toothNumber }}</span>

                        <svg
                            class="tooth-svg"
                            viewBox="0 0 80 100"
                            fill="none"
                        >
                            <path
                                d="M24 9C16 11 12 19 14 30C16 40 21 46 22 61C23 76 27 91 35 91C42 91 39 75 40 67C41 75 38 91 45 91C53 91 57 76 58 61C59 46 64 40 66 30C68 19 64 11 56 9C50 8 45 12 40 13C35 12 30 8 24 9Z"
                                stroke="currentColor"
                                stroke-width="2.4"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M24 27C29 22 35 22 40 27C45 22 51 22 56 27"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />
                        </svg>
                    </button>
                @endforeach
            </div>

        </div>

        <div class="odontogram-row primary-row">

            <div class="tooth-group">
                @foreach($upperPrimaryLeft as $toothNumber)
                    <button
                        type="button"
                        class="tooth tooth-primary"
                        data-tooth="{{ $toothNumber }}"
                        aria-label="Primary tooth {{ $toothNumber }}"
                    >
                        <span class="tooth-number">{{ $toothNumber }}</span>

                        <svg
                            class="tooth-svg"
                            viewBox="0 0 80 100"
                            fill="none"
                        >
                            <path
                                d="M25 12C18 14 15 21 17 31C19 41 24 47 25 61C26 74 30 87 36 87C41 87 39 76 40 69C41 76 39 87 44 87C50 87 54 74 55 61C56 47 61 41 63 31C65 21 62 14 55 12C49 11 45 14 40 15C35 14 31 11 25 12Z"
                                stroke="currentColor"
                                stroke-width="2.4"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M26 30C31 25 36 25 40 29C44 25 49 25 54 30"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />
                        </svg>
                    </button>
                @endforeach
            </div>

            <div class="odontogram-midline short"></div>

            <div class="tooth-group">
                @foreach($upperPrimaryRight as $toothNumber)
                    <button
                        type="button"
                        class="tooth tooth-primary"
                        data-tooth="{{ $toothNumber }}"
                        aria-label="Primary tooth {{ $toothNumber }}"
                    >
                        <span class="tooth-number">{{ $toothNumber }}</span>

                        <svg
                            class="tooth-svg"
                            viewBox="0 0 80 100"
                            fill="none"
                        >
                            <path
                                d="M25 12C18 14 15 21 17 31C19 41 24 47 25 61C26 74 30 87 36 87C41 87 39 76 40 69C41 76 39 87 44 87C50 87 54 74 55 61C56 47 61 41 63 31C65 21 62 14 55 12C49 11 45 14 40 15C35 14 31 11 25 12Z"
                                stroke="currentColor"
                                stroke-width="2.4"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M26 30C31 25 36 25 40 29C44 25 49 25 54 30"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />
                        </svg>
                    </button>
                @endforeach
            </div>

        </div>

    </div>

    <div class="odontogram-center-divider"></div>

    <div class="jaw-section lower-jaw" id="lowerJaw">

        <div class="odontogram-row primary-row lower-primary-row">

            <div class="tooth-group">
                @foreach($lowerPrimaryLeft as $toothNumber)
                    <button
                        type="button"
                        class="tooth tooth-primary"
                        data-tooth="{{ $toothNumber }}"
                        aria-label="Primary tooth {{ $toothNumber }}"
                    >
                        <span class="tooth-number">{{ $toothNumber }}</span>

                        <svg
                            class="tooth-svg"
                            viewBox="0 0 80 100"
                            fill="none"
                        >
                            <path
                                d="M25 88C18 86 15 79 17 69C19 59 24 53 25 39C26 26 30 13 36 13C41 13 39 24 40 31C41 24 39 13 44 13C50 13 54 26 55 39C56 53 61 59 63 69C65 79 62 86 55 88C49 89 45 86 40 85C35 86 31 89 25 88Z"
                                stroke="currentColor"
                                stroke-width="2.4"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M26 70C31 75 36 75 40 71C44 75 49 75 54 70"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />
                        </svg>
                    </button>
                @endforeach
            </div>

            <div class="odontogram-midline short"></div>

            <div class="tooth-group">
                @foreach($lowerPrimaryRight as $toothNumber)
                    <button
                        type="button"
                        class="tooth tooth-primary"
                        data-tooth="{{ $toothNumber }}"
                        aria-label="Primary tooth {{ $toothNumber }}"
                    >
                        <span class="tooth-number">{{ $toothNumber }}</span>

                        <svg
                            class="tooth-svg"
                            viewBox="0 0 80 100"
                            fill="none"
                        >
                            <path
                                d="M25 88C18 86 15 79 17 69C19 59 24 53 25 39C26 26 30 13 36 13C41 13 39 24 40 31C41 24 39 13 44 13C50 13 54 26 55 39C56 53 61 59 63 69C65 79 62 86 55 88C49 89 45 86 40 85C35 86 31 89 25 88Z"
                                stroke="currentColor"
                                stroke-width="2.4"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M26 70C31 75 36 75 40 71C44 75 49 75 54 70"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />
                        </svg>
                    </button>
                @endforeach
            </div>

        </div>

        <div class="odontogram-row permanent-row lower-permanent-row">

            <div class="tooth-group">
                @foreach($lowerPermanentLeft as $toothNumber)
                    <button
                        type="button"
                        class="tooth"
                        data-tooth="{{ $toothNumber }}"
                        aria-label="Tooth {{ $toothNumber }}"
                    >
                        <span class="tooth-number">{{ $toothNumber }}</span>

                        <svg
                            class="tooth-svg"
                            viewBox="0 0 80 100"
                            fill="none"
                        >
                            <path
                                d="M24 91C16 89 12 81 14 70C16 60 21 54 22 39C23 24 27 9 35 9C42 9 39 25 40 33C41 25 38 9 45 9C53 9 57 24 58 39C59 54 64 60 66 70C68 81 64 89 56 91C50 92 45 88 40 87C35 88 30 92 24 91Z"
                                stroke="currentColor"
                                stroke-width="2.4"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M24 73C29 78 35 78 40 73C45 78 51 78 56 73"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />
                        </svg>
                    </button>
                @endforeach
            </div>

            <div class="odontogram-midline"></div>

            <div class="tooth-group">
                @foreach($lowerPermanentRight as $toothNumber)
                    <button
                        type="button"
                        class="tooth"
                        data-tooth="{{ $toothNumber }}"
                        aria-label="Tooth {{ $toothNumber }}"
                    >
                        <span class="tooth-number">{{ $toothNumber }}</span>

                        <svg
                            class="tooth-svg"
                            viewBox="0 0 80 100"
                            fill="none"
                        >
                            <path
                                d="M24 91C16 89 12 81 14 70C16 60 21 54 22 39C23 24 27 9 35 9C42 9 39 25 40 33C41 25 38 9 45 9C53 9 57 24 58 39C59 54 64 60 66 70C68 81 64 89 56 91C50 92 45 88 40 87C35 88 30 92 24 91Z"
                                stroke="currentColor"
                                stroke-width="2.4"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M24 73C29 78 35 78 40 73C45 78 51 78 56 73"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />
                        </svg>
                    </button>
                @endforeach
            </div>

        </div>

        <div class="jaw-label lower-jaw-label">
            <span>LOWER JAW</span>
            <small>Mandibular</small>
        </div>

    </div>

</div>

                </section>


                <!-- =================================================
                     TOOTH DETAILS
                ================================================== -->

                <aside class="tooth-details-card">


                    <div class="details-header">

                        <div>

                            <span>
                                SELECTED TOOTH
                            </span>

                            <h3 id="selectedToothNumber">
                                No Tooth Selected
                            </h3>

                        </div>


                        <div class="tooth-status-icon">

                            <svg viewBox="0 0 64 64" fill="none">

                                <path
                                    d="M18 10C11 12 8 19 10 27C12 34 15 39 17 48C18 53 20 56 24 56C28 56 29 51 30 46C31 42 33 42 34 46C35 51 36 56 40 56C44 56 46 53 47 48C49 39 52 34 54 27C56 19 53 12 46 10C41 8 37 11 32 12C27 11 23 8 18 10Z"
                                    stroke="currentColor"
                                    stroke-width="3"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </div>

                    </div>


                    <div class="details-body">


                        <!-- CURRENT CONDITION -->

                        <div class="current-condition">

                            <span>
                                CURRENT CONDITION
                            </span>

                            <div
                                class="condition-display healthy"
                                id="currentConditionDisplay"
                            >
                                Healthy
                            </div>

                        </div>


                        <!-- CONDITIONS -->

                        <div class="condition-section">

                            <label>
                                Select Condition
                            </label>


                            <div class="condition-grid">


                                <button
                                    type="button"
                                    class="condition-button active"
                                    data-condition="healthy"
                                >

                                    <span class="condition-dot healthy"></span>

                                    Healthy

                                </button>


                                <button
                                    type="button"
                                    class="condition-button"
                                    data-condition="caries"
                                >

                                    <span class="condition-dot caries"></span>

                                    Caries

                                </button>


                                <button
                                    type="button"
                                    class="condition-button"
                                    data-condition="filled"
                                >

                                    <span class="condition-dot filled"></span>

                                    Filled

                                </button>


                                <button
                                    type="button"
                                    class="condition-button"
                                    data-condition="crown"
                                >

                                    <span class="condition-dot crown"></span>

                                    Crown

                                </button>


                                <button
                                    type="button"
                                    class="condition-button"
                                    data-condition="missing"
                                >

                                    <span class="condition-dot missing"></span>

                                    Missing

                                </button>


                                <button
                                    type="button"
                                    class="condition-button"
                                    data-condition="root-canal"
                                >

                                    <span class="condition-dot root-canal"></span>

                                    Root Canal

                                </button>


                                <button
                                    type="button"
                                    class="condition-button"
                                    data-condition="extraction"
                                >

                                    <span class="condition-dot extraction"></span>

                                    Extraction

                                </button>


                                <button
                                    type="button"
                                    class="condition-button"
                                    data-condition="implant"
                                >

                                    <span class="condition-dot implant"></span>

                                    Implant

                                </button>


                                <button
                                    type="button"
                                    class="condition-button"
                                    data-condition="fracture"
                                >

                                    <span class="condition-dot fracture"></span>

                                    Fracture

                                </button>


                                <button
                                    type="button"
                                    class="condition-button"
                                    data-condition="other"
                                >

                                    <span class="condition-dot other"></span>

                                    Other

                                </button>

                            </div>

                        </div>


                        <!-- NOTES -->

                        <div class="notes-section">

                            <label for="toothNotes">
                                Clinical Notes
                            </label>

                            <textarea
                                id="toothNotes"
                                rows="5"
                                placeholder="Enter notes for this tooth..."
                            ></textarea>

                        </div>


                        <!-- ACTIONS -->

                        <div class="tooth-actions">
<button
    type="button"
    class="clear-button"
    id="clearToothButton"
>
    <svg viewBox="0 0 24 24" fill="none">
        <path
            d="M4 7H20"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
        />

        <path
            d="M10 11V17M14 11V17"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
        />

        <path
            d="M6 7L7 20H17L18 7"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linejoin="round"
        />

        <path
            d="M9 7V4H15V7"
            stroke="currentColor"
            stroke-width="1.8"
        />
    </svg>

    Clear
</button>

                            <button
                                type="button"
                                class="apply-button"
                                id="applyToothButton"
                            >

                                <svg viewBox="0 0 24 24" fill="none">

                                    <path
                                        d="M5 12L10 17L19 7"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />

                                </svg>

                                Apply

                            </button>

                        </div>

                    </div>

                </aside>

            </div>


            <!-- =================================================
                 HISTORY
            ================================================== -->

            <section class="history-card">

                <div class="history-header">

                    <div>

                        <h3>
                            Tooth History
                        </h3>

                        <p>
                            Recent changes made to the dental chart.
                        </p>

                    </div>


                    <button
                        type="button"
                        class="clear-history-button"
                        id="clearHistoryButton"
                    >
                        Clear History
                    </button>


                    <div
    id="clearHistoryConfirmationModal"
    class="clear-history-modal hidden"
>
    <div
        class="clear-history-modal-overlay"
        id="clearHistoryModalOverlay"
    ></div>

    <div class="clear-history-modal-content">

        <div class="clear-history-modal-icon">
            !
        </div>

        <h3>Clear History?</h3>

        <p>
            Are you sure you want to clear the dental history?
            This action cannot be undone.
        </p>

        <div class="clear-history-modal-actions">

            <button
                type="button"
                id="cancelClearHistory"
                class="cancel-clear-history"
            >
                Cancel
            </button>

            <button
                type="button"
                id="confirmClearHistory"
                class="confirm-clear-history"
            >
                Yes, Clear
            </button>

        </div>

    </div>
</div>
                </div>


                <div
                    class="history-list"
                    id="historyList"
                >

                    <div class="history-empty">

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

                        <span>
                            No changes recorded yet.
                        </span>

                    </div>

                </div>

            </section>

        </section>

    </main>

</div>


<!-- TOAST -->

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

<div
    id="saveChartConfirmationModal"
    class="save-chart-modal hidden"
>
    <div
        class="save-chart-modal-overlay"
        id="saveChartModalOverlay"
    ></div>

    <div
        class="save-chart-modal-content"
    >
        <div
            class="save-chart-modal-icon"
        >
            ?
        </div>

        <h3>
            Save Dental Chart?
        </h3>

        <p>
            Are you sure you want to save the changes made to this patient's dental chart?
        </p>

        <div
            class="save-chart-modal-actions"
        >
            <button
                type="button"
                id="cancelSaveChart"
                class="cancel-save-chart"
            >
                Cancel
            </button>

            <button
                type="button"
                id="confirmSaveChart"
                class="confirm-save-chart"
            >
                Yes, Save
            </button>
        </div>
    </div>
</div>

<div
    id="clearToothConfirmationModal"
    class="confirmation-modal hidden"
    aria-hidden="true"
>
    <div
        class="confirmation-modal-overlay"
        id="clearToothModalOverlay"
    ></div>

    <div
        class="confirmation-modal-content"
        role="dialog"
        aria-modal="true"
    >
        <div class="confirmation-modal-header">
            <h3>Clear Tooth</h3>
        </div>

        <div class="confirmation-modal-body">
            <p id="clearToothMessage">
                Are you sure you want to clear this tooth?
            </p>
        </div>

        <div class="confirmation-modal-actions">
            <button
                type="button"
                class="modal-cancel-button"
                id="cancelClearTooth"
            >
                Cancel
            </button>

            <button
                type="button"
                class="modal-confirm-button"
                id="confirmClearTooth"
            >
                Yes, Clear
            </button>
        </div>
    </div>
</div>



<script>
    window.ODONTOGRAM_CONFIG = {
        loadUrl: "{{ route('dentist.odontogram.patient', ['id' => '__PATIENT_ID__']) }}",
        saveUrl: "{{ route('dentist.odontogram.save') }}",
        clearUrl: "{{ route('dentist.odontogram.clear') }}",
    };
</script>

<script src="{{ asset('js/dentist/dentist-odontogram.js') }}"></script>

</body>
</html>
