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
    ->withMiddleware(function (Middleware $middleware): void {
        // Register route middleware alias if supported
        if (method_exists($middleware, 'alias')) {
            $middleware->alias(['admin' => \App\Http\Middleware\AdminMiddleware::class]);
        } elseif (method_exists($middleware, 'register')) {
            // older/newer naming fallback
            $middleware->register(['admin' => \App\Http\Middleware\AdminMiddleware::class]);
        }

        // Try to add common web middleware if the API supports adding global middleware
        $web = [
            \App\Http\Middleware\TrustProxies::class,
            \Fruitcake\Cors\HandleCors::class,
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ];

        foreach ($web as $m) {
            if (method_exists($middleware, 'add')) {
                $middleware->add($m);
            } elseif (method_exists($middleware, 'push')) {
                $middleware->push($m);
            }
        }
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
