<?php

namespace App\Http\Struct\User\Relation\Role\Contract;

use Spatie\Permission\Models\Role;

interface RoleInterface
{
    public function roleByName(string $name): Role;

    public function roleFirstOrCreate(array $columns): Role;

    public function roles(array $columns = [], bool|null $trashed = false): mixed;

    public function roleById($id, $trashed = false): ?Role;

    public function store($name, $permissionId): mixed;

    public function update($id, $name, $permissionId): bool;

    public function destroy($id): ?bool;
}
