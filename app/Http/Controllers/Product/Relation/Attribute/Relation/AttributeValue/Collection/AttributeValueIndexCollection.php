<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueIndexCollection extends JsonResource
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
            'code' => $this->code ?? null,
            'path' => asset($this->path ?? null)
        ];
    }
}
