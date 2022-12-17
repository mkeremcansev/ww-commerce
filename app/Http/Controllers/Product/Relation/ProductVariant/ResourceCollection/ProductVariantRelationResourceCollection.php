<?php

namespace App\Http\Controllers\Product\Relation\ProductVariant\ResourceCollection;

use App\Helpers\GeneralHelper;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantRelationResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     * @throws BindingResolutionException
     */
    public function toArray($request): array
    {
        return GeneralHelper::skuFormatter($this->sku, $this->stock, $this->price);
    }
}
