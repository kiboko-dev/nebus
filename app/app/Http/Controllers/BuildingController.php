<?php

namespace App\Http\Controllers;

use App\Data\BuildingData;
use App\Http\Repositories\BuildingRepository;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;

#[Group(name: 'Здания')]
class BuildingController extends Controller
{
    #[Endpoint(title: 'Получить список')]
    public function index(): JsonResponse
    {
        return response()->json(
            BuildingData::collect(app(BuildingRepository::class)->index())
        );
    }
}
