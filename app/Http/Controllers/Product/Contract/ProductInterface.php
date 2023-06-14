<?php

namespace App\Http\Controllers\Product\Contract;

use App\Http\Controllers\Product\Model\Product;

interface ProductInterface
{
    /**
     * @param string $slug
     * @return mixed
     */
    public function productBySlug(string $slug): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function productById($id): mixed;

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
     * @param $media
     * @return mixed
     */
    public function store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media): mixed;

    /**
     * @param $variants
     * @param $product
     * @return void
     */
    public function extractedProductInVariants($variants, $product): void;

    /**
     * @param Product $product
     * @param array $media
     * @return void
     */
    public function attachMedia(Product $product, array $media): void;

    /**
     * @param $product
     * @param $categoryId
     * @return void
     */
    public function attachCategories($product, $categoryId): void;

    /**
     * @param $product
     * @param string|null $sku
     * @param $stock
     * @param $price
     * @return void
     */
    public function extractedVariant($product, ?string $sku, $stock, $price): void;

    /**
     * @param $variant
     * @param $product
     * @return array
     */
    public function extractedAttributes($variant, $product): array;

    /**
     * @param $variants
     * @param $product
     * @param $categoryId
     * @return void
     */
    public function extracted($variants, $product, $categoryId): void;

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
     * @param $media
     * @return mixed
     */
    public function update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media): mixed;

    /**
     * @param mixed $product
     * @return void
     */
    public function destroyProductRelationalData(Product $product): void;

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;

    /**
     * @param Product $product
     * @return void
     */
    public function destroyMedia(Product $product): void;

    /**
     * @param array $columns
     * @return mixed
     */
    public function products(array $columns = []): mixed;
}
