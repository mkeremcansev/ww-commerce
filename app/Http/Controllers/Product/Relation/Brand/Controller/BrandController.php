<?php

namespace App\Http\Controllers\Product\Relation\Brand\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Brand\Request\BrandStoreRequest;
use App\Http\Controllers\Product\Relation\Brand\Request\BrandUpdateRequest;
use App\Http\Controllers\Product\Relation\Brand\Resource\BrandIndexResource;
use App\Http\Controllers\Product\Relation\Brand\ResourceCollection\BrandResourceCollection;
use App\Http\Controllers\Product\Relation\Brand\Service\BrandService;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function __construct(public BrandService $service, public Str $str)
    {
    }

    /**
     * @throws Exception
     */
    public function index(): BrandIndexResource
    {
        return new BrandIndexResource($this->service->index());
    }

    public function store(BrandStoreRequest $request): JsonResponse
    {
        $brand = $this->service->store($request->title, $this->str::slug($request->title), $request->media);

        return ResponseHandler::store(['id' => $brand->id]);
    }

    public function edit(int $id): JsonResponse|BrandResourceCollection
    {
        $brand = $this->service->edit($id);

        return $brand
            ? new BrandResourceCollection($brand)
            : ResponseHandler::recordNotFound();
    }

    public function update(int $id, BrandUpdateRequest $request): JsonResponse
    {
        $brand = $this->service->update($id, $request->title, $this->str::slug($request->title), $request->media);

        return $brand
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::recordNotFound();
    }

    public function destroy(int $id): JsonResponse
    {
        $brand = $this->service->destroy($id);

        return $brand
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }
}
