<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Spatie\Permission\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | Register Spatie Role Middleware
        |--------------------------------------------------------------------------
        */

        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Redirect Unauthenticated Users
        |--------------------------------------------------------------------------
        |
        | Appointment pages go to the appointment login page.
        | All other protected pages go to the normal system login.
        |
        */

        $middleware->redirectGuestsTo(function (Request $request) {

            if ($request->is('appointments/*')) {
                return route('appointments.login');
            }

            return route('login');
        });
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();
