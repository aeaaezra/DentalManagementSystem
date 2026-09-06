<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\PatientRecords;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\User;

use App\Notifications\AppointmentSubmitted;
use App\Notifications\AppointmentCancelled;
use App\Notifications\AppointmentApproved;
use App\Notifications\AppointmentDeclined;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\ClinicPayment;
use App\Models\TreatmentGuide;
use App\Services\BillingService;

use Carbon\Carbon;

class AppointmentBookingController extends Controller
{

    public function create()
    {
        $services = Service::all();

        $payments = ClinicPayment::all();

        $notifications = auth()
            ->user()
            ->notifications()
            ->latest()
            ->get();

        $notificationCount = auth()
            ->user()
            ->unreadNotifications
            ->count();

        $latestBalance = Appointments::whereHas(
            'patient',
            function ($query) {
                $query->where(
                    'user_id',
                    Auth::id()
                );
            }
        )
            ->where('balance', '>', 0)
            ->latest('appointment_date')
            ->first();

        return view(
            'appointments.create',
            compact(
                'services',
                'payments',
                'notifications',
                'notificationCount',
                'latestBalance'
            )
        );
    }



    public function store(
        Request $request,
        BillingService $billingService
    ) {

        $validated = $request->validate([

            'service_id' => [
                'required',
                'exists:services,id'
            ],

            'patient_name' => [
                'required',
                'string',
                'max:255'
            ],

            'age' => [
                'nullable',
                'integer',
                'min:1'
            ],

            'sex' => [
                'nullable'
            ],

            'civil_status' => [
                'nullable'
            ],

            'tel_no' => [
                'nullable'
            ],

            'occupation' => [
                'nullable'
            ],

            'address' => [
                'nullable'
            ],

            'heart_condition' => ['nullable'],
            'heart_condition_details' => ['nullable', 'string', 'max:255'],

            'allergy' => ['nullable'],
            'allergy_details' => ['nullable', 'string', 'max:255'],

            'diabetes' => ['nullable'],
            'diabetes_details' => ['nullable', 'string', 'max:255'],

            'hypertension' => ['nullable'],
            'hypertension_details' => ['nullable', 'string', 'max:255'],

            'bleeding_tendency' => ['nullable'],
            'bleeding_tendency_details' => ['nullable', 'string', 'max:255'],

            'asthma' => ['nullable'],
            'asthma_details' => ['nullable', 'string', 'max:255'],

            'other_conditions' => ['nullable', 'string'],

            'appointment_date' => [
                'required',
                'date'
            ],

            'appointment_time' => [
                'required',
                'date_format:H:i:s'
            ],

            'reason' => [
                'required'
            ],

            'patient_signature' => [
                'nullable',
                'string'
            ],
        ]);




        $service = Service::findOrFail(
            $validated['service_id']
        );




        $duration = (int) (
            $service->duration_minutes ?? 0
        );

        if ($duration <= 0) {

            return back()
                ->withErrors([
                    'service_id' =>
                        'The selected service does not have a valid duration.'
                ])
                ->withInput();

        }


        $startTime = Carbon::createFromFormat(
            'H:i:s',
            $validated['appointment_time']
        );


        $endTime = $startTime
            ->copy()
            ->addMinutes($duration);




        $clinicStart = Carbon::createFromFormat(
            'H:i:s',
            '08:00:00'
        );


        $clinicEnd = Carbon::createFromFormat(
            'H:i:s',
            '17:00:00'
        );


        if (
            $startTime->lt($clinicStart) ||
            $endTime->gt($clinicEnd)
        ) {

            return back()
                ->withErrors([
                    'appointment_time' =>
                        'The selected appointment time is outside clinic hours.'
                ])
                ->withInput();

        }

        $exists = Appointments::query()
            ->whereDate(
                'appointment_date',
                $validated['appointment_date']
            )
            ->whereNotIn(
                'status',
                [
                    'cancelled',
                    'declined',
                ]
            )
            ->where(
                'appointment_time',
                '<',
                $endTime->format('H:i:s')
            )
            ->where(
                'end_time',
                '>',
                $startTime->format('H:i:s')
            )
            ->exists();


        if ($exists) {

            return back()
                ->withErrors([
                    'appointment_time' =>
                        'This appointment time is already booked.'
                ])
                ->withInput();

        }

        $dailyAppointmentCount = Appointments::query()
            ->whereDate(
                'appointment_date',
                $validated['appointment_date']
            )
            ->whereNotIn(
                'status',
                [
                    'cancelled',
                    'declined',
                ]
            )
            ->count();


        $maximumPatientsPerDay = 20;


        if (
            $dailyAppointmentCount >=
            $maximumPatientsPerDay
        ) {

            return back()
                ->withErrors([
                    'appointment_date' =>
                        'The maximum number of appointments for this day has been reached.'
                ])
                ->withInput();

        }


        $appointment = DB::transaction(
            function () use (
                $validated,
                $service,
                $endTime
            ) {

$patient = PatientRecords::create([
    'user_id' => Auth::id(),

    'patient_name' => $validated['patient_name'],
    'age' => $validated['age'] ?? null,
    'sex' => $validated['sex'] ?? null,
    'civil_status' => $validated['civil_status'] ?? null,
    'tel_no' => $validated['tel_no'] ?? null,
    'occupation' => $validated['occupation'] ?? null,
    'address' => $validated['address'] ?? null,
    'patient_signature' => $validated['patient_signature'] ?? null,


    'heart_condition' => !empty($validated['heart_condition']),
    'heart_condition_details' => $validated['heart_condition_details'] ?? null,

    'allergy' => !empty($validated['allergy']),
    'allergy_details' => $validated['allergy_details'] ?? null,

    'diabetes' => !empty($validated['diabetes']),
    'diabetes_details' => $validated['diabetes_details'] ?? null,

    'hypertension' => !empty($validated['hypertension']),
    'hypertension_details' => $validated['hypertension_details'] ?? null,

    'bleeding_tendency' => !empty($validated['bleeding_tendency']),
    'bleeding_tendency_details' => $validated['bleeding_tendency_details'] ?? null,

    'asthma' => !empty($validated['asthma']),
    'asthma_details' => $validated['asthma_details'] ?? null,

    'other_conditions' => $validated['other_conditions'] ?? null,
]);




                $appointment = Appointments::create([

                    'patient_record_id' =>
                        $patient->id,

                    'service_id' =>
                        $service->id,

                    'appointment_date' =>
                        $validated['appointment_date'],

                    'appointment_time' =>
                        $validated['appointment_time'],

                    'end_time' =>
                        $endTime->format('H:i:s'),

                    'reason' =>
                        $validated['reason'],

                    'status' =>
                        'pending',

                    'total_fee' =>
                        $service->price,

                    'amount_paid' =>
                        0,

                    'balance' =>
                        $service->price,

                ]);


                return $appointment;

            }
        );




        Auth::user()->notify(
            new AppointmentSubmitted(
                $appointment
            )
        );




        return redirect()
            ->route(
                'appointments.thankyou',
                $appointment
            );
    }



