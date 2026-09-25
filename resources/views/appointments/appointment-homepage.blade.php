<!DOCTYPE html>


<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Shine & Smile Dental | Creating Healthy, Beautiful Smiles</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@600;700&display=swap"  rel="stylesheet"  >
<link rel="stylesheet" href="{{ asset('css/appointment/patient-theme.css') }}">
<link rel="stylesheet" href="{{ asset('css/appointment/homepage.css') }}">
    <link  rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" >

</head>

<body>

<nav class="main-navbar fixed top-0 left-0 w-full z-[99999]">
<div class="w-full max-w-none px-6 py-4 flex items-center">

        <!-- Logo + Mobile Menu -->
<div class="flex items-center gap-3 shrink-0">
            <!-- Mobile Hamburger -->
            <button
                id="mobileMenuBtn"
                type="button"
                class="md:hidden w-10 h-10 inline-flex items-center justify-center rounded-lg text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition"
                aria-label="Open navigation menu"
                aria-controls="mobileSidebar"
                aria-expanded="false"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Logo -->
            <a href="{{ route('appointments.homepage') }}"
               class="text-xl sm:text-2xl font-bold text-[#E91E63] whitespace-nowrap">
                Shine & Smile
            </a>
        </div>


<div class="hidden md:flex items-center gap-10 mx-auto shrink-0">

    <!-- HOME -->
    <a href="{{ route('appointments.homepage') }}"
       class="main-nav-link {{ request()->routeIs('appointments.homepage') ? 'active' : '' }}">
        HOME
    </a>

    <!-- APPOINTMENTS -->
    <a href="{{ route('appointments.create') }}"
       class="main-nav-link {{ request()->routeIs('appointments.create') ? 'active' : '' }}">
        APPOINTMENTS
    </a>

    <!-- FAQ -->
    <a href="{{ route('faq') }}"
       class="main-nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">
        FAQ'S
    </a>

    <!-- HISTORY -->
    <a href="{{ route('appointments.history') }}"
       class="main-nav-link {{ request()->routeIs('appointments.history') ? 'active' : '' }}">
        HISTORY
    </a>



</div>

<div
    id="navbarActions"
    class="flex items-center gap-4 relative shrink-0 ml-auto"
>

<div
    id="profileWrapper"
    class="relative shrink-0"
>

        <!-- NOTIFICATION BUTTON -->
        <button
            id="notificationBtn"
            type="button"
            aria-label="Open notifications"
            aria-expanded="false"
            class="notification-btn relative p-3 rounded-xl bg-pink-50 text-pink-600 hover:bg-pink-100 hover:text-pink-700 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-pink-200 active:scale-95 shadow-sm"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                />
            </svg>

            @if($notificationCount > 0)
                <span
                    class="notification-badge absolute -top-1.5 -right-1.5 bg-rose-500 text-white text-xs font-bold min-w-5 h-5 px-1 rounded-full flex items-center justify-center shadow-md ring-2 ring-white"
                >
                    {{ $notificationCount }}
                </span>
            @endif
        </button>

        @php
                $totalNotifications = $notifications->count();

                $unreadNotifications = $notifications
                    ->whereNull('read_at')
                    ->count();

                $readNotifications = $notifications
                    ->whereNotNull('read_at')
                    ->count();
            @endphp

        <!-- NOTIFICATION DROPDOWN -->
{{-- ============================================================
     NOTIFICATION DROPDOWN
     ============================================================ --}}

@php
    /*
    |--------------------------------------------------------------------------
    | Notification Counts
    |--------------------------------------------------------------------------
    | Use read_at consistently throughout the notification system.
    */

    $totalNotifications = $notifications->count();

    $unreadNotifications = $notifications
        ->filter(fn ($notification) => is_null($notification->read_at))
        ->count();

    $readNotifications = $notifications
        ->filter(fn ($notification) => !is_null($notification->read_at))
        ->count();
@endphp


<div
    id="notificationDropdown"
    class="hidden notification-dropdown"
    aria-hidden="true"
>

    {{-- ============================================================
         HEADER
         ============================================================ --}}

    <div class="notification-dropdown-header">

        <div class="notification-header-content">

            {{-- Bell Icon --}}
<div class="notification-header-icon">
    <svg
        class="notification-header-svg"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
        aria-hidden="true"
        style="width:24px !important; height:24px !important; min-width:24px !important; min-height:24px !important; max-width:24px !important; max-height:24px !important; display:block !important;"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
        />
    </svg>
