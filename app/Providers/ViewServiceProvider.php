<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;

class ViewServiceProvider extends ServiceProvider
{

    public function boot()
{
    View::composer('*', function ($view) {
        $user = Auth::user();

        if ($user) {

            // --- Get latest 50 completed todos where user is creator or member ---
            $todos = Todo::where('completed', 1)
                ->where(function ($q) use ($user) {
                    $q->where('user_id', $user->_id)
                      ->orWhere('members', $user->_id);
                })
                ->latest()
                ->take(50)
                ->get();

            // --- Get all completed todos for rating calculation ---
            $allTodos = Todo::where('completed', 1)
                ->where(function ($q) use ($user) {
                    $q->where('user_id', $user->_id)
                      ->orWhere('members', $user->_id);
                })
                ->get();

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

            // Share todos and ratings with all views
            $view->with([
                'userTodos' => $todos,
                'userRatings' => $ratingAverages,
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
