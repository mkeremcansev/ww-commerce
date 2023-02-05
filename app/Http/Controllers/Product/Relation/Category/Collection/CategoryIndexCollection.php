<?php

namespace App\Http\Controllers\Product\Relation\Category\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryIndexCollection extends JsonResource
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
            'path' => asset($this->path ?? null)
        ];
    }
}
