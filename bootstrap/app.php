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
        
        // Update user last activity on each request
        $middleware->append(\App\Http\Middleware\UpdateLastActivity::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
