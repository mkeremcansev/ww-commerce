<?php

namespace App\Http\Struct\Media\Model;

use App\Http\Struct\Media\Trait\MediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, SoftDeletes, MediaTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'path',
        'extension',
        'mime_type',
        'size',
        'path_info',
    ];
}
