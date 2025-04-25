<?php

namespace Database\Factories;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $images = File::files(public_path('images'));
        $randomImage = $images[array_rand($images)];
        $randomImageUrl = asset('http://localhost:8000/images/' . basename($randomImage));

        return [
            'name' => $this->faker->unique()->words(3, true),
            'image_url' => $randomImageUrl,
            'additional_images' => [
                'http://localhost:8000/images/nvidia-rtx-3080.jpg',
                'http://localhost:8000/images/nvidia-rtx-5070ti.jpg'
            ],
            'description' => $this->faker->paragraph(4),
            'price' => $this->faker->randomFloat(2, 5, 500),
            'in_stock' => $this->faker->numberBetween(0, 500),
            'created_at' => now(),
        ];
    }
}
