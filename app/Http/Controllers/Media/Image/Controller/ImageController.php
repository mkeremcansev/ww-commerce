<?php

namespace App\Http\Controllers\Media\Image\Controller;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Media\Image\Enumeration\ImagePathEnumeration;
use App\Http\Controllers\Media\Image\Request\ImageUploadRequest;
use App\Response\ResponseHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /**
     * @param File $file
     * @param FileHelper $fileHelper
     */
    public function __construct(public File $file, public FileHelper $fileHelper)
    {
    }

    /**
     * @param ImageUploadRequest $request
     * @return JsonResponse
     */
    public function upload(ImageUploadRequest $request): JsonResponse
    {
        foreach ($request->file('files') as $file) {
            $this->fileHelper::upload($file, ImagePathEnumeration::IMAGE_PATH);
        }

        return ResponseHandler::success();
    }
}
