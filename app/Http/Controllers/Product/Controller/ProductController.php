<?php

namespace App\Http\Controllers\Product\Controller;

use App\Exceptions\ResponseHandler;
use App\Helpers\EnumerationHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Controllers\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeRelationResourceCollection;
use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Brand\ResourceCollection\BrandResourceCollection;
use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryCreateResourceCollection;
use App\Http\Controllers\Product\Request\ProductStoreRequest;
use App\Http\Controllers\Product\ResourceCollection\ProductResourceCollection;
use App\Http\Controllers\Product\Service\ProductService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * @param ProductService $service
     * @param Str $str
     */
    public function __construct(public ProductService $service, public Str $str)
    {
    }

    /**
     * @return array
     * @throws BindingResolutionException
     * @throws \ReflectionException
     */
    public function create(): array
    {
        return [
            'attribute_id' => AttributeRelationResourceCollection::collection(app()
                ->make(AttributeInterface::class)
                ->attributes()),
            'category_id' => CategoryCreateResourceCollection::collection(app()
                ->make(CategoryInterface::class)
                ->mainCategoriesWithParents(['id', 'title', 'slug', 'path'])),
            'brand_id' => BrandResourceCollection::collection(app()
                ->make(BrandInterface::class)
                ->brands()),
            'status' => EnumerationHelper::enumerationToArray(ProductStatusEnumeration::class)
        ];
    }

    /**
     * @param ProductStoreRequest $request
     * @return JsonResponse
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {
        $product = $this->service->store(
            $request->title,
            $this->str::slug($request->title),
            $request->price,
            $request->content,
            $request->category_id,
            $request->brand_id,
            $request->status,
            $request->variants
        );

        return ResponseHandler::store(['id' => $product->id]);
    }

    /**
     * @param string $slug
     * @return ProductResourceCollection|JsonResponse
     */
    public function show(string $slug): ProductResourceCollection|JsonResponse
    {
        $product = $this->service->productBySlug($slug);

        return $product
            ? new ProductResourceCollection($product)
            : ResponseHandler::notFound();
    }
}
