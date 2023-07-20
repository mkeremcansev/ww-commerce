<?php

namespace App\Http\Struct\Product\Relation\Category\Resource;

use App\Http\Struct\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Struct\Product\Relation\Attribute\ResourceCollection\AttributeResourceCollection;
use App\Http\Struct\Product\Relation\Category\ResourceCollection\CategoryCreateResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCreateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'attributes' => AttributeResourceCollection::collection(resolve(AttributeInterface::class)
                ->attributes() ?? null),
            'categories' => CategoryCreateResourceCollection::collection($this->resource),
        ];
    }
}
