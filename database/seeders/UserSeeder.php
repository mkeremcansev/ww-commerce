<?php

namespace Database\Seeders;

use App\Http\Struct\User\Contract\UserInterface;
use App\Http\Struct\User\Enumeration\UserRoleEnumeration;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->firstOrCreate('Admin', 'admin@ww-commerce.com', 'password');
    }

    public function firstOrCreate(string $name, string $email, string $password): void
    {
        $this->assignRoleAndAssignPermissions(resolve(UserInterface::class)
            ->userUpdateOrCreate([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
            ]));
    }

    public function assignRoleAndAssignPermissions($user): void
    {
        $user->assignRole(UserRoleEnumeration::ADMINISTRATOR_ROLE);
    }
}
