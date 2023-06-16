<?php

namespace App\Http\Struct\Product\Relation\Attribute\Resource;

use App\Http\Struct\Product\Relation\Attribute\Collection\AttributeIndexCollection;
use App\Traits\DatatableCollectionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeIndexResource extends JsonResource
{
    use DatatableCollectionTrait;

    public function toArray($request): array
    {
        return [
            'data' => AttributeIndexCollection::collection($this->data ?? null),
        ]
            +
            $this->datatables($this);
    }
}
