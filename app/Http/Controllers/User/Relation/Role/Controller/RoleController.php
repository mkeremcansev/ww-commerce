<?php

namespace App\Http\Controllers\User\Relation\Role\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Relation\Permission\Contract\PermissionInterface;
use App\Http\Controllers\User\Relation\Permission\ResourceCollection\PermissionRelationResourceCollection;
use App\Http\Controllers\User\Relation\Role\Request\RoleStoreRequest;
use App\Http\Controllers\User\Relation\Role\Request\RoleUpdateRequest;
use App\Http\Controllers\User\Relation\Role\Resource\RoleIndexResource;
use App\Http\Controllers\User\Relation\Role\ResourceCollection\RoleEditResourceCollection;
use App\Http\Controllers\User\Relation\Role\Service\RoleService;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    public function __construct(public RoleService $service)
    {
    }

    /**
     * @throws Exception
     */
    public function index(): RoleIndexResource
    {
        return new RoleIndexResource($this->service->index());
    }

    /**
     * @throws BindingResolutionException
     */
    public function create(): array
    {
        return [
            'permission_id' => PermissionRelationResourceCollection::collection(
                resolve(PermissionInterface::class)
                    ->permissions()
            ),
        ];
    }

    public function store(RoleStoreRequest $request): JsonResponse
    {
        $role = $this->service->store($request->name, $request->permission_id);

        return ResponseHandler::store(['id' => $role->id]);
    }

    public function edit(int $id): RoleEditResourceCollection|JsonResponse
    {
        $role = $this->service->edit($id);

        return $role
            ? new RoleEditResourceCollection($role)
            : ResponseHandler::recordNotFound();
    }

    public function update(int $id, RoleUpdateRequest $request): JsonResponse
    {
        $role = $this->service->update($id, $request->name, $request->permission_id);

        return $role
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::recordNotFound();
    }

    public function destroy(int $id): JsonResponse
    {
        $role = $this->service->destroy($id);

        return $role
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }
}
