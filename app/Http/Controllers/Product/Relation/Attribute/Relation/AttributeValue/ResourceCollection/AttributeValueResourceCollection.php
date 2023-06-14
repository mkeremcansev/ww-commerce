<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\ResourceCollection;

use App\Http\Controllers\Media\ResourceCollection\MediaResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'code' => $this->code ?? null,
            'media' => new MediaResourceCollection($this->firstMedia() ?? null),
            'attribute_id' => $this->attribute_id ?? null,
        ];
    }
}
