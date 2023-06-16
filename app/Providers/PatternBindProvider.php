<?php

namespace App\Providers;

use App\Http\Controllers\Media\Relation\Image\Contract\ImageInterface;
use App\Http\Controllers\Media\Relation\Image\Repository\ImageRepository;
use App\Http\Struct\Media\Contract\MediaInterface;
use App\Http\Struct\Media\Relation\MediaPolymorphic\Contract\MediaPolymorphicInterface;
use App\Http\Struct\Media\Relation\MediaPolymorphic\Repository\MediaPolymorphicRepository;
use App\Http\Struct\Media\Repository\MediaRepository;
use App\Http\Struct\Product\Contract\ProductInterface;
use App\Http\Struct\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Repository\AttributeValueRepository;
use App\Http\Struct\Product\Relation\Attribute\Repository\AttributeRepository;
use App\Http\Struct\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Struct\Product\Relation\Brand\Repository\BrandRepository;
use App\Http\Struct\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Struct\Product\Relation\Category\Repository\CategoryRepository;
use App\Http\Struct\Product\Relation\Coupon\Contract\CouponInterface;
use App\Http\Struct\Product\Relation\Coupon\Repository\CouponRepository;
use App\Http\Struct\Product\Repository\ProductRepository;
use App\Http\Struct\User\Contract\UserInterface;
use App\Http\Struct\User\Relation\Permission\Contract\PermissionInterface;
use App\Http\Struct\User\Relation\Permission\Repository\PermissionRepository;
use App\Http\Struct\User\Relation\Role\Contract\RoleInterface;
use App\Http\Struct\User\Relation\Role\Repository\RoleRepository;
use App\Http\Struct\User\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class PatternBindProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductInterface::class,
            ProductRepository::class
        );
        $this->app->bind(
            CategoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            PermissionInterface::class,
            PermissionRepository::class
        );

        $this->app->bind(
            RoleInterface::class,
            RoleRepository::class
        );

        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            BrandInterface::class,
            BrandRepository::class
        );

        $this->app->bind(
            AttributeInterface::class,
            AttributeRepository::class
        );

        $this->app->bind(
            AttributeValueInterface::class,
            AttributeValueRepository::class
        );

        $this->app->bind(
            CouponInterface::class,
            CouponRepository::class
        );

        $this->app->bind(
            ImageInterface::class,
            ImageRepository::class
        );

        $this->app->bind(
            MediaInterface::class,
            MediaRepository::class
        );

        $this->app->bind(
            MediaPolymorphicInterface::class,
            MediaPolymorphicRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
