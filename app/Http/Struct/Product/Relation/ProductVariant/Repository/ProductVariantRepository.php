<?php

namespace App\Http\Struct\Product\Relation\ProductVariant\Repository;

use App\Http\Struct\Product\Relation\ProductVariant\Contract\ProductVariantInterface;
use App\Http\Struct\Product\Relation\ProductVariant\Model\ProductVariant;

class ProductVariantRepository implements ProductVariantInterface
{
    public function __construct(public ProductVariant $model)
    {
    }
}
