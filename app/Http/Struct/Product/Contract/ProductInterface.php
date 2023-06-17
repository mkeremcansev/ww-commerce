<?php

namespace App\Http\Struct\Product\Contract;

use App\Http\Struct\Product\Model\Product;

interface ProductInterface
{
    public function productBySlug(string $slug): mixed;

    public function productById($id): mixed;

    public function store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media): mixed;

    public function attachMedia(Product $product, array $media): void;

    public function attachCategories(Product $product, $categoryId): void;

    public function attachAttributes($variant, Product $product): array;

    public function attachVariants(Product $product, $variants);

    public function update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media): mixed;

    public function destroy($id): bool;

    public function destroyMedia(Product $product): void;

    public function products(array $columns = []): mixed;
}
