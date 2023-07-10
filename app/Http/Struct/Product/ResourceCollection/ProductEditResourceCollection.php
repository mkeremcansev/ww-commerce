<?php

namespace App\Http\Struct\Product\ResourceCollection;

use App\Helpers\EnumerationHelper;
use App\Http\Struct\Media\ResourceCollection\MediaResourceCollection;
use App\Http\Struct\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Struct\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Struct\Product\Relation\Attribute\ResourceCollection\AttributeRelationResourceCollection;
use App\Http\Struct\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Struct\Product\Relation\Brand\ResourceCollection\BrandResourceCollection;
use App\Http\Struct\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Struct\Product\Relation\Category\ResourceCollection\CategoryCreateResourceCollection;
use App\Http\Struct\Product\Relation\ProductCategory\ResourceCollection\ProductCategoryResourceCollection;
use App\Http\Struct\Product\Relation\ProductVariant\ResourceCollection\ProductVariantRelationResourceCollection;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\JsonResource;
use ReflectionException;

class ProductEditResourceCollection extends JsonResource
{
    /**
     * @throws BindingResolutionException
     * @throws ReflectionException
     */
    public function toArray($request): array
    {
        self::withoutWrapping();

        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'content' => $this->content ?? null,
            'price' => $this->price ?? null,
            'brand' => $this->brand->id ?? null,
            'status' => $this->status ?? null,
            'variant_status' => $this->variant_status ?? null,
            'variant_groups' => ProductVariantRelationResourceCollection::collection($this->variants ?? null),
            'categories' => ProductCategoryResourceCollection::collection($this->categories ?? null),
            'media' => MediaResourceCollection::collection($this->getMedia() ?? null),
            'attribute_id' => AttributeRelationResourceCollection::collection(resolve(AttributeInterface::class)
                ->attributes([], ['values'])),
            'category_id' => CategoryCreateResourceCollection::collection(resolve(CategoryInterface::class)
                ->mainCategoriesWithParents(['id', 'title', 'slug'])),
            'brand_id' => BrandResourceCollection::collection(resolve(BrandInterface::class)
                ->brands()),
            'status_type' => EnumerationHelper::enumerationToArray(ProductStatusEnumeration::class),
        ];
    }
}
