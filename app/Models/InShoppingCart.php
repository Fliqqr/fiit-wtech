<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InShoppingCart extends Model
{
    use HasFactory;

    protected $table = 'in_shopping_cart';

    protected $fillable = [
        'user_id',
        'session_id',
        'product_id',
        'amount',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
