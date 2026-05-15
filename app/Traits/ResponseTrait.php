<?php

namespace App\Traits;

use ErrorException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;
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
    public function errorResponse(Throwable | ErrorException | HttpResponseException $error,int $code = 500): JsonResponse
    {
        if($error instanceof HttpResponseException){
            $content = json_decode($error->getResponse()->getContent(),true);
            return response()->json($content,$code ?? $error->getCode());
        }
        return response()->json([
                'message' => $error->getMessage(),
                'error' => $error
            ],$code);
    }
    public function failedValidationResponse(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'error' => $validator->getMessageBag()
            ],422)
        );
    }

}
