<?php

namespace App\Http\Controllers\Product\Model;

use App\Http\Controllers\Brand\Model\Brand;
use App\Http\Controllers\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;
use App\Http\Controllers\Product\Relation\Category\Model\Category;
use App\Http\Controllers\Product\Relation\ProductAttribute\Model\ProductAttribute;
use App\Http\Controllers\Product\Relation\ProductCategory\Model\ProductCategory;
use App\Http\Controllers\Product\Relation\ProductImage\Model\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return BelongsToMany
     */
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, ProductAttribute::class)->distinct();
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,ProductCategory::class);
    }

    /**
     * @return mixed
     */
    public function scopeActive(): mixed
    {
        return $this->whereStatus(ProductStatusEnumeration::ACTIVE);
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
}
