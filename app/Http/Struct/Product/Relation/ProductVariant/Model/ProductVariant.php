<?php

namespace App\Http\Struct\Product\Relation\ProductVariant\Model;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'sku',
        'stock',
        'price',
        'product_id',
    ];
}
