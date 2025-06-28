<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use App\Http\Middleware\forceJSONResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Spatie\Permission\Middleware\{RoleMiddleware, PermissionMiddleware, RoleOrPermissionMiddleware};

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(web: __DIR__ . '/../routes/web.php', api: __DIR__ . '/../routes/api.php', commands: __DIR__ . '/../routes/console.php', health: '/up')
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
        $middleware->append(forceJSONResponse::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // $exceptions->render(function (NotFoundHttpException $e, Request $request) {
        //     dd("HTTP EXCEPTION");
        //     if ($request->is('api/*')) {
        //         return response()->json(
        //             [
        //                 'code' => 404,
        //                 'status' => false,
        //                 'message' => 'Route not found',
        //             ],
        //             404,
        //         );
        //     }
        // });
        
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(
                    [
                        'code' => 401,
                        'status' => false,
                        'message' => 'Akses tidak diizinkan. Silakan masuk terlebih dahulu.',
                    ],
                    401,
                );
            }
        });
    })
    ->withSchedule(function ($schedule) {
        $schedule->command('auth:clear-resets')->hourly();
    })
    ->create();
