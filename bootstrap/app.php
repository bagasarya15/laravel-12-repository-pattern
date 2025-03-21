<?php

use Illuminate\Foundation\Application;

// dd("Bootstrap is working!");

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    api: __DIR__ . '/../routes/api.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withProviders([
    \Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class,
  ])
  ->withMiddleware(function ($middleware) {
    $middleware->alias([
      'auth' => \App\Http\Middleware\AuthenticateJson::class,
      'auth:sanctum' => \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
      'role.access' => \App\Http\Middleware\RoleAccessMiddleware::class,
    ]);
  })
  ->withExceptions(function ($exceptions) {
    $exceptions->renderable(function (Throwable $exception, $request) {
      return app(App\Exceptions\Handler::class)->render($request, $exception);
    });
  })
  ->create();
