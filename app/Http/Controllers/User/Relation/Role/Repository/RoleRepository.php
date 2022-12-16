<?php

namespace App\Http\Controllers\User\Relation\Role\Repository;

use App\Http\Controllers\User\Relation\Role\Contract\RoleInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
    /**
     * @param Role $model
     */
    public function __construct(public Role $model)
    {
    }

    /**
     * @param string $name
     * @return Role
     */
    public function roleByName(string $name): Role
    {
        return $this->model->whereName($name)->first();
    }

    /**
     * @param array $columns
     * @return Role
     */
    public function roleFirstOrCreate(array $columns): Role
    {
        return $this->model->firstOrCreate($columns);
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function roles(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn($eloquent) => $eloquent->select($columns),
                fn($eloquent) => $eloquent->get()
            );
    }

    /**
     * @param $id
     * @return Role|null
     */
    public function roleById($id): ?Role
    {
        return $this->model
            ->whereId($id)
            ->first();
    }

    /**
     * @param $name
     * @param $permissionId
     * @return mixed
     */
    public function store($name, $permissionId): mixed
    {
        return $this->model->create([
            'name' => $name,
            'guard_name' => 'web',
        ])->givePermissionTo($permissionId);
    }

    /**
     * @param $id
     * @param $name
     * @param $permissionId
     * @return bool
     */
    public function update($id, $name, $permissionId): bool
    {
        $role = $this->roleById($id);

        return $role && $role->update([
                'name' => $name,
                'permission_id' => $permissionId,
            ]) && $role->syncPermissions($permissionId);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        $role = $this->roleById($id);

        return $role && $role->delete();
    }
}
