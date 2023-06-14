<?php

namespace App\Http\Controllers\Product\Relation\Category\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Category\Request\CategoryStoreRequest;
use App\Http\Controllers\Product\Relation\Category\Request\CategoryUpdateRequest;
use App\Http\Controllers\Product\Relation\Category\Resource\CategoryIndexResource;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryCreateResourceCollection;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryEditResourceCollection;
use App\Http\Controllers\Product\Relation\Category\Service\CategoryService;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(public CategoryService $service, public Str $str)
    {
    }

    /**
     * @throws Exception
     */
    public function index(): CategoryIndexResource
    {
        return new CategoryIndexResource($this->service->index());
    }

    public function create(): AnonymousResourceCollection
    {
        return CategoryCreateResourceCollection::collection($this->service->create());
    }

    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $category = $this->service->store($request->title, $this->str::slug($request->title), $request->media, $request->category_id);

        return ResponseHandler::store(['id' => $category->id]);
    }

    public function edit(int $id): CategoryEditResourceCollection|JsonResponse
    {
        $category = $this->service->edit($id);

        return $category
            ? new CategoryEditResourceCollection($category)
            : ResponseHandler::notFound();
    }

    public function update(int $id, CategoryUpdateRequest $request): JsonResponse
    {
        $category = $this->service->update($id, $request->title, $this->str::slug($request->title), $request->media, $request->category_id);

        return $category
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::notFound();
    }

    public function destroy(int $id): JsonResponse
    {
        $category = $this->service->destroy($id);

        return $category
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }
}
