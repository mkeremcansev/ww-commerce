<?php

namespace App\Http\Controllers\Media\Service;

use App\Helpers\FileHelper;
use App\Http\Controllers\Media\Contract\MediaInterface;
use App\Http\Controllers\Media\Enumeration\MediaPathEnumeration;
use Illuminate\Support\Facades\File;

class MediaService
{
    public function __construct(
        public MediaInterface $repository,
        public FileHelper $fileHelper,
        public File $file,
    ) {
    }

    public function index(): mixed
    {
        return $this->repository->media();
    }

    public function store($files): bool
    {
        foreach ($files as $file) {
            $uploadedFile = $this->fileHelper::upload($file, MediaPathEnumeration::MEDIA_PATH);
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

    public function pathReplace($path): array|string
    {
        return str_replace('/', '', str_replace(asset(MediaPathEnumeration::MEDIA_PATH), '', $path));
    }
}
