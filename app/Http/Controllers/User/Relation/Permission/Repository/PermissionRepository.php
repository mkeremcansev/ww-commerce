<?php

namespace App\Http\Controllers\User\Relation\Permission\Repository;

use App\Http\Controllers\User\Relation\Permission\Contract\PermissionInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionInterface
{
    public function __construct(public Permission $model)
    {
    }

    public function permissions(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->get()
            );
    }

    public function firstOrCreate(array $columns): Permission
    {
        return $this->model->firstOrCreate($columns);
    }
}
