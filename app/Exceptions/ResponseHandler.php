<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class ResponseHandler
{
    /**
     * @return JsonResponse
     */
    public static function tooManyRequests(): JsonResponse
    {
        return self::result(429, $message ?? __('words.tooManyRequests'), $parameters);
    }

    /**
     * Returns record result
     *
     * @param array $parameters
     * @param null $message
     * @return JsonResponse
     */
    public static function store(array $parameters = [], $message = null): JsonResponse
    {
        return self::result(200, $message ?? __(''), $parameters);
    }

    /**
     * Returns the update result
     *
     * @param array $parameters
     * @param null $message
     * @return JsonResponse
     */
    public static function update(array $parameters = [], $message = null): JsonResponse
    {
        return self::result(200, $message ?? __(''), $parameters);
    }

    /**
     * Returns the deletion result
     *
     * @param array $parameters
     * @param null $message
     * @return JsonResponse
     */
    public static function destroy(array $parameters = [], $message = null): JsonResponse
    {
        return self::result(200, $message ?? __(''), $parameters);
    }

    /**
     * Returns the recovery result
     *
     * @param array $parameters
     * @param null $message
     * @return JsonResponse
     */
    public static function restore(array $parameters = [], $message = null): JsonResponse
    {
        return self::result(200, $message ?? __(''), $parameters);
    }

    /**
     * Returns successful result
     *
     * @param array $parameters
     * @param null $message
     * @return JsonResponse
     */
    public static function success(array $parameters = [], $message = null):JsonResponse
    {
        return self::result(200, $message ?? __(''), $parameters);
    }

    /**
     * Returns successful without message.
     *
     * @param array $parameters
     * @return JsonResponse
     */
    public static function successWithoutMessage(array $parameters = []): JsonResponse
    {
        return self::result(200, null, $parameters);
    }

    /**
     * Returns error result
     *
     * @param array $parameters
     * @param null $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function error(int $statusCode = 422, $message = null, array $parameters = []): JsonResponse
    {
        return self::result($statusCode, $message ?? __(''), $parameters);
    }

    /**
     * Returns not found result
     *
     * @param null $message
     * @param array $parameters
     * @return JsonResponse
     */
    public static function notFound($message = null, array $parameters = []): JsonResponse
    {
        return self::result(404, $message ??  __('words.notFound'), $parameters);
    }

    /**
     * Returns notAuthorized result
     *
     * @param array $parameters
     * @return JsonResponse
     */
    public static function notAuthorized(array $parameters = []): JsonResponse
    {
        return self::result(401, __(''), $parameters);
    }

    /**
     * Formats the result and returns
     *
     * @param int $statusCode
     * @param $message
     * @param null $data
     * @return JsonResponse
     */
    public static function result($statusCode = 200, $message, $data = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ])->setStatusCode($statusCode);
    }
}
