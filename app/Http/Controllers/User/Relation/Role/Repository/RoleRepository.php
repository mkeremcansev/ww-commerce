<?php

namespace App\Http\Controllers\User\Relation\Role\Repository;

use App\Http\Controllers\User\Relation\Role\Contract\RoleInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
    public function __construct(public Role $role)
    {
    }

    /**
     * @param string $name
     * @return Role
     */
    public function roleByName(string $name): Role
    {
        return $this->role->whereName($name)->first();
    }

    /**
     * @param array $columns
     * @return Role
     */
    public function roleFirstOrCreate(array $columns): Role
    {
        return $this->role->firstOrCreate($columns);
    }

}
