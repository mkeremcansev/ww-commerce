<?php

namespace App\Http\Struct\Product\Resource;

use App\Http\Struct\Product\Collection\ProductIndexCollection;
use App\Traits\DatatableCollectionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
{
    use DatatableCollectionTrait;

    public function toArray($request): array
    {
        return [
            'data' => ProductIndexCollection::collection($this->data ?? null),
        ]
            +
            $this->datatables($this);
    }
}
