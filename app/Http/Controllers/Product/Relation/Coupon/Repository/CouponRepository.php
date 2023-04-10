<?php

namespace App\Http\Controllers\Product\Relation\Coupon\Repository;

use App\Http\Controllers\Product\Relation\Coupon\Contract\CouponInterface;
use App\Http\Controllers\Product\Relation\Coupon\Model\Coupon;

class CouponRepository implements CouponInterface
{
    /**
     * @param Coupon $model
     */
    public function __construct(public Coupon $model)
    {
    }

    /**
     * @param $id
     * @return mixed
     */
    public function couponById($id): mixed
    {
        return $this->model
            ->whereId($id)
            ->first();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function coupons(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn($eloquent) => $eloquent->select($columns),
                fn($eloquent) => $eloquent->get()
            );
    }

    /**
     * @param $code
     * @param $type
     * @param $value
     * @param $usage_limit
     * @param $status
     * @param $expired_at
     * @return mixed
     */
    public function store($code, $type, $value, $usage_limit, $status, $expired_at): mixed
    {
        return $this->model->create([
            'code' => $code,
            'type' => $type,
            'value' => $value,
            'usage_limit' => $usage_limit,
            'status' => $status,
            'expired_at' => $expired_at
        ]);
    }

    /**
     * @param $id
     * @param $code
     * @param $type
     * @param $value
     * @param $usage_limit
     * @param $status
     * @param $expired_at
     * @return bool
     */
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
                'expired_at' => $expired_at
            ]);

            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        $coupon = $this->couponById($id);
        if ($coupon) {
            $coupon->delete();

            return true;
        }

        return false;
    }
}
