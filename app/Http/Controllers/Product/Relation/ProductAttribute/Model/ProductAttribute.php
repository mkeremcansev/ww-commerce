<?php

namespace App\Http\Controllers\Product\Relation\ProductAttribute\Model;

use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;
use App\Http\Controllers\Product\Relation\AttributeValue\Model\AttributeValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * First attribute
     * @return HasOne
     */
    public function attribute(): HasOne
    {
        return $this->hasOne(Attribute::class, 'id', 'attribute_id');
    }

    /**
     * First value
     * @return HasOne
     */
    public function value(): HasOne
    {
        return $this->hasOne(AttributeValue::class, 'id', 'attribute_value_id');
    }
}
