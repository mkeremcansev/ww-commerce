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
    public function __construct(public MediaService $service)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return MediaResourceCollection::collection($this->service->index());
    }

    public function store(MediaStoreRequest $request): JsonResponse
    {
        $this->service->store($request->file('files'));

        return ResponseHandler::success();
    }

    public function destroy(MediaDestroyRequest $request): JsonResponse
    {
        $this->service->destroy($request->media);

        return ResponseHandler::success();
    }
}
