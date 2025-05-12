<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;

Route::prefix('auth')
  ->middleware(['auth:sanctum', 'role.access'])
  ->controller(UserController::class)
  ->group(function () {
    Route::get('user', 'index');
    Route::post('user', 'store');
    Route::put('user/{id}', 'update');
    Route::delete('user/{id}', 'destroy');
  });
