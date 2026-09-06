<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Receptionist Dashboard | Shine & Smile
    </title>


    {{-- Tailwind CDN --}}

    <script src="https://cdn.tailwindcss.com"></script>


    <script>

        tailwind.config = {

            theme: {

                extend: {

                    colors: {

                        primary: '#E91E63',

                        secondary: '#F8BBD0',

                        pinklight: '#FFF1F5',

                        darkpink: '#C2185B',

                    }

                }

            }

        }

    </script>



    <link
        rel="stylesheet"
        href="{{ asset('css/receptionist/receptionist.css') }}">

</head>


<body class="bg-pinklight min-h-screen text-gray-800">


<div class="flex min-h-screen">


    <aside class="sidebar">

        <div class="sidebar-inner">




            <div class="sidebar-logo">

                <div class="logo-icon">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 4c-1.5-1-4-.5-5 1.5-1.2 2.4-.2 5.2.8 7.5.8 1.8 1.2 4.2 2.2 5.5.7.9 1.7 1.2 2.5.4.9-.8 1-2.4 1.2-3.7.2-1.4.5-2.7 1.3-2.7s1.1 1.3 1.3 2.7c.2 1.3.3 2.9 1.2 3.7.8.8 1.8.5 2.5-.4 1-1.3 1.4-3.7 2.2-5.5 1-2.3 2-5.1.8-7.5C19 3.5 16.5 3 15 4c-1 .7-2 1-3 1s-2-.3-3-1z"
                        />

                    </svg>

                </div>


                <div>

                    <h1>
                        Shine & Smile
                    </h1>

                    <p>
                        Receptionist
                    </p>

                </div>

            </div>

            <nav class="sidebar-nav">

                <a
                    href="{{ route('receptionist.dashboard') }}"
                    class="sidebar-link active"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 12l9-9 9 9"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"
                        />

                    </svg>

                    Dashboard

                </a>


                {{-- APPOINTMENTS --}}

                <a
                    href="#appointments"
                    class="sidebar-link"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            d="M8 2v4"
                        />

                        <path
                            stroke-linecap="round"
                            d="M16 2v4"
                        />

                        <path
                            stroke-linecap="round"
                            d="M3 9h18"
                        />

                        <rect
                            x="3"
                            y="4"
                            width="18"
                            height="17"
                            rx="2"
                        />

                    </svg>

                    Appointments

                </a>


                {{-- PATIENTS --}}

                <a
    href="{{ route('receptionist.patients.index') }}"
    class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-pink-50"
>

    <svg
        xmlns="http://www.w3.org/2000/svg"
        class="w-5 h-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
    >

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
        />

        <circle
            cx="9"
            cy="7"
            r="4"
        />

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
        />

    </svg>

    <span>
        Patients
    </span>

</a>


                {{-- NOTIFICATIONS --}}

                <a
                    href="#notifications"
                    class="sidebar-link"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M18 8a6 6 0 00-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                        />

                        <path
                            stroke-linecap="round"
                            d="M10 21h4"
                        />

                    </svg>

                    Notifications

                </a>
 {{-- SETTINGS --}}
<a
    href="{{ route('receptionist.settings') }}"
    class="sidebar-link {{ request()->routeIs('receptionist.settings*') ? 'active' : '' }}"
>

    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="20"
        height="20"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.8"
        stroke-linecap="round"
        stroke-linejoin="round"
    >
        <path
            d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z"
        />

        <path
            d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.41 1.41-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V20h-2v-.49a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.41-1.41.06-.06A1.7 1.7 0 0 0 9.4 15a1.7 1.7 0 0 0-1.56-1.03H7.35v-2h.49A1.7 1.7 0 0 0 9.4 10.94a1.7 1.7 0 0 0-.34-1.88L9 9l1.41-1.41.06.06a1.7 1.7 0 0 0 1.88.34A1.7 1.7 0 0 0 13.38 6.43V6h2v.43a1.7 1.7 0 0 0 1.03 1.56 1.7 1.7 0 0 0 1.88-.34l.06-.06L19.76 9l-.06.06a1.7 1.7 0 0 0-.34 1.88A1.7 1.7 0 0 0 20.92 12h.43v2h-.43A1.7 1.7 0 0 0 19.4 15Z"
        />
    </svg>

    <span>
        Settings
    </span>

