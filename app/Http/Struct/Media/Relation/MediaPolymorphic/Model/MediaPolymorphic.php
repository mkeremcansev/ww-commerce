<?php

namespace App\Http\Struct\Media\Relation\MediaPolymorphic\Model;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaPolymorphic extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'media_id',
        'model_type',
        'model_id',
    ];
}
