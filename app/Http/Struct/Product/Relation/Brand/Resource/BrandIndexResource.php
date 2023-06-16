<?php

namespace App\Http\Struct\Product\Relation\Brand\Resource;

use App\Http\Struct\Product\Relation\Brand\Collection\BrandIndexCollection;
use App\Traits\DatatableCollectionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandIndexResource extends JsonResource
{
    use DatatableCollectionTrait;

    public function toArray($request): array
    {
        return [
            'data' => BrandIndexCollection::collection($this->data ?? null),
        ]
            +
            $this->datatables($this);
    }
}
