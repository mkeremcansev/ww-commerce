<?php

namespace App\Http\Controllers\Product\Controller;

use App\Helpers\DatatableHelper;
use App\Helpers\EnumerationHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Controllers\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeRelationResourceCollection;
use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Brand\ResourceCollection\BrandResourceCollection;
use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Controllers\Product\Relation\Category\ResourceCollection\CategoryCreateResourceCollection;
use App\Http\Controllers\Product\Request\ProductIndexRequest;
use App\Http\Controllers\Product\Request\ProductStoreRequest;
use App\Http\Controllers\Product\Request\ProductUpdateRequest;
use App\Http\Controllers\Product\ResourceCollection\ProductEditResourceCollection;
use App\Http\Controllers\Product\ResourceCollection\ProductIndexResourceCollection;
use App\Http\Controllers\Product\ResourceCollection\ProductResourceCollection;
use App\Http\Controllers\Product\Service\ProductService;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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
     * @param ProductIndexRequest $request
     * @return AnonymousResourceCollection
     * @throws Exception
     */
    public function index(ProductIndexRequest $request): AnonymousResourceCollection
    {
        return ProductIndexResourceCollection::collection(
            DatatableHelper::datatable($request, $this->service->index())
        );
    }

    /**
     * @return array
     * @throws BindingResolutionException
     * @throws \ReflectionException
     */
    public function create(): array
    {
        return [
            'attribute_id' => AttributeRelationResourceCollection::collection(resolve(AttributeInterface::class)
                ->attributes([], ['values'])),
            'category_id' => CategoryCreateResourceCollection::collection(resolve(CategoryInterface::class)
                ->mainCategoriesWithParents(['id', 'title', 'slug', 'path'])),
            'brand_id' => BrandResourceCollection::collection(resolve(BrandInterface::class)
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

    /**
     * @param int $id
     * @return ProductEditResourceCollection|JsonResponse
     */
    public function edit(int $id): ProductEditResourceCollection|JsonResponse
    {
        $product = $this->service->edit($id);

        return $product
            ? new ProductEditResourceCollection($this->service->edit($id))
            : ResponseHandler::recordNotFound();
    }

    /**
     * @param int $id
     * @param ProductUpdateRequest $request
     * @return JsonResponse
     */
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
            $request->variants
        );

        return $product
            ? ResponseHandler::update(['id' => $product->id])
            : ResponseHandler::recordNotFound();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $product = $this->service->destroy($id);

        return $product
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }
}
