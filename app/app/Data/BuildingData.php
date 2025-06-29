<?php

namespace App\Data;

use App\Models\Building;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class BuildingData extends Data
{
    public function __construct(
        public string $id,
        public string $address,
        public float $latitude,
        public float $longitude,
        public Optional|array|null $organizations,
    ) {}

    public static function fromModel(Building $building, array $with = []): BuildingData
    {
        return new self(
        id: $building->id,
        address: $building->address,latitude: $building->latitude, longitude: $building->longitude,
        organizations: in_array('organizations', $with)
            ? OrganizationData::collect($building->organizations)->toArray()
            : null
        );
    }
}
