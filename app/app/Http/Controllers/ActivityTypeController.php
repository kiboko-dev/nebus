<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ActivityTypeRepository;
use App\Models\ActivityType;
use Illuminate\Http\JsonResponse;

class ActivityTypeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(app(ActivityTypeRepository::class)->index());
    }
}
