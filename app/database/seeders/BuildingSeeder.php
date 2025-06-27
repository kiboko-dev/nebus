<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use App\Models\Building;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    public function run(): void
    {
        Organization::query()->truncate();
        Building::query()->forceDelete();
        Building::factory()->count(10)->create();
    }
}
