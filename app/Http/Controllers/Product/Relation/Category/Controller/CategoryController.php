<?php

namespace App\Http\Controllers\Product\Relation\Category\Controller;

use App\Exceptions\ResponseHandler;
use App\Helpers\DatatableHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Category\Request\CategoryIndexRequest;
use App\Http\Controllers\Product\Relation\Category\Request\CategoryStoreRequest;
use App\Http\Controllers\Product\Relation\Category\Request\CategoryUpdateRequest;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryCreateResourceCollection;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryEditResourceCollection;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryResourceCollection;
use App\Http\Controllers\Product\Relation\Category\Service\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * @param CategoryService $service
     * @param Str $str
     */
    public function __construct(public CategoryService $service, public Str $str)
    {
    }

    /**
     * @param CategoryIndexRequest $request
     * @return AnonymousResourceCollection
     * @throws Exception
     */
    public function index(CategoryIndexRequest $request): AnonymousResourceCollection
    {
        return CategoryResourceCollection::collection(DatatableHelper::datatable($request, $this->service->index()));
    }

    /**
     * @return array
     */
    public function create(): array
    {
        return [
            'category_id' => CategoryCreateResourceCollection::collection($this->service->create())
        ];
    }

    /**
     * @param CategoryStoreRequest $request
     * @return JsonResponse
     */
    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $category = $this->service->store($request->title, $this->str::slug($request->title), $request->path, $request->category_id);

        return ResponseHandler::store(['id' => $category->id]);
    }

    /**
     * @param int $id
     * @return CategoryEditResourceCollection|JsonResponse
     */
    public function edit(int $id): CategoryEditResourceCollection|JsonResponse
    {
        $category = $this->service->edit($id);

        return $category
            ? new CategoryEditResourceCollection($category)
            : ResponseHandler::notFound();
    }

    /**
     * @param int $id
     * @param CategoryUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, CategoryUpdateRequest $request): JsonResponse
    {
        $category = $this->service->update($id, $request->title, $this->str::slug($request->title), $request->path, $request->category_id);

        return $category
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::notFound();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $category = $this->service->destroy($id);

        return $category
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }
}
