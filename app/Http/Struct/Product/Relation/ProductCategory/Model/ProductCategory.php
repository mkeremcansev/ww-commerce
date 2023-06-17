<?php

namespace App\Http\Struct\Product\Relation\ProductCategory\Model;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends BaseModel
{
    use HasFactory, SoftDeletes;
}
