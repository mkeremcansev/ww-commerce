<?php

namespace App\Http\Controllers\Brand\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'path' => asset($this->path)
        ];
    }
}
