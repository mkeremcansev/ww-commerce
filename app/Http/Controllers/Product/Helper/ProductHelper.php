<?php

namespace App\Http\Controllers\Product\Helper;

use App\Http\Controllers\Product\Model\Product;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeResourceCollection;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeValueResourceCollection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductHelper
{
    /**
     * @param Product $product
     * @return AnonymousResourceCollection
     */
    public function format(Product $product): AnonymousResourceCollection
    {
        return AttributeResourceCollection::collection($product->attributes);
    }
}
