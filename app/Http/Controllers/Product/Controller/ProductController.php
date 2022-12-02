<?php

namespace App\Http\Controllers\Product\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Service\ProductService;

class ProductController extends Controller
{
    /**
     * @param ProductService $service
     */
    public function __construct(public ProductService $service)
    {
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function show(string $slug): mixed
    {
        return $this->service->productBySlug($slug);
    }
}
