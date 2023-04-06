<?php

namespace App\Http\Controllers\Product\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexCollection extends JsonResource
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
            'price' => $this->price ?? null
        ];
    }
}
