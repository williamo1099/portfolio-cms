<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CurriculumVitaeService;
use App\Traits\APIResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CurriculumVitaeController extends Controller
{
    use APIResponse;

    protected CurriculumVitaeService $service;

    public function __construct(CurriculumVitaeService $service)
    {
        $this->service = $service;
    }

    /**
     * Fetch currently active curriculum vitae path.
     * 
     * @return JsonResponse
     */
    public function getActiveCurriculumVitae(): JsonResponse
    {
        try {
            $curriculumVitae = $this->service->getActiveCurriculumVitae();
            return $this->success(['path' => $curriculumVitae->path], "Active curriculum vitae fetched successfully!");
        } catch (Exception $ex) {
            Log::error('Error fetching curriculum vitae', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ]);
            return $this->error("Failed to fetch curriculum vitae!", 500, $ex->getMessage());
        }
    }
}
