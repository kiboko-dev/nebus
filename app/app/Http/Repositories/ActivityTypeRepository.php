<?php

namespace App\Http\Repositories;

use App\Models\ActivityType;
use Illuminate\Database\Eloquent\Collection;

class ActivityTypeRepository
{
    public function index(): Collection
    {
        return ActivityType::all();
    }
}
