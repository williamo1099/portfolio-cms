<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait HasAPIResponse
{
    /**
     * Return a successful JSON response.
     *
     * @param JsonResource|array|null $data
     * @param ?string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function success(JsonResource|array|null $data = null, ?string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param ?string $message
     * @param int $code
     * @param array|string|null $errors
     * @return JsonResponse
     */
    protected function error(?string $message = null, int $code = 400, array|string|null $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
