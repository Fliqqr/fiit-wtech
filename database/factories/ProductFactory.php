<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(3, true),
            'image_url' => $this->faker->imageUrl(640, 480, 'tech', true),
            'description' => $this->faker->paragraph(4),
            'price' => $this->faker->randomFloat(2, 5, 500),
            'in_stock' => $this->faker->numberBetween(0, 500),
            'created_at' => now(),
        ];
    }
}
