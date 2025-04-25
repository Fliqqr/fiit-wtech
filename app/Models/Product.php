<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_url',
        'description',
        'price',
        'in_stock',
        'additional_images',
    ];

    protected $casts = [
        'price' => 'float',
        'in_stock' => 'integer',
        'created_at' => 'datetime',
        'additional_images' => 'array',
    ];

    public $timestamps = false;

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_tags', 'product_id', 'product_category_id');
    }
}
