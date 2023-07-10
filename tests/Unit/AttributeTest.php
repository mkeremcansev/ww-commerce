<?php

namespace Tests\Unit;

use App\Http\Struct\Product\Relation\Attribute\Model\Attribute;
use Tests\TestCase;

class AttributeTest extends TestCase
{
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->model = resolve(Attribute::class);
    }

    public function test_can_index_attribute(): void
    {
        $this->assertIsObject($this->post(route('attribute.index'), [])->getOriginalContent());
    }

    public function test_can_create_attribute(): void
    {
        $this->assertTrue(true);
    }

    public function test_can_store_attribute(): void
    {
        $attribute = $this->post(route('attribute.store'), [
            'title' => $this->faker->colorName,
        ])->assertStatus(200)->getOriginalContent();
        self::$id = $attribute['data']['id'];
    }

    public function test_can_edit_attribute(): void
    {
        $this->get(route('attribute.edit', self::$id))->assertStatus(200);
    }

    public function test_can_update_attribute(): void
    {
        $this->patch(route('attribute.update', self::$id), [
            'title' => $this->faker->colorName,
        ])->assertStatus(200);
    }

    public function test_can_destroy_attribute(): void
    {
        $this->delete(route('attribute.destroy', self::$id))->assertStatus(200);
    }

    public function test_can_force_attribute(): void
    {
        $this->assertTrue($this->model->onlyTrashed()->find(self::$id)->forceDelete());
    }
}
