<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeIndexCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null
        ];
    }
}
