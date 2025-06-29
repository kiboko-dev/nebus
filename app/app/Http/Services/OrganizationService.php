<?php

namespace App\Http\Services;

use App\Data\BuildingData;
use App\Http\Repositories\ActivityTypeRepository;
use App\Http\Repositories\BuildingRepository;

class OrganizationService
{
    public function __construct(
        protected BuildingRepository $buildingRepository,
        protected ActivityTypeRepository $activityTypeRepository,
    ){
    }

    public function byBuildingId(string $buildingId): BuildingData
    {
        return $this->buildingRepository->getWithOrganizations($buildingId);
    }

    public function byActivityTypeId(int $activityTypeId)
    {
        return $this->activityTypeRepository->getWithOrganizations($activityTypeId);
    }
}
