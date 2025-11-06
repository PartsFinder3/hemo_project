<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // This is the CRITICAL line. It tells Laravel to look at routes/api.php
        // AND apply the /api prefix, the api middleware, etc.
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // <--- ENSURE THIS IS PRESENT
        commands: __DIR__.'/../routes/console.php',
        using: function (\Illuminate\Routing\Router $router) {
            $router->middleware('api')
                ->prefix('api') // <--- ENSURE THIS IS ALSO APPLIED
                ->group(base_path('routes/api.php'));

            $router->middleware('web')
                ->group(base_path('routes/web.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
