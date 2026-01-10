<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Models\Notification;

class ViewServiceProvider extends ServiceProvider
{

    public function boot()
{
    View::composer('*', function ($view) {
        $user = Auth::user();
        
        // Initialize notifications as empty collection by default
        $notifications = collect([]);

        if ($user) {

            
            // --- Get latest 50 completed todos where user is creator or member ---
            $todos = Todo::whereIn('completed', ["1", "2", "-1", "-2"])
                ->where(function ($q) use ($user) {
                    $q->where('members', $user->_id);
                })
                ->latest()
                ->take(50)
                ->get();

            // --- Get all completed todos for rating calculation ---
           
            $allTodos = Todo::where('completed', "1")->whereIn('members', [(string) $user->_id])->get();

               

            // --- Calculate category-wise and total average rating ---
            $ratingSums = [];
            $ratingCounts = [];
            $ratingAverages = [];
            $totalSum = 0;
            $totalCount = 0;

            foreach ($allTodos as $todo) {
                if (!empty($todo->ratings) && is_array($todo->ratings)) {
                    foreach ($todo->ratings as $category => $value) {
                        $value = (float) $value;
                        if (!isset($ratingSums[$category])) {
                            $ratingSums[$category] = 0;
                            $ratingCounts[$category] = 0;
                        }
                        $ratingSums[$category] += $value;
                        $ratingCounts[$category]++;

                        $totalSum += $value;
                        $totalCount++;
                    }
                }
            }
            

            foreach ($ratingSums as $category => $sum) {
                $ratingAverages[$category] = round($sum / $ratingCounts[$category], 2);
            }

            $ratingAverages['Total'] = $totalCount > 0 ? round($totalSum / $totalCount, 2) : 0;

            // --- Get notifications for the current user ---
            $authId = $user->_id;
            $userId = (string) $authId;
            
            $allNotifications = Notification::orderByDesc('created_at')
                ->limit(1000)
                ->get();
            
            // Filter for all task-related notification types
            $taskNotificationTypes = [
                'task_assigned',
                'task_started',
                'task_on_hold',
                'task_checked',
                'task_delayed',
                'task_rejected',
                'task_completed',
                'task_status_updated',
            ];
            
            $allNotifications = $allNotifications->filter(function($notif) use ($taskNotificationTypes) {
                $type = is_string($notif->type) ? trim(rtrim($notif->type, ', ')) : (string)$notif->type;
                return in_array($type, $taskNotificationTypes);
            });
            
            $notifications = $allNotifications->filter(function($notif) use ($userId, $authId) {
                $notifUserId = $notif->user_id;
                
                if (is_object($notifUserId)) {
                    $notifUserIdStr = (string)$notifUserId;
                } else {
                    $notifUserIdStr = (string)$notifUserId;
                }
                
                $notifUserIdStr = rtrim($notifUserIdStr, '/ ');
                
                $authIdStr = (string)$authId;
                $userIdStr = (string)$userId;
                
                return ($notifUserIdStr === $userIdStr || $notifUserIdStr === $authIdStr);
            })->sortByDesc('created_at')->values();

            // Share todos, ratings, and notifications with all views
            $view->with([
                'userTodos' => $todos,
                'userRatings' => $ratingAverages,
                'notifications' => $notifications,
            ]);
        } else {
            // Share empty collections when user is not authenticated
            $view->with([
                'userTodos' => collect([]),
                'userRatings' => [],
                'notifications' => $notifications,
            ]);
        }
    });
}

    /*
    public function boot()
    {
        // Share todos with all views
        View::composer('*', function ($view) {
            $user = Auth::user();

            if ($user) {

                $todos = Todo::where('completed', 1)->where(function ($q) use ($user) {
                    $q->where('user_id', $user->_id)
                    ->orWhere('members', $user->_id);
                })->latest()->take(50)->get();

                $view->with('userTodos', $todos);
            }
        });
    }
        */

    public function register() {}
}
