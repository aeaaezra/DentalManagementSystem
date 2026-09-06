<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shine & Smile Dental | Creating Healthy, Beautiful Smiles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@600;700&display=swap"  rel="stylesheet"  >
    <link  href="{{ asset('css/appointment/booking.css') }}"  rel="stylesheet"  >
    <link  rel="stylesheet"   href="{{ asset('css/appointment/patient-theme.css') }}" >
    <link  rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" >

</head>

<body>

<nav class="main-navbar fixed top-0 left-0 w-full z-[99999]">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo + Mobile Menu -->
        <div class="flex items-center gap-3">
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


<div class="hidden md:flex items-center gap-10 mx-auto">

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

<div class="flex items-center gap-4 relative">

    <div class="notification-wrapper">

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
        <div
            id="notificationDropdown"
            class="hidden absolute right-0 mt-3 w-80 sm:w-96 bg-white rounded-2xl shadow-2xl border border-pink-100 overflow-hidden z-[999999] origin-top-right"
        >

            <!-- HEADER -->
            <div class="p-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white">

                <div class="flex items-center justify-between gap-3">

                    <div class="flex items-center gap-3 min-w-0">

                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
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
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                />
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h3 class="font-bold text-lg truncate">
                                    Notifications
                                </h3>

                                <span class="bg-white/20 text-white text-xs px-2 py-0.5 rounded-full font-semibold whitespace-nowrap">
                                    {{ $unreadNotifications }} New
                                </span>
                            </div>

                            <p class="text-xs text-pink-100 mt-0.5">
                                Stay updated with your appointments
                            </p>
                        </div>

                    </div>

                    <button
                        id="closeNotificationBtn"
                        type="button"
                        aria-label="Close notifications"
                        class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-white/20 transition flex-shrink-0"
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
            </div>

            <!-- FILTER BAR -->
            <div class="flex border-b border-pink-100 bg-pink-50/50 px-3 pt-2 text-xs font-medium text-gray-500">

                <button
                    type="button"
                    class="notification-filter active pb-2 px-3 border-b-2 border-pink-500 text-pink-600 font-semibold transition-all"
                    data-filter="all"
                >
                    All {{ $totalNotifications }}
                </button>

                <button
                    type="button"
                    class="notification-filter pb-2 px-3 border-b-2 border-transparent hover:text-pink-600 transition-all"
                    data-filter="unread"
                >
                    Unread {{ $unreadNotifications }}
                </button>

                <button
                    type="button"
                    class="notification-filter pb-2 px-3 border-b-2 border-transparent hover:text-pink-600 transition-all"
                    data-filter="read"
                >
                    Read {{ $readNotifications }}
                </button>

                @if($totalNotifications > 0)
                    <button
                        id="clearAllNotifications"
                        type="button"
                        class="ml-auto pb-2 px-3 text-red-500 hover:text-red-600 transition-colors whitespace-nowrap"
                        title="Delete all notifications"
                         data-clear-url="{{ route('notifications.clearAll') }}"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-3.5 h-3.5 inline-block mr-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 01-1-1h-4a1 1 0 01-1 1v3m-4 0h14"
                            />
                        </svg>
                        Clear all
                    </button>
                @endif
            </div>

            <!-- NOTIFICATION LIST -->
            <div
                id="notificationList"
                class="notification-scroll max-h-[360px] overflow-y-auto divide-y divide-pink-50"
            >

                @forelse($notifications as $notification)

                    @php
                        $isUnread = !$notification->read_at;
                        $title = $notification->data['title'] ?? 'Notification';
                        $message = $notification->data['message'] ?? 'No message available.';
                        $lowerTitle = strtolower($title);
                    @endphp

                    <div
                        class="notification-item group relative px-4 py-4 border-b border-gray-100 bg-white hover:bg-pink-50/50 transition-all duration-200"
                        data-notification-id="{{ $notification->id }}"
                        data-notification-status="{{ is_null($notification->read_at) ? 'unread' : 'read' }}"
                    >

                        @if($isUnread)
                            <span
                                class="absolute left-2 top-5 w-2 h-2 rounded-full bg-pink-500 ring-2 ring-white"
                                title="Unread"
                            ></span>
                        @endif

                        <!-- ICON -->
                        <div
                            class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center shadow-sm
                            @if(str_contains($lowerTitle, 'cancel'))
                                bg-red-100 text-red-500
                            @elseif(str_contains($lowerTitle, 'confirm') || str_contains($lowerTitle, 'approved'))
                                bg-blue-100 text-blue-600
                            @elseif(str_contains($lowerTitle, 'payment'))
                                bg-emerald-100 text-emerald-600
                            @else
                                bg-pink-100 text-pink-600
                            @endif"
                        >

                            @if(str_contains($lowerTitle, 'cancel'))

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>

                            @elseif(str_contains($lowerTitle, 'confirm') || str_contains($lowerTitle, 'approved'))

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>

                            @elseif(str_contains($lowerTitle, 'payment'))

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>

                            @endif
                        </div>

                        <!-- CONTENT -->
                        <div class="flex-1 min-w-0 pr-7">

                            <h4 class="text-xs font-semibold text-gray-800 truncate">
                                {{ $title }}
                            </h4>

                            <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                                {{ $message }}
                            </p>

                            <div class="flex items-center gap-1.5 mt-2 text-[10px] text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                <span>
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>

                        </div>

                        <!-- DELETE -->
                        <button
                            type="button"
                            class="delete-notification absolute right-3 top-4 opacity-70 group-hover:opacity-100 w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all duration-200"
                            data-notification-id="{{ $notification->id }}"
                            data-delete-url="{{ route('notifications.destroy', $notification->id) }}"
                            title="Delete notification"
                            aria-label="Delete notification"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 01-1-1h-4a1 1 0 01-1 1v3m-4 0h14" />
                            </svg>
                        </button>

                    </div>

                @empty

                    <div
                        id="noNotificationsMessage"
                        class="py-12 px-4 text-center"
                    >
                        <div class="w-12 h-12 bg-pink-50 text-pink-400 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>

                        <p class="text-sm font-medium text-gray-600">
                            No notifications found
                        </p>

                        <p class="text-xs text-gray-400 mt-0.5">
                            You're all caught up for now!
                        </p>
                    </div>

                @endforelse

            </div>

            <!-- FOOTER -->
            @if($totalNotifications > 0)
                <div class="p-3 bg-pink-50/50 border-t border-pink-100 text-center">

                    <a
                        href="{{ route('appointments.history') }}"
                        class="text-xs font-semibold text-pink-600 hover:text-pink-700 hover:underline py-1 px-3 rounded-lg transition-colors"
                    >
                        View appointment history

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-3 h-3 inline-block ml-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                </div>
            @endif



        <div
            id="clearNotificationsConfirmModal"
            class="notification-modal hidden"
            role="dialog"
            aria-modal="true"
            aria-labelledby="clearNotificationsConfirmTitle"
        >
            <div
                class="notification-modal-backdrop"
                data-close-clear-modal
            ></div>

            <div class="notification-modal-card">

                <div class="notification-modal-icon warning">
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
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.82 13a2 2 0 001.71 3h15.64a2 2 0 001.71-3l-7.82-13a2 2 0 00-3.42 0z"
                        />
                    </svg>
                </div>

                <h3 id="clearNotificationsConfirmTitle">
                    Clear all notifications?
                </h3>

                <p>
                    Are you sure you want to clear all notifications?
                    This action cannot be undone.
                </p>

                <div class="notification-modal-actions">

                    <button
                        type="button"
                        id="cancelClearNotifications"
                        class="notification-modal-btn cancel"
                    >
                        Cancel
                    </button>

                    <button
                        type="button"
                        id="confirmClearNotifications"
                        class="notification-modal-btn danger"
                    >
                        Yes, clear all
                    </button>

                </div>
            </div>
        </div>


        <!-- ============================================================
             CLEAR ALL SUCCESS MODAL
             ============================================================ -->
        <div
            id="clearNotificationsSuccessModal"
            class="notification-modal hidden"
            role="dialog"
            aria-modal="true"
            aria-labelledby="clearNotificationsSuccessTitle"
        >
            <div class="notification-modal-backdrop"></div>

            <div class="notification-modal-card success-card">

                <div class="notification-modal-icon success">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7"
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

                <h3 id="clearNotificationsSuccessTitle">
                    Notifications cleared
                </h3>

                <p>
                    All of your notifications have been successfully cleared.
                </p>

                <button
                    type="button"
                    id="closeClearNotificationsSuccess"
                    class="notification-modal-btn success"
                >
                    Done
                </button>

            </div>
        </div>

        </div>

    </div>
