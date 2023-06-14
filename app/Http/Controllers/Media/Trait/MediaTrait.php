<?php

namespace App\Http\Controllers\Media\Trait;

trait MediaTrait
{
    public function getFullPath(): string
    {
        return asset($this->path_info.$this->path);
    }
}
