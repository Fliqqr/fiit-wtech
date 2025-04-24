<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InShoppingCart;
use App\Models\Product;
use App\Models\User;

class PaymentController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user() ?? User::find(session('temp_user_id'));
        $cartItems = InShoppingCart::with('product')
            ->where(Auth::check() ? ['user_id' => $user->id] : ['session_id' => session()->getId()])
            ->get();

        // Calculate total
        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->amount);

        // Delivery method
        $delivery = $request->session()->get('delivery');
        $deliveryPrice = match ($delivery) {
            default => 0,
            'home' => 5,
            'express' => 10,
        };

        return view('payment', [
            'user' => $user,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'delivery' => $delivery,
            'deliveryPrice' => $deliveryPrice,
            'total' => $subtotal + $deliveryPrice,
        ]);
    }
}
