<?php

namespace Database\Seeders;

use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
//        $this->firstOrCreate(
//            'Microphone',
//            'microphone',
//            1999.99,
//            'Microphone description',
//            resolve(CategoryInterface::class)->categories()->pluck('id')->toArray(),
//            resolve(BrandInterface::class)->brands()->first()->id,
//            ProductStatusEnumeration::ACTIVE,
//            variantCombination(),
//            [
//               [
//                   'id' => 1,
//               ]
//            ]
//        );
    }

    /**
     * @param $title
     * @param $slug
     * @param $price
     * @param $content
     * @param $categoryId
     * @param $brandId
     * @param $status
     * @param $variants
     * @param $images
     * @return void
     */
    public function firstOrCreate($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $images): void
    {
        if (!resolve(ProductInterface::class)->productBySlug($slug)) {
            resolve(ProductInterface::class)->store(
                $title,
                $slug,
                $price,
                $content,
                $categoryId,
                $brandId,
                $status,
                $variants,
                rand(0, 3),
                $images
            );
        }
    }
}
