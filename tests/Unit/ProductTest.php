<?php

namespace Tests\Unit;

use App\Http\Controllers\Product\Enumeration\ProductStatusEnumeration;
use App\Http\Controllers\Product\Model\Product;
use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->model = resolve(Product::class);
    }

    /**
     * @return void
     */
    public function test_can_index_product(): void
    {
        $this->assertInstanceOf(Collection::class, $this->post(route('product.index'))->getOriginalContent());
    }

    /**
     * @return void
     */
    public function test_can_create_product(): void
    {
        $this->assertEquals(200, $this->get(route('product.create'))->getStatusCode());
    }

    /**
     * @return void
     */
    public function test_can_store_product(): void
    {
        $product = $this->post(route('product.store'), [
            'title' => $this->faker->company,
            'price' => 1999.99,
            'content' => $this->faker->paragraph,
            'category_id' => resolve(CategoryInterface::class)->categories()->pluck('id')->toArray(),
            'brand_id' => resolve(BrandInterface::class)->brands()->first()->id,
            'status' => ProductStatusEnumeration::ACTIVE,
            'variants' => variantCombination()
        ])->assertStatus(200)->getOriginalContent();
        self::$id = $product['data']['id'];
    }

    /**
     * @return void
     */
    public function test_can_edit_product(): void
    {
        $this->get(route('product.edit', self::$id))->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_update_product(): void
    {
        $this->patch(route('product.update', self::$id), [
            'title' => $this->faker->company,
            'price' => 1999.99,
            'content' => $this->faker->paragraph,
            'category_id' => resolve(CategoryInterface::class)->categories()->pluck('id')->toArray(),
            'brand_id' => resolve(BrandInterface::class)->brands()->first()->id,
            'status' => ProductStatusEnumeration::ACTIVE,
            'variants' => variantCombination()
        ])->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_destroy_product(): void
    {
        $this->delete(route('product.destroy', self::$id))->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_force_product(): void
    {
        $this->assertTrue($this->model->find(self::$id)->forceDelete());
    }
}
