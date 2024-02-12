<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'cost_price' => $faker->numberBetween($min = 5000, $max = 25000),
                'selling_price' => $faker->numberBetween($min = 2500, $max = 45000),
                'image' => $faker->imageUrl(),
                'stock' => $faker->numberBetween(0, 100),
            ]);
        }
    }
}
