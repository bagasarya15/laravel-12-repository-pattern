<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\PengunjungController;

Route::prefix('master')
  ->middleware(['auth:sanctum', 'role.access'])
  ->controller(PengunjungController::class)
  ->group(function () {
    Route::get('pengunjung', 'index');
    Route::post('pengunjung', 'store');
    Route::put('pengunjung/{id}', 'update');
    Route::delete('pengunjung/{id}', 'destroy');
  });
