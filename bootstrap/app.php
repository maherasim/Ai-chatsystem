<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Handle reverse proxy (Trust Proxies)
        $middleware->trustProxies(at: '*');
        
        // Update user last activity on each request in the web group
        $middleware->web(append: [
            \App\Http\Middleware\UpdateLastActivity::class,
        ]);

        // Exempt logout from CSRF to prevent 419 errors
        $middleware->validateCsrfTokens(except: [
            'logout',
            'signout',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
