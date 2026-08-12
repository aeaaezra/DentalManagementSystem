<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shine & Smile Dental | AppointmentHistory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/history.css') }}">
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

    <a href="{{ route('appointments.homepage')}}"
       class="px-4 py-2 rounded-lg transition
       {{ request()->routeIs('appointments.homepage') ? 'bg-pink-500 text-white' : 'hover:text-[#E91E63]' }}">
        Home
    </a>

    <a href="{{ route('appointments.create')}}"
        class="hover:text-[#E91E63] transition">
        Appointments
    </a>

    <a href="{{ route('appointments.dentists')}}"
       class="hover:text-[#E91E63] transition">
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

<div class="px-4 py-3 border-b hover:bg-gray-50">

    <div class="flex justify-between items-start">

        <div>

            <div class="font-medium">
                {{ $notification->title }}
            </div>

            <div class="text-sm text-gray-600">
                {{ $notification->message }}
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

<main class="container mx-auto px-6 py-10">
 <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Appointment History</h1>
            <p class="text-gray-600">Track your dental visits and billing status.</p>
        </div>

<div class="flex justify-end mb-4">

    <button
        onclick="printHistory()"
        class="inline-flex items-center gap-2 bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg shadow transition">

        <!-- Printer Icon -->
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M17 17h2a2 2 0 002-2V9a2 2 0 00-2-2h-2m-10 0H5a2 2 0 00-2 2v6a2 2 0 002 2h2m10 0H7m10 0v4H7v-4m10-8V3H7v6h10z"/>

        </svg>

        Print History

    </button>

</div>

<!--
<div class="print-summary">

    <div class="summary-card outstanding">
        <p>Outstanding Balance</p>
        <h2>₱{{ number_format($totalOutstanding, 2) }}</h2>
    </div>

    <div class="summary-card paid">
        <p>Total Paid</p>
        <h2>₱{{ number_format($totalPaid, 2) }}</h2>
    </div>

    <div class="summary-card appointments">
        <p>Total Appointments</p>
        <h2>{{ $totalAppointments }}</h2>
    </div>

    <div class="summary-card pending">
        <p>Pending Payments</p>
        <h2>{{ $pendingPayments }}</h2>
    </div>

</div>
-->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">


        <select
            id="monthFilter"
            onchange="filterTable()"
            class="w-full h-10 px-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:outline-none">

            <option value="" selected>Month</option>

            @for($i = 1; $i <= 12; $i++)
                <option value="{{ sprintf('%02d', $i) }}">
                    {{ date('F', mktime(0,0,0,$i,1)) }}
                </option>
            @endfor

        </select>

        <select
    id="dentistFilter"
    onchange="filterTable()"
    class="w-full h-9 px-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:outline-none">

    <option value="Dentist" selected> Dentist</option>

    @foreach($doctors as $doctor)
    <option value="{{ $doctor }}">
        {{ $doctor }}
    </option>
@endforeach

</select>


        <select
        id="serviceFilter"
        onchange="filterTable()"
        class="w-full h-9 px-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:outline-none">

        <option value=" Service" selected>Service</option>

        @foreach($services as $service)
            <option value="{{ $service->service_name }}">
                {{ $service->service_name }}
            </option>
        @endforeach

            </select>


        <select
            id="statusFilter"
            onchange="filterTable()"
            class="w-full h-9 px-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:outline-none">

            <option value="Status" selected>Status</option>

            <option value="pending">Pending</option>
            <option value="accepted">Accepted</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
            <option value="declined">Declined</option>

        </select>

        <input
        type="text"
        id="searchInput"
        placeholder="Search..."
        onkeyup="filterTable()"
        class="w-full h-9 px-4 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:outline-none">

    </div>

