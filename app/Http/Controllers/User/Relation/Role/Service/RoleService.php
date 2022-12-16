<?php

namespace App\Http\Controllers\User\Relation\Role\Service;

use App\Http\Controllers\User\Relation\Role\Contract\RoleInterface;
use Spatie\Permission\Models\Role;

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
     */
    public function index(): mixed
    {
        return $this->repository->roles(['id', 'name']);
    }

    /**
     * @param $name
     * @param $permissionId
     * @return mixed
     */
    public function store($name, $permissionId): mixed
    {
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
}
