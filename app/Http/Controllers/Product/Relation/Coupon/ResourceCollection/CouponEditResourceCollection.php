<?php

namespace App\Http\Controllers\Product\Relation\Coupon\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponEditResourceCollection extends JsonResource
{
    /**
     * @param $request
     * @return array
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
            'expired_at' => $this->expired_at ?? null
        ];
    }
}
