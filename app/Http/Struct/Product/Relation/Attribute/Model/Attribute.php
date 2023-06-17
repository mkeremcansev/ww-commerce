<?php

namespace App\Http\Struct\Product\Relation\Attribute\Model;

use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Model\AttributeValue;
use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }
}
