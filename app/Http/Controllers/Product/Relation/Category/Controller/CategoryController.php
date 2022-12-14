<?php

namespace App\Http\Controllers\Product\Relation\Category\Controller;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Category\Request\CategoryIndexRequest;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryResourceCollection;
use App\Http\Controllers\Product\Relation\Category\Service\CategoryService;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * @param CategoryService $service
     */
    public function __construct(public CategoryService $service)
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
}
