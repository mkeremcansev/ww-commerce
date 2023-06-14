<?php

namespace App\Http\Controllers\Product\Contract;

use App\Http\Controllers\Product\Model\Product;

interface ProductInterface
{
    public function productBySlug(string $slug): mixed;

    public function productById($id): mixed;

    public function store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media): mixed;

    public function extractedProductInVariants($variants, $product): void;

    public function attachMedia(Product $product, array $media): void;

    public function attachCategories($product, $categoryId): void;

    public function extractedVariant($product, ?string $sku, $stock, $price): void;

    public function extractedAttributes($variant, $product): array;

    public function extracted($variants, $product, $categoryId): void;

    public function update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media): mixed;

    /**
     * @param  mixed  $product
     */
    public function destroyProductRelationalData(Product $product): void;

    public function destroy($id): bool;

    public function destroyMedia(Product $product): void;

    public function products(array $columns = []): mixed;
}
