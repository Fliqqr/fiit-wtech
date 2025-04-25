<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
            'category_type' => $this->faker->randomElement(['Brand', 'Model', 'Component']),
        ];
    }
}
