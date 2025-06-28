<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ActivityTypeRepository;
use App\Models\ActivityType;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;

#[Group(name: 'Виды деятельности')]
class ActivityTypeController extends Controller
{
    #[Endpoint(title: 'Получить список')]
    public function index(): JsonResponse
    {
        return response()->json(app(ActivityTypeRepository::class)->index());
    }
}
