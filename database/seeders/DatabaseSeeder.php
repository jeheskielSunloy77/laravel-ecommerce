<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Product::query()->delete();

        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'id' => fake()->uuid(),
                'name' => fake()->sentence(2),
                'price' => fake()->randomFloat(2, 1, 10),
                'description' => fake()->paragraph(20),
                'image' => fake()->imageUrl(640, 480,),
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
