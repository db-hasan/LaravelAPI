<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Adjust the loop count based on the number of products you want to seed
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'product_name' => 'laptops',
                'product_sku' => $faker->unique()->isbn10,
                'mfg_cost' => $faker->numberBetween(50000, 100000),
                'sales_price' => $faker->numberBetween(100000, 120000),
                'product_qty' => $faker->numberBetween(1, 10),
                'product_des' => 'Acer Aspire Lite AL15-51 Intel Core i3 1115G4',
                'product_img' => $faker->imageUrl(),
            ]);
        }
    }
}