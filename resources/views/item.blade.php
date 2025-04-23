<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/item.css', 'resources/css/base.css', 'resources/css/header.css', 'resources/css/footer.css'])
    <title>{{ $product->name }} - eShop</title>
</head>

<body>
    <header>
        <a href="/" class="logo">eShop</a>
        <div class="search-bar">
            <form method="GET" action="{{ route('products.index') }}">
                <input type="text" name="search" placeholder="Search products..." />
                <button type="submit">🔍</button>
            </form>
        </div>
        <div class="navbar-actions">
            <div class="cart"><a href="cart">🛒</a></div>
            <div class="account"><a href="login">👤 Account</a></div>
        </div>
    </header>

    <div class="content-wrapper">
        <div class="product-view">
            <div class="product-gallery">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="main-image" />
            </div>

            <div class="product-details">
                <h1>{{ $product->name }}</h1>
                <p class="price">${{ number_format($product->price, 2) }}</p>
                <p class="stock">Stock left: <span class="stock-count">{{ $product->in_stock }}</span></p>
                <p class="description">{{ $product->description }}</p>

                {{-- Placeholder for technical specs --}}
                <div class="technical-details">
                    <h2>Technical Specifications</h2>
                    <ul>
                        <li>More specs coming soon...</li>
                    </ul>
                </div>

                <div class="add-to-cart-section">
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="amount" value="1" min="1" class="quantity-input">
                        <button type="submit" class="add-to-cart">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 eShop. All rights reserved.</p>
        <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>
</body>

</html>
