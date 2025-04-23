<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\InShoppingCart;
use App\Models\User;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:1',
        ]);

        $user = User::default();

        $cartItem = InShoppingCart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->amount += $request->amount;
            $cartItem->save();
        } else {
            InShoppingCart::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'amount' => $request->amount,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
