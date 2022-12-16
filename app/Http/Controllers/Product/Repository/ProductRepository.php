<?php

namespace App\Http\Controllers\Product\Repository;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\Model\Product;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Contract\AttributeValueInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductInterface
{
    /**
     * @param Product $product
     */
    public function __construct(public Product $product)
    {
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function productBySlug(string $slug): mixed
    {
        return $this->product
            ->query()
            ->active()
            ->with(['attributes' => ['values'], 'brand', 'categories', 'images'])
            ->whereSlug($slug)
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
            $product = $this->product->create([
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
    public function extractedProductAndVariants($variants, $product): void
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
    public function getAttach($product, $categoryId): void
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
            'title' => GeneralHelper::skuTitleGenerator($product->title, $sku),
            'sku' => GeneralHelper::skuGenerator($product->id, $sku),
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
            $sku .= app()
                    ->make(AttributeValueInterface::class)
                    ->attributeValueById($attribute['attribute_value_id'])->code . '-';
            $product->attributes()->attach($attribute['attribute_id'], ['attribute_value_id' => $attribute['attribute_value_id']]);
        }
        return array($sku, $stock, $price);
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
        $this->extractedProductAndVariants($variants, $product);
        $this->getAttach($product, $categoryId);
    }
}
