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
}
