<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
  public function render($request, Throwable $exception): JsonResponse
  {
    $statusCode = 500;
    $message = $exception->getMessage() ?: 'An error occurred.';

    if ($exception instanceof ValidationException) {
      return response()->json([
        'status' => 422,
        'message' =>  $exception->getMessage() ?: 'Validation error.',
        'errors' => $exception->errors(),
      ], 422);
    }

    if ($exception instanceof AuthenticationException) {
      $statusCode = 401;
      $message = $exception->getMessage() ?: 'Unauthorized access.';
    }

    if ($exception instanceof NotFoundHttpException) {
      $statusCode = 404;
      $message = $exception->getMessage() ?: 'API route not found.';
    }

    if ($exception instanceof QueryException) {
      $statusCode = 500;
      $message = 'Database error: ' . $exception->getMessage();
    }

    if ($exception instanceof HttpException) {
      $statusCode = $exception->getStatusCode();
    }

    return response()->json([
      'status' => $statusCode,
      'message' => $message,
    ], $statusCode);
  }
}
