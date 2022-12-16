<?php

namespace App\Http\Controllers\User\Relation\Permission\Contract;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

interface PermissionInterface
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function permissions(array $columns = []): mixed;

    /**
     * @param array $columns
     * @return Permission
     */
    public function permissionFirstOrCreate(array $columns): Permission;
}
