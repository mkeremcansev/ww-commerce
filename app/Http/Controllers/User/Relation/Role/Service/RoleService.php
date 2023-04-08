<?php

namespace App\Http\Controllers\User\Relation\Role\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\User\Relation\Role\Contract\RoleInterface;
use Exception;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleService
{
    /**
     * @param RoleInterface $repository
     */
    public function __construct(public RoleInterface $repository)
    {
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->roles(['id', 'name']));
    }

    /**
     * @param $name
     * @param $permissionId
     * @return mixed
     */
    public function store($name, $permissionId): mixed
    {
        $this->permissionCacheClear();

        return $this->repository->store($name, $permissionId);
    }

    /**
     * @param $id
     * @return Role|null
     */
    public function edit($id): ?Role
    {
        return $this->repository->roleById($id);
    }

    /**
     * @param $id
     * @param $name
     * @param $permissionId
     * @return bool
     */
    public function update($id, $name, $permissionId): bool
    {
        $this->permissionCacheClear();

        return $this->repository->update($id, $name, $permissionId);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->repository->destroy($id);
    }

    /**
     * @return void
     */
    public function permissionCacheClear(): void
    {
        resolve(PermissionRegistrar::class)
            ->forgetCachedPermissions();
    }
}
