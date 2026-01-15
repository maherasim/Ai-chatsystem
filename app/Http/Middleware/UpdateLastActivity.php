<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UpdateLastActivity
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Update last_activity for authenticated users
        if (Auth::check()) {
            $user = Auth::user();
            // Only update if more than 30 seconds have passed (to avoid too many DB writes)
            if (!$user->last_activity || $user->last_activity->diffInSeconds(now()) > 30) {
                $user->last_activity = now();
                $user->save();
            }
        }

        return $next($request);
    }
}
