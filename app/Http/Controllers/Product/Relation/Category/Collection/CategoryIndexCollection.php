<?php

namespace App\Http\Controllers\Product\Relation\Category\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryIndexCollection extends JsonResource
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
