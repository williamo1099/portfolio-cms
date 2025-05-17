<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Services\ProjectService;
use App\Traits\HasAPIResponse;
use App\Traits\HasLogging;
use Exception;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    use HasAPIResponse, HasLogging;

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
            $projects = $this->service->getProjectsInOrder($type);
            return $this->success(ProjectResource::collection($projects), "Projects fetched successfully!");
        } catch (Exception $ex) {
            $this->logException('fetching projects', $ex);
            return $this->error("Failed to fetch projects!", 500, $ex->getMessage());
        }
    }
}
