<?php

use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\EnsureUserIsConnected;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => EnsureUserIsConnected::class,
            'guest' => RedirectIfAuthenticated::class,
            'role' => EnsureUserHasRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $exception, Request $request) {
            if ($exception->getStatusCode() === 403) {
                return response()->view('errors.error', ['status_code' => 403], 403);
            }

            if ($exception->getStatusCode() === 404) {
                return response()->view('errors.error', ['status_code' => 404], 404);
            }

            if ($exception->getStatusCode() === 419) {
                return response()->view('errors.error', ['status_code' => 419], 419);
            }

            if ($exception->getStatusCode() === 500) {
                return response()->view('errors.error', ['status_code' => 500], 500);
            }

            if ($exception->getStatusCode() === 503) {
                return response()->view('errors.error', ['status_code' => 503], 503);
            }
        });
    })->create();
