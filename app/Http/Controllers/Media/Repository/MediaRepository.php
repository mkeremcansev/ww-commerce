<?php

namespace App\Http\Controllers\Media\Repository;

use App\Http\Controllers\Media\Contract\MediaInterface;
use App\Http\Controllers\Media\Model\Media;

class MediaRepository implements MediaInterface
{
    public function __construct(public Media $model)
    {
    }

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

    public function media(): mixed
    {
        return $this->model
            ->get();
    }

    public function mediaById($mediaId): mixed
    {
        return $this->model
            ->whereId($mediaId)
            ->first();
    }

    public function destroy($mediaId): ?bool
    {
        $media = $this->mediaById($mediaId);

        return $media && $media->delete();
    }
}
