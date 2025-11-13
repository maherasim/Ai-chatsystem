<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScreenLockMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Guests cannot be locked
        if (!auth()->check()) {
            return $next($request);
        }

        // Allow specific routes while locked
        $routeName = optional($request->route())->getName();
        $allowedNames = [
            'user.unlockScreen', // unlock API
            'user.toggleTwoFactor',
            'logout', 'signout', 'login', 'register-user', 'register.custom',
            'locked.page', // locked screen view
        ];
        if ($routeName && in_array($routeName, $allowedNames, true)) {
            return $next($request);
        }

        // Allow POST to lock endpoint even if locked
        if ($routeName === 'user.lockScreen') {
            return $next($request);
        }

        // Skip non-HTML requests (e.g., assets, API JSON)
        if ($request->expectsJson() || $request->is('storage/*') || $request->is('build/*') || $request->is('public/*')) {
            return $next($request);
        }

        // If user disabled screen lock, remove any server lock flag
        $setting = \App\Models\Setting::where('user_id', auth()->id())->first();
        $isEnabled = (bool)($setting->screen_lock ?? false);
        if (!$isEnabled) {
            $request->session()->forget('screen_locked');
            return $next($request);
        }

        // Enforce: when locked, redirect to home (overlay will handle lock screen)
        if ($request->session()->get('screen_locked') === true) {
            $request->session()->put('intended_url', $request->fullUrl());
            // Redirect to home instead of /locked - overlay will show automatically
            return redirect()->route('home');
        }

        return $next($request);
    }
}

