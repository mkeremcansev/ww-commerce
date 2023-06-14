<?php

namespace App\Http\Controllers\User\Relation\Role\Repository;

use App\Http\Controllers\User\Relation\Role\Contract\RoleInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
    public function __construct(public Role $model)
    {
    }

    public function roleByName(string $name): Role
    {
        return $this->model->whereName($name)->first();
    }

    public function roleFirstOrCreate(array $columns): Role
    {
        return $this->model->firstOrCreate($columns);
    }

    public function roles(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->get()
            );
    }

    public function roleById($id): ?Role
    {
        return $this->model
            ->whereId($id)
            ->first();
    }

    public function store($name, $permissionId): mixed
    {
        return $this->model->create([
            'name' => $name,
            'guard_name' => 'web',
        ])->givePermissionTo($permissionId);
    }

    public function update($id, $name, $permissionId): bool
    {
        $role = $this->roleById($id);

        return $role && $role->update([
            'name' => $name,
            'permission_id' => $permissionId,
        ]) && $role->syncPermissions($permissionId);
    }

    public function destroy($id): bool
    {
        $role = $this->roleById($id);

        return $role && $role->delete();
    }
}
