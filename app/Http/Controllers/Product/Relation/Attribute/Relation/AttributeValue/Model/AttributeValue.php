<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeValue extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'code',
        'path',
        'attribute_id'
    ];
}
