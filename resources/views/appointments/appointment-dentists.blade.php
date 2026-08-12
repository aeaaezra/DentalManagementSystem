<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shine & Smile Dental Clinic | Find Your Dentist</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dentists.css') }}">
</head>
<body class="text-slate-800">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full z-[99999] bg-white/90 backdrop-blur-md shadow-sm">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo + Burger -->
        <div class="relative flex items-center gap-4">

            <div class="text-2xl font-bold text-[#E91E63]">
                Shine & Smile
            </div>
        </div>

        <div class="hidden md:flex items-center gap-8 font-medium mx-auto">
    <a href="{{ route('appointments.homepage') }}"
    class="hover:text-[#E91E63] transition">Home</a>

    <a href="{{ route('appointments.create') }}"
    class="hover:text-[#E91E63] transition">Appointments</a>

    <a href="{{ route('appointments.dentists') }}"
   class="px-4 py-2 rounded-lg transition
   {{ request()->routeIs('appointments.dentists') ? 'bg-pink-500 text-white' : 'hover:text-[#E91E63]' }}">
    Dentists
</a>

<a href="{{ route('appointments.message')}}"
    class="hover:text-[#E91E63] transition">
    Messages
</a>

    <a href="{{ route('appointments.history')}}"
    class="hover:text-[#E91E63] transition">
    History
</a>

</div>

        <!-- Notification + Profile -->
    <div class="flex items-center gap-4">

            <button id="notificationBtn" class="notification-btn">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0m6 0H9" />
                    </svg>


            @if($notificationCount > 0)
                <span class="notification-badge">
                    {{ $notificationCount }}
                </span>
            @endif

        </button>

    <!-- Dropdown -->
     <div id="notificationDropdown"
         class="hidden absolute top-full right-12 mt-3 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 z-[999999]">

        <div class="px-4 py-3 border-b font-semibold text-lg">
            Notifications
        </div>

        @forelse($notifications as $notification)

            <div class="px-4 py-3 border-b hover:bg-gray-50 transition">

                <div class="font-medium text-gray-800">
                    {{ $notification->title }}
                </div>

                <div class="text-sm text-gray-600">
                    {{ $notification->message }}
                </div>

                <div class="text-xs text-gray-400 mt-1">
                    {{ $notification->created_at->diffForHumans() }}
                </div>

            </div>

        @empty

            <div class="p-4 text-gray-500">
                No notifications.
            </div>

        @endforelse

    </div>

</div>

<!-- Profile Dropdown -->
<div class="relative">

    <button id="profileBtn"
        type="button"
        class="flex items-center gap-2 focus:outline-none">

        <img
    src="{{ Auth::user()->profile_picture
            ? asset('storage/' . Auth::user()->profile_picture)
            : asset('images/default-profile.png') }}"
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
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit"
                class="w-full text-left flex items-center gap-3 px-2 py-1 text-red-600 hover:bg-red-50 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7" />
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 12h4" />
            </svg>

            <span>Logout</span>
        </button>
    </form>

</div>

</div>

        </div>

    </div>
</nav>
<main class="container mx-auto px-6 pt-32">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-slate-900">Our Dentists</h2>
            <p class="text-slate-600 mt-2">Find the right dental specialist and check their availability.</p>
        </div>


    <!-- Search & Filter -->
<!-- Search & Filter -->
<div class="flex flex-col md:flex-row gap-4 mb-8">

    <input
        type="text"
        id="searchInput"
        placeholder="Search by name or specialization..."
        class="flex-grow p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-pink-500">

    <select
        id="filterSpec"
        class="p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-pink-500">

        <option value="All">All Specializations</option>
        <option value="Orthodontics">Orthodontics</option>
        <option value="Endodontics">Endodontics</option>
        <option value="Oral Surgery">Oral Surgery</option>
        <option value="Prosthodontics">Prosthodontics</option>
        <option value="Esthetic Dentistry">Esthetic Dentistry</option>

    </select>

</div>
        </div>

            <!-- Dentist Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@forelse($doctors as $doctor)

<div
    class="dentist-card bg-white p-6 rounded-2xl shadow-sm border border-slate-100"
    data-name="{{ strtolower($doctor->name) }}"
    data-specialization="{{ strtolower($doctor->specialization) }}">

    <div class="flex items-center gap-4 mb-4">

        @if(!empty($doctor->image))
            <img
                src="{{ asset('storage/' . $doctor->image) }}"
                alt="{{ $doctor->name }}"
                class="w-16 h-16 rounded-full object-cover">
        @else
            <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-user-doctor text-pink-600 text-xl"></i>
            </div>
        @endif

        <div>
            <h4 class="font-bold text-lg">
                {{ $doctor->name }}
            </h4>

            <p class="text-sm text-pink-600 font-semibold">
                {{ $doctor->specialization ?? 'General Dentistry' }}
            </p>

            @if(isset($doctor->experience))
                <p class="text-xs text-slate-400">
                    {{ $doctor->experience }} years of experience
                </p>
            @endif
        </div>

    </div>

    <div class="mb-4">

        <span class="inline-block px-3 py-1 rounded bg-gray-100 text-gray-600 text-sm">
            {{ $doctor->specialization ?? 'General Dentistry' }}
        </span>

    </div>

    <div class="mb-4">

        @if(isset($doctor->available) && $doctor->available)
            <span class="text-green-500 font-medium">
                ● Available Now
            </span>
        @else
            <span class="text-red-500 font-medium">
                ● Unavailable
            </span>
        @endif

    </div>

    <a href="{{ route('appointments.create') }}"
       class="block text-center bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition">

        Book Appointment

    </a>

</div>

@empty

<div class="col-span-3 text-center py-10 text-gray-500">
    No dentists found.
</div>

@endforelse

</div>
        </div>

</main>
    <script src="{{ asset('js/dentists.js') }}"></script>
</body>
</html>
