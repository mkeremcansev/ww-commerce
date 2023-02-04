<?php

namespace App\Http\Controllers\Product\Relation\Brand\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandIndexCollection extends JsonResource
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
