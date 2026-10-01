<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    // STORE FEEDBACK

    public function store(
        Request $request,
        $appointmentId
    ) {

        $validated = $request->validate([

            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],

            'comment' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ]);


        $appointment = Appointments::query()
            ->where('id', $appointmentId)
            ->where(
                'user_id',
                auth()->id()
            )
            ->firstOrFail();


        // ONLY COMPLETED APPOINTMENTS

        if (
            $appointment->status !== 'completed'
        ) {

            return back()->with(
                'error',
                'Feedback can only be submitted after your appointment is completed.'
            );

        }


        // PREVENT DUPLICATE FEEDBACK

        if (
            $appointment->feedback
        ) {

            return back()->with(
                'error',
                'You have already submitted feedback for this appointment.'
            );

        }


        // CREATE FEEDBACK

        Feedback::create([

            'user_id' =>
                auth()->id(),

            'appointment_id' =>
                $appointment->id,

            'rating' =>
                $validated['rating'],

            'comment' =>
                $validated['comment'] ?? null,

        ]);


        return back()->with(
            'feedback_success',
            'Thank you for your feedback!'
        );
    }
}
