<?php

namespace Tests\Feature;

use App\Http\Struct\Media\Model\Media;
use App\Http\Struct\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Struct\Product\Model\Product;
use App\Http\Struct\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Struct\Product\Relation\Category\Contract\CategoryInterface;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->model = resolve(Product::class);
    }

    public function test_can_index_product(): void
    {
        $this->assertIsObject($this->post(route('product.index'), [])->getOriginalContent());
    }

    public function test_can_create_product(): void
    {
        $this->assertEquals(200, $this->get(route('product.create'))->getStatusCode());
    }

    public function test_can_store_product(): void
    {
        $product = $this->post(route('product.store'), [
            'title' => $this->faker->company,
            'price' => 1999.99,
            'content' => $this->faker->paragraph,
            'category_id' => resolve(CategoryInterface::class)->categories()->pluck('id')->toArray(),
            'brand_id' => resolve(BrandInterface::class)->brands()->first()->id,
            'status' => ProductStatusEnumeration::ACTIVE,
            'variants' => variantCombination(),
            'stock' => rand(0, 3),
            'media' => Media::limit(3)->get()->toArray(),
            'variant_status' => true,
        ])->assertStatus(200)->getOriginalContent();
        self::$id = $product['data']['id'];
    }

    public function test_can_edit_product(): void
    {
        $this->get(route('product.edit', self::$id))->assertStatus(200);
    }

    public function test_can_update_product(): void
    {
        $this->patch(route('product.update', self::$id), [
            'title' => $this->faker->company,
            'price' => 1999.99,
            'content' => $this->faker->paragraph,
            'category_id' => resolve(CategoryInterface::class)->categories()->pluck('id')->toArray(),
            'brand_id' => resolve(BrandInterface::class)->brands()->first()->id,
            'status' => ProductStatusEnumeration::ACTIVE,
            'variants' => variantCombination(),
            'stock' => rand(0, 3),
            'media' => Media::limit(3)->get()->toArray(),
            'variant_status' => true,
        ])->assertStatus(200);
    }

    public function test_can_destroy_product(): void
    {
        $this->delete(route('product.destroy', self::$id))->assertStatus(200);
    }

    public function test_can_force_product(): void
    {
        $this->assertTrue($this->model->onlyTrashed()->find(self::$id)->forceDelete());
    }
}
