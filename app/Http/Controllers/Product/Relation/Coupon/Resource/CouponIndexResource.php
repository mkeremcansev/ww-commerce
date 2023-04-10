<?php

namespace App\Http\Controllers\Product\Relation\Coupon\Resource;

use App\Http\Controllers\Product\Relation\Coupon\Collection\CouponIndexCollection;
use App\Traits\DatatableCollectionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponIndexResource extends JsonResource
{
    use DatatableCollectionTrait;

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
                'data' => CouponIndexCollection::collection($this->data ?? null)
            ]
            +
            $this->datatables($this);
    }
}
