<?php

namespace App\Response;

use Illuminate\Http\JsonResponse;

class ResponseHandler
{
    public static function tooManyRequests(): JsonResponse
    {
        return self::result(429, $message ?? __('words.tooManyRequests'));
    }

    /**
     * @param  null  $message
     */
    public static function store(array $parameters = [], $message = null): JsonResponse
    {
        return self::result(200, $message ?? __('words.createdSuccessfully'), $parameters);
    }

    /**
     * @param  null  $message
     */
    public static function update(array $parameters = [], $message = null): JsonResponse
    {
        return self::result(200, $message ?? __('words.updatedSuccessfully'), $parameters);
    }

    /**
     * @param  null  $message
     */
    public static function recordNotFound(array $parameters = [], $message = null): JsonResponse
    {
        return self::result(404, $message ?? __('words.recordNotFound'), $parameters);
    }

    /**
     * @param  null  $message
     */
    public static function destroy(array $parameters = [], $message = null): JsonResponse
    {
        return self::result(200, $message ?? __('words.deletedSuccessfully'), $parameters);
    }

    /**
     * @param  null  $message
     */
    public static function restore(array $parameters = [], $message = null): JsonResponse
    {
        return self::result(200, $message ?? __(''), $parameters);
    }

    /**
     * @param  null  $message
     */
    public static function success(array $parameters = [], $message = null): JsonResponse
    {
        return self::result(200, $message ?? __('words.actionSuccessfully'), $parameters);
    }

    public static function successWithoutMessage(array $parameters = []): JsonResponse
    {
        return self::result(200, null, $parameters);
    }

    /**
     * @param  null  $message
     */
    public static function error(int $statusCode = 422, $message = null, array $parameters = []): JsonResponse
    {
        return self::result($statusCode, $message ?? __(''), $parameters);
    }

    /**
     * @param  null  $message
     */
    public static function notFound($message = null, array $parameters = []): JsonResponse
    {
        return self::result(404, $message ?? __('words.notFound'), $parameters);
    }

    public static function notAuthorized(array $parameters = []): JsonResponse
    {
        return self::result(401, __('words.userNotLoggedIn'), $parameters);
    }

    public static function invalidAuthorizationInformation(array $parameters = []): JsonResponse
    {
        return self::result(401, __('words.invalidAuthorizationInformation'), $parameters);
    }

    public static function authorize(array $parameters = []): JsonResponse
    {
        return self::result(200, __('words.loginSuccess'), $parameters);
    }

    public static function notHaveRole(array $parameters = []): JsonResponse
    {
        return self::result(403, __('words.userNotHaveAuthorization'), $parameters);
    }

    public static function roleAlreadyExists(array $parameters = []): JsonResponse
    {
        return self::result(500, __('words.roleAlreadyExists'), $parameters);
    }

    /**
     * @param  int  $statusCode
     * @param  null  $data
     */
    public static function result($statusCode, $message, $data = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ])->setStatusCode($statusCode);
    }
}
