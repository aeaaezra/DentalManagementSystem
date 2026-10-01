<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class PrefetchController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $notifications = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', User::class)
            ->latest()
            ->take(5)
            ->get();

        $notificationCount = Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', User::class)
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'notificationCount' => $notificationCount,
        ]);
    }
}
