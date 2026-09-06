<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"
    />

    <!-- Favicon -->
    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/favicon.png') }}"
    >

    <!-- Alpine Cloak Fix -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">


        <!-- ========================================== -->
        <!-- NAVIGATION -->
        <!-- ========================================== -->

        <nav
            class="bg-white dark:bg-gray-800 shadow px-6 py-4 flex justify-between items-center border-b border-gray-200 dark:border-gray-700"
        >


            <!-- ====================================== -->
            <!-- LEFT SIDE / LOGO -->
            <!-- ====================================== -->

            <div class="flex items-center">

                <h1 class="font-bold text-lg text-gray-800 dark:text-white">
                    {{ config('app.name', 'Laravel') }}
                </h1>

            </div>


            <!-- ====================================== -->
            <!-- RIGHT SIDE -->
            <!-- ====================================== -->

            <div class="flex items-center gap-5">


                <!-- ================================== -->
                <!-- NOTIFICATION -->
                <!-- ================================== -->

                <div
                    x-data="{ open: false }"
                    class="relative"
                >

                    <!-- Notification Button -->

                    <button
                        type="button"
                        @click="open = !open"
                        class="relative flex items-center justify-center w-10 h-10 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white focus:outline-none"
                    >

                        <!-- Bell SVG -->

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
                        >

                            <path
                                d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                            ></path>

                            <path
                                d="M13.73 21a2 2 0 0 1-3.46 0"
                            ></path>

                        </svg>


                        <!-- Notification Count -->

                        @auth

                            @if(auth()->user()->unreadNotifications->count() > 0)

                                <span
                                    class="absolute -top-0.5 -right-0.5 flex items-center justify-center min-w-[18px] h-[18px] px-1 bg-red-500 text-white text-[10px] font-bold rounded-full"
                                >
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>

                            @endif

                        @endauth

                    </button>


                    <!-- ================================== -->
                    <!-- NOTIFICATION DROPDOWN -->
                    <!-- ================================== -->

                    <div
                        x-show="open"
                        x-cloak
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-3 z-50 max-h-60 overflow-y-auto border border-gray-200 dark:border-gray-700"
                    >

                        @auth

                            @forelse(auth()->user()->notifications as $notification)

                                <div
                                    class="border-b border-gray-200 dark:border-gray-700 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                >

                                    {{ $notification->data['message'] ?? 'No message' }}

                                </div>

                            @empty

                                <div
                                    class="text-gray-500 dark:text-gray-400 text-sm text-center py-3"
                                >
                                    No notifications
                                </div>

                            @endforelse

                        @endauth

                    </div>

                </div>


                <!-- ================================== -->
                <!-- USER PROFILE -->
                <!-- ================================== -->

                @auth

                    <div class="flex items-center gap-3">


                        <!-- Profile Picture -->

                        <div
                            class="w-10 h-10 rounded-full overflow-hidden border-2 border-pink-500 flex-shrink-0"
                        >

                            <img
                                src="{{ auth()->user()->profile_picture
                                    ? asset('storage/' . auth()->user()->profile_picture)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=FCE7F3&color=E91E63'
                                }}"
                                alt="Profile"
                                class="w-full h-full object-cover"
                            >

                        </div>


                        <!-- User Information -->

                        <div class="leading-tight">

                            <div
                                class="text-sm font-semibold text-gray-800 dark:text-white"
                            >
                                {{ auth()->user()->name }}
                            </div>

                            <div
                                class="text-xs text-gray-500 dark:text-gray-400"
                            >
                                Patient
                            </div>

                        </div>


                        <!-- Chevron -->

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
                            class="text-gray-500 dark:text-gray-300 ml-1"
                        >

                            <polyline
                                points="6 9 12 15 18 9"
                            ></polyline>

                        </svg>

                    </div>

                @endauth


            </div>

        </nav>


        <!-- ========================================== -->
        <!-- OPTIONAL ORIGINAL NAVIGATION -->
        <!-- ========================================== -->

        {{-- @include('layouts.navigation') --}}


        <!-- ========================================== -->
        <!-- PAGE HEADER -->
        <!-- ========================================== -->

        @isset($header)

            <header
                class="bg-white dark:bg-gray-800 shadow border-b border-gray-200 dark:border-gray-700"
            >

                <div
                    class="max-w-7xl mx-auto py-6 px-4 text-gray-900 dark:text-white"
                >

                    {{ $header }}

                </div>

            </header>

        @endisset


        <!-- ========================================== -->
        <!-- PAGE CONTENT -->
        <!-- ========================================== -->

        <main class="p-6">

            {{ $slot }}

        </main>


    </div>


</body>

</html>
