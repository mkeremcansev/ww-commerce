<?php

namespace App\Http\Controllers\Product\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'price' => $this->price ?? null,
            'status' => $this->status ?? null,
        ];
    }
}
