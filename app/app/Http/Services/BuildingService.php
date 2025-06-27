<?php

namespace App\Http\Services;

use App\Http\Repositories\BuildingRepository;

class BuildingService
{
    public function getOrganizationByBuildingId(string $buildingId)
    {
        $building = app(BuildingRepository::class)->show($buildingId);
        return $building->organizations();
    }
}