</div>


            {{-- Header Text --}}
            <div class="notification-header-text">

                <div class="notification-header-title-row">

                    <h3 class="notification-header-title">
                        Notifications
                    </h3>

                    <span class="notification-new-count">
                        {{ $unreadNotifications }} New
                    </span>

                </div>

                <p class="notification-header-subtitle">
                    Stay updated with your appointments
                </p>

            </div>

        </div>


        {{-- Close Button --}}
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
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>

        </button>

    </div>


    {{-- ============================================================
         FILTER BAR
         ============================================================ --}}

    <div
        class="notification-filter-bar"
        role="tablist"
        aria-label="Notification filters"
    >

        {{-- ALL --}}
        <button
            type="button"
            class="notification-filter active"
            data-filter="all"
            role="tab"
            aria-selected="true"
        >
            <span>All</span>
            <span class="notification-filter-count">
                {{ $totalNotifications }}
            </span>
        </button>


        {{-- UNREAD --}}
        <button
            type="button"
            class="notification-filter"
            data-filter="unread"
            role="tab"
            aria-selected="false"
        >
            <span>Unread</span>
            <span class="notification-filter-count">
                {{ $unreadNotifications }}
            </span>
        </button>


        {{-- READ --}}
        <button
            type="button"
            class="notification-filter"
            data-filter="read"
            role="tab"
            aria-selected="false"
        >
            <span>Read</span>
            <span class="notification-filter-count">
                {{ $readNotifications }}
            </span>
        </button>

    </div>


    {{-- ============================================================
         NOTIFICATION LIST
         ============================================================ --}}

    <div
        id="notificationList"
        class="notification-list"
    >

        @forelse($notifications as $notification)

            @php

                $isUnread = is_null($notification->read_at);

                $title = $notification->data['title']
                    ?? 'Notification';

                $message = $notification->data['message']
                    ?? 'No message available.';

                $lowerTitle = strtolower($title);

                $notificationTime = $notification->created_at
                    ->diffForHumans();
            @endphp


            <div
                class="notification-item"
                data-notification-id="{{ $notification->id }}"
                data-notification-status="{{ $isUnread ? 'unread' : 'read' }}"
                data-notification-title="{{ $title }}"
                data-notification-message="{{ $message }}"
                data-notification-time="{{ $notificationTime }}"
                role="button"
                tabindex="0"
                aria-label="View notification"
            >

                @if($isUnread)

                    <span
                        class="notification-unread-dot"
                        title="Unread"
                        aria-label="Unread notification"
                    ></span>

                @endif


                {{-- ====================================================
                     NOTIFICATION ICON
                     ==================================================== --}}

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

                    {{-- CANCEL --}}
                    @if(str_contains($lowerTitle, 'cancel'))

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                            aria-hidden="true"
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
                            aria-hidden="true"
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
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>


                    @else

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                            />
                        </svg>

                    @endif

                </div>


                <div class="notification-content">

                    <h4 class="notification-title">
                        {{ $title }}
                    </h4>


                    <p class="notification-message">
                        {{ $message }}
                    </p>


                    <div class="notification-time">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                        <span>
                            {{ $notificationTime }}
                        </span>

                    </div>

                </div>

            </div>


        @empty


            <div
                id="noNotificationsMessage"
                class="notification-empty"
            >



                <p class="notification-empty-title">
                    No notifications found
                </p>


                <p class="notification-empty-text">
                    You're all caught up for now!
                </p>

            </div>

        @endforelse

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
                    stroke-width="1.7"
                    aria-hidden="true"
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


    {{-- ============================================================
         FOOTER
         ============================================================ --}}

    @if($totalNotifications > 0)

        <div class="notification-footer">

            <a
                href="{{ route('appointments.history') }}"
                class="notification-history-link"
            >

                <span>
                    View appointment history
                </span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7"
                    />
                </svg>

            </a>

        </div>

    @endif

</div>

    </div>
</div>

<!-- ============================================================
     NOTIFICATION DETAILS MODAL
     ============================================================ -->
<div
    id="notificationModal"
    class="notification-details-modal hidden"
    role="dialog"
    aria-modal="true"
    aria-labelledby="notificationModalTitle"
>
    <div
        id="notificationModalBackdrop"
        class="notification-details-backdrop"
    ></div>

    <div class="notification-details-card">

        <!-- HEADER -->
        <div class="notification-details-header">

            <div class="notification-details-icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
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
            </div>

            <div>
                <h2 id="notificationModalTitle">
                    Notification
                </h2>

                <p id="notificationModalTime">
                    Just now
                </p>
            </div>

            <button
                type="button"
                id="closeNotificationModal"
                class="notification-details-close"
                aria-label="Close notification"
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
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>

        <!-- MESSAGE -->
        <div class="notification-details-body">

            <p id="notificationModalMessage"></p>

        </div>

        <!-- FOOTER -->
        <div class="notification-details-footer">

            <button
                type="button"
                id="doneNotificationModal"
                class="notification-details-done"
            >
                Done
            </button>

        </div>

    </div>
</div>



