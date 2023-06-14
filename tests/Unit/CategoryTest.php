<?php

namespace Tests\Unit;

use App\Http\Controllers\Media\Model\Media;
use App\Http\Controllers\Product\Relation\Category\Model\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->model = resolve(Category::class);
    }

    public function test_can_index_category(): void
    {
        $this->assertIsObject($this->post(route('category.index'), [])->getOriginalContent());
    }

    public function test_can_create_category(): void
    {
        $this->assertEquals(200, $this->get(route('category.create'))->getStatusCode());
    }

    public function test_can_store_category(): void
    {
        $category = $this->post(route('category.store'), [
            'title' => $this->faker->name,
            'media' => Media::first()->toArray(),
        ])->assertStatus(200)->getOriginalContent();
        self::$id = $category['data']['id'];
    }

    public function test_can_edit_category(): void
    {
        $this->get(route('category.edit', self::$id))->assertStatus(200);
    }

    public function test_can_update_category(): void
    {
        $this->patch(route('category.update', self::$id), [
            'title' => $this->faker->name,
            'media' => Media::first()->toArray(),
        ])->assertStatus(200);
    }

    public function test_can_destroy_category(): void
    {
        $this->delete(route('category.destroy', self::$id))->assertStatus(200);
    }

    public function test_can_force_category(): void
    {
        $this->assertTrue($this->model->find(self::$id)->forceDelete());
    }
}
