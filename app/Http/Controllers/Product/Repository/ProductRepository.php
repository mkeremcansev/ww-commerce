<?php

namespace App\Http\Controllers\Product\Repository;

use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\Model\Product;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductInterface
{
    /**
     * @param Product $model
     */
    public function __construct(public Product $model)
    {
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function productBySlug(string $slug): mixed
    {
        return $this->model
            ->active()
            ->with(['attributes' => ['values'], 'brand', 'categories', 'images'])
            ->whereSlug($slug)
            ->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function productById($id): mixed
    {
        return $this->model
            ->with('variants')
            ->whereId($id)
            ->first();
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
        return DB::transaction(function () use ($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants) {
            $product = $this->model->create([
                'title' => $title,
                'slug' => $slug,
                'price' => $price,
                'content' => $content,
                'brand_id' => $brandId,
                'status' => $status,
            ]);
            $this->extracted($variants, $product, $categoryId);

            return $product;
        });
    }

    /**
     * @param $variants
     * @param $product
     * @return void
     * @throws BindingResolutionException
     */
    public function extractedProductInVariants($variants, $product): void
    {
        foreach ($variants as $variant) {
            list($sku, $stock, $price) = $this->extractedAttributes($variant, $product);
            $this->extractedVariant($product, $sku, $stock, $price);
        }
    }

    /**
     * @param $product
     * @param $categoryId
     * @return void
     */
    public function attachCategories($product, $categoryId): void
    {
        $product->categories()->attach($categoryId);
    }

    /**
     * @param $product
     * @param string|null $sku
     * @param $stock
     * @param $price
     * @return void
     */
    public function extractedVariant($product, ?string $sku, $stock, $price): void
    {
        $product->variants()->create([
            'title' => skuTitleGenerator($product->title, $sku),
            'sku' => skuGenerator($product->id, $sku),
            'stock' => $stock,
            'price' => $price,
        ]);
    }

    /**
     * @param $variant
     * @param $product
     * @return array
     * @throws BindingResolutionException
     */
    public function extractedAttributes($variant, $product): array
    {
        $sku = null;
        $stock = null;
        $price = null;
        foreach ($variant['attributes'] as $attribute) {
            $stock = $variant['stock'];
            $price = $variant['price'];
            $sku .= resolve(AttributeValueInterface::class)
                    ->attributeValueById($attribute['attribute_value_id'])->code . '-';
            $product->attributes()->attach($attribute['attribute_id'], ['attribute_value_id' => $attribute['attribute_value_id']]);
        }

        return [$sku, $stock, $price];
    }

    /**
     * @param $variants
     * @param $product
     * @param $categoryId
     * @return void
     * @throws BindingResolutionException
     */
    public function extracted($variants, $product, $categoryId): void
    {
        $this->extractedProductInVariants($variants, $product);
        $this->attachCategories($product, $categoryId);
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
        return DB::transaction(function () use ($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants) {
            $product = $this->productById($id);
            if ($product) {
                $product->update([
                    'title' => $title,
                    'slug' => $slug,
                    'price' => $price,
                    'content' => $content,
                    'brand_id' => $brandId,
                    'status' => $status,
                ]);
                $this->destroyProductRelationalData($product);
                $this->extracted($variants, $product, $categoryId);

                return $product;
            }

            return false;
        });
    }

    /**
     * @param mixed $product
     * @return void
     */
    public function destroyProductRelationalData(mixed $product): void
    {
        $product->categories()->detach();
        $product->attributes()->detach();
        $product->variants()->delete();
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        $product = $this->productById($id);
        if ($product) {
            $this->destroyProductRelationalData($product);
            $this->destroyProductImages($product);

            return $product->delete();
        }

        return false;
    }

    /**
     * @param $product
     * @return void
     */
    public function destroyProductImages($product): void
    {
        $product->images()->delete();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function products(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn($eloquent) => $eloquent->select($columns),
                fn($eloquent) => $eloquent->get()
            );
    }
}
