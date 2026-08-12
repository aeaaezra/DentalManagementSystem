<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shine & Smile Dental | Creating Healthy, Beautiful Smiles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body class="bg-white text-[#2D2D2D] pt-24">


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
       class="px-4 py-2 rounded-lg transition
       {{ request()->routeIs('appointments.homepage') ? 'bg-pink-500 text-white' : 'hover:text-[#E91E63]' }}">
        Home
    </a>

    <a href="{{ route('appointments.create') }}"
       class="hover:text-[#E91E63] transition">
        Appointments
    </a>

    <a href="{{ route('appointments.dentists') }}"
       class="hover:text-[#E91E63] transition">
        Dentists
    </a>

    <a href="  {{ route('appointments.message') }}  "
       class="hover:text-[#E91E63] transition">
       Messages
    </a>

    <a href="{{ route('appointments.history') }}"
       class="hover:text-[#E91E63] transition">
        History
    </a>

</div>

        <!-- Notification + Profile -->
    <div class="flex items-center gap-4">

            <button
            id="notificationBtn"
            type="button"
            class="notification-btn"
        >
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

    <div class="px-4 py-3 border-b hover:bg-gray-50">

        <div class="flex justify-between items-start">

            <div>

                <div class="font-medium">
                    {{ $notification->data['title'] ?? 'Notification' }}
                </div>

                <div class="text-sm text-gray-600">
                    {{ $notification->data['message'] ?? 'No message available.' }}
                </div>

                <div class="text-xs text-gray-400 mt-1">
                    {{ $notification->created_at->diffForHumans() }}
                </div>

            </div>

            <form method="POST"
                  action="{{ route('notifications.destroy', $notification->id) }}">

                @csrf
                @method('DELETE')

                <button type="submit"
                    class="text-red-500 hover:text-red-700 text-sm font-bold">
                    ✕
                </button>

            </form>

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

<main class="container mx-auto px-6 pt-8">

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

    <a href="{{ route('appointments.dentists') }}"
       class="inline-block bg-white text-custom-pink font-bold py-3 px-8 rounded-full shadow-md hover:bg-gray-100 transition mt-4 md:mt-0">
        Book Now!
    </a>

</section>

  <div class="lg:col-span-3 w-full bg-white p-8 rounded-2xl shadow-sm border border-gray-100">

        <!-- Left Column: Appointments -->
<section class="mb-12 bg-white p-8 rounded-2xl shadow-sm border border-gray-100 max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">My Appointments</h3>
            <p class="text-sm text-gray-500">Manage your current and past bookings</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">

            <thead>
                <tr class="text-gray-500 border-b border-gray-100 text-sm">
                    <th class="pb-4 font-semibold pl-2">Date & Time</th>
                    <th class="pb-4 font-semibold">Service</th>
                    <th class="pb-4 font-semibold text-center">Status</th>
                    <th class="pb-4 font-semibold text-right">Action</th>
                </tr>
            </thead>

            <tbody class="text-gray-700 text-sm">

                @forelse($appointmentHistory as $appointment)

                    <tr class="border-b border-gray-50 hover:bg-pink-50 transition">

                        <!-- DATE -->
                        <td class="py-5 pl-2">
                            <p class="font-semibold">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}
                            </p>

                            <p class="text-xs text-gray-400">
                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                            </p>
                        </td>

                        <!-- SERVICE -->
                        <td class="py-5 font-medium text-custom-pink">
                            {{ $appointment->service?->service_name ?? 'N/A' }}
                        </td>


                        <!-- STATUS -->
                        <td class="py-5 text-center">

                            @php
                                $status = strtolower(trim($appointment->status));
                            @endphp

                            @if($status === 'pending')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                                    Pending
                                </span>

                            @elseif($status === 'confirmed')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                    Confirmed
                                </span>

                            @elseif($status === 'completed')
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                                    Completed
                                </span>

                            @elseif($status === 'cancelled')
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                                    Cancelled
                                </span>

                            @else
                                <span class="text-gray-400">N/A</span>
                            @endif

                        </td>

                        <!-- ACTION -->
                        <td class="py-5 text-right">

                            @if(in_array($status, ['pending', 'confirmed']))

                                <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" class="inline">
                                    @csrf

                                    <button
                                        type="submit"
                                        onclick="return confirm('Cancel this appointment?')"
                                        class="text-red-500 hover:underline text-sm font-medium">
                                        Cancel
                                    </button>
                                </form>

                            @else
                                <span class="text-xs text-gray-300">N/A</span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            No appointments found.
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>
    </div>

