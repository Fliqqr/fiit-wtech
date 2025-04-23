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

    <div class="delivery-content">
        <div class="address-panel">
            <h2>Shipping Address</h2>
            <form>
                <input type="text" placeholder="Full Name" required />
                <input type="text" placeholder="Street Address" required />
                <input type="text" placeholder="City" required />
                <input type="text" placeholder="Postal Code" required />
                <input type="text" placeholder="Country" required />
            </form>
        </div>

        <div class="options-panel">
            <h2>Delivery Options</h2>
            <div class="delivery-options">
                <label>
                    <input type="radio" name="delivery" value="pickup" required />
                    Pickup in Shop (Free)
                </label>
                <label>
                    <input type="radio" name="delivery" value="home" />
                    Home Delivery (€5)
                </label>
                <label>
                    <input type="radio" name="delivery" value="express" />
                    Express Delivery (€10)
                </label>
            </div>
        </div>
    </div>

    <div class="delivery-actions">
        <a href="{{route('cart')}}">Back to Cart</a>
        <a href="{{route('payment')}}">Continue</a>
    </div>
</div>

<footer>
    <p>&copy; 2025 eShop. All rights reserved.</p>
    <p>Contact | Privacy Policy | Terms of Service</p>
</footer>
</body>
</html>
