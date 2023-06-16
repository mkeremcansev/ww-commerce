<?php

namespace App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Model;

use App\Http\Struct\Media\Relation\MediaPolymorphic\Trait\MediaPolymorphicTrait;
use App\Http\Struct\Product\Relation\Attribute\Model\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeValue extends Model
{
    use HasFactory, SoftDeletes, MediaPolymorphicTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'code',
        'attribute_id',
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
