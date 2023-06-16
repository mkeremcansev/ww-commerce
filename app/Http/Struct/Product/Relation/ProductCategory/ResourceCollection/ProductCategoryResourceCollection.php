<?php

namespace App\Http\Struct\Product\Relation\ProductCategory\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResourceCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'slug' => $this->slug ?? null,
            'media' => $this->firstMedia() ?? null,
            'parent_id' => $this->category_id ?? null,
            'parents' => self::collection($this->parents),
        ];
    }
}
