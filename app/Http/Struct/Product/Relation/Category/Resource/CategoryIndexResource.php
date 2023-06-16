<?php

namespace App\Http\Struct\Product\Relation\Category\Resource;

use App\Http\Struct\Product\Relation\Category\Collection\CategoryIndexCollection;
use App\Traits\DatatableCollectionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryIndexResource extends JsonResource
{
    use DatatableCollectionTrait;

    public function toArray($request): array
    {
        return [
            'data' => CategoryIndexCollection::collection($this->data ?? null),
        ]
            +
            $this->datatables($this);
    }
}
