<?php

namespace App\Traits;

use App\Http\Controllers\Media\Image\Relation\Contract\ImagePolymorphicInterface;

trait MediaImageTrait
{
    /**
     * @return mixed
     */
    public function images(): mixed
    {
        return resolve(ImagePolymorphicInterface::class)
            ->images(self::class, $this->id)
            ->map(function ($imagePolymorhpic) {
                return $imagePolymorhpic->images;
            })->flatten();
    }
}
