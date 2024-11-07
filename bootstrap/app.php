<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\Middleware\StartSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();

        // Désactivation de StartSession pour éviter les conflits de session avec Sanctum dans les requêtes API. Utiliser pour les application web tradtionnel sans api
        // $middleware->append(StartSession::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