    public function thankYou(
        Appointments $appointment
    ) {

        if (
            !$appointment->patient ||
            $appointment->patient->user_id != Auth::id()
        ) {

            abort(403);

        }


        $appointment->load('service');


        return view(
            'appointments.thank-you',
            compact('appointment')
        );
    }



    public function summary(
        Appointments $appointment
    ) {

        $notifications = auth()
            ->user()
            ->notifications()
            ->latest()
            ->get();

        $notificationCount = auth()
            ->user()
            ->unreadNotifications()
            ->count();


        return view(
            'appointments.summary',
            compact(
                'appointment',
                'notifications',
                'notificationCount'
            )
        );
    }



    public function homepage()
    {

        $appointmentHistory = Appointments::whereHas(
            'patient',
            function ($query) {

                $query->where(
                    'user_id',
                    Auth::id()
                );

            }
        )
            ->with('service')
            ->latest('appointment_date')
            ->paginate(5)
            ->withQueryString();


        $notifications = auth()
            ->user()
            ->notifications()
            ->latest()
            ->get();


        $notificationCount = auth()
            ->user()
            ->notifications()
            ->whereNull('read_at')
            ->count();


        $totalOutstanding = Appointments::whereHas(
            'patient',
            function ($query) {

                $query->where(
                    'user_id',
                    Auth::id()
                );

            }
        )
            ->sum('balance');


        $totalPaid = Appointments::whereHas(
            'patient',
            function ($query) {

                $query->where(
                    'user_id',
                    Auth::id()
                );

            }
        )
            ->sum('amount_paid');


        $totalAppointments = Appointments::whereHas(
            'patient',
            function ($query) {

                $query->where(
                    'user_id',
                    Auth::id()
                );

            }
        )
            ->count();


        $pendingPayments = Appointments::whereHas(
            'patient',
            function ($query) {

                $query->where(
                    'user_id',
                    Auth::id()
                );

            }
        )
            ->where(
                'balance',
                '>',
                0
            )
            ->count();


        $services = Service::all();


        return view(
            'appointments.appointment-homepage',
            compact(
                'appointmentHistory',
                'notifications',
                'notificationCount',
                'services',
                'totalOutstanding',
                'totalPaid',
                'totalAppointments',
                'pendingPayments'
            )
        );
    }



public function cancel(
    Appointments $appointment
) {


    if (
        $appointment->patient->user_id != Auth::id()
    ) {
        abort(403);
    }




    if (
        in_array(
            $appointment->status,
            [
                'completed',
                'cancelled',
                'cancellation_requested',
            ]
        )
    ) {
        return back()
            ->with(
                'error',
                'This appointment cannot be cancelled.'
            );
    }




    $startOfMonth = Carbon::now()->startOfMonth();

    $endOfMonth = Carbon::now()->endOfMonth();


    $monthlyCancellationCount = Appointments::query()
        ->whereHas(
            'patient',
            function ($query) {
                $query->where(
                    'user_id',
                    Auth::id()
                );
            }
        )
        ->whereIn(
            'status',
            [
                'cancellation_requested',
                'cancelled',
            ]
        )
        ->whereBetween(
            'updated_at',
            [
                $startOfMonth,
                $endOfMonth,
            ]
        )
        ->count();




    if ($monthlyCancellationCount >= 3) {
        return back()
            ->with(
                'error',
                'You have reached the maximum of 3 cancellation requests for this month.'
            );
    }




    $appointment->update([
        'status' => 'cancellation_requested',
    ]);




    return redirect()
        ->route(
            'appointments.homepage'
        )
        ->with(
            'success',
            'Cancellation request submitted. Please wait for the clinic to review it.'
        );
}




