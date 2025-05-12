<?php

namespace App\Repositories\Auth;

use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Auth\AuthInterface;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Auth\UserResource;

class AuthRepository implements AuthInterface
{
  use ResponseTrait;

  public function login(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'username' => 'required|string',
        'password' => 'required|string',
      ]);

      if ($validator->fails()) {
        return response()->json([
          'status' => $this->httpCode('UNPROCESSABLE'),
          'message' => $validator->errors(),
          'errors' => $validator->errors()
        ], $this->httpCode('UNPROCESSABLE'));
      }

      $user = User::with(['roles', 'pengunjung', 'petugas'])
        ->where("username", $request->username)
        ->first();

      if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
          'status' => $this->httpCode('UNAUTHORIZED'),
          'message' => $this->message('INVALID_CREDENTIALS')
        ], $this->httpCode('UNAUTHORIZED'));
      }

      if ($user->tokens()->count()) {
        $user->tokens()->delete();
      }

      $token = $user->createToken('user-token')->plainTextToken;

      $resource = (new UserResource($user))
        ->additional(['token' => $token])
        ->response()
        ->getData(true);

      return response()->json([
        'status' => $this->httpCode('OK'),
        'message' => $this->message('LOGIN_SUCCESS'),
        'records' => $resource
      ], $this->httpCode('OK'));
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
