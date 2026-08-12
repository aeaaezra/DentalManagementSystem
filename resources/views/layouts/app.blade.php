<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Alpine Cloak Fix -->
    <style>
        [x-cloak] { display: none !important; }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <!-- NAVIGATION -->
        <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">

            <!-- LEFT SIDE -->
            <div>
                <h1 class="font-bold text-lg">{{ config('app.name', 'Laravel') }}</h1>
            </div>

            <!-- RIGHT SIDE -->
            <div class="flex items-center gap-6">

                <!-- 🔔 NOTIFICATION -->
                <div x-data="{ open: false }" class="relative">

                    <!-- BUTTON -->
                    <button @click="open = !open" class="text-xl relative focus:outline-none">
                        🔔

                        @auth
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1 rounded-full">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                        @endif
                        @endauth
                    </button>

                    <!-- DROPDOWN -->
                    <div x-show="open"
                         x-cloak
                         @click.outside="open = false"
                         class="absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg p-3 z-50 max-h-60 overflow-y-auto">

                        @auth
                            @forelse(auth()->user()->notifications as $notification)
                                <div class="border-b py-2 text-sm hover:bg-gray-100 cursor-pointer">
                                    {{ $notification->data['message'] ?? 'No message' }}
                                </div>
                            @empty
                                <div class="text-gray-500 text-sm text-center">
                                    No notifications
                                </div>
                            @endforelse
                        @endauth

                    </div>
                </div>

                <!-- USER -->
                @auth
                    <div class="text-sm">
                        {{ auth()->user()->name }}
                    </div>
                @endauth

            </div>
        </nav>

        <!-- OPTIONAL: KEEP YOUR ORIGINAL NAV -->
        {{-- @include('layouts.navigation') --}}

        <!-- PAGE HEADER -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- CONTENT -->
        <main class="p-6">
            {{ $slot }}
        </main>

    </div>

</body>
</html>
