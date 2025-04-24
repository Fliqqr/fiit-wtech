<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery - eShop</title>
    @vite([
        'resources/css/delivery.css',
        'resources/css/base.css',
        'resources/css/header.css',
        'resources/css/footer.css'
    ])
</head>
<body>
<header>
    <a href="{{route('home')}}" class="logo">eShop</a>
    <div class="search-bar">
        <input type="text" placeholder="Search products..." />
        <button type="submit">🔍</button>
    </div>
    <div class="navbar-actions">
        <div class="cart"><a href="{{route('cart')}}">🛒</a></div>
        <div class="account">
            @guest
                <a href="{{ route('login')}}">👤 Account</a>
            @endguest
            @auth
                <form method="POST" action="{{ route("logout") }}">
                    @csrf
                    <button type="submit">🔓 Logout</button>
                </form>
            @endauth
        </div>
    </div>
</header>

<div class="delivery-container">
    <div class="progress-bar">
        <span>Shopping cart</span>
        <span>&rarr;</span>
        <span class="active">Delivery</span>
        <span>&rarr;</span>
        <span>Payment</span>
    </div>

    <form method="POST" action="{{ route('delivery.submit') }}" id="delivery_form">
        @csrf

        @if ($errors->any())
            <ul class="form-errors">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="delivery-content">
            <div class="address-panel">
                <h2>Shipping Address</h2>

                <input type="text" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}">
                <input type="text" name="address" placeholder="Address" value="{{ old('address') }}">
                <input type="text" name="city" placeholder="City" value="{{ old('city') }}">
                <input type="text" name="postal_code" placeholder="Postal Code" value="{{ old('postal_code') }}">
                <input type="text" name="country" placeholder="Country" value="{{ old('country') }}">
            </div>

            <div class="options-panel">
                <h2>Delivery Options</h2>
                <div class="delivery-options">
                    <label>
                        <input type="radio" name="delivery" value="pickup" {{ old('delivery') === 'pickup' ? 'checked' : '' }} required>
                        Pickup in Shop (Free)
                    </label>
                    <label>
                        <input type="radio" name="delivery" value="home" {{ old('delivery') === 'home' ? 'checked' : '' }}>
                        Home Delivery (€5)
                    </label>
                    <label>
                        <input type="radio" name="delivery" value="express" {{ old('delivery') === 'express' ? 'checked' : '' }}>
                        Express Delivery (€10)
                    </label>
                </div>
            </div>
        </div>

        <div class="delivery-actions">
            <button type="button" onclick="window.location='{{ route('cart') }}'">Back to Cart</button>
            <button type="submit">Continue</button>
        </div>
    </form>
</div>

<footer>
    <p>&copy; 2025 eShop. All rights reserved.</p>
    <p>Contact | Privacy Policy | Terms of Service</p>
</footer>
</body>
</html>
