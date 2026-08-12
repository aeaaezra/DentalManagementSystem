<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\PatientRecords;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Notifications\AppointmentSubmitted;
use App\Notifications\AppointmentCancelled;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicPayment;
use App\Models\TreatmentGuide;
use Illuminate\Support\Facades\Storage;
use App\Services\BillingService;
use App\Notifications\AppointmentApproved;
use App\Notifications\AppointmentDeclined;
class AppointmentBookingController extends Controller
{
    /**
     * Show booking form
     */
    public function create()
    {

        $services = Service::all();
        $payments = ClinicPayment::all();


        $notifications = auth()->user()->notifications()->latest()->get();
        $notificationCount = auth()->user()->unreadNotifications->count();

        $latestBalance = Appointments::whereHas('patient', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->where('balance', '>', 0)
        ->latest('appointment_date')
        ->first();

        return view('appointments.create', compact(

            'services',
            'payments',
            'notifications',
            'notificationCount',
            'latestBalance'
        ));
    }

    // Store appointment

    public function store(Request $request, BillingService $billingService)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'patient_name' => ['required', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:1'],
            'sex' => ['nullable'],
            'civil_status' => ['nullable'],
            'tel_no' => ['nullable'],
            'occupation' => ['nullable'],
            'address' => ['nullable'],

            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'reason' => ['required'],
        ]);

        $service = Service::findOrFail($validated['service_id']);

        // Prevent double booking
        $exists = Appointments::where('appointment_date', $validated['appointment_date'])
            ->where('appointment_time', $validated['appointment_time'])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'appointment_time' => 'This appointment time is already booked.'
            ])->withInput();
        }

        // Create patient
        $patient = PatientRecords::create([
            'user_id' => Auth::id(),
            'patient_name' => $validated['patient_name'],
            'age' => $validated['age'] ?? null,
            'sex' => $validated['sex'] ?? null,
            'civil_status' => $validated['civil_status'] ?? null,
            'tel_no' => $validated['tel_no'] ?? null,
            'occupation' => $validated['occupation'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        // Create appointment
        $appointment = Appointments::create([
            'patient_record_id' => $patient->id,
            'service_id' => $service->id,
            'appointment_date' => $validated['appointment_date'],

            'reason' => $validated['reason'],
            'status' => 'pending',

                ]);
            $request->validate([
    'appointment_time' => ['required', 'date_format:H:i:s'],
    ]);

        // Send notification
        Auth::user()->notify(new AppointmentSubmitted($appointment));

        return redirect()->route('appointments.homepage')
    ->with('success', 'Appointment booked successfully!');
    }

    public function summary(Appointments $appointment)
    {
        $notifications = auth()->user()->notifications()->latest()->get();
        $notificationCount = auth()->user()->unreadNotifications()->count();

        return view('appointments.summary', compact(
            'appointment',
            'notifications',
            'notificationCount'
        ));
    }

    public function homepage()
{
    $appointmentHistory = Appointments::whereHas('patient', function ($query) {
        $query->where('user_id', Auth::id());
    })->latest()->get();


    $notifications = auth()->user()->notifications()->latest()->get();
    $notificationCount = auth()->user()->unreadNotifications()->count();

    $totalOutstanding = Appointments::whereHas('patient', function ($query) {
        $query->where('user_id', Auth::id());
    })->sum('balance');

    $totalPaid = Appointments::whereHas('patient', function ($query) {
        $query->where('user_id', Auth::id());
    })->sum('amount_paid');

    $totalAppointments = Appointments::whereHas('patient', function ($query) {
        $query->where('user_id', Auth::id());
    })->count();

    $pendingPayments = Appointments::whereHas('patient', function ($query) {
        $query->where('user_id', Auth::id());
    })
    ->where('balance', '>', 0)
    ->count();

    $services = Service::all();

    return view('appointments.appointment-homepage', compact(
        'appointmentHistory',
        'notifications',
        'notificationCount',
        'services',
        'totalOutstanding',
        'totalPaid',
        'totalAppointments',
        'pendingPayments'
    ));
}

    public function cancel(Appointments $appointment)
    {
        if ($appointment->patient->user_id != Auth::id()) {
            abort(403);
        }

        if (in_array($appointment->status, ['completed', 'cancelled'])) {
            return back()->with('error', 'Cannot cancel.');
        }

        $appointment->update([
            'status' => 'cancelled',
        ]);

        // ✅ Send notification
        Auth::user()->notify(new AppointmentCancelled($appointment));

        return redirect()->route('appointments.homepage')
            ->with('success', 'Cancelled successfully.');
    }

   public function history(Request $request)
{
    $query = Appointments::whereHas('patient', function ($q) {
        $q->where('user_id', Auth::id());
    });


    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('doctor_name', 'like', '%' . $request->search . '%')
              ->orWhere('reason', 'like', '%' . $request->search . '%')
              ->orWhereDate('appointment_date', $request->search);
        });
    }


    if ($request->status && $request->status !== 'all') {
        $query->where('payment_status', match ($request->status) {
            'paid' => 'Paid',
            'partial' => 'Partially Paid',
            'unpaid' => 'Unpaid',
        });
    }


    $appointments = $query->latest()->paginate(10)->withQueryString();

    $totalOutstanding = $query->sum('balance');
    $totalPaid = $query->sum('amount_paid');
    $totalAppointments = $query->count();
    $pendingPayments = $query->where('balance', '>', 0)->count();

    // Notifications
    $notifications = auth()->user()->notifications()->latest()->get();
    $notificationCount = auth()->user()->unreadNotifications->count();

$services = Appointments::select('service_id')
    ->distinct()
    ->with('service')
    ->get()
    ->pluck('service')
    ->filter();

$doctors = Appointments::select('doctor_name')
    ->distinct()
    ->pluck('doctor_name');

return view('appointments.appointment-history', compact(
    'appointments',
    'totalOutstanding',
    'totalPaid',
    'totalAppointments',
    'pendingPayments',
    'notifications',
    'notificationCount',
    'doctors',
    'services'
));
}

    public function settings()
    {
        $user = Auth::user();

        $notifications = auth()->user()->notifications()->latest()->get();
        $notificationCount = auth()->user()->unreadNotifications()->count();

        return view('appointments.settings', compact(
            'user',
            'notifications',
            'notificationCount'
        ));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $user->profile_picture = $request->file('profile_picture')
                ->store('profile_pictures', 'public');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profile updated!');
    }
public function availableSlots(Request $request)
{
    if (!$request->date) {
        return response()->json([], 400);
    }

    $start = \Carbon\Carbon::parse($request->date . ' 08:00');
    $end = \Carbon\Carbon::parse($request->date . ' 17:00');

    $slots = [];
    $now = now();

    while ($start < $end) {

        $slotStart = $start->format('H:i:s');
        $slotEnd = $start->copy()->addHour()->format('H:i:s');

        // Check if already booked
        $isBooked = Appointments::where('appointment_date', $request->date)
            ->where('appointment_time', $slotStart)
            ->exists();

        //FIXED availability logic
        if ($request->date == $now->toDateString() && $start < $now) {
            $available = false; // past time today
        } else {
            $available = !$isBooked;
        }

        $slots[] = [
            'time' => $start->format('h:i A'),
            'start' => $slotStart,
            'end' => $slotEnd,
            'available' => $available,
        ];

        $start->addHour();
    }

    return response()->json($slots);
}
}
