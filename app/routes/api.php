<?php

use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\OrganizationController;
use App\Http\Middleware\VerifyApiToken;
use Illuminate\Support\Facades\Route;

Route::middleware([VerifyApiToken::class])->group(function () {
    Route::prefix('buildings')->group(function () {
        Route::get('/', [BuildingController::class, 'index']);
        Route::post('/geoSearch', [BuildingController::class, 'geoSearch']);
    });

    Route::get('/activity-types', [ActivityTypeController::class, 'index']);

    Route::prefix('organization')->group(function () {
        Route::get('/{id}', [OrganizationController::class, 'getById']);
    });

    Route::prefix('organizations')->group(function () {
        Route::get('/', [OrganizationController::class, 'index']);
        Route::get('/by-building/{buildingId}', [OrganizationController::class, 'indexByBuilding']);
        Route::get('/by-activity-type/{activityTypeId}', [OrganizationController::class, 'indexByActivityType']);
        Route::get('/search/by-name/{query}', [OrganizationController::class, 'searchByName']);
        Route::post('/search/by-activity-type', [OrganizationController::class, 'searchByActivityType']);
    });
});
