<?php

namespace Database\Factories;

use App\Models\Tax;
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
    public function definition()
    {
        $tax = Tax::factory()->create();

        return [
            'name' => fake()->unique()->name(),
            'cost' => 2000,
            'tax_rate_id' => $tax['id'],
        ];
    }
}
