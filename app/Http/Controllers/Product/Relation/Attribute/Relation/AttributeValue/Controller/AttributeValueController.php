<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Controller;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Request\AttributeValueIndexRequest;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Request\AttributeValueStoreRequest;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Request\AttributeValueUpdateRequest;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Resource\AttributeValueIndexResource;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\ResourceCollection\AttributeValueEditResourceCollection;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\ResourceCollection\AttributeValueResourceCollection;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Service\AttributeValueService;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeResourceCollection;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AttributeValueController extends Controller
{
    /**
     * @param AttributeValueService $service
     */
    public function __construct(public AttributeValueService $service)
    {
    }

    /**
     * @return AttributeValueIndexResource
     * @throws Exception
     */
    public function index(): AttributeValueIndexResource
    {
        return new AttributeValueIndexResource($this->service->index());
    }

    /**
     * @return AnonymousResourceCollection
     * @throws BindingResolutionException
     */
    public function create(): AnonymousResourceCollection
    {
        return AttributeResourceCollection::collection(resolve(AttributeInterface::class)
            ->attributes());
    }

    /**
     * @param AttributeValueStoreRequest $request
     * @return JsonResponse
     */
    public function store(AttributeValueStoreRequest $request): JsonResponse
    {
        $attributeValue = $this->service->store($request->title, $request->code, $request->path, $request->attribute_id);

        return ResponseHandler::store(['id' => $attributeValue->id]);
    }

    /**
     * @param int $id
     * @return JsonResponse|AttributeValueEditResourceCollection
     */
    public function edit(int $id): JsonResponse|AttributeValueEditResourceCollection
    {
        $attributeValue = $this->service->edit($id);

        return $attributeValue
            ? new AttributeValueEditResourceCollection($attributeValue)
            : ResponseHandler::notFound();
    }

    /**
     * @param int $id
     * @param AttributeValueUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, AttributeValueUpdateRequest $request): JsonResponse
    {
        $attributeValue = $this->service->update($id, $request->title, $request->code, $request->path, $request->attribute_id);

        return $attributeValue
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::notFound();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $attributeValue = $this->service->destroy($id);

        return $attributeValue
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::notFound();
    }
}
