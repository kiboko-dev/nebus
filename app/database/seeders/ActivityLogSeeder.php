<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $parentActivities = [
            ['name' => 'Еда', 'parent_id' => null, 'level' => 1],
            ['name' => 'Автомобили', 'parent_id' => null, 'level' => 1],
            ['name' => 'Запчасти', 'parent_id' => null, 'level' => 1],
        ];
        $i = 1;
        foreach ($parentActivities as $parentActivity) {
            $activity = ActivityType::query()->firstOrCreate(['name' => $parentActivity['name']], $parentActivity);
            foreach ($this->getChildActivities($activity->id)[$i] as $item) {
                ActivityType::query()->firstOrCreate(['name' => $item['name']], $item);
            }
            $i++;
        }
    }

    private function getChildActivities(int $parentActivityId): array
    {
        return [
            1 => [
                ['name' => 'Мясная продукция', 'parent_id' => $parentActivityId, 'level' => 2],
                ['name' => 'Молочная продукция', 'parent_id' => $parentActivityId, 'level' => 2],
            ],
            2 => [
                ['name' => 'Легковые', 'parent_id' => $parentActivityId, 'level' => 2],
                ['name' => 'Грузовые', 'parent_id' => $parentActivityId, 'level' => 2],
            ],
            3 => [
                ['name' => 'Для легковых авто', 'parent_id' => $parentActivityId, 'level' => 2],
                ['name' => 'Для грузовых авто', 'parent_id' => $parentActivityId, 'level' => 2],
            ]
        ];
    }
}
