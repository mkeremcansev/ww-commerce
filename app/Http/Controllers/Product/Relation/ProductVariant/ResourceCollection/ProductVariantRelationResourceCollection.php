<?php

namespace App\Http\Controllers\Product\Relation\ProductVariant\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantRelationResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return skuFormatter($this->sku, $this->stock, $this->price);
    }
}
