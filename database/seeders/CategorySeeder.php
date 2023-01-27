<?php

namespace Database\Seeders;

use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Controllers\Product\Relation\Category\Enumeration\CategoryDefaultPathEnumeration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->firstOrCreate('Electronics', [
            ['title' => 'Mobile Phones'],
            ['title' => 'Laptops'],
            ['title' => 'Tablets'],
            ['title' => 'TV & Audio'],
            ['title' => 'Cameras'],
            ['title' => 'Accessories'],
        ]);
    }

    /**
     * @param $title
     * @param array $parents
     * @return void
     */
    public function firstOrCreate($title, array $parents): void
    {
        $category = resolve(CategoryInterface::class)
            ->firstOrCreate($title, Str::slug($title), CategoryDefaultPathEnumeration::DEFAULT_PATH, null);

        foreach ($parents as $parent) {
            $category->parents()
                ->firstOrCreate([
                    'title' => $parent['title'],
                    'slug' => Str::slug($parent['title']),
                    'path' => CategoryDefaultPathEnumeration::DEFAULT_PATH
                ]);
        }
    }
}
