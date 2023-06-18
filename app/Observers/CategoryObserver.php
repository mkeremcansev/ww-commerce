<?php

namespace App\Observers;

use App\Http\Struct\Product\Relation\Category\Model\Category;
use App\Http\Struct\Product\Relation\ProductCategory\Model\ProductCategory;

class CategoryObserver
{
    public function __construct(public ProductCategory $productCategory)
    {
    }

    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "deleting" event.
     */
    public function deleting(Category $category): void
    {
        $category->parents()->each(fn ($parent) => $parent->delete());
        $this->productCategory->where('category_id', $category->id)
            ->each(function ($pivot) {
                $pivot->delete();
                $pivot->product->delete();
            });
    }

    /**
     * Handle the Category "restoring" event.
     */
    public function restoring(Category $category): void
    {
        $category
            ->parents()
            ->onlyTrashed()
            ->each(fn ($parent) => $parent->restore());
        $this->productCategory
            ->onlyTrashed()
            ->where('category_id', $category->id)
            ->each(function ($pivot) {
                $pivot->restore();
                $pivot->product()
                    ->onlyTrashed()
                    ->restore();
            });
    }

    /**
     * Handle the Category "force deleting" event.
     */
    public function forceDeleting(Category $category): void
    {
        $category
            ->parents()
            ->onlyTrashed()
            ->each(fn ($parent) => $parent->forceDelete());
        $this->productCategory
            ->onlyTrashed()
            ->where('category_id', $category->id)
            ->each(function ($pivot) {
                $pivot->forceDelete();
                $pivot->product()
                    ->onlyTrashed()
                    ->forceDelete();
            });
    }
}
