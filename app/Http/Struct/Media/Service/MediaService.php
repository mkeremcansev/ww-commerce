<?php

namespace App\Http\Struct\Media\Service;

use App\Helpers\FileHelper;
use App\Http\Struct\Media\Contract\MediaInterface;
use App\Http\Struct\Media\Enumeration\MediaPathEnumeration;
use Illuminate\Support\Facades\File;

class MediaService
{
    public function __construct(
        public MediaInterface $repository,
        public FileHelper $fileHelper,
        public File $file,
    ) {
    }

    public function index(bool|null $trashed = false): mixed
    {
        return $this->repository->media($trashed);
    }

    public function store($files): bool
    {
        foreach ($files as $file) {
            $uploadedFile = $this->fileHelper::upload($file);
            $this->repository->store(
                $uploadedFile->basename,
                $uploadedFile->extension,
                $uploadedFile->mime,
                $this->file::size(public_path(MediaPathEnumeration::MEDIA_PATH.$uploadedFile->basename)),
                MediaPathEnumeration::MEDIA_PATH
            );
        }

        return true;
    }

    public function destroy($media): ?bool
    {
        foreach ($media as $file) {
            $this->repository->destroy($file['id']);
        }

        return true;
    }

    public function restore(array $ids): bool
    {
        foreach ($ids as $id) {
            $this->repository->restore($id);
        }

        return true;
    }

    public function forceDelete(array $ids): bool
    {
        foreach ($ids as $id) {
            $this->repository->forceDelete($id);
        }

        return true;
    }
}
