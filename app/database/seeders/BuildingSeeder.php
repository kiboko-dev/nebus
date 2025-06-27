<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    public function run(): void
    {
        Organization::query()->truncate();
        Building::query()->forceDelete();

        $buildings = [
            ['address' => '1-я Карачаровская улица, 8с2, Москва, 109202', 'latitude' => 55.735510, 'longitude' => 37.755146],
            ['address' => '2-я Карачаровская улица, 14Ас2, Москва, 109202', 'latitude' => 55.732624, 'longitude' => 37.750243],
            ['address' => 'Авиамоторная улица, 12, Москва, 111024', 'latitude' => 55.753286, 'longitude' => 37.715507],
            ['address' => 'шоссе Энтузиастов, 12к2, Москва, 111024', 'latitude' => 55.748379, 'longitude' => 37.706934],
            ['address' => 'Холодильный переулок, 3, Москва, 115191', 'latitude' => 55.708394, 'longitude' => 37.625397],
            ['address' => 'Большая Тульская улица, 2, Москва, 115191', 'latitude' => 55.709018, 'longitude' => 37.620770],
            ['address' => 'улица Щепкина, 47с1, Москва, 129110', 'latitude' => 55.781337, 'longitude' => 37.629026],
            ['address' => 'Староалексеевская улица, 3, Москва, 129626', 'latitude' => 55.810506, 'longitude' => 37.643624],
        ];

        foreach ($buildings as $building) {
            Building::query()->firstOrCreate(['address' => $building['address']], $building);
        }
    }
}
