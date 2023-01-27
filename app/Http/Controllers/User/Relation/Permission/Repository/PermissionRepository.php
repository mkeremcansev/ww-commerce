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
     * @param array $columns
     * @return mixed
     */
    public function permissions(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn($eloquent) => $eloquent->select($columns),
                fn($eloquent) => $eloquent->get()
            );
    }

    /**
     * @param array $columns
     * @return Permission
     */
    public function firstOrCreate(array $columns): Permission
    {
        return $this->model->firstOrCreate($columns);
    }
}
