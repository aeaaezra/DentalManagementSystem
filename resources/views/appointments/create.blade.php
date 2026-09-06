    <!DOCTYPE html>
    <html lang="en" class="scroll-smooth">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Shine & Smile Dental | Creating Healthy, Beautiful Smiles</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/appointment/booking.css') }}">
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
        <link rel="stylesheet" href="{{ asset('css/appointment/patient-theme.css') }}">
    <script src="{{ asset('js/patient-theme.js') }}"></script>

    </head>
    <body>


    <nav class="main-navbar fixed top-0 left-0 w-full z-[99999]">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <!-- Logo + Burger -->
            <div class="relative flex items-center gap-4">

                <div class="text-2xl font-bold text-[#E91E63]">
                    Shine & Smile
                </div>
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

  <!-- Notification + Profile -->
        <div class="flex items-center relative">
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

    <!-- Profile Dropdown -->
    <div class="relative">

        <button id="profileBtn"
            type="button"
            class="flex items-center gap-2 focus:outline-none">

        <img
        src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/default-profile.png') }}"
        alt="Profile"
        class="w-10 h-10 rounded-full border-2 border-pink-500 object-cover">

            <div class="hidden md:block text-left">
                <p class="text-sm font-semibold text-gray-800">
        {{ Auth::user()->name }}
    </p>
                <p class="text-xs text-gray-500">
                    Patient
                </p>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 text-gray-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7" />
            </svg>

        </button>

        <!-- Dropdown Menu -->
    <div id="profileMenu"
        class="hidden absolute right-0 mt-3 w-52 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-[9999]">

        <!-- Settings -->
        <a href="{{ route('appointments.settings', [ 'return' => url()->current() ]) }}"
        class="flex items-center gap-3 px-2 py-2 text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition">

        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            viewBox="0 0 24 24"
            fill="currentColor">

        <path d="M19.14,12.94a7.49,7.49,0,0,0,.05-.94,7.49,7.49,0,0,0-.05-.94l2.03-1.58a.5.5,0,0,0,.12-.64l-1.92-3.32a.5.5,0,0,0-.6-.22l-2.39.96a7.28,7.28,0,0,0-1.63-.94L14.4,2.81A.5.5,0,0,0,13.91,2H10.09a.5.5,0,0,0-.49.81L9.25,5.32a7.28,7.28,0,0,0-1.63.94l-2.39-.96a.5.5,0,0,0-.6.22L2.71,8.84a.5.5,0,0,0,.12.64L4.86,11.06a7.49,7.49,0,0,0-.05.94,7.49,7.49,0,0,0,.05.94L2.83,14.52a.5.5,0,0,0-.12.64l1.92,3.32a.5.5,0,0,0,.6.22l2.39-.96a7.28,7.28,0,0,0,1.63.94l.35,2.51a.5.5,0,0,0,.49.41h3.82a.5.5,0,0,0,.49-.41l.35-2.51a7.28,7.28,0,0,0,1.63-.94l2.39.96a.5.5,0,0,0,.6-.22l1.92-3.32a.5.5,0,0,0-.12-.64ZM12,15.5A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/>
    </svg>

            <span>Settings</span>
        </a>

        <!-- Logout -->
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



    <div class="booking-container">
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>Dental Appointment Tracker</h2>

    <div class="tracker">

        <!-- STEP 1 -->
        <div class="tracker-step active" id="tracker-step-1">
            <div class="circle">1</div>
            <span>Form</span>
        </div>

        <!-- STEP 2 -->
        <div class="tracker-step" id="tracker-step-2">
            <div class="circle">2</div>
            <span>Summary</span>
        </div>

        <!-- STEP 3 -->
        <div class="tracker-step" id="tracker-step-3">
            <div class="circle">3</div>
            <span>Confirmed</span>
        </div>

    </div>

        <form method="POST"
            action="{{ route('appointments.store') }}"
            enctype="multipart/form-data">

            @csrf



            <!-- STEP 1 -->
        <div class="form-step active" id="step1">

        <!-- PATIENT INFORMATION -->
        <div class="section-card">

            <h3 class="section-title">
                Patient Information
            </h3>

            <div class="form-grid">

                <div class="form-group">
                    <label>Full Name</label>

                    <input
                        type="text"
                        name="patient_name"
                        value="{{ auth()->user()->name }}"
                        readonly
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input type="number"
                        name="age"
                        value="{{ old('age') }}">
                </div>

                <div class="form-group">
                    <label>Sex</label>
                    <select name="sex">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="form-group">

                <label>Civil Status</label>

                <select name="civil_status">

                    <option value="">Select Civil Status</option>

                    <option value="Single"
                        {{ old('civil_status') == 'Single' ? 'selected' : '' }}>
                        Single
                    </option>

                    <option value="Married"
                        {{ old('civil_status') == 'Married' ? 'selected' : '' }}>
                        Married
                    </option>

                    <option value="Widowed"
                        {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>
                        Widowed
                    </option>

                    <option value="Separated"
                        {{ old('civil_status') == 'Separated' ? 'selected' : '' }}>
                        Separated
                    </option>

                    <option value="Divorced"
                        {{ old('civil_status') == 'Divorced' ? 'selected' : '' }}>
                        Divorced
                    </option>

                </select>

            </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text"
                        name="tel_no"
                        value="{{ old('tel_no') }}">
                </div>

            <div class="form-group">

                <label>Occupation</label>

                <select name="occupation">

                    <option value="">Select Occupation</option>

                    <option value="Student"
                        {{ old('occupation') == 'Student' ? 'selected' : '' }}>
                        Student
                    </option>

                    <option value="Employed"
                        {{ old('occupation') == 'Employed' ? 'selected' : '' }}>
                        Employed
                    </option>

                    <option value="Self-Employed"
                        {{ old('occupation') == 'Self-Employed' ? 'selected' : '' }}>
                        Self-Employed
                    </option>

                    <option value="Business Owner"
                        {{ old('occupation') == 'Business Owner' ? 'selected' : '' }}>
                        Business Owner
                    </option>

                    <option value="Government Employee"
                        {{ old('occupation') == 'Government Employee' ? 'selected' : '' }}>
                        Government Employee
                    </option>

                    <option value="Private Employee"
                        {{ old('occupation') == 'Private Employee' ? 'selected' : '' }}>
                        Private Employee
                    </option>

                    <option value="Unemployed"
                        {{ old('occupation') == 'Unemployed' ? 'selected' : '' }}>
                        Unemployed
                    </option>

                    <option value="Retired"
                        {{ old('occupation') == 'Retired' ? 'selected' : '' }}>
                        Retired
                    </option>

                    <option value="Other"
                        {{ old('occupation') == 'Other' ? 'selected' : '' }}>
                        Other
                    </option>

                </select>

            </div>

            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="address">{{ old('address') }}</textarea>
            </div>

                <div class="signature-section">

        <div class="signature-actions">

            <button
                type="button"
                class="add-signature-button"
                id="addSignatureButton"
            >
                Add Signature
            </button>

            <button
                type="button"
                class="clear-signature-button"
                id="clearSignatureButton"
            >
                Clear Signature
            </button>

        </div>

        <div
            class="signature-preview"
            id="signaturePreview"
        >

            <img
                id="signatureImage"
                src=""
                alt="Patient Signature"
                style="display: none;"
            >

            <span id="signaturePlaceholder">
                No signature added
            </span>

        </div>

        <div class="signature-line">

            <div></div>

            <span>
                Patient / Guardian Signature
            </span>

        </div>

        <input
            type="hidden"
            name="patient_signature"
            id="patientSignature"
        >

    </div>
        </div>

        <!-- MEDICAL HISTORY -->
<div class="section-card">

    <h3 class="section-title">
        Medical History
    </h3>

    <div class="medical-grid">

        <div class="medical-item">

            <label class="checkbox-label">

                <input
                    type="checkbox"
                    name="heart_condition"
                    value="1"
                >

                Heart Condition

            </label>

            <input
                type="text"
                name="heart_condition_details"
                placeholder="Provide details"
            >

        </div>

        <div class="medical-item">

            <label class="checkbox-label">

                <input
                    type="checkbox"
                    name="allergy"
                    value="1"
                >

                Allergy

            </label>

            <input
                type="text"
                name="allergy_details"
                placeholder="Provide details"
            >

        </div>

        <div class="medical-item">

            <label class="checkbox-label">

                <input
                    type="checkbox"
                    name="diabetes"
                    value="1"
                >

                Diabetes

            </label>

            <input
                type="text"
                name="diabetes_details"
                placeholder="Provide details"
            >

        </div>

        <div class="medical-item">

            <label class="checkbox-label">

                <input
                    type="checkbox"
                    name="hypertension"
                    value="1"
                >

                Hypertension / High Blood Pressure

            </label>

            <input
                type="text"
                name="hypertension_details"
                placeholder="Provide details"
            >

        </div>

        <div class="medical-item">

            <label class="checkbox-label">

                <input
                    type="checkbox"
                    name="bleeding_tendency"
                    value="1"
                >

                Bleeding Tendency

            </label>

            <input
                type="text"
                name="bleeding_tendency_details"
                placeholder="Provide details"
            >

        </div>

        <div class="medical-item">

            <label class="checkbox-label">

                <input
                    type="checkbox"
                    name="asthma"
                    value="1"
                >

                Asthma

            </label>

            <input
                type="text"
                name="asthma_details"
                placeholder="Provide details"
            >

        </div>

    </div>

    <div class="form-group">

        <label>
            Other Diseases / Abnormalities & Treatments
        </label>

        <textarea
            name="other_conditions"
            placeholder="Provide additional medical information..."
        ></textarea>

    </div>



</div>

        <!-- APPOINTMENT DETAILS -->

        <div class="section-card" >

            <h3 class="section-title">
                Appointment Details
            </h3>
<div class="form-group">

    <label for="service_id">Dental Service</label>

    <select name="service_id" id="service_id" required>

        <option value="">Select Service</option>

        @foreach($services as $service)

            <option
                value="{{ $service->id }}"
                data-duration="{{ $service->duration_minutes ?? 0 }}"
                data-price="{{ $service->price }}"
            >
                {{ $service->service_name }}
                (₱{{ number_format($service->price, 2) }}
                - {{ $service->duration_minutes ?? 0 }} minutes)
            </option>

        @endforeach

    </select>

</div>

            <div class="form-grid">

                <div class="form-group">
                    <label>Appointment Date</label>
                    <input type="date" id="date"
                        name="appointment_date"
                        onchange="loadSlots(this.value)"
                        required>
                </div>

                <div class="form-group">
                    <label>Available Time Slots</label>
                    <div id="slots" class="slots-container">
                        <small>Select a date first</small>
                    </div>
                </div>

                <!-- Hidden inputs -->
                <input type="hidden" name="appointment_time" id="start_time">
                <input type="hidden" name="end_time" id="end_time">

            </div>

            <div class="form-group">
                <label>Reason for Visit</label>
                <textarea name="reason"></textarea>
            </div>

        </div>

        <div class="btn-group">
            <a
                href="{{ route('appointments.homepage') }}"
                class="btn-prev"
            >
                <span class="arrow">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <polyline points="15 18 9 12 15 6"></polyline>

                    </svg>

                </span>

                <span>
                    Previous
                </span>

            </a>

    <button type="button"
            class="btn-next"
            onclick="nextStep()">

        <span>Next</span>

        <span class="arrow">
            <svg xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="3"
                stroke-linecap="round"
                stroke-linejoin="round">

                <polyline points="9 18 15 12 9 6"></polyline>

            </svg>
        </span>

    </button>
        </div>


    </div>

    <!-- ============================= -->
    <!-- STEP 2: APPOINTMENT SUMMARY -->
    <!-- ============================= -->

    <div class="form-step" id="step2">

        <!-- Summary Header -->
        <div class="summary-header">
            <div class="summary-header-icon">
                ✓
            </div>

            <div>
                <h2>Review Your Appointment</h2>
                <p>
                    Please check all the information below before saving your appointment.
                </p>
            </div>
        </div>


        <!-- ============================= -->
        <!-- PATIENT INFORMATION -->
        <!-- ============================= -->

        <div class="summary-card">

            <div class="summary-card-header">
                <div>
                    <span class="summary-number">01</span>
                    <div>
                        <h3>Patient Information</h3>
                        <p>Personal information provided</p>
                    </div>
                </div>

                <button type="button"
                        class="summary-edit"
                        onclick="previousStep()">
                    Edit
                </button>
            </div>


            <div class="summary-grid">

                <div class="summary-item">
                    <span>Full Name</span>
                    <strong id="summary_patient_name">—</strong>
                </div>

                <div class="summary-item">
                    <span>Age</span>
                    <strong id="summary_age">—</strong>
                </div>

                <div class="summary-item">
                    <span>Sex</span>
                    <strong id="summary_sex">—</strong>
                </div>

                <div class="summary-item">
                    <span>Civil Status</span>
                    <strong id="summary_civil_status">—</strong>
                </div>

                <div class="summary-item">
                    <span>Contact Number</span>
                    <strong id="summary_tel_no">—</strong>
                </div>

                <div class="summary-item">
                    <span>Occupation</span>
                    <strong id="summary_occupation">—</strong>
                </div>

                <div class="summary-item full">
                    <span>Address</span>
                    <strong id="summary_address">—</strong>
                </div>

            </div>

        </div>


        <!-- ============================= -->
        <!-- MEDICAL HISTORY -->
        <!-- ============================= -->

        <div class="summary-card">

            <div class="summary-card-header">

                <div>
                    <span class="summary-number">02</span>

                    <div>
                        <h3>Medical History</h3>
                        <p>Health information provided</p>
                    </div>
                </div>

                <button type="button"
                        class="summary-edit"
                        onclick="previousStep()">
                    Edit
                </button>

            </div>


            <div class="medical-summary-grid">

                <div class="medical-summary-item">
                    <span>Heart Condition</span>
                    <strong id="summary_heart_condition">No</strong>
                </div>

                <div class="medical-summary-item">
                    <span>Allergy</span>
                    <strong id="summary_allergy">No</strong>
                </div>

                <div class="medical-summary-item">
                    <span>Diabetes</span>
                    <strong id="summary_diabetes">No</strong>
                </div>

                <div class="medical-summary-item">
                    <span>Hypertension</span>
                    <strong id="summary_hypertension">No</strong>
                </div>

                <div class="medical-summary-item">
                    <span>Bleeding Tendency</span>
                    <strong id="summary_bleeding_tendency">No</strong>
                </div>

                <div class="medical-summary-item">
                    <span>Asthma</span>
                    <strong id="summary_asthma">No</strong>
                </div>

            </div>


            <div class="summary-large-item">

                <span>Other Diseases / Treatments</span>

                <strong id="summary_other_conditions">
                    None
                </strong>

            </div>

        </div>


<div class="appointment-highlight">

    <div class="appointment-icon">

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="22"
            height="22"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <circle cx="12" cy="12" r="9"></circle>
            <polyline points="12 7 12 12 15 15"></polyline>
        </svg>

    </div>

    <div>

        <span>Appointment Time</span>

        <strong id="summary_time">
            —
        </strong>

        <small id="summary_duration">
            —
        </small>

    </div>

</div>
<div class="appointment-highlight">

    <div class="appointment-icon">

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="22"
            height="22"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
        >
            <rect
                x="3"
                y="4"
                width="18"
                height="18"
                rx="2"
            ></rect>

            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>

        </svg>

    </div>

    <div>

        <span>Appointment Date</span>

        <strong id="summary_date">
            —
        </strong>

    </div>

</div>
        <!-- ============================= -->
        <!-- FINAL REVIEW NOTICE -->
        <!-- ============================= -->

        <div class="final-review-box">

            <div class="final-review-icon">
                !
            </div>

            <div>

                <h4>Final Review</h4>

                <p>
                    Please review your information carefully.
                    This summary is provided to help prevent errors
                    in your appointment details.
                </p>

                <p>
                    If you find anything incorrect, click
                    <strong>Previous</strong> to edit your information.
                </p>

            </div>

        </div>


        <!-- ============================= -->
        <!-- SUMMARY BUTTONS -->
        <!-- ============================= -->

    <div class="summary-buttons">

        <button type="button"
                class="btn-previous"
                onclick="previousStep()">

            <span class="arrow">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="3"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </span>

            <span>Previous</span>

        </button>


        <button
        type="button"
        class="btn-save"
        id="openSubmitModalBtn"
    >
        <span>
            Save Appointment
        </span>

        <span class="save-icon">
            ✓
        </span>
    </button>

    </div>
    </div>

    </form>
  <div id="submitModal" class="submit-modal">

    <div
        class="submit-modal-overlay"
        id="submitModalOverlay"
    ></div>

    <div class="submit-modal-content">

        <div class="submit-modal-icon">
            ?
        </div>

        <h2>Confirm Submission</h2>

        <p>
            Are you sure you want to submit your appointment?
        </p>

        <div class="submit-modal-buttons">

            <button
                type="button"
                class="modal-cancel-btn"
                id="cancelSubmitBtn"
            >
                Cancel
            </button>

            <button
                type="button"
                class="modal-confirm-btn"
                id="confirmSubmitBtn"
            >
                Yes, Submit
            </button>

        </div>

    </div>

</div>

<div
    class="signature-modal"
    id="signatureModal"
    aria-hidden="true"
>
    <div
        class="signature-modal-overlay"
        id="signatureModalOverlay"
    ></div>

    <div
        class="signature-modal-content"
        role="dialog"
        aria-modal="true"
        aria-labelledby="signatureModalTitle"
    >

        <div class="signature-modal-header">

            <div>

                <span class="signature-modal-label">
                    PATIENT RECORD
                </span>

                <h2 id="signatureModalTitle">
                    Add Signature
                </h2>

                <p>
                    Please sign inside the box below.
                </p>

            </div>

            <button
                type="button"
                class="signature-modal-close"
                id="closeSignatureModal"
                aria-label="Close"
            >
                ×
            </button>

        </div>

        <div class="signature-pad-wrapper">

            <canvas
                id="signatureCanvas"
                class="signature-canvas"
            ></canvas>

            <div
                class="signature-canvas-placeholder"
                id="signatureCanvasPlaceholder"
            >
                Sign here
            </div>

        </div>

        <div class="signature-modal-footer">

            <button
                type="button"
                class="signature-reset-button"
                id="resetSignatureButton"
            >
                Clear
            </button>

            <div class="signature-modal-actions">

                <button
                    type="button"
                    class="signature-cancel-button"
                    id="cancelSignatureButton"
                >
                    Cancel
                </button>

                <button
                    type="button"
                    class="signature-save-button"
                    id="saveSignatureButton"
                >
                    Save Signature
                </button>

            </div>

        </div>

    </div>

</div>

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

    <script src="{{ asset('js/booking.js') }}"></script>
    </body>
    </html>
