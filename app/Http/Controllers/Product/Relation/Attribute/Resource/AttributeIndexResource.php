<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Resource;

use App\Http\Controllers\Product\Relation\Attribute\Collection\AttributeIndexCollection;
use App\Traits\DatatableCollectionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeIndexResource extends JsonResource
{
    use DatatableCollectionTrait;

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
                'data' => AttributeIndexCollection::collection($this->data ?? null)
            ]
            +
            $this->datatables($this);
    }
}
