<?php

namespace App\Http\Controllers\User\Relation\Permission\Contract;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

interface PermissionInterface
{
    /**
     * @return array|Collection
     */
    public function permissions(): array|Collection;

    /**
     * @param array $columns
     * @return Permission
     */
    public function permissionFirstOrCreate(array $columns): Permission;
}
