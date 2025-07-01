<?php

namespace App\Http\Controllers;

use App\Http\Repositories\BuildingRepository;
use App\Http\Requests\GeoRequest;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;

#[Group("Здания")]
class BuildingController extends Controller
{
    public function __construct(protected BuildingRepository $repository)
    {
    }

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
            $this->repository->index()
        );
    }

    #[
        Endpoint(
            title: 'Гео-поиск зданий',
            description: 'Поиск зданий в радиусе от точки, в заданном прямоугольнике или полигоне с минимум 3 точками'
        ),
        BodyParam(
            name: 'type',
            type: 'string',
            description: 'Тип поиска: point (поиск по точке), rectangle (поиск в заданном прямоугольнике), polygon (поиск в области)',
            required: true,
            example: 'point'
        ),
        BodyParam(
            name: 'radius',
            type: 'integer',
            description: 'Радиус поиска зданий в метрах. Обязателен при поиске по точке',
            example: 500
        ),
        BodyParam(
            name: 'point',
            type: 'object',
            description: "Массив с координатами точки. Обязателен при поиске по точке.",
            example: ['lat' => 55.711960, 'lng' => 37.621065]
        ),
        BodyParam(
            name: 'rectangle',
            type: 'object',
            description: 'Массив с координатами верхней левой и нижней правой точек прямоугольника в котором осуществляется поиск. Обязателен при поиске в прямоугольнике.',
            example: "No-example"
        ),
    ]
    public function geoSearch(GeoRequest $request): JsonResponse
    {
        return response()->json(
            $this->repository->geoSearch($request->validated())
        );
    }
}