    public function history(
        Request $request
    ) {

        $query = Appointments::whereHas(
            'patient',
            function ($q) {

                $q->where(
                    'user_id',
                    Auth::id()
                );

            }
        );




        if ($request->search) {

            $query->where(
                function ($q) use ($request) {

                    $q->where(
                        'doctor_name',
                        'like',
                        '%' . $request->search . '%'
                    )

                        ->orWhere(
                            'reason',
                            'like',
                            '%' . $request->search . '%'
                        )

                        ->orWhereDate(
                            'appointment_date',
                            $request->search
                        );

                }
            );

        }




        if (
            $request->status
            && $request->status !== 'all'
        ) {

            $query->where(
                'payment_status',
                match ($request->status) {

                    'paid' =>
                        'Paid',

                    'partial' =>
                        'Partially Paid',

                    'unpaid' =>
                        'Unpaid',

                    default =>
                        $request->status,

                }
            );

        }




        $appointments = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        $totalOutstanding =
            $query->sum('balance');


        $totalPaid =
            $query->sum('amount_paid');


        $totalAppointments =
            $query->count();


        $pendingPayments =
            $query
                ->where(
                    'balance',
                    '>',
                    0
                )
                ->count();




        $notifications = auth()
            ->user()
            ->notifications()
            ->latest()
            ->get();


        $notificationCount =
            auth()
                ->user()
                ->notifications()
                ->whereNull('read_at')
                ->count();




        $services = Appointments::select(
            'service_id'
        )
            ->distinct()
            ->with('service')
            ->get()
            ->pluck('service')
            ->filter();




        $doctors = Appointments::select(
            'doctor_name'
        )
            ->distinct()
            ->pluck(
                'doctor_name'
            );


        return view(
            'appointments.appointment-history',
            compact(
                'appointments',
                'totalOutstanding',
                'totalPaid',
                'totalAppointments',
                'pendingPayments',
                'notifications',
                'notificationCount',
                'doctors',
                'services'
            )
        );
    }




    public function settings()
    {

        $user = Auth::user();


        $notifications = auth()
            ->user()
            ->notifications()
            ->latest()
            ->get();


        $notificationCount = auth()
            ->user()
            ->notifications()
            ->whereNull('read_at')
            ->count();


        return view(
            'appointments.settings',
            compact(
                'user',
                'notifications',
                'notificationCount'
            )
        );
    }




    public function updateNotificationSettings(
        Request $request
    ) {

        $user = Auth::user();


        $user->update([

            'appointment_reminders' =>
                $request->boolean(
                    'appointment_reminders'
                ),

            'promotional_emails' =>
                $request->boolean(
                    'promotional_emails'
                ),

        ]);


        return back()
            ->with(
                'success',
                'Notification settings updated successfully.'
            );
    }




