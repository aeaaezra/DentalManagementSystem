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

    <title>Patients | Receptionist</title>

    {{-- Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Receptionist Patients CSS --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/receptionist/receptionist-patients.css') }}"
    >

</head>


<body class="receptionist-body">
     {{-- =========================================================
     TOP BAR
========================================================= --}}

<header class="topbar">

    {{-- =====================================================
         HEADER TITLE
    ====================================================== --}}

    <div>

        <h2>
            Receptionist Dashboard
        </h2>

        <p>
            Manage today's patient appointments
        </p>

    </div>


    {{-- =====================================================
         HEADER RIGHT
    ====================================================== --}}

    <div class="topbar-right">


        {{-- =================================================
             CURRENT DATE
        ================================================== --}}

        <span class="current-date">

            {{ now()->format('F d, Y') }}

        </span>


        {{-- =================================================
             NOTIFICATIONS
        ================================================== --}}

        <a
            href="{{ route('receptionist.notifications.index') }}"
            class="notification-button"
            aria-label="Notifications"
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

                <path
                    d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                />

                <path
                    d="M10 21h4"
                />

            </svg>


            {{-- UNREAD NOTIFICATION COUNT --}}

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


        {{-- =================================================
             PROFILE AVATAR
        ================================================== --}}

        <div class="top-avatar">

            @if(auth()->user()->profile_picture)

                <img
                    src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                    alt="{{ auth()->user()->name }}"
                    class="top-avatar-image"
                >

            @else

                <span class="top-avatar-letter">

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


        {{-- =================================================
             LOGOUT FORM
        ================================================== --}}

     <form
    action="{{ route('logout') }}"
    method="POST"
    id="logoutForm"
    class="logout-form"
>
    @csrf

    <button
        type="submit"
        id="logoutButton"
        class="header-logout-button"
    >

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="19"
            height="19"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />

            <polyline points="16 17 21 12 16 7" />

            <line x1="21" y1="12" x2="9" y2="12" />
        </svg>

        <span>
            Logout
        </span>

    </button>

</form>

    </div>

</header>
<div class="receptionist-layout">

    {{-- =====================================================
         RECEPTIONIST SIDEBAR
    ====================================================== --}}
<aside class="receptionist-sidebar">

    {{-- =====================================================
         SIDEBAR BRAND
    ====================================================== --}}

    <div class="sidebar-brand">

        <div class="sidebar-logo">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >

                <path
                    d="M7 3C5.2 3 4 4.5 4 6.5C4 9.5 5.2 11.5 6 14.5C6.6 16.8 6.8 21 9 21C10.8 21 11 17 12 17C13 17 13.2 21 15 21C17.2 21 17.4 16.8 18 14.5C18.8 11.5 20 9.5 20 6.5C20 4.5 18.8 3 17 3C15.3 3 14.1 4.2 12 4.2C9.9 4.2 8.7 3 7 3Z"
                />

            </svg>

        </div>


        <div class="sidebar-brand-text">

            <strong>
                Shine &amp; Smile
            </strong>

            <span>
                Receptionist
            </span>

        </div>

    </div>


    {{-- =====================================================
         SIDEBAR NAVIGATION
    ====================================================== --}}

    <nav class="sidebar-navigation">


        {{-- DASHBOARD --}}

        <a
            href="{{ route('receptionist.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('receptionist.dashboard') ? 'active' : '' }}"
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
                aria-hidden="true"
            >

                <path d="M3 10.5L12 3l9 7.5" />

                <path d="M5 9.5V21h14V9.5" />

                <path d="M9 21v-6h6v6" />

            </svg>

            <span>
                Dashboard
            </span>

        </a>


        {{-- APPOINTMENTS --}}

        <a
            href="{{ route('receptionist.dashboard') }}#appointments"
            class="sidebar-link {{ request()->routeIs('receptionist.dashboard') && request()->get('section') === 'appointments' ? 'active' : '' }}"
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
                aria-hidden="true"
            >

                <rect
                    x="3"
                    y="5"
                    width="18"
                    height="16"
                    rx="2"
                />

                <path d="M16 3v4" />

                <path d="M8 3v4" />

                <path d="M3 10h18" />

            </svg>

            <span>
                Appointments
            </span>

        </a>


        {{-- PATIENTS --}}

        <a
            href="{{ route('receptionist.patients.index') }}"
            class="sidebar-link {{ request()->routeIs('receptionist.patients.*') ? 'active' : '' }}"
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
                aria-hidden="true"
            >

                <path
                    d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                />

                <circle
                    cx="9"
                    cy="7"
                    r="4"
                />

                <path
                    d="M22 21v-2a4 4 0 0 0-3-3.87"
                />

                <path
                    d="M16 3.13a4 4 0 0 1 0 7.75"
                />

            </svg>

            <span>
                Patients
            </span>

        </a>


        {{-- NOTIFICATIONS --}}

        <a
            href="{{ route('receptionist.notifications.index') }}"
            class="sidebar-link {{ request()->routeIs('receptionist.notifications.*') ? 'active' : '' }}"
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
                aria-hidden="true"
            >

                <path
                    d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                />

                <path d="M10 21h4" />

            </svg>

            <span>
                Notifications
            </span>


            @if(isset($unreadCount) && $unreadCount > 0)

                <span class="sidebar-notification-count">
                    {{ $unreadCount }}
                </span>

            @endif

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
                aria-hidden="true"
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


    {{-- =====================================================
         SIDEBAR USER PROFILE
    ====================================================== --}}

    <div class="sidebar-user">


        {{-- PROFILE AVATAR --}}

        <div class="sidebar-user-avatar">

            @if(
                auth()->check() &&
                !empty(auth()->user()->profile_picture)
            )

                <img
                    src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                    alt="{{ auth()->user()->name ?? 'Receptionist' }}"
                    class="sidebar-user-image"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                >

                {{-- FALLBACK IF IMAGE DOES NOT LOAD --}}

                <span
                    class="sidebar-user-letter"
                    style="display: none;"
                >
                    {{ strtoupper(
                        substr(
                            auth()->user()->name ?? 'R',
                            0,
                            1
                        )
                    ) }}
                </span>

            @else

                {{-- FALLBACK LETTER --}}

                <span class="sidebar-user-letter">

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


        {{-- USER DETAILS --}}

        <div class="sidebar-user-info">

            <strong>
                {{ auth()->user()->name ?? 'Receptionist' }}
            </strong>

            <span>
                Receptionist
            </span>

        </div>


    </div>


</aside>


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <main class="receptionist-main">




<div class="patients-page">


    {{-- ======================================================
        HEADER
    ======================================================= --}}

    <header class="patients-header">

        <div>

            <div class="breadcrumb">
                Receptionist / Patients
            </div>

            <h1>
                Patients
            </h1>

            <p>
                Search and manage registered patients.
            </p>

        </div>


        <button
            type="button"
            class="btn-primary"
            id="openAddPatient"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="19"
                height="19"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 5v14M5 12h14"
                />
            </svg>

            Add Patient

        </button>

    </header>


    {{-- ======================================================
        SUCCESS MESSAGE
    ======================================================= --}}

    @if(session('success'))

        <div class="alert success-alert">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                fill="none"
                viewBox="0 0 24 24"
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


    {{-- ======================================================
        SEARCH / FILTER
    ======================================================= --}}

    <section class="filter-card">

        <form
            method="GET"
            action="{{ route('receptionist.patients.index') }}"
            class="search-form"
        >

            <div class="search-box">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    fill="none"
                    viewBox="0 0 24 24"
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
                        d="m20 20-4-4"
                    />

                </svg>


                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search patient name..."
                    autocomplete="off"
                >


                @if($search)

                    <a
                        href="{{ route('receptionist.patients.index') }}"
                        class="clear-search"
                    >
                        ×
                    </a>

                @endif

            </div>


            <button
                type="submit"
                class="btn-search"
            >
                Search
            </button>

        </form>

    </section>


    {{-- ======================================================
        PATIENT TABLE
    ======================================================= --}}

    <section class="patients-card">


        <div class="table-header">

            <div>

                <h2>
                    Patient List
                </h2>

                <p>
                    {{ $patients->total() }}
                    registered patient{{ $patients->total() == 1 ? '' : 's' }}
                </p>

            </div>

        </div>


        <div class="table-wrapper">

            <table class="patients-table">

                <thead>

                    <tr>

                        <th>
                            Patient
                        </th>

                        <th>
                            Patient ID
                        </th>

                        <th>
                            Last Appointment
                        </th>

                        <th>
                            Next Appointment
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="text-right">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>


                @forelse($patients as $patient)

                    @php

                        $patientName =
                            $patient->patient_name
                            ?? 'Unknown Patient';

                        $appointments =
                            $patient->appointments;

                        $lastAppointment =
                            $appointments
                                ->filter(
                                    fn ($a) =>
                                        $a->appointment_date &&
                                        $a->appointment_date
                                            ->isPast()
                                )
                                ->first();

                        $nextAppointment =
                            $appointments
                                ->filter(
                                    fn ($a) =>
                                        $a->appointment_date &&
                                        $a->appointment_date
                                            ->isFuture()
                                )
                                ->last();

                        $initials =
                            collect(
                                preg_split(
                                    '/\s+/',
                                    trim($patientName)
                                )
                            )
                            ->filter()
                            ->take(2)
                            ->map(
                                fn ($name) =>
                                    strtoupper(
                                        substr($name, 0, 1)
                                    )
                            )
                            ->implode('');

                    @endphp


                    <tr>


                        {{-- PATIENT --}}

                        <td>

                            <div class="patient-cell">

                                <div class="patient-avatar">
                                    {{ $initials ?: 'P' }}
                                </div>

                                <div>

                                    <div class="patient-name">
                                        {{ $patientName }}
                                    </div>

                                    <div class="patient-label">
                                        Patient Record
                                    </div>

                                </div>

                            </div>

                        </td>


                        {{-- ID --}}

                        <td>

                            <span class="patient-id">
                                PT-{{
                                    str_pad(
                                        $patient->id,
                                        5,
                                        '0',
                                        STR_PAD_LEFT
                                    )
                                }}
                            </span>

                        </td>


                        {{-- LAST APPOINTMENT --}}

                        <td>

                            @if($lastAppointment)

                                <div class="appointment-date">

                                    {{
                                        $lastAppointment
                                            ->appointment_date
                                            ->format('M d, Y')
                                    }}

                                </div>

                                <div class="appointment-service">

                                    {{
                                        $lastAppointment
                                            ->service
                                            ?->service_name
                                        ?? 'N/A'
                                    }}

                                </div>

                            @else

                                <span class="muted">
                                    No previous visit
                                </span>

                            @endif

                        </td>


                        {{-- NEXT APPOINTMENT --}}

                        <td>

                            @if($nextAppointment)

                                <div class="appointment-date">

                                    {{
                                        $nextAppointment
                                            ->appointment_date
                                            ->format('M d, Y')
                                    }}

                                </div>

                                <div class="appointment-service">

                                    {{
                                        $nextAppointment
                                            ->service
                                            ?->service_name
                                        ?? 'N/A'
                                    }}

                                </div>

                            @else

                                <span class="muted">
                                    No upcoming appointment
                                </span>

                            @endif

                        </td>


                        {{-- STATUS --}}

                        <td>

                            @if($nextAppointment)

                                @php
                                    $status =
                                        strtolower(
                                            $nextAppointment->status
                                            ?? ''
                                        );
                                @endphp

                                @if(
                                    in_array(
                                        $status,
                                        ['accepted', 'confirmed']
                                    )
                                )

                                    <span class="status-badge confirmed">
                                        Confirmed
                                    </span>

                                @elseif($status === 'completed')

                                    <span class="status-badge completed">
                                        Completed
                                    </span>

                                @elseif($status === 'cancelled')

                                    <span class="status-badge cancelled">
                                        Cancelled
                                    </span>

                                @elseif($status === 'no_show')

                                    <span class="status-badge no-show">
                                        No Show
                                    </span>

                                @else

                                    <span class="status-badge pending">
                                        Pending
                                    </span>

                                @endif

                            @else

                                <span class="status-badge neutral">
                                    No Appointment
                                </span>

                            @endif

                        </td>


                        {{-- ACTION --}}

                        <td class="text-right">

                            <button
                                type="button"
                                class="btn-view"
                                data-patient-id="{{ $patient->id }}"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="17"
                                    height="17"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="2.5"
                                    />

                                </svg>

                                View

                            </button>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="empty-state"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="48"
                                height="48"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.5"
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

                            <h3>
                                No patients found
                            </h3>

                            <p>
                                Try another search or add a new patient.
                            </p>

                        </td>

                    </tr>

                @endforelse


                </tbody>

            </table>

        </div>


        {{-- ==================================================
            PAGINATION
        =================================================== --}}

        @if($patients->hasPages())

            <div class="pagination">

                <div>

                    @if($patients->onFirstPage())

                        <span class="pagination-disabled">
                            ← Previous
                        </span>

                    @else

                        <a
                            href="{{ $patients->previousPageUrl() }}"
                        >
                            ← Previous
                        </a>

                    @endif

                </div>


                <div class="pagination-pages">

                    @foreach(
                        $patients->getUrlRange(
                            1,
                            $patients->lastPage()
                        )
                        as $page => $url
                    )

                        @if(
                            $page ===
                            $patients->currentPage()
                        )

                            <span class="pagination-current">
                                {{ $page }}
                            </span>

                        @else

                            <a href="{{ $url }}">
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach

                </div>


                <div>

                    @if($patients->hasMorePages())

                        <a
                            href="{{ $patients->nextPageUrl() }}"
                        >
                            Next →
                        </a>

                    @else

                        <span class="pagination-disabled">
                            Next →
                        </span>

                    @endif

                </div>

            </div>

        @endif

    </section>

</div>


{{-- ==========================================================
    VIEW PATIENT MODAL
=========================================================== --}}

<div
    id="patientModal"
    class="modal-overlay hidden"
>

    <div class="patient-modal">


        <div class="modal-header">

            <div>

                <p class="modal-label">
                    Patient Record
                </p>

                <h2 id="modalPatientName">
                    Patient
                </h2>

            </div>


            <button
                type="button"
                class="modal-close"
                data-close-modal
            >
                ×
            </button>

        </div>


        <div class="modal-content">


            <div class="patient-summary">

                <div
                    class="large-avatar"
                    id="modalInitials"
                >
                    P
                </div>

                <div>

                    <h3 id="modalSummaryName">
                        Patient
                    </h3>

                    <p id="modalPatientId">
                        Patient ID
                    </p>

                </div>

            </div>


            <div class="modal-section">

                <h3>
                    Appointment History
                </h3>

                <div
                    id="appointmentHistory"
                    class="history-list"
                >

                    <div class="loading">
                        Loading...
                    </div>

                </div>

            </div>

        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="btn-secondary"
                data-close-modal
            >
                Close
            </button>

        </div>

    </div>

</div>


{{-- ==========================================================
    ADD PATIENT MODAL
=========================================================== --}}

<div
    id="addPatientModal"
    class="modal-overlay hidden"
>

    <div class="patient-modal small-modal">


        <div class="modal-header">

            <div>

                <p class="modal-label">
                    Patient Registration
                </p>

                <h2>
                    Add New Patient
                </h2>

            </div>


            <button
                type="button"
                class="modal-close"
                data-close-add
            >
                ×
            </button>

        </div>


        <form
            method="POST"
            action="{{ route('receptionist.patients.store') }}"
        >

            @csrf


            <div class="modal-content">

                <div class="form-group">

                    <label for="patient_name">
                        Patient Name
                    </label>

                    <input
                        type="text"
                        id="patient_name"
                        name="patient_name"
                        placeholder="Enter patient's full name"
                        required
                    >

                    @error('patient_name')

                        <p class="form-error">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-secondary"
                    data-close-add
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Add Patient
                </button>

            </div>

        </form>

    </div>

</div>


<script src="{{ asset('js/receptionist/receptionist-patients.js') }}"></script>

</main>

</div>

</body>

</html>
