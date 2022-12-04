<?php

namespace Database\Seeders;

use App\Http\Controllers\Brand\Enumeration\BrandDefaultPathEnumeration;
use App\Http\Controllers\Brand\Model\Brand;
use App\Http\Controllers\Product\Model\Product;
use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;
use App\Http\Controllers\Product\Relation\AttributeValue\Enumeration\AttributeValueDefaultPathEnumeration;
use App\Http\Controllers\Product\Relation\AttributeValue\Model\AttributeValue;
use App\Http\Controllers\Product\Relation\Category\Enumeration\CategoryDefaultPathEnumeration;
use App\Http\Controllers\Product\Relation\Category\Model\Category;
use App\Http\Controllers\Product\Relation\ProductAttribute\Model\ProductAttribute;
use App\Http\Controllers\Product\Relation\ProductCategory\Model\ProductCategory;
use App\Http\Controllers\Product\Relation\ProductImage\Enumeration\ProductImageDefaultPathEnumeration;
use App\Http\Controllers\Product\Relation\ProductImage\Model\ProductImage;
use App\Http\Controllers\Product\Relation\ProductVariant\Model\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductAllRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = Brand::create([
            'title' => 'Google Cloud',
            'slug' => Str::slug('Google Cloud'),
            'path' => BrandDefaultPathEnumeration::DEFAULT_PATH
        ]);
        $product = Product::create([
            'title' => 'Back-end System',
            'slug' => Str::slug('Back-end System'),
            'content' => 'Back-end system product.',
            'price' => 1999.99,
            'brand_id' => $brand->id
        ]);
        $category = Category::create([
            'title' => 'Web Development',
            'slug' => Str::slug('Web Development'),
            'path' => CategoryDefaultPathEnumeration::DEFAULT_PATH
        ]);

        ProductCategory::create([
            'product_id' => $product->id,
            'category_id' => $category->id
        ]);

        $attribute = Attribute::create([
            'title' => 'Time'
        ]);

        $attributeValue = AttributeValue::create([
            'title' => '1 Year',
            'code' => '1YEAR',
            'path' => AttributeValueDefaultPathEnumeration::DEFAULT_PATH,
            'attribute_id' => $attribute->id
        ]);

        ProductAttribute::create([
            'product_id' => $product->id,
            'attribute_id' => $attribute->id,
            'attribute_value_id' => $attributeValue->id
        ]);

        ProductImage::create([
            'path' => ProductImageDefaultPathEnumeration::DEFAULT_PATH,
            'product_id' => $product->id
        ]);

        ProductVariant::create([
            'title' => '1 Year',
            'sku' => '1-1YEAR',
            'stock' => 30,
            'price' => 19.99,
            'product_id' => $product->id
        ]);
    }
}
