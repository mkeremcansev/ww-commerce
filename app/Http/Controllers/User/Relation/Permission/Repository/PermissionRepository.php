<?php

namespace App\Http\Controllers\User\Relation\Permission\Repository;

use App\Http\Controllers\User\Relation\Permission\Contract\PermissionInterface;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionInterface
{
    /**
     * @param Permission $model
     */
    public function __construct(public Permission $model)
    {
    }

    /**
     * @return array|Collection
     */
    public function permissions(): array|Collection
    {
        return $this->model->get();
    }

    /**
     * @param array $columns
     * @return Permission
     */
    public function permissionFirstOrCreate(array $columns): Permission
    {
        return $this->model->firstOrCreate($columns);
    }
}
