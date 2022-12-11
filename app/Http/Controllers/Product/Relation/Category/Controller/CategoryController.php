<?php

namespace App\Http\Controllers\Product\Relation\Category\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryResourceCollection;
use App\Http\Controllers\Product\Relation\Category\Service\CategoryService;
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
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResourceCollection::collection($this->service->index());
    }
}
