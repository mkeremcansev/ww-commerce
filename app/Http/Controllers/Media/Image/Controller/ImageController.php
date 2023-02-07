<?php

namespace App\Http\Controllers\Media\Image\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Media\Image\Request\ImageDestroyRequest;
use App\Http\Controllers\Media\Image\Request\ImageUploadRequest;
use App\Http\Controllers\Media\Image\Service\ImageService;
use App\Response\ResponseHandler;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    /**
     * @param ImageService $service
     */
    public function __construct(public ImageService $service)
    {
    }

    /**
     * @return array
     */
    public function index(): array
    {
        return $this->service->index();
    }

    /**
     * @param ImageUploadRequest $request
     * @return JsonResponse
     */
    public function upload(ImageUploadRequest $request): JsonResponse
    {
        $this->service->upload($request->file('files'));

        return ResponseHandler::success();
    }

    /**
     * @param ImageDestroyRequest $request
     * @return JsonResponse
     */
    public function destroy(ImageDestroyRequest $request): JsonResponse
    {
        foreach ($request->paths as $path) {
            $this->service->destroy($path);
        }
        return ResponseHandler::success();
    }
}
