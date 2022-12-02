<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Model;

use App\Http\Controllers\Product\Relation\AttributeValue\Model\AttributeValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
