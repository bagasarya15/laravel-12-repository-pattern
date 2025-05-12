<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RoleController;

Route::prefix('auth')
  ->middleware(['auth:sanctum', 'role.access'])
  ->controller(RoleController::class)
  ->group(function () {
    Route::get('role', 'index');
    Route::post('role', 'store');
    Route::put('role/{id}', 'update');
    Route::delete('role/{id}', 'destroy');
  });