<div class="relative">

    <button
        id="profileBtn"
        type="button"
        class="flex items-center gap-3
               focus:outline-none
               min-w-0"
        aria-expanded="false"
        aria-controls="profileMenu"
    >

        <!-- PROFILE PICTURE -->
        <div
            class="w-11 h-11
                   rounded-full
                   overflow-hidden
                   flex-shrink-0
                   bg-gray-700
                   flex items-center justify-center"
        >

            @if(auth()->user()->profile_picture)

                <img
                    src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                    alt="Profile"
                    class="w-full h-full object-cover"
                    onerror="this.style.display='none';"
                >

            @else

                <svg
                    class="w-6 h-6 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0
                           3.75 3.75 0 0 1 7.5 0ZM4.5
                           20.25a7.5 7.5 0 0 1 15 0"
                    />
                </svg>

            @endif

        </div>


        <!-- USER INFORMATION -->
        <div class="text-left min-w-0">

            <div
                class="font-semibold text-sm
                       text-white
                       truncate
                       whitespace-nowrap"
            >
                {{ auth()->user()->name ?? 'John Doe' }}
            </div>

            <div
                class="text-xs text-gray-400
                       truncate
                       whitespace-nowrap"
            >
                {{ ucfirst(auth()->user()->role ?? 'Patient') }}
            </div>

        </div>


        <!-- ARROW -->
        <svg
            class="w-4 h-4
                   flex-shrink-0
                   text-gray-300"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m6 9 6 6 6-6"
            />
        </svg>

    </button>


    <!-- PROFILE MENU -->
    <div
        id="profileMenu"
        class="hidden"
    >

        <!-- SETTINGS -->
        <a href="{{ route('appointments.settings') }}">

            <svg
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 15.5a3.5 3.5 0 1 0 0-7
                       3.5 3.5 0 0 0 0 7Z"
                />
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm8.5 4c0-.5-.1-1-.2-1.5l1.4-1.1-1.8-3.1-1.7.7a7.5 7.5 0 0 0-2.6-1.5L15.4 4h-3.6l-.2 1.5A7.5 7.5 0 0 0 9 7l-1.7-.7-1.8 3.1 1.4 1.1A7.4 7.4 0 0 0 6.7 12c0 .5.1 1 .2 1.5l-1.4 1.1 1.8 3.1L9 17a7.5 7.5 0 0 0 2.6 1.5l.2 1.5h3.6l.2-1.5A7.5 7.5 0 0 0 18 17l1.7.7 1.8-3.1-1.4-1.1c.3-.5.4-1 .4-1.5Z"
                />
            </svg>

            <span>SETTINGS</span>

        </a>


        <!-- LOGOUT -->
        <button
            type="button"
            id="logoutBtn"
        >

            <svg
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 12H3m0 0 4-4m-4 4 4 4"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 3v18"
                />

            </svg>

            <span>Logout</span>

        </button>

    </div>

</div>

        </div>

    </div>
</nav>


<div
    id="mobileSidebarOverlay"
    class="fixed inset-0 bg-black/40 z-[999998] hidden md:hidden"
    aria-hidden="true"
></div>

<aside
    id="mobileSidebar"
    class="fixed top-0 left-0 h-[100dvh] w-[280px] bg-white
           shadow-2xl z-[999999] -translate-x-full
           transition-transform duration-300 ease-in-out
           md:hidden flex flex-col overflow-hidden"
    aria-label="Mobile navigation"
