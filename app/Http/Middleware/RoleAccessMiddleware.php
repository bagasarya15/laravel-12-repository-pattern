<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class RoleAccessMiddleware
{
  use ResponseTrait;

  public function handle(Request $request, Closure $next)
  {
    $roles = Auth::user()->roles->pluck('slug')->toArray();

    if ($request->isMethod('get')) {
      return $next($request);
    }

    if (in_array('admin', $roles) || in_array('super-admin', $roles)) {
      return $next($request);
    }

    return response()->json([
      'status' => $this->httpCode('FORBIDDEN'),
      'message' => $this->message('FORBIDDEN')
    ], $this->httpCode('FORBIDDEN'));
  }
}
