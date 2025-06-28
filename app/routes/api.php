<?php

use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\OrganizationController;
use App\Http\Middleware\VerifyApiToken;
use Illuminate\Support\Facades\Route;

Route::middleware([VerifyApiToken::class])->group(function () {
    Route::get('/buildings', [BuildingController::class, 'index']);
    Route::get('/activity-types', [ActivityTypeController::class, 'index']);

    Route::prefix('organizations')->group(function () {
        Route::get('/by-building/{building}', [OrganizationController::class, 'indexByBuilding']);
    });
});
