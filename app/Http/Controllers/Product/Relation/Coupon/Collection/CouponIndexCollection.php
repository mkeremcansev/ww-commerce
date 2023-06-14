<?php

namespace App\Http\Controllers\Product\Relation\Coupon\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponIndexCollection extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? null,
            'code' => $this->code ?? null,
            'value' => $this->value ?? null,
            'usage_limit' => $this->usage_limit ?? null,
            'expired_at' => $this->expired_at ?? null,
        ];
    }
}
