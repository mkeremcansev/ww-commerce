<?php

namespace App\Http\Struct\Media\Controller;

use App\Http\Controller;
use App\Http\Struct\Media\Request\MediaDestroyRequest;
use App\Http\Struct\Media\Request\MediaIndexRequest;
use App\Http\Struct\Media\Request\MediaStoreRequest;
use App\Http\Struct\Media\ResourceCollection\MediaResourceCollection;
use App\Http\Struct\Media\Service\MediaService;
use App\Response\ResponseHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MediaController extends Controller
{
    public function __construct(public MediaService $service)
    {
    }

    public function index(MediaIndexRequest $request): AnonymousResourceCollection
    {
        return MediaResourceCollection::collection($this->service->index($request->trashed));
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
