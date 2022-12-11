<?php

namespace App\Http\Controllers\User\Relation\Permission\Repository;

use App\Http\Controllers\User\Relation\Permission\Contract\PermissionInterface;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionInterface
{
    /**
     * @param Permission $permission
     */
    public function __construct(public Permission $permission)
    {
    }

    /**
     * @return array|Collection
     */
    public function permissions(): array|Collection
    {
        return $this->permission->get();
    }

    /**
     * @param array $columns
     * @return Permission
     */
    public function permissionFirstOrCreate(array $columns): Permission
    {
        return $this->permission->firstOrCreate($columns);
    }
}
