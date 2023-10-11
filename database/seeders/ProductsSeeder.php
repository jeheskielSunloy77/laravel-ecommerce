<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->truncate();

        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'id' => fake()->uuid(),
                'name' => fake()->sentence(3),
                'price' => fake()->randomFloat(2, 1, 10),
                'description' => fake()->sentence(10),
                'image' => fake()->imageUrl(640, 480, 'animals', true),
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
