<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReceiverNotificationController extends Controller
{
    /**
     * Display a listing of notifications for the receiver.
     */
    public function index(): View
    {
        $userId = auth()->id();

        $notifications = Notification::where('user_id', $userId)
            ->latest()
            ->paginate(15);

        $unreadCount = Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->count();

        return view('receiver.notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * Mark a single notification as read.
     */
    public function markAsRead(Notification $notification): RedirectResponse
    {
        abort_unless($notification->user_id === auth()->id(), 403);

        $notification->update(['is_read' => true]);

        return back()->with('success', 'Notification marked as read.');
    }

    /**
     * Mark all notifications as read for current user.
     */
    public function markAllAsRead(): RedirectResponse
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete a notification.
     */
    public function destroy(Notification $notification): RedirectResponse
    {
        abort_unless($notification->user_id === auth()->id(), 403);

        $notification->delete();

        return back()->with('success', 'Notification removed.');
    }
}
