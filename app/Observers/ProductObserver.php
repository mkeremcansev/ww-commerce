<?php

namespace App\Observers;

use App\Http\Struct\Product\Model\Product;
use App\Http\Struct\Product\Relation\ProductAttribute\Model\ProductAttribute;
use App\Http\Struct\Product\Relation\ProductCategory\Model\ProductCategory;

class ProductObserver
{
    public function __construct(
        public ProductAttribute $attribute,
        public ProductCategory $category,
    ) {
    }

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updating" event.
     */
    public function updating(Product $product): void
    {
        $product->variants()->forceDelete();
        $this->attribute
            ->where('product_id', $product->id)
            ->forceDelete();
        $this->category
            ->where('product_id', $product->id)
            ->forceDelete();
        $product->forceDestroyMedia();
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $product->variants()->delete();
        $this->attribute
            ->where('product_id', $product->id)
            ->delete();
        $this->category
            ->where('product_id', $product->id)
            ->delete();
        $product->destroyMedia();
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
