<?php

namespace App\Http\Struct\Product\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'slug' => $this->slug ?? null,
            'price' => $this->price ?? null,
        ];
    }
}
