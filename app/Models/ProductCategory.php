<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_type'];

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tags');
    }

    public static function getCategoriesAsMap()
    {
        // Group categories by category_type and return the category names as an array
        return self::all()->groupBy('category_type')->map(function ($categories) {
            return $categories->pluck('name')->toArray();
        })->toArray();
    }
}