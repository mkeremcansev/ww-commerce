<?php

namespace Tests\Unit;

use App\Http\Controllers\Product\Relation\Category\Model\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->model = resolve(Category::class);
    }

    /**
     * @return void
     */
    public function test_can_index_category(): void
    {
        $this->assertInstanceOf(Collection::class, $this->post(route('category.index'))->getOriginalContent());
    }

    /**
     * @return void
     */
    public function test_can_create_category(): void
    {
        $this->assertEquals(200, $this->get(route('category.create'))->getStatusCode());
    }

    /**
     * @return void
     */
    public function test_can_store_category(): void
    {
        $category = $this->post(route('category.store'), [
            'title' => $this->faker->name,
            'path' => $this->faker->imageUrl(),
        ])->assertStatus(200)->getOriginalContent();
        self::$id = $category['data']['id'];
    }

    /**
     * @return void
     */
    public function test_can_edit_category(): void
    {
        $this->get(route('category.edit', self::$id))->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_update_category(): void
    {
        $this->patch(route('category.update', self::$id), [
            'title' => $this->faker->name,
            'path' => $this->faker->imageUrl(),
        ])->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_destroy_category(): void
    {
        $this->delete(route('category.destroy', self::$id))->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_force_brand(): void
    {
        $this->assertTrue($this->model->find(self::$id)->forceDelete());
    }
}
