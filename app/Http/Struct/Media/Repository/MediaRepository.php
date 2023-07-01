<?php

namespace App\Http\Struct\Media\Repository;

use App\Http\Struct\Media\Contract\MediaInterface;
use App\Http\Struct\Media\Model\Media;

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

    public function media(bool|null $trashed = false): mixed
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->get();
    }

    public function mediaById($mediaId, $trashed = false): mixed
    {
        return $this->model
            ->when($trashed, fn ($query) => $query->onlyTrashed())
            ->whereId($mediaId)
            ->first();
    }

    public function destroy($mediaId): ?bool
    {
        $media = $this->mediaById($mediaId);

        return $media?->delete();
    }

    public function restore($id): ?bool
    {
        $media = $this->mediaById($id, true);

        return $media?->restore();
    }

    public function forceDelete($id): ?bool
    {
        $media = $this->mediaById($id, true);

        return $media?->forceDelete();
    }
}
