<?php

namespace App\Http\Struct\Media\Model;

use App\Http\Struct\Media\Relation\MediaPolymorphic\Model\MediaPolymorphic;
use App\Http\Struct\Media\Trait\MediaTrait;
use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends BaseModel
{
    use HasFactory, SoftDeletes, MediaTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'path',
        'extension',
        'mime_type',
        'size',
        'path_info',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(MediaPolymorphic::class);
    }
}
