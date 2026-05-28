<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-pink-50 via-gray-50 to-white min-h-screen">

<!-- NAVBAR -->
<header class="bg-white/80 backdrop-blur border-b sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <h1 class="text-xl font-bold text-pink-600 tracking-tight">
            Shine and Smile Dental Clinic System
        </h1>

        <nav class="flex items-center gap-6 text-sm font-medium">
            <a href="/" class="text-gray-600 hover:text-pink-600 transition">Home</a>
            <a href="#" class="text-gray-600 hover:text-pink-600 transition">Services</a>
            <a href="#" class="text-gray-600 hover:text-pink-600 transition">Contact</a>
        </nav>
    </div>
</header>

<!-- MAIN -->
<main class="max-w-4xl mx-auto px-6 py-12">

    <!-- HERO -->
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Book Your Appointment</h2>
        <p class="text-gray-500 mt-2">
            Schedule your dental visit quickly and easily.
        </p>
    </div>

    <!-- CARD -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border">

        <div class="grid md:grid-cols-2">

            <!-- LEFT INFO PANEL -->
            <div class="bg-pink-600 text-white p-8 flex flex-col justify-center">
                <h3 class="text-2xl font-bold mb-3">Welcome!</h3>
                <p class="text-pink-100 leading-relaxed">
                    Please fill out the form to book your appointment.
                    Our clinic will confirm your schedule shortly.
                </p>

                <div class="mt-6 text-sm text-pink-100 space-y-2">
                    <p>✔ Fast booking process</p>
                    <p>✔ Secure appointment system</p>
                    <p>✔ Professional dental care</p>
                </div>
            </div>

            <!-- FORM -->
            <div class="p-8">

                <!-- SUCCESS -->
                @if(session('success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ERROR -->
                @if(session('error'))
                    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('appointments.store') }}" class="space-y-5">

                    @csrf

                    <!-- NAME -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="full_name"
                            value="{{ old('full_name') }}"
                            class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none"
                            placeholder="Enter your full name" required>
                        @error('full_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- DATE + TIME -->
                    <div class="grid grid-cols-2 gap-4">

                        <div>
                            <label class="text-sm font-medium text-gray-700">Date</label>
                            <input type="date" name="appointment_date"
                                value="{{ old('appointment_date') }}"
                                class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-pink-400"
                                required>
                            @error('appointment_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">Time</label>
                            <input type="time" name="appointment_time"
                                value="{{ old('appointment_time') }}"
                                class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-pink-400"
                                required>
                            @error('appointment_time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- REASON -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Reason for Visit</label>
                        <textarea name="reason" rows="4"
                            class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-pink-400"
                            placeholder="Describe your concern...">{{ old('reason') }}</textarea>
                        @error('reason')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md">
                        Confirm Appointment
                    </button>

                </form>
            </div>
        </div>
    </div>

</main>

<!-- FOOTER -->
<footer class="text-center text-gray-500 text-sm py-8">
    © {{ date('Y') }} Dental Clinic System. All rights reserved.
</footer>

</body>
</html>
