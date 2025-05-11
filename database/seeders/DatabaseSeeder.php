<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\InShoppingCart;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Product::factory()->count(200)->create();

        // ProductCategory::factory()->count(10)->create();

        $brands = ['Nvidia', 'Intel', 'AMD', 'ASUS', 'Gigabyte'];
        $components = ['GPU', 'CPU', 'Motherboard', 'RAM'];
        $models = range(2012, 2025);

        foreach ($brands as $brand) {
            ProductCategory::create(['name' => $brand, 'category_type' => 'Brand']);
        }

        foreach ($components as $component) {
            ProductCategory::create(['name' => $component, 'category_type' => 'Component']);
        }

        foreach ($models as $year) {
            ProductCategory::create(['name' => (string)$year, 'category_type' => 'Model']);
        }

        // Get categories grouped by type
        $groupedCategories = ProductCategory::all()->groupBy('category_type');

        Product::all()->each(function ($product) use ($groupedCategories) {
            $categoryIds = collect();

            foreach (['Brand', 'Model'] as $type) {
                $categories = $groupedCategories[$type] ?? collect();
                $categoryIds = $categoryIds->merge(
                    $categories->random(1)->pluck('id')
                );
            }

            $url = strtolower($product->image_url);
            $componentCategory = null;

            if (strpos($url, 'cpu') !== false) {
                $componentCategory = 'CPU';
            } elseif (strpos($url, 'gpu') !== false) {
                $componentCategory = 'GPU';
            } elseif (strpos($url, 'ram') !== false) {
                $componentCategory = 'RAM';
            } elseif (strpos($url, 'mobo') !== false) {
                $componentCategory = 'Motherboard';
            }

            // Attach the corresponding Component category
            if ($componentCategory) {
                $componentCategoryId = $groupedCategories['Component']->firstWhere('name', $componentCategory)->id;
                if ($componentCategoryId) {
                    $categoryIds->push($componentCategoryId);
                }
            }

            $product->categories()->attach($categoryIds->all());
        });
    }
}
