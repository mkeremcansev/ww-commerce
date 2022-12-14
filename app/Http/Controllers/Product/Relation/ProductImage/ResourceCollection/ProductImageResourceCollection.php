<?php

namespace App\Http\Controllers\Product\Relation\ProductImage\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'path' => asset($this->path ?? null)
        ];
    }
}
