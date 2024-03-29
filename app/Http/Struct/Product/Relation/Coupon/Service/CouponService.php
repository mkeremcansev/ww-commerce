<?php

namespace App\Http\Struct\Product\Relation\Coupon\Service;

use App\Helpers\DatatableHelper;
use App\Http\Struct\Product\Relation\Coupon\Repository\CouponRepository;
use Exception;

class CouponService
{
    public function __construct(public CouponRepository $repository)
    {
    }

    /**
     * @throws Exception
     */
    public function index(bool|null $trashed = false): mixed
    {
        return DatatableHelper::datatable($this->repository->coupons(['id', 'code', 'value', 'usage_limit', 'expired_at', 'deleted_at'], $trashed));
    }

    public function store($code, $type, $value, $usage_limit, $status, $expired_at): mixed
    {
        return $this->repository->store($code, $type, $value, $usage_limit, $status, $expired_at);
    }

    public function edit($id): mixed
    {
        return $this->repository->couponById($id);
    }

    public function update($id, $code, $type, $value, $usage_limit, $status, $expired_at): bool
    {
        return $this->repository->update($id, $code, $type, $value, $usage_limit, $status, $expired_at);
    }

    public function destroy($id): ?bool
    {
        return $this->repository->destroy($id);
    }

    public function restore(array $ids): bool
    {
        foreach ($ids as $id) {
            $this->repository->restore($id);
        }

        return true;
    }

    public function forceDelete(array $ids): bool
    {
        foreach ($ids as $id) {
            $this->repository->forceDelete($id);
        }

        return true;
    }
}
