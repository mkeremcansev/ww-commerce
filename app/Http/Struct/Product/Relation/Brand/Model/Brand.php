<?php

namespace App\Http\Struct\Product\Relation\Brand\Model;

use App\Http\Struct\Media\Relation\MediaPolymorphic\Trait\MediaPolymorphicTrait;
use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends BaseModel
{
    use HasFactory, SoftDeletes, MediaPolymorphicTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
    ];
}
