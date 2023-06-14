<?php

namespace Database\Seeders;

use App\Http\Controllers\Product\Relation\Attribute\Contract\AttributeInterface;
use App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Enumeration\AttributeValueDefaultPathEnumeration;
use Illuminate\Database\Seeder;

class AttributeAndAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->firstOrCreate('Color', ['Red', 'Green', 'Blue']);
        $this->firstOrCreate('Size', ['Small', 'Medium', 'Large']);
    }

    /**
     * @param string $title
     * @param array $values
     * @return void
     */
    public function firstOrCreate(string $title, array $values): void
    {
        $attribute = resolve(AttributeInterface::class)
            ->firstOrCreate($title);
        foreach ($values as $value) {
            $attribute->values()
                ->firstOrCreate([
                    'title' => $value,
                    'code' => strtoupper($value),
                ]);
        }
    }
}