>

    <div class="flex-shrink-0 px-5 py-5 border-b border-gray-200">
        <div class="flex items-center gap-3">

            <img
                src="{{ Auth::user()->profile_picture
                    ? asset('storage/' . Auth::user()->profile_picture)
                    : asset('images/default-profile.png') }}"
                class="w-12 h-12 rounded-full object-cover border-2 border-pink-500"
                alt="{{ Auth::user()->name }}"
            >

            <div class="flex-1 min-w-0">
                <p class="font-bold text-gray-800 truncate">
                    {{ Auth::user()->name }}
                </p>

                <p class="text-sm text-gray-500 capitalize">
                    {{ Auth::user()->role ?? 'Patient' }}
                </p>
            </div>

            <button
                id="closeMobileSidebar"
                type="button"
                class="w-9 h-9 flex items-center justify-center rounded-lg
                       text-gray-500 hover:bg-pink-50 hover:text-pink-600
                       transition"
                aria-label="Close navigation menu"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>
    </div>

    <nav
        class="flex-1 px-3 py-4 space-y-2 overflow-y-auto"
        aria-label="Main navigation"
    >

        <a
            href="{{ route('appointments.homepage') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition
            {{ request()->routeIs('appointments.homepage')
                ? 'bg-pink-500 text-white shadow-md'
                : 'text-gray-600 hover:bg-pink-50 hover:text-pink-600' }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 9.5L12 3l9 6.5V21a1 1 0 01-1 1h-5v-7H9v7H4a1 1 0 01-1-1V9.5z"
                />
            </svg>

            <span class="font-medium">
                Home
            </span>
        </a>

        <a
            href="{{ route('appointments.create') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition
            {{ request()->routeIs('appointments.create')
                ? 'bg-pink-500 text-white shadow-md'
                : 'text-gray-600 hover:bg-pink-50 hover:text-pink-600' }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <rect
                    x="3"
                    y="4"
                    width="18"
                    height="18"
                    rx="2"
                />

                <path
                    stroke-linecap="round"
                    d="M16 2v4M8 2v4M3 10h18"
                />
            </svg>

            <span class="font-medium">
                Appointments
            </span>
        </a>

        <a
            href="{{ route('faq') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition
            {{ request()->routeIs('faq')
                ? 'bg-pink-500 text-white shadow-md'
                : 'text-gray-600 hover:bg-pink-50 hover:text-pink-600' }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <circle
                    cx="12"
                    cy="12"
                    r="9"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9.5 9a2.5 2.5 0 115 0c0 2-2.5 4-2.5 4"
                />

                <path
                    stroke-linecap="round"
                    d="M12 17h.01"
                />
            </svg>

            <span class="font-medium">
                FAQ's
            </span>
        </a>

        <a
            href="{{ route('appointments.history') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition
            {{ request()->routeIs('appointments.history')
                ? 'bg-pink-500 text-white shadow-md'
                : 'text-gray-600 hover:bg-pink-50 hover:text-pink-600' }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 12a9 9 0 109-9 9.5 9.5 0 00-6.4 2.6L3 8"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 3v5h5"
                />

                <path
                    stroke-linecap="round"
                    d="M12 7v5l3 2"
                />
            </svg>

            <span class="font-medium">
                History
            </span>
        </a>

    </nav>
<div
    class="flex-shrink-0 border-t border-gray-200 px-3 py-4 space-y-2"
>

    {{-- SETTINGS --}}
    <a
        href="{{ route('appointments.settings', ['return' => url()->current()]) }}"
        class="flex items-center gap-4 px-4 py-3 rounded-xl
               text-gray-600 hover:bg-pink-50 hover:text-pink-600
               transition"
    >

        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5 shrink-0"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
            aria-hidden="true"
        >
            <circle
                cx="12"
                cy="12"
                r="3"
            />

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M19.4 15a1.7 1.7 0 00.34 1.88l.06.06-2 2-.06-.06A1.7 1.7 0 0016 18.6a1.7 1.7 0 00-1 .3 1.7 1.7 0 00-.6 1.4V20h-4v-.3a1.7 1.7 0 00-.6-1.4 1.7 1.7 0 00-1-.3 1.7 1.7 0 00-1.88.34l-.06.06-2-2 .06-.06A1.7 1.7 0 005.4 15a1.7 1.7 0 00-.3-1 1.7 1.7 0 00-1.4-.6H3.4v-4h.3a1.7 1.7 0 001.4-.6 1.7 1.7 0 00.3-1A1.7 1.7 0 005.06 5.9L5 5.84l2-2 .06.06A1.7 1.7 0 008.94 3.6a1.7 1.7 0 001-.3 1.7 1.7 0 00.6-1.4V1.6h4v.3a1.7 1.7 0 00.6 1.4 1.7 1.7 0 001 .3A1.7 1.7 0 0018 3.26l.06-.06 2 2-.06.06A1.7 1.7 0 0019.4 7a1.7 1.7 0 00.3 1 1.7 1.7 0 001.4.6h.3v4h-.3a1.7 1.7 0 00-1.4.6 1.7 1.7 0 00-.3 1z"
            />
        </svg>

        <span class="font-medium">
            Settings
        </span>

    </a>


    {{-- LOGOUT --}}
    <form
        method="POST"
        action="{{ route('logout') }}"
        id="logoutForm"
    >

        @csrf

        <button
            type="button"
            id="logoutButton"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-xl
                   text-red-600 hover:bg-red-50 transition text-left"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M10 17l5-5-5-5"
                />

                <path
                    stroke-linecap="round"
                    d="M15 12H3"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 5v14a2 2 0 002 2h10"
                />

            </svg>

            <span class="font-semibold">
                Logout
            </span>

        </button>

    </form>

</div>

</aside>

<main class="container mx-auto px-4 sm:px-6 pt-[120px]">

@if(session('success'))

<div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6">

    {{ session('success') }}

</div>

@endif

@if(session('error'))

<div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6">

    {{ session('error') }}

</div>

@endif


<section class="mb-12 max-w-7xl mx-auto custom-pink text-white rounded-2xl p-8 md:p-10 flex flex-col md:flex-row justify-between items-center shadow-lg">

    <div>
        <h2 class="text-2xl font-bold">
    Welcome Back, {{ auth()->user()->name }}!
</h2>

        <p class="opacity-90 mt-2">
            Manage your teeth with ease
        </p>
    </div>

    <a href="{{ route('appointments.create') }}"
       class="inline-block bg-white text-custom-pink font-bold py-3 px-8 rounded-full shadow-md hover:bg-gray-100 transition mt-4 md:mt-0">
        Book Now!
    </a>

</section>

  <div class="lg:col-span-3 w-full bg-white p-8 rounded-2xl shadow-sm border border-gray-100">

        <!-- Left Column: Appointments -->
<section class="mb-12 bg-white p-8 rounded-2xl shadow-sm border border-gray-100 max-w-5xl mx-auto">


    <div class="flex justify-between items-center mb-8">

        <div>

            <h3 class="text-2xl font-bold text-gray-800">
                My Appointments
            </h3>

            <p class="text-sm text-gray-500">
                Manage your current and past bookings
            </p>

        </div>

    </div>



    <div class="overflow-x-auto">

        <table class="w-full text-left border-collapse">

            {{-- TABLE HEADER --}}

            <thead>

                <tr class="text-gray-500 border-b border-gray-100 text-sm">

                    <th class="pb-4 font-semibold pl-2">
                        Date & Time
                    </th>

                    <th class="pb-4 font-semibold">
                        Service
                    </th>

                    <th class="pb-4 font-semibold text-center">
                        Status
                    </th>

                    <th class="pb-4 font-semibold text-right">
                        Action
                    </th>

                </tr>

            </thead>




            <tbody class="text-gray-700 text-sm">


                @forelse($appointmentHistory as $appointment)


                    @php


                        $status = strtolower(
                            trim(
                                $appointment->status ?? ''
                            )
                        );




                        if ($appointment->checked_out_at) {

                            $displayStatus = 'completed';

                        } elseif ($appointment->treatment_started_at) {

                            $displayStatus = 'in_treatment';

                        } elseif ($appointment->checked_in_at) {

                            $displayStatus = 'checked_in';

                        } elseif ($status === 'no_show') {

                            $displayStatus = 'no_show';

                        } elseif (
                            in_array(
                                $status,
                                [
                                    'accepted',
                                    'confirmed'
                                ]
                            )
                        ) {

                            $displayStatus = 'confirmed';

                        } else {

                            $displayStatus = $status;

                        }

                    @endphp


                    <tr
                        class="border-b border-gray-50 hover:bg-pink-50 transition"
                    >


                        {{-- =================================================
                            DATE & TIME
                        ================================================== --}}

                        <td class="py-5 pl-2">

                            <p class="font-semibold">

                                {{ \Carbon\Carbon::parse(
                                    $appointment->appointment_date
                                )->format('F d, Y') }}

                            </p>


                            <p class="text-xs text-gray-400">

                                {{ \Carbon\Carbon::parse(
                                    $appointment->appointment_time
                                )->format('h:i A') }}

                            </p>

                        </td>


                        {{-- =================================================
                            SERVICE
                        ================================================== --}}

                        <td class="py-5 font-medium text-custom-pink">

                            {{ $appointment->service?->service_name ?? 'N/A' }}

                        </td>


                        {{-- =================================================
                            STATUS
                        ================================================== --}}

                        <td class="py-5 text-center">


                            {{-- PENDING --}}

                            @if($displayStatus === 'pending')

                                <span
                                    class="inline-flex items-center gap-1
                                           bg-yellow-100
                                           text-yellow-700
                                           px-3 py-1
                                           rounded-full
                                           text-xs font-medium"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-3.5 h-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
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

                                    Pending

                                </span>


                            {{-- CONFIRMED --}}

                            @elseif($displayStatus === 'confirmed')

                                <span
                                    class="inline-flex items-center gap-1
                                           bg-green-100
                                           text-green-700
                                           px-3 py-1
                                           rounded-full
                                           text-xs font-medium"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-3.5 h-3.5"
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

                                    Confirmed

                                </span>


                            {{-- CHECKED IN --}}

                            @elseif($displayStatus === 'checked_in')

                                <span
                                    class="inline-flex items-center gap-1
                                           bg-orange-100
                                           text-orange-700
                                           px-3 py-1
                                           rounded-full
                                           text-xs font-medium"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-3.5 h-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            d="M12 7v5l3 2"
                                        />

                                    </svg>

                                    Checked In

                                </span>


                            {{-- IN TREATMENT --}}

                            @elseif($displayStatus === 'in_treatment')

                                <span
                                    class="inline-flex items-center gap-1
                                           bg-blue-100
                                           text-blue-700
                                           px-3 py-1
                                           rounded-full
                                           text-xs font-medium"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-3.5 h-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
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


                            {{-- COMPLETED --}}

                            @elseif($displayStatus === 'completed')

                                <span
                                    class="inline-flex items-center gap-1
                                           bg-purple-100
                                           text-purple-700
                                           px-3 py-1
                                           rounded-full
                                           text-xs font-medium"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-3.5 h-3.5"
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

                                    Completed

                                </span>


                            {{-- NO SHOW --}}

                            @elseif($displayStatus === 'no_show')

                                <span
                                    class="inline-flex items-center gap-1
                                           bg-red-100
                                           text-red-700
                                           px-3 py-1
                                           rounded-full
                                           text-xs font-medium"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-3.5 h-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
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


                            {{-- CANCELLED --}}

                            @elseif($displayStatus === 'cancelled')

                                <span
                                    class="inline-flex items-center gap-1
                                           bg-red-100
                                           text-red-700
                                           px-3 py-1
                                           rounded-full
                                           text-xs font-medium"
                                >

                                    Cancelled

                                </span>


                            @else

                                <span class="text-gray-400 text-xs">

                                    N/A

                                </span>

                            @endif

                        </td>



                        <td class="py-5 text-right">

                            @if(
                                in_array(
                                    $displayStatus,
                                    [
                                        'pending',
                                        'confirmed'
                                    ]
                                )
                            )

                        <form
                            action="{{ route('appointments.cancel', $appointment->id) }}"
                            method="POST"
                            class="inline cancel-appointment-form"
                        >
                            @csrf

                            <button
                                type="button"
                                class="open-cancel-modal px-4 py-2 rounded-lg font-medium
                                    bg-pink-500 text-white
                                    hover:bg-pink-600
                                    dark:bg-pink-600
                                    dark:hover:bg-pink-500
                                    transition duration-200"
                            >
                                Cancel
                            </button>
                        </form>

                            @else

                                <span class="text-xs text-gray-300">

                                    N/A

                                </span>

                            @endif

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="4"
                            class="text-center py-10 text-gray-500"
                        >

                            <div class="flex flex-col items-center">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-10 h-10 text-gray-300 mb-3"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
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


                                <p class="font-medium">

                                    No appointments found.

                                </p>

                            </div>

                        </td>

                    </tr>


                @endforelse


            </tbody>

        </table>


        {{-- =========================================================
            PAGINATION
        ========================================================== --}}

        @if($appointmentHistory instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)

            @if($appointmentHistory->hasPages())

                <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-100">


                    {{-- PREVIOUS --}}

                    <div>

                        @if($appointmentHistory->onFirstPage())

                            <span
                                class="px-4 py-2 text-sm text-gray-300 cursor-not-allowed"
                            >

                                ← Previous

                            </span>

                        @else

                            <a
                                href="{{ $appointmentHistory->previousPageUrl() }}"
                                class="px-4 py-2 text-sm text-gray-600 hover:text-custom-pink transition"
                            >

                                ← Previous

                            </a>

                        @endif

                    </div>


                    {{-- PAGE NUMBERS --}}

                    <div class="flex items-center gap-2">

                        @foreach(
                            $appointmentHistory->getUrlRange(
                                1,
                                $appointmentHistory->lastPage()
                            )
                            as $page => $url
                        )

                            @if(
                                $page ==
                                $appointmentHistory->currentPage()
                            )

                                <span
                                    class="w-9 h-9 flex items-center justify-center
                                           rounded-lg bg-custom-pink text-white
                                           text-sm font-semibold"
                                >

                                    {{ $page }}

                                </span>

                            @else

                                <a
                                    href="{{ $url }}"
                                    class="w-9 h-9 flex items-center justify-center
                                           rounded-lg text-gray-500
                                           hover:bg-pink-50
                                           hover:text-custom-pink
                                           text-sm transition"
                                >

                                    {{ $page }}

                                </a>

                            @endif

                        @endforeach

                    </div>

                    <div>

                        @if($appointmentHistory->hasMorePages())

                            <a
                                href="{{ $appointmentHistory->nextPageUrl() }}"
                                class="px-4 py-2 text-sm text-gray-600 hover:text-custom-pink transition"
                            >

                                Next →

                            </a>

                        @else

                            <span
                                class="px-4 py-2 text-sm text-gray-300 cursor-not-allowed"
                            >

                                Next →

                            </span>

                        @endif

                    </div>

                </div>

            @endif

        @endif

    </div>

</section>

<div class="lg:col-span-3 w-full bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

    {{-- HEADER --}}
    <div class="px-8 pt-8 pb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Patient Appointment Balance History
        </h2>
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="px-8 pb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

            <div class="bg-red-50 border border-red-100 rounded-xl p-5">
                <p class="text-sm font-medium text-gray-500">
                    Outstanding Balance
                </p>
                <h3 class="text-2xl font-bold text-red-600 mt-2">
                    ₱{{ number_format($totalOutstanding ?? 0, 2) }}
                </h3>
            </div>

            <div class="bg-green-50 border border-green-100 rounded-xl p-5">
                <p class="text-sm font-medium text-gray-500">
                    Total Paid
                </p>
                <h3 class="text-2xl font-bold text-green-600 mt-2">
                    ₱{{ number_format($totalPaid ?? 0, 2) }}
                </h3>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                <p class="text-sm font-medium text-gray-500">
                    Total Appointments
                </p>
                <h3 class="text-2xl font-bold text-blue-600 mt-2">
                    {{ $totalAppointments ?? 0 }}
                </h3>
            </div>

            <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-5">
                <p class="text-sm font-medium text-gray-500">
                    Pending Payments
                </p>
                <h3 class="text-2xl font-bold text-yellow-600 mt-2">
                    {{ $pendingPayments ?? 0 }}
                </h3>
            </div>

        </div>
    </div>

    {{-- TABLE --}}
    <div class="border-t border-gray-100">

        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <thead class="bg-gray-50">
                    <tr class="border-b border-gray-200">

                        <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Date
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Service
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-gray-500 text-center">
                            Total Fee
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-gray-500 text-center">
                            Amount Paid
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wide text-gray-500 text-center">
                            Balance
                        </th>

                        <th class="px-8 py-4 text-xs font-semibold uppercase tracking-wide text-gray-500 text-center">
                            Status
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">

                    @forelse($appointmentHistory as $appointment)

                        <tr class="hover:bg-gray-50 transition duration-150">

                            <td class="px-8 py-5 whitespace-nowrap font-medium text-gray-700">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                            </td>

                            <td class="px-6 py-5 whitespace-nowrap text-gray-700">
                                {{ $appointment->service?->service_name ?? 'N/A' }}
                            </td>

                            <td class="px-6 py-5 text-center whitespace-nowrap">
                                ₱{{ number_format($appointment->total_amount ?? 0, 2) }}
                            </td>

                            <td class="px-6 py-5 text-center whitespace-nowrap font-medium text-green-600">
                                ₱{{ number_format($appointment->amount_paid ?? 0, 2) }}
                            </td>

                            <td class="px-6 py-5 text-center whitespace-nowrap font-semibold text-red-600">
                                ₱{{ number_format($appointment->balance ?? 0, 2) }}
                            </td>

                            <td class="px-8 py-5 text-center whitespace-nowrap">

                                @if($appointment->payment_status == 'Paid')

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-semibold border border-green-100">
                                        Paid
                                    </span>

                                @elseif($appointment->payment_status == 'Partially Paid')

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-semibold border border-yellow-100">
                                        Partially Paid
                                    </span>

                                @else

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-semibold border border-red-100">
                                        Unpaid
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                No appointment history found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- FOOTER --}}
    <div class="px-8 py-5 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <p class="text-sm text-gray-500">
            Showing historical appointment balances.
        </p>

        <a
            href="{{ route('appointments.history') }}"
            class="inline-flex items-center font-semibold text-sm text-pink-600 hover:text-pink-700 transition"
        >
            View All History
            <span class="ml-2">→</span>
        </a>

    </div>

</div>
    </main>

    <footer class="bg-slate-50 pt-24 pb-12 border-t border-slate-200">
            <div class="pt-8 border-t border-slate-200 text-center text-slate-400 text-xs">
                © 2026 Shine & Smile Systems Dental. | All Rights Reserved.
            </div>
        </div>
    </footer>
<!-- Clear All Notifications Modal -->
<div
    id="clearNotificationsModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 backdrop-blur-sm px-4"
>
    <div
        class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl"
    >
        <div class="flex items-center justify-center mb-4">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100">
                <i data-lucide="trash-2" class="h-7 w-7 text-red-500"></i>
            </div>
        </div>

        <h3 class="text-xl font-bold text-center text-slate-900">
            Clear All Notifications?
        </h3>

        <p class="mt-2 text-center text-sm text-slate-500">
            Are you sure you want to delete all your notifications?
            This action cannot be undone.
        </p>

        <div class="mt-6 flex gap-3">
            <button
                type="button"
                id="cancelClearNotifications"
                class="flex-1 rounded-xl border border-slate-200 px-4 py-3 font-semibold text-slate-600 transition hover:bg-slate-50"
            >
                Cancel
            </button>

            <button
                type="button"
                id="confirmClearNotifications"
                class="flex-1 rounded-xl bg-red-500 px-4 py-3 font-semibold text-white transition hover:bg-red-600"
            >
                Clear All
            </button>
        </div>
    </div>
</div>


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


<div
    id="cancelModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center
           bg-black/50 dark:bg-black/70
           backdrop-blur-sm px-4"
>
    <div
        id="cancelModalContent"
        class="w-full max-w-md
               rounded-2xl
               bg-white dark:bg-[#251C22]
               border border-gray-200 dark:border-gray-700
               shadow-2xl
               transform scale-95 opacity-0
               transition-all duration-200"
    >


        <div
            class="flex items-center justify-between
                   border-b border-gray-100 dark:border-gray-700
                   px-6 py-5"
        >

            <div class="flex items-center gap-3">


                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-full
                           bg-pink-100 dark:bg-pink-900/40"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6
                               text-pink-600 dark:text-pink-400"
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
                </div>

                <div>
                    <h3
                        class="text-lg font-semibold
                               text-gray-900 dark:text-white"
                    >
                        Cancel Appointment
                    </h3>

                    <p
                        class="mt-1 text-xs
                               text-gray-500 dark:text-gray-400"
                    >
                        Cancellation request
                    </p>
                </div>

            </div>

            <button
                type="button"
                id="closeCancelModal"
                class="rounded-lg p-2
                       text-gray-400
                       hover:bg-gray-100
                       hover:text-gray-700
                       dark:hover:bg-[#30252B]
                       dark:hover:text-gray-200
                       transition"
                aria-label="Close modal"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
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

        <form
            id="cancelAppointmentForm"
            method="POST"
            action=""
        >

            @csrf

            <div class="px-6 py-6 space-y-5">

                <div>

                    <p
                        class="text-gray-700 dark:text-gray-200
                               leading-relaxed"
                    >
                        Please tell us why you want to cancel
                        your appointment.
                    </p>

                    <p
                        class="mt-1 text-sm
                               text-gray-500 dark:text-gray-400"
                    >
                        Your cancellation request will be reviewed
                        by the clinic.
                    </p>

                </div>

                <div>

                    <label
                        for="cancellation_reason"
                        class="block mb-2 text-sm font-medium
                               text-gray-700 dark:text-gray-200"
                    >
                        Reason for cancellation
                        <span class="text-pink-600">*</span>
                    </label>

                    <select
                        id="cancellation_reason"
                        name="cancellation_reason"
                        required
                        class="w-full rounded-lg
                               border border-gray-300
                               dark:border-gray-600
                               bg-white dark:bg-[#30252B]
                               px-4 py-2.5
                               text-sm
                               text-gray-700 dark:text-gray-200
                               focus:border-pink-500
                               focus:ring-2 focus:ring-pink-500/20
                               outline-none
                               transition"
                    >

                        <option value="">
                            Select a reason
                        </option>

                        <option value="Schedule conflict">
                            Schedule conflict
                        </option>

                        <option value="Feeling unwell">
                            Feeling unwell
                        </option>

                        <option value="Financial reasons">
                            Financial reasons
                        </option>

                        <option value="Transportation problem">
                            Transportation problem
                        </option>

                        <option value="Personal or family matter">
                            Personal or family matter
                        </option>

                        <option value="Emergency">
                            Emergency
                        </option>

                        <option value="Other">
                            Other
                        </option>

                    </select>

                </div>



                <div>

                    <label
                        for="cancellation_details"
                        class="block mb-2 text-sm font-medium
                               text-gray-700 dark:text-gray-200"
                    >
                        Additional details

                        <span
                            class="font-normal text-gray-400"
                        >
                            (Optional)
                        </span>
                    </label>

                    <textarea
                        id="cancellation_details"
                        name="cancellation_details"
                        rows="4"
                        maxlength="1000"
                        placeholder="Please provide additional details..."
                        class="w-full rounded-lg
                               border border-gray-300
                               dark:border-gray-600
                               bg-white dark:bg-[#30252B]
                               px-4 py-3
                               text-sm
                               text-gray-700 dark:text-gray-200
                               placeholder-gray-400
                               focus:border-pink-500
                               focus:ring-2 focus:ring-pink-500/20
                               outline-none
                               transition
                               resize-none"
                    ></textarea>

                    <div
                        class="mt-1 text-xs
                               text-gray-400"
                    >
                        Maximum 1000 characters.
                    </div>

                </div>

            </div>


            <div
                class="flex justify-end gap-3
                       border-t border-gray-100 dark:border-gray-700
                       px-6 py-4"
            >


                <button
                    type="button"
                    id="cancelModalKeepButton"
                    class="rounded-lg
                           border border-gray-300
                           dark:border-gray-600
                           bg-white dark:bg-[#30252B]
                           px-5 py-2.5
                           text-sm font-medium
                           text-gray-700 dark:text-gray-200
                           transition
                           hover:bg-gray-50
                           dark:hover:bg-[#3A2D34]"
                >
                    No, Keep It
                </button>



                <button
                        type="submit"
                        id="submitCancellationButton"
                        class="rounded-lg
                            bg-pink-600
                            hover:bg-pink-700
                            dark:bg-pink-600
                            dark:hover:bg-pink-500
                            px-5 py-2.5
                            text-sm font-medium
                            text-white
                            transition"
                    >
                        Submit Cancellation
                    </button>

            </div>

        </form>

    </div>
</div>




<div
    id="cancellationSuccessModal"
    class="fixed inset-0 z-[10000] hidden items-center justify-center
           bg-black/50 dark:bg-black/70
           backdrop-blur-sm px-4"
>
    <div
        id="cancellationSuccessModalContent"
        class="w-full max-w-md
               rounded-2xl
               bg-white dark:bg-[#251C22]
               border border-gray-200 dark:border-gray-700
               shadow-2xl
               transform scale-95 opacity-0
               transition-all duration-200"
    >


        <div class="px-6 pt-7 pb-4 text-center">

            <div
                class="mx-auto flex h-14 w-14
                       items-center justify-center
                       rounded-full
                       bg-green-100
                       dark:bg-green-900/30"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8
                           text-green-600
                           dark:text-green-400"
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
            </div>


            <h3
                class="mt-4 text-xl font-semibold
                       text-gray-900 dark:text-white"
            >
                Cancellation Request Sent
            </h3>

        </div>


        <div class="px-6 pb-6 text-center">

            <p
                class="text-gray-600
                       dark:text-gray-300
                       leading-relaxed"
            >
                Your appointment cancellation has been sent
                successfully.
            </p>

            <p
                class="mt-2 text-sm
                       text-gray-500 dark:text-gray-400"
            >
                Please wait while the clinic reviews your request.
                Your appointment will remain scheduled until the
                clinic makes a decision.
            </p>

        </div>


        <div
            class="border-t border-gray-100
                   dark:border-gray-700
                   px-6 py-4"
        >

            <button
                type="button"
                id="closeCancellationSuccessModal"
                class="w-full rounded-lg
                       bg-pink-600
                       hover:bg-pink-700
                       dark:bg-pink-600
                       dark:hover:bg-pink-500
                       px-5 py-2.5
                       text-sm font-medium
                       text-white
                       transition"
            >
                OK, Got It
            </button>

        </div>

    </div>
</div>



    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
<script src="{{ asset('js/appointment/appointment.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/appointment/patient-theme.js') }}"></script>

<script>

</script>

</script>
</body>
</html>
