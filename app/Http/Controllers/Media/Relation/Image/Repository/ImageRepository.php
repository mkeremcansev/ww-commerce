<?php

namespace App\Http\Controllers\Media\Relation\Image\Repository;

use App\Http\Controllers\Media\Relation\Image\Contract\ImageInterface;
use App\Http\Controllers\Media\Relation\Image\Model\Image;

class ImageRepository implements ImageInterface
{
    /**
     * @param Image $model
     */
    public function __construct(public Image $model)
    {
    }

    /**
     * @param $path
     * @param $extension
     * @param $mimeType
     * @param $size
     * @return mixed
     */
    public function store($path, $extension, $mimeType, $size): mixed
    {
        return $this->model->create([
            'path' => $path,
            'extension' => $extension,
            'mime_type' => $mimeType,
            'size' => $size,
        ]);
    }
}
