<?php

namespace App\Http\Controllers\Product\Relation\Attribute\ResourceCollection;

use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\ResourceCollection\AttributeValueResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeRelationResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'attribute_values' => AttributeValueResourceCollection::collection($this->values)
        ];
    }
}
