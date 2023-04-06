<?php

namespace App\Http\Controllers\Product\Service;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Product\Contract\ProductInterface;
use Exception;

class ProductService
{
    /**
     * @param ProductInterface $repository
     */
    public function __construct(public ProductInterface $repository)
    {
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function index(): mixed
    {
        return DatatableHelper::datatable($this->repository->products(['id', 'title', 'price', 'slug']));
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
     * @param $stock
     * @param $images
     * @return mixed
     */
    public function store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $images): mixed
    {
        return $this->repository->store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $images);
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
     * @param $stock
     * @param $images
     * @return mixed
     */
    public function update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $images): mixed
    {
        return $this->repository->update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $images);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        return $this->repository->destroy($id);
    }
}
