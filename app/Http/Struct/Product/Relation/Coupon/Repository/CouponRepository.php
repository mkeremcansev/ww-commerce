<?php

namespace App\Http\Struct\Product\Relation\Coupon\Repository;

use App\Http\Struct\Product\Relation\Coupon\Contract\CouponInterface;
use App\Http\Struct\Product\Relation\Coupon\Model\Coupon;

class CouponRepository implements CouponInterface
{
    public function __construct(public Coupon $model)
    {
    }

    public function couponById($id): mixed
    {
        return $this->model
            ->whereId($id)
            ->first();
    }

    public function coupons(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->get()
            );
    }

    public function store($code, $type, $value, $usage_limit, $status, $expired_at): mixed
    {
        return $this->model->create([
            'code' => $code,
            'type' => $type,
            'value' => $value,
            'usage_limit' => $usage_limit,
            'status' => $status,
            'expired_at' => $expired_at,
        ]);
    }

    public function update($id, $code, $type, $value, $usage_limit, $status, $expired_at): bool
    {
        $coupon = $this->couponById($id);
        if ($coupon) {
            $coupon->update([
                'code' => $code,
                'type' => $type,
                'value' => $value,
                'usage_limit' => $usage_limit,
                'status' => $status,
                'expired_at' => $expired_at,
            ]);

            return true;
        }

        return false;
    }

    public function destroy($id): ?bool
    {
        $coupon = $this->couponById($id);

        return $coupon?->delete();
    }
}
