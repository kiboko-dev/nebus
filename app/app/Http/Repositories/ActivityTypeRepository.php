<?php

namespace App\Http\Repositories;

use App\Models\ActivityType;
use Illuminate\Support\Collection;

class ActivityTypeRepository
{
    public function index(): Collection
    {
        $activities = ActivityType::with('children')->whereNull('parent_id')->get();

        return $this->buildTree($activities);
    }

    protected function buildTree($activities)
    {
        return $activities->map(function ($activity) {
            return [
                'id' => $activity->id,
                'name' => $activity->name,
                'children' => $this->buildTree($activity->children)
            ];
        });
    }
}
