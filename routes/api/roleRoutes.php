<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\RoleController;

Route::prefix("master")
  ->middleware(['auth:sanctum'])
  ->group(function () {
    Route::apiResource("role", RoleController::class)
      ->except(["show"])
      ->middleware('role.access');
  });
