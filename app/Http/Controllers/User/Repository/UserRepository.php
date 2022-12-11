<?php

namespace App\Http\Controllers\User\Repository;

use App\Http\Controllers\User\Contract\UserInterface;
use App\Http\Controllers\User\Model\User;

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
}
