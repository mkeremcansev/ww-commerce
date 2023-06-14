<?php

namespace Database\Seeders;

use App\Http\Controllers\Media\Model\Media;
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
        $this->firstOrCreate(
            'Microphone',
            'microphone',
            1999.99,
            'Microphone description',
            resolve(CategoryInterface::class)->categories()->pluck('id')->toArray(),
            resolve(BrandInterface::class)->brands()->first()->id,
            ProductStatusEnumeration::ACTIVE,
            variantCombination(),
            Media::limit(3)->get()->toArray()
        );
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
     * @param $media
     * @return void
     */
    public function firstOrCreate($title, $slug, $price, $content, $categoryId, $brandId, $status, $variants, $media): void
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
                $media
            );
        }
    }
}
