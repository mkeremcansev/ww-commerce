<?php

namespace App\Http\Controllers\Media\Image\Relation\Model;

use App\Http\Controllers\Media\Image\Model\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ImagePolymorphic extends Model
{
    use HasFactory;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'image_id',
        'model_type',
        'model_id'
    ];

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'id', 'image_id');
    }
}
