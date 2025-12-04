<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Get order notifications (envelope icon)
    public function getOrderNotifications()
    {
        $notifications = ActivityLog::orderNotifications()
            ->take(10)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'message' => $notification->message,
                    'icon' => $notification->icon,
                    'time' => $notification->created_at->diffForHumans(),
                    'is_read' => $notification->is_read,
                    'related_id' => $notification->related_id,
                ];
            });

        $unreadCount = ActivityLog::orderNotifications()->unread()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    // Get system notifications (bell icon)
    public function getSystemNotifications()
    {
        $notifications = ActivityLog::systemNotifications()
            ->take(10)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'message' => $notification->message,
                    'icon' => $notification->icon,
                    'time' => $notification->created_at->diffForHumans(),
                    'is_read' => $notification->is_read,
                ];
            });

        $unreadCount = ActivityLog::systemNotifications()->unread()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    // Mark notification as read
    public function markAsRead(Request $request)
    {
        $notification = ActivityLog::find($request->id);
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    // Mark all as read
    public function markAllAsRead(Request $request)
    {
        $type = $request->type; // 'order' atau 'system'
        ActivityLog::where('type', $type)->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}
