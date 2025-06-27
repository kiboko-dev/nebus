<?php

namespace App\Http\Controllers;

use App\Http\Services\BuildingService;
use Illuminate\Http\JsonResponse;

class OrganizationController extends Controller
{
    public function indexByBuilding(string $buildingId): JsonResponse
    {
        return response()->json(['data' => app(BuildingService::class)->getOrganizationByBuildingId($buildingId)]);
    }

    public function indexByActivityType(string $activityTypeId): JsonResponse
    {

        return response()->json(['data' => '']);
    }

    public function indexByRadius(float $latitude, float $longitude, float $radius): JsonResponse
    {

        return response()->json(['data' => '']);
    }

    public function getById(string $id): JsonResponse
    {

        return response()->json(['data' => '']);
    }

    public function searchByActivityType(string $activityType): JsonResponse
    {

        return response()->json(['data' => '']);
    }

    public function searchByName(string $name): JsonResponse
    {

        return response()->json(['data' => '']);
    }
}
