<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Admin;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\Users;
use App\Http\Middleware\Sales;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        $middleware->alias([
            'admin' => App\Http\Middleware\Admin::class,
            'role' => App\Http\Middleware\CheckRole::class,
            'users' => App\Http\Middleware\Users::class,
            'sales' => App\Http\Middleware\RedirectIfNotSales::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
