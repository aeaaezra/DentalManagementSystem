<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shine & Smile Dental | Appointment History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"  >
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link  rel="stylesheet" href="{{ asset('css/appointment/history.css') }}">
    <link  rel="stylesheet"   href="{{ asset('css/appointment/patient-theme.css') }}" >
    <script src="{{ asset('js/patient-theme.js') }}"></script>

</head>

<body class="bg-white text-[#2D2D2D] pt-24">

    <!-- NAVIGATION -->

    <nav class="fixed top-0 left-0 w-full z-[99999] bg-white/90 backdrop-blur-md shadow-sm">

        <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <!-- LOGO -->

            <div class="relative flex items-center gap-4">

                <div class="text-2xl font-bold text-[#E91E63]">
                    Shine & Smile
                </div>

            </div>

            <!-- NAVIGATION LINKS -->

            <div class="hidden md:flex items-center gap-8 font-medium mx-auto">

                <a
                    href="{{ route('appointments.homepage') }}"
                    class="hover:text-[#E91E63] transition"
                >
                    Home
                </a>

                <a
                    href="{{ route('appointments.create') }}"
                    class="hover:text-[#E91E63] transition"
                >
                    Appointments
                </a>


                <a href="  {{ route('faq') }}"
                    class="hover:text-[#E91E63] transition">
                    FAQ's
                    </a>

                <!-- HISTORY -->

                <a
                        href="{{ route('appointments.history') }}"
                        class="main-nav-link
                            {{ request()->routeIs('appointments.history') ? 'active' : '' }}"
                    >
                        HISTORY
                    </a>

            </div>
<!-- =========================================================
     NOTIFICATION + PROFILE
     ========================================================= -->

<div class="flex items-center gap-4">

   @php
    $totalNotifications = $notifications->count();

    $unreadNotifications = $notifications
        ->filter(fn ($notification) => is_null($notification->read_at))
        ->count();

    $readNotifications = $notifications
        ->filter(fn ($notification) => !is_null($notification->read_at))
        ->count();
