<?php

namespace App\Http\Controllers\Product\Relation\Brand\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandIndexCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'slug' => $this->slug ?? null,
        ];
    }
}
