<?php

namespace App\Http\Controllers\Product\Relation\Coupon\Controller;

use App\Helpers\EnumerationHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Coupon\Enumeration\CouponStatusEnumeration;
use App\Http\Controllers\Product\Relation\Coupon\Enumeration\CouponTypeEnumeration;
use App\Http\Controllers\Product\Relation\Coupon\Request\CouponStoreRequest;
use App\Http\Controllers\Product\Relation\Coupon\Request\CouponUpdateRequest;
use App\Http\Controllers\Product\Relation\Coupon\Resource\CouponIndexResource;
use App\Http\Controllers\Product\Relation\Coupon\ResourceCollection\CouponEditResourceCollection;
use App\Http\Controllers\Product\Relation\Coupon\Service\CouponService;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Http\JsonResponse;
use ReflectionException;

class CouponController extends Controller
{
    /**
     * @param CouponService $service
     */
    public function __construct(public CouponService $service)
    {
    }

    /**
     * @return CouponIndexResource
     * @throws Exception
     */
    public function index(): CouponIndexResource
    {
        return new CouponIndexResource($this->service->index());
    }

    /**
     * @return array
     * @throws ReflectionException
     */
    public function create(): array
    {
        return [
            'statuses' => EnumerationHelper::enumerationToArray(CouponStatusEnumeration::class),
            'types' => EnumerationHelper::enumerationToArray(CouponTypeEnumeration::class)
        ];
    }

    /**
     * @param CouponStoreRequest $request
     * @return JsonResponse
     */
    public function store(CouponStoreRequest $request): JsonResponse
    {
        $coupon = $this->service->store($request->code, $request->type, $request->value, $request->usage_limit, $request->status, $request->expired_at);

        return ResponseHandler::store(['id' => $coupon->id]);
    }

    /**
     * @param int $id
     * @return CouponEditResourceCollection|JsonResponse
     */
    public function edit(int $id): JsonResponse|CouponEditResourceCollection
    {
        $coupon = $this->service->edit($id);

        return $coupon
            ? new CouponEditResourceCollection($coupon)
            : ResponseHandler::recordNotFound();
    }

    /**
     * @param int $id
     * @param CouponUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, CouponUpdateRequest $request): JsonResponse
    {
        $coupon = $this->service->update($id, $request->code, $request->type, $request->value, $request->usage_limit, $request->status, $request->expired_at);

        return $coupon
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::recordNotFound();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $coupon = $this->service->destroy($id);

        return $coupon
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }
}
