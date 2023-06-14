<?php

namespace App\Http\Controllers\Product\Relation\Coupon\Contract;

interface CouponInterface
{
    public function couponById($id): mixed;

    public function coupons(array $columns = []): mixed;

    public function store($code, $type, $value, $usage_limit, $status, $expired_at): mixed;

    public function update($id, $code, $type, $value, $usage_limit, $status, $expired_at): bool;

    public function destroy($id): bool;
}
