<?php

namespace App\Http\Struct\User\Controller;

use App\Http\Controller;
use App\Http\Struct\User\Request\UserAuthorizeRequest;
use App\Http\Struct\User\Request\UserProfileUpdateRequest;
use App\Http\Struct\User\Request\UserUpdateRequest;
use App\Http\Struct\User\Resource\UserIndexResource;
use App\Http\Struct\User\ResourceCollection\UserEditResourceCollection;
use App\Http\Struct\User\ResourceCollection\UserProfileEditResourceCollection;
use App\Http\Struct\User\Service\UserService;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(public UserService $service)
    {
    }

    /**
     * @throws Exception
     */
    public function index(): UserIndexResource
    {
        return new UserIndexResource($this->service->index());
    }

    public function authorization(UserAuthorizeRequest $request): Response|JsonResponse
    {
        $token = $this->service->authorization($request->email, $request->password);

        return $token
            ? ResponseHandler::authorize([
                'token' => $token,
                'permissions' => $this->service->permissionGroupsWithRoleName($request),
                'user' => $this->service->user($request),
            ])
            : ResponseHandler::invalidAuthorizationInformation();
    }

    public function logout(): JsonResponse
    {
        return $this->service->logout()
            ? ResponseHandler::success()
            : ResponseHandler::invalidAuthorizationInformation();
    }

    public function edit(int $id): JsonResponse|UserEditResourceCollection
    {
        $user = $this->service->edit($id);

        return $user
            ? new UserEditResourceCollection($user)
            : ResponseHandler::notFound();
    }

    public function update(int $id, UserUpdateRequest $request): JsonResponse
    {
        $user = $this->service->update($id, $request->name, $request->email, $request->role_id);

        return $user
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::notFound();
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->service->destroy($id)
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::notFound();
    }

    public function profile(): UserProfileEditResourceCollection
    {
        return new UserProfileEditResourceCollection(auth()->user());
    }

    public function profileUpdate(UserProfileUpdateRequest $request): JsonResponse
    {
        $user = $this->service->profileUpdate($request->name, $request->new_password);

        return $user
            ? ResponseHandler::update(['id' => auth()->id()])
            : ResponseHandler::notFound();
    }
}
