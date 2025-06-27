<?php

use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\BuildingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/buildings', [BuildingController::class, 'index']);
    Route::get('/activity-types', [ActivityTypeController::class, 'index']);
});
