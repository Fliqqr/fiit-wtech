<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    public function run(): void
    {
        $brands = ['Nvidia', 'Intel', 'AMD', 'ASUS', 'Gigabyte'];
        $components = ['GPU', 'CPU', 'Monitor', 'Motherboard', 'RAM'];
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
    }
}
