<?php

namespace Tests\Unit;

use App\Http\Controllers\Product\Relation\Attribute\Model\Attribute;
use Tests\TestCase;

class AttributeTest extends TestCase
{
    /**
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->model = resolve(Attribute::class);
    }

    /**
     * @return void
     */
    public function test_can_index_attribute(): void
    {
        $this->assertIsObject($this->post(route('attribute.index'), [])->getOriginalContent());
    }

    /**
     * @return void
     */
    public function test_can_create_attribute(): void
    {
        $this->assertTrue(true);
    }

    /**
     * @return void
     */
    public function test_can_store_attribute(): void
    {
        $attribute = $this->post(route('attribute.store'), [
            'title' => $this->faker->colorName
        ])->assertStatus(200)->getOriginalContent();
        self::$id = $attribute['data']['id'];
    }

    /**
     * @return void
     */
    public function test_can_edit_attribute(): void
    {
        $this->get(route('attribute.edit', self::$id))->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_update_attribute(): void
    {
        $this->patch(route('attribute.update', self::$id), [
            'title' => $this->faker->colorName
        ])->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_destroy_attribute(): void
    {
        $this->delete(route('attribute.destroy', self::$id))->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_can_force_attribute(): void
    {
        $this->assertTrue($this->model->find(self::$id)->forceDelete());
    }
}
