<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait JsonResponseTrait
{
    /**
     * @param $data
     * @param int $status
     * @return JsonResponse
     */
    protected function successResponse($data, int $status = ResponseAlias::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ], $status);
    }

    /**
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $status = ResponseAlias::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
