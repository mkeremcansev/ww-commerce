<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueResourceCollection extends JsonResource
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
            'code' => $this->code ?? null,
            'path' => asset($this->path ?? null),
            'attribute_id' => $this->attribute_id ?? null,
        ];
    }
}
