<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MediaSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            AttributeAndAttributeValueSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CouponSeeder::class,
        ]);
    }
}
