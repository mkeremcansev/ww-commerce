<?php

namespace App\Helpers;

use App\Http\Controllers\Media\Enumeration\MediaPathEnumeration;
use Intervention\Image\Facades\Image;

class FileHelper
{
    public static function upload($file): mixed
    {
        return Image::make($file)
            ->encode(setting('default_image_mime_type'), 100)
            ->save(
                public_path(
                    MediaPathEnumeration::MEDIA_PATH.pathinfo($file->getClientOriginalName(),
                        PATHINFO_FILENAME).date('d-m-Y-H-i-s').rand(1, 99999).'.'.setting('default_image_mime_type')
                )
            );
    }
}
