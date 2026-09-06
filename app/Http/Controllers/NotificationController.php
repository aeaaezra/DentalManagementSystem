<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead(Notification $notification)
    {
        if (
            $notification->notifiable_type !== get_class(Auth::user()) ||
            $notification->notifiable_id !== Auth::id()
        ) {
            abort(403);
        }

        $notification->markAsRead();

        return response()->json([
            'success' => true,
        ]);
    }

    public function markAllAsRead()
    {
        $updated = Notification::where(
            'notifiable_type',
            get_class(Auth::user())
        )
            ->where(
                'notifiable_id',
                Auth::id()
            )
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'updated' => $updated,
        ]);
    }

    public function destroy(Notification $notification)
    {
        if (
            $notification->notifiable_type !== get_class(Auth::user()) ||
            $notification->notifiable_id !== Auth::id()
        ) {
            abort(403);
        }

        $notification->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
