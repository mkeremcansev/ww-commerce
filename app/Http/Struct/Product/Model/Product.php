<?php

namespace App\Http\Struct\Product\Model;

use App\Http\Struct\Media\Relation\MediaPolymorphic\Trait\MediaPolymorphicTrait;
use App\Http\Struct\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Struct\Product\Relation\Attribute\Model\Attribute;
use App\Http\Struct\Product\Relation\Brand\Model\Brand;
use App\Http\Struct\Product\Relation\Category\Model\Category;
use App\Http\Struct\Product\Relation\ProductAttribute\Model\ProductAttribute;
use App\Http\Struct\Product\Relation\ProductCategory\Model\ProductCategory;
use App\Http\Struct\Product\Relation\ProductVariant\Model\ProductVariant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, MediaPolymorphicTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
        'price',
        'stock',
        'content',
        'status',
        'brand_id',
    ];

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, ProductAttribute::class)->withTimestamps()->distinct();
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, ProductCategory::class)->withTimestamps();
    }

    public function scopeActive(): mixed
    {
        return $this->whereStatus(ProductStatusEnumeration::ACTIVE);
    }
}
