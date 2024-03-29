<?php

namespace App\Http\Struct\Product\Relation\Attribute\Controller;

use App\Http\Controller;
use App\Http\Struct\Product\Relation\Attribute\Request\AttributeIndexRequest;
use App\Http\Struct\Product\Relation\Attribute\Request\AttributeRestoreAndForceDeleteRequest;
use App\Http\Struct\Product\Relation\Attribute\Request\AttributeStoreRequest;
use App\Http\Struct\Product\Relation\Attribute\Request\AttributeUpdateRequest;
use App\Http\Struct\Product\Relation\Attribute\Resource\AttributeIndexResource;
use App\Http\Struct\Product\Relation\Attribute\ResourceCollection\AttributeEditResourceCollection;
use App\Http\Struct\Product\Relation\Attribute\Service\AttributeService;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Http\JsonResponse;

class AttributeController extends Controller
{
    public function __construct(public AttributeService $service)
    {
    }

    /**
     * @throws Exception
     */
    public function index(AttributeIndexRequest $request): AttributeIndexResource
    {
        return new AttributeIndexResource($this->service->index($request->trashed));
    }

    public function store(AttributeStoreRequest $request): JsonResponse
    {
        $attribute = $this->service->store($request->title);

        return ResponseHandler::store(['id' => $attribute->id]);
    }

    public function edit(int $id): AttributeEditResourceCollection|JsonResponse
    {
        $attribute = $this->service->edit($id);

        return $attribute
            ? new AttributeEditResourceCollection($attribute)
            : ResponseHandler::notFound();
    }

    public function update(int $id, AttributeUpdateRequest $request): JsonResponse
    {
        $attribute = $this->service->update($id, $request->title);

        return $attribute
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::notFound();
    }

    public function destroy(int $id): JsonResponse
    {
        $attribute = $this->service->destroy($id);

        return $attribute
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }

    public function restore(AttributeRestoreAndForceDeleteRequest $request): JsonResponse
    {
        return $this->service->restore($request->ids)
            ? ResponseHandler::restore()
            : ResponseHandler::recordNotFound();
    }

    public function forceDelete(AttributeRestoreAndForceDeleteRequest $request): JsonResponse
    {
        return $this->service->forceDelete($request->ids)
            ? ResponseHandler::forceDelete()
            : ResponseHandler::recordNotFound();
    }
}
