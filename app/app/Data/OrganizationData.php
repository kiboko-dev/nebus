<?php

namespace App\Data;

use App\Models\Organization;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Data;

class OrganizationData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $phone,
        public Optional|BuildingData|null $building,
        public Optional|ActivityTypeData|null $activityType,
    ) {}

    public static function fromModel(Organization $organization, array $with = []): OrganizationData
    {
        return new self(
            id: $organization->id,
            name: $organization->name,
            phone: $organization->phone,
            building: in_array('building', $with)
                ? BuildingData::fromModel($organization->building, [])
                : null,
            activityType: in_array('activityType', $with)
                ? ActivityTypeData::fromModel($organization->activityType, ['parent'])
                : null,
        );
    }}
