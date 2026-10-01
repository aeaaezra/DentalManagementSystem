<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\PatientRecords;
use Carbon\Carbon;

class DentistDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $now = Carbon::now();

        $appointmentStats = Appointments::query()
            ->whereDate('appointment_date', $today)
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as confirmed,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed
            ")
            ->first();

        $todayAppointments = $appointmentStats->total ?? 0;
        $pendingAppointments = $appointmentStats->pending ?? 0;
        $confirmedAppointments = $appointmentStats->confirmed ?? 0;
        $completedToday = $appointmentStats->completed ?? 0;

        $pendingToday = $pendingAppointments;
        $confirmedToday = $confirmedAppointments;

        /*
        |--------------------------------------------------------------------------
        | TOTAL PATIENTS
        |--------------------------------------------------------------------------
        */

        $totalPatients = PatientRecords::count();

        /*
        |--------------------------------------------------------------------------
        | TODAY'S APPOINTMENT LIST
        |--------------------------------------------------------------------------
        */

        $todayAppointmentList = Appointments::query()
            ->with([
                'patient',
                'service',
            ])
            ->whereDate('appointment_date', $today)
            ->orderByRaw('appointment_time IS NULL')
            ->orderBy('appointment_time')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | NEXT APPOINTMENT
        |--------------------------------------------------------------------------
        */

        $nextAppointment = Appointments::query()
            ->with([
                'patient',
                'service',
            ])
            ->whereIn('status', [
                'pending',
                'confirmed',
            ])
            ->where(function ($query) use ($today, $now) {
                $query
                    ->whereDate(
                        'appointment_date',
                        '>',
                        $today
                    )
                    ->orWhere(function ($query) use ($today, $now) {
                        $query
                            ->whereDate(
                                'appointment_date',
                                $today
                            )
                            ->whereTime(
                                'appointment_time',
                                '>=',
                                $now->format('H:i:s')
                            );
                    });
            })
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | RECENT PATIENTS
        |--------------------------------------------------------------------------
        */

        $recentPatients = PatientRecords::query()
            ->latest('created_at')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RETURN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view(
            'dentist.dashboard',
            compact(
                'todayAppointments',
                'pendingAppointments',
                'confirmedAppointments',
                'totalPatients',
                'todayAppointmentList',
                'nextAppointment',
                'recentPatients',
                'completedToday',
                'pendingToday',
                'confirmedToday'
            )
        );
    }
}
