<?php

namespace App\Http\Controllers\User\Contract;

use App\Http\Controllers\User\Model\User;
use Illuminate\Support\Collection;

interface UserInterface
{
    /**
     * @param array $columns
     * @return User
     */
    public function userUpdateOrCreate(array $columns): User;

    /**
     * @param $email
     * @return null|User
     */
    public function userByEmail($email): ?User;

    /**
     * @param $id
     * @return User|null
     */
    public function userById($id): ?User;

    /**
     * @param $id
     * @param $name
     * @param $email
     * @param array $roleId
     * @return bool
     */
    public function update($id, $name, $email, array $roleId): bool;

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;

    /**
     * @param array $roleNames
     * @return Collection|array
     */
    public function usersByRoleName(array $roleNames): Collection|array;

    /**
     * @param array $columns
     * @return mixed
     */
    public function users(array $columns = []): mixed;
}
