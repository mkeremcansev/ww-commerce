<?php

namespace App\Http\Controllers\Media\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Media\Request\MediaDestroyRequest;
use App\Http\Controllers\Media\Request\MediaStoreRequest;
use App\Http\Controllers\Media\ResourceCollection\MediaResourceCollection;
use App\Http\Controllers\Media\Service\MediaService;
use App\Response\ResponseHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MediaController extends Controller
{
    /**
     * @param MediaService $service
     */
    public function __construct(public MediaService $service)
    {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return MediaResourceCollection::collection($this->service->index());
    }

    /**
     * @param MediaStoreRequest $request
     * @return JsonResponse
     */
    public function store(MediaStoreRequest $request): JsonResponse
    {
        $this->service->store($request->file('files'));

        return ResponseHandler::success();
    }
    /**
     * @param MediaDestroyRequest $request
     * @return JsonResponse
     */
    public function destroy(MediaDestroyRequest $request): JsonResponse
    {
        $this->service->destroy($request->media);

        return ResponseHandler::success();
    }
}
