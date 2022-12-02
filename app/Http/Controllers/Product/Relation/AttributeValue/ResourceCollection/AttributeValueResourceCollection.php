<?php

namespace App\Http\Controllers\Product\Relation\AttributeValue\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueResourceCollection extends JsonResource
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
            'code' => $this->code
        ];
    }
}
