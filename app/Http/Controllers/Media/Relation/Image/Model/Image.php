<?php

namespace App\Http\Controllers\Media\Relation\Image\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'path',
        'extension',
        'mime_type',
        'size'
    ];
}
