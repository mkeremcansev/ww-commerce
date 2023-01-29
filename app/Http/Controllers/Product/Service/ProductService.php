<?php

namespace App\Http\Controllers\Product\Service;

use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\ResourceCollection\ProductResourceCollection;

class ProductService
{
    /**
     * @param ProductInterface $repository
     */
    public function __construct(public ProductInterface $repository)
    {
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function productBySlug(string $slug): mixed
    {
        return $this->repository->productBySlug($slug);
    }

    /**
     * @param $title
     * @param $slug
     * @param $price
     * @param $content
     * @param $categoryId
     * @param $brandId
     * @param $status
     * @param $variants
     * @return mixed
     */
    public function store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants): mixed
    {
        return $this->repository->store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id): mixed
    {
        return $this->repository->productById($id);
    }

    /**
     * @param $id
     * @param $title
     * @param $slug
     * @param $price
     * @param $content
     * @param $categoryId
     * @param $brandId
     * @param $status
     * @param $variants
     * @return mixed
     */
    public function update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants): mixed
    {
        return $this->repository->update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants);
    }
}
