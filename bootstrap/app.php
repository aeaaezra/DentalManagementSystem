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
        | Redirect unauthenticated users
        |--------------------------------------------------------------------------
        */

        $middleware->redirectGuestsTo(function (Request $request) {

            /*
            |--------------------------------------------------------------------------
            | Appointment pages → Appointment Login
            |--------------------------------------------------------------------------
            */

            if (
                $request->is('shine-and-smile/appointments/*') ||
                $request->is('shine-and-smile/appointments-booking')
            ) {
                return url('/shine-and-smile/appointments/login');
            }

            /*
            |--------------------------------------------------------------------------
            | Everything else → Normal Login
            |--------------------------------------------------------------------------
            */

            return url('/login');
        });

    })

    ->withExceptions(function (Exceptions $exceptions): void {

        //
    })

    ->create();
