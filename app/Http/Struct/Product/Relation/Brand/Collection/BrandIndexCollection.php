<?php

namespace App\Http\Struct\Product\Relation\Brand\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandIndexCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'slug' => $this->slug ?? null,
            'deleted_at' => $this->deleted_at ?? null,
        ];
    }
}
