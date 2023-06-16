<?php

namespace App\Http\Struct\Product\Relation\ProductVariant\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantRelationResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return skuFormatter($this->sku, $this->stock, $this->price);
    }
}
