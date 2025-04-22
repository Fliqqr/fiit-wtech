<?php

namespace Database\Factories;

use App\Models\InShoppingCart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class InShoppingCartFactory extends Factory
{
    protected $model = InShoppingCart::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::inRandomOrder()->first()?->id ?? Product::factory(),
            'amount' => $this->faker->numberBetween(1, 5),
        ];
    }
}
