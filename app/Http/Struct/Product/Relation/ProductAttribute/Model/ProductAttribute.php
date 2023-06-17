<?php

namespace App\Http\Struct\Product\Relation\ProductAttribute\Model;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends BaseModel
{
    use HasFactory, SoftDeletes;
}
