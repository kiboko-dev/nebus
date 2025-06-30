<?php

namespace App\Http\Repositories;

use App\Data\ActivityTypeData;
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

    public function getWithOrganizations(int $id): ActivityTypeData
    {
        return ActivityTypeData::fromModel(
            activityType: ActivityType::query()->with('organizations')->findOrFail($id),
            with: ['organizations', 'parent']
        );
    }

    public function getWithChild(array $query): array
    {
        if(isset($query['query'])) {
            $activity = ActivityType::query()->where('name', 'like', "%{$query['query']}%")->first();
            if(null === $activity) {
                return [];
            }
            $activityTypeId =  $activity->id;
        } else {
            $activityTypeId =  $query['activityTypeId'];
        }

        $activityType = ActivityType::query()->findOrFail($activityTypeId);

        $activityTypeIds = $this->getAllChildIds($activityTypeId);
        $activityTypeIds[] = $activityTypeId; // Добавляем саму категорию

        return [
            'ids' => $activityTypeIds,
            'structure' => $this->getStructure($activityType, $activityTypeId)
        ];
    }

    private function getStructure(ActivityType $activityType, int $searchId): array
    {
        return [
            'id' => $activityType->id,
            'name' => $activityType->name,
            'is_searched' => $activityType->id === $searchId,
            'children' => $activityType->children->map(function($child) use ($searchId) {
                return $this->getStructure($child, $searchId);
            })
        ];
    }

    private function getAllChildIds(int $parentId): array
    {
        $childIds = [];
        $children = ActivityType::where('parent_id', $parentId)->get();

        foreach ($children as $child) {
            $childIds[] = $child->id;
            $childIds = array_merge($childIds, $this->getAllChildIds($child->id));
        }

        return $childIds;
    }

    /**
     * Строим структуру категорий с отметкой найденной категории
     */
    private function getCategoryStructure(ActivityType $category, int $searchId): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'is_searched' => $category->id === $searchId,
            'children' => $category->children->map(function($child) use ($searchId) {
                return $this->getCategoryStructure($child, $searchId);
            })
        ];
    }
}
