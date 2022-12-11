<?php

namespace App\Http\Controllers\User\Controller;

use App\Exceptions\ResponseHandler;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Request\UserAuthorizeRequest;
use App\Http\Controllers\User\Service\UserService;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @param UserService $service
     */
    public function __construct(public UserService $service)
    {
    }

    /**
     * @param UserAuthorizeRequest $request
     * @return Response|JsonResponse
     */
    public function authorization(UserAuthorizeRequest $request): Response|JsonResponse
    {
        $token = $this->service->authorization($request->email, $request->password);

        return $token
            ? ResponseHandler::authorize(['token' => $token])
            : ResponseHandler::invalidAuthorizationInformation();
    }
}