    public function updateProfile(
        Request $request
    ) {

        $request->validate([

            'profile_picture' =>
                'nullable|image|max:2048',

        ]);


        $user = Auth::user();


        if (
            $request->hasFile(
                'profile_picture'
            )
        ) {

            if (
                $user->profile_picture
            ) {

                Storage::disk('public')
                    ->delete(
                        $user->profile_picture
                    );

            }


            $user->profile_picture =
                $request
                    ->file(
                        'profile_picture'
                    )
                    ->store(
                        'profile_pictures',
                        'public'
                    );

        }


        $user->save();


        return back()
            ->with(
                'success',
                'Profile picture updated!'
            );
    }




public function availableSlots(Request $request)
{
    $validated = $request->validate([
        'date' => [
            'required',
            'date',
        ],

        'service_id' => [
            'required',
            'exists:services,id',
        ],
    ]);

    $date = $validated['date'];

    $service = Service::findOrFail(
        $validated['service_id']
    );



    $duration = (int) (
        $service->duration_minutes ?? 0
    );

    if ($duration <= 0) {
        return response()->json([
            'message' =>
                'The selected service does not have a valid duration.'
        ], 422);
    }




    $clinicStart = Carbon::parse(
        $date . ' 08:00:00'
    );

    $clinicEnd = Carbon::parse(
        $date . ' 17:00:00'
    );




    $now = now();




    $dailyAppointmentCount = Appointments::query()
        ->whereDate(
            'appointment_date',
            $date
        )
        ->whereNotIn(
            'status',
            [
                'cancelled',
                'declined',
            ]
        )
        ->count();


    $maximumPatientsPerDay = 20;




    $appointments = Appointments::query()
        ->whereDate(
            'appointment_date',
            $date
        )
        ->whereNotIn(
            'status',
            [
                'cancelled',
                'declined',
            ]
        )
        ->with('service')
        ->get();




    $slots = [];

    $currentTime = $clinicStart->copy();


    while (
        $currentTime
            ->copy()
            ->addMinutes($duration)
            ->lessThanOrEqualTo($clinicEnd)
    ) {



        $slotStartCarbon = $currentTime->copy();




        $slotEndCarbon = $currentTime
            ->copy()
            ->addMinutes($duration);




        $isOverlapping = false;


        foreach ($appointments as $appointment) {



            $appointmentStart = Carbon::parse(
                $date . ' ' . $appointment->appointment_time
            );




            if ($appointment->end_time) {

                $appointmentEnd = Carbon::parse(
                    $date . ' ' . $appointment->end_time
                );

            } else {

                $existingDuration = 0;

                if ($appointment->service) {

                    $existingDuration = (int) (
                        $appointment
                            ->service
                            ->duration_minutes ?? 0
                    );

                }



                if ($existingDuration <= 0) {

                    $existingDuration = $duration;

                }


                $appointmentEnd = $appointmentStart
                    ->copy()
                    ->addMinutes(
                        $existingDuration
                    );

            }




            if (
                $appointmentStart->lt($slotEndCarbon)
                &&
                $appointmentEnd->gt($slotStartCarbon)
            ) {

                $isOverlapping = true;

                break;
            }
        }




        $isPastTime = false;


        if (
            $date === $now->toDateString()
            &&
            $slotStartCarbon->lessThanOrEqualTo($now)
        ) {

            $isPastTime = true;

        }




        $dailyLimitReached =
            $dailyAppointmentCount >=
            $maximumPatientsPerDay;




        $available =
            !$isOverlapping
            &&
            !$isPastTime
            &&
            !$dailyLimitReached;




        $slots[] = [

            'time' =>
                $slotStartCarbon->format('h:i A'),

            'start' =>
                $slotStartCarbon->format('H:i:s'),

            'end' =>
                $slotEndCarbon->format('H:i:s'),

            'duration' =>
                $duration,

            'available' =>
                $available,

        ];




        $currentTime->addMinutes(
            $duration
        );
    }


    return response()->json(
        $slots
    );
}



    public function printHistory(
        Request $request
    ) {

        $appointments =
            Appointments::whereHas(
                'patient',
                function ($query) {

                    $query->where(
                        'user_id',
                        Auth::id()
                    );

                }
            )
                ->with([
                    'service',
                    'patient'
                ])
                ->latest('appointment_date')
                ->get();


        return view(
            'appointments.appointment-history-print',
            compact('appointments')
        );
    }
}
