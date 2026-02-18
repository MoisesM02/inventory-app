<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseDetail>
 */
class PurchaseDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'purchase_id' => Purchase::factory()->create(),
            'product_id' => Product::first(),
            'quantity' => $this->faker->randomNumber(),
            'cost' => $this->faker->randomFloat(2, 10),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
