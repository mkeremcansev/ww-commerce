<?php

namespace App\Http\Controllers\Media\Image\Relation\Repository;

use App\Http\Controllers\Media\Image\Relation\Contract\ImagePolymorphicInterface;
use App\Http\Controllers\Media\Image\Relation\Model\ImagePolymorphic;

class ImagePolymorphicRepository implements ImagePolymorphicInterface
{
    /**
     * @param ImagePolymorphic $model
     */
    public function __construct(public ImagePolymorphic $model)
    {
    }
}
