<?php

namespace App\Http\Struct\Product\Relation\Category\Controller;

use App\Http\Controller;
use App\Http\Struct\Product\Relation\Category\Request\CategoryIndexRequest;
use App\Http\Struct\Product\Relation\Category\Request\CategoryRestoreAndForceDeleteRequest;
use App\Http\Struct\Product\Relation\Category\Request\CategoryStoreRequest;
use App\Http\Struct\Product\Relation\Category\Request\CategoryUpdateRequest;
use App\Http\Struct\Product\Relation\Category\Resource\CategoryCreateResource;
use App\Http\Struct\Product\Relation\Category\Resource\CategoryIndexResource;
use App\Http\Struct\Product\Relation\Category\ResourceCollection\CategoryEditResourceCollection;
use App\Http\Struct\Product\Relation\Category\Service\CategoryService;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(public CategoryService $service, public Str $str)
    {
    }

    /**
     * @throws Exception
     */
    public function index(CategoryIndexRequest $request): CategoryIndexResource
    {
        return new CategoryIndexResource($this->service->index($request->trashed));
    }

    public function create(): CategoryCreateResource
    {
        return new CategoryCreateResource($this->service->create());
    }

    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $category = $this->service->store(
            $request->title,
            $this->str::slug($request->title),
            $request->media,
            $request->category_id,
            $request->attribute_ids
        );

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
        $category = $this->service->update(
            $id,
            $request->title,
            $this->str::slug($request->title),
            $request->media,
            $request->category_id,
            $request->attribute_ids
        );

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

    public function restore(CategoryRestoreAndForceDeleteRequest $request): JsonResponse
    {
        $brands = $this->service->restore($request->ids);

        return $brands
            ? ResponseHandler::restore()
            : ResponseHandler::recordNotFound();
    }

    public function forceDelete(CategoryRestoreAndForceDeleteRequest $request): JsonResponse
    {
        $brands = $this->service->forceDelete($request->ids);

        return $brands
            ? ResponseHandler::forceDelete()
            : ResponseHandler::recordNotFound();
    }
}
