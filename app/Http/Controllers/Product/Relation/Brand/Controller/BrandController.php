<?php

namespace App\Http\Controllers\Product\Relation\Brand\Controller;

use App\Exceptions\ResponseHandler;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Brand\Request\BrandStoreRequest;
use App\Http\Controllers\Product\Relation\Brand\Request\BrandUpdateRequest;
use App\Http\Controllers\Product\Relation\Brand\ResourceCollection\BrandResourceCollection;
use App\Http\Controllers\Product\Relation\Brand\Service\BrandService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * @param BrandService $service
     * @param Str $str
     */
    public function __construct(public BrandService $service, public Str $str)
    {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return BrandResourceCollection::collection($this->service->index());
    }

    /**
     * @param BrandStoreRequest $request
     * @return JsonResponse
     */
    public function store(BrandStoreRequest $request): JsonResponse
    {
        $brand = $this->service->store($request->title, $this->str::slug($request->title), $request->path);

        return ResponseHandler::store(['id' => $brand->id]);
    }

    /**
     * @param int $id
     * @return BrandResourceCollection|JsonResponse
     */
    public function edit(int $id): JsonResponse|BrandResourceCollection
    {
        $brand = $this->service->edit($id);

        return $brand
            ? new BrandResourceCollection($brand)
            : ResponseHandler::recordNotFound();
    }

    /**
     * @param int $id
     * @param BrandUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, BrandUpdateRequest $request): JsonResponse
    {
        $brand = $this->service->update($id, $request->title, $this->str::slug($request->title), $request->path);

        return $brand
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::recordNotFound();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $brand = $this->service->destroy($id);

        return $brand
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }
}
