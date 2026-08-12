<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\Booking;

class BookingService
{
    public function getAvailableSlots($date)
    {
        $start = Carbon::parse($date . ' 07:00');
        $end = Carbon::parse($date . ' 21:00');

        $slots = [];

        while ($start < $end) {
            $slotStart = $start->copy();
            $slotEnd = $start->copy()->addHour();

            // Check if overlapping booking exists
            $isBooked = Booking::where('date', $date)
                ->where(function ($q) use ($slotStart, $slotEnd) {
                    $q->whereBetween('start_time', [$slotStart, $slotEnd])
                      ->orWhereBetween('end_time', [$slotStart, $slotEnd])
                      ->orWhere(function ($q) use ($slotStart, $slotEnd) {
                          $q->where('start_time', '<', $slotStart)
                            ->where('end_time', '>', $slotEnd);
                      });
                })
                ->exists();

            $slots[] = [
                'time' => $slotStart->format('h:i A'),
                'start' => $slotStart->format('H:i'),
                'end' => $slotEnd->format('H:i'),
                'available' => !$isBooked,
            ];

            $start->addHour();
        }

        return $slots;
    }
}
