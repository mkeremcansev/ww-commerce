<?php

namespace App\Http\Controllers\Product\ResourceCollection;

use App\Http\Controllers\Brand\ResourceCollection\BrandResourceCollection;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeResourceCollection;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeValueResourceCollection;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

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
            'categories' => CategoryResourceCollection::collection($this->categories),
            'attributes' => AttributeResourceCollection::collection($this->attributes)
        ];
    }
}
