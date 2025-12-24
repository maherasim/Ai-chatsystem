<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get all notifications for the authenticated user
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        try {
            $notifications = Notification::where('user_id', (string)($user->_id ?? $user->id))
                ->orderByDesc('created_at')
                ->limit(50)
                ->get()
                ->map(function ($notification) {
                    // Load relationships safely
                    try {
                        if ($notification->task_id) {
                            $notification->task = \App\Models\Task::find($notification->task_id);
                        }
                    } catch (\Exception $e) {
                        $notification->task = null;
                    }
                    
                    try {
                        if ($notification->created_by) {
                            $notification->creator = \App\Models\User::find($notification->created_by);
                        }
                    } catch (\Exception $e) {
                        $notification->creator = null;
                    }
                    
                    return $notification;
                });

            $unreadCount = Notification::where('user_id', (string)($user->_id ?? $user->id))
                ->where('read', false)
                ->count();

            return response()->json([
                'success' => true,
                'notifications' => $notifications,
                'unread_count' => $unreadCount,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching notifications: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = Notification::where('_id', $id)
            ->where('user_id', (string)($user->_id ?? $user->id))
            ->first();

        if ($notification) {
            $notification->read = true;
            $notification->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        Notification::where('user_id', (string)($user->_id ?? $user->id))
            ->where('read', false)
            ->update(['read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Delete notification
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $notification = Notification::where('_id', $id)
            ->where('user_id', (string)($user->_id ?? $user->id))
            ->first();

        if ($notification) {
            $notification->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
    }

    /**
     * Delete all notifications
     */
    public function destroyAll()
    {
        $user = Auth::user();
        Notification::where('user_id', (string)($user->_id ?? $user->id))->delete();

        return response()->json(['success' => true]);
    }
}

