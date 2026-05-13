<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

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
     * @param  string $message
     * @param  array  $errors
     * @param  int $code
     * @return JsonResponse
     */
    public function errorResponse(string $message = "Error" , array | string $errors = array(),int $code = 500): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'error' => $errors
        ],$code);
    }
}
