<?php

namespace App\Http\Struct\User\Relation\Role\Service;

use App\Helpers\DatatableHelper;
use App\Http\Struct\User\Relation\Role\Contract\RoleInterface;
use Exception;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleService
{
    public function __construct(public RoleInterface $repository)
    {
    }

    /**
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->roles(['id', 'name']));
    }

    public function store($name, $permissionId): mixed
    {
        $this->permissionCacheClear();

        return $this->repository->store($name, $permissionId);
    }

    public function edit($id): ?Role
    {
        return $this->repository->roleById($id);
    }

    public function update($id, $name, $permissionId): bool
    {
        $this->permissionCacheClear();

        return $this->repository->update($id, $name, $permissionId);
    }

    public function destroy($id): ?bool
    {
        return $this->repository->destroy($id);
    }

    public function permissionCacheClear(): void
    {
        resolve(PermissionRegistrar::class)
            ->forgetCachedPermissions();
    }
}
