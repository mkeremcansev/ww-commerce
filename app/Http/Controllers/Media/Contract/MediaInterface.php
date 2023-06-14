<?php

namespace App\Http\Controllers\Media\Contract;

interface MediaInterface
{
    /**
     * @param $path
     * @param $extension
     * @param $mimeType
     * @param $size
     * @param $pathInfo
     * @return mixed
     */
    public function store($path, $extension, $mimeType, $size, $pathInfo): mixed;

    /**
     * @return mixed
     */
    public function media(): mixed;

    /**
     * @param $mediaId
     * @return mixed
     */
    public function mediaById($mediaId): mixed;

    /**
     * @param $mediaId
     * @return bool|null
     */
    public function destroy($mediaId): ?bool;
}
