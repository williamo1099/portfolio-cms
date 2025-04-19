<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CurriculumVitaeService;
use App\Traits\HasAPIResponse;
use Exception;
use HasLogging;
use Illuminate\Http\JsonResponse;

class CurriculumVitaeController extends Controller
{
    use HasAPIResponse, HasLogging;

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
            $this->logException('fetching curriculum vitae', $ex);
            return $this->error("Failed to fetch curriculum vitae!", 500, $ex->getMessage());
        }
    }
}