@endphp


    <!-- =====================================================
         NOTIFICATION
         ===================================================== -->

    <div class="relative notification-wrapper">

        <!-- NOTIFICATION BUTTON -->

        <button
            id="notificationBtn"
            type="button"
            class="notification-btn"
            aria-label="Notifications"
            aria-expanded="false"
        >

            <!-- Bell icon -->

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="notification-bell-icon"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                />
            </svg>


            <!-- UNREAD BADGE -->

            @if($unreadNotifications > 0)

                <span
                    id="notificationBadge"
                    class="notification-badge"
                >
                    {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
                </span>

            @endif

        </button>


        <!-- =================================================
             NOTIFICATION DROPDOWN BOX
             ================================================= -->

        <div
            id="notificationDropdown"
            class="hidden"
            aria-hidden="true"
        >

            <!-- =================================================
                 HEADER
                 ================================================= -->

            <div class="notification-dropdown-header">

                <div class="notification-header-content">


                    <div>

                        <h3>
                            Notifications
                        </h3>

                        <p>
                            Stay updated with your appointments
                        </p>

                    </div>

                </div>


                <!-- CLOSE BUTTON -->

                <button
                    id="closeNotificationBtn"
                    type="button"
                    class="notification-close-btn"
                    aria-label="Close notifications"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </button>

            </div>


            <!-- =================================================
                 FILTER BAR
                 ================================================= -->

            <div
                class="notification-filter-bar"
                role="tablist"
                aria-label="Notification filters"
            >

                <!-- ALL -->

                <button
                    type="button"
                    class="notification-filter active"
                    data-filter="all"
                    role="tab"
                    aria-selected="true"
                >

                    <span>
                        All
                    </span>

                    <span class="notification-filter-count">
                        {{ $totalNotifications }}
                    </span>

                </button>


                <!-- UNREAD -->

                <button
                    type="button"
                    class="notification-filter"
                    data-filter="unread"
                    role="tab"
                    aria-selected="false"
                >

                    <span>
                        Unread
                    </span>

                    <span class="notification-filter-count">
                        {{ $unreadNotifications }}
                    </span>

                </button>


                <!-- READ -->

                <button
                    type="button"
                    class="notification-filter"
                    data-filter="read"
                    role="tab"
                    aria-selected="false"
                >

                    <span>
                        Read
                    </span>

                    <span class="notification-filter-count">
                        {{ $readNotifications }}
                    </span>

                </button>

            </div>


            <!-- =================================================
                 NOTIFICATION LIST
                 ================================================= -->

            <div
                id="notificationList"
                class="notification-list"
            >

                @forelse($notifications as $notification)

                    @php

                        $isUnread = is_null($notification->read_at);

                        $title =
                            $notification->data['title']
                            ?? 'Notification';

                        $message =
                            $notification->data['message']
                            ?? 'No message available.';

                        $lowerTitle =
                            strtolower($title);

                    @endphp


                    <!-- NOTIFICATION ITEM -->
                        <div
                        class="notification-item cursor-pointer"
                        data-notification-id="{{ $notification->id }}"
                        data-notification-status="{{ $notification->read_at ? 'read' : 'unread' }}"
                        data-notification-title="{{ $notification->data['title'] ?? 'Notification' }}"
                        data-notification-message="{{ $notification->data['message'] ?? '' }}"
                        data-notification-time="{{ $notification->created_at->diffForHumans() }}"
                        role="button"
                        tabindex="0"
                        aria-label="View notification"
                    >


                        <!-- UNREAD DOT -->

                        @if(is_null($notification->read_at))
                            <span
                                class="notification-unread-dot"
                                title="Unread"
                            ></span>
                        @endif


                        <!-- ICON -->

                        <div
                            class="notification-icon

                            @if(str_contains($lowerTitle, 'cancel'))
                                notification-icon-cancel

                            @elseif(
                                str_contains($lowerTitle, 'confirm') ||
                                str_contains($lowerTitle, 'approved')
                            )
                                notification-icon-success

                            @elseif(str_contains($lowerTitle, 'payment'))
                                notification-icon-payment

                            @else
                                notification-icon-default
                            @endif"
                        >

                            @if(str_contains($lowerTitle, 'cancel'))

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>

                            @elseif(
                                str_contains($lowerTitle, 'confirm') ||
                                str_contains($lowerTitle, 'approved')
                            )

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
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

                            @elseif(str_contains($lowerTitle, 'payment'))

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 7c-1.11 0-2.08.402-2.599 1"
                                    />
                                </svg>

                            @else

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5"
                                    />
                                </svg>

                            @endif

                        </div>


                        <!-- CONTENT -->

                        <div class="notification-content">

                            <p class="notification-title">
                                {{ $title }}
                            </p>

                            <p class="notification-message">
                                {{ $message }}
                            </p>

                            <span class="notification-time">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>

                        </div>

                    </div>

                @empty

                    <div
                        id="notificationEmptyState"
                        class="notification-empty"
                    >



                        <p class="notification-empty-title">
                            No notifications
                        </p>

                        <p class="notification-empty-text">
                            You're all caught up.
                        </p>

                    </div>

                @endforelse

                <!-- JS FILTER EMPTY STATE -->

                <div
                    id="notificationFilterEmpty"
                    class="notification-empty hidden"
                >

                    <div class="notification-empty-icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5"
                            />
                        </svg>

                    </div>

                    <p
                        id="notificationFilterEmptyTitle"
                        class="notification-empty-title"
                    >
                        No notifications
                    </p>

                    <p class="notification-empty-text">
                        There are no notifications in this category.
                    </p>

                </div>

            </div>

        </div>

    </div>

<!-- Notification Details Modal -->
<div id="notificationModal" class="notification-modal">

    <div
        id="notificationModalOverlay"
        class="notification-modal-overlay"
    ></div>

    <div
        class="notification-modal-card"
        role="dialog"
        aria-modal="true"
        aria-labelledby="notificationModalTitle"
    >

        <!-- Close -->
        <button
            type="button"
            id="closeNotificationModal"
            class="notification-modal-close"
            aria-label="Close"
        >
            &times;
        </button>

        <!-- Icon -->
        <div class="notification-modal-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
            >
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </div>

        <!-- Title -->
        <h2 id="notificationModalTitle">
            Appointment Pending
        </h2>

        <!-- Time -->
        <p id="notificationModalTime">
            1 hour ago
        </p>

        <!-- Message -->
        <div class="notification-modal-message">
            <p id="notificationModalMessage"></p>
        </div>

        <!-- Button -->
        <button
            type="button"
            id="notificationModalDone"
            class="notification-modal-button"
        >
            Done
        </button>

    </div>
</div>
    <!-- =====================================================
         PROFILE
         ===================================================== -->

    <div class="relative">

        <button
            id="profileBtn"
            type="button"
            class="flex items-center gap-2 focus:outline-none"
            aria-expanded="false"
        >

            <img
                src="{{ Auth::user()->profile_picture
                    ? asset('storage/' . Auth::user()->profile_picture)
                    : asset('images/default-profile.png') }}"
                alt="Profile"
                class="w-10 h-10 rounded-full border-2 border-pink-500 object-cover"
            >

            <div class="hidden md:block text-left">

                <p class="text-sm font-semibold text-gray-800">
                    {{ Auth::user()->name }}
                </p>

                <p class="text-xs text-gray-500">
                    Patient
                </p>

            </div>


            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 text-gray-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"
                />
            </svg>

        </button>


        <!-- PROFILE DROPDOWN -->

        <div
            id="profileMenu"
            class="hidden absolute right-0 mt-3 w-52 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-[9999]"
        >

            <a
                href="{{ route('appointments.settings', ['return' => url()->current()]) }}"
                class="flex items-center gap-3 px-3 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition"
            >

                <span>
                    Settings
                </span>

            </a>


            <form
                method="POST"
                action="{{ route('logout') }}"
                id="logoutForm"
            >

                @csrf

                <button
                    type="button"
                    id="logoutButton"
                    class="w-full text-left flex items-center gap-3 px-3 py-3 text-red-600 hover:bg-red-50 transition"
                >

                    <span>
                        Logout
                    </span>

                </button>

            </form>

        </div>

    </div>

