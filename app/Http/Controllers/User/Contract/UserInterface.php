<?php

namespace App\Http\Controllers\User\Contract;

use App\Http\Controllers\User\Model\User;

interface UserInterface
{
    /**
     * @param array $columns
     * @return User
     */
    public function userUpdateOrCreate(array $columns): User;
}
