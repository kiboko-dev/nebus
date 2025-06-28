<?php

namespace App\Http\Repositories;

use App\Data\BuildingData;
use App\Models\Building;
use Illuminate\Support\Collection;

class BuildingRepository
{
    public function index(): Collection|array
    {
        return BuildingData::collect(Building::all()->toArray());
    }
}
