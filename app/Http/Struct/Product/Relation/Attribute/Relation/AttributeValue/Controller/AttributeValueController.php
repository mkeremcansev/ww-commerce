<?php

namespace App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Controller;

use App\Http\Controller;
use App\Http\Struct\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Request\AttributeValueIndexRequest;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Request\AttributeValueRestoreAndForceDeleteRequest;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Request\AttributeValueStoreRequest;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Request\AttributeValueUpdateRequest;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Resource\AttributeValueIndexResource;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\ResourceCollection\AttributeValueEditResourceCollection;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Service\AttributeValueService;
use App\Http\Struct\Product\Relation\Attribute\ResourceCollection\AttributeResourceCollection;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AttributeValueController extends Controller
{
    public function __construct(public AttributeValueService $service)
    {
    }

    /**
     * @throws Exception
     */
    public function index(AttributeValueIndexRequest $request): AttributeValueIndexResource
    {
        return new AttributeValueIndexResource($this->service->index($request->trashed));
    }

    /**
     * @throws BindingResolutionException
     */
    public function create(): AnonymousResourceCollection
    {
        return AttributeResourceCollection::collection(resolve(AttributeInterface::class)
            ->attributes());
    }

    public function store(AttributeValueStoreRequest $request): JsonResponse
    {
        $attributeValue = $this->service->store($request->title, $request->code, $request->media, $request->attribute_id);

        return ResponseHandler::store(['id' => $attributeValue->id]);
    }

    public function edit(int $id): JsonResponse|AttributeValueEditResourceCollection
    {
        $attributeValue = $this->service->edit($id);

        return $attributeValue
            ? new AttributeValueEditResourceCollection($attributeValue)
            : ResponseHandler::notFound();
    }

    public function update(int $id, AttributeValueUpdateRequest $request): JsonResponse
    {
        $attributeValue = $this->service->update($id, $request->title, $request->code, $request->media, $request->attribute_id);

        return $attributeValue
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::notFound();
    }

    public function destroy(int $id): JsonResponse
    {
        $attributeValue = $this->service->destroy($id);

        return $attributeValue
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::notFound();
    }

    public function restore(AttributeValueRestoreAndForceDeleteRequest $request): JsonResponse
    {
        return $this->service->restore($request->ids)
            ? ResponseHandler::restore()
            : ResponseHandler::recordNotFound();
    }

    public function forceDelete(AttributeValueRestoreAndForceDeleteRequest $request): JsonResponse
    {
        return $this->service->forceDelete($request->ids)
            ? ResponseHandler::forceDelete()
            : ResponseHandler::recordNotFound();
    }
}
