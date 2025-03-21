<?php

use Illuminate\Support\Facades\Route;

use Rap2hpoutre\LaravelLogViewer\LogViewerController;

Route::get('logs', [LogViewerController::class, 'index']);
