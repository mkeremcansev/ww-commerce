<?php

namespace App\Http\Struct\Product\ResourceCollection;

use App\Http\Struct\Media\ResourceCollection\MediaResourceCollection;
use App\Http\Struct\Product\Relation\Attribute\ResourceCollection\AttributeRelationResourceCollection;
use App\Http\Struct\Product\Relation\Brand\ResourceCollection\BrandResourceCollection;
use App\Http\Struct\Product\Relation\ProductCategory\ResourceCollection\ProductCategoryResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'content' => $this->content ?? null,
            'price' => $this->price ?? null,
            'brand' => new BrandResourceCollection($this->brand ?? null),
            'categories' => ProductCategoryResourceCollection::collection($this->categories ?? null),
            'media' => MediaResourceCollection::collection($this->getMedia() ?? null),
            'attributes' => AttributeRelationResourceCollection::collection($this->attributes ?? null),
        ];
    }
}
