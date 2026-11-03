<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Laravel') }}
    </title>


    {{-- =========================================================
         FONTS
    ========================================================== --}}

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"
    />


    {{-- =========================================================
         FAVICON
    ========================================================== --}}

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/favicon.png') }}"
    >


    {{-- =========================================================
         ALPINE CLOAK
    ========================================================== --}}

    <style>
        [x-cloak] {
            display: none !important;
        }

        /*
        Prevent SVGs from becoming unexpectedly large
        if another stylesheet overrides their dimensions.
        */
        .notification-button svg {
            width: 23px;
            height: 23px;
            min-width: 23px;
            min-height: 23px;
        }

        .profile-chevron {
            width: 18px;
            height: 18px;
            min-width: 18px;
            min-height: 18px;
        }
    </style>


    {{-- =========================================================
         VITE
    ========================================================== --}}

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body
    class="font-sans antialiased
           bg-gray-100 dark:bg-gray-900
           text-gray-900 dark:text-gray-100"
>

    <div
        class="min-h-screen
               bg-gray-100 dark:bg-gray-900"
    >


        {{-- =====================================================
             NAVIGATION
        ====================================================== --}}

        <nav
            class="bg-white dark:bg-gray-800
                   shadow px-6 py-4
                   flex justify-between items-center
                   border-b border-gray-200
                   dark:border-gray-700"
        >


            {{-- =================================================
                 LEFT SIDE / LOGO
            ================================================== --}}

            <div class="flex items-center">

                <h1
                    class="font-bold text-lg
                           text-gray-800 dark:text-white"
                >
                    {{ config('app.name', 'Laravel') }}
                </h1>

            </div>


            {{-- =================================================
                 RIGHT SIDE
            ================================================== --}}

            <div class="flex items-center gap-5">


                {{-- =================================================
                     NOTIFICATIONS
                ================================================== --}}

                @auth

                    <div
                        x-data="{ open: false }"
                        class="relative"
                    >

                        {{-- Notification Button --}}

                        <button
                            type="button"
                            class="notification-button
                                   relative
                                   flex items-center justify-center
                                   w-10 h-10
                                   text-gray-700
                                   dark:text-gray-200
                                   hover:text-gray-900
                                   dark:hover:text-white
                                   focus:outline-none"
                            @click="open = !open"
                            :aria-expanded="open.toString()"
                            aria-label="Notifications"
                        >

                            {{-- Bell SVG --}}

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="23"
                                height="23"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >

                                <path
                                    d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                                ></path>

                                <path
                                    d="M13.73 21a2 2 0 0 1-3.46 0"
                                ></path>

                            </svg>


                            {{-- Notification Count --}}

                            @php
                                $unreadCount = auth()
                                    ->user()
                                    ->unreadNotifications
                                    ->count();
                            @endphp

                            @if($unreadCount > 0)

                                <span
                                    class="absolute
                                           -top-0.5 -right-0.5
                                           flex items-center justify-center
                                           min-w-[18px] h-[18px]
                                           px-1
                                           bg-red-500
                                           text-white
                                           text-[10px]
                                           font-bold
                                           rounded-full"
                                >
                                    {{ $unreadCount }}
                                </span>

                            @endif

                        </button>


                        {{-- =================================================
                             NOTIFICATION DROPDOWN
                        ================================================== --}}

                        <div
                            x-show="open"
                            x-cloak
                            x-transition
                            @click.outside="open = false"

                            class="absolute
                                   right-0
                                   mt-2
                                   w-80
                                   max-h-80
                                   overflow-y-auto
                                   bg-white
                                   dark:bg-gray-800
                                   shadow-xl
                                   rounded-xl
                                   p-3
                                   z-[9999]
                                   border
                                   border-gray-200
                                   dark:border-gray-700"
                        >

                            {{-- Notification Header --}}

                            <div
                                class="px-2 pb-3
                                       border-b
                                       border-gray-200
                                       dark:border-gray-700"
                            >

                                <h3
                                    class="font-semibold
                                           text-gray-800
                                           dark:text-white"
                                >
                                    Notifications
                                </h3>

                            </div>


                            {{-- Notification List --}}

                            <div class="mt-2">

                                @forelse(
                                    auth()->user()->notifications as $notification
                                )

                                    @php
                                        $notificationMessage =
                                            $notification->data['message']
                                            ?? 'No message';
                                    @endphp

                                    <div
                                        class="border-b
                                               border-gray-200
                                               dark:border-gray-700
                                               py-3
                                               px-2
                                               text-sm
                                               text-gray-700
                                               dark:text-gray-200
                                               hover:bg-gray-100
                                               dark:hover:bg-gray-700
                                               cursor-pointer
                                               transition"
                                    >

                                        {{ $notificationMessage }}

                                    </div>

                                @empty

                                    <div
                                        class="text-gray-500
                                               dark:text-gray-400
                                               text-sm
                                               text-center
                                               py-5"
                                    >
                                        No notifications
                                    </div>

                                @endforelse

                            </div>

                        </div>

                    </div>

                @endauth


                {{-- =================================================
                     USER PROFILE
                ================================================== --}}

                @auth

                    <div
                        class="flex items-center gap-3"
                    >


                        {{-- =================================================
                             PROFILE PICTURE
                        ================================================== --}}

                        <div
                            class="w-10 h-10
                                   rounded-full
                                   overflow-hidden
                                   border-2
                                   border-pink-500
                                   flex-shrink-0"
                        >

                            @if(auth()->user()->profile_picture)

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        auth()->user()->profile_picture
                                    ) }}"
                                    alt="Profile"
                                    class="w-full h-full object-cover"
                                >

                            @else

                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=FCE7F3&color=E91E63"
                                    alt="Profile"
                                    class="w-full h-full object-cover"
                                >

                            @endif

                        </div>


                        {{-- =================================================
                             USER INFORMATION
                        ================================================== --}}

                        <div
                            class="leading-tight"
                        >

                            <div
                                class="text-sm
                                       font-semibold
                                       text-gray-800
                                       dark:text-white"
                            >
                                {{ auth()->user()->name }}
                            </div>

                            <div
                                class="text-xs
                                       text-gray-500
                                       dark:text-gray-400"
                            >
                                Patient
                            </div>

                        </div>


                        {{-- =================================================
                             CHEVRON
                        ================================================== --}}

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="profile-chevron
                                   text-gray-500
                                   dark:text-gray-300
                                   ml-1"
                            aria-hidden="true"
                        >

                            <polyline
                                points="6 9 12 15 18 9"
                            ></polyline>

                        </svg>

                    </div>

                @endauth

            </div>

        </nav>


        {{-- =====================================================
             OPTIONAL ORIGINAL NAVIGATION
        ====================================================== --}}

        {{-- @include('layouts.navigation') --}}


        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        @isset($header)

            <header
                class="bg-white
                       dark:bg-gray-800
                       shadow
                       border-b
                       border-gray-200
                       dark:border-gray-700"
            >

                <div
                    class="max-w-7xl
                           mx-auto
                           py-6
                           px-4
                           text-gray-900
                           dark:text-white"
                >

                    {{ $header }}

                </div>

            </header>

        @endisset


        {{-- =====================================================
             PAGE CONTENT
        ====================================================== --}}

        <main class="p-6">

            {{ $slot }}

        </main>


    </div>


</body>

</html>
