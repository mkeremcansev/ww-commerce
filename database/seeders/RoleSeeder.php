<?php

namespace Database\Seeders;

use App\Http\Controllers\User\Enumeration\UserRoleEnumeration;
use App\Http\Controllers\User\Relation\Permission\Contract\PermissionInterface;
use App\Http\Controllers\User\Relation\Role\Contract\RoleInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function run(): void
    {
        $this->firstOrCreate(['name' => UserRoleEnumeration::ADMINISTRATOR_ROLE, 'guard_name' => 'web']);
        $this->firstOrCreate(['name' => UserRoleEnumeration::MODERATOR_ROLE, 'guard_name' => 'web']);
        $this->firstOrCreate(['name' => UserRoleEnumeration::CUSTOMER_REPRESENTATIVE_ROLE, 'guard_name' => 'web']);
        $this->firstOrCreate(['name' => UserRoleEnumeration::MEMBER_ROLE, 'guard_name' => 'web']);
    }

    /**
     * @param array $columns
     * @return void
     * @throws BindingResolutionException
     */
    public function firstOrCreate(array $columns): void
    {
        resolve(RoleInterface::class)
            ->roleFirstOrCreate($columns);
        $this->givePermissionByRoleName(UserRoleEnumeration::ADMINISTRATOR_ROLE);
    }

    /**
     * @param $roleName
     * @return void
     * @throws BindingResolutionException
     */
    public function givePermissionByRoleName($roleName): void
    {
        resolve(RoleInterface::class)
            ->roleByName($roleName)
            ->givePermissionTo(resolve(PermissionInterface::class)
                ->permissions()
                ->pluck('name', 'id'));
    }
}
