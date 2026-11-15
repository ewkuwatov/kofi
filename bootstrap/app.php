<?php

use App\Http\Middleware\StudioAccess;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(['studio' => StudioAccess::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Laravel's default exception handling is suitable for this app.
    })
    ->create();
