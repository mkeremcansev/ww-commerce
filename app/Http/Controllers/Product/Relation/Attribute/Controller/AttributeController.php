<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Attribute\Request\AttributeStoreRequest;
use App\Http\Controllers\Product\Relation\Attribute\Request\AttributeUpdateRequest;
use App\Http\Controllers\Product\Relation\Attribute\Resource\AttributeIndexResource;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeEditResourceCollection;
use App\Http\Controllers\Product\Relation\Attribute\Service\AttributeService;
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
    public function index(): AttributeIndexResource
    {
        return new AttributeIndexResource($this->service->index());
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
}
