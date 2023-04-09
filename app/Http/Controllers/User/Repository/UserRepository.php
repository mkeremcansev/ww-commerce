<?php

namespace App\Http\Controllers\User\Repository;

use App\Http\Controllers\User\Contract\UserInterface;
use App\Http\Controllers\User\Model\User;
use Illuminate\Support\Collection;

class UserRepository implements UserInterface
{
    public function __construct(public User $user)
    {
    }

    /**
     * @param array $columns
     * @return User
     */
    public function userUpdateOrCreate(array $columns): User
    {
        return $this->user
            ->firstOrCreate($columns);
    }

    /**
     * @param $email
     * @return null|User
     */
    public function userByEmail($email): ?User
    {
        return $this->user
            ->whereEmail($email)
            ->first();
    }

    /**
     * @param $id
     * @return null|User
     */
    public function userById($id): ?User
    {
        return $this->user
            ->whereId($id)
            ->first();
    }

    /**
     * @param $id
     * @param $name
     * @param $email
     * @param array $roleId
     * @return bool
     */
    public function update($id, $name, $email, array $roleId): bool
    {
        $user = $this->userById($id);

        return $user && $user->update([
                'name' => $name,
                'email' => $email,
            ]) && $user->syncRoles($roleId);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        $user = $this->userById($id);

        return $user && $user->delete();
    }

    /**
     * @param array $roleNames
     * @return Collection|array
     */
    public function usersByRoleName(array $roleNames): Collection|array
    {
        return $this->user
            ->role($roleNames)
            ->get();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function users(array $columns = []): mixed
    {
        return $this->user
            ->when(count($columns),
                fn($eloquent) => $eloquent->select($columns),
                fn($eloquent) => $eloquent->get()
            );
    }

    /**
     * @param $name
     * @param $password
     * @return bool
     */
    public function profileUpdate($name, $password): bool
    {
        $user = $this->userById(auth()->id());

        return $user && $user->update([
                'name' => $name,
                'password' => bcrypt($password),
            ]);
    }
}
