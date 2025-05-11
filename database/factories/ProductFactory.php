<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $components = [
            'CPU' => 'cpu',
            'GPU' => 'gpu',
            'RAM' => 'ram',
            'Motherboard' => 'mobo',
        ];

        $component = array_rand($components); // this is the key (e.g., "GPU")
        $folder = $components[$component];

        $images = File::files(public_path("images/{$folder}"));
        if (empty($images)) {
            throw new \Exception("No images found in public/images/{$folder}");
        }

        $mainImage = $images[array_rand($images)];
        $baseUrl = 'http://localhost:8000';

        $mainImageUrl = "{$baseUrl}/images/{$folder}/" . basename($mainImage);

        $additionalImages = collect($images)
            ->filter(fn($img) => basename($img) !== basename($mainImage))
            ->shuffle()
            ->take(rand(0, 2))
            ->map(fn($img) => "{$baseUrl}/images/{$folder}/" . basename($img))
            ->values()
            ->toArray();

        $componentAdjectives = [
            'CPU' => ['Intel', 'AMD', 'Ryzen', 'Core', 'Xeon'],
            'GPU' => ['RTX', 'GTX', 'NVIDIA', 'GeForce', 'AMD', 'RX'],
            'RAM' => ['Corsair', 'HyperX', 'G.Skill', 'Kingston', 'Vengeance'],
            'Motherboard' => ['MSI', 'Gigabyte', 'ASUS', 'ASRock', 'Biostar'],
        ];

        $adjective = $this->faker->randomElement($componentAdjectives[$component]);
        $modelName = $this->faker->unique()->words(2, true); // You can also add a model number or code here if you'd like

        // Example: "Intel Core i9 10900K" for CPU or "NVIDIA GeForce RTX 3080" for GPU
        $productName = "{$adjective} {$component} {$modelName}";

        return [
            'name' => $productName, // Use the generated fitting name
            'image_url' => $mainImageUrl,
            'additional_images' => $additionalImages,
            'description' => $this->faker->paragraph(4),
            'price' => $this->faker->randomFloat(2, 5, 500),
            'in_stock' => $this->faker->numberBetween(0, 500),
            'created_at' => now(),
        ];
    }

    // faker->unique()->words(3, true),
}
