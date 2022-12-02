<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class ResponseHandler
{
    /**
     * @return JsonResponse
     */
    public function notFound(): JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => __('words.notFound'),
                'type' => 'error'
            ]
        ], 404);
    }

    /**
     * @return JsonResponse
     */
    public function tooManyRequests(): JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => __('words.tooManyRequests'),
                'type' => 'error'
            ]
        ], 429);
    }
}
