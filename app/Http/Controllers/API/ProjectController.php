<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Services\ProjectService;
use App\Traits\APIResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    use APIResponse;

    protected ProjectService $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    /**
     * Fetch projects filtered by type.
     * 
     * @param ?string $type
     * @return JsonResponse
     */
    public function getProjects(?string $type = ''): JsonResponse
    {
        try {
            $projects = $this->service->getProjects($type);
            return $this->success(ProjectResource::collection($projects), "Projects fetched successfully!");
        } catch (Exception $ex) {
            Log::error('Error fetching projects', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);
            return $this->error("Failed to fetch projects!", 500, $ex->getMessage());
        }
    }
}
