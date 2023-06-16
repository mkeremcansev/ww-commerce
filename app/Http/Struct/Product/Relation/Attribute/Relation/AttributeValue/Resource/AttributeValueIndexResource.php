<?php

namespace App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Resource;

use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Collection\AttributeValueIndexCollection;
use App\Traits\DatatableCollectionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueIndexResource extends JsonResource
{
    use DatatableCollectionTrait;

    public function toArray($request): array
    {
        return [
            'data' => AttributeValueIndexCollection::collection($this->data ?? null),
        ]
            +
            $this->datatables($this);
    }
}
