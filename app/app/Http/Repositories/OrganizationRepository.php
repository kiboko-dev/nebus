<?php

namespace App\Http\Repositories;

use App\Data\OrganizationData;
use App\Models\Organization;

class OrganizationRepository
{
    public function show(string $id): OrganizationData
    {
        return OrganizationData::fromModel(Organization::findOrFail($id), ['building', 'activityType']);
    }

    public function index(): array
    {
        $organizations = Organization::all();
        $result = [];
        foreach ($organizations as $organization) {
            $result[] = OrganizationData::fromModel($organization, ['building', 'activityType']);
        }

        return $result;
    }

    public function search(string $query): ?array
    {
        $organizations = Organization::query()->where('name', 'like', "%$query%")->get();

        foreach ($organizations as $organization) {
            $result[] = OrganizationData::fromModel($organization, ['building', 'activityType']);
        }

        return $result ?? null;
    }
}
