<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeIndexCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
        ];
    }
}
