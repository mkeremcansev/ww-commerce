<?php

namespace App\Http\Controllers\Product\Contract;

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
     * @return mixed
     */
    public function store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants): mixed;

    /**
     * @param $variants
     * @param $product
     * @return void
     */
    public function extractedProductInVariants($variants, $product): void;

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
     * @return mixed
     */
    public function update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants): mixed;

    /**
     * @param mixed $product
     * @return void
     */
    public function destroyProductRelationalData(mixed $product): void;

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;

    /**
     * @param $product
     * @return void
     */
    public function destroyProductImages($product): void;
}
