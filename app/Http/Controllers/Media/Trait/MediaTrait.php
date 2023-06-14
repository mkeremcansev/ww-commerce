<?php

namespace App\Http\Controllers\Media\Trait;

trait MediaTrait
{
    /**
     * @return string
     */
    public function getFullPath(): string
    {
        return asset($this->path_info . $this->path);
    }
}
