<?php

namespace App\Http\Struct\Product\Controller;

use App\Helpers\EnumerationHelper;
use App\Http\Controller;
use App\Http\Struct\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Struct\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Struct\Product\Relation\Attribute\ResourceCollection\AttributeRelationResourceCollection;
use App\Http\Struct\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Struct\Product\Relation\Brand\ResourceCollection\BrandResourceCollection;
use App\Http\Struct\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Struct\Product\Relation\Category\ResourceCollection\CategoryCreateResourceCollection;
use App\Http\Struct\Product\Request\ProductStoreRequest;
use App\Http\Struct\Product\Request\ProductUpdateRequest;
use App\Http\Struct\Product\Resource\ProductIndexResource;
use App\Http\Struct\Product\ResourceCollection\ProductEditResourceCollection;
use App\Http\Struct\Product\ResourceCollection\ProductResourceCollection;
use App\Http\Struct\Product\Service\ProductService;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use ReflectionException;

class ProductController extends Controller
{
    public function __construct(public ProductService $service, public Str $str)
    {
    }

    /**
     * @throws Exception
     */
    public function index(): ProductIndexResource
    {
        return new ProductIndexResource($this->service->index());
    }

    /**
     * @throws BindingResolutionException
     * @throws ReflectionException
     */
    public function create(): array
    {
        return [
            'attribute_id' => AttributeRelationResourceCollection::collection(resolve(AttributeInterface::class)
                ->attributes([], ['values'])),
            'category_id' => CategoryCreateResourceCollection::collection(resolve(CategoryInterface::class)
                ->mainCategoriesWithParents(['id', 'title', 'slug'])),
            'brand_id' => BrandResourceCollection::collection(resolve(BrandInterface::class)
                ->brands()),
            'status' => EnumerationHelper::enumerationToArray(ProductStatusEnumeration::class),
        ];
    }

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
            $request->variants,
            $request->stock,
            $request->media
        );

        return ResponseHandler::store(['id' => $product->id]);
    }

    public function show(string $slug): ProductResourceCollection|JsonResponse
    {
        $product = $this->service->productBySlug($slug);

        return $product
            ? new ProductResourceCollection($product)
            : ResponseHandler::notFound();
    }

    public function edit(int $id): ProductEditResourceCollection|JsonResponse
    {
        $product = $this->service->edit($id);

        return $product
            ? new ProductEditResourceCollection($product)
            : ResponseHandler::recordNotFound();
    }

    public function update(int $id, ProductUpdateRequest $request): JsonResponse
    {
        $product = $this->service->update(
            $id,
            $request->title,
            $this->str::slug($request->title),
            $request->price,
            $request->content,
            $request->category_id,
            $request->brand_id,
            $request->status,
            $request->variants,
            $request->stock,
            $request->media
        );

        return $product
            ? ResponseHandler::update(['id' => $product->id])
            : ResponseHandler::recordNotFound();
    }

    public function destroy(int $id): JsonResponse
    {
        $product = $this->service->destroy($id);

        return $product
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }
}
