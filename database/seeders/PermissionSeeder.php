<?php

namespace Database\Seeders;

use App\Http\Controllers\User\Relation\Permission\Contract\PermissionInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function run(): void
    {
        //Category permissions
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.index', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.create', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.store', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.edit', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.show', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.update', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.destroy', 'guard_name' => 'web']);
    }

    /**
     * @param array $columns
     * @return void
     * @throws BindingResolutionException
     */
    public function firstOrCreate(array $columns): void
    {
        app()
            ->make(PermissionInterface::class)
            ->permissionFirstOrCreate($columns);
    }
}
