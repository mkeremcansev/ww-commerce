<?php

namespace App\Http\Helper;

use Illuminate\Http\JsonResponse;

class ResponseHelper
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
}
