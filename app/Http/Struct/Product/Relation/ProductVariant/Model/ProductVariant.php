<?php

namespace App\Http\Struct\Product\Relation\ProductVariant\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sku',
        'stock',
        'price',
        'product_id',
    ];
}
