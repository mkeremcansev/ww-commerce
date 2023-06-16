<?php

namespace App\Http\Struct\Media\Relation\MediaPolymorphic\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaPolymorphic extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'media_id',
        'model_type',
        'model_id',
    ];
}
