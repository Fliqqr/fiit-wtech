<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products - eShop</title>
    @vite(['resources/css/products.css', 'resources/css/base.css', 'resources/css/header.css', 'resources/css/footer.css'])
</head>

<body>
    <form method="GET" action="{{ route('products.index') }}">

        <header>
            <a href="/" class="logo">eShop</a>
            <div class="search-bar">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." />
                <button type="submit">🔍</button>
            </div>
            <div class="navbar-actions">
                <div class="cart"><a href="cart">🛒</a></div>
                <div class="account"><a href="login">👤 Account</a></div>
            </div>
        </header>

        <div class="content-wrapper">
            <div class="container">
                <div class="sidebar">
                    <h3>Filters</h3>

                    {{-- <form method="GET" action="{{ route('products.index') }}"> --}}
                    <label for="sort-select">Sort By:</label>
                    <select id="sort-select" name="sort">
                        <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Price: Low to
                            High</option>
                        <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Price: High
                            to Low</option>
                        <option value="date-asc" {{ request('sort') == 'date-asc' ? 'selected' : '' }}>Oldest First
                        </option>
                        <option value="date-desc" {{ request('sort') == 'date-desc' ? 'selected' : '' }}>Newest First
                        </option>
                    </select>

                    <label for="price-range">Max Price: <span
                            id="price-value">{{ request('max_price', 100) }}</span></label>
                    <input type="range" id="price-range" name="max_price" min="0" max="1000"
                        value="{{ request('max_price', 100) }}" step="10"
                        oninput="document.getElementById('price-value').innerText = this.value" />

                    <label><input type="checkbox" name="in_stock" {{ request('in_stock') ? 'checked' : '' }} /> In
                        Stock</label><br />
                    <label><input type="checkbox" name="on_sale" {{ request('on_sale') ? 'checked' : '' }} /> On
                        Sale</label><br />

                    <label for="brand-select">Brand:</label>
                    <select id="brand-select" name="brand">
                        <option value="all">All Brands</option>
                        <option value="nvidia" {{ request('brand') == 'nvidia' ? 'selected' : '' }}>NVIDIA</option>
                        <option value="amd" {{ request('brand') == 'amd' ? 'selected' : '' }}>AMD</option>
                        <option value="intel" {{ request('brand') == 'intel' ? 'selected' : '' }}>Intel</option>
                    </select>

                    <button type="submit">Apply Filters</button>
                    {{-- </form> --}}
                </div>

                <div class="products-section">
                    <h2>Products</h2>
                    <div class="products-grid">
                        @foreach ($products as $product)
                            <div class="product">
                                <a href="{{ url('/item?id=' . $product->id) }}">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" />
                                    <p>{{ $product->name }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>

    </form>

    <footer>
        <p>&copy; 2025 eShop. All rights reserved.</p>
        <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>
</body>

</html>
