<?php

namespace App\Helpers;

class FileHelper
{
    public static function upload($file, $path): mixed
    {
        return $file->move(
            public_path($path),
            pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).date('d-m-Y-H-i-s').rand(1, 99999).'.'.$file->extension()
        );
    }
}
