<?php

namespace App\Http\Controllers\Media\Repository;

use App\Http\Controllers\Media\Contract\MediaInterface;
use App\Http\Controllers\Media\Model\Media;

class MediaRepository implements MediaInterface
{
    /**
     * @param Media $model
     */
    public function __construct(public Media $model)
    {
    }

    /**
     * @param $path
     * @param $extension
     * @param $mimeType
     * @param $size
     * @param $pathInfo
     * @return mixed
     */
    public function store($path, $extension, $mimeType, $size, $pathInfo): mixed
    {
        return $this->model->create([
            'path' => $path,
            'extension' => $extension,
            'mime_type' => $mimeType,
            'size' => $size,
            'path_info' => $pathInfo,
        ]);
    }

    /**
     * @return mixed
     */
    public function media(): mixed
    {
        return $this->model
            ->get();
    }


    /**
     * @param $mediaId
     * @return mixed
     */
    public function mediaById($mediaId): mixed
    {
        return $this->model
            ->whereId($mediaId)
            ->first();
    }

    /**
     * @param $mediaId
     * @return bool|null
     */
    public function destroy($mediaId): ?bool
    {
        $media = $this->mediaById($mediaId);

        return $media && $media->delete();
    }
}
