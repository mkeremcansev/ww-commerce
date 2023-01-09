<?php

namespace App\Http\Controllers\User\Relation\Role\Controller;

use App\Exceptions\ResponseHandler;
use App\Helpers\DatatableHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Relation\Permission\Contract\PermissionInterface;
use App\Http\Controllers\User\Relation\Permission\ResourceCollection\PermissionRelationResourceCollection;
use App\Http\Controllers\User\Relation\Role\Request\RoleIndexRequest;
use App\Http\Controllers\User\Relation\Role\Request\RoleStoreRequest;
use App\Http\Controllers\User\Relation\Role\Request\RoleUpdateRequest;
use App\Http\Controllers\User\Relation\Role\ResourceCollection\RoleEditResourceCollection;
use App\Http\Controllers\User\Relation\Role\ResourceCollection\RoleResourceCollection;
use App\Http\Controllers\User\Relation\Role\Service\RoleService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    /**
     * @param RoleService $service
     */
    public function __construct(public RoleService $service)
    {
    }

    /**
     * @param RoleIndexRequest $request
     * @return AnonymousResourceCollection
     * @throws Exception
     */
    public function index(RoleIndexRequest $request): AnonymousResourceCollection
    {
        return RoleResourceCollection::collection(DatatableHelper::datatable($request, $this->service->index()));
    }

    /**
     * @return array
     * @throws BindingResolutionException
     */
    public function create(): array
    {
        return [
            'permission_id' => PermissionRelationResourceCollection::collection(
                resolve(PermissionInterface::class)
                    ->permissions()
            )
        ];
    }

    public function store(RoleStoreRequest $request): JsonResponse
    {
        $role = $this->service->store($request->name, $request->permission_id);

        return ResponseHandler::store(['id' => $role->id]);
    }

    /**
     * @param int $id
     * @return RoleEditResourceCollection|JsonResponse
     */
    public function edit(int $id): RoleEditResourceCollection|JsonResponse
    {
        $role = $this->service->edit($id);

        return $role
            ? new RoleEditResourceCollection($role)
            : ResponseHandler::recordNotFound();
    }

    /**
     * @param int $id
     * @param RoleUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, RoleUpdateRequest $request): JsonResponse
    {
        $role = $this->service->update($id, $request->name, $request->permission_id);

        return $role
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::recordNotFound();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $role = $this->service->destroy($id);

        return $role
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }
}
