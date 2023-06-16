<?php

namespace App\Http\Struct\Product\Relation\Coupon\Resource;

use App\Http\Struct\Product\Relation\Coupon\Collection\CouponIndexCollection;
use App\Traits\DatatableCollectionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponIndexResource extends JsonResource
{
    use DatatableCollectionTrait;

    public function toArray($request): array
    {
        return [
            'data' => CouponIndexCollection::collection($this->data ?? null),
        ]
            +
            $this->datatables($this);
    }
}
