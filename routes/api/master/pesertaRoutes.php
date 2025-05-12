<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\PetugasController;

Route::prefix('master')
  ->middleware(['auth:sanctum', 'role.access'])
  ->controller(PetugasController::class)
  ->group(function () {
    Route::get('petugas', 'index');
    Route::post('petugas', 'store');
    Route::put('petugas/{id}', 'update');
    Route::delete('petugas/{id}', 'destroy');
  });
