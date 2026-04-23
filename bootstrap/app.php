<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\TrackVisitor::class,
        ]);

        // Fix #5: user sudah login → redirect ke dashboard
        $middleware->redirectUsersTo(fn() => route('admin.dashboard'));

        // Fix #6: guest akses admin → redirect ke admin login
        $middleware->redirectGuestsTo(fn() => route('admin.login'));
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        // Fix #6 backup: session habis saat di halaman admin
        $exceptions->render(function (AuthenticationException $e, $request) {
            if ($request->is('admin*')) {
                return redirect()->route('admin.login')
                    ->with('error', 'Sesi Anda telah berakhir, silakan login kembali.');
            }
        });
    })->create();