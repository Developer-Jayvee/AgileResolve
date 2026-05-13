<?php

namespace App\Traits;

use ErrorException;
use Illuminate\Http\JsonResponse;
use Throwable;

trait ResponseTrait
{
    /**
     * Success Response
     *
     * @param  string $message
     * @param  array $data
     * @return JsonResponse
     */
    public function sucessResponse(string $message = "Success" , array $data = array()) : JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message
        ],200);
    }
    /**
     * Error Response
     *
     * @param  Throwable $error
     * @param  int $code
     * @return JsonResponse
     */
    public function errorResponse(Throwable | ErrorException $error,int $code = null): JsonResponse
    {
        return response()->json([
            'message' => $error->getMessage(),
            'error' => $error
        ],$code ?? $error->getCode());
    }
}
