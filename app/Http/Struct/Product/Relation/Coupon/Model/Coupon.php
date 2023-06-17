<?php

namespace App\Http\Struct\Product\Relation\Coupon\Model;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends BaseModel
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'type',
        'value',
        'usage_limit',
        'status',
        'expired_at',
        'created_at',
        'updated_at',
    ];
}
