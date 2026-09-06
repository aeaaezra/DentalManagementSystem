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
    <link rel="stylesheet" href="{{ asset('css/appointment/patient-theme.css') }}">
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

   <!-- Notification + Profile -->
<div class="flex items-center gap-4">

    <!-- NOTIFICATION WRAPPER -->
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
                ->where('is_read', false)
                ->count();

            $readNotifications = $notifications
                ->where('is_read', true)
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
                        $isUnread = !$notification->is_read;
                        $title = $notification->data['title'] ?? 'Notification';
                        $message = $notification->data['message'] ?? 'No message available.';
                        $lowerTitle = strtolower($title);
                    @endphp

                    <div
                        class="notification-item p-4 transition-colors hover:bg-pink-50/40 flex items-start gap-3 relative group {{ $isUnread ? 'bg-pink-50/30' : 'bg-white' }}"
                        data-notification-id="{{ $notification->id }}"
                        data-notification-status="{{ $isUnread ? 'unread' : 'read' }}"
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


        <!-- ============================================================
             CLEAR ALL CONFIRMATION MODAL
             ============================================================ -->
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
<!-- PROFILE -->

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

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid lg:grid-cols-4 gap-12 mb-20">

                <div class="col-span-2">

                    <div class="flex items-center gap-3 mb-8">

                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 40 40"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M20 2L2 10V20C2 28.5 8.5 36.2 20 38C31.5 36.2 38 28.5 38 20V10L20 2Z"
                                fill="#DB2777"
                            />

                            <path
                                d="M20 38C26 36.5 31 32 34.5 26.5L20 20V38Z"
                                fill="#BE185D"
                            />

                            <path
                                d="M20 8L21.5 14.5L28 16L21.5 17.5L20 24L18.5 17.5L12 16L18.5 14.5L20 8Z"
                                fill="white"
                            />
                        </svg>

                        <span class="text-xl font-extrabold tracking-tight text-slate-900">
                            Shine & Smile
                        </span>

                    </div>

                    <p class="text-slate-500 max-w-sm mb-8 leading-relaxed">
                        Redefining dental practice management with a focus on clinician efficiency and patient outcomes.
                    </p>

                </div>


                <!-- PLATFORM -->

                <div>

                    <h4 class="font-bold text-slate-900 mb-6 uppercase text-xs tracking-widest">
                        Platform
                    </h4>

                    <ul class="space-y-4 text-slate-500 text-sm font-medium">

                        <li>
                            <a
                                href="#"
                                class="hover:text-pink-600 transition-colors"
                            >
                                Clinical Records
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="hover:text-pink-600 transition-colors"
                            >
                                Billing Engine
                            </a>
                        </li>

                    </ul>

                </div>


                <!-- COMPANY -->

                <div>

                    <h4 class="font-bold text-slate-900 mb-6 uppercase text-xs tracking-widest">
                        Company
                    </h4>

                    <ul class="space-y-4 text-slate-500 text-sm font-medium">

                        <li>
                            <a
                                href="#"
                                class="hover:text-pink-600 transition-colors"
                            >
                                Our Mission
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="hover:text-pink-600 transition-colors"
                            >
                                Privacy
                            </a>
                        </li>

                    </ul>

                </div>

            </div>


            <!-- COPYRIGHT -->

            <div class="pt-8 border-t border-slate-200 text-center text-slate-400 text-xs">

                © 2025 Shine & Smile Systems Inc. | All Rights Reserved.

            </div>

        </div>

    </footer>


<!-- ============================================================
     LOGOUT CONFIRMATION MODAL
     ============================================================ -->

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

<script>
    window.notificationRoutes = {
        readAll: @json(route('notifications.readAll')),
        clearAll: @json(route('notifications.clearAll'))
    };
</script>


<script src="{{ asset('js/history.js') }}"></script>


</body>

</html>
