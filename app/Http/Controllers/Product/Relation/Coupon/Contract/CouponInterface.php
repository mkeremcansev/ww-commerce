<?php

namespace App\Http\Controllers\Product\Relation\Coupon\Contract;

interface CouponInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function couponById($id): mixed;

    /**
     * @param array $columns
     * @return mixed
     */
    public function coupons(array $columns = []): mixed;

    /**
     * @param $code
     * @param $type
     * @param $value
     * @param $usage_limit
     * @param $status
     * @param $expired_at
     * @return mixed
     */
    public function store($code, $type, $value, $usage_limit, $status, $expired_at): mixed;

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
    public function update($id, $code, $type, $value, $usage_limit, $status, $expired_at): bool;

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;
}
