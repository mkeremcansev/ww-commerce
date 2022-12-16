<?php

namespace App\Http\Controllers\Product\ResourceCollection;

use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeRelationResourceCollection;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeResourceCollection;
use App\Http\Controllers\Product\Relation\Brand\ResourceCollection\BrandResourceCollection;
use App\Http\Controllers\Product\Relation\ProductCategory\ResourceCollection\ProductCategoryResourceCollection;
use App\Http\Controllers\Product\Relation\ProductImage\ResourceCollection\ProductImageResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'price' => $this->price,
            'brand' => new BrandResourceCollection($this->brand),
            'categories' => ProductCategoryResourceCollection::collection($this->categories),
            'images' => ProductImageResourceCollection::collection($this->images),
            'attributes' => AttributeRelationResourceCollection::collection($this->attributes)
        ];
    }
}
