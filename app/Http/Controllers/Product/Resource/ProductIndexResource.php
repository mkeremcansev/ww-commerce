<?php

namespace App\Http\Controllers\Product\Resource;

use App\Http\Controllers\Product\Collection\ProductIndexCollection;
use App\Traits\DatatableCollectionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
{
    use DatatableCollectionTrait;

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
                'data' => ProductIndexCollection::collection($this->data ?? null)
            ]
            +
            $this->datatables($this);
    }
}
