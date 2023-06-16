<?php

namespace App\Http\Struct\Product\Relation\Brand\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'slug' => $this->slug ?? null,
            'media' => $this->firstMedia() ?? null,
        ];
    }
}
