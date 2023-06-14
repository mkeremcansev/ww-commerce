<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueIndexCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'code' => $this->code ?? null,
        ];
    }
}
