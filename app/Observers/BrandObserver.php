<?php

namespace App\Observers;

use App\Http\Struct\Product\Relation\Brand\Model\Brand;

class BrandObserver
{
    /**
     * Handle the Brand "created" event.
     */
    public function created(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "updated" event.
     */
    public function updated(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "deleting" event.
     */
    public function deleting(Brand $brand): void
    {
        $brand->products()
            ->each(fn ($product) => $product->delete());
        $brand->destroyMedia();
    }

    /**
     * Handle the Brand "restoring" event.
     */
    public function restoring(Brand $brand): void
    {
        $brand->products()
            ->onlyTrashed()
            ->each(fn ($product) => $product->restore());
        $brand->restoreMedia();
    }

    /**
     * Handle the Brand "force deleting" event.
     */
    public function forceDeleting(Brand $brand): void
    {
        $brand->products()
            ->onlyTrashed()
            ->each(fn ($product) => $product->forceDelete());
        $brand->forceDestroyMedia();
    }
}
