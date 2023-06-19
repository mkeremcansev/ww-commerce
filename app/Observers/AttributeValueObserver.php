<?php

namespace App\Observers;

use App\Http\Struct\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Struct\Product\Relation\Attribute\Model\Attribute;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;
use App\Http\Struct\Product\Relation\ProductAttribute\Model\ProductAttribute;
use App\Http\Struct\Product\Relation\ProductVariant\Model\ProductVariant;

class AttributeValueObserver
{
    public function __construct(public ProductAttribute $productAttribute, public Attribute $attribute, public ProductVariant $productVariant)
    {
    }

    /**
     * Handle the AttributeValue "created" event.
     */
    public function created(AttributeValue $attributeValue): void
    {
        //
    }

    /**
     * Handle the AttributeValue "updated" event.
     */
    public function updated(AttributeValue $attributeValue): void
    {
        //
    }

    /**
     * Handle the AttributeValue "deleting" event.
     */
    public function deleting(AttributeValue $attributeValue): void
    {
        $this->productAttribute
            ->where('attribute_value_id', $attributeValue->id)
            ->get()
            ->each(function ($productAttribute) {
                $this->productAttribute
                    ->where('product_id', $productAttribute->product_id)
                    ->delete();
                $this->productVariant
                    ->where('product_id', $productAttribute->product_id)
                    ->delete();
                $productAttribute->product()?->update([
                    'status' => ProductStatusEnumeration::PASSIVE,
                ]);
            });
        $attributeValue->destroyMedia();
    }

    /**
     * Handle the AttributeValue "restoring" event.
     */
    public function restoring(AttributeValue $attributeValue): void
    {
        $this->productAttribute
            ->onlyTrashed()
            ->where('attribute_value_id', $attributeValue->id)
            ->get()
            ->each(function ($productAttribute) {
                $this->productAttribute
                    ->onlyTrashed()
                    ->where('product_id', $productAttribute->product_id)
                    ->restore();
                $this->productVariant
                    ->onlyTrashed()
                    ->where('product_id', $productAttribute->product_id)
                    ->restore();
                $productAttribute->product()
                    ?->update([
                        'status' => ProductStatusEnumeration::ACTIVE,
                    ]);
            });
        $attributeValue->restoreMedia();
    }

    /**
     * Handle the AttributeValue "force deleting" event.
     */
    public function forceDeleting(AttributeValue $attributeValue): void
    {
        $this->productAttribute
            ->onlyTrashed()
            ->where('attribute_value_id', $attributeValue->id)
            ->get()
            ->each(function ($productAttribute) {
                $this->productAttribute
                    ->onlyTrashed()
                    ->where('product_id', $productAttribute->product_id)
                    ->forceDelete();
                $this->productVariant
                    ->onlyTrashed()
                    ->where('product_id', $productAttribute->product_id)
                    ->forceDelete();
                $productAttribute->product()
                    ->onlyTrashed()
                    ?->update([
                        'status' => ProductStatusEnumeration::PASSIVE,
                    ]);
            });
        $attributeValue->forceDestroyMedia();
    }
}
