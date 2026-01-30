<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'  => ucwords(fake()->words(2, true)) ,
            'code'  => fake()->unique()->countryCode(),
            'price' => fake()->randomFloat(2, 1, 100),
            'stock' => fake()->randomNumber(3, false),
            'unit'  => fake()->word(),
        ];
    }
}