</a>
            </nav>


            {{-- =================================================
     SIDEBAR USER
================================================= --}}

<div class="sidebar-user">

    {{-- PROFILE AVATAR --}}
    <div class="user-avatar">

        @if(auth()->user()->profile_picture)

            <img
                src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                alt="{{ auth()->user()->name }}"
                class="user-avatar-image"
            >

        @else

            <span class="user-avatar-letter">
                {{ strtoupper(
                    substr(
                        auth()->user()->name ?? 'R',
                        0,
                        1
                    )
                ) }}
            </span>

        @endif

    </div>


    {{-- USER INFORMATION --}}
    <div class="sidebar-user-info">

        <p>
            {{ auth()->user()->name ?? 'Receptionist' }}
        </p>

        <span>
            Receptionist
        </span>

    </div>

</div>

        </div>

    </aside>


    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <main class="main-content">


     {{-- =========================================================
     TOP BAR
========================================================= --}}

<header class="topbar">

    <div>

        <h2>
            Receptionist Dashboard
        </h2>

        <p>
            Manage today's patient appointments
        </p>

    </div>

    <div class="topbar-right">

        <span class="current-date">
            {{ now()->format('F d, Y') }}
        </span>

        <a
                    href="{{ route('receptionist.notifications.index') }}"
                    class="notification-button"
                    aria-label="Notifications"
                >
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
                        aria-hidden="true"
                    >
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>

                    @php
                        $unreadNotificationCount = auth()
                            ->user()
                            ->unreadNotifications()
                            ->count();
                    @endphp

                    @if($unreadNotificationCount > 0)
                        <span class="notification-dot"></span>

                        <span class="notification-count">
                            {{ $unreadNotificationCount }}
                        </span>
                    @endif
                </a>

        <div class="top-avatar">

            @if(auth()->user()->profile_picture)

                <img
                    src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                    alt="{{ auth()->user()->name }}"
                    class="top-avatar-image"
                >

            @else

                <span class="top-avatar-letter">
                    {{ strtoupper(substr(auth()->user()->name ?? 'R', 0, 1)) }}
                </span>

            @endif

        </div>

                <form
                    id="logoutForm"
                    action="{{ route('logout') }}"
                    method="POST"
                    class="logout-form"
                >
                    @csrf

                    <button
                        type="button"
                        id="openLogoutModal"
                        class="header-logout-button"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" y1="12" x2="9" y2="12" />
                        </svg>

                        <span>Logout</span>
                    </button>
                </form>

    </div>

</header>
{{-- =================================================
     LOGOUT CONFIRMATION MODAL
================================================= --}}

<div
    id="logoutModal"
    class="logout-modal"
    aria-hidden="true"
>

    {{-- BACKDROP --}}

    <div
        class="logout-modal-overlay"
        id="logoutModalOverlay"
    ></div>


    {{-- MODAL CARD --}}

    <div
        class="logout-modal-card"
        role="dialog"
        aria-modal="true"
        aria-labelledby="logoutModalTitle"
    >

        {{-- ICON --}}

        <div class="logout-modal-icon">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="25"
                height="25"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <path d="M10 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h5" />

                <polyline points="16 17 21 12 16 7" />

                <line x1="21" y1="12" x2="9" y2="12" />

            </svg>

        </div>


        {{-- TITLE --}}

        <h3 id="logoutModalTitle">
            Are you sure you want to logout?
        </h3>


        {{-- MESSAGE --}}

        <p>
            You will need to sign in again to access your receptionist account.
        </p>


        {{-- BUTTONS --}}

        <div class="logout-modal-actions">

            <button
                type="button"
                id="cancelLogout"
                class="logout-cancel-button"
            >
                Cancel
            </button>


            <button
                type="button"
                id="confirmLogout"
                class="logout-confirm-button"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="17"
                    height="17"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path d="M10 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h5" />

                    <polyline points="16 17 21 12 16 7" />

                    <line x1="21" y1="12" x2="9" y2="12" />

                </svg>

                Logout

            </button>

        </div>

    </div>

