<?php

namespace App\Http\Struct\Product\Relation\ProductVariant\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
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
