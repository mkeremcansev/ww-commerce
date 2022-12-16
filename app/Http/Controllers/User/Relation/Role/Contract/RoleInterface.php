<?php

namespace App\Http\Controllers\User\Relation\Role\Contract;

use Spatie\Permission\Models\Role;

interface RoleInterface
{
    /**
     * @param string $name
     * @return Role
     */
    public function roleByName(string $name): Role;

    /**
     * @param array $columns
     * @return Role
     */
    public function roleFirstOrCreate(array $columns): Role;

    /**
     * @param array $columns
     * @return mixed
     */
    public function roles(array $columns = []): mixed;

    /**
     * @param $id
     * @return Role|null
     */
    public function roleById($id): ?Role;

    /**
     * @param $name
     * @param $permissionId
     * @return mixed
     */
    public function store($name, $permissionId): mixed;

    /**
     * @param $id
     * @param $name
     * @param $permissionId
     * @return bool
     */
    public function update($id, $name, $permissionId): bool;

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;
}
