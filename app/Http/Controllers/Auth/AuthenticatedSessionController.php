<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        session()->put('guest_cart_session_id', session()->getId());
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $guestSessionId = session()->pull('guest_cart_session_id');

        $request->authenticate();
        $request->session()->regenerate();

        $userId = Auth::id();

        // Merge guest cart into user cart
        $guestCartItems = \App\Models\InShoppingCart::where('session_id', $guestSessionId)->get();

        foreach ($guestCartItems as $guestItem) {
            $existing = \App\Models\InShoppingCart::where('user_id', $userId)
                ->where('product_id', $guestItem->product_id)
                ->first();

            if ($existing) {
                $existing->amount += $guestItem->amount;
                $existing->save();
                $guestItem->delete();
            } else {
                $guestItem->user_id = $userId;
                $guestItem->session_id = null;
                $guestItem->save();
            }
        }

        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
