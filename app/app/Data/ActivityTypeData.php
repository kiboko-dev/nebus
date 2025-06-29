<?php

namespace App\Data;

use App\Models\ActivityType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ActivityTypeData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public Optional|ActivityTypeData|null $parent,
        public Optional|array|null $organizations,
    ) {}

    public static function fromModel(ActivityType $activityType, array $with = []): ActivityTypeData
    {
        return new self(
            id: $activityType->id,
            name: $activityType->name,
            parent: in_array('parent', $with)
                ? ActivityTypeData::factory()->withOptionalValues()->from($activityType->parent)
                : null,
            organizations: in_array('organizations', $with)
                ? OrganizationData::collect($activityType->organizations)->toArray()
                : null,
        );
    }
}