</section>


        <div class="lg:col-span-3 w-full bg-white p-8 rounded-2xl shadow-sm border border-gray-100">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Patient Appointment Balance History
        </h2>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

    <!-- Outstanding Balance -->
    <div class="bg-red-50 border border-red-100 rounded-xl p-5">
        <p class="text-sm text-gray-500">
            Outstanding Balance
        </p>

        <h2 class="text-2xl font-bold text-red-600 mt-2">
            ₱{{ number_format($totalOutstanding ?? 0, 2) }}
        </h2>
    </div>

    <!-- Total Paid -->
    <div class="bg-green-50 border border-green-100 rounded-xl p-5">
        <p class="text-sm text-gray-500">
            Total Paid
        </p>

        <h2 class="text-2xl font-bold text-green-600 mt-2">
            ₱{{ number_format($totalPaid ?? 0, 2) }}
        </h2>
    </div>

    <!-- Total Appointments -->
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
        <p class="text-sm text-gray-500">
            Total Appointments
        </p>

        <h2 class="text-2xl font-bold text-blue-600 mt-2">
            {{ $totalAppointments ?? 0 }}
        </h2>
    </div>

    <!-- Pending Payments -->
    <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-5">
        <p class="text-sm text-gray-500">
            Pending Payments
        </p>

        <h2 class="text-2xl font-bold text-yellow-600 mt-2">
            {{ $pendingPayments ?? 0 }}
        </h2>
    </div>

</div>



</div>

        <div class="overflow-x-auto rounded-xl">
                <table class="w-full text-left">
                <thead>

<tr class="text-gray-500 border-b">

    <th class="py-4">Date</th>

    <th>Dentist</th>

    <th>Service</th>

    <th class="text-right">Total Fee</th>

    <th class="text-right">Amount Paid</th>

    <th class="text-right">Balance</th>

    <th class="text-center">Status</th>



</tr>

</thead>
            <tbody class="text-gray-700 divide-y divide-gray-50">

@forelse($appointmentHistory as $appointment)

<tr class="hover:bg-pink-50 transition">

    <td class="py-5">
        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
    </td>

    <td>
        Dr.{{ $appointment->doctor_name }}
    </td>

    <td>
        {{ $appointment->service?->service_name ?? 'N/A' }}
    </td>

    <td class="text-center">
        ₱{{ number_format($appointment->total_amount ?? 0, 2) }}
    </td>

    <td class="text-center text-green-600">
        ₱{{ number_format($appointment->amount_paid ?? 0, 2) }}
    </td>

    <td class="text-center font-bold text-red-600">
        ₱{{ number_format($appointment->balance ?? 0, 2) }}
    </td>

    <td class="text-center">

        @if($appointment->payment_status == 'Paid')

            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                Paid
            </span>

        @elseif($appointment->payment_status == 'Partially Paid')

            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                Partially Paid
            </span>

        @else

            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                Unpaid
            </span>

        @endif

    </td>


    <td>

        <div class="flex justify-center gap-2">



            @if(($appointment->balance ?? 0) > 0)
                <button class="px-3 py-1 rounded-lg bg-green-100 text-green-600">
                    Pay
                </button>
            @endif

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="9" class="text-center py-8 text-gray-500">

        No appointment history found.

    </td>

</tr>

@endforelse

</tbody>
            </table>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between items-center">
            <p class="text-sm text-gray-500">Showing historical appointment balances.</p>

            <a href="{{ route('appointments.history') }}"
            class="inline-flex items-center text-pink-600 font-semibold hover:text-pink-700 hover:underline transition">
                View All History
                <span class="ml-1">→</span>
            </a>

        </div>
    </div>

</div>
    </main>

    <footer class="bg-slate-50 pt-24 pb-12 border-t border-slate-200">
            <div class="pt-8 border-t border-slate-200 text-center text-slate-400 text-xs">
                © 2026 Shine & Smile Systems Dental. | All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
    <script src="{{ asset('js/appointment.js') }}"></script>
</body>
</html>
