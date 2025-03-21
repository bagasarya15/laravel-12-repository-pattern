<?php

namespace App\Interfaces\Auth;

use Illuminate\Http\Request;

interface AuthInterface
{
  public function login(Request $request);
}
