<?php

namespace App\Http\Controllers;

use App\Http\Repositories\BuildingRepository;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;

#[Group("Служебное")]
class BuildingController extends Controller
{
    #[Endpoint(title: 'Список зданий')]
    #[Response(content: '[
    {
        "id": "9f43ba57-c4ca-48e0-a0d2-0a238ef4e8b1",
        "address": "1-я Карачаровская улица, 8с2, Москва, 109202",
        "latitude": 55.73551,
        "longitude": 37.755146
    },
    ]', status: 200)]
    public function index(): JsonResponse
    {
        return response()->json(
            app(BuildingRepository::class)->index()
        );
    }
}
