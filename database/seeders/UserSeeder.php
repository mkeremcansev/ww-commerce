<?php

namespace Database\Seeders;

use App\Http\Controllers\User\Contract\UserInterface;
use App\Http\Controllers\User\Enumeration\UserRoleEnumeration;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->firstOrCreate('Admin', 'admin@ww-commerce.com', 'password');
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return void
     */
    public function firstOrCreate(string $name, string $email, string $password): void
    {
        $this->assignRoleAndAssignPermissions(resolve(UserInterface::class)
            ->userUpdateOrCreate([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
            ]));
    }

    /**
     * @param $user
     * @return void
     */
    public function assignRoleAndAssignPermissions($user): void
    {
        $user->assignRole(UserRoleEnumeration::ADMINISTRATOR_ROLE);
    }
}
