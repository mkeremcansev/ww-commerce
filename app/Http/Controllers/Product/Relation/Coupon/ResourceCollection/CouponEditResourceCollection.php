<?php

namespace App\Http\Controllers\Product\Relation\Coupon\ResourceCollection;

use App\Helpers\EnumerationHelper;
use App\Http\Controllers\Product\Relation\Coupon\Enumeration\CouponStatusEnumeration;
use App\Http\Controllers\Product\Relation\Coupon\Enumeration\CouponTypeEnumeration;
use Illuminate\Http\Resources\Json\JsonResource;
use ReflectionException;

class CouponEditResourceCollection extends JsonResource
{
    /**
     * @throws ReflectionException
     */
    public function toArray($request): array
    {
        self::withoutWrapping();

        return [
            'id' => $this->id ?? null,
            'code' => $this->code ?? null,
            'type' => $this->type ?? null,
            'value' => $this->value ?? null,
            'usage_limit' => $this->usage_limit ?? null,
            'status' => $this->status ?? null,
            'expired_at' => $this->expired_at ?? null,
            'statuses' => EnumerationHelper::enumerationToArray(CouponStatusEnumeration::class),
            'types' => EnumerationHelper::enumerationToArray(CouponTypeEnumeration::class),
        ];
    }
}