</div>

        </div>

    </nav>


    <!-- MAIN CONTENT -->

    <main class="container mx-auto px-6 py-10">

        <div class="max-w-7xl mx-auto">

            <!-- PAGE HEADER -->

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-gray-800">
                    Appointment History
                </h1>

                <p class="text-gray-600">
                    Track your dental visits and billing status.
                </p>

            </div>


            <!-- PRINT BUTTON -->

            <div class="flex justify-end mb-4">

                <button
                    type="button"
                    onclick="printHistory()"
                    class="inline-flex items-center gap-2 bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg shadow transition"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 17h2a2 2 0 002-2V9a2 2 0 00-2-2h-2m-10 0H5a2 2 0 00-2 2v6a2 2 0 002 2h2m10 0H7m10 0v4H7v-4m10-8V3H7v6h10z"
                        />
                    </svg>

                    Print History

                </button>

            </div>


            <!-- FILTERS -->

            <form
                method="GET"
                action="{{ route('appointments.history') }}"
                id="historyFilterForm"
                class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6"
            >

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">

                    <!-- MONTH -->

                    <select
                        id="monthFilter"
                        name="month"
                        class="w-full h-10 px-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:outline-none"
                    >

                        <option value="">
                            Month
                        </option>

                        @for($i = 1; $i <= 12; $i++)

                            <option
                                value="{{ sprintf('%02d', $i) }}"
                                {{ request('month') == sprintf('%02d', $i) ? 'selected' : '' }}
                            >
                                {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                            </option>

                        @endfor

                    </select>



                    <!-- SERVICE -->

                    <select
                        id="serviceFilter"
                        name="service"
                        class="w-full h-10 px-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:outline-none"
                    >

                        <option value="">
                            Service
                        </option>

                        @foreach($services as $service)

                            <option
                                value="{{ $service->service_name }}"
                                {{ request('service') == $service->service_name ? 'selected' : '' }}
                            >
                                {{ $service->service_name }}
                            </option>

                        @endforeach

                    </select>


                    <!-- STATUS -->

                    <select
                        id="statusFilter"
                        name="status"
                        class="w-full h-10 px-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:outline-none"
                    >

                        <option value="">
                            Status
                        </option>

                        <option
                            value="pending"
                            {{ request('status') === 'pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="confirmed"
                            {{ request('status') === 'confirmed' ? 'selected' : '' }}
                        >
                            Confirmed
                        </option>

                        <option
                            value="completed"
                            {{ request('status') === 'completed' ? 'selected' : '' }}
                        >
                            Completed
                        </option>

                        <option
                            value="cancelled"
                            {{ request('status') === 'cancelled' ? 'selected' : '' }}
                        >
                            Cancelled
                        </option>

                    </select>


                    <!-- SEARCH -->

                    <input
                        type="search"
                        id="searchInput"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search..."
                        class="w-full h-10 px-4 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:outline-none"
                    >


                    <!-- FILTER BUTTON -->

                    <button
                        type="submit"
                        class="w-full h-10 bg-pink-600 hover:bg-pink-700 text-white rounded-xl text-sm font-semibold transition"
                    >
                        Apply Filters
                    </button>

                </div>


                <!-- CLEAR FILTERS -->

                @if(
                    request()->filled('month')
                    || request()->filled('doctor')
                    || request()->filled('service')
                    || request()->filled('status')
                    || request()->filled('search')
                )

                    <div class="mt-4">

                        <a
                            href="{{ route('appointments.history') }}"
                            class="inline-flex items-center text-sm text-pink-600 hover:text-pink-800 font-medium"
                        >
                            Clear all filters
                        </a>

                    </div>

                @endif

            </form>


           <!-- APPOINTMENT TABLE -->

<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

    <div class="overflow-x-auto">

        <table
            class="w-full min-w-[900px] text-sm text-left text-gray-600"
            id="historyTable"
        >

            <!-- TABLE HEADER -->
        <thead class="bg-gradient-to-r from-pink-50 to-rose-50 border-b-2 border-pink-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-pink-600">
                        Date
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-pink-600">
                        Service
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-pink-600 text-right">
                        Total Fee
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-pink-600 text-right">
                        Amount Paid
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-pink-600 text-right">
                        Balance
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-pink-600 text-center">
                        Status
                    </th>

                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-pink-600 text-center">
                        Action
                    </th>
                </tr>
            </thead>


            <!-- TABLE BODY -->
            <tbody class="divide-y divide-gray-100">

                @forelse($appointments as $appointment)

                    <tr class="hover:bg-gray-50 transition duration-150">

                        <!-- DATE -->
                        <td class="px-6 py-5 whitespace-nowrap">

                            <div class="font-medium text-gray-800">
                                {{ $appointment->appointment_date?->format('M d, Y') }}
                            </div>

                            @if($appointment->appointment_time)

                                <div class="text-xs text-gray-400 mt-1">

                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}

                                </div>

                            @endif

                        </td>


                        <!-- SERVICE -->
                        <td class="px-6 py-5 whitespace-nowrap">

                            <span class="font-medium text-gray-700">

                                {{ $appointment->service->service_name ?? 'N/A' }}

                            </span>

                        </td>


                        <!-- TOTAL FEE -->
                        <td class="px-6 py-5 text-right whitespace-nowrap font-medium text-gray-700">

                            ₱{{ number_format($appointment->total_amount ?? 0, 2) }}

                        </td>


                        <!-- AMOUNT PAID -->
                        <td class="px-6 py-5 text-right whitespace-nowrap font-medium text-green-600">

                            ₱{{ number_format($appointment->amount_paid ?? 0, 2) }}

                        </td>


                        <!-- BALANCE -->
                        <td class="px-6 py-5 text-right whitespace-nowrap font-semibold">

                            @if(($appointment->balance ?? 0) > 0)

                                <span class="text-red-600">

                                    ₱{{ number_format($appointment->balance ?? 0, 2) }}

                                </span>

                            @else

                                <span class="text-gray-500">

                                    ₱{{ number_format($appointment->balance ?? 0, 2) }}

                                </span>

                            @endif

                        </td>


                        <!-- STATUS -->
                        <td class="px-6 py-5 text-center whitespace-nowrap">

                            @if($appointment->status === 'pending')

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-semibold border border-yellow-100">
                                    Pending
                                </span>

                            @elseif($appointment->status === 'confirmed')

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold border border-blue-100">
                                    Confirmed
                                </span>

                            @elseif($appointment->status === 'completed')

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-semibold border border-green-100">
                                    Completed
                                </span>

                            @elseif($appointment->status === 'cancelled')

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-semibold border border-red-100">
                                    Cancelled
                                </span>

                            @elseif($appointment->status === 'declined')

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-semibold border border-red-100">
                                    Declined
                                </span>

                            @else

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-50 text-gray-600 text-xs font-semibold border border-gray-200">
                                    {{ ucfirst($appointment->status) }}
                                </span>

                            @endif

                        </td>


                        <!-- ACTION -->
                        <td class="px-6 py-5 text-center whitespace-nowrap">

                            <button
                                type="button"
                                class="view-history-button inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-medium text-pink-600 bg-pink-50 border border-pink-100 hover:bg-pink-100 hover:text-pink-700 transition"
                                data-date="{{ $appointment->appointment_date?->format('M d, Y') ?? 'N/A' }}"
                                data-time="{{ $appointment->appointment_time ? \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') : 'N/A' }}"
                                data-service="{{ $appointment->service->service_name ?? 'N/A' }}"
                                data-total="₱{{ number_format($appointment->total_amount ?? 0, 2) }}"
                                data-paid="₱{{ number_format($appointment->amount_paid ?? 0, 2) }}"
                                data-balance="₱{{ number_format($appointment->balance ?? 0, 2) }}"
                                data-status="{{ ucfirst($appointment->status ?? 'N/A') }}"
                            >
                                View
                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="px-6 py-12 text-center text-gray-500"
                        >

                            No appointment history found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

            <!-- PAGINATION -->

            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">

                <p class="text-sm text-gray-500">

                    Showing

                    <span class="font-medium text-gray-700">
                        {{ $appointments->firstItem() ?? 0 }}
                    </span>

                    to

                    <span class="font-medium text-gray-700">
                        {{ $appointments->lastItem() ?? 0 }}
                    </span>

                    of

                    <span class="font-medium text-gray-700">
                        {{ $appointments->total() }}
                    </span>

                    appointments

                </p>

                <div>
                    {{ $appointments->links() }}
                </div>

            </div>

        </div>

    </main>

    <!-- APPOINTMENT HISTORY VIEW MODAL -->
    <div
        id="appointmentHistoryModal"
        class="fixed inset-0 z-[9999] hidden items-center justify-center p-4"
        aria-hidden="true"
    >
        <div
            id="appointmentHistoryOverlay"
            class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
        ></div>

        <div
            class="relative z-10 w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl"
            role="dialog"
            aria-modal="true"
            aria-labelledby="appointmentHistoryModalTitle"
        >
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-5">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-pink-600">
                        Appointment History
                    </p>

                    <h2
                        id="appointmentHistoryModalTitle"
                        class="mt-1 text-xl font-bold text-gray-900"
                    >
                        Appointment Details
                    </h2>
                </div>

                <button
                    type="button"
                    id="closeAppointmentHistoryModal"
                    class="flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-700 transition"
                    aria-label="Close appointment details"
                >
                    <span class="text-2xl leading-none">&times;</span>
                </button>
            </div>

            <div class="px-6 py-5">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                        <p class="text-xs font-medium text-gray-500">Date</p>
                        <p id="viewAppointmentDate" class="mt-1 font-semibold text-gray-900">N/A</p>
                    </div>

                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                        <p class="text-xs font-medium text-gray-500">Time</p>
                        <p id="viewAppointmentTime" class="mt-1 font-semibold text-gray-900">N/A</p>
                    </div>

                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-4 sm:col-span-2">
                        <p class="text-xs font-medium text-gray-500">Service</p>
                        <p id="viewAppointmentService" class="mt-1 font-semibold text-gray-900">N/A</p>
                    </div>
                </div>

                <div class="mt-5 overflow-hidden rounded-xl border border-gray-100">
                    <div class="flex items-center justify-between border-b border-gray-100 px-4 py-3">
                        <span class="text-sm text-gray-500">Total Fee</span>
                        <span id="viewAppointmentTotal" class="font-semibold text-gray-900">₱0.00</span>
                    </div>

                    <div class="flex items-center justify-between border-b border-gray-100 px-4 py-3">
                        <span class="text-sm text-gray-500">Amount Paid</span>
                        <span id="viewAppointmentPaid" class="font-semibold text-green-600">₱0.00</span>
                    </div>

                    <div class="flex items-center justify-between px-4 py-3">
                        <span class="text-sm text-gray-500">Remaining Balance</span>
                        <span id="viewAppointmentBalance" class="font-semibold text-red-600">₱0.00</span>
                    </div>
                </div>

                <div class="mt-5 flex items-center justify-between rounded-xl bg-pink-50 px-4 py-3">
                    <span class="text-sm font-medium text-gray-600">Appointment Status</span>
                    <span
                        id="viewAppointmentStatus"
                        class="rounded-full bg-white px-3 py-1 text-xs font-bold text-pink-600 shadow-sm"
                    >
                        N/A
                    </span>
                </div>
            </div>

            <div class="flex justify-end border-t border-gray-100 px-6 py-4">
                <button
                    type="button"
                    id="closeAppointmentHistoryModalFooter"
                    class="rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-gray-800 transition"
                >
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- FEEDBACK MODAL -->

    <div
        id="feedbackModal"
        class="feedback-modal"
        aria-hidden="true"
    >

        <div
            id="feedbackOverlay"
            class="feedback-overlay"
        ></div>

        <div
            class="feedback-card"
            role="dialog"
            aria-modal="true"
            aria-labelledby="feedbackModalTitle"
        >

            <button
                type="button"
                id="closeFeedbackModal"
                class="feedback-close"
                aria-label="Close feedback form"
            >
                &times;
            </button>

            <div class="feedback-icon">
                ⭐
            </div>

            <h2 id="feedbackModalTitle">
                How was your experience?
            </h2>

            <p id="feedbackServiceName">
                Dental Service
            </p>

            <form
                id="feedbackForm"
                method="POST"
                action=""
            >

                @csrf

                <div class="rating-container">

                    <p>
                        Rate your experience
                    </p>

                    <div
                        class="stars"
                        role="radiogroup"
                        aria-label="Appointment rating"
                    >

                        @for($i = 1; $i <= 5; $i++)

                            <button
                                type="button"
                                class="star"
                                data-rating="{{ $i }}"
                                aria-label="{{ $i }} star{{ $i > 1 ? 's' : '' }}"
                            >
                                ★
                            </button>

                        @endfor

                    </div>

                    <input
                        type="hidden"
                        name="rating"
                        id="ratingInput"
                        value=""
                    >

                    <span
                        id="ratingText"
                        class="rating-text"
                    >
                        Select a rating
                    </span>

                </div>

                <div class="feedback-field">

                    <label for="feedbackComment">
                        Tell us about your experience
                    </label>

                    <textarea
                        id="feedbackComment"
                        name="comment"
                        rows="4"
                        maxlength="1000"
                        placeholder="What did you like about your experience? How can we improve?"
                    ></textarea>

                    <div class="feedback-counter">
                        <span id="feedbackCharacterCount">0</span>
                        / 1000
                    </div>

                </div>

                <div
                    id="feedbackFormError"
                    class="hidden mb-4 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-600"
                ></div>

                <button
                    type="submit"
                    id="submitFeedback"
                    class="submit-feedback"
                >
                    Submit Feedback
                </button>

            </form>

        </div>

    </div>


    <!-- FEEDBACK SUCCESS MODAL -->

    <div
        id="feedbackSuccessModal"
        class="feedback-modal"
        aria-hidden="true"
    >

        <div
            id="feedbackSuccessOverlay"
            class="feedback-overlay"
        ></div>

        <div
            class="feedback-card"
            role="dialog"
            aria-modal="true"
            aria-labelledby="feedbackSuccessTitle"
        >

            <div class="feedback-success-icon">
                ✓
            </div>

            <h2 id="feedbackSuccessTitle">
                Thank You for Your Feedback!
            </h2>

            <p>
                Your feedback helps Shine & Smile Dental Clinic improve our services and provide a better patient experience.
            </p>

            <button
                type="button"
                id="closeFeedbackSuccess"
                class="submit-feedback"
            >
                Done
            </button>

        </div>

    </div>


    <!-- FOOTER -->

    <footer class="bg-slate-50 pt-24 pb-12 border-t border-slate-200">


            <!-- COPYRIGHT -->

            <div class="pt-8 border-t border-slate-200 text-center text-slate-400 text-xs">

                © 2025 Shine & Smile Systems Inc. | All Rights Reserved.

            </div>

        </div>

    </footer>


<!-- ============================================================
     LOGOUT CONFIRMATION MODAL
     ============================================================ -->
<!-- =========================================================
     LOGOUT CONFIRMATION MODAL
     ========================================================= -->

<div
    id="logoutModal"
    class="logout-modal"
    aria-hidden="true"
>

    <!-- OVERLAY -->
    <div
        id="logoutModalOverlay"
        class="logout-modal-overlay"
    ></div>


    <!-- MODAL CARD -->
    <div
        class="logout-modal-card"
        role="dialog"
        aria-modal="true"
        aria-labelledby="logoutModalTitle"
    >

        <!-- ICON -->
        <div class="logout-modal-icon">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="28"
                height="28"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>

        </div>


        <!-- TITLE -->
        <h2 id="logoutModalTitle">
            Logout?
        </h2>


        <!-- MESSAGE -->
        <p>
            Are you sure you want to log out of your account?
        </p>


        <!-- BUTTONS -->
        <div class="logout-modal-actions">

            <button
                type="button"
                id="cancelLogout"
                class="logout-cancel-btn"
            >
                Cancel
            </button>


            <button
                type="button"
                id="confirmLogout"
                class="logout-confirm-btn"
            >
                Logout
            </button>

        </div>

    </div>

</div>

<script>
    window.notificationRoutes = {
        readAll: @json(route('notifications.readAll')),
        clearAll: @json(route('notifications.clearAll'))
    };
</script>


<script src="{{ asset('js/appointment/history.js') }}"></script>
    <script src="{{ asset('js/appointment/patient-theme.js') }}"></script>

</body>

</html>
