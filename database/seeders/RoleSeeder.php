<?php

namespace Database\Seeders;

use App\Http\Struct\User\Enumeration\UserRoleEnumeration;
use App\Http\Struct\User\Relation\Permission\Contract\PermissionInterface;
use App\Http\Struct\User\Relation\Role\Contract\RoleInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
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
     * @throws BindingResolutionException
     */
    public function firstOrCreate(array $columns): void
    {
        resolve(RoleInterface::class)
            ->roleFirstOrCreate($columns);
        $this->givePermissionByRoleName(UserRoleEnumeration::ADMINISTRATOR_ROLE);
    }

    /**
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
