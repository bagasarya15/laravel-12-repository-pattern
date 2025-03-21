<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateJson extends Middleware
{
  protected function unauthenticated($request, array $guards)
  {
    throw new AuthenticationException(
      'Unauthorized. Please provide a valid authentication token.'
    );
  }
}
