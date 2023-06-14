<?php

namespace App\Http\Controllers\Product\Relation\Category\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {;
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'slug' => $this->slug ?? null,
            'media' => $this->firstMedia() ?? null,
        ];
    }
}
