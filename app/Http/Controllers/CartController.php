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
        session()->start();

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:1',
        ]);

        $productId = $request->product_id;
        $amount = $request->amount;
        $sessionId = session()->getId();

        if (Auth::check()) {
            $identifier = ['user_id' => auth::id()];
        }
        else{
            $identifier = ['session_id' => $sessionId];
        }

        $cartItem = InShoppingCart::where($identifier)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->amount += $amount;
            $cartItem->save();
        } else {
            InShoppingCart::create(array_merge($identifier, [
                'product_id' => $request->product_id,
                'amount' => $request->amount,
            ]));
        }


        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function index()
    {
        $query = InShoppingCart::with('product');

        if (Auth::check()) {
            $cartItems = $query->where('user_id', Auth::id())->get();
        } else {
            $cartItems = $query->where('session_id', session()->getId())->get();
        }

        return view('cart', compact('cartItems'));
    }

    public function update(Request $request, InShoppingCart $item)
    {
        $request->validate(['amount' => 'required|integer|min:1']);
        $item->update(['amount' => $request->amount]);

        return redirect()->back()->with('success', 'Cart updated');
    }

    public function remove(InShoppingCart $item)
    {
        $item->delete();
        return redirect()->back()->with('success', 'Item removed');
    }
}