</div>

        <div class="dashboard-content">



            @if(session('success'))

                <div class="alert alert-success">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7"
                        />

                    </svg>

                    {{ session('success') }}

                </div>

            @endif


            {{-- ERROR MESSAGE --}}

            @if(session('error'))

                <div class="alert alert-error">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path
                            stroke-linecap="round"
                            d="M12 8v5"
                        />

                        <path
                            stroke-linecap="round"
                            d="M12 16h.01"
                        />

                    </svg>

                    {{ session('error') }}

                </div>

            @endif

            <section class="welcome-section">

                <h1>
                    Good morning! 👋
                </h1>

                <p>
                    Here's what's happening at the clinic today.
                </p>

            </section>

            <section class="stats-grid">


                {{-- TOTAL --}}

                <div class="stat-card">

                    <div>

                        <p>
                            Today's Appointments
                        </p>

                        <strong>
                            {{ $totalAppointments }}
                        </strong>

                    </div>


                    <div class="stat-icon pink">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <rect
                                x="3"
                                y="4"
                                width="18"
                                height="17"
                                rx="2"
                            />

                            <path d="M8 2v4" />

                            <path d="M16 2v4" />

                            <path d="M3 9h18" />

                        </svg>

                    </div>

                </div>


                {{-- WAITING --}}

                <div class="stat-card">

                    <div>

                        <p>
                            Waiting
                        </p>

                        <strong class="yellow">
                            {{ $waitingAppointments }}
                        </strong>

                    </div>


                    <div class="stat-icon yellow-bg">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                stroke-linecap="round"
                                d="M12 7v5l3 2"
                            />

                        </svg>

                    </div>

                </div>


                {{-- CHECKED IN --}}

                <div class="stat-card">

                    <div>

                        <p>
                            Checked In
                        </p>

                        <strong class="orange">
                            {{ $checkedInAppointments }}
                        </strong>

                    </div>


                    <div class="stat-icon orange-bg">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 12l2.5 2.5L16 9"
                            />

                        </svg>

                    </div>

                </div>


                {{-- IN TREATMENT --}}

                <div class="stat-card">

                    <div>

                        <p>
                            In Treatment
                        </p>

                        <strong class="blue">
                            {{ $inTreatmentAppointments }}
                        </strong>

                    </div>


                    <div class="stat-icon blue-bg">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 4c-1.5-1-4-.5-5 1.5-1.2 2.4-.2 5.2.8 7.5.8 1.8 1.2 4.2 2.2 5.5.7.9 1.7 1.2 2.5.4.9-.8 1-2.4 1.2-3.7.2-1.4.5-2.7 1.3-2.7s1.1 1.3 1.3 2.7c.2 1.3.3 2.9 1.2 3.7.8.8 1.8.5 2.5-.4 1-1.3 1.4-3.7 2.2-5.5 1-2.3 2-5.1.8-7.5C19 3.5 16.5 3 15 4c-1 .7-2 1-3 1s-2-.3-3-1z"
                            />

                        </svg>

                    </div>

                </div>


                {{-- COMPLETED --}}

                <div class="stat-card">

                    <div>

                        <p>
                            Completed
                        </p>

                        <strong class="green">
                            {{ $completedAppointments }}
                        </strong>

                    </div>


                    <div class="stat-icon green-bg">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"
                            />

                        </svg>

                    </div>

                </div>


                {{-- NO SHOW --}}

                <div class="stat-card">

                    <div>

                        <p>
                            No Show
                        </p>

                        <strong class="red">
                            {{ $noShowAppointments }}
                        </strong>

                    </div>


                    <div class="stat-icon red-bg">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                stroke-linecap="round"
                                d="M9 9l6 6"
                            />

                            <path
                                stroke-linecap="round"
                                d="M15 9l-6 6"
                            />

                        </svg>

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- SEARCH AND FILTER --}}
            {{-- ================================================= --}}

            <section class="filter-card">

                <div class="search-box">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <circle
                            cx="11"
                            cy="11"
                            r="7"
                        />

                        <path
                            stroke-linecap="round"
                            d="M20 20l-4-4"
                        />

                    </svg>


                    <input
                        id="searchInput"
                        type="text"
                        placeholder="Search patient..."
                    >

                </div>


                <select id="statusFilter">

                    <option value="all">
                        All Status
                    </option>

                    <option value="waiting">
                        Waiting
                    </option>

                    <option value="checked_in">
                        Checked In
                    </option>

                    <option value="in_treatment">
                        In Treatment
                    </option>

                    <option value="completed">
                        Completed
                    </option>

                    <option value="no_show">
                        No Show
                    </option>

                </select>

            </section>


            {{-- ================================================= --}}
            {{-- APPOINTMENTS --}}
            {{-- ================================================= --}}

            <section
                id="appointments"
                class="appointments-card"
            >


                <div class="appointments-header">

                    <div>

                        <h2>
                            Today's Appointments
                        </h2>

                        <p>
                            {{ now()->format('F d, Y') }}
                        </p>

                    </div>


                    <span class="appointment-count">

                        {{ $totalAppointments }}

                        Appointments

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
                                    Time
                                </th>

                                <th>
                                    Service
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody id="appointmentTable">


                            @forelse($appointments as $appointment)


                                @php

                                    /*
                                    |--------------------------------------------------------------------------
                                    | PATIENT
                                    |--------------------------------------------------------------------------
                                    */

                                    $patientName =
                                        $appointment->patient?->patient_name
                                        ?? $appointment->user?->name
                                        ?? 'Unknown Patient';


                                    /*
                                    |--------------------------------------------------------------------------
                                    | INITIALS
                                    |--------------------------------------------------------------------------
                                    */

                                    $nameParts = preg_split(
                                        '/\s+/',
                                        trim($patientName)
                                    );

                                    $initials = '';

                                    foreach (
                                        array_slice($nameParts, 0, 2)
                                        as $part
                                    ) {

                                        if ($part !== '') {

                                            $initials .= strtoupper(
                                                substr($part, 0, 1)
                                            );

                                        }

                                    }


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DATETIME
                                    |--------------------------------------------------------------------------
                                    */

                                    $appointmentStart =
                                        \Carbon\Carbon::parse(
                                            $appointment
                                                ->appointment_date
                                                ->format('Y-m-d')
                                            . ' '
                                            . $appointment->appointment_time
                                        );


                                    $appointmentEnd =
                                        \Carbon\Carbon::parse(
                                            $appointment
                                                ->appointment_date
                                                ->format('Y-m-d')
                                            . ' '
                                            . $appointment->end_time
                                        );


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DATABASE STATUS
                                    |--------------------------------------------------------------------------
                                    */

                                    $databaseStatus =
                                        strtolower(
                                            trim(
                                                $appointment->status ?? ''
                                            )
                                        );


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DISPLAY STATUS
                                    |--------------------------------------------------------------------------
                                    */

                                    if (
                                        $appointment->checked_out_at
                                    ) {

                                        $displayStatus =
                                            'completed';

                                    } elseif (
                                        $appointment->treatment_started_at
                                    ) {

                                        $displayStatus =
                                            'in_treatment';

                                    } elseif (
                                        $appointment->checked_in_at
                                    ) {

                                        $displayStatus =
                                            'checked_in';

                                    } elseif (
                                        $databaseStatus === 'no_show'
                                    ) {

                                        $displayStatus =
                                            'no_show';

                                    } elseif (
                                        in_array(
                                            $databaseStatus,
                                            [
                                                'accepted',
                                                'confirmed'
                                            ]
                                        )
                                    ) {

                                        $displayStatus =
                                            'waiting';

                                    } else {

                                        $displayStatus =
                                            $databaseStatus ?: 'waiting';

                                    }

                                @endphp


                                <tr
                                    class="appointment-row"
                                    data-name="{{ strtolower($patientName) }}"
                                    data-status="{{ $displayStatus }}"
                                    data-id="{{ $appointment->id }}"
                                >


                                    {{-- PATIENT --}}

                                    <td>

                                        <div class="patient-cell">

                                            <div class="patient-avatar">

                                                {{ $initials ?: 'P' }}

                                            </div>


                                            <div>

                                                <strong>
                                                    {{ $patientName }}
                                                </strong>

                                                <span>
                                                    Patient #{{ $appointment->patient_record_id }}
                                                </span>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- TIME --}}

                                    <td>

                                        <div class="time-cell">

                                            <strong>

                                                {{ $appointmentStart->format('h:i A') }}

                                            </strong>


                                            <span>

                                                Until

                                                {{ $appointmentEnd->format('h:i A') }}

                                            </span>

                                        </div>

                                    </td>


                                    {{-- SERVICE --}}

                                    <td>

                                        {{ $appointment->service?->name ?? 'N/A' }}

                                    </td>


                                    {{-- STATUS --}}

                                    <td>


                                        @if($displayStatus === 'completed')

                                            <span
                                                class="status-badge completed"
                                                data-display-status="completed"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7"
                                                    />

                                                </svg>

                                                Completed

                                            </span>


                                        @elseif($displayStatus === 'in_treatment')

                                            <span
                                                class="status-badge in-treatment"
                                                data-display-status="in_treatment"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="9"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        d="M12 7v5l3 2"
                                                    />

                                                </svg>

                                                In Treatment

                                            </span>


                                        @elseif($displayStatus === 'checked_in')

                                            <span
                                                class="status-badge checked-in"
                                                data-display-status="checked_in"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M5 13l4 4L19 7"
                                                    />

                                                </svg>

                                                Checked In

                                            </span>


                                        @elseif($displayStatus === 'no_show')

                                            <span
                                                class="status-badge no-show"
                                                data-display-status="no_show"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="9"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        d="M9 9l6 6"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        d="M15 9l-6 6"
                                                    />

                                                </svg>

                                                No Show

                                            </span>


                                        @elseif($displayStatus === 'waiting')

                                            <span
                                                class="status-badge waiting"
                                                data-display-status="waiting"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="9"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        d="M12 7v5l3 2"
                                                    />

                                                </svg>

                                                Confirmed

                                            </span>


                                        @else

                                            <span
                                                class="status-badge pending"
                                                data-display-status="waiting"
                                            >

                                                {{ ucfirst($displayStatus) }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- ACTION --}}

                                    <td>

                                        <div class="action-container">


                                            {{-- CHECK IN --}}

                                            @if(
                                                $displayStatus === 'waiting'
                                                && !$appointment->checked_in_at
                                            )

                                                <form
                                                    method="POST"
                                                    action="{{ route(
                                                        'receptionist.appointments.check-in',
                                                        $appointment
                                                    ) }}"
                                                >

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="action-button check-in-button"
                                                        onclick="return confirm('Check in this patient?')"
                                                    >

                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                        >

                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M5 13l4 4L19 7"
                                                            />

                                                        </svg>

                                                        Check In

                                                    </button>

                                                </form>

                                            @endif


                                            {{-- START TREATMENT --}}

                                            @if(
                                                $appointment->checked_in_at
                                                && !$appointment->treatment_started_at
                                                && !$appointment->checked_out_at
                                            )

                                                <form
                                                    method="POST"
                                                    action="{{ route(
                                                        'receptionist.appointments.start-treatment',
                                                        $appointment
                                                    ) }}"
                                                >

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="action-button treatment-button"
                                                        onclick="return confirm('Start treatment for this patient?')"
                                                    >

                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                        >

                                                            <circle
                                                                cx="12"
                                                                cy="12"
                                                                r="9"
                                                            />

                                                            <path
                                                                stroke-linecap="round"
                                                                d="M12 7v5l3 2"
                                                            />

                                                        </svg>

                                                        Start Treatment

                                                    </button>

                                                </form>

                                            @endif


                                            {{-- CHECK OUT --}}

                                            @if(
                                                $appointment->treatment_started_at
                                                && !$appointment->checked_out_at
                                            )

                                                <form
                                                    method="POST"
                                                    action="{{ route(
                                                        'receptionist.appointments.check-out',
                                                        $appointment
                                                    ) }}"
                                                >

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="action-button checkout-button"
                                                        onclick="return confirm('Check out this patient?')"
                                                    >

                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                        >

                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M17 8l4 4m0 0l-4 4m4-4H9"
                                                            />

                                                        </svg>

                                                        Check Out

                                                    </button>

                                                </form>

                                            @endif


                                            {{-- COMPLETED --}}

                                            @if($appointment->checked_out_at)

                                                <span class="completed-text">

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                    >

                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M5 13l4 4L19 7"
                                                        />

                                                    </svg>

                                                    Completed

                                                </span>

                                            @endif


                                            {{-- NO SHOW --}}

                                            @if($displayStatus === 'no_show')

                                                <span class="no-show-text">

                                                    No Show

                                                </span>

                                            @endif

                                        </div>

                                    </td>

                                </tr>


                            @empty


                                <tr>

                                    <td
                                        colspan="5"
                                        class="empty-cell"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >

                                            <rect
                                                x="3"
                                                y="4"
                                                width="18"
                                                height="17"
                                                rx="2"
                                            />

                                            <path d="M8 2v4" />

                                            <path d="M16 2v4" />

                                            <path d="M3 9h18" />

                                        </svg>


                                        <strong>
                                            No appointments today
                                        </strong>

                                        <span>
                                            There are no appointments scheduled for today.
                                        </span>

                                    </td>

                                </tr>

                            @endforelse


                        </tbody>

                    </table>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- LATE PATIENTS --}}
            {{-- ================================================= --}}

            <section class="late-card">


                <div class="late-header">

                    <div>

                        <h2>
                            Late Patients
                        </h2>

                        <p>
                            Patients who have not checked in more than 30 minutes after their appointment.
                        </p>

                    </div>


                    <div class="late-icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                stroke-linecap="round"
                                d="M12 7v5l3 2"
                            />

                        </svg>

                    </div>

                </div>


                @php

                    $lateAppointments =
                        $appointments->filter(
                            function ($appointment) {

                                if (
                                    $appointment->checked_in_at
                                    || $appointment->checked_out_at
                                ) {
                                    return false;
                                }


                                $status =
                                    strtolower(
                                        trim(
                                            $appointment->status ?? ''
                                        )
                                    );


                                if (
                                    !in_array(
                                        $status,
                                        [
                                            'accepted',
                                            'confirmed'
                                        ]
                                    )
                                ) {
                                    return false;
                                }


                                $appointmentDateTime =
                                    \Carbon\Carbon::parse(
                                        $appointment
                                            ->appointment_date
                                            ->format('Y-m-d')
                                        . ' '
                                        . $appointment->appointment_time
                                    );


                                return now()->greaterThan(
                                    $appointmentDateTime
                                        ->copy()
                                        ->addMinutes(30)
                                );

                            }
                        );

                @endphp


                <div class="late-list">


                    @forelse(
                        $lateAppointments
                        as $appointment
                    )


                        @php

                            $latePatient =
                                $appointment
                                    ->patient
                                    ?->patient_name
                                ?? $appointment
                                    ->user
                                    ?->name
                                ?? 'Unknown Patient';


                            $lateDateTime =
                                \Carbon\Carbon::parse(
                                    $appointment
                                        ->appointment_date
                                        ->format('Y-m-d')
                                    . ' '
                                    . $appointment->appointment_time
                                );


                            $minutesLate =
                                $lateDateTime
                                    ->diffInMinutes(now());

                        @endphp


                        <div class="late-patient">


                            <div class="late-patient-info">

                                <div class="late-patient-icon">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            d="M12 7v5l3 2"
                                        />

                                    </svg>

                                </div>


                                <div>

                                    <strong>
                                        {{ $latePatient }}
                                    </strong>

                                    <span>

                                        Appointment:
                                        {{ $lateDateTime->format('h:i A') }}

                                    </span>

                                </div>

                            </div>


                            <strong class="late-time">

                                {{ $minutesLate }} min late

                            </strong>

                        </div>


                    @empty


                        <div class="no-late-patients">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />

                            </svg>


                            No patients are currently more than 30 minutes late.

                        </div>


                    @endforelse

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- NOTIFICATIONS --}}
            {{-- ================================================= --}}

            <section
                id="notifications"
                class="notification-card"
            >

                <div class="notification-heading">

                    <div class="notification-heading-icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M18 8a6 6 0 00-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                            />

                            <path
                                stroke-linecap="round"
                                d="M10 21h4"
                            />

                        </svg>

                    </div>


                    <div>

                        <h2>
                            Notifications
                        </h2>

                        <p>
                            Receptionist appointment information
                        </p>

                    </div>

                </div>


                <div class="system-message">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path
                            stroke-linecap="round"
                            d="M12 10v6"
                        />

                        <path
                            stroke-linecap="round"
                            d="M12 7h.01"
                        />

                    </svg>


                    <div>

                        <strong>
                            Receptionist system is active.
                        </strong>

                        <p>
                            Check patients in when they arrive.
                        </p>

                    </div>

                </div>


                <div class="late-rule-message">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path
                            stroke-linecap="round"
                            d="M12 7v5l3 2"
                        />

                    </svg>


                    <div>

                        <strong>
                            30-minute late rule
                        </strong>

                        <p>
                            Patients who haven't checked in after 30 minutes can be handled as no-shows.
                        </p>

                    </div>

                </div>

            </section>


        </div>

    </main>

