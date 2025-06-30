<?php

namespace App\Http\Controllers;

use App\Http\Repositories\OrganizationRepository;
use App\Http\Requests\GeoRequest;
use App\Http\Requests\SearchByActivityTypeRequest;
use App\Http\Services\OrganizationService;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;


class OrganizationController extends Controller
{
    public function __construct(
        protected OrganizationService $service,
        protected OrganizationRepository $repository,
    )
    {
    }

    #[Group(name: 'Организации')]
    #[Endpoint(title: 'Список организаций в здании')]
    public function indexByBuilding(string $buildingId): JsonResponse
    {
        return response()->json(
            $this->service->byBuildingId($buildingId));
    }

    #[Group(name: 'Организации')]
    #[Endpoint(title: 'Список организаций по виду деятельности')]
    public function indexByActivityType(int $activityTypeId): JsonResponse
    {
        return response()->json(
            $this->service->byActivityTypeId($activityTypeId)
        );
    }

    #[Group(name: 'Служебное')]
    #[Endpoint(title: 'Список организаций')]
    public function index(): JsonResponse
    {
        return response()->json(
            $this->repository->index()
        );
    }

    #[Group(name: 'Организации')]
    #[Endpoint(title: 'Данные организации')]
    public function getById(string $id): JsonResponse
    {

        return response()->json(
            $this->repository->show($id)
        );
    }

    public function searchByActivityType(SearchByActivityTypeRequest $request): JsonResponse
    {
        return response()->json(
            $this->service->searchByActivityType($request->validated())
        );
    }

    #[Group(name: 'Организации')]
    #[Endpoint(title: 'Поиск по названию')]
    public function searchByName(string $query): JsonResponse
    {
        return response()->json(
            $this->repository->search($query)
        );
    }
}
