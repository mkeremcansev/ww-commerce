<?php

namespace App\Http\Controllers\Product\Relation\ProductVariant\Repository;

use App\Http\Controllers\Product\Relation\ProductVariant\Contract\ProductVariantInterface;
use App\Http\Controllers\Product\Relation\ProductVariant\Model\ProductVariant;

class ProductVariantRepository implements ProductVariantInterface
{
    /**
     * @param ProductVariant $model
     */
    public function __construct(public ProductVariant $model)
    {
    }
}