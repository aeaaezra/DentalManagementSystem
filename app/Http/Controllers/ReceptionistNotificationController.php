<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceptionistNotificationController extends Controller
{
    /**
     * Display receptionist notifications.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $notifications = $user
            ->notifications()
            ->latest()
            ->paginate(10);

        $unreadCount = $user
            ->unreadNotifications()
            ->count();

        return view(
            'receptionist.notifications.index',
            compact(
                'notifications',
                'unreadCount'
            )
        );
    }


    /**
     * Mark one notification as read.
     */
    public function markAsRead(Request $request, string $id)
    {
        $notification = $request->user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        if (!$notification->read_at) {
            $notification->markAsRead();
        }

        return back()->with(
            'success',
            'Notification marked as read.'
        );
    }


    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(Request $request)
    {
        $request->user()
            ->unreadNotifications
            ->markAsRead();

        return back()->with(
            'success',
            'All notifications marked as read.'
        );
    }

    public function destroy($notification)
{
    $notification = auth()
        ->user()
        ->notifications()
        ->where('id', $notification)
        ->firstOrFail();

    $notification->delete();

    return redirect()
        ->route('receptionist.notifications.index')
        ->with(
            'success',
            'Notification deleted successfully.'
        );
}
}
