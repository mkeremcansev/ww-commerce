<?php

namespace App\Http\Struct\Media\Trait;

trait MediaTrait
{
    public function getFullPath(): string
    {
        return asset($this->path_info.$this->path);
    }
}
