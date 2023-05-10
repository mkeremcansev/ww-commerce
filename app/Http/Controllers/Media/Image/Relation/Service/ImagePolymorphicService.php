<?php

namespace App\Http\Controllers\Media\Image\Relation\Service;

use App\Http\Controllers\Media\Image\Relation\Contract\ImagePolymorphicInterface;

class ImagePolymorphicService
{
    /**
     * @param ImagePolymorphicInterface $repository
     */
    public function __construct(public ImagePolymorphicInterface $repository)
    {
    }
}
