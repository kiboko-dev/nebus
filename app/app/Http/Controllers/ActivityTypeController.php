<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ActivityTypeRepository;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;

#[Group("Виды деятельности")]
class ActivityTypeController extends Controller
{
    #[Endpoint(title: 'Список видов деятельности')]
    public function index(): JsonResponse
    {
        return response()->json(app(ActivityTypeRepository::class)->index());
    }
}
