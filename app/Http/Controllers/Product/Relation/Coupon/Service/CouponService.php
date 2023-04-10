<?php

namespace App\Http\Controllers\Product\Relation\Coupon\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Product\Relation\Coupon\Repository\CouponRepository;
use Exception;

class CouponService
{
    /**
     * @param CouponRepository $repository
     */
    public function __construct(public CouponRepository $repository)
    {
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->coupons(['id', 'code', 'value', 'usage_limit', 'expired_at']));
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
        return $this->repository->store($code, $type, $value, $usage_limit, $status, $expired_at);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id): mixed
    {
        return $this->repository->couponById($id);
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
        return $this->repository->update($id, $code, $type, $value, $usage_limit, $status, $expired_at);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->repository->destroy($id);
    }
}
