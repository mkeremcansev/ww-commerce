<?php

namespace App\Http\Struct\Product\Relation\Attribute\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeEditResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
        ];
    }
}
