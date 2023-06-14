<?php

namespace Database\Seeders;

use App\Http\Controllers\Product\Relation\Brand\Contract\BrandInterface;
use App\Http\Controllers\Product\Relation\Brand\Enumeration\BrandDefaultPathEnumeration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->firstOrCreate('Apple');
    }

    /**
     * @param string $title
     * @return void
     */
    public function firstOrCreate(string $title): void
    {
        resolve(BrandInterface::class)
            ->firstOrCreate($title, Str::slug($title));
    }
}