</div>





<div
    id="logoutModal"
    class="logout-modal"
    aria-hidden="true"
>
    <div
        class="logout-modal-overlay"
        id="logoutModalOverlay"
    ></div>

    <div
        class="logout-modal-card"
        role="dialog"
        aria-modal="true"
        aria-labelledby="logoutModalTitle"
    >
        <div class="logout-modal-icon">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                <polyline points="16 17 21 12 16 7" />
                <line x1="21" y1="12" x2="9" y2="12" />
            </svg>
        </div>

        <h3 id="logoutModalTitle">
            Confirm Logout
        </h3>

        <p>
            Are you sure you want to log out of your account?
        </p>

        <div class="logout-modal-actions">
            <button
                type="button"
                id="cancelLogout"
                class="logout-cancel-button"
            >
                Cancel
            </button>

            <button
                type="button"
                id="confirmLogout"
                class="logout-confirm-button"
            >
                Yes, Logout
            </button>
        </div>
    </div>
</div>

{{-- APPOINTMENT SUCCESS MODAL --}}
<div id="appointmentSuccessModal" class="appointment-modal" aria-hidden="true">
    <div class="appointment-modal-overlay" id="appointmentSuccessModalOverlay"></div>
    <div class="appointment-modal-card" role="dialog" aria-modal="true">
        <div class="appointment-modal-icon success">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
        </div>
        <h3>Success!</h3>
        <p id="appointmentSuccessMessage">The appointment was updated successfully.</p>
        <div class="appointment-modal-actions single"><button type="button" id="closeAppointmentSuccess" class="appointment-modal-confirm">Okay</button></div>
    </div>
</div>

{{-- APPOINTMENT ERROR MODAL --}}
<div id="appointmentErrorModal" class="appointment-modal" aria-hidden="true">
    <div class="appointment-modal-overlay" id="appointmentErrorModalOverlay"></div>
    <div class="appointment-modal-card" role="dialog" aria-modal="true">
        <div class="appointment-modal-icon error">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path stroke-linecap="round" d="M12 8v5" /><path stroke-linecap="round" d="M12 16h.01" /></svg>
        </div>
        <h3>Action Failed</h3>
        <p id="appointmentErrorMessage">Something went wrong. Please try again.</p>
        <div class="appointment-modal-actions single"><button type="button" id="closeAppointmentError" class="appointment-modal-error-button">Okay</button></div>
    </div>
</div>

@if(session('success'))
<script>window.appointmentActionSuccess={message:@json(session('success'))};</script>
@endif
@if(session('error'))
<script>window.appointmentActionError={message:@json(session('error'))};</script>
@endif

<script src="{{ asset('js/receptionist.js') }}"></script>



</body>

</html>
