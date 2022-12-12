<?php

namespace App\Http\Controllers\Product\Relation\Brand\Controller;

use App\Exceptions\ResponseHandler;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Brand\Request\BrandStoreRequest;
use App\Http\Controllers\Product\Relation\Brand\Service\BrandService;
use Illuminate\Http\JsonResponse;
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
     * @param BrandStoreRequest $request
     * @return JsonResponse
     */
    public function store(BrandStoreRequest $request): JsonResponse
    {
        $brand = $this->service->store($request->title, $this->str::slug($request->title), $request->path);

        return ResponseHandler::store(['id' => $brand->id]);
    }
}
