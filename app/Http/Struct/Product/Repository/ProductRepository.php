<?php

namespace App\Http\Struct\Product\Repository;

use App\Http\Struct\Product\Contract\ProductInterface;
use App\Http\Struct\Product\Model\Product;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
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

    public function productById($id, $trashed = false): mixed
    {
        return $this->model
            ->with(['variants', 'categories'])
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->whereId($id)
            ->first();
    }

    public function store($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media, $variantStatus): mixed
    {
        return DB::transaction(function () use ($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media, $variantStatus) {
            $product = $this->model->create([
                'title' => $title,
                'slug' => $slug,
                'price' => $price,
                'content' => $content,
                'brand_id' => $brandId,
                'status' => $status,
                'stock' => $stock,
                'variant_status' => $variantStatus,
            ]);
            $this->attachMedia($product, $media);
            $this->attachCategories($product, $categoryId);
            $variantStatus && $this->attachVariants($product, $variants);

            return $product;
        });
    }

    public function attachMedia(Product $product, array $media): void
    {
        foreach ($media as $mediaItem) {
            $product->addMediaFromId($mediaItem['id']);
        }
    }

    public function attachCategories(Product $product, $categoryId): void
    {
        $product->categories()->attach($categoryId);
    }

    /**
     * @throws BindingResolutionException
     */
    public function attachAttributes($variant, Product $product): array
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
    public function attachVariants(Product $product, $variants)
    {
        foreach ($variants as $variant) {
            [$sku, $stock, $price] = $this->attachAttributes($variant, $product);
            $product->variants()->create([
                'title' => skuTitleGenerator($product->title, $sku),
                'sku' => skuGenerator($product->id, $sku),
                'stock' => $stock,
                'price' => $price,
            ]);
        }
    }

    public function update($id, $title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $stock, $media, $variantStatus): mixed
    {

        return DB::transaction(function () use ($id, $title, $slug, $price, $categoryId, $content, $brandId, $status, $variants, $stock, $media, $variantStatus) {
            $product = $this->productById($id);
            if ($product) {
                $product->touch();
                $product->update([
                    'title' => $title,
                    'slug' => $slug,
                    'price' => $price,
                    'content' => $content,
                    'brand_id' => $brandId,
                    'status' => $status,
                    'stock' => $stock,
                    'variant_status' => $variantStatus,
                ]);
                $this->attachCategories($product, $categoryId);
                $this->attachMedia($product, $media);
                $variantStatus && $this->attachVariants($product, $variants);

                return $product;
            }

            return false;
        });
    }

    public function destroy($id): bool
    {
        $product = $this->productById($id);

        return $product?->delete();
    }

    public function destroyMedia(Product $product): void
    {
        $product->destroyMedia();
    }

    public function products(array $columns = [], bool|null $trashed = false): mixed
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->get()
            );
    }

    public function restore($id): ?bool
    {
        $product = $this->productById($id, true);

        return $product?->restore();
    }

    public function forceDelete($id): ?bool
    {
        $product = $this->productById($id, true);

        return $product?->forceDelete();
    }
}
