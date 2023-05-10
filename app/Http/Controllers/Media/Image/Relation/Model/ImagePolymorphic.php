<?php

namespace App\Http\Controllers\Media\Image\Relation\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePolymorphic extends Model
{
    use HasFactory;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'image_id',
        'model_type',
        'model_id'
    ];
}
