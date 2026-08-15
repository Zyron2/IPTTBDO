<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()
            ->limit(30)
            ->get();

        return response()->json([
            'unread_count' => $request->user()->unreadNotifications()->count(),
            'notifications' => $notifications->map(function ($notification) {
                $data = $notification->data;

                return [
                    'id' => $notification->id,
                    'read' => ! is_null($notification->read_at),
                    'message' => $data['message'] ?? 'New update',
                    'application_id' => $data['application_id'] ?? null,
                    'tracking_no' => $data['tracking_no'] ?? null,
                    'created_at' => $notification->created_at?->diffForHumans(),
                ];
            }),
        ]);
    }

    public function markAsRead(Request $request, string $notificationId)
    {
        $request->user()->notifications()
            ->where('id', $notificationId)
            ->get()
            ->each->markAsRead();

        return response()->json(['ok' => true]);
    }

    public function markAllAsRead(Request $request)
    {
        $request->user()->unreadNotifications()->get()->each->markAsRead();

        return response()->json(['ok' => true]);
    }
}
