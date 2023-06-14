<?php

namespace App\Http\Controllers\Product\Relation\Category\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCreateResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'slug' => $this->slug ?? null,
            'parent_id' => $this->parent_id ?? null,
            'parents' => self::collection($this->parents),
        ];
    }
}
