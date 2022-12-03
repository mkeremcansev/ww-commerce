<?php

namespace App\Http\Controllers\Product\Relation\Category\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryResourceCollection;
use App\Http\Controllers\Product\Relation\Category\Service\CategoryService;

class CategoryController extends Controller
{
    /**
     * @param CategoryService $service
     */
    public function __construct(public CategoryService $service)
    {
    }

    public function index()
    {
        return CategoryResourceCollection::collection($this->service->index());
    }
}
