<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Auth\AuthInterface;

class AuthController extends Controller
{
  protected $interface;

  public function __construct(AuthInterface $interface)
  {
    $this->interface = $interface;
  }

  public function login(Request $request)
  {
    return $this->interface->login($request);
  }
}
