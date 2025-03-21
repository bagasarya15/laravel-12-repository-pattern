<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::prefix("auth")->group(function () {
  Route::post("login", [AuthController::class, 'login']);
});
