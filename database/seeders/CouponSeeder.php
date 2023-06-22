<?php

namespace Database\Seeders;

use App\Http\Struct\Product\Relation\Coupon\Contract\CouponInterface;
use App\Http\Struct\Product\Relation\Coupon\Enumeration\CouponStatusEnumeration;
use App\Http\Struct\Product\Relation\Coupon\Enumeration\CouponTypeEnumeration;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->create(fake()->name, CouponTypeEnumeration::PERCENTAGE, rand(10, 100), rand(10, 20), CouponStatusEnumeration::PASSIVE, now()->addDays(30));
    }

    public function create($code, $type, $value, $usage_limit, $status, $expired_at)
    {
        return resolve(CouponInterface::class)
            ->store($code, $type, $value, $usage_limit, $status, $expired_at);
    }
}
