<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Table name is "products" by default, so no need to specify unless different

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'image_url',
        'description',
        'price',
        'in_stock',
    ];

    // If you want to cast types (optional but useful)
    protected $casts = [
        'price' => 'float',
        'in_stock' => 'integer',
        'created_at' => 'datetime',
    ];

    // Disable updated_at if you're not using it
    public $timestamps = false;

    public function categories() {
        return $this->belongsToMany(ProductCategory::class, 'product_tags', 'product_id', 'product_category_id');
    }
}
