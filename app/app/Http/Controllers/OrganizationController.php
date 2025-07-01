<?php

namespace App\Http\Controllers;

use App\Http\Repositories\OrganizationRepository;
use App\Http\Requests\SearchByActivityTypeRequest;
use App\Http\Services\OrganizationService;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;

#[Group(name: 'Организации')]
class OrganizationController extends Controller
{
    public function __construct(
        protected OrganizationService $service,
        protected OrganizationRepository $repository,
    )
    {
    }


    #[Endpoint(title: 'Список организаций в здании')]
    public function indexByBuilding(string $buildingId): JsonResponse
    {
        return response()->json(
            $this->service->byBuildingId($buildingId));
    }

    #[Endpoint(title: 'Список организаций по виду деятельности')]
    public function indexByActivityType(int $activityTypeId): JsonResponse
    {
        return response()->json(
            $this->service->byActivityTypeId($activityTypeId)
        );
    }

    #[Endpoint(title: 'Список всех организаций')]
    public function index(): JsonResponse
    {
        return response()->json(
            $this->repository->index()
        );
    }

    #[Endpoint(title: 'Данные организации')]
    public function getById(string $id): JsonResponse
    {

        return response()->json(
            $this->repository->show($id)
        );
    }

    #[Endpoint(title: 'Поиск по виду деятельности')]
    public function searchByActivityType(SearchByActivityTypeRequest $request): JsonResponse
    {
        return response()->json(
            $this->service->searchByActivityType($request->validated())
        );
    }

    #[Endpoint(title: 'Поиск по названию')]
    public function searchByName(string $query): JsonResponse
    {
        return response()->json(
            $this->repository->search($query)
        );
    }
}
