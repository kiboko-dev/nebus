<?php

namespace Database\Factories;

use App\Models\ActivityType;
use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    public function definition(): array
    {

        return [
            'name' => $this->faker->company,
            'building_id' => Building::all()->random()->id,
            'phone' => '+7' . fake()->unique()->numerify('(9##)#######'),
            'activity_type_id' => ActivityType::where('level', 2)->get()->random()->id,
        ];
    }
}
