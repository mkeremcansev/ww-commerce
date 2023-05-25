<?php

namespace App\Http\Controllers\Media\Relation\Image\Service;

use App\Helpers\FileHelper;
use App\Http\Controllers\Media\Relation\Image\Enumeration\ImagePathEnumeration;
use Illuminate\Support\Facades\File;

class ImageService
{
    /**
     * @param FileHelper $fileHelper
     * @param File $file
     */
    public function __construct(public FileHelper $fileHelper, public File $file)
    {
    }

    /**
     * @return array
     */
    public function index(): array
    {
        return collect($this->file::allFiles(public_path(ImagePathEnumeration::IMAGE_PATH)))->map(function ($file) {
            return asset(ImagePathEnumeration::IMAGE_PATH . $file->getFilename());
        })->toArray();
    }

    /**
     * @param $files
     * @return void
     */
    public function upload($files): void
    {
        foreach ($files as $file) {
            $this->fileHelper::upload($file, ImagePathEnumeration::IMAGE_PATH);
        }
    }

    /**
     * @param $path
     * @return bool
     */
    public function destroy($path): bool
    {
        return $this->file::delete(public_path(ImagePathEnumeration::IMAGE_PATH) . $this->pathReplace($path));
    }

    /**
     * @param $path
     * @return array|string
     */
    public function pathReplace($path): array|string
    {
        return str_replace('/', '', str_replace(asset(ImagePathEnumeration::IMAGE_PATH), '', $path));
    }
}
