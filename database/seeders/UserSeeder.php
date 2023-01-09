<?php

namespace Database\Seeders;

use App\Http\Controllers\User\Contract\UserInterface;
use App\Http\Controllers\User\Enumeration\UserRoleEnumeration;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function run(): void
    {
        $user = resolve(UserInterface::class)
            ->userUpdateOrCreate(
                [
                    'name' => 'Admin',
                    'email' => 'admin@ww-commerce.com',
                    'password' => bcrypt('password'),
                ]
            );
        $user->assignRole(UserRoleEnumeration::ADMINISTRATOR_ROLE);
    }
}
