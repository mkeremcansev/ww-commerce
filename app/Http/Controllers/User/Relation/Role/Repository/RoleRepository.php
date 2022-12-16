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

}
