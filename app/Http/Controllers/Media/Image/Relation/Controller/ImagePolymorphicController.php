<?php

namespace App\Http\Controllers\Media\Image\Relation\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Media\Image\Relation\Service\ImagePolymorphicService;

class ImagePolymorphicController extends Controller
{
    /**
     * @param ImagePolymorphicService $service
     */
    public function __construct(public ImagePolymorphicService $service)
    {
    }
}
