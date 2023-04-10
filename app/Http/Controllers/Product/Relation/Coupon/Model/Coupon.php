<?php

namespace App\Http\Controllers\Product\Relation\Coupon\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'code',
        'type',
        'value',
        'usage_limit',
        'status',
        'expired_at',
        'created_at',
        'updated_at'
    ];
}
