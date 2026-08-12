<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MessageReaction;

class MessageController extends Controller
{
    public function message()
    {
        $dentists = Doctor::all();

        $messages = collect();

        $receiver = null;

        $notificationCount = 0;

        $notifications = collect();

        $pinnedMessages = collect();

        return view(
            'appointments.appointments-chat',
            compact(
                'dentists',
                'messages',
                'receiver',
                'notificationCount',
                'notifications',
                'pinnedMessages'
            )
        );
    }

    public function index($userId)
    {
        $receiver = Doctor::findOrFail($userId);

        $dentists = Doctor::all();

        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $userId);
        })
        ->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', auth()->id());
        })
        ->orderBy('created_at')
        ->get();

        $pinnedMessages = Message::where('is_pinned', true)
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', auth()->id())
                      ->where('receiver_id', $userId);
            })
            ->orWhere(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', auth()->id());
            })
            ->latest()
            ->get();

        $notificationCount = 0;

        $notifications = collect();

        return view(
            'appointments.appointments-chat',
            compact(
                'messages',
                'receiver',
                'dentists',
                'notificationCount',
                'notifications',
                'pinnedMessages'
            )
        );
    }

    public function adminMessages()
    {
        $patients = User::where(
            'role',
            'patient'
        )->get();

        return view(
            'admin.messages',
            compact('patients')
        );
    }


    public function react(Request $request, Message $message)
    {

        MessageReaction::updateOrCreate(
            [
                'message_id' => $message->id,
                'user_id' => auth()->id(),
            ],
            [
                'emoji' => $request->emoji,
            ]
        );

        return back();
    }

    public function store(Request $request)
    {

        $request->validate([
            'message' => 'required'
        ]);

        if ($request->edit_message_id) {

            $message = Message::findOrFail(
                $request->edit_message_id
            );

            $message->update([
                'message' => $request->message
            ]);

        } else {

            Message::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $request->receiver_id,
                'message' => $request->message,
                'reply_to' => $request->reply_to,
            ]);

        }

        return back();
    }

    public function pin(Message $message)
    {
        $message->update([
            'is_pinned' => !$message->is_pinned
        ]);

        return back();
    }



public function unsend(
    Request $request,
    Message $message
)
{
    if ($request->type === 'everyone')
    {
        $message->update([
            'message' => 'This message was unsent'
        ]);
    }

    return back();
}



}

