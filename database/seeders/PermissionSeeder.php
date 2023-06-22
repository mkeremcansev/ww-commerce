<?php

namespace Database\Seeders;

use App\Http\Struct\User\Relation\Permission\Contract\PermissionInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws BindingResolutionException
     */
    public function run(): void
    {
        //Dashboard permissions
        $this->firstOrCreate(['group_name' => 'Dashboard', 'name' => 'dashboard.index', 'guard_name' => 'web']);

        //User permissions
        $this->firstOrCreate(['group_name' => 'User', 'name' => 'user.index', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'User', 'name' => 'user.create', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'User', 'name' => 'user.store', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'User', 'name' => 'user.edit', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'User', 'name' => 'user.update', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'User', 'name' => 'user.destroy', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'User', 'name' => 'user.profile.edit', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'User', 'name' => 'user.profile.update', 'guard_name' => 'web']);

        //Role permissions
        $this->firstOrCreate(['group_name' => 'Role', 'name' => 'role.index', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Role', 'name' => 'role.create', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Role', 'name' => 'role.store', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Role', 'name' => 'role.edit', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Role', 'name' => 'role.update', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Role', 'name' => 'role.destroy', 'guard_name' => 'web']);

        //Permission permissions
        $this->firstOrCreate(['group_name' => 'Permission', 'name' => 'permission.index', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Permission', 'name' => 'permission.create', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Permission', 'name' => 'permission.store', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Permission', 'name' => 'permission.edit', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Permission', 'name' => 'permission.update', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Permission', 'name' => 'permission.destroy', 'guard_name' => 'web']);

        //Category permissions
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.index', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.create', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.store', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.edit', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.update', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.destroy', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.restore', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Category', 'name' => 'category.forceDelete', 'guard_name' => 'web']);

        //Brand permissions
        $this->firstOrCreate(['group_name' => 'Brand', 'name' => 'brand.index', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Brand', 'name' => 'brand.create', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Brand', 'name' => 'brand.store', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Brand', 'name' => 'brand.edit', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Brand', 'name' => 'brand.update', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Brand', 'name' => 'brand.destroy', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Brand', 'name' => 'brand.restore', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Brand', 'name' => 'brand.forceDelete', 'guard_name' => 'web']);

        //Attribute permissions
        $this->firstOrCreate(['group_name' => 'Attribute', 'name' => 'attribute.index', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Attribute', 'name' => 'attribute.create', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Attribute', 'name' => 'attribute.store', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Attribute', 'name' => 'attribute.edit', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Attribute', 'name' => 'attribute.update', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Attribute', 'name' => 'attribute.destroy', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Attribute', 'name' => 'attribute.restore', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Attribute', 'name' => 'attribute.forceDelete', 'guard_name' => 'web']);

        //Attribute Value permissions
        $this->firstOrCreate(['group_name' => 'AttributeValue', 'name' => 'attribute_value.index', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'AttributeValue', 'name' => 'attribute_value.create', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'AttributeValue', 'name' => 'attribute_value.store', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'AttributeValue', 'name' => 'attribute_value.edit', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'AttributeValue', 'name' => 'attribute_value.update', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'AttributeValue', 'name' => 'attribute_value.destroy', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'AttributeValue', 'name' => 'attribute_value.restore', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'AttributeValue', 'name' => 'attribute_value.forceDelete', 'guard_name' => 'web']);

        //Product permissions
        $this->firstOrCreate(['group_name' => 'Product', 'name' => 'product.index', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Product', 'name' => 'product.create', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Product', 'name' => 'product.store', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Product', 'name' => 'product.edit', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Product', 'name' => 'product.update', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Product', 'name' => 'product.destroy', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Product', 'name' => 'product.restore', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Product', 'name' => 'product.forceDelete', 'guard_name' => 'web']);

        //Coupon permissions
        $this->firstOrCreate(['group_name' => 'Coupon', 'name' => 'coupon.index', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Coupon', 'name' => 'coupon.create', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Coupon', 'name' => 'coupon.store', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Coupon', 'name' => 'coupon.edit', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Coupon', 'name' => 'coupon.update', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Coupon', 'name' => 'coupon.destroy', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Coupon', 'name' => 'coupon.restore', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Coupon', 'name' => 'coupon.forceDelete', 'guard_name' => 'web']);

        //Media permissions
        $this->firstOrCreate(['group_name' => 'Media', 'name' => 'media.index', 'guard_name' => 'web']);

        //Image permissions
        $this->firstOrCreate(['group_name' => 'Image', 'name' => 'image.index', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Image', 'name' => 'image.upload', 'guard_name' => 'web']);
        $this->firstOrCreate(['group_name' => 'Image', 'name' => 'image.destroy', 'guard_name' => 'web']);

    }

    /**
     * @throws BindingResolutionException
     */
    public function firstOrCreate(array $columns): void
    {
        resolve(PermissionInterface::class)
            ->firstOrCreate($columns);
    }
}
