<?php

namespace App\Http\Struct\Product\Relation\Attribute\ResourceCollection;

use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\ResourceCollection\AttributeValueResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeRelationResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'attribute_values' => AttributeValueResourceCollection::collection($this->values),
        ];
    }
}
