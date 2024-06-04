<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{


    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'price' => fake()->randomFloat(2, 1, 1000),
            'quantity' => fake()->numberBetween(1, 100),
            'quantity_sold' => fake()->numberBetween(1, 100),
            'description' => fake()->sentence,
            'image' => fake()->imageUrl(640, 480, 'products', true),
        ];
    }
}
