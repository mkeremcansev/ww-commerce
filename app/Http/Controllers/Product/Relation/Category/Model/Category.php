<?php

namespace App\Http\Controllers\Product\Relation\Category\Model;

use App\Http\Controllers\Media\Relation\MediaPolymorphic\Trait\MediaPolymorphicTrait;
use App\Http\Controllers\Product\Relation\Category\Enumeration\CategoryDefaultPathEnumeration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, MediaPolymorphicTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
        'category_id'
    ];

    /**
     * @return HasMany
     */
    public function parents(): HasMany
    {
        return $this->hasMany(self::class)->with('parents');
    }

    /**
     * @return mixed
     */
    public function scopeMain(): mixed
    {
        return $this->where('category_id', null);
    }

    /**
     * @return mixed
     */
    public function scopeSub(): mixed
    {
        return $this->where('category_id', '!=', null);
    }
}
