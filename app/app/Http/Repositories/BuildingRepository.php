<?php

namespace App\Http\Repositories;

use App\Data\BuildingData;
use App\Data\OrganizationData;
use App\Models\Building;
use Illuminate\Support\Collection;

class BuildingRepository
{
    public function index(): Collection|array
    {
        return BuildingData::collect(Building::all()->toArray());
    }

    public function getWithOrganizations(string $buildingId): BuildingData
    {
        return BuildingData::fromModel(
            building: Building::query()->with('organizations')->findOrFail($buildingId),
            with: ['organizations']
        );
    }
}
