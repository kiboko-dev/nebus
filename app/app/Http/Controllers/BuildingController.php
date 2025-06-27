<?php

namespace App\Http\Controllers;

use App\Http\Repositories\BuildingRepository;
use Illuminate\Http\JsonResponse;

class BuildingController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(app(BuildingRepository::class)->index());
    }
}
