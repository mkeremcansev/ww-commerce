<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Model;

use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;
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

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
