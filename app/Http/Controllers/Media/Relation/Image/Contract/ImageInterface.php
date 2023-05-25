<?php

namespace App\Http\Controllers\Media\Relation\Image\Contract;

interface ImageInterface
{
    /**
     * @param $path
     * @param $extension
     * @param $mimeType
     * @param $size
     * @return mixed
     */
    public function store($path, $extension, $mimeType, $size): mixed;
}
