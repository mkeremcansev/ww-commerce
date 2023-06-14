<?php

namespace App\Http\Controllers\Product\Relation\Brand\Model;

use App\Http\Controllers\Media\Relation\MediaPolymorphic\Trait\MediaPolymorphicTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes, MediaPolymorphicTrait;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'title',
        'slug',
    ];
}
