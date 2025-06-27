<?php

namespace App\Http\Repositories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Collection;

class BuildingRepository
{
    public function index(): Collection
    {
        return Building::all();
    }
}
