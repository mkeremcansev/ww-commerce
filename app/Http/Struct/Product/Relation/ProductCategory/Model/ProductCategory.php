<?php

namespace App\Http\Struct\Product\Relation\ProductCategory\Model;

use App\Http\Struct\Product\Model\Product;
use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'category_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
