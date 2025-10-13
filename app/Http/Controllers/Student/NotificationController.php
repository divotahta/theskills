<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of notifications.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Notification::where('user_id', $user->id)->latest();
        
        // Filter by type if provided
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }
        
        // Filter by read status if provided
        if ($request->has('status')) {
            if ($request->status === 'unread') {
                $query->unread();
            } elseif ($request->status === 'read') {
                $query->read();
            }
        }
        
        $notifications = $query->paginate(15);
        
        // Get notification counts
        $unreadCount = $user->unread_notifications_count;
        $totalCount = Notification::where('user_id', $user->id)->count();
        
        // Get notification types for filter
        $types = Notification::where('user_id', $user->id)
            ->select('type')
            ->distinct()
            ->pluck('type')
            ->toArray();
        
        return view('student.notifications.index', compact(
            'notifications',
            'unreadCount',
            'totalCount',
            'types'
        ));
    }

    /**
     * Display the specified notification.
     */
    public function show(Notification $notification)
    {
        // Ensure the notification belongs to the authenticated user
        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        // Mark as read if not already read
        if (!$notification->is_read) {
            $notification->markAsRead();
        }
        
        return view('student.notifications.show', compact('notification'));
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead(Notification $notification)
    {
        // Ensure the notification belongs to the authenticated user
        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        $notification->markAsRead();
        
        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read'
        ]);
    }

    /**
     * Mark notification as unread.
     */
    public function markAsUnread(Notification $notification)
    {
        // Ensure the notification belongs to the authenticated user
        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        $notification->markAsUnread();
        
        return response()->json([
            'success' => true,
            'message' => 'Notification marked as unread'
        ]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        
        Notification::where('user_id', $user->id)
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        
        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read'
        ]);
    }

    /**
     * Delete notification.
     */
    public function destroy(Notification $notification)
    {
        // Ensure the notification belongs to the authenticated user
        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        $notification->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Notification deleted'
        ]);
    }

    /**
     * Get unread notifications count for AJAX.
     */
    public function getUnreadCount()
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'unread_count' => 0
            ]);
        }
        
        $unreadCount = $user->unread_notifications_count;
        
        return response()->json([
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * Get recent notifications for dropdown.
     */
    public function getRecent()
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'notifications' => [],
                'unread_count' => 0
            ]);
        }
        
        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();
        
        return response()->json([
            'notifications' => $notifications->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'icon' => $notification->icon,
                    'color' => $notification->color,
                    'is_read' => $notification->is_read,
                    'created_at' => $notification->created_at->diffForHumans(),
                    'url' => route('student.notifications.show', $notification),
                ];
            }),
            'unread_count' => $user->unread_notifications_count
        ]);
    }
}