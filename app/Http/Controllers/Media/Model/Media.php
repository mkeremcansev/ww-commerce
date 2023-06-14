<?php

namespace App\Http\Controllers\Media\Model;

use App\Http\Controllers\Media\Trait\MediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, SoftDeletes, MediaTrait;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'path',
        'extension',
        'mime_type',
        'size',
        'path_info',
    ];
}
