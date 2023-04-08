<?php

namespace App\Http\Controllers\User\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Request\UserAuthorizeRequest;
use App\Http\Controllers\User\Request\UserUpdateRequest;
use App\Http\Controllers\User\ResourceCollection\UserEditResourceCollection;
use App\Http\Controllers\User\Service\UserService;
use App\Response\ResponseHandler;
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
            ? ResponseHandler::authorize([
                'token' => $token,
                'permissions' => $this->service->permissionGroupsWithRoleName($request),
                'user' => $this->service->user($request)
            ])
            : ResponseHandler::invalidAuthorizationInformation();
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->service->logout()
            ? ResponseHandler::success()
            : ResponseHandler::invalidAuthorizationInformation();
    }

    /**
     * @param int $id
     * @return UserEditResourceCollection|JsonResponse
     */
    public function edit(int $id): JsonResponse|UserEditResourceCollection
    {
        $user = $this->service->edit($id);

        return $user
            ? new UserEditResourceCollection($user)
            : ResponseHandler::notFound();
    }

    /**
     * @param int $id
     * @param UserUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, UserUpdateRequest $request): JsonResponse
    {
        $user = $this->service->update($id, $request->name, $request->email, $request->role_id);

        return $user
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::notFound();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->service->destroy($id)
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::notFound();
    }
}