</div>


<!-- Profile Dropdown -->

                <div class="relative">

                    <button
                        id="profileBtn"
                        type="button"
                        class="flex items-center gap-2 focus:outline-none"
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

                        <!-- SETTINGS -->

                        <a
                            href="{{ route('appointments.settings', ['return' => url()->current()]) }}"
                            class="flex items-center gap-3 px-3 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                            >
                                <path d="M19.14,12.94a7.49,7.49,0,0,0,.05-.94,7.49,7.49,0,0,0-.05-.94l2.03-1.58a.5.5,0,0,0,.12-.64l-1.92-3.32a.5.5,0,0,0-.6-.22l-2.39.96a7.28,7.28,0,0,0-1.63-.94L14.4,2.81A.5.5,0,0,0,13.91,2H10.09a.5.5,0,0,0-.49.81L9.25,5.32a7.28,7.28,0,0,0-1.63.94l-2.39-.96a.5.5,0,0,0-.6.22L2.71,8.84a.5.5,0,0,0,.12.64L4.86,11.06a7.49,7.49,0,0,0-.05.94,7.49,7.49,0,0,0,.05.94l-2.03,1.58a.5.5,0,0,0-.12.64l1.92,3.32a.5.5,0,0,0,.6.22l2.39-.96a7.28,7.28,0,0,0,1.63.94l.35,2.51a.5.5,0,0,0,.49.41h3.82a.5.5,0,0,0,.49-.41l.35-2.51a7.28,7.28,0,0,0,1.63-.94l2.39.96a.5.5,0,0,0,.6-.22l1.92-3.32a.5.5,0,0,0-.12-.64ZM12,15.5A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/>
                            </svg>

                            <span>Settings</span>

                        </a>

                        <!-- LOGOUT -->

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
                                d="M17 16l4-4m0 0l-4-4m4 4H7"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12h4"
                            />
                        </svg>

                        <span>Logout</span>
                    </button>
                </form>

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

        <form
            method="POST"
            action="{{ route('logout') }}"
        >
            @csrf

            <button
                type="submit"
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

    {{-- =========================================================
        HEADER
    ========================================================== --}}

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


    {{-- =========================================================
        APPOINTMENT TABLE
    ========================================================== --}}

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


                            {{-- UNKNOWN --}}

                            @else

                                <span class="text-gray-400 text-xs">

                                    N/A

                                </span>

                            @endif

                        </td>


                        {{-- =================================================
                            ACTION
                        ================================================== --}}

                        <td class="py-5 text-right">


                            {{-- CANCEL --}}

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
                                    action="{{
                                        route(
                                            'appointments.cancel',
                                            $appointment->id
                                        )
                                    }}"
                                    method="POST"
                                    class="inline"
                                >

                                    @csrf


                                    <button
                                        type="submit"
                                        onclick="return confirm('Cancel this appointment?')"
                                        class="text-red-500 hover:text-red-700 hover:underline text-sm font-medium"
                                    >

                                        Cancel

                                    </button>

                                </form>


                            {{-- NO ACTION --}}

                            @else

                                <span class="text-xs text-gray-300">

                                    N/A

                                </span>

                            @endif

                        </td>

                    </tr>


                @empty


                    {{-- =================================================
                        NO APPOINTMENTS
                    ================================================== --}}

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


                    {{-- NEXT --}}

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


<div
    id="logoutModal"
    class="logout-modal"
    aria-hidden="true"
>

    <div
        id="logoutModalOverlay"
        class="logout-modal-overlay"
    ></div>


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
                type="submit"
                form="logoutForm"
                id="confirmLogout"
                class="logout-confirm-btn"
            >
                Logout
            </button>

        </div>

    </div>

</div>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
    <script src="{{ asset('js/appointment.js') }}"></script>
    <script src="{{ asset('js/patient-theme.js') }}"></script>


</body>
</html>
