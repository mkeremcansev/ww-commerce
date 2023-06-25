<?php

namespace App\Helpers;

use App\Http\Struct\Media\Enumeration\MediaPathEnumeration;
use Intervention\Image\Facades\Image;

class FileHelper
{
    public static function upload($file, $path = MediaPathEnumeration::MEDIA_PATH): mixed
    {
        return Image::make($file)
            ->encode(setting('default_image_mime_type'), 100)
            ->save(
                public_path(
                    $path.pathinfo($file->getClientOriginalName(),
                        PATHINFO_FILENAME).date('d-m-Y-H-i-s').rand(1, 99999).'.'.setting('default_image_mime_type')
                )
            );
    }
}
