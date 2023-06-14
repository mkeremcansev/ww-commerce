<?php

namespace App\Http\Controllers\Product\Repository;

use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\Model\Product;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductInterface
{
    public function __construct(public Product $model)
    {
    }

    public function productBySlug(string $slug): mixed
    {
        return $this->model
            ->active()
            ->with(['attributes' => ['values'], 'brand', 'categories'])
            ->whereSlug($slug)
            ->first();
    }

    public function productById($id): mixed
    {
        return $this->model
            ->with(['variants', 'categories'])
            ->whereId($id)
            ->first();
    }

    public function store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media): mixed
    {
        return DB::transaction(function () use ($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media) {
            $product = $this->model->create([
                'title' => $title,
                'slug' => $slug,
                'price' => $price,
                'content' => $content,
                'brand_id' => $brandId,
                'status' => $status,
                'stock' => $stock,
            ]);
            $this->attachMedia($product, $media);
            $this->extracted($variants, $product, $categoryId);

            return $product;
        });
    }

    /**
     * @throws BindingResolutionException
     */
    public function extractedProductInVariants($variants, $product): void
    {
        foreach ($variants as $variant) {
            [$sku, $stock, $price] = $this->extractedAttributes($variant, $product);
            $this->extractedVariant($product, $sku, $stock, $price);
        }
    }

    public function attachMedia(Product $product, array $media): void
    {
        foreach ($media as $mediaItem) {
            $product->addMediaFromId($mediaItem['id']);
        }
    }

    public function attachCategories($product, $categoryId): void
    {
        $product->categories()->attach($categoryId);
    }

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
                    ->attributeValueById($attribute['attribute_value_id'])->code.'-';
            $product->attributes()->attach($attribute['attribute_id'], ['attribute_value_id' => $attribute['attribute_value_id']]);
        }

        return [$sku, $stock, $price];
    }

    /**
     * @throws BindingResolutionException
     */
    public function extracted($variants, $product, $categoryId): void
    {
        $this->extractedProductInVariants($variants, $product);
        $this->attachCategories($product, $categoryId);
    }

    public function update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media): mixed
    {
        return DB::transaction(function () use ($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media) {
            $product = $this->productById($id);
            if ($product) {
                $product->update([
                    'title' => $title,
                    'slug' => $slug,
                    'price' => $price,
                    'content' => $content,
                    'brand_id' => $brandId,
                    'status' => $status,
                    'stock' => $stock,
                ]);
                $this->destroyProductRelationalData($product);
                $this->attachMedia($product, $media);
                $this->extracted($variants, $product, $categoryId);

                return $product;
            }

            return false;
        });
    }

    public function destroyProductRelationalData(Product $product): void
    {
        $product->categories()->detach();
        $product->attributes()->detach();
        $product->variants()->delete();
        $this->destroyMedia($product);
    }

    public function destroy($id): bool
    {
        $product = $this->productById($id);
        if ($product) {
            $this->destroyProductRelationalData($product);

            return $product->delete();
        }

        return false;
    }

    public function destroyMedia(Product $product): void
    {
        $product->destroyMedia();
    }

    public function products(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->get()
            );
    }
}
