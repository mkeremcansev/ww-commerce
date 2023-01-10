<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Controller;

use App\Helpers\DatatableHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\Relation\Attribute\Request\AttributeIndexRequest;
use App\Http\Controllers\Product\Relation\Attribute\Request\AttributeStoreRequest;
use App\Http\Controllers\Product\Relation\Attribute\Request\AttributeUpdateRequest;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeEditResourceCollection;
use App\Http\Controllers\Product\Relation\Attribute\ResourceCollection\AttributeResourceCollection;
use App\Http\Controllers\Product\Relation\Attribute\Service\AttributeService;
use App\Response\ResponseHandler;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AttributeController extends Controller
{
    /**
     * @param AttributeService $service
     */
    public function __construct(public AttributeService $service)
    {
    }

    /**
     * @param AttributeIndexRequest $request
     * @return AnonymousResourceCollection
     * @throws Exception
     */
    public function index(AttributeIndexRequest $request): AnonymousResourceCollection
    {
        return AttributeResourceCollection::collection(DatatableHelper::datatable($request, $this->service->index($request)));
    }

    /**
     * @param AttributeStoreRequest $request
     * @return JsonResponse
     */
    public function store(AttributeStoreRequest $request): JsonResponse
    {
        $attribute = $this->service->store($request->title);

        return ResponseHandler::store(['id' => $attribute->id]);
    }

    /**
     * @param int $id
     * @return AttributeEditResourceCollection|JsonResponse
     */
    public function edit(int $id): AttributeEditResourceCollection|JsonResponse
    {
        $attribute = $this->service->edit($id);

        return $attribute
            ? new AttributeEditResourceCollection($attribute)
            : ResponseHandler::notFound();
    }

    /**
     * @param int $id
     * @param AttributeUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, AttributeUpdateRequest $request): JsonResponse
    {
        $attribute = $this->service->update($id, $request->title);

        return $attribute
            ? ResponseHandler::update(['id' => $id])
            : ResponseHandler::notFound();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $attribute = $this->service->destroy($id);

        return $attribute
            ? ResponseHandler::destroy(['id' => $id])
            : ResponseHandler::recordNotFound();
    }
}
