<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 🔥 REGISTRA O MIDDLEWARE AQUI
        $middleware->alias([
            'check.session' => \App\Http\Middleware\CheckSession::class,
        ]);

        // Middlewares web
        $middleware->web([
            //
        ]);
    })
 ->withExceptions(function (Exceptions $exceptions): void {
    $exceptions->render(function (Throwable $e, Request $request) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
        ], 500);
    });
})
    ->create();