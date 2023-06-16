<?php

namespace App\Http\Struct\User\Contract;

use App\Http\Struct\User\Model\User;
use Illuminate\Support\Collection;

interface UserInterface
{
    public function userUpdateOrCreate(array $columns): User;

    public function userByEmail($email): ?User;

    public function userById($id): ?User;

    public function update($id, $name, $email, array $roleId): bool;

    public function destroy($id): ?bool;

    public function usersByRoleName(array $roleNames): Collection|array;

    public function users(array $columns = []): mixed;

    public function profileUpdate($name, $password): bool;
}
