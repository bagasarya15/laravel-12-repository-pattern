<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
  ->middleware(['auth:sanctum', 'role.access'])
  ->controller(DashboardController::class)
  ->group(function () {
    //
  });