</div>


        <div class="bg-white rounded-xl shadow-sm overflow-x-auto border border-gray-200">
            <table class="w-full text-sm text-left text-gray-600" id="historyTable">
                <thead class="text-xs uppercase bg-pink-50 text-pink-700">
                    <tr>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Dentist</th>
                        <th class="px-6 py-4">Service</th>
                        <th class="px-6 py-4">Total Fee</th>
                        <th class="px-6 py-4">Amount Paid</th>
                        <th class="px-6 py-4">Balance</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Payment</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                        @forelse($appointments as $appointment)

                        <tr>

                            <td class="px-6 py-4 text-right font-medium">
                                {{ $appointment->appointment_date }}
                            </td>

                            <td class="px-6 py-4 text-right font-medium">
                                {{ $appointment->doctor_name }}
                            </td>

                            <td class="px-6 py-4 text-right font-medium">
                                {{ $appointment->service }}
                            </td>

                            <td class="px-6 py-4 text-right font-medium">
                                ₱{{ number_format($appointment->total_fee,2) }}
                            </td>

                            <td class="px-6 py-4 text-right font-medium">
                                ₱{{ number_format($appointment->amount_paid,2) }}
                            </td>

                            <td class="px-6 py-4 text-right font-medium">
                                ₱{{ number_format($appointment->balance,2) }}
                            </td>

                            <td class="px-6 py-4 text-center">

                            @if(strtolower($appointment->status) == 'completed')

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    Completed
                                </span>

                            @elseif(strtolower($appointment->status) == 'pending')

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                    Pending
                                </span>

                            @elseif(strtolower($appointment->status) == 'accepted')

                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                    Accepted
                                </span>

                            @elseif(strtolower($appointment->status) == 'cancelled')

                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                    Cancelled
                                </span>

                            @elseif(strtolower($appointment->status) == 'declined')

                                <span class="px-3 py-1 rounded-full bg-gray-200 text-gray-700 text-xs font-semibold">
                                    Declined
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
                                    {{ ucfirst($appointment->status) }}
                                </span>

                            @endif

                        </td>

                            <td class="px-6 py-4 text-right font-medium">
                                {{ $appointment->payment_method }}
                            </td>

                            <td class="px-6 py-4 text-right font-medium">
                                <button class="text-pink-600 hover:underline">
                                    View
                                </button>
                            </td>

                        </tr>

                        @empty

                        <tr>

                        <td colspan="9" class="text-center py-10 text-gray-500">
                        No appointment history found.
                        </td>

                        </tr>

                        @endforelse

                        </tbody>
            </table>
        </div>

<div class="mt-6 flex items-center justify-between">

    <p class="text-sm text-gray-500">
        Showing
        {{ $appointments->firstItem() ?? 0 }}
        to
        {{ $appointments->lastItem() ?? 0 }}
        of
        {{ $appointments->total() }}
        appointments
    </p>

    {{ $appointments->links() }}

</div>

    </div>
</main>

 <footer class="bg-slate-50 pt-24 pb-12 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-4 gap-12 mb-20">
                <div class="col-span-2">
                    <div class="flex items-center gap-3 mb-8">
                        <svg width="24" height="24" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 2L2 10V20C2 28.5 8.5 36.2 20 38C31.5 36.2 38 28.5 38 20V10L20 2Z" fill="#DB2777" />
                            <path d="M20 38C26 36.5 31 32 34.5 26.5L20 20V38Z" fill="#BE185D" />
                            <path d="M20 8L21.5 14.5L28 16L21.5 17.5L20 24L18.5 17.5L12 16L18.5 14.5L20 8Z" fill="white" />
                        </svg>
                        <span class="text-xl font-extrabold tracking-tight text-slate-900">Shine & Smile</span>
                    </div>
                    <p class="text-slate-500 max-w-sm mb-8 leading-relaxed">
                        Redefining dental practice management with a focus on clinician efficiency and patient outcomes.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase text-xs tracking-widest">Platform</h4>
                    <ul class="space-y-4 text-slate-500 text-sm font-medium">
                        <li><a href="#" class="hover:text-pink-600 transition-colors">Clinical Records</a></li>
                        <li><a href="#" class="hover:text-pink-600 transition-colors">Billing Engine</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase text-xs tracking-widest">Company</h4>
                    <ul class="space-y-4 text-slate-500 text-sm font-medium">
                        <li><a href="#" class="hover:text-pink-600 transition-colors">Our Mission</a></li>
                        <li><a href="#" class="hover:text-pink-600 transition-colors">Privacy</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-200 text-center text-slate-400 text-xs">
                © 2025 Shine & Smile Systems Inc. | All Rights Reserved.
            </div>
        </div>
    </footer>


    <script src="{{ asset('js/history.js') }}"></script>
</body>
</html>
