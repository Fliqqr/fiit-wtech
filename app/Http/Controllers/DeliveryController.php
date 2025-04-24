<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class DeliveryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'email' => 'nullable|email|max:255',
        ]);

        if (Auth::check()) {
            $user = Auth::user();
            $user->update($validated);
        } else {
            // If email was not provided, generate one
            $validated['email'] = $validated['email'] ?? Str::uuid() . '@guest.com';

            $user = User::create([
                'email' => $validated['email'],
                'full_name' => $validated['full_name'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'],
                'password' => Hash::make(Str::random(16)), // guest account
                'email_verified_at' => null,
            ]);

            session(['temp_user_id' => $user->id]);
        }

        return redirect()->route('payment'); // to your payment page
    }
}
