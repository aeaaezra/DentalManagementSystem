<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Summary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            #appointment-card { box-shadow: none !important; border: none !important; }
        }
    </style>
</head>
<body class="bg-pink-50 min-h-screen p-4 md:p-10">

    <div id="appointment-card" class="max-w-3xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden border border-pink-100">
        <!-- Header -->
        <div class="bg-pink-500 p-8 text-white text-center">
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/logo.jng') }}" class="w-20 h-20 mb-4 rounded-full bg-white p-1">
                <h1 class="text-3xl font-extrabold tracking-tight">Shine and Smile Dental Clinic</h1>
                <p class="mt-2 text-pink-100 font-medium">Appointment Successfully Submitted</p>
            </div>
        </div>

        <div class="p-8">
            <!-- Status Header -->
                <p class="text-xs uppercase tracking-widest text-pink-500 font-bold">
<!-- Status Header -->
<div class="flex flex-col md:flex-row justify-between items-center mb-8 bg-pink-50 border border-pink-200 rounded-xl p-5">

    <div>

        <p class="text-xs uppercase tracking-widest text-pink-500 font-bold">
            Appointment Reference
        </p>

        <p class="text-2xl font-bold text-pink-700">
            {{ $appointment->reference_number ?? 'APP-' . now()->format('Y') . '-' . str_pad($appointment->id,6,'0',STR_PAD_LEFT) }}
        </p>

    </div>

    <span
        class="mt-4 md:mt-0 px-4 py-2 rounded-full font-semibold text-sm

        @if(($appointment->status ?? '') == 'approved')
            bg-green-100 text-green-700
        @elseif(($appointment->status ?? '') == 'pending')
            bg-yellow-100 text-yellow-700
        @elseif(($appointment->status ?? '') == 'cancelled')
            bg-red-100 text-red-700
        @else
            bg-pink-100 text-pink-700
        @endif">

        {{ ucfirst($appointment->status ?? 'Pending') }}

    </span>

</div>
            <!-- Details Grid -->
            <div class="grid grid-cols-2 gap-x-10 gap-y-8">
                <div>
                    <p class="text-xs uppercase tracking-[0.25em] font-bold text-pink-500">Patient</p>
                    <p class="mt-1 text-xl font-bold text-gray-900">{{ $appointment->patient?->patient_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.25em] font-bold text-pink-500">Doctor</p>
                    <p class="mt-1 text-xl font-bold text-gray-900">{{ $appointment->doctor_name }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.25em] font-bold text-pink-500">Date</p>
                    <p class="mt-1 text-xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.25em] font-bold text-pink-500">Time</p>
                    <p class="mt-1 text-xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.25em] font-bold text-pink-500">
                        Booked On
                    </p>

                    <p class="mt-1 text-xl font-bold text-gray-900">
                        {{ optional($appointment->created_at)->format('F d, Y g:i A') }}
                    </p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs uppercase tracking-[0.25em] font-bold text-pink-500">Reason for Visit</p>
                    <p class="mt-1 text-xl font-bold text-gray-900">{{ $appointment->reason }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs uppercase tracking-[0.25em] font-bold text-pink-500">Service</p>
                    <p class="mt-1 text-xl font-bold text-gray-900">{{ $appointment->service?->service_name ?? 'Not Specified' }}</p>
                </div>
            </div>





</div>
                </div>
            </div>

            <!-- Clinic Info -->
            <div class="mt-10 text-center text-sm text-gray-500 border-t pt-6">
                <p><strong>Shine and Smile Dental Clinic</strong></p>
                <p>Norala, South Cotabato | Contact: 09XXXXXXXXX</p>
                <p class="mt-4 text-xs italic">Please arrive 15 minutes before your scheduled appointment.</p>
            </div>

            <!-- Footer Actions -->
            <div class="mt-10 border-t pt-6 text-center">

    <h3 class="text-xl font-bold text-pink-600">

        Shine and Smile Dental Clinic

    </h3>

    <p class="mt-2 text-gray-600">

        Door 5 MDFI Building, Alunan Avenue,
        Koronadal City, South Cotabato

    </p>

    <p class="text-gray-600">

        Phone:
        0936-806-8074

    </p>

    <p class="text-gray-600">

        Email:
        clinic@email.com

    </p>

    <p class="mt-5 italic text-gray-500 text-sm">

        Please arrive at least
        <strong>15 minutes</strong>
        before your appointment.

    </p>

</div>
<div class="mt-10 flex gap-4 no-print">

    <button
        onclick="window.print()"
        class="flex-1 bg-gray-900 hover:bg-black text-white py-3 rounded-xl font-semibold transition">

        Print Appointment

    </button>

    <form action="/final-submit" method="POST">
    @csrf

    <form onsubmit="event.preventDefault(); confirmSubmit(this)">
        Submit Appointment
    </button>
</form>
</div>
        </div>
    </div>
</body>
</html>
