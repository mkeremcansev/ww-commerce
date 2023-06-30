<?php

namespace App\Http\Struct\User\Relation\Role\Repository;

use App\Http\Struct\User\Relation\Role\Contract\RoleInterface;
use App\Http\Struct\User\Relation\Role\Model\Role;

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

    public function roles(array $columns = [], bool|null $trashed = false): mixed
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->get()
            );
    }

    public function roleById($id, $trashed = false): ?Role
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
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

    public function destroy($id): ?bool
    {
        $role = $this->roleById($id);

        return $role?->delete();
    }

    public function restore($id): ?bool
    {
        $role = $this->roleById($id, true);

        return $role?->restore();
    }

    public function forceDelete($id): ?bool
    {
        $role = $this->roleById($id, true);

        return $role?->forceDelete();
    }
}
