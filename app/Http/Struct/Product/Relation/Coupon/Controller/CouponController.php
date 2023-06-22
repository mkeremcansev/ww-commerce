<?php

namespace App\Http\Struct\Product\Relation\Coupon\Controller;

use App\Helpers\EnumerationHelper;
use App\Http\Controller;
use App\Http\Struct\Product\Relation\Coupon\Enumeration\CouponStatusEnumeration;
use App\Http\Struct\Product\Relation\Coupon\Enumeration\CouponTypeEnumeration;
use App\Http\Struct\Product\Relation\Coupon\Request\CouponIndexRequest;
use App\Http\Struct\Product\Relation\Coupon\Request\CouponRestoreAndForceDeleteRequest;
use App\Http\Struct\Product\Relation\Coupon\Request\CouponStoreRequest;
use App\Http\Struct\Product\Relation\Coupon\Request\CouponUpdateRequest;
use App\Http\Struct\Product\Relation\Coupon\Resource\CouponIndexResource;
use App\Http\Struct\Product\Relation\Coupon\ResourceCollection\CouponEditResourceCollection;
use App\Http\Struct\Product\Relation\Coupon\Service\CouponService;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Http\JsonResponse;
use ReflectionException;

class CouponController extends Controller
{
    public function __construct(public CouponService $service)
    {
    }

    /**
     * @throws Exception
     */
    public function index(CouponIndexRequest $request): CouponIndexResource
    {
        return new CouponIndexResource($this->service->index($request->trashed));
    }

    /**
     * @throws ReflectionException
     */
    public function create(): array
    {
        return [
            'statuses' => EnumerationHelper::enumerationToArray(CouponStatusEnumeration::class),
            'types' => EnumerationHelper::enumerationToArray(CouponTypeEnumeration::class),
        ];
    }

    public function store(CouponStoreRequest $request): JsonResponse
    {
        $coupon = $this->service->store($request->code, $request->type, $request->value, $request->usage_limit, $request->status, $request->expired_at);

        return ResponseHandler::store(['id' => $coupon->id]);
    }

    public function edit(int $id): JsonResponse|CouponEditResourceCollection
    {
        $coupon = $this->service->edit($id);

        return $coupon
            ? new CouponEditResourceCollection($coupon)
            : ResponseHandler::recordNotFound();
    }

    public function update(int $id, CouponUpdateRequest $request): JsonResponse
    {
        $coupon = $this->service->update($id, $request->code, $request->type, $request->value, $request->usage_limit, $request->status, $request->expired_at);

        return $coupon
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::recordNotFound();
    }

    public function destroy(int $id): JsonResponse
    {
        $coupon = $this->service->destroy($id);

        return $coupon
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }

    public function restore(CouponRestoreAndForceDeleteRequest $request): JsonResponse
    {
        return $this->service->restore($request->ids)
            ? ResponseHandler::restore()
            : ResponseHandler::recordNotFound();
    }

    public function forceDelete(CouponRestoreAndForceDeleteRequest $request): JsonResponse
    {
        return $this->service->forceDelete($request->ids)
            ? ResponseHandler::forceDelete()
            : ResponseHandler::recordNotFound();
    }
}
