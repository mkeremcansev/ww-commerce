<?php

namespace App\Http\Controllers\Product\Relation\Category\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return HasMany
     */
    public function parents(): HasMany
    {
        return $this->hasMany(self::class, 'category_id', 'id')->with('parents')->distinct();
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
