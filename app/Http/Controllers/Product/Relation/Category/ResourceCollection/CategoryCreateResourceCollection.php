<?php

namespace App\Http\Controllers\Product\Relation\Category\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCreateResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'slug' => $this->slug ?? null,
            'path' => asset($this->path ?? null),
            'parents' => self::collection($this->parents)
        ];
    }
}
