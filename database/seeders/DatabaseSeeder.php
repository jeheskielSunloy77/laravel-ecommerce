<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use SebastianBergmann\CodeUnitReverseLookup\Wizard;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->delete();
        $userIds = [];


        for ($i = 1; $i <= 3; $i++) {
            $id = fake()->uuid();
            $userIds[] = $id;
            if ($i == 1) {
                User::factory()->create([
                    'id' => $id,
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => 'admin',
                ]);
            } else {
                User::factory()->create([
                    'id' => $id,
                ]);
            }
        }


        Product::query()->delete();
        $productIds = [];

        for ($i = 1; $i <= 100; $i++) {
            $id = fake()->uuid();
            $productIds[] = $id;

            Product::create([
                'id' => $id,
                'name' => fake()->sentence(2),
                'price' => fake()->randomFloat(2, 1, 10),
                'description' => fake()->paragraph(20),
                'image' => 'https://picsum.photos/seed/' . $i . '/640/480',
                'category' => fake()->randomElement(['clothes', 'shoes', 'sports wear', 'bags', 'hats', 'watches', 'jewelery', 'electronics', 'kids', 'furniture', 'books', 'cosmetics', 'health', 'toys', 'grocery', 'stationary']),
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            ]);
        }

        Cart::query()->delete();

        for ($i = 1; $i <= 10; $i++) {
            Cart::create([
                'id' => fake()->uuid(),
                'user_id' => fake()->randomElement($userIds),
                'product_id' => fake()->randomElement($productIds),
                'quantity' => fake()->numberBetween(1, 10),
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            ]);
        }


        Wishlist::query()->delete();

        for ($i = 1; $i <= 15; $i++) {
            Wishlist::create([
                'id' => fake()->uuid(),
                'user_id' => fake()->randomElement($userIds),
                'product_id' => fake()->randomElement($productIds),
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            ]);
        }

        Transaction::query()->delete();

        for ($i = 1; $i <= 20; $i++) {
            Transaction::create([
                'id' => fake()->uuid(),
                'user_id' => fake()->randomElement($userIds),
                'product_id' => fake()->randomElement($productIds),
                'quantity' => fake()->numberBetween(1, 10),
                'rating' => fake()->boolean() ? fake()->numberBetween(1, 5) : null,
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
