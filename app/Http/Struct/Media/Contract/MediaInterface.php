<?php

namespace App\Http\Struct\Media\Contract;

interface MediaInterface
{
    public function store($path, $extension, $mimeType, $size, $pathInfo): mixed;

    public function media(bool|null $trashed = false): mixed;

    public function mediaById($mediaId): mixed;

    public function destroy($mediaId): ?bool;
}
