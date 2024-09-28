<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;


    
    function _response(int $statusCode, string $message, array $data = null, array | string $errors = null): JsonResponse
    {
        $response = [
            'status' => $statusCode,
            'message' => $message,
            'data' => $data,
            'errors' => $errors
        ];

        $filteredResponse = array_filter($response, function ($value) {
            return !is_null($value);
        });

        return response()->json($filteredResponse, $statusCode);
    }
