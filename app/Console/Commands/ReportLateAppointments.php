<?php

namespace App\Console\Commands;

use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:report-late-appointments')]
#[Description('Report overdue confirmed appointments without changing bookings')]
class ReportLateAppointments extends Command
{
    public function handle(): int
    {
        $now = now();

        $this->info('LATE APPOINTMENTS DRY RUN');
        $this->line('Current time: '.$now->toDateTimeString());
        $this->line('No appointments will be changed and no emails will be sent.');
        $this->newLine();

        $appointments = Appointments::query()
            ->where('status', 'confirmed')
            ->whereNull('checked_in_at')
            ->whereNull('treatment_started_at')
            ->whereNull('checked_out_at')
            ->whereDate('appointment_date', $now->toDateString())
            ->with(['patient.user', 'service'])
            ->orderBy('appointment_time')
            ->get();

        $count = 0;

        foreach ($appointments as $appointment) {
            $appointmentDateTime = Carbon::parse(
                $appointment->appointment_date->format('Y-m-d')
                .' '.$appointment->appointment_time
            );

            if ($now->lt($appointmentDateTime->copy()->addMinutes(30))) {
                continue;
            }

            $count++;

            $duration = (int) ($appointment->service?->duration_minutes ?? 0);
            $patientEmail = $appointment->patient?->user?->email;

            $this->warn('Appointment #'.$appointment->id);
            $this->line('  Scheduled: '.$appointmentDateTime->format('Y-m-d h:i A'));
            $this->line('  Minutes late: '.$appointmentDateTime->diffInMinutes($now));
            $this->line('  Patient email: '.($patientEmail ?: 'MISSING'));
            $this->line('  Service duration: '.($duration > 0 ? $duration.' minutes' : 'INVALID / MISSING'));

            if ($duration <= 0) {
                $this->error('  Result: MANUAL REVIEW — service duration is invalid.');
                $this->newLine();
                continue;
            }

            if (!$patientEmail) {
                $this->warn('  Result: MANUAL REVIEW — no patient email is available.');
                $this->newLine();
                continue;
            }

            $appointmentsForDay = Appointments::query()
                ->whereDate('appointment_date', $now->toDateString())
                ->where('id', '!=', $appointment->id)
                ->whereNotIn('status', ['cancelled', 'declined'])
                ->with('service')
                ->get();

            $candidate = $now->copy()
                ->startOfMinute()
                ->addMinute();

            $candidate->second(0);

            $clinicEnd = Carbon::parse($now->toDateString().' 17:00:00');
            $proposed = null;

            while (
                $candidate->copy()->addMinutes($duration)->lessThanOrEqualTo($clinicEnd)
            ) {
                $overlap = false;

                foreach ($appointmentsForDay as $existing) {
                    $existingStart = Carbon::parse(
                        $now->toDateString().' '.$existing->appointment_time
                    );

                    if ($existing->end_time) {
                        $existingEnd = Carbon::parse(
                            $now->toDateString().' '.$existing->end_time
                        );
                    } else {
                        $existingDuration = (int) (
                            $existing->service?->duration_minutes ?? $duration
                        );

                        if ($existingDuration <= 0) {
                            $existingDuration = $duration;
                        }

                        $existingEnd = $existingStart->copy()
                            ->addMinutes($existingDuration);
                    }

                    if (
                        $existingStart->lt($candidate->copy()->addMinutes($duration))
                        && $existingEnd->gt($candidate)
                    ) {
                        $overlap = true;
                        break;
                    }
                }

                if (!$overlap) {
                    $proposed = $candidate->copy();
                    break;
                }

                $candidate->addMinutes($duration);
            }

            if ($proposed) {
                $this->info(
                    '  Dry-run proposal: '.$proposed->format('h:i A')
                    .' to '.$proposed->copy()->addMinutes($duration)->format('h:i A')
                );
                $this->line('  Result: CANDIDATE SLOT ONLY — not reserved or saved.');
            } else {
                $this->warn(
                    '  Result: NO SAME-DAY SLOT FOUND — receptionist review required.'
                );
            }

            $this->newLine();
        }

        if ($count === 0) {
            $this->info('No overdue confirmed appointments were found for today.');
        } else {
            $this->info('Overdue appointments reported: '.$count);
        }

        return self::SUCCESS;
    }
}
