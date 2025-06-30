<?php

namespace App\Http\Services;

use App\Data\ActivityTypeData;
use App\Data\BuildingData;
use App\Http\Repositories\ActivityTypeRepository;
use App\Http\Repositories\BuildingRepository;
use App\Http\Repositories\OrganizationRepository;
use App\Http\Requests\SearchByActivityTypeRequest;

class OrganizationService
{
    public function __construct(
        protected BuildingRepository $buildingRepository,
        protected ActivityTypeRepository $activityTypeRepository,
        protected OrganizationRepository $organizationRepository,
    ){
    }

    public function byBuildingId(string $buildingId): BuildingData
    {
        return $this->buildingRepository->getWithOrganizations($buildingId);
    }

    public function byActivityTypeId(int $activityTypeId): ActivityTypeData
    {
        return $this->activityTypeRepository->getWithOrganizations($activityTypeId);
    }

    public function searchByActivityType(array $request): array
    {
        $activityType =  $this->activityTypeRepository->getWithChild($request);
        $organizations = $this->organizationRepository->getByActivityTypeId($activityType['ids']);

        return [
            'founded_count' => count($organizations),
            'organizations' => $organizations,
        ];
    }
}
