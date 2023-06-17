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
        if (! $product->isRestoring) {
            $this->forceDestroyRelational($product);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $this->destroyRelational($product);
    }

    /**
     * Handle the Product "restoring" event.
     */
    public function restoring(Product $product): void
    {
        $product->isRestoring = true;
        $this->restoreRelational($product);
    }

    /**
     * Handle the Product "force deleting" event.
     */
    public function forceDeleting(Product $product): void
    {
        $this->forceDestroyRelational($product);
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }

    private function forceDestroyRelational(Product $product): void
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

    private function destroyRelational(Product $product): void
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

    private function restoreRelational(Product $product): void
    {
        $product->variants()->restore();
        $this->attribute
            ->where('product_id', $product->id)
            ->restore();
        $this->category
            ->where('product_id', $product->id)
            ->restore();
        $product->restoreMedia();
    }
}
